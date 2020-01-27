<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealer extends Admin_Controller {
	public $_table_names = 'users';
	public $_subView = 'admin/dealers/';
	public $_redirect = '/dealer';
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
		$this->data['lang_id'] = $this->data['adminLangSession']['lang_id'];
		$this->checkPermissions('user_manage');

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

	function set_user($id){
		if(!$id)
			redirect($this->data['_cancel']);
			$this->comman_model->save($this->_table_names,array('confirm'=>'confirm'),$id);
			redirect($this->data['_cancel']);		
	}


	function create(){

        $newUsers = new stdClass();
        //$tags->parent_id = 0;
        $newUsers->first_name		 	= '';
        $newUsers->company_name 		= '';
        $newUsers->phone				= '';
        $newUsers->email 				= '';
        $newUsers->c_days 				= 0;
        $newUsers->c_num 				= 0;
		$this->data['users'] = $newUsers;

		$this->data['name'] = 'Create';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['days_data'] = array('0'=>'None','7'=>'7 days','15'=>'15 days','-1'=>'For Life');
        // Set up the form
		$rules = $this->users_model->create_d_rules;
        $this->form_validation->set_rules($rules);
		$this->form_validation->set_message('is_unique',show_static_text($this->data['lang_id'],60));
        // Process the form
        if($this->form_validation->run() == TRUE){
			$user_post =array('first_name','company_name','email','password','phone','c_num','c_days','is_set_price');
			$post_data= $this->comman_model->array_from_post($user_post);
			$checkEmail = $this->comman_model->get_by('users',array('LOWER(email)'=>strtolower($post_data['email'])),false,false,false);
			if($checkEmail){
				$this->session->set_flashdata('error',show_static_text($this->data['lang_id'],60));
				redirect($this->data['_cancel'].'/create');
			}

			$post_data['account_type'] = 'D';
			$post_data['type'] = 'Dealer';
			$post_data['username'] = $post_data['first_name'];
			$post_data['status'] = 1;
			$post_data['created_by'] = 'admin';
			$post_data['confirm'] = 'confirm';
			$post_data['update_point'] = date('Y-m-t');
          	//$this->comman_model->save('users',$userData,$this->data['users']->user_id);
			$this->db->trans_start();
            $id = $this->comman_model->save($this->_table_names,$post_data);
			$folder = url_title($post_data['first_name'].'-'.$id, 'dash', true);
			//for create dealer folder
			if (!is_dir('data/'.$folder)){
				mkdir('./data/'.$folder, 0777, true);
			}

           	$this->comman_model->save($this->_table_names,array('dealer_path'=>$folder),$id);
           	$this->comman_model->save('users_e_setup',array('user_id'=>$id,'type'=>'system'));
			$this->db->trans_complete();
			
						
			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel']);
			die;
        }

		$this->data['subview'] = $this->_subView.'create';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	function edit($id= NULL){
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$this->data['users'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'account_type'=>'D'),false,false,true);

            if(!$this->data['users']){
	            redirect($this->data['_cancel']);
			}
			//$this->data['user_data']  = $this->comman_model->get_by('users',array('id'=>$this->data['users']->user_id),false,false,true);
        }
        else
        {
			redirect($this->data['_cancel']);
        }

		$this->data['days_data'] = array('0'=>'None','7'=>'7 days','15'=>'15 days','-1'=>'For Life');


        // Set up the form
		$rules = $this->users_model->update_d_rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$user_post =array('flash_notes','first_name','company_name','c_days','c_num','is_set_price');
			$post_data= $this->comman_model->array_from_post($user_post);
          	//$this->comman_model->save('users',$userData,$this->data['users']->user_id);
			$post_data['username'] = $post_data['first_name'];

            $this->comman_model->save($this->_table_names,$post_data,$id);

			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel']);
			//die;
        }

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
	function update_balance($id= NULL){
	    // Fetch a page or set a new one
	    if(!$id){
			redirect($this->data['_cancel']);
		}
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$checkUser = $this->data['users'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'account_type'=>'D'),false,false,true);

		if(!$this->data['users']){
			redirect($this->data['_cancel']);
		}
		if($checkUser->debt_point==0){
			$this->session->set_flashdata('error','Sorry there is no due amount');
			redirect($this->data['_cancel']);
		}
		$rules = array(
			'name' => array('field'=>'name', 'label'=>'email', 'rules'=>'trim'),
		);

        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			$this->db->trans_start();
			$this->db->where('id',$checkUser->id);
			$this->db->set('debt_point',0,true);
			$this->db->set('update_point',date('Y-m-d'),true);
			$this->db->set('status',1,true);
			$this->db->set('dealer_inactive_send_3',0,true);
			$this->db->set('dealer_inactive_send_6',0,true);
			$this->db->set('dealer_inactive_send_14',0,true);
			$this->db->set('dealer_inactive_msge',0,true);
			
			$this->db->update($this->_table_names);
			$post_data =array(
						'amt'				=> abs($checkUser->debt_point),
						'user_id'			=> $checkUser->id,
						'payment_type'		=> 'admin',
						'subscribe_status'	=> 'confirm',
						'on_date'			=> date('Y-m-d'),
						);		
			$check = $this->comman_model->save('user_history',$post_data);
			
			$this->db->trans_complete();

			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel']);
			die;
        }

		$this->data['subview'] = $this->_subView.'balance_form';
        $this->load->view('admin/_layout_main', $this->data);
	}
	function send_mail($id =false){
		if(!$id){
            redirect($this->data['_cancel']);			
		}
		
	
		$checkUser = $this->comman_model->get_by('users',array('id'=>$id),false,false,true);
		if(!$checkUser){
			$this->session->set_flashdata('error','There is no user!!');
            redirect($this->data['_cancel']);			
			
		}

		$email_data = $this->comman_model->get_by('email',array('id'=>3),false,false,true);
				
		$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
		$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);
		
		$email_data->message = str_replace('{user_name}', $checkUser->first_name.' '.$checkUser->last_name, $email_data->message);
		$email_data->message = str_replace('{user_email}', $checkUser->email, $email_data->message);
		$email_data->message = str_replace('{password}', $checkUser->password, $email_data->message);
		$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
		$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
		$email_data->message = str_replace('{login_link}', base_url(), $email_data->message);
		//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);
		//echo $checkUser->email.' '.$this->data['settings']['site_email'];die;
		//echo $email_data->message;die;
		$this->load->library('email');
		$config12 = array (
		  'mailtype' => 'html',
		  'charset'  => 'utf-8',
		  'priority' => '1'
		   );
		$this->email->initialize($config12);
		//echo $email_data->subject;

		$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
		$this->email->to($checkUser->email);
		$this->email->subject($email_data->subject);
		$this->email->message($email_data->message);
		
