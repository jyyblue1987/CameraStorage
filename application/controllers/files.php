<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class files extends User_Controller {	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('ip_model','php_fast_cache_model'));
	}

	function index(){
		//var_dump($this->session->all_userdata());
		$this->data['active'] = 'video';	
		$this->data['name'] = 'My Video';	
		$this->data['title'] = $this->data['site_name']->value;
		$this->data['active_sub'] = '';	
		//$this->data['login'] = $this->session->all_userdata();
		$this->data['files']= $this->comman_model->get_by('files',array('user_id'=>$this->data['user_details']->id),false,false,false);
		
        $this->data['subview'] = 'user/files/index';	
		$this->load->view('user/_layout_main',$this->data);
	}

	function edit($id =false){		
        if(!$id)
            redirect('files');
        $this->data['active']= 'tools';
        $this->data['name']= 'Edit ';
        $this->data['title'] ='Edit| '.$this->data['site_name']->value;
		$this->data['categories'] = $this->comman_model->get('categories',false);	
        
        $edit_data = $this->comman_model->get_by('files',array('id'=>$id,'user_id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);
        if(count($edit_data)==0){
           redirect('files');
        }
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
        if($this->form_validation->run()==TRUE){
			if (!empty($_FILES['photo']['name'])){					
				$result =$this->comman_model->do_upload('photo','./assets/uploads/videos');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
					redirect('files/edit/'.$id);
				}
				else if($result[0]=='success'){
					$image = $result[1];
				}
			}	
			else{
				$image = $edit_data->image;
			}

            $post_data =$this->comman_model->array_from_post(array('name','published','category_id','description')); 
			$post_data['cover']= $image;
			if($this->input->post('file_name')){
				$post_data['file_name'] = $this->input->post('file_name');
			}
			else{
				$post_data['file_name'] = $edit_data->file_name;
			}
            $this->comman_model->save('files',$post_data,$id);
            $this->session->set_flashdata('success','File has successfully updated.');
            redirect('files');
        }

        $this->data['files'] = $edit_data;		
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'user/files/edit';        
        $this->load->view('user/_layout_main',$this->data);       
    }
	
	function create(){
		//var_dump($this->session->all_userdata());
		$image = '';
		$this->data['active'] = 'dropbox';	
		$this->data['title'] = $this->data['site_name']->value;
		$this->data['active_sub'] = '';	
		$this->data['categories'] = $this->comman_model->get('categories',false);	
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		if ($this->input->post('operation')){
			if ($this->form_validation->run() == FALSE){}
			else{
				if(!empty($_FILES['photo']['name'])){
					//echo $_FILES['photo'.$i]['name'];
					$result =$this->comman_model->do_upload('photo','./assets/uploads/videos');
					if($result[0]=='error'){
						$this->session->set_flashdata('error',$result[1]); 
						redirect('files/create');
					}
					else if($result[0]=='success'){
						$image = $result[1];
					}
				}			

				$post_data = $this->comman_model->array_from_post(array('name','published','description','category_id','link'));
				$post_data['cover'] = $image;
				$post_data['code'] = time().random_string('numeric',5);
				$post_data['user_id'] = $this->data['user_details']->id;
				$post_data['file_name'] = $this->input->post('file_name');

				$detail = $this->flag();
				//country details
				$post_data['ip_address']	= $this->input->ip_address();
				$post_data['country'] 		= $detail['CountryName'];
				$post_data['country_code'] 	= $detail['Country'];
				$post_data['flag'] 			= $detail['Flag'];
				$post_data['city'] 			= $detail['CityName'];
				$registerForm = $this->comman_model->save('files',$post_data);
				$this->session->set_flashdata('success', 'Video has successfully created.');
				//upload photo
				redirect('files/create');
			}
		}

		//$this->data['login'] = $this->session->all_userdata();
		
        $this->data['subview'] = 'user/files/create';	
		$this->load->view('user/_layout_main',$this->data);
	}

	function _check_ext($ext){
		$_type = 'o';
		$allowed = array(
					'a'	=> array('mpga', 'mp2', 'mp3', 'ra', 'rv', 'wav'),
					'v'	=> array('mpeg', 'mpg', 'mpe', 'mp4', 'flv', 'qt', 'mov', 'avi', 'movie'),
					'd'	=> array('pdf', 'xls', 'ppt', 'pptx', 'txt', 'text', 'log', 'rtx', 'rtf', 'xml', 'xsl', 'doc', 'docx', 'xlsx', 'word', 'xl', 'csv', 'pages', 'numbers'),
					'i'	=> array('bmp', 'gif', 'jpeg', 'jpg', 'jpe', 'png', 'tiff', 'tif'),
					'o'	=> array('psd', 'gtar', 'swf', 'tar', 'tgz', 'xhtml', 'css', 'html', 'htm', 'shtml', 'svg'),
					'z'	=> array('zip'),
				);
		if(!empty($ext)){
			foreach ($allowed as $type => $ext_arr)
			{				
				if (in_array(strtolower($ext), $ext_arr))
				{
					$_type		= $type;
					break;
				}
			}
		}
		return $_type;
	}

	function upload(){		
		$this->load->helper('string');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/videos/';
		$config['allowed_types'] = 'mp4';
		//$config['allowed_types'] = config_item('allow_data_type');
		$config['max_size']	= '600000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('myfile')){
			$ret['result']= 'error';
			$ret['msg']= $this->upload->display_errors();
			//redirect('admin/add_coach');
		}
		else{
			$upload_info = $this->upload->data();
			$extension_type = $this->_check_ext(ltrim($upload_info['file_ext'],'.'));
			$image_data = array(
						'code'		=>time().random_string('numeric',5),
						'name'      => $upload_info['file_name'],
						'file_name' => $upload_info['file_name'],
						'type'      => $extension_type,
						'extension' => $upload_info['file_ext'],
						'mimetype'  => $upload_info['file_type'],
						'file_size' => $upload_info['file_size'],
						'user_id'  	=> $this->data['user_details']->id
					  );
			//$image_id = $this->comman_model->save('files',$image_data);

			$ret['result']= 'success';
			//$ret['msg']= $image_id;
			$ret['msg']= $upload_info['file_name'];
		}
	    echo json_encode($ret);
		
	}

	function download($name = false){
		$data = file_get_contents('assets/uploads/videos/'.$name);
		$this->load->helper('download');
		force_download($name,$data); 
	}
	
	function delete($id){
		if(!$id)
			redirect('files');
		$check = $this->comman_model->get_by('files',array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if($check){
			$this->comman_model->delete('files',array('id'=>$id,'user_id'=>$this->data['user_details']->id));
			$this->comman_model->delete('video_voicebox',array('file_id'=>$id));
			$this->comman_model->delete('video_rating',array('file_id'=>$id));
			$this->comman_model->delete('video_like',array('file_id'=>$id));
			$this->comman_model->delete('video_favorite',array('file_id'=>$id));
			@unlink("assets/uploads/videos/".$check->file_name);
			$this->session->set_flashdata('success', 'File has successfully deleted.'); 
		}
		else{
			$this->session->set_flashdata('error', 'Sorry! You could not be delete.'); 
		}
		redirect('files');
	}

	function flag(){
		$real_client_ip_address = $this->ip_model->getRealIP();
		$visitor_location       = $this->ip_model->getLocation($real_client_ip_address);
		return $visitor_location;
		//$this->load->view('templates/flag',$data);
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */