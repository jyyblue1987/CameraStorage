<?php
class default_image extends Admin_Controller{
	public $_table_names = 'home_images';
	public $_subView = 'admin/default_image/';
	public $_redirect = '/default_image';
    public $_current_revision_id;
	public function __construct(){
		parent::__construct();
		$this->checkPermissions('default_image');

		$this->data['active'] = 'Content Management';
        $this->load->model(array('comman_model'));
        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
	}

	function index(){
		$this->load->library('image_lib');
        $this->data['name'] = 'Default Image';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		if ($this->input->post('operation')){
            //$data = $this->settings_model->array_from_post($this->settings_model->get_post_from_rules($rules)+array('footer_text','phone','address'));
            $data = array();
            if(!empty($_FILES['logo']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['product_image']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }

            }else{
                $data['product_image']  = $this->data['settings']['product_image'];
            }      
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],294));
            redirect($this->data['_cancel']);
        }
        
        //var_dump($this->data['admin_details']);
/*        $this->data['subview'] = 'admin/dashboard/background';
        $this->load->view('admin/_layout_main',$this->data);       */
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
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