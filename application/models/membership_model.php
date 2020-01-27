<?php

class Membership_model extends MY_Model {
    
    protected $_table_name = 'memberships';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'parent_id' => array('field'=>'parent_id', 'label'=>'lang:Parent', 'rules'=>'trim|intval'),
        'language_id' => array('field'=>'language_id', 'label'=>'lang:Language', 'rules'=>'trim|intval'),
        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required|max_length[100]|xss_clean'),
        'desc' => array('field'=>'desc', 'label'=>'Description', 'rules'=>'trim'),
//        'member' => array('field'=>'member', 'label'=>'Member', 'rules'=>'trim|required|numeric'),
        'price' => array('field'=>'price', 'label'=>'User price', 'rules'=>'trim|required|numeric'),
        'price2' => array('field'=>'price2', 'label'=>'Dealer price', 'rules'=>'trim|required|numeric'),
       // 'c_point' => array('field'=>'c_point', 'label'=>'Credit Point', 'rules'=>'trim|required|numeric'),
       // 'month' => array('field'=>'month', 'label'=>'Month', 'rules'=>'trim|required|integer'),
   );

    public $user_rules = array(
        'parent_id' => array('field'=>'parent_id', 'label'=>'lang:Parent', 'rules'=>'trim|intval'),
        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required|max_length[100]|xss_clean'),
        'desc' => array('field'=>'desc', 'label'=>'Description', 'rules'=>'trim'),
        'price' => array('field'=>'price', 'label'=>'Price', 'rules'=>'trim|required|numeric'),
        'month' => array('field'=>'month', 'label'=>'Month', 'rules'=>'trim|required|integer'),
        'member' => array('field'=>'member', 'label'=>'Classes', 'rules'=>'trim|required|integer'),
   );
   
   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
                                  
	}
	
	public function  get_day_month(){
		$month= array();

		for($i=1;$i<=29;$i++){
			$month[$i] = $i.' day';
		}
		$month['30']  ='1 Month'; 
		$month['60']  ='2 Months'; 
		$month['90']  ='3 Months'; 
		$month['120']  ='4 Months'; 
		$month['150']  ='5 Months'; 
		$month['180']  ='6 Months'; 
		$month['365']  ='1 Year'; 
		$month['730']  = '2 Years'; 
		$month['1095']  = '3 Years'; 
        return $month;

	}

    public function get_new(){
		$categories = new stdClass();
		$categories->type			= '';
		$categories->parent_id 		= 0;
		$categories->language_id 	= 0;
		$categories->name 			= '';
		$categories->desc			= '';
		$categories->type			= '';
		$categories->member			= 1;
		$categories->plan_id		= '';
		$categories->month 			= 1;
		$categories->price 			= 0;
		$categories->price2			= 0;
        
        //Add language parameters
        
        return $categories;
	}

    public function get_new_user(){
        $categories = new stdClass();
        $categories->parent_id 		= 0;
        $categories->language_id 	= 0;
        $categories->name 			= '';
        $categories->desc			= '';
        $categories->s_date			= '';
        $categories->e_date			= '';
        $categories->type			= '';
        $categories->member			= '';
        $categories->staff			= 1;
        $categories->coach			= 1;
        $categories->price 			= 1;
        $categories->c_point 		= 0;
        $categories->days 			= 1;
        $categories->month 			= 1;
        $categories->gym_id 		= '';
        $categories->program_id		= '';
        $categories->payment_type	= '';
        
        //Add language parameters
        
        return $categories;
	}
    
	public function save_order ($data)
	{
		if (count($data)) {
			foreach ($data as $order => $categories) {
				if ($categories['item_id'] != '') {
					$data = array('parent_id' => (int) $categories['parent_id'], 'order' => $order);
					$this->db->set($data)->where($this->_primary_key, $categories['item_id'])->update($this->_table_name);
				}
			}
		}
	}
    
	public function get_with_parent ($id = NULL, $single = FALSE)
	{
		$this->db->select('categories.*, p.slug as parent_slug, p.title as parent_title');
		$this->db->join('categories as p', 'categories.parent_id=p.id', 'left');
		return parent::get($id, $single);
	}
    
    public function get_templates($template_prefix)
    {
        $CI =& get_instance();
        
        $templates = array();
        
/*        $templatesDirectory = opendir(APPPATH.'../templates/'.$CI->app_settings['template']);
        // get each template
        while($tempFile = readdir($templatesDirectory)) {
            if ($tempFile != "." && $tempFile != "..") {
                if(substr_count($tempFile, $template_prefix) > 0)
                {
                    $templates[substr($tempFile,0,-4)] = lang_check(ucfirst(substr($tempFile, strlen($template_prefix), -4)));
                }

            }
        }*/
        
        return $templates;
    }
    
	public function get_lang1($id = NULL, $single = FALSE, $lang_id=1){    	
		$this->db->select('*');
		$this->db->from($this->_table_name.'_lang');
		$lang_result = $this->db->get()->result_array();
		foreach ($lang_result as $row)
		{
			foreach ($row as $key=>$val)
			{
				$result->{$key.'_'.$row['language_id']} = $val;
			}
		}
		
		foreach($this->languages as $key_lang=>$val_lang)
		{
			foreach($this->rules_lang as $r_key=>$r_val)
			{
				if(!isset($result->{$r_key}))
				{
					$result->{$r_key} = '';
				}
			}
		}
		
		return $result;
    }
    
	public function get_lang($id = NULL, $single = FALSE, $lang_id=1)
    {
        if($id != NULL)
        {
            $result = $this->get($id);
            
            $this->db->select('*');
            $this->db->from($this->_table_name.'_lang');
            $this->db->where('category_id', $id);
            $lang_result = $this->db->get()->result_array();
            foreach ($lang_result as $row)
            {
                foreach ($row as $key=>$val)
                {
                    $result->{$key.'_'.$row['language_id']} = $val;
                }
            }
            
            foreach($this->languages as $key_lang=>$val_lang)
            {
                foreach($this->rules_lang as $r_key=>$r_val)
                {
                    if(!isset($result->{$r_key}))
                    {
                        $result->{$r_key} = '';
                    }
                }
            }
            
            return $result;
        }
        
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where('language_id', $lang_id);
        
        if($single == TRUE)
        {
            $method = 'row';
        }
        else
        {
            $method = 'result';
        }
        
        if(!count($this->db->ar_orderby))
        {
            $this->db->order_by($this->_order_by);
        }
        
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

  
    public function get_lang_array($id = NULL, $single = FALSE, $lang_id=1)
    {

        if($id != NULL)
        {
            $result = $this->db
                    ->select($this->_table_name.'.* ,'.$this->_table_name.'.id, '.$this->_table_name.'_lang.*')
                    ->from($this->_table_name)
                    ->where(array('categories_lang.language_id'=>$lang_id,'categories.id'=>$id))
                    ->join('categories_lang','categories.id = categories_lang.category_id')
                    
                    ->get()->result_array();
            //echo $this->db->last_query();
            return $result;  
        }
        
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where('language_id', $lang_id);
        
        if($single == TRUE)
        {
            $method = 'row';
        }
        else
        {
            $method = 'result';
        }
        
        if(!count($this->db->ar_orderby))
        {
            $this->db->order_by($this->_order_by);
        }
        
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
    
    public function save_with_lang($data, $data_lang, $id = NULL)
    {
        // Set timestamps
        if($this->_timestamps == TRUE)
        {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }

        // Insert
        if($id === NULL)
        {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        // Update
        else
        {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }
        
        // Save lang data
        $this->db->delete($this->_table_name.'_lang', array('category_id' => $id));
        
        foreach($this->languages as $lang_key=>$lang_val)
        {
            if(is_numeric($lang_key))
            {
                $curr_data_lang = array();
                $curr_data_lang['language_id'] = $lang_key;
                $curr_data_lang['category_id'] = $id;
                
                foreach($data_lang as $data_key=>$data_val)
                {
                    $pos = strrpos($data_key, "_");
                    if(substr($data_key,$pos+1) == $lang_key)
                    {
                        $curr_data_lang[substr($data_key,0,$pos)] = $data_val;
                    }
                }
                $this->db->set($curr_data_lang);
                $this->db->insert($this->_table_name.'_lang');
				//echo $this->db->last_query();
            }
        }

        return $id;
    }
    
    public function get_no_parents($lang_id=1)
	{
        // Fetch pages without parents
        $this->db->select('*');
        $this->db->where('parent_id', 0);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where('language_id', $lang_id);
        $categories = parent::get();
        
        // Return key => value pair array
        $array = array(0 => 'Select');
        //$array = array(0 => lang('No parent'));
        if(count($categories))
        {
            foreach($categories as $n)
            {
                $array[$n->id] = $n->title;
            }
        }
        
        return $array;
	}
    
    public function get_sitemap()
	{
        // Fetch pages without parents
        $this->db->select('*');
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $categories = parent::get();
                
        return $categories;
	}
    
    public function get_first ()
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->order_by($this->_order_by);
        $this->db->limit(1);
        
		$categories = $this->db->get()->result();
        
        if(count($categories) > 0)
        {
            return $categories[0];
        }
        
        return '';
    }
    
    public function get_id_by_name ($category_id)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->order_by($this->_order_by);
		$categories = $this->db->get()->result_array();
        
		foreach ($categories as $n) {
		  if(url_title_cro($n['title'], '-', TRUE) == $category_id)  
          {
            return $n['id'];
          }
		}
        
        return $category_id;
    }    
 
     public function get_nested_services($lang_id=2)
    {
        $this->db->select('*')
                ->from($this->_table_name)
                ->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.services_id')
                ->where('language_id', $lang_id)
                ->order_by($this->_order_by);
        $categories = $this->db->get($this->_table_name)->result();
      
        $array = array();
        foreach ($categories as $n) {         
            if (! $n['parent_id']) {
                // This page has no parent
                $array[$n['id']] = $n;
            }
            else {
                // This is a child page
                $array[$n['parent_id']]['children'][] = $n;
            }
        }
        return $array;
    }   
	public function get_nested($lang_id=2,$limit=false)
	{
        if($limit){
            $this->db->limit($limit);
        }
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where('language_id', $lang_id);
        $this->db->order_by($this->_order_by);
		$categories = $this->db->get()->result_array();
		
		$array = array();
		foreach ($categories as $n) {         
			if (! $n['parent_id']) {
				// This page has no parent
				$array[$n['id']] = $n;
			}
			else {
				// This is a child page
				$array[$n['parent_id']]['children'][] = $n;
			}
		}
		return $array;
	}

    public function get_page_static($id,$lang_id){
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where('language_id', $lang_id);
        $this->db->where('id', $id);
        $categories = $this->db->get()->result_array();

        return $categories;
    }

	function getPaymentType($id,$user_id){
		$payment_type =array();
		$checkPaypal = print_value('users_paypal',array('payment'=>'Paypal','user_id'=>$user_id,'gym_id'=>$id),'id',0);
		if($checkPaypal>0){
			$payment_type['paypal'] = 'Paypal';
		}
		
		$checkCheque = print_value('users_paypal',array('payment'=>'Cheque','user_id'=>$user_id,'gym_id'=>$id),'id',0);
		if($checkCheque>0){
			$payment_type['cheque'] = 'Cheque';
		}
		$checkCash = print_value('users_paypal',array('payment'=>'Cash','user_id'=>$user_id,'gym_id'=>$id),'id',0);
		if($checkCash>0){
			$payment_type['cash'] ='Cash';
		}
		return $payment_type;
	}

    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
    }

}


