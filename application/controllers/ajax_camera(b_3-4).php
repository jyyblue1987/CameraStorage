<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_camera extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date','front'));	
		$this->load->library(array('session'));
		$this->load->model(array('comman_model','settings_model'));
		$this->data['set_meta'] = '';	
        $this->data['settings'] = $this->settings_model->get_fields();
		date_default_timezone_set("America/Cancun"); 

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

	function ajax3212(){//check connect is loss or not file 
		ini_set('max_execution_time', 0);
//		ini_set("memory_limit","5012M");
		ini_set("memory_limit","-1");
		$output['status'] ='ok';
		//for check camera expire
		$string = "select * from camera where is_expire =0 and (payment_id !=0 or (payment_type='free'))";
		$PaidCamera = $this->comman_model->get_query($string,false);
//		$PaidCamera = $this->comman_model->get_by('camera',array('payment_id !='=>0,'is_expire'=>0),false,false,false);
		$now = strtotime(date('Y-m-d'));
		//echo '<br>Now Date:'.date('Y-m-d',$now);
		if($PaidCamera){
			//echo 'as';
			foreach($PaidCamera as $set_mult){						
				$totalDay = $set_mult->plan_day;
				$expireData = strtotime(h_addDate($set_mult->plan_date,'day',$totalDay,'Y-m-d'));
/*				echo '<br><br>ExpireD: '.date('Y-m-d',$expireData);
				echo '<br><br>Now string:'.$now;
				echo '<br>U time: '.$expireData;*/
				if($now>=$expireData){
					//echo 'Yes';
					//echo '<br>Ok:'.$set_mult->id;				
					$this->comman_model->update_by('camera',array('is_expire'=>1),array('id'=>$set_mult->id));
				}
			}
		}
		//end for check camera expire



		$checkProductss = $this->comman_model->get_by('camera',array('sys_file'=>1),false,false,false);
		if($checkProductss){
			//for check lost connection
			foreach($checkProductss as $checkProduct){
				if(!empty($checkProduct->camera_path)){
					$images_folder = $checkProduct->camera_path.'/camera '.$checkProduct->id;
					$path = 'data/'.$images_folder;
					if (!is_dir('data/'.$images_folder)) {
						mkdir('./data/'.$images_folder, 0777, true);
					}
					if (!is_dir('data/'.$images_folder.'/files')) {
						mkdir('./data/'.$images_folder.'/files', 0777, true);
					}
	
					if(!empty($checkProduct->last_f_date)){//check file time created					
						$nowTime = time();
						//echo '<br>'.date('d-m-Y H:i:s',$nowTime);
						//echo '<br>1ADdd: '.date('d-m-Y H:i',strtotime('+1 minutes',$checkProduct->last_f_date));
						$minAdd1 = strtotime('+1 minutes',$checkProduct->last_f_date);
						//echo '<br>';
						if($minAdd1<$nowTime){
						$get_last_file = $this->scan_last_dir($path);
						$nowTime = time();	
							if($get_last_file){
								$last_file = end($get_last_file);
								//echo '<br>'.$checkProduct->id.': '.$last_file;
								if(empty($checkProduct->last_file)){//check  file empty
								//	echo 'check  file empty';
									$this->db->where('id', $checkProduct->id);
									$this->db->set('last_file',$last_file,true);
									$this->db->set('last_f_date',$nowTime,true);
									$this->db->update('camera');
								}
								else if($last_file==$checkProduct->last_file){//check last file is same in server
								//	echo 'same file';
									$this->db->where('id', $checkProduct->id);
									$this->db->set('sys_file',0,true);
									$this->db->set('is_connect',0,true);
									$this->db->update('camera');
								}
								else{
									//echo 'save new file';
									$this->db->where('id', $checkProduct->id);
									$this->db->set('last_file',$last_file,true);
									$this->db->set('last_f_date',$nowTime,true);
									$this->db->update('camera');
								}
							}
						}
						
						
					}
					else{
						$get_last_file = $this->scan_last_dir($path);
						$nowTime = time();	
						if($get_last_file){
							$last_file = end($get_last_file);
							//echo '<br>'.$checkProduct->id.': '.$last_file;
							if(empty($checkProduct->last_file)){
								$this->db->where('id', $checkProduct->id);
								$this->db->set('last_file',$last_file,true);
								$this->db->set('last_f_date',$nowTime,true);
								$this->db->update('camera');
							}
							else if($last_file==$checkProduct->last_file){
								$this->db->where('id', $checkProduct->id);
								$this->db->set('sys_file',0,true);
								$this->db->set('is_connect',0,true);
								$this->db->update('camera');
							}
							else{
								$this->db->where('id', $checkProduct->id);
								$this->db->set('last_file',$last_file,true);
								$this->db->set('last_f_date',$nowTime,true);
								$this->db->update('camera');
							}
						}
					}
				}
			}
		}
/*		$checkProductss = $this->comman_model->get_by('camera',array('user_id'=>$this->data['user_details']->id,'sys_file'=>0,'is_connect'=>0),false,false,false);
		$output['connect'] = count($checkProductss);*/
		echo json_encode($output);
	}
	
	function ajax1232(){
		ini_set('max_execution_time', 300);
		$start = microtime(true);
		$mh = curl_multi_init();
		$handles = array();
		
		$all_data = $this->comman_model->get_by('camera',array('is_connect'=>0,'sys_file'=>0,'is_expire'=>0),false,false,false);
		if($all_data){
			foreach($all_data as $set_data){
				$cameraPlay = false;
				$checkUser = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
				if($checkUser){
					if($checkUser->play_w_pay==0){
						$cameraPlay =true;
					}
					else{
						if($set_data->payment_id!=0&&$set_data->is_expire==0){
							$cameraPlay =true;
						}
					}
				}

				if($cameraPlay){
					//echo '<br>'.$set_data->id;
					$ch = curl_init();		
					if(ENVIRONMENT=='production'){
						curl_setopt($ch, CURLOPT_URL, base_url()."ajax_camera/ajaxCameraRun?id=".$set_data->id);
					}
					else{
						curl_setopt($ch, CURLOPT_URL, base_url()."ajax_camera/ajaxCameraRun?id=".$set_data->id);
					}
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_VERBOSE, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	  
					curl_setopt($ch, CURLOPT_TIMEOUT, 30);
					curl_multi_add_handle($mh, $ch);
					$handles[] = $ch;
				}
			}
		}
		
		// execute requests and poll periodically until all have completed
/*		echo '<pre>';
		print_r($handles);
		echo '</pre>';*/
		$isRunning = null;
		do {
			curl_multi_exec($mh, $isRunning);
		//    usleep(250000);
		//	echo 'OK';
		} while ($isRunning > 0);
		
		// fetch output of each request
		$outputs = array();
		for ($i = 0; $i < count($handles); $i++) {
		//	echo '<br>Close';
			$outputs[$i] = trim(curl_multi_getcontent($handles[$i]));
			curl_multi_remove_handle($mh, $handles[$i]);
		}
		
		curl_multi_close($mh);
		
/*		print_r($outputs);*/
//		printf("Elapsed time: %.2f seconds\n", microtime(true) - $start);
	}	

	function ajaxCameraRun(){
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='';
		$id = $this->input->get('id');
		$camerPlay =false;
		//$id = 10;
		if($id){
			$check = $this->comman_model->get_by('camera',array('id'=>$id,'is_connect'=>0,'sys_file'=>0,'is_expire'=>0),false,false,true);
			if($check){//check camera
				$checkUser = $this->comman_model->get_by('users',array('id'=>$check->user_id),false,false,true);
				if($checkUser){
					if($checkUser->play_w_pay==0){
						$cameraPlay =true;
					}
					else{
						if($check->payment_id!=0&&$check->is_expire==0){
							$cameraPlay =true;
						}
					}
				}
				if($cameraPlay){
					//echo 'YES';
					if($check->model=='Custom RTSP Device'){
						$videoLink = $check->url;
						//$videoLink = 'rtsp://'.$check->ip_address.':'.$check->port.'/user='.$check->username.'&password='.urlencode($check->password).'&channel='.$check->camera_num.'&stream='.$check->stream.'.sdp';
					}
					else{
						$videoLink = 'rtsp://'.$check->ip_address.':'.$check->port.'/user='.$check->username.'&password='.urlencode($check->password).'&channel='.$check->camera_num.'&stream='.$check->stream.'.sdp';
					}
				
					$images_folder = 'camera '.$id;
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
					$this->db->update('camera');


					//old file
					//path change
//					$string = 'ffmpeg -nostats -loglevel 0 -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 "data/demos_files/'.$fileStart.'"';
					if(ENVIRONMENT=='production'){
						$string = 'ffmpeg -nostats -loglevel 0 -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 -r '.$check->fps.' "data/'.$path.'/'.$fileStart.'"';
					}
					else{
						$string = 'ffmpeg -nostats -loglevel 0 -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 -r '.$check->fps.' "/var/www/html/data/'.$path.'/'.$fileStart.'"';
					}

					//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 "/var/www/html/data/demo_files/'.$fileStart.'" 2>&1';
					exec($string,$output_d,$return);
					if (!$return) {
						//echo "ffmpeg work!!";
					} 
					else {
/*						echo '<pre>';
						print_r($output_d);
						print_r($return);
						echo '<pre>';
						echo $id."ffmpeg not work or some error";*/

						$this->db->where('id',$id);
						$this->db->set('sys_file',0,true);
						if(!empty($check->s_file)){
							$this->db->set('s_file',$check->s_file,true);						
						}
						$this->db->set('is_connect',0,true);						
						$this->db->update('camera');
					}
					//for Connection Restored
					if($this->data['settings']['email_option']==1){
						$email_data = $this->comman_model->get_by('users_email',array('user_id'=>$checkUser->parent_id,'email_id'=>7),false,false,true);
						if($email_data){
							$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
							$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);		
							$email_data->message = str_replace('{user_name}', $checkUser->username, $email_data->message);
							$email_data->message = str_replace('{camera_name}', $check->name, $email_data->message);
							$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
							$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
							$this->send_mail($checkUser,$check,$email_data->subject,$email_data->message);
						}
					}
					
				}
				$output['status'] ='ok';
				
					$output['msge'] ='Thers is no camera!!';
			}
			else{
				$output['msge'] ='Thers is no camera!!';
			}
			
		}		
		echo json_encode($output);
	}

	function test_email($id=false){
		$check = $this->comman_model->get_by('camera',array('id'=>$id),false,false,true);
		if($check){//check camera
			$checkUser = $this->comman_model->get_by('users',array('id'=>$check->user_id),false,false,true);
			if($checkUser){
				$email_data = $this->comman_model->get_by('users_email',array('user_id'=>$checkUser->parent_id,'email_id'=>7),false,false,true);
				if($email_data){
					$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
					$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);		
					$email_data->message = str_replace('{user_name}', $checkUser->username, $email_data->message);
					$email_data->message = str_replace('{camera_name}', $check->name, $email_data->message);
					$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
					$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
					$this->send_mail($checkUser,$check,$email_data->subject,$email_data->message);
				}				
			}
				
		}
		
	}
	
	function send_mail($checkUser,$check,$subject,$body){
		$email_data = $this->comman_model->get_by('users_email',array('user_id'=>$checkUser->parent_id,'email_id'=>7),false,false,true);
		if($email_data){
			$string = 'SELECT users_e_setup.*,users.email AS u_email,users.company_name AS company_name FROM users_e_setup JOIN users ON users_e_setup.user_id = users.id WHERE users.id= '.$checkUser->parent_id;
			$support = $this->comman_model->get_query($string,true);
			if(!$support){
				return false;
			}
			if($support->type=='smtp'){
			}
			else if($support->type=='system'){
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($support->data['settings']['site_email'], $this->data['settings']['site_name']);
				$this->email->to($checkUser->email);
				$this->email->subject($subject);
				$this->email->message($body);
				$this->email->send();	
			}
			else {
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($support->email, $support->company_name);
				$this->email->to($checkUser->email);
				$this->email->subject($subject);
				$this->email->message($body);
				$this->email->send();	
			}
		}
		return true;
	}
	
	function ajax156(){
		die;
		ini_set('max_execution_time', 300);
		$start = microtime(true);
		$mh = curl_multi_init();
		$handles = array();
		
		$all_data = $this->comman_model->get_by('camera',array('is_connect'=>0,'sys_file'=>0),false,false,false);
		if($all_data){
			foreach($all_data as $set_data){
				$cameraPlay = false;
				$checkUser = $this->comman_model->get_by('users',array('id'=>$set_data->user_id),false,false,true);
				if($checkUser){
					if($checkUser->play_w_pay==0){
						$cameraPlay =true;
					}
					else{
						if($set_data->payment_id!=0&&$set_data->is_expire==0){
							$cameraPlay =true;
						}
					}
				}

				if($cameraPlay){
					//echo '<br>'.$set_data->id;
					$ch = curl_init();		
					if(ENVIRONMENT=='production'){
						curl_setopt($ch, CURLOPT_URL, base_url()."ajax_camera/ajaxCameraRun?id=".$set_data->id);
					}
					else{
						curl_setopt($ch, CURLOPT_URL, base_url()."ajax_camera/ajaxCameraRun?id=".$set_data->id);
					}
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 30);
					curl_multi_add_handle($mh, $ch);
					$handles[] = $ch;
				}
			}
		}
		
		// execute requests and poll periodically until all have completed
/*		echo '<pre>';
		print_r($handles);
		echo '</pre>';*/
		$isRunning = null;
		do {
			curl_multi_exec($mh, $isRunning);
		//    usleep(250000);
		//	echo 'OK';
		} while ($isRunning > 0);
		
		// fetch output of each request
		$outputs = array();
		for ($i = 0; $i < count($handles); $i++) {
		//	echo '<br>Close';
			$outputs[$i] = trim(curl_multi_getcontent($handles[$i]));
			curl_multi_remove_handle($mh, $handles[$i]);
		}
		
		curl_multi_close($mh);
		
/*		print_r($outputs);*/
//		printf("Elapsed time: %.2f seconds\n", microtime(true) - $start);
			
	}
}
