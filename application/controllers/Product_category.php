<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_category extends CI_Controller {

	public function __construct()
 	{
    parent::__construct();
   /*  if(superadmin_logged_in()==FALSE)
    {
      redirect('backend/login'); 
    } */
    $this->load->model('product_category_model');
	$this->load->model('common_model');    
	}
	public function index($offset = 0)
  {	
    $data['page_title'] = 'Dashboard :: Admin Panel';
	 if ($this->input->post('action_type')==1) 
    {
      $id=$this->input->post('cat_id');
      $data['update']=$this->Admin_model->getColumnDataWhere('product_category','',array('id'=>$id),'','');
       $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[200]'); 
      $this->form_validation->set_error_delimiters('<div class="form_error">','</div>');
      $this->session->set_userdata('categotyid',$id); 
      //print_r($data['update']);die;

      if($this->form_validation->run('product_category_edit')==TRUE)
      {
     
        $inset['category_name']=$this->input->post('category_name');
        $inset['description']=$this->input->post('description');
        $inset['parent_id']=$this->input->post('parent_id');
        $inset['sort_order']=$this->input->post('sort_order');
        $inset['status']=$this->input->post('status');
        $inset['category_slug']=url_title($this->input->post('category_name'),'-');
        //echo "<pre>";print_r($inset);die;
        if($this->common_model->update('product_category',$inset,array('id'=>$id)))
        {
          
          $this->session->set_flashdata('msg_success', 'Product category updated successfully.');
        }
        else
        {
          $this->session->set_flashdata('msg_error','Product Category update failed, Please try again.');
        }
        redirect('backend/product_category/index');              
      }
    }
    else
    {
		$this->form_validation->set_rules('category_name', 'category name', 'trim|required|is_unique[product_category.category_name]');	
    $this->form_validation->set_rules('description', 'Description', 'trim|required|max_length[200]'); 
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	     if($this->form_validation->run()==TRUE)
		{  
			$inset['category_name']=$this->input->post('category_name');
			$inset['parent_id']=$this->input->post('parent_id');
      $inset['description']=$this->input->post('description');
			$inset['sort_order']=$this->input->post('sort_order');
			$inset['status']=$this->input->post('status');
			$inset['category_slug']=url_title($this->input->post('category_name'),'-');
			//echo "<pre>";print_r($inset);die;
			if($this->common_model->insert('product_category',$inset))
			{   
			$this->session->set_flashdata('msg_success', 'Product Category added successfully.');
			}
			else
			{
			$this->session->set_flashdata('msg_error', 'New add Product category failed, Please try again.');
			}
			redirect('product_category/index');
		}
   }
    $data['category'] = $this->product_category_model->category(0,1000);
    $data['template'] = "backend/product_category/index";
    $this->load->view('templates/backend_template', $data);
	}
  public function check_updateproductcategory($str)
  {
    $id=$this->session->userdata('categotyid'); 
    $check=$this->Admin_model->getColumnDataWhere('product_category','',array('id !='=>$id,'category_name'=>$str),'','');
    if(count($check)>0)
    { 
      $this->form_validation->set_message('check_updateproductcategory',"The category name field must contain a unique value.");
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }
  public function delete($news_id = 0,$i=0)
  {
    //if (empty($news_id)) redirect('backend/product_category');
    // Try to delete all the childrens first
    $res=$this->common_model->get_result('product_category',array('parent_id' => $news_id)); 
    //print_r($res);
    //$result=$this->Common_model->delete('product_category', array('id' => $news_id));
    if ($i==1) 
    {
      define('ID',$news_id);
    }
    if ($news_id) 
    {
      if ($res) 
      {
        foreach ($res as $row)
        { 
          @unlink($row->image);
          @unlink($row->thumb_image);
          $this->common_model->delete('product_category', array('id' => $row->id));
          $this->delete($row->id);
        }
      }
    }
    if (ID==$news_id) 
    {
      $res=$this->common_model->get_result('product_category',array('id' => $news_id));
      @unlink($res[0]->image);
      @unlink($res[0]->thumb_image);
      $result=$this->common_model->delete('product_category', array('id' => $news_id));
      if ($result==1) 
      {
        $this->session->set_flashdata('msg_success','Category deleted successfully.');
        redirect('backend/product_category');
      } 
      else 
      {
          $this->session->set_flashdata('msg_error', 'Delete failed, Please try again.');
      }
    }
  }
  public function status($id="",$status="",$offset="")
  {
    if(empty($id)) redirect('backend/product_category/');
    if($status==0){
        $cat_status=1;
    }

    if($status==1){
        $cat_status=0;
    }       

    $data = array('status'=>$cat_status);
    if($this->common_model->update('product_category', $data ,array('id'=>$id)))
    {
       $this->session->set_flashdata('msg_success','Category status has been updated successfully.');
    }
    else{
      $this->session->set_flashdata('msg_error', 'Status updated failed, Please try again.');

    }
    redirect('backend/product_category/index/'.$offset);  
  }
  public function get_categories_data()
  {
    $id=$_POST["id"];
    $check=$this->common_model->get_row('product_category',array('id'=>$id),'','');
    //print_r($check);
    echo json_encode($check);
  }

}
