<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Public_chat extends Admin_Controller{
	public $_table_names = 'public_chat';
	public $_subView = 'admin/public_chat/';
	public $_redirect = '/public_chat';
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('smiley'));
		$this->load->library(array('table'));
		$image_array = get_clickable_smileys(base_url().'assets/plugins/chat/images/smileys/', 'textb');
		$col_array = $this->table->make_columns($image_array, 8);
		$this->data['smiley_table'] = $this->table->generate($col_array);				
		$this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
		$this->data['active'] = 'chat';
		$this->checkPermissions('public_chat');

	}
    
    public function index()
	{
	    // Fetch all pages
		$this->data['title'] = 'Chat | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Chat';
		$this->data['all_data'] = $this->comman_model->get('public_user',false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function read_message(){		
		$msge['result']= 'error';
		$read_data = $this->comman_model->get_by('public_chat',array('to'=>0,'recipient_type'=>'admin','read'=>0),false,false,false);
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
		$this->data['user_chat_data'] = $this->comman_model->get_by('public_user',array('id'=>$id),false,false,true);
		if(!$this->data['user_chat_data']){
			redirect($this->_redirect);
		}
		
		$this->comman_model->update_by('public_chat',array('read'=>1),array('from'=>$id));
        $this->data['subview'] = $this->_subView.'view';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function get_all(){
		$msge = array();
		$msge['status'] = 'error';
		$msge['msge'] = 'hello';
		
		$search_item = $this->input->post('search_item');
		$msge['status'] = 'ok';
		$output = ""; 		


		$this->db->group_by('`from`');
		$this->db->order_by('id','desc');
		$all_unread = $this->comman_model->get_by('public_chat',array('recd'=>0,'`from` !='=>0),false,false,false);
		foreach($all_unread as $set_data){
			if($search_item){
				$this->db->like('user_name',$search_item,'after');
			}
			$user_data = $this->comman_model->get_by('public_user',array('id'=>$set_data->to,'user_type !='=>'admin'),false,false,true);
			if($user_data){
				$image = 'assets/uploads/profile.jpg';
				$clickUser = "chatWith('".$user_data->id."','".$user_data->user_name."')";
				$output.='<li><a href="javascript:void(0);" onclick="'.$clickUser.'"><img src="'.$image.'" width="25" height="25" style="border-radius:50px"> <strong style="color:#FFF">'.$set_data->first_name.'</strong></a></li>';
			}
		}
		
		$this->db->group_by('`from`');
		$this->db->order_by('id','desc');
		$all_unread = $this->comman_model->get_by('public_chat',array('recd'=>1,'`from` !='=>0),false,false,false);
		foreach($all_unread as $set_data){
			if($search_item){
				$this->db->like('user_name',$search_item,'after');
			}
			$user_data = $this->comman_model->get_by('public_user',array('id'=>$set_data->from,'user_type !='=>'admin'),false,false,true);
			if($user_data){
				$image = 'assets/uploads/profile.jpg';
				$clickUser = "chatWith('".$user_data->id."','".$user_data->user_name."')";
				$output.='<li><a href="javascript:void(0);" onclick="'.$clickUser.'"><img src="'.$image.'" width="25" height="25" style="border-radius:50px"> <strong style="color:#FFF">'.$user_data->user_name.'</strong></a></li>';
			}
		}

		$msge['msge'] = $output;
	    echo json_encode($msge);
	}




	function views($id = false){	
		$viewList ='';
		$this->data['login'] = $this->session->all_userdata();
		//$new_data = $this->comman_model->query_result("SELECT * FROM public_chat where (from='".$this->data['user_details']->id."' and user_type='girl' and to='".$id."' and recipient_type ='users') OR (from='".$id."' and to='".$this->data['user_details']->id."' and recipient_type ='girl' and user_type='users' ) ORDER BY message_time");

		$this->db->where('from ='.$id.' or `to` ='.$id);
		$new_data = $this->comman_model->get('public_chat',false);
		foreach($new_data as $row){
			$time = date("Y-m-d",strtotime($row->message_time));
			$now = date("Y-m-d");
			if ($time == $now) {
				$hourAndMinutes = date("h:i A", strtotime($row->message_time));
			}else{
				$hourAndMinutes = date("Y-m-d", strtotime($row->message_time));
			}
			if($row->from!=0){
				$image = 'assets/uploads/profile.jpg';

				$str = $row->message;	
				$viewList .= '<div class="media msg">
                    <a class="pull-left" href="#">
                        <img class="media-object"  style="width: 32px; height: 32px;" src="'.$image.'">
                    </a>
                    <div class="media-body">
                        <small class="pull-right time"><i class="fa fa-clock-o"></i>'.$hourAndMinutes.'</small>

                        <h5 class="media-heading">'.$row->from_name.'</h5>
                        <small class="col-lg-10">'.$str.'</small>
                    </div>
                </div>';
			}
			else{
				$image = 'assets/uploads/profile.jpg';
				$str = $row->message;	
				$viewList .='<div class="media msg">
                    <a class="pull-left" href="#">
                        <img class="media-object"  style="width: 32px; height: 32px;" src="'.$image.'">
                    </a>
                    <div class="media-body">
                        <small class="pull-right time"><i class="fa fa-clock-o"></i> '.$hourAndMinutes.'</small>

                        <h5 class="media-heading">Admin</h5>
                        <small class="col-lg-10">'.$str.'</small>
                    </div>
                </div>';
			}		
		}
		$viewList .='';
		echo $viewList;
	}

	function send_chat(){
		$post_data = array(
						'to'=>$this->input->post('user_id'),
						'to_name'=>$this->input->post('user_name'),
						'recipient_type'=>'user',
						'from'=>0,
						'from_name'=>'admin',
						'user_type'=>'admin',
						'sent'=>date("Y-m-d h:i:s"),
						'message'=>$this->input->post('message'),
					);
		//print_r($post_data);			
		$this->comman_model->save('public_chat',$post_data);
	}

	function online_update(){
		$this->data['login'] = $this->session->all_userdata();
		if($this->data['admin_details']->id){
			$check_list = $this->comman_model->get_by('public_user',array('user_type'=>'admin'),false,false,true); 
			if(!empty($check_list)){
				$this->comman_model->update_by('public_user',array('user_name'=>'admin','email'=>'admin','last_active_time'=>date('Y-m-d h:i:s',time()),'created'=>time()),array('user_type'=>'admin'));
			}
			else{
				$this->comman_model->save('public_user',array('last_active_time'=>date('Y-m-d h:i:s',time()),'status'=>0,'user_type'=>'admin'));
			}			
		}
		//echo $this->db->last_query();
	}

	function unread(){
		$output = array(); 
		$output['status'] = 'error';
		$this->db->group_by('from');
		$this->db->order_by('id','desc');
		$selectUser = array();
		$all_unread = $this->comman_model->get_by('public_chat',array('read'=>0,'from !='=>0),false,false,false);
		//echo $this->db->last_query();
		if($all_unread){
			$output['status'] = 'ok';
			$output['count'] = count($all_unread);
		}
		echo json_encode($output);
	}

	function get_all_list(){	
		$output = ""; 
		$this->db->group_by('from');
		$this->db->order_by('id','desc');
		$selectUser = array();
		$all_unread = $this->comman_model->get_by('public_chat',array('read'=>0,'from !='=>0),false,false,false);
		//echo $this->db->last_query();
		foreach($all_unread as $set_data){
			$user_data = $this->comman_model->get_by('public_user',array('id'=>$set_data->from,'user_type !='=>'admin'),false,false,true);
			$unread = $this->comman_model->get_by('public_chat',array('from'=>$set_data->from,'read'=>0),false,false,false);
			$selectUser[] = $set_data->from;

			if(count($unread)){
				$total_count = '&nbsp;&nbsp;<span style="background-color: #0f0;border-radius: 24px !important;padding: 1px 6px">'.count($unread).'</span>';
			}
			else{
				$total_count = '';
			}
			//$online_data = $this->comman_model->get_by('public_user',array('from'=>$set_data->id,'last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time()))),false,false,true);
/*				if(!empty($online_data)){
				$online_image = 'assets/plugins/chat/images/online.jpg';
			}
			else{
				$online_image = 'assets/plugins/chat/images/offline.jpg';
			}*/
			$image = 'assets/uploads/profile.jpg';
			$output.='<a href="'.$this->data['_cancel'].'/user/'.$user_data->id.'"><div class="media conversation">
                <div class="pull-left" >
                    <img class="media-object"" style="width: 50px; height: 50px;" src="'.$image.'">
                </div>
                <div class="media-body">
                    <h5 class="media-heading">'.$user_data->user_name.'</h5>
                    <small>'.$total_count.'</small>
                </div>
            </div></a>';
		}
		
		$this->db->group_by('from');
		$this->db->order_by('id','desc');
		if($selectUser){
			$this->db->where_not_in('from', $selectUser);
		}
		$all_unread = $this->comman_model->get_by('public_chat',array('read'=>1,'from !='=>0),false,false,false);
		//echo $this->db->last_query();
		foreach($all_unread as $set_data){
			$user_data = $this->comman_model->get_by('public_user',array('id'=>$set_data->from,'user_type !='=>'admin'),false,false,true);
			$unread = $this->comman_model->get_by('public_chat',array('from'=>$set_data->from,'read'=>0),false,false,false);
			if(count($unread)){
				$total_count = '&nbsp;&nbsp;<span style="background-color: #0f0;border-radius: 24px !important;padding: 1px 6px;">'.count($unread).'</span>';
			}
			else{
				$total_count = '';
			}
			//$online_data = $this->comman_model->get_by('public_user',array('from'=>$set_data->id,'last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time()))),false,false,true);
/*				if(!empty($online_data)){
				$online_image = 'assets/plugins/chat/images/online.jpg';
			}
			else{
				$online_image = 'assets/plugins/chat/images/offline.jpg';
			}*/
			$image = 'assets/uploads/profile.jpg';
			$output.='<a href="'.$this->data['_cancel'].'/user/'.$user_data->id.'"><div class="media conversation">
                <div class="pull-left" >
                    <img class="media-object"" style="width: 50px; height: 50px;" src="'.$image.'">
                </div>
                <div class="media-body">
                    <h5 class="media-heading">'.$user_data->user_name.'</h5>
                    <small>'.$total_count.'</small>
                </div>
            </div></a>';
		}
		echo $output;
		return $output;
	}


  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			$redirect = checkPermission('admin_permission',array('user_id'=>$this->data['admin_details']->id,'type'=>$type,'value'=>1));	
		}
		else{
			$redirect = 1;
		}
		
		if($redirect==0){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			if($redirect){
				redirect($redirect);
			}
			redirect($this->data['admin_link'].'');
		}		
	}
}