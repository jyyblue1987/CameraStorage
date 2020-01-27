<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_safari extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date'));	
		$this->load->library(array('form_validation','session'));
		$this->load->model(array('comman_model'));
	}
	

	function safari(){
		$this->data['title'] = 'sdf';
		$this->load->view('test/iframe_safari',$this->data);
		//$this->load->view('test/test1',$this->data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */