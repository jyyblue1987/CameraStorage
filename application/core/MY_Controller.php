<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	public $data = array();
	function __construct()
	{
		parent::__construct();
        $this->data['site_name'] = config_item('site_name');
    }
} 

class Admin_Controller extends MY_Controller{
	public function __construct(){
    	parent::__construct();
		date_default_timezone_set("America/Cancun"); 
		//date_default_timezone_set('GMT');		
//		date_default_timezone_set("Europe/London"); 
		$this->load->helper(array('url','date','form','cms','front','language','emailhtml','text'));	
		$this->load->library(array('form_validation','session','cart','user_agent'));
		$this->load->model(array('account_model','comman_model','admin_model','language_model','settings_model','custom_model'));
		$this->clear_cache();
        $this->form_validation->set_error_delimiters('<p class="alert alert-block alert-danger fade in" style="margin-bottom:2px;padding:5px 10px">', '</p>');


        $this->data['settings'] = $this->settings_model->get_fields();
		$this->data['set_meta'] = '';	
		$this->data['name'] = '';	
		$this->data['active'] = 'home';	
		$this->data['active_sub'] = '';	
		$this->lang->load("admin","english");
		//seo _data
       	$this->data['seo_title'] = $this->data['settings']['meta_title'];
       	$this->data['seo_keywords'] = $this->data['settings']['keywords'];
       	$this->data['seo_description'] = $this->data['settings']['meta_description'];

		$this->data['title'] =$this->data['settings']['site_name'];

//		$this->data['admin_link'] = 'admin';	
		$this->data['admin_link'] = $this->data['settings']['admin_link'];	


        $detail = $this->session->all_userdata();
        if(isset($detail['admin_session']['id'])){
            $this->data['admin_details'] =  $this->comman_model->get_by('admin',array('id'=>$detail['admin_session']['id']),FALSE,FALSE,TRUE);
        }
		

		if(!isset($detail['adminLangSession'])){
			$lang_code = $this->language_model->get_default();
			$lang_id = $this->language_model->get_id($lang_code);
			$this->session->set_userdata('adminLangSession',array('lang_code'=>$lang_code,'lang_id'=>$lang_id));
		}
		else{
			$this->data['adminLangSession'] = $detail['adminLangSession'];
		}
		
		$exception_uris = array(
			$this->data['admin_link'].'/account/login', 
			$this->data['admin_link'].'/account/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			$logged_in = $this->session->userdata('admin_session');
			if((!isset($logged_in['loggedin']) || $logged_in['loggedin'] != true)){
				redirect($this->data['admin_link'].'/account/login','refresh');
			}
		}

        $this->data['print_lang_menu'] = $this->language_model->get_array();

		$this->checkNewTicketTime();
    }

	function checkNewTicketTime(){
/*		$getAllTicket = $this->comman->get_by('problems',array('status'=>'Open'),false,false,false);
		
		die;*/
	}
	
	function clear_cache(){
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
		
    }
} 


class Frontend_Controller extends MY_Controller{
	public function __construct(){
    	parent::__construct();
		date_default_timezone_set("America/Cancun"); 
		//date_default_timezone_set("Asia/Kolkata"); 
		//date_default_timezone_set("Asia/Dubai"); 
		//date_default_timezone_set("GMT"); 
		$this->load->library(array('form_validation','session','cart','user_agent'));
        // Load stuff
        $this->load->model(array('comman_model','page_model','pages_model','language_model','settings_model','category_model','custom_model'));
		$this->load->helper(array('url','form','date','language','text','front','emailhtml'));	
        // Fetch navigation
		$this->data['lang_code'] = (string) $this->uri->segment(1);
        if(empty($this->data['lang_code']))
        {
            $this->data['lang_code'] = $this->language_model->get_default();
            $this->data['lang_currency'] = $this->language_model->get_default_currency();
            $this->data['lang_unit'] = $this->language_model->get_default_unit();
        }
        $this->data['lang_id'] = $this->language_model->get_id($this->data['lang_code']);
        $this->data['lang_currency'] = $this->language_model->get_currency($this->data['lang_code']);
		$this->data['lang_unit'] = $this->language_model->get_unit($this->data['lang_code']);

        $this->data['settings'] = $this->settings_model->get_fields();

		if($this->data['settings']['website_active']==0){
			redirect('/offline/');
		}        

		
/*		$this->data['set_home_background'] = 'image';
		$this->data['home_background'] = $this->comman_model->get_by('home_setting',array('id'=>1),false,false,true);
		if($this->data['home_background'])
			$this->data['set_home_background'] = $this->data['home_background']->type;*/


		//menu
        //$this->data['top_menu'] = $this->pages_model->get_topmenu($this->data['lang_id']);		
		/*--- banner ---*/
/*		$this->data['top_banner'] = $this->comman_model->get_lang('banners',$this->data['lang_id'],NULL,array('template'=>'top'),'banner_id',true);
		$this->data['bottom_banner'] = $this->comman_model->get_lang('banners',$this->data['lang_id'],NULL,array('template'=>'bottom'),'banner_id',false);
		$this->data['right_banner'] = $this->comman_model->get_lang('banners',$this->data['lang_id'],NULL,array('template'=>'right'),'banner_id',false);
		$this->data['left_banner'] = $this->comman_model->get_lang('banners',$this->data['lang_id'],NULL,array('template'=>'left'),'banner_id',false);*/
		/*end of banner*/

		$this->db->order_by('order','asc');
		$this->data['top_menu'] = $this->comman_model->get_lang('page',$this->data['lang_id'],NULL,array('parent_id'=>0,'top_menu'=>1),'page_id',false);

		$this->db->order_by('order','asc');
		$this->data['bottom_menu'] = $this->comman_model->get_lang('page',$this->data['lang_id'],NULL,array('parent_id'=>0,'bottom_menu'=>1),'page_id',false);

        $this->data['print_lang_menu'] = $this->language_model->get_array();

		$this->data['default_image'] = 'assets/uploads/sites/'.$this->data['settings']['product_image'];

       	$this->data['seo_title'] = $this->data['settings']['meta_title'];
       	$this->data['seo_keywords'] = $this->data['settings']['keywords'];
       	$this->data['seo_description'] = $this->data['settings']['meta_description'];
		$this->data['title'] = $this->data['settings']['site_name'];	
		$this->data['set_meta'] = '';	
		$this->data['active'] = '';
		$this->data['search_home'] = false;
        $detail = $this->session->all_userdata();
        $this->data['session_data'] = $this->session->all_userdata();
/*		echo '<pre>';
		print_r($detail);
		die;
*/


		
		if(isset($detail['user_session'])){
			$this->data['user_session'] = $detail['user_session'];
			if(isset($detail['user_session']['loginType'])){
				if($detail['user_session']['loginType']=='user'){
		            $this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
					if(!$this->data['user_details']){
						$this->session->unset_userdata('user_session');						
					}
/*					if($this->data['user_details']&&$this->data['user_details']->status==0){
						$this->session->unset_userdata('user_session');						
					}*/
				}
			}
        }
//		die;
        $detail = $this->session->all_userdata();
		$redirect = false;
		if(isset($detail['user_session'])){
			$this->data['user_account'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
			if(!empty($this->data['user_account'])){
			}
			else{
				$redirect =true;
			}
        }
		else{
			$redirect =true;
		}
		if($redirect){
//			redirect($this->data['lang_code'].'/secure/login');
		}

    }

	function clear_cache(){
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");		
    }

	function mainkAthleteMembership(){
		$nowDate = strtotime(date('Y-m-d'));
		if(isset($this->data['user_details'])){
			if($this->data['user_details']->account_type=='A'){
				$this->db->order_by('s_date','asc');
				$checkmember = $this->comman_model->get_by('athlete_membership',array('user_id'=>$this->data['user_details']->id,'is_expire'=>0),false,false,true);
				if($checkmember){
					$startD = strtotime($checkmember->s_date);
					if($nowDate>=$startD){}
					else{
						$this->session->set_flashdata('error','Sorry!! You can not open untill '.h_dateFormat($this->data['user_details']->plan_start_date,'d-m-Y')); 
						redirect($this->data['_user_link'].'/account');
					}
				}					
				else{
					$this->session->set_flashdata('error','Please Upgrade Your Membership!!'); 
					redirect($this->data['_user_link']);
				}
			}		
		}
		else{
			return 0;
		}
	}

} 

class User_Controller extends MY_Controller{
	public function __construct(){
    	parent::__construct();
		$this->load->library(array('form_validation','session','cart'));
        // Load stuff
        $this->load->model(array('comman_model','page_model','pages_model','language_model','settings_model','category_model','custom_model'));
		$this->load->helper(array('url','form','date','language','text','front','emailhtml'));	
        // Fetch navigation
		$this->data['lang_code'] = (string) $this->uri->segment(1);
        if(empty($this->data['lang_code']))
        {
            $this->data['lang_code'] = $this->language_model->get_default();
            $this->data['lang_currency'] = $this->language_model->get_default_currency();
            $this->data['lang_unit'] = $this->language_model->get_default_unit();
        }
        $this->data['lang_id'] = $this->language_model->get_id($this->data['lang_code']);
        $this->data['lang_currency'] = $this->language_model->get_currency($this->data['lang_code']);
		$this->data['lang_unit'] = $this->language_model->get_unit($this->data['lang_code']);

        $this->data['settings'] = $this->settings_model->get_fields();

		if($this->data['settings']['website_active']==0){
			redirect('/offline/');
		}        

        $this->data['print_lang_menu'] = $this->language_model->get_array();

		$this->data['default_image'] = 'assets/uploads/sites/'.$this->data['settings']['product_image'];

       	$this->data['seo_title'] = $this->data['settings']['meta_title'];
       	$this->data['seo_keywords'] = $this->data['settings']['keywords'];
       	$this->data['seo_description'] = $this->data['settings']['meta_description'];
		$this->data['title'] = $this->data['settings']['site_name'];	
		$this->data['set_meta'] = '';	
		$this->data['active'] = '';
		$this->data['search_home'] = false;
        $detail = $this->session->all_userdata();
        $this->data['session_data'] = $this->session->all_userdata();
/*		echo '<pre>';
		print_r($detail);
		die;
*/


		
		if(isset($detail['user_session'])){
			$this->data['user_session'] = $detail['user_session'];
			if(isset($detail['user_session']['loginType'])){
				if($detail['user_session']['loginType']=='user'){
		            $this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
					if(!$this->data['user_details']){
						$this->session->unset_userdata('user_session');						
					}
				}
			}
        }
		else{
			redirect($this->data['lang_code'].'/secure/login');
		}

    }

	function clear_cache(){
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");		
    }

}

?>