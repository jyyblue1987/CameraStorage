<?php

class Partner_model extends MY_Model {
    
    protected $_table_name = 'partners';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'page_id' => array('field'=>'page_id', 'label'=>'lang:Page', 'rules'=>'trim|intval'),
        'first_name' => array('field'=>'first_name', 'label'=>'First Name', 'rules'=>'trim|required'),
        'last_name' => array('field'=>'last_name', 'label'=>'Last Name', 'rules'=>'trim|required'),
        'email' => array('field'=>'first_name', 'label'=>'lang:Name', 'rules'=>'trim|required|'),
		'email' =>array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|callback__unique_email'),
	    'password' =>array('field'=>'password','label'=>'Password','rules'=>'trim|required|'),
        //'navigation_title' => array('field'=>'navigation_title', 'label'=>'lang:Navigation title', 'rules'=>'trim|required|max_length[100]|xss_clean'),
        //'slug' => array('field'=>'slug', 'label'=>'lang:Slug', 'rules'=>'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'),
        //'body' => array('field'=>'body', 'label'=>'lang:Body', 'rules'=>'trim|required'),
   );
   
   public $rules_lang = array();
   
    public function __construct(){
        parent::__construct();
        
        $this->languages = $this->language_model->get_form_dropdown('language', FALSE, FALSE);
        $this->languages_icon = $this->language_model->get_form_dropdown('image', FALSE, FALSE);
        foreach($this->languages as $key=>$value)
        {
            //$this->rules_lang["body_$key"] = array('field'=>"body_$key", 'label'=>'About', 'rules'=>'trim|required|xss_clean');
        }
                                  
        //Rules for languages
    }

    public function get_new()
    {
        $partner = new stdClass();
        $partner->page_id = 0;
        $partner->first_name = '';
        $partner->last_name = '';
        $partner->email = '';
        $partner->phone = '';
        $partner->password = '';
        $partner->address = '';
        $partner->city = '';
        $partner->country = '';
        $partner->dob = '';
        $partner->date = date('Y-m-d H:i:s');
        
        //Add language parameters
        foreach($this->languages as $key=>$value)
        {
            $partner->{"title_$key"} = '';
            $partner->{"navigation_title_$key"} = '';
            //$partner->{"slug_$key"} = '';
            $partner->{"body_$key"} = '';
            $partner->{"keywords_$key"} = '';
            $partner->{"description_$key"} = '';
        }
        
        return $partner;
    }
    
    public function save_order ($pages)
    {
        if (count($pages)) {
            foreach ($pages as $order => $page) {
                if ($page['item_id'] != '') {
                    $data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
                }
            }
        }
    }
    
    public function get_with_parent ($id = NULL, $single = FALSE)
    {
        $this->db->select('page.*, p.slug as parent_slug, p.title as parent_title');
        $this->db->join('page as p', 'page.parent_id=p.id', 'left');
        return parent::get($id, $single);
    }
    
    public function get_templates($template_prefix)
    {
        $CI =& get_instance();
        
        $templates = array();

//        $templates = array('page' => lang('Page'), 
//                           'homepage' => lang('Homepage'), 
//                           'homepage-slideshow' => lang('Homepage Slideshow'), 
//                           'sale' => lang('Sale'), 
//                           'rent' => lang('Rent'), 
//                           'contact' => lang('Contact page'));
        
/*        $templatesDirectory = opendir(APPPATH.'../templates/'.$CI->app_settings['template']);
        // get each template
        while($tempFile = readdir($templatesDirectory)) {
            if ($tempFile != "." && $tempFile != "..") {
                if(substr_count($tempFile, $template_prefix) > 0)
                {
                    $templates[substr($tempFile,0,-4)] = lang_check(ucfirst(substr($tempFile, strlen($template_prefix), -4)));
                }

            }
        }
*/        
        return $templates;
    }
    
    public function get_lang_banner($lang_id=1){
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.partner_id');
        $this->db->where('language_id', $lang_id);
        $this->db->where('is_banner', 1);
        
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
    public function get_lang($id = NULL, $single = FALSE, $lang_id=1)
    {
        if($id != NULL)
        {
            $result = $this->get($id);
            
            $this->db->select('*');
            $this->db->from($this->_table_name.'_lang');
            $this->db->where('partner_id', $id);
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.partner_id');
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
    
    function delete_lang($partner_id){
		$this->db->delete($this->_table_name.'_lang', array('partner_id' => $partner_id));

     //echo $this->db->last_query();
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

             // delete all lang data
            $this->db->delete($this->_table_name.'_lang', array('partner_id' => $id));

           
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);

           

        }
       
            // Save lang data
            foreach($this->languages as $lang_key=>$lang_val)
            {
                if(is_numeric($lang_key))
                {
                    $curr_data_lang = array();
                    $curr_data_lang['language_id'] = $lang_key;
                    $curr_data_lang['partner_id'] = $id;
                    
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
					
                }
            }
        return $id;
    }
    
    public function get_no_parents($lang_id=1)
    {
        // Fetch pages without parents
        $this->db->select('*');
        $this->db->join('page_lang', 'page.id = page_lang.page_id');
        $this->db->where('language_id', $lang_id);
        if(!count($this->db->ar_orderby))
        {
            $this->db->order_by($this->_order_by);
        }
		//$pages = parent::get();
		$pages =$this->db->get('page')->result();
        //echo $this->db->last_query();die;
        
        // Return key => value pair array
        $array = array(0 => lang('No parent'));
        if(count($pages))
        {
            foreach($pages as $page)
            {
                $array[$page->id] = $page->title;
            }
        }
        
        return $array;
    }
    
    public function get_sitemap()
    {
        // Fetch pages without parents
        $this->db->select('*');
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.partner_id');
        $pages = parent::get();
                
        return $pages;
    }
    
    public function get_first ()
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        //$this->db->order_by($this->_order_by);
        $this->db->where('id', '16');
        $this->db->limit(1);
        
        $pages = $this->db->get()->result();
        
        if(count($pages) > 0)
        {
            return $pages[0];
        }
        
        return '';
    }
    
    public function get_id_by_name ($partner_id)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.partner_id');
        $this->db->order_by($this->_order_by);
        $pages = $this->db->get()->result_array();
        
        foreach ($pages as $page) {
          if(url_title_cro($page['title'], '-', TRUE) == $partner_id)  
          {
            return $page['id'];
          }
        }
        
        return $partner_id;
    }    
 
     public function get_nested_services($lang_id=2)
    {
        $this->db->select('*')
                ->from($this->_table_name)
                ->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.services_id')
                ->where('language_id', $lang_id)
                ->order_by($this->_order_by);
        $pages = $this->db->get($this->_table_name)->result();
        //echo $this->db->last_query(); die;
        $array = array();
        foreach ($pages as $page) {         
            if (! $page['parent_id']) {
                // This page has no parent
                $array[$page['id']] = $page;
            }
            else {
                // This is a child page
                $array[$page['parent_id']]['children'][] = $page;
            }
        }
        return $array;
    }   

	public function get_nested1($page_id=false,$lang_id=2,$limit=false)
	{
        if($limit){
            $this->db->limit($limit);
        }
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.partner_id');		
        $this->db->where('language_id', $lang_id);
        $this->db->where('page_id', $page_id);
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

    public function get_nested($lang_id=2)
    {
		//error_reporting(E_ALL);
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $pages = $this->db->get()->result_array();        
        $array = array();
        foreach ($pages as $page) {         
			// This page has no parent
			$array[$page['id']] = $page;
        }
        return $array;
    }

    public function get_page_static($id,$lang_id){
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.partner_id');
        $this->db->where('language_id', $lang_id);
        $this->db->where('id', $id);
        $pages = $this->db->get()->result_array();

        return $pages;
    }

    public function get_topmenu($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.partner_id');
        $this->db->where(array('language_id'=>$lang_id));
        $this->db->where('(menu_location="top_menu" OR menu_location="both_menu")');
        $this->db->order_by($this->_order_by);
        $pages = $this->db->get()->result_array();
        
        $array = array();
        foreach ($pages as $page) {         
            if (! $page['parent_id']) {
                // This page has no parent
                $array[$page['id']] = $page;
            }
            else {
                // This is a child page
                $array[$page['parent_id']]['children'][] = $page;
            }
        }
        return $array;
    }

    public function get_footermenu($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.partner_id');
        $this->db->where(array('language_id'=>$lang_id));
        $this->db->where('(menu_location="footer_menu" OR menu_location="both_menu")');
        $this->db->order_by($this->_order_by);
        $pages = $this->db->get()->result_array();
        
        $array = array();
        foreach ($pages as $page) {         
            if (! $page['parent_id']) {
                // This page has no parent
                $array[$page['id']] = $page;
            }
            else {
                // This is a child page
                $array[$page['parent_id']]['children'][] = $page;
            }
        }
        return $array;
    }

    public function get_bothmenu_location($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.partner_id');
        $this->db->where(array('language_id'=>$lang_id));
        $this->db->where(array('menu_location'=>'both_menu'));
        $this->db->order_by($this->_order_by);
        $pages = $this->db->get()->result_array();
        
        $array = array();
        foreach ($pages as $page) {         
            if (! $page['parent_id']) {
                // This page has no parent
                $array[$page['id']] = $page;
            }
            else {
                // This is a child page
                $array[$page['parent_id']]['children'][] = $page;
            }
        }
        return $array;
    }

    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
		$this->db->delete($this->_table_name.'_lang', array('partner_id'=>$id));
    }

}

