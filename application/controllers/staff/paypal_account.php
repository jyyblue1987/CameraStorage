<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal_account extends Frontend_Controller{	
	public $_redirect = '/staff/paypal_account';

	public $_subView = 'staff/paypals/';
	public $_table_names = 'users_paypal';
	public $_mainView = 'staff/_layout_main';

	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Payment Account';		
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/staff';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
//		$this->_checkPaidUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Paypal API';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->parent_id,'type'=>'paypal'),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

    public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->parent_id,'type'=>'paypal'),false,false,true);
			if(!$checkProduct){
				redirect($this->data['_cancel']);				
			}
			$this->data['products'] = $checkProduct;
        }
        else{
			$this->data['name'] = show_static_text($this->data['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

				$page 				= new stdClass();
				$page->username 	= '';
				$page->signature	= '';
				$page->password		= '';
				$page->comission	= 0;
				$page->account		= '';
				$page->is_default	= 1;

            $this->data['products'] = $page;	
        }


		$rules = array(
				'username' =>array('field'=>'username','label'=>'Api username','rules'=>'trim|required'),
				'signature' =>array('field'=>'signature','label'=>'Api signature','rules'=>'trim|required'),
				'password' =>array('field'=>'password','label'=>'Api Password','rules'=>'trim|required'),
				'account' =>array('field'=>'account','label'=>'Account','rules'=>'trim|required'),
//		        'comission' => array('field'=>'comission', 'label'=>'Comission', 'rules'=>'trim|required|integer'),
	//	        'gym_id' => array('field'=>'gym_id', 'label'=>'Comission', 'rules'=>'trim|required'),
//		        'comission' => array('field'=>'comission', 'label'=>'Comission', 'rules'=>'trim|required|integer'),
		);
		
        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['lang_id'],219));

        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data 	= array();
			$post1 =array('username','signature','password','is_default','comission','account','gym_id');
        	$data = $this->comman_model->array_from_post($post1);

			if($data['is_default'] == 1){
				$this->db->where('user_id',$this->data['user_details']->parent_id);
				$this->db->where('type','paypal');
				$this->db->set(array('is_default'=>'0'));
				$this->db->update($this->_table_names);
			}

			$data['type']		 = 'paypal';
			$data['payment']	 = 'Paypal';
            if($id == NULL){
				$data['user_id']		 = $this->data['user_details']->parent_id;
                $data['on_date'] 		= date('Y-m-d');
                $data['on_datetime'] 	= date('Y-m-d H:i:s');
                $data['enabled'] 		= 1;
                $data['created'] 		= time();
                $data['modified'] 		= time();
			}
			else{
                $data['modified'] 	= time();
			}
			//file1



			$id = $this->comman_model->save($this->_table_names,$data, $id);
			if(empty($this->data['product']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['lang_id'],296));
            
			//redirect($this->data['_cancel']);
			redirect($this->data['_cancel'].'/edit/'.$id);
        }

        $this->data['subview'] = $this->_subView.'edit';			
		$this->load->view($this->_mainView,$this->data);
	}

	public function settings(){
	    // Fetch a page or set a new one
		$this->data['dealer_data'] = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$this->data['dealer_data']){
			$this->session->set_flashdata('error','Sorry!! There is some problem!!'); 
			redirect($this->data['_user_link'].'/account');
		}
		$rules = array(
				'use_paypal' =>array('field'=>'use_paypal','label'=>'use_paypal','rules'=>'trim|required'),
		);
		
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$post1 =array('use_paypal');
			$data = $this->comman_model->array_from_post($post1);
			$this->db->where('id',$this->data['dealer_data']->id);
			if($data['use_paypal']==1){
				$this->db->set(array('use_paypal'=>1));
			}
			else{
				$this->db->set(array('use_paypal'=>0));
			}
			$this->db->update('users');
			redirect($this->data['_cancel'].'/settings');
        }

		$this->data['name'] = 'Paypal API Setting';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'setting_form';			
		$this->load->view($this->_mainView,$this->data);
	}

	function delete($id=false){
		die;
		if(!$id){
			redirect($this->data['_cancel']);			
		}
		$check_product = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);
		if(!$check_product){
			$this->session->set_flashdata('error','Sorry!! You can not delete.');
			redirect($this->data['_cancel']);			
		}
		$this->db->delete($this->_table_names, array('id'=>$id,'user_id'=>$this->data['user_details']->id)); 
		redirect($this->data['_cancel']);			
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

	function _checkPaidUser(){
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */