<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends Admin_Controller {
	public $_table_names = 'product_review';
	public $_subView = 'admin/reviews/';
	public $_redirect = 'admin/review';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'Product Management';
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
    }
	

	//  Landing page of admin section.
	function index(){
		$this->data['title'] = 'Review | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['name'] = 'Review';
		$this->data['login'] = $this->session->all_userdata();	
		if($this->input->get('q')){
			$this->data['search'] = $this->input->get('q');
			$query = "SELECT * FROM (product_review) WHERE (name LIKE '%".$this->input->get('q')."%' OR email LIKE '%".$this->input->get('q')."%' OR comment LIKE '%".$this->input->get('q')."%' ) ORDER BY id desc";

			$this->data['all_data'] =  $this->db->query($query)->result();
				$this->data['pagination'] = '';
			//$this->data['product_data'] = $this->comman_model->get_lang('products',$this->data['lang_id'],NULL,array('user_id'=>$this->data['user_details']->id),'product_id',false);
			/*echo $this->db->last_query();
			echo '<pre>';
			print_r($this->data['product_data']);
			die;*/
		}
		else{
			$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
		}
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function buyer(){
		$this->data['title'] = 'Buyer | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['name'] = 'Buyer';
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function reseller(){
		$this->data['title'] = 'Reseller | '.$this->data['settings']['site_name'];
		$this->data['table'] = true;
		$this->data['name'] = 'Reseller';
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('account_type'=>"S"),false,false,false);
        $this->data['subview'] = $this->_subView.'index_seller';	
		$this->load->view('admin/_layout_main',$this->data);
	}


	function add(){	
		$image = NULL;
		$this->data['name'] = 'Create User';
		$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];

		$rules = $this->admin_model->user_rules;
		$this->form_validation->set_rules($rules);
		if ($this->input->post('operation')){
			if ($this->form_validation->run() == FALSE){}
			else{
				//upload photo
				$post_data= $this->comman_model->array_from_post(array('username','email','password'));
				$post_data['created_by'] = 'admin';
				$post_data['user_type'] = 'free_user';
				$post_data['confirm'] = 'confirm';
				
				if(!empty($_FILES['photo']['name'])){
					//echo $_FILES['photo'.$i]['name'];
					$result =$this->comman_model->do_upload('photo','./assets/uploads/users');
					if($result[0]=='error'){
						$this->session->set_flashdata('error',$result[1]); 
						redirect('admin/users/add');
					}
					else if($result[0]=='success'){
						$image = $result[1];
					}
				}			

				$post_data['image']= $image;
				$registerForm = $this->comman_model->save($this->_table_names,$post_data);
				$this->session->set_flashdata('success', 'User has successfully created.');
				redirect($this->_redirect);
			}
		}
		//$this->data['login'] = $this->session->all_userdata();
        $this->data['subview'] = $this->_subView.'add';
		$this->load->view('admin/_layout_main',$this->data);
	}


	function edit($id= false){
		$this->data['name'] = 'Edit';	
        if(!$id){
            redirect($this->_redirect);
           
        }
        $this->data['title'] ='Edit | '.$this->data['settings']['site_name'];
        
        $edit_data = $this->comman_model->get_by($this->_table_names,array('id'=>$id),FALSE,FALSE,TRUE);
        if(count($edit_data)==0){
           redirect($this->_redirect);
        }
		$this->form_validation->set_rules('username', 'Username', 'trim|required|');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
        if($this->form_validation->run()==TRUE){
			if (!empty($_FILES['photo']['name'])){					
				$result =$this->comman_model->do_upload('photo','./assets/uploads/users');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
					redirect($this->_redirect.'/edit/'.$id);
				}
				else if($result[0]=='success'){
					$image = $result[1];
				}
			}	
			else{
				$image = $edit_data->image;
			}

            $post_data =$this->comman_model->array_from_post(array('username','password')); 
			$post_data['image']= $image;
            $this->comman_model->save($this->_table_names,$post_data,$id);
            $this->session->set_flashdata('success','User has successfully updated.');
            redirect($this->_redirect);
        }
        
        $this->data['edit_data'] =$edit_data;
		$this->data['categories'] = $this->comman_model->get_by('categories',array('parent_id'=>0),false,false,false);		
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = $this->_subView.'edit';        
        $this->load->view('admin/_layout_main',$this->data);       
    }	

	function get_comfirm($id){
		if(!$id){
			redirect($this->_redirect.'/reseller');
		}
		
		$result = $this->comman_model->save($this->_table_names,array('admin_confirm'=>1),$id);
		redirect($this->_redirect.'/reseller');
	}

	function get_status(){
		$id = $this->input->post('id');
		$post_data = array('enabled'=>$this->input->post('status'));
		$result = $this->comman_model->save($this->_table_names,$post_data,$id);
	}

	

	function delete($id = false){
		if(!$id){
			redirect($this->_redirect);
		}

		$this->comman_model->delete_by_id($this->_table_names,array('id'=>$id));
		$this->session->set_flashdata('success','Review has successfully deleted.'); 
		redirect($this->_redirect);		

	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */