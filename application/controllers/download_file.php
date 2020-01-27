<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download_file extends Frontend_Controller {	
	public function __construct(){
		parent::__construct();

	}

	function index($id=false){
		$this->data['active'] = 'home';	
		$this->data['title'] = $this->data['site_name']->value;
		$this->data['download_file'] = $this->comman_model->get_by('files',array('code'=>$id,'published'=>1),false,false,true);
		//$this->data['login'] = $this->session->all_userdata();
		
		$this->load->view('templates/download_file',$this->data);
	}

	function downloadfile($files,$name = false){
		$data = file_get_contents('assets/uploads/'.$files.'/'.$name);
		$this->load->helper('download');
		force_download($name,$data); 
	}
	function download1($id = false){
		$this->load->helper('download');
		if(!$id){
			redirect('front');
		}
		$download_file = $this->comman_model->get_by('files',array('code'=>$id,'published'=>1),false,false,true);
		if(count($download_file)){
			$this->comman_model->save('files',array('download_count'=>$download_file->download_count+1),$download_file->id);
			$data = file_get_contents('assets/uploads/dropbox/'.$download_file->file_name);
			force_download($download_file->file_name,$data); 
		}
		else{
			redirect('front');
		}
	}
	
	function down(){
		$download_file = $this->comman_model->save('files',array('code'=>$id,'published'=>1),false,false,true);	
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */