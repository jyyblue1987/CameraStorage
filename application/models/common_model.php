<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_model  extends CI_Model 
{
 
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	
	//  This method is used for the get category list - get all category
	function fetchAllSponser()
	{		
		$query = $this->db->get('tbl_sponser');
		return $query->result_array();
	
	} 
	
	
	function fetchAllAdvertis()
	{		
		$query = $this->db->get('tbl_advt');
		return $query->result_array();
	
	}
	
	
	
	function fetchAllLink()
	{		
		$query = $this->db->get('tbl_link');
		return $query->result_array();
	
	}
	
	
	function fetchAllCategory()
	{		
		$query = $this->db->get('tbl_category');
		return $query->result_array();
	
	}
	
	
	function get_news_by_type($news_type)
	{	
	
		$this->db->where("news_type",$news_type);
		$query = $this->db->get('tbl_news');
		return $query->result_array();
	
	}
	
	function get_latest_news()
	{	
		if($this->uri->segment(3)!='')
		{
			$category_id = 	$this->uri->segment(3);
			$query = $this->db->query("select * from tbl_news where category_id = '$category_id' ");
		}else{
			$query = $this->db->query("select * from tbl_news ORDER BY news_id DESC ");
		}
		
		return $query->result_array();
	
	}
	
	
	
	
	function get_top_view_news()
	{	
	
		
		$query = $this->db->query("select * from tbl_news ORDER BY news_id DESC ");
		return $query->result_array();
	
	}
	
	
	// this method is used for the get news detail by id
	function get_news_detail_by_id($news_id)
	{
		$query = $this->db->query("select * from tbl_news where  news_id = '$news_id' ");
		return $query->row_array();	
	}
	
	function get_news_rating_detail_by_id($news_id)
	{
			$query = $this->db->query("select * from tbl_rating where  news_id = '$news_id' ");
			return $query->row_array();	
	}
	
	
	function check_news_rating_exits_or_not_by_id($news_id,$date,$ip_address)
	{
			$query = $this->db->query("select * from tbl_rating where  news_id = '$news_id' and date = '$date' and ip_address = '$ip_address' ");
			return $query->row_array();	
	}
	
	
	
	
	//  this method is used for the update news view count detail
	function update_news_view_count($news_id,$siteData)
	{
		$this->db->where('news_id', $news_id);
		$this->db->update('tbl_news', $siteData); 
		
	}
	
	function add_rating($rating_post_data)
	{
		$this->db->insert('tbl_rating', $rating_post_data); 
	}

		
    function get_avg_rating_id($news_id)
	{
	@		$query = $this->db->query("select AVG(rating) as rating from tbl_rating where  news_id = '$news_id' ");
			return $query->row_array();	
	}		
		
		function update_rating($news_id,$siteData)
	{
		$this->db->where('news_id', $news_id);
		$this->db->update('tbl_news', $siteData); 
		
	}
	
	
	 function all_view_news()
	{	
	
		
		$query = $this->db->query("select * from tbl_news ORDER BY news_id DESC ");
		return $query->result_array();
	
	}
	
	function get_news_video_for_slider()
	{
		$query = $this->db->query("select * from tbl_news where news_video_slider LIKE 'YES' ORDER BY news_id DESC");
		
		//echo $this->db->last_query();
		
		return $query->result_array();	
	}
		
		
}

// END Sponser_model Class

/* End of file sponser_model.php */
/* Location: ./application/models/sponser_model.php */