<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Playback_camera extends Frontend_Controller{	
	public $_redirect = '/member/playback_camera';

	public $_subView = 'user/playback_camera/';
	public $_table_names = 'camera';
	public $_table_plan = 'plans';
	public $_table_membership = 'memberships';
	public $_mainView = 'user/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'playback';		
        $this->load->model(array('camera_model','membership_model'));
		$this->load->helper('directory');
		$this->load->helper("file");
		
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
		ini_set("memory_limit","2512M");
	}

	function c_order(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Set Order';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index_order';
		$this->load->view($this->_mainView,$this->data);
	}


    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->camera_model->save_order_playback($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->camera_model->get_nested_playback($this->data['user_details']->id);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }


	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],6000).'Playback Camera';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('user_id'=>$this->data['user_details']->id),false,array('order_playback'=>'asc'),false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	
	public function v($id = false){
		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'Playback Camera View';
		$this->data['is_dir'] = false;
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }

		$this->data['time_data']  = $this->custom_model->get_time_hour_min();
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}

		if($this->data['user_details']->play_w_pay==1){
			if($checkProduct->payment_id!=0&&$checkProduct->is_expire==0){
				
			}			
			else{
				$this->session->set_flashdata('error','Please upgrade your camera!!');
				//redirect($this->data['_cancel']);							
			}
		}

		$startDate = $endDate = '';
		if($checkProduct->payment_id!=0){
			$startDate	= $checkProduct->plan_date;
			$endDate 	= h_addDate($checkProduct->plan_date,'day',$checkProduct->plan_day,'Y-m-d');
/*			echo '<br>'.$startDate.' '.$checkProduct->plan_day;
			echo '<br>'.$endDate;
*/
		}
//		echo $checkProduct->payment_id.' : '.$checkProduct->is_expire.'asd';die;

		$this->data['name'] = 'Playback Camera View - '.$checkProduct->name;
 
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
/*		$images_folder = 'camera '.$id;
		$path = 'data/'.$images_folder;
		if (!is_dir('data/'.$images_folder)) {
			mkdir('./data/'.$images_folder, 0777, true);
		}*/

		$images_folder = 'camera '.$id;
		$user_path = $this->data['user_details']->dealer_path.'/'.$this->data['user_details']->folder_path;
		if(!empty($checkProduct->camera_path)){
			$user_path = $checkProduct->camera_path;
//			echo 'data/'.$checkProduct->camera_path.'/'.$images_folder;
			if (!is_dir('data/'.$checkProduct->camera_path.'/'.$images_folder)) {
				mkdir('./data/'.$checkProduct->camera_path.'/'.$images_folder, 0755, true);
			}
		}
		else{
			if (!is_dir('data/'.$user_path.'/'.$images_folder)) {
				mkdir('./data/'.$user_path.'/'.$images_folder, 0755, true);
			}
			$this->db->where('id', $checkProduct->id);
			$this->db->set('camera_path',$user_path,true);
			$this->db->update('camera');			
		}
		//for localhost
		$u_b_path = $this->data['user_details']->dealer_path.'\\'.$this->data['user_details']->folder_path;


//		$GetDate = h_addDate($gdate,'day','-1','Y-m-d');
		//$GetDate = $gdate;
		$this->data['dateFolder'] = $dateFolder = 'files';
		$GetDates = $this->input->get('dates');
		$sTime = $this->input->get('s_time');
		$eTime = $this->input->get('e_time');

		$images_folder = 'camera '.$checkProduct->id;
		$path = $user_path.'/'.$images_folder;
		if (!is_dir('data/'.$path.'/files')){
			mkdir('./data/'.$path.'/files', 0777, true);
		}

		if(ENVIRONMENT=='production'){
			$this->delete_ts_file('data/'.$path.'/files');
		}
		else{
			$this->delete_ts_file('/var/www/html/data/'.$path.'/files');
		}

