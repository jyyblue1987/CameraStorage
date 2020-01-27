<?php
class Voucher extends Admin_Controller{
	public $_table_names = 'coupons';
	public $_subView = 'admin/coupons/';
	public $_redirect = 'admin/voucher';
    public $_current_revision_id;
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'User Management';
        $this->load->model(array('coupon_model','comman_model'));
        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
	}
    
	function index(){
		$this->data['name'] = 'Coupon Transection History';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->db->order_by('id','desc');	
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('is_public'=>0),false,false,false);
        $this->data['subview'] = $this->_subView.'index_pagination';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function public_voucher(){
		$this->data['name'] = 'Public Coupon';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['login'] = $this->session->all_userdata();
		$this->data['table'] = true;

		$this->db->order_by('id','desc');	
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('is_public'=>1),false,false,false);
        $this->data['subview'] = $this->_subView.'index_public_voucher';	
		$this->load->view('admin/_layout_main',$this->data);

	}
	


	public function edit1($id = NULL){
		$all_session =$this->session->all_userdata();
	    // Fetch a page or set a new one		
	    if($id)
        {
            $this->data['products'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'is_public'=>1), FALSE, FALSE, TRUE);
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Edit Code';
            if(count($this->data['products'])==0){
				redirect($this->_redirect.'/public_voucher');
			} 
        }
        else
        {
			$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Create Code';
            $this->data['products'] = $this->coupon_model->get_new();
        }
        

        
        // Set up the form
        $rules = $this->coupon_model->rules;
        $this->form_validation->set_rules($this->coupon_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
        	$data = $this->coupon_model->array_from_post(array('code','user_id','end_date','reduction_amount'));
        	$data['is_public'] = 1;

            $id = $this->comman_model->save($this->_table_names,$data,$id);

			if(empty($this->data['products']->id)){
	            $this->session->set_flashdata('success','Voucher has successfully created.');
			}
			else
	            $this->session->set_flashdata('success','Voucher has successfully updated.');			
            
            redirect($this->_redirect.'/public_voucher');
        }
        
		$this->data['subview'] = $this->_subView.'edit1';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	public function edit($id = NULL){
		$all_session =$this->session->all_userdata();
	    // Fetch a page or set a new one		
	    if($id)
        {
            $this->data['products'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'is_public'=>0), FALSE, FALSE, TRUE);
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Edit Code';
            if(count($this->data['products'])==0){
				redirect($this->_redirect);
			} 
        }
        else
        {
			$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Create Code';
            $this->data['products'] = $this->coupon_model->get_new();
        }
        

        $this->data['user_data'] = $this->comman_model->get_by('users',array('account_type'=>'B','confirm'=>'confirm','enabled'=>1),false,false,false);
        
        // Set up the form
        $rules = $this->coupon_model->rules;
        $this->form_validation->set_rules($this->coupon_model->get_all_rules());

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
        	$data = $this->coupon_model->array_from_post(array('code','user_id','end_date','reduction_amount'));
            if($id == NULL){
                $data['remaining'] = $data['reduction_amount'];
			}

            $id = $this->comman_model->save($this->_table_names,$data,$id);

			if(empty($this->data['products']->id)){
				$this->send_mail($id,false);
	            $this->session->set_flashdata('success','Voucher has successfully created.');
			}
			else
	            $this->session->set_flashdata('success','Voucher has successfully updated.');			
            
            redirect($this->_redirect);
        }
        
        // Load the view
/*		echo '<pre>';
		print_r($this->data);
		die;
*/
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
    public function user_mail($id){
		if(!$id){
            redirect($this->_redirect.'/public_voucher');
		}
		$product = $this->comman_model->get_by('coupons',array('id'=>$id,'is_public'=>1),false,false,true);
		if(!$product){
            redirect($this->_redirect.'/public_voucher');
		}
		$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Send Mail';

		$email_data = $this->comman_model->get_by('email',array('id'=>8),false,false,true);						
		$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
		$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);

		$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
		$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
		$email_data->message = str_replace('{expire}', $product->end_date, $email_data->message);
		$email_data->message = str_replace('{coupon_code}', $product->code, $email_data->message);
		$email_data->message = str_replace('{link}', base_url().'', $email_data->message);

		$this->data['news']= new stdClass;
		$this->data['news']->subject = $email_data->subject;
		$this->data['news']->message = $email_data->message;
        // Set up the form
        if($this->input->post('operation')){            
            $data =array();
        	$data = $this->comman_model->array_from_post(array('subject','desc'));
			$user_email = $this->input->post('email');
			//send mail
			$this->load->library('email');
			$config = array (
				  'mailtype' => 'html',
				  'charset'  => 'utf-8',
				  'priority' => '1'
				   );
			$this->email->initialize($config);
			$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
			$this->email->to($user_email);
			$this->email->subject($data['subject']);
			$this->email->message($data['desc']);
			if($this->email->send()){
	            $this->session->set_flashdata('success','Voucher has successfully sent.');
			}
			else{
	            $this->session->set_flashdata('error','There is some problem to send.');			
			}
            redirect($this->_redirect.'/public_voucher');
        }
        
        // Load the view
		$this->data['subview'] = $this->_subView.'mail_form';
        $this->load->view('admin/_layout_main', $this->data);	
	}

	function send_mail($id=false,$redirect=false){
		if(!$id){
			redirect($this->_redirect);
		}
		$product = $this->comman_model->get_by('coupons',array('id'=>$id),false,false,true);
		if($product){
			$user = $this->comman_model->get_by('users',array('id'=>$product->user_id),false,false,true);
			if($user){
				$email_data = $this->comman_model->get_by('email',array('id'=>3),false,false,true);						

				$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
				$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);
	
				$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
				$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
				$email_data->message = str_replace('{user_name}', $user->first_name.' '.$user->last_name, $email_data->message);
				$email_data->message = str_replace('{expire}', $product->end_date, $email_data->message);
				$email_data->message = str_replace('{coupon_code}', $product->code, $email_data->message);
				$email_data->message = str_replace('{link}', base_url().'', $email_data->message);
				//echo $email_data->message; die;
				//$email_data-> = str_replace('{site_email}', $this->data['site_name']->value, $email_data->);
	
				//$your_message = 'Hello '.$this->input->post('username').',<br> Thank you for registration. Please here for verification '.base_url().'verify/user/'.$dynamic_code.'/'.md5($registerForm);
				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
				$this->email->to($user->email);
				$this->email->subject($email_data->subject);
				$this->email->message($email_data->message);
				$this->email->send();	
				if($redirect){
					$this->session->set_flashdata('success', 'Mail has successfully Sent.');
				}
			}
			else{
					$this->session->set_flashdata('error', 'There is no user.');
			}
		}
		else{
			if($redirect)
					$this->session->set_flashdata('error', 'There is no coupon.');
		}
		if($redirect){
			redirect($this->_redirect);
		}
		else{
			return true;
		}
		return true;
	}

    
    public function delete($id){       
		$this->coupon_model->delete($id);
        redirect($this->_redirect);
	}
    
    public function _unique_slug($str){
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current categories
        
        $id = $this->uri->segment(4);
        $this->db->where('code', $this->input->post('code'));
        !$id || $this->db->where('id !=', $id);        
        $categories = $this->comman_model->get($this->_table_names,false);        
	//	echo $this->db->last_query();die;
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
    }        
}