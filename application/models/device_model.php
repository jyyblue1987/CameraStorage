<?php
class Device_model extends MY_Model {    
    protected $_table_name = 'devices';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'name'				=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
//        'tax' 				=> array('field'=>'tax', 'label'=>'Tax', 'rules'=>'trim|integer'),
   );


   public $rules_lang = array();
   
	public function __construct(){}

	public function get_new(){

        $products = new stdClass();
        //$products->parent_id = 0;
        $products->name 					= '';

        //Add language parameters
        
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

	public function get_nested($user_id=false,$limit=false){
        if($limit){
            $this->db->limit($limit);
        }
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->where('user_id', $user_id);
        $this->db->order_by($this->_order_by);
		$categories = $this->db->get()->result_array();
		
		$array = array();
		foreach ($categories as $n) {         
			if (! $n['parent_id']) {
				// This page has no parent
				$array[$n['id']] = $n;
			}
			else {
				// This is a child page
				$array[$n['parent_id']]['children'][] = $n;
			}
		}
		return $array;
	}

}


