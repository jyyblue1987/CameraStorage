<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_camera extends Admin_Controller {
	public $_table_names = 'users';
	public $_table_camera = 'camera';
	
	public $_subView = 'admin/client_camera/';
	public $_redirect = '/client_camera';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'User Management';
        $this->load->model(array('users_model'));
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
		$this->checkPermissions('user_manage');
        $this->data['timeszone_list'] = array('EST' => "US Eastern Standard (EST)", 'CST' => "US Central Standard (CST)",'MST' => "US Mountain Standard (MST)",'PST' => "US Pacific Standard (PST)");

	}
	

	//  Landing page of admin section.
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'Dealer';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>"D"),false,false,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function c($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'View';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['user_data'] = $checkUser = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'account_type'=>"D"),false,false,true);
		if(!$checkUser){
			redirect($this->data['_cancel']);
		}

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('parent_id'=>$id,'account_type'=>"A"),false,false,false);
        $this->data['subview'] = $this->_subView.'index_c';
		$this->load->view('admin/_layout_main',$this->data);

	}

	function c_v($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'View';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['user_data'] = $checkUser = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'account_type'=>"A"),false,false,true);
		if(!$checkUser){
			redirect($this->data['_cancel']);
		}

		$this->data['all_data'] = $this->comman_model->get_by('camera',array('user_id'=>$id),false,false,false);
        $this->data['subview'] = $this->_subView.'index_c_v';
		$this->load->view('admin/_layout_main',$this->data);

	}

	function view($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'View';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['view_data'] = $checkUser = $this->comman_model->get_by('camera',array('id'=>$id),false,false,true);
		if(!$checkUser){
			redirect($this->data['_cancel']);
		}

        $this->data['subview'] = $this->_subView.'view';
		$this->load->view('admin/_layout_main',$this->data);
	}
	
	public function v($id = NULL){
		$this->data['name'] = 'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
        }
		$this->data['view_data'] = $checkProduct = $this->comman_model->get_by($this->_table_camera,array('id'=>$id),false,false,true);
		
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}


		$this->data['client_data'] = $getClient = $this->comman_model->get_by('users',array('id'=>$checkProduct->user_id),false,false,true);
		if(!$getClient){
			redirect($this->data['_cancel']);
		}

		$images_folder = 'camera '.$id;
		$path = $getClient->dealer_path.'/'.$getClient->folder_path;
		if(!empty($checkProduct->camera_path)){
//			echo 'data/'.$checkProduct->camera_path.'/'.$images_folder;
			if (!is_dir('data/'.$checkProduct->camera_path.'/'.$images_folder)) {
				mkdir('./data/'.$checkProduct->camera_path.'/'.$images_folder, 0755, true);
			}
		}
		else{
			if (!is_dir('data/'.$path.'/'.$images_folder)) {
				mkdir('./data/'.$path.'/'.$images_folder, 0755, true);
			}
			$this->db->where('id', $checkProduct->id);
			$this->db->set('camera_path',$path,true);
			$this->db->update('camera');			
		}
		
/*		if($this->data['user_details']->play_w_pay==1){
			if($checkProduct->payment_id==0){
				$this->session->set_flashdata('error','Camera has not upgrade!!');
//				redirect($this->data['_cancel']);							
			}			
		}*/

		if($getClient->play_w_pay==1){
			if($checkProduct->payment_id==0){
				$this->session->set_flashdata('error','Camera has not upgrade!!');
				redirect($this->data['_cancel']);							
			}
			elseif($checkProduct->is_expire==1){
				$this->session->set_flashdata('error','Camera has not upgrade!!');
				redirect($this->data['_cancel']);							
			}
		}

		if ($this->agent->is_browser('Safari')) {
	        $this->data['subview'] = $this->_subView.'view_camera_safari';
		}
		else{
	        $this->data['subview'] = $this->_subView.'view_camera';
		}

//        $this->data['subview'] = $this->_subView.'view_camera';
		$this->load->view('admin/_layout_main',$this->data);
	}
	
	function get_start_link2(){
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='';
		$id = $this->input->post('id');
		//$id = 10;
		if($id){
			$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			if($check){
				//die;
				if($check->sys_file==0){

				if($check->model=='Custom RTSP Device'){
					$videoLink = $check->url;
				}
				else{
					$videoLink = 'rtsp://'.$check->ip_address.':'.$check->port.'/user='.$check->username.'&password='.$check->password.'&channel='.$check->camera_num.'&stream='.$check->stream.'.sdp';
				}
				
					$images_folder = 'camera '.$id;
//					$path = $this->data['user_details']->camera.'/'.$this->data['user_details']->folder_path.'/'.$images_folder;
					$path = $check->camera_path.'/'.$images_folder;
					if (!is_dir('data/'.$path)) {
						mkdir('./data/'.$path, 0755, true);
					}
					//die;
					if(!empty($check->s_file)){
						$fileStart = (trim(basename($check->s_file,".m3u8"),'-').'1').'-.m3u8';
					}
					else{
						$fileStart = 'capture-.m3u8';
					}
					
/*					echo '<br>Old: '.$check->s_file;
					echo '<br>New: '.$fileStart;die;*/

					$this->db->where('id',$id);
					$this->db->set('sys_file',1,true);
					$this->db->set('s_file',$fileStart,true);
					$this->db->set('is_connect',1,true);
					$this->db->update($this->_table_names);

					//old file
					//path change
					//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 "/var/www/html/data/'.$images_folder.'/'.$fileStart.'"';
					$string = 'ffmpeg -nostats -loglevel 0 -rtsp_transport tcp -i "'.$videoLink.'" -c copy -hls_time 2 "/var/www/html/data/'.$path.'/'.$fileStart.'"';
					//die;
					//$string = 'ffmpeg -rtsp_transport tcp -i "'.$videoLink.'" -c copy "/var/www/html/data/'.$images_folder.'/capture.m3u8"';
					exec($string,$output_d,$return);
					if (!$return) {
						//echo "ffmpeg work!!";
					} else {
						//echo "ffmpeg not work or some error";
						$this->db->where('id',$id);
						$this->db->set('sys_file',0,true);
						$this->db->update($this->_table_names);
					}

				
/*					$this->db->where('id',$id);
//					$this->db->set('sys_file',0,true);
					$this->db->update($this->_table_names);*/
					$output['msge'] ='Thers is no camera!!';
				}
				else{
					$output['status'] ='ok';
				}			
			}
			else{
				$output['msge'] ='Thers is no camera!!';
			}
			
		}		
		echo json_encode($output);
	//	echo exec('ffmpeg -rtsp_transport tcp -i "rtsp://demo.itechproducts.info:95/user=admin&password=123456&channel=2&stream=1.sdp" -c copy -acodec aac -strict -2 -b:a 384k -map 0 -f segment -segment_time 30 -segment_format mp4 "data/capture-%03d.mp4"');
	}

  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			$redirect = checkPermission('admin_permission',array('user_id'=>$this->data['admin_details']->id,'type'=>$type,'value'=>1));	
		}
		else{
			$redirect = 1;
		}
		
		if($redirect==0){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			if($redirect){
				redirect($redirect);
			}
			redirect($this->data['admin_link'].'');
		}		
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */