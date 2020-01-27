<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends Admin_Controller {
	public $_table_names = 'stores';
	public $_subView = 'admin/stores/';
	public $_redirect = '/store';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'Product Management';
        $this->load->model(array('store_model'));
        // Get language for content id to show in administration

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_product==1){}
			else{
				$redirect = true;
			}
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}
    }
	

	function set_value(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		$check_data = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if($check_data){
			if($type=='online'){
				if($check_data->is_online==1){
					$post_data = array('is_online'=>0);
				}
				elseif($check_data->is_online==0){
					$post_data = array('is_online'=>1);
				}
				else{
					$post_data = array('is_online'=>1);
				}
				$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
			}
			if($type=='status'){
				if($check_data->status==1){
					$post_data = array('status'=>0);
				}
				elseif($check_data->status==0){
					$post_data = array('status'=>1);
				}
				else{
					$post_data = array('status'=>1);
				}
				$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
			}
			if($type=='feature'){
				if($check_data->is_feature==1){
					$post_data = array('is_feature'=>0);
				}
				elseif($check_data->is_feature==0){
					$post_data = array('is_feature'=>1);
				}
				else{
					$post_data = array('is_feature'=>1);
				}
				$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
			}
		}
	}

	//  Landing page of admin section.
	function get_confirm($id){
		if(!$id)
			redirect($this->data['_cancel']);
		$this->comman_model->save('users',array('confirm'=>'confirm'),$id);
		redirect($this->data['_cancel']);		
	}

	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],129);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		if($this->data['admin_details']->default=='0'){
			$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('admin_id'=>$this->data['admin_details']->id),false,false,false);		
		}
		else{
			$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		}

        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function calander($id=false){
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],2570).'calander';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    if($id){
			$this->data['stores']  = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
            if(!$this->data['stores']){
	            redirect($this->data['_cancel']);
			}
			$this->data['user_data']  = $this->comman_model->get_by('users',array('id'=>$this->data['stores']->user_id),false,false,true);
        }
        else{
			redirect($this->data['_cancel']);
        }
		
	    // Fetch a page or set a new one
		$this->data['id'] = $id;

		$this->data['subview'] = $this->_subView.'calander';
        $this->load->view('admin/_layout_main', $this->data);
	}



	function ajax_appointment($id=false){
		if($id){
			$check_product = $this->comman_model->get_by('stores',array('id'=>$id),false,false,true);
			$product_arr =array();
			if($check_product){
				$this->db->where('owner_id',$check_product->user_id);
				$all_data = $this->comman_model->get('remarks',false);
///				echo $this->db->last_query();
			
				$appointments = array();
				if($all_data){
					foreach($all_data as $set_data){
		/*				$case = $this->comman_model->get_by('cases',array('id'=>$set_data->case_id,'user_id'=>$this->data['user_details']->id),false,false,true);
						if($case){
							$appointments[] = array('title'=>$case->name,'start'=>date("Y-m-d", strtotime($set_data->start_date)));
						}
		*/
		
						$appointments[] = array('title'=>$set_data->name,'start'=>date("Y-m-d", strtotime($set_data->dates)),'url'=>$this->data['content_language_id'].$this->_redirect.'/view/'.$set_data->id,'description'=>$set_data->desc);
					}
				}		
				echo json_encode($appointments);
			}
		}
	}


	function create(){
	    // Fetch a page or set a new one
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['stores'] = $this->store_model->get_new();

	   	$this->db->order_by('title','asc');
        $this->data['categories_data'] = $this->comman_model->get_lang('categories',$this->data['content_language_id'],NULL,array('parent_id'=>0),'category_id',false);

	   	$this->db->order_by('title','asc');
        $this->data['department_data'] = $this->comman_model->get_lang('departments',$this->data['content_language_id'],NULL,false,'department_id',false);

        $this->data['time_data'] = $this->comman_model->get_time_hour();
        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));
        $rules = $this->store_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			$user_post =array('first_name','last_name','email','password');
			$store_post =array('name','country','address','zip','city','country','phone','start_time','end_time','delivery','description','gps',
								'department_id','category_id','sub_category_id','total_room','default',
								);
        	$userData = $this->store_model->array_from_post($user_post);
        	$storeData = $this->store_model->array_from_post($store_post);

	    	$storeData['slug'] = url_title($this->input->post('name'), 'dash', true);


			if($this->input->post('department_id')){
				$storeData['department_id'] = implode(',',$this->input->post('department_id'));
			}


			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/stores');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$storeData['logo'] = $result[1];
				}
			}	
			if (!empty($_FILES['image']['name'])){					
				$result =$this->comman_model->do_upload('image','./assets/uploads/stores');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$storeData['image'] = $result[1];
				}
			}	

            $storeData['order'] = $this->store_model->max_order()+1;
			$storeData['admin_id'] = $this->data['admin_details']->id;
			$storeData['date'] = date('Y-m-d H:i:s');
			$storeData['enabled'] = 1;
			$storeData['created'] = time();
			$storeData['modified'] = time();


			$userData['confirm'] = 'confirm';
	    	$userData['status'] = 1;
			$userData['account_type'] = 'R';

            $id = $this->comman_model->save('users',$userData);
			
			$storeData['user_id'] = $id;
         	$store_id = $this->comman_model->save($this->_table_names,$storeData);

			$more_pic = $this->input->post('more_pic');
			if($more_pic){
				foreach($more_pic as $key=>$value){
		            $this->comman_model->save('stores_files', array('store_id'=>$store_id,'filename'=>$value));					
				}
			}

			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
            redirect($this->data['_cancel']);
        }

		$this->data['subview'] = $this->_subView.'create';
        $this->load->view('admin/_layout_main', $this->data);
	}

	function edit($id= NULL){
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			if($this->data['admin_details']->default=='0'){
				$this->data['stores']  = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'admin_id'=>$this->data['admin_details']->id),false,false,true);
			}
			else{
	            $this->data['stores'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			}

            if(!$this->data['stores']){
	            redirect($this->data['_cancel']);
			}
			$this->data['user_data']  = $this->comman_model->get_by('users',array('id'=>$this->data['stores']->user_id),false,false,true);
        }
        else
        {
			redirect($this->data['_cancel']);
        }

	   	$this->db->order_by('title','asc');
        $this->data['categories_data'] = $this->comman_model->get_lang('categories',$this->data['content_language_id'],NULL,array('parent_id'=>0),'category_id',false);

	   	$this->db->order_by('title','asc');
        $this->data['department_data'] = $this->comman_model->get_lang('departments',$this->data['content_language_id'],NULL,false,'department_id',false);


		$this->data['products_file'] = $this->comman_model->get_by('stores_files',array('store_id'=>$id),false,false,false);

        $this->data['time_data'] = $this->comman_model->get_time_hour();
        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));
        $rules = $this->store_model->update_rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			//$user_post =array('first_name','last_name','email','password');
			$store_post =array('name','country','address','zip','city','country','phone','start_time','end_time','delivery','description','gps',
								'category_id','sub_category_id','total_room','default',
								);
        	//$userData = $this->store_model->array_from_post($user_post);
        	$storeData = $this->store_model->array_from_post($store_post);

	    	$storeData['slug'] = url_title($this->input->post('name'), 'dash', true);

			if($this->input->post('department_id')){
					$storeData['department_id'] = implode(',',$this->input->post('department_id'));
			}

			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/stores');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$storeData['logo'] = $result[1];
				}
			}	
			else{
				if($id != NULL)
					$storeData['logo'] = $this->data['stores']->logo;
			}

			if (!empty($_FILES['image']['name'])){					
				$result =$this->comman_model->do_upload('image','./assets/uploads/stores');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$storeData['image'] = $result[1];
				}
			}	
			else{
				if($id != NULL)
					$storeData['image'] = $this->data['stores']->image;
			}

          	//$this->comman_model->save('users',$userData,$this->data['stores']->user_id);
            $this->comman_model->save($this->_table_names,$storeData,$id);

			$more_pic = $this->input->post('more_pic');
			if($more_pic){
				foreach($more_pic as $key=>$value){
		            $this->comman_model->save('stores_files', array('store_id'=>$id,'filename'=>$value));					
				}
			}

			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel'].'/edit/'.$id);
			//die;
        }

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}	

	function send_mail($id =false){
		if(!$id){
            redirect($this->data['_cancel']);			
		}
		$checkStore = $this->comman_model->get_by('stores',array('id'=>$id),false,false,true);
		if(!$checkStore){
			$this->session->set_flashdata('error','There is no restuarant!!');
            redirect($this->data['_cancel']);			
			
		}
	
		$checkUser = $this->comman_model->get_by('users',array('id'=>$checkStore->user_id),false,false,true);
		if(!$checkUser){
			$this->session->set_flashdata('error','There is no user!!');
            redirect($this->data['_cancel']);			
			
		}

		$email_data = $this->comman_model->get_by('email',array('id'=>3),false,false,true);
				
		$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
		$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);
		
		$email_data->message = str_replace('{user_name}', $checkUser->first_name.' '.$checkUser->last_name, $email_data->message);
		$email_data->message = str_replace('{user_email}', $checkUser->email, $email_data->message);
		$email_data->message = str_replace('{password}', $checkUser->password, $email_data->message);
		$email_data->message = str_replace('{store_name}', $checkStore->name, $email_data->message);
		$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
		$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
		$email_data->message = str_replace('{login_link}', base_url(), $email_data->message);
		//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);
		//echo $checkUser->email.' '.$this->data['settings']['site_email'];die;
		//echo $email_data->message;die;
		$this->load->library('email');
		$config12 = array (
		  'mailtype' => 'html',
		  'charset'  => 'utf-8',
		  'priority' => '1'
		   );
		$this->email->initialize($config12);
		//echo $email_data->subject;

		$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
		$this->email->to($checkUser->email);
		$this->email->subject($email_data->subject);
		$this->email->message($email_data->message);
		
/*		$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
		$this->email->to('pvsysgroup01@gmail.com');
		$this->email->subject('asdasdas');
		$this->email->message($email_data->message);*/

		if($this->email->send()){
			$this->session->set_flashdata('success','mail has successfully sent!!');
		}
		else{
			$this->session->set_flashdata('error','There is some problem to sent mail!!');
		}

		redirect($this->data['_cancel']);			
	}

    public function review($id){
		if(!$id){
			redirect($this->_redirect);
		}
		$this->data['table'] = true;
		$this->data['title'] = 'Comments | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Comments';
		$this->data['uri_id'] = $id;
		$this->data['products'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, true);
		if(!$this->data['products']){
			redirect($this->data['_cancel']);
		}

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names.'_rating',array('store_id'=>$id), FALSE, FALSE, false);
        $this->data['subview'] = $this->_subView.'comment';	
		$this->load->view('admin/_layout_main',$this->data);
	}
    

	function get_active_review(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		$check_data = $this->comman_model->get_by($this->_table_names.'_review',array('id'=>$id),false,false,true);
		if($check_data){
			if($type=='enabled'){
				if($check_data->enabled==1){
					$post_data = array('enabled'=>0);
				}
				elseif($check_data->enabled==0){
					$post_data = array('enabled'=>1);
				}
				else{
					$post_data = array('enabled'=>1);
				}
				$result = $this->comman_model->save($this->_table_names.'_review',$post_data,$id);				
			}
		}
	}


 	function deletes($page = false,$uri=false,$id =false){
		if(!$page){
			redirect($this->data['_cancel']);
		}
		if(!$uri){
			redirect($this->data['_cancel']);
		}
		if($page=='review'){
			$name  = 'Comment';
		}
		else if($page=='answer'){
			$name  = 'Answer';
		}
		else{
			redirect($this->data['_cancel']);			
		}

		if(!$id){
			redirect($this->data['_cancel'].'view/'.$page.'/'.$uri);			
		}		
		if($page=='review'){
			$result = $this->comman_model->delete_by_id($this->_table_names.'_rating',array('id'=>$id));
		}

		$this->session->set_flashdata('success', $name.' has successfully deleted.'); 
		redirect($this->data['_cancel'].'/'.$page.'/'.$uri);
	}


	function delete($id = false){
		if(!$id){
            redirect($this->data['_cancel']);
		}
		$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!$check){
			$this->session->set_flashdata('error','There is no store.'); 
            redirect($this->data['_cancel']);
		}

		//$this->comman_model->update('categories',array('parent_id'=>0),array('parent_id'=>$id));

		$this->comman_model->delete_by_id($this->_table_names,array('id'=>$id));
		$this->comman_model->delete_by_id('products',array('store_id'=>$id));
		$this->comman_model->delete_by_id('users',array('id'=>$check->user_id));
		//$checkProduct = $this->comman_model->get_by('products',array('user_id'=>$id),false,false,false);

		$this->session->set_flashdata('success','Store has successfully deleted.'); 
		redirect($this->data['_cancel']);
	}

 	public function remove_file($type=false,$id=false){
		if(!$type){
            redirect($this->data['_cancel']);
		}
		if(!$id){
            redirect($this->data['_cancel']);
		}
        $check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!$check){
            redirect($this->data['_cancel'].'/edit/'.$id);
		}
		if($type=='image'){
			$this->db->where(array('id'=>$id));
			$this->db->update($this->_table_names, array('image'=>NULL));
			$file_dir ='assets/uploads/posts/full/'.$check->image; 
			if(is_file($file_dir)){
				unlink($file_dir);
			}
			$file_dir ='assets/uploads/posts/small/'.$check->image; 
			if(is_file($file_dir)){
				unlink($file_dir);
			}
			$file_dir ='assets/uploads/posts/thumbnails/'.$check->image; 
			if(is_file($file_dir)){
				unlink($file_dir);
			}
		}
		redirect($this->data['_cancel'].'/edit/'.$id);

	}


	function ajax_upload(){
		$this->load->helper('string');
		$id = $this->input->post('id');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/stores';
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
	function refresh(){
		$id = $this->input->post('id');
	   echo '<div class="product-item col-md-3" style="padding:4px;margin:5px;width:23%" >
        <div class="pi-img-wrapper">
	        <img style="height:100px;width:100%" alt="" class="img-responsive" src="assets/uploads/stores/'.$id.'"></a>
        </div></div>';
	}

	function remove_store_image(){
		$id = $this->input->post('id');
		$check_image = $this->comman_model->get_by('stores_files',array('id'=>$id),false,false,true);
		if($check_image){
			$this->comman_model->delete('stores_files',array('id'=>$id));
			$image = 'assets/uploads/stores/'.$check_image->filename;
			if(is_file($image))
    	    	unlink($image);
		}
	}


}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */