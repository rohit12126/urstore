<div class="bread_parent">
<ul class="breadcrumb">
    <li><a href="<?php echo base_url('backend/dashboard');?>"><i class="icon-home"></i> Dashboard  </a></li>
    <li><b>Change Password</b></li>
           
</ul>
</div>

<div class="panel-body">
<div class="col-md-6">
  <form role="form" method="post" action="<?php echo current_url()?>">
      <div class="form-group">
        <label class="control-label">Old Password</label>
        <input type="password" placeholder="Old Password" class="form-control" name="oldpassword" value="<?php echo set_value('oldpassword'); ?>"><?php echo form_error('oldpassword'); ?>
      </div>

      <div class="form-group">
        <label class="control-label">New Password</label>
        <input type="password" placeholder="New Password" class="form-control" name="newpassword" value="<?php echo set_value('newpassword'); ?>"><?php echo form_error('newpassword'); ?>
      </div>

      <div class="form-group">
        <label class="control-label">Confirm Password</label>
          <input type="password" placeholder="Confirm Password" class="form-control" name="confpassword" value="<?php echo set_value('confpassword'); ?>"><?php echo form_error('confpassword'); ?>
      </div>
     
    <div class="form-group">
      <button class="btn btn-primary" type="submit">Submit</button>
    </div>    

  </form>
</div>
</div>