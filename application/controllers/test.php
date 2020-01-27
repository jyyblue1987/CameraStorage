<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date'));	
		$this->load->library(array('form_validation','session'));
		$this->load->model(array('comman_model'));
	}
	
	function ffmpeg_install(){
		echo exec("ffmpeg -version");
	}

	function ffmpeg_link(){
		$flv = 'b.mp4';
		exec("ffmpeg -i $flv -y -f mjpeg -ss 00:00:05 -s 120x90 -vframes 1 -an thumb.jpg 2>&1",$error,$return);
		echo '<pre>';
		print_r($error);
//		 exec('ffmpeg -rtsp_transport tcp -i "rtsp://demo.itechproducts.info:95/user=admin&password=123456&channel=2&stream=1.sdp" -c copy -acodec aac -strict -2 -b:a 384k -map 0 -f segment -segment_time 30 -segment_format mp4 "datasdsd/capture-%03d.mp4"',$output,$return);
		if (!$return) {
			echo "PDF Created Successfully";
		} else {
			echo "PDF not created";
		}
	}
	function btn(){
/*			$images_folder = 'camera as';
			if (!is_dir('data/'.$images_folder)) {
				mkdir('./data/'.$images_folder, 0777, true);
			}*/
		$output = 'new_file';
		echo '<br>Folderr Name: '.$output.'<br>';
		if(!file_exists('data/'.$output)){
//			echo 'yes';
			if (!mkdir('./data/'.$output,0777)) {//0777
				die('Failed to create folders...');
			}
			else{
				echo 'created';
			}
		}
		else{
					echo '<br>foloder already have!!';
		}

/*error_reporting(0);
echo '<html><body>';
@set_time_limit(1);
$i = 0;
while(++$i < 100000001){
        if($i % 100000 == 0){
                echo $i / 100000, "<br/>\n";
        }
}
echo "done.<br/>\n";
*/
// will not echo 'done.'.
die;

//		echo exec('ffmpeg -rtsp_transport tcp -i "rtsp://demo.itechproducts.info:95/user=admin&password=123456&channel=2&stream=1.sdp" -c copy -acodec aac -strict -2 -b:a 384k -map 0 -f segment -segment_time 30 -segment_format mp4 "data/capture-%03d.mp4"');
	}

	function folders(){
		$output = 'new_file';
//		echo '<br>Folderr Name: '.$output.'<br>';
/*		if(!file_exists('datas')){
			echo 'no';
		}
		else{
			echo '<br>have!!';
		}*/
		
		$dir = "datas/";
		
		// Open a directory, and read its contents
		if (is_dir($dir)){
		  if ($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false){
			  echo "filename:" . $file . "<br>";
			}
			closedir($dh);
		  }
		}
	}
	

	function times(){
		date_default_timezone_set('UTC');		
		echo date('Y-m-d H:i:s A');
		echo '<br>'.date('Y-m-d H:i:s',time());
		echo '<br>';
		echo date('Y-m-d H:i:s A');
		echo '<br>'.date('Y-m-d H:i:s',time());
	}


	function send_mail(){
		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);
		$this->email->from('pvsysgrouptesting@gmail.com','testing User');
		$this->email->to('sushant.goralkar@gmail.com');
		$this->email->subject('pvsysgroup Subject');
		$this->email->message('this is text msge of testing');
		$this->email->send();
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */