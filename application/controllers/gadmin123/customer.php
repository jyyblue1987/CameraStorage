<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends Admin_Controller {
	public $_table_names = 'users';
	public $_subView = 'admin/customers/';
	public $_redirect = '/customer';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'Customer Management';
        $this->load->model(array('customer_model'));
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
			if($this->data['admin_details']->is_customer==1){}
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
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1290).'Company';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		if($this->data['admin_details']->default=='0'){
			$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>'C','admin_id'=>$this->data['admin_details']->id),false,false,false);		
		}
		else{
			$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>'C',),false,false,false);
		}

        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function create(){
	    // Fetch a page or set a new one
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['stores'] = $this->customer_model->get_new();

	    // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));
        $rules = $this->customer_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			$user_post =array('first_name','last_name','email','password','company_name','website','phone');
			
        	$userData = $this->customer_model->array_from_post($user_post);

/*			if (!empty($_FILES['logo']['name'])){					
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
			}	*/

 			$userData['admin_id'] = $this->data['admin_details']->id;
 			$userData['created_by'] = 'admin';
			$userData['created'] = time();
			$userData['modified'] = time();
			$userData['confirm'] = 'confirm';
	    	$userData['status'] = 1;
			$userData['account_type'] = 'C';

            $id = $this->comman_model->save('users',$userData);
		
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
			//$this->data['user_data']  = $this->comman_model->get_by('users',array('id'=>$this->data['stores']->user_id),false,false,true);
        }
        else
        {
			redirect($this->data['_cancel']);
        }

        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));
        $rules = $this->customer_model->update_rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$user_post =array('first_name','last_name','phone','website','company_name');
			$userData = $this->customer_model->array_from_post($user_post);
        	
	    	$storeData['slug'] = url_title($this->input->post('name'), 'dash', true);

/*
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
			}*/

          	//$this->comman_model->save('users',$userData,$this->data['stores']->user_id);
            $this->comman_model->save($this->_table_names,$userData,$id);

			

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
		
	
		$checkUser = $this->comman_model->get_by('users',array('id'=>$id),false,false,true);
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




	function delete($id = false){
		if(!$id){
            redirect($this->data['_cancel']);
		}
		$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!$check){
			$this->session->set_flashdata('error','There is no company.'); 
            redirect($this->data['_cancel']);
		}

		//$this->comman_model->update('categories',array('parent_id'=>0),array('parent_id'=>$id));

		$this->db->delete($this->_table_names, array('id'=>$id));
		//$this->comman_model->delete_by_id('users',array('id'=>$check->user_id));
		//$checkProduct = $this->comman_model->get_by('products',array('user_id'=>$id),false,false,false);

		$this->session->set_flashdata('success','Company has successfully deleted.'); 
		redirect($this->data['_cancel']);
	}


}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */