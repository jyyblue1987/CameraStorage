<?php
class Partner_slider_model extends MY_Model {
    
    protected $_table_name = 'partner_sliders';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required|max_length[100]|xss_clean'),
        'description' => array('field'=>'description', 'label'=>'Description', 'rules'=>'trim'),
   );
   
   public $rules_lang = array();
   
    public function __construct(){
        parent::__construct();
		$this->load->model(array('language_model'));
        $this->languages = $this->language_model->get_form_dropdown('language', FALSE, FALSE);
        $this->languages_icon = $this->language_model->get_form_dropdown('image', FALSE, FALSE);
                                  
        //Rules for languages
        foreach($this->languages as $key=>$value)
        {
/*            $this->rules_lang["title_$key"] = array('field'=>"title_$key", 'label'=>'Title', 'rules'=>'trim|required|xss_clean');
            $this->rules_lang["navigation_title_$key"] = array('field'=>"navigation_title_$key", 'label'=>'Navigation title', 'rules'=>'trim|xss_clean');
            $this->rules_lang["body_$key"] = array('field'=>"body_$key", 'label'=>'Body', 'rules'=>'trim|required|xss_clean');
            $this->rules_lang["description_$key"] = array('field'=>"description_$key", 'label'=>'Description', 'rules'=>'trim');
            $this->rules_lang["keywords_$key"] = array('field'=>"keywords_$key", 'label'=>'Keywords', 'rules'=>'trim|');
*/        }
    }

    public function get_new()
    {
        $page = new stdClass();
        $page->parent_id = 0;
        $page->name = '';
        $page->link = '';
        $page->description ='';
        $page->type ='';
        $page->template = 'hometop';
        $page->date = date('Y-m-d H:i:s');
        
        //Add language parameters
        return $page;
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
    
    public function get_templates()
    {
        $templates = array( 
				"top slider"=>"Top Slider",
	     		"bottom slider"=>"Bottom Slider",);

        return $templates;
    }
    
    public function get_lang_banner($lang_id=1){
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.banner_id');
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
            $this->db->where('banner_id', $id);
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.banner_id');
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
    
    function delete_lang($banner_id){
     $this->db->delete($this->_table_name.'_lang', array('banner_id' => $banner_id));

     echo $this->db->last_query();
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
            $this->db->delete($this->_table_name.'_lang', array('banner_id' => $id));

           
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
                    $curr_data_lang['banner_id'] = $id;
                    
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
        $this->db->where('parent_id', 0);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.banner_id');
        $this->db->where('language_id', $lang_id);
        $pages = parent::get();
        
        // Return key => value pair array
        $array = array(0 =>'No parent');
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.banner_id');
        $pages = parent::get();
                
        return $pages;
    }
    
    public function get_first ()
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        //$this->db->order_by($this->_order_by);
        $this->db->where('id', '1');
        $this->db->limit(1);
        
        $pages = $this->db->get()->result();
        
        if(count($pages) > 0)
        {
            return $pages[0];
        }
        
        return '';
    }
    
    public function get_id_by_name ($banner_id)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.banner_id');
        $this->db->order_by($this->_order_by);
        $pages = $this->db->get()->result_array();
        
        foreach ($pages as $page) {
          if(url_title_cro($page['title'], '-', TRUE) == $banner_id)  
          {
            return $page['id'];
          }
        }
        
        return $banner_id;
    }    
 
     public function get_nested_services($lang_id=2)
    {
        $this->db->select('*')
                ->from($this->_table_name)
                ->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.services_id')
                ->where('language_id', $lang_id)
                ->order_by($this->_order_by);
        $pages = $this->db->get($this->_table_name)->result();
        echo $this->db->last_query(); die;
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
    public function get_nested ($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
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

    public function get_page_static($id,$lang_id){
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.banner_id');
        $this->db->where('language_id', $lang_id);
        $this->db->where('id', $id);
        $pages = $this->db->get()->result_array();

        return $pages;
    }

    public function get_topmenu($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.banner_id');
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.banner_id');
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.banner_id');
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
        $page_data = $this->get($id, TRUE);
        parent::delete($id);        		
       // $this->db->set(array('parent_id' => 0))->where('parent_id', $id)->update($this->_table_name);
    }

}

