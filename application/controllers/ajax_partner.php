<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_partner extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form'));	
		$this->load->library(array('session'));
		$this->load->model(array('comman_model','language_model','settings_model'));
		$this->data['set_meta'] = '';	
		//date_default_timezone_set("Asia/Dubai"); 
		//date_default_timezone_set("Asia/Kolkata"); 

/*		$this->data['lang_code'] = (string) $this->uri->segment(1);
        if(empty($this->data['lang_code']))
        {
            $this->data['lang_code'] = $this->language_model->get_default();
        }
        $this->data['lang_id'] = $this->language_model->get_id($this->data['lang_code']);*/

        $detail = $this->session->all_userdata();
		if(isset($detail['user_session'])){
			$this->data['user_account'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
			if(!empty($this->data['user_account'])&&$this->data['user_account']->account_type=='R'){
				$this->data['partner_details'] =  $this->comman_model->get_by('stores',array('user_id'=>$this->data['user_account']->id),FALSE,FALSE,TRUE);
			}
        }
	}

	function read_notification(){
		$rel = array();
		$rel['status']= "error";
		$rel['msg']= '';
		$rel['sound'] = 0;
		$rel['order_count'] = 0;
		$rel['payapal_order_count'] = 0;
		if(isset($this->data['partner_details'])){
			$rel['status']= "ok";
			$orderSound = $this->comman_model->get_by('user_orders',array('store_id'=>$this->data['partner_details']->id,'user_sound'=>0,'payment_type'=>'cash','payment'=>1),false,false,false);		
			$paySound = $this->comman_model->get_by('user_orders',array('store_id'=>$this->data['partner_details']->id,'user_sound'=>0,'payment_type'=>'paypal','payment'=>1),false,false,false);	
			if($paySound||$orderSound){
				$this->db->where(array('store_id'=>$this->data['partner_details']->id,'payment'=>1));
				$this->db->set('user_sound', '1', FALSE);
				$this->db->update('user_orders');
				$rel['sound'] = 1;
			}

			$deliveryOrderCount = count($this->comman_model->get_by('user_orders',array('store_id'=>$this->data['partner_details']->id,'read'=>0,'payment_type'=>'cash','payment'=>1),false,false,false));		
			$payOrderCount = count($this->comman_model->get_by('user_orders',array('store_id'=>$this->data['partner_details']->id,'read'=>0,'payment_type'=>'paypal','payment'=>1),false,false,false));	

			if($deliveryOrderCount){
				$rel['order_count'] = $deliveryOrderCount;
			}
			if($payOrderCount){
				$rel['payapal_order_count'] = $payOrderCount;
			}
		}		
		echo json_encode($rel);
	}
	
	
}
