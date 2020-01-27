<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remark extends Admin_Controller {
	public $_table_names = 'remarks';
	public $_subView = 'admin/remark/';
	public $_redirect = '/remark';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'Product Management';
        $this->load->model(array('store_model','remark_model'));
        // Get language for content id to show in administration

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_product==1){}
			else{
				$redirect = true;
			}
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}
    }
	
	function index(){
	}

	function calander($id=false){
		$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],101);
		$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
	    if($id){
			$this->data['stores']  = $this->comman_model->get_by('stores',array('id'=>$id),false,false,true);
            if(!$this->data['stores']){
	            redirect($this->data['_cancel']);
			}
			$this->data['user_data']  = $this->comman_model->get_by('users',array('id'=>$this->data['stores']->user_id),false,false,true);
        }
        else{
			redirect($this->data['_cancel']);
        }
		
	    // Fetch a page or set a new one
		$this->data['id'] = $id;

		$this->data['subview'] = $this->_subView.'index';
        $this->load->view('admin/_layout_main', $this->data);
	}



	function ajax_appointment($id=false){
		if($id){
			$check_product = $this->comman_model->get_by('stores',array('id'=>$id),false,false,true);
			$product_arr =array();
			if($check_product){
				$this->db->where('owner_id',$check_product->user_id);
				$all_data = $this->comman_model->get('remarks',false);
///				echo $this->db->last_query();
			
				$appointments = array();
				if($all_data){
					foreach($all_data as $set_data){
		/*				$case = $this->comman_model->get_by('cases',array('id'=>$set_data->case_id,'user_id'=>$this->data['user_details']->id),false,false,true);
						if($case){
							$appointments[] = array('title'=>$case->name,'start'=>date("Y-m-d", strtotime($set_data->start_date)));
						}
		*/
		
						$appointments[] = array('title'=>$set_data->name,'start'=>date("Y-m-d", strtotime($set_data->dates)),'url'=>$this->data['_cancel'].'/view/'.$id.'/'.$set_data->id,'description'=>$set_data->desc);
					}
				}		
				echo json_encode($appointments);
			}
		}
	}


	function edit($page=false,$id= NULL){
	    // Fetch a page or set a new one
	    if($page){
			$this->data['stores'] = $this->comman_model->get_by('stores',array('id'=>$page),false,false,true);

            if(!$this->data['stores']){
	            redirect($this->data['_cancel'].'/remark/calander/'.$page);
			}
		}
		else{
			redirect($this->data['admin_link'].'/store');
		}
		
		if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
			$this->data['remarks'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);

            if(!$this->data['remarks']){
	            redirect($this->data['_cancel'].'/remark/calander/'.$page);
			}
        }
        else
        {
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],257);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
            $this->data['remarks'] = $this->remark_model->get_new_ticket();
        }

        // Set up the form
		$this->form_validation->set_message('required', '%s '.show_static_text($this->data['adminLangSession']['lang_id'],219));
        $rules = $this->remark_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE){

        	$storeData['store_id'] = $page;


            $data =array();
            $data = $this->remark_model->array_from_post(array('name','category_id','desc','dates'));
            $data['user_id'] = $this->data['stores']->user_id;
            $data['owner_id'] =$this->data['stores']->user_id;

			if($id ==NULL){
            	$data['created_by'] ='admin';
			}

            if(!empty($_FILES['logo'])){
                $config['upload_path']      = 'assets/uploads/remarks/';
                $config['allowed_types']    = '*';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('logo')){
                    if($_FILES['logo']['error'] != 4){
                        $this->session->set_flashdata('error', $this->upload->display_errors());
                    }
                }
                else{
					$upload_info = $this->upload->data();
					$data['files'] = $upload_info['file_name'];
				}
            }
			else{
				 if($id != NULL)
                $data['files']  = $this->data['remark']->image;
            }      

           	$this->comman_model->save($this->_table_names,$data,$id);
			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel'].'/calander/'.$page);
			//die;
        }

        $this->data['_cancel'] = $this->data['_cancel'].'/calander/'.$page;
		$this->data['subview'] = $this->_subView.'edit';
        $this->load->view('admin/_layout_main', $this->data);
	}

	function view($page=false,$id= NULL){
	    // Fetch a page or set a new one
	    if($page){
			$this->data['stores'] = $this->comman_model->get_by('stores',array('id'=>$page),false,false,true);

            if(!$this->data['stores']){
	            redirect($this->data['_cancel'].'/remark/calander/'.$page);
			}
		}
		else{
			redirect($this->data['admin_link'].'/store');
		}
		
		if($id){
			$this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],254);
			$this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
			$this->data['remarks'] = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
            if(!$this->data['remarks']){
	            redirect($this->data['_cancel'].'/remark/calander/'.$page);
			}
        }
        else
        {
            if(!$this->data['stores']){
	            redirect($this->data['_cancel'].'/remark/calander/'.$page);
			}
        }


		$this->data['subview'] = $this->_subView.'view';
        $this->load->view('admin/_layout_main', $this->data);
	}	

	function download($page= false, $id = false){
		$this->load->helper('download');
		if(!$page){
			redirect($this->data['_cancel'].'/store');
		}
		if(!$id){
			redirect($this->data['_cancel'].'/remark/calander/'.$page);
		}
			//$this->comman_model->save('files',array('download_count'=>$download_file->download_count+1),$download_file->id);
		$data = file_get_contents('assets/uploads/remarks/'.$id);
		force_download($id,$data); 
	}



	function delete($page= false,$id = false){
		if(!$page){
			redirect($this->data['admin_link'].'/store');
		}
		if(!$id){
            redirect($this->data['_cancel'].'/'.$page);
		}
		$check = $this->comman_model->get_by($this->_table_names,array('id'=>$id),false,false,true);
		if(!$check){
			$this->session->set_flashdata('error','There is no store.'); 
            redirect($this->data['_cancel'].'/calander/'.$page);
		}

		//$this->comman_model->update('categories',array('parent_id'=>0),array('parent_id'=>$id));

		$this->comman_model->delete_by_id($this->_table_names,array('id'=>$id));
		$this->session->set_flashdata('success','data has successfully deleted.'); 
		redirect($this->data['_cancel'].'/calander/'.$page);
	}

}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */