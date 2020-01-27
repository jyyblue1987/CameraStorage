<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Content extends Admin_Controller{
	public $_table_names = 'content';
	public $_subView = 'admin/content/';
	public $_redirect = '/content';
    public $_current_revision_id;
	
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Content Management';
        $this->load->model(array('content_model'));

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

		$this->checkPermissions('content');
        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}
    
    public function index()
	{
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],181);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;
		$this->db->order_by('id','asc');
		$this->data['all_data'] = $this->comman_model->get_lang($this->_table_names,$this->data['adminLangSession']['lang_id'],NULL,array('enabled'=>1),'content_id',false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}
	
    public function edit($id = NULL){

		$data = array();
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$this->data['page'] = $this->content_model->get_lang($id, FALSE, $this->data['content_language_id']);
            count($this->data['page']) || $this->data['errors'][] = 'User could not be found';
            
        }
        else{
			redirect($this->data['_cancel']);
        }
        

        
        // Fetch all files by repository_id

        // Set up the form
        $rules = $this->content_model->rules;
        $this->form_validation->set_rules($this->content_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data = $this->content_model->array_from_post(array('link'));
            $data_lang = $this->content_model->array_from_post($this->content_model->get_lang_post_fields());
            if($id != NULL){
                $data['date'] = date('Y-m-d H:i:s');
			}

			$p_video1 =$this->input->post('video');
			if($p_video1){
				$data['video']  = $p_video1;
			}
			
            $id = $this->content_model->save_with_lang($data, $data_lang, $id);
			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
//            redirect($this->data['_cancel'].'/edit/'.$id);
            redirect($this->data['_cancel']);
        }
        
/*            echo '<pre>';
			print_r($this->data);die;*/
        // Load the view
		$this->data['subview'] = $this->_subView.'/edit';
        $this->load->view('admin/_layout_main', $this->data);
	}

	public function edits($id = NULL){
		$data = array();
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
			$this->db->where('type','home');
			$this->data['page'] = $this->content_model->get_lang($id, FALSE, $this->data['content_language_id']);
			if(!$this->data['page']){
				redirect($this->data['_cancel']);
			}
            
        }
        else{
			redirect($this->data['_cancel']);
        }
        

        
        // Fetch all files by repository_id

        // Set up the form
        $rules = $this->content_model->rules;
        $this->form_validation->set_rules($this->content_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data_lang = $this->content_model->array_from_post($this->content_model->get_lang_post_fields());
            if($id != NULL){
                $data['date'] = date('Y-m-d H:i:s');
			}
						
            $id = $this->content_model->save_with_lang($data, $data_lang, $id);
			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel'].'/edits/'.$id);
        }
        
/*            echo '<pre>';
			print_r($this->data);die;*/
        // Load the view
		$this->data['subview'] = $this->_subView.'/edits';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
    
	
    public function remove_video($id){
		$file_name = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!empty($file_name)){
			$file_dir ='assets/uploads/contents/'.$file_name->video; 
			if(is_file($file_dir)){
				unlink($file_dir);
			}
			$this->comman_model->save($this->_table_names,array('video'=>NULL),$id);		
		}
		redirect($this->data['_edit'].'/'.$id);
	}

	function ajax_upload(){		
		$this->load->helper('string');
		$id = $this->input->post('id');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/contents/';
		$config['allowed_types'] = '*';
		
		//$config['allowed_types'] = config_item('allow_data_type');
		$config['max_size']	= '200000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('myfile')){
			$ret['result']= 'error';
			$ret['msg']= $this->upload->display_errors();
			//redirect('admin/add_coach');
		}
		else{
			$upload_info = $this->upload->data();
			$ret['result']= 'success';
			$ret['msg']= $upload_info['file_name'];
			$ret['m_id']= time();
			
		}
	    echo json_encode($ret);		
	}

	function refresh_m(){
		$id = $this->input->post('id');
		$v_id = $this->input->post('v_id');
		$c_id = $this->input->post('c_id');
		$delete ="delete_files2('".$c_id."')";
		if($v_id==1){
			$delete ="delete_files1('".$c_id."')";
		}
		echo '<tr class="template-download fade in" id="'.$c_id.'">
            <td width="60%" class="name">'.$id.'</td>
        <td width="10%" align="right" class="delete" >
            <a href="javascript:void(0);"  class="btn " onclick="'.$delete.'" >
                <i class="fa fa-times"></i>
            </a>
        </td>
    </tr>';
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