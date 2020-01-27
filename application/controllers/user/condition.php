<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Condition extends Frontend_Controller{	
	public $_redirect = '/user/account';

	public $_subView = 'employee/';
	public $_mainView = 'employee/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['name'] = 'sada';	
        $this->load->model(array('users_model','chat_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
        $detail = $this->session->all_userdata();
		$redirect = false;
		if(isset($this->data['user_details'])){	
			if($this->data['user_details']->account_type!='E'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
		

		$this->data['userClient'] = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$this->data['userClient']){
	        $this->data['_cancel'];
		}
		
		$this->data['_user_link'] = $this->data['lang_code'].'/user';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
	}

	function index(){
		//var_dump($this->session->all_userdata());
		$this->data['active'] = 'home';	
        $this->data['name'] = show_static_text($this->data['lang_id'],8000).'Terms and Conditions';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'dashboard/condition';	
		$this->load->view($this->_mainView,$this->data);
	}

	
}


/* End of file user.php */
/* Location: ./application/controllers/user.php */