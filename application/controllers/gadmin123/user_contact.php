<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_contact extends Admin_Controller {
	public $_table_names = 'user_contact';
	public $_subView = 'admin/user/';
	public $_redirect = '/userlist';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'User Management';
        $this->load->model(array('partner_model'));
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();

		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_user==1){}
			else{
				$redirect = true;
			}
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}
	}
	

	//  Landing page of admin section.
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],178);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type !='=>"R"),false,false,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function set_user($id){
		if(!$id)
			redirect($this->data['_cancel']);
			$this->comman_model->save($this->_table_names,array('account_type'=>'B','confirm'=>'confirm'),$id);
			redirect($this->data['_cancel']);		
	}

	function buyer(){
		$this->data['title'] = 'Buyer | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['name'] = 'Buyer';
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function reseller(){
		$this->data['title'] = 'Partner | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['name'] = 'Partner';
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>"P"),false,false,false);
        $this->data['subview'] = $this->_subView.'index_seller';	
		$this->load->view('admin/_layout_main',$this->data);
	}


	function add(){	
		$image = NULL;
		$this->data['name'] = 'Create User';
		$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];

		$rules = $this->admin_model->user_rules;
		$this->form_validation->set_rules($rules);
		if ($this->input->post('operation')){
			if ($this->form_validation->run() == FALSE){}
			else{
				//upload photo
				$post_data= $this->comman_model->array_from_post(array('username','email','password'));
				$post_data['created_by'] = 'admin';
				$post_data['user_type'] = 'free_user';
				$post_data['confirm'] = 'confirm';
				
				if(!empty($_FILES['photo']['name'])){
					//echo $_FILES['photo'.$i]['name'];
					$result =$this->comman_model->do_upload('photo','./assets/uploads/users');
					if($result[0]=='error'){
						$this->session->set_flashdata('error',$result[1]); 
						redirect('admin/users/add');
					}
					else if($result[0]=='success'){
						$image = $result[1];
					}
				}			

				$post_data['image']= $image;
				$registerForm = $this->comman_model->save($this->_table_names,$post_data);
				$this->session->set_flashdata('success', 'User has successfully created.');
				redirect($this->data['_cancel']);
			}
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'add';
		$this->load->view('admin/_layout_main',$this->data);
	}

    public function _unique_email($str){
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current categories
        
        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $categories = $this->comman_model->get('users',false);        
        
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }

    public function edit($id = NULL){	
		$all_session =$this->session->all_userdata();
	    // Fetch a page or set a new one
	    if($id)
        {
            $this->data['partners'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, true);
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Edit Partner';
            count($this->data['partners']) || $this->data['errors'][] = 'User could not be found';
        }
        else
        {
			$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Product Partner';
            $this->data['partners'] = $this->partner_model->get_new();
        }
        
        // Set up the form
        $rules = $this->partner_model->rules;
        $this->form_validation->set_rules($this->partner_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
        	$data = $this->partner_model->array_from_post(array('first_name','last_name','email','password','dob','country','phone','address'));

			

			$data['username'] = $this->input->post('first_name').' '.$this->input->post('last_name');

            if($id == NULL){
                $data['created_by'] = 'admin';
                $data['confirm'] = 'confirm';
                $data['account_type'] = 'P';
                $data['status'] = 1;
			}
			else{
                $data['modified'] = time();
			}
			//file1
			if (!empty($_FILES['logo']['name'])){					
				$result =$this->comman_model->do_upload('logo','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
				}
				else if($result[0]=='success'){
					$data['image'] = $result[1];
				}
			}	
			else{
				if($id != NULL)
					$data['image'] = $this->data['partners']->image;
			}

            $id = $this->comman_model->save($this->_table_names,$data,$id);

			if(empty($this->data['partner']->id)){
	            $this->session->set_flashdata('success','Partner has successfully created.');
			}
			else
	            $this->session->set_flashdata('success','Partner has successfully updated.');			
            
            redirect($this->data['_cancel'].'/edit/'.$id);
        }
        
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}

	function edit1($id= false){
		$this->data['name'] = 'Edit';	
        $this->data['title'] ='Edit | '.$this->data['settings']['site_name'];
        
        $edit_data = $this->comman_model->get_by($this->_table_names,array('id'=>$id),FALSE,FALSE,TRUE);

		$this->form_validation->set_rules('username', 'Username', 'trim|required|');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
        if($this->form_validation->run()==TRUE){
			if (!empty($_FILES['photo']['name'])){					
				$result =$this->comman_model->do_upload('photo','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
					redirect($this->data['_cancel'].'/edit/'.$id);
				}
				else if($result[0]=='success'){
					$image = $result[1];
				}
			}	
			else{
				$image = $edit_data->image;
			}

            $post_data =$this->comman_model->array_from_post(array('username','password')); 
			$post_data['image']= $image;
            $this->comman_model->save($this->_table_names,$post_data,$id);
            $this->session->set_flashdata('success','User has successfully updated.');
            redirect($this->data['_cancel']);
        }
        
        $this->data['edit_data'] =$edit_data;
		$this->data['categories'] = $this->comman_model->get_by('categories',array('parent_id'=>0),false,false,false);		
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = $this->_subView.'edit';        
        $this->load->view('admin/_layout_main',$this->data);       
    }	

	function get_comfirm($id){
		if(!$id){
			redirect($this->data['_cancel'].'/reseller');
		}
		
		$result = $this->comman_model->save($this->_table_names,array('admin_confirm'=>1),$id);
		redirect($this->data['_cancel'].'/reseller');
	}

	function get_status(){
		$id = $this->input->post('id');
		$post_data = array('status'=>$this->input->post('status'));
		$result = $this->comman_model->save($this->_table_names,$post_data,$id);
	}

	

	function delete($id = false){
		if(!$id){
			redirect($this->data['_cancel']);
		}

		//$this->comman_model->update('categories',array('parent_id'=>0),array('parent_id'=>$id));
		$this->comman_model->delete_by_id('user_history',array('user_id'=>$id));
		$this->comman_model->delete_by_id('user_orders',array('user_id'=>$id));
		$this->comman_model->delete_by_id('user_order_shipping_add',array('user_id'=>$id));
		$this->comman_model->delete_by_id('stores',array('user_id'=>$id));
		$this->comman_model->delete_by_id($this->_table_names,array('id'=>$id));

		$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],297)); 
		redirect($this->data['_cancel']);		

	}
	function send_mail(){		
		$this->data['name'] = 'Send Mail';	
        $this->data['title'] ='Send Mail | '.$this->data['settings']['site_name'];        

		//$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        if($this->form_validation->run()==TRUE){
	        if ($this->input->post('operation')){
				$post_data= $this->comman_model->array_from_post(array('subject','message'));
				$post_data['email'] = serialize($this->input->post('email'));

				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
				$this->email->to($this->input->post('email'));
				$this->email->subject($this->input->post('subject'));
				$this->email->message($this->input->post('message'));
				$this->email->send();
				$this->session->set_flashdata('success', 'Mail has successfully sent.');
				redirect($this->data['_cancel']);
			}
		}
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = $this->_subView.'mail_form';        
        $this->load->view('admin/_layout_main',$this->data);       
    }

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */