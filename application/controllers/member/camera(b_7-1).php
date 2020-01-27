<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Camera extends Frontend_Controller{	
	public $_redirect = '/member/camera';

	public $_subView = 'user/camera/';
	public $_table_names = 'camera';
	public $_table_plan = 'plans';
	public $_table_membership = 'memberships';
	public $_mainView = 'user/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Camera';		
        $this->load->model(array('camera_model','membership_model'));
//		$this->load->library('user_agent');		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/member';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
		$this->_checkPaidUser();
        $this->data['timeszone_list'] = array('EST' => "US Eastern Standard (EST)", 'CST' => "US Central Standard (CST)",'MST' => "US Mountain Standard (MST)",'PST' => "US Pacific Standard (PST)");
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Settings';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id,'model !='=>'Custom RTSP Device',),false,false,false);
		//$this->data['all_data2'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id,'model'=>'IP Camera','payment_id !='=>0),false,false,false);
		$this->data['all_data3'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id,'model'=>'Custom RTSP Device'),false,false,false);
		
		$this->data['all_c_data'] = count($this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id,'payment_id !='=>0,'model !='=>'Custom RTSP Device','sys_file'=>0,'is_connect'=>0),false,false,false));
//		$this->data['all_c_data2'] = count($this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id,'payment_id !='=>0,'model'=>'IP Camera','sys_file'=>0,'is_connect'=>0),false,false,false));
		$this->data['all_c_data3'] = count($this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id,'payment_id !='=>0,'model'=>'Custom RTSP Device','sys_file'=>0,'is_connect'=>0),false,false,false));

		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function c_order(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Settings';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index_order';
		$this->load->view($this->_mainView,$this->data);
	}


    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->camera_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->camera_model->get_nested($this->data['user_details']->id);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }


	public function edit($id = NULL){
		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'Edit';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }
		$this->data['products'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}
		if($checkProduct->sys_file==1){
			$this->session->set_flashdata('error','Sorry!! you can not edit!!'); 			
			redirect($this->data['_cancel']);
		}

		$this->data['model_data'] 		= array('NVR'=>'NVR/DVR','IP Camera' =>'IP Camera','Custom RTSP Device'=>'Custom RTSP Device');
		$this->data['motion_data']		= array('Enable'=>'Enable','Disable' =>'Disable');
		$this->data['resolution_data'] 	= array("CIF – 352x240"=>"CIF – 352x240","VGA 640x480" =>"VGA 640x480","1MP/720p 1280x720"=>"1MP/720p 1280x720");


		$this->db->order_by('name','asc');
		$this->data['models_data'] 		= $this->comman_model->get('devices',false);

		$class_rules = array(
			'username' => array('field'=>'username', 'label'=>'username', 'rules'=>'trim'),
		);
        $this->form_validation->set_rules($class_rules);
        if($this->form_validation->run() == TRUE){
			//die;
            $data 	= array();
			$post1 =array('name','username','password','ip_address','port','channel','stream','camera_num','model','resolution','motion','url','is_mail','timeszone');
        	$data = $this->comman_model->array_from_post($post1);
			if($data['model']=='Custom RTSP Device'){
	        	$data['ip_address']= $data['port'] = $data['channel']= $data['stream']= $data['camera_num'] = '';
	        	$data['username']= $data['password'] = '';
			}
			else{
	        	$data['url'] = '';
			}

/*			$data['on_date'] 	= date('Y-m-d');
			$data['date_time'] 	= date('Y-m-d H:i:s');
//			$data['enabled'] 	= 0;
			$data['created'] 	= time();*/
			$data['modified'] 	= time();

			$this->comman_model->save($this->_table_names,$data,$id);

			$images_folder = 'camera '.$id;
			if (!is_dir('data/'.$images_folder)) {
				mkdir('./data/'.$images_folder, 0777, true);
			}

			$this->session->set_flashdata('success','Data has successfully updated.'); 
//			redirect($this->data['_cancel'].'/edit/'.$id);
			redirect($this->data['_cancel']);
        }

        $this->data['subview'] = $this->_subView.'edit';
		$this->load->view($this->_mainView,$this->data);
	}
	
    public function create(){
		
	    // Fetch a page or set a new one
		$this->data['name'] = show_static_text($this->data['lang_id'],2570).'Plan';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['month_data'] = $this->membership_model->get_day_month();

		$this->data['all_data'] = $this->comman_model->get($this->_table_plan,false);
        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['lang_id'],219));


		$this->data['models_data'] 		= $this->comman_model->get('devices',false);

		$class_rules = array(
			'username' => array('field'=>'username', 'label'=>'username', 'rules'=>'trim'),
		);
        $this->form_validation->set_rules($class_rules);
        if($this->form_validation->run() == TRUE){
			//die;
            $data 	= array();
			$post1 =array('name','username','password','ip_address','port','channel','stream','camera_num','model','m_id','resolution','motion','url','is_mail','timeszone');
        	$data = $this->camera_model->array_from_post($post1);
			$checkMembersip = $this->comman_model->get_by('memberships',array('id'=>$data['m_id']),false,false,true);
			if(!$checkMembersip){
				$this->session->set_flashdata('error','There is no plan!!!');
				redirect($this->data['_user_link'].'/camera/plan/'.$id);
			}
			
			$checkPlan = $this->comman_model->get_by('plans',array('id'=>$checkMembersip->plan_id),false,false,true);
			if(!$checkPlan){
				$this->session->set_flashdata('error','There is no plan!!!');
				redirect($this->data['_user_link'].'/camera/plan/'.$id);
			}
	

			$dealer_price = $checkMembersip->price2;

			$checkDealerPrice = $this->comman_model->get_by('plans_d',array('user_id'=>$this->data['user_details']->parent_id,'plan_id'=>$data['m_id'],'is_set'=>1),false,false,true);
			if($checkDealerPrice){
				$dealer_price = $checkDealerPrice->price;
			}

			$data['dealer_price'] = $dealer_price;

			$setPrice = $checkMembersip->price;
			$checkDealer = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id),false,false,true);
			if($checkDealer){
				if($checkDealer->is_set_price==1){
					$checkUsePrice = $this->comman_model->get_by('plans_c',array('user_id'=>$this->data['user_details']->id,'plan_id'=>$data['m_id'],'is_set'=>1),false,false,true);
					if($checkUsePrice){
						$setPrice = $checkUsePrice->price;
					}
				}
			}

			$data['price'] = $setPrice;
			$data['m_day'] = $checkMembersip->month;		

			$data['plan_id'] 	= $checkMembersip->plan_id;
			$data['fps']	 	= $checkPlan->fps;
			$data['user_id'] 	= $this->data['user_details']->id;
			$data['on_date'] 	= date('Y-m-d');
			$data['date_time'] 	= date('Y-m-d H:i:s');
