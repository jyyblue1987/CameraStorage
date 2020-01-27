<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_user extends Frontend_Controller{	
	public function __construct(){
		parent::__construct();
	}

	function inactive_dealer(){
		$nowday = date('d');
		$output['status'] ='ok';
		$string = "select * from users where account_type='D' and MONTH(update_point)!='".date('m')."' and debt_point>0 and status=1 ";
		$all_user = $this->comman_model->get_query($string,false);
		if($all_user){
			foreach($all_user as $set_u){
				if(empty($set_u->update_point)){
					$this->db->where('id', $set_u->id);
					$this->db->set('update_point',date('Y-m-t'),true);
					$this->db->update('users');
				}
				else{
					//printR($set_u);
					if($nowday>6){
						$this->db->where('id', $set_u->id);
						$this->db->set('status',0,true);
						$this->db->update('users');
					}
				}
			}

		}
		echo json_encode($output);
	}


}

