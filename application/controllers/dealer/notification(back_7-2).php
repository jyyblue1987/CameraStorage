<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends Frontend_Controller{	
	public $_redirect = '/dealer/notification';
	public $_subView = 'ownner/notifications/';
	public $_d_table_names = 'd_email';
	public $_table_names = 'users_email';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Content Management';
//        $this->load->model(array('user_staff_model'));
		
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
        $this->data['name'] = show_static_text($this->data['lang_id'],1000).'Notifications';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$all_data = $this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id),false,false,false);
		if(empty($all_data)){
			$d_data = $this->comman_model->get($this->_d_table_names,false);
			if($d_data){
				foreach($d_data as $set_d){
					$post =array(
								'name'=>$set_d->name,
								'subject'=>$set_d->subject,
								'message'=>$set_d->message,
								'user_id'=>$this->data['user_details']->id,
							);
					$this->comman_model->save($this->_table_names,$post);
				}
			}
		}

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}


    public function edit($id = NULL){
		if(!$id)
			redirect($this->data['_cancel']);
	
		$this->data['name'] = show_static_text($this->data['lang_id'],2570).'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['edit_data'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$this->data['edit_data']){
			redirect($this->data['_cancel']);
		}

		$rules = array(
			'subject' 	=> array('field'=>'subject', 'label'=>'Subject', 'rules'=>'trim|required'),
	        'message'	=> array('field'=>'message', 'label'=>'Message', 'rules'=>'trim|required'),
		);

        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){			
        	$post_data = $this->comman_model->array_from_post(array('subject','message'));

			$this->comman_model->save($this->_table_names,$post_data,$id);
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],2101).'Data has successfully updated.');
			redirect($this->data['_cancel'].'/edit/'.$id);
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'edit';
		$this->load->view($this->_mainView,$this->data);
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