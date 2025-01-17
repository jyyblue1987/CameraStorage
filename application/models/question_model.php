<?php

class Question_model extends MY_Model {    
    protected $_table_name = 'quizs_ques';
    protected $_order_by = 'parent_id, order, id';
    public $rules = array(
        'category_id' => array('field'=>'category_id', 'label'=>'Entity Name', 'rules'=>'trim|intval'),
        //'code' => array('field'=>'code', 'label'=>'Product code', 'rules'=>'trim|required|max_length[100]|callback__unique_slug'),
        'name' => array('field'=>'name', 'label'=>'Name', 'rules'=>'trim|required'),
        'timer' => array('field'=>'timer', 'label'=>'Time', 'rules'=>'trim|required|integer'),
        'timer_type' => array('field'=>'timer_type', 'label'=>'Typer', 'rules'=>'trim'),
        'description' => array('field'=>'description', 'label'=>'Description', 'rules'=>'trim|required'),
   );
   
    public $question_rules = array(
        'quiz_id' => array('field'=>'quiz_id', 'label'=>'Exam', 'rules'=>'trim|intval'),
        'description' => array('field'=>'description', 'label'=>'Description', 'rules'=>'trim|required'),
        'option_a' => array('field'=>'option_a', 'label'=>'Option A', 'rules'=>'trim'),
        'option_b' => array('field'=>'option_b', 'label'=>'Option B', 'rules'=>'trim'),
        'option_c' => array('field'=>'option_c', 'label'=>'Option C', 'rules'=>'trim'),
        'option_d' => array('field'=>'option_d', 'label'=>'Option D', 'rules'=>'trim'),
        'answer' => array('field'=>'answer', 'label'=>'Answer', 'rules'=>'trim'),
   );

   public $rules_lang = array();
   
	public function __construct(){
		parent::__construct();
        $this->languages = $this->language_model->get_form_dropdown('language', FALSE, FALSE);
        $this->languages_icon = $this->language_model->get_form_dropdown('image', FALSE, FALSE);
                                  
        //Rules for languages
        foreach($this->languages as $key=>$value)
        {
/*            $this->rules_lang["title_$key"] = array('field'=>"title_$key", 'label'=>'lang:Title', 'rules'=>'trim|required|xss_clean');
			$this->rules_lang["body_$key"] = array('field'=>"body_$key", 'label'=>'lang:Body', 'rules'=>'trim');
            $this->rules_lang["short_description_$key"] = array('field'=>"short_description_$key", 'label'=>'Meta Description', 'rules'=>'trim');*/
			//$this->rules_lang["kampaign_$key"] = array('field'=>"kampaign_$key", 'label'=>'Kampaign', 'rules'=>'trim');
            //$this->rules_lang["keywords_$key"] = array('field'=>"keywords_$key", 'label'=>'lang:Keywords', 'rules'=>'trim');
        }
	}


    public function get_new_question(){

        $questions = new stdClass();
        $questions->quiz_id = '';

        $questions->description = '';
        $questions->option_a = '';
        $questions->option_b = '';
        $questions->option_c = '';
        $questions->option_d = '';
        $questions->answer = '';
        $questions->type = 'objective';

        $questions->date = date('Y-m-d H:i:s');

        return $questions;	
	}
	
    public function get_new()
	{
        $questions = new stdClass();
        //$questions->parent_id = 0;
        $questions->category_id= '';
        $questions->name = '';
        $questions->description = '';
        $questions->timer_type = '';
        $questions->timer = '';

        $questions->date = date('Y-m-d H:i:s');

        //Add language parameters
        foreach($this->languages as $key=>$value)
        {
/*            $questions->{"title_$key"} = '';
            //$page->{"slug_$key"} = '';
            $questions->{"body_$key"} = '';
            //$questions->{"kampaign_$key"} = '';
            //$questions->{"short_description_$key"} = '';
            //$questions->{"keywords_$key"} = '';*/
        }
        
        return $questions;
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
						'latest'=> "Latest",
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
		$this->db->delete('questions_category', array('question_id' => $id)); 
		if($data){
			foreach($data as $key=>$value){
				$this->db->insert('questions_category',array('category_id'=>$value,'question_id'=>$id));
			}
		}
	}

	function save_answer($data,$user_id=false){
		if($data){
			foreach($data as $key=>$value){
				$post_data =  array('right_answer'=>$value);
				$this->db->where(array('id'=>$key));
				$this->db->update('questions_answer',$post_data);
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

		// Reset parent ID for its children
		//$this->db->set(array('product_id' => 0))->where('product_id', $id)->update('projects');
    }

}