//			$data['enabled'] 	= 0;
			$data['created'] 	= time();
			$data['modified'] 	= time();
			$data['modified'] 	= time();
			$data['plan_day'] 	= 3;
			$data['plan_date'] 	= date('Y-m-d');

			//check free
			$data['is_test'] 	= 1;
			$data['is_test_date'] 	= date('Y-m-d H:i:s');
			if($this->data['user_details']->free_camera>0){
				$use_free_camera = print_count('camera',array('user_id'=>$this->data['user_details']->id,'is_free_camera'=>1));
				if($use_free_camera<$this->data['user_details']->free_camera){
					$free_use = print_value2('users',array('id'=>$this->data['user_details']->parent_id),'c_days');
					if($free_use>0){
						$data['plan_day'] 	= $free_use;
					}
					$data['is_free_camera'] 	= 1;
					$data['is_test'] 	= 0;
				}
			}
//			printR($data);die;
			//redirect('admin/searchengine/edit/'.$id);
			$ids = $this->comman_model->save($this->_table_names,$data);
/*			$images_folder = 'camera '.$ids;
			if (!is_dir('data/'.$images_folder)) {
				mkdir('./data/'.$images_folder, 0777, true);
			}*/

			$images_folder = 'camera '.$ids;
			$path = $this->data['user_details']->dealer_path.'/'.$this->data['user_details']->folder_path;
			if (!is_dir('data/'.$path.'/'.$images_folder)) {
				mkdir('./data/'.$path.'/'.$images_folder, 0755, true);
			}
			$this->db->where('id', $ids);
			$this->db->set('camera_path',$path,true);
			$this->db->update('camera');			
			//die;
			//$this->session->set_flashdata('success','Camera has been added successfully. Please add/confirm payment by clicking on the orange upgrade button.'); 
			redirect($this->data['_cancel'].'/test_camera/'.$ids);
			die;
