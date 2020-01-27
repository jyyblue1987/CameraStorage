<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Admin_Controller {
	public function __construct(){
		parent::__construct();
        $this->data['active']= 'General Settings';
		ini_set("memory_limit","2512M");
	}
    public function index(){
        $this->data['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/_layout_main',$this->data);
        
    }

	function account_info(){	
        $this->data['name'] = 'Account Info';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

	$rules= array(
			'bank_name' =>array('field'=>'bank_name','label'=>'Bank Name','rules'=>'trim|required'),
			'bank_account' =>array('field'=>'bank_account','label'=>'Bank Account','rules'=>'trim|required'),

	   );
        $this->form_validation->set_rules($rules);
        // Process the form

        if($this->form_validation->run()==TRUE){
	        $data = $this->settings_model->array_from_post(array('bank_name','bank_account'));
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['admin_link'].'/account/account_info');
        }
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = 'admin/dashboard/edit_bank';
        $this->load->view('admin/_layout_main',$this->data);
	}


	function chat_setting(){
        $this->data['active']= 'General Settings';
        $this->data['name'] = 'Chat Option';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        if($this->input->post('chat_set')){
	        $data = $this->settings_model->array_from_post(array('chat_option'));
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['admin_link'].'/account/chat_setting');
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'admin/dashboard/edit_chat';        
        $this->load->view('admin/_layout_main',$this->data);       
   	}

	function notification_setting(){
        $this->data['active']= 'Content Management';
        $this->data['name'] = 'Notification Setting';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        if($this->input->post('chat_set')){
	        $data = $this->settings_model->array_from_post(array('email_option'));
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['admin_link'].'/account/notification_setting');
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'admin/dashboard/edit_email';        
        $this->load->view('admin/_layout_main',$this->data);       
   	}
    

	function set_lang(){
		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= 'login_error';		
		$id = $this->input->post('id');
		if($id){
			$check_lang = $this->comman_model->get_by('language',array('id'=>$id),false,false,true);
			if($check_lang){
				$this->session->set_userdata('adminLangSession',array('lang_code'=>$check_lang->code,'lang_id'=>$check_lang->id));
			}
		}
		echo json_encode($msge);
	}


    public function remove_image($id=false){
		$id = $this->input->post('id');
		
		$this->db->where(array('field'=>'logo'));
		$this->db->update('setting', array('value'=>''));
/*		$msge['result']= 'success';
		echo json_encode($msge);*/

		redirect($this->data['admin_link'].'/account/setting');
		/*$file_dir ='assets/uploads/home/'.$file_name->image; 
		if(is_file($file_dir)){
			unlink($file_dir);
		}
*/	}

	public function login(){
		$this->data['title'] = 'Admin Login';
	    $dashboard = $this->data['admin_link'].'/dashboard';
        $this->account_model->loggedin() == FALSE||redirect($dashboard);
        
		$rules = $this->account_model->rules;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run()==TRUE){
			if($this->account_model->login()==TRUE){
			    redirect($dashboard);			    
			}
            else{
                $this->session->set_flashdata('error','Invalid username or password.');
                redirect($this->data['admin_link'].'/account/login');
            }
		}
		$this->data['subview'] = 'admin/user/login';
		$this->load->view('admin/login',$this->data);
	}
	

	public function logout(){
	    $this->account_model->logout();
	    @session_start();
		session_destroy();
        redirect($this->data['admin_link'].'/account/login');		
	}
    

    public function _check_old_password($str){
		$login = $this->session->all_userdata();
		$check = $this->comman_model->get_by('admin',array('id'=>$login['admin_session']['id'],'password'=>md5($this->input->post('old_password'))),false,false,true);
        if(!count($check)){
            $this->form_validation->set_message('_check_old_password',show_static_text($this->data['adminLangSession']['lang_id'],212));
            return FALSE;                    
        }
        return TRUE;
    }



	public function change_password(){			
//		die;
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],50);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active_sub']= 'email';
		$login = $this->session->all_userdata();

		$this->form_validation->set_message('matches',show_static_text($this->data['adminLangSession']['lang_id'],213));
		$rules = $this->account_model->rules_password;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run()==TRUE){
			$this->comman_model->save('admin',array('password'=>md5($this->input->post('password'))),$login['admin_session']['id']);
			$this->session->set_flashdata('success', show_static_text($this->data['adminLangSession']['lang_id'],214)); 
			redirect($this->data['admin_link'].'/account/change_password');
		}
        $this->data['edit_data'] = $this->comman_model->get_by('admin',array('id'=>$login['admin_session']['id']),FALSE,FALSE,TRUE);

        $this->data['subview'] = 'admin/dashboard/password';
        $this->load->view('admin/_layout_main',$this->data);               
	}

	function dashboard(){
		$this->check_lang();		
		$this->validateLogin();
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],80);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'home';	
        $this->data['subview'] = 'admin/dashboard/index';	
		$this->load->view('admin/_layout_main',$this->data);
	}
	

	function background(){
		$this->checkPermissions('general_setting');
		$this->load->library('image_lib');
        $this->data['name'] = 'Background Image';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'General Settings';
        $this->data['active_sub']= 'website';
		if ($this->input->post('operation')){
            //$data = $this->settings_model->array_from_post($this->settings_model->get_post_from_rules($rules)+array('footer_text','phone','address'));
            $data = array();
            if(!empty($_FILES['logo']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['background']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }

            }else{
                $data['background']  = $this->data['settings']['background'];
            }      

            if(!empty($_FILES['logo1']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo1')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['background2']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }

            }else{
                $data['background2']  = $this->data['settings']['background2'];
            }      

			//3 image
            if(!empty($_FILES['logo2']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo2')){
                    if($_FILES['logo2']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['b_background']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }

            }else{
                $data['b_background']  = $this->data['settings']['b_background'];
            }      

			//login image
            if(!empty($_FILES['logo3']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo3')){
                    if($_FILES['logo3']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['l_background']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }

            }else{
                $data['l_background']  = $this->data['settings']['l_background'];
            }      

			//register image
            if(!empty($_FILES['logo4']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo4')){
                    if($_FILES['logo4']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['r_background']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }

            }else{
                $data['r_background']  = $this->data['settings']['r_background'];
            }      
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],294));
            redirect($this->data['admin_link'].'/account/background');
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'admin/dashboard/background';
        $this->load->view('admin/_layout_main',$this->data);       
	}
	
	function setting(){
		$this->checkPermissions('general_setting');
		$this->load->library('image_lib');
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],162);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'General Settings';
        $this->data['active_sub']= 'website';
        $rules = $this->settings_model->setting_rules;
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run()==TRUE){
            //$data = $this->settings_model->array_from_post($this->settings_model->get_post_from_rules($rules)+array('footer_text','phone','address'));
            $data = $this->settings_model->array_from_post(array_merge($this->settings_model->get_post_from_rules($rules),array('phone','address','gps','website_active','website_desc','analytic_code')));
            if(!empty($_FILES['logo']['name'])){
                $config['upload_path']      = 'assets/uploads/sites/';
                $config['allowed_types']    = 'gif|jpg|png|jpeg|bmp|GIF|JPG|PNG|JEPG|BMP';
                $config['max_size']         = '60000';
                $config['max_width']        = '5000';
                $config['max_height']       = '5000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
                    $upload_data    = $this->upload->data();
                    $data['logo']  = $upload_data['file_name'];
					$this->image_lib->clear();
                }

            }else{
                $data['logo']  = $this->data['settings']['logo'];
            }      
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],294));
            redirect($this->data['admin_link'].'/account/setting');
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'admin/dashboard/setting';        
        $this->load->view('admin/_layout_main',$this->data);       
    }

	function socialnetwork(){
		$this->checkPermissions('general_setting');
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],188);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'General Settings';
        $this->data['active_sub']= 'website';
		$this->form_validation->set_rules('google', 'Google', 'trim');
		$this->form_validation->set_rules('facebook', 'Facebook', 'trim');
		$this->form_validation->set_rules('twitter', 'twitter', 'trim');
		$this->form_validation->set_rules('instagram_url', 'Instagram', 'trim');
		$this->form_validation->set_rules('skype_id', 'Skype', 'trim');
		$this->form_validation->set_rules('linkedin', 'Linkedin', 'trim');
        if($this->form_validation->run()==TRUE){
	        $data = $this->settings_model->array_from_post(array('linkedin_url','youtube_url','twitter_url','facebook_url','google_plus','skype_id','instagram_url'));
	        $this->settings_model->save_settings($data);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['admin_link'].'/account/socialnetwork');
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'admin/dashboard/social';        
        $this->load->view('admin/_layout_main',$this->data);       
    }
	

  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			$redirect = checkPermission('admin_permission',array('user_id'=>$this->data['admin_details']->id,'type'=>$type,'value'=>1));	
		}
		else{
			$redirect = 1;
		}
		
		if($redirect==0){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			if($redirect){
				redirect($redirect);
			}
			redirect($this->data['admin_link'].'');
		}		
	}

