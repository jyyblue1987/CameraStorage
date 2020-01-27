<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_camera extends Frontend_Controller{	
	public $_redirect = '/staff/c_camera';

	public $_subView = 'staff/camera/';
	public $_table_names = 'camera';
	public $_table_plan = 'plans';
	public $_table_membership = 'memberships';
	public $_mainView = 'staff/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'People';		
        $this->load->model(array('camera_model','membership_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/staff';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
		$this->checkPermissions('client_camera');
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Client Camera';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;


		$this->data['all_data']  = $this->comman_model->get_by('users',array('account_type'=>'A','parent_id'=>$this->data['user_details']->parent_id),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index_all';			
		$this->load->view($this->_mainView,$this->data);
	}

	function l($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
	
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Camera';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;


		
		$this->data['client_data'] = $getClient = $this->comman_model->get_by('users',array('id'=>$id,'parent_id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$getClient){
			redirect($this->data['_cancel']);
		}
		
		$this->data['all_data'] = $getClient = $this->comman_model->get_by($this->_table_names,array('user_id'=>$id,'payment_id !='=>0),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	
	public function v($id = NULL){

		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

		$this->data['client_data'] = $getClient = $this->comman_model->get_by('users',array('id'=>$checkProduct->user_id,'parent_id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$getClient){
			redirect($this->data['_cancel']);
		}

		$images_folder = 'camera '.$id;
		$path = $getClient->dealer_path.'/'.$getClient->folder_path;
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

		//die;
		if($getClient->play_w_pay==1){
			if($checkProduct->payment_id==0){
				$this->session->set_flashdata('error','Camera has not upgrade!!');
				redirect($this->data['_cancel']);							
			}
			elseif($checkProduct->is_expire==1){
				$this->session->set_flashdata('error','Camera has not upgrade!!');
				redirect($this->data['_cancel']);							
			}
		}

		if ($this->agent->is_browser('Safari')) {
	        $this->data['subview'] = $this->_subView.'view_camera_safari';
		}
		else{
	        $this->data['subview'] = $this->_subView.'view_camera';
		}
//        $this->data['subview'] = $this->_subView.'view_camera';
		$this->load->view($this->_mainView,$this->data);
	}
	

	public function edit($id = NULL){
		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'Edit';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }
		$this->data['products'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

		$this->data['client_data'] = $getClient = $this->comman_model->get_by('users',array('id'=>$checkProduct->user_id,'parent_id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$getClient){
			redirect($this->data['_cancel']);
		}

		if($checkProduct->sys_file==1){
			$this->session->set_flashdata('error','Sorry!! you can not edit!!'); 			
			redirect($this->data['_cancel'].'/l/'.$getClient->id);
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
			$post1 =array('name','username','password','ip_address','port','channel','stream','camera_num','model','resolution','motion','url','is_mail');
        	$data = $this->comman_model->array_from_post($post1);


/*			$data['on_date'] 	= date('Y-m-d');
			$data['date_time'] 	= date('Y-m-d H:i:s');
//			$data['enabled'] 	= 0;
			$data['created'] 	= time();*/
			$data['modified'] 	= time();

			$this->comman_model->save($this->_table_names,$data,$id);
			$this->session->set_flashdata('success','Data has successfully updated.'); 
			redirect($this->data['_cancel'].'/edit/'.$id);
        }

        $this->data['subview'] = $this->_subView.'edit';
		$this->load->view($this->_mainView,$this->data);
	}

	function get_start_link2(){
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='';
		$id = $this->input->post('id');
		//$id = 5;
		if($id){
			$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);			
			if($check){
				$getClient = $this->comman_model->get_by('users',array('id'=>$check->user_id,'parent_id'=>$this->data['user_details']->parent_id),false,false,true);
				if($getClient){
				//die;
					if($check->sys_file==0){	
						if($check->model=='Custom RTSP Device'){
							$videoLink = $check->url;
						}
						else{
							$videoLink = 'rtsp://'.$check->ip_address.':'.$check->port.'/user='.$check->username.'&password='.urlencode($check->password).'&channel='.$check->camera_num.'&stream='.$check->stream.'.sdp';
						}
					
						$images_folder = 'camera '.$id;
						$path = $check->camera_path.'/'.$images_folder;
						if (!is_dir('data/'.$path)) {
							mkdir('./data/'.$path, 0755, true);
						}
					
						if(!empty($check->s_file)){
							$fileStart = (trim(basename($check->s_file,".m3u8"),'-').'1').'-.m3u8';
						}
						else{
							$fileStart = 'capture-.m3u8';
						}

						$this->db->where('id',$id);
						$this->db->set('sys_file',1,true);
						$this->db->set('s_file',$fileStart,true);
						$this->db->set('is_connect',1,true);
						$this->db->update($this->_table_names);
	
						//old file
						//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy "/var/www/html/data/'.$images_folder.'/capture.m3u8"';

						$string = 'ffmpeg -nostats -loglevel 0 -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 -r '.$check->fps.' "/var/www/html/data/'.$path.'/'.$fileStart.'"';
						exec($string,$output_d,$return);
						if (!$return) {
							$output['status'] ='ok';
							//echo "ffmpeg work!!";
						} else {
							//echo "ffmpeg not work or some error";
							$this->db->where('id',$id);
							$this->db->set('sys_file',0,true);
							$this->db->update($this->_table_names);
						}
	
					
	/*					$this->db->where('id',$id);
	//					$this->db->set('sys_file',0,true);
						$this->db->update($this->_table_names);*/
						$output['msge'] ='Thers is no camera!!';
					}//sysfile =0
					else{
						$output['status'] ='ok';
					}	
				}
				else{
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
			if($this->data['user_details']->account_type!='S'){
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

	function checkPermissions($type= false){
		$redirect2 = 0;
		if($this->data['user_details']->account_type=='S'){
			$redirect2 = checkPermission('users_permission',array('user_id'=>$this->data['user_details']->id,'type'=>$type,'value'=>1));	
			if($redirect2==0){
				redirect($this->data['_user_link'].'/account');
			}		
		}
		else{
			redirect($this->data['_user_link'].'');
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */