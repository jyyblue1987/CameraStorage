<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class video_download extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date','front'));	
		$this->load->library(array('session'));
		$this->load->model(array('comman_model','settings_model'));
		$this->data['set_meta'] = '';	
        $this->data['settings'] = $this->settings_model->get_fields();
		date_default_timezone_set("America/Cancun"); 

	}

	function download(){
		$this->load->helper('download');
		$id =$this->input->get('id');
		$file =$this->input->get('files');
		if(!$id){
			$this->session->set_flashdata('error','There is no camera!!'); 
			redirect('EN/front');
		}

		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by('camera',array('id'=>$id),false,false,true);
		if(!$checkProduct){
			//echo 'no camere';die;
			redirect('EN/front');
		}

		if(!$file){
			redirect('EN/front');
		}
		if(ENVIRONMENT=='production'){
			$checkAlreayExist = FCPATH.'data/'.$checkProduct->camera_path.'/camera '.$checkProduct->id.'/files/'.$file;
		}
		else{
			$checkAlreayExist = FCPATH.'data/'.$checkProduct->camera_path.'/camera '.$checkProduct->id.'/files/'.$file;
		}

		//echo $checkAlreayExist;
		if(file_exists($checkAlreayExist)){//if file exists
//		echo 'Yes';
		}
		else{
			redirect('EN/front');
		}

		//$this->comman_model->save('files',array('download_count'=>$download_file->download_count+1),$download_file->id);
		$data = file_get_contents($checkAlreayExist);
		force_download($file,$data); 
	}    
}
