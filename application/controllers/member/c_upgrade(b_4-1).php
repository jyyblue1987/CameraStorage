<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_upgrade extends Frontend_Controller{	
	public $_redirect = '/member/c_upgrade';

	public $_table_names = 'camera';

	public $_subView = 'user/camera/';
	public $_mainView = 'user/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['name'] = 'Dashboard';	
		$this->data['active'] = 'Membership';
		$this->load->library(array('user_paypal_lib'));
        $this->load->model(array('membership_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');



		$this->data['_user_link'] = $this->data['lang_code'].'/member';

        $this->data['_c_cancel'] = $this->data['_user_link'].'/camera';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';
		$this->data['month_data'] = $this->membership_model->get_day_month();

		$this->_checkUser();
	}

	function l($id = false){
		session_start();
		$str = '';
		$url = base_url().$this->data['_cancel'];

		if(!$id){
			redirect($this->data['_c_cancel'].'/');		
		}

		$checkcamera = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkcamera){
			redirect($this->data['_c_cancel'].'/');		
		}

		$checkMembership = $this->comman_model->get_by('memberships',array('id'=>$checkcamera->m_id),false,false,true);
		$OwnnerData = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id),false,false,true);
		if($checkMembership&&$OwnnerData){
			//check payment			
			
//			echo $this->db->last_query();die;
			$userAPIArr = array();
			
			//check dealer set apply paypal
			$userDealer = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id,),false,false,true);
			if($userDealer&&$userDealer->use_paypal==1){}
			else{
				$this->session->set_flashdata('error','Sorry!! Paypal not available.');
				redirect($this->data['_c_cancel']);
			}

			//check dealer paypal data
			$checkUserApi = $this->comman_model->get_by('users_paypal',array('user_id'=>$this->data['user_details']->parent_id,),false,false,true);
			if($checkUserApi){
				if($checkUserApi->username!=''&&$checkUserApi->signature!=''&&$checkUserApi->password!=''){
					$userAPIArr['username']		= $checkUserApi->username;
					$userAPIArr['signature']	= $checkUserApi->signature;
					$userAPIArr['comission']	= $checkUserApi->comission;
					$userAPIArr['password']		= $checkUserApi->password;
					$userAPIArr['id']			= $checkUserApi->id;
					$userAPIArr['recurring']	= $checkUserApi->is_recurring;
				}
			}
			else{
				$this->session->set_flashdata('error','Sorry!! Paypal not available.');
				redirect($this->data['_c_cancel']);
			}
			if(empty($userAPIArr)){
				$this->session->set_flashdata('error','Sorry!! Paypal not available.');
				redirect($this->data['_c_cancel']);
			}
			$totalAmount = $checkcamera->price;
/*				echo $totalAmount;
			die;*/
//			$str .= "&L_PAYMENTREQUEST_0_AMT0=".$totalAmount."&L_PAYMENTREQUEST_0_NAME0=".$checkMembership->name." Total amount &L_PAYMENTREQUEST_0_QTY0=1";
			$str .= "&L_BILLINGTYPE0=RecurringPayments&L_BILLINGAGREEMENTDESCRIPTION0=".$checkMembership->name."&L_PAYMENTTYPE0=Any&L_CUSTOM0=";
			$paymentAmount = $str;
			$_SESSION["Payment_Amount"] = $paymentAmount;
			$currencyCodeType = "USD";//MXN
			$paymentType = "Sale";
			$returnURL = $url."/review";
			$cancelURL = $url."/cancel";
			$resArray = $this->user_paypal_lib->CallShortcutExpressCheckout1($paymentAmount,$totalAmount,$currencyCodeType, $paymentType, $returnURL, $cancelURL,$userAPIArr);
//			printR($resArray);die;
			//$resArray = CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);
			if($resArray){
				$ack = strtoupper($resArray["ACK"]);
				if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING"){
					$newdata = array(
					'user_id'  			=> $this->data['user_details']->id,
					'subscribe_type'	=> 'membership',
					'product_id'		=> $checkcamera->id,

					'm_id'				=> $checkMembership->id,
					'name'				=> $checkMembership->name,
					'price'				=> $checkcamera->price,
					'month'				=> $checkcamera->m_day,
					'email' 			=> $this->data['user_details']->email,
					'paypal_id'			=> $userAPIArr['id'],
					'api_username'		=> $userAPIArr['username'],
					'api_signature'		=> $userAPIArr['signature'],
					'api_password'		=> $userAPIArr['password'],
					'recurring'			=> $userAPIArr['recurring'],
				   );
					$this->session->set_userdata('user_subscribe',$newdata);	
					$this->user_paypal_lib->RedirectToPayPal( $resArray["TOKEN"],$userAPIArr);
				}
				else{				
				//	echo 'Sorry!! Paypal not available2.';
					$this->session->set_flashdata('error','Sorry!! Paypal not available.');
					redirect($this->data['_c_cancel']);
				}
			}
			else{
				
				//for test
/*				$newdata = array(
					'user_id'  			=> $this->data['user_details']->id,
					'subscribe_type'	=> 'membership',
					'product_id'		=> $checkMembership->id,
					'gym_id'			=> $checkcamera->id,
					'name'				=> $checkMembership->name,
					'price'				=> $checkMembership->price,
					'month'				=> $checkMembership->month,
					'email' 			=> $this->data['user_details']->email,
					'paypal_id'			=> $userAPIArr['id'],
					'api_username'		=> $userAPIArr['username'],
					'api_signature'		=> $userAPIArr['signature'],
					'api_password'		=> $userAPIArr['password'],
			   );
				$this->session->set_userdata('user_subscribe',$newdata);	
				echo 'test';
				die;*/
			//	echo 'noew';
				$this->session->set_flashdata('error','Sorry!! Paypal not available.');
				redirect($this->data['_c_cancel']);
			}			
			
		}
		else{
			redirect($this->data['_cancel'].'/');
		}
	}
	
	function m($id = false){
		$str = '';
		$url = base_url().$this->data['_cancel'];

		if(!$id){
			redirect($this->data['_c_cancel'].'/');		
		}

		$checkcamera = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$checkcamera){
			redirect($this->data['_c_cancel'].'/');		
		}

		$checkMembership = $this->comman_model->get_by('memberships',array('id'=>$checkcamera->m_id),false,false,true);
		$OwnnerData = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->parent_id),false,false,true);
		if($checkMembership&&$OwnnerData){
			$this->db->trans_start();
			$post_data =array(
							'amount'			=> $checkMembership->price,
							'user_id'			=> $this->data['user_details']->id,
							'owner_id'			=> $this->data['user_details']->parent_id,
							'product_id'		=> $checkcamera->id,
							'payment_type'		=> 'Cash',
							'name'				=> '',
							'price'				=> $checkMembership->price,
							'month'				=> 30,
							'on_date'			=> date('Y-m-d'),
							'on_datetime'		=> date('Y-m-d H:i'),
							'payment'			=> 1
							
							);		

			$res = $this->comman_model->save('camera_payment',$post_data);
							
			$this->db->where('id',$checkcamera->id);
			$this->db->set('payment_id',$res, true);
			$this->db->set('plan_day',30, true);
			$this->db->set('plan_date',date('Y-m-d'), true);
			$this->db->set('is_expire',0, true);
			$this->db->set('payment_type', 'paid', true);
			$this->db->update('camera');
			$this->db->trans_complete();
			$this->session->set_flashdata('success', 'Thank you for upgrading!');
			
		}
		else{
			//redirect($this->data['_cancel'].'/');
		}
		redirect($this->data['_user_link'].'/camera');
	}

	function cancel(){	
		redirect($this->data['_user_link'].'/camera');
	}
	
	function review(){	
		//session_start();
		$token = "";
//		printR($_GET);
		if(isset($_GET['token'])){
			$token = $_GET['token'];
		}
/*		echo 'ehco '.$token;
		die;*/
		if ($token!=""){
			$userAPI =array(
						'username'=>$this->data['session_data']['user_subscribe']['api_username'],
						'signature'=>$this->data['session_data']['user_subscribe']['api_signature'],
						'password'=>$this->data['session_data']['user_subscribe']['api_password'],
						'paypal_id'=>$this->data['session_data']['user_subscribe']['paypal_id'],
						);
			$resArray = $this->user_paypal_lib->GetShippingDetails($token,$userAPI);
			$ack = strtoupper($resArray["ACK"]);
			if( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING"){
				
				$this->data['amount'] = $resArray['AMT'];
				$membership_paypal_sess = $this->session->userdata('membership_paypal_sess');
				if(isset($membership_paypal_sess)&&!empty($membership_paypal_sess)){
				}
				else{
					$post_data =array(
							'token'				=> $resArray['TOKEN'],
							'PayerID'			=> $resArray['PAYERID'],
							'currencyCodeType'	=> $resArray['CURRENCYCODE'],
							'paypal_id'			=> $userAPI['paypal_id'],
							'api_username'		=> $userAPI['username'],
							'api_signature'		=> $userAPI['signature'],
							'api_password'		=> $userAPI['password'],
							'amount'			=> $resArray['AMT'],
							'payment_record'	=> serialize($resArray),

							'user_id'			=> $this->data['user_details']->id,
							'owner_id'			=> $this->data['user_details']->parent_id,
							'product_id'		=> $this->data['session_data']['user_subscribe']['product_id'],
							'payment_type'		=> 'Paypal',
							'name'				=> $this->data['session_data']['user_subscribe']['name'],
							'price'				=> $this->data['session_data']['user_subscribe']['price'],
							'month'				=> 30,//$this->data['session_data']['user_subscribe']['month'],
							);		

					$this->session->set_userdata('membership_paypal_sess',$post_data);
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
				
/*				echo "<br>GetExpressCheckoutDetails API call failed. ";
				echo "<br>Detailed Error Message: " . $ErrorLongMsg;
				echo "<br>Short Error Message: " . $ErrorShortMsg;*/
		//		echo "<br>Error Code: " . $ErrorCode;
/*				echo "<br>Error Severity Code: " . $ErrorSeverityCode;
				die;*/
				$this->session->set_flashdata('error',$ErrorCode);
				redirect($this->data['_user_link'].'/camera');				
			}
		}	
		else{
			redirect($this->data['_user_link'].'/camera');				
			//for  test
		}
	}

	function order_confirm(){
		session_start();
		$PaymentOption = "PayPal";
		//test
		if(isset($this->data['session_data']['membership_paypal_sess'])){
		}
		else{
//			echo 'go camera';
			redirect($this->data['_user_link'].'/camera');				
		}
/*		$userAPI =array(
						'username'=>$this->data['session_data']['user_subscribe']['api_username'],
						'signature'=>$this->data['session_data']['user_subscribe']['api_signature'],
						'password'=>$this->data['session_data']['user_subscribe']['api_password'],
						'paypal_id'=>$this->data['session_data']['user_subscribe']['paypal_id'],
						);

		$recurring_Arr = array(
							'token'					=> $this->data['session_data']['membership_paypal_sess']['token'],
							'PayerID'				=> $this->data['session_data']['membership_paypal_sess']['PayerID'],
							'currencyCodeType'		=> $this->data['session_data']['membership_paypal_sess']['currencyCodeType'],
							'AMT'					=> $this->data['session_data']['user_subscribe']['price'],
							'billing_period'		=> 'Day',// Month
							'billing_recurring'		=> 1,
							'desc'					=> $this->data['session_data']['user_subscribe']['price'],
							'AMT'					=> $this->data['session_data']['user_subscribe']['name'],
						);
		$recurring_data = $this->user_paypal_lib->recurring($recurring_Arr,$userAPIArr);
		printR($recurring_data);	die;
*/	
		if ( $PaymentOption == "PayPal" ){
			//	$data['userSubscribed'] = $this->isUserSubscribed();
//				redirect($this->data['_c_cancel']);
			
			
			//var_dump($_SESSION);
			$finalPaymentAmount =  $this->data['session_data']['PAYMENTREQUEST_0_AMT'].$_SESSION["Payment_Amount"];

			$userAPI =array(
						'username'=>$this->data['session_data']['user_subscribe']['api_username'],
						'signature'=>$this->data['session_data']['user_subscribe']['api_signature'],
						'password'=>$this->data['session_data']['user_subscribe']['api_password'],
						'paypal_id'=>$this->data['session_data']['user_subscribe']['paypal_id'],
						);


		//	die;
			//$finalPaymentAmount =  $resArray['AMT'];
			$resArray = $this->user_paypal_lib->ConfirmPayment($finalPaymentAmount,$userAPI);
			$ack = strtoupper($resArray["ACK"]);
			if( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" ){						
				//$order_id = $this->get_checkout2('paypal');
				$post_data					= $this->data['session_data']['membership_paypal_sess'];
				$post_data['on_date'] 		= date('Y-m-d');
				$post_data['on_datetime']	= date('Y-m-d H:i');
				$post_data['payment']		= 1;

				$this->db->trans_start();

				$payment_id = $this->comman_model->save('camera_payment',$post_data);

				$this->db->where('user_id',$this->data['user_details']->id);
				$this->db->where('id',$this->data['session_data']['user_subscribe']['product_id']);
				
				$this->db->set('payment_id',$payment_id, true);
				$this->db->set('plan_day',30, true);
				$this->db->set('plan_date',date('Y-m-d'), true);
				$this->db->set('payment_type', 'paid', true);
				$this->db->update('camera');

				//update credit point 
				$getCameraPrice = $this->comman_model->get_by('camera',array('id'=>$this->data['session_data']['user_subscribe']['product_id']),false,false,true);
				if($getCameraPrice){
//					echo 'asd';
					$this->db->where('id',$this->data['user_details']->parent_id);
					$this->db->set('credits_point', 'ROUND(credits_point+'.$getCameraPrice->price.',2)', FALSE);
					$this->db->update('users');
	
					$this->db->where('id',$this->data['user_details']->parent_id);
					$this->db->set('debt_point', 'ROUND(debt_point+'.$getCameraPrice->dealer_price.',2)', FALSE);
					$this->db->update('users');

					$this->db->where('id',$this->data['user_details']->parent_id);
					$this->db->set('total_point', 'ROUND(total_point-'.$getCameraPrice->dealer_price.',2)', FALSE);
					$this->db->update('users');

					$this->comman_model->save('users_transaction',array('ownner_id'=>$this->data['user_details']->parent_id,'user_id'=>$this->data['user_details']->id,'order_id'=>$getCameraPrice->payment_id,'product_id'=>$getCameraPrice->id,'type'=>'upgrade','amount2'=>$getCameraPrice->dealer_price,'amount'=>$getCameraPrice->price,'on_date'=>date('Y-m-d'),'on_datetime'=>date('y-m-d H:i:s')));

				}
				$this->db->trans_complete();
				if($this->data['session_data']['user_subscribe']['recurring']==1){
					$this->recurring_method($payment_id);
				}
				
				$this->session->set_flashdata('success', 'Thank you for upgrading!');
				//unset($_SESSION['Payment_Amount']);
				$this->session->unset_userdata('user_subscribe');
				$this->session->unset_userdata('membership_paypal_sess');
				
			//	$data['userSubscribed'] = $this->isUserSubscribed();
				redirect($this->data['_c_cancel']);
				//die;
				//echo "Thank you for your payment.";
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
				redirect($this->data['_c_cancel']);
			}
		}	
	}
	
	function recurring_method($payment_id){
		if(!$payment_id)
			return false;

		$payment_data =	$this->comman_model->get_by($this->_table_names.'_payment',array('id'=>$payment_id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if(!$payment_data){
			return false;
		}
		$userAPI =array(
						'username'		=> $payment_data->api_username,
						'signature'		=> $payment_data->api_signature,
						'password'		=> $payment_data->api_password,
						);

		$recurring_Arr = array(
							'token'					=> $payment_data->token,
							'PayerID'				=> $payment_data->PayerID,
							'currencyCodeType'		=> $payment_data->currencyCodeType,
							'AMT'					=> 1, //$payment_data->price
							'desc'					=> $payment_data->name,
							'billing_period'		=> 'Day',// Month
							'billing_recurring'		=> 1,
						);
		$recurring_data = $this->user_paypal_lib->recurring($recurring_Arr,$userAPI);
		//printR($recurring_data);
		$this->db->trans_start();
		if($recurring_data['ACK']=='Success'||$recurring_data['ACK']=='success'){
			$this->db->where('id',$payment_data->id);
			$this->db->set('is_recurring',1, true);
			$this->db->set('profile_id',$recurring_data['PROFILEID'], true);
			$this->db->set('recurring_data',serialize($recurring_data), true);
			$this->db->update($this->_table_names.'_payment');
		}
		else{
			$this->db->where('id',$payment_data->id);
			$this->db->set('error_message',$recurring_data['L_LONGMESSAGE0'], true);
			$this->db->set('recurring_data',serialize($recurring_data), true);
			$this->db->update($this->_table_names.'_payment');
		}
		$this->db->trans_complete();
		return true;
	}

	function _checkUser(){
		$redirect = $redirect2 = false;
		if(isset($this->data['user_details'])){	
			if($this->data['user_details']->account_type=='S'){
				$redirect =true;
			}
			if($this->data['user_details']->account_type!='A'){
				$redirect2 = true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}

		$redirect2 = false;
		if($redirect2){
			redirect($this->data['_user_link'].'');
		}
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */