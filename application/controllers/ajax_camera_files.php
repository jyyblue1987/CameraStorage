<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_camera_files extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->data['settings'] = $this->settings_model->get_fields();
		date_default_timezone_set(TIMEZONES); 

	}

	function check_test_camera(){//check test camera and delete file 
		ini_set('max_execution_time', 0);
//		ini_set("memory_limit","5012M");
		ini_set("memory_limit","-1");
		$output['status'] ='ok';
		//for check camera expire
		$string = "select * from camera where is_test =1";
		$cameras = $this->comman_model->get_query($string,false);
		if($cameras){
			foreach($cameras as $set_camera){
				if(!empty($set_camera->camera_path)){
					$path = '/var/www/html/data/'.$set_camera->camera_path.'/camera '.$set_camera->id;
					if(ENVIRONMENT=='production'){
						$path = 'data/'.$set_camera->camera_path.'/camera '.$set_camera->id;
					}
					echo '<br>'.$path;
					$this->deleteDir($path);
				}
			}
		}
		echo json_encode($output);
	}

	public static function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			return "$dirPath must be a directory";
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
			} else {
				unlink($file);
			}
		}
	}	
	
	
}
