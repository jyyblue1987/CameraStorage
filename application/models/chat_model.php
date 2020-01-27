<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chat_model extends CI_Model {
    protected $_chat_table = 'users_chat';
    protected $_online_table = 'user_online';
    protected $_user_table = 'users';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function update($id=false){
		if($id==0){//for admin
			$check_list = $this->comman_model->get_by('user_online',array('user_id'=>0,'user_type'=>'admin'),false,false,true); 
			if(!empty($check_list)){
				$this->db->where(array('user_id'=>$id,'user_type'=>'admin'));
				$this->db->update($this->_online_table,array('last_active_time'=>date('Y-m-d h:i:s',time()),'user_type'=>'admin'));	
			}
			else{
				$query = $this->db->insert($this->_online_table,array('last_active_time'=>date('Y-m-d h:i:s',time()),'status'=>1,'user_id'=>$id,'user_type'=>'admin'));
			}			
		}
		else{
			$check_list = $this->comman_model->get_by('user_online',array('user_id'=>$this->data['user_account']->id,'user_type'=>'user'),false,false,true); 
			if(!empty($check_list)){
				$this->db->where(array('user_id'=>$id,'user_type'=>'user'));
				$this->db->update($this->_online_table,array('last_active_time'=>date('Y-m-d h:i:s',time()),'user_type'=>'user'));	
			}
			else{
				$query = $this->db->insert($this->_online_table,array('last_active_time'=>date('Y-m-d h:i:s',time()),'status'=>1,'user_id'=>$id,'user_type'=>'user'));
			}			
		}
	}

	function get_online_data($where=false,$order=false,$single=false){
		$resultArr = array();
		if($order){
			foreach($order as $set =>$value){				
	            $this->db->order_by($set,$value);
			}
		}
		if($where){
	        $this->db->where_in('id',$where);
		}
		$this->db->where('confirm','confirm');
      	if($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result';
        }
       	$results = $this->db->get($this->_user_table)->$method();
		//echo $this->db->last_query();
		if($results){
			foreach($results as $set_r){
				$image = 'assets/uploads/profile.jpg';
				if(!empty($set_r->image)){
					$image = 'assets/uploads/users/small/'.$set_r->image;
				}
				$this->db->where(array('last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time())),'user_id'=>$set_r->id));
		       	$checkOnline = $this->db->get($this->_online_table)->row();
//				echo $this->db->last_query();
				if($checkOnline){
					$resultArr[] =array('user_id'=>$set_r->id,'image'=>$image,'username'=>$set_r->first_name.' '.$set_r->last_name,'status'=>1);
				}
			}
		}
		
/*       	echo '<pre>';
		print_r($resultArr);die;		*/
        return $resultArr;
	}

	function online_data($where=false,$order=false,$single=false){
		$resultArr = array();
		if($order){
			foreach($order as $set =>$value){				
	            $this->db->order_by($set,$value);
			}
		}
		if($where){
	        $this->db->where_in('id',$where);
		}
      	if($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result';
        }
       	$results = $this->db->get($this->_user_table)->$method();
		if($results){
			foreach($results as $set_r){
				$this->db->where(array('last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time())),'user_id'=>$set_r->id));
		       	$checkOnline = $this->db->get($this->_online_table)->row();
//				echo $this->db->last_query();
				if($checkOnline){
					$resultArr[] =array('user_id'=>$set_r->id,'status'=>1);
				}
				else{
					$resultArr[] =array('user_id'=>$set_r->id,'status'=>0);
				}				
			}
		}
		
/*       	echo '<pre>';
		print_r($resultArr);die;		*/
        return $resultArr;
	}

	//default
	function online_data123($where=false,$order=false,$single=false){
		$resultArr = array();
		if($order){
			foreach($order as $set =>$value){				
	            $this->db->order_by($set,$value);
			}
		}
		if($where){
	        $this->db->where($where);
		}
      	if($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result';
        }
       	$results = $this->db->get($this->_user_table)->$method();
		if($results){
			foreach($results as $set_r){
				$this->db->where(array('last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time())),'user_id'=>$set_r->id));
		       	$checkOnline = $this->db->get($this->_online_table)->row();
//				echo $this->db->last_query();
				if($checkOnline){
					$resultArr[] =array('user_id'=>$set_r->id,'status'=>1);
				}
				else{
					$resultArr[] =array('user_id'=>$set_r->id,'status'=>0);
				}				
			}
		}
		
/*       	echo '<pre>';
		print_r($resultArr);die;		*/
        return $resultArr;
	}


	//default
	function get_online_data123($where=false,$order=false,$single=false){
		$resultArr = array();
		if($order){
			foreach($order as $set =>$value){				
	            $this->db->order_by($set,$value);
			}
		}
		if($where){
	        $this->db->where($where);
		}
		$this->db->where('confirm','confirm');
      	if($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result';
        }
       	$results = $this->db->get($this->_user_table)->$method();
		if($results){
			foreach($results as $set_r){
				$image = 'assets/uploads/profile.jpg';
				if(!empty($set_r->image)){
					$image = 'assets/uploads/users/small/'.$set_r->image;
				}
				$this->db->where(array('last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time())),'user_id'=>$set_r->id));
		       	$checkOnline = $this->db->get($this->_online_table)->row();
//				echo $this->db->last_query();
				if($checkOnline){
					$resultArr[] =array('user_id'=>$set_r->id,'image'=>$image,'username'=>$set_r->username,'status'=>1);
				}
			}
		}
		
/*       	echo '<pre>';
		print_r($resultArr);die;		*/
        return $resultArr;
	}

}