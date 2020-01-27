<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends Admin_Controller {
	public $_table_names = 'user_orders';
	public $_subView = 'admin/reports/';
	public $_redirect = '/report';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'Order Management';
        $this->load->model(array('order_model'));
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
    }
	

	//  Landing page of admin section.
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],173);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function best_sellers(){
		$start	= $this->input->post('start');
		$end	= $this->input->post('end');
		$this->data['best_sellers']	= $this->order_model->get_best_sellers($start, $end);
/*		echo '<pre>';
		print_r($data['best_sellers']);
		die;*/
		$this->load->view($this->_subView.'best_sellers', $this->data);	
	}
	
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */