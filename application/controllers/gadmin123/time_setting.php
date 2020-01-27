<?php
class Time_setting extends Admin_Controller{
	public $_table_names = 'problems_time_setting';
	public $_subView = 'admin/time_setting/';
	public $_redirect = '/time_setting';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Product Management';
        // Get language for content id to show in administration

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_product==1){}
			else{
				$redirect = true;
			}
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}
	}
    
	public function index(){
		$all_session =$this->session->all_userdata();
	    // Fetch a page or set a new one
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],2540).'Time Setting';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['products']  = $this->comman_model->get_by($this->_table_names,array('id'=>1),false,false,true);
        
        $this->form_validation->set_rules('is_mon','Monday','trim');
/*        $this->form_validation->set_rules('bingo_price','Slot Price','numeric|trim|required');
        $this->form_validation->set_rules('bingo_price','Bingo Price','numeric|trim|required');*/

/*	    $this->data['time_data'] = $this->custom_model->get_time_hour_with_AP();
	    $this->data['time_data'] = $this->custom_model->get_time_hour_with_AP();*/

        // Process the form
        if($this->form_validation->run() == TRUE){
			$day = date('l');
            $data =array();
			$post1 =array('is_mon','is_tue','is_wed','is_thr','is_fri','is_sat','is_sun','start_time','end_time',);

        	$data = $this->comman_model->array_from_post($post1);

if($day=='Monday'){
	$data['is_mon']=$this->data['products']->is_mon;
}
if($day=='Tuesday'){
	$data['is_tue']=$this->data['products']->is_tue;
}
if($day=='Wednesday'){
	$data['is_wed']=$this->data['products']->is_wed;
}
if($day=='Thrusday'){
	$data['is_thr']=$this->data['products']->is_thr;
}
if($day=='Friday'){
	$data['is_fri']=$this->data['products']->is_fri;
}
if($day=='Saturday'){
	$data['is_sat']=$this->data['products']->is_sat;
}
if($day=='Sunday'){
	$data['is_sun']=$this->data['products']->is_sun;
}

            $id = $this->comman_model->save($this->_table_names,$data,1);



			if(empty($this->data['products']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            
            redirect($this->data['_cancel']);
        }

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
        

}