<?php
ob_start(); 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller {
	public function __construct()
	{
        parent::__construct();  
	    //clear_cache();  
	    $this->load->model('superadmin_model');        
	    $this->load->model('common_model');    
    }         
	private function _check_login(){
	///print_r($this->session->all_userdata());
	///	if($this->superadmin_model->admin_logged_in()===FALSE)
			//redirect('backend/login');
	}

    public function index($offset=0)
	{   
		$this->_check_login(); //check  login authentication 
		$data['title']='Category';    
	    $per_page=NUMBER_OF_DATA_SHOWING;
	    $table="category";
	    $data['offset']=$offset;
	    $id_array=array();
	    $order_by=array('id','desc');
	    $columns=array();
	    $like=array();
	    $name=$this->input->get('name');
		if (!empty($name) ) 
	    {
	    	$like=array('category_name' => $name);
	    }
	    $id_array = array('category_id' => 0, );
	    
	    $data['data'] = $this->superadmin_model->get_result_with_pagination($offset,$per_page,$table,$id_array,$order_by,$columns,$like);
	    $config=backend_pagination();
	    $config['base_url'] = base_url().'category/index/';
	    $config['total_rows'] = $this->superadmin_model->get_result_with_pagination(0,0,$table,$id_array,$order_by,$columns,$like);
	    $config['per_page'] = $per_page;
	    $config['uri_segment'] = 3;
	    if(!empty($_SERVER['QUERY_STRING'])){
	     $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
	    }
	    else
	    {
	     $config['suffix'] ='';
	    }
	    $data['total_records'] = $config['total_rows'];
	    $config['first_url'] = $config['base_url'].$config['suffix'];
	    $this->pagination->initialize($config);
	    $data['pagination']=$this->pagination->create_links();  
	    $data['template']='backend/category/index';
	    $this->load->view('templates/backend_template',$data);
	}
	public function delete($id="")
	{
		$this->_check_login(); //check  login authentication
		if( $this->superadmin_model->delete('category',array('id'=>$id)) )
		$this->session->set_flashdata('msg_success','Deleted successfully');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function insert()
	{
		if( $this->superadmin_model->insert('category',$_POST))
		$this->session->set_flashdata('msg_success','Category Added successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function edit()
	{
		$this->_check_login(); //check  login authentication
		$where=array('id'=>$_POST['id']);
		unset($_POST['id']);
		if( $this->superadmin_model->update('category',$_POST,$where))
		$this->session->set_flashdata('msg_success','Category Updated successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function checkcategory()
	{
		if( $this->superadmin_model->checkcategory($_POST,0))
		{
			echo 'ok';
		}else{
			echo 'error';
		}
	}
	public function changeuserstatus_t($id="",$col="",$status="",$table_name="")	{
		$data=array($col=>$status);
		if($this->superadmin_model->update($table_name,$data,array('id'=>$id)))
		$this->session->set_flashdata('msg_success','Status Updated successfully.');
		redirect($_SERVER['HTTP_REFERER']);
	}

	 public function subcategory($offset=0)
	{
		$this->_check_login(); //check  login authentication
		$data['title']='Sub Category';    
		$per_page=NUMBER_OF_DATA_SHOWING;
	    $table="category";
	    $data['offset']=$offset;
	    $id_array=array();
	    $order_by=array('id','desc');
	    $columns=array();
	    $like=array();
	    $name=$this->input->get('name');
		if (!empty($name) ) 
	    {
	    	$like=array('category_name' => $name);
	    }
	    $category_id=$this->input->get('category_id');
	    if (!empty($category_id) ) 
	    {
	    	$like=array('category_id' => $category_id);
	    }
	    $id_array = array('category_id !=' => 0, );
	    
	    $data['data'] = $this->superadmin_model->get_result_with_pagination($offset,$per_page,$table,$id_array,$order_by,$columns,$like);
	    $config=backend_pagination();
	    $config['base_url'] = base_url().'category/subcategory/';
	    $config['total_rows'] = $this->superadmin_model->get_result_with_pagination(0,0,$table,$id_array,$order_by,$columns,$like);
	    $config['per_page'] = $per_page;
	    $config['uri_segment'] = 3;
	    if(!empty($_SERVER['QUERY_STRING'])){
	     $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
	    }
	    else
	    {
	     $config['suffix'] ='';
	    }
	    $data['total_records'] = $config['total_rows'];
	    $config['first_url'] = $config['base_url'].$config['suffix'];
	    $this->pagination->initialize($config);
	    $data['pagination']=$this->pagination->create_links();  
	     $data['category']=$this->common_model->getAlldata('category',0,'category_id');
	    $data['template']='backend/category/subcategory';
	    $this->load->view('templates/backend_template',$data);
	}
 
}