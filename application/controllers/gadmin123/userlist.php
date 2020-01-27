<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userlist extends Admin_Controller {
	public $_table_names = 'users';
	public $_subView = 'admin/user/';
	public $_redirect = '/userlist';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'User Management';
        $this->load->model(array('users_model'));
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
		$this->checkPermissions('user_manage');

	}
	

	//  Landing page of admin section.
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'Dealer';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>"D"),false,false,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function type($type=false,$id=false){
		if(!$type){
			redirect($this->data['_cancel']);
		}
		if(!$id){
			redirect($this->data['_cancel']);
		}
		
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'Member';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		if($type=='athlete'){
			$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>"A",'parent_id'=>$id),false,false,false);
		}
		elseif($type=='coach'){
			$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>"C",'parent_id'=>$id),false,false,false);
		}
		else{
			$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>"E",'parent_id'=>$id),false,false,false);
		}
        $this->data['subview'] = $this->_subView.'index_member';	
		$this->load->view('admin/_layout_main',$this->data);
	}


	function set_user($id){
		if(!$id)
			redirect($this->data['_cancel']);
			$this->comman_model->save($this->_table_names,array('confirm'=>'confirm'),$id);
			redirect($this->data['_cancel']);		
	}


	function edit($id= NULL){
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$this->data['stores'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);

            if(!$this->data['stores']){
	            redirect($this->data['_cancel']);
			}
			//$this->data['user_data']  = $this->comman_model->get_by('users',array('id'=>$this->data['stores']->user_id),false,false,true);
        }
        else
        {
			redirect($this->data['_cancel']);
        }

	   	$this->db->order_by('name','asc');
        $this->data['countries_data'] = $this->comman_model->get('countries',false);


        // Set up the form
		$rules = array(
			'flash_notes' => array('field'=>'flash_notes', 'label'=>'flash_notes', 'rules'=>'trim'),
		);
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$user_post =array('flash_notes');
			$post_data= $this->comman_model->array_from_post($user_post);
          	//$this->comman_model->save('users',$userData,$this->data['stores']->user_id);
            $this->comman_model->save($this->_table_names,$post_data,$id);

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

	function get_comfirm($id){
		if(!$id){
			redirect($this->data['_cancel'].'/reseller');
		}
		
		$result = $this->comman_model->save($this->_table_names,array('admin_confirm'=>1),$id);
		redirect($this->data['_cancel'].'/reseller');
	}

	function get_status(){
		$id = $this->input->post('id');
		$post_data = array('status'=>$this->input->post('status'));
		$result = $this->comman_model->save($this->_table_names,$post_data,$id);
	}

	

	function delete($id = false){
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		if(!$id){
			redirect($this->data['_cancel']);
		}

		//$this->comman_model->update('categories',array('parent_id'=>0),array('parent_id'=>$id));
		$this->comman_model->delete_by_id($this->_table_names,array('id'=>$id));

		$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],297)); 
		redirect($this->data['_cancel']);		

	}
	//function send_mail(){}

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

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */