<?php
class Competition extends Admin_Controller{
	public $_table_names = 'competitions';
	public $_subView = 'admin/competitions/';

	public $_mainView = 'admin/_layout_main';
	public $_redirect = '/competition';
    public $_current_revision_id;
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'Competition';
        $this->load->model(array('competition_model'));
        // Get language for content id to show in administration

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit_detail';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['session_data'] = $this->session->all_userdata();

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
		$this->checkPermissions('competition');
	}
    	
	function index(){
		//var_dump($this->session->all_userdata());
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1000).'Competition';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;

		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		//$this->load->view('user/orders',$this->data);
        $this->data['subview'] = $this->_subView.'index';			
		$this->load->view($this->_mainView,$this->data);
	}

    public function edit_detail($id = NULL){

	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			if(!$checkProduct){
				redirect($this->data['_cancel']);				
			}
			$this->data['products'] = $checkProduct;
        }
        else{
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['products'] = $this->competition_model->get_new();	
        }

	   	$this->db->order_by('title','asc');
        $this->data['categories_data'] = $this->comman_model->get_lang('c_categories',$this->data['content_language_id'],NULL,array('parent_id'=>0),'category_id',false);


		$this->data['workout_data'] =$this->comman_model->get_by('workouts',array('user_id'=>0,'type'=>'bench mark'),false,false,false);
        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));

        $rules = $this->competition_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data 	= array();
			$post1 =array('name','description','workout','price','place','category','gps','city','street','country');

        	$data = $this->competition_model->array_from_post($post1);
			$data['s_date']	= h_dateFormat($this->input->post('s_date'),'Y-m-d');
			$data['e_date']	= h_dateFormat($this->input->post('e_date'),'Y-m-d');
			$data['s_r_date']	= h_dateFormat($this->input->post('s_r_date'),'Y-m-d');			
			$data['e_r_date']	= h_dateFormat($this->input->post('e_r_date'),'Y-m-d');
			
			//file1

			$this->session->set_userdata('details',$data);
			//redirect($this->data['_cancel']);
			redirect($this->data['_cancel'].'/edit_category/'.$id);
        }

        $this->data['subview'] = $this->_subView.'edit';			
		$this->load->view($this->_mainView,$this->data);
	}

	public function edit_category($id = NULL){

	    // Fetch a page or set a new one
/*		echo '<pre>';
		print_r($this->data['session_data']['details']);die;*/
		if(isset($this->data['session_data']['details'])&&!empty($this->data['session_data']['details'])){}
		else{
//			redirect($this->data['_cancel'].'/edit_detail/'.$id);
		}
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			if(!$checkProduct){
				redirect($this->data['_cancel']);				
			}
			$this->data['products'] = $checkProduct;
        }
        else{
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['products'] = $this->competition_model->get_new();	
        }

	   	$this->db->order_by('title','asc');
        $this->data['categories_data'] = $this->comman_model->get_lang('c_categories',$this->data['content_language_id'],NULL,array('parent_id'=>0),'category_id',false);

		$rules = array(
			'name' 		=> array('field'=>'name', 'label'=>'Salary', 'rules'=>'trim'),
	   );

       $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
			
			//file1

			$post_sell = $this->input->post('sell');
/*			echo '<pre>';
			print_r($post_sell);
			die;*/
			if($post_sell){
				$this->session->set_userdata('p_category',$post_sell);
				redirect($this->data['_cancel'].'/edit_event/'.$id);
			}
			//redirect($this->data['_cancel']);
        }

        $this->data['subview'] = $this->_subView.'edit_category';			
		$this->load->view($this->_mainView,$this->data);
	}

	public function edit_event($id = NULL){
	    // Fetch a page or set a new one
/*		echo '<pre>';
		print_r($this->data['session_data']['details']);die;*/
		if(isset($this->data['session_data']['p_category'])&&!empty($this->data['session_data']['p_category'])){}
		else{
			redirect($this->data['_cancel'].'/edit_category/'.$id);
		}
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			if(!$checkProduct){
				redirect($this->data['_cancel']);				
			}
			$this->data['products'] = $checkProduct;
        }
        else{
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['products'] = $this->competition_model->get_new();	
        }

	   	$this->db->order_by('title','asc');
        $this->data['categories_data'] = $this->comman_model->get_lang('c_categories',$this->data['content_language_id'],NULL,array('parent_id'=>0),'category_id',false);

		$rules = array(
			'name' 		=> array('field'=>'name', 'label'=>'Salary', 'rules'=>'trim'),
	   );

       $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){

            $data 	= array();
//			$post1 =array('name','description','workout','price','place','category','gps');
			foreach($this->data['session_data']['details'] as $key=>$value){
				$data[$key] = $value;
				
			}

            if($id == NULL)$data['order'] = $this->competition_model->max_order()+1;

            if($id == NULL){
				$data['admin_id'] 		= $this->data['admin_details']->id;
                $data['on_date'] 		= date('Y-m-d');
                $data['on_datetime'] 	= date('Y-m-d H:i:s');
                $data['enabled'] 		= 1;
                $data['created'] 		= time();
                $data['modified'] 		= time();
			}
			else{
                $data['modified'] 	= time();
			}
			//file1

			$post_sell = $this->input->post('sell');
			if($post_sell){
				$data['event_text'] =serialize($post_sell);
			}
			if($this->data['session_data']['p_category']){
				$data['category_text'] =serialize($this->data['session_data']['p_category']);
			}
/*			echo '<pre>';
//			print_r($this->data['session_data']['details']);
			echo 'New:';
			print_r($this->data['session_data']['details']);
			print_r($data);
			die;*/
			$id = $this->comman_model->save($this->_table_names,$data, $id);
			if(empty($this->data['product']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            

			$this->session->unset_userdata('p_category');
			$this->session->unset_userdata('details');
			
			redirect($this->data['_cancel']);
			//redirect($this->data['_cancel']);
			//file1

			//redirect($this->data['_cancel']);
        }

        $this->data['subview'] = $this->_subView.'edit_event';			
		$this->load->view($this->_mainView,$this->data);
	}
	
	public function edit($id = NULL){
		die;
	    // Fetch a page or set a new one
	    if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

			$checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
			if(!$checkProduct){
				redirect($this->data['_cancel']);				
			}
			$this->data['products'] = $checkProduct;
			$this->data['products_file'] = $this->comman_model->get_by('workouts_files',array('workout_id'=>$id),false,false,false);
            $this->data['products_options'] =$this->comman_model->get_by('workouts_option',array('product_id'=>$id),false,false,false);
        }
        else{
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['products'] = $this->competition_model->get_new();	
        }

	   	$this->db->order_by('title','asc');
        $this->data['categories_data'] = $this->comman_model->get_lang('c_categories',$this->data['content_language_id'],NULL,array('parent_id'=>0),'category_id',false);


		$this->data['workout_data'] =$this->comman_model->get_by('workouts',array('user_id'=>0,'type'=>'bench mark'),false,false,false);
        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));

        $rules = $this->competition_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){
            $data 	= array();
			$post1 =array('name','description','workout','price','place','category','gps');

        	$data = $this->competition_model->array_from_post($post1);
			$data['s_date']	= h_dateFormat($this->input->post('s_date'),'Y-m-d');
			$data['e_date']	= h_dateFormat($this->input->post('e_date'),'Y-m-d');
			$data['s_r_date']	= h_dateFormat($this->input->post('s_r_date'),'Y-m-d');
			$data['e_r_date']	= h_dateFormat($this->input->post('e_r_date'),'Y-m-d');
            if($id == NULL)$data['order'] = $this->competition_model->max_order()+1;

            if($id == NULL){
				$data['admin_id'] 		= $this->data['admin_details']->id;
                $data['on_date'] 		= date('Y-m-d');
                $data['on_datetime'] 	= date('Y-m-d H:i:s');
                $data['enabled'] 		= 1;
                $data['created'] 		= time();
                $data['modified'] 		= time();
			}
			else{
                $data['modified'] 	= time();
			}
			//file1


/*			echo '<pre>';
			print_r($data);
			die;*/
			$id = $this->comman_model->save($this->_table_names,$data, $id);
			if(empty($this->data['product']->id)){
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],295));
			}
			else
	            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            
			//redirect($this->data['_cancel']);
			redirect($this->data['_cancel'].'/edit/'.$id);
        }

        $this->data['subview'] = $this->_subView.'edit';			
		$this->load->view($this->_mainView,$this->data);
	}

    public function view($id = NULL){
	    // Fetch a page or set a new one
		//for smiley text
		$this->data['name'] = 'View';
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

	    if(!$id)
			redirect($this->data['_cancel']);
	
		$checkProduct = '';
		//check first that workout has admin
		$this->data['view_data']= $checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!$checkProduct){
			redirect($this->data['_cancel']);
		}			
		$this->data['product'] = $this->competition_model->get_new_plan();	

		$this->db->order_by('times','asc');
		$this->data['options_data'] =$this->comman_model->get_by($this->_table_names.'_option',array('product_id'=>$id),false,false,false);

//		echo $this->db->last_query();die;
        $this->data['subview'] = $this->_subView.'view';
		$this->load->view($this->_mainView,$this->data);
	}

	function get_content(){

		$output =array();
		$output['status'] = 'error';
		$id = $this->input->post('id');
		$count = $this->input->post('count');

	/*	$id = 1;
		$count = 1;*/

		$t_html= '';
		if($id&&$count){
			$products = $this->comman_model->get_lang('c_categories',$this->data['adminLangSession']['lang_id'],NULL,array('id'=>$id),'category_id',true);
			$options= '<option value="">Select</option>';
			if($products){			
				$output['status'] = 'ok';
				$html = '<div class="col-md-4 item-'.$count.'">
							<div class="well">
							<input type="hidden" name="sell['.$count.'][id]" value="'.$id.'"  />
							<label class="col-lg-12 control-label" style="text-align:left">'.$products->title.'</label>
							<label class="col-lg-3 control-label">Price</label>
							<div class="col-lg-7">
								<input type="number" name="sell['.$count.'][price]" min="1"   pattern="\d*" class="form-control input-qty-'.$count.'" value="1" onchange="get_qty(this.value,'.$count.');" onkeypress="get_qty(this.value,'.$count.');" />
							</div>                
							<a href="javascript:void(0)"  onclick="delete_item('.$count.');" class="remove_field btn default"><i class="fa fa-times"></i></a>
							</div>
						</div>';
			}
			$output['html'] = $html;
		}
		echo json_encode($output);
	}
	
	function get_event_content(){
		$output =array();
		$output['status'] = 'error';
		$count = $this->input->post('count');

	/*	$id = 1;
		$count = 1;*/

		$t_html= '';
		if($count){
			$workout_data =$this->comman_model->get_by('workouts',array('user_id'=>0,'type'=>'bench mark'),false,false,false);			
			$options= '<option value="">Select</option>';
			if($workout_data){			
				$output['status'] = 'ok';
				foreach($workout_data as $set){
					$options .= '<option value="'.$set->id.'">'.$set->name.'</option>';
				}
			}

			$output['status'] = 'ok';
			$html = '<div class="col-md-12 item-'.$count.'">
						<div class="well">
						<a href="javascript:void(0)"  onclick="delete_item('.$count.');" class="remove_field btn default pull-right"><i class="fa fa-times"></i></a>
						<label class="col-lg-11 control-label" style="text-align:left">Event</label>
						<div class="form-group">
							<label class="col-lg-2 control-label">Workout</label>
						<div class="col-lg-7">
						<select class="form-control " name="sell['.$count.'][workout]" id="" required>'.$options.'</select>
						</div>
						</div><!--//form-group/-->      
						<div class="form-group">
						<label class="col-lg-2 control-label">Date</label>
						<div class="col-lg-7">
							<input type="text" name="sell['.$count.'][dates]" class="form-control input-date" value="'.date('d-m-Y').'" data-date-format="dd-mm-yyyy" data-date-start-date="+0d"  required  />
						</div>
						</div><!--//form-group/-->      
						<div class="form-group">
						<label class="col-lg-2 control-label">Heat capacity</label>
						<div class="col-lg-7">
							<input type="text" name="sell['.$count.'][capacity]" class="form-control" value="" required  />
						</div>
						</div><!--//form-group/-->      
						</div>
					</div>';
			$output['html'] = $html;
		}
		echo json_encode($output);
	}

    public function delete($id){       
		if($this->data['admin_details']->default=='0'){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
	        redirect($this->data['_cancel']);
		}

		$checkProduct = $this->comman_model->get_by($this->_table_names,array('id'=>$id,'admin_id'=>$this->data['admin_details']->id),false,false,true);
		if($checkProduct){
			$this->db->delete($this->_table_names, array('id'=>$id,'admin_id'=>$this->data['admin_details']->id)); 
		}
		else{
			$this->session->set_flashdata('error','Sorry ! You can not delete.');
		}

        redirect($this->data['_cancel']);
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