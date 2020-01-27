<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends Frontend_Controller{	
	public $_redirect = '/member/group';

	public $_subView = 'user/groups/';
	public $_table_names = 'groups';
	public $_mainView = 'user/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Group';		
        $this->load->model(array('camera_model'));
		
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
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Group';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;

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

			$this->data['products'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
			if(!$checkProduct){
				redirect($this->data['_cancel']);				
			}
        }
        else{
			$this->data['name'] = show_static_text($this->data['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['products'] = $this->camera_model->get_new_group();	
        }

	   	$this->db->order_by('name','asc');
        $this->data['camera_data'] = $this->comman_model->get_by('camera',array('user_id'=>$this->data['user_details']->id),false,false,false);
        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['lang_id'],219));

        $rules = $this->camera_model->group_rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data 	= array();
			$post1 =array('name');
        	$data = $this->comman_model->array_from_post($post1);
            if($id == NULL){
				$data['user_id'] = $this->data['user_details']->id;
                $data['on_date'] 	= date('Y-m-d');
                $data['date_time'] 	= date('Y-m-d H:i:s');
			}
			else{
                $data['modified'] 	= time();
			}

			$get_camera = $this->input->post('camera');
			if($get_camera){
				$data['camera_id'] = implode(',',$get_camera);
			}



			$id = $this->comman_model->save($this->_table_names,$data,$id);

			$this->db->delete('groups_c',array('group_id'=>$id));
			if($get_camera){
				foreach($get_camera as $key=>$value){
					$this->db->insert('groups_c',array('group_id'=>$id,'camera_id'=>$value,'user_id'=>$this->data['user_details']->id));
				}
			}

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
	
	public function v($id = NULL){
		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id),false,false,false);

		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

        $this->data['subview'] = $this->_subView.'view';
		$this->load->view($this->_mainView,$this->data);
	}

	function delete($id=false){
		if(!$id){
			redirect($this->data['_cancel']);			
		}
		$check_product = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);
		if(!$check_product){
			$this->session->set_flashdata('error','Sorry!! You can not delete.');
			redirect($this->data['_cancel']);			
		}
		$this->db->delete($this->_table_names, array('id'=>$id,'user_id'=>$this->data['user_details']->id)); 
		$this->db->delete($this->_table_names.'_c',array('group_id'=>$id)); 
		redirect($this->data['_cancel']);			
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