<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Croppic extends CI_Controller {
	public $_subView = 'templates/';
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date'));	
		$this->load->library(array('form_validation','pagination','session'));
		$this->load->model(array('page_model','comman_model'));

/*		$logged_in = $this->session->userdata('user_session');
		if((isset($logged_in['loggedin']) || $logged_in['loggedin'] == true)){
			if($logged_in['loginType']=='user'){
				$detail = $this->session->all_userdata();
				$this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
			}
		}*/
	}


	


	public function index($id = false){}

	function crop_to_image(){

		$imagePath = $_POST['upload_path'];
		$session = $_POST['session'];
		$imgUrl = $_POST['imgUrl'];
		// original sizes
		$imgInitW = $_POST['imgInitW'];
		$imgInitH = $_POST['imgInitH'];
		// resized sizes
		$imgW = $_POST['imgW'];
		$imgH = $_POST['imgH'];
		// offsets
		$imgY1 = $_POST['imgY1'];
		$imgX1 = $_POST['imgX1'];
		// crop box
		$cropW = $_POST['cropW'];
		$cropH = $_POST['cropH'];
		// rotation angle
		$angle = $_POST['rotation'];
		
		$jpeg_quality = 100;
		$file_name = "product_".rand();
		$output_filename = $imagePath.$file_name;
		
		// uncomment line below to save the cropped image in the same location as the original image.
		//$output_filename = dirname($imgUrl). "/croppedImg_".rand();
		
		$what = getimagesize($imgUrl);
		
		switch(strtolower($what['mime']))
		{
		case 'image/png':
			$img_r = imagecreatefrompng($imgUrl);
			$source_image = imagecreatefrompng($imgUrl);
			$type = '.png';
			break;
		case 'image/jpeg':
			$img_r = imagecreatefromjpeg($imgUrl);
			$source_image = imagecreatefromjpeg($imgUrl);
			error_log("jpg");
			$type = '.jpeg';
			break;
		case 'image/gif':
			$img_r = imagecreatefromgif($imgUrl);
			$source_image = imagecreatefromgif($imgUrl);
			$type = '.gif';
			break;
		default: die('image type not supported');
		}
		
		
		//Check write Access to Directory
		
		if(!is_writable(dirname($output_filename))){
		$response = Array(
			"status" => 'error',
			"message" => 'Can`t write cropped File'
		);	
		}else{
		
		// resize the original image to size of editor
		$resizedImage = imagecreatetruecolor($imgW, $imgH);
		imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
		// rotate the rezized image
		$rotated_image = imagerotate($resizedImage, -$angle, 0);
		// find new width & height of rotated image
		$rotated_width = imagesx($rotated_image);
		$rotated_height = imagesy($rotated_image);
		// diff between rotated & original sizes
		$dx = $rotated_width - $imgW;
		$dy = $rotated_height - $imgH;
		// crop rotated image to fit into original rezized rectangle
		$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
		imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
		imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
		// crop image into selected area
		$final_image = imagecreatetruecolor($cropW, $cropH);
		imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
		imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
		// finally output png image
		//imagepng($final_image, $output_filename.$type, $png_quality);
		imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
		$response = Array(
			"status" => 'success',
			"url" => $output_filename.$type
		);
			if($session=='store'){
				$this->session->set_userdata('store_image_session',$file_name.$type);
			}
			else if($session=='banner'){
				$this->session->set_userdata('banner_image_session',$file_name.$type);
			}
			else if($session=='image'){
				$this->session->set_userdata('image_session',$file_name.$type);
			}
			else{
				$this->session->set_userdata('image_session',$file_name.$type);
			}
		}
		print json_encode($response);
	}
	
	function save_to_image(){
		$imagePath = $_POST['upload_path'];
		$session = $_POST['session'];		
		$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
		$temp = explode(".", $_FILES["img"]["name"]);
		$extension = end($temp);
		$new_file = 'product_'.time().'.'.$extension;
		//Check write Access to Directory
		
		if(!is_writable($imagePath)){
		$response = Array(
			"status" => 'error',
			"message" => 'Can`t upload File; no write Access'
		);
		print json_encode($response);
		return;
		}
		
		if ( in_array($extension, $allowedExts))
		{
		if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
			);			
		}
		else
		{
			
		  $filename = $_FILES["img"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );
		
		 // move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);
		  move_uploaded_file($filename,  $imagePath . $new_file);
		
		  $response = array(
			"status" => 'success',
			"url" => $imagePath.$new_file,
			"filename" => $new_file,
			"width" => $width,
			"height" => $height
		  );
			if($session=='store'){
				$this->session->set_userdata('store_image_session',$new_file);
			}
			else if($session=='banner'){
				$this->session->set_userdata('banner_image_session',$new_file);
			}
			else if($session=='image'){
				$this->session->set_userdata('image_session',$new_file);
			}
			else{
				$this->session->set_userdata('image_session',$new_file);
			}
		  
		}
		}
		else
		{
		$response = array(
			"status" => 'error',
			"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
		);
		}
		
		print json_encode($response);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */