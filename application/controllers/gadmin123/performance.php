<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Performance extends Admin_Controller {
	public $_table_names = 'users';
	public $_table_entry_o = 'workouts_entry_option';	//table name
	public $_table_u_f_level = 'u_f_level';	//table name
	public $_subView = 'admin/performance/';
	public $_redirect = '/performance';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'Performance';
        $this->load->model(array('users_model'));
        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel1'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_cancel'] = $this->data['admin_link'].'/userlist';
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
		$this->checkPermissions('performance');

	}
	
	
	function index(){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],70).'';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

		$this->db->order_by('avgs','desc');
		$this->data['all_data'] = $this->comman_model->get($this->_table_u_f_level,false);

        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function l($id=false){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1780).'Performance';
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
		$this->data['fitness_per']	= 0;
		$b1 = $this->comman_model->get_by('excercises',array('type'=>'Power Lifts'),false,false,false);
		$b2 = $this->comman_model->get_by('excercises',array('type'=>'Olympic Lifts'),false,false,false);
		$b3 = $this->comman_model->get_by('excercises',array('type'=>'Speed'),false,false,false);
		$b4 = $this->comman_model->get_by('excercises',array('type'=>'Endurance'),false,false,false);
		$b5 = $this->comman_model->get_by('excercises',array('type'=>'Bodyweight'),false,false,false);
		$b6 = $this->comman_model->get_by('excercises',array('type'=>'Heavy'),false,false,false);
		$b7 = $this->comman_model->get_by('excercises',array('type'=>'Light'),false,false,false);
		$b8 = $this->comman_model->get_by('excercises',array('type'=>'Long'),false,false,false);
		$bTempArr1 = $bTempArr2 = $bTempArr3 = $bTempArr4 = $bTempArr5 = $bTempArr6 = $bTempArr7 = $bTempArr8  = array();
		$TempArr1 = $TempArr2 = $TempArr3 = $TempArr4 = $TempArr5 = $TempArr6 = $TempArr7 = $TempArr8  = array();
		$this->data['b1'] = $this->data['b2'] = $this->data['b3'] = $this->data['b4'] = $this->data['b5'] = $this->data['b6'] = $this->data['b7'] = $this->data['b8'] =  0;

		if($b1){
			$tempArr = array();
			foreach($b1 as $set_d){
				$tempArr[] = $set_d->id;
			}
			if($tempArr){
				$this->db->where_in('excercise_id',$tempArr);
				$this->db->order_by('on_date','desc');
				$c1 = $this->comman_model->get_by($this->_table_entry_o,array('user_id'=>$id),false,false,true);
				//echo $this->db->last_query();
				if($c1){
					$this->data['b1'] = round($c1->avgs,1);
				}
			}
		}

		if($b2){
			$tempArr = array();
			foreach($b2 as $set_d){
				$tempArr[] = $set_d->id;
			}
			if($tempArr){
				$this->db->where_in('excercise_id',$tempArr);
				$this->db->order_by('on_date','desc');
				$c1 = $this->comman_model->get_by($this->_table_entry_o,array('user_id'=>$id),false,false,true);
				//echo $this->db->last_query();
				if($c1){
					$this->data['b2'] = round($c1->avgs,1);
				}
			}
		}

		if($b3){
			$tempArr = array();
			foreach($b3 as $set_d){
				$tempArr[] = $set_d->id;
			}
			if($tempArr){
				$this->db->where_in('excercise_id',$tempArr);
				$this->db->order_by('on_date','desc');
				$c1 = $this->comman_model->get_by($this->_table_entry_o,array('user_id'=>$id),false,false,true);
				//echo $this->db->last_query();
				if($c1){
					$this->data['b3'] = round($c1->avgs,1);
				}
			}
		}

		if($b4){
			$tempArr = array();
			foreach($b4 as $set_d){
				$tempArr[] = $set_d->id;
			}
			if($tempArr){
				$this->db->where_in('excercise_id',$tempArr);
				$this->db->order_by('on_date','desc');
				$c1 = $this->comman_model->get_by($this->_table_entry_o,array('user_id'=>$id),false,false,true);
				//echo $this->db->last_query();
				if($c1){
					$this->data['b4'] = round($c1->avgs,1);
				}
			}
		}

		if($b5){
			$tempArr = array();
			foreach($b5 as $set_d){
				$tempArr[] = $set_d->id;
			}
			if($tempArr){
				$this->db->where_in('excercise_id',$tempArr);
				$this->db->order_by('on_date','desc');
				$c1 = $this->comman_model->get_by($this->_table_entry_o,array('user_id'=>$id),false,false,true);
				//echo $this->db->last_query();
				if($c1){
					$this->data['b5'] = round($c1->avgs,1);
				}
			}
		}

		if($b6){
			$tempArr = array();
			foreach($b6 as $set_d){
				$tempArr[] = $set_d->id;
			}
			if($tempArr){
				$this->db->where_in('excercise_id',$tempArr);
				$this->db->order_by('on_date','desc');
				$c1 = $this->comman_model->get_by($this->_table_entry_o,array('user_id'=>$id),false,false,true);
				//echo $this->db->last_query();
				if($c1){
					$this->data['b6'] = round($c1->avgs,1);
				}
			}
		}

		if($b7){
			$tempArr = array();
			foreach($b7 as $set_d){
				$tempArr[] = $set_d->id;
			}
			if($tempArr){
				$this->db->where_in('excercise_id',$tempArr);
				$this->db->order_by('on_date','desc');
				$c1 = $this->comman_model->get_by($this->_table_entry_o,array('user_id'=>$id),false,false,true);
				//echo $this->db->last_query();
				if($c1){
					$this->data['b7'] = round($c1->avgs,1);
				}
			}
		}

		if($b8){
			$tempArr = array();
			foreach($b8 as $set_d){
				$tempArr[] = $set_d->id;
			}
			if($tempArr){
				$this->db->where_in('excercise_id',$tempArr);
				$this->db->order_by('on_date','desc');
				$c1 = $this->comman_model->get_by($this->_table_entry_o,array('user_id'=>$id),false,false,true);
				//echo $this->db->last_query();
				if($c1){
					$this->data['b8'] = round($c1->avgs,1);
				}
			}
		}


		$total= $this->data['b1']+$this->data['b2']+$this->data['b3']+$this->data['b4']+$this->data['b5']+$this->data['b6']+$this->data['b7']+$this->data['b8'];
		$this->data['fitness_per']	= round(($total)/8,0);

	
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