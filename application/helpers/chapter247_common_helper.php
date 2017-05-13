<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*	clear cache
*/
if ( ! function_exists('clear_cache')) {
	function clear_cache(){
		$CI =& get_instance();
		$CI->output->set_header('Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
		$CI->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');
		$CI->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");
		$CI->output->set_header("Pragma: no-cache");			
	}
}
// Sub category name get
if ( ! function_exists('sub_category'))
{
    function sub_category($id='')
    {
        $CI =& get_instance();
      return $CI->common_model->getAlldata('product_category',$id,'parent_id',array('status',1),array('category_name','asc'));
    }  

}
//category name
if ( ! function_exists('category_name'))
{
    function category_name($id='')
    {
        $CI =& get_instance();
      return $CI->superadmin_model->blog_name($id);
    }  

}

if ( ! function_exists('getcategory'))
{
    function getcategory($category)
    {
        $CI =& get_instance();
      return $CI->common_model->getcategory($category);
    }  

}
/**
*	category_name by id
*/
if ( ! function_exists('blog_name'))
{
    function blog_name($id='')
    {
        $CI =& get_instance();
      return $CI->superadmin_model->blog_name($id);
    }  

}
/**
*	tag_name by id
*/
if ( ! function_exists('tag_name'))
{
    function tag_name($id='')
    {
        $CI =& get_instance();
      return $CI->common_model->tag_name($id);
    }  

}
/**
*	count Likes
*/
if ( ! function_exists('count_likes'))
{
    function count_likes($id='')
    {
        $CI =& get_instance();
      return $CI->common_model->count_likes($id);
    }  

}
/**
*	count by Commments
*/
if ( ! function_exists('count_comments'))
{
    function count_comments($id='')
    {
        $CI =& get_instance();
      return $CI->common_model->count_comments($id);
    }  

}
/**
*	check admin logged in
*/
if ( ! function_exists('admin_logged_in')) {
	function admin_logged_in(){
		$CI =& get_instance();
		$admin_info = $CI->session->userdata('admin_info');
		if($admin_info['logged_in']===TRUE)
			return TRUE;
		else
			return FALSE;

		/*$url=(''.API_URL.'?action=checksession');
		$dat=@file_get_contents($url);
		$data=json_decode($dat);
		if($data->status=='success')
		{
			$admin_info = $CI->session->userdata('admin_info');
			if($admin_info['logged_in']===TRUE)
			{
				return TRUE;
			}else{
				$user_data = array( 'id' 		=> $data->data->ID,
								'status' 		=> $data->data->user_status,
								'username' 		=> $data->data->user_login,
								'logged_in' 	=> TRUE);
				$this->session->set_userdata('admin_info',$user_data);
			}	

		}else
			return FALSE;*/
	}
}
// get subcategory 
if ( ! function_exists('subcategory_name')) {
    function subcategory_name($id){
        $CI =& get_instance();
        // $CI->load->model('common_model');
       if($store_admin = $CI->common_model->get_row('category',array('id'=>$id), array(), array('category_name','id'))){
             return $store_admin->category_name;     
            }    
    }               
}

/**
*	get admin id
*/
if ( ! function_exists('admin_id')) {
	function admin_id(){
		$CI =& get_instance();
		$admin_info = $CI->session->userdata('admin_info');		
			return $admin_info['id'];		
	}
}
/**
*	superadmin login information
*/
if ( ! function_exists('admin_name')) { 
	function admin_name(){
		$CI =& get_instance();
		$admin_info = $CI->session->userdata('admin_info');
		if($admin_info['logged_in']===TRUE )
		 	return $admin_info['username'];
		else
			return FALSE;
	}					
}

if ( ! function_exists('get_user_info')) {
    function get_user_info(){
        $CI =& get_instance();
        $store_admin_info = $CI->common_model->get_row('users',array('id'=>store_admin_id()));        
            return $store_admin_info;        
    }
}


if ( ! function_exists('store_admin_name')) {
    function store_admin_name(){
        $CI =& get_instance();
        $store_admin_info = $CI->session->userdata('store_admin_info');
        if($store_admin_info['logged_in']===TRUE ){
        	if($store_admin = $CI->common_model->get_row('users',array('id'=>store_admin_id()), array(), array('first_name','last_name'))){
             return $store_admin->first_name.' '.$store_admin->last_name;
        	}else{
        		return FALSE;
        	}
         }
        else
            return FALSE;
    }                    
}

if ( ! function_exists('store_admin_profile_info')) {
    function store_admin_profile_info(){
        $CI =& get_instance();
        $store_admin_profile_info = $CI->session->userdata('store_admin_profile_info');
             return $store_admin_profile_info['set_status'];
    }                    
}
if ( ! function_exists('backend_pagination')) {
	function backend_pagination(){
		$data = array();		
		$data['full_tag_open'] = '<ul class="pagination custom-pagination">';		
		$data['full_tag_close'] = '</ul>';
		$data['first_tag_open'] = '<li>';
		$data['first_tag_close'] = '</li>';
		$data['num_tag_open'] = '<li>';
		$data['num_tag_close'] = '</li>';
		$data['last_tag_open'] = '<li>';
		$data['last_tag_close'] = '</li>';
		$data['next_tag_open'] = '<li>';
		$data['next_tag_close'] = '</li>';
		$data['prev_tag_open'] = '<li>';
		$data['prev_tag_close'] = '</li>';
		$data['cur_tag_open'] = '<li class="active"><a href="#">';
		$data['cur_tag_close'] = '</a></li>';
		return $data;
	}					
}
/**
*	frontend pagination
*/
if ( ! function_exists('frontend_pagination')) {
	function frontend_pagination(){
		$data = array();
		$data['full_tag_open'] = '<ul class="pagination">';		
		$data['full_tag_close'] = '</ul>';
		$data['first_tag_open'] = '<li>';
		$data['first_tag_close'] = '</li>';
		$data['num_tag_open'] = '<li>';
		$data['num_tag_close'] = '</li>';
		$data['last_tag_open'] = '<li>';		
		$data['last_tag_close'] = '</li>';
		$data['next_tag_open'] = '<li>';
		$data['next_tag_close'] = '</li>';
		$data['prev_tag_open'] = '<li>';
		$data['prev_tag_close'] = '</li>';
		$data['cur_tag_open'] = '<li class="active"><a href="#">';
		$data['cur_tag_close'] = '</a></li>';
		$data['next_link'] = 'Next';
		$data['prev_link'] = 'Previous';
		return $data;
	}					
}

if (!function_exists('buildCategory')) {

	function buildCategory($parent='', $category='')
	{
		 $CI = & get_instance();
		 return $CI->common_model->buildCategory($parent, $category);
	}
}

if (!function_exists('buildCategory_add')) {  

	function buildCategory_add($parent='', $category='',$edit_category='')
	{
		 $CI = & get_instance();
		 return $CI->common_model->buildCategory_add($parent, $category,$edit_category);
	}
}
/**
*	thisis  back end helper 
*/
/* if ( ! function_exists('msg_alert')) {
	function msg_alert(){
	$CI =& get_instance(); ?>
<?php if($CI->session->flashdata('msg_success')): ?>	
	<div class="alert alert-success">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <strong>Success :</strong> <br>  <?php echo $CI->session->flashdata('msg_success'); ?>
	</div>
 <?php endif; ?>
<?php if($CI->session->flashdata('msg_info')): ?>	
	<div class="alert alert-info">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <strong>Info :</strong> <br> <?php echo $CI->session->flashdata('msg_info'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_warning')): ?>	
	<div class="alert alert-warning">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	     <strong>Warning :</strong> <br> <?php echo $CI->session->flashdata('msg_warning'); ?> 
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_error')): ?>	
	<div class="alert alert-danger">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	     <strong>Error :</strong> <br>  <?php echo $CI->session->flashdata('msg_error'); ?>
	</div>
<?php endif; ?>
	<?php }					
} */
/**
*	thisis  back end helper 
*/
if ( ! function_exists('msg_alert_front')) {
	function msg_alert_front(){
	$CI =& get_instance(); ?>
	<?php if($CI->session->flashdata('theme_danger')): ?>	
	<div class="alert theme-alert-danger">
		 <button type="button" class="close" data-dismiss="alert">&times;</button>
	     <!-- <strong>Success :</strong> <br> --> <?php echo $CI->session->flashdata('theme_danger'); ?>
	</div>
 <?php endif; ?>
 <?php if($CI->session->flashdata('theme_success')): ?>	
	<div class="alert theme-success">
		 <button type="button" class="close" data-dismiss="alert">&times;</button>
	     <!-- <strong>Success :</strong> <br> --> <?php echo $CI->session->flashdata('theme_success'); ?>
	</div>
 <?php endif; ?>

<?php if($CI->session->flashdata('msg_success')): ?>	
	<div class="alert alert-success">
		 <button type="button" class="close" data-dismiss="alert">&times;</button>
	     <!-- <strong>Success :</strong> <br> --> <?php echo $CI->session->flashdata('msg_success'); ?>
	</div>
 <?php endif; ?>
<?php if($CI->session->flashdata('msg_info')): ?>	
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <!-- <strong>Info :</strong> <br> --> <?php echo $CI->session->flashdata('msg_info'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_warning')): ?>	
	<div class="alert alert-warning">
		<!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
	   <!--  <strong>Warning :</strong> <br> --> <?php echo $CI->session->flashdata('msg_warning'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_error')): ?>	
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <!-- <strong>Error :</strong> <br> --> <?php echo $CI->session->flashdata('msg_error'); ?>
	</div>
<?php endif; ?>
	<?php }					
}
/**
*	Menu Information
*/
if ( ! function_exists('upload_file')) {
	function upload_file($param = null){
		$CI =& get_instance();		
		
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|csv|jpeg|pdf|doc|docx';
		$config['max_size']	= 1024*90;
		$config['image_resize']= FALSE;
		$config['resize_width']= 126;
		$config['resize_height']= 126;
		
		if ($param){
            $config = $param + $config;
        }
		$CI->load->library('upload', $config);
		if(!empty( $config['file_name']))
			$file_Status = $CI->upload->do_upload($config['file_name']);
		else
			$file_Status = $CI->upload->do_upload();
		if (!$file_Status){
			return array('STATUS'=>FALSE,'FILE_ERROR' => $CI->upload->display_errors());			
		}else{
			$uplaod_data=$CI->upload->data();
	
			$upload_file = explode('.', $uplaod_data['file_name']);
			
			if($config['image_resize'] && in_array($upload_file[1], array('gif','jpeg','jpg','png','bmp','jpe'))){
				$param2=array(
					'source_image' 	=>	$config['source_image'].$uplaod_data['file_name'],
					'new_image' 	=>	$config['new_image'].$uplaod_data['file_name'],
					'create_thumb' 	=>	FALSE,
					'maintain_ratio'=>	FALSE,
					'width' 		=>	$config['resize_width'],
					'height' 		=>	$config['resize_height'],
					);
			
				image_resize($param2);
			}	
			return array('STATUS'=>TRUE,'UPLOAD_DATA' =>$uplaod_data );
		}
	}
}
/**
*	image resize
*/
if ( ! function_exists('image_resize')) {
	function image_resize($param = null){
		$CI =& get_instance();
		$config['image_library'] = 'gd2';
		$config['source_image']	= './assets/uploads/';
		$config['new_image']	= './assets/uploads/';		
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width']	 = 150;
		$config['height']	= 150;
		
		 if ($param) {
            $config = $param + $config;
        }
		$CI->load->library('image_lib', $config); 
		if ( ! $CI->image_lib->resize())
		{
		   //return array('STATUS'=>TRUE,'MESSAGE'=>$CI->image_lib->display_errors()); 
			die($CI->image_lib->display_errors());
		}else{
			 return array('STATUS'=>TRUE,'MESSAGE'=>'Image resized.'); 
		}
	}
}
/**
*	image delete
*/
if ( ! function_exists('file_delete')) {
	function file_delete($param = null){
		$config['file_path']	= './assets/uploads/';
		$config['file_thumb_path']	= './assets/uploads/';		
		
		if ($param){
            $config = $param + $config;
        }
        //print_r($config); die;
        if(file_exists($config['file_path'])){
				unlink($config['file_path']);
		}
		if(file_exists($config['file_thumb_path'])){
				unlink($config['file_thumb_path']);
		}		
	}
}
/**
*	Menu Information
*/
if ( ! function_exists('get_nav_menu')) {
	function get_nav_menu($slug='',$is_location=FALSE){
		$CI =& get_instance();
		//$CI->load->model('user_model');		
		if($menu =$CI->common_model->get_nav_menu($slug,$is_location))
			return $menu;
		else
			return FALSE;
	}					
}
/**
*	Get YouTube video ID from URL
*/
if ( ! function_exists('get_youtube_id_from_url')) {
	function get_youtube_thumbnail($youtube_url='',$alt=TRUE){
			$youtubeId = preg_replace('/^[^v]+v.(.{11}).*/', '$1', $youtube_url); 
		
		if($alt) $alt='alt="AA'.$youtubeId.'"'; else $alt='';
		return'<img style="border-radius: 0px !important; transition: none 0s ease 0s;" class="timeline-img pull-left imgsize" src="http://img.youtube.com/vi/'.$youtubeId.'/default.jpg" '.$alt.'>';
				
	}					
}
//for option
if ( ! function_exists('get_option_value')) {
	function get_option_value($key=FALSE){	
		$CI =& get_instance();		
		if($option = $CI->getoption->get_option_value($key))		
			return $option;
		else
			return FALSE;	
	}
}
if ( ! function_exists('file_download')) {
	function file_download($title=FALSE,$data=FALSE){
		$data=str_replace('./', '', $data);		
		$CI =& get_instance();		
		$CI->load->helper('download');
		if(!empty($title) && !empty($data)):
			$title=url_title($title, '-', TRUE);
			if($file = file_get_contents($data)){ 		
			$extend=end(explode('.',$data));			 
			$file_name = $title.'.'.$extend;			
			force_download($file_name, $file);
		}else{
			return FALSE;
		}
		endif;	
	}
}
if ( ! function_exists('get_post')) {
	function get_post($slug='',$is_slug=FALSE){
		$CI =& get_instance();	
		if(!empty($slug))				
			return $CI->common_model->get_post($slug,$is_slug);
		else
			return FALSE;
	}					
}

/**
*	thumbnail image
*/
if ( ! function_exists('create_thumbnail')) {
	function create_thumbnail($config_img='',$img_fix='') {
		$CI =& get_instance();
		$config_image['image_library'] = 'gd2';
		$config_image['source_image'] = $config_img['source_path'].$config_img['file_name'];	
		//$config_image['create_thumb'] = TRUE;
		$config_image['new_image'] = $config_img['destination_path'].$config_img['file_name'];
		$config_image['height']=$config_img['height'];
		$config_image['width']=$config_img['width'];
		if($img_fix){
		$config_image['maintain_ratio'] = FALSE;
		}
		else{
			$config_image['maintain_ratio'] = TRUE;
			list($width, $height, $type, $attr) = getimagesize($config_img['source_path'].$config_img['file_name']);

	        if ($width < $height) {
	        	$cal=$width/$height;
	        	$config_image['width']=$config_img['width']*$cal;
	        }
			if ($height < $width)
			{
				$cal=$height/$width;
		    	$config_image['height']=$config_img['height']*$cal;
			}
		}
		
		$CI->load->library('image_lib');
		$CI->image_lib->initialize($config_image);
		
		if(!$CI->image_lib->resize()) 
			return array('status'=>FALSE,'error_msg'=>$CI->image_lib->display_errors());
		else
			return array('status'=>TRUE,'file_name'=>$config_img['file_name']);
	}
}
/*
/**
*	get_social_url
*/
if ( ! function_exists('get_option_url')) {
	function get_option_url($option_name){	
		$CI =& get_instance();		
		 if($query = $CI->common_model->get_row('options',array('option_name'=>$option_name)))
		 	return $query->option_value;
		 else
		 	return false;
	}
}

if (!function_exists('get_seo_meta_tags')) {
	function get_seo_meta_tags($params=''){
		$CI =& get_instance();	
		if(!empty($params)):
			$CI->db->like('page_name',$params);
			$seometatags_query=$CI->db->get('meta_tags');				
				if($seometatags_query->num_rows()>0)
					return $seometatags_query->row();
				else
					return FALSE;
		else:
		
			return FALSE;

		endif;
	}		
}

/**
*	tag_name by id
*/
if ( ! function_exists('tag_name'))
{
    function tag_name($id='')
    {
        $CI =& get_instance();
      return $CI->common_model->tag_name($id);
    }  

}
/**
*	category_name by id
*/
if ( ! function_exists('categorys_name'))
{
    function categorys_name($id='')
    {
        $CI =& get_instance();
      return $CI->common_model->category_name($id);
    }  

}
/**
*	category_name by id
*/
if ( ! function_exists('blog_name'))
{
    function blog_name($id='')
    {
        $CI =& get_instance();
      return $CI->superadmin_model->blog_name($id);
    }  

}
/**
*	count Likes
*/
if ( ! function_exists('count_likes'))
{
    function count_likes($id='')
    {
        $CI =& get_instance();
      return $CI->common_model->count_likes($id);
    }  

}
/**
*	count by Commments
*/
if ( ! function_exists('count_comments'))
{
    function count_comments($id='')
    {
        $CI =& get_instance();
      return $CI->common_model->count_comments($id);
    }  

}

if (!function_exists('get_counts')) {
	function get_counts($tbl=''){
		$CI =& get_instance();	
		if(!empty($tbl)):
			$count=$CI->db->count_all($tbl);				
				if($count>0)
					return $count;
				else
					return FALSE;
		else:
		
			return FALSE;

		endif;
	}		
}

