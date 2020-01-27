<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paypal extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('hyperpay_lib');
	}

	public function form(){
		if($this->input->get('id')){
			$this->data['id'] = $this->input->get('id');
			$this->load->view('test_api/step2',$this->data);
		}
	}
	
	function expresscheckout($id=false){				
		if(!$id){
			redirect('/');
		}
		$url = base_url().'user';
		$paymentAmount = '10.00';
		$currencyCodeType = "EUR";
		$paymentType = "PA";
		$resArray = json_decode($this->hyperpay_lib->ExpressCheckout($paymentAmount,$currencyCodeType, $paymentType));
/*		echo '<pre>';
		print_r($resArray);
		die;*/
		if($resArray->result->code=="000.200.100"){
					$newdata = array(
						'user_id'  		=> $this->data['user_account']->id,
						'order_id'  		=> $order_id,
						'subscribe_type'=> 'order',
						'total'	=> $total,
						'email' 		=> $this->data['user_account']->email,
					   );
					$this->session->set_userdata('user_subscribe',$newdata);	
			redirect($this->data['lang_code'].'/paypal/form/?id='.$resArray->id);			
		} 
		else  
		{
		}
	}
	
	
	function confirm(){
		if($this->input->get('id')){
			$c_id = $this->input->get('id');
			$resArray = json_decode($this->hyperpay_lib->ConfirmPayment($c_id));
			echo '<pre>';
			print_r($resArray);
			if($resArray->result->code=='000.100.110'){
					$post_data =array(
								'user_id'=>$this->data['user_details']->id,
								'subscribe_status'=>'confirm',
								'order_id'=>1,
								'token'=>$resArray->id,
								'PayerID'=>$resArray->ndc,
								'currencyCodeType'=>$resArray->currency,
								'payment_type'=>'Hyperpay',
								'amt'=>$resArray->amount,
								'payment_record1'=>serialize($resArray));		

				$res = $this->comman_model->save('user_history',$post_data);

				$order_ids = $this->comman_model->save('user_orders',array('payment'=>1),$this->data['login']['user_subscribe']['order_id']);
				$getCreditsPoints = $this->comman_model->get('user_orders',array('id'=>$this->data['login']['user_subscribe']['order_id']),false,false,true);
				
				$this->db->where('id',$this->data['user_account']->id);
				$this->db->set('credits_point', 'credits_point+'.$getCreditsPoints->credits_point, FALSE);
				$this->db->update('users');
				
			}
		}		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */