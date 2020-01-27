<?php
class State extends Admin_Controller{
	public $_table_names = 'regions';
	public $_subView = 'admin/regions/';
	public $_redirect = '/state';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'State & city';
        $this->load->model('region_model');
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();

		$this->checkPermissions('state');        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}
    
    public function index()
	{
	    // Fetch all pages
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1670).'State';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['all_data'] = $this->region_model->get_lang();
/*		$count = count($this->data['all_data']);
		$r_from = $page <= 1 ? 1 : ($page -1) * $config["per_page"]+1; //RANGE STARTS FROM 
		$r_to   = $r_from + $count - 1;    //RANGE ENDS TO
		$this->data['range'] = $count? "Showing ".$r_from." to ".$r_to." of ".$config["total_rows"]:'';*/
		//echo $this->db->last_query();die;
		//die;
		$this->db->order_by('country','asc');
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

    public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id){
            $this->data['categories'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, true);
            count($this->data['categories']) || $this->data['errors'][] = 'User could not be found';

			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['categories'] = $this->region_model->get_new();
        }
        

       
		$this->data['country_data'] = $this->comman_model->get('countries',false);
		// Pages for dropdown
        // Fetch all files by repository_id
        
        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));

        $rules = $this->region_model->rules;
        $this->form_validation->set_rules($this->region_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
            $data = $this->comman_model->array_from_post(array('name','desc','country'));
            if($id == NULL)$data['order'] = $this->region_model->max_order()+1;
            $data_lang = $this->region_model->array_from_post($this->region_model->get_lang_post_fields());
            if($id == NULL){
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
            
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/cities');
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
			}
            $id = $this->comman_model->save($this->_table_names, $data, $id);
			if(empty($this->data['categories']->id))
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


    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->region_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        //$this->data['pages'] = $this->region_model->get_nested($this->data['content_language_id']);
		$this->data['pages'] = $this->region_model->get_nested($this->data['content_language_id']);
		
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    
    public function order()
    {
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function update_ajax($filename = NULL)
    {
        // Save order from ajax call
        if(isset($_POST['sortable']) && $this->config->item('app_type') != 'demo')
        {
            $this->region_model->save_order($_POST['sortable']);
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
		$this->region_model->delete($id);
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