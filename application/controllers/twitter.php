<?php
/**
 * Twitter OAuth library.
 * Sample controller.
 * Requirements: enabled Session library, enabled URL helper
 * Please note that this sample controller is just an example of how you can use the library.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Twitter extends CI_Controller
{
	private $connection;
	
	function __construct()
	{
		parent::__construct();
		// Loading TwitterOauth library. Delete this line if you choose autoload method.
		$this->load->helper(array('url'));	
		$this->load->library(array('session'));
		$this->load->library('twitteroauth');

		$this->load->model(array('comman_model'));
        $this->load->helper('url');
        // To use site_url and redirect on this controller.
		// Loading twitter configuration.
		$this->config->load('twitter');
		
		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			// If user already logged in
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
		}
		elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
		{
			// If user in process of authentication
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
		}
		else
		{
			// Unknown user
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		}
//		date_default_timezone_set('UTC');		
		date_default_timezone_set("Europe/London"); 
	}
	
	/**
	 * Here comes authentication process begin.
	 * @access	public
	 * @return	void
	 */
	public function auth()
	{
		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			// User is already authenticated. Add your user notification code here.
			//redirect(base_url('/'));
		}
		else
		{
			// Making a request for request_token
			$request_token = $this->connection->getRequestToken(base_url('/twitter/callback'));

			$this->session->set_userdata('request_token', $request_token['oauth_token']);
			$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
			
			if($this->connection->http_code == 200)
			{
				$url = $this->connection->getAuthorizeURL($request_token);
				redirect($url);
			}
			else
			{
				// An error occured. Make sure to put your error notification code here.
				//redirect(base_url('/'));
			}
		}
	}
	
	/**
	 * Callback function, landing page for twitter.
	 * @access	public
	 * @return	void
	 */
	public function callback()
	{
		if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
		{
			$this->reset_session();
			redirect(base_url('/twitter/auth'));
		}
		else
		{
			$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));
		
			if ($this->connection->http_code == 200)
			{
				$content = $this->connection->get('account/verify_credentials',array('include_email'=>'true'));
				if(isset($content->errors)){
				}
				else{					
					if(isset($content->email)){
						$check_user = $this->comman_model->get_by('users',array('email'=>$content->email),false,false,true);
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
							$register = array(
											'first_name'=>$content->name,
											'username'=>$content->screen_name,
											'email'=>$content->email,
											'user_type' =>'free',
											'status' =>1,
											'type'=>'Trainer',
											'account_type'=> 'T',
											'confirm' =>'confirm',
											);
/*							echo '<pre>';
							print_r($register);
							die;*/
							$user_id = $this->comman_model->save('users',$register);
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
					}
				}
				
				$this->session->unset_userdata('access_token');
				$this->session->unset_userdata('access_token_secret');
				$this->session->unset_userdata('request_token');
				$this->session->unset_userdata('request_token_secret');
				$this->session->unset_userdata('twitter_user_id');
				$this->session->unset_userdata('twitter_screen_name');
				//die;
				
				redirect(base_url('/'));
			}
			else
			{
				// An error occured. Add your notification code here.
				redirect(base_url('/'));
			}
		}
	}
	
	/**
	 * Reset session data
	 * @access	private
	 * @return	void
	 */
	function reset_session()
	{
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('access_token_secret');
		$this->session->unset_userdata('request_token');
		$this->session->unset_userdata('request_token_secret');
		$this->session->unset_userdata('twitter_user_id');
		$this->session->unset_userdata('twitter_screen_name');
	}
}

/* End of file twitter.php */
/* Location: ./application/controllers/twitter.php */