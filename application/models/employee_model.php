<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_model extends CI_Model {
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
        //'email' => array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required|max_length[100]|callback__unique_email|xss_clean'),
   );

    public $create_rules = array(
        'first_name' => array('field'=>'first_name', 'label'=>'Name', 'rules'=>'trim|required'),
        'last_name' => array('field'=>'last_name', 'label'=>'Surname', 'rules'=>'trim|required'),
		'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[users.email]'),
        'password' => array('field'=>'password', 'label'=>'password', 'rules'=>'trim|required'),
        //'email' => array('field'=>'email', 'label'=>'email', 'rules'=>'trim|required|max_length[100]|callback__unique_email|xss_clean'),
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

	function get_user_new(){
        $users = new stdClass();
        //$tags->parent_id = 0;
        $users->first_name	 	= '';
        $users->last_name		= '';
        $users->password		= '';
        $users->email 			= '';
/*        $users->is_ = '';*/
        
        return $users;
	}   
    
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>