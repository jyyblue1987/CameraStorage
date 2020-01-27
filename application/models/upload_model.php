<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class upload_model extends CI_Model {
	protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
	protected $_timestamps = TRUE;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function do_upload_with_mark($file_name,$path){	
		$result = array();
		$field_name = $file_name;
		$config['upload_path'] = $path.'/full/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['max_size']	= '900000';
		$config['max_width']  = '50000';
		$config['max_height']  = '503000';		
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($field_name)){
			array_push($result,'error',$this->upload->display_errors());
			return $result; 
		}
		else{
			$upload_data = $this->upload->data();
			$this->load->library('image_lib');
			$config['image_library'] = 'GD2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['wm_type'] = 'overlay';
			$config['wm_vrt_alignment'] = 'top';
			$config['wm_hor_alignment'] = 'left';
			$config['wm_overlay_path'] = './assets/uploads/watermark.png';//the overlay image
			$config['wm_opacity']=40;
			$this->image_lib->initialize($config);
			$this->image_lib->watermark();


			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image']	= $path.'/thumbnails/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 450;
			$config['height'] = 450;
			$config['wm_text'] = 'tutsmore';
			$config['wm_type'] = 'text';
			//$config['wm_font_path'] = './fonts/ostrich-black-webfont.ttf';
			//$config['wm_padding'] = '20';
			$this->image_lib->initialize($config);
			$this->image_lib->watermark();
			$this->image_lib->clear();

			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();

			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image'] = $path.'/small/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			$this->image_lib->clear();		
			array_push($result,'success',$upload_data['file_name']);
			return $result;
		}
	
	}
	
	function do_upload($file_name,$path){
		$result = array();
		$result['status'] = 'error';
		$field_name 				= $file_name;
		$config['upload_path'] 		= $path.'/full/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['maintain_ratio'] 	= TRUE;
		$config['max_size']			= '9000000';
/*		$config['min_width'] 		= '500';
		$config['min_height']  		= '500';		*/
		$this->load->library('upload', $config);
		$this->upload->initialize($config); 

		if (!$this->upload->do_upload($field_name)){
			$result['data'] = $this->upload->display_errors();
			return $result; 
		}
		else{
			$upload_data = $this->upload->data();
			$this->load->library('image_lib');
/*			$config['image_library'] = 'GD2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['wm_text'] = 'tutsmore';
	 		$config['wm_type'] = 'text';
			$config['wm_opacity'] = 10;
			$config['new_image'] = $path.'/full/mark_'.$upload_data['file_name'];
			$this->image_lib->initialize($config);
			$this->image_lib->watermark();*/


			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image']	= $path.'/thumbnails/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 450;
			$config['height'] = 450;

			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();

			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image'] = $path.'/small/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			$this->image_lib->clear();		
			$result['status'] = 'ok';
			$result['data'] = $upload_data;

			return $result;
		}
	}

	function uploads($file_name,$path){
		//video
		$result = array();
		$result['status'] = 'error';
		$field_name 				= $file_name;
		$config['upload_path'] 		= $path.'/';
		$config['allowed_types'] 	= 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['maintain_ratio'] 	= TRUE;
		$config['max_size']			= '9000000';
/*		$config['min_width'] 		= '500';
		$config['min_height']  		= '500';		*/
		$this->load->library('upload', $config);
		$this->upload->initialize($config); 

		if (!$this->upload->do_upload($field_name)){
			$result['data'] = $this->upload->display_errors();
			return $result; 
		}
		else{
			$upload_data = $this->upload->data();
			$result['status'] = 'ok';
			$result['data'] = $upload_data;
			return $result;
		}

/*		if(!empty($_FILES['video1'])){
			$config['upload_path']      = 'assets/uploads/shows/';
			$config['allowed_types']    = '*';
			$config['max_size']         = '6000000';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('video1')){
				if($_FILES['video1']['error'] != 4){
					$this->session->set_flashdata('error', $this->upload->display_errors());
				}
			}
			else{
				$upload_data    = $this->upload->data();
				$data['video']  = $upload_data['file_name'];
			}
		}else{
			$data['video']  = $this->data['blogs']->video;
		}      */
	}
}




/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>