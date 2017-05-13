<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model 
{	
	public function insert($table_name='',  $data='')
	{
		$query=$this->db->insert($table_name, $data);
		if($query)
			return $this->db->insert_id();
		else
			return FALSE;		
	}
	public function get_result($table_name='', $id_array= array(),$columns=array(),$order_by=array(),$limit='')
	{
		if(!empty($columns)):
			$all_columns = implode(",", $columns);
			$this->db->select($all_columns);
		endif;
		if(!empty($order_by)):			
			foreach ($order_by as $key => $value){
				$this->db->order_by($key, $value);
			}
		endif; 
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
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
	public function get_row($table_name='', $id_array='',$columns=array(),$order_by=array())
	{
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
	public function get_row_like($table_name='', $id_array='',$columns=array(),$order_by=array()){
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where_in($key, $value);
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
	public function get_search_result()
	{
		$this->db->select('*');
	    $this->db->from('stores');
	    $this->db->like('store_title', $_GET['query']);
	    $this->db->where('store_status', 1);
	    $this->db->where('store_type', 2);
	    $this->db->order_by('store_category_id');
		$query = $this->db->get();	
	    if ($query->num_rows() > 0)
	    {
	      return $query->result();
	    } 
	    else
	    {
	       return FALSE;
	    }
	}
  	public function upload_image_gd($link){
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, 
			array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $link,
			CURLOPT_USERAGENT => 'Create and save image'
			)
		);
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		 //$ACurlError = curl_error($curl);
		curl_close($curl);
	}
	public function get_result_with_pagination($offset='', $per_page='',$tablename){
		$this->db->from($tablename);
		if($offset>=0 && $per_page>0){
			$this->db->limit($per_page,$offset);
			$this->db->order_by('id','desc');
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			return $this->db->count_all_results();
		}
	}
	public function check_exist_or_not($tablename='',$id=0){
		 $this->db->where('id',$id);
		 $this->db->from($tablename);
		 $query = $this->db->get();		 
		 if($query->row()){		 	
		 	return true;
		 }else{		 	
		 	return false;
		 }
	} 
	public function getAlldata($tablename='',$id='',$col='',$status=array(),$order=array())
	{
		if($id!==''){
			$this->db->where($col,$id);
		}
		if(!empty($status))
		{
			$this->db->where($status[0],$status[1]);
		}
		if(!empty($order))
		{
			$this->db->order_by($order[0],$order[1]);
		}
		$this->db->from($tablename);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function category_name($id='')
    {
        $this->db->where('id',$id);
        $this->db->select('id,category_name');
		$this->db->from('product_category');
		$query = $this->db->get();
		return $query->row(); 
    }
    public function count_likes($id='')
	{
		$this->db->where('blog_id', $id);
		$query=$this->db->get('likes');	
		return $query->num_rows();
	}
	public function count_comments($id='')
	{
		$this->db->where(array('blog_id'=> $id,'status' => 1, ));
		$query=$this->db->get('comments');	
		return $query->num_rows();
	}
   	public function blog_model($offset='', $per_page=''){
		$this->db->from('blogs');
		$this->db->where('status',1);
		if ($tag=$this->input->get('tag'))
			{
				$this->db->like('blog_tags',$tag);
			}
		if ($search=$this->input->get('search'))
			{
				$this->db->like('blog_title',$search);
			}
		if($offset>=0 && $per_page>0)
		{
			$this->db->limit($per_page,$offset);
			$this->db->order_by('order_by','ASC');
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
	public function getAllblog($id='',$category='')
	{
		$this->db->select('*');
		$this->db->from('blogs');
		if($id!=='')
		{
			$this->db->where('id',$id);	
		}
		if ($category!=='') 
		{
			$this->db->like('blog_category',$category);
		}
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public function getAllcomments($id='')
	{
		$this->db->select('comments.*,user.user_nicename as name');
		$this->db->from('comments');
		$this->db->join('l7d1zw_users as user','user.ID=comments.user_id');
		$this->db->where('comments.blog_id',$id);	
		$this->db->where('status',1);
		return $this->db->get()->result_array();
	}
	public function buildCategory($parent='', $category='') 
    {
        $html = "";
        if (isset($category['parent_cats'][$parent])) {
            $html .= "<ul  id='sortable_category'>";
            foreach ($category['parent_cats'][$parent] as $cat_id) {
                if (!isset($category['parent_cats'][$cat_id])) {
                    $html .= "<li>  <a href='javascript:void(0)' class='categories' id='".$category['categories'][$cat_id]->id."'>". $category['categories'][$cat_id]->category_name . "</a></li> ";
                }
                if (isset($category['parent_cats'][$cat_id])) {
                    $html .= "<li>  <a href='javascript:void(0)' class='categories' id='".$category['categories'][$cat_id]->id."'>". $category['categories'][$cat_id]->category_name . "</a> ";
                    $html .= buildCategory($cat_id, $category);
                    $html .= "</li> ";
                }
            }
            $html .= "</ul> ";
        }
        return $html;
    }
    function buildCategory_add($parent='', $category='',$edit_category='') 
    {	
        //$colors = array('red', 'green', 'blue', 'yellow', 'pink');
        //style='color:".$colors[$sort_order]."'
		//echo '<pre>';print_r($category);die;
        $html = "";
        if (isset($category['parent_cats'][$parent])) 
        {
            foreach ($category['parent_cats'][$parent] as $cat_id) 
            {
                $selected='';
                if ($this->input->post('category_id')) 
                {
                    if (in_array($category['categories'][$cat_id]['id'], $this->input->post('category_id'))) 
                    {
                        $selected='checked';
                    }
                }
                elseif (!empty($edit_category)) 
                {
                    if (in_array($category['categories'][$cat_id]->id,$edit_category)) 
                    {
                        $selected='checked';
                    }
                }
                $sort_order=$category['categories'][$cat_id]['sort_order'];
                if (!isset($category['parent_cats'][$cat_id])) 
                {
                    $html .= "".$this->numbertodash($sort_order)."<input name='category[]' type='checkbox'  value='".$category['categories'][$cat_id]['id']."'".$selected." />";
                    $html .= "<span>&nbsp;&nbsp;". $category['categories'][$cat_id]['category_name'] ."</span><br>";
                }
                if (isset($category['parent_cats'][$cat_id])) 
                {
                    $html .= "".$this->numbertodash($sort_order)."<input  name='category[]' type='checkbox'  value='".$category['categories'][$cat_id]['id']."'".$selected." />";
                    $html .= "<span>&nbsp;&nbsp;". $category['categories'][$cat_id]['category_name']."</span><br>";
                    $html .= buildCategory_add($cat_id, $category,$edit_category);
                }
            }
        }
        return $html;
    }
	    public function numbertodash($number='')
    {
        $hash='';
        for ($i=0; $i < $number; $i++) 
        { 
            $hash=$hash."&ensp;&ensp;&ensp;&ensp;";
        }
        return $hash;
    }
	function admin_logged_in(){
		
		$admin_info = $this->session->userdata('admin_info');
		if($admin_info['logged_in']===TRUE && $admin_info['username']==='admin')
			return TRUE;
		else
			return FALSE;
		}
	function getcategory($categorys,$html='')
	{
		$this->db->select('*');
		$this->db->from('product_category');
		$this->db->where_in('parent_id',$categorys);	
		$this->db->where('status',1);
		$this->db->order_by('category_name','asc');

		$category=$this->db->get()->result();
	//echo $this->db->last_query();die;
		if(!empty($category))
		{
			$cate=array();
				foreach($category as $row)
				{
					$cate[]=$row->id;
					$count=$this->db->where('blog_category',$row->id)->from('blogs')->count_all_results();
					if($count>0)
					{
						if($html=='')
						{
							echo '<style>.abc_hidden{
								display:none;
							}</style>';
						}
					echo '<div class="col-xs-12 col-sm-6 col-md-6">
          				  <div class="post_wrapper">
              				 <a  href="'.base_url('home/dashboard/0').'/'.$row->id.'"><h1 class="post_title">'.limit_text(strip_tags($row->category_name),60).'</h1></a> 
             					    <p class="post_text">'.limit_text(strip_tags($row->description), 200).'<a class="blog_read_more" href="'.base_url('home/dashboard/0').'/'.$row->id.'">View Posts in this Category <?php  ?></a></p>
       
			            </div> 
			        </div>';
			    	}
				}
			//getcategory($cate,$html);	

		}
	}
	function limit_text($text,$limit=200){
	   if(strlen($text)<=$limit){
	      return  $text;
	   }else{
	      $text = substr($text,0,$limit) . '...';
	       return  $text;
	   }
	 }	
}