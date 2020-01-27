<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends Admin_Controller {
	public $_table_names = 'language';
	public $_subView = 'admin/language/';
	public $_redirect = '/language';
	public function __construct(){
    	parent::__construct();
        $this->load->model('language_model');
        $this->load->model('settings_model');
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
		
		$this->data['active'] = 'General Settings';

		$this->checkPermissions('general_setting');
    }
	

	//  Landing page of admin section.
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],134);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['table'] = true;
		$this->db->order_by('id','desc');	
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
/*		$count = count($this->data['all_data']);
		$r_from = $page <= 1 ? 1 : ($page -1) * $config["per_page"]+1; //RANGE STARTS FROM 
		$r_to   = $r_from + $count - 1;    //RANGE ENDS TO
		$this->data['range'] = $count? "Showing ".$r_from." to ".$r_to." of ".$config["total_rows"]:'';*/
		//echo $this->db->last_query();die;
		//die;
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}


	function edit($id= NULL){
	    // Fetch a record or set a new one
	    if($id){
            $this->data['language'] = $this->language_model->get($id);
            if(!$this->data['language']){
	            redirect($this->data['admin_link'].$this->_redirect);
			}
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        }
        else
        {
            $this->data['language'] = $this->language_model->get_new();
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        }

        // Set up the form
        $rules = $this->language_model->rules_admin;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data = $this->settings_model->array_from_post($this->language_model->get_post_from_rules($rules));
             // check if userfile logo is not empty
            if(!empty($_FILES['logo'])){
                $config['upload_path']      = 'assets/uploads/language/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp';
                $config['max_size']         = '30000';
                $config['max_width']        = '1024';
                $config['max_height']       = '768';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo'))
                {
                    if($_FILES['logo']['error'] != 4)
                    {
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else
                {
                    $upload_data    = $this->upload->data();
                //    $this->session->set_flashdata('message', 'Your file has been successfully uploaded.');
                    $data['image']  = $upload_data['file_name'];
                //  redirect(config_item('admin_folder').'/media/index/'.$root);
                }
            }else{
                $data['image']  = $this->data['language']->image;
            }

            $ids = $this->language_model->save($data, $id);
			if(!$id){
				$statics = $this->comman_model->get('static_text',false);
				if($statics){
					foreach($statics as $set_static){
						$this->db->set(array('title'=>$set_static->name,'static_text_id'=>$set_static->id,'language_id'=>$ids));
						$this->db->insert('static_text_lang');
					}
				}
			}
			redirect($this->data['admin_link'].$this->_redirect);
        }

          
        
    	$this->data['subview'] = $this->_subView.'edit';
    	$this->load->view('admin/_layout_main', $this->data);
    }

	function set_option(){
		$id = $this->input->post('id');
		$action = $this->input->post('action');
		if($action=='shopping'){
			$post_data = array('is_shopping_gold'=>$this->input->post('value'));
			$this->comman_model->save($this->_table_names,$post_data,$id);
		}
		else if($action=='featured'){
			$post_data = array('is_featured'=>$this->input->post('value'));
			$this->comman_model->save($this->_table_names,$post_data,$id);			
		}	
	}

	function get_status(){
		$id = $this->input->post('id');
		$post_data = array('enabled'=>$this->input->post('enable'));
		$result = $this->comman_model->save($this->_table_names,$post_data,$id);
	}

	function delete($id = false){

		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$this->language_model->delete($id);
		$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],297)); 
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

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */