<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_user_amount extends Frontend_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("America/Cancun"); 

	}

	function send_3(){
		$email_data = $this->comman_model->get_by('email',array('id'=>10),false,false,true);
		if(!$email_data){
			return false;
		}

		$now_day = date('d');
		if($now_day>=03){
			$string = "select * from users where account_type='D' and MONTH(update_point)!='".date('m')."' and debt_point>0 and dealer_inactive_send_3=0";
			$user_data = $this->comman_model->get_query($string,false);
			if($user_data){
				foreach($user_data as $set_data){
					$subject = $email_data->subject;
					$html = $email_data->message; 

					$subject = str_replace('{company_name}', $set_data->company_name, $subject);
					$html = str_replace('{company_name}', $set_data->company_name, $html );
					$html = str_replace('{month}', date('m'), $html );
					$html = str_replace('{year}', date('Y'), $html );
					$this->load->library('email');
					$config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
					$this->email->initialize($config);
					$this->email->from(SENDMAILID, $this->data['settings']['site_name']);
					$this->email->to($set_data->email);
					$this->email->subject($subject);
					$this->email->message($html);
					if($this->email->send()){
						$this->db->where('id', $set_data->id);
						$this->db->set('dealer_inactive_send_3',1,true);
						$this->db->update('users');
					}
				}
			}
		}
	}


	function send_6(){
		$email_data = $this->comman_model->get_by('email',array('id'=>11),false,false,true);
		$now_day = date('d');
		if(!$email_data){
			return false;
		}
		if($now_day>=06){
			$string = "select * from users where account_type='D' and MONTH(update_point)!='".date('m')."' and debt_point>0 and dealer_inactive_send_6=0";
			$user_data = $this->comman_model->get_query($string,false);
			if($user_data){
				foreach($user_data as $set_data){
					$subject = $email_data->subject;
					$html = $email_data->message; 
					$subject = str_replace('{company_name}', $set_data->company_name, $subject);
					$html = str_replace('{company_name}', $set_data->company_name, $html );
					$html = str_replace('{month}', date('m'), $html );
					$html = str_replace('{year}', date('Y'), $html );
					$this->load->library('email');
					$config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
					$this->email->initialize($config);
					$this->email->from(SENDMAILID, $this->data['settings']['site_name']);
					$this->email->to($set_data->email);
					$this->email->subject($subject);
					$this->email->message($html);
					if($this->email->send()){
						$this->db->where('id', $set_data->id);
						$this->db->set('dealer_inactive_send_6',1,true);
						$this->db->update('users');
					}
				}
			}
		}
	}
	
	function send_14(){
		$email_data = $this->comman_model->get_by('email',array('id'=>12),false,false,true);
		if(!$email_data){
			return false;
		}

		$now_day = date('d');
		if($now_day>=14){
			$string = "select * from users where account_type='D' and MONTH(update_point)!='".date('m')."' and debt_point>0 and dealer_inactive_send_14=0";
			$user_data = $this->comman_model->get_query($string,false);
			if($user_data){
				foreach($user_data as $set_data){
					$subject = $email_data->subject;
					$html = $email_data->message; 

					$subject = str_replace('{company_name}', $set_data->company_name, $subject);
					$html = str_replace('{company_name}', $set_data->company_name, $html );
					$html = str_replace('{month}', date('m'), $html );
					$html = str_replace('{year}', date('Y'), $html );
					$this->load->library('email');
					$config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
					$this->email->initialize($config);
					$this->email->from(SENDMAILID, $this->data['settings']['site_name']);
					$this->email->to($set_data->email);
					$this->email->subject($subject);
					$this->email->message($html);
					if($this->email->send()){
						$this->db->where('id', $set_data->id);
						$this->db->set('dealer_inactive_send_14',1,true);
						$this->db->update('users');
					}
				}
			}
		}
	}
}
