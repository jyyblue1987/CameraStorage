<?php
class Ticket_category extends Admin_Controller{
	public $_table_names = 'tickets_category';
	public $_subView = 'admin/ticket_category/';
	public $_redirect = 'admin/ticket_category';
	public $_msg_success = 'Category has successfully created.';
	public $_msg_update = 'Category has successfully updated.';
	public $_msg_delete = 'Category has successfully deleted.';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Ticket Management';
        $this->load->model('comman_model');
        $this->load->model('ticket_model');

		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_ticket==1){}
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
        $this->data['_add'] = $this->_redirect.'/edit';
        $this->data['_edit'] = $this->_redirect.'/edit';
        $this->data['_view'] = $this->_redirect.'/view';
        $this->data['_cancel'] = $this->_redirect;
        $this->data['_delete'] = $this->_redirect.'/delete';
        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}

    
    public function index(){
	    // Fetch all pages
		$this->data['name'] = 'Category';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

    public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id)
        {
			$this->data['categories'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Edit';
           	if(!$this->data['categories'])
	            redirect($this->_redirect);	   		
        }
        else
        {
			$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];
			$this->data['name'] = ' Create';
            $this->data['categories'] = $this->ticket_model->get_new_category();
        }
        

       
        // Set up the form
        $rules = $this->ticket_model->category_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
            $data = $this->comman_model->array_from_post(array('name','desc'));
            if($id == NULL){
                $data['date'] = date('Y-m-d H:i:s');
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
            
/*			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/categories');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
			}	
			else{
				if($id != NULL)
					$data['image'] = $this->data['categories']->image;
			}*/
			
            $id = $this->comman_model->save($this->_table_names,$data,$id);
			if(empty($this->data['categories']->id))
	            $this->session->set_flashdata('success',$this->_msg_success);
			else
	            $this->session->set_flashdata('success',$this->_msg_update);			
            redirect($this->_redirect.'/edit/'.$id);
        }
        
        // Load the view
/*		echo '<pre>';
		print_r($this->data);
		die;
*/
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
    
    public function delete($id){
		$this->ticket_model->delete($id);
        redirect($this->_redirect);
	}        
}