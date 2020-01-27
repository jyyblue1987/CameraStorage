<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends Admin_Controller {
	public $_table_names = 'email';
	public $_mainView = 'admin/';
	public $_subView = 'admin/email/';
	public $_redirect = '/email';
	public $_msg_success = 'Data has successfully created.';
	public $_msg_update = 'Data has successfully updated.';
	public $_msg_delete = 'Data has successfully deleted.';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'General Settings';
        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
        

		
		$this->checkPermissions('general_setting');
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}

	function index(){
        $this->data['name']		= 'Email Settings';
        $this->data['title'] 	= $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('deleted'=>0),FALSE,FALSE,FALSE);
        $this->data['subview']	= $this->_subView.'index';	
		
        $this->load->view($this->_mainView.'_layout_main',$this->data);               
    }
	
	function edit($id= false){
		$this->load->model('email_model');
        $this->data['name']= 'Email Settings';
        $this->data['active']= 'General Settings';
        $this->data['active_sub']= 'email';
        if(!$id){
            redirect($this->data['_cancel']);
           
        }
        $this->data['title'] ='Edit Setting | '.$this->data['settings']['site_name'];
        
        $edit_data = $this->comman_model->get_by('email',array('id'=>$id),FALSE,FALSE,TRUE);
        if(count($edit_data)==0){
            redirect($this->data['_cancel']);
        }
        $this->data['edit_data'] =$edit_data;
        $setting_rules = $this->email_model->email_rules;
        $this->form_validation->set_rules($setting_rules);
        if($this->form_validation->run()==TRUE){
            $post_data = array('value'=>$this->input->post(''));
            $post_data =$this->comman_model->array_from_post(array('subject','message')); 
            $this->comman_model->save('email',$post_data,$id);
            $this->session->set_flashdata('success','Email has successfully updated.');
            redirect($this->data['_cancel']);
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = $this->_subView.'edit';	
        $this->load->view($this->_mainView.'_layout_main',$this->data);       
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

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */