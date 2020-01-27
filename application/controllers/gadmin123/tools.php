<?php
class Tools extends Admin_Controller{
	public $_table_names = 'tools';
	public $_subView = 'admin/tools/';
	public $_redirect = '/tools';
	public function __construct(){
		parent::__construct();

		$this->data['active'] = 'Workout';
        $this->load->model('tool_model');

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';


        // Get language for content id to show in administration
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();

		$this->checkPermissions('workout_tool');
        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}
    
    public function index()
	{
	    // Fetch all pages
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1205).'Tools';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'index_order';	
		$this->load->view('admin/_layout_main',$this->data);
	}

    public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id)
        {
            $this->data['tags'] = $this->tool_model->get_lang($id, FALSE, $this->data['content_language_id']);
            count($this->data['tags']) || $this->data['errors'][] = 'User could not be found';

			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['tags'] = $this->tool_model->get_new();
        }
        
        $this->data['type_data'] = array(
									'timer'				=> 'Timer',
									'count down timer'	=> 'Count Down Timer',
									'take time'	 		=> 'Take Time',
									'break'				=> 'Break',
									'related break'		=> 'Related Break',
									'remaining break'	=> 'Remaining Break ',
									'round counter'		=> 'Round Counter',
									'rep counter'		=> 'Rep Counter',
									'take count'		=> 'Take Count',
									'rounds'			=> 'Rounds',
/*									'conditions'		=> 'Conditions',*/
									'time extend'		=> 'Time Extend',
									'rep extend'		=> 'Rep Extend',
									'weight extend' 	=> 'Weight Extend',
									'height extend' 	=> 'Height Extend',
									'distance extend' 	=> 'Distance Extend',
									);
	   	$this->db->order_by('title','asc');
        $this->data['styles_data'] = $this->comman_model->get_lang('styles',$this->data['content_language_id'],NULL,array('parent_id'=>0),'style_id',false);
        // Set up the form
        $rules = $this->tool_model->rules;
        $this->form_validation->set_rules($this->tool_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
        	$data = $this->tool_model->array_from_post(array('style_id','type'));
            if($id == NULL)$data['order'] = $this->tool_model->max_order()+1;
            $data_lang = $this->tool_model->array_from_post($this->tool_model->get_lang_post_fields());
            if($id == NULL){
                $data['on_date'] = date('Y-m-d');
                $data['date_time'] = date('Y-m-d H:i:s');
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}

            
            $id = $this->tool_model->save_with_lang($data, $data_lang, $id);
			if(empty($this->data['tags']->id))
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));            
            redirect($this->data['_cancel'].'/edit/'.$id);
        }
        
        // Load the view
/*		echo '<pre>';
		print_r($this->data);
		die;
*/
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}

    public function order(){
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['all_data'] = $this->tool_model->get_lang();
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->tool_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->tool_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    
    public function delete($id){       
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		$this->tool_model->delete($id);
        redirect($this->data['_cancel']);
	}
    
    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current categories
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        
        $categories = $this->tool_model->get();
        
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
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