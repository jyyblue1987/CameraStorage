<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Camera extends Admin_Controller {
	public $_table_names = 'camera';
	public $_subView = 'admin/camera/';
	public $_redirect = '/camera';
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

	}
	

	//  Landing page of admin section.
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'Lost Connection Camera';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('sys_file'=>"0",'is_connect'=>0),false,array('id'=>'desc'),false);
/*		echo '<pre>';
		print_r($this->data['all_data']);
		die;*/
   		$this->data['subview'] = $this->_subView.'index_lost';
//	   die;
		$this->load->view('admin/_layout_main',$this->data);

	}

	function send_mail($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
		
		$checkCamera = $this->comman_model->get_by($this->_table_names,array('sys_file'=>0,'is_connect'=>0,'id'=>$id),false,false,true);
		if(!$checkCamera){
            $this->session->set_flashdata('error','Sorry ! There is no camera!!');
			redirect($this->data['_cancel']);
		}
		
		$u_data = $this->comman_model->get_by('users',array('id'=>$checkCamera->user_id),false,false,true);
		if(!$u_data){
//			echo 'ok';
            $this->session->set_flashdata('error','Sorry ! There is no user for this camera!!');
			redirect($this->data['_cancel']);
		}
		$email_data = $this->comman_model->get_by('email',array('id'=>3),false,false,true);
		$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
		$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);		
		$email_data->message = str_replace('{user_name}', $u_data->username, $email_data->message);
		$email_data->message = str_replace('{camera_name}', $checkCamera->name, $email_data->message);
		$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
		$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
//		echo $email_data->message;die;

		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);
		$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
		$this->email->to($u_data->email);
		$this->email->subject($email_data->subject);
		$this->email->message($email_data->message);
		$this->email->send();	
		if($this->email->send()){
				$this->session->set_flashdata('success','Send has successfully sent!!');
		}
			redirect($this->data['_cancel']);	
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