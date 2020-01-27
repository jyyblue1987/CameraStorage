<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library(array('google_api/google','facebook','session'));
		$this->load->helper(array('string','url'));	
		$this->load->model('comman_model');
		$this->load->model('language_model');
        // To use site_url and redirect on this controller.
        $this->data['lang_code'] = $this->language_model->get_default();
        $this->data['lang_id'] = $this->language_model->get_id($this->data['lang_code']);

	}
	
	

	public function fb_login(){
		$user = $this->facebook->getUser();        
        if ($user) {
            try {
                $user_profile = $this->facebook->api('/me?fields=id,name,first_name,last_name,email');
            } catch (FacebookApiException $e) {
                $user = null;
            }
			$check_user = $this->comman_model->get_by('users',array('email'=>$user_profile['email']),false,false,true);
			if(count($check_user)){
				$session_data = array(
						'loginType' => 'user',
						'loggedin' => true,				   
						'name' =>$check_user->username,
						'email' =>$check_user->email,
						'id' =>$check_user->id);				
				//$total = $login['bonus_balance']+10;
				$this->session->set_userdata('user_session',$session_data);					
			}
			else{
				$dynamic_code =  random_string('alnum',4);  
				$register = array(
								'first_name'=>$user_profile['first_name'],
								'last_name'=>$user_profile['last_name'],
								'username'=>$user_profile['name'],
								'email'=>$user_profile['email'],
								'password'=>$dynamic_code,
								'type'=>'Trainer',
								'account_type'=> 'T',
							   	'user_type' =>'free',
							   	'status' =>1,
							   	'confirm' =>'confirm',
								);
				$user_id = $this->comman_model->add('users',$register);
				$login = $this->comman_model->get_by('users',array('id'=>$user_id),false,false,true);	
				$session_data = array(
						'loginType' => 'user',
						'loggedin' => true,				   
						'name' =>$login->username,
						'email' =>$login->email,
						'id' =>$login->id);				
				//$total = $login['bonus_balance']+10;
				$this->session->set_userdata('user_session',$session_data);					
			}
			redirect($this->data['lang_code'].'/trainer/');
        }else{
            $this->facebook->destroySession();
        }
		if(!$user){
			$authUrl = $this->facebook->getLoginUrl(array(
				'redirect_uri' => site_url('auth/fb_login'), 
				'scope' => array("email") // permissions here
			));
			redirect($authUrl);
		}
	}

	function linkedin_login(){
        $this->load->library('linkedin'); // load library
        session_name('linkedin');
        session_start();
        // OAuth 2 Control Flow
        if (isset($_GET['error'])) {
			redirect($this->data['lang_code'].'/secure/login');
            // linkedin returned an error
            // load any error view here
            exit;
        } elseif (isset($_GET['code'])) {
            // User authorized your application
            if ($_SESSION['state'] == $_GET['state']) {
                // Get token so you can make API calls
                $this->linkedin->getAccessToken();
            } else {

                // CSRF attack? Or did you mix up your states?
                exit;
            }
        } else {
            if ((empty($_SESSION['expires_at'])) || (time() > $_SESSION['expires_at'])) {
                // Token has expired, clear the state
                $_SESSION = array();
            }
            if (empty($_SESSION['access_token'])) {
                // Start authorization process
                $this->linkedin->getAuthorizationCode();
            }
        }
        // define the array of profile fields
        $profile_fileds = array(
            'id',
            'firstName',
            'maiden-name',
            'lastName',
            'picture-url',
            'email-address',
            'location:(country:(code))',
            'industry',
            'summary',
            'specialties',
            'interests',
            'public-profile-url',
            'last-modified-timestamp',
            'num-recommenders',
            'date-of-birth',
        );
        $user_profile = $this->linkedin->fetch('GET', '/v1/people/~:(' . implode(',', $profile_fileds) . ')');
        if ($user_profile){
			$check_user = $this->comman_model->get_by('users',array('email'=>$user_profile->emailAddress),false,false,true);
			if(count($check_user)){
				$session_data = array(
						'loginType' => 'user',
						'loggedin' => true,				   
						'name' =>$check_user->username,
						'email' =>$check_user->email,
						'id' =>$check_user->id);				
				//$total = $login['bonus_balance']+10;
				$this->session->set_userdata('user_session',$session_data);					
			}
			else{
				$dynamic_code =  random_string('alnum',4);  
				$register = array(
								'first_name'=>$user_profile->firstName,
								'last_name'=>$user_profile->lastName,
								'username'=>$user_profile->firstName.' '.$user_profile->lastName,
								'email'=>$user_profile->emailAddress,
								'type'=>'Trainer',
								'password'=>$dynamic_code,
								'account_type'=> 'T',
							   	'user_type' =>'free',
							   	'status' =>1,
							   	'confirm' =>'confirm',
								);
				$user_id = $this->comman_model->add('users',$register);
				$login = $this->comman_model->get_by('users',array('id'=>$user_id),false,false,true);	
				$session_data = array(
						'loginType' => 'user',
						'loggedin' => true,				   
						'name' =>$login->username,
						'email' =>$login->email,
						'id' =>$login->id);				
				//$total = $login['bonus_balance']+10;
				$this->session->set_userdata('user_session',$session_data);					
			}
			redirect($this->data['lang_code'].'/trainer/');
        } else {
			redirect($this->data['lang_code'].'/secure/login');
           // linked return an empty array of profile data
        }   	
	}
}

