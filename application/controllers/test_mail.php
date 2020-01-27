<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('post_max_size', '500M');
ini_set('upload_max_filesize', '500M');

ini_set( 'memory_limit', '200M' );
ini_set('max_input_time', 3600);  
ini_set('max_execution_time', 3600);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once(APPPATH.'/libraries/PHPMailer/Exception.php');
require_once(APPPATH.'/libraries/PHPMailer/PHPMailer.php');
require_once(APPPATH.'/libraries/PHPMailer/SMTP.php');


class test_mail extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model(array('email_model'));
		$this->data['smtp_data'] = array(
				'smtp_host' => '10.0.1.51',
				'smtp_user' => 'test@ilinkpro.net',
				'smtp_pass' => 'testP@$$w0rd',
				'smtp_port' => '25',
		);		
	}
	
	
	function send_smtp_1(){

		$smtp_data = array(
				'smtp_host' => '10.0.1.51',
				'smtp_user' => 'test@ilinkpro.net',
				'smtp_pass' => 'testP@$$w0rd',
				'smtp_port' => '25',
		);
		
		$post_mail = array(
								'to_email'		=> 'pvsysgroup01@gmail.com',
								'html'			=> 'this is description',
								'subject'		=> 'test mail',
								'from_email'	=> 'pvsysgroup01@gmail.com',
								'from_name'		=> 'test onlinecamera',
							);		
		
		$result = $this->email_model->send_mail_in_usersmtp($smtp_data,$post_mail);
		printR($result);

	}
	
	function send_smtp_2(){
		$this->load->library('email');
		$config = array (
			  'mailtype' =>'html',
			  'charset'  =>'utf-8',
			  'protocol'  =>'smtp',
			  'smtp_host' => $this->data['smtp_data']['smtp_host'],
			  'smtp_user' => $this->data['smtp_data']['smtp_user'],
			  'smtp_pass' => $this->data['smtp_data']['smtp_pass'],
			  'smtp_port' => $this->data['smtp_data']['smtp_port'],
			  'smtp_crypto' =>'tls',
			  '_smtp_auth' => TRUE,
			  'newline' =>"\r\n",
			  'priority' =>'1'
		   );
			   
		$this->email->initialize($config);
		$this->email->SMTPAuth = true;
		$this->email->from('pvsysgroup01@gmail.com', 'test onlinecamera');
		$this->email->to('pvsysgroup01@gmail.com');
		$this->email->subject('test mail');
		$this->email->message('this is description');
		if($this->email->send()){
			echo 'ok';
		}
		else{
			$print =  $this->email->print_debugger();
			printR($print);
			echo 'not send';
		}
	}
	
	function send_m(){
		$checkAlreayExist = FCPATH.'data/asma-molu-10/dsp-11/camera 31/files/file-12-15-2018 05-20 05-25.mp4';
//		$checkAlreayExist = FCPATH.'assets/uploads/profile.jpg';
		$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
		$this->email->initialize($config);
		$this->email->from('pvsysgroup01@gmail.com','test onlinecamera');
		$this->email->to('pvsysgroup01@gmail.com');
		$this->email->subject('testing mail');
		$this->email->message('this is description. this is description. this is description. ');
		if(is_file($checkAlreayExist)){
			$this->email->attach($checkAlreayExist);
		}
		if($this->email->send()){
			echo 'ok';
		}
		else{
			$print =  $this->email->print_debugger();
			printR($print);
			echo 'not send';
		}
	}
	
	
	function send_smtp_3(){
		die;
	//	 echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n"; die;
		$smtp_data = array(
				'smtp_host' => '10.0.1.51',
				'smtp_user' => 'test@ilinkpro.net',
				'smtp_pass' => 'testP@$$w0rd',
				'smtp_port' => '25',
		);
		
		$post_mail = array(
								'to_email'		=> 'pvsysgroup01@gmail.com',
								'html'			=> 'this is description',
								'subject'		=> 'test mail',
								'from_email'	=> 'pvsysgroup01@gmail.com',
								'from_name'		=> 'test onlinecamera',
							);		

		$mail = new PHPMailer;
		//$mail->isSMTP();
		$mail->isMail();  		
		$mail->Host     = $smtp_data['smtp_host'];
		$mail->SMTPAuth = true;
/*		$mail->SMTPAuth = false;
		$mail->SMTPSecure = false;		*/
		$mail->Username = $smtp_data['smtp_user'];
		$mail->Password = $smtp_data['smtp_pass'];
		$mail->SMTPSecure = 'ssl';//tls
		$mail->Port     = $smtp_data['smtp_port'];
		$mail->setFrom($post_mail['from_email'], $post_mail['from_name']);
		
		// Add a recipient
		$mail->addAddress($post_mail['to_email']);
		// Email subject
		$mail->Subject = $post_mail['subject'];
		
		// Set email format to HTML
		$mail->isHTML(true);
		
		// Email body content
		$mailContent = $post_mail['html'];
		$mail->Body = $mailContent;
		
		/*$mail->smtpConnect(array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		));		*/
		// Send email
		if(!$mail->send()){
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}else{
			echo 'Message has been sent';
		}		
	
	}
}
