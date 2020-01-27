<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Frontend_Controller {
	public $_subView = 'templates/';
	public function __construct(){
		parent::__construct();
		$logged_in = $this->session->userdata('user_session');
		$this->load->model(array('search_model'));
		if((isset($logged_in['loggedin']) || $logged_in['loggedin'] == true)){
			if($logged_in['loginType']=='user'){
				$detail = $this->session->all_userdata();
				$this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
			}
		}
		$this->data['set_meta'] = 'search';
	}

	public function index(){
		$this->data['title'] = "Search | ".$this->data['settings']['site_name'];
		$this->data['active'] = 'home';
		$this->data['search'] ='';
		$this->data['more_d'] =false;
		if($_GET){
			$this->ajax('template');
		}
		else{
			$stringQuery = "SELECT * FROM (`stores`) WHERE `enabled` =1 order by id desc limit 12 ";	
			$this->data['products'] = $this->comman_model->get_query($stringQuery,false);
		}

		//$this->data['searchs'] = $this->comman_model->get('products',false);
		//echo $this->db->last_query();die;
		$this->load->view('templates/search/index',$this->data);
	}
	

	function ajax($page_type=false){	
		$output = array();
		$output['result']= 'error';
		$this->data['more_d'] = $output['more_d'] = false;
		//$msg = 0;
		$limit = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$set_limit = 12;
		if(!$limit){
			$limit= $set_limit;
		}
		if(!$offset){
			$offset= 0;
		}
		$name = $this->input->get('q');

		$rating = $this->input->get('rating');

		$category = $this->input->get('category');		
		$tag = $this->input->get('tag');

		$city = $this->input->get('city');
		$region = $this->input->get('region');
		$address = $this->input->get('address');
		$country = $this->input->get('country');

		$types = $this->input->get('type');		

		$min_price = $this->input->get('min_price');		
		$max_price = $this->input->get('max_price');

		$userArr =array();
		$where_clause = "";
		$url = site_url().$this->data['lang_code'].'/search?';
		//category
		if($category){
			$where_clause .= " category_id =".$category." and";
			$url .= 'category='.$category.'&';
		}

		//city
		if($city){
			$where_clause .= " city=".$city." and";
			$url .= 'city='.$city.'&';
		}
		//state
		if($region){
			$where_clause .= " state=".$region." and";
			$url .= 'region='.$region.'&';
		}

		//country
		if($country){
			$where_clause .= " country=".$country." and";
			$url .= 'country='.$country.'&';
		}

		//country
		if($address){
			$where_clause .= " address='".$address."' and";
			$url .= 'address='.$address.'&';
		}

		if($name){
			$where_clause .= "(name like '%".$this->input->get('q')."%' or company_nae like '%".$this->input->get('q')."%') and";
			$url .= 'q='.$name.'&';
			
		}

		//price
		/*if($min_price){
			$where_clause .= " price >'".$min_price."' and";
			$wherrArr= array('price >'=>$min_price);
			$url .= 'min_price='.$min_price.'&';
		}
		if($max_price){
			$where_clause .= " price <='".$max_price."' and";
			$url .= 'max_price='.$max_price.'&';
		}
*/
		$url .= 'min_price='.$min_price.'&';
		$url .= 'max_price='.$max_price.'&';

		//rating
		if($rating){
			$stringQuery = "SELECT AVG(rate)AS rate, product_id FROM products_review  where rate >=".$rating." and rate <".($rating+1)." GROUP BY product_id";
			$avgs = $this->comman_model->get_query($stringQuery,false);
			if($avgs){
				foreach($avgs as $avg){					
					$userArr[] = $avg->product_id;
				}
			}						
			$url .= 'rating='.$rating.'&';
		}
		else{
			$url .= 'rating=&';
		}

		if($userArr){
			$where_clause .= " id in (".implode(',',$userArr).") and";
		}

		$where_clause = rtrim($where_clause,'and');

		if($_REQUEST){
			if($where_clause){
				$output['result']= 'ok';

				$stringQuery = "SELECT * FROM (`stores`) WHERE `enabled` = 1 AND ";	
				//$this->data['products'] = $this->comman_model->get_query($stringQuery.$where_clause,false);
				$this->data['products'] = $this->comman_model->get_query($stringQuery.$where_clause." limit $offset ,$limit",false);
				$this->data['map_products'] = $this->comman_model->get_query($stringQuery.$where_clause,false);
				//echo $this->db->last_query();die;
				if($this->data['products']){
					$output['content'] = $this->load->view('templates/search/ajax_search',$this->data,true);
				}
				else{
					$output['content'] = '';
				}

				$checkMoreD = $this->comman_model->get_query($stringQuery.$where_clause,false);
				$count = count($checkMoreD);
				if($count>$offset+$set_limit){
					$this->data['more_d'] = $output['more_d'] = true;
				}

				$output['offset'] =$offset +12;
				$output['limit'] =$limit;

			}
			else{
				$output['content'] = '';
				$output['offset'] = 12;
				$output['limit'] = 12;
			}
		}
		else{
			$output['content'] = '';
		}
		$output['url']= $url;
/*		echo '<pre>';
		print_r($output);*/
		if($page_type=='template'){
		}
		else{
			echo json_encode($output);
		}
		//echo $msg;	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */