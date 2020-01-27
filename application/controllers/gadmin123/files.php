<?php
class Files extends Admin_Controller {
	
    public $_current_revision_id;
    
    public function __construct(){
		parent::__construct();       
        $this->load->model('comman_model');
        $this->load->model('product_file_model');
	}
    
    public function index($page = NULL){
        exit();
    }
    
    public function download($repository_id, $revision_id)
    {
        $this->load->library('zip');
        $this->load->helper('file');
        
        // Fetch all files by repository_id
        $files = $this->product_file_model->get_by(array(
            'repository_id' => $repository_id
        ));
        
        // Add all files to zip archive
        foreach($files as $file)
        {
            $name = $revision_id.'/'.$file->filename;
            $data = read_file(dirname($_SERVER['SCRIPT_FILENAME']).'/files/'.$revision_id.'/'.$file->filename);
            
            $this->zip->add_data($name, $data); 
        }
        
        $this->zip->download('file_repository_'.$repository_id.'.zip'); 
    }
    

    public function order($page_or_param, $model = 'page_m'){
        $data = array();
		$files = $this->comman_model->get_by('product_files',array('product_id' => $page_or_param),false,false,false);
		foreach($_POST['order'] as $order=>$filename){
			foreach($files as $file)
			{
				if($filename == $file->filename){
					$this->comman_model->save('product_files',array('order' => $order,),$file->id);
					break;
				}
			}
		}
        echo json_encode($data);
	}

    public function order1($page_or_param, $model = 'page_m'){
        $this->load->model($model);
        
        $data = array();
        
        $page_id = NULL;
        
        if(is_numeric($page_or_param))
        {
            $page_id = $page_or_param;
            
    	    // Fetch page
    		$page = $this->$model->get($page_id, TRUE);
            
            // Fetch file repository
            $repository_id = $page->repository_id;
        }
        else if($page_or_param == 'data-files')
        {
            // Fetch all parameters
            $this->data['parameters'] = $this->parameters_m->get_parameters();
            
            $repository_id = $this->data['parameters']['additional-files'];
        }

        // Fetch all files by repository_id
        $files = $this->product_file_model->get_by(array(
            'repository_id' => $repository_id
        ));
        
        /* +++ Security check for USER +++ */
        if($this->session->userdata('type') == 'USER')
        {
            $user_id = $this->session->userdata('id');
            
            // Find property with this repository_id
            $this->load->model('estate_m');
            $estates = $this->estate_m->get_by(array('repository_id'=>$repository_id));
            if(count($estates) == 0)
            {
                exit();
            }
            
            // Check if user is owner of property
            $this->db->where(array('property_id' => $estates[0]->id,
                                   'user_id' => $user_id));
            $this->db->from('property_user');
            if($this->db->count_all_results() == 0)
            {
                exit();
            }
        }
        /* +++ End security check for USER +++ */
        
        // Update all files with order value
        if(isset($_POST['order']) && config_item('app_type') != 'demo')
        foreach($_POST['order'] as $order=>$filename)
        {
            foreach($files as $file)
            {
                if($filename == $file->filename)
                {
                    $this->product_file_model->save(array(
                        'order' => $order,
                    ), $file->id);
                    break;
                }
            }
        }
        
        echo json_encode($data);
    }
    
    public function upload_slideshow($slideshow_or_param = NULL) 
    {
        return $this->upload($slideshow_or_param, 'slideshow_m');
    }

    public function upload_gallery($gallery_or_param = NULL) 
    {
        return $this->upload($gallery_or_param, 'gallery_m');
    }


    public function upload_estate($estate_or_param = NULL) 
    {
        return $this->upload($estate_or_param, 'estate_m');
    }
    
    public function upload_user($estate_or_param = NULL) 
    {
        return $this->upload($estate_or_param, 'user_m');
    }
    

    public function upload_files($page_or_param = NULL, $model = 'product_model'){
        $modelinput = $this->input->post('model');
        if($modelinput){
            $model = $modelinput;
        }

        $this->load->model($model);        
        $page_id = NULL;        
        $repository_id = NULL;        
        if(is_numeric($page_or_param)){
            // Files for page
            $page_id = $page_or_param;
    	    // Fetch page
    		$page = $this->$model->get($page_id, TRUE);
            // Fetch file repository
            $repository_id = $page->id;
        }

        /* +++ Security check for USER +++ */
        /* +++ End security check for USER +++ */
        // Upload Handler
        $this->load->library('uploadHandler1', array( 'options'=>array('script_url' => site_url('admin/files/upload_files').'/',
                                                     'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']).'/files/'.$this->_current_revision_id.'/',
                                                     'upload_url' => base_url('/files/'.$this->_current_revision_id).'/'),
                                                     'initialize'=>false,
                                                     ));
        

        if($_SERVER['REQUEST_METHOD'] == 'DELETE')
        {
            $this->uploadhandler1->initialize(true);          
            
            if(substr($page_or_param, 0, 4) == 'rep_')
            {
                $repository_id = substr($page_or_param, 4);
                
                $file = $this->comman_model->get_by('product_files',array(
                    'filename' => $this->uploadhandler1->get_file_name_param(),
                    'product_id' => $repository_id
                ),false,false,TRUE);
                
                $this->comman_model->delete('product_files',array('id'=>$file->id));
            }

            exit();
        }
        else if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $response = $this->uploadhandler1->initialize(false);
            
            if(isset($response['files']))
            {
                foreach($response['files'] as $file)
                {
                    
                    $file->thumbnail_url = base_url('assets/templates/images/icons/filetype/_blank.png');
                    $file->zoom_enabled = false;
                //    $filena = str_replace(" ", "_", $file->name);
                    $filena = $file->name;
                    $file->delete_url = site_url('admin/files/upload_files/rep_'.$repository_id).'?file='.rawurlencode($filena);
                    if(file_exists(FCPATH.'/files/'.$this->_current_revision_id.'/thumbnail/'.$file->name))
                    {
                        $file->thumbnail_url = base_url('files/'.$this->_current_revision_id.'/thumbnail/'.$filena);
                        $file->zoom_enabled = true;
                    }
                    else if(file_exists(FCPATH.'assets/templates/images/icons/filetype/'.get_file_extension($filena).'.png'))
                    {
                        $file->thumbnail_url = base_url('assets/templates/images/icons/filetype/'.get_file_extension($filena).'.png');
                    }
                    
                    $file->short_name = character_hard_limiter($filena, 20);
                    
                    $next_order = $this->product_file_model->get_max_order()+1;
                    
                    $response['orders'][$filena] = $next_order;
                    
                    // Add file to repository
                    $file_id = $this->comman_model->save('product_files',array(
                        'product_id' => $repository_id,
                        'order' => $next_order,
                        'filename' => $filena,
                        'filetype' => $file->type
                    ));
    
                }
            }
            

            $this->uploadhandler1->generate_response($response);
        }
        exit();
    }

    public function upload($page_or_param = NULL, $model = 'page_m') 
    {
        //if(config_item('app_type') == 'demo')
        //    exit();
        $modelinput = $this->input->post('model');
        if($modelinput){
            $model = $modelinput;
        }

       
        $this->load->model($model);
        
        $page_id = NULL;
        
        $repository_id = NULL;
        
        if(is_numeric($page_or_param))
        {
            // Files for page
            $page_id = $page_or_param;
            
    	    // Fetch page
    		$page = $this->$model->get($page_id, TRUE);
            
            // Fetch file repository
            $repository_id = $page->repository_id;
            if(empty($repository_id))
            {
                // Create repository
                $repository_id = $this->repository_m->save(array('name'=>$model));
                
                // Update page with new repository_id
                $this->$model->save(array('repository_id'=>$repository_id), $page->id);
            }
        }

        /* +++ Security check for USER +++ */
        if($this->session->userdata('type') == 'USER')
        {
            if(substr($page_or_param, 0, 4) == 'rep_')
            {
                $repository_id = substr($page_or_param, 4);
            }
            
            if($repository_id == NULL){
                exit();
            }
            
            $user_id = $this->session->userdata('id');
            
            // Find property with this repository_id
            $this->load->model('estate_m');
            $estates = $this->estate_m->get_by(array('repository_id'=>$repository_id));
            if(count($estates) == 0)
            {
                exit();
            }
            
            // Check if user is owner of property
            $this->db->where(array('property_id' => $estates[0]->id,
                                   'user_id' => $user_id));
            $this->db->from('property_user');
            if($this->db->count_all_results() == 0)
            {
                exit();
            }
        }
        /* +++ End security check for USER +++ */
        

        // Upload Handler
        $this->load->library('uploadHandler', array( 'options'=>array('script_url' => site_url('files/upload').'/',
                                                     'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']).'/files/'.$this->_current_revision_id.'/',
                                                     'upload_url' => base_url('/files/'.$this->_current_revision_id).'/'),
                                                     'initialize'=>false,
                                                     ));
        
        if($_SERVER['REQUEST_METHOD'] == 'DELETE')
        {
            $this->uploadhandler->initialize(true);          
            
            if(substr($page_or_param, 0, 4) == 'rep_')
            {
                $repository_id = substr($page_or_param, 4);
                
                $file = $this->product_file_model->get_by(array(
                    'filename' => $this->uploadhandler->get_file_name_param(),
                    'repository_id' => $repository_id
                ), TRUE);
                
                $this->product_file_model->delete($file->id);
            }

            exit();
        }
        else if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
//            $response = $this->uploadhandler->initialize(false);
//            
//            // Get all files of page
//            $files = $this->product_file_model->get_by(array(
//                'repository_id' => $repository_id,
//            ));
//            
//            // Generate new list of ordered files
//            $ordered_files = array();
//            if(isset($response['files']))
//            {
//                foreach($files as $file)
//                {
//                    foreach($response['files'] as $key => $response_file)
//                    {
//                        if($file->filename == $response_file->name)
//                        {
//                            //$response_file->thumbnail_url = '';
//                            $ordered_files[] = $response_file;
//                        }
//                    }
//                }
//            }
//            $response['files'] = $ordered_files;
//            
//            // Send to output
//            $this->uploadhandler->generate_response($response);
        }
        else if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $response = $this->uploadhandler->initialize(false);
            
            if(isset($response['files']))
            {
                foreach($response['files'] as $file)
                {
    //                object(stdClass)#27 (7) {
    //                    ["name"]=>
    //                    string(9) "1 (1).gif"
    //                    ["size"]=>
    //                    int(33308)
    //                    ["type"]=>
    //                    string(9) "image/gif"
    //                    ["url"]=>
    //                    string(57) "http://localhost/BeforeConstruction/files/1%20%281%29.gif"
    //                    ["thumbnail_url"]=>
    //                    string(67) "http://localhost/BeforeConstruction/files/thumbnail/1%20%281%29.gif"
    //                    ["delete_url"]=>
    //                    string(57) "http://localhost/BeforeConstruction/?file=1%20%281%29.gif"
    //                    ["delete_type"]=>
    //                    string(6) "DELETE"
    //                }
                    
                    $file->thumbnail_url = base_url('assets/templates/images/icons/filetype/_blank.png');
                    $file->zoom_enabled = false;
                //    $filena = str_replace(" ", "_", $file->name);
                    $filena = $file->name;
                    $file->delete_url = site_url('files/upload/rep_'.$repository_id).'?file='.rawurlencode($filena);
                    if(file_exists(FCPATH.'/files/'.$this->_current_revision_id.'/thumbnail/'.$file->name))
                    {
                        $file->thumbnail_url = base_url('files/'.$this->_current_revision_id.'/thumbnail/'.$filena);
                        $file->zoom_enabled = true;
                    }
                    else if(file_exists(FCPATH.'assets/templates/images/icons/filetype/'.get_file_extension($filena).'.png'))
                    {
                        $file->thumbnail_url = base_url('assets/templates/images/icons/filetype/'.get_file_extension($filena).'.png');
                    }
                    
                    $file->short_name = character_hard_limiter($filena, 20);
                    
                    $next_order = $this->product_file_model->get_max_order()+1;
                    
                    $response['orders'][$filena] = $next_order;
                    
                    // Add file to repository
                    $file_id = $this->product_file_model->save(array(
                        'repository_id' => $repository_id,
                        'order' => $next_order,
                        'filename' => $filena,
                        'filetype' => $file->type
                    ));
    
                }
            }
            
            
            $this->uploadhandler->generate_response($response);
        }
        exit();
    }


    public function delete_f(){
       // Upload Handler
        $this->load->library('uploadHandler', array( 'options'=>array('script_url' => site_url('files/upload').'/',
                                                     'upload_dir' => dirname($_SERVER['SCRIPT_FILENAME']).'/files/'.$this->_current_revision_id.'/',
                                                     'upload_url' => base_url('/files/'.$this->_current_revision_id).'/'),
                                                     'initialize'=>false,
                                                     ));
       $page_or_param = NULL;
       $response = $this->uploadhandler->initialize(true);        
         
        $repository_id = substr($this->input->post('rep'), 4);
        
                $file = $this->product_file_model->get_by(array(
                    'filename' => $this->input->post('filename'),
                    'repository_id' => $repository_id
                ), TRUE);
                
                $this->product_file_model->delete($file->id);
        $this->uploadhandler->generate_response($response);        
          echo json_encode($response); 
        exit();
    }
	
	public function upload_editor_image(){
		echo 'sdf';
		die;
		$url = base_url().'uploads/'.time()."_".$_FILES['upload']['name'];
		if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
		{
		   $message = "No file uploaded.";
		}
		else if ($_FILES['upload']["size"] == 0)
		{
		   $message = "The file is of zero length.";
		}
		else if (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png"))
		{
		   $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
		}
		else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
		{
		   $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
		}
		else {
		  $message = "";
		  $move = @ move_uploaded_file($_FILES['upload']['tmp_name'], $url);
		  if(!$move)
		  {
			 $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
		  }
		  $url = $url;
		}
		$funcNum = $_GET['CKEditorFuncNum'] ;
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>";	
	}
}
