<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once(APPPATH.'/libraries/PHPMailer/Exception.php');
require_once(APPPATH.'/libraries/PHPMailer/PHPMailer.php');
require_once(APPPATH.'/libraries/PHPMailer/SMTP.php');

class Email_model extends CI_Model {
    public $email_rules = array(
                    'subject' =>array('field'=>'subject','label'=>'Subject','rules'=>'trim|required'),
                    'message' =>array('field'=>'message','label'=>'Message','rules'=>'trim|required'),                    
                    ); 

					
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	
	
	public function send_mail_in_ci($data){
		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);

		$this->email->from($data['from_email'],  $data['from_name']);
		$this->email->to($data['to_email']);
		
		$this->email->subject( $data['subject']);
		$this->email->message( $data['html']);
		if($this->email->send()){
			return 'sent';
		}
		else{
/*			echo 'ok: '.$this->email->print_debugger();
			printR($errors);die;*/
			return 'error';
		}
	}
		
	public function send_mail_in_smtp($data){
		$this->load->library('email');
		$config = array (
			  'mailtype' =>'html',
			  'charset'  =>'utf-8',
			  'protocol'  =>'smtp',
			  'smtp_host' => C_SMTP_HOST,
			  'smtp_user' => C_SMTP_USER,
			  'smtp_pass' => C_SMTP_PASS,
			  'smtp_port' => C_SMTP_PORT,
			  'smtp_crypto' =>'tls',
			  '_smtp_auth' => TRUE,
			  'newline' =>"\r\n",
			  'priority' =>'1'
		   );
			   
		$this->email->initialize($config);
		$this->email->SMTPAuth = true;
		$this->email->from($data['from_email'],  $data['from_name']);
		if(isset($data['cc'])){
			$this->email->bcc($data['cc']);
		}
		$this->email->to($data['to_email']);
		
		$this->email->subject( $data['subject']);
		$this->email->message( $data['html']);
		if($this->email->send()){
			return 'sent';
		}
		else{
			return 'error';
		}
		
	}
	
	public function send_mail_in_usersmtp($smtp,$data){
		$this->load->library('email');
		$config = array (
			  'mailtype' =>'html',
			  'charset'  =>'utf-8',
			  'protocol'  =>'smtp',
			  'smtp_host' => $smtp['smtp_host'],
			  'smtp_user' => $smtp['smtp_user'],
			  'smtp_pass' => $smtp['smtp_pass'],
			  'smtp_port' => $smtp['smtp_port'],
			  'smtp_crypto' =>'tls',
			  '_smtp_auth' => TRUE,
			  'newline' =>"\r\n",
			  'priority' =>'1'
		   );
			   
		$this->email->initialize($config);
		$this->email->SMTPAuth = true;
		$this->email->from($data['from_email'],  $data['from_name']);
		if(isset($data['cc'])){
			$this->email->bcc($data['cc']);
		}
		$this->email->to($data['to_email']);
		
		$this->email->subject( $data['subject']);
		$this->email->message( $data['html']);
		if($this->email->send()){
			return 'sent';
		}
		else{
			return 'error';
		}
		
	}	
	 
	function send_smtp_lib($smtp_data,$post_mail){

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
			return array('status'=>'error','message'=>'Message could not be sent.');
		}else{
			return array('status'=>'ok','message'=>'Message has been sent');
		}		
	}
//  Function to verify the user login credentials.
	function verifyUserLogin($user_name, $user_password)
	{
		
		 $query = $this->db->get_where('admin',array('adminname'=>$user_name ,'password'=>md5($user_password), 'status'=>1));
		//echo $this->db->last_query();die;
		return $query->row_array();
	}

	function update_password($old_pass,$new_pass,$id){
		$array = array('id' =>$id,'password'=>md5($old_pass));
		$update = array('password'=>md5($new_pass));
		$query = $this->db->get_where('admin',$array);
		//echo $this->db->last_query();die;
		if($query->row_array()){
			$this->db->where('id', $id);
			$this->db->update('admin', $update); 
			return 'yes';
		}
		else{
			return 'no';
		}
	}
	
						
}

// END Admin_model Class

/* End of file admin_model.php */
/* Location: ./application/models/admin_model.php */