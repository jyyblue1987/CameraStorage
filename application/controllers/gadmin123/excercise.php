<?php
class excercise extends Admin_Controller{
	public $_table_names = 'excercises';
	public $_subView = 'admin/excercise/';
	public $_redirect = '/excercise';
	public function __construct(){
		parent::__construct();

		$this->data['active'] = 'Workout';
        $this->load->model('excercise_model');

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';


        // Get language for content id to show in administration
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();

		$this->checkPermissions('excercise');
        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}
    
    public function index()
	{
	    // Fetch all pages
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1205).'GYM Excercises';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'index_order';	
		$this->load->view('admin/_layout_main',$this->data);
	}

    public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id)
        {
            $this->data['tags'] = $this->excercise_model->get_lang($id, FALSE, $this->data['content_language_id']);
            count($this->data['tags']) || $this->data['errors'][] = 'User could not be found';

			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['tags'] = $this->excercise_model->get_new();
        }
        

		$this->data['workout_data'] = $this->comman_model->get_by('workouts',array('user_id'=>0,'type'=>'bench mark'),false,false,false);

		$this->data['machine_data'] = $this->comman_model->get_lang('tags',$this->data['adminLangSession']['lang_id'],NULL,array('parent_id'=>0),'tag_id',false);
		$this->data['part_data'] = $this->comman_model->get_lang('parts',$this->data['adminLangSession']['lang_id'],NULL,array('parent_id'=>0),'part_id',false);
       
		// Pages for dropdown
        $this->data['pages_no_parents'] = $this->excercise_model->get_no_parents($this->data['content_language_id']);
        $this->data['page_languages'] = $this->language_model->get_form_dropdown('language');
        $this->data['templates_page'] = $this->excercise_model->get_templates('page_');
        $this->data['type_data'] = array(
										'Power Lifts'	=> 'Power Lifts',
										'Olympic Lifts'	=> 'Olympic Lifts',
										'Speed'			=> 'Speed',
										'Endurance'		=> 'Endurance',
										'Bodyweight'	=> 'Bodyweight',
										'Heavy'			=> 'Heavy',
										'Light'			=> 'Light',
										'Long'			=> 'Long',
										);
		

        $this->data['type_data2'] = array(
										'Repeats'	=> 'Repeats',
										'Weight'	=> 'Weight',
										'Distance'	=> 'Distance',
										'Height'	=> 'Height',
										'Time'		=> 'Time',
										'Cal'		=> 'Cal'
										);
		
        // Fetch all files by repository_id
        
        // Set up the form
        $rules = $this->excercise_model->rules;
        $this->form_validation->set_rules($this->excercise_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
        	$data = $this->excercise_model->array_from_post(array('type','d_score','link'));

			$postProgram = $this->input->post('type2');
			if($postProgram){
				$data['type2'] = implode(',' ,$postProgram);
			}

			$postSkill = $this->input->post('skill');
			if($postSkill){
				$data['skill'] = implode(',' ,$postSkill);
			}
			
			$postPart = $this->input->post('part_id');
			if($postPart){
				$data['part_id'] = implode(',' ,$postPart);
			}
			$postMachine = $this->input->post('machine_id');
			if($postMachine){
				$data['machine_id'] = implode(',' ,$postMachine);
			}

			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/excercises');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
			}	
			else{
				if($id != NULL)
					$data['image'] = $this->data['tags']->image;
			}
			
            if($id == NULL)$data['order'] = $this->excercise_model->max_order()+1;
            $data_lang = $this->excercise_model->array_from_post($this->excercise_model->get_lang_post_fields());
            if($id == NULL){
                $data['on_date'] = date('Y-m-d');
                $data['date_time'] = date('Y-m-d H:i:s');
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}

            
            $id = $this->excercise_model->save_with_lang($data, $data_lang, $id);
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
		$this->data['all_data'] = $this->excercise_model->get_lang();
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->excercise_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->excercise_model->get_nested1($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    public function search_ajax(){
        // Save order from ajax call
		$title = $this->input->post('title');
        if (isset($_POST['sortable'])) {
            $this->excercise_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
		$this->db->like('title',$title);
        $this->data['pages'] = $this->excercise_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }
	

/*    public function order()
    {
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
    }*/
    
    public function update_ajax($filename = NULL)
    {
        // Save order from ajax call
        if(isset($_POST['sortable']) && $this->config->item('app_type') != 'demo')
        {
            $this->excercise_model->save_order($_POST['sortable']);
        }
        
        $data = array();
        $length = strlen(json_encode($data));
        header('Content-Type: application/json; charset=utf8');
        header('Content-Length: '.$length);
        echo json_encode($data);
        
        exit();
    }
    
    
    
    public function delete($id){       
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		$this->excercise_model->delete($id);
        redirect($this->data['_cancel']);
	}
    
    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current categories
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        
        $categories = $this->excercise_model->get();
        
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