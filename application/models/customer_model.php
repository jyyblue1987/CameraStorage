<?php
class customer_model extends MY_Model {    
    protected $_table_name = 'users';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'first_name' => array('field'=>'first_name', 'label'=>'Username', 'rules'=>'trim|required'),
        'last_name' => array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required'),
/*        'email' => array('field'=>'email', 'label'=>'Email', 'rules'=>'trim|required|valid_email|is_unique[users.email]'),
        'password' => array('field'=>'password', 'label'=>'Password', 'rules'=>'trim|required'),*/
        'company_name' => array('field'=>'company_name', 'label'=>'Company Name', 'rules'=>'trim|required'),
        'website' => array('field'=>'website', 'label'=>'Website', 'rules'=>'trim'),
        'phone' => array('field'=>'phone', 'label'=>'Phone', 'rules'=>'trim|required|integer'),
   );
    public $update_rules = array(
        'first_name' => array('field'=>'first_name', 'label'=>'Username', 'rules'=>'trim|required'),
        'last_name' => array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required'),
        'company_name' => array('field'=>'company_name', 'label'=>'Company Name', 'rules'=>'trim|required'),
        'website' => array('field'=>'website', 'label'=>'Website', 'rules'=>'trim'),
        'phone' => array('field'=>'phone', 'label'=>'Phone', 'rules'=>'trim|required|integer'),
   );

    public $update_partner_rules = array(
        'name' => array('field'=>'name', 'label'=>'Store Name', 'rules'=>'trim|required'),
        'city' => array('field'=>'city', 'label'=>'City', 'rules'=>'trim|required'),
        'country' => array('field'=>'country', 'label'=>'Country', 'rules'=>'trim|required'),
        'description' => array('field'=>'description', 'label'=>'Description', 'rules'=>'trim'),
        'address' => array('field'=>'address', 'label'=>'address', 'rules'=>'trim|required'),
        'zip' => array('field'=>'zip', 'label'=>'Post Code', 'rules'=>'trim|required'),
        'phone' => array('field'=>'phone', 'label'=>'Phone', 'rules'=>'trim|required|integer'),
   );
   
   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
	}

    public function get_new()
	{
        $tags = new stdClass();

        $tags->total_room 		= 0;
        $tags->description 		= '';
        $tags->name 			= '';
        $tags->last_name 		= '';
        $tags->first_name 		= '';
        $tags->email 			= '';
        $tags->password 		= '';
        $tags->username 		= '';
        $tags->address 			= '';
        $tags->website			= '';
        $tags->company_name		= '';
        $tags->city 			= '';
        $tags->country 			= '';
        $tags->phone			= '';
        $tags->delivery			= '';
        $tags->category_id		= 0;
        $tags->sub_category_id	= 0;
        $tags->department_id	= '';		
        $tags->start_time		= '';
        $tags->end_time			= '';
        $tags->gps 				= '53.5500, -2.4333';
        
        return $tags;
	}
    
}


