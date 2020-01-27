<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_send extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form','date','front'));	
		$this->load->library(array('session'));
		$this->load->model(array('comman_model','settings_model'));
		$this->data['set_meta'] = '';	
        $this->data['settings'] = $this->settings_model->get_fields();
		date_default_timezone_set("America/Cancun"); 

	}


	function ajax32(){//send mail when camera connect loss
		$output['status'] ='ok';
		if($this->data['settings']['email_option']==1){
			$all_camera = $this->comman_model->get_by('camera',array('sys_file'=>0,'is_connect'=>0,'is_mail'=>1,'is_send'=>0),false,false,false);
			if($all_camera){
				foreach($all_camera as $set_c){
					$u_data  = $this->comman_model->get_by('users',array('id'=>$set_c->user_id),false,false,true);
					if($u_data){
						$this->db->where('id',$set_c->id);
						$this->db->set('is_send',1,true);
						$this->db->update('camera');
						$email_data = $this->comman_model->get_by('users_email',array('user_id'=>$u_data->parent_id,'email_id'=>5),false,false,true);
						if($email_data){
							$email_data->subject = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->subject);
							$email_data->subject = str_replace('{site_email}', $this->data['settings']['site_name'], $email_data->subject);		
							$email_data->message = str_replace('{user_name}', $u_data->username, $email_data->message);
							$email_data->message = str_replace('{camera_name}', $set_c->name, $email_data->message);
							$email_data->message = str_replace('{site_name}', $this->data['settings']['site_name'], $email_data->message);
							$email_data->message = str_replace('{site_email}', $this->data['settings']['site_email'], $email_data->message);
							//echo $email_data->message;
			
							$this->load->library('email');
							$config = array (
								  'mailtype' => 'html',
								  'charset'  => 'utf-8',
								  'priority' => '1'
								   );
							$this->email->initialize($config);
							$this->email->from($this->data['settings']['site_email'], $this->data['settings']['site_name']);
							$this->email->to($u_data->email);
							$this->email->subject($email_data->subject);
							$this->email->message($email_data->message);
							$this->email->send();	
						}
					}
				}
			}
		}
		echo json_encode($output);
	}

	function ajax4321(){//check expire camera and delete camera
		ini_set("memory_limit","2512M");
		$output['status'] ='ok';
		//check paid camera is expire
		$PaidCamera = $this->comman_model->get_by('camera',array('payment_id !='=>0,'is_expire'=>0),false,false,false);
		$now = strtotime(date('Y-m-d'));
		//echo '<br>Now Date:'.date('Y-m-d',$now);
		if($PaidCamera){
			//echo 'as';
			foreach($PaidCamera as $set_mult){						
				$totalDay = $set_mult->plan_day;
				$expireData = strtotime(h_addDate($set_mult->plan_date,'day',$totalDay,'Y-m-d'));
/*				echo '<br><br>ExpireD: '.date('Y-m-d',$expireData);
				echo '<br><br>Now string:'.$now;
				echo '<br>U time: '.$expireData;*/
				if($now>=$expireData){
					//echo 'Yes';
					//echo '<br>Ok:'.$set_mult->id;				
					$this->comman_model->update_by('camera',array('is_expire'=>1),array('id'=>$set_mult->id));
				}
			}
		}
		

		//check expire camera >3days
		$PaidCamera = $this->comman_model->get_by('camera',array('payment_id !='=>0,'is_expire'=>1,'is_delete'=>0),false,false,false);
		if($PaidCamera){
			//echo 'as';
			foreach($PaidCamera as $set_mult){						
				$totalDay = $set_mult->plan_day;
				$expireData = strtotime(h_addDate($set_mult->plan_date,'day',($totalDay+3),'Y-m-d'));
/*				echo '<br><br>ExpireD: '.date('Y-m-d',$expireData);
				echo '<br><br>Now string:'.$now;
				echo '<br>U time: '.$expireData;*/
				if($now>=$expireData){
					//echo 'asd';
//					$this->comman_model->update_by('camera',array('is_expire'=>1),array('id'=>$set_mult->id));

//					$this->db->delete('camera', array('id'=>$id,'user_id'=>$this->data['user_details']->id)); 
					if(ENVIRONMENT=='production'){
						$new_files = 'data/'.$set_mult->camera_path.'/camera '.$set_mult->id;
					}
					else{
						$new_files = '/var/www/html/data/'.$set_mult->camera_path.'/camera '.$set_mult->id;
					}

					$this->load->helper('directory');
					$this->load->helper("file");
					h_deleteDirectory($new_files.'/');
					if(ENVIRONMENT=='production'){
						$this->comman_model->update_by('camera',array('is_delete'=>1),array('id'=>$set_mult->id));
					}
					else{
						$this->db->delete('camera', array('id'=>$set_mult->id)); 
					}
				}//$now>=$expireData
			}//foreach
		}//check expire camera >3days
		echo json_encode($output);
	}
		
}
