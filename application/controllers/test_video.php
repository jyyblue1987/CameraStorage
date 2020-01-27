<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_video extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date'));	
		$this->load->library(array('form_validation','session'));
		$this->load->model(array('comman_model'));
	}
	
	function audio(){
//		mkdir('./data/test_audio_file/', 0755, true);
		
		exec('ffmpeg -rtsp_transport tcp -i  "rtsp://demo.itechproducts.info:9095/video1.sdp" -c:a aac -c:v copy -hls_time 2  "data/test_audio_file/capture.m3u8" 2>&1',$error,$return);
		echo '<pre>';
		print_r($error);
	}
	
	function IE1($id=false){
		$this->data['title'] = 'sdf';
		if($id==1){
			$this->load->view('test/test_ie1',$this->data);
		}
		if($id==3){
			$this->load->view('test/test_ie3',$this->data);
		}
		else{
			$this->load->view('test/test_ie2',$this->data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */