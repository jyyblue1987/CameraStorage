<?php
class region_model extends MY_Model {
    
    protected $_table_name = 'regions';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'parent_id' => array('field'=>'parent_id', 'label'=>'lang:Parent', 'rules'=>'trim|intval'),
        'language_id' => array('field'=>'language_id', 'label'=>'lang:Language', 'rules'=>'trim|intval'),
        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
     //   'template' => array('field'=>'template', 'label'=>'lang:Template', 'rules'=>'trim|required|xss_clean'),
        //'title' => array('field'=>'title', 'label'=>'lang:Title', 'rules'=>'trim|required|max_length[100]|xss_clean'),
        //'navigation_title' => array('field'=>'navigation_title', 'label'=>'lang:Navigation title', 'rules'=>'trim|required|max_length[100]|xss_clean'),
        //'body' => array('field'=>'body', 'label'=>'lang:Body', 'rules'=>'trim|required'),
   );
   
   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
        $this->languages = $this->language_model->get_form_dropdown('language', FALSE, FALSE);
        $this->languages_icon = $this->language_model->get_form_dropdown('image', FALSE, FALSE);
                                  
        //Rules for languages
        foreach($this->languages as $key=>$value)
        {
           // $this->rules_lang["title_$key"] = array('field'=>"title_$key", 'label'=>'lang:Title', 'rules'=>'trim|required|xss_clean');
       //     $this->rules_lang["navigation_title_$key"] = array('field'=>"navigation_title_$key", 'label'=>'lang:Navigation title', 'rules'=>'trim|required|xss_clean');
/*            $this->rules_lang["body_$key"] = array('field'=>"body_$key", 'label'=>'lang:Body', 'rules'=>'trim');
            $this->rules_lang["description_$key"] = array('field'=>"description_$key", 'label'=>'lang:Description', 'rules'=>'trim');
            $this->rules_lang["keywords_$key"] = array('field'=>"keywords_$key", 'label'=>'lang:Keywords', 'rules'=>'trim');*/
        }
	}

    public function get_new_country(){

        $cities = new stdClass();
        $cities->parent_id = 0;
        $cities->name = '';
        $cities->desc = '';
        
        return $cities;
	}

    public function get_new(){
        $cities = new stdClass();
        $cities->parent_id = 0;
        $cities->language_id = 0;
        $cities->slug = '';
        $cities->country = '';
        $cities->name = '';
        $cities->desc = '';
        $cities->template = 'cities';
        $cities->date = date('Y-m-d H:i:s');
        $cities->menu_location = '';
        
        //Add language parameters
        foreach($this->languages as $key=>$value)
        {
            $cities->{"title_$key"} = '';
            $cities->{"navigation_title_$key"} = '';
            //$page->{"slug_$key"} = '';
            $cities->{"body_$key"} = '';
            $cities->{"keywords_$key"} = '';
            $cities->{"description_$key"} = '';
        }
        
        return $cities;
	}
    
	public function save_order ($data)
	{
		if (count($data)) {
			foreach ($data as $order => $cities) {
				if ($cities['item_id'] != '') {
					$data = array('parent_id' => (int) $cities['parent_id'], 'order' => $order);
					$this->db->set($data)->where($this->_primary_key, $cities['item_id'])->update($this->_table_name);
				}
			}
		}
	}
    
	public function get_with_parent ($id = NULL, $single = FALSE)
	{
		$this->db->select('cities.*, p.slug as parent_slug, p.title as parent_title');
		$this->db->join('cities as p', 'cities.parent_id=p.id', 'left');
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
                    ->where(array('cities_lang.language_id'=>$lang_id,'cities.id'=>$id))
                    ->join('cities_lang','cities.id = cities_lang.category_id')
                    
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
        $cities = parent::get();
        
        // Return key => value pair array
        $array = array(0 => 'Select');
        //$array = array(0 => lang('No parent'));
        if(count($cities))
        {
            foreach($cities as $n)
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
        $cities = parent::get();
                
        return $cities;
	}
    
    public function get_first ()
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->order_by($this->_order_by);
        $this->db->limit(1);
        
		$cities = $this->db->get()->result();
        
        if(count($cities) > 0)
        {
            return $cities[0];
        }
        
        return '';
    }
    
    public function get_id_by_name ($category_id)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->order_by($this->_order_by);
		$cities = $this->db->get()->result_array();
        
		foreach ($cities as $n) {
		  if(url_title_cro($n['title'], '-', TRUE) == $category_id)  
          {
            return $n['id'];
          }
		}
        
        return $category_id;
    }    
 
	public function get_search_data($lang_id=2,$limit=false)
	{
        if($limit){
            $this->db->limit($limit);
        }
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where('language_id', $lang_id);
        $this->db->order_by($this->_order_by);
		$regions = $this->db->get()->result_array();
		
		$array = array();
		foreach ($regions as $n) {         
			$array[$n['id']] = $n;
		}
		return $array;
	}


     public function get_nested_services($lang_id=2)
    {
        $this->db->select('*')
                ->from($this->_table_name)
                ->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.services_id')
                ->where('language_id', $lang_id)
                ->order_by($this->_order_by);
        $cities = $this->db->get($this->_table_name)->result();
      
        $array = array();
        foreach ($cities as $n) {         
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
        $this->db->order_by($this->_order_by);
		$cities = $this->db->get()->result_array();
		$array = array();
		foreach ($cities as $n) {         
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

	public function get_nested1($lang_id=2,$limit=false){
        if($limit){
            $this->db->limit($limit);
        }
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where('language_id', $lang_id);
        $this->db->order_by($this->_order_by);
		$cities = $this->db->get()->result_array();
		//print_r($cities);
		$array = array();
		foreach ($cities as $n) {         
				$array[$n['id']] = $n;
		}
		$ay = $this->makeNested1($array);;
		return $ay;
	}

	function makeNested1($source) {

		$nested = array();
	
		foreach ( $source as &$s ) {
			if (!$s['parent_id']) {
				// no parent_id so we put it in the root of the array
				$nested[$s['id']] = &$s;
			}
			else {
				$pid = $s['parent_id'];
/*				echo 'asdsds';
				print_r($source[$pid]);*/
				if ( isset($source[$pid]) ) {
					if ( !isset($source[$pid]['children']) ) {
						$source[$pid]['children'] = array();
					}
	
					$source[$pid]['children'][] = &$s;
				}
			}
		}
		//print_r($nested);
		//die;
		return $nested;
	}
	
	function makeNested($lang_id=2,$limit=false) {
        if($limit){
            $this->db->limit($limit);
        }
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where('language_id', $lang_id);
        $this->db->order_by($this->_order_by);
		$source = $this->db->get()->result_array();
		//echo '<pre>';
		//print_r($source);

		$nested = array();
	
		foreach ( $source as &$s ) {
			if (!$s['parent_id']) {
				// no parent_id so we put it in the root of the array
				$nested[$s['id']] = &$s;
			}
			else {
				$pid = $s['parent_id'];
/*				echo 'asdsds';
				print_r($source[$pid]);*/
				if ( isset($source[$pid]) ) {
					if ( !isset($source[$pid]['children']) ) {
						$source[$pid]['children'] = array();
					}
	
					$source[$pid]['children'][] = &$s;
				}
			}
		}
		//print_r($nested);
		//die;
		return $nested;
	}	


    public function get_page_static($id,$lang_id){
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where('language_id', $lang_id);
        $this->db->where('id', $id);
        $cities = $this->db->get()->result_array();

        return $cities;
    }

    public function get_topmenu($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where(array('language_id'=>$lang_id));
        $this->db->where('(menu_location="top_menu" OR menu_location="both_menu")');
        $this->db->order_by($this->_order_by);
        $cities = $this->db->get()->result_array();
        
        $array = array();
        foreach ($cities as $p) {         
            if (! $p['parent_id']) {
                // This page has no parent
                $array[$p['id']] = $p;
            }
            else {
                // This is a child page
                $array[$p['parent_id']]['children'][] = $p;
            }
        }
        return $array;
    }

    public function get_footermenu($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where(array('language_id'=>$lang_id));
        $this->db->where('(menu_location="footer_menu" OR menu_location="both_menu")');
        $this->db->order_by($this->_order_by);
        $cities = $this->db->get()->result_array();
        
        $array = array();
        foreach ($cities as $n) {         
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

    public function get_bothmenu_location($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.category_id');
        $this->db->where(array('language_id'=>$lang_id));
        $this->db->where(array('menu_location'=>'both_menu'));
        $this->db->order_by($this->_order_by);
        $cities = $this->db->get()->result_array();
        
        $array = array();
        foreach ($cities as $n) {         
            if (!$n['parent_id']) {
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

    public function delete($id)
    {
		$this->db->delete($this->_table_name, array('id'=>$id));
        
    }

}


