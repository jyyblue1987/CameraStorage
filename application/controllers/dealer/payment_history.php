<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_history extends Frontend_Controller{	
	public $_redirect = '/dealer/payment_history';

	public $_table_names = 'camera_payment';

	public $_subView = 'ownner/payment_history/';
	public $_mainView = 'ownner/_layout_main';
	public function __construct(){
		parent::__construct();
		$this->data['active_sub'] = '';	
		$this->data['active'] = 'Payment History';
        $this->load->model(array('membership_model'));
		
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');

		$this->data['_user_link'] = $this->data['lang_code'].'/dealer';

        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_payment_form'] = $this->data['lang_code'].$this->_redirect.'/payment';
        $this->data['_add'] = $this->data['lang_code'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['lang_code'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['lang_code'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['lang_code'].$this->_redirect;
        $this->data['_delete'] = $this->data['lang_code'].$this->_redirect.'/delete';
		$this->_checkUser();
		//$this->_checkPaidUser();
	}



	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],2801).'Payment History';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['month_data'] = $this->membership_model->get_day_month();


/*		$this->db->where('ownner_id',$this->data['user_details']->id);
		$this->db->set('is_read', 1, true);
		$this->db->update('user_membership_history');*/

		$this->data['all_data'] = '';	
		$clientArr = array();
		$getClient = $this->comman_model->get_by('users',array('parent_id'=>$this->data['user_details']->id),false,false,false);
		if($getClient){
			foreach($getClient as $g_c){
				$clientArr[] = $g_c->id;
			}
		}
		

		$this->db->order_by('id','desc');
		if($clientArr){
			$this->db->where_in('user_id',$clientArr);
			$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('payment'=>1),false,false,false);	
			
		}
/*		echo $this->db->last_query();
		echo '<pre>';
		print_r($this->data['all_data']);
		die;*/
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index_history';
		$this->load->view($this->_mainView,$this->data);
	}

	function payment(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],2810).'Payment';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

        $this->data['_cancel'] = $this->data['_cancel'].'/history';

		$this->db->order_by('username','asc');
		$this->data['user_data'] = $this->comman_model->get_by('users',array('parent_id'=>$this->data['user_details']->id,'account_type'=>'A'),false,false,false);

		$this->db->order_by('id','desc');
		$this->data['membership_data'] = $this->comman_model->get_by('users_membership',array('user_id'=>$this->data['user_details']->id),false,false,false);
		$class_rules = array(
			'user_id' => array('field'=>'user_id', 'label'=>'Username', 'rules'=>'trim|required'),
			'plan_id' => array('field'=>'plan_id', 'label'=>'Plan', 'rules'=>'trim|required'),
			's_date' => array('field'=>'s_date', 'label'=>'Date', 'rules'=>'trim|required'),
		);
        $this->form_validation->set_rules($class_rules);
        if($this->form_validation->run() == TRUE){
			//echo 'asd';
			//die;
            $post_data = $this->membership_model->array_from_post(array('user_id','plan_id','discount'));
			$post_data['s_date'] 		= h_dateFormat($this->input->post('s_date'),'Y-m-d');
			
			$checkMembership = $this->comman_model->get_by('users_membership',array('id'=>$post_data['plan_id'],'user_id'=>$this->data['user_details']->id),false,false,true);
			if($checkMembership){		
				$price = $checkMembership->price;
				if($post_data['discount']>0){
					$price = $checkMembership->price-round(($checkMembership->price*$post_data['discount'])/100,2);
				}
	//			echo $this->db->last_query();die;
				if($checkMembership->month<30){
					$perDayPrice = round($this->data['user_details']->plan_member/30,2);
					//echo '<br>Per:'.$perDayPrice;
					$totalAmt = round($perDayPrice*$checkMembership->month,2);
				}
				elseif($checkMembership->month<365){
					$month = round($checkMembership->month/30);
				//	echo '<br>Month:'.$month;
					$totalAmt = round($this->data['user_details']->plan_member*$month,2);
				}
				else{
					$month = round($checkMembership->month/365)*12;
					//echo '<br>year:'.$month;
					$totalAmt = round($this->data['user_details']->plan_member*$month,2);
				}
			
/*				echo '<br>Total:'.$totalAmt;
				echo '<br>'.$this->data['user_details']->total_point.' : '.round($totalAmt+$this->data['user_details']->credits_point,2);*/
				if($this->data['user_details']->total_point<round($totalAmt+$this->data['user_details']->credits_point,2)){
					//$this->session->set_flashdata('error','Enough Balance!!'); 
					//die;
					
					//redirect($this->data['_payment_form']);
					//						$this->session->set_flashdata('error','Enough Balance!!'); 
				}
				else{
				}
				//available total
					$arr = array(
							'ownner_id'		=> $this->data['user_details']->id,
							'user_id'		=> $post_data['user_id'],
							'product_id'	=> $post_data['plan_id'],
							'gym_id'		=> $checkMembership->gym_id,
							'bank_id'		=> print_value('users_paypal',array('gym_id'=>$checkMembership->gym_id,'type'=>'bank'),'id'),
							'payment_type'	=> 'Cash',
							's_date'		=> $post_data['s_date'],
							'created_by'	=> 'gym',
							'class_count'	=> $checkMembership->member,
							'name'			=> $checkMembership->name,
							'amount'		=> $price,
							'month'			=> $checkMembership->month,
							'on_date'		=> date('Y-m-d'),
							'on_datetime'	=> date('Y-m-d H:i:s'),
							'status'		=> 'Confirm'
							
								);
					
					$reID = $this->comman_model->save('user_membership_history',$arr);
					//die;
					$this->db->where('id',$post_data['user_id']);
					$this->db->set('plan_id', $checkMembership->id, true);
					$this->db->set('plan_type', $checkMembership->name, true);
					$this->db->set('plan_status', 'Confirm', true);
					$this->db->set('plan_month', $checkMembership->month, true);
					$this->db->set('plan_start_date', $post_data['s_date'], true);
					$this->db->set('plan_class_count', $checkMembership->member, true);
					if($checkMembership->member==100){
						$this->db->set('plan_unlimit',1, true);
					}
					else{
						$this->db->set('total_used_class', "total_used_class+".$checkMembership->member, false);
					}
					$this->db->set('plan_date', date('Y-m-d'), true);
					$this->db->set('user_type', 'paid', true);
					$this->db->update('users');

					$arr = array(
							'order_id'		=> $reID,
							'ownner_id'		=> $this->data['user_details']->id,
							'user_id'		=> $post_data['user_id'],
							'product_id'	=> $post_data['plan_id'],
							's_date'		=> $post_data['s_date'],
							'class_count'	=> $checkMembership->member,
							'name'			=> $checkMembership->name,
							'amount'		=> $price,
							'month'			=> $checkMembership->month,
							'on_date'		=> date('Y-m-d'),
							'on_datetime'	=> date('Y-m-d H:i:s'),
							);
					$this->comman_model->save('athlete_membership',$arr);

					//for transaction 
					$this->comman_model->save('users_transaction',array('ownner_id'=>$this->data['user_details']->id,'user_id'=>$post_data['user_id'],'order_id'=>$reID,'product_id'=>$checkMembership->id,'type'=>'athlete_membership','amount'=>$totalAmt,'on_date'=>date('Y-m-d'),'on_datetime'=>date('y-m-d H:i:s')));

					//update credit 
					$this->db->where('id',$this->data['user_details']->id);
					$this->db->set('credits_point', 'ROUND(credits_point+'.$totalAmt.',2)', FALSE);
					$this->db->update('users');
				
				$this->session->set_flashdata('success','Data has successfully submitted');
			}
			redirect($this->data['_cancel'].'/payment');
		}
/*		echo '<pre>';
		print_r($this->data['all_data']);
		die;*/
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'edit_payment';
		$this->load->view($this->_mainView,$this->data);
	}

	function transaction(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['lang_id'],104);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->db->order_by('id','desc');
		$this->data['all_data'] = $this->comman_model->get_by('users_transaction',array('ownner_id'=>$this->data['user_details']->id),false,false,false);	

/*		echo '<pre>';
		print_r($this->data['all_data']);
		die;*/
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index_transaction';
		$this->load->view($this->_mainView,$this->data);
	}

	function getStatus(){	
		$output =array();
		$output['status'] ='error';
		$output['msge'] ='Please login first!!';
		$user_id = $this->input->post('id');
		$type = $this->input->post('type');
/*		$user_id = 1;
		$type = 'confirm';*/
		if($user_id&&$type){
			$output['msge'] ='There is some problem!!';
			$checkMembership = $this->comman_model->get_by('user_membership_history',array('id'=>$user_id,'ownner_id'=>$this->data['user_details']->id),false,false,true);
			if($checkMembership){
				if($checkMembership->status=='Pending'){
					if($type=='confirm'){
		
/*							echo '<br>Ownn price:'.$this->data['user_details']->plan_member;
							echo '<br>';
							echo  $checkMembership->month;
							echo '<br>';*/
							if($checkMembership->month<30){
								$perDayPrice = round($this->data['user_details']->plan_member/30,2);
								//echo '<br>Per:'.$perDayPrice;
								$totalAmt = round($perDayPrice*$checkMembership->month,2);
							}
							elseif($checkMembership->month<365){
								$month = round($checkMembership->month/30);
							//	echo '<br>Month:'.$month;
								$totalAmt = round($this->data['user_details']->plan_member*$month,2);
							}
							else{
								$month = round($checkMembership->month/365)*12;
								//echo '<br>year:'.$month;
								$totalAmt = round($this->data['user_details']->plan_member*$month,2);
							}
						
							//echo '<br>Total:'.$totalAmt;
							//check credit to total

								$this->comman_model->update_by('user_membership_history',array('status'=>'Confirm'),array('id'=>$user_id,'ownner_id'=>$this->data['user_details']->id));		
		
/*								$this->db->where('id',$checkMembership->user_id);
								$this->db->set('plan_status', "Confirm", true);
								$this->db->set('total_used_class', "total_used_class+".$checkMembership->class_count, false);
								$this->db->update('users');*/
								$this->db->where('id',$checkMembership->user_id);
								$this->db->set('plan_id', $checkMembership->product_id, true);
								$this->db->set('plan_type', $checkMembership->name, true);
								$this->db->set('plan_status', 'Confirm', true);
								$this->db->set('plan_month', $checkMembership->month, true);
								$this->db->set('plan_start_date', $checkMembership->s_date, true);
								$this->db->set('plan_class_count', $checkMembership->class_count, true);
								if($checkMembership->class_count==100){
									$this->db->set('plan_unlimit',1, true);
								}
								else{
									$this->db->set('total_used_class', "total_used_class+".$checkMembership->class_count, false);
								}
								$this->db->set('plan_date', date('Y-m-d'), true);
								$this->db->set('user_type', 'paid', true);
								$this->db->update('users');


								$arr = array(
										'order_id'		=> $checkMembership->id,
										'ownner_id'		=> $this->data['user_details']->id,
										'user_id'		=> $checkMembership->user_id,
										'product_id'	=> $checkMembership->product_id,
										's_date'		=> $checkMembership->s_date,
										'class_count'	=> $checkMembership->class_count,
										'name'			=> $checkMembership->name,
										'month'			=> $checkMembership->month,
										'on_date'		=> date('Y-m-d'),
										'on_datetime'	=> date('Y-m-d H:i:s'),
										);
								$this->comman_model->save('athlete_membership',$arr);
			
								
								//for transaction 
								$this->comman_model->save('users_transaction',array('ownner_id'=>$this->data['user_details']->id,'user_id'=>$checkMembership->user_id,'order_id'=>$checkMembership->id,'product_id'=>$checkMembership->product_id,'type'=>'athlete_membership','amount'=>$totalAmt,'on_date'=>date('Y-m-d'),'on_datetime'=>date('y-m-d H:i:s')));
		
								//update credit 
								$this->db->where('id',$this->data['user_details']->id);
								$this->db->set('credits_point', 'ROUND(credits_point+'.$totalAmt.',2)', FALSE);
								$this->db->update('users');

								$output['status'] = 'ok';
								$output['msge'] = '<label class="label label-success">Confirm</label>';
					}
					elseif($type=='cancel'){						
						$this->comman_model->update_by('user_membership_history',array('status'=>'Cancel'),array('id'=>$user_id,'ownner_id'=>$this->data['user_details']->id));		

						$this->db->where('id', $checkMembership->id);
						$this->db->set('plan_id',0, TRUE);
						$this->db->set('plan_type',NULL, TRUE);
						$this->db->set('plan_date',NULL, TRUE);
						$this->db->set('plan_month',NULL, TRUE);
						$this->db->update('users');

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
	

	function _checkUser(){
		$redirect = false;
		if(isset($this->data['user_details'])){	
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
	}

	function _checkPaidUser(){
		if($this->data['user_details']->plan_id!=0){}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link']);
		}
		if($this->data['user_details']->total_point>0){
		}
		else{
			$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
			redirect($this->data['_user_link'].'/account');
		}
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */