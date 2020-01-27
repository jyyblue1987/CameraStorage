<?php
class Problem extends Admin_Controller{
	public $_table_names = 'tickets';
	public $_subView = 'admin/tickets/';
	public $_redirect = '/problem';
	public $_msg_success = 'Problem has successfully created.';
	public $_msg_update = 'Problem has successfully updated.';
	public $_msg_delete = 'Problem has successfully deleted.';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Problem Management';
        $this->load->model('comman_model');
        $this->load->model('ticket_model');

		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_product==1){}
			else{
				$redirect = true;
			}
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect('admin/dashboard');
		}
        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] =$this->data['admin_link'].$this->_redirect.'/delete';
        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}


	
    public function index(){
	    // Fetch all pages
		$this->data['name'] = 'Ticket Types';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		$this->data['employee_data'] = $this->comman_model->get_by('admin',array('id !='=>$this->data['admin_details']->id,'is_ticket'=>1),false,false,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

        public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id)
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$this->data['products'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, TRUE);
			if(!$this->data['products']){
	            redirect($this->data['_cancel']);				
			}

        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['products'] = $this->ticket_model->get_new();
	
        }

		// Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));

        $rules = $this->ticket_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			$post1 =array('name','desc','desc2','solve_time',);

        	$data = $this->ticket_model->array_from_post($post1);


            if($id == NULL){
                $data['enabled'] = 1;
                $data['status'] = 1;
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
			//file1

			

            $id = $this->comman_model->save($this->_table_names,$data, $id);
			
			
			if(empty($this->data['products']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            
			$this->session->unset_userdata('image_session');
            redirect($this->data['_cancel'].'/edit/'.$id);
        }

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}

    public function update($id = NULL){
    // Fetch a page or set a new one
		$this->data['name'] = 'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    if($id){
			$this->data['view_data'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
           	if(!$this->data['view_data'])
	            redirect($this->_redirect);

			if(!empty($this->data['view_data']->status)){
				if($this->data['view_data']->admin_id==$this->data['admin_details']->id||$this->data['admin_details']->default==1){}
				else{
					redirect($this->data['_cancel']);				
				}
			}
			if(empty($this->data['view_data']->admin_id)){				
				$this->comman_model->save($this->_table_names,array('admin_id'=>$this->data['admin_details']->id,'status'=>'open'),$id);
			
			}		
        }
        else{
	            redirect($this->data['_cancel']);	   		
        }
  		
		if($this->input->post('operation')){
            $data =array();
            $data = $this->comman_model->array_from_post(array('description','status'));
            $data['user_id'] = 0;
            $data['problem_id'] = $id;
			//$data['date'] = date('Y-m-d H:i:s');
			$data['created_by'] = 'admin';
			$data['created'] = time();
			$data['modified'] = time();
            $this->comman_model->save($this->_table_names.'_status',$data);
            redirect($this->data['_cancel']);
        }

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view($this->_mainView.'_layout_main', $this->data); 
   	}
    
	public function view($id = NULL){
	    // Fetch a page or set a new one
		$this->data['name'] = 'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    if($id){
			$this->data['view_data'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
           	if(!$this->data['view_data'])
	            redirect($this->_redirect);

			if(!empty($this->data['view_data']->status)){
				if($this->data['view_data']->admin_id==$this->data['admin_details']->id||$this->data['admin_details']->default==1){}
				else{
					redirect($this->_redirect);				
				}
			}
			if(empty($this->data['view_data']->admin_id)){				
				$this->comman_model->save($this->_table_names,array('admin_id'=>$this->data['admin_details']->id,'status'=>'open'),$id);
			
			}		
        }
        else{
	            redirect($this->_redirect);	   		
        }
        
		$this->data['answer_data'] = $this->comman_model->get_by($this->_table_names.'_answer',array('ticket_id'=>$id),false,false,false);
       
        // Set up the form
        if($this->input->post('operation')){
            $data =array();
            $data = $this->comman_model->array_from_post(array('desc'));
            $data['user_id'] = 0;
            $data['ticket_id'] = $id;
            $data['created_by'] = 'admin';
			$data['date'] = date('Y-m-d H:i:s');
			$data['created'] = time();
			$data['modified'] = time();
            $this->comman_model->save($this->_table_names.'_answer',$data);
            redirect($this->_redirect.'/view/'.$id);
        }
        
		$this->data['employee_data'] = $this->comman_model->get_by('admin',array('id !='=>$this->data['admin_details']->id,'is_ticket'=>1),false,false,false);
		
		$this->data['subview'] = $this->_subView.'view';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
    
    public function delete($id){
		$this->ticket_model->delete($id);
        redirect($this->_redirect);
	}        
}