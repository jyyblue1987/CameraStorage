<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_condition extends Frontend_Controller{	

	public function __construct(){
		parent::__construct();
		
	}
	
	function ajaxSetCookie(){
		if (!$this->input->is_ajax_request()) {//only call in ajax
			exit('No direct script access allowed');
		}
		$output = array();
		$output['status']= 'ok';
		$this->db->where('id',$this->data['user_details']->id);
		$this->db->set('accept_condition',1,true);
		$this->db->update('users');
		echo json_encode($output);
	}
}