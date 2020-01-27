<?php

class Problem_model extends MY_Model {    
    protected $_table_name = 'problems';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
        'desc' => array('field'=>'desc', 'label'=>'Description', 'rules'=>'trim|required'),
   );
   
   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
        $this->languages = $this->language_model->get_form_dropdown('language', FALSE, FALSE);
        $this->languages_icon = $this->language_model->get_form_dropdown('image', FALSE, FALSE);
                                  
        //Rules for languages
        foreach($this->languages as $key=>$value)
        {
            $this->rules_lang["title_$key"] = array('field'=>"title_$key", 'label'=>'lang:Title', 'rules'=>'trim|required|xss_clean');
			$this->rules_lang["body_$key"] = array('field'=>"body_$key", 'label'=>'lang:Body', 'rules'=>'trim');
            $this->rules_lang["short_description_$key"] = array('field'=>"short_description_$key", 'label'=>'Meta Description', 'rules'=>'trim');
			//$this->rules_lang["kampaign_$key"] = array('field'=>"kampaign_$key", 'label'=>'Kampaign', 'rules'=>'trim');
            //$this->rules_lang["keywords_$key"] = array('field'=>"keywords_$key", 'label'=>'lang:Keywords', 'rules'=>'trim');
        }
	}

    public function get_new_ticket(){
        $categories = new stdClass();
        $categories->company_name= '';
        $categories->name= '';
        $categories->desc = '';
        $categories->solve_time = '';
        $categories->solve_user_time = '';
        $categories->date = date('d-m-Y');
        $categories->time = date('h:i A');
        $categories->help = '';
        $categories->urgency = '';
        $categories->is_confirm = '';
        $categories->is_responsive = '';
		
        $categories->ticket_id = '';
        $categories->files = '';
        return $categories;
	}

    public function get_new()
	{
        $tags = new stdClass();
        //$tags->parent_id = 0;
        $tags->slug = '';
        $tags->store_id = 0;
        $tags->user_id = 0;

        $tags->category_id = '';
        $tags->sub_category_id = '';
		

        $tags->is_feature = 0;
        $tags->free_shipping = 0;

        $tags->language_id = 0;
        $tags->price = 0;
        $tags->discount_price = 0;

        $tags->description= '';
        $tags->type = '';

        $tags->date = date('Y-m-d H:i:s');
        $tags->menu_location = '';
        
        //Add language parameters
        foreach($this->languages as $key=>$value)
        {
            $tags->{"title_$key"} = '';
            //$page->{"slug_$key"} = '';
            $tags->{"body_$key"} = '';
            //$tags->{"kampaign_$key"} = '';
            //$tags->{"short_description_$key"} = '';
            //$tags->{"keywords_$key"} = '';
        }
        
        return $tags;
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
    
    public function get_section(){
        $templates = array(
						'' => 'Select',
						'new' => 'New',
						'upcoming' => 'Upcoming',
					);
					
        return $templates;
	}

	public function get_templates($template_prefix){
        $CI =& get_instance();
        
        $templates = array();

        $templates = array('contact' => 'Contact page',
                           	'panoramas' => 'Panoramas Page', 							
                           	'map' => 'Map Page',
							'page' => 'Page',);

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
            $this->db->where('product_id', $id);
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
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
                    ->join('categories_lang','categories.id = categories_lang.product_id')
                    
                    ->get()->result_array();
            //echo $this->db->last_query();
            return $result;  
        }
        
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
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
    
    public function save_category_product($data, $id){
		$this->db->delete('product_category', array('product_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				$this->db->insert('product_category',array('category_id'=>$value,'product_id'=>$id));
			}
		}
	}
    public function save_colour_product($data, $id){
		$this->db->delete('product_colour', array('product_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				$this->db->insert('product_colour',array('colour_id'=>$value,'product_id'=>$id));
			}
		}
	}

    public function save_size_product($data, $id){
		$this->db->delete('product_size', array('product_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				$this->db->insert('product_size',array('size_id'=>$value,'product_id'=>$id));
			}
		}
	}

    public function save_brand_product($data, $id){
		$this->db->delete('product_brand', array('product_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				$this->db->insert('product_brand',array('brand_id'=>$value,'product_id'=>$id));
			}
		}
	}


    public function save_tag_product($data, $id){
		$this->db->delete('product_tag', array('product_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				$this->db->insert('product_tag',array('tag_id'=>$value,'product_id'=>$id));
			}
		}
	}

    public function save_attribute_product($data, $id,$att_id){
		$this->db->delete('product_attribute', array('product_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				$this->db->where(array('id'=>$value));
				$check_value = $this->db->get('attributes_value')->row();
				if($check_value){
					$this->db->where(array('id'=>$check_value->field_id));
					$check_field = $this->db->get('attributes_field')->row();
					if($check_field){						
						$this->db->insert('product_attribute',array('value_id'=>$value,'product_id'=>$id,'attribute_id'=>$att_id,'field_id'=>$check_field->id,));
						//echo '<br>'.$this->db->last_query();
					}
					
				}
			}
		}
		//die;
	}

    public function save_location_product($data, $id){
		$this->db->delete('product_location', array('product_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				$this->db->insert('product_location',array('location_id'=>$value,'product_id'=>$id));
			}
		}
	}

    public function save_store_product($data, $id){
		$this->db->delete('product_store', array('product_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				$this->db->insert('product_store',array('store_id'=>$value,'product_id'=>$id));
			}
		}
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
        $this->db->delete($this->_table_name.'_lang', array('product_id' => $id));
        
        foreach($this->languages as $lang_key=>$lang_val)
        {
            if(is_numeric($lang_key))
            {
                $curr_data_lang = array();
                $curr_data_lang['language_id'] = $lang_key;
                $curr_data_lang['product_id'] = $id;
                
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
        $this->db->where('language_id', $lang_id);
        $categories = parent::get();
        
        // Return key => value pair array
        $array = array(0 => lang('No parent'));
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
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
    
    public function get_id_by_name ($product_id)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
        $this->db->order_by($this->_order_by);
		$categories = $this->db->get()->result_array();
        
		foreach ($categories as $n) {
		  if(url_title_cro($n['title'], '-', TRUE) == $product_id)  
          {
            return $n['id'];
          }
		}
        
        return $product_id;
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
        $this->db->where('language_id', $lang_id);
        $this->db->where('id', $id);
        $categories = $this->db->get()->result_array();

        return $categories;
    }

    public function get_topmenu($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
        $this->db->where(array('language_id'=>$lang_id));
        $this->db->where('(menu_location="top_menu" OR menu_location="both_menu")');
        $this->db->order_by($this->_order_by);
        $categories = $this->db->get()->result_array();
        
        $array = array();
        foreach ($categories as $p) {         
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
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
        $this->db->where(array('language_id'=>$lang_id));
        $this->db->where('(menu_location="footer_menu" OR menu_location="both_menu")');
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

    public function get_bothmenu_location($lang_id=2)
    {
        $this->db->select('*');
        $this->db->from($this->_table_name);
        $this->db->join($this->_table_name.'_lang', $this->_table_name.'.id = '.$this->_table_name.'_lang.product_id');
        $this->db->where(array('language_id'=>$lang_id));
        $this->db->where(array('menu_location'=>'both_menu'));
        $this->db->order_by($this->_order_by);
        $categories = $this->db->get()->result_array();
        
        $array = array();
        foreach ($categories as $n) {         
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
        $this->db->delete($this->_table_name.'_lang', array('product_id' => $id)); 
		$this->db->delete($this->_table_name, array('id'=>$id));

		$this->db->delete('product_category', array('product_id'=>$id));
		$this->db->delete('products_eoption', array('product_id'=>$id));
		$this->db->delete('products_extra', array('product_id'=>$id));
		$this->db->delete('products_option', array('product_id'=>$id));
/*		$this->db->delete('product_tag', array('product_id'=>$id));
		$this->db->delete('product_attribute', array('product_id'=>$id));*/
        
		// Reset parent ID for its children
		//$this->db->set(array('product_id' => 0))->where('product_id', $id)->update('projects');
    }


    public function save_options($data,$price_data,$options_id, $id){
		if($options_id){
			$this->db->where_not_in('id',$options_id);
			$this->db->where('product_id',$id);
			$this->db->delete('products_option');
		}
		else{
			$this->db->where('product_id',$id);
			$this->db->delete('products_option');
		}
		//$this->db->delete('posts_option', array('post_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				if(isset($options_id[$key])){
					$this->db->where('id', $options_id[$key]);
					$this->db->where('product_id', $id);
					$this->db->update('products_option',array('name'=>$value,'price'=>$price_data[$key]));
				}
				else{
					$this->db->insert('products_option',array('name'=>$value,'price'=>$price_data[$key],'product_id'=>$id));
				}
			}
		}
	}

    public function save_extra($data,$price_data,$options_id, $id){
		if($options_id){
			$this->db->where_not_in('id',$options_id);
			$this->db->where('product_id',$id);
			$this->db->delete('products_extra');
		}
		else{
			$this->db->where('product_id',$id);
			$this->db->delete('products_extra');
		}
		//$this->db->delete('posts_option', array('post_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				if(isset($options_id[$key])){
					$this->db->where('id', $options_id[$key]);
					$this->db->where('product_id', $id);
					$this->db->update('products_extra',array('name'=>$value,'price'=>$price_data[$key]));
				}
				else{
					$this->db->insert('products_extra',array('name'=>$value,'price'=>$price_data[$key],'product_id'=>$id));
				}
			}
		}
	}


	function get_product_options($product_id,$level=false){
		$this->db->where('product_id',$product_id); 
		if($level){
			$this->db->where('level',$level); 
		}
		$this->db->order_by('order', 'ASC');
		
		$result	= $this->db->get('products_eoption');
		
		$return = array();
		foreach($result->result() as $option)
		{
			$return[]	= $option;
		}
		return $return;
	}

	function save_option($data,$id){

		//delete
		if(!empty($data)){
			$deleteArray = array();
			foreach($data as $set_option){
				if(isset($set_option['id'])&&!empty($set_option['id'])){
					$deleteArray[] =$set_option['id'];
				}
			}
			if($deleteArray){
				$this->db->where_not_in('id',$deleteArray);
				$this->db->where('product_id',$id);
				$this->db->delete('products_eoption');
			}
		}
		else{
			$this->db->where('product_id',$id);
			$this->db->delete('products_eoption');
			//echo $this->db->last_query();
		}
		//echo '<pre>';
		//print_r($deleteArray);
		//print_r($data);
		$count = 1;
		if($data){
			foreach ($data as $option){
				$option['product_id'] = $id;
				$option['order'] = $count;
				if(isset($option['values'])&&!empty($option['values'])){
					$option['values'] = implode(',',$option['values']);
				}
	
				if(isset($option['description'])&&!empty($option['description'])){
					$option['description'] = implode(',$,',$option['description']);
				}
				
				if(isset($option['id'])&&!empty($option['id'])){
					$this->db->where('id', $option['id']);
					$this->db->update('products_eoption', $option);
				}
				else{
					unset($option['id']);
					$this->db->insert('products_eoption', $option);
					$this->db->insert_id();
				}
				$count++;
			}
		}
	}
}


