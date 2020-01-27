<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_model extends CI_Model {

    public $_order_by = '';
    public $_table_name = '';
	

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function query_result($query){
		$query = $this->db->query($query);
		//echo $this->db->last_query();die;
		return $query->result_array(); 
	}


    public function get_by($table,$where, $like = false, $single = FALSE){
        
		if($like){
			$this->db->like($like);
        }
        $this->db->where($where);

        return $this->get($table,NULL, $single);
    }

    public function get($table,$id = NULL, $single = FALSE){
		$this->_table_name = $table;
        if ($id != NULL) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        }
        elseif($single == TRUE) {
            $method = 'row';
        }
        else {
            $method = 'result';
        }
    
/*        if (!count($this->db->ar_orderby)) {
            $this->db->order_by($this->_order_by);
        }*/
		//$this->db->get($this->_table_name)->$method();
        //echo $this->db->last_query();die;
        return $this->db->get($this->_table_name)->$method();
    }


	function get_like_data($table=false,$field1){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->or_like($field1);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	function get_data($table=false,$field2,$field1){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->or_where($field2);
		$this->db->where_in('type',$field1);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		return $query->result_array();
	}

	function get_data1($table=false,$field2,$field1,$value){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->or_where_in($field1,$value);
		$this->db->or_where($field2);
		$query = $this->db->get();
	//	echo $this->db->last_query();die;
		return $query->result_array();
	}

	function get_all_top_ranking($table,$field1,$field2,$new_name2,$field3,$new_name3,$order){
		$this->db->select($field1);
		$this->db->select_sum($field2, $new_name2);
		$this->db->group_by($field1); 
		$this->db->order_by($new_name2,$order); 
//		$this->db->where('`tdate` BETWEEN `$start_date` and `$end_date`', NULL, FALSE); 
		$query = $this->db->get($table);
		//echo $this->db->last_query();die;
		return $query->result_array(); 
	}

	function add($table,$array){
		$query = $this->db->insert($table,$array);
		//echo $this->db->last_query();die;
		//return $query->row_array();
		return $this->db->insert_id();
	}
	
	function record_count() {
        return $this->db->count_all("user");
    }
	
	function get_username($data){		
		$query = $this->db->get_where('user', $data);
		//echo $this->db->last_query();die;
		return $query->row_array();

	}

	
	function user($limit, $start){
		$this->db->limit($limit, $start);
		$query = $this->db->get('user');
		/*if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
    	        $data[] = $row;
	        }
        return $data;
        }*/
     	return $query->result_array();
	}
	
	function delete_user_data($id){	
		$this->db->where('user_id', $id);
		$this->db->delete('user');
		//echo $this->db->last_query();die;
	}
	
	function search_data($table,$array){
		$this->db->like($array);
		$query = $this->db->get_where($table);
		echo $this->db->last_query();die;
		return $query->result_array();
	}
	
	function check_user($id,$confirm){
		$check_confirm = $this->user_valid($id);
		if($check_confirm==0){
			$this->db->where('md5(id)',$id);
			$this->db->where('confirm',$confirm);
			$query = $this->db->get('user');
			if($query->num_rows()==1){
				$this->db->where('md5(id)',$id);
				$this->db->update('user', array('confirm'=>'confirm')); 
				return 'Thank You!<br>You Email has verified. Please Login.';
			}
			else{
				return 'Sorry You have something mistake';
					
			}
		}
		else{
			return 'You have already verified.';
		}
	}
	
	function user_valid($id){
		$check = $this->db->get_where('user',array('md5(id)'=>$id,'confirm'=>'confirm'));
		return $check->num_rows();
	}

	function get_data_by_id($tablename,$condition){
		$query=$this->db->get_where($tablename,$condition);
		//echo $this->db->last_query();die;
		return $query->row_array(); 
	}

	function get_all_data_by_id($table_name,$condition)
	{
		$query=$this->db->get_where($table_name,$condition);
		//echo $this->db->last_query();die;
		return $query->result_array(); 
	}
	
	function get_all_data_by_or_condition($table_Name,$where){		
		$query = $this->db->or_where($where);
		$query = $this->db->get($table_Name);
		//echo $this->db->last_query();die;
		return $query->result_array();
	}
	
	// this method is used for the add user
	/*function add_user($post_data)
	{		
		
		$this->db->insert('users', $post_data);
		return $this->db->insert_id(); 
	}
	
	
	function add_user_friends($post_data)
	{
		$this->db->insert('user_friends', $post_data);
		return $this->db->insert_id(); 
	}
	
	function add_unique_view_table($post_data)
	{
		$this->db->insert('unique_view_table', $post_data);
		return $this->db->insert_id(); 
	}		
	
	
	// this method is used for the check user name already exits or not
	function verify_username_already_exit($user_name)
	{
		$query = $this->db->get_where('users', array('user_name'=> $user_name));
		return $query->row_array();	
	}
	
		// this method is used for the check user name already exits or not
	function verify_userid_already_exit($user_id)
	{
		$query = $this->db->get_where('users', array('user_id'=> $user_id));
		return $query->row_array();	
	}
	
	//  this method is used for the update category detail
	function update_user_detail($siteData,$user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('users', $siteData); 
		
	}
	
	
	
	// this method is used for the add story
	function add_story($post_data)
	{	
		//$query = $this->db->query("select count(*) from storys");
		
		$this->db->from('storys');
		$query = $this->db->get();
		$rowcount = $query->num_rows();
		//die;
		
		//$idvalue = $rowcount+1;	
		//$post_data['story_id'] = $idvalue;
		$this->db->insert('storys', $post_data);
		return $this->db->insert_id(); 
	}
	
	//  This method is used for the get category list
	function story_List($offset,$user_id)
	{		
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('storys',RESULTS_PER_PAGE,$offset);
		//echo $this->db->last_query();
		return $query->result_array();
	
	}
	
	//  This method is used for the count user 
	function story_count($user_id)
	{
		$this->db->select('story_id');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('storys');
		return $query->num_rows();
	}
	
	// this method is used for the get story detail by id
	function get_story_detail_by_id($where_condition)
	{
		if(!empty($where_condition))
		{
			foreach($where_condition as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		$query = $this->db->get('storys');
		return $query->row_array();	
	}
	
	
	function get_unique_view_table_detail_by_id($where_condition)
	{
		if(!empty($where_condition))
		{
			foreach($where_condition as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		$query = $this->db->get('unique_view_table');
		return $query->row_array();	
	}
	
	
	
	//  this method is used for the update story detail
	function update_story_detail($siteData,$where_condition)
	{
		
		if(!empty($where_condition))
		{
			foreach($where_condition as $key=>$value)
			{
				$this->db->where($key,$value);
			}
		}
		
		$this->db->update('storys', $siteData); 
		
	}
	
	
	
	
	
	
	
	function top_ten_story()
	{		
		$query = $this->db->query("select * from storys Order By Like_count DESC  limit 10  ");
		
		//echo $this->db->last_query();
		return $query->result_array();
	
	}
	
	
	
	function feature_story_three()
	{		
		
		$query = $this->db->query("select * from storys  ");
		
		//echo $this->db->last_query();
		return $query->result_array();
	
	}
	
	
	function recent_story_List($user_id)
	{		
		
		//$query = $this->db->get('storys',RESULTS_PER_PAGE,$offset);
		$per_page = RESULTS_PER_PAGE;
		$story_create_date_time = date('Y-m-d');		
		
		
		if($this->input->post('search_value')!='')
		{
			 $search_value = $_POST['search_value'];
			
			$query = $this->db->query("select * from storys where story_title like '%$search_value%'	 ORDER BY story_create_date_time  ");
			
			return $query->result_array();
			
		}else{
		
		
		if($this->uri->segment(3)=='t')
		{
			$query = $this->db->query("select * from storys Order By Like_count DESC  limit 10  ");
		
			//echo $this->db->last_query();
			return $query->result_array();	
		}
		
		if($this->uri->segment(3)=='fe')
		{
		
		$query = $this->db->query("select * from storys Order By Like_count DESC  limit 10  ");
		
		//echo $this->db->last_query();
		return $query->result_array();
		
		}
		
		
		if($this->uri->segment(3)=='f')
		{
			$query = $this->db->query("select * from storys as ST , user_friends as UF where
		ST.user_id = UF.friend_id 
		and ST.user_id!= '$user_id'
		");
		//echo $this->db->last_query();
		return $query->result_array();
		}
		
		
		$query = $this->db->query("select * from storys ORDER BY story_create_date_time DESC  ");
		return $query->result_array();
		
		}
		
		//echo $this->db->last_query();
		
	
	}
	
	
	function date_wise_story_list()
	{
		$query = $this->db->query("select * from storys ORDER BY story_create_date_time asc  ");
		return $query->result_array();
	}
	
	
	//  This method is used for the count recent user 
	function recent_story_count()
	{
		
		if($this->input->post('search_value')!='')
		{
			 $search_value = $_POST['search_value'];
			
			$query = $this->db->query("select * from storys where story_title = '$search_value'	 ORDER BY story_create_date_time  ");
			
			
		}else{
		
		$query = $this->db->query("select * from storys");
		
		}
		//echo $this->db->last_query();
		return $query->num_rows();
	}
	

	function friends_stories($user_id)
	{
		
		
		
		
		$query = $this->db->query("select * from storys as ST , user_friends as UF where
		ST.user_id = UF.friend_id 
		and ST.user_id!= '$user_id'
		");
		//echo $this->db->last_query();
		return $query->result_array();
	}
	
	
	function get_two_story()
	{
	
		$query = $this->db->query("select * from storys limit 2");
		return $query->result_array();
		
	}
	
	
	function vote_count_unique_view_by_id($story_id)
	{
		$this->db->where('story_id',$story_id);
		$query = $this->db->get("unique_view_table");
		return count($query->result_array());
		
	}
	
	function check_user_vote_are_not($story_id,$user_id)
	{
		$this->db->where('story_id',$story_id);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get("vote_user_detail");
		return $query->row_array();
	
	}
	
	
	function add_vote_deatil($post_data)
	{
		$this->db->insert('vote_user_detail', $post_data);
		return $this->db->insert_id(); 
	}
	
	*/
	
	
	
					
}



/* End of file super_admin_model.php */
/* Location: ./system/application/models/super_admin_model.php */
?>