//			redirect($this->data['_user_link'].'/c_upgrade/l/'.$ids);
        }

        $this->data['subview'] = $this->_subView.'view';
		$this->load->view($this->_mainView,$this->data);
	}
	
	public function view($id = NULL){
		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'View Settings';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

		$images_folder = 'camera '.$id;
		$path = $this->data['user_details']->dealer_path.'/'.$this->data['user_details']->folder_path;
		if(!empty($checkProduct->camera_path)){
//			echo 'data/'.$checkProduct->camera_path.'/'.$images_folder;
			if (!is_dir('data/'.$checkProduct->camera_path.'/'.$images_folder)) {
				mkdir('./data/'.$checkProduct->camera_path.'/'.$images_folder, 0755, true);
			}
		}
		else{
			if (!is_dir('data/'.$path.'/'.$images_folder)) {
				mkdir('./data/'.$path.'/'.$images_folder, 0755, true);
			}
			$this->db->where('id', $checkProduct->id);
			$this->db->set('camera_path',$path,true);
			$this->db->update('camera');			
		}
		
//		die;

/*		$images_folder = 'camera '.$id;
		$path = 'data/'.$images_folder;
		if (!is_dir('data/'.$images_folder)) {
			mkdir('./data/'.$images_folder, 0777, true);
		}*/

        $this->data['subview'] = $this->_subView.'view_data';
		$this->load->view($this->_mainView,$this->data);
	}
	
	public function test_camera($id = NULL){//it use to check camera
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

		$images_folder = 'camera '.$id;
		$path = $this->data['user_details']->dealer_path.'/'.$this->data['user_details']->folder_path;
		if(!empty($checkProduct->camera_path)){
//			echo 'data/'.$checkProduct->camera_path.'/'.$images_folder;
			if (!is_dir('data/'.$checkProduct->camera_path.'/'.$images_folder)) {
				mkdir('./data/'.$checkProduct->camera_path.'/'.$images_folder, 0755, true);
			}
		}
		else{
			if (!is_dir('data/'.$path.'/'.$images_folder)) {
				mkdir('./data/'.$path.'/'.$images_folder, 0755, true);
			}
			$this->db->where('id', $checkProduct->id);
			$this->db->set('camera_path',$path,true);
			$this->db->update('camera');			
		}
		
//		die;

/*		$images_folder = 'camera '.$id;
		$path = 'data/'.$images_folder;
		if (!is_dir('data/'.$images_folder)) {
			mkdir('./data/'.$images_folder, 0777, true);
		}*/
		$this->data['subview'] = $this->_subView.'test_camera';
		
		$this->data['name'] = 'Test Camera - '.$checkProduct->name;
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->load->view($this->_mainView,$this->data);
	}
	
	public function v($id = NULL){

	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

		$images_folder = 'camera '.$id;
		$path = $this->data['user_details']->dealer_path.'/'.$this->data['user_details']->folder_path;
		if(!empty($checkProduct->camera_path)){
//			echo 'data/'.$checkProduct->camera_path.'/'.$images_folder;
			if (!is_dir('data/'.$checkProduct->camera_path.'/'.$images_folder)) {
				mkdir('./data/'.$checkProduct->camera_path.'/'.$images_folder, 0755, true);
			}
		}
		else{
			if (!is_dir('data/'.$path.'/'.$images_folder)) {
				mkdir('./data/'.$path.'/'.$images_folder, 0755, true);
			}
			$this->db->where('id', $checkProduct->id);
			$this->db->set('camera_path',$path,true);
			$this->db->update('camera');			
		}
		
		if($this->data['user_details']->play_w_pay==1){
			if($checkProduct->payment_id!=0&&$checkProduct->is_expire==0){
			}			
			else{
				$this->session->set_flashdata('error','Please upgrade your camera!!');
				redirect($this->data['_cancel']);							
			}
		}
//		die;

/*		$images_folder = 'camera '.$id;
		$path = 'data/'.$images_folder;
		if (!is_dir('data/'.$images_folder)) {
			mkdir('./data/'.$images_folder, 0777, true);
		}*/
		if ($this->agent->is_browser('Safari')) {
	        $this->data['subview'] = $this->_subView.'view_camera_safari';
		}
		else{
	        $this->data['subview'] = $this->_subView.'view_camera';
		}
		
		$this->data['name'] = 'Live Camera - '.$checkProduct->name;
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->load->view($this->_mainView,$this->data);
	}

	public function v_safari($id = NULL){
		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

		$images_folder = 'camera '.$id;
		$path = $this->data['user_details']->dealer_path.'/'.$this->data['user_details']->folder_path;
		if(!empty($checkProduct->camera_path)){
//			echo 'data/'.$checkProduct->camera_path.'/'.$images_folder;
			if (!is_dir('data/'.$checkProduct->camera_path.'/'.$images_folder)) {
				mkdir('./data/'.$checkProduct->camera_path.'/'.$images_folder, 0755, true);
			}
		}
		else{
			if (!is_dir('data/'.$path.'/'.$images_folder)) {
				mkdir('./data/'.$path.'/'.$images_folder, 0755, true);
			}
			$this->db->where('id', $checkProduct->id);
			$this->db->set('camera_path',$path,true);
			$this->db->update('camera');			
		}
		
//		die;

/*		$images_folder = 'camera '.$id;
		$path = 'data/'.$images_folder;
		if (!is_dir('data/'.$images_folder)) {
			mkdir('./data/'.$images_folder, 0777, true);
		}*/

		if ($this->agent->is_browser('Safari')) {
/*				echo 'Yes';		
				die;*/
		}

        $this->data['subview'] = $this->_subView.'view_camera_safari';
		$this->load->view($this->_mainView,$this->data);
	}
		
	function ajaxGetVideo(){
		$output =array();
		$output['status'] ='error';
		$output['v'] =0;
		$output['msge'] ='';

		$id = $this->input->post('id');
		//$id = 5;
		if($id){
			$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
			if($check){
				$output['msge'] ='There is no video!!';
				$images_folder = 'camera '.$id;
				$path = 'data/'.$images_folder;
				if (!is_dir('data/'.$images_folder)) {
					mkdir('./data/'.$images_folder, 0777, true);
				}
	
				$latest_ctime = 0;
				$tempFiles= '';    
				$latest_filename = '';    
				
				$d = dir($path);
				while (false !== ($entry = $d->read())) {
					$filepath = "{$path}/{$entry}";
					// could do also other checks than just checking whether the entry is a file
					if (is_file($filepath) && filectime($filepath) > $latest_ctime) {
						$latest_ctime = filectime($filepath);
						$tempFiles = $latest_filename;
						$latest_filename = $entry;
					}
				}				
				if($tempFiles){
					$output['status'] = 'ok';
					$output['msge'] ='';
					$output['v'] =1;
					$output['files'] = $tempFiles;
				}
			}
			else{
			}
		
		}
		echo json_encode($output);
	}

	function delete($id=false){
		ini_set("memory_limit","2512M");
		if(!$id){
			redirect($this->data['_cancel']);			
		}
		$check_product = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);
		if(!$check_product){
			$this->session->set_flashdata('error','Sorry!! You can not delete.');
			redirect($this->data['_cancel']);			
		}
		$this->db->delete($this->_table_names, array('id'=>$id,'user_id'=>$this->data['user_details']->id)); 
		if(ENVIRONMENT=='production'){
			$new_files = 'data/'.$check_product->camera_path.'/camera '.$id;
//			$new_files = 'data/camera '.$id;
		}
		else{
			$new_files = '/var/www/html/data/'.$check_product->camera_path.'/camera '.$id;
	//		$new_files = '/var/www/html/data/camera '.$id;
		}
