<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_user extends Admin_Controller {
	public $_table_names = 'admin';
	public $_subView = 'admin/admin_user/';
	public $_redirect = '/admin_user';
	public $_msg_success = 'Employee has successfully created.';
	public $_msg_update = 'Employee has successfully updated.';
	public $_msg_delete = 'Employee has successfully deleted.';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Employee Management';
        $this->load->model('admin_employee_model');

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_employee==1){}
			else{
				$redirect = true;
			}
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}

        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}


	//  Landing page of admin section.
	function index(){
		$this->data['title'] = 'Employee | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['name'] = 'Employee';
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('default'=>0),false,false,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}


    public function create(){
		$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Create';
		$this->data['employee'] = $this->admin_employee_model->get_new();
        
        
        // Set up the form
        $rules = $this->admin_employee_model->create_rules;
        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
            $data =array();
        	$data = $this->comman_model->array_from_post(array(
								'username','email',
/*								'is_general','is_product','is_user','is_payment','is_membership',
								'is_content','is_place','is_ticket',*/
							));
			$data['password'] = md5($this->input->post('password'));
			$data['role'] = 'employee';
			$data['date'] = date('Y-m-d H:i:s');
			$data['created'] = time();
			$data['modified'] = time();
            
           	$id = $this->comman_model->save($this->_table_names,$data);
			$post_permission = $this->input->post('permission');
/*			echo '<pre>';
			print_r($post_permission);*/
			if($post_permission){
				foreach($post_permission as $key=>$value){
					if($value){
						$postPD = array(
										'value'			=> $value,
										'type'			=> $key,
										'user_id'		=> $id,
									//	'gym_id'		=> $this->data['user_details']->id
										);
						$this->db->insert('admin_permission',$postPD);
					}
				}
			}

//die;
			$email_data = $this->comman_model->get_by('email',array('id'=>9),false,false,true);
			$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
			$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

			$email_data->message = str_replace('{user_name}', $data['username'], $email_data->message);
			$email_data->message = str_replace('{user_email}', $data['email'], $email_data->message);
			$email_data->message = str_replace('{password}', $this->input->post('password'), $email_data->message);
			$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
			$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
			$email_data->message = str_replace('{login_link}', base_url().$this->data['admin_link'], $email_data->message);
			//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);
			//echo $email_data->message;die;
			//$your_message = 'Hello '.$this->input->post('username').',<br> Thank you for registration. Please here for verification '.base_url().'verify/user/'.$dynamic_code.'/'.md5($registerForm);
			$this->load->library('email');
			$config = array (
				  'mailtype' => 'html',
				  'charset'  => 'utf-8',
				  'priority' => '1'
				   );
			$this->email->initialize($config);
			$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
			$this->email->to($this->input->post('email'));
			$this->email->subject($email_data->subject);
			$this->email->message($email_data->message);
			$this->email->send();

			if(empty($this->data['categories']->id))
	            $this->session->set_flashdata('success',$this->_msg_success);
			else
	            $this->session->set_flashdata('success',$this->_msg_update);			
            
            redirect($this->data['_cancel']);
        }
        
		$this->data['subview'] = $this->_subView.'create';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	public function edit($id = NULL){
	    // Fetch a page or set a new one
	    if($id)
        {
            $this->data['employee'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'default'=>0), FALSE, FALSE, true);
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Edit';
           	if(!$this->data['employee']){
            redirect($this->data['_cancel']);
			}
        }
        else
        {
            redirect($this->data['_cancel']);
        }
        
        
        // Process the form
        if($this->input->post('operation')){
            $data =array();
        	$data = $this->comman_model->array_from_post(array(
								'is_general','is_product','is_user','is_payment','is_membership',
								'is_content','is_place','is_ticket',

								));
			$data['date'] = date('Y-m-d H:i:s');
			$data['created'] = time();
			$data['modified'] = time();          
			$this->comman_model->save($this->_table_names,$data,$id);

			$post_permission = $this->input->post('permission');
			$this->db->delete('admin_permission', array('user_id' => $id)); 
			if($post_permission){
				foreach($post_permission as $key=>$value){
					if($value){
						$postPD = array(
										'value'			=> $value,
										'type'			=> $key,
										'user_id'		=> $id,
//										'gym_id'		=> $this->data['user_details']->id
										);
						$this->db->insert('admin_permission',$postPD);
					}
				}
			}

			$this->session->set_flashdata('success',$this->_msg_update);			
            redirect($this->data['_cancel']);
		}
        
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
    

    public function _unique_email($str){
        
        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $categories = $this->comman_model->get('admin',false);        
        
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_email', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }

    public function _unique_user($str){
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current categories
        
        $id = $this->uri->segment(4);
        $this->db->where('username', $this->input->post('username'));
        !$id || $this->db->where('id !=', $id);
        $categories = $this->comman_model->get('admin',false);        
        
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_user', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }

	function delete($id = false){
		if(!$id){
            redirect($this->data['_cancel']);
		}
		$checkEmployee = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'default'=>0), FALSE, FALSE, true);
		if(!$checkEmployee){
			$this->session->set_flashdata('error','Sorry! You can not delete employee.'); 
            redirect($this->data['_cancel']);
		}
		$this->db->delete($this->_table_names,array('id'=>$id));
		$this->session->set_flashdata('success',$this->_msg_delete); 
		redirect($this->data['_cancel']);
	}
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */