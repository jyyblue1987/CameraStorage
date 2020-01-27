<?php

class Order_model extends MY_Model {
    protected $_table_name = 'user_orders';
    protected $_order_by = 'parent_id, order, id';

    public $rules = array(
        'first_name' => array('field'=>'first_name', 'label'=>'Firstname', 'rules'=>'trim|required|max_length[100]|xss_clean'),
        'last_name' => array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required|max_length[100]|xss_clean'),
        'email' => array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required|max_length[100]|valid_email'),
        'address1' => array('field'=>'address1', 'label'=>'Address', 'rules'=>'trim|xss_clean'),
        'phone' => array('field'=>'phone', 'label'=>'Phone', 'rules'=>'trim|required|integer|xss_clean'),
        'city' => array('field'=>'city', 'label'=>'City', 'rules'=>'trim|required|xss_clean'),
        'country' => array('field'=>'country', 'label'=>'Country', 'rules'=>'trim|required|xss_clean'),
   );
   
	public function __construct(){
		parent::__construct();
        
                                  
        //Rules for languages
	}

	function get_best_sellers($start, $end){
		if(!empty($start))
		{
			$this->db->where('ordered_on >=', $start);
		}
		if(!empty($end))
		{
			$this->db->where('ordered_on <',  $end);
		}
		
		// just fetch a list of order id's
		$this->db->where('payment',1);
		$orders	= $this->db->select('id')->get('user_orders')->result();
		
		$items = array();
		foreach($orders as $order)
		{
			// get a list of product id's and quantities for each
			$order_items	= $this->db->select('product_id, quantity')->where('order_id', $order->id)->get('user_order_items')->result_array();
			
			foreach($order_items as $i)
			{
				
				if(isset($items[$i['product_id']]))
				{
					$items[$i['product_id']]	+= $i['quantity'];
				}
				else
				{
					$items[$i['product_id']]	= $i['quantity'];
				}
				
			}
		}
		arsort($items);
		return $items;
	}	
    
}


