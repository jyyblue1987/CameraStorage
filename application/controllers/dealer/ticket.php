<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticket extends Frontend_Controller{
	public $_redirect = '/dealer/ticket';

	public $_table_names = 'tickets';

	public $_subView = 'ownner/tickets/';
	public $_mainView = 'ownner/_layout_main';


	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Ticket Management';	
		$this->data['name'] = 'Dashboard';	
        $this->load->model(array('users_model','problem_model'));
		
        $detail = $this->session->all_userdata();
		$redirect = false;
		if(isset($this->data['user_details'])){}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}

		$this->data['_user_link'] = $this->data['lang_code'].'/dealer';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';
		if($this->data['user_details']->parent_id!=0){
				redirect($this->data['lang_code'].'/user');
		}

	}

	function index(){
		//var_dump($this->session->all_userdata());
		$this->data['table'] = true;
        $this->data['name'] = show_static_text($this->data['lang_id'],1003).'Ticket';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['login'] = $this->session->all_userdata();
		$this->db->order_by('id','desc');
		$this->data['all_data']= $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id),false,false,false);
		
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view($this->_mainView,$this->data);
	}


	public function edit($id = NULL){
		$company_name = '';
	    if($id){
			redirect($this->data['_cancel']);
			$this->data['name'] = show_static_text($this->data['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['tickets'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id), FALSE, FALSE, true);
			if(empty($this->data['tickets'])){
	            redirect($this->data['_cancel']);
			}
			$this->data['products_file'] = $this->comman_model->get_by($this->_table_names.'_files',array('ticket_id'=>$this->data['tickets']->id),false,false,false);

        }
        else
        {
			$this->data['name'] = show_static_text($this->data['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
			$this->data['tickets'] = $this->problem_model->get_new_ticket();
        }
        



        $rules = $this->problem_model->rules;
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
            $data = $this->problem_model->array_from_post(array(
														'name','desc',
															));

            $data['user_id'] = $this->data['user_details']->id;
            if($id == NULL){
                $data['on_date'] = date('Y-m-d');
                $data['date_time'] = date('Y-m-d H:i:s');
                $data['status'] = 'Open';
			}

            /*if(!empty($_FILES['logo'])){
                $config['upload_path']      = 'assets/uploads/tickets/';
                $config['allowed_types']    = '*';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
					$upload_info = $this->upload->data();
					$data['files'] = $upload_info['file_name'];
				}
            }
			else{
                $data['files']  = $this->data['tickets']->image;
            }      */

			/*echo '<pre>';
			print_r($data);
			die;*/
	        $id =$this->comman_model->save($this->_table_names,$data,$id);
			$more_pic = $this->input->post('more_pic');
			if($more_pic){
				foreach($more_pic as $key=>$value){
		            $this->comman_model->save('tickets_files', array('ticket_id'=>$id,'filename'=>$value,'ticket_type'=>'problem'));					
				}
			}
			//$this->send_mail($id);
			$this->session->set_flashdata('success',$this->_msg_success); 
            redirect($this->data['lang_code'].$this->_redirect);
        }

        $this->data['subview'] = $this->_subView.'edit';	
		$this->load->view($this->_mainView,$this->data);
	}


	/*public function remove_file($id=false){
		$check  = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id), FALSE, FALSE, true);
		if($check){
			$this->comman_model->save($this->_table_names,array('files'=>''),$id);
			$file_dir ='assets/uploads/tickets/'.$check->files; 
			if(is_file($file_dir)){
				unlink($file_dir);
			}
		}
		else{
			$this->session->set_flashdata('error', 'Sorry you could not be delete.'); 
		}
		redirect($this->data['_edit'].'/'.$id);
	}*/


    public function delete($id){
        $check = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id), FALSE, FALSE, true);
		if(!$check){
			$this->session->set_flashdata('error', 'Sorry you could not be delete.'); 
			redirect($this->data['_cancel']);
		}
		$this->db->delete($this->_table_names, array('id'=>$id));
		redirect($this->data['_cancel']);
	}

	function view($id=false){
		$this->data['name'] = show_static_text($this->data['lang_id'],28);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    if($id){
			$this->data['view_data'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id), FALSE, FALSE, true);
			if(empty($this->data['view_data'])){
	            redirect($this->data['_cancel']);
			}

        }
        else{
            redirect($this->data['_cancel']);
		}

		$this->data['products_file'] = $this->comman_model->get_by('tickets_files',array('ticket_id'=>$id,'ticket_type'=>'problem'),false,false,false);
		$this->data['problems_status'] = $this->comman_model->get_by('tickets_status',array('ticket_id'=>$id),false,false,false);
		//$this->data['answer_data'] = $this->comman_model->get_by($this->_table_names.'_answer',array('ticket_id'=>$id),false,false,false);
       
        // Set up the form
/*        if($this->input->post('operation')){
            $data =array();
            $data = $this->comman_model->array_from_post(array('desc'));
            $data['user_id'] = $this->data['user_details']->id;
            $data['ticket_id'] = $id;
			$data['date'] = date('Y-m-d H:i:s');
			$data['created'] = time();
			$data['modified'] = time();
            $this->comman_model->save($this->_table_names.'_answer',$data);
            redirect($this->data['_cancel'].'/view/'.$id);
        }*/
		if ($this->input->post('rating_input')){
			$post_data = $this->comman_model->array_from_post(array('rate','comment'));
			$post_data['user_id']= $this->data['user_details']->id;
			$post_data['username']= $this->data['user_details']->first_name.' '.$this->data['user_details']->last_name;
			$post_data['ticket_id']= $id;
			$this->comman_model->save($this->_table_names.'_rating',$post_data);
			redirect($this->data['_cancel'].'/view/'.$id);
		}


        if($this->input->post('reply_set')){		
            $data =array();
            $data = $this->comman_model->array_from_post(array('description'));
			$newTime = time();
			$data['user_id'] = $this->data['user_details']->id;
			$data['ticket_id'] = $id;
			$data['created_by'] = 'user';
			$data['created'] = $newTime;
			$data['modified'] = $newTime;
/*			printR($data);
			die;*/
			$ids = $this->comman_model->save($this->_table_names.'_status',$data);
			$more_pic = $this->input->post('more_pic');
			if($more_pic){
				foreach($more_pic as $key=>$value){
		            $this->comman_model->save('tickets_files', array('ticket_id'=>$id,'filename'=>$value,'ticket_type'=>'reply','reply_id'=>$ids));					
				}
			}
            redirect($this->data['_cancel'].'/view/'.$id);
        }

		$this->data['subview'] = $this->_subView.'view';
        $this->load->view($this->_mainView, $this->data);		
	}


