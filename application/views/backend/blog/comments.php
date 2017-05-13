<div class="bread_parent">
  <div class="col-md-12">
  <ul class="breadcrumb">
      <li><a href="<?php echo base_url('backend/dashboard');?>"><i class="icon-home"></i> Dashboard  </a></li>  
       <li><a href="<?php echo base_url('blogs/');?>"><b>Blog</b></a></li>
       <li><b>Comments</b></li>
      <a class="btn btn-primary tooltips category_add" href="<?php echo base_url('blogs/Comment_add');?>" id="add" data-original-title="Click to add the New Comment"><i class="icon-plus"> Add Comment &nbsp;</i></a>
  </ul>
  </div>
  <div class="clearfix"></div> 
    <div class="panel-body" >     
       <div class="clearfix"></div>  
    <div class="adv-table">
      <div class="well">
        <form action="<?php current_url() ?>" method="get" accept-charset="utf-8">
          <label class="col-lg-3">
          <?php if ($blogs) { ?>
          <select name="search" class="form-control">
          <?php if ($this->input->get('search', TRUE)) { ?>
            <option value="<?php echo $this->input->get('search', TRUE); ?>"><?php if ($this->input->get('search', TRUE)) { echo blog_name($this->input->get('search', TRUE))->blog_title; }  ?></option>
          <?php }?>
            <option value="">All Blogs</option>
          <?php  foreach ($blogs as $row1) {
            if ($this->input->get('search', TRUE) !== $row1->id) {?>
            <option value="<?php echo $row1->id; ?>"><?php echo $row1->blog_title; ?></option>
            <?php } } }?>
          </select>
          </label>
          <label class="search-label">
          <button type="submit" class="btn btn-primary">Search</button>
          <a href="<?php echo base_url('blogs/comments') ?>" class="btn btn-danger">Reset</a>
          </label>
        </form>
      </div>
      <table id="datatable_example" class="responsive table table-striped" >
        <thead class="thead_color">
          <tr>
            <th  width="2%">#</th>
            <th  width="13%">User Name</th>
            <th  width="12%">Email</th>
            <th  >Comment</th>
            <th  width="10%">Blog</th>  
            <th  width="5%">Status</th>
            <th  width="17%">Created</th>
            <th width="8%">Actions</th>
          </tr>
        </thead>
          <?php  
          if(!empty($comments)):
            $j=$offset+1;
            foreach($comments as $row): 
          ?>
            <tbody>
            <tr>
                <td><?php echo $j ?></td>
                <td><?php echo $row->user_login ?></td>
                <td><?php echo $row->user_email ?></td>
                <td><?php echo $row->comment ?></td>
                <td><?php echo $row->blog_title ?>
                </td>
                <td> 
                <?php if($row->status==1){ ?>
                <a class="label label-success label-mini tooltips" href="<?php echo base_url('blogs/changeuserstatus_t/'.$row->id.'/'.$row->status.'/0/comments')?>"  rel="tooltip" data-placement="top" data-original-title="Click to Unpublish" >Publish</a> 
                <?php } 
                else if($row->status==0){ ?><a class="label label-warning label-mini tooltips"  href="<?php echo base_url('blogs/changeuserstatus_t/'.$row->id.'/'.$row->status.'/0/comments')?>" rel="tooltip" data-placement="top" data-original-title="Click to publish" >Unpublish</a> 
                <?php } ?>
                </td>
                <td class="to_hide_phone"><i class="fa fa-calendar"></i> <?php echo date('d M Y,h:i  A',strtotime($row->created)); ?></td>
                <td class="ms">
                    <a href="<?php echo base_url().'blogs/comment_edit/'.$row->id ?>" class="btn btn-primary btn-xs tooltips" rel="tooltip"  data-placement="left" data-original-title="Edit This Comment" > <i class="icon-pencil"></i></a>
                    <a href="<?php echo base_url().'blogs/comment_delete/'.$row->id ?>" class="btn btn-danger btn-xs tooltips" rel="tooltip"  data-placement="top" data-original-title="Delete <?php if(!empty($row->user_name)) echo $row->user_name; ?> Comment" onclick="if(confirm('Are you sure want to delete?')){return true;} else {return false;}" > <i class="icon-trash "></i></a> 
                </td>
              </tr> 
            </tbody> 
          <?php $j++;  endforeach; ?>
        <?php else: ?>
          <tr>
           <th colspan="6" class="msg"> <center>No Comment found.</center></th>
          </tr>
        <?php endif; ?> 
    </table>
    </div> 
  </div> 
</div> 
<?php echo $pagination;?>
<script>
   $("#tab1 #checkAll").click(function () {
        if ($("#tab1 #checkAll").is(':checked')) {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#tab1 input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
</script>

