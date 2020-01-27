<?php

class Meal_model extends MY_Model {    
    protected $_table_name = 'products';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'name'				=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim'),
//        'tax' 				=> array('field'=>'tax', 'label'=>'Tax', 'rules'=>'trim|integer'),
   );

   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
        $this->languages = $this->language_model->get_form_dropdown('language', FALSE, FALSE);
        $this->languages_icon = $this->language_model->get_form_dropdown('image', FALSE, FALSE);
                                  
        //Rules for languages
	}


	public function get_new(){

        $products = new stdClass();
        //$products->parent_id = 0;
        $products->attribute				= '';
        $products->name	 					= '';
        $products->protein 					= '';
        $products->carb 					= '';
        $products->fat	 					= '';
		
        $products->description				= '';
        $products->s_date					= date('Y-m-d');
        $products->s_time					= date('h:i');
        
        return $products;
	}

    
	public function save_order ($data)
	{
		if (count($data)) {
			foreach ($data as $order => $categories) {
				if ($categories['item_id'] != '') {
					$data = array('parent_id' => (int) $categories['parent_id'], 'order' => $order);
					$this->db->set($data)->where($this->_primary_key, $categories['item_id'])->update($this->_table_name);
				}
			}
		}
	}
    
    
    public function get_section(){
        $templates = array(
						'' => 'Select',
						'new' => 'New',
						'upcoming' => 'Upcoming',
					);
					
        return $templates;
	}

    
    
  

    public function delete($id)
    {
        $this->db->delete($this->_table_name.'_lang', array('product_id' => $id)); 
		$this->db->delete($this->_table_name, array('id'=>$id));
    }



}


