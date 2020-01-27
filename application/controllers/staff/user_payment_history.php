<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_payment_history extends Frontend_Controller{	
	public $_redirect = '/staff/user_payment_history';

	public $_table_names = 'user_history';

	public $_subView = 'staff/user_payment_history/';
	public $_mainView = 'staff/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
		$this->checkPermissions('monthly_payment_history');
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Update Balance';
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		$this->data['_user_link'] = $this->data['lang_code'].'/staff';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
	}



	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],2801).'Payment History';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('subscribe_status'=>'confirm','user_id'=>$this->data['user_details']->parent_id),false,false,false);	
        $this->data['subview'] = $this->_subView.'index';
		$this->load->view($this->_mainView,$this->data);
	}



	function _checkUser(){
		$redirect = false;
	
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='S'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
	}

	function checkPermissions($type= false){
		$redirect2 = 0;
		if($this->data['user_details']->account_type=='S'){
			$redirect2 = checkPermission('users_permission',array('user_id'=>$this->data['user_details']->id,'type'=>$type,'value'=>1));	
			if($redirect2==0){
				redirect($this->data['_user_link'].'/account');
			}		
		}
		else{
			redirect($this->data['_user_link'].'');
		}
	}

}
