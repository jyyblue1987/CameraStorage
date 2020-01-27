<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Flash_note extends Admin_Controller{
	public $_table_names = 'admin_flash';
	public $_subView = 'admin/flash/';
	public $_redirect = '/flash_note';
    public $_current_revision_id;
	
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Content Management';
        $this->load->model(array('content_model'));

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

		$this->checkPermissions('flash_note');
        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}
    
    public function index()
	{
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1810).'Flash Notice';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;
		$this->db->order_by('id','asc');
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}
	
    public function edit($id = NULL){

		$data = array();
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$this->data['page'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
            count($this->data['page']) || $this->data['errors'][] = 'User could not be found';
            
        }
        else{
			redirect($this->data['_cancel']);
        }
        

        
        // Fetch all files by repository_id

        // Set up the form
		$rules = array(
			'desc' 	=> array('field'=>'desc', 'label'=>'desc', 'rules'=>'trim'),
		
		);

        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
            $data = $this->content_model->array_from_post(array('desc'));
            $id = $this->comman_model->save($this->_table_names,$data,$id);
			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel']);
        }
        
/*            echo '<pre>';
			print_r($this->data);die;*/
        // Load the view
		$this->data['subview'] = $this->_subView.'/edit';
        $this->load->view('admin/_layout_main', $this->data);
	}

    
	function get_active(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		$check_data = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if($check_data){
			if($type=='enabled'){
				if($check_data->enabled==1){
					$post_data = array('enabled'=>0);
				}
				elseif($check_data->enabled==0){
					$post_data = array('enabled'=>1);
				}
				else{
					$post_data = array('enabled'=>1);
				}
				$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
			}
			if($type=='feature'){
				if($check_data->is_feature==1){
					$post_data = array('is_feature'=>0);
				}
				elseif($check_data->is_feature==0){
					$post_data = array('is_feature'=>1);
				}
				else{
					$post_data = array('is_feature'=>1);
				}
				$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
			}
		}
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