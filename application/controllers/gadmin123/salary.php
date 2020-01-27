<?php
class Salary extends Admin_Controller{
	public $_table_names = 'a_salary';

	public $_mainView = 'admin/_layout_main';
	public $_subView = 'admin/salary/';

	public $_redirect = '/salary';

	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Expenses Managment';
        $this->load->model(array('product_model'));
        // Get language for content id to show in administration

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
		$this->checkPermissions('salary');

	}
    	
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1700).'Salary';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);


	}

    public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id)
        {
			redirect($this->data['_cancel']);				
			$this->data['name'] = 'Salary';
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
			$this->db->where('user_id',$this->data['user_details']->id);
			$this->data['products'] = $this->product_model->get_lang($id, FALSE, $this->data['adminLangSession']['lang_id']);
			if(!$this->data['products']){
	            redirect($this->data['_cancel']);				
			}

        }
        else
        {
			$this->data['name'] = 'Salary';
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['products'] = $this->product_model->get_stock();
	
        }
		
		$this->data['customer_data'] = $this->comman_model->get_by('admin',array('default'=>'0','role !='=>'Super Admin'),false,false,false);

		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));

        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		$rules = array(
			'price' 		=> array('field'=>'price', 'label'=>'Salary', 'rules'=>'trim|numeric|required'),
	   );
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post1 		= array('emp_id','price','description','account_num');
        	$post_data	= $this->comman_model->array_from_post($post1);

			//$post_data['dates']	= h_dateFormat($this->input->post('dates'),'Y-m-d');
/*			echo '<pre>';
			print_r($_POST);
			echo '</pre>';
*/			
			$post_data['admin_id']		= $this->data['admin_details']->id;
//			$post_data['order_number'] 	= h_orderNumber('users_salary','REEO',5);
			$post_data['on_date'] 		= date('Y-m-d');
			$post_data['date_time'] 	= date('Y-m-d H:i:s');
/*			echo '<pre>';
			print_r($post_data);
			die;*/
			$id = $this->comman_model->save($this->_table_names,$post_data);
		//	$this->generate_pdf($id);
			if(empty($this->data['product']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            
			redirect($this->data['_cancel']);
			//redirect($this->data['_cancel'].'/edit/'.$id);
        }
		else{
		}

        $this->data['subview'] = $this->_subView.'edit';			
		$this->load->view($this->_mainView,$this->data);
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
            $this->product_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->product_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    public function search_ajax(){
        // Save order from ajax call
		$title = $this->input->post('title');
        if (isset($_POST['sortable'])) {
            $this->product_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
		$this->db->like('title',$title);
        $this->data['pages'] = $this->product_model->get_nested($this->data['content_language_id']);
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
            $this->product_model->save_order($_POST['sortable']);
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
				$this->product_model->delete($id);		
			}
			else{
	            $this->session->set_flashdata('error','Sorry ! You can not delete.');
			}
		}
		else{
			$this->product_model->delete($id);		
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
			redirect($this->data['admin_link'].'');
		}		
	}

}