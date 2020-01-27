<?php
class Newsletter extends Admin_Controller{
	public $_table_names = 'news';
	public $_subView = 'admin/newsletters/';
	public $_redirect = '/newsletter';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Newsletter Management';
        $this->load->model('comman_model');
        $this->load->model('news_model');

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        
		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_newsletter==1){}
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
    
    public function index(){
		//$this->data['table'] = true;
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],9);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get('news',false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function user(){
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],187);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['table'] = true;
		$this->data['all_data'] = $this->comman_model->get('newsletters',false);
        $this->data['subview'] = $this->_subView.'userlist';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function delete_user($id = false){
		if(!$id){
			redirect('admin/newsletter/user');		
		}
		$this->comman_model->delete_by_id('newsletters',array('id'=>$id));
		$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],297)); 
		redirect('admin/newsletter/user');		
	}
	

    
    public function order()
    {
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->news_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->news_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    public function search_ajax(){
        // Save order from ajax call
		$title = $this->input->post('title');
        if (isset($_POST['sortable'])) {
            $this->news_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
		$this->db->like('title',$title);
        $this->data['pages'] = $this->news_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    public function update_ajax($filename = NULL)
    {
        // Save order from ajax call
        if(isset($_POST['sortable']) && $this->config->item('app_type') != 'demo')
        {
            $this->news_model->save_order($_POST['sortable']);
        }
        
        $data = array();
        $length = strlen(json_encode($data));
        header('Content-Type: application/json; charset=utf8');
        header('Content-Length: '.$length);
        echo json_encode($data);
        
        exit();
    }
    
    public function user_mail(){
		
	    // Fetch a page or set a new one
		$this->data['name'] = 'News Data';
		$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
        // Set up the form
        $rules = $this->news_model->mail_rules;
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == TRUE){            
            $data =array();
        	$data = $this->news_model->array_from_post(array('slug'));
			if(isset($this->data['settings'])){
				$news_letter = $this->comman_model->get('newsletters',false);
				if($news_letter){
					$email = array();
					foreach($news_letter as $set_news){
						$email[] = $set_news->email;
					}
					$this->load->library('email');
					$config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
					$this->email->initialize($config);
					$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
					$this->email->to($email);
					$this->email->subject($this->input->post('subject'));
					$this->email->message($this->input->post('body'));
					if($this->email->send()){
			            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],298));
					}
					else{
			            $this->session->set_flashdata('error',show_static_text($this->data['adminLangSession']['lang_id'],200));
					}
					
				}
			}
            redirect($this->data['_cancel'].'/user_mail');
		}
        
        // Load the view
		$this->data['subview'] = $this->_subView.'mail_form';
        $this->load->view('admin/_layout_main', $this->data);	
	}

    public function edit1($id = NULL){
		
	    // Fetch a page or set a new one
		$this->data['name'] = 'News Data';
	    if($id)
        {
            $this->data['news'] = $this->news_model->get_lang($id, FALSE, $this->data['content_language_id']);
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
            count($this->data['news']) || $this->data['errors'][] = 'User could not be found';            
        }
        else
        {
			$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];
            $this->data['news'] = $this->news_model->get_new();
        }
        

       
		// Pages for dropdown
        $this->data['pages_no_parents'] = $this->news_model->get_no_parents($this->data['content_language_id']);
        $this->data['page_languages'] = $this->language_model->get_form_dropdown('language');
        $this->data['templates_page'] = $this->news_model->get_templates('page_');
        
        // Fetch all files by repository_id
        // Set up the form
        $rules = $this->news_model->rules;
        $this->form_validation->set_rules($this->news_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE){
            
            $data =array();
        	$data = $this->news_model->array_from_post(array('slug'));
        //    $data = $this->news_model->array_from_post(array('template', 'parent_id','menu_location'));
            if($id == NULL)$data['order'] = $this->news_model->max_order()+1;
            $data_lang = $this->news_model->array_from_post($this->news_model->get_lang_post_fields());
            $data['date'] = date('Y-m-d H:i:s');
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/newsletters');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
			}	
			else{
	            if($id != NULL)
	                $data['image']  = $this->data['news']->image;
			}


            $id = $this->news_model->save_with_lang($data, $data_lang, $id);
			if(isset($this->data['settings'])){
				$news_letter = $this->comman_model->get('newsletters',false);
				if($news_letter){
					$email = array();
					foreach($news_letter as $set_news){
						$email[] = $set_news->email;
					}
					$this->load->library('email');
					$config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
					$this->email->initialize($config);
					$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
					$this->email->to($email);
					$this->email->subject($this->input->post('title_1'));
					$this->email->message($this->input->post('body_1'));
					$this->email->send();					
				}
			}

			if(empty($this->data['products']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            
            redirect($this->data['_cancel'].'/edit/'.$id);
        }
        
        // Load the view
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	
	}
	public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id)
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['news'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, true);
            count($this->data['news']) || $this->data['errors'][] = 'User could not be found';            
        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['news'] = $this->news_model->get_new();
        }
        

       
		// Pages for dropdown
        $this->data['pages_no_parents'] = $this->news_model->get_no_parents($this->data['content_language_id']);
        $this->data['page_languages'] = $this->language_model->get_form_dropdown('language');
        $this->data['templates_page'] = $this->news_model->get_templates('page_');
        
        // Fetch all files by repository_id
        // Set up the form
        $rules = $this->news_model->email_rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            
            $data =array();
        	$data = $this->news_model->array_from_post(array('subject','desc'));
			$user_email = $this->input->post('email');
			$data['user_id']= serialize($this->input->post('email'));
        //    $data = $this->news_model->array_from_post(array('template', 'parent_id','menu_location'));
            if($id == NULL)$data['order'] = $this->news_model->max_order()+1;


            $id = $this->comman_model->save($this->_table_names,$data,$id);
			
			//send mail
			$this->load->library('email');
			$config = array (
				  'mailtype' => 'html',
				  'charset'  => 'utf-8',
				  'priority' => '1'
				   );
			$this->email->initialize($config);
			$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
			$this->email->to($user_email);
			$this->email->subject($data['subject']);
			$this->email->message($data['desc']);
			$this->email->send();					
			//end of send mail

			if(empty($this->data['products']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            
            redirect($this->data['_cancel'].'/');
        }
        
        // Load the view
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
    public function delete($id){
       
		$this->comman_model->delete($this->_table_names,array('id'=>$id));
        redirect($this->data['_cancel']);
	}
    
    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current news
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        
        $news = $this->news_model->get();
        
        if(count($news))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }
    
}