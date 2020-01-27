<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_staff_model extends CI_Model {
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

    public $create_staff_rules = array(
//		'username'		=> array('field'=>'username','label'=>'Userame','rules'=>'trim|required|callback__unique_user2'),
		'email' 		=> array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]|callback__unique_email'),
	    'first_name' 	=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
//        'last_name'		=> array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required'),
        'password' 		=> array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
        'phone' 		=> array('field'=>'phone', 'label'=>'Phone', 'rules'=>'trim'),
        'address' 		=> array('field'=>'address', 'label'=>'Address', 'rules'=>'trim'),
      );


    public $update_staff_rules = array(
//		'username'		=> array('field'=>'username','label'=>'Userame','rules'=>'trim|required|callback__unique_user2'),
//		'email' 		=> array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]'),
	    'first_name' 	=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
//        'last_name'		=> array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required'),
        'password' 		=> array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
        'phone' 		=> array('field'=>'phone', 'label'=>'Phone', 'rules'=>'trim'),
        'address' 		=> array('field'=>'address', 'label'=>'Address', 'rules'=>'trim'),
      );

    public $update_rules = array(
		'username'		=> array('field'=>'username','label'=>'Userame','rules'=>'trim|required|callback__unique_user2'),
        'first_name' 	=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
        'last_name'		=> array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required'),
        'password' 		=> array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
      );


    public $supplier_rules = array(
        'name' 			=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
        'company_name'	=> array('field'=>'company_name', 'label'=>'Company Name', 'rules'=>'trim|required'),
		'email' 		=> array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email'),
		'phone' 		=> array('field'=>'phone','label'=>'Phone','rules'=>'trim|required|integer'),
//		'zip' 			=> array('field'=>'zip','label'=>'Post Code','rules'=>'trim|required'),

   );
    public $create_athletes_rules = array(
        'first_name' 	=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
//        'last_name'		=> array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required'),
		'company_name' 	=> array('field'=>'company_name','label'=>'Company name','rules'=>'trim'),

		'email' 		=> array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]|callback__unique_email'),
        'password' 		=> array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
        'flash_notes'	=> array('field'=>'flash_notes', 'label'=>'Flash notes', 'rules'=>'trim'),
		'phone' 		=> array('field'=>'phone','label'=>'Phone','rules'=>'trim'),
		'phone2' 		=> array('field'=>'phone2','label'=>'Phone','rules'=>'trim'),
		'address'		=> array('field'=>'address','label'=>'Address','rules'=>'trim|required'),
		'city' 			=> array('field'=>'city','label'=>'City','rules'=>'trim|required'),
		'state'			=> array('field'=>'state','label'=>'State','rules'=>'trim|required'),
//		'zip' 			=> array('field'=>'zip','label'=>'Post Code','rules'=>'trim|required'),

   );


    public $update_athletes_rules = array(
        'first_name' 	=> array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
//        'last_name'		=> array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required'),
		'company_name' 	=> array('field'=>'company_name','label'=>'Company name','rules'=>'trim'),
        'password' 		=> array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
		'phone' 		=> array('field'=>'phone','label'=>'Phone','rules'=>'trim'),
		'phone2' 		=> array('field'=>'phone2','label'=>'Phone','rules'=>'trim'),
		'address'		=> array('field'=>'address','label'=>'Address','rules'=>'trim|required'),
		'city' 			=> array('field'=>'city','label'=>'City','rules'=>'trim|required'),
		'state'			=> array('field'=>'state','label'=>'State','rules'=>'trim|required'),
        'flash_notes'	=> array('field'=>'flash_notes', 'label'=>'Flash notes', 'rules'=>'trim'),
		//'zip' 			=> array('field'=>'zip','label'=>'Post Code','rules'=>'trim|required'),

   );


    function __construct(){
        parent::__construct();

    }

	function get_new_category(){
        $users = new stdClass();
        //$tags->parent_id = 0;
        $users->name = '';
        $users->desc= '';
        return $users;
	}

	function get_supplier_new(){
        $users = new stdClass();
        //$tags->parent_id = 0;
        $users->name		 	= '';
        $users->company_name 	= '';
        $users->phone			= '';
        $users->email 			= '';
        return $users;
	}

	function get_athletes_new(){
        $users = new stdClass();
        //$tags->parent_id = 0;
        $users->username	 	= '';
        $users->first_name	 	= '';
        $users->last_name		= '';
        $users->password		= '';
        $users->email 			= '';
		$users->mon_s_time		= '';
		$users->tue_s_time		= '';
		$users->wed_s_time		= '';
		$users->thr_s_time		= '';
		$users->fri_s_time		= '';
		$users->sat_s_time		= '';
		$users->sun_s_time		= '';

		$users->mon_e_time		= '';
		$users->tue_e_time		= '';
		$users->wed_e_time		= '';
		$users->thr_e_time		= '';
		$users->fri_e_time		= '';
		$users->sat_e_time		= '';
		$users->sun_e_time		= '';

/*        $users->is_ = '';*/
        
        return $users;
	}   
    
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>