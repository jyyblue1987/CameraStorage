<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_chat extends Admin_Controller{
	public $_table_names = 'chat_messages';
	public $_subView = 'admin/public_chat/';
	public $_redirect = 'admin/public_chat';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'chat';
	}
    
    public function index()
	{
	    @session_start();
		if( !isset( $_SESSION['chatusername'] )  || !isset( $_SESSION['username'] )  ){
			$_SESSION['chatusername'] = 'Admin';				
			$_SESSION['username'] = '0';			
		}
		$this->load->library('user_chats');
	}

	function read_message(){		
		$msge['result']= 'error';
		$read_data = $this->comman_model->get_by('chat_messages',array('recipient_id'=>0,'recipient_type'=>'admin','read'=>0),false,false,false);
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

    public function user($id =false){
		if(!$id){
			redirect($this->_redirect);
		}
	    // Fetch all pages
		$this->data['title'] = 'Guest Chat | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Guest Chat';
		$this->data['user_chat_data'] = $this->comman_model->get_by('user_online',array('id'=>$id),false,false,true);
		if(!$this->data['user_chat_data']){
			redirect($this->_redirect);
		}
		
		$this->comman_model->update_by('chat_messages',array('read'=>1),array('user_id'=>$id));
        $this->data['subview'] = $this->_subView.'edit';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function get_all(){
		$msge = array();
		$msge['status'] = 'error';
		$msge['msge'] = 'hello';
		
		$search_item = $this->input->post('search_item');
		$msge['status'] = 'ok';
		$output = ""; 		


		$all_data = $this->comman_model->get_by('users',array('confirm'=>'confirm','parent_id'=>0),false,array('first_name'=>'asc','last_name'=>'asc'),false);
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

		$msge['msge'] = $output;
	    echo json_encode($msge);
	}




	function get_all_list(){
		$output = ""; 
		$this->db->group_by('user_id');
		$this->db->order_by('id','desc');
		$all_unread = $this->comman_model->get_by('chat_messages',array('read'=>0,'user_id !='=>0),false,false,false);
		foreach($all_unread as $set_data){
			$user_data = $this->comman_model->get_by('user_online',array('id'=>$set_data->user_id,'user_type !='=>'admin'),false,false,true);
			$unread = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_data->user_id,'read'=>0),false,false,false);
			if(count($unread)){
				$total_count = '&nbsp;&nbsp;<span style="background-color: #0f0;border-radius: 24px !important;padding: 5px 10px;">'.count($unread).'</span>';
			}
			else{
				$total_count = '';
			}
			//$online_data = $this->comman_model->get_by('user_online',array('user_id'=>$set_data->id,'last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time()))),false,false,true);
/*				if(!empty($online_data)){
				$online_image = 'assets/plugins/chat/images/online.jpg';
			}
			else{
				$online_image = 'assets/plugins/chat/images/offline.jpg';
			}*/
			$image = 'assets/uploads/profile.jpg';
			$output.='<div id="all_user_data" class="chat_icon"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr>
				<td align="right" valign="top" width="50" rowspan="2"><a href="admin/public_chat/user/'.$user_data->id.'" >
				<img src="'.$image.'" width="50" height="50" style="border-radius:50px"></a></td><td valign="top"> <a href="admin/public_chat/user/'.$user_data->id.'" ><strong>'.$user_data->user_name.'</strong></a></td></tr><tr><td>'.$total_count.'</td></tr></tbody></table></div>';
		}
		
		$this->db->group_by('user_id');
		$this->db->order_by('id','desc');
		$all_unread = $this->comman_model->get_by('chat_messages',array('read'=>1,'user_id !='=>0),false,false,false);
		foreach($all_unread as $set_data){
			$user_data = $this->comman_model->get_by('user_online',array('id'=>$set_data->user_id,'user_type !='=>'admin'),false,false,true);
			$unread = $this->comman_model->get_by('chat_messages',array('user_id'=>$set_data->user_id,'read'=>0),false,false,false);
			if(count($unread)){
				$total_count = '&nbsp;&nbsp;<span style="background-color: #0f0;border-radius: 24px !important;padding: 5px 10px;">'.count($unread).'</span>';
			}
			else{
				$total_count = '';
			}
			//$online_data = $this->comman_model->get_by('user_online',array('user_id'=>$set_data->id,'last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time()))),false,false,true);
/*				if(!empty($online_data)){
				$online_image = 'assets/plugins/chat/images/online.jpg';
			}
			else{
				$online_image = 'assets/plugins/chat/images/offline.jpg';
			}*/
			$image = 'assets/uploads/profile.jpg';
			$output.='<div id="all_user_data" class="chat_icon"><table class="table1" cellpadding="0" cellspacing="0"><tbody><tr>
				<td align="right" valign="top" width="50" rowspan="2"><a href="admin/public_chat/user/'.$user_data->id.'" >
				<img src="'.$image.'" width="50" height="50" style="border-radius:50px"></a></td><td valign="top"> <a href="admin/public_chat/user/'.$user_data->id.'" ><strong>'.$user_data->user_name.'</strong></a></td></tr><tr><td>'.$total_count.'</td></tr></tbody></table></div>';
		}
		echo $output;
		return $output;
	}
	

	function views($id = false){	
		$viewList ='<ul class="ad-chats">';
		$this->data['login'] = $this->session->all_userdata();
		//$new_data = $this->comman_model->query_result("SELECT * FROM chat_messages where (user_id='".$this->data['user_details']->id."' and user_type='girl' and recipient_id='".$id."' and recipient_type ='users') OR (user_id='".$id."' and recipient_id='".$this->data['user_details']->id."' and recipient_type ='girl' and user_type='users' ) ORDER BY message_time");

		$this->db->where('user_id ='.$id.' or recipient_id ='.$id);
		$new_data = $this->comman_model->get('chat_messages',false);
		foreach($new_data as $row){
			$time = date("Y-m-d",strtotime($row->message_time));
			$now = date("Y-m-d");
			if ($time == $now) {
				$hourAndMinutes = date("h:i A", strtotime($row->message_time));
			}else{
				$hourAndMinutes = date("Y-m-d", strtotime($row->message_time));
			}
			if($row->user_id!=0){
				$image = 'assets/uploads/profile.jpg';

				$str = $row->message_content;	
				$viewList .= '<li class="in">
									<img src="'.$image.'" alt="" class="avatar">
									<div class="message">
										<span class="arrow">
										</span>
										<a class="name">'.$row->username.'</a>
										<span class="datetime" style="color:#ccc">
										at '.$hourAndMinutes.'</span>
										<span class="body">'.$str.'</span>
									</div>
								</li>';
			}
			else{
				$image = 'assets/uploads/profile.jpg';
				$str = $row->message_content;	
				$viewList .='<li class="out">
								<img src="'.$image.'" alt="" class="avatar">
								<div class="message">
									<span class="arrow">
									</span>
									<a class="name">Admin</a>
									<span class="datetime" style="color:#ccc"> at '.$hourAndMinutes.'</span>
									<span class="body">'.$str.'</span>
								</div>
								</li>';
			}		
		}
		$viewList .='</ul>';
		echo $viewList;
	}

	function send_chat(){
		$post_data = array(
						'recipient_id'=>$this->input->post('user_id'),
						'recipient'=>$this->input->post('user_name'),
						'recipient_type'=>'user',
						'user_id'=>0,
						'username'=>'admin',
						'user_type'=>'admin',
						'message_content'=>$this->input->post('message'),
					);
		//print_r($post_data);			
		$this->comman_model->save('chat_messages',$post_data);
	}

	function online_update(){
		$this->data['login'] = $this->session->all_userdata();
		if($this->data['admin_details']->id){
			$check_list = $this->comman_model->get_by('user_online',array('user_type'=>'admin'),false,false,true); 
			if(!empty($check_list)){
				$this->comman_model->update_by('user_online',array('user_name'=>'admin','email'=>'admin','last_active_time'=>date('Y-m-d h:i:s',time()),'created'=>time()),array('user_type'=>'admin'));
			}
			else{
				$this->comman_model->save('user_online',array('last_active_time'=>date('Y-m-d h:i:s',time()),'status'=>0,'user_type'=>'admin'));
			}			
		}
		//echo $this->db->last_query();
	}



}