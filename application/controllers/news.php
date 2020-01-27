<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends Frontend_Controller {
	public $_subView = 'templates/';
	public function __construct(){
		parent::__construct();
		$logged_in = $this->session->userdata('user_session');
		if((isset($logged_in['loggedin']) || $logged_in['loggedin'] == true)){
			if($logged_in['loginType']=='user'){
				$detail = $this->session->all_userdata();
				$this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
			}
		}
	}


	
	function visitor(){
	}

	public function visit_news($id){
		if(isset($this->data['user_details'] )&&!empty($this->data['user_details'])){
			$check = $this->comman_model->get_by('user_news',array('news_id'=>$id,'user_id'=>$this->data['user_details']->id),false,false,false);
			//echo $this->db->last_query();
			if(!count($check)){
				$this->comman_model->save('user_news',array('news_id'=>$id,'user_id'=>$this->data['user_details']->id));
			}
		}
	}


	public function index($id = false){
		$this->data['set_meta'] = 'home';
		if($id){
			$this->data['page'] = $this->comman_model->get_lang('news',$this->data['lang_id'],$id,array('enabled'=>1),'news_id',true);
			if(!$this->data['page']){
				show_404(current_url());
			}
			$this->visit_news($this->data['page']->id);

			$this->data['title'] = $this->data['page']->title." | ".$this->data['settings']['site_name'];
			$this->load->view($this->_subView.'news',$this->data);
		}
		else{
			$this->data['title'] = $this->data['settings']['site_name'];
			$this->data['page'] = $this->comman_model->get_lang('news',$this->data['lang_id'],NULL,array('enabled'=>1),'news_id',false);
			$this->load->view($this->_subView.'all_news',$this->data);
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */