<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class support extends Frontend_Controller{	
	public $_redirect = '/dealer/support';
	public $_subView = 'ownner/support/';
	public $_table_names = 'users_support';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
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

		$this->_checkUser();
	//	$this->_checkPaidUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],1000)."Client's Support Information";
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$support = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id),false,false,true);
		if($support){
			$this->data['support_data'] =$support;			
		}
		else{
			$users = new stdClass();
			//$tags->parent_id = 0;
			$users->contact_name 	= '';
			$users->company_name 	= '';
			$users->email 			= '';
			$users->website			= '';
			$users->support_num		= '';
			$users->sales_num		= '';
			$users->support_hour	= '';
			$users->business_hour	= '';			
			$users->term_desc		= '';
			
			$users->notes			= '';
			$users->business_hour	= '';
			$users->business_hour	= '';
			

			$this->data['support_data'] =$users;
		}
		$rules = array(
			'support_hour' 	=> array('field'=>'support_hour', 'label'=>'support hour', 'rules'=>'trim'),
			'company_name' 	=> array('field'=>'company_name', 'label'=>'company name', 'rules'=>'trim'),
			'support_num' 	=> array('field'=>'support_num', 'label'=>'support number', 'rules'=>'trim'),
			'sales_num' 	=> array('field'=>'sales_num', 'label'=>'sales number', 'rules'=>'trim'),
			'business_hour' => array('field'=>'business_hour', 'label'=>'business hour', 'rules'=>'trim'),
			'website' 		=> array('field'=>'website', 'label'=>'website', 'rules'=>'trim'),
			'term_desc'		=> array('field'=>'term_desc', 'label'=>'term_desc', 'rules'=>'trim'),
			'notes'			=> array('field'=>'notes', 'label'=>'notes', 'rules'=>'trim'),

			'email' 		=> array('field'=>'email', 'label'=>'email', 'rules'=>'trim'),		
			'contact_name' 	=> array('field'=>'contact_name', 'label'=>'contact_name', 'rules'=>'trim'),
			
		//        'contact_name' 	=> array('field'=>'contact_name', 'label'=>'contact_name', 'rules'=>'trim'),
		//		'zip' 			=> array('field'=>'zip','label'=>'Post Code','rules'=>'trim|required'),
		
		);

        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
        	$post_data = $this->comman_model->array_from_post(array(
								'contact_name','company_name','website','term_desc','support_num','sales_num','support_hour','business_hour','email','notes',
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



	function _checkPaidUser(){
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	}


	function _checkPlan(){
		if($this->data['user_details']->plan_id!=0){
/*			echo 'Total: '.$this->data['user_details']->total_point;
			echo '<br>';
			echo 'use IN : '.$this->data['user_details']->credits_point+$this->data['user_details']->plan_coach;*/
			if($this->data['user_details']->total_point<($this->data['user_details']->credits_point+$this->data['user_details']->plan_member)){
				$this->session->set_flashdata('error','Enough Balance!!'); 
				redirect($this->data['_cancel']);
			}
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_cancel']);
		}

		if($this->data['user_details']->total_point>0){
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
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