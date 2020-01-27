<?php

class Membership extends Admin_Controller
{
	public $_table_names_hi = 'ownner_m_history';
	public $_table_names = 'memberships';
	public $_subView = 'admin/memberships/';
	public $_redirect = '/membership';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Membership Management';
        $this->load->model(array('membership_model'));

        // Get language for content id to show in administration
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
	}
    
    public function index()
	{
		$this->checkPermissions('membership');
	    // Fetch all pages
		$this->data['title'] = 'Membership Plan | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Membership Plan ';
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		$this->data['table'] = true;

		$this->data['month_data'] = $this->membership_model->get_day_month();
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

    
    public function edit($id = NULL){

	    // Fetch a page or set a new one
	    if($id){
            $this->data['categories'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, true);
			$this->data['title'] = 'Edit | '.$this->data['settings']['site_name'];
			$this->data['name'] = 'Edit';
            count($this->data['categories']) || $this->data['errors'][] = 'User could not be found';
        }
        else
        {
			$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];
			$this->data['name'] = ' Create ';
            $this->data['categories'] = $this->membership_model->get_new();
        }
        
		for($i=1;$i<=29;$i++){
			$this->data['month'][$i] = $i.' day';
		}
		$this->data['month']['30']  ='1 Month'; 
		$this->data['month']['60']  ='2 Months'; 
		$this->data['month']['90']  ='3 Months'; 
		$this->data['month']['120']  ='4 Months'; 
		$this->data['month']['150']  ='5 Months'; 
		$this->data['month']['180']  ='6 Months'; 
		$this->data['month']['365']  ='1 Year'; 
		$this->data['month']['730']  = '2 Years'; 
		$this->data['month']['1095']  = '3 Years'; 

//		$this->data['type_data']  =array('Public'=>'Public','Special'=>'Special'); 

	   	$this->db->order_by('name','asc');
        $this->data['categories_data'] = $this->comman_model->get('plans',false);
       
        // Set up the form
        $rules = $this->membership_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
            $data = $this->comman_model->array_from_post(array('name','desc','plan_id','price','price2','month'));
            if($id == NULL)$data['order'] = $this->membership_model->max_order()+1;
            if($id == NULL){
                $data['created'] = time();
                $data['modified'] = time();
			}
			else{
                $data['modified'] = time();
			}
            
            //$data['price'] = round($data['staff']+$data['coach']+$data['member'],2);
            $id = $this->comman_model->save($this->_table_names,$data, $id);
			if(empty($this->data['categories']->id))
	            $this->session->set_flashdata('success','Plan has successfully created.');
			else
	            $this->session->set_flashdata('success','Plan has successfully updated.');			
            redirect($this->data['_cancel']);
        }
        
        // Load the view
/*		echo '<pre>';
		print_r($this->data);
		die;
*/
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
	public function dealer_price($id = NULL){
	    // Fetch a page or set a new one
	    if(!$id)
	        redirect($this->data['_cancel']);

		$check_m = $this->data['view_data'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id), FALSE, FALSE, true);
		if(!$check_m)
			redirect($this->data['_cancel']);

		$this->data['name'] = 'Dealer Price Set - '.$check_m->name.' ('.print_value('plans',array('id'=>$check_m->plan_id),'name').' )';
        
		$this->data['all_data'] = $this->comman_model->get_by('plans_c',array('plan_id'=>$id), FALSE, FALSE, FALSE);
/*		echo '<pre>';
		print_r($this->data['all_data']);*/
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['subview'] = $this->_subView.'index_dealer_price';
        $this->load->view('admin/_layout_main', $this->data);
	}
	
    public function order_ajax(){
        // Save order from ajax call
        if (isset($_POST['sortable'])) {
            $this->membership_model->save_order($_POST['sortable']);
        }
        
        // Fetch all pages
        $this->data['pages'] = $this->membership_model->get_nested($this->data['content_language_id']);
        
        // Load view
        $this->load->view($this->_subView.'order_ajax', $this->data);
    }

    
    public function order()
    {
		$this->data['sortable'] = TRUE;
        
        // Load view
		$this->data['subview'] = $this->_subView.'order';
        $this->load->view('admin/_layout_main', $this->data);
    }


	function history(){
		$this->checkPermissions('membership_history');
		//var_dump($this->session->all_userdata());
        $this->data['name'] = 'History';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->db->set('is_read', 1, true);
		$this->db->update($this->_table_names_hi);

		$this->db->order_by('id','desc');
		$this->data['all_data'] = $this->comman_model->get($this->_table_names_hi,false);	

		$this->db->order_by('id','desc');
		$this->data['all_pnd_data'] = $this->comman_model->get_by($this->_table_names_hi,array('status'=>'Pending'),false,false,false);	

		$this->db->order_by('id','desc');
		$this->data['all_cfrm_data'] = $this->comman_model->get_by($this->_table_names_hi,array('status'=>'Confirm'),false,false,false);

		$this->db->order_by('id','desc');
		$this->data['all_cncel_data'] = $this->comman_model->get_by($this->_table_names_hi,array('status'=>'Cancel'),false,false,false);
/*		echo '<pre>';
		print_r($this->data['all_data']);
		die;*/
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index_history';
        $this->load->view('admin/_layout_main', $this->data);
	}

	function getStatus(){	
	
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='Please login first!!';
		$user_id = $this->input->post('id');
		$type = $this->input->post('type');

		//for testing
/*		$type = 'confirm';
		$user_id = 1;*/
		//$user_id = 2;
		if($user_id&&$type){
			$output['msge'] ='There is some problem!!';
			$checkMembership = $this->comman_model->get_by($this->_table_names_hi,array('id'=>$user_id),false,false,true);
			if($checkMembership){
				//echo 'asd';
				if($checkMembership->status=='Pending'){
					if($type=='confirm'){
						$this->comman_model->update_by($this->_table_names_hi,array('status'=>'Confirm'),array('id'=>$user_id));
		
						$user_update = array(
								'plan_id'			=> $checkMembership->product_id,
								'plan_type'			=> $checkMembership->name,
								'plan_month'		=> $checkMembership->month,
								'plan_coach'		=> $checkMembership->plan_coach,
								'plan_member'		=> $checkMembership->plan_member,
								'plan_staff'		=> $checkMembership->plan_staff,

								'plan_business'		=> $checkMembership->plan_business,
								'plan_photograph'	=> $checkMembership->plan_photograph,
								'plan_sport'		=> $checkMembership->plan_sport,
								'plan_tournament'	=> $checkMembership->plan_tournament,
								'plan_competition'	=> $checkMembership->plan_competition,
		//						'plan_c_point'=>$this->data['login']['user_subscribe']['c_point'],
								'user_type'			=>'paid',
								'plan_date'			=> date('Y-m-d',time()),
								'plan_datetime' 	=> date('Y-m-d H:i:s',strtotime('+1 month',time())),
							);
		
						$this->comman_model->save('users',$user_update,$checkMembership->user_id);
						$this->db->where('id', $checkMembership->user_id);
						$this->db->set('total_point', 'ROUND(total_point+'.$checkMembership->amount.',2)', FALSE);
						$this->db->update('users');


						$output['status'] = 'ok';
						$output['msge'] = '<label class="label label-success">Confirm</label>';
					}
					elseif($type=='cancel'){						
						$this->comman_model->update_by($this->_table_names_hi,array('status'=>'Cancel'),array('id'=>$user_id));		

/*						$this->db->where('id', $checkMembership->id);
						$this->db->set('plan_id',0, TRUE);
						$this->db->set('plan_type',NULL, TRUE);
						$this->db->set('plan_date',NULL, TRUE);
						$this->db->set('plan_month',NULL, TRUE);
						$this->db->update('users');*/

						$output['status'] = 'ok';
						$output['msge'] = '<label class="label label-warning">Cancel</label>';
					}
				}
			}
			else{
				$output['msge'] ='There is no history.';
			}
		}
		else{
			$output['msge'] ='There is no history.';
		}
		echo json_encode($output);
	}

 	function payment(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = 'Payment';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

        $this->data['_cancel'] = $this->data['_cancel'].'/history';

		$this->db->order_by('username','asc');
		$this->data['user_data'] = $this->comman_model->get_by('users',array('account_type'=>'S'),false,false,false);

		$this->db->order_by('id','desc');
		$this->data['membership_data'] = $this->comman_model->get($this->_table_names,false);
		$class_rules = array(
			'user_id' => array('field'=>'user_id', 'label'=>'Username', 'rules'=>'trim|required'),
			'plan_id' => array('field'=>'plan_id', 'label'=>'Plan', 'rules'=>'trim|required'),
			//'s_date' => array('field'=>'s_date', 'label'=>'Date', 'rules'=>'trim|required'),
		);
        $this->form_validation->set_rules($class_rules);
        if($this->form_validation->run() == TRUE){
			//echo 'asd';
			//die;
            $post_data = $this->membership_model->array_from_post(array('user_id','plan_id','discount'));
			$post_data['s_date'] 		= h_dateFormat($this->input->post('s_date'),'Y-m-d');
			
			$checkMembership = $this->comman_model->get_by($this->_table_names,array('id'=>$post_data['plan_id']),false,false,true);
			$price = $checkMembership->price;
			if($post_data['discount']>0){
				$price = $checkMembership->price-round(($checkMembership->price*$post_data['discount'])/100,2);
			}
			if($checkMembership){		
	//			echo $this->db->last_query();die;
				$arr = array(
						'user_id'			=> $post_data['user_id'],
						'product_id'		=> $post_data['plan_id'],
						'payment_type'		=> 'Cash',
						'created_by'		=> 'admin',
						'status'			=> 'Confirm',

						'plan_business'		=> $checkMembership->business,
						'plan_photograph'	=> $checkMembership->photographer,
						'plan_sport'		=> $checkMembership->nutritionist,
						'plan_tournament'	=> $checkMembership->tournament,
						'plan_competition'	=> $checkMembership->competition,

						'plan_staff'		=> $checkMembership->staff,
						'plan_member'		=> $checkMembership->member,
						'plan_coach'		=> $checkMembership->coach,
						'name'				=> $checkMembership->name,
						'amount'			=> $checkMembership->price,
						'month'				=> $checkMembership->month,
						'on_date'			=> date('Y-m-d'),
						'on_datetime'		=> date('Y-m-d H:i'),
							);
							
				$this->comman_model->save($this->_table_names_hi,$arr);

				$user_update = array(
						'plan_id'			=> $checkMembership->id,
						'plan_type'			=> $checkMembership->name,
						'plan_month'		=> $checkMembership->month,
						'plan_coach'		=> $checkMembership->coach,
						'plan_member'		=> $checkMembership->member,
						'plan_staff'		=> $checkMembership->staff,

						'plan_business'		=> $checkMembership->business,
						'plan_photograph'	=> $checkMembership->photographer,
						'plan_sport'		=> $checkMembership->nutritionist,
						'plan_tournament'	=> $checkMembership->tournament,
						'plan_competition'	=> $checkMembership->competition,

//						'plan_c_point'=>$this->data['login']['user_subscribe']['c_point'],
						'plan_date'			=> date('Y-m-d',time()),
						'user_type'			=>'paid',
						'plan_datetime' 	=> date('Y-m-d H:i:s',strtotime('+1 month',time())),
					);

				$this->comman_model->save('users',$user_update,$post_data['user_id']);
				$this->db->where('id', $post_data['user_id']);
				$this->db->set('total_point', 'ROUND(total_point+'.$checkMembership->price.',2)', FALSE);
				$this->db->update('users');

				$this->session->set_flashdata('success','Data has successfully submitted');
			}
//			die;
			//redirect($this->data['_cancel'].'/payment');
		}
/*		echo '<pre>';
		print_r($this->data['all_data']);
		die;*/
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'edit_payment';
        $this->load->view('admin/_layout_main', $this->data);
	}
    
    public function delete($id)
	{
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}
       
		$this->membership_model->delete($id);
            redirect($this->data['_cancel']);
	}
    
    public function _unique_slug($str)
    {
        // Do NOT validate if slug alredy exists
        // UNLESS it's the slug for the current categories
        
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        
        $categories = $this->membership_model->get();
        
        if(count($categories))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }
        
        return TRUE;
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