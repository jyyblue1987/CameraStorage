<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends Admin_Controller {
	public $_table_names = 'admin_support';
	public $_subView = 'admin/support/';
	public $_redirect = '/support';
	public function __construct(){
    	parent::__construct();
		$this->checkPermissions('support');

		$this->data['active'] = 'Content Management';
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
	}
	

	//  Landing page of admin section.
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'Support';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$support = $this->comman_model->get_by($this->_table_names,array('id'=>1),false,false,true);
		if($support){
			$this->data['support_data'] =$support;			
		}
		$rules = array(
			'support_hour' 	=> array('field'=>'support_hour', 'label'=>'support hour', 'rules'=>'trim'),
			'company_name' 	=> array('field'=>'company_name', 'label'=>'company name', 'rules'=>'trim'),
			'support_num' 	=> array('field'=>'support_num', 'label'=>'support number', 'rules'=>'trim'),
			'sales_num' 	=> array('field'=>'sales_num', 'label'=>'sales number', 'rules'=>'trim'),
			'business_hour' => array('field'=>'business_hour', 'label'=>'business hour', 'rules'=>'trim'),
			'website' 		=> array('field'=>'website', 'label'=>'website', 'rules'=>'trim'),
			'term_desc'		=> array('field'=>'term_desc', 'label'=>'term_desc', 'rules'=>'trim'),
			'notes'			=> array('field'=>'notes', 'label'=>'notes', 'rules'=>'trim'),

			'email' 		=> array('field'=>'email', 'label'=>'email', 'rules'=>'trim'),		
			'contact_name' 	=> array('field'=>'contact_name', 'label'=>'contact_name', 'rules'=>'trim'),
			
		//        'contact_name' 	=> array('field'=>'contact_name', 'label'=>'contact_name', 'rules'=>'trim'),
		//		'zip' 			=> array('field'=>'zip','label'=>'Post Code','rules'=>'trim|required'),
		
		);

        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){
        	$post_data = $this->comman_model->array_from_post(array(
								'contact_name','company_name','website','term_desc','support_num','sales_num','support_hour','business_hour','email','notes',
							));



			$reg = $this->comman_model->save($this->_table_names,$post_data,$support->id);
			redirect($this->data['_cancel']);			
		}
        $this->data['subview'] = $this->_subView.'edit';
		$this->load->view('admin/_layout_main',$this->data);
	}
	
  	function checkPermissions($type= false,$is_redirect=false){
		$redirect = 0;
		if($this->data['admin_details']->default=='0'){
			$redirect = checkPermission('admin_permission',array('user_id'=>$this->data['admin_details']->id,'type'=>$type,'value'=>1));	
		}
		else{
			$redirect = 1;
		}
		
		if($redirect==0){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			if($redirect){
				redirect($redirect);
			}
			redirect($this->data['admin_link'].'/dashboard');
		}		
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */