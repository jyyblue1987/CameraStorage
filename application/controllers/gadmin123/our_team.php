<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Our_team extends Admin_Controller{
	public $_table_names = 'partner_sliders';
	public $_subView = 'admin/our_team/';
	public $_redirect = '/our_team';
    public $_current_revision_id;
	
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Employee Management';
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->load->model(array('partner_slider_model','language_model'));

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
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1084).'Our Team';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;
		$this->data['login'] = $this->session->all_userdata();
		$this->db->order_by('id','desc');	
		$this->data['all_data'] = $this->partner_slider_model->get();
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
		$this->data['all_data'] = $this->partner_slider_model->get_lang();
		$this->data['subview'] = 'admin/page/order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function order_ajax ()
    {
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->partner_slider_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->partner_slider_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    public function update_ajax($filename = NULL)
    {
        // Save order from ajax call
        if(isset($_POST['sortable']) && $this->config->item('app_type') != 'demo')
        {
            $this->partner_slider_model->save_order($_POST['sortable']);
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
            $this->data['page'] = $this->partner_slider_model->get($id, FALSE, $this->data['content_language_id']);
            count($this->data['page']) || $this->data['errors'][] = 'User could not be found';
            
        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

            $this->data['page'] = $this->partner_slider_model->get_new();
        }

       
		// Pages for dropdown
        $this->data['partner_slider_position'] = $this->partner_slider_model->get_templates();

        // Set up the form
        $rules = $this->partner_slider_model->rules;
        $this->form_validation->set_rules($this->partner_slider_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE){
			$data = $this->partner_slider_model->array_from_post(array('name','type','description'));
            if($id == NULL)$data['order'] = $this->partner_slider_model->max_order()+1;
            $data_lang = $this->partner_slider_model->array_from_post($this->partner_slider_model->get_lang_post_fields());
            if($id == NULL){
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
           
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/partner_sliders');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
			}	
			else{
				 if($id != NULL)$data['image'] = $this->data['page']->image;
			}
			
			
			//print_r($data);
			
			//$data_lang['body_1']=htmlentities($data_lang['body_1']);
			//print_r($data_lang);
			
			//exit;
            $id = $this->comman_model->save($this->_table_names,$data,$id);
			if(empty($this->data['page']->id))
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel']);
        }
        
/*            echo '<pre>';
			print_r($this->data);die;*/
        // Load the view
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
	
    public function delete($id)
	{
		$this->partner_slider_model->delete($id);
        redirect($this->data['_cancel']);
	}
    
}