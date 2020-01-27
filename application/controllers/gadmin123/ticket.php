<?php
class Ticket extends Admin_Controller{
	public $_table_names = 'tickets';
	public $_subView = 'admin/problems/';
	public $_redirect = '/ticket';
    public $_current_revision_id;
	public function __construct(){
		parent::__construct();
		$this->checkPermissions('ticket_manage');
		$this->data['active'] = 'Ticket Management';
        $this->load->model(array('problem_model'));
		// Get language for content id to show in administration

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/update';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
	}
    
	function index(){
		$this->db->where('is_read',0);
		$this->db->set('is_read', 1, true);
		$this->db->update($this->_table_names);

        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1700).'Ticket';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
   		//$this->data['table'] = true;
		//$this->data['employee_data'] = $this->comman_model->get_by('admin',array('id !='=>$this->data['admin_details']->id,'is_ticket'=>1),false,false,false);
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('status'=>'Open'),false,false,false);
		$this->data['all_data2'] = $this->comman_model->get_by($this->_table_names,array('status'=>'In Progress'),false,false,false);
		$this->data['all_data3'] = $this->comman_model->get_by($this->_table_names,array('status'=>'Completed'),false,false,false);
		$this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function urgent(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1700).'Ticket';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
   		$this->data['table'] = true;
		$this->db->order_by('solve_user_time','asc');
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		$this->data['subview'] = $this->_subView.'index_time';	
		$this->load->view('admin/_layout_main',$this->data);

	}

    public function view($id = NULL){
	    // Fetch a page or set a new one
	   	$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],28);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	 	if($id)
        {
			$this->data['view_data'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, true);
			//$this->data['products'] = $this->problem_model->get_lang($id, FALSE, $this->data['content_language_id']);
			if(!$this->data['view_data']){
	            redirect($this->data['_cancel']);				
			}
       }
        else
        {
                redirect($this->data['_cancel']);				
	    }
		$this->db->order_by('id','asc');
		$this->data['problems_status'] = $this->comman_model->get_by($this->_table_names.'_status',array('ticket_id'=>$id),false,false,false);
		$this->data['products_file'] = $this->comman_model->get_by($this->_table_names.'_files',array('ticket_id'=>$id,'ticket_type'=>'problem'),false,false,false);

        if($this->input->post('reply_set')){		
            $data =array();
            $data = $this->comman_model->array_from_post(array('description'));
			$newTime = time();
			$data['user_id'] =0;
			$data['ticket_id'] = $id;
			$data['created_by'] = 'admin';
			$data['created'] = $newTime;
			$data['modified'] = $newTime;
/*			printR($data);
			die;*/
			$ids = $this->comman_model->save($this->_table_names.'_status',$data);
			$more_pic = $this->input->post('more_pic');
			if($more_pic){
				foreach($more_pic as $key=>$value){
		            $this->comman_model->save($this->_table_names.'_files', array('ticket_id'=>$id,'filename'=>$value,'ticket_type'=>'reply','reply_id'=>$ids));					
				}
			}


			$userdata = $this->comman_model->get_by('users',array('id'=>$this->data['view_data']->user_id), FALSE, FALSE, true);				
/*			$email_data = $this->comman_model->get_by('email',array('id'=>12),false,false,true);
						
			$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
			$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

			$email_data->message = str_replace('{user_name}', $this->data['view_data']->user_name, $email_data->message);
			$email_data->message = str_replace('{ticket_id}', $id, $email_data->message);
			$email_data->message = str_replace('{company_name}', $this->data['view_data']->company_name, $email_data->message);
			$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
			$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
			$email_data->message = str_replace('{ticket_link}', base_url().$this->data['settings']['admin_link'].'/ticket/view/'.$id, $email_data->message);
			//echo $email_data->message;die;
			$this->load->library('email');
			$config = array (
				  'mailtype' => 'html',
				  'charset'  => 'utf-8',
				  'priority' => '1'
				   );
			$this->email->initialize($config);
			$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
			$this->email->to($this->data['settings']['site_email']);
			$this->email->subject($email_data->subject);
			$this->email->message($email_data->message);
			$this->email->send();*/


/*			$email_data = $this->comman_model->get_by('email',array('id'=>13),false,false,true);
						
			$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
			$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

			$email_data->message = str_replace('{user_name}', $this->data['view_data']->user_name, $email_data->message);
			$email_data->message = str_replace('{ticket_id}', $id, $email_data->message);
			$email_data->message = str_replace('{company_name}', $this->data['view_data']->company_name, $email_data->message);
			$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
			$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
			$email_data->message = str_replace('{ticket_link}', base_url().'EN/customer_ticket/view/'.$id, $email_data->message);
			//echo $email_data->message;die;
			$this->load->library('email');
			$config = array (
				  'mailtype' => 'html',
				  'charset'  => 'utf-8',
				  'priority' => '1'
				   );
			$this->email->initialize($config);
			$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
			$this->email->to($userdata->email);
			$this->email->subject($email_data->subject);
			$this->email->message($email_data->message);
			$this->email->send();*/
            redirect($this->data['_cancel'].'/view/'.$id);
        }
		
		$this->data['subview'] = $this->_subView.'view';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	public function update($id = NULL){
	    // Fetch a page or set a new one
	   	$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1028)."Status";
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	 	if($id)
        {
			$this->data['view_data'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, true);
			//$this->data['products'] = $this->problem_model->get_lang($id, FALSE, $this->data['content_language_id']);
			if(!$this->data['view_data']){
	            redirect($this->data['_cancel']);				
			}
       }
        else
        {
                redirect($this->data['_cancel']);				
	    }

		if($this->input->post('operation')){
            $data =array();
            $data = $this->comman_model->array_from_post(array('description','status'));
            $data['user_id'] = 0;
            $data['ticket_id'] = $id;
			//$data['date'] = date('Y-m-d H:i:s');
			$data['created_by'] = 'admin';
			$data['created'] = time();
			$data['modified'] = time();
            $this->comman_model->save($this->_table_names.'_status',$data);


            redirect($this->data['_cancel'].'/view/'.$id);
        }
		
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
        
    public function delete($id){
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		$this->db->delete($this->_table_names, array('id'=>$id));
        redirect($this->data['_cancel']);
	}        

	function download($id = false){
		$this->load->helper('download');
		if(!$id){
			redirect($this->data['_cancel']);
		}
		$download_file = $this->comman_model->get_by($this->_table_names.'_files',array('md5(id)'=>$id),false,false,true);
		if(count($download_file)){
			//$this->comman_model->save('files',array('download_count'=>$download_file->download_count+1),$download_file->id);
			$data = file_get_contents('assets/uploads/tickets/'.$download_file->filename);
			force_download($download_file->filename,$data); 
		}
		else{
			redirect($this->data['_cancel']);
		}
	}    

	function ajax_save_status(){			
		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= '';		
		$post_data = array('status'=>$this->input->post('status'),'id'=>$this->input->post('id'));
		//$post_data = array('status'=>'Completed','id'=>3);
		$checkData = $this->comman_model->get_by($this->_table_names,array('id'=>$post_data['id']), FALSE, FALSE, true);
		if($checkData){
/*			$msge['result']= 'ok';
			$this->comman_model->save($this->_table_names,array('status'=>$post_data['status']),$post_data['id']);		*/

			$msge['result']= 'ok';
			$this->comman_model->save($this->_table_names,array('status'=>$post_data['status']),$post_data['id']);		
			if($checkData->status!='Completed'){
				if($post_data['status']=='Completed'){
					if(!empty($checkData->solve_user_time)){
						$nowtime =time();				
						$matchTime = strtotime($checkData->date.' '.$checkData->time);	
						$min30 = strtotime('+'.$checkData->solve_user_time.' hour', $matchTime);	
/*						echo '<br>Now: '.date('d-m-Y H:i:s',$nowtime);	
						echo '<br>On Time: '.date('d-m-Y H:i:s',$min30);	*/
						if($nowtime>$min30){
							$this->comman_model->save($this->_table_names,array('done_by'=>'Delay','rate'=>0,'done_user'=>'admin'),$post_data['id']);
						}
						else{
							//echo 'on Time';
							$this->comman_model->save($this->_table_names,array('done_by'=>'On Time','rate'=>5,'done_user'=>'admin'),$post_data['id']);
						}
					}
				}
			}

			$userdata = $this->comman_model->get_by('users',array('id'=>$checkData->user_id), FALSE, FALSE, true);				
			if($post_data['status']=='In Progress'){
/*				$email_data = $this->comman_model->get_by('email',array('id'=>7),false,false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

				$email_data->message = str_replace('{user_name}', $checkData->user_name, $email_data->message);
				$email_data->message = str_replace('{ticket_id}', $post_data['id'], $email_data->message);
				$email_data->message = str_replace('{company_name}', $checkData->company_name, $email_data->message);
				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{ticket_link}', base_url().$this->data['settings']['admin_link'].'/ticket/view/'.$post_data['id'], $email_data->message);
				//echo $email_data->message;die;
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
				$this->email->to($this->data['settings']['site_email']);
				$this->email->subject($email_data->subject);
				$this->email->message($email_data->message);
				$this->email->send();*/


/*				$email_data = $this->comman_model->get_by('email',array('id'=>8),false,false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

				$email_data->message = str_replace('{user_name}', $checkData->user_name, $email_data->message);
				$email_data->message = str_replace('{ticket_id}', $post_data['id'], $email_data->message);
				$email_data->message = str_replace('{company_name}', $checkData->company_name, $email_data->message);
				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{ticket_link}', base_url().'EN/customer_ticket/view/'.$post_data['id'], $email_data->message);
				//echo $email_data->message;die;
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
				$this->email->to($userdata->email);
				$this->email->subject($email_data->subject);
				$this->email->message($email_data->message);
				$this->email->send();*/
			}
			
			if($post_data['status']=='Completed'){
/*				$email_data = $this->comman_model->get_by('email',array('id'=>10),false,false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

				$email_data->message = str_replace('{user_name}', $checkData->user_name, $email_data->message);
				$email_data->message = str_replace('{ticket_id}', $post_data['id'], $email_data->message);
				$email_data->message = str_replace('{company_name}', $checkData->company_name, $email_data->message);
				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{ticket_link}', base_url().$this->data['settings']['admin_link'].'/ticket/view/'.$post_data['id'], $email_data->message);
				//echo $email_data->message;die;
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
				$this->email->to($this->data['settings']['site_email']);
				$this->email->subject($email_data->subject);
				$this->email->message($email_data->message);
				$this->email->send();*/


/*				$email_data = $this->comman_model->get_by('email',array('id'=>11),false,false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

				$email_data->message = str_replace('{user_name}', $checkData->user_name, $email_data->message);
				$email_data->message = str_replace('{ticket_id}', $post_data['id'], $email_data->message);
				$email_data->message = str_replace('{company_name}', $checkData->company_name, $email_data->message);
				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{ticket_link}', base_url().'EN/customer_ticket/view/'.$post_data['id'], $email_data->message);
				//echo $email_data->message;die;
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
				$this->email->to($userdata->email);
				$this->email->subject($email_data->subject);
				$this->email->message($email_data->message);
				$this->email->send();*/
			}
		}
		echo json_encode($msge);
	}

	function ajax_save_reply(){
		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= '';		
		$post_data = array('comment'=>$this->input->post('comment'),'id'=>$this->input->post('id'));
		$checkData = $this->comman_model->get_by($this->_table_names,array('id'=>$post_data['id']), FALSE, FALSE, true);
		if($checkData){
			$newTime = time();
			$msge['result']= 'ok';
			$data =array();
			$data['user_id'] = 0;
			$data['ticket_id'] = $post_data['id'];
			$data['description'] = $post_data['comment'];
			//$data['date'] = date('Y-m-d H:i:s');
			$data['created_by'] = 'user';
			$data['created'] = $newTime;
			$data['modified'] = $newTime;
			$msge['times'] = date('d M Y, h:i:A',$newTime);
			$this->comman_model->save($this->_table_names.'_status',$data);
		}
		echo json_encode($msge);
		
	}
	function ajax_upload(){
		$this->load->helper('string');
		$id = $this->input->post('id');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/tickets';
		$config['allowed_types'] = '*';
		
		//$config['allowed_types'] = config_item('allow_data_type');
		$config['max_size']	= '200000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('myfile')){
			$ret['result']= 'error';
			$ret['msg']= $this->upload->display_errors();
			//redirect('admin/add_coach');
		}
		else{
			$upload_info = $this->upload->data();
			$ret['result']= 'success';
			$ret['msg']= $upload_info['file_name'];
			
		}
	    echo json_encode($ret);	
	}
	function ajax_refresh(){
		$id = $this->input->post('id');
	   echo '<tr class="template-download fade in" id="'.$id.'">
		    <td width="60%" class="name">'.$id.'</td></tr>';
	}

	function remove_file(){
		$id = $this->input->post('id');
		$check_image = $this->comman_model->get_by($this->_table_names.'_files',array('id'=>$id),false,false,true);
		if($check_image){
			$this->comman_model->delete($this->_table_names.'_files',array('id'=>$id));
			$image = 'assets/uploads/tickets/'.$check_image->filename;
			if(is_file($image))
    	    	unlink($image);
		}
	}
	function ajax_resign(){
		$id = $this->input->post('id');
		$admin_id = $this->input->post('admin_id');
		$post_data = array('admin_id'=>$admin_id);
		if($this->data['admin_details']->default==1){
			$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			if($check){
				$this->comman_model->save($this->_table_names,$post_data,$id);
			}		
		}
	}

  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			$redirect = checkPermission('admin_permission',array('user_id'=>$this->data['admin_details']->id,'type'=>$type,'value'=>1));	
		}
		else{
			$redirect = 1;
		}
		
		if($redirect==0){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			if($redirect){
				redirect($redirect);
			}
			redirect($this->data['admin_link'].'');
		}		
	}

}
