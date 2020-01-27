<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends Frontend_Controller{	
	public $_subView = 'user/';
	public $_redirect = '/customer';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['name'] = 'Dashboard';	
        $this->load->model(array('users_model','address_model','feedback_model'));
		$this->load->helper(array('smiley'));
		$this->load->library(array('table'));
		
        $detail = $this->session->all_userdata();
		$redirect = false;
		if(isset($detail['user_session'])){	
			$this->data['user_account'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
			if(!empty($this->data['user_account'])){
				if($this->data['user_account']->account_type!='U'){
					$redirect =true;
				}
			}
			else{
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

	function index(){
		//var_dump($this->session->all_userdata());
		$this->data['active'] = 'home';	
        $this->data['name'] = show_static_text($this->data['lang_id'],80);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		//$this->data['login'] = $this->session->all_userdata();
		
        $this->data['subview'] = 'user/dashboard';	
		$this->load->view('user/_layout_main',$this->data);
	}

	function information(){	
        $this->data['name'] = show_static_text($this->data['lang_id'],4500).'Information';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'information';	
		$this->data['page'] = $this->comman_model->get_lang('content',$this->data['lang_id'],NULL,array('id'=>1),'content_id',true);
        $this->data['subview'] = 'user/information';	
		$this->load->view('user/_layout_main',$this->data);
	}
	
	function edit_profile(){	
        $this->data['name'] = show_static_text($this->data['lang_id'],45);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['active'] = 'Profile';	
        $this->form_validation->set_error_delimiters('<div class="warnings"><p>', '</p></div>');
		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		$this->form_validation->set_message('is_unique',show_static_text($this->data['lang_id'],220));
		$this->form_validation->set_message('integer',show_static_text($this->data['lang_id'],221));
		$this->form_validation->set_message('required', show_static_text($this->data['lang_id'],219));

        $rules = $this->users_model->update_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
			$post_data = $this->comman_model->array_from_post(array('first_name','last_name','phone'));
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
				$post_data['image'] = $this->data['user_account']->image;
			}

			$this->comman_model->save('users',$post_data,$this->data['user_account']->id);

			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],211));
			redirect($this->data['lang_code'].$this->_redirect.'/edit_profile');
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = 'user/edit_profile';	
		$this->load->view('user/_layout_main',$this->data);
	}
		
	function chat($id=false){
		$this->data['active'] = 'Chat';	
		$this->data['title'] = $this->data['settings']['site_name'];

		$image_array = get_clickable_smileys(base_url().'assets/plugins/chat/images/smileys/', 'textb');
		$col_array = $this->table->make_columns($image_array, 8);
		$this->data['smiley_table'] = $this->table->generate($col_array);
		
		$this->data['new_data'] = $this->comman_model->get_by('users',array('enabled'=>1),false,array('first_name'=>'asc','last_name'=>'asc'),false);
		if($id){
			if($id=='admin'){
				$this->comman_model->update_by('chat_messages',array('read'=>1),array('recipient_id'=>$this->data['user_details']->id,'user_id'=>0));
				$this->data['subview'] = $this->_subView.'/chat/view_admin';	
			}
			else{
				$user_chat_data = $this->comman_model->get_by('users',array('id'=>$id),false,false,true);
				if(!$user_chat_data){
					//echo 'no girl id ';
					redirect($this->data['lang_code'].$this->_redirect);
				}
				$this->comman_model->update_by('chat_messages',array('read'=>1),array('recipient_id'=>$this->data['user_details']->id,'user_id'=>$id));
				$this->data['user_chat_data'] = $user_chat_data;
				$this->data['subview'] = $this->_subView.'/chat/view';	
			}
		}
		else{
       		//echo $this->db->last_query();die;
	       $this->data['subview'] = $this->_subView.'/chat/index';	
		}
		$this->load->view($this->_subView.'/_layout_main',$this->data);
	}
	
    public function _unique_email($str){
        $this->db->where('email', $this->input->post('email'));
        $this->db->where('id !=', $this->data['user_account']->id);        
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
        $this->data['subview'] = 'user/dashboard';	
		$this->load->view('user/_layout_main',$this->data);
	}

	public function change_password(){

        $this->data['name'] = show_static_text($this->data['lang_id'],50);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['active']= 'Change Password';
        $this->form_validation->set_error_delimiters('<div class="warnings"><p>', '</p></div>');
		$rules = $this->users_model->rules_password;
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_message('matches',show_static_text($this->data['lang_id'],213));
		if ($this->form_validation->run()==TRUE){
			$this->comman_model->save('users',array('password'=>$this->input->post('password')),$this->data['user_details']->id);
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],214)); 
			redirect($this->data['lang_code'].$this->_redirect.'/change_password');
		}
        $this->data['edit_data'] = $this->comman_model->get_by('users',array('id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);

        $this->data['subview'] = 'user/change_password';	
		$this->load->view('user/_layout_main',$this->data);
	}

    public function _check_old_password($str){
		$login = $this->session->all_userdata();
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
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */