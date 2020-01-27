<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update_balance extends Frontend_Controller{	
	public $_redirect = '/dealer/update_balance';

	public $_table_names = 'camera';

	public $_subView = 'ownner/update_balance/';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['name'] = 'Dashboard';	
		$this->data['active'] = 'Update Balance';
		$this->load->library(array('paypal_lib'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');



		$this->data['_user_link'] = $this->data['lang_code'].'/dealer';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';
		$this->_checkUser();
	}

	function index(){
        $this->data['name'] = show_static_text($this->data['lang_id'],41005).'Make Monthly Pyament';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['subview'] = $this->_subView.'index';
		$this->load->view($this->_mainView,$this->data);
	}
	
	function get_update(){
		$this->session->unset_userdata('user_subscribe');
		$this->session->unset_userdata('user_amount_sess');
		session_start();
		$str = '';
		$url = base_url().$this->data['_cancel'];	
	
		$amount = abs($this->data['user_details']->debt_point);
		if($amount==0){
			$this->session->set_flashdata('error','Sorry!! amount is 0');
			redirect($this->data['_cancel']);
		}

		$session = array('name'=>'Get Balance','price'=>$amount);
		$total = $amount;
		$str .= "&L_PAYMENTREQUEST_0_AMT0=".$total."&L_PAYMENTREQUEST_0_NAME0=".$session['name']."&L_PAYMENTREQUEST_0_QTY0=1";
		$total = $total;

		$paymentAmount = $str;
		$_SESSION["Payment_Amount"] = $paymentAmount;
		//$currencyCodeType = "EUR";
		$currencyCodeType = "USD";
		$paymentType = "Sale";
		$returnURL = $url."/review";
		$cancelURL = $url."/";
		$resArray = $this->paypal_lib->CallShortcutExpressCheckout1($paymentAmount,$total,$currencyCodeType, $paymentType, $returnURL, $cancelURL);
		//$resArray = CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);
		$ack = strtoupper($resArray["ACK"]);
//			printR($resArray);die;
		if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING"){
			$newdata = array(
				'total'				=> $total,
			   );
			$this->session->set_userdata('user_subscribe',$newdata);	
			$this->paypal_lib->RedirectToPayPal( $resArray["TOKEN"] );
		}
		else{
			$this->session->set_flashdata('error','Sorry!! Paypal not available.');
			redirect($this->data['_cancel']);
		}			
	}

	function review(){	
		session_start();
		$token = "";
		if(isset($_GET['token'])){
			$token = $_GET['token'];
		}
		if ($token!=""){
			$resArray = $this->paypal_lib->GetShippingDetails($token);
			$ack = strtoupper($resArray["ACK"]);
			if( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING"){
				$this->data['amount'] = $resArray['AMT'];

				$membership_paypal_sess = $this->session->userdata('user_amount_sess');
				if(isset($membership_paypal_sess)&&!empty($membership_paypal_sess)){
				}
				else{
					$post_data =array(
							'token'				=> $resArray['TOKEN'],
							'PayerID'			=> $resArray['PAYERID'],
							'currencyCodeType'	=> $resArray['CURRENCYCODE'],
							'amt'				=> $resArray['AMT'],
							'payment_record1'	=> serialize($resArray),
							'payment_type'		=> 'Paypal',
							);

					$this->session->set_userdata('user_amount_sess',$post_data);
				}				
				$this->session->set_userdata('PAYMENTREQUEST_0_AMT',$resArray['PAYMENTREQUEST_0_AMT']);
				$this->data['subview'] = $this->_subView.'review';
				$this->load->view($this->_mainView,$this->data);
		
			} 
			else  
			{
				//Display a user friendly Error on the page using any of the following error information returned by PayPal
				$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
				$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
				$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
				$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
				$this->session->set_flashdata('error',$ErrorLongMsg);
				redirect($this->data['_cancel']);
				

			}
		}	
		else{
			$this->session->set_flashdata('error','Sorry!! There is some problem.');
			redirect($this->data['_cancel']);
		}
	}

	function order_confirm(){				
		session_start();
		$this->data['login'] = $this->session->all_userdata();
		$PaymentOption = "PayPal";
		if ( $PaymentOption == "PayPal" ){
			//var_dump($_SESSION);

			$finalPaymentAmount =  $this->data['login']['PAYMENTREQUEST_0_AMT'].$_SESSION["Payment_Amount"];
			//die;
			//$finalPaymentAmount =  $resArray['AMT'];
			$resArray = $this->paypal_lib->ConfirmPayment($finalPaymentAmount );
			$ack = strtoupper($resArray["ACK"]);
			if( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" ){						
				$post_data						= $this->data['session_data']['user_amount_sess'];
				$post_data['on_date'] 			= date('Y-m-d');
				$post_data['user_id'] 			= $this->data['user_details']->id;
				$post_data['subscribe_status']	= 'confirm';
				$post_data['transaction_id']	= isset($resArray['PAYMENTINFO_0_TRANSACTIONID'])?$resArray['PAYMENTINFO_0_TRANSACTIONID']:'';
				$this->db->trans_start();
				$payment_id = $this->comman_model->save('user_history',$post_data);
				$this->db->where('id', $this->data['user_details']->id);
				$this->db->set('debt_point', 0, true);
				$this->db->set('update_point',date('Y-m-d'),true);
				$this->db->set('dealer_inactive_send_3',0,true);
				$this->db->set('dealer_inactive_send_6',0,true);
				$this->db->set('dealer_inactive_send_14',0,true);
				$this->db->set('dealer_inactive_msge',0,true);
				$this->db->update('users');
				$this->db->trans_complete();

				$this->session->set_flashdata('success','Thank you for your update balance');
				$this->session->unset_userdata('user_subscribe');
				$this->session->unset_userdata('user_amount_sess');
			//	$data['userSubscribed'] = $this->isUserSubscribed();
				redirect($this->data['_cancel']);
				die;
			}
			else  
			{
				//Display a user friendly Error on the page using any of the following error information returned by PayPal
				$ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
				$ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
				$ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
				$ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);
				
				$error = "<br>Detailed Error Message: " . $ErrorLongMsg;
				$error .="<br>Short Error Message: " . $ErrorShortMsg;
				$this->session->set_flashdata('error', $error);
				redirect($this->data['_cancel']);
			}
		}	
	}
	
	function _checkUser(){
		$redirect = false;
		if(isset($this->data['user_details'])){	
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
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */