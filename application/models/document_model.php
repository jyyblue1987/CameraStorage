<?php
class document_model extends MY_Model {    
    protected $_table_name = 'document';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'category_id' 		=> array('field'=>'category_id', 'label'=>'Category', 'rules'=>'trim|intval'),
        'name' 				=> array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
        'description' 		=> array('field'=>'description', 'label'=>'Description', 'rules'=>'trim|required'),
   );
    public $update_rules = array(
        'name' => array('field'=>'name', 'label'=>'Store Name', 'rules'=>'trim|required'),
        'city' => array('field'=>'city', 'label'=>'City', 'rules'=>'trim|required'),
        'country' => array('field'=>'country', 'label'=>'Country', 'rules'=>'trim|required'),
        'description' => array('field'=>'description', 'label'=>'Description', 'rules'=>'trim'),
        'address' => array('field'=>'address', 'label'=>'address', 'rules'=>'trim|required'),
        'zip' => array('field'=>'zip', 'label'=>'Post Code', 'rules'=>'trim|required'),
        'phone' => array('field'=>'phone', 'label'=>'Phone', 'rules'=>'trim|required|integer'),
   );

   
   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
	}

    public function get_new()
	{
        $tags = new stdClass();

        $tags->type 		= '';
        $tags->description 		= '';
        $tags->name 			= '';
        
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

    public function delete($id){
		$this->db->delete($this->_table_name, array('id'=>$id));
    }

}


