<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Frontend_Controller{	
	public $_redirect = '/staff/account';

	public $_subView = 'staff/';
	public $_mainView = 'staff/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['name'] = 'Dashboard';	
        $this->load->model(array('users_model','chat_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
        $detail = $this->session->all_userdata();
		$redirect = false;
		if(isset($this->data['user_details'])){	
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
		$this->data['_user_link'] = $this->data['lang_code'].'/staff';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
		ini_set("memory_limit","2512M");
	}

	function index(){
		//var_dump($this->session->all_userdata());
		$this->data['active'] = 'home';	
        $this->data['name'] = show_static_text($this->data['lang_id'],80);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['login'] = $this->session->all_userdata();
		
        $this->data['subview'] = $this->_subView.'dashboard/index';	
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
		
    public function _unique_email($str){
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('id !=', $this->data['user_details']->id);        
        $categories = $this->comman_model->get('users',true);        
        if(count($categories)){
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }

    
	
	function logout(){
        $this->session->sess_destroy();
		redirect($this->data['lang_code'].'/front/');
	}
	
	function update_online(){
		$output['status'] ='ok';
		$this->chat_model->update($this->data['user_details']->id);
		echo json_encode($output);
	}

	function userDetail(){
		$output['status'] ='ok';
		//$this->chat_model->update($this->data['user_details']->id);
		$output['requestCount'] = count($this->comman_model->get_by('user_membership_history',array('is_read'=>0,'ownner_id'=>$this->data['user_details']->perent_id),false,false,false));		
		
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

		echo json_encode($output);
	}

	function ajaxChart(){
		$table_name= 'user_membership_history';
		$id = $this->input->post('type');
//		$where = 'user_id ='.$this->data['user_details']->id;
		$where1  = "on_date > '".date('Y-m-d', strtotime('-15 day',time()))."'";

		$array = array();
		if($id=='month'){
			$where = "status='confirm' and ownner_id =".$this->data['user_details']->parent_id;
			$query = "SELECT on_date as on_date, SUM(amount) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE ".$where." GROUP BY Y,m ORDER BY on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->m)){
						if($set_data->m==1){
							$array['Jan'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==2){
							$array['Feb'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==3){
							$array['Mar'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==4){
							$array['Apr'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==5){
							$array['May'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==6){
							$array['Jun'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==7){
							$array['Jul'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==8){
							$array['Aug'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==9){
							$array['Sep'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==10){
							$array['Oct'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==11){
							$array['Nov'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==12){
							$array['Dec'] =(int)$set_data->problem_count;
						}
					}				
				}
			}
		}
		else if($id=='year'){
			$where = "status='confirm' and ownner_id =".$this->data['user_details']->parent_id;
			$query = "SELECT on_date as on_date,  SUM(amount) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE ".$where."  GROUP BY Y ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->Y)){
						$array[$set_data->Y] =(int)$set_data->problem_count;
					}				
				}
			}
		}
		else{
			$where = $where1." and status='confirm' and ownner_id =".$this->data['user_details']->parent_id;
			$query = "SELECT on_date as on_date, SUM(amount) as user_orders_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE $where GROUP BY Y,m,d ORDER BY on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			//echo $this->db->last_query();
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->on_date)){
						$array[$set_data->on_date] =(int)$set_data->user_orders_count;
					}				
				}
			}
		}
		if(empty($array)){
			$array[date('Y-m-d')] =0;
		}

	//	$array = array('05-8-2016'=>4,'6-8-2016'=>6,'7-8-2016'=>2,'8-8-2016'=>5,'9-8-2016'=>4);
		echo json_encode($array);	
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