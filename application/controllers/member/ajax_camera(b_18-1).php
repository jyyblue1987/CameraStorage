<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_camera extends Frontend_Controller{	
	public $_redirect = '/member/ajax_camera';
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
	}

	function get_start_camera(){
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='there is some problem';
		$id = $this->input->get('id');
		//$id = 10;
		if($id){
			$check = $this->comman_model->get_by('camera',array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
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
							//$videoLink = 'rtsp://'.$check->ip_address.':'.$check->port.'/user='.$check->username.'&password='.urlencode($check->password).'&channel='.$check->camera_num.'&stream='.$check->stream.'.sdp';
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
						$this->db->set('is_worked',1,true);
						$this->db->update('camera');
	
						//old file
						//path change
						//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 "/var/www/html/data/'.$images_folder.'/'.$fileStart.'"';
						$string = 'ffmpeg -nostats -loglevel 0 -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 -r '.$check->fps.' "/var/www/html/data/'.$path.'/'.$fileStart.'" > /dev/null 2>&1 &';
						if(ENVIRONMENT=='production'){
							$string = 'ffmpeg -nostats -loglevel 0 -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 -r '.$check->fps.' "'.FCPATH.'/data/'.$path.'/'.$fileStart.'" > /dev/null 2>&1 &';
						}
						//echo $string;die;
						//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy "/var/www/html/data/'.$images_folder.'/capture.m3u8"';
						$output['status'] ='ok';
						$output['msge'] ='';
						exec($string,$output_d,$return);
						if (!$return) {
/*							$this->db->where('id',$id);
							$this->db->set('is_connect',0,true);
							$this->db->set('is_worked',1,true);
							$this->db->update('camera');*/
							//echo "ffmpeg work!!";
						} else {
							$output['msge'] ='Not connected!!';
							$output['status'] ='error';
							//echo "ffmpeg not work or some error";
							$this->db->where('id',$id);
							$this->db->set('sys_file',0,true);
							$this->db->set('is_connect',0,true);
							$this->db->set('is_worked',1,true);
							$this->db->update('camera');
						}
					}
					else{//if_else sysfile == 0
/*						$this->db->where('id',$id);
						$this->db->set('sys_file',0,true);
						$this->db->set('is_connect',0,true);
						$this->db->set('is_worked',0,true);
						$this->db->update('camera');*/
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
	}
	
	function check_file(){
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='there is some problem';
		$id = $this->input->get('id');
		//$id = 10;
		if($id){
			$check = $this->comman_model->get_by('camera',array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
			if($check){
				$images_folder = $check->camera_path.'/camera '.$check->id;
				$path = 'data/'.$images_folder;
				$get_last_file = $this->scan_last_dir($path);
				$nowTime = time();	
				if($get_last_file){
					$output['status'] ='ok';
					$output['msge'] ='';
				}
				else{
					$output['msge'] ='live camera not working. Please update your camera.';
				}
			}
			else{
				$output['msge'] ='Thers is no camera!!';
			}
			
		}		
		echo json_encode($output);
	//	echo exec('ffmpeg -rtsp_transport tcp -i "rtsp://demo.itechproducts.info:95/user=admin&password=123456&channel=2&stream=1.sdp" -c copy -acodec aac -strict -2 -b:a 384k -map 0 -f segment -segment_time 30 -segment_format mp4 "data/capture-%03d.mp4"');
	}


	function scan_last_dir($dir) {
		ini_set('max_execution_time', 0);
		ini_set("memory_limit","-1");
		$ignored = array('.', '..', '.svn', '.htaccess','capture.m3u8','.mp4');
		$files = array();    
		$i=0;
		foreach (scandir($dir) as $file) {
			if (in_array($file, $ignored)) continue;
			if(preg_match("/\.(mp4|m3u8|jpg)$/", $file)){
				continue;
			}
//			echo '<br>'.$dir.'/'.$file;
			if(is_dir($dir.'/'.$file)){
//				echo 'yes';
				continue;
			}
//			echo '<br>as: '.$file;
			$files[$file] = filemtime($dir . '/' . $file);
		}
	    asort($files);
	//    arsort($files);
		$files = array_keys($files);
	
		return ($files) ? $files : false;
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
			exit('No direct script access allowed');
		}
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */