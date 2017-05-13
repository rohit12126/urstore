  <?php if(form_error('tag_title_edit[]')|| form_error('order_by_edit[]')){?>
  <div class="alert alert-danger">
   <button type="button" class="close" data-dismiss="alert">&times;</button> 
  <?php echo form_error('tag_title_edit[]'); ?> 
  <?php echo form_error('order_by_edit[]'); ?> 
  </div>
<?php } ?>

<?php $offset =0; ?>
<div class="bread_parent">
<div class="col-md-12">
<ul class="breadcrumb">
    <li><a href="<?php echo base_url('backend');?>"><i class="icon-home"></i> Dashboard  </a></li>
    <li><a href="<?php echo base_url('blogs/');?>"><b>Blog</b></a></li>  
    <li><b>Blog Tags</b></a></li>
  <a class="btn btn-primary btn-toggle-link tooltips category_add" main="0" id="add" data-original-title="Click to add the Blog Tag">
        Add Blog Tag &nbsp;<i id="iconadd" class="fa fa-chevron-down"></i>
    </a>
</ul>
</div>
<script>
  jQuery('#add').click(function(){
      var type=$(this).attr('main');
      if(parseInt(type)===0){
         $('#form').show();
         $(this).attr('main','1'); 
         $('#iconadd').attr('class','fa fa-chevron-up');  
      }else{
        $('#form').hide();
         $(this).attr('main','0'); 
         $('#iconadd').attr('class','fa fa-chevron-down'); 
      }
     
  });


</script>
<!-- fa fa-chevron-up
 <div class="col-md-1">
  <div class="btn-group pull-right" >
    <a class="btn btn-primary btn-toggle-link tooltips" id="add" data-original-title="Click to add the Blog Tag">
        Add Blog Tag &nbsp;<i class="fa fa-chevron-down"></i>
    </a>
  </div>
</div> -->
<div class="clearfix"></div>
</div>
<div id="tab1">
  <div class="panel-body div_border toggle-inner-panel" id="form" style="<?php if(isset($_POST['add'])) echo"display:block"; else ?>display:none;">   
   <div class="col-md-12 no-padding" >   
      <form role="form" class="form-horizontal tasi-form" name="frm1" action="<?php echo current_url()?>" enctype="multipart/form-data" method="post" id="form_valid">
      <input type="hidden" name="type_action" value="1">
          <div class="form-body">
            <div class="form-group">
              <div class="col-md-3">
                <input type="text" placeholder="Blog Tag Title" class="form-control" name="tag_title" value="<?php echo set_value('tag_title');?>" data-bvalidator="required" data-bvalidator-msg="Blog Tag Title is required"><?php echo form_error('tag_title'); ?>
               </div>
               <div class="col-md-3" id="input_field_to_search">
                <input type="number"  min='1' placeholder="Arrange order No" class="form-control" name="order_by" value="<?php echo set_value('order_by');?>" data-bvalidator="number,required" data-bvalidator-msg="Order No is required and must be a number"><?php echo form_error('order_by'); ?>
               </div>
                <button  class="btn btn-primary" name="add" type="submit"><i class="icon-plus"></i> Add Tags</button>
            </div>           
          </div>          
          </form>
         </div>
          <!-- END FORM--> 
        </div>
        <br>
         <!--table -->
   
  <div class="panel-body" >     
     <div class="clearfix"></div>  
  <div class="adv-table">
    <table id="datatable_example" class="responsive table table-striped" >
      <thead class="thead_color">
        <tr>

          <th width="5%"># </th>
          <th >Blog Tag Title</th>
          <th  width="10%">Order By</th>
          <th  width="8%">Status</th>
          <th  width="18%">Created</th>
          <th width="10%">Actions</th>
        </tr>
      </thead>
         <form action="<?php echo current_url() ?>" method="post">
        <?php  
        if(!empty($blog_tags)):
          $i=0; foreach($blog_tags as $row): 
        $i++;?>
         <tbody>
        <input type="hidden" name="type_action" value="2">
        <tr>
          <td><?php echo '# '.$i; ?></td>
          <td>
          <div class="col-md-15">
            <input class="form-control" type="text" name="tag_title_edit[]" value="<?php if(!empty($row->tag_title)) echo $row->tag_title; ?>"/>
          </div>
          </td>
          <td>
          <div class="col-md-15">
            <input type="hidden" name="main_id[]" value="<?php echo $row->id ?>">
            <input class="form-control" type="number" min="1" name="order_by_edit[]" value="<?php if(!empty($row->order_by)) echo $row->order_by; ?>"/>
          </div>
          </td>
          <td> 
            <?php if($row->status==1){ ?>
            <a class="label label-success label-mini tooltips" href="<?php echo base_url('backend/superadmin/changeuserstatus_t/'.$row->id.'/'.$row->status.'/0/blog_tags')?>"  rel="tooltip" data-placement="top" data-original-title="Click to Unpublish" >Publish</a> 
            <?php } 
            else if($row->status==0){ ?><a class="label label-warning label-mini tooltips"  href="<?php echo base_url('backend/superadmin/changeuserstatus_t/'.$row->id.'/'.$row->status.'/0/blog_tags')?>" rel="tooltip" data-placement="top" data-original-title="Click to publish" >Unpublish</a> 
            <?php } ?>
          </td>
          <td class="to_hide_phone">
            <i class="fa fa-calendar"></i> <?php echo date('d M Y,h:i  A',strtotime($row->created)); ?>
          </td> 
          <td class="ms">
            <a href="<?php echo base_url().'blogs/blog_tag_delete/'.$row->id ?>" class="btn btn-danger btn-xs tooltips" rel="tooltip"  data-placement="top" data-original-title="Delete <?php if(!empty($row->tag_title)) echo $row->tag_title; ?> Tag" onclick="if(confirm('Are you sure want to delete?')){return true;} else {return false;}" > Delete <i class="icon-trash "></i></a> 
            </td>
          </tr> 
        </tbody> 
        <?php  endforeach; ?>
         <tr><td colspan="8"><button type="submit" class="btn btn-primary pull-right tooltips"  rel="tooltip"  data-placement="top" data-original-title="Update the Blog Tags and there order sequences"> <i class="fa fa-repeat"></i> Upadate Tags</button></td></tr>
          </form> 
      <?php else: ?>
        <tr>
         <th colspan="6" class="msg"> <center>No Blog Tag Found.</center></th>
        </tr>
      <?php endif; ?> 
   
  </table>
  </div> 
</div> 
</div> 