//		$new_files = 'data/camera '.$id;
		$this->load->helper('directory');
		$this->load->helper("file");
		h_deleteDirectory($new_files.'/');
		redirect($this->data['_cancel']);			
	}
		
	
	function get_start_link2(){
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='there is some problem';
		$id = $this->input->post('id');
		if($id){
		}
		else{
			$id = $this->input->get('id');
		}
		//$id = 10;
		if($id){
			$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
			if($check){
				$cameraStart =false;
				//die;
				if($this->data['user_details']->play_w_pay==1){//if user set payment for camera
					if($check->payment_id!=0&&$check->is_expire==0){//if camera is paid and not expire
						$cameraStart =true;
					}			
					else{
					}
				}
				else{
					$cameraStart =true;
				}


				if($cameraStart){
					if($check->sys_file==0){
						if($check->model=='Custom RTSP Device'){
							$videoLink = $check->url;
							//$videoLink = 'rtsp://'.$check->ip_address.':'.$check->port.'/user='.$check->username.'&password='.$check->password.'&channel='.$check->camera_num.'&stream='.$check->stream.'.sdp';
						}
						else{
							$videoLink = 'rtsp://'.$check->ip_address.':'.$check->port.'/user='.$check->username.'&password='.$check->password.'&channel='.$check->camera_num.'&stream='.$check->stream.'.sdp';
						}
					
						$images_folder = 'camera '.$id;
	//					$path = $this->data['user_details']->camera.'/'.$this->data['user_details']->folder_path.'/'.$images_folder;
						$path = $check->camera_path.'/'.$images_folder;
						if (!is_dir('data/'.$path)) {
							mkdir('./data/'.$path, 0755, true);
						}
						//die;
						if(!empty($check->s_file)){
							$fileStart = (trim(basename($check->s_file,".m3u8"),'-').'1').'-.m3u8';
						}
						else{
							$fileStart = 'capture-.m3u8';
						}
						
	/*					echo '<br>Old: '.$check->s_file;
						echo '<br>New: '.$fileStart;die;*/
	
						$this->db->where('id',$id);
						$this->db->set('sys_file',1,true);
						$this->db->set('s_file',$fileStart,true);
						$this->db->set('is_connect',1,true);
						$this->db->set('is_worked',1,true);
						$this->db->update($this->_table_names);
	
						//old file
						//path change
						//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 "/var/www/html/data/'.$images_folder.'/'.$fileStart.'"';
						$string = 'ffmpeg -nostats -loglevel 0 -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 -r '.$check->fps.' "/var/www/html/data/'.$path.'/'.$fileStart.'"';
						//die;
						//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy "/var/www/html/data/'.$images_folder.'/capture.m3u8"';
						$output['status'] ='ok';
						exec($string,$output_d,$return);
						if (!$return) {
							$output['msge'] ='Not connected!!';
							$output['status'] ='error';
							$this->db->where('id',$id);
							$this->db->set('is_worked',0,true);
							$this->db->update($this->_table_names);
							//echo "ffmpeg work!!";
						} else {
							//echo "ffmpeg not work or some error";
							$this->db->where('id',$id);
							$this->db->set('sys_file',0,true);
							$this->db->set('is_worked',1,true);
							$this->db->update($this->_table_names);
						}
					}
					else{//if_else sysfile == 0
/*						$this->db->where('id',$id);
						$this->db->set('is_worked',0,true);
						$this->db->update($this->_table_names);*/
						$output['status'] ='ok';
						$output['msge'] ='';
					}
				}
				else{//if_else camera_start ==0 
					$output['status'] ='error';
					$output['msge'] ='Thers is no camera!!';
				}
			}
			else{
				$output['msge'] ='Thers is no camera!!';
			}
			
		}		
		echo json_encode($output);
	//	echo exec('ffmpeg -rtsp_transport tcp -i "rtsp://demo.itechproducts.info:95/user=admin&password=123456&channel=2&stream=1.sdp" -c copy -acodec aac -strict -2 -b:a 384k -map 0 -f segment -segment_time 30 -segment_format mp4 "data/capture-%03d.mp4"');
	}


	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='A'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
	}

	function _checkPaidUser(){/*
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link']);
		}
		if($this->data['user_details']->total_point>0){
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	*/}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */