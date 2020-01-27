<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends Admin_Controller {
	public $_table_names = 'newsletters';
	public $_subView = 'admin/newsletters/';
	public $_redirect = 'admin/newsletter';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'merchant';
    }
	

	//  Landing page of admin section.
	function index(){
		$this->data['title'] = 'User Subscribe | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'User Subscribe';
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

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
				//$registerForm = $this->comman_model->save($this->_table_names,$post_data);

				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['site_email']->value, $this->data['settings']['site_name']);
				$this->email->to($this->input->post('email'));
				$this->email->subject($this->input->post('subject'));
				$this->email->message($this->input->post('message'));
				$this->email->send();
				$this->session->set_flashdata('success', 'Mail has successfully sent.');
				redirect($this->_redirect);
			}
		}
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = $this->_subView.'mail_form';        
        $this->load->view('admin/_layout_main',$this->data);       
    }

	function get_status(){
		$id = $this->input->post('id');
		$post_data = array('status'=>$this->input->post('status'));
		$result = $this->comman_model->save($this->_table_names,$post_data,$id);
	}
	

	function delete($id = false){
		if(!$id){
			redirect($this->_redirect);
		}

		//$this->comman_model->update('categories',array('parent_id'=>0),array('parent_id'=>$id));
		//$this->comman_model->delete_by_id('files',array('category_id'=>$id));
/*		$this->comman_model->delete_by_id('likes',array('user_id'=>$id));
		$this->comman_model->delete_by_id('comments',array('user_id'=>$id));
		$this->comman_model->delete_by_id('forums',array('user_id'=>$id));*/
		$this->comman_model->delete_by_id($this->_table_names,array('id'=>$id));

		$this->session->set_flashdata('success','Merchant has successfully deleted.'); 
		redirect($this->_redirect);		

	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */