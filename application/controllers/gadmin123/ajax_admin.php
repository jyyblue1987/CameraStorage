<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date','front'));	
		$this->load->library(array('session'));
		$this->load->model(array('comman_model','language_model','settings_model'));
		$this->data['set_meta'] = '';	


        $this->data['settings'] = $this->settings_model->get_fields();

		$redirect = false;
        $detail = $this->session->all_userdata();
        if(isset($detail['admin_session']['id'])){
            $this->data['admin_details'] =  $this->comman_model->get_by('admin',array('id'=>$detail['admin_session']['id']),FALSE,FALSE,TRUE);
        }
		date_default_timezone_set("America/Cancun");        
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
	}

	function userDetail(){
		$output['status'] ='ok';
		$last_now = date('Y-m-t');
	

		//$this->chat_model->update($this->data['user_details']->id);
		$output['requestCount'] = count($this->comman_model->get_by('tickets',array('is_read'=>0),false,false,false));
		$output['publicCount'] = count($this->comman_model->get_by('public_user',array('is_read'=>0),false,false,false));
		echo json_encode($output);
	}
    
	function ajax_demo(){
		$table_name= 'requests';
		$id = $this->input->post('type');

		$array = array('05-8-2016'=>4,'6-8-2016'=>6,'7-8-2016'=>2,'8-8-2016'=>5,'9-8-2016'=>4);
		echo json_encode($array);
	
	}
	
	function notification(){
		$rel = array();
		$rel['status']= "error";
		$rel['msg']= '';
		$rel['sound'] = 0;
		$rel['order_count'] = 0;
		$rel['payapal_order_count'] = 0;
		if(isset($this->data['admin_details'])){
			$rel['status']= "ok";
			$orderSound  = $this->comman_model->get_by('user_orders',array('admin_sound'=>0,'payment'=>1),false,false,false);	
			if($orderSound){
				$this->db->where(array('payment'=>1));
				$this->db->set('admin_sound', '1', FALSE);
				$this->db->update('user_orders');
				$rel['sound'] = 1;
			}

			$deliveryOrderCount = count($this->comman_model->get_by('user_orders',array('admin_read'=>0,'payment'=>1),false,false,false));
			if($deliveryOrderCount){
				$rel['order_count'] = $deliveryOrderCount;
			}
		}		
		echo json_encode($rel);
	}    

	//for count order price
	function ajax_order_chart1(){
		$table_name= 'user_history';
		$id = $this->input->post('type');
//		$where = 'user_id ='.$this->data['user_details']->id;
		$where1  = "on_date > '".date('Y-m-d', strtotime('-15 day',time()))."'";

		$array = array();
		if($id=='month'){
			$query = "SELECT on_date as on_date,  SUM(amount) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE status='Confirm' GROUP BY Y,m ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->m)){
						if($set_data->m==1){
							$array['Jan'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==2){
							$array['Feb'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==3){
							$array['Mar'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==4){
							$array['Apr'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==5){
							$array['May'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==6){
							$array['Jun'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==7){
							$array['Jul'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==8){
							$array['Aug'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==9){
							$array['Sep'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==10){
							$array['Oct'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==11){
							$array['Nov'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==12){
							$array['Dec'] =(int)$set_data->problem_count;
						}
					}				
				}
			}
		}
		else if($id=='year'){
			$query = "SELECT on_date as on_date,  SUM(amount) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE status='Confirm'  GROUP BY Y ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->Y)){
						$array[$set_data->Y] =(int)$set_data->problem_count;
					}				
				}
			}
		}
		else{
			$query = "SELECT on_date as on_date, SUM(amount) as user_orders_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE $where1 and status='Confirm'  GROUP BY Y,m,d ORDER BY on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			//echo $this->db->last_query();
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->on_date)){
						$array[h_dateFormat($set_data->on_date,'m/d/Y')] =(int)$set_data->user_orders_count;
					}				
				}
			}
		}
		if(empty($array)){
			$array[date('d/m/Y')] =0;
		}

	//	$array = array('05-8-2016'=>4,'6-8-2016'=>6,'7-8-2016'=>2,'8-8-2016'=>5,'9-8-2016'=>4);
		echo json_encode($array);	
	}

	//for count order
	function ajax_order_chart(){
		$table_name= 'user_history';
		$id = $this->input->post('type');
//		$where = 'user_id ='.$this->data['user_details']->id;
		$where1  = "on_date > '".date('Y-m-d', strtotime('-15 day',time()))."'";

		$array = array();
		if($id=='month'){
			$query = "SELECT on_date as on_date,  COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE subscribe_status='confirm' GROUP BY Y,m ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->m)){
						if($set_data->m==1){
							$array['Jan'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==2){
							$array['Feb'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==3){
							$array['Mar'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==4){
							$array['Apr'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==5){
							$array['May'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==6){
							$array['Jun'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==7){
							$array['Jul'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==8){
							$array['Aug'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==9){
							$array['Sep'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==10){
							$array['Oct'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==11){
							$array['Nov'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==12){
							$array['Dec'] =(int)$set_data->problem_count;
						}
					}				
				}
			}
		}
		else if($id=='year'){
			$query = "SELECT on_date as on_date,  COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE subscribe_status='confirm'  GROUP BY Y ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->Y)){
						$array[$set_data->Y] =(int)$set_data->problem_count;
					}				
				}
			}
		}
		else{
			$query = "SELECT on_date as on_date, COUNT(id) as user_orders_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y FROM $table_name WHERE $where1 and subscribe_status='confirm'  GROUP BY Y,m,d ORDER BY on_date ASC";
			$result = $this->comman_model->get_query($query,false);
			//echo $this->db->last_query();
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->on_date)){
						$array[$set_data->on_date] =(int)$set_data->user_orders_count;
					}				
				}
			}
		}
		if(empty($array)){
			$array[date('Y-m-d')] =0;
		}

	//	$array = array('05-8-2016'=>4,'6-8-2016'=>6,'7-8-2016'=>2,'8-8-2016'=>5,'9-8-2016'=>4);
		echo json_encode($array);
	
	}

	function ajax_chart(){
		$id = $this->input->post('type');
		$array = array();
		if($id=='day'){
			$query = "SELECT date, COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y  FROM problems GROUP BY Y,m,d ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->date)){
						$array[$set_data->date] =(int)$set_data->problem_count;
					}				
				}
			}
		}
		else if($id=='month'){
			$query = "SELECT date, COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y  FROM problems GROUP BY Y,m ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->m)){
						if($set_data->m==1){
							$array['Jan'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==2){
							$array['Feb'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==3){
							$array['Mar'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==4){
							$array['Apr'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==5){
							$array['May'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==6){
							$array['Jun'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==7){
							$array['Jul'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==8){
							$array['Aug'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==9){
							$array['Sep'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==10){
							$array['Oct'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==11){
							$array['Nov'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==12){
							$array['Dec'] =(int)$set_data->problem_count;
						}
					}				
				}
			}
		}
		else if($id=='year'){
				$query = "SELECT date, COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y  FROM problems where YEAR(on_date)='".date('Y')."' GROUP BY Y ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->Y)){
						$array[$set_data->Y] =(int)$set_data->problem_count;
					}				
				}
			}
		}
		else{
			$query = "SELECT date, COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y  FROM problems GROUP BY Y,m,d ORDER BY  on_date ASC";
			$result = $this->comman_model->get_query($query);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->date)){
						$array[$set_data->date] =(int)$set_data->problem_count;
					}				
				}
			}
		}

///		echo $query = "SELECT date, COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y  FROM problems GROUP BY Y,m,d ORDER BY  on_date ASC";
	//for admin
		$array = array('18-7-2016'=>4,'20-7-2016'=>6,'11-7-2016'=>2,'8-7-2016'=>5,'7-7-2016'=>4);
		echo json_encode($array);
	}
	
	
	function ajax_company_chart(){
		$id = $this->input->post('type');
		//$id = 'company';
		$array = array();
		if($id=='company'){
			//$query = "SELECT date, COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y  FROM problems GROUP BY Y,m,d ORDER BY  on_date ASC";
			$company = $this->comman_model->get_by('users',array('account_type'=>'C'),false,false,false);
			if(!empty($company)){
				foreach($company as $set_data){
					$check = count($this->comman_model->get_by('problems',array('status'=>'Completed','done_user'=>'user','customer_id'=>$set_data->id),false,false,false));
					$totalcheck = count($this->comman_model->get_by('problems',array('customer_id'=>$set_data->id),false,false,false));
					$array[$set_data->company_name] =(int)(($check*100)/$totalcheck);
				}
			}
		}
		else if($id=='admin'){
			//$query = "SELECT date, COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y  FROM problems GROUP BY Y,m,d ORDER BY  on_date ASC";
			$company = $this->comman_model->get_by('users',array('account_type'=>'C'),false,false,false);
			if(!empty($company)){
				foreach($company as $set_data){
					$check = count($this->comman_model->get_by('problems',array('status'=>'Completed','done_user'=>'admin','customer_id'=>$set_data->id),false,false,false));
					$totalcheck = count($this->comman_model->get_by('problems',array('customer_id'=>$set_data->id),false,false,false));
					$array[$set_data->company_name] =(int)(($check*100)/$totalcheck);
				}
			}
		}

///		echo $query = "SELECT date, COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y  FROM problems GROUP BY Y,m,d ORDER BY  on_date ASC";

/*		$array = array('9-3-2016'=>4,'10-3-2016'=>6,'11-3-2016'=>2,'8-3-2016'=>5,'7-3-2016'=>4);*/
		echo json_encode($array);
	}

	
	function ajax_request_chart(){
		$table_name= 'requests';
		$id = $this->input->post('type');
//		$where = 'user_id ='.$this->data['user_details']->id;
		$where1  = "dates > '".date('Y-m-d', strtotime('-15 day',time()))."'";

		$array = array();
		if($id=='month'){
			$query = "SELECT dates as on_date,  COUNT(id) as problem_count, DAY(dates)AS d, MONTH(dates) AS m,YEAR(dates) AS Y FROM $table_name WHERE GROUP BY Y,m ORDER BY  dates ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->m)){
						if($set_data->m==1){
							$array['Jan'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==2){
							$array['Feb'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==3){
							$array['Mar'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==4){
							$array['Apr'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==5){
							$array['May'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==6){
							$array['Jun'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==7){
							$array['Jul'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==8){
							$array['Aug'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==9){
							$array['Sep'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==10){
							$array['Oct'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==11){
							$array['Nov'] =(int)$set_data->problem_count;
						}
						else if($set_data->m==12){
							$array['Dec'] =(int)$set_data->problem_count;
						}
					}				
				}
			}
		}
		else if($id=='year'){
			$query = "SELECT dates as on_date,  COUNT(id) as problem_count, DAY(dates)AS d, MONTH(dates) AS m,YEAR(dates) AS Y FROM $table_name WHERE GROUP BY Y ORDER BY  dates ASC";
			$result = $this->comman_model->get_query($query,false);
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->Y)){
						$array[$set_data->Y] =(int)$set_data->problem_count;
					}				
				}
			}
		}
		else{
			$query = "SELECT dates as on_date, COUNT(id) as user_orders_count, DAY(dates)AS d, MONTH(dates) AS m,YEAR(dates) AS Y FROM $table_name WHERE $where1 GROUP BY Y,m,d ORDER BY dates ASC";
			$result = $this->comman_model->get_query($query,false);
			//echo $this->db->last_query();
			if(!empty($result)){
				foreach($result as $set_data){
					if(!empty($set_data->on_date)){
						$array[$set_data->on_date] =(int)$set_data->user_orders_count;
					}				
				}
			}
		}
		if(empty($array)){
			$array[date('Y-m-d')] =0;
		}

		$array = array('05-8-2016'=>4,'6-8-2016'=>6,'7-8-2016'=>2,'8-8-2016'=>5,'9-8-2016'=>4);
		echo json_encode($array);
	
	}	
}