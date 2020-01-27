<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class comman_model extends CI_Model {
	protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
	protected $_timestamps = TRUE;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

   public function get_time(){	 
		$options = array();
		foreach (range(0,23) as $fullhour) 
		{
			$parthour = $fullhour > 12 ? $fullhour - 12 : $fullhour;
			$sufix = $fullhour > 11 ? " pm" : " am";
		
			$options["$fullhour:00"] = $parthour.":00".$sufix;
			$options["$fullhour:30"] = $parthour.":30".$sufix;
		}
		return $options;
	}

   public function get_time_hour(){	 
		$options = array();
		foreach (range(1,24) as $fullhour) 
		{
			$parthour = $fullhour;
		
			$options["$fullhour:00"] = $parthour.":00";
		}
		return $options;
	}

    public function get_max_order($table){
        // get max order
        $this->db->select('MAX(`order`) as `order`', FALSE);
        $row = $this->db->get($table)->row();        
        return (int) $row->order;
    }

    public function get_lang($table_name,$lang_id=1,$id = NULL,$where=false,$parent_id,$single = FALSE){
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->join($table_name.'_lang', $table_name.'.id = '.$table_name.'_lang.'.$parent_id);
        $this->db->where('language_id', $lang_id);
		if($where){
	        $this->db->where($where);
		}
        if($id != NULL){
	        $this->db->where($table_name.'.id', $id);
		}
        
        if($single == TRUE){
            $method = 'row';
        }
        else
        {
            $method = 'result';
        }
        
/*        if(!count($this->db->ar_orderby))
        {
            $this->db->order_by($this->_order_by);
        }
*/        
        return $query = $this->db->get()->$method();
/*        $result = $query->result();
        return $result;*/
	}
	
    public function get_no_parents($table_name,$where){
        // Fetch pages without parents
        $this->db->select('*');
        $this->db->where($where);
        $sizes = $this->db->get($table_name)->result();

        
        // Return key => value pair array
        $array = array();
        //$array = array(0 => lang('No parent'));
        if(count($sizes))
        {
            foreach($sizes as $n)
            {
                $array[$n->id] = $n->name;
            }
        }
        return $array;
	}
    
	
	
	public function save($table,$data, $id = NULL){    
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = time();
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		
		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($table);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($table);
		}
		//echo $this->db->last_query();die;
	    return $id;
    }

	public function save_with_lang($table,$data, $id = NULL){    
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = time();
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		
		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($table);
			$id = $this->db->insert_id();

	        $curr_data_lang['product_id'] = $id;
            $language =  $this->get('language',false);
			if($language){
				foreach($language as  $set_value){
					$curr_data_lang['language_id'] = $set_value->id;
					$this->db->set($curr_data_lang);
					$this->db->insert($table.'_lang');
				}
			}
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($table);
		}
		//echo $this->db->last_query();die;
	    return $id;
    }

	public function update($table,$data, $id = NULL){    
		// Set timestamps
		$this->db->set($data);
		$this->db->where($id);
		$this->db->update($table);
		//echo $this->db->last_query();die;
	   //return $id;
    }

    public function get_query_by_array($string){
		$query = $this->db->query($string);		
		//echo $this->db->last_query();die;
		return $query->result_array(); 
	}
	

    public function get_query($string,$single=false,$arry=false){
		$query = $this->db->query($string);		
		if($arry){
			if($single == TRUE) {
				$method = 'row_array';
			}
			else {
				$method = 'result_array';
			}
		}
		else{
			if($single == TRUE) {
				$method = 'row';
			}
			else {
				$method = 'result';
			}
		}		//echo $this->db->last_query();die;
		return $query->$method(); 
	}
	
	
    public function get_by($table,$where, $like = false,$order = false, $single = FALSE){
        
		if($like){
			$this->db->like($like);
        }		
		if($order){
			foreach($order as $set =>$value){				
	            $this->db->order_by($set,$value);
			}
		}
        $this->db->where($where);
       	//$this->get($table, $single);
       	//echo $this->db->last_query();die;
		
        return $this->get($table, $single);
    }

    public function get($table,$single = FALSE){
		$this->_table_name = $table;
      	if($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result';
        }
    
/*        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by);
        }*/
		//$this->db->get($this->_table_name)->$method();
       // echo $this->db->last_query();die;
        return $this->db->get($this->_table_name)->$method();
    }

	public function array_from_post($fields){
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }
        return $data;
    }
   
	function upload($file_name,$path){
		
		$result = array();
		$field_name = $file_name;
		$config['upload_path'] = $path.'/';
		$config['allowed_types'] = '*';
		$config['max_size']	= '900000';
		$this->load->library('upload', $config);
		$this->upload->initialize($config); 

		if (!$this->upload->do_upload($field_name)){
			array_push($result,'error',$this->upload->display_errors());
			return $result; 
		}
		else{
			$upload_data = $this->upload->data();
			$this->load->library('image_lib');
			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image']	= $path.'/thumbnails/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 450;
			$config['height'] = 450;
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();

			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image'] = $path.'/small/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			$this->image_lib->clear();		
			array_push($result,'success',$upload_data['file_name']);
			return $result;
		}	
	}
	function do_upload_with_mark($file_name,$path){
		
		$result = array();
		$field_name = $file_name;
		$config['upload_path'] = $path.'/full/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['max_size']	= '900000';
		$config['max_width']  = '50000';
		$config['max_height']  = '503000';		
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload($field_name)){
			array_push($result,'error',$this->upload->display_errors());
			return $result; 
		}
		else{
			$upload_data = $this->upload->data();
			$this->load->library('image_lib');
			$config['image_library'] = 'GD2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['wm_type'] = 'overlay';
			$config['wm_vrt_alignment'] = 'top';
			$config['wm_hor_alignment'] = 'left';
			$config['wm_overlay_path'] = './assets/uploads/watermark.png';//the overlay image
			$config['wm_opacity']=40;
			$this->image_lib->initialize($config);
			$this->image_lib->watermark();


			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image']	= $path.'/thumbnails/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 450;
			$config['height'] = 450;
			$config['wm_text'] = 'tutsmore';
			$config['wm_type'] = 'text';
			//$config['wm_font_path'] = './fonts/ostrich-black-webfont.ttf';
			//$config['wm_padding'] = '20';
			$this->image_lib->initialize($config);
			$this->image_lib->watermark();
			$this->image_lib->clear();

			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();

			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image'] = $path.'/small/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			$this->image_lib->clear();		
			array_push($result,'success',$upload_data['file_name']);
			return $result;
		}
	
	}
	function do_upload($file_name,$path){
		$result = array();
		$field_name = $file_name;
		$config['upload_path'] = $path.'/full/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|GIF|JPG|JPEG|PNG';
		$config['max_size']	= '900000';
		$config['max_width']  = '50000';
		$config['max_height']  = '503000';		
		$this->load->library('upload', $config);
		$this->upload->initialize($config); 

		if (!$this->upload->do_upload($field_name)){
			array_push($result,'error',$this->upload->display_errors());
			return $result; 
		}
		else{
			$upload_data = $this->upload->data();
			$this->load->library('image_lib');
/*			$config['image_library'] = 'GD2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['wm_text'] = 'tutsmore';
	 		$config['wm_type'] = 'text';
			$config['wm_opacity'] = 10;
			$config['new_image'] = $path.'/full/mark_'.$upload_data['file_name'];
			$this->image_lib->initialize($config);
			$this->image_lib->watermark();*/


			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image']	= $path.'/thumbnails/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 450;
			$config['height'] = 450;

			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();

			$config['image_library'] = 'gd2';
			$config['source_image'] = $path.'/full/'.$upload_data['file_name'];
			$config['new_image'] = $path.'/small/'.$upload_data['file_name'];
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 100;
			$config['height'] = 100;
			$this->image_lib->initialize($config); 
			$this->image_lib->resize();
			$this->image_lib->clear();		
			array_push($result,'success',$upload_data['file_name']);
			return $result;
		}
	}





	function userLogin($array){
		$query = $this->db->get_where('user',$array);
		//echo $this->db->last_query();die;
		return $query->row_array();
	}

	function add($table,$array){
		$query = $this->db->insert($table,$array);
		//echo $this->db->last_query();die;
		//return $query->row_array();
		return $this->db->insert_id();
	}
	
	function record_count($table) {
        return $this->db->count_all($table);
    }
	
	function get_data_by_pagination($table,$limit,$start,$field,$value){
		$this->db->order_by($field, $value); 
		$this->db->limit($limit, $start);
		$query = $this->db->get($table);
		/*if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
		return $data;
		}*/
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	function get_username($data){		
		$query = $this->db->get_where('user', $data);
		//echo $this->db->last_query();die;
		return $query->row_array();
	}

	function get_average_by_id($table,$data,$field_name){		
		$query =$this->db->select_avg($field_name)->get_where($table, $data);
		//echo $this->db->last_query();die;
		return $query->row_array();
	}

	function get_sum_by_id($table,$data,$field_name){		
		$query =$this->db->select_sum($field_name)->get_where($table, $data);
		//echo $this->db->last_query();die;
		return $query->row_array();
	}

	function get_top_ranking($table,$field1,$field2,$new_name,$order){
		$this->db->select($field1);
		$this->db->select_sum($field2, $new_name);
		$this->db->group_by($field1); 
		$this->db->order_by($new_name,$order); 
		$query = $this->db->get($table, 10);
	//	echo $this->db->last_query();die;
		return $query->result_array(); 
	}

	function query_result($query){
		$query = $this->db->query($query);
		//echo $this->db->last_query();die;
		return $query->result_array(); 
	}

    public function delete($table,$where){
		$this->db->delete($table, $where);
    }
		
	function delete_by_id($table,$where)
	{		
		$this->db->delete($table, $where);
	}
		
	function update_by_id($table_Name,$updatequery, $id){
		$this->db->where('id', $id);
		$this->db->update($table_Name, $updatequery);	
	}

	function update_by($table_Name,$updatequery,$condition){
		$this->db->where($condition);
		$this->db->update($table_Name, $updatequery);	
		//echo $this->db->last_query();die;
	}

	function update_data_by_id($table_Name,$updatequery, $field_name,$value){
		$this->db->where($field_name, $value);
		$this->db->update($table_Name, $updatequery);	
		//echo $this->db->last_query();die;
	}					
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>