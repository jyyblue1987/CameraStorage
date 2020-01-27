<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends Frontend_Controller{	
	public $_redirect = '/member/Support';

	public $_subView = 'user/support/';
	public $_table_names = 'users_support';
	public $_mainView = 'user/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Support';
        $this->load->model(array('camera_model','membership_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/member';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
		$this->_checkPaidUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Support Information';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$check = $this->data['view_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->parent_id),false,false,true);
		if($check){
		}
		else{
			$users = new stdClass();
			//$tags->parent_id = 0;
			$users->contact_name 	= '';
			$users->company_name 	= '';
			$users->website			= '';
			$users->support_num		= '';
			$users->sales_num		= '';
			$users->support_hour	= '';
			$users->business_hour	= '';
			$users->business_hour	= '';
			$users->business_hour	= '';
			$users->business_hour	= '';
			$users->email 			= '';

			$this->data['view_data'] =$users;
		}
		
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
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

	function _checkPaidUser(){/*
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link']);
		}
		if($this->data['user_details']->total_point>0){
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	*/}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */