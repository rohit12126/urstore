<div class="bread_parent">
  <div class="col-md-12">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url('backend/dashboard');?>"><i class="icon-home"></i> Dashboard  </a></li>  
         <li><b>Sub Categories</b></li>
     <button type="button" class="btn btn-primary category_add" data-toggle="modal" data-target="#addcategory"><i class="icon-plus"></i> Add Sub Category</button>
    </ul>

  </div>
  <div class="clearfix"></div> 
    <div class="panel-body" >     
       <div class="clearfix"></div>  
    <div class="adv-table">
       <div class="well">
        <form action="<?php echo base_url('category/subcategory') ?>" method="get" accept-charset="utf-8">
          <label class="col-lg-3">
            <select class="form-control category_id" id="category_id" name="category_id" >
                   <option value="">Select category</option>
                   <?php
                    foreach($category as $cat)
                    {
                       echo '<option value="'.$cat['id'].'"';
                       if($this->input->get('category_id')==$cat['id']) 
                          echo 'selected';
                       echo '>'.$cat['category_name'].'</option>';
                    } 
                   ?>
            </select>
          </label> 
          <label class="col-lg-3">
          <input type="text" name="name" value="<?php echo $this->input->get('name'); ?>" class="form-control" placeholder="Search By Sub Category"></label>
          
        
          <label class="search-label">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="<?php echo base_url('category/subcategory')?>" class="btn btn-danger">Reset</a>
          </label>
          
        </form>
      </div>
      <form action="<?php echo base_url('backend/changeuserstatus_t_array/0/status/0/top_ads'); ?>" method="post" accept-charset="utf-8">
        <table id="datatable_example" class="responsive table table-striped" >
          <thead class="thead_color">
            <tr>
              <th width="30"> # 
                 </th>
              <th> Sub Category Name <span style="float:right;"></th>
               <th>Parent Category Name <span style="float:right;"></th>
              <th> Status <span style="float:right;"></th>
              <th width="180">Actions</th>
            </tr>
          </thead>
            <?php  
            if(!empty($data)):
              $j=$offset+1; 
            foreach($data as $row): 
            ?>
                <tbody>
                  <tr>
                    <td> <?php echo $j ?></td>
                    <td><?php echo $row->category_name ?> </td>
                    <td><?php echo subcategory_name($row->category_id) ?> </td>
                    <td> 
                      <?php if($row->sub_status==0){ ?>
                      <a class="label label-success label-mini tooltips" href="<?php echo base_url('category/changeuserstatus_t/'.$row->id.'/sub_status/1/category')?>"  rel="tooltip" data-placement="top" data-original-title="Click to deactive" >Active</a> 
                      <?php } 
                        else if($row->sub_status==1){ ?><a class="label label-warning label-mini tooltips"  href="<?php echo base_url('category/changeuserstatus_t/'.$row->id.'/sub_status/0/category')?>" rel="tooltip" data-placement="top" data-original-title="Click to active" >Deactive</a> 
                      <?php } ?>
                    </td>
                    <td class="ms">
                       <button type="button" substatus="<?php echo $row->sub_status; ?>" maincategory="<?php echo $row->category_id; ?>" main="<?php echo $row->id ?>" name="<?php echo $row->category_name ?>" class="btn btn-primary btn-x  tooltips category_edit" data-toggle="modal" data-target="#editcategory" data-placement="left" data-original-title="Edit This" ><i class="icon-pencil"></i></button>
                      <a href="<?php echo base_url().'category/delete/'.$row->id ?>" class="btn btn-danger btn-xs tooltips" rel="tooltip"  data-placement="top" data-original-title="Delete This" onclick="if(confirm('Are you sure want to delete?')){return true;} else {return false;}" > <i class="icon-trash "></i></a> 
                    </td>
                  </tr> 
                </tbody> 
            <?php $j++;  endforeach; ?>
          <?php else: ?>
            <tr>
             <th colspan="6" class="msg"> <center>No Data Found.</center></th>
            </tr>
          <?php endif; ?> 
        </table>
      </form>
    </div> 
  </div> 
</div> 
<?php echo $pagination;?>
<!-- add category -->
<div class="modal fade" id="addcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Sub Categories</h4>
      </div>
      <form action="<?php echo base_url('category/insert') ?>" method="post" id="addcategory_form">
       <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="control-label">Category <span class="mandatory">*</span></label>
            <select class="form-control" id="category_id" name="category_id" >
            <option value="">Select category</option>
            <?php
            foreach($category as $cat)
            {
              echo '<option value="'.$cat['id'].'">'.$cat['category_name'].'</option>';
            } 
            ?>
            </select>
          </div>
          <div class="form-group">
              <label for="recipient-name" class="control-label">Name <span class="mandatory">*</span></label>
              <input type="text" class="form-control" id="category_name" name="category_name" >
             <p style="display:none;color:red;" id="category_error">Sub Category name already exists</p>
          </div>
          <div class="form-group">
              <label for="recipient-name" class="control-label">Status <span class="mandatory">*</span></label><br>
              <input type="radio" class="" checked="checked" value="0" id="sub_status" name="sub_status" >Active
              <input type="radio" class="" value="1" id="sub_status" name="sub_status" >Deactive
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-remove"></i> Close</button>
        <button type="submit" class="btn btn-primary">Add Sub Category</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- edit category -->
<div class="modal fade" id="editcategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Sub Category</h4>
      </div>
      <form action="<?php echo base_url('category/edit') ?>" method="post" id="editcategory_form">
      <div class="modal-body">
          <div class="form-group">
              <label for="recipient-name" class="control-label">Category <span class="mandatory">*</span></label>
              <select class="form-control category_id" id="category_id" name="category_id" >
                   <option value="">Select category</option>
                   <?php
                    foreach($category as $cat)
                    {
                       echo '<option value="'.$cat['id'].'">'.$cat['category_name'].'</option>';
                    } 
                   ?>
            </select>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Name <span class="mandatory">*</span></label>
            <input type="text" class="form-control categoryedit" id="category_name" name="category_name" >
            <input type="hidden" class="form-control categoryid" id="id" name="id" >
            <p style="display:none;color:red;" id="category_errors">Sub Category name already exists</p>
          </div>
          <div class="form-group">
              <label for="recipient-name" class="control-label">Status <span class="mandatory">*</span></label><br>
              <input type="radio" class="sub_status0 sub_status" value="0" id="sub_status" name="sub_status" >Active
              <input type="radio" class="sub_status1 sub_status" value="1" id="sub_status" name="sub_status" >Deactive
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="icon-remove"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Update Category</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
 jQuery(document).ready(function(){
    jQuery('.category_edit').click(function(){
      jQuery('.categoryedit').val(jQuery(this).attr('name'));
      jQuery('.categoryid').val(jQuery(this).attr('main')); 
      jQuery('.category_id').val(jQuery(this).attr('maincategory'));
       $('.sub_status').prop('checked', false);
      if(parseInt(jQuery(this).attr('substatus'))===0)
      {
        $('.sub_status0').prop('checked', true); // Checks it
       // Unchecks it
      }else{    
        $('.sub_status1').prop('checked', true); // Checks it
         // Unchecks it
      }
    });

 })
      jQuery("#addcategory_form").validate({
            rules: {
                category_name: "required",
                category_id: "required",
            },
            submitHandler: function() {
                    $('#category_error').hide();
                    var form_data = new FormData(jQuery('#addcategory_form')[0]);
                   jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url('category/checkcategory') ?>",
                            data: form_data,                    
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function()
                            {
                                jQuery('.loading_countrygif').show();
                            }, 
                            success: function(result)
                            {
                                if(result=='ok')
                                {
                                     $('#category_error').hide();
                                    $( "#addcategory_form" )[0].submit();
                                }else{
                                    $('#category_error').show();
                                }

                            } 
                         });   
            }
        });
          jQuery("#editcategory_form").validate({
            rules: {
                category_name: "required",
                category_id: "required",
            },
            submitHandler: function() {
                    $('#category_errors').hide();
                    var form_data = new FormData(jQuery('#editcategory_form')[0]);
                   jQuery.ajax({
                            type: "POST",
                            url: "<?php echo base_url('category/checkcategory') ?>",
                            data: form_data,                    
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function()
                            {
                                jQuery('.loading_countrygif').show();
                            }, 
                            success: function(result)
                            {
                                if(result=='ok')
                                {
                                     $('#category_errors').hide();
                                    $( "#editcategory_form" )[0].submit();
                                }else{
                                    $('#category_errors').show();
                                }

                            } 
                         });   
            }
        });
</script>