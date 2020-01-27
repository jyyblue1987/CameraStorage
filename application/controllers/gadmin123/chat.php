<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends Admin_Controller
{
	public $_table_names = 'chat_messages';
	public $_subView = 'admin/chat/';
	public $_redirect = 'admin/chat';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'chat';
		$this->load->model('chat_model');
		$this->load->helper(array('smiley','front'));	
		$this->load->library(array('table'));

		date_default_timezone_set('UTC');		
	}
    
	public function index(){
	}

	function mark_read(){		
		$id = $this->input->post('id');
		if($id){
			$this->db->where('to_id',0);
			$this->db->where('id',$id);
			$this->db->set('is_read',1, true);
			$this->db->update('users_chat');
		}
	}
	
	function messages(){
		$arr =  array();
		$arr['success'] =false;
/*
		$arr['success'] =true;
		$arr['buddy'] =array('status'=>1);
		echo json_encode($arr);*/
		$postUser = $this->input->post('user');
		$limit = $this->input->post('limit');
		//$postUser = 1;
		//$limit = 12;
		if($postUser){
			///read user 
			$this->db->where('to_id',0);
			$this->db->where('from_id',$postUser);
			$this->db->set('is_read',1, true);
			$this->db->update('users_chat');
			$temps = array();
			$temps["status"] =0;

//check online
			$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$postUser.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
			
			if(!empty($online_data)){
				$temps["status"] =1;
			}
			$userSet = $this->comman_model->get_by('users',array('id'=>$postUser),false,false,true);
			$arr['success'] =true;

			$temps["recipient"] = 0;
			$temps["avatar"] ='assets/uploads/profile.jpg';
			$temps["body"] ='';
			$temps["name"] =$userSet->username;
			$temps["time"]="2015, Oct 10, 11:32 am";
			$temps["type"]="in";
			$temps["id"]=$postUser;

			$arr['buddy']= $temps;

			$query = "select * from users_chat where (to_id=0 and from_id=".$postUser.") or  (from_id=0 and to_id=".$postUser.") ";

			$count = count($this->comman_model->get_query($query,false));

			if($limit){
				$set_limit =$limit;
			}
			else{
				$set_limit = 3;	
			}
//			$query = "select * from users_chat where (to_id=0 and from_id=".$postUser.") or  (from_id=0 and to_id=".$postUser.") order by id desc limit $set_limit ";
			$query = "select * from users_chat where (to_id=0 and from_id=".$postUser.") or  (from_id=0 and to_id=".$postUser.") order by id desc ";
			

			$getMessage = $this->comman_model->get_query($query,false);
			if($getMessage){
/*				echo '<pre>';
				print_r($getMessage);*/
				//$arr['success'] =true;
				if($count>$set_limit){
					//echo 'as';
					$temps['more'] = true;
					$temps['limit'] = $set_limit+3;
					$temps['remaining'] = $count-$set_limit;
				}
				$temp = array();
				foreach($getMessage as $set_msge){
					$type = 'in';
					$name = $userSet->username;
					$image = 'assets/uploads/profile.jpg';
					if(!empty($userSet->image)){
						$image = 'assets/uploads/users/small/'.$userSet->image;
					}
					if($set_msge->from_id==0){
						$type = 'out';
						$name = 'Admin';
						$image = 'assets/uploads/profile.jpg';
					}
					$temp[] =array(
								"recipient"=>$set_msge->to_id,
								"avatar"=>$image,
								"body"=>parse_smileys($set_msge->message, base_url().'assets/plugins/chat/images/smileys/'),
								"time"=>h_dateFormat($set_msge->sent,'d-m-Y h:i:s'),
								"type"=>$type,
								"name"=>$name,
								);

				}
				$arr['thread'] =array_reverse($temp);
			}
		}
/*		echo '<pre>';
		print_r($arr);*/
		echo json_encode($arr);
		
	}
	
	function unread() {
		$arr =  array();
		$arr['success'] =false;
		$this->chat_model->update(0);
		$query = 'select * from users_chat where (to_id=0) and is_read=0 group by from_id;';
		$getMessage = $this->comman_model->get_query($query,false);
		if($getMessage){
			$arr['success'] =true;				
			$unreadUser =array();
			$temp = array();
			foreach($getMessage as $set_msge){
				if(in_array($set_msge->from_id,$unreadUser)){
					
				}
				else{
						$query = 'select * from users_chat where (to_id=0)and from_id='.$set_msge->from_id.' and is_read=0;';
						$getCount = count($this->comman_model->get_query($query,false));
						$unreadUser[] =array('user'=>$set_msge->from_id,'count'=>$getCount);
				}
	/*					echo '<pre>';
				print_r($unreadUser);*/
	
				$type = 'out';
				$name = $set_msge->from_name;
/*				if($set_msge->to_id==0){
					$type = 'in';
					$name = 'Admin';
				}*/
				$image = 'assets/uploads/profile.jpg';
				$formUser = $this->comman_model->get_by('users',array('id'=>$set_msge->from_id),false,false,true);
				if($formUser){
					if(!empty($formUser->image)){
						$image = 'assets/uploads/users/small/'.$formUser->image;
					}
				}

				$temp[] = array(
							'msg'=>$set_msge->id,
							"sender"=>$set_msge->from_id,
							"recipient"=>$set_msge->to_id,
							"avatar"=>$image,
							"body"=>parse_smileys($set_msge->message, base_url().'assets/plugins/chat/images/smileys/'),
							"time"=>h_dateFormat($set_msge->sent,'d-m-Y h:i:s'),
							"type"=>$type,
							"name"=>$name
							);
			}
			$arr['senders']=$unreadUser;
			$arr['messages']=$temp;
		}
		//get user online 
		$arr['user_online'] = $this->chat_model->online_data();
		$arr['user_online_data'] = $this->chat_model->get_online_data();
		$arr['user_online_count'] = count($this->chat_model->get_online_data());
		echo json_encode($arr);
	}
	
	function send_message(){
		$arr =  array();
		$arr['success'] =false;
		$to_user = $this->input->post('user');
		$message = $this->input->post('message');

		if($to_user&&$message){
			$get_user =$this->comman_model->get_by('users',array('id'=>$to_user),false,false,true);
			if($get_user){
				$arr['success'] =true;
				$time =date('Y-m-d h:i:s');
				$post_data = 	array(
								'from_id'=>0,
								'from_name'=>'Admin',
								'to_id'=>$to_user,
								'to_name'=>$get_user->username,
								'message'=>$message,'sent'=>$time);
				$ids= $this->comman_model->save('users_chat',$post_data);
				$arr['message'] =array('name'=>'Admin','body'=>parse_smileys($message, base_url().'assets/plugins/chat/images/smileys/'),'time'=>h_dateFormat($time,'d-m-Y h:i:s'),'type'=>'out',"avatar"=>"assets/uploads/profile.jpg");
			}
		}
		echo json_encode($arr);
		
	}

}
