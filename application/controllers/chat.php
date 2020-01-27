<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {
	public $_subView = 'templates/';
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("America/Cancun"); 
//		date_default_timezone_set('GMT');		
//		date_default_timezone_set("Europe/London"); 

		$this->load->helper(array('form','language'));
		$this->load->helper(array('url','date','form'));	
		$this->load->library(array('form_validation','session'));
		$this->load->helper(array('smiley'));
		$this->load->library(array('table'));
		$this->load->model(array('comman_model'));
		$this->data['set_meta'] = 'search';
        $detail = $this->session->all_userdata();

		$redirect = false;
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

	function check_online($id,$type){
		$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$id.' and user_type="'.$type.'" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'" or status=1)');
		//echo $this->db->last_query().'<br>';
		
		//$online_data = $this->comman_model->get_by('user_online',array('user_id'=>$set_data->id,'last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time())),'user_type'=>'girl'),false,false,true);
		$check_olnine =false;
		if(!empty($online_data)){
			$check_olnine =true;
		}
		else{
			$check_olnine =false;
		}
		//echo $check_olnine.'das';
		return $check_olnine;
	}

	public function index(){
	    @session_start();
		if(isset($this->data['user_account'])){
			if( !isset( $_SESSION['chatusername'] )  || !isset( $_SESSION['username'] )  ){
				$_SESSION['chatusername'] = $this->data['user_account']->first_name.' '.$this->data['user_account']->last_name;				
				$_SESSION['username'] = $this->data['user_account']->id;			
			}
			$this->load->library('ci_chat');
		}

/*		if( !isset( $_SESSION['chatusername'] )  || !isset( $_SESSION['username'] )  ){
			$_SESSION['chatusername'] = $this->data['user_details']->first_name.' '.$this->data['user_details']->last_name;
			$_SESSION['username'] = $this->data['user_details']->id;			
		}*/
		
	}

	function all_views(){
		if(isset($this->data['user_account'])){
			$new_data = $this->comman_model->get_query("SELECT * FROM chat_messages where  recipient_id='-1' ORDER BY message_time");
			//echo $this->db->last_query();
			if($new_data){
			foreach($new_data as $row){
				$time = date("Y-m-d",strtotime($row->message_time));
				$now = date("Y-m-d");
				if ($time == $now) {
					$hourAndMinutes = date("h:i A", strtotime($row->message_time));
				}else{
					$hourAndMinutes = date("Y-m-d", strtotime($row->message_time));
				}
				if($row->user_id==$this->data['user_account']->id){
					$set_boy = $this->comman_model->get_by('users',array('id'=>$row->user_id),false,false,true);
					if(!empty($set_boy->image)){
						$image = 'assets/uploads/users/small/'.$set_boy->image;
					}
					else{
						$image = 'assets/uploads/profile.jpg';
					}
				 	$str = parse_smileys($row->message_content, base_url().'assets/plugins/chat/images/smileys/');	
	
					echo '<article id="chat-id-1" class="chat-item media arrow arrow-right"> 
						<a href="#" class="pull-right thumb-small avatar"><img src="'.$image.'" style="height:40px;width:55px" class="img-circle"></a> 
						<section class="media-body"> 
							<div class="panel text-small r-b-none"> 
								<div class="panel-body"><strong>'.$row->username.'</strong><br>'.$str.'</div> 
						   </div> 
						   <small class="text-muted"><i class="icon-ok text-success"></i>&nbsp;&nbsp;&nbsp;'.$hourAndMinutes.'</small> </section>
					</article>';
				}
				else{
					$set_girl = $this->comman_model->get_by('users',array('id'=>$row->user_id),false,false,true);
					if(!empty($set_girl->image)){
						$image = 'assets/uploads/users/small/'.$set_girl->image;
					}
					else{
						$image = 'assets/uploads/profile.jpg';
					}
					$str = parse_smileys($row->message_content, base_url().'assets/plugins/chat/images/smileys/');	
					echo'<article id="chat-id-1" class="chat-item media arrow arrow-left"> 
						<a href="#" class="pull-left thumb-small avatar"><img src="'.$image.'" style="height:40px;width:55px" class="img-circle"></a> 
						<section class="media-body"> 
							<div class="panel bg-lighter text-small l-b-none"> 
								<div class="panel-body1"><strong>'.$row->username.'</strong><br>'.$str.'</div> 
							</div> 
							<small class="text-muted">
							<i class="icon-ok text-success"></i>&nbsp;&nbsp;&nbsp;'.$hourAndMinutes.'</small> 
							</section> 
					</article>';
				}
				echo '<div class="clear"></div>';
			}
			}		
		}
	}
	
	function views($id = false){
		if(isset($this->data['user_account'])){
			$new_data = $this->comman_model->query_result("SELECT * FROM chat_messages where (user_id='".$this->data['user_account']->id."' and user_type='user' and recipient_id='".$id."' and recipient_type ='girl') OR (user_id='".$id."' and recipient_id='".$this->data['user_account']->id."' and recipient_type ='user' and user_type='girl' ) ORDER BY message_time");
			//echo $this->db->last_query();
			if($new_data){
			foreach($new_data as $row){
				$time = date("Y-m-d",strtotime($row['message_time']));
				$now = date("Y-m-d");
				if (($row['user_id'] == $this->data['user_account']->id) && ($time == $now)) {
					//$set_user = $this->comman_model->get_by('user',array('id'=>$id),false,false,true);
					$user = '<strong style="color:green;">'.$this->data['user_account']->first_name.'</strong>'.'-->'.$row['recipient']; 
				}else{
					$user = '<strong style="color:blue;">'.$this->data['user_account']->first_name.'</strong>'; 			
				}	
				if ($time == $now) {
					$hourAndMinutes = date("h:i A", strtotime($row['message_time']));
				}else{
					$hourAndMinutes = date("Y-m-d", strtotime($row['message_time']));
				}
				if($row['user_type']=='user'){
					$set_boy = $this->comman_model->get_by('users',array('id'=>$row['user_id']),false,false,true);
					if(!empty($set_boy->image)){
						$image = 'assets/uploads/users/small/'.$set_boy->image;
					}
					else{
						$image = 'assets/uploads/profile.jpg';
					}
				 $str = parse_smileys($row['message_content'], base_url().'assets/plugins/chat/images/smileys/');	
	
					echo '<article id="chat-id-1" class="chat-item media arrow arrow-right"> 
						<a href="#" class="pull-right thumb-small avatar"><img src="'.$image.'" style="height:40px;width:55px" class="img-circle"></a> 
						<section class="media-body"> 
							<div class="panel text-small r-b-none"> 
								<div class="panel-body">'.$str.'</div> 
						   </div> 
						   <small class="text-muted"><i class="icon-ok text-success"></i>&nbsp;&nbsp;&nbsp;'.$hourAndMinutes.'</small> </section>
					</article>';
				}
				else{
					$set_girl = $this->comman_model->get_by('users',array('id'=>$row['user_id']),false,false,true);
					if(!empty($set_girl->image)){
						$image = 'assets/uploads/users/small/'.$set_girl->image;
					}
					else{
						$image = 'assets/uploads/profile.jpg';
					}
					$str = parse_smileys($row['message_content'], base_url().'assets/plugins/chat/images/smileys/');	
					echo'<article id="chat-id-1" class="chat-item media arrow arrow-left"> 
						<a href="#" class="pull-left thumb-small avatar"><img src="'.$image.'" style="height:40px;width:55px" class="img-circle"></a> 
						<section class="media-body"> 
							<div class="panel bg-lighter text-small l-b-none"> 
								<div class="panel-body1">'.$str.'</div> 
							</div> 
							<small class="text-muted">
							<i class="icon-ok text-success"></i>&nbsp;&nbsp;&nbsp;'.$hourAndMinutes.'</small> 
							</section> 
					</article>';
				}
				echo '<div class="clear"></div>';
			}
			}
		
		}
	}

	function chat_views($id = false){
		$viewList ='<ul class="chats">';
		if(isset($this->data['user_account'])){
			//$new_data = $this->comman_model->query_result("SELECT * FROM chat_messages where (user_id='".$this->data['user_account']->id."' and user_type='user' and recipient_id='".$id."' and recipient_type ='girl') OR (user_id='".$id."' and recipient_id='".$this->data['user_account']->id."' and recipient_type ='user' and user_type='girl' ) ORDER BY message_time");

			$new_data = $this->comman_model->get_query("SELECT * FROM chat_messages where (user_id='".$this->data['user_account']->id."' and user_type='user' and recipient_id='".$id."'  ) OR (user_id='".$id."' and recipient_id='".$this->data['user_account']->id."' ) ORDER BY message_time");
			//echo $this->db->last_query();
			if($new_data){
			foreach($new_data as $row){
				$time = date("Y-m-d",strtotime($row->message_time));
				$now = date("Y-m-d");
				if (($row->user_id == $this->data['user_account']->id) && ($time == $now)) {
					//$set_user = $this->comman_model->get_by('user',array('id'=>$id),false,false,true);
					$user = '<strong style="color:green;">'.$this->data['user_account']->first_name.'</strong>'.'-->'.$row->recipient; 
				}else{
					$user = '<strong style="color:blue;">'.$this->data['user_account']->first_name.'</strong>'; 			
				}	
				if ($time == $now) {
					$hourAndMinutes = date("h:i A", strtotime($row->message_time));
				}else{
					$hourAndMinutes = date("Y-m-d", strtotime($row->message_time));
				}
				if($row->user_id==$this->data['user_account']->id){
					$set_boy = $this->comman_model->get_by('users',array('id'=>$row->user_id),false,false,true);
					if(!empty($set_boy->image)){
						$image = 'assets/uploads/users/small/'.$set_boy->image;
					}
					else{
						$image = 'assets/uploads/profile.jpg';
					}
					 $str = parse_smileys($row->message_content, base_url().'assets/plugins/chat/images/smileys/');	
	
					$viewList .= '<li class="out">
										<img src="'.$image.'" alt="" class="avatar">
										<div class="message">
											<span class="arrow">
											</span>
											<a class="name">'.$set_boy->first_name.'</a>
											<span class="datetime" style="color:#ccc">
											at '.$hourAndMinutes.'</span>
											<span class="body">'.$str.'</span>
										</div>
									</li>';
				}
				else{
					if($row->user_id==0){
						$userName = 'admin';
						$image = 'assets/uploads/profile.jpg';
					}
					else{
						$set_girl = $this->comman_model->get_by('users',array('id'=>$row->user_id),false,false,true);
						if($set_girl){
							$userName = $set_girl->first_name;							
						}
						else{
							$userName = 'No Name';
						}
						if(!empty($set_girl->image)){
							$image = 'assets/uploads/users/small/'.$set_girl->image;
						}
						else{
							$image = 'assets/uploads/profile.jpg';
						}
					}
					$str = parse_smileys($row->message_content, base_url().'assets/plugins/chat/images/smileys/');	
					$viewList .='<li class="in">
									<img src="'.$image.'" alt="" class="avatar">
									<div class="message">
										<span class="arrow">
										</span>
										<a class="name">'.$userName.'</a>
										<span class="datetime" style="color:#ccc"> at '.$hourAndMinutes.'</span>
										<span class="body">'.$str.'</span>
									</div>
									</li>';
				}
			}
			}
		
		}
		$viewList .='</ul>';
		echo $viewList;		
	}



	function views2($id = false){	
		$detail = $this->session->all_userdata();
		if(isset($detail['chat_session'])){
			$user_chat = $detail['chat_session'];
			$this->db->where('user_id ='.$user_chat['id'].' or recipient_id ='.$user_chat['id']);
			$new_data = $this->comman_model->get('chat_messages',false);
			//echo $this->db->last_query();die;
			foreach($new_data as $row){
				$time = date("Y-m-d",strtotime($row->message_time));
				$now = date("Y-m-d");
				if ($time == $now) {
					$hourAndMinutes = date("h:i A", strtotime($row->message_time));
				}else{
					$hourAndMinutes = date("Y-m-d", strtotime($row->message_time));
				}
				if($row->user_id!=$user_chat['id']){
					$image = 'assets/uploads/profile.jpg';
					echo '<div class="row msg_container base_receive">
							<div class="col-md-2 col-xs-2 avatar">
								<img src="'.$image.'" class=" img-responsive ">
							</div>
							<div class="col-md-10 col-xs-10">
								<div class="messages msg_receive">
									<p>'.$row->message_content.'</p>
									<time datetime="2009-11-13T20:00">'.$row->username.' • '.$hourAndMinutes.'</time>
								</div>
							</div>
						</div>';
				}
				else{
					$image = 'assets/uploads/profile.jpg';
					echo'<div class="row msg_container base_sent">
							<div class="col-md-10 col-xs-10"><div class="messages msg_sent">'.$row->message_content.'</p>
								<time datetime="2009-11-13T20:00">'.$row->username.' •'.$hourAndMinutes.'</time></div></div>
							<div class="col-md-2 col-xs-2 avatar">
								<img src="'.$image.'" class=" img-responsive ">
							</div>
						</div>';
				}
			}
		}
	}

	function send_chat(){
		if(isset($this->data['user_account'])){
			$post_data = array(
							'user_id'=>$this->data['user_account']->id,
							'username'=>$this->data['user_account']->first_name,
							'message_content'=>$this->input->post('message'),
							'recipient_id'=>$this->input->post('recipient_id'),
							'recipient'=>$this->input->post('recipient'),
						);
			if($post_data['recipient_id']==0){
				$post_data['recipient_type']='admin';
			}
			else if($post_data['recipient_id']=='-1'){
				$post_data['recipient_type']='public';
			}
			else{
				$post_data['recipient_type']='user';

			}
			$post_data['user_type']='user';
			//print_r($post_data);			
			$this->comman_model->save('chat_messages',$post_data);
		}
	}

	function get_online(){
		$show_status= 'off';
		$result = $this->comman_model->get_by('user_online',array('user_type'=>'admin','last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time()))),false,false,false);
		
		if($result){
			$show_status ='on';
		}		
		echo $show_status;
	}


	function get_history_girl(){	
		if(isset($this->data['user_account'])){
			if($this->data['user_account']->gender=='male'){
				$result = $this->comman_model->query_result("SELECT distinct username,user_id,user_type,recipient_id FROM chat_messages where (user_id='".$this->data['user_account']->id."' and user_type='user')  ORDER BY id desc");	
			}
			else{
				$result = $this->comman_model->query_result("SELECT distinct username,user_id,user_type,recipient_id FROM chat_messages where (user_id='".$this->data['user_account']->id."' and user_type='girl') or (recipient_id='".$this->data['user_account']->id."' and recipient_type='girl')  ORDER BY id desc");	
			}
			//echo $this->db->last_query();
			$output = ""; 
			if(!empty($result)){
				foreach($result as $set_data){
					$set_user= $this->comman_model->get_by('users',array('id'=>$set_data['recipient_id']),false,false,true);
					if(!empty($set_user->image)){
						$image = 'assets/uploads/girls/small/'.$set_user->image;
					}
					else{
						$image = 'assets/uploads/users/profile.jpg';
					}
					$output.='<div id="online_user_data" class="chat_icon"><a href="en/user/chat/'.$set_user->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_user->first_name.'</strong><br></td></tr></tbody></table></a></div>';
				}
			}
			echo $output;
			return $output;
		}
	}

	function read_message(){		
		$msge['result']= 'error';
		if(isset($this->data['user_account'])){
			$read_data = $this->comman_model->get_by('chat_messages',array('recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
			//echo $this->db->last_query();
			if($read_data){
				$msge['result']='success';
				$msge['count']=count($read_data);
			}						
			else{
				$msge['count']='';
			}

			echo json_encode($msge);
		}	
	}
	
	function getAllUser(){		
		$lang_code = $this->input->post('lang_code');
		if(isset($this->data['user_account'])){
			$result = $this->comman_model->query_result("SELECT distinct username,user_id,user_type,recipient_id, recipient_type FROM chat_messages where (user_id='".$this->data['user_account']->id."' and user_type='user')  ORDER BY id desc");	
			echo $this->db->last_query();
			$output = ""; 
			if(!empty($result)){
				foreach($result as $set_data){
					if($this->data['user_account']->gender=='male'){
						$set_user= $this->comman_model->get_by('users',array('id'=>$set_data['recipient_id']),false,false,true);
						
						//count for unread msge
						$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_user->id,'user_type'=>'girl','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
						if($read_data){
							$readCount='<span style="border-radius:50px;background:red;padding:5px 9px;color:white">'.count($read_data).'</span>';
						}						
						else{
							$readCount ='';
						}

						$check_online = $this->check_online($set_user->id,'user');
						if($check_online){
							$online_image = 'assets/plugins/chat/images/online.jpg';
						}
						else{
							$online_image = 'assets/plugins/chat/images/offline.jpg';
						}

						if(!empty($set_user->image)){
							$image = 'assets/uploads/users/small/'.$set_user->image;
						}
						else{
							$image = 'assets/uploads/users/profile.jpg';
						}
						$output.='<div id="online_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_user->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_user->first_name.'</strong>&nbsp;'.$readCount.'<br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';
					}
					else if($this->data['user_account']->gender=='female'){
						if($this->data['user_account']->id!=$set_data['user_id']){						
							$set_user= $this->comman_model->get_by('users',array('id'=>$set_data['user_id']),false,false,true);
	
							//count for unread msge
							$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_user->id,'user_type'=>'user','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'girl','read'=>0),false,false,false);
							if($read_data){
								$readCount='<span style="border-radius:50px;background:red;padding:5px 9px;color:white">'.count($read_data).'</span>';
							}						
							else{
								$readCount ='';
							}
							//echo $set_user->id;						
							$check_online = $this->check_online($set_user->id,'user');
							if($check_online){
								$online_image = 'assets/plugins/chat/images/online.jpg';
							}
							else{
								$online_image = 'assets/plugins/chat/images/offline.jpg';
							}
							if(!empty($set_user->image)){
									$image = 'assets/uploads/users/small/'.$set_user->image;
							}
							else{
								$image = 'assets/uploads/users/profile.jpg';
							}
							$output.='<div id="online_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_user->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_user->first_name.'</strong>&nbsp;'.$readCount.'<br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';
						}
					}
				}
			}
			echo $output;
			return $output;
		}
	}
	function get_history_user(){	
		$lang_code = $this->input->post('lang_code');
		if(isset($this->data['user_account'])){
			if($this->data['user_account']->gender=='male'){
				$result = $this->comman_model->query_result("SELECT distinct username,user_id,user_type,recipient_id, recipient_type FROM chat_messages where (user_id='".$this->data['user_account']->id."' and user_type='user')  ORDER BY id desc");	
			}
			else{
				$result = $this->comman_model->query_result("SELECT distinct username,user_id,user_type,recipient_id,recipient_type  FROM chat_messages where (user_id='".$this->data['user_account']->id."' and user_type='girl') or (recipient_id='".$this->data['user_account']->id."' and recipient_type='girl')  ORDER BY id desc");	
			}
			//echo $this->db->last_query();
			$output = ""; 
			if(!empty($result)){
				foreach($result as $set_data){
					if($this->data['user_account']->gender=='male'){
						$set_user= $this->comman_model->get_by('users',array('id'=>$set_data['recipient_id']),false,false,true);
						
						//count for unread msge
						$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_user->id,'user_type'=>'girl','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
						if($read_data){
							$readCount='<span style="border-radius:50px;background:red;padding:5px 9px;color:white">'.count($read_data).'</span>';
						}						
						else{
							$readCount ='';
						}

						$check_online = $this->check_online($set_user->id,'user');
						if($check_online){
							$online_image = 'assets/plugins/chat/images/online.jpg';
						}
						else{
							$online_image = 'assets/plugins/chat/images/offline.jpg';
						}

						if(!empty($set_user->image)){
							$image = 'assets/uploads/users/small/'.$set_user->image;
						}
						else{
							$image = 'assets/uploads/users/profile.jpg';
						}
						$output.='<div id="online_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_user->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_user->first_name.'</strong>&nbsp;'.$readCount.'<br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';
					}
					else if($this->data['user_account']->gender=='female'){
						if($this->data['user_account']->id!=$set_data['user_id']){						
							$set_user= $this->comman_model->get_by('users',array('id'=>$set_data['user_id']),false,false,true);
	
							//count for unread msge
							$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_user->id,'user_type'=>'user','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'girl','read'=>0),false,false,false);
							if($read_data){
								$readCount='<span style="border-radius:50px;background:red;padding:5px 9px;color:white">'.count($read_data).'</span>';
							}						
							else{
								$readCount ='';
							}
							//echo $set_user->id;						
							$check_online = $this->check_online($set_user->id,'user');
							if($check_online){
								$online_image = 'assets/plugins/chat/images/online.jpg';
							}
							else{
								$online_image = 'assets/plugins/chat/images/offline.jpg';
							}
							if(!empty($set_user->image)){
									$image = 'assets/uploads/users/small/'.$set_user->image;
							}
							else{
								$image = 'assets/uploads/users/profile.jpg';
							}
							$output.='<div id="online_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_user->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_user->first_name.'</strong>&nbsp;'.$readCount.'<br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';
						}
					}
				}
			}
			echo $output;
			return $output;
		}
	}

	function update(){
		if(isset($this->data['user_account'])){
			$check_list = $this->comman_model->get_by('user_online',array('user_id'=>$this->data['user_account']->id,'user_type'=>'user'),false,false,true); 
			if(!empty($check_list)){
				$this->comman_model->update_by('user_online',array('last_active_time'=>date('Y-m-d h:i:s',time()),'user_type'=>'user'),array('user_id'=>$this->data['user_account']->id,'user_type'=>'user'));
			}
			else{
				$this->comman_model->add('user_online',array('last_active_time'=>date('Y-m-d h:i:s',time()),'status'=>1,'user_id'=>$this->data['user_account']->id,'user_type'=>'user'));
			}			
			//echo $this->db->last_query();
		}
	}


	function get_all(){
		$msge = array();
		$msge['status'] = 'error';
		$msge['msge'] = 'hello';
		
		$lang_code = $this->input->post('lang_code');
		$search_item = $this->input->post('search_item');
		if(isset($this->data['user_account'])){
			$msge['status'] = 'ok';
			$output = ""; 		
			//show admin only client and law user
			if($this->data['user_account']->account_type=='S'){
				$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>0,'user_type'=>'admin','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
				$online_data = $this->comman_model->get_query('select * from user_online where user_id=0 and user_type="admin" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
				if(!empty($online_data)){
					$onlineImage = '<span class="badge pull-right"> </span>';
				}
				else{
					$onlineImage = '<span class="badge pull-right" style="background:#CCC"> </span>';
				}
				$admin_image = 'assets/uploads/users/profile.jpg';
				$clickUser = "chatWith('0','Admin')";
				$output.='<li><a href="javascript:void(0);" onclick="'.$clickUser.'"><img src="'.$admin_image.'" width="25" height="25" style="border-radius:50px"> Admin'.$onlineImage.'</a></li>';


				$userArr =array();
				$checkOUser = $this->comman_model->get_by('user_orders',array('store_id'=>$this->data['user_account']->id,'payment'=>1),false,false,false);
				if($checkOUser){
					foreach($checkOUser as $avg){					
						$userArr[] = $avg->user_id;
					}
				}						
				$checkOUser = $this->comman_model->get_by('users',array('parent_id'=>$this->data['user_account']->id),false,false,false);
				if($checkOUser){
					foreach($checkOUser as $avg){					
						$userArr[] = $avg->id;
					}
				}						
		
				if($userArr){
					$this->db->where_in('id',$userArr);	
					//$all_data= $this->comman_model->get_by('users',array('account_type'=>'U','confirm'=>'confirm'),false,array('first_name'=>'asc'),false);
					$all_data= $this->comman_model->get_by('users',array('confirm'=>'confirm'),false,array('first_name'=>'asc'),false);
					//echo $this->db->last_query();
					if(isset($all_data)&&!empty($all_data)){
						foreach($all_data as $set_data){
							//check online user
							$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$set_data->id.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
							if(!empty($online_data)){
								$online_image = '<span class="badge pull-right"> </span>';
							}
							else{
								$online_image = '<span class="badge pull-right" style="background:#CCC"> </span>';
							}
							if(!empty($set_data->image)){
								$image = 'assets/uploads/users/small/'.$set_data->image;
							}
							else{
								$image = 'assets/uploads/profile.jpg';
							}
							$clickUser = "chatWith('".$set_data->id."','".$set_data->first_name.' '.$set_data->last_name."')";
							$output.='<li><a href="javascript:void(0);" onclick="'.$clickUser.'"><img src="'.$image.'" width="25" height="25" style="border-radius:50px"> <strong style="color:#FFF">'.$set_data->first_name.'</strong>'.$online_image.'</a></li>';
	
						}
					}
				}//userarra
			
			}
			//employee
			if($this->data['user_account']->account_type=='E'){
				$userArr =array();
				$checkOUser = $this->comman_model->get_by('users',array('id'=>$this->data['user_account']->parent_id),false,false,false);
				if($checkOUser){
					foreach($checkOUser as $avg){					
						$userArr[] = $avg->id;
					}
				}						
		
				if($userArr){
					$this->db->where_in('id',$userArr);	
					//$all_data= $this->comman_model->get_by('users',array('account_type'=>'U','confirm'=>'confirm'),false,array('first_name'=>'asc'),false);
					$all_data= $this->comman_model->get_by('users',array('confirm'=>'confirm'),false,array('first_name'=>'asc'),false);
					//echo $this->db->last_query();
					if(isset($all_data)&&!empty($all_data)){
						foreach($all_data as $set_data){
							//check online user
							$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$set_data->id.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
							if(!empty($online_data)){
								$online_image = '<span class="badge pull-right"> </span>';
							}
							else{
								$online_image = '<span class="badge pull-right" style="background:#CCC"> </span>';
							}
							if(!empty($set_data->image)){
								$image = 'assets/uploads/users/small/'.$set_data->image;
							}
							else{
								$image = 'assets/uploads/profile.jpg';
							}
							$clickUser = "chatWith('".$set_data->id."','".$set_data->first_name.' '.$set_data->last_name."')";
							$output.='<li><a href="javascript:void(0);" onclick="'.$clickUser.'"><img src="'.$image.'" width="25" height="25" style="border-radius:50px"> <strong style="color:#FFF">'.$set_data->first_name.'</strong>'.$online_image.'</a></li>';
	
						}
					}
				}//userarra
			
			}			
			/*end of admin*/			
			
			//show employee and client to law user 
			
			//show law to client  
			if($this->data['user_account']->account_type=='U'){
				$userArr =array();
				$checkOUser = $this->comman_model->get_by('user_orders',array('user_id'=>$this->data['user_account']->id,'payment'=>1),false,false,false);
				if($checkOUser){
					foreach($checkOUser as $avg){					
						$userArr[] = $avg->store_id;
					}
				}						
		
				if($userArr){
					$this->db->where_in('id',$userArr);	
					$all_data= $this->comman_model->get_by('users',array('account_type'=>'S','confirm'=>'confirm'),false,array('first_name'=>'asc'),false);
					//echo $this->db->last_query();
					if(isset($all_data)&&!empty($all_data)){
						foreach($all_data as $set_data){
							//check online user
							$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$set_data->id.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
							if(!empty($online_data)){
								$online_image = '<span class="badge pull-right"> </span>';
							}
							else{
								$online_image = '<span class="badge pull-right" style="background:#CCC"> </span>';
							}
							if(!empty($set_data->image)){
								$image = 'assets/uploads/users/small/'.$set_data->image;
							}
							else{
								$image = 'assets/uploads/profile.jpg';
							}
							$clickUser = "chatWith('".$set_data->id."','".$set_data->first_name.' '.$set_data->last_name."')";
							$output.='<li><a href="javascript:void(0);" onclick="'.$clickUser.'"><img src="'.$image.'" width="25" height="25" style="border-radius:50px"> <strong style="color:#FFF">'.$set_data->first_name.'</strong>'.$online_image.'</a></li>';
	
						}
					}
				}//userarra
			}
			$msge['msge'] = $output;
		}
	    echo json_encode($msge);
	}
	
	function get_all_list(){

		$lang_code = $this->input->post('lang_code');
		if(isset($this->data['user_account'])){
			$output = ""; 
		
			//show admin only client and law user
			if($this->data['user_account']->account_type!='E'){
				$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>0,'user_type'=>'admin','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
				$online_data = $this->comman_model->get_query('select * from user_online where user_id=0 and user_type="admin" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
				if(!empty($online_data)){
					$onlineImage = 'assets/plugins/chat/images/online.jpg';
				}
				else{
					$onlineImage = 'assets/plugins/chat/images/offline.jpg';
				}
				$admin_image = 'assets/uploads/users/profile.jpg';
				if(!empty($read_data)){
					$readCount ='<span style="border-radius:50px !important;background:red;padding:5px 9px;color:white">'.count($read_data).'</span>';
				}
				else{
					$readCount ='';
				}
				$output.='<div id="all_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/admin"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$admin_image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>Admin</strong>&nbsp;'.$readCount.'<br><br><img src="'.$onlineImage.'"></td></tr></tbody></table></a></div>';					

			}			
			/*end of admin*/			
			
			//show employee and client to law user 
			if($this->data['user_account']->account_type=='L'){
				$lawUser = $this->comman_model->get_by('user_client',array('owner_id'=>$this->data['user_account']->id),false,false,false);
				$product_arr = array();
				if($lawUser){
					foreach($lawUser as $set_pro){
						$product_arr[] =$set_pro->user_id;
					}
				}
				if($product_arr){
					$this->db->where_in('id',$product_arr);
					$all_data= $this->comman_model->get_by('users',array('enabled'=>1,'id !='=>$this->data['user_account']->id),false,array('first_name'=>'asc','last_name'=>'asc'),false);
				}
				if(isset($all_data)&&!empty($all_data)){
					foreach($all_data as $set_data){
						//check online user
						$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$set_data->id.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
						$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_data->id,'user_type'=>'user','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
						if(count($read_data)!=0){
							if(!empty($online_data)){
								$online_image = 'assets/plugins/chat/images/online.jpg';
							}
							else{
								$online_image = 'assets/plugins/chat/images/offline.jpg';
							}
							if(!empty($set_data->image)){
								$image = 'assets/uploads/users/small/'.$set_data->image;
							}
							else{
								$image = 'assets/uploads/profile.jpg';
							}
							$output.='<div id="all_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_data->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_data->first_name.'</strong>&nbsp;<span style="border-radius:50px !important;background:red;padding:5px 9px;color:white">'.count($read_data).'</span><br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';					
						}
					}
					foreach($all_data as $set_data){
						//for receiver msge
						$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$set_data->id.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
						$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_data->id,'user_type'=>'user','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
						//echo $this->db->last_query();
						if(count($read_data)==0){
							if(!empty($online_data)){
								$online_image = 'assets/plugins/chat/images/online.jpg';
							}
							else{
								$online_image = 'assets/plugins/chat/images/offline.jpg';
							}
							if(!empty($set_data->image)){
								$image = 'assets/uploads/users/small/'.$set_data->image;
							}
							else{
								$image = 'assets/uploads/profile.jpg';
							}
							$output.='<div id="all_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_data->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_data->first_name.'</strong><br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';					
						}
					}
					
				}			
			}
			
			//show law to client  
			if($this->data['user_account']->account_type=='E'||$this->data['user_account']->account_type=='U'){
				$lawUser = $this->comman_model->get_by('user_client',array('user_id'=>$this->data['user_account']->id),false,false,false);
				$product_arr = array();
				if($lawUser){
					foreach($lawUser as $set_pro){
						$product_arr[] =$set_pro->owner_id;
					}
				}
				if($product_arr){
					$this->db->where_in('id',$product_arr);
					$all_data= $this->comman_model->get_by('users',array('enabled'=>1,'id !='=>$this->data['user_account']->id),false,array('first_name'=>'asc','last_name'=>'asc'),false);
				}
				if(isset($all_data)&&!empty($all_data)){
					foreach($all_data as $set_data){
						//check online user
						$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$set_data->id.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
						$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_data->id,'user_type'=>'user','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
						if(count($read_data)!=0){
							if(!empty($online_data)){
								$online_image = 'assets/plugins/chat/images/online.jpg';
							}
							else{
								$online_image = 'assets/plugins/chat/images/offline.jpg';
							}
							if(!empty($set_data->image)){
								$image = 'assets/uploads/users/small/'.$set_data->image;
							}
							else{
								$image = 'assets/uploads/profile.jpg';
							}
							$output.='<div id="all_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_data->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_data->first_name.'</strong>&nbsp;<span style="border-radius:50px !important;background:red;padding:5px 9px;color:white">'.count($read_data).'</span><br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';					
						}
						
						//for receiver msge
						$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_data->id,'user_type'=>'user','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
						//echo $this->db->last_query();
						if(count($read_data)==0){
							if(!empty($online_data)){
								$online_image = 'assets/plugins/chat/images/online.jpg';
							}
							else{
								$online_image = 'assets/plugins/chat/images/offline.jpg';
							}
							if(!empty($set_data->image)){
								$image = 'assets/uploads/users/small/'.$set_data->image;
							}
							else{
								$image = 'assets/uploads/profile.jpg';
							}
							$output.='<div id="all_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_data->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_data->first_name.'</strong><br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';					
						}
					}
					
				}
			}

			echo $output;
			return $output;
		}
	}

	function get_all_list1(){
		$lang_code = $this->input->post('lang_code');
		if(isset($this->data['user_account'])){
			$output = ""; 
			//admin 
			$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>0,'user_type'=>'admin','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
			$online_data = $this->comman_model->get_query('select * from user_online where user_id=0 and user_type="admin" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
			if(!empty($online_data)){
				$onlineImage = 'assets/plugins/chat/images/online.jpg';
			}
			else{
				$onlineImage = 'assets/plugins/chat/images/offline.jpg';
			}
			$admin_image = 'assets/uploads/users/profile.jpg';
			if(!empty($read_data)){
				$readCount ='<span style="border-radius:50px !important;background:red;padding:5px 9px;color:white">'.count($read_data).'</span>';
			}
			else{
				$readCount ='';
			}
			$output.='<div id="all_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/admin"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$admin_image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>Admin</strong>&nbsp;'.$readCount.'<br><br><img src="'.$onlineImage.'"></td></tr></tbody></table></a></div>';					
			
			/*end of admin*/			
			$all_data= $this->comman_model->get_by('users',array('enabled'=>1,'id !='=>$this->data['user_account']->id),false,array('first_name'=>'asc','last_name'=>'asc'),false);
			foreach($all_data as $set_data){
				$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_data->id,'user_type'=>'user','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
				if(count($read_data)!=0){
					$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$set_data->id.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
					//$online_data = $this->comman_model->get_by('user_online',array('user_id'=>$set_data->id,'last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time())),'user_type'=>'girl'),false,false,true);
					if(!empty($online_data)){
						$online_image = 'assets/plugins/chat/images/online.jpg';
					}
					else{
						$online_image = 'assets/plugins/chat/images/offline.jpg';
					}
					if(!empty($set_data->image)){
						$image = 'assets/uploads/users/small/'.$set_data->image;
					}
					else{
						$image = 'assets/uploads/profile.jpg';
					}
					$output.='<div id="all_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_data->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_data->first_name.'</strong>&nbsp;<span style="border-radius:50px !important;background:red;padding:5px 9px;color:white">'.count($read_data).'</span><br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';					
				}
			}

			foreach($all_data as $set_data){
				$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$set_data->id.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'")');
				//$online_data = $this->comman_model->get_query('select * from user_online where user_id='.$set_data->id.' and user_type="user" and( last_active_time >"'.date("Y-m-d h:i:s", strtotime('-7 second', time())).'" or status=1)');
				//echo $this->db->last_query();
				$read_data = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_data->id,'user_type'=>'user','recipient_id'=>$this->data['user_account']->id,'recipient_type'=>'user','read'=>0),false,false,false);
				if(count($read_data)==0){
					if(!empty($online_data)){
						$online_image = 'assets/plugins/chat/images/online.jpg';
					}
					else{
						$online_image = 'assets/plugins/chat/images/offline.jpg';
					}
					if(!empty($set_data->image)){
						$image = 'assets/uploads/users/small/'.$set_data->image;
					}
					else{
						$image = 'assets/uploads/profile.jpg';
					}
					$output.='<div id="all_user_data" class="chat_icon"><a href="'.$lang_code.'/user/chat/'.$set_data->id.'"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr><td align="right" valign="top" width="65"><img src="'.$image.'" width="50" height="50" style="border-radius:50px"></td><td width="7"></td><td valign="top"><strong>'.$set_data->first_name.'</strong><br><br><img src="'.$online_image.'"></td></tr></tbody></table></a></div>';					
				}
			}
			echo $output;
			return $output;
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */