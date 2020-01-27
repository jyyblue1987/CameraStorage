<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Camera extends Frontend_Controller{	
	public $_redirect = '/user/camera';

	public $_subView = 'employee/camera/';
	public $_table_names = 'camera';
	public $_table_plan = 'plans';
	public $_mainView = 'employee/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Camera';		
        $this->load->model(array('camera_model','membership_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/user';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Settings';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->parent_id,'model !='=>'Custom RTSP Device','payment_id !='=>0),false,false,false);
		$this->data['all_data2'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->parent_id,'model'=>'IP Camera','payment_id !='=>0),false,false,false);
		$this->data['all_data3'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->parent_id,'model'=>'Custom RTSP Device','payment_id !='=>0),false,false,false);
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
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

		$checkClient = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$checkClient){
			redirect($this->data['_cancel']);
		}
		
		$images_folder = 'camera '.$id;
		$path = $checkClient->dealer_path.'/'.$checkClient->folder_path;
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

		if($checkClient->play_w_pay==1){
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
	
	function get_start_link2(){
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='';
		$id = $this->input->post('id');
	//	$id = 5;
		if($id){
			$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->parent_id),false,false,true);
			if($check){
				//die;
				if($check->sys_file==0){

					if($check->model=='Custom RTSP Device'){
						$videoLink = $check->url;
					}
					else{
						$videoLink = 'rtsp://'.$check->ip_address.':'.$check->port.'/user='.$check->username.'&password='.urlencode($check->password).'&channel='.$check->camera_num.'&stream='.$check->stream.'.sdp';
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
					$this->db->update($this->_table_names);

					//old file
					//path change
					//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 "/var/www/html/data/'.$images_folder.'/'.$fileStart.'"';
					$string = 'ffmpeg -nostats -loglevel 0 -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 -r '.$check->fps.' "/var/www/html/data/'.$path.'/'.$fileStart.'"';
					//die;
					//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy "/var/www/html/data/'.$images_folder.'/capture.m3u8"';
					exec($string,$output_d,$return);
					if (!$return) {
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
				}
				else{
					$output['status'] ='ok';
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
			if($this->data['user_details']->account_type!='E'){
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


}

/* End of file user.php */
/* Location: ./application/controllers/user.php */