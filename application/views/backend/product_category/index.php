<div class="page-content-wrapper">
  <div class="col-md-12">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url('backend/dashboard');?>"><i class="icon-home"></i> Dashboard  </a></li>  
         <li><b>Post Category</b></li>
		 	
		<a href="#" class="btn btn-danger delete_btn category_add" rel="tooltip" data-placement="bottom" data-original-title="Remove" id="delete_btn" disabled="1" onclick="if(confirm('Are you sure want to delete?')){return true;} else {return false;}" delurl="">Delete <i class="icon-trash "></i></a>
		<a href="javascript:void(0)" class="btn btn-primary  yellow category_add" id="sub_cat" disabled="1"> Add Sub category <i class="icon-plus"></i> </a>
		 <a href="javascript:void(0)" class="btn  btn-primary yellow category_add" id="root_cat"> Add Main category <i class="icon-plus"></i> </a>
    </ul>

  </div>
  <div class="clearfix"></div> 
	<div class="page-content">
		
		<div class="row">
			<div class="col-md-12">
				<?php // echo msg_alert_backend(); 
					//echo msg_alert_front();
				?>
				<!-- BEGIN SAMPLE TABLE PORTLET-->
				<div class="portlet box green">
					<!-- categories add start  -->
					<div class="col-md-12 portlet-body">
							<?php
							$result=$category;
							$category = array(
								'categories' => array(),
								'parent_cats' => array()
							);
		       		//build the array lists with data from the category table
							if (!empty($result)) 
							{
								foreach ($result as $row) 
								{
									$category['categories'][$row->id] = $row;
									$category['parent_cats'][$row->parent_id][] = $row->id;
								}
							}
			        ?>
			        	<div class="col-xs-12 col-sm-4 col-md-4">
					        <div class="u-vmenu pro_cate_list">
						        <?php
											echo buildCategory(0, $category);
										?>
									</div>
								</div>
								<div class="col-md-8" style="border-left: #1ABC9C 1px solid;">
                  <form  method="post" action=""  class="form-horizontal" enctype="multipart/form-data" id="form_valid">
                    <input type="hidden" name="action_type" value="0">
                    <input type="hidden" name="sort_order" value="0">
                    <input type="hidden" name="cat_id" value="">
                    <div class="form-body">
                      <div class="form-group">
                        <label class="col-md-6 control-label main-title" style="color:#1ABC9C;"> <i class="icon-plus"></i> Add Main category </label>
                      </div>
										  <div class="form-group">
												<label class="col-md-3 control-label">Name<small class="error">*</small></label>
												<div class="col-md-9">
													<input value="<?php echo set_value('category_name');?>" name="category_name" data-bvalidator="required" data-bvalidator-msg="Category name required" type="text" placeholder="Enter Name" class="form-control">
												    <?php echo form_error('category_name'); ?> 
												</div>
											</div>
											<div class="form-group">
									            <label class=" control-label col-md-3">Description <span class="mandatory">*</span></label>
									            <div class="col-md-9">
									              <textarea class="form-control" placeholder="Description" data-bvalidator="required" id="description" data-bvalidator-msg="Category Description required" name="description"><?php echo set_value('description'); ?></textarea>
									              <?php echo form_error('description'); ?> 
									            </div>  
									        </div>  	
											
											<input value="<?php echo set_value('parent_id');?>" name="parent_id" type="hidden" class="form-control" id="parent_id">
		                  <div class="form-group">
												<label class="col-md-3 control-label">Status</label>
												<div class="col-md-9">
		                      <select name="status" class="form-control">
														<option value="1">Active</option>
														<option value="0">Inactive</option>
													</select>
												</div>
											</div>
								
											
										</div>
										<div class="form-actions">
											<div class="row">
												<div class="col-md-offset-3 col-md-9">
													<input class="btn green" type="submit" name="add_and_new" value="Save">
												</div>
											</div>
										</div>
									</form>
								</div>
							<!-- categories add finish  -->
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $(".u-vmenu").vmenuModule({
      Speed: 200,
      autostart: false,
      autohide: true
    });
    $(".categories").click(function(e) 
    {
      $(".categories").removeClass('active');
      $('#load_modal').modal('show');
      $(this).addClass('active');
      var cat_id=$(this).prop('id');
      $.ajax({
        url: '<?php echo base_url("blog_category/get_categories_data/"); ?>',
        type: 'POST',
        data: {id: cat_id},
      })
      .done(function(data,response) {
        obj = JSON.parse(data);
        //alert(obj.id);
        $(".main-title").html(" <i class='fa fa-edit'></i> Edit category <b>"+ obj.category_name +" </b> ");
        $("input[name='cat_id']").val(obj.id);
        $("input[name='action_type']").val('1');
        $("input[name='sort_order']").val(obj.sort_order);
		
		if(parseInt(obj.sort_order)<3)
		{
			$("#sub_cat").show();
			$("#sub_cat").removeAttr('disabled');
		}else{
			
			$("#sub_cat").prop('disabled', false);
			$("#sub_cat").hide();
		//	$("#sub_cat").Attr('disabled', false);  
		}
        
        $("#delete_btn").attr('href','<?php echo base_url("blog_category/delete"); ?>/'+obj.id+'/1').removeAttr('disabled');
        $("input[name='category_name']").val(obj.category_name);
        $("#parent_id").val(obj.parent_id);
        $("#description").val(obj.description);
        $("select[name='status']").val(obj.status);
        setTimeout(function(){
          $('#load_modal').modal('hide');
        }, 1000);
      })
      .fail(function() 
      {
        alert("error");
      });
    });
    $("#root_cat").click(function(event) 
    {
      //$("#loading").show();
			$(".categories").removeClass('active');
			$(".main-title").html(" <i class='icon-plus'></i> Add Main category ");
			$('#load_modal').modal('show');
			$("input[name='action_type']").val('0');
			$("#delete_btn").attr('disabled','disabled');
			$("input[type='text']").val('');
			$("#description").val('');
			$("#parent_id").val('0');
			$("input[name='sort_order']").val(0);
			$("#sub_cat").attr('disabled','disabled');
			$('#load_modal').modal('hide');
    });
    $("#sub_cat").click(function(event) 
    {
			parent_cat=$("input[name='cat_id']").val();
			parent_cat_name=$("input[name='category_name']").val();
			sort_order=$("input[name='sort_order']").val();
			$(".main-title").html(" <i class='icon-plus'></i> Add Sub category of <b>"+parent_cat_name+" </b> ");
			$('#load_modal').modal('show');
			$("input[name='action_type']").val('0');
			//alert(obj.sort_order);
			$("input[name='sort_order']").val(++sort_order);
			$("#delete_btn").attr('disabled','disabled');
			$("#description").val('');
			$("input[name='category_name']").val('');
			$("#parent_id").val(parent_cat);
			$("#sub_cat").attr('disabled','disabled');
			$('#load_modal').modal('hide');
    });
  });
</script>
<!-- END CONTAINER -- >