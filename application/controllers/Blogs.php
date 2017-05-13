<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blogs extends CI_Controller {
	public function __construct(){
	    parent::__construct();  
			
			$this->load->model('superadmin_model');        
			$this->load->model('common_model');  
			$this->load->model('product_category_model');	
			$this->_check_login();			
	}
   private function _check_login(){
/* 		 if($this->common_model->admin_logged_in()===FALSE)
			redirect('backend/login');    */
	}
	
  public function index($offset=0)  
  {
    $this->_check_login(); //check login authentication
    $data['title']='Posts';    
    $per_page=100;
    $data['offset']=$offset;
    $data['blogs'] = $this->superadmin_model->blog_model($offset,$per_page);
    $config=backend_pagination();
    $config['base_url'] = base_url().'blogs/index';
    $config['total_rows'] = $this->superadmin_model->blog_model(0,0);
    $config['per_page'] = $per_page;
    $config['uri_segment'] = 3;
    if(!empty($_SERVER['QUERY_STRING'])){
     $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
    }
    else{
     $config['suffix'] ='';
    }
    $data['total_records'] = $config['total_rows'];
    $config['first_url'] = $config['base_url'].$config['suffix'];
    $this->pagination->initialize($config);
    $data['pagination']=$this->pagination->create_links();  
    $data['subcategory']=array();
    if ($this->input->get('search')) 
	{
		$data['subcategory']=$this->common_model->getAlldata('category',$this->input->get('search'),'category_id',array('main_status',0));
	}	
    $data['category']=$this->common_model->getAlldata('product_category',0,'parent_id',array('status',1));

    $data['template']='backend/blog/index';
    $this->load->view('templates/backend_template',$data);
 }
	public function getAllsubCategoryAjax()
 	{
 		$result=$this->common_model->getAlldata('category',$_POST['cat_id'],'category_id',array('main_status',0));
 		echo json_encode($result);
 	}

   public function blog_add()
    {    
       	ini_set('memory_limit', '-1');	
    	$this->_check_login(); //check login authentication
    	$data['title']='add_post';
		$this->form_validation->set_rules('blog_title','Post Title','required');
		$this->form_validation->set_rules('blog_full_description','Post Complete Description','required');
		$this->form_validation->set_rules('category', 'Post Categories', 'required');
		$this->form_validation->set_rules('order_number', 'Post Order Number ', 'required|integer');
		//$this->form_validation->set_rules('type[]', 'Blog Tags', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == TRUE){
			
			//$tags= implode(", ",$this->input->post('category'));
			$data_insert['blog_title'] =  ucfirst($this->input->post('blog_title'));
			$data_insert['blog_full_description'] =  ucfirst($this->input->post('blog_full_description'));
			$data_insert['blog_slug']	=	url_title($this->input->post('blog_title'), '-', TRUE);
			$data_insert['order_number'] =  ucfirst($this->input->post('order_number'));
			$data_insert['blog_category']=$this->input->post('category');
			$data_insert['status']=$this->input->post('blog_status');
			$tags= implode(", ",$this->input->post('type'));
			$data_insert['blog_tags']=$tags;
			$data_insert['created'] =	date('Y-m-d h:i:s A');
	        $this->superadmin_model->insert('blogs',$data_insert);
			$this->session->set_flashdata('msg_success','Post Added successfully.');
			redirect('blogs');
		   }	  
		$id = array('status' => 1, );//$data['category']=$this->product_category_model->getColumnDataWhere('product_category','',array('status'=>'1'),'','');
		$data['category']=$this->common_model->getAlldata('product_category',0,'parent_id',array('status',1));
		$data['blog_tags'] = $this->superadmin_model->get_result('blog_tags',$id);
	
    	$data['template']='backend/blog/blog_add';
   		$this->load->view('templates/backend_template',$data);
    }

    public function blog_edit($id='')
    {    
       	ini_set('memory_limit', '-1');	
    	//$this->_check_login(); //check login authentication
    	$data['title']='edit_post';
    	if($id==='')
    	{
    		redirect('blogs'); 
    	}
		$this->form_validation->set_rules('blog_title','Post Title','required|strip_tags');
		$this->form_validation->set_rules('category', 'Post Category', 'required');
		$this->form_validation->set_rules('order_number', 'Post Order Number ', 'required|integer');
		//$this->form_validation->set_rules('type[]', 'Blog Tags', 'required');
		$this->form_validation->set_rules('blog_full_description','Post Full Description','required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');

		if ($this->form_validation->run() == TRUE)
		{
			//$tags= implode(", ",$this->input->post('category'));
			$data_insert['blog_category']=$this->input->post('category');
			$tags= implode(", ",$this->input->post('type'));
			$data_insert['blog_tags']=$tags;
			$data_insert['blog_title'] =  ucfirst($this->input->post('blog_title'));
			$data_insert['order_number'] =  ucfirst($this->input->post('order_number'));
			$data_insert['blog_full_description'] =  ucfirst($this->input->post('blog_full_description'));
			$data_insert['blog_slug']	=	url_title($this->input->post('blog_title'), '-', TRUE);
			$data_insert['updated'] =	date('Y-m-d h:i:s A');
	        $this->superadmin_model->update('blogs',$data_insert,$array = array('id' => $id, ));
			$this->session->set_flashdata('msg_success','Post Updated successfully.');
			redirect('blogs');
		   }	  
		$data['blog'] = $this->superadmin_model->get_result('blogs',$array = array('id' =>$id) ,array(),array());
		$id = array('status' => 1, );
		//$data['category']=$this->product_category_model->getColumnDataWhere('product_category','',array('status'=>'1'),'','');
		$data['category']=$this->common_model->getAlldata('product_category',0,'parent_id',array('status',1));
		$data['blog_tags'] = $this->superadmin_model->get_result('blog_tags',$id);
    	$data['template']='backend/blog/blog_edit';
		$this->load->view('templates/backend_template',$data);
    }

    public function blog_delete($id='')
    {
    	$this->_check_login(); //check login authentication
        if(empty($id)){ redirect('blogs/'); }
        if($this->superadmin_model->delete('blogs',array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Post deleted successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('msg_error','Failed, Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

	public function blog_tags() 
	{
	    $this->_check_login(); //check login authentication

        if($this->input->post('type_action') == 1){
      	  $this->form_validation->set_rules('tag_title', 'Post Tag Title', 'required|trim');
      	  $this->form_validation->set_rules('order_by', 'Tag Order', 'required|trim|numeric');
        }
        if($this->input->post('type_action') == 2){
        	$this->form_validation->set_rules('tag_title_edit[]', 'Post Tag Title', 'required|trim');
	        $this->form_validation->set_rules('order_by_edit[]', 'Post Order By', 'required|trim|numeric');
        }
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){

          if($this->input->post('type_action') == 1){
              if($this->input->post('tag_title_label')){
             	$category_label = $this->input->post('tag_title_label');
              }else{
            	 $category_label = $this->input->post('tag_title') ;
              }

				$category_data  = array(
					'tag_title' =>    ucfirst($this->input->post('tag_title')),
					'tag_slug'  =>    url_title($this->input->post('tag_title'), '-', TRUE),
					'order_by'  =>    $this->input->post('order_by'),
					'created'   =>  date('Y-m-d H:i:s A')
				);
            if($this->superadmin_model->insert('blog_tags',$category_data)){
                $this->session->set_flashdata('msg_success','Post tag added successfully.');
                 redirect('blogs/blog_tags');
            }
           }
          if($this->input->post('type_action') == 2){              

            for ($i=0; $i < count($_POST['main_id']); $i++) {   
                $category_data['tag_title'] = ucfirst($_POST['tag_title_edit'][$i]);
                $category_data['order_by'] = $_POST['order_by_edit'][$i];
                $category_data['updated'] =date('Y-m-d H:i:s A');    
                $this->superadmin_model->update('blog_tags',$category_data,array('id'=>$_POST['main_id'][$i]));
            }
                $this->session->set_flashdata('msg_success','Post tag updated successfully.');
                redirect('blogs/blog_tags');
           }
        }
        $data['title']='Post Tags';	
        $data['blog_tags'] = $this->superadmin_model->get_result('blog_tags',array(),array(),array('order_by','asc'));

        $data['template']='backend/blog/blog_tags';
        $this->load->view('templates/backend_template',$data);
    }

   public function blog_tag_delete($id='')
    {
    	$this->_check_login(); //check login authentication
        if(empty($id)){ redirect('blogs/blog_tags'); }
        if($this->superadmin_model->delete('blog_tags',array('id'=>$id))){
           $this->session->set_flashdata('msg_success','Post tag deleted successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('msg_error','Failed, Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function comments($offset=0)
  	{
  		$this->_check_login(); //check login authentication
	    $data['title']='Comments';    
	    $per_page=5;
	    $data['offset']=$offset;
	    $data['comments'] = $this->superadmin_model->comments_model($offset,$per_page);
	    $config=backend_pagination();
	    $config['base_url'] = base_url().'blogs/comments';
	    $config['total_rows'] = $this->superadmin_model->comments_model(0,0);
	    $config['per_page'] = $per_page;
	    $config['uri_segment'] = 4;
	    if(!empty($_SERVER['QUERY_STRING'])){
	     $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
	    }
	    else{
	     $config['suffix'] ='';
	    }
	    $data['total_records'] = $config['total_rows'];
	    $config['first_url'] = $config['base_url'].$config['suffix'];
	    $this->pagination->initialize($config);
	    $data['pagination']=$this->pagination->create_links();  
	    $data['offset']=$offset;
	    
	    $data['blogs'] = $this->superadmin_model->get_result('blogs');  
	    $data['template']='backend/blog/comments';
	    $this->load->view('templates/backend_template',$data);
    }
    public function comment_delete($id='')
    {
    	$this->_check_login(); //check login authentication
        if(empty($id)){ redirect('backend/blog/comments/'); }
        if($this->superadmin_model->delete('comments',array('id'=>$id)))
        {
           $this->session->set_flashdata('msg_success','Comment deleted successfully.');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('msg_error','Failed, Please try again.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
	function blog_image_check($str)
	{ 
	 $data['title']='';
	 if(empty($_FILES['blog_img']['name'])){
	        $this->form_validation->set_message('blog_image_check', 'Choose Post Image');
	       return FALSE;
	    }
	 $image = getimagesize($_FILES['blog_img']['tmp_name']);
	   if ($image[0] < 500 || $image[1] < 500) {
	       $this->form_validation->set_message('blog_image_check', 'Oops! Your Post image needs to be atleast 500 x 500 pixels.');
	       return FALSE;
	   }
	   if ($image[0] > 2000 || $image[1] > 2000) {
	       $this->form_validation->set_message('blog_image_check', 'Oops! Your Post image needs to be maximum of 2000 x 2000 pixels.');
	       return FALSE;
	   }
	  if(!empty($_FILES['blog_img']['name'])):
	    $config['upload_path'] = './assets/uploads/blogs/';
	    $config['allowed_types'] = 'jpeg|jpg|png';
	    $config['max_size']  = '5024';
	    $config['max_width']  = '2000';
	    $config['max_height']  = '2000';
	    $this->load->library('upload', $config);
	    if ( ! $this->upload->do_upload('blog_img')){
	        $this->form_validation->set_message('blog_image_check', $this->upload->display_errors());
	        return FALSE;
	    }
	    else
	    {
	        $data = $this->upload->data(); // upload image
	        $config_img_p['source_path'] = './assets/uploads/blogs/';
	        $config_img_p['destination_path'] = './assets/uploads/blogs/thumbnails/';
	        $config_img_p['width']  = '500';
	        $config_img_p['height']  = '500';
	        $config_img_p['file_name'] =$data['file_name'];
	        $status=create_thumbnail($config_img_p);
	        $this->session->set_userdata('blog_image_check',array('image_url'=>$config['upload_path'].$data['file_name'],
	             'blog_img'=>$data['file_name']));
	        return TRUE;
	    }
	    else:
	        $this->form_validation->set_message('blog_image_check', 'The %s field required.');
	        return FALSE;
	    endif;
	  }
	  public function changeuserstatus_t($id="",$status="",$offset="",$table_name="")	{
		$this->_check_login(); //check login authentication
		 $data['title']='';
		if($status==0) $status=1;
		else $status=0;
		$data=array('status'=>$status);
		if($this->superadmin_model->update($table_name,$data,array('id'=>$id)))
		$this->session->set_flashdata('msg_success','Status Updated successfully.');
		redirect($_SERVER['HTTP_REFERER']);
		}
	public function comment_add()
    {    
       	ini_set('memory_limit', '-1');	
    	$this->_check_login(); //check login authentication
    	$data['title']='add_comment';
		$this->form_validation->set_rules('user_id','Username','required');
		$this->form_validation->set_rules('comment','Comment','required');
		$this->form_validation->set_rules('blog_id', 'Blog', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == TRUE){
			$data_insert['user_id'] =  ucfirst($this->input->post('user_id'));
			$data_insert['comment'] =  ucfirst($this->input->post('comment'));
			$data_insert['blog_id']	=	url_title($this->input->post('blog_id'));
			$data_insert['status']	=	url_title($this->input->post('status'));
			$data_insert['created'] =	date('Y-m-d h:i:s A');
			$data_insert['updated'] =	date('Y-m-d h:i:s A');
		    $this->superadmin_model->insert('comments',$data_insert);
			$this->session->set_flashdata('msg_success','Comment Added successfully.');
			redirect('blogs/comments');
		   }	  
		$data['blogs'] = $this->superadmin_model->getAlldata('blogs');
		$data['users'] = $this->superadmin_model->getAlldata('l7d1zw_users');
    	$data['template']='backend/blog/comment_add';
   		$this->load->view('templates/backend_template',$data);
    }	
    public function comment_edit($id='')
    {    
       	ini_set('memory_limit', '-1');	
    	$this->_check_login(); //check login authentication
    	$data['title']='add_comment';
		$this->form_validation->set_rules('user_id','Username','required');
		$this->form_validation->set_rules('comment','Comment','required');
		$this->form_validation->set_rules('blog_id', 'Blog', 'required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == TRUE){
			$data_insert['user_id'] =  ucfirst($this->input->post('user_id'));
			$data_insert['comment'] =  ucfirst($this->input->post('comment'));
			$data_insert['blog_id']	=	url_title($this->input->post('blog_id'));
			$data_insert['updated'] =	date('Y-m-d h:i:s A');
		  $this->superadmin_model->update('comments',$data_insert,$array = array('id' => $id, ));
			$this->session->set_flashdata('msg_success','Comment Updated successfully.');
			redirect('blogs/comments/');
		   }	  
		$data['comment'] = $this->superadmin_model->get_result('comments',$array = array('id' =>$id) ,array(),array());   
		$data['blogs'] = $this->superadmin_model->getAlldata('blogs');
		$data['users'] = $this->superadmin_model->getAlldata('l7d1zw_users');
    	$data['template']='backend/blog/comment_edit';
   		$this->load->view('templates/backend_template',$data);
    }
}