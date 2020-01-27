<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_plan extends Frontend_Controller{	
	public $_redirect = '/dealer/client_plan';
	public $_subView = 'ownner/client_plan/';
	public $_table_names = 'plans_c';
	public $_membership_table = 'memberships';
	public $_user_table = 'users';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'People';
        $this->load->model(array('plan_model','membership_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');
	
		$this->data['_user_link'] = $this->data['lang_code'].'/dealer';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';

		$this->_checkUser();
	//	$this->_checkPaidUser();
	}

	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],1000).'Client Plan';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('owner_id'=>$this->data['user_details']->id),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}


    public function edit($id = NULL){
		$company_name = '';
	    if($id){
			$this->data['name'] = show_static_text($this->data['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $checkPro = $this->data['products'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'owner_id'=>$this->data['user_details']->id), FALSE, FALSE, true);
			if(empty($this->data['products'])){
	            redirect($this->data['_cancel']);
			}

			$this->db->order_by('plan_id','asc');
			$this->data['plan_data'] = $this->comman_model->get_by('memberships',array('id'=>$checkPro->plan_id),false);
	
			$this->db->order_by('username','asc');
			$this->data['user_data'] = $this->comman_model->get_by('users',array('id'=>$checkPro->user_id,'parent_id'=>$this->data['user_details']->id,'account_type'=>'A'),false,false,false);

        }
        else
        {
			$this->data['name'] = show_static_text($this->data['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
			$this->data['products'] = $this->plan_model->get_new_dealer();

			$this->db->order_by('plan_id','asc');
			$this->data['plan_data'] = $this->comman_model->get('memberships',false);
	
			$this->db->order_by('username','asc');
			$this->data['user_data'] = $this->comman_model->get_by('users',array('parent_id'=>$this->data['user_details']->id,'account_type'=>'A'),false,false,false);

        }

		$this->data['month_data'] = $this->membership_model->get_day_month();
        

		$rules = array(
			'user_id' 	=> array('field'=>'user_id', 'label'=>'User', 'rules'=>'trim|required'),
			'plan_id' 	=> array('field'=>'plan_id', 'label'=>'Plan', 'rules'=>'trim|required'),
	        'price' => array('field'=>'price', 'label'=>'User price', 'rules'=>'trim|required|numeric'),
		);

        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == TRUE){
			
        	$post_data = $this->comman_model->array_from_post(array('user_id','plan_id','price','is_set'));
			$post_data['owner_id'] = $this->data['user_details']->id;

            if($id == NULL){
				$checkAlready = $this->comman_model->get_by($this->_table_names,array('user_id'=>$post_data['user_id'],'plan_id'=>$post_data['plan_id']),false,false,true);
				if($checkAlready){
					$this->session->set_flashdata('error','This plan has already been modified for this user!');
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
			$this->session->set_flashdata('success',show_static_text($this->data['lang_id'],2101).'Data has successfully updated.');
			redirect($this->data['_cancel'].'/edit/'.$id);
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'edit';
		$this->load->view($this->_mainView,$this->data);
	}
		
	function delete($id=false){
		if(!$id){
			redirect($this->data['_cancel']);			
		}
		$check_product = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'owner_id'=>$this->data['user_details']->id),FALSE,FALSE,TRUE);
		if(!$check_product){
			redirect($this->data['_cancel']);			
		}
		$this->db->delete($this->_table_names,array('id'=>$id,'owner_id'=>$this->data['user_details']->id)); 
		redirect($this->data['_cancel']);			
	}

	function ajaxPlan(){
		$msge = array();
		$msge['status']= 'error';
		$msge['msge']= 'There is no plan!!';
		$j = $this->input->post('id');
		$id = 25;
		$html = '';
		if($id){
			$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			if($check){
				$html .='<div class="portlet-body">
    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,236);?></b></div>
        <div class="col-md-9 value"><?=$view_data->name;?></div>
    </div>    
  
    <div class="row static-info">
        <div class="col-md-3 name"><b><?=show_static_text($lang_id,38);?></b></div>
        <div class="col-md-9 value"><?=$view_data->description;?></div>
    </div>

</div>';
			}
		}
		$msge['html'] = $html;
		echo json_encode($msge);		
	}

	function _checkPaidUser(){
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	}



	function _checkUser(){
		$redirect = false;
		if(!empty($this->data['user_details'])){
			if($this->data['user_details']->account_type!='D'){
				$redirect =true;
			}
		}
		else{
			$redirect =true;
		}
		if($redirect){
			redirect($this->data['lang_code'].'/secure/login');
		}
		if($this->data['user_details']->parent_id!=0){
				redirect($this->data['lang_code'].'/user');
		}

		if($this->data['user_details']->is_set_price==0){
				$this->session->set_flashdata('error','Sorry!! You have no permission.');				
				redirect($this->data['lang_code'].'/dealer/account');
		}

	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */