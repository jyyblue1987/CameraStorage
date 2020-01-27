<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offline extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date'));	
		$this->load->library(array('session'));
		$this->load->model(array('comman_model','language_model','settings_model'));
		$this->data['set_meta'] = '';	
        $this->data['settings'] = $this->settings_model->get_fields();

        $detail = $this->session->all_userdata();
		if(isset($detail['user_session'])){
			$this->data['user_session'] = $detail['user_session'];
			if(isset($detail['user_session']['loginType'])){
				if($detail['user_session']['loginType']=='user'){
		            $this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
				}
				if($detail['user_session']['loginType']=='reseller'){
		            $this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
				}
			}
        }
        $this->data['settings'] = $this->settings_model->get_fields();

	}
	
	function index(){
		//$this->visitor();
		$this->data['set_meta'] = 'home';
		$this->data['active'] = 'home';
		$this->data['slider'] = 'home';
	//$this->data['subview'] = $this->_subView.'index';	
		$this->data['title'] = $this->data['settings']['site_name'];
		$this->load->view('templates/offline',$this->data);
	}	

}
