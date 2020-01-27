<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct(){
    	parent::__construct();
		$this->data['active'] = 'home';	
    }

    public function index() {
        // Fetch recently modified articles
        $this->data['subview'] = 'admin/dashboard/index';
		//$this->data['merchant'] = $this->comman_model->get_by('',array('enabled'=>1),false,false,false);
/*		$this->data['websites'] = $this->comman_model->get_by('websites',array('enabled'=>1),false,false,false);
		$this->data['users'] = $this->comman_model->get('users',false);
		$this->data['coupons'] = $this->comman_model->get_by('coupons',array('coupon_code !='=>''),false,false,false);
		$this->data['deals'] = $this->comman_model->get_by('coupons',array('coupon_code '=>''),false,false,false);
		$this->data['active_coupons'] = $this->comman_model->get_by('coupons',array('coupon_code !='=>'','enabled'=>1),false,false,false);
		$this->data['active_deals'] = $this->comman_model->get_by('coupons',array('coupon_code '=>'','enabled'=>1),false,false,false);
		$this->data['pending_coupon'] = $this->comman_model->get_by('coupons',array('enabled'=>0),false,false,false);
*/
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function modal() {
        $this->load->view('admin/_layout_modal', $this->data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */