<ul class="breadcrumb">
    <li><a  href="<?php echo base_url('backend/superadmin/dashboard');?>"><i class="icon-home"></i> Dashboard / </a></li>   
</ul>
<header class="panel-heading">
 Hello <?php echo superadmin_name();?>, Welcome to the admin section of lean Indulgence <i class="icon-smile"></i>
</header>
<div class="panel-body">
  <div class="row">
    <div class="col-lg-4">
      <!--user info table start-->
      <aside class="profile-nav alt green-border">
          <section class="panel"> 
              <div class="heading">
                  <h4><i class="fa fa-credit-card"></i> Subadmin Information</h4>
              </div>
              <ul class="nav nav-pills nav-stacked">
                  <li><a href="javascript:;"><i class="glyphicon glyphicon-user"></i> User Name <span class="label label-primary pull-right r-activity"><?php  echo $admin->first_name." ".$admin->last_name; ?></span></a></li>
                  <li><a href="javascript:;"> <i class="fa fa-envelope-o"></i> Email <span class="label label-success pull-right r-activity"><?php  echo $admin->email; ?></span></a></li>
                  <li><a href="javascript:;"> <i class="fa fa-calendar"></i> Last Login <span class="label label-info pull-right r-activity"><?php  echo date("d-M-Y H:i A",strtotime($admin->last_login)); ?></span></a></li>
                  <li><?php if($admin->status==1){ ?> 
                        <a  href="<?php echo base_url(); ?>backend/superadmin/change_status_users/<?php echo $admin->id;  ?>/0" ><i class="fa fa-check-square-o"></i>Status<span class="label label-danger pull-right r-activity">Inactive</span></a>
                        <?php }
                        else{ ?>
                         <a href="<?php echo base_url(); ?>backend/superadmin/change_status_users/<?php echo $admin->id;  ?>/1"><i class="fa fa-check-square-o"></i>Status<span class="label label-success pull-right r-activity">Active</span></a>
                    <?php } ?>
                  </li>
                  <li><a target="_blank" href="<?php echo base_url(); ?>backend/superadmin/login_admin"><i class="fa fa-sign-in"></i> Proxy Login</a>
                  </li>
              </ul>
          </section>
      </aside>  
      <!--user info table end-->
    </div>
    <div class="col-lg-4">
        <!--widget start-->
        <aside class="profile-nav alt green-border"> 
            <section class="panel">
              <div class="heading">
                  <h4><i class="fa fa-external-link-square"></i> Site Links</h4>
              </div>
              <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php echo base_url('backend/blogs'); ?>"> <i class="fa fa-clock-o"></i> BLogs <span class="label label-primary pull-right r-activity"><?php echo get_counts('blogs') ?></span></a></li>

                  <li><a href="<?php echo base_url('backend/blogs/comments'); ?>"> <i class="fa fa-comments"></i> Comments <span class="label label-info pull-right r-activity"><?php echo get_counts('comments') ?></span></a></li>

                  <li><a href="<?php echo base_url('backend/gallery'); ?>"> <i class=" fa fa-picture-o"></i> Gallery <span class="label label-warning pull-right r-activity"><?php echo get_counts('galleries') ?></span></a></li>

                  <li><a href="<?php echo base_url('backend/news'); ?>"> <i class="fa fa-bullhorn"></i> News <span class="label label-success pull-right r-activity"><?php echo get_counts('news') ?></span></a></li>

                  <li><a href="<?php echo base_url('backend/faq'); ?>"> <i class=" fa fa-question"></i> FAQ <span class="label label-danger pull-right r-activity"><?php echo get_counts('faq') ?></span></a></li>
              </ul>
            </section>
        </aside>
        <!--widget end-->
    </div>

    <div class="col-lg-4">
        <!--widget start-->
        <aside class="profile-nav alt green-border">
            <section class="panel">
              <div class="heading">
                  <h4><i class="icon-gear"></i> Settings</h4>
              </div>
              <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php echo base_url('backend/superadmin/option'); ?>"> <i class="fa fa-home"></i> Home Page <span class="label label-success pull-right r-activity"></span></a></li>
                  <li><a href="<?php echo base_url('backend/superadmin/option'); ?>"> <i class="icon-money"></i> Membership <span class="label label-danger pull-right r-activity"></span></a></li>
                  <li><a href="<?php echo base_url('backend/superadmin/option'); ?>"> <i class="fa fa-shield"></i> About Us <span class="label label-danger pull-right r-activity"></span></a></li>
                  <li><a href="<?php echo base_url('backend/superadmin/option'); ?>"> <i class="icon-map-marker"></i> Address <span class="label label-danger pull-right r-activity"></span></a></li>
                  <li><a href="<?php echo base_url('backend/superadmin/option'); ?>"> <i class="icon-cogs"></i> Social Media <span class="label label-danger pull-right r-activity"></span></a></li>
              </ul>
            </section>
                  
        </aside>
        <!--widget end-->
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3">
        <!--widget start-->
        <aside class="profile-nav alt green-border">
            <section class="panel">
              <div class="heading">
                  <h4><i class="fa fa-try"></i> User Links</h4>
              </div>
              <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php echo base_url('backend/subscriptions'); ?>"> <i class="fa fa-envelope-o"></i> Appointments <span class="label label-success pull-right r-activity"></span></a></li>
                  <li><a href="<?php echo base_url('backend/subscriptions'); ?>"> <i class="icon-money"></i> Membership <span class="label label-danger pull-right r-activity"></span></a></li>
              </ul>
            </section>
                  
        </aside>
        <!--widget end-->
    </div>
   <!--  <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
              <div class="heading">
                  <h4>Blogs</h4>
              </div>
              <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php echo base_url('backend/blogs'); ?>"> <i class="fa fa-clock-o"></i> Blogs <span class="label label-primary pull-right r-activity"></span></a></li>

                  <li><a href="<?php echo base_url('backend/blogs/blog_add'); ?>"> <i class="fa fa-plus"></i> Add Blog <span class="label label-info pull-right r-activity"></span></a></li>

                  <li><a href="<?php echo base_url('backend/blogs/blog_tags'); ?>"> <i class="fa fa-tags"></i> Blog Tags <span class="label label-warning pull-right r-activity"></span></a></li>

                  <li><a href="<?php echo base_url('backend/blogs/comments'); ?>"> <i class="fa fa-comments"></i> Comments <span class="label label-success pull-right r-activity"></span></a></li>
              </ul>
            </section>
        </aside>
    </div>
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
              <div class="heading">
                  <h4>Gallery</h4>
              </div>
              <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php echo base_url('backend/gallery'); ?>"> <i class="fa fa-picture-o"></i> Gallery <span class="label label-primary pull-right r-activity"></span></a></li>

                  <li><a href="<?php echo base_url('backend/gallery/gallery_add'); ?>"> <i class="fa fa-plus"></i> Add Gallery <span class="label label-info pull-right r-activity"></span></a></li>

                  <li><a href="<?php echo base_url('backend/gallery/gallery_categories'); ?>"> <i class="fa fa-tag"></i> Gallery Categories <span class="label label-warning pull-right r-activity"></span></a></li>
              </ul>
            </section>
        </aside>
    </div>
    
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
              <div class="heading">
                  <h4>News</h4>
              </div>
              <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php echo base_url('backend/news'); ?>"> <i class="fa fa-bullhorn"></i> News <span class="label label-primary pull-right r-activity"></span></a></li>

                  <li><a href="<?php echo base_url('backend/news/news_add'); ?>"> <i class="fa fa-plus"></i> Add News <span class="label label-info pull-right r-activity"></span></a></li>

              </ul>
            </section>
        </aside>
    </div>
    <div class="col-lg-3">
        <aside class="profile-nav alt green-border">
            <section class="panel">
              <div class="heading">
                  <h4>Faq</h4>
              </div>
              <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php echo base_url('backend/faq'); ?>"> <i class=" fa fa-question"></i> Faq <span class="label label-primary pull-right r-activity"></span></a></li>

                  <li><a href="<?php echo base_url('backend/faq/faq_add'); ?>"> <i class="fa fa-plus"></i> Add Faq <span class="label label-info pull-right r-activity"></span></a></li>

              </ul>
            </section>
        </aside>
    </div> -->
  </div>
</div>