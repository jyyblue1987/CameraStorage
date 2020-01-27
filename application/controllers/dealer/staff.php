<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends Frontend_Controller{	
	public $_redirect = '/dealer/staff';

	public $_subView = 'ownner/employee/';
	public $_table_names = 'users';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Staff';
        $this->load->model(array('user_staff_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/dealer';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';		
		$this->_checkUser();
		$this->data['permissions']	= array(
										array(
											'id'=>'users',
											'value'=>'Client Management',
											'children'=>array(
															array('id'=>'client','value'=>'Client'),
															array('id'=>'client_camera','value'=>'Client Camera'),
															array('id'=>'client_plan','value'=>'Client Plan'),
														),
										),
										array(
											'id'=>'staff_manage',
											'value'=>'Staff Management',
										),
										
										array(
											'id'=>'content',
											'value'=>'Content Management',
											'children'=>array(
															array('id'=>'email_setup','value'=>'E-Mail Server Setup'),
															array('id'=>'support','value'=>'Support'),
															array('id'=>'notification','value'=>'Notifications'),
															array('id'=>'client_link','value'=>'Client Self Registration Link'),
														),
										),
										array(
											'id'=>'payment_manage',
											'value'=>'Payment Account',
											'children'=>array(
															array('id'=>'paypal_account','value'=>'paypal Account'),
															array('id'=>'paypal_setting','value'=>'Settings'),
														),
										),
										array(
											'id'=>'payment_history',
											'value'=>'Payment History',
										),
										array(
											'id'=>'monthly_payment_manage',
											'value'=>'Monthly Payment',
											'children'=>array(
															array('id'=>'monthly_payment_history','value'=>'Payment History'),
														),
										),
										
										array(
											'id'=>'ticket',
											'value'=>'Ticket Management',
										),
								);        		
//		$this->_checkPaidUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],1000).'Staff';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('parent_id'=>$this->data['user_details']->id,'account_type'=>'S'),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function create(){				
//		$this->_checkPlan();
		$this->data['name'] = show_static_text($this->data['lang_id'],257);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];



        $rules = $this->user_staff_model->create_staff_rules;
        $this->form_validation->set_rules($rules);
//		$this->form_validation->set_message('is_unique','%s should be unique');
		$this->form_validation->set_message('is_unique',show_static_text($this->data['lang_id'],60));
        // Process the form
        if($this->form_validation->run() == TRUE){
        	$post_data = $this->comman_model->array_from_post(array(
							'first_name','email','password',
							'phone','address',
							));

			$checkEmail = $this->comman_model->get_by('users',array('LOWER(email)'=>strtolower($post_data['email'])),false,false,false);
			if($checkEmail){
				$this->session->set_flashdata('error',show_static_text($this->data['lang_id'],60));
				redirect($this->data['_cancel'].'/create');
			}

        	$post_data['username'] = $post_data['first_name'];
/*			$this->load->library('image_lib');
			if (!empty($_FILES['image']['name'])){					
				$result =$this->comman_model->do_upload('image','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$post_data['image'] = $result[1];
				}
			}	
			else{
				$post_data['image'] = $this->data['user_details']->logo;
			}*/


			$post_data['confirm']		= 'confirm';
			$post_data['account_type'] 	= 'S';
			$post_data['type']			= 'Staff';
			$post_data['status'] 		= 1;
			$post_data['parent_id'] 	= $this->data['user_details']->id;

			$reg = $this->comman_model->save('users',$post_data);

			//save permission
			$post_permission = $this->input->post('permission');
/*			echo '<pre>';
			print_r($post_permission);*/
			if($post_permission){
				foreach($post_permission as $key=>$value){
					if($value){
						$postPD = array(
										'value'			=> $value,
										'type'			=> $key,
										'user_id'		=> $reg,
										'owner_id'		=> $this->data['user_details']->id
										);
						$this->db->insert('users_permission',$postPD);
					}
				}
			}

			$this->send_m($reg);
			/*send mail*/			
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],2101).'Data has successfully created.');
			redirect($this->data['_cancel']);
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'create';
		$this->load->view($this->_mainView,$this->data);
	}

	function send_m($id=false){
		if(!$id){
			return false;
		}
		if($this->data['settings']['email_option']==1){
	
	//		echo 'asd';
			$checkUsers = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id,'account_type'=>'S'),false,false,true);
	/*		echo $this->db->last_query();
			echo '<pre>';
			print_r($checkUsers);
			die;*/
			if(!$checkUsers){
				return false;
			}
			$checkEmail = $this->comman_model->get_by('users_email',array('user_id'=>$this->data['user_details']->id,'email_id'=>4),false,false,true);
			if($checkEmail){
				$html = $checkEmail->message;
				$subject = $checkEmail->subject;
			}
			else{
				return false;
			}
			
				
			$html = str_replace('{user_name}', $checkUsers->username, $html);
			$html = str_replace('{user_email}', $checkUsers->email, $html);
			$html = str_replace('{password}', $checkUsers->password, $html);
			$html = str_replace('{site_name}', $this->data['settings']['site_name'], $html);
			$html = str_replace('{site_email}', $this->data['settings']['site_email'], $html);
			$html = str_replace('{login_link}', site_url($this->data['lang_code'].'/secure/login'), $html);
			//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);
			//echo $html;die;
			$this->load->library('email');
			$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
			$this->email->initialize($config);
			$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
			$this->email->to($checkUsers->email);
			$this->email->subject($subject);
			$this->email->message($html);
			$this->email->send();
			return true;
		}
	}
    
	public function edit($id = NULL){
		if(!$id)
			redirect($this->data['_cancel']);
	
		$this->data['name'] = show_static_text($this->data['lang_id'],2570).'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['users'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id,'account_type'=>'S'),false,false,true);
		if(!$this->data['users']){
			redirect($this->data['_cancel']);
		}
		
        $rules = $this->user_staff_model->update_staff_rules ;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			
        	$post_data = $this->comman_model->array_from_post(array(
							'first_name','phone','address',
							));

        	$post_data['username'] = $post_data['first_name'];

			$post_data['account_type'] 	= 'S';
			$post_data['type']			= 'Staff';

			$this->comman_model->save('users',$post_data,$id);

			//save permission
			$post_permission = $this->input->post('permission');
/*			echo '<pre>';
			print_r($post_permission);
			die;*/
			$this->db->delete('users_permission', array('user_id' => $id,'owner_id' => $this->data['user_details']->id)); 
			if($post_permission){
				foreach($post_permission as $key=>$value){
					if($value){
						$postPD = array(
										'value'			=> $value,
										'type'			=> $key,
										'user_id'		=> $id,
										'owner_id'		=> $this->data['user_details']->id
										);
						$this->db->insert('users_permission',$postPD);
					}
				}
			}

/*			echo '<pre>';
			print_r($data2);
			die;*/
//			echo $this->db->last_query();die;
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],2101).'Data has successfully updated.');
			redirect($this->data['_cancel'].'/edit/'.$id);
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'edit';
		$this->load->view($this->_mainView,$this->data);
	}
		
	function delete($id=false){
		if(!$id){
			redirect($this->data['_cancel']);			
		}
		$check_product = $this->comman_model->get_by('users',array('id'=>$id,'parent_id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);
		if(!$check_product){
			redirect($this->data['_cancel']);			
		}
		$this->db->delete('users', array('id'=>$id,'parent_id'=>$this->data['user_details']->id)); 
		redirect($this->data['_cancel']);			
	}

	function _checkPlan(){
		if($this->data['user_details']->plan_id!=0){
/*			echo 'Total: '.$this->data['user_details']->total_point;
			echo '<br>';
			echo 'use IN : '.$this->data['user_details']->credits_point+$this->data['user_details']->plan_coach;*/
			if($this->data['user_details']->total_point<($this->data['user_details']->credits_point+$this->data['user_details']->plan_coach)){
				$this->session->set_flashdata('error','Enough Balance!!'); 
				redirect($this->data['_cancel']);
			}
		}
	}

	function get_active(){
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='Please login first!!';

		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$value = $this->input->post('value');
		$check_data = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id),false,false,true);
		if($check_data){
			if($type=='status'){
				$output['status'] = 'ok';
				if($check_data->status==1){
					$post_data = array('status'=>0);
				}
				elseif($check_data->status==0){
					$post_data = array('status'=>1);
				}
				else{
					$post_data = array('status'=>1);
				}
				$result = $this->comman_model->save($this->_table_names,$post_data,$id);				
			}
		}
		else{
			$output['msge'] ='There is no user!!';
		}
		echo json_encode($output);
	}

	function _checkPaidUser(){
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
		if($this->data['user_details']->total_point>0){
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	}

	public function _unique_email($str){
		//$login = $this->session->all_userdata();
		$check = $this->comman_model->get_by('users',array('LOWER(email)'=>strtolower($str)),false,false,true);
        if($check){
            $this->form_validation->set_message('_unique_email','System already has an account with this email address, please use a different email address for this account');
            return FALSE;                    
        }
        return TRUE;
    }
	

	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='D'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
		if($this->data['user_details']->parent_id!=0){
				redirect($this->data['lang_code'].'/user');
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */