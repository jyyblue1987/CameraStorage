<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Banner extends Admin_Controller{
	public $_table_names = 'banners';
	public $_subView = 'admin/banners/';
	public $_redirect = '/banner';
    public $_current_revision_id;
	
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Banner Management';
        $this->load->model(array('banner_model','language_model','settings_model'));

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_content==1){}
			else{
				$redirect = true;
			}
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}
        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}
    
    public function index()
	{
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],3190).'Ad Space';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;
		$this->data['login'] = $this->session->all_userdata();
		$this->db->order_by('id','desc');	
		$this->data['all_data'] = $this->comman_model->get_lang('banners',$this->data['content_language_id'],NULL,false,'banner_id',false);
        $this->data['templates_page'] = $this->banner_model->get_templates('page_');
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
		$this->data['all_data'] = $this->banner_model->get_lang($this->data['content_language_id']);
		$this->data['subview'] = 'admin/banner/order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->banner_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->banner_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view('admin/banners/order_ajax', $this->data);
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
            $this->banner_model->save_order($_POST['sortable']);
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

            $this->data['page'] = $this->banner_model->get_lang($id, FALSE, $this->data['content_language_id']);
            count($this->data['page']) || $this->data['errors'][] = 'User could not be found';
            
        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['page'] = $this->banner_model->get_new();
        }

       
		// Pages for dropdown
        $this->data['page_languages'] = $this->language_model->get_form_dropdown('language');
        $this->data['templates_page'] = $this->banner_model->get_templates('page_');
        
        // Fetch all files by repository_id

        // Set up the form
        $rules = $this->banner_model->rules;
        $this->form_validation->set_rules($this->banner_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE){
			$data = $this->banner_model->array_from_post(array('template', 'name','link','desc'));
            if($id == NULL)$data['order'] = $this->banner_model->max_order()+1;
            $data_lang = $this->banner_model->array_from_post($this->banner_model->get_lang_post_fields());
            if($id == NULL)
                $data['date'] = date('Y-m-d H:i:s');
           
            if(!empty($_FILES['logo'])){
                $config['upload_path']      = 'assets/uploads/banners/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
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
			
			//$data_lang['body_1']=htmlentities($data_lang['body_1']);
			//print_r($data_lang);
			
			//exit;
			
            $id = $this->banner_model->save_with_lang($data, $data_lang, $id);
			if(empty($this->data['page']->id))
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel'].'/edit/'.$id);
        }
        
/*            echo '<pre>';
			print_r($this->data);die;*/
        // Load the view
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
    
	
    public function delete($id)
	{
		$this->banner_model->delete($id);
		redirect($this->data['_cancel']);
	}
    
    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current page
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        
        $page = $this->banner_model->get();
        
        if(count($page))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }
    
}