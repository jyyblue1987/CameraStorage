<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_chat extends CI_Controller {
	public $_subView = 'templates/';
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','language','url','date','front','smiley'));	
		$this->load->library(array('form_validation','session','table'));
		$this->load->model(array('comman_model','chat_model'));
        $detail = $this->session->all_userdata();
		if(isset($detail['user_session'])){
			if(isset($detail['user_session']['loginType'])){
				if($detail['user_session']['loginType']=='user'){
		            $this->data['user_account'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
				}
				else{
					$redirect =true;
				}
				
			}
			else{
				$redirect =true;
			}
        }
		else{
			$redirect =true;
		}
	}

	public function index(){
		$image_array = get_clickable_smileys(base_url().'assets/global/plugins/chat/smileys/', 'btn-input');
		$col_array = $this->table->make_columns($image_array, 8);
		$this->data['smiley_table'] = $this->table->generate($col_array);

		if(!isset($this->data['user_chat']))			
		$this->data['search'] ='';
		$this->load->view('templates/includes/chat',$this->data);
	}



	function unread(){	
		$arr =  array();
		$arr['success'] =false;		
		if(isset($this->data['user_account'])){
			///update status
			$this->chat_model->update($this->data['user_account']->id);
			$check_list = $this->comman_model->get_by('user_online',array('user_id'=>$this->data['user_account']->id,'user_type'=>'user'),false,false,true); 
			if(!empty($check_list)){
				$this->comman_model->update_by('user_online',array('last_active_time'=>date('Y-m-d h:i:s',time()),'user_type'=>'user'),array('user_id'=>$this->data['user_account']->id,'user_type'=>'user'));
			}
			else{
				$this->comman_model->add('user_online',array('last_active_time'=>date('Y-m-d h:i:s',time()),'status'=>1,'user_id'=>$this->data['user_account']->id,'user_type'=>'user'));
			}			
			//echo $this->db->last_query();

			$query = 'select * from users_chat where (to_id='.$this->data['user_account']->id.') and is_read=0;';
			$getMessage = $this->comman_model->get_query($query,false);
			if($getMessage){
				$arr['success'] =true;				
				$unreadUser =array();
				$temp = array();
				foreach($getMessage as $set_msge){
					if(in_array($set_msge->from_id,$unreadUser)){
						
					}
					else{
							$query = 'select * from users_chat where (to_id='.$this->data['user_account']->id.')and from_id='.$set_msge->from_id.' and is_read=0;';
							$getCount = count($this->comman_model->get_query($query,false));
							$unreadUser[] =array('user'=>$set_msge->from_id,'count'=>$getCount);
					}
					$type = 'in';
					$name = $set_msge->from_name;
					$image = 'assets/uploads/profile.jpg';

					$formUser = $this->comman_model->get_by('users',array('id'=>$set_msge->from_id),false,false,true);
					if($formUser){
						if(!empty($formUser->image)){
							$image = 'assets/uploads/users/small/'.$formUser->image;
						}
					}
					
/*					if($set_msge->to_id==$this->data['user_account']->id){
						$type = 'in';
						$name = $this->data['user_account']->username;
					}*/
					$temp[] = array(
								'msg'=>$set_msge->id,
								"sender"=>$set_msge->from_id,
								"recipient"=>$set_msge->to_id,
								"avatar"=>$image,
								"body"=>$set_msge->message,
								"time"=>$set_msge->sent,
								"type"=>$type,
								"name"=>$name
								);
				}
				$arr['senders']=$unreadUser;
				$arr['messages']=$temp;
			}
		}
		if($this->data['user_account']->account_type=='S'){
			$f_u_chat =  $this->comman_model->get_query('select * from users where parent_id ='.$this->data['user_account']->id,false);
			$FrndList = array();
			if($f_u_chat){
				foreach($f_u_chat as $set_product){
					$FrndList[] = $set_product->id;
				}
			}
		}
		else{
			$f_u_chat =  $this->comman_model->get_query('select * from users where id ='.$this->data['user_account']->parent_id,false);
			$FrndList = array();
			if($f_u_chat){
				foreach($f_u_chat as $set_product){
					$FrndList[] = $set_product->id;
				}
			}
		}
		if($FrndList){
			$arr['user_online_data'] = $this->chat_model->get_online_data($FrndList);
			$arr['user_online_count'] = count($this->chat_model->get_online_data($FrndList));
			$arr['user_online'] = $this->chat_model->online_data($FrndList);
		}
		$arr['lang_code'] = 'EN';
		//for admin online

		$this->db->where(array('last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time())),'user_id'=>0));
		$checkOnline = $this->db->get('user_online')->row();
//				echo $this->db->last_query();
		if($checkOnline){
			$arr['user_online'][] =array('user_id'=>0,'status'=>1);
		}
		else{
			$arr['user_online'][] =array('user_id'=>0,'status'=>0);
		}				
		echo json_encode($arr);	
	}

	function send_message(){
		$arr =  array();
		$arr['success'] =false;
		$to_user = $this->input->post('user');
		$message = $this->input->post('message');

/*		$to_user = 0;
		$message = 'asda';*/
		
		if($to_user==0&&$message){
			if(isset($this->data['user_account'])){
				$arr['success'] =true;
				$time =date('Y-m-d h:i:s');
				$post_data = 	array(
								'from_id'=>$this->data['user_account']->id,
								'from_name'=>$this->data['user_account']->username,
								'to_id'=>$to_user,
								'to_name'=>'Admin',
								'message'=>$message,'sent'=>$time);

				$image = 'assets/uploads/profile.jpg';
				if(!empty($this->data['user_account']->image)){
					$image = 'assets/uploads/users/small/'.$this->data['user_account']->image;
				}
				$ids= $this->comman_model->save('users_chat',$post_data);
				$arr['message'] =array('name'=>$this->data['user_account']->username,'body'=>$message,'time'=>$time,'type'=>'out','avatar'=>$image);
			}		
		}
		elseif($to_user&&$message){
			if(isset($this->data['user_account'])){
				$get_user =$this->comman_model->get_by('users',array('id'=>$to_user),false,false,true);
				if($get_user){
					$arr['success'] =true;
					$time =date('Y-m-d h:i:s');
					$post_data = 	array(
									'from_id'=>$this->data['user_account']->id,
									'from_name'=>$this->data['user_account']->username,
									'to_id'=>$to_user,
									'to_name'=>$get_user->username,
									'message'=>$message,'sent'=>$time);
					/*echo '<pre>';
					print_r($post_data);
					die;
					
*/
					$image = 'assets/uploads/profile.jpg';
					if(!empty($this->data['user_account']->image)){
						$image = 'assets/uploads/users/small/'.$this->data['user_account']->image;
					}
					$ids= $this->comman_model->save('users_chat',$post_data);
					$arr['message'] =array('name'=>$this->data['user_account']->username,'body'=>$message,'time'=>$time,'type'=>'out','avatar'=>$image);
				}
			}
		}
		echo json_encode($arr);		
	}

	function messages(){
		$arr =  array();
		$arr['success'] =false;
/*
		$arr['success'] =true;
		$arr['buddy'] =array('status'=>1);
		echo json_encode($arr);*/
		$postUser = $this->input->post('user');
	//	$postUser = 0;
		if($postUser){//for user
			if(isset($this->data['user_account'])){
				$arr['success'] =true;
				//read user 
				$this->db->where('to_id',$this->data['user_account']->id);
				$this->db->where('from_id',$postUser);
				$this->db->set('is_read',1, true);
				$this->db->update('users_chat');

				//get user msge
				if($postUser==0){
					$userSet = new stdClass();
					$userSet->username = 'Admin';
					$userSet->id 		= 0;
					$userSet->image		= '';
				}
				else{
					$userSet = $this->comman_model->get_by('users',array('id'=>$postUser),false,false,true);				
					$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$postUser.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
					if(!empty($online_data)){
						$status =1;
					}
					else{
						$status =0;
					}
				}
				
				$arr['buddy']= array(
								"status"=>$status,
								"id"=>$postUser,
								"more"=>false,
								"recipient"=>$this->data['user_account']->id,
								"avatar"=>"member_2.jpg",
								"body"=>"dasd",
								"time"=>"2015, Oct 10, 11:32 am",
								"type"=>"in",
								"name"=>$userSet->username,
								"more"=>false
								);

				$query = 'select * from users_chat where (to_id='.$this->data['user_account']->id.' and from_id='.$postUser.') or  (from_id='.$this->data['user_account']->id.' and to_id='.$postUser.');';
				$getMessage = $this->comman_model->get_query($query,false);
				if($getMessage){
					$temp = array();
					foreach($getMessage as $set_msge){
						$image = 'assets/uploads/profile.jpg';
						$type = 'in';
						$name = $userSet->username;					
						if(!empty($userSet->image)){
							$image = 'assets/uploads/users/small/'.$userSet->image;
						}
						if($set_msge->from_id==$this->data['user_account']->id){
							$image = 'assets/uploads/profile.jpg';
							$type = 'out';
							$name = $this->data['user_account']->username;
							if(!empty($this->data['user_account']->image)){
								$image = 'assets/uploads/users/small/'.$this->data['user_account']->image;
							}
						}
						
						$temp[] =array(
									"recipient"=>$set_msge->to_id,
									"avatar"=>$image,
									"body"=>$set_msge->message,
									"time"=>h_dateFormat('d-m-Y h:i:s',$set_msge->sent),
									"type"=>$type,
									"name"=>$name,
									);
					}
					$arr['thread'] =$temp;
				}
			}
		}
		else if($postUser==0){//for admin
			if(isset($this->data['user_account'])){
				$arr['success'] =true;
				//read user 
				$this->db->where('to_id',$this->data['user_account']->id);
				$this->db->where('from_id',$postUser);
				$this->db->set('is_read',1, true);
				$this->db->update('users_chat');

				//get user msge
				if($postUser==0){
					$userSet = new stdClass();
					$userSet->username = 'Admin';
					$userSet->id 		= 0;
					$userSet->image		= '';
					$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$postUser.' and user_type="admin" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
					if(!empty($online_data)){
						$status =1;
					}
					else{
						$status =0;
					}
				}
				else{
					$userSet = $this->comman_model->get_by('users',array('id'=>$postUser),false,false,true);				
					$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$postUser.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
					if(!empty($online_data)){
						$status =1;
					}
					else{
						$status =0;
					}
				}
				
				$arr['buddy']= array(
								"status"=>$status,
								"id"=>$postUser,
								"more"=>false,
								"recipient"=>$this->data['user_account']->id,
								"avatar"=>"member_2.jpg",
								"body"=>"dasd",
								"time"=>"2015, Oct 10, 11:32 am",
								"type"=>"in",
								"name"=>$userSet->username,
								"more"=>false
								);

				$query = 'select * from users_chat where (to_id='.$this->data['user_account']->id.' and from_id='.$postUser.') or  (from_id='.$this->data['user_account']->id.' and to_id='.$postUser.');';
				$getMessage = $this->comman_model->get_query($query,false);
				if($getMessage){
					$temp = array();
					foreach($getMessage as $set_msge){
						$image = 'assets/uploads/profile.jpg';
						$type = 'in';
						$name = $userSet->username;					
						if(!empty($userSet->image)){
							$image = 'assets/uploads/users/small/'.$userSet->image;
						}
						if($set_msge->from_id==$this->data['user_account']->id){
							$type = 'out';
							$name = $this->data['user_account']->username;
							if(!empty($this->data['user_account']->image)){
								$image = 'assets/uploads/users/small/'.$this->data['user_account']->image;
							}
						}
						
						$temp[] =array(
									"recipient"=>$set_msge->to_id,
									"avatar"=>$image,
									"body"=>$set_msge->message,
									"time"=>$set_msge->sent,
									"type"=>$type,
									"name"=>$name,
									);
					}
					$arr['thread'] =$temp;
				}
			}
		}
		echo json_encode($arr);		
	}

	function mark_read(){
		$id = $this->input->post('id');
		if($id&&$this->data['user_account']){
			$this->db->where('to_id',$this->data['user_account']->id);
			$this->db->where('id',$id);
			$this->db->set('is_read',1, true);
			$this->db->update('users_chat');
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */