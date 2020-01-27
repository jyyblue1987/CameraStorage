<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dancers extends Frontend_Controller {
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


	public function index($id = false,$page= false){
		//$category =  $this->comman_model->get_by('categories',array('slug'=>$id),false,false,true);
		if($id){
			$this->data['products'] = $this->comman_model->get_by('users_profile',array('id'=>$id),false,false,true);
			if(!$this->data['products']){
				show_404(current_url());
			}

			$this->data['title']	= $this->data['products']->name." | ".$this->data['settings']['site_name'];
			
			$this->data['comments'] = $this->comman_model->get_by('products_review',array('product_id'=>$this->data['products']->id),false,false,false);
			
			$this->data['userLike'] = 'fa-heart-o';
			
			if(isset($this->data['user_details'])){
			$checkBook = $this->comman_model->get_by('products_like',array('product_id'=>$this->data['products']->id,'user_id'=>$this->data['user_details']->id),false,false,true);
				if($checkBook){
					$this->data['userLike'] = 'fa-heart';
				}
			}

			$query = "SELECT ownner_id, AVG(rate) AS rate FROM products_review where product_id='".$this->data['products']->id."' GROUP BY ownner_id ORDER BY rate DESC;";
			$checkRate = $this->comman_model->get_query($query,true);
			if($checkRate){
				$this->data['p_rating'] = round($checkRate->rate,1);
			}
			else{
				$this->data['p_rating'] = 0;
			}

			$this->data['p_comment'] = $this->comman_model->get_by('products_review',array('product_id'=>$this->data['products']->id,'enabled'=>1),false,false,false);

			$this->db->limit(4);
			$this->db->order_by('id','desc');
			$this->data['rel_product'] = $this->comman_model->get_by('users_profile',array('id !='=>$this->data['products']->id),false,false,false);

			$this->load->view($this->_subView.'product/index',$this->data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */