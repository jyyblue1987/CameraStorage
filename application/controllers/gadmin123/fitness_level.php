<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fitness_level extends Admin_Controller {
	public $_table_names = 'users';
	public $_table_u_f_level = 'u_f_level';	//table name
	public $_subView = 'admin/fitness_level/';
	public $_redirect = '/fitness_level';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'Fitness Level';
        $this->load->model(array('users_model'));
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel1'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_cancel'] = $this->data['admin_link'].'/userlist';
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
	}
	
	
	function index(){
		$this->checkPermissions('gym_fitness_level');
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],54);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>'S'),false,false,false);

        $this->data['subview'] = $this->_subView.'index_g';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function gym($id=false){	
		if(!$id)
			redirect($this->data['_cancel1']);
		//var_dump($this->session->all_userdata());
		$checkUser = $this->comman_model->get_by('users',array('id'=>$id,'account_type'=>'S'),false,false,true);
		if(!$checkUser){
			redirect($this->data['_cancel1']);
		}
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],54);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['ownner_data'] = $checkUser;
//		$this->data['table'] = true;
		$this->db->order_by('p_avgs','desc');
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_u_f_level,array('gym_id'=>$id),false,false,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view('admin/_layout_main',$this->data);
	}

	function sys_fitness_level(){
		$this->checkPermissions('sys_fitness_level');
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],5400).'System Fitness Level';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->db->order_by('p_avgs','desc');
		$this->data['all_data'] = $this->comman_model->get($this->_table_u_f_level,false);
/*		echo $this->db->last_query();
		die;
		echo '<pre>';
		print_r($);*/
		
        $this->data['subview'] = $this->_subView.'index_sys';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function l($id=false){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],54);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		//for smiley text
	    if(!$id)
			redirect($this->data['_cancel']);
	

		$checkProduct = '';

		$this->data['view_data'] = $checkProduct =  $this->comman_model->get_by($this->_table_names,array('id'=>$id,'account_type'=>'A'),false,false,true);

		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}			

		//var_dump($this->session->all_userdata());
		$heightPoints = 0;
		$this->data['b1']=$this->data['b2']=$this->data['b3']=$this->data['b4']=$this->data['b5']=$this->data['b6']=$this->data['b7']=$this->data['b8']= 0;
		$this->data['fitness_per']	= 0;
		$checkUser = $this->comman_model->get_by('u_f_level',array('user_id'=>$id),false,false,true);
		if($checkUser){				
			$query = "SELECT Max(avgs)as avgs FROM u_f_level where gym_id=".$checkProduct->parent_id." GROUP BY gym_id";
			//echo $query.'<br>';
			$heightPointsData = $this->comman_model->get_query($query,true);
			if($heightPointsData){
				$heightPoints =$heightPointsData->avgs;
				if($checkUser->avgs>0&&$heightPoints>0)
					$this->data['fitness_per']	= round(($checkUser->avgs/$heightPoints)*100,1);
			}

			//b1
			$query = "SELECT Max(power_lift)as avgs FROM u_f_level where gym_id=".$checkProduct->parent_id." GROUP BY gym_id";
			//echo $query.'<br>';
			$hightB1 = $this->comman_model->get_query($query,true);
			if($hightB1){
				$heightPoints =$hightB1->avgs;
				if($checkUser->power_lift>0&&$heightPoints>0)
					$this->data['b1']	= round(($checkUser->power_lift/$heightPoints)*100,1);
			}

			//b2
			$query = "SELECT Max(olympic_lift)as avgs FROM u_f_level where gym_id=".$checkProduct->parent_id." GROUP BY gym_id";
			//echo $query.'<br>';
			$hightB2 = $this->comman_model->get_query($query,true);
			if($hightB2){
				$heightPoints =$hightB2->avgs;
				if($checkUser->olympic_lift>0&&$heightPoints>0)
					$this->data['b2']	= round(($checkUser->olympic_lift/$heightPoints)*100,1);
			}

			//b3
			$query = "SELECT Max(speed)as avgs FROM u_f_level where gym_id=".$checkProduct->parent_id." GROUP BY gym_id";
			//echo $query.'<br>';
			$hightB3 = $this->comman_model->get_query($query,true);
			if($hightB3){
				$heightPoints =$hightB3->avgs;
				if($checkUser->speed>0&&$heightPoints>0)
					$this->data['b3']	= round(($checkUser->speed/$heightPoints)*100,1);
			}

			//b4
			$query = "SELECT Max(endurance)as avgs FROM u_f_level where gym_id=".$checkProduct->parent_id." GROUP BY gym_id";
			//echo $query.'<br>';
			$hightB4 = $this->comman_model->get_query($query,true);
			if($hightB4){
				$heightPoints =$hightB4->avgs;
				if($checkUser->endurance>0&&$heightPoints>0)
					$this->data['b4']	= round(($checkUser->endurance/$heightPoints)*100,1);
			}

			//b5
			$query = "SELECT Max(bodyweight)as avgs FROM u_f_level where gym_id=".$checkProduct->parent_id." GROUP BY gym_id";
			//echo $query.'<br>';
			$hightB5 = $this->comman_model->get_query($query,true);
			if($hightB5){
				$heightPoints =$hightB5->avgs;
				if($checkUser->bodyweight>0&&$heightPoints>0)
					$this->data['b5']	= round(($checkUser->bodyweight/$heightPoints)*100,1);
			}

			//b6
			$query = "SELECT Max(heavy)as avgs FROM u_f_level where gym_id=".$checkProduct->parent_id." GROUP BY gym_id";
			//echo $query.'<br>';
			$hightB6 = $this->comman_model->get_query($query,true);
			if($hightB6){
				$heightPoints =$hightB6->avgs;
				if($checkUser->heavy>0&&$heightPoints>0)
					$this->data['b6']	= round(($checkUser->heavy/$heightPoints)*100,1);
			}

			//b7
			$query = "SELECT Max(light)as avgs FROM u_f_level where gym_id=".$checkProduct->parent_id." GROUP BY gym_id";
			//echo $query.'<br>';
			$hightB7 = $this->comman_model->get_query($query,true);
			if($hightB7){
				$heightPoints =$hightB7->avgs;
				if($checkUser->light>0&&$heightPoints>0)
					$this->data['b7']	= round(($checkUser->light/$heightPoints)*100,1);
			}

			//b8
			$query = "SELECT Max(longs)as avgs FROM u_f_level where gym_id=".$checkProduct->parent_id." GROUP BY gym_id";
			//echo $query.'<br>';
			$hightB8 = $this->comman_model->get_query($query,true);
			if($hightB8){
				$heightPoints =$hightB8->avgs;
				if($checkUser->longs>0&&$heightPoints>0)
					$this->data['b8']	= round(($checkUser->longs/$heightPoints)*100,1);
			}
		}

	
//		echo $this->db->last_query();die;
	
        $this->data['subview'] = $this->_subView.'view';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function ajax_chart(){
		$id = $this->input->post('type');
		$user_id = $this->input->post('user_id');
		$array = array();
			if($id=='day'){
				$this->db->order_by('on_date','asc');
				$entry_data = $this->comman_model->get_by('workouts_entry',array('user_id'=>$user_id),false,false,false);
				if($entry_data){
					foreach($entry_data as $set_entry){
						$query = "SELECT AVG(avgs) as avgs,user_id,entry_id FROM workouts_entry_option where entry_id=$set_entry->id GROUP BY entry_id";
						//echo $query.'<br>';
						$result = $this->comman_model->get_query($query,true);
						
						if($result){
							$array[$set_entry->on_date] =(float)round($result->avgs,2);
						}
					}
				}
//				$result = $this->comman_model->get_query($query);
			}
			else if($id=='month'){}
			else if($id=='year'){}
			else{
				$this->db->order_by('on_date','desc');
				$entry_data = $this->comman_model->get_by('workouts_entry',array('user_id'=>$user_id),false,false,false);
				if($entry_data){
					foreach($entry_data as $set_entry){
							$query = "SELECT AVG(avgs) as avgs,user_id,entry_id FROM workouts_entry_option where entry_id=$set_entry->id GROUP BY entry_id";
						//echo $query.'<br>';
						$result = $this->comman_model->get_query($query,true);
						
						if($result){
							$array[$set_entry->on_date] =(float)round($result->avgs,2);
						}
					}
				}
//				$result = $this->comman_model->get_query($query);
			}
///		echo $query = "SELECT date, COUNT(id) as problem_count, DAY(on_date)AS d, MONTH(on_date) AS m,YEAR(on_date) AS Y  FROM problems GROUP BY Y,m,d ORDER BY  on_date ASC";
		if(empty($array)){
			$array[date('Y-m-d')] = 0;
		}
	//	$array = array('12-7-2016'=>4,'18-7-2016'=>6,'25-7-2016'=>2,'26-7-2016'=>5,'12-07-2016'=>4);
		echo json_encode($array);
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

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */