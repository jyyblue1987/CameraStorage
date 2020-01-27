<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends Admin_Controller {
	public $_table_names = 'admins';
	public $_subView = 'admin/admin/';
	public $_redirect = 'admin/admin';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'admin';
    }
	

	//  Landing page of admin section.
	function index(){
		$this->data['title'] = 'Administrators Management | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Administrators Management';
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['all_data'] = $this->comman_model->get($this->_table_names,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);

	}

	function add(){	
		$image = NULL;
		$this->data['name'] = 'Create';
		$this->data['title'] = 'Create | '.$this->data['settings']['site_name'];

		$rules = $this->admin_model->categories_rules;
		$this->form_validation->set_rules($rules);
		if ($this->input->post('operation')){
			if ($this->form_validation->run() == FALSE){}
			else{
				//upload photo
				$post_data= $this->comman_model->array_from_post(array('name'));
				if(!empty($_FILES['photo']['name'])){
					//echo $_FILES['photo'.$i]['name'];
					$result =$this->comman_model->do_upload('photo','./assets/uploads/categories');
					if($result[0]=='error'){
						$this->session->set_flashdata('error',$result[1]); 
						redirect($this->_redirect);
					}
					else if($result[0]=='success'){
						$image = $result[1];
					}
				}			

				$post_data['image']= $image;
				$registerForm = $this->comman_model->save($this->_table_names,$post_data);
				$this->session->set_flashdata('success', 'Category has successfully created.');
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
        $setting_rules = $this->admin_model->categories_rules;
        $this->form_validation->set_rules($setting_rules);
        if($this->form_validation->run()==TRUE){
			if (!empty($_FILES['photo']['name'])){					
				$result =$this->comman_model->do_upload('photo','./assets/uploads/categories');
				if($result[0]=='error'){
					$this->session->set_flashdata('error',$result[1]); 
					redirect($this->_redirect.'/'.$id);
				}
				else if($result[0]=='success'){
					$image = $result[1];
				}
			}	
			else{
				$image = $edit_data->image;
			}

            $post_data =$this->comman_model->array_from_post(array('name')); 
			$post_data['image']= $image;
            $this->comman_model->save($this->_table_names,$post_data,$id);
            $this->session->set_flashdata('success','Category has successfully updated.');
            redirect($this->_redirect);
        }
        
        $this->data['edit_data'] =$edit_data;
		$this->data['categories'] = $this->comman_model->get_by($this->_table_names,array('parent_id'=>0),false,false,false);		
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = $this->_subView.'edit';        
        $this->load->view('admin/_layout_main',$this->data);       
    }	

	function delete($id = false){
		if(!$id){
			redirect($this->_redirect);
		}

		//$this->comman_model->update('categories',array('parent_id'=>0),array('parent_id'=>$id));
		//$this->comman_model->delete_by_id('files',array('category_id'=>$id));
		$result2 = $this->comman_model->delete_by_id($this->_table_names,array('id'=>$id));

		$this->session->set_flashdata('success','Category has successfully deleted.'); 
		redirect($this->_redirect);		

	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */