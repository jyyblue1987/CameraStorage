<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_setup extends Frontend_Controller{	
	public $_redirect = '/dealer/email_setup';
	public $_subView = 'ownner/email_setup/';
	public $_table_names = 'users_e_setup';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();

		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Content Management';
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');	
		$this->data['_user_link'] = $this->data['lang_code'].'/dealer';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

        $this->data['type_list'] = array('smtp'=>'External SMTP Server','email'=>'From E-Mail Address','system'=>'Use Internal E-Mail Server - No-Reply@MyOnlineCameras.com');
        $this->load->model(array('email_model'));
	//	$this->_checkPaidUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],1000)."E-mail Server Setup";
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$support = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id),false,false,true);
		if($support){
			$this->data['support_data'] =$support;			
		}
		else{
			$users = new stdClass();
			//$tags->parent_id = 0;
			$users->smtp_host 		= '';
			$users->smtp_port 		= '';
			$users->smtp_user 		= '';
			$users->email 			= '';
			$users->password		= '';
			$users->is_used			= 1;
			$users->type			= 'system';
			$this->data['support_data'] =$users;
		}
		$rules = array(
			'smtp_host' 	=> array('field'=>'smtp_host', 'label'=>'Smtp Host', 'rules'=>'trim'),
			'smtp_port' 	=> array('field'=>'smtp_port', 'label'=>'Smtp Port', 'rules'=>'trim'),
			'email' 		=> array('field'=>'email', 'label'=>'email', 'rules'=>'trim'),
			'password'		 => array('field'=>'password', 'label'=>'password', 'rules'=>'trim'),
			
		//        'contact_name' 	=> array('field'=>'contact_name', 'label'=>'contact_name', 'rules'=>'trim'),
		//		'zip' 			=> array('field'=>'zip','label'=>'Post Code','rules'=>'trim|required'),
		
		);

        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
        	$post_data = $this->comman_model->array_from_post(array(
								'smtp_host','smtp_user','smtp_port','email','password','is_used','type'
							));



			$post_data['user_id'] 	= $this->data['user_details']->id;
			if(!empty($post_data['website'])){
				if(strpos($post_data['website'], "http://") !== false||strpos($post_data['website'], "https://") !== false){					
					
				}else{
					$post_data['website'] = "http://".$post_data['website'];
				}
			}
/*			echo '<pre>';
			print_r($post_data);
			die;*/
			if($support){
				$reg = $this->comman_model->save($this->_table_names,$post_data,$support->id);
			}
			else{
				$reg = $this->comman_model->save($this->_table_names,$post_data);
			}

			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],2101).'Data has successfully updated.');
			redirect($this->data['_cancel']);			
		}

        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}
	
	function test_mail(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],1000)."Test E-Mail";
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$support = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$support){
			redirect($this->data['_cancel']);			
		}
		if($support->type=='system'){
			redirect($this->data['_cancel']);			
		}

		$this->data['support_data'] =$support;			

		$rules = array(
			'email' 		=> array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required'),
			'message' 	=> array('field'=>'message', 'label'=>'message', 'rules'=>'trim|required'),
		
		);

        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
        	$post_data = $this->comman_model->array_from_post(array('email','message'));
			$post_mail = array(
								'to_email'		=> $post_data['email'],
								'html'			=> $post_data['message'],
								'subject'		=> 'test mail',
								'from_email'	=> $support->email,
								'from_name'		=> 'Test User',
							);
			if($support->type=='smtp'){
				$smtp_data = array(
						'smtp_host' => $support->smtp_host,
						'smtp_user' => $support->smtp_user,
						'smtp_pass' => $support->password,
						'smtp_port' => $support->smtp_port,
				);
//				$result = $this->email_model->send_mail_in_usersmtp($smtp_data,$post_mail);
				$result = $this->email_model->send_smtp_lib($smtp_data,$post_mail);
				if($result['status']=='ok'){
					$this->session->set_flashdata('success','Test E-mail successfully sent.');
				}
				else{
					$this->session->set_flashdata('error','Error sending test E-Mail, Please click on Back button and check your settings');
				}
			}
			else{
				$result = $this->email_model->send_mail_in_ci($post_mail);
				if($result=='sent'){
					$this->session->set_flashdata('success','Test E-mail successfully sent.');
				}
				else{
					$this->session->set_flashdata('error','Error sending test E-Mail, Please click on Back button and check your settings');
				}
			}

			redirect($this->data['_cancel'].'/test_mail');			
			die;
		}

        $this->data['subview'] = $this->_subView.'test_form';			
		$this->load->view($this->_mainView,$this->data);
	}



	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='D'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
		if($this->data['user_details']->parent_id!=0){
				redirect($this->data['lang_code'].'/user');
		}

	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */