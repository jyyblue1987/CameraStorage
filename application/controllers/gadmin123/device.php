<?php
class Device extends Admin_Controller{
	public $_table_names = 'devices';
	public $_subView = 'admin/devices/';

	public $_mainView = 'admin/_layout_main';
	public $_redirect = '/device';
    public $_current_revision_id;
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Devices';
        $this->load->model(array('device_model'));
        // Get language for content id to show in administration

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
		$this->checkPermissions('workout');

	}
    	
	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1000).'Devices';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

    public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			if(!$checkProduct){
				redirect($this->data['_cancel']);				
			}
			$this->data['products'] = $checkProduct;
        }
        else{
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['products'] = $this->device_model->get_new();	
        }


/*	   	$this->db->order_by('name','asc');
		$this->data['program_data'] = $this->comman_model->get_by('programs',array('enabled'=>1),false,false,false);
*/
        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));

        $rules = $this->device_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data 	= array();
			$post1 =array('name');

        	$data = $this->device_model->array_from_post($post1);

            if($id == NULL){
                $data['on_date'] 		= date('Y-m-d');
                $data['on_datetime'] 	= date('Y-m-d H:i:s');
                $data['created'] 		= time();
                $data['modified'] 		= time();
			}
			else{
                $data['modified'] 	= time();
			}

			$id = $this->comman_model->save($this->_table_names,$data, $id);
/*			$postAttribute  = $this->device_model->array_from_post(array('options'));
			$this->device_model->save_options_product($postAttribute['options'],$id);*/
			if(empty($this->data['product']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            
			//redirect($this->data['_cancel']);
			redirect($this->data['_cancel'].'/edit/'.$id);
        }

        $this->data['subview'] = $this->_subView.'edit';			
		$this->load->view($this->_mainView,$this->data);
	}


    public function delete($id=false){
		if(!$id){
	        redirect($this->data['_cancel']);
		}
		$checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if($checkProduct){
			$this->db->delete($this->_table_names, array('id'=>$id,)); 
		}
		else{
			$this->session->set_flashdata('error','Sorry ! You can not delete.');
		}
        redirect($this->data['_cancel']);
	}

  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			$redirect = checkPermission('admin_permission',array('user_id'=>$this->data['admin_details']->id,'type'=>$type,'value'=>1));	
		}
		else{
			$redirect = 1;
		}
		
		if($redirect==0){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			if($redirect){
				redirect($redirect);
			}
			redirect($this->data['admin_link'].'');
		}		
	}


   
}