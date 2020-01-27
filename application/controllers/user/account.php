<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Frontend_Controller{	
	public $_redirect = '/user/account';

	public $_subView = 'employee/';
	public $_mainView = 'employee/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['name'] = 'Dashboard';	
        $this->load->model(array('users_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
        $detail = $this->session->all_userdata();
		$redirect = false;
		if(isset($detail['user_session'])){	
			$this->data['user_account'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
			if(!empty($this->data['user_account'])){
				if($this->data['user_account']->account_type=='S'||$this->data['user_account']->account_type=='A'){
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
		$this->data['_user_link'] = $this->data['lang_code'].'/user';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
		ini_set("memory_limit","2512M");
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

        $rules = $this->users_model->update_employee_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post_data = $this->comman_model->array_from_post(array('first_name','address','address2','phone'));
        	$post_data['username'] = $post_data['first_name'];
        	$post_data['last_name'] = '';

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

	function iframe($id=false){
		$this->data['name'] = show_static_text($this->data['lang_id'],20054).'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
	        $this->data['subview'] = $this->_subView.'dashboard/blank';
			exit();
        }
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by('camera',array('id'=>$id,'user_id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$checkProduct){
//			echo 'asd';
	        $this->data['subview'] = $this->_subView.'dashboard/blank';
			exit();
		}
		$checkClient = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id),false,false,true);
		if(!$checkClient){
	        $this->data['subview'] = $this->_subView.'dashboard/blank';
			exit();
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

		if ($this->agent->is_browser('Safari')) {
			$this->load->view($this->_subView.'dashboard/iframe_safari',$this->data);	
//	        $this->data['subview'] = $this->_subView.'dashboard/iframe_safari';
		}
		else{
			$this->load->view($this->_subView.'dashboard/iframe',$this->data);	
		}
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
	
	function programs(){
		$output['programCount'] = 0;
		$output['status'] ='ok';
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