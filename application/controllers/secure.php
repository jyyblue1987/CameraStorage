<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Secure extends Frontend_Controller{
	public $_subView = 'templates/account/';
	public function __construct(){
		parent::__construct();
		$this->load->library('user_agent');
		$this->load->library(array('recaptcha'));
		$this->load->model(array('register_model'));
	}



	function ajax_login(){

		$output= array();
		$output['status'] = 'error';
		$this->output->set_content_type('application/json');
		$this->load->library('form_validation');
		if (!$this->input->is_ajax_request()) { exit('no valid req.'); }

		$rules = $this->register_model->ajax_login;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE){
/*				$output['course_code'] =$this->form_validation->course_code_error;
				$output['name'] =$this->form_validation->name_error; */
//				echo validation_errors();
				$output['error'] =form_error('email');
				$output['error'] =form_error('password');
			}
			else{
				$send = array('LOWER(email)' => strtolower($this->input->post('email')),'password'=>$this->input->post('password'));
				$login = $this->comman_model->get_by('users',$send,false,false,true);
				//echo $this->db->last_query();die;
				if(!empty($login)){
					if($login->confirm!='confirm'){
						$output['error'] ='Your email ID has not verify.';
					}
/*					else if($login->status!=1){
						$output['error'] ='Your account has been deactived.';
					}*/
/*					else if($login->admin_confirm!=1){
						$output['error'] ='Your email ID has not verified by admin.';
					}*/
					else{
						if($this->input->post('remember')!=NULL){
							//echo 'dsfs';
							setcookie('email',$this->input->post('email'),time()+(86400*300),'/');
							//setcookie('password',$this->input->post('password'),time()+(86400*300),'/');
						}
						$output['status'] ='ok';
						$session_data = array(
								'loginType' => 'user',
								'loggedin' => true,				   
								'name' =>$login->username,
								'email' =>$login->email,
								'id' =>$login->id);				
						//$total = $login['bonus_balance']+10;
						$this->session->set_userdata('user_session',$session_data);					
/*						$insert_fields = array(
										'user_id' => $login->id,
										'type' => 'user',
										'on_date' => date('Y-m-d'),
										'login_date' => date('Y-m-d H:i:s'),
										'ip_address' => $this->input->ip_address(),
										'login_browser' => $this->input->user_agent(),
										'created' => time()
										);
						$this->db->set($insert_fields);
						$this->db->insert('users_login');*/
					}
				}
				else{
					$output['error'] ='Invalid user id or password.';
				}

			}
		echo json_encode($output);
	}

	function register(){
		$photos = array();
/*        $this->data['widget'] = $this->recaptcha->getWidget();
        $this->data['script'] = $this->recaptcha->getScriptTag();*/

		$this->data['set_meta'] = 'register';
		$this->data['active'] = "register";
		$this->data['title'] = 'Register | '.$this->data['settings']['site_name'];
		$this->data['country_data'] = $this->custom_model->get_country_name();
		$this->load->library('form_validation');

		$rules = $this->register_model->register;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		$this->form_validation->set_message('is_unique',show_static_text($this->data['lang_id'],220));
		$this->form_validation->set_message('integer',show_static_text($this->data['lang_id'],221));
		$this->form_validation->set_message('required', show_static_text($this->data['lang_id'],219));

		$this->db->order_by('name','asc');
		$this->data['country_d'] = $this->comman_model->get('countries',false);
		
		if ($this->input->post('operation')){
			if ($this->form_validation->run() == FALSE){}
			else{
				$post_data = $this->comman_model->array_from_post(array('first_name','last_name','email','password','city','phone','address','country','type'));
/*				if($post_data['type']=='Photographers'){
					$post_data['account_type'] = 'P';
				}
				elseif($post_data['type']=='Sport Nutritionist'){
					$post_data['account_type'] = 'N';
				}
				elseif($post_data['type']=='Affiliate business'){
					$post_data['account_type'] = 'B';
				}
				else{
					$post_data['account_type'] = 'S';
				}*/

				$post_data['account_type'] = 'D';
/*				if(array_key_exists($post_data['country_code'],$this->data['country_data'])){
					$post_data['country'] = $this->data['country_data'][$post_data['country_code']];
				}*/

				$dynamic_code =  random_string('alnum', 16);  
				$post_data['status'] = 1;
				$post_data['confirm'] = $dynamic_code;
				$post_data['username'] = $post_data['first_name'].' '.$post_data['last_name'];
/*				echo '<pre>';
				print_r($post_data);
				die;*/
				$checkEmail = $this->comman_model->get_by('users',array('email'=>$post_data['email']),false,false,false);
				if($checkEmail){
					$this->session->set_flashdata('error','Sorry! Email already exist.');
					redirect($this->data['lang_code'].'/secure/register');
				}
				$registerForm = $this->comman_model->save('users',$post_data);

				$folder = url_title($post_data['first_name'].'-'.$registerForm, 'dash', true);
				//for create dealer folder
				if (!is_dir('data/'.$folder)){
					mkdir('./data/'.$folder, 0777, true);
				}
	
				$this->comman_model->save($this->_table_names,array('dealer_path'=>$folder),$id);

				$email_data = $this->comman_model->get_by('email',array('id'=>1),false,false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

				$email_data->message = str_replace('{user_name}', $post_data['first_name'].' '.$post_data['last_name'], $email_data->message);
				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{site_link}', base_url().'verify/user/'.$dynamic_code.'/'.md5($registerForm), $email_data->message);
				//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);

				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
				$this->email->to($post_data['email']);
				$this->email->subject($email_data->subject);
				$this->email->message($email_data->message);
				$this->email->send();
				$this->session->unset_userdata('user_reg');
				$this->session->set_flashdata('success', show_static_text($this->data['lang_id'],216).'<br>'.show_static_text($this->data['lang_id'],217).'<br>('.show_static_text($this->data['lang_id'],218).')');
				//$this->session->set_flashdata('success', show_static_text($this->data['lang_id'],216));

				redirect($this->data['lang_code'].'/secure/register');
			}
		}
        $this->data['subview'] = $this->_subView.'register';	
		//$this->load->view('templates/_layout_main',$this->data);
		$this->load->view($this->_subView.'register',$this->data);
	}


	function login(){
		$this->data['set_meta'] = 'login';
		$this->data['active'] = "login";
		$this->data['login'] = $this->session->all_userdata();
		//$data['message'] = $this->session->flashdata('success');

        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		$rules = $this->register_model->page_login;
		$this->form_validation->set_rules($rules);
		if ($this->input->post('operation')){
			if ($this->form_validation->run() == TRUE){
					///check login attempt
					$now =time();
					if(isset($this->data['session_data']['login_attempt'])){
						$loginError = $this->data['session_data']['login_attempt'];
						if($loginError['attempt']>=8){
							$loginAttemptTime = strtotime('+15 minutes',$loginError['times']);
//							echo $loginAttemptTime.'<br>'.$now;
							if($loginAttemptTime<=$now){
								$this->session->unset_userdata('login_attempt');
							}
							else{
								$this->session->set_flashdata('error','Your account has been locked for 15 minutes, please wait 15 minutes and try again');
								redirect($this->data['lang_code'].'/secure/login');
							}
						}
						
					}
				
	//			$send = array('email' => $this->input->post('email'),'password'=>$this->input->post('password'));
				$send = array('LOWER(email)' => strtolower($this->input->post('email')),'password'=>$this->input->post('password'));
				$login = $this->comman_model->get_by('users',$send,false,false,true);
				if(!empty($login)){
					if($login->confirm!='confirm'){
						$this->session->set_flashdata('error',show_static_text($this->data['lang_id'],222));
						redirect($this->data['lang_code'].'/secure/login');
					}
/*					else if($login->status!=1){
						$this->session->set_flashdata('error',show_static_text($this->data['lang_id'],223));
						redirect($this->data['lang_code'].'/secure/login');
					}
					else if($login->admin_confirm!=1){
						$this->session->set_flashdata('error', 'Your email ID has not verified by admin.');
						redirect($this->data['lang_code'].'/secure/login');
					}*/
					else{
						if($login->account_type=='A'){
							if($login->status!=1){
								$this->session->set_flashdata('error',show_static_text($this->data['lang_id'],223));
								redirect($this->data['lang_code'].'/secure/login');
							}
						}
						$session_data = array(
								'loginType' => 'user',
								'loggedin' => true,				   
								'name' =>$login->username,
								'email' =>$login->email,
								'id' =>$login->id);				
						//$total = $login['bonus_balance']+10;
						$this->session->sess_expiration = '14400'; 
						$this->session->set_userdata('user_session',$session_data);					
	/*					$this->session->set_flashdata('success', 'welcome To '.$login->username);*/
						$this->session->unset_userdata('login_attempt');
	
						$checkRember = $this->input->post('remember_me');
						if($checkRember){
						$cookie = array(
									'name'   => 'rember_me',//recruiter_verify_mail
									'value'  => $login->email,
									'expire' => 86400*366,//1 day
								);
							set_cookie($cookie);
						}
						$getDefaultL  = $this->data['lang_code'];
						if($login->lang_id!=0){
							$getDefaultL  = print_value('language',array('id'=>$login->lang_id),'code','');
						}
						if($login->account_type=='D'){
							redirect($getDefaultL.'/dealer/account','refresh');
						}
						else if($login->account_type=='A'||$login->account_type=='C'){
							redirect($getDefaultL.'/member','refresh');
						}
						else if($login->account_type=='S'){
							redirect($getDefaultL.'/staff','refresh');
						}
						else if($login->account_type=='E'){
							redirect($getDefaultL.'/user','refresh');				
						}
						else {
							redirect($getDefaultL.'/','refresh');
					
						}
					}
				}
				else{
					$now =time();
					$ip = $this->input->ip_address();
					if(isset($this->data['session_data']['login_attempt'])){
						$loginError = $this->data['session_data']['login_attempt'];
						if($loginError['attempt']<8){
							$this->session->set_userdata('login_attempt',array('ip_address'=>$ip,'times'=>$loginError['times'],'attempt'=>$loginError['attempt']+1));
						}
						else{
							$loginAttemptTime = strtotime('+15 minutes',$loginError['times']);
//							echo $loginAttemptTime.'<br>'.$now;
							if($loginAttemptTime<=$now){
								$this->session->unset_userdata('login_attempt');
							}
							//Your account has been locked for 15 minutes, please wait 15 minutes and try again
						}
						
					}
					else{
						$this->session->set_userdata('login_attempt',array('ip_address'=>$ip,'times'=>time(),'attempt'=>1));
					}
					
					//printR($this->data['session_data']['login_attempt']);
					
					$this->session->set_flashdata('error', show_static_text($this->data['lang_id'],224));
					redirect($this->data['lang_code'].'/secure/login');
					//die;
				}
			}
		}
		

		$checkCookies = get_cookie('rember_me');
		$this->data['c_email'] = '';
		$this->data['c_pass'] = '';
		if(isset($checkCookies)&&!empty($checkCookies)){
			$c_login = $this->comman_model->get_by('users',array('email'=>$checkCookies),false,false,TRUE);
			if($c_login){
				$this->data['c_email'] = $c_login->email;
				$this->data['c_pass'] = $c_login->password;
			}
			
		}
		
        $this->data['subview'] = $this->_subView.'login';	
		$this->load->view('templates/index',$this->data);
//		$this->load->view($this->_subView.'login',$this->data);
	}

	

	function forgot(){	
		$this->data['active'] = "Forgot Password";

		$this->data['title'] = "Forgot Password | ".$this->data['settings']['site_name'];

        $this->data['widget'] = $this->recaptcha->getWidget();
        $this->data['script'] = $this->recaptcha->getScriptTag();
		$rules = array(
                    'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email'),
					'code' =>array('field'=>'code','label'=>'Code','rules'=>'callback__check_code'),
                    );

		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == true){
			$send = array('email' => $this->input->post('email'));
			$login = $this->comman_model->get_by('users',$send,false,false,TRUE);
			if(!empty($login)){
				if($login->confirm!='confirm'){
					$this->session->set_flashdata('success', show_static_text($this->data['lang_id'],222));
					redirect($this->data['lang_code'].'/secure/forgot');
				}
				else{
					$your_message = 'Hello '.$login->first_name.' '.$login->last_name.' Your password is '.$login->password;
	
					$this->load->library('email');
					$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
					$this->email->to($this->input->post('email'));
					$this->email->subject("Forgot Password");			
					$this->email->message($your_message);
					$this->email->send();
					//end varify
					$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],225));
					redirect($this->data['lang_code'].'/secure/forgot');
				}
			}
			else{
				$this->session->set_flashdata('error',show_static_text($this->data['lang_id'],226));
				redirect($this->data['lang_code'].'/secure/forgot');
			}
		}
        $this->data['subview'] = $this->_subView.'forgot';	
		$this->load->view($this->_subView.'forgot',$this->data);
	}
	

    public function _check_code($str){
		$recaptcha = $this->input->post('g-recaptcha-response');
		if (!empty($recaptcha)) {
			$response = $this->recaptcha->verifyResponse($recaptcha);
			if (isset($response['success']) and $response['success'] === true) {
	            return true;
			}
		}
            $this->form_validation->set_message('_check_code', 'Field required');
            return FALSE;
    }

/*    public function _check_code($str){
		@session_start();
		$check = $this->input->post('code');
		if(empty($_SESSION['6_letters_code'])||strcasecmp($_SESSION['6_letters_code'], $this->input->post('code')) != 0){
            $this->form_validation->set_message('_check_code', 'The captcha code does not match');
            return FALSE;
        }
            return true;
    }*/

    public function _unique_user($str){
        $this->db->where('username', $this->input->post('username'));
        $categories = $this->comman_model->get('users',true);        
        if(count($categories)){
            $this->form_validation->set_message('_unique_user', '%s already exist');
            return FALSE;
        }
        
        return TRUE;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */