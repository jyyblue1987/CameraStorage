<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inactive extends Frontend_Controller{	
	public $_redirect = '/member/account';

	public $_subView = 'user/';
	public $_mainView = 'user/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->_checkUser();
		$this->data['name'] = 'Dashboard';	
		
		$this->data['_user_link'] = $this->data['lang_code'].'/member';
	}

	function index(){
		$checkDealerStatus = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$checkDealerStatus){
			redirct($this->data['lang_code'].'/user/account/logout');
		}

		$this->data['user_dealer_data'] = $checkDealerStatus;
		//var_dump($this->session->all_userdata());
		$this->data['active'] = 'home';	
        $this->data['name'] = show_static_text($this->data['lang_id'],8000).'Error';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['login'] = $this->session->all_userdata();
		
		$this->data['subview'] = $this->_subView.'dashboard/inactive';	
		$this->load->view($this->_mainView,$this->data);
	}

	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='A'){
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

}
