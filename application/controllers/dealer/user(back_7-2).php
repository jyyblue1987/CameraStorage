<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends Frontend_Controller{	
	public $_redirect = '/dealer/user';
	public $_subView = 'ownner/client/';
	public $_table_names = 'users';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'People';
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
	//	$this->_checkPaidUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],1000).'Client';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('parent_id'=>$this->data['user_details']->id,'account_type'=>'A'),false,false,false);
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

		$total_camera = 0;
		if($this->data['user_details']->c_num>0){
			$use_camera = $this->comman_model->get_query('SELECT SUM(c_num)AS total_c FROM users WHERE parent_id='.$this->data['user_details']->id.' GROUP BY parent_id ',true);
			if($use_camera&&$use_camera->total_c>0){
				if($this->data['user_details']->c_num>$use_camera->total_c){
					$total_camera = $this->data['user_details']->c_num-$use_camera->total_c;
				}
			}

/*			$use_camera = count($this->comman_model->get_by('camera_free',array('dealer_id'=>$this->data['user_details']->id),false,false,false));
			if($this->data['user_details']->c_num>$use_camera){
				$total_camera = $this->data['user_details']->c_num-$use_camera;
			}*/
		}
		$this->data['total_camera'] = $total_camera;
        $rules = $this->user_staff_model->create_athletes_rules;
        $this->form_validation->set_rules($rules);
		$this->form_validation->set_message('is_unique','%s should be unique');
        // Process the form
        if($this->form_validation->run() == TRUE){
			
        	$post_data = $this->comman_model->array_from_post(array(
							'first_name','company_name','email','password','flash_notes',
							'phone','phone2','address','city','state','country','c_num',
/*							'discount',*/
							));

			$post_data['play_w_pay'] = 1;
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
			$post_data['created_by'] 	= 'Dealer';
			$post_data['account_type'] 	= 'A';
			$post_data['type']			= 'Client';
			$post_data['status'] 		= 1;
			$post_data['parent_id'] 	= $this->data['user_details']->id;

			$reg = $this->comman_model->save('users',$post_data);
/*			$this->comman_model->save('users_transaction',array('ownner_id'=>$this->data['user_details']->id,'user_id'=>$reg,'type'=>'add_athlete','amount'=>$this->data['user_details']->plan_member,'on_date'=>date('Y-m-d'),'on_datetime'=>date('y-m-d H:i:s')));
*/			//update credits point
/*			$this->db->where('id',$this->data['user_details']->id);
			$this->db->set('credits_point', 'ROUND(credits_point+'.$this->data['user_details']->plan_member.',2)', FALSE);
			$this->db->update('users');*/

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

		$this->data['users'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'parent_id'=>$this->data['user_details']->id,'account_type'=>'A'),false,false,true);
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
							'phone','phone2','address','city','state','country','play_w_pay',
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

			$post_data['play_w_pay'] = 1;
			$post_data['account_type'] 	= 'A';
			$post_data['type']			= 'Client';

			$this->comman_model->save('users',$post_data,$id);
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

	function set_free_camera(){
		$msge = array();
		$msge['status']= 'error';
		$msge['msg']= 'Please Login First!!';
		//$msg = 0;
		$id = $this->input->post('id');
		if($id){
			$checkUser = $this->comman_model->get_by($this->_table_names,array('parent_id'=>$this->data['user_details']->id,'id'=>$id,'account_type'=>'A'),false,false,true);
			if($checkUser){
				if($checkUser->is_f_c==0){
					//for update use class in this membership
					$this->db->where('id', $id);
					$this->db->set('is_f_c',1, true);
					$this->db->update('users');					
					$msge['status'] = 'ok';
					$msge['msg']= '';
					
				}
				else{
					$msge['msg']= 'You have already set!!';
				}
			}
			else{
				$msge['msg']= 'There is no client!!';
			}
		}
		else{
			$msge['msg']= 'There is no client!!';
		}
		echo json_encode($msge);
		//echo $msg;	
	}

	function _checkPaidUser(){
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	}


	function _checkPlan(){
		if($this->data['user_details']->plan_id!=0){
/*			echo 'Total: '.$this->data['user_details']->total_point;
			echo '<br>';
			echo 'use IN : '.$this->data['user_details']->credits_point+$this->data['user_details']->plan_coach;*/
			if($this->data['user_details']->total_point<($this->data['user_details']->credits_point+$this->data['user_details']->plan_member)){
				$this->session->set_flashdata('error','Enough Balance!!'); 
				redirect($this->data['_cancel']);
			}
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_cancel']);
		}

		if($this->data['user_details']->total_point>0){
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
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