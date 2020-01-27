<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        
    }
    
    function get_addressbook($table) {     
		//$query = $this->db->get($table);
		$query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    function insert_csv($table,$data) {
        $this->db->insert('category', $data);
    }
}
/*END OF FILE*/
