<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends Frontend_Controller{	
	public $_redirect = '/dealer/user';
	public $_subView = 'ownner/client/';
	public $_table_names = 'users';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'People';
        $this->load->model(array('user_staff_model','email_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/dealer';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
		$checkEmail = $this->comman_model->get_by('users_email',array('user_id'=>$this->data['user_details']->id,'email_id'=>8),false,false,true);
		if(!$checkEmail){
			$this->data['error_message'] = 'lease set/update your personalized custom E-Mail notifications under “Content Management-Notifications” before creating a client, to insure that the proper format as well as the content of the E-Mails are being sent to your clients.';
		}
		
        $this->data['timeszone_list'] = array('EST' => "US Eastern Standard (EST)", 'CST' => "US Central Standard (CST)",'MST' => "US Mountain Standard (MST)",'PST' => "US Pacific Standard (PST)");
		
	//	$this->_checkPaidUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],1000).'Client';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('parent_id'=>$this->data['user_details']->id,'account_type'=>'A'),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function create(){				
//		$this->_checkPlan();
		$this->data['name'] = show_static_text($this->data['lang_id'],257);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

	   	$this->db->order_by('name','asc');
        $this->data['countries_data'] = $this->comman_model->get('countries',false);

		$total_camera = 0;
		if($this->data['user_details']->c_num>0){
			$use_camera = $this->comman_model->get_query('SELECT SUM(c_num)AS total_c FROM users WHERE parent_id='.$this->data['user_details']->id.' GROUP BY parent_id ',true);
			if($use_camera&&$use_camera->total_c>0){
				if($this->data['user_details']->c_num>$use_camera->total_c){
					$total_camera = $this->data['user_details']->c_num-$use_camera->total_c;
				}
			}

/*			$use_camera = count($this->comman_model->get_by('camera_free',array('dealer_id'=>$this->data['user_details']->id),false,false,false));
			if($this->data['user_details']->c_num>$use_camera){
				$total_camera = $this->data['user_details']->c_num-$use_camera;
			}*/
		}
		$this->data['total_camera'] = $total_camera;
        $rules = $this->user_staff_model->create_athletes_rules;
        $this->form_validation->set_rules($rules);
		$this->form_validation->set_message('is_unique',show_static_text($this->data['lang_id'],60));
        // Process the form
        if($this->form_validation->run() == TRUE){
			
        	$post_data = $this->comman_model->array_from_post(array(
							'first_name','company_name','email','password','flash_notes',
							'phone','phone2','address','city','state','zip','country','c_num',
/*							'discount',*/
							));


			$checkEmail = $this->comman_model->get_by('users',array('LOWER(email)'=>strtolower($post_data['email'])),false,false,false);
			if($checkEmail){
				$this->session->set_flashdata('error',show_static_text($this->data['lang_id'],60));
				redirect($this->data['_cancel'].'/create');
			}

			//$post_data['play_w_pay'] = 1;
        	$post_data['username'] = $post_data['first_name'];
/*			$this->load->library('image_lib');
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
				$post_data['image'] = $this->data['user_details']->logo;
			}*/


			$dynamic_code =  random_string('alnum', 16);  
			$post_data['confirm']		= $dynamic_code;
			$post_data['created_by'] 	= 'Dealer';
			$post_data['account_type'] 	= 'A';
			$post_data['type']			= 'Client';
			$post_data['status'] 		= 1;
			$post_data['parent_id'] 	= $this->data['user_details']->id;

			$reg = $this->comman_model->save('users',$post_data);
			$this->send_mail($reg);/*send mail*/			
			
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],2101).'Data has successfully created.');
			redirect($this->data['_cancel']);
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'create';
		$this->load->view($this->_mainView,$this->data);
	}

    public function edit($id = NULL){
		if(!$id)
			redirect($this->data['_cancel']);
	
		$this->data['name'] = show_static_text($this->data['lang_id'],2570).'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['users'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id,'account_type'=>'A'),false,false,true);
		if(!$this->data['users']){
			redirect($this->data['_cancel']);
		}

	   	$this->db->order_by('name','asc');
        $this->data['countries_data'] = $this->comman_model->get('countries',false);

        $rules = $this->user_staff_model->update_athletes_rules ;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			
        	$post_data = $this->comman_model->array_from_post(array(
							'first_name','company_name','password','flash_notes',
							'phone','phone2','address','city','state','zip','country',
/*							'discount',*/
							));

        	$post_data['username'] = $post_data['first_name'];
/*			$this->load->library('image_lib');
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
				$post_data['image'] = $this->data['user_details']->logo;
			}
*/

			//$post_data['play_w_pay'] = 1;
			$post_data['account_type'] 	= 'A';
			$post_data['type']			= 'Client';

			$this->comman_model->save('users',$post_data,$id);
/*			echo '<pre>';
			print_r($data2);
			die;*/
//			echo $this->db->last_query();die;
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],2101).'Data has successfully updated.');
			redirect($this->data['_cancel'].'/edit/'.$id);
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'edit';
		$this->load->view($this->_mainView,$this->data);
	}
	
	public function free_camera_form($id = NULL){
		if(!$id)
			redirect($this->data['_cancel']);
	
		$this->data['name'] = show_static_text($this->data['lang_id'],2570).'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['users'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id,'account_type'=>'A'),false,false,true);
		if(!$this->data['users']){
			redirect($this->data['_cancel']);
		}
		if($this->data['users']->free_camera>0){
			$this->session->set_flashdata('error','Sorry You have  already set!!');
			redirect($this->data['_cancel']);
		}

		$rules = array(
			'free_camera' =>array('field'=>'free_camera','label'=>'Camera','rules'=>'trim'),
		  );
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$string = "select SUM(free_camera) as free_camera from users where parent_id=".$this->data['user_details']->id.' group by parent_id';
			$count_camera = $this->comman_model->get_query($string,true);
/*			if($count_camera&&($count_camera->free_camera)>$this->data['user_details']->c_num){
				$this->session->set_flashdata('error','Sorry You have '.($this->data['user_details']->c_num-$count_camera->free_camera).' free camera!!');
				redirect($this->data['_cancel'].'/free_camera_form/'.$id);
			}*/
			
        	$post_data = $this->comman_model->array_from_post(array('free_camera'));

			if($count_camera&&($count_camera->free_camera+$post_data['free_camera'])>$this->data['user_details']->c_num){
				$this->session->set_flashdata('error','Sorry You have '.($this->data['user_details']->c_num-$count_camera->free_camera).' free camera!!');
				redirect($this->data['_cancel'].'/free_camera_form/'.$id);
			}
			//die;
			$this->comman_model->save('users',$post_data,$id);
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],2101).'Data has successfully updated.');
			redirect($this->data['_cancel']);
		}
		$string = "select SUM(free_camera) as free_camera from users where parent_id=".$this->data['user_details']->id.' group by parent_id';
		$count_camera = $this->data['count_camera'] = $this->comman_model->get_query($string,true);
		if($count_camera&&$count_camera->free_camera>=$this->data['user_details']->c_num){
			$this->session->set_flashdata('error','Sorry You have no free camera!!');
			redirect($this->data['_cancel']);
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'free_camera';
		$this->load->view($this->_mainView,$this->data);
	}
	
	function send_mail($id=false){
		if(!$id){
			return false;
		}

		$checkUser = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id,'account_type'=>'A'),false,false,true);
		if(!$checkUser)
			return false;

		$email_data = $this->comman_model->get_by('users_email',array('user_id'=>$this->data['user_details']->id,'email_id'=>8),false,false,true);
		if(!$email_data){
			return false;
		}

		$support = $this->comman_model->get_by('users_e_setup',array('user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$support){
			return false;
		}
		
		if($this->data['settings']['email_option']==1){
			$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
			$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);
	
			$email_data->message = str_replace('{user_name}', $checkUser->first_name.' '.$checkUser->last_name, $email_data->message);
			$email_data->message = str_replace('{user_email}', $checkUser->email, $email_data->message);
			$email_data->message = str_replace('{password}', $checkUser->password, $email_data->message);
			$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
			$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
//			$email_data->message = str_replace('{login_link}', site_url($this->data['lang_code'].'/secure/login'), $email_data->message);
			$email_data->message = str_replace('{login_link}', base_url().'verify/user/'.$checkUser->confirm.'/'.md5($id), $email_data->message);
			//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);
			//echo $email_data->message;die;

			$support = $this->comman_model->get_by('users_e_setup',array('user_id'=>$this->data['user_details']->id),false,false,true);
			if(!$support){
				return false;
			}
			if($support->type=='smtp'){
				$post_mail = array(
								'to_email'		=> $checkUser->email,
								'html'			=> $email_data->message,
								'subject'		=> $email_data->subject,
								'from_email'	=> $support->email,
								'from_name'		=> $this->data['user_details']->company_name,
							);
				$smtp_data = array(
						'smtp_host' => $smtp_data->smtp_host,
						'smtp_user' => $smtp_data->smtp_user,
						'smtp_pass' => $smtp_data->smtp_pass,
						'smtp_port' => $smtp_data->smtp_port,
				);
				$result = $this->email_model->send_mail_in_usersmtp($smtp_data,$post_mail);
				if($result=='sent'){
					return true;
				}
				else{
					return false;
				}
			}
			else if($support->type=='system'){
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from(SENDMAILID, $this->data['settings']['site_name']);
				$this->email->to($checkUser->email);
				$this->email->subject($email_data->subject);
				$this->email->message($email_data->message);
				if($this->email->send()){
					return true;
				}
			}
			else {
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($support->email, $this->data['user_details']->company_name);
				$this->email->to($$checkUser->email);
				$this->email->subject($email_data->subject);
				$this->email->message($email_data->message);
				if($this->email->send()){
					return true;
				}
			}
			
			if($this->email->send()){
				return true;
			}
		}
		return false;		
	}
		

	function get_active(){
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='Please login first!!';

		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		$check_data = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id),false,false,true);
		if($check_data){
			if($type=='status'){
				$output['status'] = 'ok';
				if($check_data->status==1){
					$post_data = array('status'=>0);
				}
				elseif($check_data->status==0){
					$post_data = array('status'=>1);
				}
				else{
					$post_data = array('status'=>1);
				}
				$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
			}
		}
		else{
			$output['msge'] ='There is no user!!';
		}
		echo json_encode($output);
	}

	function set_free_camera(){
		$msge = array();
		$msge['status']= 'error';
		$msge['msg']= 'Please Login First!!';
		//$msg = 0;
		$id = $this->input->post('id');
		if($id){
			$checkUser = $this->comman_model->get_by($this->_table_names,array('parent_id'=>$this->data['user_details']->id,'id'=>$id,'account_type'=>'A'),false,false,true);
			if($checkUser){
				if($checkUser->is_f_c==0){
					//for update use class in this membership
					$this->db->where('id', $id);
					$this->db->set('is_f_c',1, true);
					$this->db->update('users');					
					$msge['status'] = 'ok';
					$msge['msg']= '';
					
				}
				else{
					$msge['msg']= 'You have already set!!';
				}
			}
			else{
				$msge['msg']= 'There is no client!!';
			}
		}
		else{
			$msge['msg']= 'There is no client!!';
		}
		echo json_encode($msge);
		//echo $msg;	
	}

	function _checkPaidUser(){
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	}


	function _checkPlan(){
		if($this->data['user_details']->plan_id!=0){
/*			echo 'Total: '.$this->data['user_details']->total_point;
			echo '<br>';
			echo 'use IN : '.$this->data['user_details']->credits_point+$this->data['user_details']->plan_coach;*/
			if($this->data['user_details']->total_point<($this->data['user_details']->credits_point+$this->data['user_details']->plan_member)){
				$this->session->set_flashdata('error','Enough Balance!!'); 
				redirect($this->data['_cancel']);
			}
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_cancel']);
		}

		if($this->data['user_details']->total_point>0){
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	}


	public function _unique_email($str){
		//$login = $this->session->all_userdata();
		$check = $this->comman_model->get_by('users',array('LOWER(email)'=>strtolower($str)),false,false,true);
        if($check){
            $this->form_validation->set_message('_unique_email','System already has an account with this email address, please use a different email address for this account');
            return FALSE;                    
        }
        return TRUE;
    }


	function set_confirm($id=false){
		if(!$id)
			redirect($this->data['_cancel']);

		$checkUser = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkUser)
			redirect($this->data['_cancel']);

		$this->comman_model->save($this->_table_names,array('confirm'=>'confirm'),$id);
		redirect($this->data['_cancel']);		
	}
		
	function delete($id=false){
		ini_set("memory_limit","2512M");
		if(!$id){
			redirect($this->data['_cancel']);			
		}
		$clients = $this->comman_model->get_by('users',array('id'=>$id,'parent_id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);
		if(!$clients){
			redirect($this->data['_cancel']);			
		}

		if(!empty($this->data['user_details']->dealer_path)&&!empty($clients->folder_path)){
			$path = '/var/www/html/data/'.$this->data['user_details']->dealer_path.'/'.$clients->folder_path;
			if(ENVIRONMENT=='production'){
				$path = 'data/'.$this->data['user_details']->dealer_path.'/'.$clients->folder_path;
			}
			$this->deleteDir($path);
		}
		
		$get_camera  = $this->comman_model->get_by('users',array('parent_id'=>$clients->id),FALSE,FALSE,false);
		if($get_camera){
			foreach($get_camera as $set_c){
				$check_camera_delete = $this->comman_model->get_by('camera_deleted',array('camera_id'=>$set_c->id),FALSE,FALSE,TRUE);
				if(!$check_camera_delete){
					$this->comman_model->save('camera_deleted',array('camera_id'=>$set_c->id,'camera_path'=>$set_c->camera_path));
				}

			}
		}
			
		$this->db->delete('groups',array('user_id'=>$clients->id));
		$this->db->delete('groups_c',array('user_id'=>$clients->id));
		$this->db->delete('user_history',array('user_id'=>$clients->id));
		$this->db->delete('user_online',array('user_id'=>$clients->id));
		$this->db->delete('user_playback_sent',array('user_id'=>$clients->id));
		$this->db->delete('users_chat',array('from_id'=>$clients->id));
		$this->db->delete('users_chat',array('to_id'=>$clients->id));
		$this->db->delete('camera',array('user_id'=>$clients->id));
		$this->db->delete('users',array('parent_id'=>$clients->id));
		
		$this->db->delete('users', array('id'=>$id,'parent_id'=>$this->data['user_details']->id)); 
		redirect($this->data['_cancel']);			
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
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}	
		
	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='D'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
		if($this->data['user_details']->parent_id!=0){
				redirect($this->data['lang_code'].'/user');
		}

	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */