<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Condition extends Frontend_Controller{	
	public $_redirect = '/dealer/account';

	public $_subView = 'ownner/';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['name'] = 'Dashboard';	
        $this->load->model(array('users_model','chat_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
        $detail = $this->session->all_userdata();
		$redirect = false;
		if(isset($this->data['user_details'])){	
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
		$this->data['_user_link'] = $this->data['lang_code'].'/dealer';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
	}

	function index(){
		//var_dump($this->session->all_userdata());
		$this->data['active'] = 'home';	
        $this->data['name'] = show_static_text($this->data['lang_id'],8000).'Terms and Conditions';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'dashboard/condition';	
		$this->load->view($this->_mainView,$this->data);
	}

	function panic_setting(){	
        $this->data['name'] = show_static_text($this->data['lang_id'],4500).'Panic Setting';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'Profile';	

        $rules = $this->users_model->panic_rules ;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post_data = $this->comman_model->array_from_post(array('p_name','p_email','p_desc'));
			$this->comman_model->save('users',$post_data,$this->data['user_details']->id);

			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],211));
			redirect($this->data['_cancel'].'/panic_setting');
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'profile/edit_panic';	
		$this->load->view($this->_mainView,$this->data);
	}

	function edit_profile(){	
		$this->load->library('image_lib');

        $this->data['name'] = show_static_text($this->data['lang_id'],45);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'Profile';	

	   	$this->db->order_by('name','asc');
        $this->data['countries_data'] = $this->comman_model->get('countries',false);

		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		$this->form_validation->set_message('is_unique',show_static_text($this->data['lang_id'],220));
		$this->form_validation->set_message('integer',show_static_text($this->data['lang_id'],221));
		$this->form_validation->set_message('required', show_static_text($this->data['lang_id'],219));


        $rules = $this->users_model->update_customer_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post_data = $this->comman_model->array_from_post(array('first_name','last_name','address','city','phone','country','state'));
        	$post_data['username'] = $post_data['first_name'].' '.$post_data['last_name'];
			if (!empty($_FILES['image']['name'])){
				$result =$this->comman_model->do_upload('image','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$post_data['image'] = $result[1];
				}
				$this->image_lib->clear();
			}	
			else{
				$post_data['image'] = $this->data['user_details']->image;
			}

			//logo
			if (!empty($_FILES['image2']['name'])){
				$result =$this->comman_model->do_upload('image2','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$post_data['logo'] = $result[1];
				}

				$this->image_lib->clear();
			}	
			else{
				$post_data['logo'] = $this->data['user_details']->logo;
			}
/*			echo '<pre>';
			print_r($post_data);
			die;*/
			$this->comman_model->save('users',$post_data,$this->data['user_details']->id);

			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],211));
			redirect($this->data['_cancel'].'/edit_profile');
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'profile/edit';	
		$this->load->view($this->_mainView,$this->data);
	}

	function account_info(){	
        $this->data['name'] = show_static_text($this->data['lang_id'],272);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'GYM';	
		$this->data['country_data'] = $this->custom_model->get_country_name();

		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		$this->form_validation->set_message('is_unique',show_static_text($this->data['lang_id'],220));
		$this->form_validation->set_message('integer',show_static_text($this->data['lang_id'],221));
		$this->form_validation->set_message('required', show_static_text($this->data['lang_id'],219));

        $rules = $this->users_model->update_account_info_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post_data = $this->comman_model->array_from_post(array('bank_name','bank_account'));
//			$post_data = $this->comman_model->array_from_post(array('api_username','api_password','api_signature','bank_name','bank_account'));

			$this->comman_model->save('users',$post_data,$this->data['user_details']->id);

			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],211));
			redirect($this->data['_cancel'].'/account_info');
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'profile/edit_paypal';	
		$this->load->view($this->_mainView,$this->data);
	}
	
		
    public function _unique_email($str){
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('id !=', $this->data['user_details']->id);        
        $categories = $this->comman_model->get('users',true);        
        if(count($categories)){
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }

    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current categories
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('code'));
        !$id || $this->db->where('id !=', $id);        
        $categories = $this->comman_model->get('products',false);        
	//	echo $this->db->last_query();die;
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }
    
	function dashboard(){
		$this->data['active'] = 'home';	
		$this->data['title'] = $this->data['settings']['site_name'];
		$this->data['active_sub'] = '';	
		//$this->data['login'] = $this->session->all_userdata();		
        $this->data['subview'] = $this->_subView.'dashboard';	
		$this->load->view($this->_mainView,$this->data);
	}

	public function change_password(){

        $this->data['name'] = show_static_text($this->data['lang_id'],50);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'Change Password';
        $this->form_validation->set_error_delimiters('<div class="warnings"><p>', '</p></div>');

//		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		$rules = $this->users_model->rules_password;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('required', show_static_text($this->data['lang_id'],219));
		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		if ($this->form_validation->run()==TRUE){
			$this->comman_model->save('users',array('password'=>$this->input->post('password')),$this->data['user_details']->id);
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],214)); 
			redirect($this->data['_cancel'].'/change_password');
		}
        $this->data['edit_data'] = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);

        $this->data['subview'] = $this->_subView.'profile/password';	
		$this->load->view($this->_mainView,$this->data);
	}

	
    public function _check_old_password($str){
		//$login = $this->session->all_userdata();
		$check = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->id,'password'=>$this->input->post('old_password')),false,false,true);
        if(!count($check)){
            $this->form_validation->set_message('_check_old_password',show_static_text($this->data['lang_id'],212));
            return FALSE;                    
        }
        return TRUE;
    }
	
	function logout(){
        $this->session->sess_destroy();
		redirect($this->data['lang_code'].'/front/');
	}
	
	function update_online(){
		$output['status'] ='ok';
		$this->chat_model->update($this->data['user_details']->id);
		echo json_encode($output);
	}

	function userDetail(){
		$output['status'] ='ok';
		$last_now = date('Y-m-t');
//		$last_now = '2016-08-31';
/*		echo '<br>';
		echo 'Now:'.date('Y-m-d');
		echo '<br>';*/
		$now = strtotime(date('Y-m-d'));
		$all_user = $this->comman_model->get_by('users',array('account_type'=>'S'),false,false,false);
		if($all_user){
			foreach($all_user as $set_u){
				if($set_u->plan_id!=0){
					if($set_u->update_point!=''){
						$total = round($set_u->total_point-$set_u->credits_point,2);
						$c	= 0;
//						echo $set_u->update_point;
						$userD = strtotime($set_u->update_point);
						if($now>=$userD){
							$this->db->where('id',$set_u->id);
							$this->db->set('total_point', $total,true);
							$this->db->set('credits_point', $c,true);
							$this->db->set('update_point',$last_now,true);
							$this->db->update('users');
						}
					}
					else{
						$this->db->where('id',$set_u->id);
						$this->db->set('update_point', $last_now, true);
						$this->db->update('users');
				//		echo 'Yes';
					}
				}
				//echo '<br>'.$set_u->id;
			}
		}

		//$this->chat_model->update($this->data['user_details']->id);
		$output['requestCount'] = count($this->comman_model->get_by('user_membership_history',array('is_read'=>0,'ownner_id'=>$this->data['user_details']->id),false,false,false));		
		echo json_encode($output);
	}

	function ajaxChart(){
		$table_name= 'camera_payment';
		$id = $this->input->post('type');
//		$where = 'user_id ='.$this->data['user_details']->id;
		$where1  = "on_date > '".date('Y-m-d', strtotime('-15 day',time()))."'";

		$array = array();
		if($id=='month'){
			$where = "payment = 1 and owner_id =".$this->data['user_details']->id;
			$query = "SELECT on_date as on_date, SUM(amount) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE ".$where." GROUP BY Y,m ORDER BY on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->m)){
						if($set_data->m==1){
							$array['Jan'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==2){
							$array['Feb'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==3){
							$array['Mar'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==4){
							$array['Apr'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==5){
							$array['May'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==6){
							$array['Jun'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==7){
							$array['Jul'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==8){
							$array['Aug'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==9){
							$array['Sep'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==10){
							$array['Oct'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==11){
							$array['Nov'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==12){
							$array['Dec'] =(int)$set_data->problem_count;
						}
					}				
				}
			}
		}
		else if($id=='year'){
			$where = "payment = 1 and owner_id =".$this->data['user_details']->id;
			$query = "SELECT on_date as on_date,  SUM(amount) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE ".$where."  GROUP BY Y ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->Y)){
						$array[$set_data->Y] =(int)$set_data->problem_count;
					}				
				}
			}
		}
		else{
			$where = $where1." and payment = 1 and owner_id =".$this->data['user_details']->id;
			$query = "SELECT on_date as on_date, SUM(amount) as user_orders_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE $where GROUP BY Y,m,d ORDER BY on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			//echo $this->db->last_query();
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->on_date)){
						$array[$set_data->on_date] =(int)$set_data->user_orders_count;
					}				
				}
			}
		}
		if(empty($array)){
			$array[date('Y-m-d')] =0;
		}

	//	$array = array('05-8-2016'=>4,'6-8-2016'=>6,'7-8-2016'=>2,'8-8-2016'=>5,'9-8-2016'=>4);
		echo json_encode($array);	
	}

	function setLang(){
		$output['status'] ='error';
		$id= $this->input->post('id');
		if (!$this->input->is_ajax_request()) { exit('no valid req.'); }
		if($id){
			$output['status'] ='ok';
			$this->db->where('id',$this->data['user_details']->id);
			$this->db->set('lang_id', $id,true);
			$this->db->update('users');
		}
		echo json_encode($output);
	}
	
}


/* End of file user.php */
/* Location: ./application/controllers/user.php */