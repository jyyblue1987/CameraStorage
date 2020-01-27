<?php
class Plan extends Admin_Controller{
	public $_table_names = 'plans';
	public $_subView = 'admin/plans/';
	public $_redirect = '/plan';
    public $_current_revision_id;
	public function __construct(){
		parent::__construct();
		$this->checkPermissions('plans');
		
		$this->data['active'] = 'Membership Management';
        $this->load->model(array('plan_model'));
        // Get language for content id to show in administration

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
	}
    	
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1700).'Plan';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

   		$this->data['table'] = true;

		$this->db->order_by('id','desc');	
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		//echo $this->db->last_query();die;
/*		$count = count($this->data['all_data']);
		$r_from = $page <= 1 ? 1 : ($page -1) * $config["per_page"]+1; //RANGE STARTS FROM 
		$r_to   = $r_from + $count - 1;    //RANGE ENDS TO
		$this->data['range'] = $count? "Showing ".$r_from." to ".$r_to." of ".$config["total_rows"]:'';*/
		//echo $this->db->last_query();die;
		//die;
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}

    public function edit($id = NULL){

		$all_session =$this->session->all_userdata();
	    // Fetch a page or set a new one
	    if($id)
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			if($this->data['admin_details']->default=='0'){
				$this->data['products']= $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'admin_id'=>$this->data['admin_details']->id),false,false,true);
				if(!$checkProduct){
					redirect($this->data['_cancel']);				
				}
			}
			else{
			$this->data['products']= $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			}
			if(!$this->data['products']){
	            redirect($this->data['_cancel']);				
			}

        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['products'] = $this->plan_model->get_new();
			$this->data['category_selected'] = array();
	
        }


        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));

        $rules = $this->plan_model->rules;
        $this->form_validation->set_rules($this->plan_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
			$post1 =array('name','description','fps');
        	$data = $this->plan_model->array_from_post($post1);

            if($id == NULL)$data['order'] = $this->plan_model->max_order()+1;
            $data_lang = $this->plan_model->array_from_post($this->plan_model->get_lang_post_fields());
            if($id == NULL){
                $data['admin_id'] = $this->data['admin_details']->id;
                $data['on_date'] = date('Y-m-d');
                $data['date_time'] = date('Y-m-d H:i:s');
                $data['created_by'] = 'admin';
                $data['enabled'] = 1;
                $data['status'] = 1;
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
			//file1
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/products');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
			}	
			else{
				 if($id != NULL)$data['image'] = $this->data['products']->image;
			}

//            $id = $this->plan_model->save_with_lang($data, $data_lang, $id);
            $id = $this->comman_model->save($this->_table_names,$data,$id);

			if(empty($this->data['products']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            
			$this->session->unset_userdata('image_session');
//            redirect($this->data['_cancel'].'/edit/'.$id);
            redirect($this->data['_cancel']);
        }

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	function set_value(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		if($type=='section'){
			$post_data = array('section'=>$value);
			$result = $this->comman_model->save($this->_table_names,$post_data,$id);
			
		}
		else if($type=='user_id'){
			$post_data = array('user_id'=>$value);
			$result = $this->comman_model->save($this->_table_names,$post_data,$id);					
		}	
	}

	function get_active(){
		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		$check_data = $this->comman_model->get_by('products',array('id'=>$id),false,false,true);
		if($check_data){
			if($type=='enabled'){
				if($check_data->enabled==1){
					$post_data = array('enabled'=>0);
				}
				elseif($check_data->enabled==0){
					$post_data = array('enabled'=>1);
				}
				else{
					$post_data = array('enabled'=>1);
				}
				$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
			}
			if($type=='feature'){
				if($check_data->is_feature==1){
					$post_data = array('is_feature'=>0);
				}
				elseif($check_data->is_feature==0){
					$post_data = array('is_feature'=>1);
				}
				else{
					$post_data = array('is_feature'=>1);
				}
				$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
			}
		}
	}

    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->plan_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->plan_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    public function search_ajax(){
        // Save order from ajax call
		$title = $this->input->post('title');
        if (isset($_POST['sortable'])) {
            $this->plan_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
		$this->db->like('title',$title);
        $this->data['pages'] = $this->plan_model->get_nested($this->data['content_language_id']);
		//echo $this->db->last_query();
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

	
	function get_status(){
		$id = $this->input->post('id');
		$post_data = array('enabled'=>$this->input->post('enabled'));
		$result = $this->comman_model->save($this->_table_names,$post_data,$id);
	}

    public function file_order($id){
        $data = array();
		$files = $this->comman_model->get_by('product_files',array('product_id' => $id),false,false,false);
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

    
    public function order()
    {
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
    }
    

    public function update_link(){
        $post = array();
        $post['id'] = $this->input->post('id');
        $post['link'] = $this->input->post('links');
        $id = $this->input->post('id');
        $link = $this->input->post('links');

       
        $id = $this->comman_model->save('product_files',array('link'=>$link),$id);
        if($id>0){
            $data['message'] = 'Success Updating Description';
            $data['status'] = true;
        }else{
            $data['message'] = 'Error Updating Description';
            $data['status'] = false;
        }
        $length = strlen(json_encode($post));
        header('Content-Type: application/json; charset=utf8');
        header('Content-Length: '.$length);
        echo json_encode($data);
        exit();
    }


    public function update_ajax($filename = NULL)
    {
        // Save order from ajax call
        if(isset($_POST['sortable']) && $this->config->item('app_type') != 'demo')
        {
            $this->plan_model->save_order($_POST['sortable']);
        }
        
        $data = array();
        $length = strlen(json_encode($data));
        header('Content-Type: application/json; charset=utf8');
        header('Content-Length: '.$length);
        echo json_encode($data);
        
        exit();
    }

	function ajax_upload(){		
		$this->load->helper('string');
		$id = $this->input->post('id');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/products';
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
			
		}
	    echo json_encode($ret);		
	}

	function refresh(){
		$id = $this->input->post('id');
	   echo '<div class="product-item col-md-3" style="padding:4px;margin:5px;width:23%" >
        <div class="pi-img-wrapper">
	        <img style="height:100px;width:100%" alt="" class="img-responsive" src="assets/uploads/products/'.$id.'"></a>
        </div></div>';
	}

	function delete_image(){
		$id = $this->input->post('id');
		$check_image = $this->comman_model->get_by('product_files',array('id'=>$id),false,false,true);
		if($check_image){
			$this->comman_model->delete('product_files',array('id'=>$id));
			$image = 'assets/uploads/products/'.$check_image->filename;
			if(is_file($image))
    	    	unlink($image);
		}
	}

        
    public function delete($id){       
		if($this->data['admin_details']->default=='0'){
			$checkProduct = $this->comman_model->get_lang('products',$this->data['content_language_id'],NULL,array('id'=>$id,'admin_id'=>$this->data['admin_details']->id),'product_id',true);
			if($checkProduct){
				$this->plan_model->delete($id);		
			}
			else{
	            $this->session->set_flashdata('error','Sorry ! You can not delete.');
			}
		}
		else{
			$this->plan_model->delete($id);		
		}

        redirect($this->data['_cancel']);
	}
    
    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current categories
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('code'));
        !$id || $this->db->where('id !=', $id);        
        $categories = $this->comman_model->get('products',false);        
	//	echo $this->db->last_query();die;
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }


	function import(){	
		$image = NULL;

		$this->data['name'] = 'Import';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$rules = $this->admin_model->product_rules;
		$this->form_validation->set_rules($rules);
		if ($this->input->post('operation')){
			$config['upload_path'] = 'assets/uploads/csv/';
			$config['allowed_types'] = 'csv';
	        $config['max_size'] = '30000';
			$this->load->library('upload', $config);
			// If upload failed, display error
			if (!$this->upload->do_upload()) {
				$this->session->set_flashdata('error',$this->upload->display_errors()); 
	            redirect($this->data['_cancel'].'/import');
			} 
			else {
				$file_data = $this->upload->data();
				$file_path =  './assets/uploads/csv/'.$file_data['file_name'];
				$many_lang = $this->comman_model->get('language',false);
				if ($this->csvimport->get_array($file_path)) {
					$csv_array = $this->csvimport->get_array($file_path);
					foreach($csv_array as $row){
						$post_data = array();
						$post_data['store_id'] = 0;
						$checkUser = $this->comman_model->get_by('users',array('email'=>$row['email']),false,false,true);
						if($checkUser){
							$checkStore = $this->comman_model->get_by('stores',array('user_id'=>$checkUser->id),false,false,true);
							if($checkStore){
								$post_data['store_id'] = $checkStore->id;
							}					
						}				
						$post_data['price'] 			= $row['price'];
						$post_data['discount_price']	= $row['discount'];
						$post_data['category_id'] 		= $row['category_id'];
						$post_data['sub_category_id']	= $row['sub_category_id'];
		
						$id = $this->comman_model->save('products',$post_data);
						if($many_lang){
							foreach($many_lang as $set_lang){		
								$post_lang_data = array(
										'product_id'=>$id,
										'language_id'=>$set_lang->id,
										'title'=>$row['name'],
										'body'=>$row['description']							
										);
										
								$this->comman_model->add('products_lang',$post_lang_data);
							}
						}
					}
					$this->session->set_flashdata('success','Data has successfully import'); 
			
				}				
				else {
					$this->session->set_flashdata('error','There is some problem in file.'); 
				}
	            redirect($this->data['_cancel'].'/import');
			}	
		}
		//$this->data['login'] = $this->session->all_userdata();
		
		$this->data['subview'] = $this->_subView.'upload_csv';
        $this->load->view('admin/_layout_main', $this->data);
	}

	function import2(){	
		$file_path =  'assets/1.csv';
		echo '<pre>';
		die;
		$many_lang = $this->comman_model->get('language',false);
		if ($this->csvimport->get_array($file_path)) {
			$csv_array = $this->csvimport->get_array($file_path);
			foreach($csv_array as $row){
				$post_data = array();
				$post_data['store_id'] = 0;
				$checkUser = $this->comman_model->get_by('users',array('email'=>$row['email']),false,false,true);
				if($checkUser){
					$checkStore = $this->comman_model->get_by('stores',array('user_id'=>$checkUser->id),false,false,true);
					if($checkStore){
						$post_data['store_id'] = $checkStore->id;
					}					
				}				
				$post_data['price'] 			= $row['price'];
				$post_data['discount_price']	= $row['discount'];
				$post_data['category_id'] 		= $row['category_id'];
				$post_data['sub_category_id']	= $row['sub_category_id'];

				$id = $this->comman_model->save('products',$post_data);
				if($many_lang){
					foreach($many_lang as $set_lang){		
						$post_lang_data = array(
								'product_id'=>$id,
								'language_id'=>$set_lang->id,
								'title'=>$row['name'],
								'body'=>$row['description']							
								);
								
						$this->comman_model->add('products_lang',$post_lang_data);
					}
				}
			}
		}
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
			redirect($this->data['admin_link'].'/dashboard');
		}		
	}
	
}