/*		if(ENVIRONMENT=='production'){
			$this->delete_ts_file('data/'.$path);
		}
		else{
			$this->delete_ts_file('/var/www/html/data/'.$path);
		}*/

		if($eTime&&$GetDates&&$sTime){
			$arrDate = explode('-',$GetDates);
			$GetDate =  date('d-m-Y',strtotime($arrDate['1'].'-'.$arrDate[0].'-'.$arrDate[2]));
			if($sTime>$eTime){
				$str = $eTime.'-'.$sTime;
				$sDateTime = $GetDate.' '.$eTime;
				$eDateTime = $GetDate.' '.$sTime;
			}
			else{
				$str = $sTime.' '.$eTime;
				$sDateTime = $GetDate.' '.$sTime;
				$eDateTime = $GetDate.' '.$eTime;
			}

			$getDateFolderName =  $GetDates.' '.str_replace(':','-',$str);
			if (!is_dir('data/'.$path)) {
				mkdir('./data/'.$path, 0777, true);
			}
			
			if (!is_dir('data/'.$path.'/'.$dateFolder)){
				mkdir('./data/'.$path.'/'.$dateFolder, 0777, true);
			}
			$checkAlreayExist = 'data/'.$path.'/'.$dateFolder.'/file-'.$getDateFolderName.'.mp4';
			if(file_exists($checkAlreayExist)){//if file exists
			}
			else{
				if($dateFolder){
					if(ENVIRONMENT=='production'){
						$images_folder = 'camera '.$checkProduct->id;
						$path = $user_path.'/'.$images_folder;
						if (!is_dir('data/'.$path)) {
							mkdir('./data/'.$path, 0777, true);
						}
						
						if (!is_dir('data/'.$path.'/'.$dateFolder)){
							mkdir('./data/'.$path.'/'.$dateFolder, 0777, true);
						}
						//	echo '<pre>';
						$ar = $this->scan_dir('data/'.$path,$sDateTime,$eDateTime);//for get ts
/*							echo '<br> Total: '.count($ar);
						echo '<pre>';
						
						print_r($ar);
						die;*/
						$setFile = '';
						if($ar){
							$ars = array_chunk($ar,5);
							$i=0;
							foreach($ars as $s_f){
								$setFile = '';
								foreach($s_f as $set_f){
									$setFile .= '"data\\'.$path.'\\'.$set_f.'"+';// localhost
								}
		//							echo '<br>'.$setFile;
								$setFile = trim($setFile,'+');
								if($setFile){			
									//$stringAllFile = 'copy /b '.$setFile.' "data\\'.$path.'\\'.$dateFolder.'\\file-'.$i.'.mp4"';	// for localhost
		
									$stringAllFile = 'copy /b '.$setFile.' "data\\'.$path.'\\'.$dateFolder.'\\all-'.$i.'.ts"';	// for localhost
		//									echo '<br>'.$stringAllFile;
									exec($stringAllFile ,$output_d,$return);
									$i++;									
								}
							}
						}					
					
						$getAllTS = $this->get_files('data/'.$path.'/files');//for get all.ts
						$setAllTSFile = '';
						if($getAllTS){
						//	echo 'ok';
							foreach($getAllTS as $s_f){
								$setAllTSFile .= '"data\\'.$path.'\\files\\'.$s_f.'"+';// localhost
							}
							$setAllTSFile = trim($setAllTSFile,'+');

							if($setAllTSFile){			
								//$stringAllFile = 'copy /b '.$setFile.' "data\\'.$path.'\\'.$dateFolder.'\\file-'.$i.'.mp4"';	// for localhost
	
								$stringAllFile = 'copy /b '.$setAllTSFile.' "data\\'.$path.'\\'.$dateFolder.'\\all.ts"';	// for localhost
	//									echo '<br>'.$stringAllFile;
								exec($stringAllFile ,$output_d,$return);
								$convertString = 'ffmpeg -nostats -loglevel 0 -i "data\\'.$path.'\\'.$dateFolder.'\\all.ts" -acodec copy -vcodec copy "data\\'.$path.'\\'.$dateFolder.'\\file-'.$getDateFolderName.'.mp4"';	// for localhost
							exec($convertString,$output_d,$return);
							}
						}					
						$this->delete_ts_file('data/'.$path.'/files');
					}//if(ENVIRONMENT=='production')
					else{
						$images_folder = 'camera '.$checkProduct->id;
						$path = $user_path.'/'.$images_folder;
						//$path = 'data/'.$images_folder;
						if (!is_dir('data/'.$path)) {
							mkdir('./data/'.$path, 0777, true);
						}
						
						if (!is_dir('data/'.$path.'/'.$dateFolder)){
							mkdir('./data/'.$path.'/'.$dateFolder, 0777, true);
						}
		//						echo 'asd';
						$ar = $this->scan_dir('/var/www/html/data/'.$path,$sDateTime,$eDateTime);
						//$ar = $this->scan_dir('/var/www/html/data/'.$images_folder,$GetDate,h_addDate($GetDate,'day','1','Y-m-d'));
/*							echo '<br> Total: '.count($ar);
							echo '<pre>';
							
							print_r($ar);
							die;*/

						$setFile = '';
						if($ar){
							//echo 'OK';
							$ars = array_chunk($ar, 150);
							$i=0;
							foreach($ars as $s_f){
								$setFile = '';
								foreach($s_f as $set_f){
									$setFile .= '"/var/www/html/data/'.$path.'/'.$set_f.'" ';
								}
								if($setFile){			
	//								$stringAllFile = 'cat '.$setFile.' > "/var/www/html/data/'.$images_folder.'/'.$GetDate.'/file-'.$i.'.mp4"';
									$stringAllFile = 'cat '.$setFile.' > "/var/www/html/data/'.$path.'/'.$dateFolder.'/all-'.$i.'.ts"';
									//echo '<br><br>Ts: '.$stringAllFile;
									exec($stringAllFile ,$output_d,$return);
									$i++;									
								}
							}
						}								
	
						$getAllTS = $this->get_files('/var/www/html/data/'.$path.'/files');//for get all.ts
						$setAllTSFile = '';
						if($getAllTS){
						//	echo 'ok';
							foreach($getAllTS as $set_f){
									$setAllTSFile .= '"/var/www/html/data/'.$path.'/'.$dateFolder.'/'.$set_f.'" ';
							}
	
							if($setAllTSFile){			
								//$stringAllFile = 'copy /b '.$setFile.' "data\\'.$path.'\\'.$dateFolder.'\\file-'.$i.'.mp4"';	// for localhost
	
								$stringAllFile = 'cat '.$setAllTSFile.' > "/var/www/html/data/'.$path.'/'.$dateFolder.'/all.ts"';
								//echo '<br>'.$stringAllFile;
								exec($stringAllFile ,$output_d,$return);
	
								$convertString = 'ffmpeg -nostats -loglevel 0 -i "/var/www/html/data/'.$path.'/'.$dateFolder.'/all.ts" -acodec copy -vcodec copy "/var/www/html/data/'.$path.'/'.$dateFolder.'/file-'.$getDateFolderName.'.mp4"';	
								//echo '<br>'.$convertString;
								exec($convertString,$output_d,$return);
							}
						}					
						$this->delete_ts_file('/var/www/html/data/'.$path.'/files');
					}//if(ENVIRONMENT=='production') else
				}//if($dateFolder)
			}//file not exists
				$images_folder = 'camera '.$id;
				if(ENVIRONMENT=='production'){
					$dateFPath = 'data/'.$user_path.'/camera '.$checkProduct->id.'/'.$dateFolder;
				}
				else{
					$dateFPath = '/var/www/html/data/'.$user_path.'/camera '.$checkProduct->id.'/'.$dateFolder;
				}
		//		die;
		}
		$this->data['mp4_files'] = h_get_dir('data/'.$user_path.'/camera '.$id.'/'.$dateFolder);
	//die;
/*$dir = './data/'.$images_folder.'/'.$dateFolder;
chdir($dir);
$tmp = array_map('filemtime', ($ffiles = glob("*.{mp4}", GLOB_BRACE)));
$Nfiles = array_multisort($tmp, SORT_ASC, $tmp);
echo '<pre>';
print_r($Nfiles);
$this->data['mp4_files']  = $ffiles;
*/
/*		echo '<pre>';
		print_r($this->data['mp4_files']);
		die;
		echo $this->data['is_dir'];die;*/
		
/*		if(ENVIRONMENT=='production'){
			$this->delete_ts_file('data/'.$path);
		}
		else{
			$this->delete_ts_file('/var/www/html/data/'.$path);
		}*/

		if(!empty($startDate)&&!empty($endDate)){
			if(ENVIRONMENT=='production'){
				$this->_delete_date_file('data/'.$path.'/files',$startDate,$endDate);
			}
			else{
				$this->_delete_date_file('/var/www/html/data/'.$path.'/files',$startDate,$endDate);
			}
		}
        $this->data['subview'] = $this->_subView.'view_camera1';
		$this->load->view($this->_mainView,$this->data);
	}
	
	function delete_ts_file($dir){
		foreach (scandir($dir) as $file) {
			if(preg_match("/\.(ts)$/", $file)){
				unlink($dir.'/'.$file);
			}
		}
	}
	

	function _delete_date_file($dir,$from,$to){
		
		$dates_range = h_dateRangeArray($from,$to,'m-d-Y');
/*		echo 's:'.$from.' E: '.$to;
		echo '<pre>';
		print_r($dates_range);*/
//		$dir = 'data/tfile/client-25/camera 2/files';
		foreach (scandir($dir) as $file){
			if(preg_match("/\.(mp4)$/", $file)){
				$filesNameArr = explode(' ',$file);
				if($filesNameArr[0]){
					$date 	= trim($filesNameArr[0],'file-');
					if(in_array($date,$dates_range)){
						//echo 'Yes';
					}
					else{//if not range in date
						//echo '<br>'.$file;
						unlink($dir.'/'.$file);
					}
					
				}
			}
		}
//		die;
	}

	function get_files($dir) {
		$ignored = array('.', '..', '.svn', '.htaccess','capture.m3u8');	
	/*	echo '<br>zx: '.$sDate;
		echo '<br>zx: '.$eDate;*/
		//echo '<br>s: '.date('d-m-Y H:i',$sModified).' - '.date('d-m-Y H:i',$lModified);

		$files = array();    
		$i=0;
		foreach (scandir($dir) as $file) {
			if (in_array($file, $ignored)) continue;
			if(is_dir($dir.'/'.$file)){
				continue;
			}
			if(preg_match("/\.(ts)$/", $file)){
				$i++;
				$files[$file] = filemtime($dir . '/' . $file);
			}
			
		}
	
	    asort($files);
	//    arsort($files);
		$files = array_keys($files);
	
		return ($files) ? $files : false;
	}

	function scan_dir($dir,$sDate,$eDate) {
		$ignored = array('.', '..', '.svn', '.htaccess','capture.m3u8');	
	/*	echo '<br>zx: '.$sDate;
		echo '<br>zx: '.$eDate;*/
		$sModified = strtotime($sDate);
		$lModified = strtotime($eDate);
		//echo '<br>s: '.date('d-m-Y H:i',$sModified).' - '.date('d-m-Y H:i',$lModified);

		$files = array();    
		$i=0;
		foreach (scandir($dir) as $file) {
			if (in_array($file, $ignored)) continue;
			if(preg_match("/\.(mp4|m3u8|jpg)$/", $file)){
				continue;
			}
			if(is_dir($dir.'/'.$file)){
				continue;
			}
			
			$checkFile = strtotime(date('d-m-Y H:i',filemtime($dir . '/' . $file)));
			//echo '<br>file Time:'.$checkFile;
		//	echo '<br>file Time:'.date('d-m-Y H:i',filemtime($dir . '/' . $file));
	//		echo '<br>'.$file;
			//echo '<br>String:'.$sModified.' - '.$checkFile.' - '.$lModified;
			if($checkFile>=$sModified&&$checkFile<=$lModified){
				//echo '<br>Select file :'.$file.', Time: '.date('d-m-Y H:i',filemtime($dir . '/' . $file));
//				echo '<br>ok '.$i;
/*				if($i==3){
					break;
				}*/
				$i++;
				$files[$file] = filemtime($dir . '/' . $file);
			}
		}
	

	    asort($files);
	//    arsort($files);
		$files = array_keys($files);
		//die;
		return ($files) ? $files : false;
	}
	
	function download(){
		$this->load->helper('download');
		$id =$this->input->get('id');
		$file =$this->input->get('file');
		if(!$id){
			$this->session->set_flashdata('error','There is no camera!!'); 
			redirect($this->data['_cancel']);
		}

		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
			$this->session->set_flashdata('error','There is no camera!!'); 
			redirect($this->data['_cancel']);
		}

		if(!$file){
			$this->session->set_flashdata('error','There is no file!!'); 
			redirect($this->data['_cancel'].'/v/'.$id);
		}
		if(ENVIRONMENT=='production'){
			$checkAlreayExist = FCPATH.'data/'.$checkProduct->camera_path.'/camera '.$checkProduct->id.'/files/'.$file;
		}
		else{
			$checkAlreayExist = FCPATH.'data/'.$checkProduct->camera_path.'/camera '.$checkProduct->id.'/files/'.$file;
		}

		//echo $checkAlreayExist;
		if(file_exists($checkAlreayExist)){//if file exists
//		echo 'Yes';
		}
		else{
			//echo 'There is no file!!';
			$this->session->set_flashdata('error','There is no file!!'); 
			redirect($this->data['_cancel'].'/v/'.$id);
		}

		//$this->comman_model->save('files',array('download_count'=>$download_file->download_count+1),$download_file->id);
		$data = file_get_contents($checkAlreayExist);
		force_download($file,$data); 
	}    
	
	function send_mail(){
		$id =$this->input->get('id');
		$file =$this->input->get('file');
		if(!$id){
			$this->session->set_flashdata('error','There is no camera!!'); 
			redirect($this->data['_cancel']);
		}

		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
			//echo 'NO camera';
			$this->session->set_flashdata('error','There is no camera!!'); 
			redirect($this->data['_cancel']);
		}

		if(!$file){
			//echo 'NO file';
			$this->session->set_flashdata('error','There is no file!!'); 
			redirect($this->data['_cancel'].'/v/'.$id);
		}

		if(ENVIRONMENT=='production'){
			$checkAlreayExist = FCPATH.'data/'.$checkProduct->camera_path.'/camera '.$checkProduct->id.'/files/'.$file;
		}
		else{
			$checkAlreayExist = FCPATH.'data/'.$checkProduct->camera_path.'/camera '.$checkProduct->id.'/files/'.$file;
		}

		//echo $checkAlreayExist;
		if(file_exists($checkAlreayExist)){//if file exists
			//echo 'Yes';
		}
		else{
			//echo 'There is no file!!';
			$this->session->set_flashdata('error','There is no file!!'); 
			redirect($this->data['_cancel'].'/v/'.$id);
		}

		if($this->data['settings']['email_option']==1){
			$checkEmail = $this->comman_model->get_by('users_email',array('user_id'=>$this->data['user_details']->parent_id,'email_id'=>6),false,false,true);
			if($checkEmail){
				$html = $checkEmail->message;
				$subject = $checkEmail->subject;
			}
			else{
				$this->session->set_flashdata('error','Sorry!! File can not be send!!'); 
				redirect($this->data['_cancel'].'/v/'.$id);
			}

			$subject =  $this->data['settings']['site_name'];
	
			$html = str_replace('{site_name}', $this->data['settings']['site_name'], $html);
			$html= str_replace('{user_name}', $this->data['user_details']->username, $html);
			$html= str_replace('{camera_name}', $checkProduct->name, $html);
	
	
			$this->load->library('email');
			$config = array (
				  'mailtype' => 'html',
				  'charset'  => 'utf-8',
				  'priority' => '1'
				   );
			$this->email->initialize($config);
			$this->email->from($this->data['settings']['site_email'],$this->data['settings']['site_name']);
			//$this->email->from($this->data['user_details']->email,$this->data['settings']['site_name']);
			$this->email->to($this->data['user_details']->email);
	//		$this->email->to('pvsysgroup01@gmail.com');
			if(is_file($checkAlreayExist)){
				$this->email->attach($checkAlreayExist);
			}
	
			$this->email->subject($subject);
			$this->email->message($html);
			if($this->email->send()){
				$getFilesSend = $this->comman_model->get_by('user_playback_sent',array('files'=>$file,'user_id'=>$this->data['user_details']->id),false,false,true);
				if($getFilesSend){
					$this->comman_model->save('user_playback_sent',array('files'=>$file,'user_id'=>$this->data['user_details']->id,'on_date'=>date('Y-m-d H:i:s')),$getFilesSend->id);
				}
				else{
					$this->comman_model->save('user_playback_sent',array('files'=>$file,'user_id'=>$this->data['user_details']->id,'on_date'=>date('Y-m-d H:i:s')));
				}
				
	//			echo 'Yes';
				$this->session->set_flashdata('success','File has successfully sent!!'); 
			}
			else{
				//$print =  $this->email->print_debugger();
				//printR($print);
				
				$this->session->set_flashdata('error','Some problem to send!!'); 
			}
			

			redirect($this->data['_cancel'].'/v/'.$id);
			die;
		}
		else{
			$this->session->set_flashdata('error','Sorry!! File can not be send!!'); 
			redirect($this->data['_cancel'].'/v/'.$id);
		}
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