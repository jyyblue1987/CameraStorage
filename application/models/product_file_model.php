<?php

class Product_file_model extends MY_Model {
    
    protected $_table_name = 'Product_files';
    protected $_order_by = 'order, id';
    
    protected $_revision_id = 1;

    public function set_revision($revision_id)
    {
        if($revision_id != NULL)
            $this->_revision_id = $revision_id;
    }
    
    public function get_max_order()
    {
        // get max order
        return parent::max_order();
    }

    public function get_by_lang($lang_id){
        $this->db->where('slide_lang',$lang_id)->order_by('order','asc');
        $query = $this->db->get($this->_table_name);
        if (is_object($query))
        {
            return $query->result();
        }
    }
}



