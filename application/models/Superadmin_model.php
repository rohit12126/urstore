<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Superadmin_model extends CI_Model {
	public function insert($table_name='',  $data=''){
		$query=$this->db->insert($table_name, $data);
		if($query)
			return  $this->db->insert_id();
		else
			return FALSE;
	}
	public function logout()
	{
		$url=(''.API_URL.'?action=logout');
		$data=@file_get_contents($url);
	}
	public function get_result($table_name='', $id_array='',$columns=array(),$order_by=array(),$limit='',$like=array()){
		if(!empty($columns)):
			$all_columns = implode(",", $columns);
			$this->db->select($all_columns);
		endif;
		if(!empty($order_by)):
			$this->db->order_by($order_by[0], $order_by[1]);
		endif;
		if(!empty($id_array)):
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;
		if(!empty($like)):
			foreach ($like as $key => $value){
				$this->db->like($key, $value);
			}
		endif;
		if(!empty($limit)):
			$this->db->limit($limit);
		endif;
		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}
	public function login($data='')
	{	
		$query = $this->db->get_where('users',$data);

		if($query->num_rows()==1)
		{
			$user_data = array( 
								'id' 			=> $query->row()->id,
								'status' 		=> $query->row()->status,
								'username' 		=> $query->row()->username,
								'logged_in' 	=> TRUE);
			$this->session->set_userdata('admin_info',$user_data);
			$this->session->set_flashdata('msg_info', 'Welcome '. $query->row()->username.', Backend of NCE');
			return TRUE;
		}
		else
		{
			
			return FALSE;
		}

	}
	public function get_row($table_name='', $id_array='',$columns=array(),$order_by=array()){
		if(!empty($columns)):
			$all_columns = implode(",", $columns);
			$this->db->select($all_columns);
		endif;
		if(!empty($id_array)):
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;
		if(!empty($order_by)):			
			$this->db->order_by($order_by[0], $order_by[1]);
		endif; 
		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}
	
	public function update($table_name='', $data='', $id_array=''){
		if(!empty($id_array)):
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;
		return $this->db->update($table_name, $data);
	}

	public function delete($table_name='', $id_array=''){
		return $this->db->delete($table_name, $id_array);
	}
	
	public function get_result_with_pagination($offset='', $per_page='',$tablename, $id_array=array(),$order_by=array(),$columns=array(),$like=array())
	{
		$this->db->from($tablename);
		if($offset>=0 && $per_page>0){
			$this->db->limit($per_page,$offset);
			if(!empty($id_array)):
				foreach ($id_array as $key => $value){
					$this->db->where($key, $value);
				}
			endif;
			if(!empty($order_by)):
				$this->db->order_by($order_by[0], $order_by[1]);
			endif;
			if(!empty($columns)):
				$all_columns = implode(",", $columns);
				$this->db->select($all_columns);
			endif;
			if(!empty($like)):
				foreach ($like as $key => $value){
					$this->db->like($key, $value);
				}
			endif;
			//$this->db->like('created_date',date("Y-m-d",time()));
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}
		else
		{
			if(!empty($id_array)):
				foreach ($id_array as $key => $value){
					$this->db->where($key, $value);
				}
			endif;
			if(!empty($columns)):
				$all_columns = implode(",", $columns);
				$this->db->select($all_columns);
			endif;
			if(!empty($like)):
				foreach ($like as $key => $value){
					$this->db->like($key, $value);
				}
			endif;
			//$this->db->like('created_date',date("Y-m-d",time()));
			return $this->db->count_all_results();
		}
	}
	function checkcategory($data,$category_id)
	{
		$this->db->select('*');
		$this->db->from('category');
		if(!empty($_POST['category_id']))
		{
			$this->db->where('category_id',$_POST['category_id']);
		}else{
			$this->db->where('category_id',$category_id);
		}
		
		$this->db->where('category_name',$_POST['category_name']);
		if(!empty($_POST['id']))
		{
			$this->db->where('id !=',$_POST['id']);
		}
		$result=$this->db->get()->result_array();
		$this->db->last_query();
		
		if(empty($result))
			return true;
		else
			return false;
	}
	function getAllCategoyForSerachCategory($name)
	{
		$this->db->select('id');
		$this->db->from('product_category');
		$this->db->like('category_name',$name);
		$query = $this->db->get();
		$result=$query->result_array();
		$category=array();
		$i=0;
		foreach($result as $cat)
		{
			$category[]=$cat['id'];
		} 
		return $category;
	}
	function user_logged_in(){
		$user_info = $this->session->userdata('user_info');
		if($user_info['logged_in']===TRUE)
			return TRUE;
		else
			return FALSE;
		}


	public function blog_model($offset='', $per_page='',$id='',$keyword='',$order=''){
		if($keyword!=='')
		{
			 // OR blog_category LIKE '$keyword'
			$category=$this->getAllCategoyForSerachCategory($keyword);
			 $where = "(blog_full_description LIKE '%$keyword%' OR blog_title LIKE '%$keyword%'  ";
			 if(!empty($category))
			 {
			 	$where .=' OR ';
			 	for($i=0;$i<sizeof($category);$i++)	
			 	{
			 		$where.="  blog_category LIKE '%$category[$i]%'  ";
			 		if($i+1<sizeof($category))
			 		{
			 			$where.=" OR " ;
			 		}
			 	}
			 				 		
			 }
			 $where.=" ) ";
   				$this->db->where($where);
		}	

		$this->db->from('blogs');
		if ($this->input->get('title')) 
		{
			$this->db->like('blog_title',$this->input->get('title'));
		}
		if ($id!=='') 
		{
			$this->db->where('blog_category',$id);
		}
		if ($this->input->get('search')) 
		{
			$this->db->like('blog_category',$this->input->get('search'));
		}
		if ($this->input->get('subcategory')) 
		{
			$this->db->like('blog_category',$this->input->get('subcategory'));
		}
		if ($this->input->get('status')=='1' || $this->input->get('status')=='0') 
		{
			$this->db->where('status',$this->input->get('status'));
		}
		
		if ($this->input->get('order')) 
		{
			$this->db->order_by('id',$this->input->get('order'));
		}else if($order!=''){
			$this->db->order_by($order,'asc');
			$this->db->order_by('blog_title','asc');
		}else
		{
			$this->db->order_by('id','desc');
		}

		if($offset>=0 && $per_page>0)
		{
			$this->db->limit($per_page,$offset);
			$query = $this->db->get();
			//echo $order.'==1';
			//	echo $this->db->last_query();die;
			if($query->num_rows()>0)
				return $query->result();
			else
				return array();
		}
		else
		{
			return  $this->db->count_all_results();
			//echo $this->db->last_query();die;
		}
	}	
	public function comments_model($offset='', $per_page=''){
		$this->db->select('comments.*,blogs.blog_title,users.user_login,users.user_email');
		$this->db->from('comments');
		$this->db->join('l7d1zw_users as users','users.ID=comments.user_id');
		$this->db->join('blogs','blogs.id=comments.blog_id');
		if ($this->input->get('search')) 
		{
			$this->db->where('comments.blog_id',$this->input->get('search'));
		}
		if($offset>=0 && $per_page>0)
		{
			$this->db->limit($per_page,$offset);
			$this->db->order_by('comments.id','desc');
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
	  public function delete_image($id='')
    {
    	$this->db->where('id',$id);
        $this->db->select('blog_image,blog_thumb_image');
		$this->db->from('blogs');
		$query = $this->db->get();
		if (!empty($query)) 
		{
			foreach ($query->result() as $result) {
				@unlink($result->blog_image);
                @unlink($result->blog_thumb_image);
			}
		}
    }
    public function blog_name($id='')
    {
        $this->db->where('id',$id);
        $this->db->select('id,blog_title');
		$this->db->from('blogs');
		$query = $this->db->get();
		return $query->row(); 
    }
    public function getAlldata($table)
    {
		$this->db->from($table);
		$query = $this->db->get();
		return $query->result_array(); 
    }
}