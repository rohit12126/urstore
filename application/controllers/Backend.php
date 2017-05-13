<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Backend extends CI_Controller {
	public function __construct() 
	{
        parent::__construct();
			$this->load->model('superadmin_model');
			$this->load->model('common_model');
			$this->load->library('session');
			$this->load->library('PasswordHash');
    }
	public function index()
	{
		$this->login();
	}
	private function _check_login(){
	
		if($this->common_model->admin_logged_in()===FALSE)
			redirect('/backend/login');
		else
			return true;
	}

	private function _check_login_admin(){
		if($this->common_model->admin_logged_in()===FALSE)
			redirect('/backend/login');
	}
	public function setsession()
	{
		$user_data = array( 'id' 			=> $_POST['id'],
							'status' 		=> $_POST['user_status'],
							'username' 		=> $_POST['user_login'],
							'logged_in' 	=> TRUE
						  );
	
			$this->session->set_userdata('admin_info',$user_data);
	}
	public function login()
	{
		// By default, use the portable hash from phpass
		if($this->common_model->admin_logged_in()===TRUE) redirect('backend/dashboard');
		$data['title']='Admin login';
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() == TRUE)
		{
			
			$data  = array('username'=>$this->input->post('username'),'password' => md5($this->input->post('password')));
			if($this->superadmin_model->login($data,'admin'))
			{
				if($this->_check_login()===TRUE)
			    {
			    	
			      	redirect('backend/dashboard');	
			    }	
			}
			else
			{
				$this->session->set_flashdata('msg_error', 'Incorrect Email or Password.');
				redirect('/backend/login');
			}
		}
		$this->load->view('/backend/login');
	}
	public function logout()
	{
		$this->_check_login(); //check  login authentication
		$this->session->sess_destroy();
		redirect(base_url().'backend/login');
	}
	public function delete_this($id="",$table_name="")
	{
		if( $this->superadmin_model->delete($table_name,array('id'=>$id)) )
		$this->session->set_flashdata('msg_success','Status Updated successfully.');
		redirect($_SERVER['HTTP_REFERER']);
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
	public function changeuserstatus_t_array($id=array(),$status="",$offset="",$table_name="")	
	{
		$this->_check_login(); //check login authentication
		$data['title']='';
		$status=$this->input->post('status_all');
		$data=array('status'=>$status);
		$check=$this->input->post('check');
		if (!empty($check) && $status != '')
		{
			foreach ($check as $id) 
			{
				if($this->superadmin_model->update($table_name,$data,array('id'=>$id)));
					$this->session->set_flashdata('msg_success','Status Updated successfully.');
			}
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
    public function dashboard()
    { 
		$this->_check_login(); //check login authentication
		$data['title']='Dashboard';
		//$data['admin'] = $this->superadmin_model->get_row('users', array('user_role'=>3));
		$data['template']='backend/dashboard';
		$this->load->view('templates/backend_template',$data);
    }


  
    public function change_password(){
		$this->_check_login(); //check login authentication
		$data['title']='change_password';
		//$data['data']=$this->input->post('oldpassword');
		$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required|callback_password_check');
		$this->form_validation->set_rules('newpassword', 'New Password', 'trim|required|min_length[5]|max_length[20]|matches[confpassword]');
		$this->form_validation->set_rules('confpassword','Confirm Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == TRUE){
			$user_data  = array('password' => md5($this->input->post('newpassword')));
			if($this->superadmin_model->update('users',$user_data,array('id'=>1))){
				$this->session->set_flashdata('msg_success','Password updated successfully.');
				redirect('backend/change_password');
			}else{
				$this->session->set_flashdata('msg_error','Update failed, Please try again.');
				redirect('backend/change_password');
			}
		}
		$data['template']='backend/change_password';
		$this->load->view('templates/backend_template',$data);
	}
    public function password_check($data='')
    {  
    	$data_ar = array('password' =>  md5($data),);
		$query = $this->db->get_where('users',$data_ar);
 		if($query->num_rows()>0)
			return TRUE;
		else
		{
			$this->form_validation->set_message('password_check', 'The %s field can not match');
			return FALSE;
		}
	}
	public function top_ads($offset=0)
	{
		$this->_check_login(); //check login authentication
	    $data['title']='Top Ads';    
	    $per_page=1;
	    $table="top_ads";
	    $data['offset']=$offset;
	    $id_array=array();
	    $order_by=array();
	    $columns=array();
	    $like=array();
	    $title=$this->input->get('title');
	    $date=$this->input->get('date');
	    $status=$this->input->get('status');
	    $order=$this->input->get('order');
	    if (!empty($title) && !empty($date) ) 
	    {
	    	$like=array('title' => $title,'created_date' => date("Y-m-d",strtotime($date)),);
	    }
	    elseif ( !empty($title) ) 
	    {
	    	$like=array('title' => $title);
	    }
	    elseif ( !empty($date) ) 
	    {
	    	$like=array('created_date' => date("Y-m-d",strtotime($date)),);
	    }
	    if ( $status!='' ) 
	    {
	    	$id_array = array('status' => $status, );
	    }
	    if ( !empty($order) )
	    {
	    	$order_by = $order;
	    }
	    $data['data'] = $this->superadmin_model->get_result_with_pagination($offset,$per_page,$table,$id_array,$order_by,$columns,$like);
	    $config=backend_pagination();
	    $config['base_url'] = base_url().'backend/top_ads/';
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

	    $data['template']='backend/top_ads/index';
	    $this->load->view('templates/backend_template',$data);
	}


}