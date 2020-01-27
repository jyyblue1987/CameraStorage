<?php

class Coupon_model extends MY_Model {    
    protected $_table_name = 'coupons';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'reduction_amount' => array('field'=>'reduction_amount', 'label'=>'Price', 'rules'=>'trim|required|numeric'),
        'end_date' => array('field'=>'end_date', 'label'=>'Expire', 'rules'=>'trim|required'),
        'code' => array('field'=>'code', 'label'=>'Code', 'rules'=>'trim|required|max_length[100]|callback__unique_slug'),
   );
   
   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
        //Rules for languages
	}

    public function get_new()
	{
        $tags = new stdClass();
        //$tags->parent_id = 0;
        $tags->code = '';
        $tags->user_id= 0;
        $tags->reduction_amount= 0;
        $tags->end_date = '';
        $tags->expire = '';
        
        //Add language parameters
        
        return $tags;
	}
    
    
	function check_coupon($coupon,$user_id){
        $this->db->where(array('code'=>$coupon,'user_id'=>$user_id));
        $check =  $this->db->get($this->_table_name)->row();
		if($check){
			return true;
		}
		return false;
				
	}
	
	function is_valid($coupon){
		//$coupon = $this->get_coupon($id);
				
		//if($coupon->is_used==1) return false;
		
		/*if($coupon['start_date'] != "0000-00-00")
		{
			$s_date = split("-", $coupon['start_date']);
			$start = mktime(0,0,0, $s_date[1], $s_date[2], $s_date[0]);
		
			$current = time();
		
			if($current < $start) return false;
		}*/
		
		if($coupon->end_date != "0000-00-00")
		{
			$e_date = explode("-", $coupon->end_date);
			$end = mktime(0,0,0, $e_date[1], (int) $e_date[2] +1 , $e_date[0]); // add a day to account for the end date as the last viable day
		
			$current = time();
		
			if($current > $end) return false;
		}

		
		return true;
	}
	
    

    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
    }

}


