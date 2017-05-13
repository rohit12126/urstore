<?php
@ob_start();
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        clear_cache();
        $this->load->model('superadmin_model');
        $this->load->model('common_model');
    }
	public function index()
	{
		$this->login();
	}
	public function logout()
	{
		//session_destroy();
		$this->session->unset_userdata('user_info');
		//$this->session->unset_userdata('admin_info');
		$this->session->sess_destroy();
		redirect(base_url().'home/login');
	}
	private function _check_login(){
		if($this->superadmin_model->user_logged_in()===FALSE)
			redirect('home/login');
	}

	private function _check_login_admin(){
		if($this->superadmin_model->user_logged_in()===FALSE)
			redirect('home/login');
	}
	
	public function login()
	{
  
		if($this->superadmin_model->user_logged_in()===TRUE)
			redirect('home/dashboard');
			$data['title']='Admin login';
			$this->load->view('login');
	}
	public function dashboard($offset=0,$id='')
    { 
    	
    	$_GET['status']=1;
    	$keyword='';
    	if(!empty($_POST))
    	{
    		$keyword=$_POST['keyword'];
    	}
	
		$this->_check_login(); //check login authentication

		$data['title']='Dashboard';
		$data['template']='frontend/dashboard';
		//$data['title']='Blogs';    
	    $per_page=24;
	    $data['offset']=$offset;
		if($id!=='')
		{
			$order='order_number';
		}else{
			$order='blog_title';
		}
	    $data['blogs'] = $this->superadmin_model->blog_model($offset,$per_page,$id,$keyword,$order);
	    $config=backend_pagination();
	    $config['base_url'] = base_url().'home/dashboard';
	    $config['total_rows'] = $this->superadmin_model->blog_model(0,0,$id,$keyword,$order);
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
	    $data['categorys']=$id;

		$data['category']=$this->common_model->getAlldata('product_category',0,'parent_id',array('status',1),array('category_name','asc'));
		
		//$data['blogs']=$this->common_model->getAllblog('',$id);
		$this->load->view('templates/home_template',$data);
    }
    public function post_details($id,$category='')
    {
    	//$this->_check_login(); //check login authentication
		$data['title']='post_details';
		$this->form_validation->set_rules('comment','Comment','required');
		if ($this->form_validation->run() == TRUE){
			$users = $this->session->userdata('user_info');
			$data_insert['user_id'] =  ucfirst($users['id']);
			$data_insert['blog_id'] =  ucfirst($id);
			$data_insert['status'] =0;
			$data_insert['comment'] =  ucfirst($this->input->post('comment'));
			$data_insert['created'] =	date('Y-m-d h:i:s A');
			$data_insert['updated'] =	date('Y-m-d h:i:s A');
		    $this->superadmin_model->insert('comments',$data_insert);
			$this->session->set_flashdata('msg_success','Thanks for posting your comment. Your comment has been sent for admin approval.');
			redirect('home/blog_details/'.$id.'/'.$category);
		}
		$data['template']='frontend/blog_details';
		$data['comments']=$this->common_model->getAllcomments($id);
		$data['blogs']=$this->common_model->getAllblog($id);
		$data['category']=$this->common_model->getAlldata('product_category',0,'parent_id',array('status',1),array('category_name','asc'));
		$data['category']=$this->common_model->getAlldata('product_category',0,'parent_id',array('status',1),array('category_name','asc'));
		$this->load->view('templates/home_template',$data);
    }
   public function setsession()
	{
		/*if($this->superadmin_model->user_logged_in()===TRUE)
			redirect('home/dashboard');*/
		$user_data = array( 'id' 			=> $_POST['id'],
							'status' 		=> $_POST['user_status'],
							'username' 		=> $_POST['user_login'],
							'logged_in' 	=> TRUE
						  );
		$this->session->set_userdata('user_info',$user_data);
	}

}