<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends Frontend_Controller{	
	public $_redirect = '/member/employee';

	public $_subView = 'user/employee/';
	public $_table_names = 'users';
	public $_mainView = 'user/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'People';
        $this->load->model(array('user_staff_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/member';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';		
		$this->_checkUser();
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
		$this->form_validation->set_message('is_unique','%s should be unique');
        // Process the form
        if($this->form_validation->run() == TRUE){
        	$post_data = $this->comman_model->array_from_post(array(
							'first_name','email','password',
							'phone','address',
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

			
			//update credits point
						
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


	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='A'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */