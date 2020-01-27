<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_employee_model extends CI_Model {
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
        'username' => array('field'=>'username', 'label'=>'Username', 'rules'=>'trim|required|is_unique[admin.username]'),
		'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[admin.email]'),
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

	function get_new(){
        $users = new stdClass();
        //$tags->parent_id = 0;
        $users->username 		= '';
        $users->password		= '';
        $users->email 			= '';
        $users->category_id 	= '';
        $users->is_user 		= '';
        $users->is_place 		= '';
        $users->is_product 		= '';
        $users->is_store	 	= '';
        $users->is_user 		= '';
        $users->is_payment 		= '';
        $users->is_order 		= '';
        $users->is_membership	= '';
        $users->is_event 		= '';
        $users->is_content 		= '';
        $users->is_customer		= '';
        $users->is_ticket 		= '';
        $users->is_chat 		= '';
        $users->is_newsletter	= '';
        $users->is_general 		= '';
        $users->is_slider 		= '';
/*        $users->is_ = '';*/
        
        return $users;
	}   
    
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>