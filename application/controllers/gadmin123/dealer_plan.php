<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealer_plan extends Admin_Controller {
	public $_table_names = 'plans_d';
	public $_subView = 'admin/dealers_plan/';
	public $_redirect = '/dealer_plan';
	public $_membership_table = 'memberships';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'User Management';
        $this->load->model(array('plan_model','membership_model'));
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
		$this->checkPermissions('user_manage');

	}
	

	//  Landing page of admin section.
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'Custom Dealer Plan';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}
	
	function edit($id= NULL){
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
           
		    $checkPro = $this->data['products'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, true);
			if(empty($this->data['products'])){
	            redirect($this->data['_cancel']);
			}

			$this->db->order_by('plan_id','asc');
			$this->data['plan_data'] = $this->comman_model->get_by('memberships',array('id'=>$checkPro->plan_id),false);
	
			$this->db->order_by('username','asc');
			$this->data['user_data'] = $this->comman_model->get_by('users',array('id'=>$checkPro->user_id,'account_type'=>'D'),false,false,false);
			//$this->data['user_data']  = $this->comman_model->get_by('users',array('id'=>$this->data['users']->user_id),false,false,true);
        }
        else
        {
			$this->data['name'] = 'Create';
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
			$this->data['products'] = $this->plan_model->get_new_dealer();

			$this->db->order_by('plan_id','asc');
			$this->data['plan_data'] = $this->comman_model->get('memberships',false);
			//redirect($this->data['_cancel']);

			$this->db->order_by('username','asc');
			$this->data['user_data'] = $this->comman_model->get_by('users',array('account_type'=>'D'),false,false,false);
        }

		$this->data['month_data'] = $this->membership_model->get_day_month();
        // Set up the form
		$rules = array(
			'user_id' 	=> array('field'=>'user_id', 'label'=>'User', 'rules'=>'trim|required'),
			'plan_id' 	=> array('field'=>'plan_id', 'label'=>'Plan', 'rules'=>'trim|required'),
	        'price' => array('field'=>'price', 'label'=>'User price', 'rules'=>'trim|required|numeric'),
		);

        $this->form_validation->set_rules($rules);
        // Process the form
        if($this->form_validation->run() == TRUE){

			
        	$post_data = $this->comman_model->array_from_post(array('user_id','plan_id','price','is_set'));
			$data['admin_id'] = $this->data['admin_details']->id;

            if($id == NULL){
				$checkAlready = $this->comman_model->get_by($this->_table_names,array('user_id'=>$post_data['user_id'],'plan_id'=>$post_data['plan_id']),false,false,true);
				if($checkAlready){
					$this->session->set_flashdata('error','Plan has already for this user!!');
					redirect($this->data['_cancel'].'/edit/'.$id);
				}
				$data['on_date'] = date('Y-m-d');
				$data['date_time'] = date('Y-m-d H:i:s');
			}
			
			$checkPlan = $this->comman_model->get_by($this->_membership_table,array('id'=>$post_data['plan_id']),false,false,true);
			if(!$checkPlan){
				$this->session->set_flashdata('error','There is no plan!!');
				redirect($this->data['_cancel'].'/edit/'.$id);
			}
			$id= $this->comman_model->save($this->_table_names,$post_data,$id);
/*			echo '<pre>';
			print_r($data2);
			die;*/
//			echo $this->db->last_query();die;
			if(empty($this->data['products']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
			redirect($this->data['_cancel']);
			//die;
        }

		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	

	function delete($id = false){
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
		if(!$id){
			redirect($this->data['_cancel']);
		}

		//$this->comman_model->update('categories',array('parent_id'=>0),array('parent_id'=>$id));
		$this->comman_model->delete_by_id($this->_table_names,array('id'=>$id));

		$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],297)); 
		redirect($this->data['_cancel']);		

	}
	//function send_mail(){}

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

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */