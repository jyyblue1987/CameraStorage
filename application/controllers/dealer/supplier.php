<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Supplier extends Frontend_Controller{	
	public $_redirect = '/gym/supplier';

	public $_subView = 'ownner/suppliers/';
	public $_table_names = 'suppliers';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Inventory Management';		
        $this->load->model(array('user_staff_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/gym';
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
        $this->data['name'] = show_static_text($this->data['lang_id'],196).'';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}


    public function edit($id = NULL){

	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
			$checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
			if(!$checkProduct){
				redirect($this->data['_cancel']);				
			}
			$this->data['users'] = $checkProduct;
        }
        else{
			$this->data['name'] = show_static_text($this->data['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['users'] = $this->user_staff_model->get_supplier_new();	
        }

        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['lang_id'],219));

        $rules = $this->user_staff_model->supplier_rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data 	= array();
			$post1 =array('name','email','company_name','phone');
        	$data = $this->comman_model->array_from_post($post1);
            if($id == NULL){
				$data['user_id'] 	= $this->data['user_details']->id;
                $data['on_date'] 		= date('Y-m-d');
                $data['on_datetime'] 	= date('Y-m-d H:i:s');
                $data['created'] 		= time();
                $data['modified'] 		= time();
			}
			else{
                $data['modified'] 	= time();
			}
			//file1



/*			echo '<pre>';
			print_r($data);
			die;*/
			$id = $this->comman_model->save($this->_table_names,$data,$id);
			if(empty($this->data['product']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['lang_id'],296));
            
			redirect($this->data['_cancel']);
			//redirect($this->data['_cancel'].'/edit/'.$id);
        }

        $this->data['subview'] = $this->_subView.'edit';			
		$this->load->view($this->_mainView,$this->data);
	}
		
	function delete($id=false){
		if(!$id){
			redirect($this->data['_cancel']);			
		}
		$check_product = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);
		if(!$check_product){
			redirect($this->data['_cancel']);			
		}
		$this->db->delete($this->_table_names, array('id'=>$id,'user_id'=>$this->data['user_details']->id)); 
		redirect($this->data['_cancel']);			
	}


	function _checkPaidUser(){
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link']);
		}
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
		if($this->data['user_details']->parent_id!=0){
				redirect($this->data['lang_code'].'/user');
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */