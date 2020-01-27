<?php
class Update_lang extends Admin_Controller{
	public $_table_names = 'tags';
	public $_subView = 'admin/update/';
	public $_redirect = '/update_lang';
	public function __construct(){
		parent::__construct();
		$this->data['active'] = 'General Settings';
        $this->load->model('comman_model');
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        // Get language for content id to show in administration
        //$this->data['content_language_id'] = $this->language_model->get_content_lang();
        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
        //$this->data['template_css'] = base_url('templates/'.$this->data['settings']['template']).'/'.config_item('default_template_css');
		$this->checkPermissions('general_setting');
	}
    
    public function index(){
	    // Fetch all pages
		$this->data['title'] = 'Update Data | '.$this->data['settings']['site_name'];
		//$this->data['table'] = true;
		$this->data['name'] = 'Update Data';
		if($this->input->post('operation')){
			$default_lang = $this->comman_model->get_by('language',array('default'=>1),false,false,true);
			if($default_lang){
				$many_lang = $this->comman_model->get_by('language',array('default'=>0),false,false,false);
				if($many_lang){
					foreach($many_lang as $set_lang){
						/*--for page--*/
						$product = $this->comman_model->get('page',false);
						if($product){
							foreach($product as $set_product){
								$product_lang = $this->comman_model->get_by('page_lang',array('page_id'=>$set_product->id,'language_id'=>$set_lang->id),false,false,true);
								if($product_lang){
								}
								else{
									$d_product_lang = $this->comman_model->get_by('page_lang',array('page_id'=>$set_product->id,'language_id'=>$default_lang->id),false,false,true);
									$post_data = array(
											'page_id'=>$set_product->id,
											'language_id'=>$set_lang->id,
											'title'=>$d_product_lang->title,
											'body'=>$d_product_lang->body
											);
									$this->comman_model->add('page_lang',$post_data);
								}
								
							}					
						}

						/*--for product--*/
/*						$product = $this->comman_model->get('products',false);
						if($product){
							foreach($product as $set_product){
								$product_lang = $this->comman_model->get_by('products_lang',array('product_id'=>$set_product->id,'language_id'=>$set_lang->id),false,false,true);
								if($product_lang){
								}
								else{
									$d_product_lang = $this->comman_model->get_by('products_lang',array('product_id'=>$set_product->id,'language_id'=>$default_lang->id),false,false,true);
									//print_r($d_product_lang);
									$post_data = array(
											'product_id'=>$set_product->id,
											'language_id'=>$set_lang->id,
											'title'=>$d_product_lang->title,
											'body'=>$d_product_lang->body
										
											);
//									echo '<pre>';
//									print_r($post_data);
	//								echo '</pre>';
									$this->comman_model->add('products_lang',$post_data);
								}
								
							}					
						}*/
						
						/*-- for brand--*/
						/*-- for category--*/
						$categories = $this->comman_model->get('categories',false);
						if($categories){
							foreach($categories as $set_product){
								$categories_lang = $this->comman_model->get_by('categories_lang',array('category_id'=>$set_product->id,'language_id'=>$set_lang->id),false,false,true);
								if($categories_lang){
								}
								else{
									$d_categories_lang = $this->comman_model->get_by('categories_lang',array('category_id'=>$set_product->id,'language_id'=>$default_lang->id),false,false,true);
									$post_data = array(
											'category_id'=>$set_product->id,
											'language_id'=>$set_lang->id,
											'title'=>$d_categories_lang->title,
											);
									$this->comman_model->add('categories_lang',$post_data);
								}
								
							}					
						}
	
	
					}
				}
				$this->session->set_flashdata('success','Lang Data has successfully updated.');
			}
			else{
				$this->session->set_flashdata('error','Please Select default language.');
			}
			redirect($this->data['_cancel']);			
			//die;
		}
        $this->data['subview'] = $this->_subView.'edit';	
		$this->load->view('admin/_layout_main',$this->data);
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