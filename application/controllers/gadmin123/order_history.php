<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_history extends Admin_Controller {
	public $_table_names = 'user_orders';
	public $_subView = 'admin/order/';
	public $_redirect = '/order_history';
	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'Order Management';

        $this->data['_add'] = $this->data['admin_link'].$this->_redirect.'/create';
        $this->data['_edit'] = $this->data['admin_link'].$this->_redirect.'/edit';
        $this->data['_view'] = $this->data['admin_link'].$this->_redirect.'/view';
        $this->data['_cancel'] = $this->data['admin_link'].$this->_redirect;
        $this->data['_delete'] = $this->data['admin_link'].$this->_redirect.'/delete';

        $this->data['content_language_id'] = $this->language_model->get_defualt_lang();
    	$this->load->model(array('order_model'));

		
		$redirect = false;
		if($this->data['admin_details']->default=='0'){
			if($this->data['admin_details']->is_order==1){}
			else{
				$redirect = true;
			}
		}
		if($redirect){
			$this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}

	}

	function checkPremission($type=false){
		$redirect = false;
		
		if($this->data['admin_details']->default=='0'){
			if($type=='is_order'){
				if($this->data['admin_details']->is_order==1){}
				else{
					$redirect = true;
				}
			}
			else if($type =='is_payment'){
				if($this->data['admin_details']->is_payment==1){}
				else{
					$redirect = true;
				}
			}
		}
		if($redirect){
            $this->session->set_flashdata('error','Sorry ! You have no permission.');
			redirect($this->data['admin_link'].'/dashboard');
		}
	}

	//  Landing page of admin section.
	function index(){
		//$this->data['table'] = true;
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],152);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->comman_model->update_by('user_orders',array('admin_read'=>1),array('payment'=>1));

		$this->data['all_data'] = $this->comman_model->get_by($this->_table_names,array('payment'=>1),false,false,false);
        $this->data['subview'] = $this->_subView.'index';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function delete_comment($id=false,$delete=false){
		if($delete){
    	    $this->db->delete('stores_rating', array('id' => $delete)); 
			redirect($this->data['_cancel'].'/order_review/'.$id);
		}
	}

	function edit_comment($id=false,$delete=false){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1777).'Review';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		if(!$id){
			redirect($this->data['_cancel']);
		}
	

		$this->data['order_review']	= $this->comman_model->get_by('stores_rating',array('id'=>$id),false,false,true);
		if(!$this->data['order_review']){
			redirect($this->data['_cancel']);
		}

		if ($this->input->post('operation')){
				$post_data = $this->comman_model->array_from_post(array('comment'));
				$this->comman_model->save('stores_rating',$post_data,$this->data['order_review']->id);
				redirect($this->data['_cancel'].'/order_review/'.$this->data['order_review']->order_id);
		}
		
        $this->data['subview'] = $this->_subView.'edit_comment';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function edit_review($id=false,$delete=false){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1777).'Review';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		if(!$id){
			redirect($this->data['_cancel']);
		}
	
		$check  = $this->comman_model->get_by('user_orders',array('id'=>$id),false,false,true);
		if(empty($check)){
			redirect($this->data['_cancel']);
		}

		$this->data['order_review']	= $this->comman_model->get_by('stores_rating',array('order_id'=>$id),false,false,true);
		if(!$this->data['order_review']){
			redirect($this->data['_cancel']);
		}

		if ($this->input->post('operation')){
				$post_data = $this->comman_model->array_from_post(array('comment','quality_rate','delivery_rate','service_rate'));
				$post_data['rate'] = round((($post_data['quality_rate']+$post_data['delivery_rate']+$post_data['service_rate'])/3),2);
				$this->comman_model->save('stores_rating',$post_data,$this->data['order_review']->id);
				redirect($this->data['_cancel'].'/order_review/'.$id);
		}
		
        $this->data['subview'] = $this->_subView.'edit_review';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function order_review($id=false,$delete=false){
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],1777).'Review';
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		if(!$id){
			redirect($this->data['_cancel']);
		}
		if($delete){
    	    $this->db->delete('stores_rating', array('order_id' => $id)); 
			redirect($this->data['_cancel']);
		}
	
		$check  = $this->comman_model->get_by('user_orders',array('id'=>$id),false,false,true);
		if(empty($check)){
			redirect($this->data['_cancel']);
		}

		$this->data['order_review']	= $this->comman_model->get_by('stores_rating',array('order_id'=>$id),false,false,true);
		if(!$this->data['order_review']){
			redirect($this->data['_cancel']);
		}
		
        $this->data['subview'] = $this->_subView.'review';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function send_mail($order_id){
		$this->load->library('pdf');
		//create invoice		
		$order_data= $this->comman_model->get_by('user_orders',array('id'=>$order_id),false,false,true);
		$data = array();
		if($order_data){
			$user_data= $this->comman_model->get_by('users',array('id'=>$order_data->user_id),false,false,true);
			$user_address = $this->comman_model->get_by('user_order_shipping_add',array('order_id'=>$order_data->id),false,false,true);
			$data['address'] = $user_address->address;
			$data['house_number'] = $user_address->house_number;
			$data['zip'] = $user_address->zip;
			$data['city'] = $user_address->city;
			$data['country'] = $user_address->country;
			$data['order_date'] = date('d/m/Y h:i A',time());
			$paymentType = '-';
		
			if($order_data->order_type=='collection'){
				if($order_data->payment_type=='paypal'){
					$paymentType ='paypal collection';	  
				}
				else if($order_data->payment_type=='cash'){				
					$paymentType ='Cash On Collection';	  
				}
			}
			else if($order_data->order_type=='delivery'){
				if($order_data->payment_type=='paypal'){
					$paymentType ='Paypal Delivery';	  
				}
				else if($order_data->payment_type=='cash'){
					$paymentType ='Cash On Delivery';	  
				}
			}
			
/*			if($user_data){
				$data['user_name'] = $user_data->first_name.' '.$user_data->last_name;
				$data['user_email'] = $user_data->email;
			}*/
			if($user_address){
				$data['user_name'] = $user_address->first_name.' '.$user_address->last_name;
				$data['user_email'] = $user_address->email;
			}

			
			$order_items = $this->comman_model->get_by('user_order_items',array('order_id'=>$order_data->id),false,false,false);
			$total_all =0;
			$total= 0;
			$couponCodeHtml ='';
			$totalShipping = 0;
			if($order_items){
				$html = '';
				foreach($order_items as $set_value){
					$options = unserialize($set_value->order_content);
					if($set_value->shipping_cost){						
						$shipping_cost = $set_value->shipping_cost;
						$shipping_name = ''.$set_value->shipping_cost;
					}
					else{
						$shipping_name = '';
						$shipping_cost = 0;
					}
					$totalShipping = $shipping_cost+$totalShipping;
					$total_all = ($set_value->price*$set_value->quantity)+$total_all;
					$total = ($set_value->price*$set_value->quantity);
					$product = $this->comman_model->get_lang('products',$this->data['adminLangSession']['lang_id'],NULL,array('id'=>$set_value->product_id),'product_id',true);
					if($product){
						$productName = $product->title;
					}
					else{
						$productName = 'NO Name';
					}

					$store_data = $this->comman_model->get_by('stores',array('id'=>$set_value->store_id),false,false,true);
					if($store_data){
						$storeName = $store_data->name;
						$userData = $this->comman_model->get_by('users',array('id'=>$store_data->user_id),false,false,true);
						if($userData){
							$StoreEmail[] =$userData->email;
						}
					}
					else{
						$storeName = 'NO Store';
					}
					$attributesString ='';

					$attributesString ='';




					$html.='<tr style="" class="item-row" ><td><b>'.$set_value->quantity.'x</b> '.$productName.'</td><td width="20">&pound;'.numberFormat($total).'</td></tr>';
					if(isset($options['product_free_items'])){
						$freeOption = explode(', ',$options['product_free_items']);
						if($freeOption){
							foreach($freeOption as $setFree){
								$html .='<tr><td style="padding-left:12px" colspan="2">'.$setFree.'</td></tr>';
							}
						}
					}

					if(isset($options['extra_option'])){
						$extraOption = unserialize($options['extra_option']);
						if($extraOption){
							foreach($extraOption as $setFree){
								$html .='<tr><td style="padding-left:12px">+<b>'.$setFree['qty'].'x</b> '.$setFree['name'].'</td><td>&pound;'.numberFormat($setFree['price']*$setFree['qty']).'</td></tr>';
							}
						}
					}

					$data['product_name'] =$productName;
					//check coupon code
				}
				$totalShipping = $order_data->shipping_cost;
				$data['order_items'] = $html;
				$data['product_coupon'] = $couponCodeHtml;
				$data['total_shipping'] = numberFormat($totalShipping);
			}
			$data['order_number'] = $order_data->order_number;
			$data['order_type'] = $paymentType;
			$data['total_amount'] = '&pound;'.numberFormat($total_all);
			$data['total'] = '&pound;'.numberFormat($total_all+$totalShipping-$order_data->coupon_cost);
			$data['coupon'] = '-&pound;'.numberFormat($order_data->coupon_cost);
		}
		else{
			return false;
		}
		$email_data = $this->comman_model->get_by('email',array('id'=>7),false,false,true);								
		$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
		$email_data->subject = str_replace('{site_email}',$this->data['settings']['site_email'], $email_data->subject);

		$email_data->message = str_replace('{user_name}', $data['user_name'], $email_data->message);
		$email_data->message = str_replace('{user_email}', $data['user_email'], $email_data->message);

		$email_data->message = str_replace('{order_type}', $data['order_type'], $email_data->message);
		$email_data->message = str_replace('{order_number}', $data['order_number'], $email_data->message);
		$email_data->message = str_replace('{total_amount}', ''.$data['total_amount'], $email_data->message);
		$email_data->message = str_replace('{order_item}', $data['order_items'], $email_data->message);
		$email_data->message = str_replace('{address1}', $data['address'], $email_data->message);
		$email_data->message = str_replace('{house_number}', $data['house_number'], $email_data->message);
		$email_data->message = str_replace('{city}', $data['city'], $email_data->message);
		$email_data->message = str_replace('{country}', $data['country'], $email_data->message);
		$email_data->message = str_replace('{zip_code}', $data['zip'], $email_data->message);
		$email_data->message = str_replace('{order_date}', $data['order_date'], $email_data->message);
		$email_data->message = str_replace('{total_shipping}', $data['total_shipping'], $email_data->message);

		$email_data->message = str_replace('{coupon_code}', $data['product_coupon'], $email_data->message);
		$email_data->message = str_replace('{coupon}', $data['coupon'], $email_data->message);
		$email_data->message = str_replace('{total}', ''.$data['total'], $email_data->message);
		$email_data->message = str_replace('{site_logo}', FCPATH.'assets/uploads/sites/'.$this->data['settings']['logo'], $email_data->message);

		$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
		$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
		$email_data->message = str_replace('{site_link}', base_url().'', $email_data->message);
		//echo $email_data->message;die;
		$labref=$data['order_number'];
		$path = 'assets/pdf/';
		$html = $email_data->message;
		$file_dir= 'assets/pdf/'.$data['order_number'].'.pdf';
		if(is_file($file_dir)){
			unlink($file_dir);
		}
		$paper_size = array(0,0,265,1122);
		$this->pdf->set_paper($paper_size);
		$this->pdf->createPDF($html,$path,$labref);

		//send to mail to user
		$email_data = $this->comman_model->get_by('email',array('id'=>5),false,false,true);						
		$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
		$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->subject);

		$email_data->message = str_replace('{user_name}', $data['user_name'], $email_data->message);
		$email_data->message = str_replace('{user_email}', $data['user_email'], $email_data->message);

		$email_data->message = str_replace('{order_number}', $data['order_number'], $email_data->message);
		$email_data->message = str_replace('{total_amount}', ''.$data['total'], $email_data->message);
		$email_data->message = str_replace('{order_item}', $html, $email_data->message);

		$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
		$email_data->message = str_replace('{site_email}',$this->data['settings']['site_email'], $email_data->message);
		$email_data->message = str_replace('{site_link}', base_url(), $email_data->message);
		$this->load->library('email');
		$config = array (
			  'mailtype' => 'html',
			  'charset'  => 'utf-8',
			  'priority' => '1'
			   );
		$this->email->initialize($config);
		$this->email->from($this->data['settings']['site_email'],$this->data['settings']['site_name']);
		$this->email->to($data['user_email']);
		$img = FCPATH.'assets/pdf/'.$data['order_number'].'.pdf';
		$this->email->attach($img);				
		$this->email->subject($email_data->subject);
		$this->email->message($email_data->message);
		if($this->email->send())
			$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],298));
		else 
			$this->session->set_flashdata('error',show_static_text($this->data['adminLangSession']['lang_id'],200));
		redirect($this->data['_cancel']);

	}

    public function edit($id = NULL){
	
	    if(!$id){
			redirect($this->data['_cancel']);
        }
    
		$this->data['products'] = $this->comman_model->get_by('user_order_shipping_add',array('order_id'=>$id), FALSE, FALSE, true);
		if(!$this->data['products']){
			redirect($this->data['_cancel']);
		}
        
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],152);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];

        $rules = $this->order_model->rules;
        $this->form_validation->set_rules($rules);

        // Process the form
        if($this->form_validation->run() == TRUE)
        {
            $data =array();
        	$data = $this->comman_model->array_from_post(array('first_name','last_name','email','house_number','city','phone','country','address','zip'));
			$this->comman_model->update_by('user_order_shipping_add',$data,array('order_id'=>$id));
            $this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],296));
            redirect($this->data['_cancel'].'/edit/'.$id);
        }
        
		$this->data['subview'] = $this->_subView.'edit_user';
        $this->load->view('admin/_layout_main', $this->data);
	}

	function set_xml(){			
		$this->load->library('excel');
        $this->excel->setActiveSheetIndex(0);
        // Gets all the data using MY_Model.php
        $data = $this->comman_model->get_by('user_orders',array('payment'=>1),false,false,false);
		if($data){
			foreach($data as $set_data){
				$users = $this->comman_model->get_by('user_order_shipping_add',array('order_id'=>$set_data->id),false,false,true);
				if($users){
						$price = '&pound;'.$set_data->total;
						$orderData[] = array(
									'order_number'=>$set_data->order_number,
									'username'=>$users->first_name.' '.$users->last_name,
									'email'=>$users->email,
									'city'=>$users->city,
									'phone'=>$users->phone,
									'amount'=>$price,
									'Order On'=>date('d-m-Y',$set_data->created),
									'amount'=>$price,
									'payment_type'=>$set_data->payment_type,
								);
					
				}
			}
		}
/*		echo '<pre>';
		print_r($orderData);
		die;*/
		
		if($orderData){
	        $this->excel->stream('orders'.time().'.xls', $orderData);
		}
		else{
		 return false;
		}
    
	}

	
	function save_order_status(){			
		$post_data = array('comment'=>$this->input->post('comment'),'order_status'=>$this->input->post('order_status'),
								'order_id'=>$this->input->post('order_id'),'date_added'=>date('Y-m-d H:i:s',time()));
		$this->comman_model->save('user_order_history',$post_data);		
		$notify =$this->input->post('notify');
		if($notify){
			$check = $this->comman_model->get_by('user_order_shipping_add',array('order_id'=>$post_data['order_id']),false,false,true);		
			$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
				$this->email->to($check->email);
				$this->email->subject('Order Details');
				$this->email->message($post_data['comment']);
				$this->email->send();

		}
		echo show_static_text($this->data['adminLangSession']['lang_id'],295);
	}

	function view_coupon($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
		//$this->data['table'] = true;
		$this->data['title'] = 'View Coupon | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'View Coupon ';
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['order_id'] = $id;
		$this->data['view_data'] = $this->comman_model->get_by('user_order_items',array('order_id'=>$id),false,false,true);
		//$check  = $this->comman_model->get_by('user_orders',array('id'=>$id),false,false,true);
		if(empty($this->data['view_data'])){
			redirect($this->data['_cancel']);
		}

		$this->data['coupon_data'] = $this->comman_model->get_by('user_order_item_coupons',array('item_id'=>$id),false,false,false);

        $this->data['subview'] = $this->_subView.'view_coupon';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function view($id=false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
		//$this->data['table'] = true;
        $this->data['name'] = show_static_text($this->data['adminLangSession']['lang_id'],152);
        $this->data['title'] = $this->data['name'].' | '.$this->data['settings']['site_name'];
		$this->data['login'] = $this->session->all_userdata();	
		$this->data['order_id'] = $id;
		$check  = $this->comman_model->get_by('user_orders',array('id'=>$id),false,false,true);
		if(empty($check)){
			redirect($this->data['_cancel']);
		}

		$this->data['order_details'] = $check;
		$this->data['view_data'] = $this->comman_model->get_by('user_order_items',array('order_id'=>$id),false,false,false);
		$this->data['order_user_details'] = $this->comman_model->get_by('user_order_shipping_add',array('order_id'=>$id),false,false,true);
		$this->data['order_histroy_data'] = $this->comman_model->get_by('user_order_history',array('order_id'=>$id),false,false,false);
        $this->data['subview'] = $this->_subView.'view';	
		$this->load->view('admin/_layout_main',$this->data);
	}

	function reseller(){
		$this->data['table'] = true;
		$this->data['title'] = 'Partner Order History | '.$this->data['settings']['site_name'];
		$this->data['name'] = 'Partner Order History';
		$this->data['login'] = $this->session->all_userdata();	
		$this->db->order_by('id','desc');
		$this->data['all_data'] = $this->comman_model->get_by('user_order_items',array('ownner_id !='=>0),false,false,false);
        $this->data['subview'] = $this->_subView.'reseller';	
		$this->load->view('admin/_layout_main',$this->data);
	}


/*	function send_mail(){		
		$this->data['name'] = 'Send Mail';	
        $this->data['title'] ='Send Mail | '.$this->data['settings']['site_name'];        

		//$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        if($this->form_validation->run()==TRUE){
	        if ($this->input->post('operation')){
				$post_data= $this->comman_model->array_from_post(array('subject','message'));
				$post_data['email'] = serialize($this->input->post('email'));
				//$registerForm = $this->comman_model->save($this->_table_names,$post_data);

				$this->load->library('email');
				$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
				$this->email->initialize($config);
				$this->email->from($this->data['site_email']->value, $this->data['settings']['site_name']);
				$this->email->to($this->input->post('email'));
				$this->email->subject($this->input->post('subject'));
				$this->email->message($this->input->post('message'));
				$this->email->send();
				$this->session->set_flashdata('success', 'Mail has successfully sent.');
				redirect($this->_redirect);
			}
		}
        
        //var_dump($this->data['admin_details']);
        $this->data['subview'] = $this->_subView.'mail_form';        
        $this->load->view('admin/_layout_main',$this->data);       
    }*/

	function get_status(){
		$id = $this->input->post('id');
		$post_data = array('status'=>$this->input->post('status'));
		$result = $this->comman_model->save($this->_table_names,$post_data,$id);
	}
	

	function delete($id = false){
		if(!$id){
			redirect($this->data['_cancel']);
		}
		$this->comman_model->delete_by_id($this->_table_names,array('id'=>$id));
		$this->comman_model->delete_by_id('user_order_items',array('order_id'=>$id));
		$this->comman_model->delete_by_id('user_order_shipping_add',array('order_id'=>$id));

		$this->session->set_flashdata('success',show_static_text($this->data['adminLangSession']['lang_id'],297)); 
		redirect($this->data['_cancel']);		

	}
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */