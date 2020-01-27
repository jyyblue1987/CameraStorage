<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_debt extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['set_meta'] = '';	
        $this->data['settings'] = $this->settings_model->get_fields();
		date_default_timezone_set("America/Cancun"); 

	}

	function last_date_amount(){//update debt amount of last month
		$nowDateString = time();
		$output['status'] ='ok';
		
		//debt date empty
		$string = "SELECT * FROM users WHERE account_type='D' AND (debt_date='' OR debt_date IS NULL)";
		$all_user = $this->comman_model->get_query($string,false);
		if($all_user){
			foreach($all_user as $set_u){
				$this->db->where('id', $set_u->id);
				$this->db->set('debt_date',date('Y-m-t'),true);
				$this->db->update('users');
			}
		}
		
		//check debt amount date
		$string = "SELECT * FROM users WHERE account_type='D' AND debt_date<'".date('Y-m-d')."'";
		$all_user = $this->comman_model->get_query($string,false);
		if($all_user){
			foreach($all_user as $set_u){
				$this->db->trans_start();
				$this->db->where('id', $set_u->id);
				$this->db->set('debt_date',date('Y-m-t'),true);
				$this->db->set('total_point', 0,true);
				$this->db->set('debt_point', 'ROUND(debt_point+'.abs($set_u->total_point).',2)', FALSE);
				$this->db->update('users');
				$this->db->trans_complete();
			}

		}
		echo json_encode($output);
	}
}