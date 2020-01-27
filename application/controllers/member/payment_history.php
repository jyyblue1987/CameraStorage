<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_history extends Frontend_Controller{	
	public $_redirect = '/member/payment_history';

	public $_table_names = 'camera_payment';

	public $_subView = 'user/payment_history/';
	public $_mainView = 'user/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Payment History';
        $this->load->model(array('membership_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');

		$this->data['_user_link'] = $this->data['lang_code'].'/member';

        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_payment_form'] = $this->data['lang_code'].$this->_redirect.'/payment';
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';
		$this->_checkUser();
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

		$this->db->order_by('id','desc');
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('payment'=>1,'user_id'=>$this->data['user_details']->id),false,false,false);
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
		if(isset($this->data['user_details'])){	
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

	function _checkPaidUser(){
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
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */