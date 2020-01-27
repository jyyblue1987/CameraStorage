<?php
class I_account extends Admin_Controller{
	public $_table_names = 'ownner_m_history';

	public $_mainView = 'admin/_layout_main';
	public $_subView = 'admin/i_account/';

	public $_redirect = '/i_account';

	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Income Managment';
//        $this->load->model(array('product_model'));
        // Get language for content id to show in administration

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
		$this->checkPermissions('account');
	}
    	
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1700).'Account';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$query = "SELECT SUM(amount) as amount,a_bank_account as name FROM $this->_table_names WHERE status='Confirm' and payment_type='Bank Deposit' GROUP BY  a_bank_account";
		$this->data['all_data'] = $this->comman_model->get_query($query,false);
/*		echo '<pre>';
		print_r($this->data['all_data']);
		die;*/
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);


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
			redirect($this->data['admin_link'].'');
		}		
	}
	
}