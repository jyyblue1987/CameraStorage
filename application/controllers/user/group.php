<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends Frontend_Controller{	
	public $_redirect = '/user/group';

	public $_subView = 'employee/groups/';
	public $_table_names = 'groups';
	public $_mainView = 'employee/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Group';		
        $this->load->model(array('camera_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/user';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Group';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->parent_id),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	
	public function v($id = NULL){
		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->parent_id),false,false,false);

		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

        $this->data['subview'] = $this->_subView.'view';
		$this->load->view($this->_mainView,$this->data);
	}


	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
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
	}


}

/* End of file user.php */
/* Location: ./application/controllers/user.php */