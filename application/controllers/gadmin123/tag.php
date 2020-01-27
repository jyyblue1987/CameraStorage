<?php
class Tag extends Admin_Controller{
	public $_table_names = 'tags';
	public $_subView = 'admin/tags/';
	public $_redirect = '/tag';
	public function __construct(){
		parent::__construct();

		$this->data['active'] = 'Product Management';
        $this->load->model('tag_model');

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';


        // Get language for content id to show in administration
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_product==1){}
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
	    // Fetch all pages
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],125);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['all_data'] = $this->tag_model->get_lang();
/*		$count = count($this->data['all_data']);
		$r_from = $page <= 1 ? 1 : ($page -1) * $config["per_page"]+1; //RANGE STARTS FROM 
		$r_to   = $r_from + $count - 1;    //RANGE ENDS TO
		$this->data['range'] = $count? "Showing ".$r_from." to ".$r_to." of ".$config["total_rows"]:'';*/
		//echo $this->db->last_query();die;
		//die;
        $this->data['subview'] = $this->_subView.'index_order';	
		$this->load->view('admin/_layout_main',$this->data);
	}
    
    public function order()
    {
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['all_data'] = $this->tag_model->get_lang();
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->tag_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->tag_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    public function search_ajax(){
        // Save order from ajax call
		$title = $this->input->post('title');
        if (isset($_POST['sortable'])) {
            $this->tag_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
		$this->db->like('title',$title);
        $this->data['pages'] = $this->tag_model->get_nested($this->data['content_language_id']);
        
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
            $this->tag_model->save_order($_POST['sortable']);
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
	    // Fetch a page or set a new one
	    if($id)
        {
            $this->data['tags'] = $this->tag_model->get_lang($id, FALSE, $this->data['content_language_id']);
            count($this->data['tags']) || $this->data['errors'][] = 'User could not be found';

			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['tags'] = $this->tag_model->get_new();
        }
        

       
		// Pages for dropdown
        $this->data['pages_no_parents'] = $this->tag_model->get_no_parents($this->data['content_language_id']);
        $this->data['page_languages'] = $this->language_model->get_form_dropdown('language');
        $this->data['templates_page'] = $this->tag_model->get_templates('page_');
        // Fetch all files by repository_id
        
        // Set up the form
        $rules = $this->tag_model->rules;
        $this->form_validation->set_rules($this->tag_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
        	//$data = $this->tag_model->array_from_post(array('slug'));
            if($id == NULL)$data['order'] = $this->tag_model->max_order()+1;
            $data_lang = $this->tag_model->array_from_post($this->tag_model->get_lang_post_fields());
            if($id == NULL){
                $data['on_date'] = date('Y-m-d');
                $data['date_time'] = date('Y-m-d H:i:s');
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}

            
            $id = $this->tag_model->save_with_lang($data, $data_lang, $id);
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
    
    private function generate_sitemap(){
        $this->load->model('estate_m');
        
        $sitemap = $this->tag_model->get_sitemap();
        $properties = $this->estate_m->get_sitemap();
        
        $content = '';
        $content.= '<?xml version="1.0" encoding="UTF-8"?>'."\n".
                   '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"'."\n".
                   '  	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'."\n".
                   '  	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9'."\n".
                   '			    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\n";
        
        
        foreach($sitemap as $page_obj)
        {
            $content.= '<url>'."\n".
                    	'	<loc>'.site_url($this->language_model->get_code($page_obj->language_id).'/'.$page_obj->id.'/'.url_title_cro($page_obj->navigation_title, '-', TRUE)).'</loc>'."\n".
                    	//'	<lastmod>'.$page_obj->date.'</lastmod>'.
                    	'	<changefreq>weekly</changefreq>'."\n".
                    	'	<priority>0.5</priority>'."\n".
                    	'</url>'."\n";
        }
        
        foreach($properties as $estate_obj)
        {
            $langs = $this->language_model->get_array();
            
            foreach($langs as $lang_code=>$lang)
            {
            $content.= '<url>'."\n".
                    	'	<loc>'.site_url('frontend/property/'.$estate_obj->id.'/'.$lang['code']).'</loc>'."\n".
                    	//'	<lastmod>'.$page_obj->date.'</lastmod>'.
                    	'	<changefreq>weekly</changefreq>'."\n".
                    	'	<priority>0.5</priority>'."\n".
                    	'</url>'."\n";
            }
        }

        $content.= '</urlset>';
        
        $fp = fopen(FCPATH.'sitemap.xml', 'w');
        fwrite($fp, $content);
        fclose($fp);
    }
    
    public function delete($id){       
		$this->tag_model->delete($id);
        redirect($this->data['_cancel']);
	}
    
    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current categories
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        
        $categories = $this->tag_model->get();
        
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }
    
}