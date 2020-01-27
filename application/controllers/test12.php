<?php 
class Test12 extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date'));	
		$this->load->library(array('form_validation','session'));
		$this->load->helper('cookie');
		$this->load->model(array('comman_model'));
	}
	
	function hello(){
		echo 'Hello World!!';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */