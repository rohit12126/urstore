<div class="bread_parent">
<div class="col-md-12">
  <ul class="breadcrumb">
      <li><a href="<?php echo base_url('backend/dashboard');?>"><i class="icon-home"></i> Dashboard  </a></li>  
       <li><a href="<?php echo base_url('backend/top_ads/');?>"><b>Ads</b></a></li>
       <li><b>Ad Add</b></li>
  </ul>
</div>
<div class="clearfix"></div>
</div> <br>
<div class="panel-body ">
<div class="tab-pane row-fluid fade in active" id="tab-1">
<form role="form" class="form-horizontal tasi-form" action="<?php echo current_url()?>" enctype="multipart/form-data" method="post" id="form_valid">
  <div class="form-body"> 
    <div class="form-group">
      <label class="col-md-3 control-label">Title <span class="mandatory">*</span></label>
      <div class="col-md-6">
        <input type="text" placeholder="Title" class="form-control" name="title" value="<?php echo set_value('title');?>" data-bvalidator="required" data-bvalidator-msg="Title required"><?php echo form_error('title'); ?>
      </div>
    </div> 
    <div class="form-group">
      <label class="col-md-3 control-label">Placement Type <span class="mandatory">*</span></label>
      <div class="col-md-6">
        <select name="ad_type" id="ad_type" class="form-control ">
          <option value="">Select Ad Type</option>
          <option value="1" <?php if ($this->input->post('ad_type')=='1') echo "selected" ;?> >Image</option>
          <option value="0" <?php if ($this->input->post('ad_type')=='0') echo "selected" ;?> >Script Code</option>
        </select>
      </div>
      <?php echo form_error('ad_type'); ?> 
    </div>
    <div class="form-group" id="image_this" style="display:none">
      <label class="col-md-3 control-label">Image <span class="mandatory">*</span><div class="clearfix"></div>  <span class="validation_info">Image file needs to of <b>minimum size 500 x 500 pixels and at max 2000 x 2000 pixels</b>. Allowed image type is <b>jpeg|jpg|png.</b>          
          </span></label>
      <div class="col-lg-3">
          <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" >
              <img src="<?php echo base_url('/assets/front/images/graphic-default.png') ?>" data-src="holder.js/100%x100%" alt="...">
            </div>
          <div>
              <span class="btn btn-primary btn-file btn-xs"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="img"></span>
              <a href="#" class="btn btn-danger fileinput-exists btn-xs" data-dismiss="fileinput">Remove</a>
          </div>
          </div>
      </div>
      <div class="clearfix"></div>
      <?php echo form_error('img'); ?>      
    </div>
    <div class="form-group" id="code_id" style="display:none">
      <label class="col-md-3 control-label">Ad Script Code<span class="mandatory">*</span></label>
      <div class="col-md-6">
        <textarea name="code" class="form-control" placeholder="Third party ad code"><?php echo set_value('code');?></textarea>
        <?php echo form_error('code'); ?>
      </div>
    </div>
    <div class="form-group">
       <label class="col-md-3 control-label">Ranks </label>
         <div class="col-md-4">
           <select name="type[]" class="multi-select" multiple="" id="my_multi_select2">

                    <?php
                      for ($i=1; $i < 101; $i++) 
                      { 
                        ?>
                          <option value="<?php echo $i; ?>" <?php if(!empty($_POST['type']) && in_array($i,$_POST['type'])) echo "selected"; ?>><?php echo $i;?>
                          </option> 
                        <?php
                      }
                    ?>
           </select>  <div class="clearfix theme-divider"></div>
         <span class="validation_info">You can select one or multiple values</span><div class="clearfix"></div>
           <?php echo form_error('type[]'); ?>
         </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label">Complete Description</label>
      <div class="col-md-6">
        <textarea name="description" rows="5" class="tinymce_edittor form-control" placeholder="Full Description" data-bvalidator="required" data-bvalidator-msg="Full Description required"><?php echo set_value('description');?></textarea>
        <?php echo form_error('description'); ?>
      </div>
    </div> 
    <div class="form-group">
      <label class="col-md-3 control-label">Status</label>
      <div class="col-md-6">
        <select name="status" class="form-control ">
          <option value="1">Publish</option>
          <option value="0">Unpublish</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label">Is Sidebar</label>
      <div class="col-md-6">
        <input type="radio" name="is_sidebar" value="1" checked>Yes
        <input type="radio" name="is_sidebar" value="0">No
      </div>
    </div>
  </div>
  <div class="form-actions fluid">
    <div class="col-md-offset-2 col-md-10">
      <a class="btn btn-danger tooltips" rel="tooltip" data-placement="top" data-original-title="Back to Blogs" href="<?php echo base_url('backend/top_ads/');?>"><i class="icon-remove"></i> Back</a>                              
      <button  class="btn btn-primary tooltips" rel="tooltip" data-placement="top" data-original-title="Add New Ad" type="submit"> <i class="icon-plus"></i> Submit</button>
      </div>
    </div>
  </form>
</div>                     
</div>


