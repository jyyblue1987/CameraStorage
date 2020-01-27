<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends Admin_Controller{
	public $_table_names = 'page';
	public $_subView = 'admin/page/';
	public $_redirect = '/page';
    public $_current_revision_id;
	
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Content Management';
        $this->load->model(array('pages_model','language_model','settings_model'));

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();

		$this->checkPermissions('page');
        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}
    
    public function index()
	{
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],182);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;
		$this->db->order_by('id','desc');	
        $this->data['templates_page'] = $this->pages_model->get_templates('page_');
		$this->data['all_data'] = $this->pages_model->get_lang();
/*		$count = count($this->data['all_data']);
		$r_from = $page <= 1 ? 1 : ($page -1) * $config["per_page"]+1; //RANGE STARTS FROM 
		$r_to   = $r_from + $count - 1;    //RANGE ENDS TO
		$this->data['range'] = $count? "Showing ".$r_from." to ".$r_to." of ".$config["total_rows"]:'';*/
		//echo $this->db->last_query();die;
		//die;
        $this->data['subview'] = $this->_subView.'index_order';	
		$this->load->view('admin/_layout_main',$this->data);

	}
    
    public function file_order($id){
        $data = array();
		$files = $this->comman_model->get_by('page_files',array('page_id' => $id),false,false,false);
		foreach($_POST['order'] as $order=>$filename){
			foreach($files as $file)
			{
				if($filename == $file->filename){
					$this->comman_model->save('page_files',array('order' => $order,),$file->id);
					break;
				}
			}
		}
        echo json_encode($data);
	}

    public function order()
    {
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['all_data'] = $this->pages_model->get_lang();
		$this->data['subview'] = 'admin/page/order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->pages_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->pages_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view('admin/page/order_ajax', $this->data);
    }

	public function search_ajax(){
        // Save order from ajax call
		$title = $this->input->post('title');
        if (isset($_POST['sortable'])) {
            $this->pages_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
		$this->db->like('title',$title);
        $this->data['pages'] = $this->pages_model->get_search_data($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }
	

    public function update_link(){
        $post = array();
        $post['id'] = $this->input->post('id');
        $post['link'] = $this->input->post('links');
        $id = $this->input->post('id');
        $link = $this->input->post('links');

       
        $id = $this->comman_model->save('page_files',array('link'=>$link),$id);
        if($id>0){
            $data['message'] = 'Success Updating Description';
            $data['status'] = true;
        }else{
            $data['message'] = 'Error Updating Description';
            $data['status'] = false;
        }
        $length = strlen(json_encode($post));
        header('Content-Type: application/json; charset=utf8');
        header('Content-Length: '.$length);
        echo json_encode($data);
        exit();
    }
	
    public function update_ajax($filename = NULL)
    {
        // Save order from ajax call
        if(isset($_POST['sortable']) && $this->config->item('app_type') != 'demo')
        {
            $this->pages_model->save_order($_POST['sortable']);
        }
        
        $data = array();
        $length = strlen(json_encode($data));
        header('Content-Type: application/json; charset=utf8');
        header('Content-Length: '.$length);
        echo json_encode($data);
        
        exit();
    }
    
    public function edit($id = NULL)
	{
		$data = array();
	    // Fetch a page or set a new one
	    if($id)
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['page'] = $this->pages_model->get_lang($id, FALSE, $this->data['content_language_id']);
            count($this->data['page']) || $this->data['errors'][] = 'User could not be found';
            
        }
        else{
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['page'] = $this->pages_model->get_new();
        }
        



       
		// Pages for dropdown
        $this->data['pages_no_parents'] = $this->pages_model->get_no_parents($this->data['content_language_id']);
        $this->data['page_languages'] = $this->language_model->get_form_dropdown('language');
        $this->data['templates_page'] = $this->pages_model->get_templates('page_');


		$this->data['display'] = array('' => 'Select',
										'Flash Notice To All Clients' => 'Flash Notice To All Clients',
										'Flash Notice To All Dealers' => 'Flash Notice To All Dealers',
										);
        
        // Fetch all files by repository_id

        // Set up the form

		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));
        $rules = $this->pages_model->rules;
        $this->form_validation->set_rules($this->pages_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE){
			$data = $this->pages_model->array_from_post(array('template','slug','top_menu','middle_menu','bottom_menu','display'));
            if($id == NULL)$data['order'] = $this->pages_model->max_order()+1;
            $data_lang = $this->pages_model->array_from_post($this->pages_model->get_lang_post_fields());
            if($id == NULL)
                $data['date'] = date('Y-m-d H:i:s');
           
            if(!empty($_FILES['logo'])){
                $config['upload_path']      = 'assets/uploads/pages/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo'))
                {
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else
                {
                    $upload_data    = $this->upload->data();
                //    $this->session->set_flashdata('message', 'Your file has been successfully uploaded.');
                    $data['image']  = $upload_data['file_name'];

                }

            }else{
                $data['image']  = $this->data['page']->image;
            }      
			
			
			//print_r($data);
/*			echo '<pre>';
			print_r($data_lang);
			die;*/

			//$data_lang['body_1']=htmlentities($data_lang['body_1']);
			//print_r($data_lang);
			
			//exit;
			
            $id = $this->pages_model->save_with_lang($data, $data_lang, $id);
			if(empty($this->data['page']->id))
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel'].'/edit/'.$id);
        }
        
/*            echo '<pre>';
			print_r($this->data);die;*/
        // Load the view
		$this->data['subview'] = 'admin/page/edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
    public function upload($page_or_param = NULL, $model = 'pages_model'){	
        $modelinput = $this->input->post('model');
        if($modelinput){
            $model = $modelinput;
        }

        $this->load->model($model);        
        $page_id = NULL;        
        $repository_id = NULL;        
        if(is_numeric($page_or_param)){
            // Files for page
            $page_id = $page_or_param;
    	    // Fetch page
    		$page = $this->$model->get($page_id, TRUE);
            // Fetch file repository
            $repository_id = $page->id;
        }

        /* +++ Security check for USER +++ */
        /* +++ End security check for USER +++ */
        // Upload Handler
        $this->load->library('uploadHandler1', array( 'options'=>array('script_url' => site_url($this->data['_cancel'].'/upload').'/',
                                                     'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']).'/files/'.$this->_current_revision_id.'/',
                                                     'upload_url' => base_url('/files/'.$this->_current_revision_id).'/'),
                                                     'initialize'=>false,
                                                     ));
        

        if($_SERVER['REQUEST_METHOD'] == 'DELETE')
        {
            $this->uploadhandler1->initialize(true);          
            
            if(substr($page_or_param, 0, 4) == 'rep_')
            {
                $repository_id = substr($page_or_param, 4);
                
                $file = $this->comman_model->get_by('page_files',array(
                    'filename' => $this->uploadhandler1->get_file_name_param(),
                    'page_id' => $repository_id
                ),false,false,TRUE);
                
                $this->comman_model->delete('page_files',array('id'=>$file->id));
            }

            exit();
        }
        else if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $response = $this->uploadhandler1->initialize(false);
            
            if(isset($response['files']))
            {
                foreach($response['files'] as $file)
                {
                    
                    $file->thumbnail_url = base_url('assets/templates/images/icons/filetype/_blank.png');
                    $file->zoom_enabled = false;
                //    $filena = str_replace(" ", "_", $file->name);
                    $filena = $file->name;
                    $file->delete_url = site_url($this->data['_cancel'].'/upload/rep_'.$repository_id).'?file='.rawurlencode($filena);
                    if(file_exists(FCPATH.'/files/'.$this->_current_revision_id.'/thumbnail/'.$file->name))
                    {
                        $file->thumbnail_url = base_url('files/'.$this->_current_revision_id.'/thumbnail/'.$filena);
                        $file->zoom_enabled = true;
                    }
                    else if(file_exists(FCPATH.'assets/templates/images/icons/filetype/'.get_file_extension($filena).'.png'))
                    {
                        $file->thumbnail_url = base_url('assets/templates/images/icons/filetype/'.get_file_extension($filena).'.png');
                    }
                    
                    $file->short_name = character_hard_limiter($filena, 20);
                    
                    $next_order = $this->comman_model->get_max_order('page_files')+1;
                    
                    $response['orders'][$filena] = $next_order;
                    
                    // Add file to repository
                    $file_id = $this->comman_model->save('page_files',array(
                        'page_id' => $repository_id,
                        'order' => $next_order,
                        'filename' => $filena,
                        'filetype' => $file->type
                    ));
    
                }
            }
            $this->uploadhandler1->generate_response($response);
        }
        exit();
    }
	
    public function delete($id)
	{
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		$this->pages_model->delete($id);
        redirect($this->data['_cancel']);
	}
    
    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current page
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        
        $page = $this->pages_model->get();
        
        if(count($page))
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