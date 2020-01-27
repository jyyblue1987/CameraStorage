<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Frontend_Controller{	
	public $_redirect = '/member/account';

	public $_subView = 'user/';
	public $_mainView = 'user/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['name'] = 'Dashboard';	
        $this->load->model(array('users_model'));
		$this->load->library('user_agent');		
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
        $detail = $this->session->all_userdata();
		$redirect = false;
		if(isset($detail['user_session'])){	
			$this->data['user_account'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
			if(!empty($this->data['user_account'])){
				if($this->data['user_account']->account_type=='S'||$this->data['user_account']->account_type=='B'||$this->data['user_account']->account_type=='N'||$this->data['user_account']->account_type=='B'){
					$redirect =true;
				}
			}
			else{
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
		$this->data['_user_link'] = $this->data['lang_code'].'/member';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
		ini_set("memory_limit","1512M");
	}

	function index(){
		//var_dump($this->session->all_userdata());
		$this->data['active'] = 'home';	
        $this->data['name'] = show_static_text($this->data['lang_id'],8000).'Live Cameras';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['login'] = $this->session->all_userdata();
		
		$this->data['subview'] = $this->_subView.'/dashboard/index';	
		$this->load->view($this->_mainView,$this->data);
	}

	function edit_profile(){
        $this->data['name'] = show_static_text($this->data['lang_id'],45);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'Profile';	
//		$this->data['country_data'] = $this->custom_model->get_country_name();

	   	$this->db->order_by('name','asc');
        $this->data['countries_data'] = $this->comman_model->get('countries',false);

		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		$this->form_validation->set_message('is_unique',show_static_text($this->data['lang_id'],220));
		$this->form_validation->set_message('integer',show_static_text($this->data['lang_id'],221));
		$this->form_validation->set_message('required', show_static_text($this->data['lang_id'],219));

        $rules = $this->users_model->update_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post_data = $this->comman_model->array_from_post(array('first_name','company_name','address','address2','state','city','country','phone','phone2','province','gender','zip'));
        	$post_data['username'] = $post_data['first_name'];
        	$post_data['last_name'] = '';

			$post_data['dob']	= h_dateFormat($this->input->post('dob'),'Y-m-d');
			if (!empty($_FILES['image']['name'])){					
				$result =$this->comman_model->do_upload('image','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$post_data['image'] = $result[1];
				}
			}	
			else{
				$post_data['image'] = $this->data['user_account']->image;
			}

			$this->comman_model->save('users',$post_data,$this->data['user_account']->id);

			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],211));
			redirect($this->data['_cancel'].'/edit_profile');
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'profile/edit';
		$this->load->view($this->_mainView,$this->data);
	}

	function iframe($id=false){
		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
	        $this->data['subview'] = $this->_subView.'dashboard/blank';
			exit();
        }
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by('camera',array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkProduct){
//			echo 'asd';
	        $this->data['subview'] = $this->_subView.'dashboard/blank';
			exit();
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
			$this->load->view($this->_subView.'dashboard/iframe_safari',$this->data);	
//	        $this->data['subview'] = $this->_subView.'dashboard/iframe_safari';
		}
		else{
			$this->load->view($this->_subView.'dashboard/iframe',$this->data);	
		}
	}
	
	function edit_profile_c(){	
        $this->data['name'] = show_static_text($this->data['lang_id'],45);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'Profile';	
		$this->data['country_data'] = $this->custom_model->get_country_name();

		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		$this->form_validation->set_message('is_unique',show_static_text($this->data['lang_id'],220));
		$this->form_validation->set_message('integer',show_static_text($this->data['lang_id'],221));
		$this->form_validation->set_message('required', show_static_text($this->data['lang_id'],219));

        $rules = $this->users_model->update_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post_data = $this->comman_model->array_from_post(array('first_name','last_name','address','city','country','phone','gender'));
        	$post_data['username'] = $post_data['first_name'].' '.$post_data['last_name'];
			if (!empty($_FILES['image']['name'])){					
				$result =$this->comman_model->do_upload('image','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$post_data['image'] = $result[1];
				}
			}	
			else{
				$post_data['image'] = $this->data['user_account']->image;
			}

			$this->comman_model->save('users',$post_data,$this->data['user_account']->id);

			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],211));
			redirect($this->data['_cancel'].'/edit_profile');
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'profile/edit';	
		$this->load->view($this->_mainView,$this->data);
	}
	
	function ajax_camera(){
		$output['status'] ='ok';
		$camera_id = $this->input->post('id');
		//$camera_id = 5;
		$checkProduct = $this->comman_model->get_by('camera',array('id'=>$camera_id,'sys_file'=>1,'is_connect'=>1),false,false,true);
		if($checkProduct){
		//for check lost connection
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
				$minAdd1 = strtotime('+1 minutes',$checkProduct->last_f_date);
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
		echo json_encode($output);
	}

	function notification(){
		$output['status'] ='ok';
		$countConnect = 0;
		$checkProductss = $this->comman_model->get_by('camera',array('user_id'=>$this->data['user_details']->id,'sys_file'=>1),false,false,false);
		if($checkProductss){
			//for check lost connection
			foreach($checkProductss as $checkProduct){
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
								$countConnect++;
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
							$countConnect++;
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

/*		$checkProductss = $this->comman_model->get_by('camera',array('user_id'=>$this->data['user_details']->id,'sys_file'=>0,'is_connect'=>0),false,false,false);
		$output['connect'] = count($checkProductss);*/
		echo json_encode($output);
	}
	
	function save_file(){
		$output['status'] ='ok';
		$all_user = $this->comman_model->get_by('users',array('account_type'=>'A'),false,false,false);
		if($all_user){
			foreach($all_user as $set_u){
/*				if($set_u->plan_id!=0){
					if($set_u->update_point!=''){
						$total = round($set_u->total_point-$set_u->credits_point,2);
						$c	= 0;
//						echo $set_u->update_point;
						$userD = strtotime($set_u->update_point);
						if($now>=$userD){
							$this->db->where('id',$set_u->id);
							$this->db->set('total_point', $total,true);
							$this->db->set('credits_point', $c,true);
							$this->db->set('update_point',$last_now,true);
							$this->db->update('users');
						}
					}
					else{
						$this->db->where('id',$set_u->id);
						$this->db->set('update_point', $last_now, true);
						$this->db->update('users');
				//		echo 'Yes';
					}
				}*/
				if(!empty($set_u->folder_path)){
					$folder = url_title($set_u->folder_path, 'dash', true);					
					if (!is_dir('data/'.$folder)){
						mkdir('./data/'.$folder, 0755, true);
						$this->comman_model->save('users',array('folder_path'=>$folder),$set_u->id);
					}					
				}
				else{
					$parent_folder = print_value('users',array('id'=>$set_u->parent_id),'dealer_path');
					$user_folder = url_title($set_u->first_name.'-'.$set_u->id, 'dash', true);					
					$folder = $parent_folder.'/'.$user_folder;
					//echo $set_u->id.':'.$folder.'<br>';
					if (!is_dir('data/'.$folder)){
						mkdir('./data/'.$folder, 0755, true);
					}
					$this->comman_model->save('users',array('folder_path'=>$user_folder,'dealer_path'=>$parent_folder),$set_u->id);
				}
				//echo '<br>'.$set_u->id;
			}
			
			
		$PaidCamera = $this->comman_model->get_by('camera',array('payment_id !='=>0,'is_expire'=>0),false,false,false);
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
		//die;
			
			$all_camera = $this->comman_model->get_by('camera',array('sys_file'=>0,'is_connect'=>0,'is_mail'=>1,'is_send'=>0),false,false,false);
			if($all_camera){
				foreach($all_camera as $set_c){
					$u_data  = $this->comman_model->get_by('users',array('id'=>$set_c->user_id),false,false,true);
					if($u_data){
						$this->db->where('id',$set_c->id);
						$this->db->set('is_send',1,true);
						$this->db->update('camera');

						$email_data = $this->comman_model->get_by('email',array('id'=>3),false,false,true);			
						$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
						$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);		
						$email_data->message = str_replace('{user_name}', $u_data->username, $email_data->message);
						$email_data->message = str_replace('{camera_name}', $set_c->name, $email_data->message);
						$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
						$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
						//echo $email_data->message;
		
						$this->load->library('email');
						$config = array (
							  'mailtype' => 'html',
							  'charset'  => 'utf-8',
							  'priority' => '1'
							   );
						$this->email->initialize($config);
						$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
						$this->email->to($u_data->email);
						$this->email->subject($email_data->subject);
						$this->email->message($email_data->message);
						$this->email->send();	
					}
				}
			}
		}
		$checkProductss = $this->comman_model->get_by('camera',array('user_id'=>$this->data['user_details']->id,'sys_file'=>0,'is_connect'=>0),false,false,false);
		$output['connect'] = count($checkProductss);

		echo json_encode($output);
	
		/*
		$nowDate = date('Y-m-d');
		$GetDate = h_addDate($nowDate,'day','-1','Y-m-d');
		//$GetDate = $nowDate;
		if(ENVIRONMENT=='production'){}
		else{}*/
	}
		
	function scan_last_dir($dir) {
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

	function scan_dir($dir,$sDate,$eDate) {
		$ignored = array('.', '..', '.svn', '.htaccess','capture.m3u8');
	
	/*	echo '<br>zx: '.$sDate;
		echo '<br>zx: '.$eDate;*/
		$sModified = strtotime($sDate);
		$lModified = strtotime($eDate);
		$files = array();    
		$i=0;
		foreach (scandir($dir) as $file) {
			if (in_array($file, $ignored)) continue;
			if(preg_match("/\.(mp4|m3u8|jpg)$/", $file)){
				continue;
			}
			
			$checkFile = filemtime($dir . '/' . $file);
	//		echo '<br>'.date('d-m-Y',filemtime($dir . '/' . $file));
	//		echo '<br>'.$file;
			if($checkFile>=$sModified&&$checkFile<=$lModified){
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
	
		return ($files) ? $files : false;
	}
		
    public function _unique_email($str){
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('id !=', $this->data['user_account']->id);        
        $categories = $this->comman_model->get('users',true);        
        if(count($categories)){
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
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
    
	public function change_password(){

        $this->data['name'] = show_static_text($this->data['lang_id'],50);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'Change Password';
        $this->form_validation->set_error_delimiters('<div class="warnings"><p>', '</p></div>');

//		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		$rules = $this->users_model->rules_password;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', show_static_text($this->data['lang_id'],219));
		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		if ($this->form_validation->run()==TRUE){
			$this->comman_model->save('users',array('password'=>$this->input->post('password')),$this->data['user_details']->id);
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],214)); 
			redirect($this->data['_cancel'].'/change_password');
		}
        $this->data['edit_data'] = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);

        $this->data['subview'] = $this->_subView.'profile/password';	
		$this->load->view($this->_mainView,$this->data);
	}

	
    public function _check_old_password($str){
		//$login = $this->session->all_userdata();
		$check = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->id,'password'=>$this->input->post('old_password')),false,false,true);
        if(!count($check)){
            $this->form_validation->set_message('_check_old_password',show_static_text($this->data['lang_id'],212));
            return FALSE;                    
        }
        return TRUE;
    }
	
	function programs(){
		$output['programCount'] = 0;
		$output['status'] ='ok';
		echo json_encode($output);
	}

	function get_dashboard(){

		$output['programCount'] = 0;
		$output['status'] ='ok';

		if($this->data['user_details']->account_type=='A'){
			$output['compromise_level'] = 0;
			$query = "select * from athletes_attand where user_id =".$this->data['user_details']->id." and on_date ='".date('Y-m-d')."' and entry ='class'";
			$totalattend = count($this->comman_model->get_query($query,false));
			
			$totalClass = 0;;
			if(!empty($this->data['user_details']->plan_classes)){
				$totalClass = count(explode(',',$this->data['user_details']->plan_classes));
			}
			if($totalClass>0&&$totalattend>0){
				$output['compromise_level'] = round(($totalattend/$totalClass)*100);
				
			}

			$output['skill_level'] = 0;
			$getUnblockExc = $this->comman_model->get_by('unblock_excercise',array('user_id'=>$this->data['user_details']->id,'is_confirm'=>1),false,false,false);
			$totalUnblk = count($getUnblockExc);
			$TodayAttendExc =0;
			$excArr = array();
			if($getUnblockExc){
				foreach($getUnblockExc as $setU){
					$excArr[] = $setU->excercise_id;
				}
			}
			if($excArr){
				$where = implode(',',$excArr);
			$query = "select * from workouts_entry_option where user_id =".$this->data['user_details']->id." and on_date ='".date('Y-m-d')."' and excercise_id in(".$where.") group by excercise_id";
			$TodayAttendExc = count($this->comman_model->get_query($query,false));
//		$TodayAttendExc = count($this->comman_model->get_by('workouts_entry_option',array('user_id'=>$this->data['user_details']->id,'on_date'=>date('Y-m-d')),false,false,false));
			}
			
			if($TodayAttendExc>0&&$totalUnblk>0){
				$output['skill_level'] = round(($TodayAttendExc/$totalUnblk)*100);
				
			}
		}
		echo json_encode($output);
	}

	function get_t_workout(){
		$output['status'] ='ok';
		$output['workout'] = '';

		if($this->data['user_details']->account_type=='A'){
			$getJoinClass = $this->comman_model->get_by('classes_join',array('user_id'=>$this->data['user_details']->id,'status'=>'confirm'),false,false,false);
			$workoutArr = array();
			$nowDTime = time();
			$nowTime = strtotime(date('H:i',time()));
		//	echo date('d-m-Y H:i',$nowDTime);
			if($getJoinClass){
				foreach($getJoinClass as $set_c){
					$query = "select * from classes where user_id=".$this->data['user_details']->parent_id." and type= 'Occasional Class' and id=$set_c->class_id and dates ='".date('Y-m-d')."' ";
					$checkCl = $this->comman_model->get_query($query,true);
					if($checkCl){
						$classStrtTime = strtotime($checkCl->dates.' '.$checkCl->s_time);
						$classEndTime = strtotime($checkCl->dates.' '.$checkCl->e_time);
						if($nowDTime>$classStrtTime&&$nowDTime<$classEndTime){
							$query = "select & from workouts where find_in_set($checkCl->id,class_id)<>0 and user_id=".$this->data['user_details']->parent_id." order by id desc";
							$workouts = $this->comman_model->get_query($query,false);
							if($workouts){
								foreach($workouts as $set_w){
									if(!in_array($set_w->id,$workoutArr)){
										$workoutArr[$set_w->id] ='<tr><td>'.$set_w->name.'</td><td>'.$set_w->workout.'</td><td><a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="Entry" href="'.$this->data['_cancel'].'/worout/entry/'.$set_w->id.'" ><i class="fa fa-edit"></i></a></td></tr>';
									}
								}
							}
							
						}
					}

					//Recurrent Class
					$query = "select * from classes where user_id=".$this->data['user_details']->parent_id." and type= 'Recurrent Class' and id=$set_c->class_id ";
					$checkCl = $this->comman_model->get_query($query,true);
					if($checkCl){
						$classStrtTime = strtotime(date('Y-m-d').' '.$checkCl->s_time);
						$classEndTime = strtotime(date('Y-m-d').' '.$checkCl->e_time);

/*						echo '<br>'.date('d-m-Y H:i',$classStrtTime);
						echo '<br>'.date('d-m-Y H:i',$classEndTime);*/
						if($nowDTime>$classStrtTime&&$nowDTime<$classEndTime){
							$query = "select * from workouts where find_in_set($checkCl->id,class_id)<>0 and user_id=".$this->data['user_details']->parent_id." order by id desc";
							$workouts = $this->comman_model->get_query($query,false);
							if($workouts){
								foreach($workouts as $set_w){
									if(!in_array($set_w->id,$workoutArr)){
										$workoutArr[$set_w->id] ='<tr><td>'.$set_w->name.'</td><td>'.$set_w->workout.'</td><td><a class="btn btn-icon-only btn-info" data-toggle="tooltip" data-placement="top"  title="Entry" href="'.$this->data['_cancel'].'/worout/entry/'.$set_w->id.'" ><i class="fa fa-edit"></i></a></td></tr>';
									}
								}
							}
							
						}
					}
				}
			}
/*			echo '<pre>';			
			print_r($workoutArr);
			die;*/
			if($workoutArr){
				$this->data['workout'] =$workoutArr;
				$output['workout'] = $this->load->view($this->_subView.'dashboard/ajax_workout',$this->data,true);
			}
		}
		echo json_encode($output);
	}

    public function review(){
	    // Fetch a page or set a new one

		$where = array('user_id'=>$this->data['user_details']->parent_id,'sender_id'=>$this->data['user_details']->id);
		$checkProduct = $this->comman_model->get_by('users_review',$where,false,false,true);
		if($checkProduct){
			$this->session->set_flashdata('error','Sorry!! You have already given.');
			redirect($this->data['_cancel']);
		}
		
		if($this->input->post('operation')){
			$post_data = $this->comman_model->array_from_post(array('rate','comment'));
			$post_data['sender_id'] = $this->data['user_details']->id;
			$post_data['user_id'] = $this->data['user_details']->parent_id;
			$post_data['type'] = 'user';
			$post_data['on_date'] = date('Y-m-d');
			$this->comman_model->save('users_review',$post_data);
			$this->session->set_flashdata('success','Your review has successfully submited.');
			redirect($this->data['_cancel']);			
		}
		
		$this->data['name'] = show_static_text($this->data['lang_id'],2054).'Review';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

//		echo $this->db->last_query();die;
        $this->data['subview'] = $this->_subView.'profile/review';
		$this->load->view($this->_mainView,$this->data);
	}

	function update_weight(){	
		if($this->data['user_details']->account_type!='A'){
			redirect($this->data['_user_link']);
		}
		$this->data['name'] = show_static_text($this->data['lang_id'],302);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$rules = array(
			'weight' 			=> array('field'=>'weight', 'label'=>'Weight', 'rules'=>'trim|numeric|required'),
			'height' 			=> array('field'=>'height', 'label'=>'Height', 'rules'=>'trim|numeric|required'),
			'muscle' 			=> array('field'=>'height', 'label'=>'Height', 'rules'=>'trim|numeric|required'),
			'gauze' 			=> array('field'=>'gauze', 'label'=>'gauze', 'rules'=>'trim|numeric|required'),
			'visceral_gauze'	=> array('field'=>'visceral_gauze', 'label'=>'Visceral Gauze', 'rules'=>'trim|numeric|required'),
			'edad_corporal'		=> array('field'=>'edad_corporal', 'label'=>'Edad corporal', 'rules'=>'trim|numeric|required'),
			'imc' 				=> array('field'=>'imc', 'label'=>'imc', 'rules'=>'trim|numeric|required'),

	   );
	   $this->data['unit_weight'] = $this->custom_model->weight_unit();
	   $this->data['unit_height'] = $this->custom_model->height_unit();
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post_data = $this->comman_model->array_from_post(array('weight','height','unit_w','unit_h','edad_corporal','imc','visceral_gauze','muscle','gauze','edad_corporal'));

			$this->comman_model->save('users',$post_data,$this->data['user_details']->id);

			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],296));
			redirect($this->data['_cancel'].'/update_weight');
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'profile/update_weight';	
		$this->load->view($this->_mainView,$this->data);
	}
	


	function checkAttendance(){
		$output['status'] ='error';
		echo json_encode($output);
	}

	function setAttendance(){
		$output['status'] ='error';
		$checkReq = $this->comman_model->get_by('athletes_attand',array('user_id'=>$this->data['user_details']->id,'on_date'=>date('Y-m-d')),false,false,false);
		if(!$checkReq){
			$arr = array(
						'user_id'=>$this->data['user_details']->id,
						'gym_id'=>$this->data['user_details']->parent_id,
						'type'=>'Athlete',
						'on_date'=>date('Y-m-d'),
						'on_datetime'=>date('Y-m-d H:i'),
						);
			$this->comman_model->save('athletes_attand',$arr);
			$output['status'] = 'ok';
		}
		echo json_encode($output);
	}


	function logout(){
        $this->session->sess_destroy();
		redirect($this->data['lang_code'].'/front/');
	}
	

	function setLang(){
		$output['status'] ='error';
		$id= $this->input->post('id');
		if (!$this->input->is_ajax_request()) { exit('no valid req.'); }
		if($id){
			$output['status'] ='ok';
			$this->db->where('id',$this->data['user_details']->id);
			$this->db->set('lang_id', $id,true);
			$this->db->update('users');
		}
		echo json_encode($output);
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */