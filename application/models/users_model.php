<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {
    public $rules_password =  array(
              'old_password'=> array(
                     'field'   => 'old_password',
                     'label'   => 'Old Password',
                     'rules'   => 'trim|required|callback__check_old_password'
                  ),
              'password'=> array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'trim|required'
                  ),
              'password_confirm'=> array(
                     'field'   => 'password_confirm',
                     'label'   => 'Confirm Password',
                     'rules'   => 'trim|required|matches[password]'
                  ));

    public $update_rules = array(
			'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
			'company_name' =>array('field'=>'company_name','label'=>'Company name','rules'=>'trim|required'),
//			'last_name' =>array('field'=>'last_name','label'=>'Last Name','rules'=>'trim|required'),
			'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim'),
			'phone2' =>array('field'=>'phone2','label'=>'Phone2','rules'=>'trim'),
			'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim|required'),
			'city' =>array('field'=>'city','label'=>'City','rules'=>'trim|required'),
			//'country' =>array('field'=>'country','label'=>'Country','rules'=>'trim|required'),
   );

	//for create dealer by admin
	public $create_d_rules = array(
		'first_name' => array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
		'company_name' => array('field'=>'company_name', 'label'=>'Company', 'rules'=>'trim|required'),
		'c_num' => array('field'=>'c_num', 'label'=>'camera', 'rules'=>'trim'),
		'c_days' => array('field'=>'c_days', 'label'=>'days', 'rules'=>'trim'),
		'phone' => array('field'=>'phone', 'label'=>'Phone', 'rules'=>'trim'),
		'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]|callback__unique_email'),
		'password' => array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
		//'email' => array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required|max_length[100]|callback__unique_email|xss_clean'),
	);

	public $update_d_rules = array(
		'first_name' => array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
		'company_name' => array('field'=>'company_name', 'label'=>'Company', 'rules'=>'trim|required'),
		'c_num' => array('field'=>'c_num', 'label'=>'camera', 'rules'=>'trim'),
		'c_days' => array('field'=>'c_days', 'label'=>'days', 'rules'=>'trim'),
//		'password' => array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
		'flash_notes' => array('field'=>'flash_notes', 'label'=>'flash_notes', 'rules'=>'trim'),
		//'email' => array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required|max_length[100]|callback__unique_email|xss_clean'),
	);
	///end for create dealer by admin

/*    public $update_employee_rules = array(
			'username' =>array('field'=>'username','label'=>'Userame','rules'=>'trim|required|callback__unique_user'),
			'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
			'last_name' =>array('field'=>'last_name','label'=>'Last Name','rules'=>'trim|required'),
			'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim|required|integer'),
			'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim|required'),
   );
*/	
	public $update_employee_rules = array(
			'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
			'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim|required|integer'),
			'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim|required'),
	);
   
	public $update_customer_rules = array(
			'first_name' =>array('field'=>'first_name','label'=>'First Name','rules'=>'trim|required'),
			'company_name' =>array('field'=>'company_name','label'=>'Company Name','rules'=>'trim|required'),
			'phone' =>array('field'=>'phone','label'=>'Phone','rules'=>'trim'),
			'phone2' =>array('field'=>'phone2','label'=>'Phone2','rules'=>'trim'),
			'address' =>array('field'=>'address','label'=>'Address','rules'=>'trim|required'),
			'city' =>array('field'=>'city','label'=>'City','rules'=>'trim|required'),
			'country' =>array('field'=>'country','label'=>'Country','rules'=>'trim|required'),
			'state' =>array('field'=>'state','label'=>'State','rules'=>'trim|required'),
/*			'account_num' =>array('field'=>'account_num','label'=>'Bank account','rules'=>'trim|required'),
			'paypal_account' =>array('field'=>'paypal_account','label'=>'Paypal account','rules'=>'trim|required'),*/

   );
	public $update_account_info_rules = array(
/*			'api_username' =>array('field'=>'api_username','label'=>'Api username','rules'=>'trim|required'),
			'api_signature' =>array('field'=>'api_signature','label'=>'Api signature','rules'=>'trim|required'),
			'api_password' =>array('field'=>'api_password','label'=>'Api Password','rules'=>'trim|required'),*/
			'bank_name' =>array('field'=>'bank_name','label'=>'Bank Name','rules'=>'trim|required'),
			'bank_account' =>array('field'=>'bank_account','label'=>'Bank Account','rules'=>'trim|required'),

   );

    public $profile_rules = array(
		'phone' 			=> array('field'=>'phone','label'=>'Phone','rules'=>'trim|required|integer'),
        'address'			=> array('field'=>'address', 'label'=>'Addrees', 'rules'=>'trim|required'),
        'city'				=> array('field'=>'city', 'label'=>'City', 'rules'=>'trim|required'),
        'price'				=> array('field'=>'price', 'label'=>'Price', 'rules'=>'trim|required|numeric'),
        'region'			=> array('field'=>'region', 'label'=>'Region', 'rules'=>'trim|required'),
        'description'		=> array('field'=>'description', 'label'=>'description', 'rules'=>'trim'),
        'name'				=> array('field'=>'name', 'label'=>'name', 'rules'=>'trim|required'),
        'website'			=> array('field'=>'website', 'label'=>'website', 'rules'=>'trim|'),
        'company_name'		=> array('field'=>'company_name', 'label'=>'Company name', 'rules'=>'trim|'),
//        'tax' 				=> array('field'=>'tax', 'label'=>'Tax', 'rules'=>'trim|integer'),
   );


    public $create_user_rules = array(
        'first_name' => array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
        'last_name' => array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required'),
		'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]|callback__unique_email'),
        'password' => array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
        //'email' => array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required|max_length[100]|callback__unique_email|xss_clean'),
   );


    public $panic_rules = array(
			'p_email' =>array('field'=>'p_email','label'=>'Email','rules'=>'trim|required|valid_email'),
			'p_name' =>array('field'=>'p_name','label'=>'Name','rules'=>'trim|required'),
			'p_desc' =>array('field'=>'p_desc','label'=>'Description','rules'=>'trim|required'),
   );


    function __construct(){
        parent::__construct();
    }

	function get_new_commision(){//for thirdpary use
        $users = new stdClass();
        //$users->parent_id = 0;
        $users->gym_id				= '';
        $users->name			 	= '';
        $users->price				= 0;
        $users->description			= '';
/*        $users->is_ = '';*/
        
        return $users;
	}   

	function get_new_photgraph(){
        $users = new stdClass();
        //$users->parent_id = 0;
        $users->gender			 	= '';
        $users->name			 	= '';
        $users->company_name		= '';
        $users->price				= 0;
        $users->athlete				= '';
        $users->website				= '';
        $users->description			= '';
/*        $users->is_ = '';*/
        
        return $users;
	}   

	function get_new_profile(){
        $users = new stdClass();
        //$users->parent_id = 0;
        $users->gps 				= '54, 24';
        $users->gender			 	= '';
        $users->name			 	= '';
        $users->company_name		= '';
        $users->price				= 0;
        $users->website				= '';
        $users->description			= '';
/*        $users->is_ = '';*/
        
        return $users;
	}   

	function get_user_new(){
        $users = new stdClass();
        //$users->parent_id = 0;
        $users->first_name	 	= '';
        $users->last_name		= '';
        $users->password		= '';
        $users->email 			= '';
/*        $users->is_ = '';*/
        
        return $users;
	}   

	function get_provider_new(){
        $users = new stdClass();
        //$users->parent_id = 0;
        $users->first_name 		= '';
        $users->last_name 		= '';
        $users->username		= '';
        $users->type 			= '';
        $users->email 			= '';
        $users->address 		= '';
        $users->city 			= '';
        $users->country 		= '';
        $users->phone 			= '';
        $users->password 		= '';
        $users->desc 			= '';
        $users->vat		 		= 0;
        $users->tax		 		= 0;
        $users->s_time		 	= '';
        $users->e_time	 		= '';
		
		$users->api_username 	= '';
		$users->api_signature 	= '';
		$users->api_password 	= '';
		$users->bank_name 		= '';
		$users->bank_account 	= '';
		$users->api_username 	= '';
		$users->api_username 	= '';
		
		$users->gps 			= '51.5074, 0.1278';
        
        return $users;
	}   

	public function get_salary(){
        $products = new stdClass();
        //$products->parent_id = 0;
        $products->user_id		= 0;
        $products->gym_id		= 0;
        $products->owner_id		= 0;
        $products->price			= '';
        $products->payment			= '';
        $products->account_id		= '';
        $products->description		= '';
		$products->account_num		= '';
        
        return $products;
	}

	public function get_expense(){
        $products = new stdClass();
        //$products->parent_id = 0;
        $products->user_id		= 0;
        $products->account_id		= '';
        $products->price			= '';
        $products->gym_id			= '';
        $products->payment			= '';
        $products->name				= '';
        $products->dates			= date('Y-m-d');
        $products->description		= '';
		$products->account_num		= '';
        
        return $products;
	}
    
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>