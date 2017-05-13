
<div class="bread_parent"> 
  <div class="col-md-12">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url('backend/dashboard');?>"><i class="icon-home"></i> Dashboard  </a></li>  
         <li><b>Posts</b></li>
          <a class="btn btn-primary tooltips category_add" href="<?php echo base_url('posts/post_add');?>" id="add" data-original-title="Click to add the New Post"><i class="icon-plus"> Add Post &nbsp;</i>
      </a>
    
    </ul>
  </div>
 
  <div class="clearfix"></div> 
    <div class="panel-body" >            
    <div class="adv-table">
       <div class="well">
        <form action="<?php current_url() ?>" method="get" accept-charset="utf-8">
          <label class="col-lg-3">
          <input type="text" name="title" value="<?php echo $this->input->get('title'); ?>" class="form-control" placeholder="Search By Post Tiltle"></label>
          <label class="col-lg-4">
            <?php if ($category) { ?>
            <select name="search" id="search"  class="form-control">
             <option value="">Select category</option>
            <?php  foreach ($category as $cat) {
             ?>
            <option value="<?php echo $cat['id']; ?>" <?php if ($this->input->get('search', TRUE) ==$cat['id']) { echo 'selected';} ?> ><?php echo $cat['category_name']; ?></option>
							<?php $subcategory=sub_category($cat['id']);
									if(!empty($subcategory)){ 
									foreach($subcategory as $sub){ 
							?> 
									<option value="<?php echo $sub['id']; ?>" <?php if ($this->input->get('search', TRUE) == $sub['id']) { echo 'selected';} ?> >&nbsp;&nbsp;  <?php echo $sub['category_name']; ?></option>
												<?php $subcategory2=sub_category($sub['id']);
													if(!empty($subcategory2)){
													 foreach($subcategory2 as $sub2)
													{	
												?>
													<option value="<?php echo $sub2['id']; ?>" <?php if ($this->input->get('search', TRUE) == $sub2['id']) { echo 'selected';} ?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     <?php echo $sub2['category_name']; ?></option>
															<?php $subcategory3=sub_category($sub2['id']);
																  if(!empty($subcategory3)){
																	  foreach($subcategory3 as $sub3)
                                                                          { 
															 ?>
																	<option value="<?php echo $sub3['id']; ?>" <?php if ($this->input->get('search', TRUE) == $sub3['id']) { echo 'selected';} ?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   <?php echo $sub3['category_name']; ?></option>
															<?php } } ?>
												<?php } } ?>
									
									
							<?php } }?>
			
			
            <?php } ?>
             <?php } ?>
            </select> 
			</label>
          <?php /*
           <label class="col-lg-2">
            <select name="subcategory" id="subcategory" <?php if(empty($subcategory)) { ?> disabled <?php } ?> class="form-control" title="Please select main category">
             <option value="">All Sub Categories</option>
            <?php  foreach ($subcategory as $row1) {
             ?>
            <option value="<?php echo $row1['id']; ?>" <?php if ($this->input->get('subcategory', TRUE) == $row1['id']) { echo 'selected';} ?> ><?php echo $row1['category_name']; ?></option>
            <?php } ?>
            </select>
          </label> */ ?>
          <label class="col-lg-2">
            <select name="status" class="form-control">
			 <option value="">All Status</option>
			 <option value="1" <?php if ($this->input->get('status')=='1' )echo 'selected'; ?>>Publish</option>
			  <option value="0" <?php if ($this->input->get('status')=='0' )echo 'selected'; ?>>Unpublish</option>
            </select>
          </label>
          <label >
            <select name="order" class="form-control">
               <option value="DESC" <?php if ($this->input->get('order')== 'DESC') { echo 'selected';} ?>>DESC</option>
               <option value="ASC" <?php if ($this->input->get('order')== 'ASC') { echo 'selected';} ?>>>ASC</option>
            </select>
          </label>
          <label class="search-label">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="<?php echo base_url('blogs')?>" class="btn btn-danger">Reset</a>
          </label>
        </form>
      </div>
      <form action="" method="post">
      <table id="datatable_example" class="responsive table table-striped" >
        <thead class="thead_color">
          <tr>
            <th># </th>
            <th>Post Title & Categories </th>
        <!-- <th  width="5%">Comments</th> -->
		      <!--	<th  width="10%">Order Number</th> -->
            <th  width="16%">Created</th>
			
            <th  width="5%">Status</th>
            <th width="130">Actions</th>
          </tr>
        </thead>
          <?php  
          if(!empty($blogs)):
            $j=$offset+1; 
          foreach($blogs as $row): 
          ?>
           <tbody>
            <tr>
                <td><?php echo $j ?></td>
                <td>#<?php echo $row->id ?>  <?php echo $row->blog_title ?><br>
                   Categories- <?php if($row->blog_category)
                      {
                        if($category_array=explode(',',$row->blog_category)){
                          $i=0;
                          foreach ($category_array as $value) {
                            if($category_info=categorys_name($value)){
                              if($i)
                              {
                                echo', ';
                              }
                              $i++;
                              echo ucfirst($category_info->category_name);
                            }
                          }
                        }
                      } ?></td>
                <!--<td><a href="<?php //echo base_url('blogs/comments?search='.$row->id) ?>"><?php //echo count_comments($row->id); ?></a></td>-->
			       <!--	<td><input type="number" style="width: 40px;" min="0" value="<?php echo $row->order_number; ?>" name="order_number[]" >
                <input type="hidden" style="width: 70px;" value="<?php echo $row->id; ?>" name="id[]" >  
              </td>-->

                <td class="to_hide_phone"><i class="fa fa-calendar"></i> <?php echo date('d M Y',strtotime($row->created)); ?></td> 
                <td> 
                <?php if($row->status==1){ ?>
                <a class="label label-success label-mini tooltips" href="<?php echo base_url('posts/changeuserstatus_t/'.$row->id.'/'.$row->status.'/0/blogs')?>"  rel="tooltip" data-placement="top" data-original-title="Click to Unpublish" >Publish</a> 
                <?php } 
                else if($row->status==0){ ?><a class="label label-warning label-mini tooltips"  href="<?php echo base_url('posts/changeuserstatus_t/'.$row->id.'/'.$row->status.'/0/blogs')?>" rel="tooltip" data-placement="top" data-original-title="Click to publish" >Unpublish</a> 
                <?php } ?>
                </td>
                <td class="ms">
                    <a href="<?php echo base_url().'posts/post_edit/'.$row->id ?>" class="btn btn-primary btn-xs tooltips" rel="tooltip"  data-placement="left" data-original-title="Edit This Post" > <i class="icon-pencil"></i></a>
                    <a href="<?php echo base_url().'posts/post_delete/'.$row->id ?>" class="btn btn-danger btn-xs tooltips" rel="tooltip"  data-placement="top" data-original-title="Delete This Post" onclick="if(confirm('Are you sure want to delete?')){return true;} else {return false;}" ><i class="icon-trash "></i></a> 
                </td>
              </tr> 
            </tbody> 
          <?php $j++;  endforeach; ?>
        <?php else: ?>
          <tr>
           <th colspan="6" class="msg"> <center>No Post Found.</center></th>
          </tr>
        <?php endif; ?> 
    </table>
    <!--<button type="submit" class="btn btn-primary pull-right tooltips" rel="tooltip" data-placement="top" data-original-title="Update All Post Order Number">
           <i class="fa fa-repeat"></i>Update All Post Order Number</button>-->
     </form>      
    </div> 
  </div> 
</div> 
<?php echo $pagination;?>
<script>
  
      jQuery("#search").change(function(){
           var id=$('#search').val();
		//   $( "#subcategory" ).attr( "disabled", true );
		   $("#subcategory").removeAttr('disabled');
             jQuery.ajax({
                      type: "POST",
                      url: "<?php echo base_url('Posts/getAllsubCategoryAjax') ?>",
                      data: {'cat_id':id},                    
                      success: function(result)
                      {
                          var data=jQuery.parseJSON(result);  
                          var text="<option value=''>Select Sub Category</option>";
                          for(var i=0;i<data.length;i++) 
                          {
                            text+='<option value="'+data[i]['id']+'">'+data[i]['category_name']+'</option>';
                          }
                          $('#subcategory').html(text);
						  
                      } 
                   });   
          
        });

</script>
