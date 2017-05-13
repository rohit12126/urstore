<div class="bread_parent">
<div class="col-md-12">
  <ul class="breadcrumb">
      <li><a href="<?php echo base_url('backend/index');?>"><i class="icon-home"></i> Dashboard  </a></li>  
       <li><a href="<?php echo base_url('blogs/');?>"><b>Blog</b></a></li>
          <li><a href="<?php echo base_url('blogs/comments');?>"><b>Comments</b></a></li>
       <li><b>Comment</b></li>
  </ul>
</div>
<div class="clearfix"></div>
</div> <br>
<div class="panel-body ">
<div class="tab-pane row-fluid fade in active" id="tab-1">
<form role="form" class="form-horizontal tasi-form" action="<?php echo current_url()?>" enctype="multipart/form-data" method="post" id="form_valid">
  <div class="form-body"> 
    <div class="form-group">
       <label class="col-md-3 control-label">Username<span class="mandatory">*</span></label>
         <div class="col-md-6">
           <select name="user_id" class="form-control"  id="user_id">
                  <option value="">Select username</option>
                  <?php foreach ($users as $user): ?>
                     <option value="<?php echo $user['ID'] ?>" <?php if(!empty($_POST['user_id']) && $user['ID']==$_POST['user_id']) echo "selected";?>>
                    <?php echo $user['user_login'] ?>
                    </option> 
                    <?php endforeach;?>
                    
           </select> 
           <?php echo form_error('user_id'); ?>
         </div>
    </div>
    <div class="form-group">
       <label class="col-md-3 control-label">Blog<span class="mandatory">*</span></label>
         <div class="col-md-6">
           <select name="blog_id" class="form-control"  id="blog_id">
                  <option value="">Select blog</option>
                  <?php foreach ($blogs as $blog): ?>
                     <option value="<?php echo $blog['id'] ?>" <?php if(!empty($_POST['blog_id']) && $blog['id']==$_POST['blog_id']) echo "selected";?>>
                    <?php echo $blog['blog_title'] ?>
                    </option> 
                    <?php endforeach;?>
           </select> 
           <?php echo form_error('user_id'); ?>
         </div>
    </div>
     <div class="form-group">
      <label class="col-md-3 control-label">Blog Comment<span class="mandatory">*</span></label>
      <div class="col-md-6">
        <textarea name="comment" rows="3" class="form-control" placeholder="Blog Comment" data-bvalidator="required" data-bvalidator-msg="Blog Comment required"><?php echo set_value('comment');?></textarea>
        <?php echo form_error('comment'); ?>
      </div>
    </div> 
    <div class="form-group">
      <label class="col-md-3 control-label">Status<span class="mandatory">*</span></label>
      <div class="col-md-6">
        <select name="status" class="form-control ">
          <option value="1">Publish</option>
          <option value="0">Unpublish</option>
        </select>
      </div>
    </div>

   
  </div>
  <div class="form-actions fluid">
    <div class="col-md-offset-2 col-md-10">
      <a class="btn btn-danger tooltips" rel="tooltip" data-placement="top" data-original-title="Back to Blogs" href="<?php echo base_url('blogs/comments');?>"><i class="icon-remove"></i> Back</a>                              
      <button  class="btn btn-primary tooltips" rel="tooltip" data-placement="top" data-original-title="Add New Comment" type="submit"> <i class="icon-plus"></i> Add Comment</button>
      </div>
    </div>
  </form>
</div>                     
</div>


