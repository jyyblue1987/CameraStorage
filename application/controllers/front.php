<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends Frontend_Controller {
	public $_subView = 'templates/';
	public function __construct(){
		parent::__construct();
		$this->load->helper('cookie');
/*		$logged_in = $this->session->userdata('user_session');
		if((isset($logged_in['loggedin']) || $logged_in['loggedin'] == true)){
			if($logged_in['loginType']=='user'){
				$detail = $this->session->all_userdata();
				$this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
			}
		}*/
	}


	
	function visitor(){
		$ip_address = $this->input->ip_address();
		$time = time();
		$check = $this->comman_model->get_by('visitor_activity',array('ip_address'=>$ip_address,'visit_date >='=>strtotime(date('d-m-Y 00:00:00',time())),'visit_date <='=>strtotime(date('d-m-Y 23:59:59',time()))),false,false,false);
		//echo $this->db->last_query();
		if(!count($check)){
			$this->comman_model->save('visitor_activity',array('visit_date'=>$time,'ip_address'=>$ip_address));
		}
		//var_dump($check);
	}


	public function index($id = false){
		//$this->visitor();
		$this->data['set_meta'] = 'home';
		$this->data['active'] = 'home';
		$this->data['slider'] = 'home';
		$this->data['search_home'] = true;
        //$this->data['subview'] = $this->_subView.'index';	
		$checkCookies = get_cookie('rember_me');
		$this->data['c_email'] = '';
		$this->data['c_pass'] = '';
		if(isset($checkCookies)&&!empty($checkCookies)){
			$c_login = $this->comman_model->get_by('users',array('email'=>$checkCookies),false,false,TRUE);
			if($c_login){
				$this->data['c_email'] = $c_login->email;
				$this->data['c_pass'] = $c_login->password;
			}
			
		}

		$this->data['title'] = $this->data['settings']['site_name'];
		$this->data['page'] = $this->pages_model->get_first();
		$this->load->view($this->_subView.'index',$this->data);
	}

	function active(){
		$this->data['title'] = $this->data['settings']['site_name'];
		$this->load->view($this->_subView.'active',$this->data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */