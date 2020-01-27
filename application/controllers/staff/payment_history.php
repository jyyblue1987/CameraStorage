<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_history extends Frontend_Controller{	
	public $_redirect = '/staff/payment_history';

	public $_table_names = 'camera_payment';

	public $_subView = 'staff/payment_history/';
	public $_mainView = 'staff/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Payment History';
        $this->load->model(array('membership_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');

		$this->data['_user_link'] = $this->data['lang_code'].'/staff';

        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_payment_form'] = $this->data['lang_code'].$this->_redirect.'/payment';
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
		$this->checkPermissions('payment_history');
		//$this->_checkPaidUser();
	}



	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],2801).'Payment History';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['month_data'] = $this->membership_model->get_day_month();


/*		$this->db->where('ownner_id',$this->data['user_details']->id);
		$this->db->set('is_read', 1, true);
		$this->db->update('user_membership_history');*/

		$this->data['all_data'] = '';	
		$clientArr = array();
		$getClient = $this->comman_model->get_by('users',array('parent_id'=>$this->data['user_details']->parent_id),false,false,false);
		if($getClient){
			foreach($getClient as $g_c){
				$clientArr[] = $g_c->id;
			}
		}
		

		$this->db->order_by('id','desc');
		if($clientArr){
			$this->db->where_in('user_id',$clientArr);
			$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('payment'=>1),false,false,false);	
			
		}
/*		echo $this->db->last_query();
		echo '<pre>';
		print_r($this->data['all_data']);
		die;*/
		//$this->load->view('user/orders',$this->data);
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

/* End of file user.php */
/* Location: ./application/controllers/user.php */