/*		$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
		$this->email->to('pvsysgroup01@gmail.com');
		$this->email->subject('asdasdas');
		$this->email->message($email_data->message);*/

		if($this->email->send()){
			$this->session->set_flashdata('success','mail has successfully sent!!');
		}
		else{
			$this->session->set_flashdata('error','There is some problem to sent mail!!');
		}

		redirect($this->data['_cancel']);			
	}

	function get_comfirm($id){
		if(!$id){
			redirect($this->data['_cancel'].'/reseller');
		}
		
		$result = $this->comman_model->save($this->_table_names,array('admin_confirm'=>1),$id);
		redirect($this->data['_cancel'].'/reseller');
	}

	function get_status(){
		$id = $this->input->get('id');
		if($id){
			$checkUser = $this->data['users'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'account_type'=>'D'),false,false,true);
			if($checkUser){
				$this->db->where('id', $id);
				$this->db->set('disable_date',NULL,true);
				if($checkUser->status==0){
					$this->db->set('status',1,true);
					if($checkUser->total_point<0){
//						$this->db->set('dealer_inactive_msge',1,true);
					}
				}
				else{
					$this->db->set('status',0,true);
				}
				$this->db->update('users');
			}
		}
	}

	

	function delete($id = false){
		ini_set("memory_limit","2512M");
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		if(!$id){
			redirect($this->data['_cancel']);
		}

		$dealers = $this->comman_model->get_by('users',array('id'=>$id),false,false,true);
		if(!$dealers){
			redirect($this->data['_cancel']);
		}
		//
		$string = "select id from users where parent_id=".$id;
		$clients = $this->comman_model->get_query($string,false);
		if($clients){
			foreach($clients as $set_client){
				$this->db->delete('groups',array('user_id'=>$set_client->id));
				$this->db->delete('groups_c',array('user_id'=>$set_client->id));
				$this->db->delete('user_history',array('user_id'=>$set_client->id));
				$this->db->delete('user_online',array('user_id'=>$set_client->id));
				$this->db->delete('user_playback_sent',array('user_id'=>$set_client->id));
				$this->db->delete('users_chat',array('from_id'=>$set_client->id));
				$this->db->delete('users_chat',array('to_id'=>$set_client->id));
				$this->db->delete('camera',array('user_id'=>$set_client->id));
				$this->db->delete('users',array('parent_id'=>$set_client->id));
				
/*				$this->db->delete('p_categories',array('user_id'=>$set_client->id));
				$this->db->delete('p_categories',array('user_id'=>$set_client->id));*/
				
/*				$string = "select id,camera_path from camera where user_id=".$set_client->id;
				$camera = $this->comman_model->get_query($string,false);
				if($camera){
					foreach($camera as $set_camera){
						$path = '/var/www/html/data/'.$set_camera->camera_path;
						if(ENVIRONMENT=='production'){
							$path = 'data/'.$set_camera->camera_path;
						}
						if(!rmdir($path)){
							echo ("Could not remove $path");
						}
					}
				}*/
			}
		}

		$string = "select id from tickets where user_id=".$id;
		$tickets = $this->comman_model->get_query($string,false);
		if($tickets){
			foreach($tickets as $set_ticket){
				$this->db->delete('tickets_files',array('ticket_id'=>$set_ticket->id));
				$this->db->delete('tickets_status',array('ticket_id'=>$set_ticket->id));
			}
		}
		
		if(!empty($dealers->dealer_path)){
			$path = '/var/www/html/data/'.$dealers->dealer_path;
			if(ENVIRONMENT=='production'){
				$path = 'data/'.$dealers->dealer_path;
			}
			$this->deleteDir($path);
		}

		$this->db->delete('camera_payment',array('owner_id'=>$dealers->id));
		$this->db->delete('chat_messages',array('user_id'=>$dealers->id));
		$this->db->delete('chat_messages',array('recipient_id'=>$dealers->id));
		$this->db->delete('groups',array('user_id'=>$dealers->id));
		$this->db->delete('groups_c',array('user_id'=>$dealers->id));
		$this->db->delete('plans_c',array('owner_id'=>$dealers->id));
		$this->db->delete('user_history',array('user_id'=>$dealers->id));
		$this->db->delete('user_online',array('user_id'=>$dealers->id));
		$this->db->delete('user_playback_sent',array('user_id'=>$dealers->id));
		$this->db->delete('users_chat',array('from_id'=>$dealers->id));
		$this->db->delete('users_chat',array('to_id'=>$dealers->id));
		$this->db->delete('users_e_setup',array('user_id'=>$dealers->id));
		$this->db->delete('users_email',array('user_id'=>$dealers->id));
		$this->db->delete('users_membership',array('user_id'=>$dealers->id));
		$this->db->delete('users_paypal',array('user_id'=>$dealers->id));
		$this->db->delete('users_permission',array('owner_id'=>$dealers->id));
		$this->db->delete('users_support',array('user_id'=>$dealers->id));
		$this->db->delete('users_transaction',array('ownner_id'=>$dealers->id));
		$this->db->delete('users_membership',array('user_id'=>$dealers->id));
		$this->db->delete('users',array('parent_id'=>$dealers->id));
		$this->db->delete('users',array('id'=>$dealers->id));
		
		$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],297)); 
		redirect($this->data['_cancel']);		
		die;

	}
	

	public static function deleteDir($dirPath) {
		if (! is_dir($dirPath)) {
			return "$dirPath must be a directory";
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}	
	//function send_mail(){}

	public function _unique_email($str){
		//$login = $this->session->all_userdata();
		$check = $this->comman_model->get_by('users',array('LOWER(email)'=>strtolower($str)),false,false,true);
        if($check){
            $this->form_validation->set_message('_unique_email','System already has an account with this email address, please use a different email address for this account');
            return FALSE;                    
        }
        return TRUE;
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