/*	function checkPremission($type=false){
		$redirect = false;
		
		if($this->data['admin_details']->default=='0'){
			if($type=='is_general'){
				if($this->data['admin_details']->is_general==1){}
				else{
					$redirect = true;
				}
			}
			else if($type =='is_payment'){
				if($this->data['admin_details']->is_payment==1){}
				else{
					$redirect = true;
				}
			}
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}
	}*/

	function email(){
		$this->checkPermissions('general_setting');
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],163);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active_sub']= 'email';
        $this->data['all_data'] = $this->comman_model->get('email',FALSE);
        $this->data['subview'] = 'admin/email/index';        
        $this->load->view('admin/_layout_main',$this->data);               
    }
	
	function edit_email($id= false){
		$this->checkPermissions('general_setting');
		$this->load->model('email_model');
        $this->data['name']= 'Email Settings';
        $this->data['active_sub']= 'email';
        if(!$id){
            redirect($this->data['admin_link'].'/account/email');
           
        }
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        
        $edit_data = $this->comman_model->get_by('email',array('id'=>$id),FALSE,FALSE,TRUE);
        if(count($edit_data)==0){
           redirect($this->data['admin_link'].'/account/email');
        }
        $this->data['edit_data'] =$edit_data;
        $setting_rules = $this->email_model->email_rules;
        $this->form_validation->set_rules($setting_rules);
        if($this->form_validation->run()==TRUE){
            $post_data = array('value'=>$this->input->post(''));
            $post_data =$this->comman_model->array_from_post(array('subject','message')); 
            $this->comman_model->save('email',$post_data,$id);
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['admin_link'].'/account/email');
        }
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = 'admin/email/edit';        
        $this->load->view('admin/_layout_main',$this->data);       
    }	
	
	function ajax_camera(){
		$output['status'] ='ok';
		$camera_id = $this->input->post('id');
//		$camera_id = 9;
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

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */