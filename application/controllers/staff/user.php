<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends Frontend_Controller{	
	public $_redirect = '/staff/user';
	public $_subView = 'staff/client/';
	public $_table_names = 'users';
	public $_mainView = 'staff/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'People';
        $this->load->model(array('user_staff_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/staff';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
		$this->checkPermissions('client');
	//	$this->_checkPaidUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],1000).'Client';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('parent_id'=>$this->data['user_details']->parent_id,'account_type'=>'A'),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

	function create(){				
//		$this->_checkPlan();
		$this->data['name'] = show_static_text($this->data['lang_id'],257);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

	   	$this->db->order_by('name','asc');
        $this->data['countries_data'] = $this->comman_model->get('countries',false);

        $rules = $this->user_staff_model->create_athletes_rules;
        $this->form_validation->set_rules($rules);
		$this->form_validation->set_message('is_unique','%s should be unique');
        // Process the form
        if($this->form_validation->run() == TRUE){
			
        	$post_data = $this->comman_model->array_from_post(array(
							'first_name','company_name','email','password','flash_notes',
							'phone','phone2','address','city','state','zip','country',
/*							'discount',*/
							));

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
			$post_data['created_by'] 	= 'Staff';
			$post_data['account_type'] 	= 'A';
			$post_data['type']			= 'Client';
			$post_data['status'] 		= 1;
			$post_data['parent_id'] 	= $this->data['user_details']->parent_id;
			$post_data['staff_id'] 		= $this->data['user_details']->id;

			$reg = $this->comman_model->save($this->_table_names,$post_data);

			$html  ='<div style="border: solid #666;">
<div style="background-color: #000; color: #fff; text-align: center;">
<h1>{site_name}</h1>
</div>

<div style="background-color: #fff; color: #000;">
<h3 style="margin-left:20px">Dear {user_name}</h3>
</div>

<div style="background-color: #999; color: #fff;">
<h3 style="margin-left:20px">Email: {user_email}</h3>

<h3 style="margin-left:20px">Password: {password}</h3>


<h3 style="margin-left:20px">Login link:<a href="{login_link}">Click here</a></h3>
</div>

<div style="background-color: #fff; color: #000; padding-left: 20px; font-size: 24px; line-height: 10px;">
<p>Regards,<br />
<br />
{site_name} Team</p>
</div>
</div>';
			
			$html = str_replace('{user_name}', $post_data['first_name'], $html);
			$html = str_replace('{user_email}', $post_data['email'], $html);
			$html = str_replace('{password}', $post_data['password'], $html);
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
			$this->email->to($post_data['email']);
			$this->email->subject('New employee');
			$this->email->message($html);
			$this->email->send();
			/*send mail*/			
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],2101).'Data has successfully created.');
			redirect($this->data['_cancel']);
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'create';
		$this->load->view($this->_mainView,$this->data);
	}

    public function edit($id = NULL){
		if(!$id)
			redirect($this->data['_cancel']);
	
		$this->data['name'] = show_static_text($this->data['lang_id'],2570).'Edit';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['users'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->parent_id,'account_type'=>'A'),false,false,true);
		if(!$this->data['users']){
			redirect($this->data['_cancel']);
		}

	   	$this->db->order_by('name','asc');
        $this->data['countries_data'] = $this->comman_model->get('countries',false);

        $rules = $this->user_staff_model->update_athletes_rules ;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			
        	$post_data = $this->comman_model->array_from_post(array(
							'first_name','company_name','password','flash_notes',
							'phone','phone2','address','city','state','country','zip',
/*							'discount',*/
							));

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
			}
*/

			$post_data['account_type'] 	= 'A';
			$post_data['type']			= 'Client';

			$this->comman_model->save($this->_table_names,$post_data,$id);
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
		


	function _checkUser(){
		$redirect = false;
/*		echo $this->data['user_details']->account_type;
		die;
*/		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='S'){
				$redirect =true;
				//echo'asd';
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
		//die;
	}

	function checkPermissions($type= false){
		$redirect2 = 0;
		if($this->data['user_details']->account_type=='S'){
			$redirect2 = checkPermission('users_permission',array('user_id'=>$this->data['user_details']->id,'type'=>$type,'value'=>1));	
			if($redirect2==0){
				redirect($this->data['_user_link'].'/account');
			}		
		}
		else{
			redirect($this->data['_user_link'].'');
		}
	}

}
