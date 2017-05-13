<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Top_model extends CI_Model 
{
	public function youtube_db_insert($data_insert)
	{
		foreach ($data_insert as $value) 
		{
			$value["created_date"]=date('Y-m-d H:i:s',time());
			$value["updated_date"]=date('Y-m-d H:i:s',time());
			$query=$this->db->insert('top_videos',$value);
			if ($query) 
			{
				echo $query." <br>";
			}
			else
			{
				echo "Error <br>";
			}
		}
	}
	public function imgur_db_insert($data_insert)
	{
		foreach ($data_insert as $value) 
		{
			$value["created_date"]=date('Y-m-d H:i:s',time());
			$value["updated_date"]=date('Y-m-d H:i:s',time());
			$query=$this->db->insert('top_images',$value);
			if ($query) 
			{
				echo $query." <br>";
			}
			else
			{
				echo "Error <br>";
			}
		}
	}
	public function reddit_db_insert($data_insert)
	{
		foreach ($data_insert as $value) 
		{
			$value["created_date"]=date('Y-m-d H:i:s',time());
			$value["updated_date"]=date('Y-m-d H:i:s',time());
			$query=$this->db->insert('top_links',$value);
			if ($query) 
			{
				echo $query." <br>";
			}
			else
			{
				echo "Error <br>";
			}
		}
	}
	public function get_data_like($offset='', $per_page='',$table_name='')
	{
		$this->db->from($table_name);
		if ($this->uri->segment(2)) 
		{
			$this->db->like('created_date',$this->uri->segment(2));
		}
		else
		{
			$this->db->like('created_date',date('Y-m-d',time()));
		}
		$this->db->where('status',1);
		if($offset>=0 && $per_page>0)
		{
			$this->db->limit($per_page,$offset);
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}
		else
		{
			return $this->db->count_all_results();
		}
	}
	public function get_data_like_single($table_name='',$where=array(),$like='')
	{
		$this->db->from($table_name);
		$this->db->limit(1);
		if(!empty($where)):		
			foreach ($where as $key => $value)
			{
				$this->db->where($key, $value);
			}
		endif;	
		$this->db->like('created_date',date('Y-m-d',$like));
		$this->db->where('status',1);
		$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
	public function get_first_image($array='')
	{
		if (!empty($array)) 
		{
			$data=explode(',',$array);
			return $data[0];
		}
	}
	public function get_image_array($array='')
	{
		if (!empty($array)) 
		{
			$data=explode(',',$array);
			return $data;
		}
	}
	public function get_last_rank($table='',$where=array(),$date='')
	{
		$this->db->from($table);
		$this->db->select('rank');
		$this->db->limit(1);
		if(!empty($where)):		
			foreach ($where as $key => $value)
			{
				$this->db->where($key, $value);
			}
		endif;
		$this->db->where('created_date <',$date);
		$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
	public function next_link($table='',$id='')
	{
		$this->db->from($table);
		$this->db->limit(1);
		$this->db->where('status',1);
		$this->db->where('id > ',$id);
		$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
	public function pre_link($table='',$id='')
	{
		$this->db->from($table);
		$this->db->limit(1);
		$this->db->where('status',1);
		$this->db->where('id <',$id);
		$this->db->order_by('id','desc');
			$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
}