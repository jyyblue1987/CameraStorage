<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_chat extends User_Controller{	
	public $_subView = 'user/group_chat/';
	public $_mainView = 'user/';
	public $_table_names = 'groups';
	public $_group_table = 'groups_chat';
	public $_table_user_names = 'groups_user';
	public $_redirect = '/group';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['name'] = 'Dashboard';	
		$this->load->helper(array('smiley'));
		$this->load->library(array('table'));
        $this->load->model(array('group_model','chat_model'));
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
		

        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;

        $this->data['_get_done'] = $this->data['lang_code'].$this->_redirect.'/get_done';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';
		$this->data['active'] = 'Sell Management';	
	}

	function checkUserGroup($id=false){
		$return_data = false;
		$checkGroupOwnner = $this->comman_model->get_by('requests',array('id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,true);
		if($checkGroupOwnner){
			$return_data = true;
		}
		else{}
		return $return_data;
	}

	function l($id=false){	
		if(!$id){
			redirect($this->data['lang_code'].'/user_group');
		}
		$this->data['side_group_activate'] = true;
		//check  group 
		$this->data['group_data'] = $this->comman_model->get_by('groups',array('id'=>$id),false,false,true);
		if(!$this->data['group_data']){
			redirect($this->data['lang_code'].'/user_group');
		}
		$this->data['user_invate'] = 0;

		//check user join
		$check_ref = false;
		//$owngroup  = $this->comman_model->get_by('groups',array('id'=>$id,'ownner_id'=>$this->data['user_details']->id),false,false,true);
		if($this->data['group_data']->ownner_id==$this->data['user_details']->id){
			$this->data['user_invate'] = 1;
		}
		else{
			if($this->data['group_data']->type=='private'){
				$check_join = $this->comman_model->get_by('groups_user',array('user_id'=>$this->data['user_details']->id,'group_id'=>$id),false,false,true);
				if(!$check_join){
					$check_ref = true;
				}
				else{
					$this->data['user_invate'] = 1;
				}
			}
			else{
				//$check_join = $this->comman_model->get_query("select * from groups where find_in_set('".$this->data['user_details']->id."',user_id) <> 0 and id=".$id.";");
				$check_join = $this->comman_model->get_by('groups_user',array('user_id'=>$this->data['user_details']->id,'group_id'=>$id),false,false,true);
				if($check_join){
					if($check_join->confirm==1)
						$this->data['user_invate'] = 1;
					else
						$this->data['user_invate'] = 2;
				}
			}
		}
	/*		echo  $check_ref;
			die;*/
		if($check_ref){
			redirect($this->data['lang_code'].'/user_group');
		}

		$this->data['side_group_member'] = $this->comman_model->get_by('groups_user',array('group_id'=>$id,'confirm'=>1),false,false,false);
		if($this->data['user_details']->id==$this->data['group_data']->ownner_id){
			$this->data['req_user_member'] = $this->comman_model->get_by('groups_user',array('group_id'=>$id,'confirm'=>0),false,false,false);			
		}
		else{
			$this->data['req_user_member'] = '';
		}
		if($this->data['group_data']->ownner_id==$this->data['user_details']->id){
			$this->data['side_group_ownner'] = $this->data['user_details'];
		}
		else{
			$this->data['side_group_ownner'] = $this->comman_model->get_by('users',array('id'=>$this->data['group_data']->ownner_id),false,false,true);
		}

		$chatUserArr[] = $this->data['group_data']->ownner_id;
		if($this->data['side_group_member']){
			foreach($this->data['side_group_member'] as $set_a){
				$chatUserArr[] = $set_a->user_id;
			}
		}
		$this->db->where_in('id',$chatUserArr);
		$this->db->order_by('username','asc');
		$this->data['chatUserList'] = $this->comman_model->get_by('users',array('id !='=>$this->data['user_details']->id,'enabled'=>1,'confirm'=>'confirm'),false,false,false);
		//update read post
//		echo $string = "select * from users_status where find_in_set('".$this->data['user_details']->id."',is_read) <> 0 and group_id=".$this->data['group_data']->id.";";
		$this->db->where('group_id',$id);
		$this->db->set('is_read', 'CONCAT(is_read,\',\',\''.$this->data['user_details']->id.'\')', FALSE);
		$this->db->update('users_status');

/*		$rPostCount = $this->comman_model->get_query($string,false);
		if(!$rPostCount){
						
			echo 'ok';
			die;
		}*/

        $this->data['name'] = $this->data['group_data']->name;
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['breadcrumbs'] = '<li><a href="'.$this->data['lang_code'].'/user_group">Groups</a></li><li><a href="'.$this->data['lang_code'].'/group/l/'.$this->data['group_data']->id.'">'.$this->data['name'].'</a></li><li>Chat</li>';


		$image_array = get_clickable_smileys(base_url().'assets/global/plugins/chat/smileys/', 'status_msge');
		$col_array = $this->table->make_columns($image_array, 8);
		$this->data['smiley_table'] = $this->table->generate($col_array);


        $this->data['group_id'] = $id;
		$this->db->order_by('name','desc');
        $this->data['subview'] = $this->_subView.'index';		
		$this->load->view($this->_mainView.'/_layout_main',$this->data);
	}
	
	function public_chat(){
		$arr =  array();
		$arr['success'] =true;
		if (!$this->input->is_ajax_request()) { exit('no valid req.'); }

		$getlastId = $this->input->get('msg');
		if($getlastId>0){
			 $query = 'select * from '.$this->_group_table.' where to_id=-1 and id > '.$getlastId.';';
		}
		else{
			$query = 'select * from '.$this->_group_table.' where to_id=-1 ;';
		}
		$getMessage = $this->comman_model->get_query($query,false);
		if($getMessage){
			$temp = array();
			foreach($getMessage as $set_msge){
/*					echo '<pre>';
				print_r($unreadUser);*/
				$user_data = $this->comman_model->get_by('users',array('id'=>$set_msge->from_id),false,false,true);
				if($user_data){
					$image = 'assets/uploads/profile.jpg';
					if(!empty($user_data->image)){
						$image = 'assets/uploads/users/'.$user_data->image;
					}
					$type = 'out';
					$name = $user_data->username;
					$temp[] = array(
								'msg'=>$set_msge->id,
								"sender"=>$set_msge->from_id,
								"recipient"=>$set_msge->to_id,
								"avatar"=>$image,
								"body"=>$set_msge->message,
								"time"=>$set_msge->sent,
								"name"=>$name
								);
				}
			}
			$arr['messages']=$temp;
		}
		$query = 'select * from '.$this->_group_table.' where to_id=-1 order by id desc;';
		$getMessage = $this->comman_model->get_query($query,true);
		if($getMessage){
			$arr['msg_id'] =$getMessage->id;
		}
		else{
			$arr['msg_id'] =0;
		}
/*		echo '<pre>';
		print_r($arr);*/
		echo json_encode($arr);		
	}

	function send_pmessage(){
		$arr =  array();
		$arr['success'] =false;
		$message = $this->input->post('message');
		if (!$this->input->is_ajax_request()) { exit('no valid req.'); }

/*		$to_user = 1;
		$message = 'asda';
*/
		if($message){
			if(isset($this->data['user_details'])){
					$arr['success'] =true;
					$time =date('Y-m-d h:i:s');
					$post_data = 	array(
									'from_id'=>$this->data['user_details']->id,
									'from_name'=>$this->data['user_details']->username,
									'to_id'=>-1,
									'to_name'=>'public',
									'message'=>$message,'sent'=>$time);
					$ids = $this->comman_model->save($this->_group_table,$post_data);
					$arr['message'] =array('name'=>$this->data['user_details']->username,'body'=>$message,'time'=>$time,'id'=>$ids);
	
					$arr['message']['avatar']  = 'assets/uploads/profile.jpg';
					if(!empty($this->data['user_details']->image)){
						$arr['message']['avatar'] = 'assets/uploads/users/'.$this->data['user_details']->image;
					}

			}
			else{
				$arr['error'] ='Please Login first';
			}
		}
		echo json_encode($arr);		
	}

	function unmessage(){	
		$arr =  array();
		$arr['success'] =false;		
		$get_group_id = $this->input->get('group_id');		
		if(isset($this->data['user_details'])){
			if($get_group_id){
				///update status
				$this->data['user_account'] = $this->data['user_details'];
				$this->chat_model->update($this->data['user_details']->id);
				$check_list = $this->comman_model->get_by('user_online',array('user_id'=>$this->data['user_details']->id,'user_type'=>'user'),false,false,true); 
				if(!empty($check_list)){
					$this->comman_model->update_by('user_online',array('last_active_time'=>date('Y-m-d h:i:s',time()),'user_type'=>'user'),array('user_id'=>$this->data['user_details']->id,'user_type'=>'user'));
				}
				else{
					$this->comman_model->add('user_online',array('last_active_time'=>date('Y-m-d h:i:s',time()),'status'=>1,'user_id'=>$this->data['user_details']->id,'user_type'=>'user'));
				}			
				//echo $this->db->last_query();
	
				$query = 'select * from '.$this->_group_table.' where (to_id='.$this->data['user_details']->id.') and is_read=0;';
				$getMessage = $this->comman_model->get_query($query,false);
				if($getMessage){
					$arr['success'] =true;				
					$unreadUser =array();
					$temp = array();
					foreach($getMessage as $set_msge){
						if(in_array($set_msge->from_id,$unreadUser)){
							
						}
						else{
								$query = 'select * from '.$this->_group_table.' where (to_id='.$this->data['user_details']->id.')and from_id='.$set_msge->from_id.' and is_read=0;';
								$getCount = count($this->comman_model->get_query($query,false));
								$unreadUser[] =array('user'=>$set_msge->from_id,'count'=>$getCount);
						}
						$type = 'out';
						$name = $set_msge->from_name;
						$image = 'assets/uploads/profile.jpg';
	
						$formUser = $this->comman_model->get_by('users',array('id'=>$set_msge->from_id),false,false,true);
						if($formUser){
							if(!empty($formUser->image)){
								$image = 'assets/uploads/users/'.$formUser->image;
							}
						}
						
	/*					if($set_msge->to_id==$this->data['user_details']->id){
							$type = 'in';
							$name = $this->data['user_details']->username;
						}*/

						$fileName = '';
						if(!empty($set_msge->file_name)){
							$fileName = $set_msge->file_name;								
						}
						$temp[] = array(
									'msg'=>$set_msge->id,
									"sender"=>$set_msge->from_id,
									"recipient"=>$set_msge->to_id,
									"avatar"=>$image,
									"file_name"=>$fileName,
									"body"=>parse_smileys($set_msge->message, base_url().'assets/plugins/chat/images/smileys/'),
									"time"=>h_dateFormat($set_msge->sent,'d-m-Y h:i:s'),
									"type"=>$type,
									"name"=>$name
									);
					}
					$arr['senders']=$unreadUser;
					$arr['messages']=$temp;
				}


				$chatUserArr = array();
				$requestData= $this->comman_model->get_by('requests',array('id'=>$get_group_id),false,false,true);
				if($requestData){
					if(!empty($requestData->chat_user)){
						$tempC = explode(',',$requestData->chat_user);
						$this->db->where_in('id',$tempC);
						$group_member = $this->comman_model->get_by('users',array('service'=>$requestData->service,'confirm'=>'confirm','account_type'=>'S'),false,false,false);
						//echo $this->db->last_query();
						if($group_member){
							foreach($group_member as $set_a){
								$chatUserArr[] = $set_a->id;
							}
						}	
					}
				}
/*				echo '<pre>';
				print_r($chatUserArr);
				die;*/
				$arr['user_online'] = $this->chat_model->online_data($chatUserArr);
				$arr['user_online_data'] = $this->chat_model->get_online_data($chatUserArr);
				$arr['user_online_count'] = count($this->chat_model->get_online_data($chatUserArr));
				$arr['lang_code'] = 'EN';

			}
		}
		

		echo json_encode($arr);	
	}

	function send_message(){
		$arr =  array();
		$arr['success'] =false;
		$to_user = $this->input->post('user');
		$message = $this->input->post('message');
		$group_id = $this->input->post('group_id');

/*		$to_user = 0;
		$message = 'asda';*/
		
		if($to_user&&$message&&$group_id){
			if(isset($this->data['user_details'])){
				$checkUserInGroup = $this->checkUserGroup($group_id);
				if($checkUserInGroup){
					$get_user =$this->comman_model->get_by('users',array('id'=>$to_user),false,false,true);
					if($get_user){
						$arr['success'] =true;
						$time =date('Y-m-d h:i:s');
						$post_data = 	array(
										'from_id'=>$this->data['user_details']->id,
										'from_name'=>$this->data['user_details']->username,
										'group_id'=>$group_id,
										'to_id'=>$to_user,
										'to_name'=>$get_user->username,
										'message'=>$message,
										'sent'=>$time
										);
						/*echo '<pre>';
						print_r($post_data);
						die;*/
						$file_data = $this->input->post('fileName');
						if(!empty($file_data)){						
							$post_data['file_name'] = $file_data;
						}
						$ids= $this->comman_model->save($this->_group_table,$post_data);

						$image = 'assets/uploads/profile.jpg';
						if(!empty($this->data['user_details']->image)){
							$image = 'assets/uploads/users/'.$this->data['user_details']->image;
						}

						$arr['message'] =array(
										'msge_id'=>$ids,
										'name'=>$this->data['user_details']->username,
										'body'=>parse_smileys($message, base_url().'assets/plugins/chat/images/smileys/'),
										'time'=>h_dateFormat($time,'d-m-Y h:i:s'),
										'type'=>'out','avatar'=>$image);
					}
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
		$group_id = $this->input->post('group_id');
/*		$postUser = 5;
		$group_id = 6;*/
	//	$postUser = 0;
		if($postUser&&$group_id){//for user
			if(isset($this->data['user_details'])){
				$checkUserInGroup =$this->checkUserGroup($group_id);
				if($checkUserInGroup){
					$arr['success'] =true;
					//read user 
					$this->db->where('to_id',$this->data['user_details']->id);
					$this->db->where('group_id',$group_id);
					$this->db->where('from_id',$postUser);
					$this->db->set('is_read',1, true);
					$this->db->update($this->_group_table);
	
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
									"recipient"=>$this->data['user_details']->id,
									"avatar"=>"member_2.jpg",
									"body"=>"dasd",
									"time"=>"2015, Oct 10, 11:32 am",
									"type"=>"in",
									"name"=>$userSet->username,
									"more"=>false
									);
	
					$query = 'select * from '.$this->_group_table.' where( (to_id='.$this->data['user_details']->id.' and from_id='.$postUser.') or  (from_id='.$this->data['user_details']->id.' and to_id='.$postUser.')) and group_id='.$group_id.';';
					$getMessage = $this->comman_model->get_query($query,false);
					if($getMessage){
						$temp = array();
						foreach($getMessage as $set_msge){
							$image = 'assets/uploads/profile.jpg';
							$type = 'in';
							$name = $userSet->username;					
							if(!empty($userSet->image)){
								$image = 'assets/uploads/users/'.$userSet->image;
							}
							if($set_msge->from_id==$this->data['user_details']->id){
								$image = 'assets/uploads/profile.jpg';
								$type = 'out';
								$name = $this->data['user_details']->username;
								if(!empty($this->data['user_details']->image)){
									$image = 'assets/uploads/users/'.$this->data['user_details']->image;
								}
							}
							
							$fileName = '';
							if(!empty($set_msge->file_name)){
								$fileName = $set_msge->file_name;								
							}
							$temp[] =array(
										"msge_id"=>$set_msge->id,
										"recipient"=>$set_msge->to_id,
										"avatar"=>$image,
										"body"=>parse_smileys($set_msge->message, base_url().'assets/plugins/chat/images/smileys/'),
										"file_name"=>$fileName,
										"time"=>h_dateFormat($set_msge->sent,'d-m-Y h:i:s'),
										"type"=>$type,
										"name"=>$name,
										);
						}
						$arr['thread'] =$temp;
						//echo'sad';
					}
				}
			}
		}
		echo json_encode($arr);		
	}

	function read(){
		$id = $this->input->post('id');
		if($id&&$this->data['user_details']){
			$this->db->where('to_id',$this->data['user_details']->id);
			$this->db->where('id',$id);
			$this->db->set('is_read',1, true);
			$this->db->update($this->_group_table);
		}
	}

	function notification(){
		$rel = array();
		$rel['status']= "error";
		$rel['msg']= '';
		$rel['sound'] = 0;
		$rel['count'] = 0;
		if(isset($this->data['user_details'])){
			$check_list = $this->comman_model->get_by('user_online',array('user_id'=>$this->data['user_details']->id,'user_type'=>'user'),false,false,true); 
			if(!empty($check_list)){
				$this->comman_model->update_by('user_online',array('last_active_time'=>date('Y-m-d h:i:s',time()),'user_type'=>'user'),array('user_id'=>$this->data['user_details']->id,'user_type'=>'user'));
			}
			else{
				$this->comman_model->add('user_online',array('last_active_time'=>date('Y-m-d h:i:s',time()),'status'=>1,'user_id'=>$this->data['user_details']->id,'user_type'=>'user'));
			}			


			$rel['status']= "ok";
			$checkmsge = $this->comman_model->get_query('SELECT * FROM '.$this->_group_table.' WHERE to_id ='.$this->data['user_details']->id.' AND is_read=0 AND is_sound=0 GROUP BY from_id ;',false);
			if($checkmsge){
				$this->db->where(array('to_id'=>$this->data['user_details']->id,'is_read'=>0,'is_sound'=>0));
				$this->db->set('is_sound', '1', FALSE);
				$this->db->update($this->_group_table);
				$rel['sound'] = 1;
			}
			$rel['count'] = count($this->comman_model->get_query('SELECT * FROM '.$this->_group_table.' WHERE to_id ='.$this->data['user_details']->id.' AND is_read=0 GROUP BY from_id ;',false));
		}		
		echo json_encode($rel);
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */