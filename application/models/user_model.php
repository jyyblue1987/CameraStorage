<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
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

    function __construct(){
        parent::__construct();
    }
	public function logout(){
        $this->session->sess_destroy();
	}

	function check_user($id,$confirm){
		$check_confirm = $this->user_valid('users',$id);
		if($check_confirm==0){
			$this->db->where('md5(id)',$id);
			$this->db->where('confirm',$confirm);
			$query = $this->db->get('users');
			//echo $this->db->last_query();die;
			if($query->num_rows()==1){
				$this->db->where('md5(id)',$id);
				$this->db->update('users', array('confirm'=>'confirm')); 
				return $query->row_array();
			}
			else{
				return 'error';
					
			}
		}
		else{
			return 'verified';
		}
	}

	function check_agency($id,$confirm){
		$check_confirm = $this->user_valid('products',$id);
		if($check_confirm==0){
			$this->db->where('md5(id)',$id);
			$this->db->where('confirm',$confirm);
			$query = $this->db->get('products');
			//echo $this->db->last_query();die;
			if($query->num_rows()==1){
				$this->db->where('md5(id)',$id);
				$this->db->update('products', array('confirm'=>'confirm')); 
				return $query->row_array();
			}
			else{
				return 'error';
					
			}
		}
		else{
			return 'verified';
		}
	}
	
	function user_valid($table,$id){
		$check = $this->db->get_where($table,array('md5(id)'=>$id,'confirm'=>'confirm'));
		return $check->num_rows();
	}
    
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>