function ajax_get_hour(){	
		$msge = array();
		$msge['status']= 'ok';
		$msge['hour_time']= '0';

		$id = $this->input->post('id');
		$lang_id = $this->input->post('lang_code');
		$option = '<option value="0">Select</option>';
		if($id){
			//$this->db->order_by('title','asc');
			$result = $this->comman_model->get_by('tickets',array('id'=>$id),false,false,true);
			if($result){
				$msge['hour_time']= $result->solve_time;
				$msge['desc']= $result->desc;
				$msge['desc2']= $result->desc2;
			}
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


	function send_mail($id	= false){
		if(!$id)
			return false;
		
		$checkTicket = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkTicket)
			return false;
	

		$email_data = $this->comman_model->get_by('email',array('id'=>5),false,false,true);
		$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
		$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);		
		$email_data->message = str_replace('{user_name}',$this->data['user_details']->username, $email_data->message);
		$email_data->message = str_replace('{ticket_name}', $checkTicket->name, $email_data->message);
		$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
		$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
	//	echo $email_data->message;die;
		
		$this->load->library('email');
		$config = array (
		  'mailtype' => 'html',
		  'charset'  => 'utf-8',
		  'priority' => '1'
		   );
		$this->email->initialize($config);
		$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
		$this->email->to($this->data['user_details']->email);
		$this->email->subject($email_data->subject);
		$this->email->message($email_data->message);
		if($this->email->send()){
			return true;
		}
		else{
			return false;
		}
		
	}
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */