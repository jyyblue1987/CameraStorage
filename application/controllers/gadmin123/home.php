<?php
class Home extends Admin_Controller{
	public $_table_names = 'home_images';
	public $_subView = 'admin/home/';
	public $_redirect = '/home';
    public $_current_revision_id;
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Home Management';
        $this->load->model(array('home_model','comman_model'));
        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
	}

    public function remove_image($page,$id){
		$file_name = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!empty($file_name)){
			if($page=='image1'){
				$file_dir ='assets/uploads/home/'.$file_name->image; 
				if(is_file($file_dir)){
					unlink($file_dir);
				}
				$this->comman_model->save($this->_table_names,array('image'=>NULL),$id);		
			}
			if($page=='image2'){
				$file_dir ='assets/uploads/home/'.$file_name->image1; 
				if(is_file($file_dir)){
					unlink($file_dir);
				}
				$this->comman_model->save($this->_table_names,array('image1'=>NULL),$id);		
			}
			
		}
		redirect($this->_redirect.'/edit_image/'.$id);
	}

    public function remove_video($page,$id){
		$file_name = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!empty($file_name)){
			if($page=='video'){
				$file_dir ='assets/uploads/home/'.$file_name->video; 
				if(is_file($file_dir)){
					unlink($file_dir);
				}
				$this->comman_model->save($this->_table_names,array('video'=>NULL),$id);		
			}
			else if($page=='image'){
				$file_dir ='assets/uploads/home/'.$file_name->image; 
				if(is_file($file_dir)){
					unlink($file_dir);
				}
				$this->comman_model->save($this->_table_names,array('image'=>NULL),$id);		
			}
		}
		redirect($this->_redirect.'/edit_video/'.$id);
	}


	function index1(){}

    public function setting(){
	    // Fetch all pages
		$this->data['title'] = 'Home Setting | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Home Setting';
		$this->data['types'] = array('image' => 'image', 
					'slider' => 'Slider',
					"video"=>'Video'
					);
		$this->data['page'] = $this->comman_model->get_by('home_setting',array('id'=>1),false,false,true);

		if($this->input->post('operation')){ 
            $data =array();
        	$data = $this->home_model->array_from_post(array('type'));
            $id = $this->comman_model->save('home_setting',$data,1);
			$this->session->set_flashdata('success','Setting has successfully saved.');            
            redirect($this->data['_cancel'].'/setting');
		}
        $this->data['subview'] = $this->_subView.'setting';	
		$this->load->view('admin/_layout_main',$this->data);
	}
    


    
	
	public function edit_video($id = NULL){
	    // Fetch a page or set a new one
		$id =1;
		$this->data['products'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'type'=>'video'),FALSE, FALSE,TRUE);
		$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Edit Video';

		count($this->data['products']) || $this->data['errors'][] = 'User could not be found';
        		
        // Set up the form
        $rules = $this->home_model->rules;
        $this->form_validation->set_rules($this->home_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
        	$data = $this->home_model->array_from_post(array('name','is_active'));

            if($id == NULL)$data['order'] = $this->home_model->max_order()+1;

			if (!empty($_FILES['logo']['name'])){
                $config['upload_path']      = 'assets/uploads/home/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
				$this->upload->initialize($config);
                if (!$this->upload->do_upload('logo')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['image']  = $upload_data['file_name'];
                }

            }	
			else{
	            if($id != NULL)
					$data['image'] = $this->data['products']->image;
			}

			//second image
			if (!empty($_FILES['logo1']['name'])){
                $config['upload_path']      = 'assets/uploads/home/';
                $config['allowed_types']    = '*';
                $config['max_size']         = '100000';
                $this->load->library('upload', $config);
				$this->upload->initialize($config);
                if (!$this->upload->do_upload('logo1')){
                    if($_FILES['logo1']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['video']  = $upload_data['file_name'];
                }

            }	
			else{
	            if($id != NULL)
					$data['video'] = $this->data['products']->video;
			}

			$data['type'] = 'video';
			$this->comman_model->save($this->_table_names,$data,$id);

			if(empty($this->data['products']->id)){
	            $this->session->set_flashdata('success','Image has successfully created.');
			}
			else
	            $this->session->set_flashdata('success','Image has successfully updated.');			
           redirect($this->data['_cancel'].'/edit_video/');
        }
        
		$this->data['subview'] = $this->_subView.'edit_video';
        $this->load->view('admin/_layout_main', $this->data);	
	}
    
    
}