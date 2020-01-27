<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guest_chat extends CI_Controller {
	public $_subView = 'templates/';
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form','language'));
		$this->load->helper(array('url','date','form','cms'));	
		$this->load->library(array('form_validation','session'));
		$this->load->model(array('comman_model','settings_model'));
        $detail = $this->session->all_userdata();
		if(isset($detail['chat_session'])){
			$this->data['user_chat'] = $detail['chat_session'];
		}	
        $this->data['settings'] = $this->settings_model->get_fields();
	}


	


	public function index(){
		if(!isset($this->data['user_chat']))
			redirect($this->data['lang_code'].'/chat/contact');
			
		$this->data['title'] = "".$this->data['settings']['site_name'];
		$this->data['active'] = 'home';
		$this->data['search'] ='';
		$this->load->view('templates/chat',$this->data);
	}

	public function logout(){
		$msge = array();
		$msge['status']= 'ok';
		$this->session->unset_userdata('chat_session');
		json_encode($msge);
	}
	public function chat_login(){
		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= 'error';
		if($this->input->post('operation')){
			$post_data = array(
							'last_active_time'=>date('Y-m-d h:i:s',time()),
							'status'=>0,
							'user_name'=>$this->input->post('name'),
/*							'email'=>$this->input->post('email'),*/
							'user_type'=>'user');
			
			$id = $this->comman_model->save('public_user',$post_data);
			$session_data = array(
					'name' =>$this->input->post('name'),
/*					'email' =>$this->input->post('email'),*/
					'id' =>$id);				
			$this->session->set_userdata('chat_session',$session_data);					
			$msge['result']= 'success';
			$msge['msg']= 'open';
			$this->send_mail($id);
		}
		echo json_encode($msge);
	}

	function views($id = false){	
		$detail = $this->session->all_userdata();
		if(isset($detail['chat_session'])){
			$user_chat = $detail['chat_session'];
			$this->db->where('`to` ='.$user_chat['id'].' or `from` ='.$user_chat['id']);
			$new_data = $this->comman_model->get('public_chat',false);
			//echo $this->db->last_query();die;
			foreach($new_data as $row){
				$time = date("Y-m-d",strtotime($row->sent));
				$now = date("Y-m-d");
				if ($time == $now) {
					$hourAndMinutes = date("h:i A", strtotime($row->sent));
				}else{
					$hourAndMinutes = date("Y-m-d", strtotime($row->sent));
				}
				if($row->from!=$user_chat['id']){
					$image = 'assets/uploads/profile.jpg';
					echo '<div class="row msg_container base_receive">
							<div class="col-md-2 col-xs-2 avatar" style="padding:0px">
								<img src="'.$image.'" class=" img-responsive ">
							</div>
							<div class="col-md-10 col-xs-10">
								<div class="messages msg_receive">
									<p>'.$row->message.'</p>
									<time datetime="2009-11-13T20:00">'.$row->from_name.' • '.$hourAndMinutes.'</time>
								</div>
							</div>
						</div>';
				}
				else{
					$image = 'assets/uploads/profile.jpg';
					echo'<div class="row msg_container base_sent">
							<div class="col-md-10 col-xs-10"><div class="messages msg_sent">'.$row->message.'</p>
								<time datetime="2009-11-13T20:00">'.$row->from_name.' •'.$hourAndMinutes.'</time></div></div>
							<div class="col-md-2 col-xs-2 avatar" style="padding:0px">
								<img src="'.$image.'" class=" img-responsive ">
							</div>
						</div>';
				}
			}
		}
	}

	function send_chat(){
		if(isset($this->data['user_chat'])){
			$post_data = array(
							'`from`'=>$this->data['user_chat']['id'],
							'`from_name`'=>$this->data['user_chat']['name'],
							'`to`'=>0,
							'`to_name`'=>'admin',
							'`sent`'=>date("Y-m-d h:i:s", time()),
							'`message`'=>$this->input->post('message'),
						);
			//print_r($post_data);			
			$this->comman_model->save('public_chat',$post_data);
		}
	}

	function get_online(){
		$show_status= 'off';
		$result = $this->comman_model->get_by('public_user',array('user_type'=>'admin','last_active_time >'=>date("Y-m-d h:i:s", strtotime('-7 second', time()))),false,false,false);
		
		if($result){
			$show_status ='on';
		}		
		echo $show_status;
	}

	function send_mail($id	= false){
		if(!$id)
			return false;
	
		$checkUser = $this->comman_model->get_by('public_user',array('id'=>$id),false,false,true);
		if(!$checkUser){
			return false;
		}
		$html = '<h3>Dear admin,</h3><p>'.$checkUser->user_name.' has in public chat <a href="'.base_url($this->data['settings']['admin_link'].'/public_chat').'">Click Here</a>.</p>';

		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);
		$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
		$this->email->to($this->data['settings']['site_email']);
		$this->email->subject('Public Chat');
		$this->email->message($html);
		if($this->email->send()){
			return true;
		}
		else{
			return false;
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */