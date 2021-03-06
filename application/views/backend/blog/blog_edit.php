<div class="bread_parent">
<div class="col-md-12">
  <ul class="breadcrumb">
      <li><a href="<?php echo base_url('backend/dashboard');?>"><i class="icon-home"></i> Dashboard  </a></li>  
       <li><a href="<?php echo base_url('blogs/');?>"><b>Post</b></a></li>
       <li><b>Post Edit</b></li>

  </ul>
</div>
<?php if ($blog) {
  foreach ($blog as $row) {
  ?>
<div class="clearfix"></div>
</div> <br>
<div class="panel-body ">
  <div class="tab-pane row-fluid fade in active" id="tab-1">
    <form role="form" class="form-horizontal tasi-form" action="<?php echo current_url()?>" enctype="multipart/form-data" method="post" id="form_valid">
      <div class="form-body">
        <div class="col-md-10">  
        <div class="form-group">
          <label class=" control-label">Last Updated</label>
          <?php echo date('d M Y',strtotime($row->updated)); ?>
        </div> 
         <div class="form-group">
      <label class=" control-label">Post  Category<span class="mandatory">*</span></label>
	  <select name="category" id="category"  class="form-control" data-bvalidator="required" data-bvalidator-msg="Post category required">
             <option value="">Select category</option>
            <?php  foreach ($category as $cat) {
             ?>
            <option value="<?php echo $cat['id']; ?>" <?php if ($this->input->post('category', TRUE) ==$cat['id']) { echo 'selected'; }else if($row->blog_category==$cat['id']){
				echo 'selected';
			} ?> ><?php echo $cat['category_name']; ?></option>
							<?php $subcategory=sub_category($cat['id']);
									if(!empty($subcategory)){ 
									foreach($subcategory as $sub){ 
							?> 
									<option value="<?php echo $sub['id']; ?>" <?php if ($this->input->post('category', TRUE) == $sub['id']) { echo 'selected';}else if($row->blog_category==$sub['id']){
				echo 'selected';
			}  ?> >&nbsp;&nbsp;  <?php echo $sub['category_name']; ?></option>
												<?php $subcategory2=sub_category($sub['id']);
													if(!empty($subcategory2)){
													 foreach($subcategory2 as $sub2)
													{	
												?>
													<option value="<?php echo $sub2['id']; ?>" <?php if ($this->input->post('category', TRUE) == $sub2['id']) { echo 'selected';}else if($row->blog_category==$sub2['id']){
				echo 'selected';
			}  ?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <?php echo $sub2['category_name']; ?></option>
															<?php $subcategory3=sub_category($sub2['id']);
																  if(!empty($subcategory3)){
																	  foreach($subcategory3 as $sub3)
                                                                          { 
															 ?>
																	<option value="<?php echo $sub3['id']; ?>" <?php if ($this->input->post('category', TRUE) == $sub3['id']) { echo 'selected';}else if($row->blog_category==$sub3['id']){
				echo 'selected';
			}  ?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <?php echo $sub3['category_name']; ?></option>
															<?php } } ?>
												<?php } } ?>
									
									
							<?php } }?>
			
			
            <?php } ?>
            </select> 
              <?php echo form_error('category'); ?> 
    </div> 
        <div class="form-group">
          <label class="control-label">Post Title  <span class="mandatory">*</span></label>
          
            <input type="text" placeholder="Post Title" class="form-control" name="blog_title" value="<?php if ($this->input->post('blog_title')){ echo set_value('blog_title'); } else { echo $row->blog_title;} ?>" data-bvalidator="required" data-bvalidator-msg="Post Title required"><?php echo form_error('blog_title'); ?>
          </div> 
        <div class="form-group">
            <label class=" control-label">Post Short Description <span class="mandatory">*</span></label>
              <textarea class="form-control" placeholder="Post Sort Description" data-bvalidator="required" data-bvalidator-msg="Post short description required" name="short_description"><?php if ($this->input->post('short_description')){ echo set_value('short_description'); } else { echo $row->short_description;} ?></textarea>
              <?php echo form_error('short_description'); ?> 
        </div>   
        <input type="hidden" name="type[]">
       <?php  /*<div class="form-group">
           <label class="col-md-3 control-label">Blog Tags  <span class="mandatory">*</span></label>
           <div class="col-md-4">
             <select name="type[]" class="multi-select" multiple="" id="my_multi_select2">
                     <?php if(!empty($blog_tags)):
                      foreach ($blog_tags as $row_design): ?>
                       <option value="<?php echo $row_design->id?>"<?php if (strstr($row->blog_tags,$row_design->id)) { echo "selected"; } ?> >
                      <?php echo $row_design->tag_title;?>
                      </option> 
                      <?php endforeach;?>
                      <?php endif; ?>
             </select><div class="clearfix theme-divider"></div>
           <span class="validation_info">You can select one or multiple values</span>
             <?php echo form_error('type[]'); ?>
           </div>
        </div>
      */ ?>
        <div class="form-group">
          <label class=" control-label">Blog Complete Description <span class="mandatory">*</span></label>
          
            <textarea name="blog_full_description" class="tinymce_edittor form-control" rows="5" placeholder="Post Full Description" data-bvalidator="required" data-bvalidator-msg="Post Full Description required"><?php if ($this->input->post('Post_full_description')){ echo set_value('blog_full_description'); } else { echo $row->blog_full_description;} ?></textarea>
            <?php echo form_error('blog_full_description'); ?>
          
        </div>
        <input type="hidden" placeholder="Post Order Number" class="form-control" name="order_number" value="0">
	<?php 	/* <div class="form-group">
          <label class="control-label">Post Order Number  <span class="mandatory">*</span></label>
          
            <input type="text" placeholder="Post Order Number" class="form-control" name="order_number" value="<?php if ($this->input->post('order_number')){ echo set_value('order_number'); } else { echo $row->order_number;} ?>" data-bvalidator="required" data-bvalidator-msg="Post Order Number required"><?php echo form_error('order_number'); ?>
          </div> 
        </div>*/ ?>
        <div class="col-md-1"></div>
        <?php /*<div class="col-md-4">
        <div class="form-group">
          <label class=" control-label">Post Categories<span class="mandatory">*</span></label>
     
          <div class="clearfix theme-divider"></div>
             <span class="validation_info">You can select one or multiple values</span><div class="clearfix"></div>
           <div class="clearfix theme-divider"></div>   
          <div class="col-xs-12 col-sm-9 col-md-9 category_list_">
				<?php 
				$result=$category;
				$size=count($result);
				$category = array(
				'categories' => array(),
				'parent_cats' => array()
					);
					//build the array lists with data from the category table
				if (!empty($result)) 
				{
					foreach ($result as $rows) 
					{
						$category['categories'][$rows->id] = $rows;
						$category['parent_cats'][$rows->parent_id][] = $rows->id;
					}
					//echo"<pre>";print_r($category);
				 if (!empty($_POST) && isset($_POST['category']))
					{
						echo buildCategory_add(0, $category, $this->input->post('category') ); 
					}else {
						$cate=explode(",",$row->blog_category);
						echo buildCategory_add(0, $category,$cate); 
					}
				} ?>
				<?php echo form_error('category[]'); ?> 
			</div>    

        </div> 
        </div>
       */ ?>
        <div class="form-actions fluid row">
           <div class="col-md-offset-2 col-md-10">
            <br><br>
            <a class="btn btn-danger tooltips" rel="tooltip" data-placement="top" data-original-title="Back to Posts" href="<?php echo base_url('blogs/');?>"><i class="icon-remove"></i> Back</a>                              
            <button  class="btn btn-info tooltips" rel="tooltip" data-placement="top" data-original-title="Update Post" type="submit"> <i class="fa fa-refresh"></i> Update Post</button>
          </div>
        </div>
    </form>
  </div>                     
</div>
<?php 
}
}
?>