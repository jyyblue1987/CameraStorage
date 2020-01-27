<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_page extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date'));	
		$this->load->library(array('form_validation','pagination','session'));
		$this->load->model(array('page_model','comman_model','user_model','search_model','language_model','settings_model'));
		$this->data['set_meta'] = '';	
        $this->data['settings'] = $this->settings_model->get_fields();

/*		$this->data['lang_code'] = (string) $this->uri->segment(1);
        if(empty($this->data['lang_code']))
        {
            $this->data['lang_code'] = $this->language_model->get_default();
        }
        $this->data['lang_id'] = $this->language_model->get_id($this->data['lang_code']);*/
	}

	function search_by_location(){
		$this->data['lang_code'] = $this->input->post('lang_code');
		$this->data['lang_id'] = $this->input->post('lang_id');
		$gps = explode(',',$this->input->post('gps'));		
		$dis = $this->input->post('dis');		
		
		
		//$this->data['searchs'] = $this->comman_model->get_lang('products',$this->data['lang_id'],NULL,array('enabled'=>1),'product_id',false);

		$this->db->select('longitude,id');
		$all_product = $this->comman_model->get('products',false);
		$product_array = array();
		if($all_product){			
			foreach($all_product as $set_product){
				$gps1  = explode(',',$set_product->longitude);		
				$distance = round($this->distance($gps[0],$gps[1],$gps1[0],$gps1[1] , "K"),2);
				//echo $dis.', new: '.$distance = $this->distance($gps[0],$gps[1],$gps1[0],$gps1[1] , "K").'<br>';
				
				if($distance<=$dis){
					//echo 'Id:'.$set_product->id.'<br>';
					$product_array[] = $set_product->id;
				}
			}
		}
		if(!empty($product_array)){
			$this->db->where_in('id',$product_array);
			$this->data['searchs'] = $this->comman_model->get_lang('products',$this->data['lang_id'],NULL,array('enabled'=>1),'product_id',false);
		}
		else{
			$this->data['searchs'] = '';
		}

		$this->load->view('templates/product_content',$this->data);
	}
	

	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
	
	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);
	
	  if ($unit == "K") {
		return ($miles * 1.609344);
	  } else if ($unit == "N") {
		  return ($miles * 0.8684);
		} else {
			return $miles;
		  }
	}




	function get_address(){
		$result =array();
		$address = $this->input->post('address');		
		$address = str_replace(" ", "+", $address);
		$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
		$json = json_decode($json);
		$result['lat'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$result['long'] = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		//return json_deco;
	}

	public function upload_editor_image(){
		$url = 'assets/uploads/editors/'.time()."_".$_FILES['upload']['name'];
		$showurl = base_url().$url;
		if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name'])) )
		{
		   $message = "No file uploaded.";
		}
		else if ($_FILES['upload']["size"] == 0)
		{
		   $message = "The file is of zero length.";
		}
		else if (($_FILES['upload']["type"] != "image/pjpeg") AND ($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png"))
		{
		   $message = "The image must be in either JPG or PNG format. Please upload a JPG or PNG instead.";
		}
		else if (!is_uploaded_file($_FILES['upload']["tmp_name"]))
		{
		   $message = "You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.";
		}
		else {
		  $message = "";
		  $move = @ move_uploaded_file($_FILES['upload']['tmp_name'], $url);
		  if(!$move)
		  {
			 $message = "Error moving uploaded file. Check the script is granted Read/Write/Modify permissions.";
		  }
		  $url = $url;
		}
		$funcNum = $_GET['CKEditorFuncNum'] ;
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$showurl', '$message');</script>";	
	}


	function check_agency_login(){
				
		$msg=0;
		$email=trim(mysql_real_escape_string($this->input->post('email')));		
		$password=trim(mysql_real_escape_string($this->input->post('userPassword')));
		$check =$this->comman_model->get_by('products',array('email'=>$email,'password'=>$password),false,false,true);
		if(count($check)==0){
			$msg=1;
		}
		else{
			if($check->confirm!='confirm'){
				$msg=2;
			}
			else if($check->status!=1){
				$msg=3;
			}
			else{
				$session_data = array(
						'loginType' => 'agency',
						'loggedin' => true,				   
						'name' =>$check->first_name.' '.$check->last_name,
						'email' =>$check->email,
						'id' =>$check->id);				
				//$total = $login['bonus_balance']+10;
				$this->session->set_userdata('user_session',$session_data);					
				$msg='';
			}
		}
		echo $msg;			
	}
	function check_login(){		
		$msg=0;
		$email=trim(mysql_real_escape_string($this->input->post('email')));		
		$password=trim(mysql_real_escape_string($this->input->post('userPassword')));
		$check =$this->comman_model->get_by('users',array('email'=>$email,'password'=>$password),false,false,true);
		if(count($check)==0){
			$msg=1;
		}
		else{
			if($check->confirm!='confirm'){
				$msg=2;
			}
			else if($check->status!=1){
				$msg=3;
			}
			else{
				$session_data = array(
						'loginType' => 'user',
						'loggedin' => true,				   
						'name' =>$check->first_name.' '.$check->last_name,
						'email' =>$check->email,
						'id' =>$check->id);				
				//$total = $login['bonus_balance']+10;
				$this->session->set_userdata('user_session',$session_data);					

/*					if($remember){
					   setcookie("unamesabya", $_SESSION['emailAddress'], time()+(3600*24*1*365));
					   setcookie("passwordsabya",$userPassword, time()+(3600*24*1*365));
					}
					else{	
					   setcookie("unamesabya", $_SESSION['emailAddress'], time()-(3600*24*1*365));
					   setcookie("passwordsabya",$userPassword, time()-(3600*24*1*365));
					}
*/
				$msg='';
				//$_SESSION['ecityuser']=$email;
			}
		}
		echo $msg;
	}

	function send_contact(){
		$email_data = $this->comman_model->get_by('email',array('id'=>4),false,false,true);
					
		$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
		$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->subject);

		$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
		$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
		$email_data->message = str_replace('{first_name}', $this->input->post('firstNm'), $email_data->message);
		$email_data->message = str_replace('{last_name}', $this->input->post('lastNm'), $email_data->message);
		$email_data->message = str_replace('{email}', $this->input->post('email_contact'), $email_data->message);
		$email_data->message = str_replace('{message}', $this->input->post('messege_contact'), $email_data->message);
		$email_data->message = str_replace('{site_link}', base_url(), $email_data->message);

		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);
		$this->email->from($this->input->post('email_contact'), $this->input->post('firstNm'));
		$this->email->to($this->data['settings']['site_email']);
		$this->email->subject($email_data->subject);
		$this->email->message($email_data->message);
		if($this->email->send()){
			echo "<p style='color:#0F0'>Mail Successfully Sent!!</p>";
			//$this->session->set_flashdata('success', 'Thanks for your message- a representative will be in touch with you shortly !');			
			
		}
		else{
			echo "<p style='color:#F00'>Mail Can not Be Send Dur To Some Server Problem</p>";
			//$this->session->set_flashdata('error', 'Something error in sending mail.');
		}
	}

	function contact_error(){
		$value=$_POST['value'];
		if($value=="1"){
			echo '<p style="color:#F00">Please Enater your First Name</p>';
		}
		if($value=="2"){
			echo '<p style="color:#F00">Please Enater your Last Name</p>';
		}
		if($value=="3"){
			echo '<p style="color:#F00">Please Enter Email Adress</p>';
		}
		if($value=="4"){
			echo '<p style="color:#F00">Please Enter Proper Email Adress</p>';
		}
		if($value=='5'){
			echo '<p style="color:#F00">Please enter the Messege</p>';
		}
	}

	function error_item(){
		//$data=$_REQUEST['data'];
		$value=$_REQUEST['value'];
		if($value=='1'){
			echo '<span>Invalid email-ID or password.</span>';
		}
		if($value=='2'){
			echo '<span>Your email-ID is not confirm.</span>';
		}
		if($value=='3'){
			echo '<span>Your account has diactived.</span>';
		}
		if($value=='4'){
		}
		if($value=='5'){
		}
		if($value=='50'){
			echo '<span>Invalid email-ID or password.</span>';
		}
		if($value=='51'){
			echo '<span>Your email-ID is not confirm.</span>';
		}
		if($value=='52'){
			echo '<span>Your account has diactived.</span>';
		}
		if($value=='53'){
			echo '<span>Email is required.</span>';
		}
		if($value=='54'){
			echo '<span>Password is required.</span>';
		}
		if($value=='55'){
		}
		if($value=='56')
		{
		}
		if($value=='57')
		{
		}
		if($value=='58')
		{
		}
		if($value=='59')
		{
		}
		if($value=='60')
		{
		}
		if($value=='61'){
			echo '<span>Email is required.</span>';
		}
		if($value=='62'){
			echo '<span>You have sucessfully register with Newsletter.</span>';
		}
		if($value=='63'){
			echo '<span>You have already registered with Newsletter.</span>';
		}		
	}
	
	function reset_menu1(){
		$regionID = $this->input->post('regionID');
		$lang_id = $this->input->post('lang_id');
		$lang_code = $this->input->post('lang_code');
		if($regionID){
			$where = $regionID;
			$on_click = 'onclick="get_page();"';
		}
		else{
			$where = 0;
			$on_click = '';
		}
		$this->db->order_by('order','desc');
		$set_menus  = $this->comman_model->get_lang('page',$lang_id,NULL,array('parent_id'=>0,'region_id'=>$where),'page_id',false);
		echo '<nav id="ddmenu"><div class="menu-icon"></div>';
		if($set_menus){
			foreach($set_menus as $set_menu){
				$this->db->order_by('order','asc');
				$chlid_menu = $this->comman_model->get_lang('page',$lang_id,NULL,array('parent_id'=>$set_menu->id,'region_id'=>$where),'page_id',false);
				if($chlid_menu){
					//echo '<li class="full-width"><span class="top-heading" >'.$set_menu->title.'</span><i class="caret"></i>';
					echo '<li class="full-width"><a href="'.$lang_code.'/pages/'.$set_menu->id.'" class="top-heading" '.$on_click.' >'.$set_menu->title.'</a><i class="caret"></i>';
					echo '<div class="dropdown"><div class="dd-inner">';
					foreach($chlid_menu as $set_child_menu){
						echo '<a href="'.$lang_code.'/pages/'.$set_child_menu->id.'" '.$on_click.'>'.$set_child_menu->title.'</a>';
					}
					echo '<div style="clear:both"></div></div></li>';			
				}
				else{
					echo '<li class="no-sub"><a href="'.$lang_code.'/pages/'.$set_menu->id.'" class="top-heading" '.$on_click.' >'.$set_menu->title.'</a></li>';
				}
			}
		}
		echo '</nav>';
	}

	function default_menu(){
		$regionID = $this->input->post('regionID');
		$lang_id = $this->input->post('lang_id');
		$lang_code = $this->input->post('lang_code');
		if($regionID){
			$where = $regionID;
		}
		else{
			$where = 0;
		}
		$this->db->order_by('order','asc');
		$set_menus  = $this->comman_model->get_lang('page',$lang_id,NULL,array('parent_id'=>0,'region_id'=>$where),'page_id',false);
		if($set_menus){
			foreach($set_menus as $set_menu){
				$this->db->order_by('order','asc');
				$chlid_menu = $this->comman_model->get_lang('page',$lang_id,NULL,array('parent_id'=>$set_menu->id,'region_id'=>$where),'page_id',false);
				if($chlid_menu){
					echo '<li class="has-sub"><a href="'.$lang_code.'/pages/'.$set_menu->id.'" >'.$set_menu->title.'</a>';
					echo '<ul class="">';
					foreach($chlid_menu as $set_child_menu){
						echo '<li><a href="'.$lang_code.'/pages/'.$set_child_menu->id.'" >'.$set_child_menu->title.'</a></li>';
					}
					echo '</ul>';			
				}
				else{
					echo '<li class=""><a href="'.$lang_code.'/pages/'.$set_menu->id.'" >'.$set_menu->title.'</a>';
				}
				echo '</li>';
			}
		}	
	}
	
	function reset_menu(){
		$regionID = $this->input->post('regionID');
		$lang_id = $this->input->post('lang_id');
		$lang_code = $this->input->post('lang_code');
		if($regionID){
			$where = $regionID;
			$on_click = '1';
		}
		else{
			$where = 0;
			$on_click ='';
		}
		$this->db->order_by('order','asc');
		$set_menus  = $this->comman_model->get_lang('page',$lang_id,NULL,array('parent_id'=>0,'region_id'=>$where),'page_id',false);
		if($set_menus){
			if($on_click!=''){
				foreach($set_menus as $set_menu){
					$this->db->order_by('order','asc');
					$chlid_menu = $this->comman_model->get_lang('page',$lang_id,NULL,array('parent_id'=>$set_menu->id,'region_id'=>$where),'page_id',false);
					if($chlid_menu){
						echo '<li class="has-sub"><a onclick="get_page('.$set_menu->id.');" style="cursor:pointer">'.$set_menu->title.'</a>';
						echo '<ul class="">';
						foreach($chlid_menu as $set_child_menu){
							echo '<li><a onclick="get_page('.$set_child_menu->id.');" style="cursor:pointer">'.$set_child_menu->title.'</a></li>';
						}
						echo '</ul>';			
					}
					else{
						echo '<li class=""><a onclick="get_page('.$set_menu->id.');" style="cursor:pointer">'.$set_menu->title.'</a>';
					}
					echo '</li>';
				}
			}
			else{
				foreach($set_menus as $set_menu){
					$this->db->order_by('order','asc');
					$chlid_menu = $this->comman_model->get_lang('page',$lang_id,NULL,array('parent_id'=>$set_menu->id,'region_id'=>$where),'page_id',false);
					if($chlid_menu){
						echo '<li class="has-sub"><a href="'.$lang_code.'/pages/'.$set_menu->id.'" '.$on_click.'>'.$set_menu->title.'</a>';
						echo '<ul class="">';
						foreach($chlid_menu as $set_child_menu){
							echo '<li><a href="'.$lang_code.'/pages/'.$set_child_menu->id.'" '.$on_click.'>'.$set_child_menu->title.'</a></li>';
						}
						echo '</ul>';			
					}
					else{
						echo '<li class=""><a href="'.$lang_code.'/pages/'.$set_menu->id.'" '.$on_click.'>'.$set_menu->title.'</a>';
					}
					echo '</li>';
				}
			}
		}
	}
	
	function set_subregion(){
		
		$this->load->model('region_model');
		$region=$_REQUEST['region'];
		$lang_code = $this->input->post('lang_code');
		$lang_id = $this->input->post('lang_id');
		if($region!=0){
			$subregions = $this->comman_model->get_by('regions',array('parent_id'=>$region), FALSE, FALSE, FALSE);
			if($subregions){
				foreach($subregions as $set_sub_regions){
					$subLang = $this->comman_model->get_by('regions_lang',array('region_id'=>$set_sub_regions->id,'language_id'=>$lang_id), FALSE, FALSE, TRUE);
					echo '<option value="'.$set_sub_regions->id.'">'.$subLang->title.'</option>';
				}
			}
			else{
				echo '0';
			}
		}
		else{
			echo '0';
		}			
	}

	function set_lTags(){
		$region = $this->input->post('region');
		$sub_region = $this->input->post('sub_region');
		$e_group = $this->input->post('e_group');
		$entity = $this->input->post('s_entity');
		$tagsID = $this->input->post('tagsID');
		$lang_id = $this->input->post('lang_id');
		$lang_code = $this->input->post('lang_code');
		$i=1;
		$gps = $this->input->post('gps');		
		$dis = $this->input->post('dis');		
		$product_arr= '';		
		$condiction = '';
		$product_tag = '';

		$tagarr=array();
		if($_REQUEST['tagsID'] && $_REQUEST['tagsID']!='null' ){
			$pos = strpos($_REQUEST['tagsID'], ',');
			if($pos===false){
				$tagarr[]=$_REQUEST['tagsID'];
			}
			else{
				$tagarr=explode(',',$_REQUEST['tagsID']);
			}
		}

		$this->db->select('longitude,id');
		$all_product = $this->comman_model->get('products',false);
		$product_array = array();
		if($gps&&$gps!=''){
			$gps = explode(',',$this->input->post('gps'));		
				
			if($all_product){			
				foreach($all_product as $set_product){
					$gps1  = explode(',',$set_product->longitude);		
					$distance = round($this->distance($gps[0],$gps[1],$gps1[0],$gps1[1] , "K"),2);
					//echo $dis.', new: '.$distance = $this->distance($gps[0],$gps[1],$gps1[0],$gps1[1] , "K").'<br>';
					
					if($distance<=$dis){
						//echo 'Id:'.$set_product->id.'<br>';
						//$product_array[] = $set_product->id;
						$product_arr .= $set_product->id.',';
					}
				}
			}
		}
		
		if($product_arr!=''){
			$product_tag =  ' and id in ('.rtrim($product_arr,",").')';
		}

		if($region&&$region!=0){
			$condiction.="and region_id='$region' ";
		}
		if($e_group&&$e_group!=0){
			$condiction.="and entity_group_id='$e_group' ";
		}
		$result = $this->db->query("SELECT * FROM tags_lang WHERE language_id = '$lang_id' AND tag_id IN  (SELECT tag_id  FROM product_tag WHERE  product_id IN (SELECT id FROM products WHERE enabled=1 $condiction $product_tag))")
		->result();
		//echo $this->db->last_query();
		//echo '<select data-placeholder="Choose Tags" id="tagsID"  class="chosen-select" multiple  style="width:100%" onChange="set_region();set_entity_group();set_entity();search_final()"  name="tags[]" tabindex="4"><option value=""></option>';
		echo '<select data-placeholder="Choose Tags" id="tagsID"  class="chosen-select" multiple  style="width:100%" onChange="set_entity_group();set_region();search_final()"  name="tags[]" tabindex="4"><option value=""></option>';
		if($result){
			foreach($result as $set_result){
				if(in_array($set_result->tag_id,$tagarr)){
					echo '<option value="'.$set_result->tag_id.'" selected>'.$set_result->title.'</option>';
				}
				else{
					echo '<option value="'.$set_result->tag_id.'" >'.$set_result->title.'</option>';
				}
			}
		}
		echo '</select>';
	}
	
	function set_entity_group(){
		$region = $this->input->post('region');
		$sub_region = $this->input->post('sub_region');
		$e_group = $this->input->post('e_group');
		$entity = $this->input->post('s_entity');
		$tagsID = $this->input->post('tagsID');
		$lang_id = $this->input->post('lang_id');
		$lang_code = $this->input->post('lang_code');
		$gps = $this->input->post('gps');		
		$dis = $this->input->post('dis');		
		$product_arr= '';

		$i=1;
		$condiction = '';
				$product_tag = '';
		if($e_group&&$e_group!=0){
			$condiction.="and entity_group_id='$e_group'";
		}		
		if($tagsID&& $tagsID!='null' ){
			$tagarr=array();
			$pos = strrpos($tagsID, ",");
			if($pos===false){
				$tagarr[]=$tagsID;
			}
			else{
				$tagarr=explode(',',$tagsID);
			}
			if(count($tagarr)>0){
				//$product_arr= '';
				foreach($tagarr as $values){
					$this->db->select('product_id');
					$check_product = $this->comman_model->get_by('product_tag',array('tag_id'=>$values),false,false);
					//echo '<br>'.$this->db->last_query();
					
					if($check_product){
						foreach($check_product as $set_pro){
						$product_arr .=$set_pro->product_id.',';
						}
					}
				}
				//$product_tag =  ' and id in ('.rtrim($product_arr,",").')';
			}
		}

		$this->db->select('longitude,id');
		$all_product = $this->comman_model->get('products',false);
		$product_array = array();
		if($gps&&$gps!=''){
			$gps = explode(',',$this->input->post('gps'));		
				
			if($all_product){			
				foreach($all_product as $set_product){
					$gps1  = explode(',',$set_product->longitude);		
					$distance = round($this->distance($gps[0],$gps[1],$gps1[0],$gps1[1] , "K"),2);
					//echo $dis.', new: '.$distance = $this->distance($gps[0],$gps[1],$gps1[0],$gps1[1] , "K").'<br>';
					
					if($distance<=$dis){
						//echo 'Id:'.$set_product->id.'<br>';
						//$product_array[] = $set_product->id;
						$product_arr .= $set_product->id.',';
					}
				}
			}
		}
		
		if($product_arr!=''){
			$product_tag =  ' and id in ('.rtrim($product_arr,",").')';
		}


		if($region&&$region!=0){
			$condiction.="and region_id='$region'";
		}
		$result = $this->db->query("SELECT * FROM entity_groups_lang WHERE language_id='$lang_id' AND entity_group_id IN (SELECT entity_group_id FROM products WHERE enabled=1 $condiction $product_tag)")
		->result();
/*		$result = $this->db->query("SELECT * FROM entity_groups_lang WHERE language_id='1' AND entity_group_id IN (SELECT entity_group_id FROM products WHERE region_id='1')")
		->result();*/
/*		echo $this->db->last_query();
		echo '<pre>';
		print_r($result);*/
		if($result){
			foreach($result as $set_result){
				echo '<option value="'.$set_result->entity_group_id.'">'.$set_result->title.'</option>';
			}
		}
		//echo "SELECT * FROM entity_groups_lang  WHERE   language_id='1' AND entity_group_id IN (SELECT entity_group_id FROM products WHERE region_id='1'  )";

	}

	function set_entity_name(){
		$e_group = $_REQUEST['e_group'];
		$lang_code = $this->input->post('lang_code');
		$lang_id = $this->input->post('lang_id');
		if($e_group!=0){
			$subregions = $this->comman_model->get_by('entity_names',array('entity_group_id'=>$e_group), FALSE, FALSE, FALSE);
			if($subregions){
				foreach($subregions as $set_sub_regions){
					$subLang = $this->comman_model->get_by('entity_names_lang',array('entity_name_id'=>$set_sub_regions->id,'language_id'=>$lang_id), FALSE, FALSE, TRUE);
					echo '<option value="'.$set_sub_regions->id.'">'.$subLang->title.'</option>';
				}
			}
			else{
				echo '0';
			}
		}
		else{
			echo '0';
		}			
	}
	
	function set_region(){
		$region = $this->input->post('region');
		$sub_region = $this->input->post('sub_region');
		$e_group = $this->input->post('e_group');
		$entity = $this->input->post('s_entity');
		$tagsID = $this->input->post('tagsID');
		$lang_id = $this->input->post('lang_id');
		$lang_code = $this->input->post('lang_code');
		
		$gps = $this->input->post('gps');		
		$dis = $this->input->post('dis');		
		$product_arr= '';
		
		$condiction = '';
		$product_tag = '';
		if($e_group&&$e_group!=0){
			$condiction.="and entity_group_id='$e_group'";
		}		
		if($tagsID&& $tagsID!='null' ){
			$tagarr=array();
			$pos = strrpos($tagsID, ",");
			if($pos===false){
				$tagarr[]=$tagsID;
			}
			else{
				$tagarr=explode(',',$tagsID);
			}
			if(count($tagarr)>0){
				foreach($tagarr as $values){
					$this->db->select('product_id');
					$check_product = $this->comman_model->get_by('product_tag',array('tag_id'=>$values),false,false);
					//echo '<br>'.$this->db->last_query();
					
					if($check_product){
						foreach($check_product as $set_pro){
							$product_arr .=$set_pro->product_id.',';
						}
					}
				}
			}
		}

		//get object by distance 
		$this->db->select('longitude,id');
		$all_product = $this->comman_model->get('products',false);
		$product_array = array();
		if($gps&&$gps!=''){
			$gps = explode(',',$this->input->post('gps'));		
				
			if($all_product){			
				foreach($all_product as $set_product){
					$gps1  = explode(',',$set_product->longitude);		
					$distance = round($this->distance($gps[0],$gps[1],$gps1[0],$gps1[1] , "K"),2);
					//echo $dis.', new: '.$distance = $this->distance($gps[0],$gps[1],$gps1[0],$gps1[1] , "K").'<br>';
					
					if($distance<=$dis){
						//echo 'Id:'.$set_product->id.'<br>';
						//$product_array[] = $set_product->id;
						$product_arr .= $set_product->id.',';
					}
				}
			}
		}
		
		if($product_arr!=''){
			$product_tag =  ' and id in ('.rtrim($product_arr,",").')';
		}


		
		$result = $this->db->query("SELECT * FROM regions_lang  WHERE language_id=$lang_id AND region_id IN (SELECT region_id FROM products WHERE enabled=1 $condiction $product_tag)")
		->result();
		/*echo $this->db->last_query();
		echo '<pre>';
		print_r($result);*/
		if($result){
			foreach($result as $set_result){
				echo '<option value="'.$set_result->region_id.'">'.$set_result->title.'</option>';
			}
		}

	}

	function set_page(){
		$this->data['lang_code'] = $this->input->post('lang_code');
		$page_id= $this->input->post('page_id');
		$this->data['lang_id'] = $this->input->post('lang_id');
		$show_content = '';
		if($page_id){
			$page_result = $this->comman_model->get_lang('page',$this->data['lang_id'],NULL,array('id'=>$page_id),'page_id',true);
			if($page_result){
				if($page_result->template=='panoramas'){
				}
				$show_content .= '<div id="regiterpage">';
				$show_content .= '<h2>'.$page_result->title.'</h2>';
				$show_content .= '<div style="margin-bottom:10px">'.html_entity_decode($page_result->body).'</div>';
				$show_content .= '</div>';
			}
		}
		echo $show_content;
	}

	function set_page1(){
		$this->data['lang_code'] = $this->input->post('lang_code');
		$page_id= $this->input->post('page_id');
		$this->data['lang_id'] = $this->input->post('lang_id');
		$show_content = '';
		if($page_id){
			$page_result = $this->comman_model->get_lang('page',$this->data['lang_id'],NULL,array('id'=>$page_id),'page_id',true);
			if($page_result){
				$show_content .= '<div id="regiterpage">';
				$show_content .= '<h2>'.$page_result->title.'</h2>';
				$show_content .= '<div style="margin-bottom:10px">'.html_entity_decode($page_result->body).'</div>';
				$show_content .= '</div>';
			}
		}
		echo $show_content;
	}
	
	function search_final(){
		$q=$_REQUEST['q'];
		$region=$_REQUEST['region'];
		$sub_region=$_REQUEST['sub_region'];
		$e_group=$_REQUEST['e_group'];
		$entity=$_REQUEST['entity'];
		$this->data['lang_code'] = $this->input->post('lang_code');
		$this->data['lang_id'] = $this->input->post('lang_id');
		$tag=$_REQUEST['tag'];
		$conn=" and status='Y'";
		$q = $this->input->post('q');
		if($tag&& $tag!='null' ){
			$tagarr=array();
			$pos = strrpos($tag, ",");
			if($pos===false){
				$tagarr[]=$tag;
			}
			else{
				$tagarr=explode(',',$tag);
			}
			if(count($tagarr)>0){
				$product_arr= array();
				foreach($tagarr as $values){
					$this->db->select('product_id');
					$check_product = $this->comman_model->get_by('product_tag',array('tag_id'=>$values),false,false);
					//echo '<br>'.$this->db->last_query();
					
					if($check_product){
						foreach($check_product as $set_pro){
						$product_arr[] =$set_pro->product_id;
						}
					}
				}
				if($product_arr){
					$this->db->where_in('id',$product_arr);
				}
			}
		}

		if($q){
			$this->db->like('title',$q);
		}
		if($region&&$region!=0){
			$this->db->where('region_id',$region);
		}
		if($sub_region&&$sub_region!=0){
			$this->db->where('sub_region_id',$sub_region);
		}
		if($e_group&&$e_group!=0){
			$this->db->where('entity_group_id',$e_group);
		}
		if($entity&&$entity!=0){
			$this->db->where('category_id',$entity);
		}
		$this->db->order_by('id','desc');
		//$this->data['searchs'] = $this->comman_model->get('products',false);
		$this->data['searchs'] = $this->comman_model->get_lang('products',$this->data['lang_id'],NULL,array('enabled'=>1),'product_id',false);
		//echo $this->db->last_query();

		$this->load->view('templates/product_content',$this->data);
	}
	
	function save_newsletter(){
		if($this->input->post('newsEmail')){
			$email = $this->input->post('newsEmail');
			$check =$this->comman_model->get_by('newsletters',array('email'=>$email),false,false,false);
			if($check){
				echo '2';
			}
			else{
				$this->comman_model->save('newsletters',array('email'=>$email));
				echo "1";
			}
		}
		//redirect($_SERVER['HTTP_REFERER']);
	}	

	function coupon($id =false){
		if(!$id){
			redirect('front/');
		}
		$check_coupon =$this->comman_model->get_by('coupons',array('id'=>$id),false,false,true);
		if(count($check_coupon)){
			$ip_address = $this->input->ip_address();
			$time = time();
			$check = $this->comman_model->get_by('coupon_click',array('coupon_id'=>$id,'ip_address'=>$ip_address,'visit_date >='=>strtotime(date('d-m-Y 00:00:00',time())),'visit_date <='=>strtotime(date('d-m-Y 23:59:59',time()))),false,false,false);
			//echo $this->db->last_query();
			if(!count($check)){
				$this->comman_model->save('coupon_click',array('visit_date'=>$time,'ip_address'=>$ip_address,'coupon_id'=>$id));
			}
			if(!empty($check_coupon->url)){
				redirect($check_coupon->url);				
			}
			else{
				$website = $this->comman_model->get_by('websites',array('id'=>$check_coupon->website_id),false,false,true);
				//echo $this->db->last_query();
				if(count($website)){
					redirect($website->affilate_url);					
				}
			}
			//redirect('front');
		}
		else{
			redirect('front/');
		
		}
	}

	function show_coupon($id=false){		
		if(!$id){
			echo 'there is no coupon';
		}
		$this->data['show_data'] = $this->comman_model->get_by('coupons',array('id'=>$id),false,false,true);
		echo $this->load->view('templates/pop_coupon',$this->data);
	
	}

	function show_print($id=false){
		if(!$id){
			echo 'there is no coupon';
		}
		$this->data['show_data'] = $this->comman_model->get_by('coupons',array('id'=>$id),false,false,true);
		echo $this->load->view('templates/pop_print',$this->data);
	
	}
	
	
	function set_save_coupon(){
		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= 'login_error';		
		$id = $this->input->post('id');
		$user_data = $this->session->all_userdata();
		if(isset($user_data['user_session'])){
			if($user_data['user_session']['loginType']=='user'){
				$check =$this->comman_model->get_by('coupon_save',array('user_id'=>$user_data['user_session']['id'],'coupon_id'=>$id),false,false,false);
				if(count($check)==0){
					$this->comman_model->save('coupon_save',array('user_id'=>$user_data['user_session']['id'],'coupon_id'=>$id));
					$msge['result'] = 'success';				
				}
				else{
					$msge['result'] = 'error';				
					$msge['msg']= 'already_set';							
				}
			}
		}
		echo json_encode($msge);	
	}

	function delete_favorite(){
		$msg = 0;
		$id = $this->input->post('id');
		$user_data = $this->session->all_userdata();
		if(isset($user_data['user_session'])){
			if($user_data['user_session']['loginType']=='user'){
				$check =$this->comman_model->get_by('product_favorite',array('user_id'=>$user_data['user_session']['id'],'product_id'=>$id),false,false,false);
				if(count($check)!=0){
					$this->comman_model->delete('product_favorite',array('user_id'=>$user_data['user_session']['id'],'product_id'=>$id));
					$msg =1;
				}
				else{
					$msg =0;
				}
			}
		}
		echo $msg;	
	}
	
	function set_favorite(){
/*		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= 'login_error';		
*/
		$msg = 0;
		$id = $this->input->post('id');
		$user_data = $this->session->all_userdata();
		if(isset($user_data['user_session'])){
			if($user_data['user_session']['loginType']=='user'){
				$check =$this->comman_model->get_by('product_favorite',array('user_id'=>$user_data['user_session']['id'],'product_id'=>$id),false,false,false);
				if(count($check)==0){
					$this->comman_model->save('product_favorite',array('user_id'=>$user_data['user_session']['id'],'product_id'=>$id));
					$msg =1;
					//$msge['result'] = 'success';				
				}
				else{
					$this->comman_model->delete('product_favorite',array('user_id'=>$user_data['user_session']['id'],'product_id'=>$id));
					$msg = 2;
/*					$msge['result'] = 'error';				
					$msge['msg']= 'already_set';*/							
				}
			}			
		}
		//echo json_encode($msge);
		echo $msg;
	}

	function set_rating(){
		$msg = 0;
		$id = $this->input->post('id');
    	$rate = $this->input->post('rate');;
		$user_data = $this->session->all_userdata();
		if(isset($user_data['user_session'])){
			if($user_data['user_session']['loginType']=='user'){
				$check =$this->comman_model->get_by('product_rating',array('user_id'=>$user_data['user_session']['id'],'product_id'=>$id),false,false,false);
				if(count($check)==0){
					$this->comman_model->save('product_rating',array('user_id'=>$user_data['user_session']['id'],'product_id'=>$id,'rate'=>$rate));
					$msg = 1;
				}
				else{
				}
			}
		}
		echo $msg;
	}

	function set_comment(){
		$msge = array();
		$msge['result']= 'error';
		$id = $this->input->post('id');
		$comment = $this->input->post('comment');
		$user_data = $this->session->all_userdata();
		if(isset($user_data['user_session'])){
			if($user_data['user_session']['loginType']=='user'){
				$user_details =  $this->comman_model->get_by('users',array('id'=>$user_data['user_session']['id']),FALSE,FALSE,TRUE);
				if(!empty($user_details->image)){
					$image = 'assets/uploads/users/small/'.$user_details->image;
				}
				else{
					$image = 'assets/uploads/users/profile.jpg';
				}
	
				$this->comman_model->save('coupon_comment',array('user_id'=>$user_data['user_session']['id'],'coupon_id'=>$id,'description'=>$comment));
				$msge['result'] = 'success';				
				$msge['msg'] = '<div class="media" style="min-height:70px">                    
                      <img class="media-object" alt="" src="'.$image.'" style="float:left;margin-right:5px">
                      <div style="float:left;width:92%">
                        <h4 class="media-heading" style="float:left">'.$user_details->username.'</h4> <span style="float:right">'.date('F d, Y',time()).'</span>
                        <div style="clear:both"></div>
                        <p>'.$comment.'</p></div><div style="clear:both"></div></div>';

			}
		}
		echo json_encode($msge);
	}
	
	function set_comment1(){
		$msge = array();
		$msge['result']= 'error';
		$id = $this->input->post('id');
		$comment = $this->input->post('comment');
		$user_data = $this->session->all_userdata();
		if(isset($user_data['user_session'])){
			if($user_data['user_session']['loginType']=='user'){
				$user_details =  $this->comman_model->get_by('users',array('id'=>$user_data['user_session']['id']),FALSE,FALSE,TRUE);
				if(!empty($user_details->image)){
					$image = 'assets/uploads/users/small/'.$user_details->image;
				}
				else{
					$image = 'assets/uploads/users/profile.jpg';
				}
	
				$this->comman_model->save('website_comment',array('user_id'=>$user_data['user_session']['id'],'website_id'=>$id,'description'=>$comment));
				$msge['result'] = 'success';				
				$msge['msg'] = '<div class="media" style="min-height:70px">                    
                      <img class="media-object" alt="" src="'.$image.'" style="float:left;margin-right:5px">
                      <div style="float:left;width:92%">
                        <h4 class="media-heading" style="float:left">'.$user_details->username.'</h4> <span style="float:right">'.date('F d, Y',time()).'</span>
                        <div style="clear:both"></div>
                        <p>'.$comment.'</p></div><div style="clear:both"></div></div>';

			}
		}
		echo json_encode($msge);
	}

	function ajax_upload_video(){		
		$this->load->helper('string');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/voice_box/';
		$config['allowed_types'] = 'mp4';
		$config['file_name'] = time();
		//$config['allowed_types'] = config_item('allow_data_type');
		$config['max_size']	= '600000';
		$this->load->library('upload', $config);

		$id = $this->input->post('id');		
		$user_data = $this->session->all_userdata();
		if(isset($user_data['user_session'])){
			if (!$this->upload->do_upload('myfile')){
				$ret['result']= 'error';
				$ret['msg']= $this->upload->display_errors();
				//redirect('admin/add_coach');
			}
			else{
				$upload_info = $this->upload->data();
				$image_data = array(
							'file_name' => $upload_info['file_name'],
							'file_id' => $id,
							'user_id'  	=> $user_data['user_session']['id']
						  );
				$image_id = $this->comman_model->save('video_voicebox',$image_data);
	
				$ret['result']= 'success';
				//$ret['msg']= $image_id;
				$ret['msg']= $upload_info['file_name'];
			}
		}		
		else{
			$ret['result']= 'error';
			$ret['msg']= 'Please Login.';
		}
	    echo json_encode($ret);
	}




	function clear_cache(){
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");		
    }

	public function index(){
		$this->data['title'] = "";
		$this->data['login'] = $this->session->all_userdata();
		die;
		$this->load->view('templates/index',$this->data);
	}


	function ajax_map(){
		$id = $this->input->post('id');
		$array = array();
		$result = $this->comman_model->query_result('SELECT country_code, COUNT(country_code) AS counts FROM files GROUP BY country_code;');
		if(!empty($result)){
			foreach($result as $set_data){
				if(!empty($set_data['country_code'])){
					$array[strtolower($set_data['country_code'])] = 16.63;
				}				
			}
		}
		//$array = array('in'=>'4','pk'=>'6','us'=>'2');
		echo json_encode($array);
	}

	function set_lang(){
		$name = $this->input->post('lang');
		$lang= array('lang' => $name);
		$this->session->set_userdata($lang);
		echo 'success';
	}

	function autocomplete(){		
		$json_arr = array();
		$display_json = array();
		$id = $this->input->get('q');
		$lang_id = $this->input->get('lang_id');
		//searching for website
		$this->db->like('title',$id);
		$this->db->order_by('title','asc');		
		$get_data = $this->comman_model->get_lang('products',$lang_id,NULL,array('enabled'=>1),'product_id',false);
		//echo $this->db->last_query();die;
		if(count($get_data)){
			foreach($get_data as $set_data ){
				echo $set_data->title."\n";
			}
		}				
	}

	function autocomplete1(){
		$id = $this->input->get('term');
		$this->db->like('title',$id,'after');
		$this->db->order_by('title','asc');		
		$get_data = $this->comman_model->get('websites',false);
		//echo $this->db->last_query();die;
		$array = array();
		if(count($get_data)){
			foreach($get_data as $set_data ){
				$array[] = $set_data->title;
			}
		}				

		$this->db->like('coupon_title',$id);
		$this->db->order_by('coupon_title','asc');		
		$get_data = $this->comman_model->get('coupons',false);
		if(count($get_data)){
			foreach($get_data as $set_data ){
				$array[] = $set_data->coupon_title;
			}
		}				
		echo json_encode($array);
	}
	
	function get_ajax_win(){
		$check_data = $this->comman_model->array_from_post(array('category_id','division_id'));
		$get_data = $this->comman_model->get_by('products',$check_data,false,false,true);
		if(count($get_data)){
			echo json_encode($get_data);
		}
		else{
			echo  json_encode($get_data);
		}				
	}

	function get_ajax(){
		$check = $this->input->post('single');
		if($check==1){
			$single = true;
		}
		else{
			$single = false;
		}
	
		$check_data = $this->comman_model->array_from_post(array('id'));
		$get_data = $this->comman_model->get_by($this->input->post('table'),$check_data,false,false,$single);
		if(count($get_data)){
			echo json_encode($get_data);
		}
		else{
			echo  json_encode($get_data);
		}				
	}

	function get_position(){
		$name = $this->input->post('table_name');
		$post_data = array('position'=>$this->input->post('position'));
		$id = $this->input->post('id');
		$result = $this->comman_model->save($name,$post_data,$id);
		echo 'success';
	}


	function send_mail(){
		$upload_dir = 'assets/images/';  //implement this function yourself
		$time = time();
		$file_name = 'pvsysgroup'.$time;
		$img = $_POST['img'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = $upload_dir.$file_name.".png";
		$success = file_put_contents($file, $data);
		//header('Location: '.$_POST['return_url']);
		$img = FCPATH.'assets/images/'.$file_name.'.png';

		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);
		$this->email->from($this->data['site_email']->value, '');
		$this->email->to($this->input->post('email'));
		$this->email->subject('New Images');
		$this->email->attach($img);
		$this->email->message('New Image');
		$this->email->send();
		//echo $this->input->post('img');
	}
	
	function ajax_get_video_list(){
		$html = '';
		$code = $this->input->post('code');
		$page = $this->input->post('page');
		if($page=='admin'){
			$result = $this->comman_model->get_by('files',array('country'=>$code),false,false,false);
			if(count($result)){
				foreach($result as $set_data){
					$category_name = '-';
					$user_data =$this->comman_model->get_by('user',array('id'=>$set_data->user_id),FALSE,FALSE,true);
					if($set_data->category_id!=0){
						$category = $this->comman_model->get_by('categories',array('id'=>$set_data->category_id),FALSE,FALSE,TRUE);
						if(count($category)){
							$category_name = $category->name;
						}
					}
					$user_data =$this->comman_model->get_by('user',array('id'=>$set_data->user_id),false,false,true);
					$like_data = $this->comman_model->get_by('video_like',array('file_id'=>$set_data->id),FALSE,FALSE,FALSE);
					$comment_data = $this->comman_model->get_by('video_voicebox',array('file_id'=>$set_data->id),FALSE,FALSE,FALSE);	   
					$html .= "<tr>
								<td>".$set_data->id."</td>
								<td>".$set_data->name."</td>
								<td>".$category_name."</td>
								<td>".$user_data->username."</td>
								<td>".count($like_data)."</td>
								<td>".count($comment_data)."</td>
								<td>".$set_data->country."</td>
								<td>".date('d-m-Y',$set_data->modified)."</td>
							</tr>";
				}
			}
			else{
				$html .='<tr><td colspan="8">There is no data.</td>';
			}
		}
		else if($page=='front'){
			$videos = $this->comman_model->get_by('files',array('country'=>$code),false,false,false);
			if(isset($videos)&&!empty($videos)){
				$html .='<ul class="portfolio-items col-md-12">';
				foreach($videos as $set_video){
					$url_image = 'assets/templates/img/video-cover.png';
					$comment_data = $this->comman_model->get_by('video_voicebox',array('file_id'=>$set_video->id),FALSE,FALSE,FALSE);	   
					$like_data = $this->comman_model->get_by('video_like',array('file_id'=>$set_video->id),FALSE,FALSE,FALSE);	   
					$rating_data = $this->comman_model->get_by('video_rating',array('file_id'=>$set_video->id),false,false,false);
					if($rating_data){
						$this->db->select_sum('rate');
						$total_rating = $this->comman_model->get_by('video_rating',array('file_id'=>$set_video->id),false,false,false);
						$rate_times = count($rating_data);
						//$rate_value = $total_rating/$rate_times;
						$total_rate = $total_rating[0]->rate/$rate_times;
						//$total_rate = (($rate_value)/5)*100;
					}
					else{
						$total_rate = 0;
					}
			
			if($set_video->link){
				$image_url = parse_url($set_video->link);
				if($image_url['host'] == 'www.youtube.com' || $image_url['host'] == 'youtube.com'){
					$array = explode("&", $image_url['query']);
					$url_image = "http://img.youtube.com/vi/".substr($array[0], 2)."/0.jpg";
				} 
				else if($image_url['host'] == 'www.vimeo.com' || $image_url['host'] == 'vimeo.com'){
					$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".substr($image_url['path'], 1).".php"));
					$url_image = $hash[0]["thumbnail_small"];
				}
			}
				$html .='<li class="portfolio-item col-md-3">
							<div class="item-inner" style="margin-right:5px">
								<div class="portfolio-image">
									<img src="'.$url_image.'" alt="'.$set_video->name.'" height="130" title="'.$set_video->name.'">
									<div class="overlay">
										<a class="preview btn btn-danger" title="'.$set_video->name.'" href="front/videos/'.$set_video->id.'"><i class="icon-eye-open"></i></a>             
									</div>
								</div>
								
								<a href="front/videos/'.$set_video->id.'"><h4>'.$set_video->name.'</h4></a>
								<a href="front/videos/'.$set_video->id.'">
									<div class="ratings">
											<p class="pull-left">'.count($like_data).' Like</p>
											<p class="pull-right">'.count($comment_data).' Reviews</p>
			
											<div style="clear:both"></div>
											<form style="float:left;margin-top:-10px">
									<input id="rating-input" type="number" value="'.$total_rate.'" class="rating" min=0 max=5 step=1 data-size="xs" data-show-clear="false" data-show-caption="false" />    
								</form>
											<div style="clear:both"></div>
										</div>
								</a>
							</div>
						 </li>';
				}
				$html .='</ul>';
			}
		}
		echo $html;		
	}	



}
