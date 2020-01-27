<?php
class Static_text extends Admin_Controller{
	public $_table_names = 'static_text';
	public $_subView = 'admin/static_text/';
	public $_redirect = '/static_text';
	public function __construct(){
		parent::__construct();
        $this->data['active']= 'General Settings';
        $this->load->model(array('comman_model','static_text_model'));

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        
		$this->checkPermissions('general_setting');
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}
    
    public function index(){
		//$this->data['table'] = true;
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],189);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['all_data'] = $this->comman_model->get_lang($this->_table_names,$this->data['content_language_id'],NULL,false,'static_text_id',false);
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false,false,false);

        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}
	
	function ajax_edit(){
		$msge = 'error';
		$id = $this->input->post('id');
		$data = $this->input->post('data');
		if($id){
			if(!empty($data)){
				$post = array('title'=>$data);
 				$this->db->set($post);
				$this->db->where('id_static_text_lang', $id);
				$check = $this->db->update($this->_table_names.'_lang');
				if($check){
					$msge = 'success';
				}
			}
		}
		echo $msge;
	}
    
    public function order()
    {
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    

    
    public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id)
        {
            $this->data['news'] = $this->static_text_model->get_lang($id, FALSE, $this->data['content_language_id']);
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Edit "'.$this->data['news']->name.'"';
            count($this->data['news']) || $this->data['errors'][] = 'User could not be found';            
/*			echo '<pre>';
			print_r($this->data['news']);
			die;*/
        }
        else{
            $this->data['news'] = $this->static_text_model->get_new();
			//redirect($this->data['admin_link'].$this->_redirect);
        }
        

       
		// Pages for dropdown
        $this->data['page_languages'] = $this->language_model->get_form_dropdown('language');
        $this->data['templates_page'] = $this->static_text_model->get_templates('page_');
        
        // Fetch all files by repository_id
        // Set up the form
        $rules = $this->static_text_model->rules;
        $this->form_validation->set_rules($this->static_text_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE){            
            if($id == NULL)$data['order'] = $this->static_text_model->max_order()+1;
            $data_lang = $this->static_text_model->array_from_post($this->static_text_model->get_lang_post_fields());
            if($id == NULL){
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}

            $id = $this->static_text_model->save_with_lang($data, $data_lang, $id);
            redirect($this->data['admin_link'].$this->_redirect.'/edit/'.$id);
           // redirect($this->_redirect.'/edit/');
        }
        
        // Load the view
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}

    public function edit_admin($id = NULL){
	    // Fetch a page or set a new one
        $this->data['news'] = $this->static_text_model->get_new();
	    if($id)
        {
            $this->data['news'] = $this->static_text_model->get_lang($id, FALSE, $this->data['content_language_id']);
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Edit "'.$this->data['news']->name.'"';
            if(!$this->data['news'])
			redirect($this->data['admin_link'].$this->_redirect);

        }
        else{
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Edit "'.$this->data['news']->name.'"';
            $this->data['news'] = $this->static_text_model->get_new();
			//redirect($this->data['admin_link'].$this->_redirect);
        }
        
        

       
        // Fetch all files by repository_id
        // Set up the form
        $rules = $this->static_text_model->rules;
        $this->form_validation->set_rules($this->static_text_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE){            
            if($id == NULL)$data['order'] = $this->static_text_model->max_order()+1;
            $data_lang = $this->static_text_model->array_from_post($this->static_text_model->get_lang_post_fields());
            $data =array();
        	$data = $this->static_text_model->array_from_post(array('name'));

            if($id == NULL){
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}

            $id = $this->static_text_model->save_with_lang($data, $data_lang, $id);
            //redirect($this->data['admin_link'].$this->_redirect.'/edit/'.$id);
            redirect($this->data['admin_link'].$this->_redirect.'/edit_admin');
        }
        
        // Load the view
		$this->data['subview'] = $this->_subView.'edit_admin';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
    private function generate_sitemap()
    {
        $this->load->model('estate_m');
        
        $sitemap = $this->static_text_model->get_sitemap();
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
    
/*    public function delete($id)
	{
       
		$this->static_text_model->delete($id);
        redirect($this->data['admin_link'].$this->_redirect);
	}
    */
    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current news
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        
        $news = $this->static_text_model->get();
        
        if(count($news))
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