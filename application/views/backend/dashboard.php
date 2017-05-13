
<div class="row state-overview">
  <div class="col-lg-3 col-sm-6">
      	 <a href="<?php echo base_url('post_category'); ?>">
      <section class="panel">
          <div class="symbol terques">
              <i class="fa fa-tasks"></i>
          </div>
          <div class="value">
              <h1 class=""><?php echo $this->db->where('parent_id',0)->count_all_results('product_category'); ?></h1>
              <p>Main Categories</p>
          </div>
      </section>
      </a>
  </div>
   <div class="col-lg-3 col-sm-6">
         <a href="<?php echo base_url('post_category'); ?>">
      <section class="panel">
          <div class="symbol terques">
              <i class="fa fa-tasks"></i>
          </div>
          <div class="value">
              <h1 class=""><?php echo $this->db->where('parent_id!=',0)->count_all_results('product_category'); ?></h1>
              <p>All sub categories</p>
          </div>
      </section>
      </a>
  </div>
  <div class="col-lg-3 col-sm-6">
      <a href="<?php echo base_url('posts'); ?>"><section class="panel">
          <div class="symbol yellow">
              <i class="fa fa-tasks"></i>
          </div>
          <div class="value">
              <h1 class=" "><?php echo $this->db->count_all_results('blogs'); ?></h1>
              <p>Wiki Posts</p>
          </div>
      </section></a>
  </div>
 <?php /* <div class="col-lg-3 col-sm-6">
       <a href="<?php echo base_url('blogs/comments'); ?>"><section class="panel">
          <div class="symbol blue">
             <i class="fa fa-comments-o"></i>
          </div>
          <div class="value">
              <h1 class=" "><?php echo $this->db->count_all_results('comments'); ?></h1>
              <p>Comments</p>
          </div>
      </section></a>
  </div> */ ?>
</div>
