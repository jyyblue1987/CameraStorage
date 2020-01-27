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
		session_start();
		$str = '';
		$url = base_url().$this->data['_cancel'];	
	
        $this->data['name'] = show_static_text($this->data['lang_id'],41005).'Update Balance';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$class_rules = array(
			'amount' => array('field'=>'amount', 'label'=>'amount', 'rules'=>'trim|required|integer'),
		);
        $this->form_validation->set_rules($class_rules);
		if($this->form_validation->run() == TRUE){
			$amount = $this->input->post('amount');
	
			$session = array('name'=>'Get Balance','price'=>$amount);
			$total = $amount;
			$str .= "&L_PAYMENTREQUEST_0_AMT0=".$total."&L_PAYMENTREQUEST_0_NAME0=".$session['name']."&L_PAYMENTREQUEST_0_QTY0=1";
			$total = $total;

			$paymentAmount = $str;
			$_SESSION["Payment_Amount"] = $paymentAmount;
			//$currencyCodeType = "EUR";
			$currencyCodeType = "MXN";
			$paymentType = "Sale";
			$returnURL = $url."/review";
			$cancelURL = $url."/";
			$resArray = $this->paypal_lib->CallShortcutExpressCheckout1($paymentAmount,$total,$currencyCodeType, $paymentType, $returnURL, $cancelURL);
			//$resArray = CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);
			$ack = strtoupper($resArray["ACK"]);
			if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING"){
				$newdata = array(
					'user_id'  			=> $this->data['user_details']->id,
					'subscribe_type'	=> 'balance',
					'total'				=> $total,
					'price'				=> $total,
					'email' 			=> $this->data['user_details']->email,
				   );
				$this->session->set_userdata('user_subscribe',$newdata);	
				$this->paypal_lib->RedirectToPayPal( $resArray["TOKEN"] );
			}
			else{
			}			
	
			//for test
			$newdata = array(
				'user_id'  			=> $this->data['user_details']->id,
				'subscribe_type'	=> 'balance',
				'total'				=> $total,
				'price'				=> $total,
				'email' 			=> $this->data['user_details']->email,
			   );
			$this->session->set_userdata('user_subscribe',$newdata);	
		}
		//$this->data['login'] = $this->session->all_userdata();
		$this->data['subview'] = $this->_subView.'index';
		$this->load->view($this->_mainView,$this->data);
	}

	function review(){	
		session_start();
		$token = "";
		if(isset($_REQUEST['token'])){
			$token = $_REQUEST['token'];
		}
		if ($token!=""){
			$resArray = $this->paypal_lib->GetShippingDetails($token);
			$ack = strtoupper($resArray["ACK"]);
			if( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING"){
				$this->data['amount'] = $resArray['AMT'];
				$post_data =array(
							'token'				=> $resArray['TOKEN'],
							'PayerID'			=> $resArray['PAYERID'],
							'currencyCodeType'	=> $resArray['CURRENCYCODE'],
							'amt'				=> $resArray['AMT'],
							'payment_record'	=> serialize($resArray),

							'user_id'			=> $this->data['user_details']->id,
							'payment_type'		=> 'Paypal',
							'on_date'			=> date('Y-m-d'),
							);		
				$check = $this->comman_model->get_by('user_history',array('token'=>$resArray['TOKEN']),false,false,true);
				if($check){
					$res = $check->id;
				}
				else{
					$res = $this->comman_model->save('user_history',$post_data);
				}
				$this->session->set_userdata('PAYMENTREQUEST_0_AMT',$resArray['PAYMENTREQUEST_0_AMT']);
				$this->session->set_userdata('subscribe_user_id',$res);
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
				
				echo "<br>GetExpressCheckoutDetails API call failed. ";
				echo "<br>Detailed Error Message: " . $ErrorLongMsg;
				echo "<br>Short Error Message: " . $ErrorShortMsg;
				echo "<br>Error Code: " . $ErrorCode;
				echo "<br>Error Severity Code: " . $ErrorSeverityCode;
				die;
/*				$this->session->set_flashdata('error','Sorry!! Paypal not available.');
				redirect($this->data['lang_code'].'/cart/checkout');				*/

			}
		}	
		else{
			//for  test
/*			$post_data =array(
						'token'				=> '4234242',
						'PayerID'			=> '43342342',
						'currencyCodeType'	=> 'USD',
						'amt'			=> $this->data['session_data']['user_subscribe']['price'],
//						'payment_record'	=> serialize($resArray),

						'user_id'			=> $this->data['user_details']->id,
						'payment_type'		=> 'Paypal',
						'on_date'			=> date('Y-m-d'),
						);		
			$check = $this->comman_model->get_by('user_history',array('token'=>$post_data['token']),false,false,true);
			if($check){
				$res = $check->id;
			}
			else{
				$res = $this->comman_model->save('user_history',$post_data);
			}
			$this->session->set_userdata('subscribe_user_id',$res);

			$this->data['subview'] = $this->_subView.'review';
			$this->load->view($this->_mainView,$this->data);*/
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
				$this->comman_model->update_by('user_history',array('subscribe_status'=>'confirm'),array('id'=>$this->data['login']['subscribe_user_id']));
				$this->db->where('id', $this->data['user_details']->id);
				$this->db->set('total_point', 'ROUND(total_point+'.$this->data['login']['user_subscribe']['price'].',2)', FALSE);
				$this->db->update('users');

				$this->session->set_flashdata('success','Thank you for your update balance');
				$this->session->unset_userdata('user_subscribe');
				$this->session->unset_userdata('subscribe_user_id');
			//	$data['userSubscribed'] = $this->isUserSubscribed();
				redirect($this->data['_cancem']);
				
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
				redirect($this->data['_cancem']);
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