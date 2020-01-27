<?php
class recurring_model extends MY_Model {    
   
	public function __construct(){
		parent::__construct();
	}

	function cancel_recurring($camera_id=false){
		$output = array('status'=>'error','message'=>'there is some problem.');
		if($camera_id){
			$camera_payment = $this->comman_model->get_by('camera_payment',array('product_id'=>$camera_id,'is_recurring'=>1,'profile_id !='=>''),false,array('id'=>'desc'),true);
			if($camera_payment){
				$api_request = 'USER=' . urlencode( $camera_payment->api_username)
							.  '&PWD=' . urlencode( $camera_payment->api_password )
							.  '&SIGNATURE=' . urlencode($camera_payment->api_signature)
							.  '&VERSION=76.0'
							.  '&METHOD=ManageRecurringPaymentsProfileStatus'
							.  '&PROFILEID=' . urlencode($camera_payment->profile_id)
							.  '&ACTION=' . urlencode( 'Cancel' )
							.  '&NOTE=' . urlencode( 'Profile cancelled for camera' );
			 
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp' ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
				curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
				 
				// Uncomment these to turn off server and peer verification
				// curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
				// curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt( $ch, CURLOPT_POST, 1 );
			 
				// Set the API parameters for this transaction
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
		 
				// Request response from PayPal
				$response = curl_exec( $ch );
			 
			// If no response was received from PayPal there is no point parsing the response
				if( ! $response ){
					$output['message'] = 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')';
					return $output;
				}
			 
				curl_close( $ch );
		 
			// An associative array is more usable than a parameter string
				parse_str( $response, $parsed_response );
				if($parsed_response['ACK']=='Success'||$parsed_response['ACK']=='success'){
					$output['status'] = 'ok';
					$output['message'] = 'successfully cancel';
				}
				else{
					$output['message'] = $parsed_response['L_LONGMESSAGE0']?$parsed_response['L_LONGMESSAGE0']:'there is some problem';
					
				}
			}
			else{
				$output['message'] = 'Thers is no payment!!';
			}
		}
		else{
			$output['message'] = 'no camera id!!';
		}
		return $output;
	}
	
	function cancel_recurring_payment($camera_id=false){//for testing and use menber section camera controller file 
		$output = array('status'=>'error','message'=>'there is some problem.');
		if($camera_id){
			$camera_payment = $this->comman_model->get_by('camera_payment',array('id'=>$camera_id,'is_recurring'=>1,'profile_id !='=>''),false,array('id'=>'desc'),true);
			if($camera_payment){
				$api_request = 'USER=' . urlencode( $camera_payment->api_username)
							.  '&PWD=' . urlencode( $camera_payment->api_password )
							.  '&SIGNATURE=' . urlencode($camera_payment->api_signature)
							.  '&VERSION=76.0'
							.  '&METHOD=ManageRecurringPaymentsProfileStatus'
							.  '&PROFILEID=' . urlencode($camera_payment->profile_id)
							.  '&ACTION=' . urlencode( 'Cancel' )
							.  '&NOTE=' . urlencode( 'Profile cancelled for camera' );
			 
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp' ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
				curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
				 
				// Uncomment these to turn off server and peer verification
				// curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
				// curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt( $ch, CURLOPT_POST, 1 );
			 
				// Set the API parameters for this transaction
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
		 
				// Request response from PayPal
				$response = curl_exec( $ch );
			 
			// If no response was received from PayPal there is no point parsing the response
				if( ! $response ){
					$output['message'] = 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')';
					return $output;
				}
			 
				curl_close( $ch );
		 
			// An associative array is more usable than a parameter string
				parse_str( $response, $parsed_response );
				if($parsed_response['ACK']=='Success'||$parsed_response['ACK']=='success'){
					$output['status'] = 'ok';
					$output['message'] = 'successfully cancel';
				}
				else{
					$output['message'] = $parsed_response['L_LONGMESSAGE0']?$parsed_response['L_LONGMESSAGE0']:'there is some problem';
					
				}
			}
			else{
				$output['message'] = 'Thers is no payment!!';
			}
		}
		else{
			$output['message'] = 'no camera id!!';
		}
		return $output;
	}
	
	function refund_recurring_payment($camera_id=false){
		$output = array('status'=>'error','message'=>'there is some problem.');
		if($camera_id){
			$camera_payment = $this->comman_model->get_by('camera_payment',array('product_id'=>$camera_id,'is_recurring'=>1,'profile_id !='=>''),false,array('id'=>'desc'),true);
			//$camera_payment = $this->comman_model->get_by('camera_payment',array('id'=>$camera_id,'is_recurring'=>1,'profile_id !='=>''),false,array('id'=>'desc'),true);//for testinng
			if($camera_payment){
				//echo $camera_payment->payment_record;
//				printR(unserialize($camera_payment->payment_record));die;
				$api_request = 'USER=' . urlencode( $camera_payment->api_username)
							.  '&PWD=' . urlencode( $camera_payment->api_password )
							.  '&SIGNATURE=' . urlencode($camera_payment->api_signature)
							.  '&VERSION=76.0'
							.  '&METHOD=RefundTransaction'
							.  '&TRANSACTIONID=' . urlencode($camera_payment->transaction_id)
							.  '&REFUNDTYPE=Full';
			 
				$ch = curl_init();
				curl_setopt( $ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp' ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
				curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
				 
				// Uncomment these to turn off server and peer verification
				// curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
				// curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
				curl_setopt( $ch, CURLOPT_POST, 1 );
			 
				// Set the API parameters for this transaction
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );
		 
				// Request response from PayPal
				$response = curl_exec( $ch );
			 
			// If no response was received from PayPal there is no point parsing the response
				if( ! $response ){
					$output['message'] = 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')';
					return $output;
				}
			 
				curl_close( $ch );
		 
			// An associative array is more usable than a parameter string
				parse_str( $response, $parsed_response );
				if($parsed_response['ACK']=='Success'||$parsed_response['ACK']=='success'){
					$output['status'] = 'ok';
					$output['message'] = 'successfully cancel';
				}
				else{
					$output['message'] = $parsed_response['L_LONGMESSAGE0']?$parsed_response['L_LONGMESSAGE0']:'there is some problem';
					
				}
			}
			else{
				$output['message'] = 'Thers is no payment!!';
			}
		}
		else{
			$output['message'] = 'no camera id!!';
		}
		return $output;
	}

}


