<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date','front'));	
		$this->load->library(array('form_validation','pagination','session','cart'));
		$this->load->model(array('page_model','comman_model','user_model','search_model','language_model','settings_model'));
		$this->data['set_meta'] = '';	
        $this->data['settings'] = $this->settings_model->get_fields();
		//date_default_timezone_set("Asia/Dubai"); 
		//date_default_timezone_set("Asia/Kolkata"); 

/*		$this->data['lang_code'] = (string) $this->uri->segment(1);
        if(empty($this->data['lang_code']))
        {
            $this->data['lang_code'] = $this->language_model->get_default();
        }
        $this->data['lang_id'] = $this->language_model->get_id($this->data['lang_code']);*/

        $detail = $this->session->all_userdata();
		if(isset($detail['user_session'])){
			$this->data['user_session'] = $detail['user_session'];
			if(isset($detail['user_session']['loginType'])){
				if($detail['user_session']['loginType']=='user'){
		            $this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
				}
				if($detail['user_session']['loginType']=='reseller'){
		            $this->data['user_details'] =  $this->comman_model->get_by('users',array('id'=>$detail['user_session']['id']),FALSE,FALSE,TRUE);
				}
			}
        }

	}
	
	function getCity(){	
		$msge = array();
		$msge['status']= 'ok';

		$id = $this->input->post('id');
		$lang_id = $this->input->post('lang_code');
		$option = '<option value="0">Select</option>';
		if($id){
			$result = $this->comman_model->get_by('cities',array('country'=>$id),false,false,false);
			if($result){
				foreach($result as $set_result){
					$option .='<option value="'.$set_result->id.'">'.$set_result->name.'</option>';
				}
			}
		}
		$msge['msge'] = $option;
		echo json_encode($msge);
	}

	function _check_ext($ext){
		$_type = 'o';
		$allowed = array(
					'a'	=> array('mpga', 'mp2', 'mp3', 'ra', 'rv', 'wav'),
					'v'	=> array('mpeg', 'mpg', 'mpe', 'mp4', 'flv', 'qt', 'mov', 'avi', 'movie'),
					'd'	=> array('pdf', 'xls', 'ppt', 'pptx', 'txt', 'text', 'log', 'rtx', 'rtf', 'xml', 'xsl', 'doc', 'docx', 'xlsx', 'word', 'xl', 'csv', 'pages', 'numbers'),
					'i'	=> array('bmp', 'gif', 'jpeg', 'jpg', 'jpe', 'png', 'tiff', 'tif'),
					'o'	=> array('psd', 'gtar', 'swf', 'tar', 'tgz', 'xhtml', 'css', 'html', 'htm', 'shtml', 'svg'),
					'z'	=> array('zip'),
				);
		if(!empty($ext)){
			foreach ($allowed as $type => $ext_arr)
			{				
				if (in_array(strtolower($ext), $ext_arr))
				{
					$_type		= $type;
					break;
				}
			}
		}
		return $_type;
	}

	function ajax_upload1(){		
		$this->load->helper('string');
		$id = $this->input->post('id');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/products';
		$config['allowed_types'] = '*';
		
		//$config['allowed_types'] = config_item('allow_data_type');
		$config['max_size']	= '200000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('myfile')){
			$ret['result']= 'error';
			$ret['msg']= $this->upload->display_errors();
			//redirect('admin/add_coach');
		}
		else{
			$upload_info = $this->upload->data();
			$ret['result']= 'success';
			$ret['msg']= $upload_info['file_name'];
			
		}
	    echo json_encode($ret);
		
	}


	function ajaxGetSubcategory(){	
		$msge = array();
		$msge['status']= 'ok';

		$id = $this->input->post('id');
		$type = $this->input->post('type');
		$lang_id = $this->input->post('lang_code');
		if($type==1){
			$option = '';
		}else{
			$option = '<option value="0">Select</option>';
		}
		if($id){
			$this->db->order_by('title','asc');
			$result = $this->comman_model->get_lang('categories',$lang_id,NULL,array('parent_id'=>$id),'category_id',false);
			if($result){
				foreach($result as $set_result){
					$option .='<option value="'.$set_result->id.'">'.$set_result->title.'</option>';
				}
			}
		}
		$msge['msge'] = $option;
		echo json_encode($msge);
	}

	function ajax_upload(){		
		$this->load->helper('string');
		$id = $this->input->post('id');
		$ret =array();		
		$config['upload_path'] = './assets/uploads/products';
		$config['allowed_types'] = '*';
		
		//$config['allowed_types'] = config_item('allow_data_type');
		$config['max_size']	= '200000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('myfile')){
			$ret['result']= 'error';
			$ret['msg']= $this->upload->display_errors();
			//redirect('admin/add_coach');
		}
		else{
			$upload_info = $this->upload->data();
			$extension_type = $this->_check_ext(ltrim($upload_info['file_ext'],'.'));
			$image_data = array(
						'filename' => $upload_info['file_name'],
						'filetype'      => $extension_type,
						'product_id'  	=> $id
					  );
			$image_id = $this->comman_model->save('product_files',$image_data);

			$ret['result']= 'success';
			$ret['msg']= $upload_info['file_name'];
			
		}
	    echo json_encode($ret);
		
	}

	function refresh_product_image1(){
		$id = $this->input->post('id');
	   echo '<div class="product-item col-md-3" style="padding:4px;margin:5px;width:23%" >
        <div class="pi-img-wrapper">
	        <img style="height:100px;width:100%" alt="" class="img-responsive" src="assets/uploads/products/'.$id.'"></a>
        </div></div>';
	}

	function refresh_product_image(){
		$id = $this->input->post('id');
		$this->data['id'] = $this->input->post('id');
		$this->data['products_file'] = $this->comman_model->get_by('product_files',array('product_id'=>$id),false,false,false);
		$this->load->view("user/product/product_image",$this->data);			
	}


	function delete_product_image(){
		$id = $this->input->post('id');
		$check_image = $this->comman_model->get_by('product_files',array('id'=>$id),false,false,true);
		if($check_image){
			$this->comman_model->delete('product_files',array('id'=>$id));
			$image = 'assets/uploads/products/'.$check_image->filename;
			if(is_file($image))
    	    	unlink($image);
		}
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


	function change_address(){
		$id = $this->input->post('id');
		$user_data = $this->session->all_userdata();
		if(isset($user_data['user_session'])){
			if($user_data['user_session']['loginType']=='user'){
				$this->data['user_adds'] = $this->comman_model->get_by('user_shipping_add',array('user_id'=>$user_data['user_session']['id'],'id'=>$id),false,false,true);
			}
		}
		$this->load->view("templates/ajax/address",$this->data);
	}

	function send_contact(){
		@session_start();
		$rel = array();
		$rel['status']= "error";
		$rel['msg']= '';
		$lang_id = $this->input->post('lang_id');
		if($this->input->post('email')){
			if(empty($_SESSION['6_letters_code'])||strcasecmp($_SESSION['6_letters_code'], $this->input->post('code')) != 0){
				$rel['msg'] = "<p style='color:#F00'>The captcha code does not match!</p>";
			}
			else{
				if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL) === false) {
					$email_data = $this->comman_model->get_by('email',array('id'=>4),false,false,true);
								
					$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
					$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->subject);
			
					$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
					$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
					$email_data->message = str_replace('{name}', $this->input->post('user_name'), $email_data->message);
					$email_data->message = str_replace('{phone}', $this->input->post('phone'), $email_data->message);
					$email_data->message = str_replace('{email}', $this->input->post('email'), $email_data->message);
					$email_data->message = str_replace('{message}', $this->input->post('messege'), $email_data->message);
					$email_data->message = str_replace('{site_link}', base_url(), $email_data->message);
			
					$this->load->library('email');
					$config = array (
						  'mailtype' => 'html',
						  'charset'  => 'utf-8',
						  'priority' => '1'
						   );
					$this->email->initialize($config);
					$this->email->from($this->input->post('email'), $this->input->post('user_name'));
					$this->email->to($this->data['settings']['site_email']);
					$this->email->subject($email_data->subject);
					$this->email->message($email_data->message);
					$post_data = array(
										'name'=>$this->input->post('user_name'),
										'phone'=>$this->input->post('phone'),
										'email'=>$this->input->post('email'),
										'comment'=>$this->input->post('messege')
								);
					$this->comman_model->save('user_contact',$post_data);
								
					if($this->email->send()){
						$rel['status']= "ok";
						$rel['msg']="<p style='color:#0F0'>".show_static_text($lang_id,199)."</p>";
						//$this->session->set_flashdata('success', 'Thanks for your message- a representative will be in touch with you shortly !');			
						
					}
					else{
						$rel['status']= "error";
						$rel['msg']="<p style='color:#F00'>".show_static_text($lang_id,200)."</p>";
						//$this->session->set_flashdata('error', 'Something error in sending mail.');
					}
				}
				else{
					$rel['msg']= "<p style='color:#F00'>".show_static_text($lang_id,201)."</p>";
				}
			}
		}
		else{
			$rel['msg']= "<p style='color:#F00'>".show_static_text($lang_id,202)."</p>";
		}
		echo json_encode($rel);
	}



	function refresh_cart(){
		$this->data['lang_id'] = $this->input->post('lang_id');
		$this->data['lang_code'] = $this->input->post('lang_code');
		$this->data['lang_unit'] = $this->input->post('lang_unit');
		$this->data['lang_currency'] = $this->input->post('lang_currency');
		$this->load->view("templates/includes/add_cart_popup",$this->data);
	}

	function post_error_items(){
		$value=$_REQUEST['value'];
		if($value=='10'){
			echo ' <span>Internal Problem (Id cant Be found)</span>';
		}
		if($value=='1'){
			echo ' <span>Please Enter Your  Name </span>';
		}
		if($value=='2'){
			echo ' <span>Please Enter Your Review</span>';
		}
		if($value=='3'){
			echo ' <span>Please Enter Correct Email Address</span>';
		}
		if($value=='6'){
			echo ' <span>Email is required.</span>';
		}
		if($value=='70'){
			echo ' <span>Enter Proper Email</span>';
		}
		if($value=='71'){
			echo ' <span>Thank you for submitting  review!!</span>';
		}
		if($value=='84'){
			echo ' <font>Your product is sucessfully added to your cart!!</font>';
		}
	}
	
    function error_item(){
		//$data=$_REQUEST['data'];
		$value=$_REQUEST['value'];
		if($value=='1')
		{
		echo '<span>Please Enter Your  Name </span>';
		}
		if($value=='2')
		{
		echo '<span>Please Enter Your Email Address</span>';
		}
		if($value=='3')
		{
		echo '<span>Please Enter Correct Email Address</span>';
		}
		if($value=='4')
		{
		echo '<span>Please Enter Message.</span>';
		}
		if($value=='6')
		{
		echo '<span>Email is required.</span>';
		}
		if($value=='7')
		{
		echo '<span>Please Enter Your Password .</span>';
		}
		if($value=='199')
		{
		echo '<span>Please confirm Your Password.</span>';
		}
		if($value=='8')
		{
		echo '<span>Awainting For Email. </span>';
		}
		if($value=='9')
		{
		echo '<span>User Blocked.</span>';
		}
		if($value=='10')
		{
		echo '<span>Password not matched..</span>';
		}
		if($value=='79')
		{
		echo '<span>Name is required .</span>';
		}
		if($value=='80')
		{
		echo '<span>Email is required .</span>';
		}
		if($value=='81')
		{
		echo '<span>Correct Email is required.</span>';
		}
		if($value=='82')
		{
		echo '<span>Phone is required.</span>';
		}
		if($value=='83')
		{
		echo '<span>Message field is required.</span>';
		}
		if($value=='84')
		{
		echo '<font>Your product is sucessfully added to your cart!!</font>';
		}
		if($value=='100')
		{
		echo '<span>Please Enter Your First Name </span>';
		}
		if($value=='101')
		{
		echo '<span>Please Enter Your Last Name </span>';
		}
		if($value=='102')
		{
		echo '<span>Please Enter Street Address</span>';
		}
		if($value=='103')
		{
		echo '<span>Please Enter Address Line 2</span>';
		}
		if($value=='104')
		{
		echo '<span>Please Enter City</span>';
		}
		if($value=='105')
		{
		echo '<span>Please Choose Region/State</span>';
		}
		if($value=='106')
		{
		echo '<span>Please Enter Postal Code</span>';
		}
		if($value=='107')
		{
		echo '<span>Please Choose Your Country</span>';
		}
		if($value=='108')
		{
		echo '<span>Please Enter Your Telephone Number</span>';
		}
		if($value=='109')
		{
		echo '<span>Please Enter Your Email</span>';
		}
		if($value=='110')
		{
		echo '<span>Please Enter Correct Email Address</span>';
		}
		if($value=='111')
		{
		echo '<span>Please Enter Date of Birth</span>';
		}
		if($value=='112')
		{
		echo '<span>Please Enter Height</span>';
		}
		if($value=='113')
		{
		echo '<span>Please Enter Your Weight</span>';
		}
		if($value=='114')
		{
		echo '<span>Please Enter time you go to sleep </span>';
		}
		if($value=='115')
		{
		echo '<span>Please Enter time you wake each day  </span>';
		}
		if($value=='116')
		{
		echo '<span>Please Enter Your Credit Card  </span>';
		}
		if($value=='117')
		{
		echo '<span>Please Enter Month </span>';
		}
		if($value=='118')
		{
		echo '<span>Please Enter year </span>';
		}
		if($value=='119')
		{
		echo '<span>Please Enter Security Code </span>';
		}
		if($value=='120')
		{
		echo '<span>Please Enter Card Holder Name </span>';
		}
		if($value=='121')
		{
		echo '<span>Please read the Terms and Conditions </span>';
		}
		/*
		if($value=='122')
		{
		echo '<span>Please read the Sleep Study Agreement </span>';
		}*/
		if($value=='123')
		{
		echo '<span>Please read the Deposit Agreement </span>';
		}
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
	
	function delete_wishlist(){
		
/*		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= 'login_error';		
*/
		$msg = 0;
		$id = $this->input->post('id');
		$user_data = $this->session->all_userdata();
		if(isset($this->data['user_details'])){
			if($this->data['user_details']->account_type=="B"){
				$check =$this->comman_model->get_by('product_wishlist',array('user_id'=>$this->data['user_details']->id,'id'=>$id),false,false,true);
				if($check){
					$this->comman_model->delete('product_wishlist',array('user_id'=>$this->data['user_details']->id,'id'=>$id));
					$msg =1;
				}
			}			
		}
		echo $msg;		
	}
	
	function set_like(){
		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= 'login_error';		
		//$msg = 0;
		$id = $this->input->post('productID');
		$user_data = $this->session->all_userdata();
		if(isset($this->data['user_details'])){
			if($this->data['user_details']->account_type=='B'){
				$check =$this->comman_model->get_by('product_like',array('user_id'=>$this->data['user_details']->id,'product_id'=>$id),false,false,false);
				if(count($check)==0){
					$this->comman_model->save('product_like',array('user_id'=>$this->data['user_details']->id,'product_id'=>$id));
					//$msg =1;
					$count =$this->comman_model->get_by('product_like',array('product_id'=>$id),false,false,false);
					//$msge['result'] = 'success';				
					$msge['result'] = 'success';				
					$msge['msg']= 1;		
					$msge['count'] =count($count);
				}
				else{
					$this->comman_model->delete('product_like',array('user_id'=>$this->data['user_details']->id,'product_id'=>$id));
					$msg = 2;
					$count =$this->comman_model->get_by('product_like',array('product_id'=>$id),false,false,false);
					$msge['result'] = 'success';
					$msge['msg']= 2;		
					$msge['count'] =count($count);
/*					$msge['result'] = 'error';				
					$msge['msg']= 'already_set';*/							
				}
			}			
		}
		echo json_encode($msge);
		//echo $msg;
	
	}

	function set_wishlist(){
		$msge = array();
		$msge['result']= 'error';
		$msge['msg']= 'login_error';		
		//$msg = 0;
		$id = $this->input->post('productID');
		$user_data = $this->session->all_userdata();
		if(isset($this->data['user_details'])){
			if($this->data['user_details']->account_type=='B'){
				$check =$this->comman_model->get_by('product_wishlist',array('user_id'=>$this->data['user_details']->id,'product_id'=>$id),false,false,false);
				if(count($check)==0){
					$this->comman_model->save('product_wishlist',array('user_id'=>$this->data['user_details']->id,'product_id'=>$id));
					//$msg =1;
					$count =$this->comman_model->get_by('product_wishlist',array('product_id'=>$id),false,false,false);
					//$msge['result'] = 'success';				
					$msge['result'] = 'success';				
					$msge['msg']= 1;		
					$msge['count'] =count($count);
				}
				else{
					$this->comman_model->delete('product_wishlist',array('user_id'=>$this->data['user_details']->id,'product_id'=>$id));
					$msg = 2;
					$count =$this->comman_model->get_by('product_wishlist',array('product_id'=>$id),false,false,false);
					$msge['result'] = 'success';
					$msge['msg']= 2;		
					$msge['count'] =count($count);
/*					$msge['result'] = 'error';				
					$msge['msg']= 'already_set';*/							
				}
			}			
		}
		echo json_encode($msge);
		//echo $msg;
	
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


	function set_blog_comment(){
		$msge = array();
		$msge['result']= 'error';
		$id = $this->input->post('id');
		$lang_id = $this->input->post('lang_id');
		$lang_code = $this->input->post('lang_code');
		$comment = $this->input->post('comment');
		$user_data = $this->session->all_userdata();
		if(isset($user_data['user_session'])){
			if($user_data['user_session']['loginType']=='user'){
				$user_details =  $this->comman_model->get_by('users',array('id'=>$user_data['user_session']['id']),FALSE,FALSE,TRUE);
				if(!empty($user_details->image)){	
					$image = base_url('assets/uploads/users/thumbnails').'/'.$user_details->image;
				}
				else if(!empty($user_details->site_image)){	
					$image = $user_details->site_image;
				}
				else{
					$image = 'assets/uploads/profile.jpg';
				}
				if(!empty($user_details->slug)){
					$user_slug = $lang_code.'/'.$user_details->slug;
				}
				else{
					$user_slug = $lang_code.'/user/'.$user_details->id;
				}
	
				$this->comman_model->save('blog_comment',array('user_id'=>$user_data['user_session']['id'],'blog_id'=>$id,'comment'=>$comment));
				$msge['result'] = 'success';				
				$msge['msg'] = '<div class="comments-item"><div class="avatar"><img src="'.$image.'" alt="'.$user_details->username.'"></div><div class="comment-content"><a class="username" href="'.$user_slug.'">'.$user_details->username.'</a>'.$comment.'</div></div>';

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


	function ajax_map(){}

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

	function download($id = false){
		$this->load->helper('download');
		if(!$id){
			show_404(current_url());
		}
		$download_file = $this->comman_model->get_by('groups_chat',array('id'=>$id),false,false,true);
		if(count($download_file)&&!empty($download_file->file_name)){
			$data = file_get_contents('assets/uploads/chat_data/'.$download_file->file_name);
			force_download($download_file->file_name,$data); 
		}
		else{
			show_404(current_url());
		}
	}

}
