<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Product_category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function category($offset = '', $per_page = '') {
        $this->db->from('product_category');
        if ($offset >= 0 && $per_page > 0) {
            $this->db->limit($per_page, $offset);
            $this->db->order_by('id', 'desc');
            $query = $this->db->get();
            if ($query->num_rows() > 0)
                return $query->result();
            else
               return FALSE;
        }
        else 
        {
        return $this->db->count_all_results();
        }
    }
		public function getColumnDataWhere($table,$column='',$where='',$orderby='',$ordertype='')
	{
		if($column !='')
		{
			$this->db->select($column);
		}
		else
		{
			$this->db->select('*');
		}	
		$this->db->from($table);
		if($where !='')
		{
			$this->db->where($where);
		}
		if($orderby !='')
		{
			$this->db->order_by($orderby,'ASC');
		}
		$query = $this->db->get();
		return $query->result();
	}
}