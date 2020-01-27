<?php
class competition_model extends MY_Model {    
    protected $_table_name = 'competitions';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'category_id' 		=> array('field'=>'category_id', 'label'=>'Category', 'rules'=>'trim|intval'),
        'name' 				=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
        'description' 		=> array('field'=>'description', 'label'=>'Description', 'rules'=>'trim|required'),
        'price'				 => array('field'=>'price', 'label'=>'Price', 'rules'=>'trim|required|numeric'),
        's_date'			 => array('field'=>'s_date', 'label'=>'Date', 'rules'=>'trim|required'),
        'e_date'			 => array('field'=>'e_date', 'label'=>'Date', 'rules'=>'trim|required'),
        's_r_date'			 => array('field'=>'s_r_date', 'label'=>'Date', 'rules'=>'trim|required'),
        'e_r_date'			 => array('field'=>'e_r_date', 'label'=>'Date', 'rules'=>'trim|required'),
//        'dates'				 => array('field'=>'dates', 'label'=>'Date', 'rules'=>'trim|required'),
        'place'				 => array('field'=>'place', 'label'=>'Place', 'rules'=>'trim|required'),
        'street'			 => array('field'=>'street', 'label'=>'street', 'rules'=>'trim|required'),
        'city'				 => array('field'=>'city', 'label'=>'city', 'rules'=>'trim|required'),
        'country'			 => array('field'=>'country', 'label'=>'country', 'rules'=>'trim|required'),
   );

	public $plan_rules = array(
//        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
        'desc' => array('field'=>'desc', 'label'=>'description', 'rules'=>'trim|required'),
   );

	public $entry_rules = array(
        'dates' => array('field'=>'dates', 'label'=>'Date', 'rules'=>'trim|required'),
        'times' => array('field'=>'times', 'label'=>'Time', 'rules'=>'trim|required'),
        'desc' => array('field'=>'desc', 'label'=>'description', 'rules'=>'trim|required'),
   );

   
   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
	}

	public function get_new(){
        $tags = new stdClass();

        $tags->name		 		= '';
        $tags->category 		= '';
        $tags->description 		= '';
        $tags->workout 			= '';
        $tags->place 			= '';
        $tags->street 			= '';
        $tags->city 			= '';
        $tags->country 			= '';
        $tags->place 			= '';
        $tags->dates 			= date('Y-m-d');
        $tags->s_date			= date('Y-m-d');
        $tags->e_date 			= date('Y-m-d');
        $tags->s_r_date			= date('Y-m-d');
        $tags->e_r_date			= date('Y-m-d');
        $tags->price			= '';
        $tags->gps 				= '53.5500, -2.4333';
        
        return $tags;
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
    
	public function get_with_parent ($id = NULL, $single = FALSE)
	{
		$this->db->select('categories.*, p.slug as parent_slug, p.title as parent_title');
		$this->db->join('categories as p', 'categories.parent_id=p.id', 'left');
		return parent::get($id, $single);
	}
    
    public function get_section(){
        $templates = array(
						'' => 'Select',
						'new' => 'New',
						'upcoming' => 'Upcoming',
					);
					
        return $templates;
	}

    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
    }

}


