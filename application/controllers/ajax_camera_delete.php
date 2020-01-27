<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('max_execution_time', 0);
ini_set("memory_limit","-1");

class Ajax_camera_delete extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['set_meta'] = '';	
        $this->data['settings'] = $this->settings_model->get_fields();
		date_default_timezone_set("America/Cancun"); 
		$this->load->helper(array('directory','custom',"file"));

	}


	function ajax_deleted_camera_files(){//check connect is loss or not file 
		$output['status'] ='ok';
		$string = "select * from camera_deleted";
		$camera = $this->comman_model->get_query($string,false);
		if($camera){
			foreach($camera as $set_camera){
				$images_folder = 'camera '.$set_camera->camera_id;
				$path = $set_camera->camera_path.'/'.$images_folder;
				if (!is_dir('data/'.$path)) {
				}
				else{
					if(ENVIRONMENT=='production'){
						$new_files = 'data/'.$set_camera->camera_path.'/camera '.$set_camera->camera_id;
					}
					else{
						$new_files = '/var/www/html/data/'.$set_camera->camera_path.'/camera '.$set_camera->camera_id;
					}
					h_deleteDirectory($new_files.'/');
				}
			}
		}
		echo json_encode($output);
	}

	function ajax_deleted_days_files(){//check connect is loss or not file 
		$nowdDate = date('Y-m-d H:i:s');
		$nowTime = time();
		$output['status'] ='ok';
		$string = "select id,m_day,camera_path from camera";
		$camera = $this->comman_model->get_query($string,false);
		if($camera){
			foreach($camera as $set_camera){
///				$enable_date = $this->data['disabled_date'] = h_get_playback_date(date('Y-m-d'),$set_camera->m_day,'m-d-Y');
				$prevoiusdate  = h_minusDate(date('Y-m-d'),'day',($set_camera->m_day),'Y-m-d').' 00:00:00';
			//	$prevoiusdate  = '2018-12-15 04:39:00';//for test
				//$prevoiusdateString  = h_minusDate(date('Y-m-d'),'day',($set_camera->m_day),'d-m-Y').' 00:00:00';
				
				$images_folder = 'camera '.$set_camera->id;
				$path = $set_camera->camera_path.'/'.$images_folder;
				if (is_dir('data/'.$path)) {
					if(ENVIRONMENT=='production'){
						$new_files = 'data/'.$set_camera->camera_path.'/camera '.$set_camera->id;
					}
					else{
						$new_files = '/var/www/html/data/'.$set_camera->camera_path.'/camera '.$set_camera->id;
					}
					$this->scan_dir('data/'.$path,$prevoiusdate,$nowdDate);//for get ts
				}
			}
		}
		echo json_encode($output);
	}
	
	function scan_dir($dir,$sDate,$eDate) {
		$ignored = array('.', '..', '.svn', '.htaccess','capture.m3u8');	
		$sModified = strtotime($sDate);
		$lModified = strtotime($eDate);
//		echo '<br>s: '.date('d-m-Y H:i',$sModified).' - '.date('d-m-Y H:i',$lModified);

		$files = array();    
		foreach (scandir($dir) as $file) {
			if (in_array($file, $ignored)) continue;
			if(preg_match("/\.(mp4|m3u8|jpg)$/", $file)){
				continue;
			}
			if(is_dir($dir.'/'.$file)){
				continue;
			}
			
			$checkFile = strtotime(date('d-m-Y H:i',filemtime($dir . '/' . $file)));
/*			echo '<br><br>file Time:'.$checkFile;
			echo '<br>file Time:'.date('d-m-Y H:i',filemtime($dir . '/' . $file));
			echo '<br>'.$file;
			echo '<br>String:'.$sModified.' - '.$checkFile.' - '.$lModified;*/
			if($checkFile>=$sModified&&$checkFile<=$lModified){
				//echo '<br>Select file :'.$file.', Time: '.date('d-m-Y H:i',filemtime($dir . '/' . $file));
				$files[$file] = filemtime($dir . '/' . $file);
			}
			else{
				unlink($dir.'/'.$file);
			}
		}
		return true;
	}
	
	
}
