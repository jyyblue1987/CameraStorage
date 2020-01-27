<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verify extends CI_Controller {

 	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->load->model(array('admin_model','user_model','comman_model','settings_model','language_model'));
		$this->load->helper('url');	

		$this->data['lang_code'] = $this->language_model->get_default();        
        $this->data['settings'] = $this->settings_model->get_fields();
	}

	public function index(){
	}
	
	function agency($key=false,$id= false){
		
		//$string = 'eccbc87e4b5ce2fe28308fd9f2a7baf3';
		if($key and $id){
			$show = $this->user_model->check_agency($id,$key);
			if($show=='error'){
				$this->session->set_flashdata('error', 'Sorry You have something mistake');
			}
			else if($show=='verified'){
				$this->session->set_flashdata('error', 'You have already verified.');				
			}
			else {
				$email_data = $this->comman_model->get_by('email',array('id'=>2),false,false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{site_link}', base_url(), $email_data->message);

				$email_data->message = str_replace('{user_name}', $show['username'], $email_data->message);
				$email_data->message = str_replace('{user_email}', $show['email'], $email_data->message);
				$email_data->message = str_replace('{user_password}', $show['password'], $email_data->message);
				//echo $email_data->message ;die;
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($show['email'], 'Welcome To '.$this->data['settings']['site_name']);
				//$this->email->to('sushant.goralkar@gmail.com');
				$this->email->to($this->data['settings']['site_email']);
				$this->email->subject($email_data->subject);			
				$this->email->message($email_data->message);
				$this->email->send();

				$this->session->set_flashdata('success', 'Thank you for verifying your e-mail!');				
			}
			redirect($this->data['lang_code'].'/secure/join_us');
		}	
	}
	function user($key=false,$id= false){
		//$string = 'eccbc87e4b5ce2fe28308fd9f2a7baf3';
		if($key and $id){
			$show = $this->user_model->check_user($id,$key);
			if($show=='error'){
				$this->session->set_flashdata('error', 'Sorry You have something mistake');
			}
			else if($show=='verified'){
				$this->session->set_flashdata('error', 'You have already verified.');				
			}
			else {
				$email_data = $this->comman_model->get_by('email',array('id'=>2),false,false,true);
							
				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{site_link}', base_url(), $email_data->message);

				$email_data->message = str_replace('{user_name}', $show['username'], $email_data->message);
				$email_data->message = str_replace('{user_email}', $show['email'], $email_data->message);
				$email_data->message = str_replace('{user_password}', $show['password'], $email_data->message);
				//echo $email_data->message ;die;
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($show['email'], 'Welcome To '.$this->data['settings']['site_name']);
				//$this->email->to('sushant.goralkar@gmail.com');
				$this->email->to($this->data['settings']['site_email']);
				$this->email->subject($email_data->subject);			
				$this->email->message($email_data->message);
				$this->email->send();

				$this->session->set_flashdata('success', 'Thank you for verifying your e-mail!');				
			}
			redirect($this->data['lang_code'].'/secure/login');
		}
	}
}
