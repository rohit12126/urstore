<div class="bread_parent">
  <div class="col-md-11">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url('backend/dashboard');?>"><i class="icon-home"></i> Dashboard  </a></li>  
         <li><b>Top Ads</b></li>
    </ul>
  </div>
  <div class="clearfix"></div> 
    <div class="panel-body" >     
       <div class="clearfix"></div>  
    <div class="adv-table">
       <div class="well">
        <form action="<?php echo base_url('backend/top_ads/') ?>" method="get" accept-charset="utf-8">
          <label class="col-lg-3">
          <input type="text" name="title" value="<?php echo $this->input->get('title'); ?>" class="form-control" placeholder="Search By Tiltle"></label>
          <label class="col-lg-3">
            <select name="status" class="form-control">
            <?php if ($this->input->get('status')=='1' || $this->input->get('status')=='0') { ?>
              <option value="<?php echo $this->input->get('status', TRUE); ?>"><?php if ($this->input->get('status')=='1') {echo 'Publish';} else{echo 'Unpublish';} ?></option><?php }?>
              <option value="">All Status</option>
              <?php if ($this->input->get('status', TRUE) !== '1') { ?>
              <option value="1">Publish</option>
              <?php }?>
              <?php if ($this->input->get('status', TRUE) !== '0') { ?>
              <option value="0">Unpublish</option>
              <?php }?>
            </select>
          </label>
          <label class="col-lg-3">
            <input type="text" class="form-control" id="datepicker1" name="date" value="<?php if($this->input->get('date')){ echo $date=$this->input->get('date'); } ?>" placeholder="select date to search">
          </label>
          <?php
            $ASC= $DESC="";  
            if($this->input->get('order')) {
                if($this->input->get('order')=="DESC"){
                  $DESC='selected';}
                else{
                  $ASC='selected';}
              }
          ?>
          <label>
            <select name="order" class="form-control">
              <option value="" >All </option>              
              <option value="ASC" <?php  echo $ASC; ?>> Rank Sort(1-25) </option>              
              <option value="DESC" <?php  echo $DESC; ?>> Rank Sort(25-1) </option>
            </select>
          </label>
          <label class="search-label">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="<?php echo base_url('backend/top_ads')?>" class="btn btn-danger">Reset</a>
          </label>
        </form>
      </div>
      <form action="<?php echo base_url('backend/changeuserstatus_t_array/0/status/0/top_ads'); ?>" method="post" accept-charset="utf-8">
        <table id="datatable_example" class="responsive table table-striped" >
          <thead class="thead_color">
            <tr>
              <th width="30"> # 
                <input type="checkbox" name="" id="check_all">
                <select name="status_all" id="status_all">
                  <option value="">All Status</option>
                  <option value="1">Publish</option>
                  <option value="0">Unpublish</option>
                </select>
              </th>
              <th> Title <span style="float:right;"></th>
              <th  width="8%">Ranks </th>
              <th  width="15%">Created/Updated</th>
              <th  width="5%">Status</th>
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
                    <td> <?php echo $j ?><input type="checkbox" value="<?php echo $row->id ?>" name="check[]" class="status_check"></td>
                    <td>#<?php echo $row->id ?>  <?php echo $row->title ?></td>
                    <td><?php echo $row->ranks ?></td>
                    <td class="to_hide_phone"><i class="fa fa-calendar"></i> <?php echo date('d M Y,h:i  A',strtotime($row->created_date)); ?><br><?php echo date('d M Y,h:i  A',strtotime($row->updated_date)); ?>
                    </td>
                    <td> 
                      <?php if($row->status==1){ ?>
                      <a class="label label-success label-mini tooltips" href="<?php echo base_url('backend/changeuserstatus_t/'.$row->id.'/'.$row->status.'/0/top_ads')?>"  rel="tooltip" data-placement="top" data-original-title="Click to Unpublish" >Publish</a> 
                      <?php } 
                        else if($row->status==0){ ?><a class="label label-warning label-mini tooltips"  href="<?php echo base_url('backend/changeuserstatus_t/'.$row->id.'/'.$row->status.'/0/top_ads')?>" rel="tooltip" data-placement="top" data-original-title="Click to publish" >Unpublish</a> 
                      <?php } ?>
                    </td>
                    <td class="ms">
                      <a href="<?php echo base_url().'backend/ads_edit/'.$row->id ?>" class="btn btn-primary btn-xs tooltips" rel="tooltip"  data-placement="left" data-original-title="Edit This" >Edit <i class="icon-pencil"></i></a>
                      <a href="<?php echo base_url().'backend/delete_this/'.$row->id.'/top_ads' ?>" class="btn btn-danger btn-xs tooltips" rel="tooltip"  data-placement="top" data-original-title="Delete This" onclick="if(confirm('Are you sure want to delete?')){return true;} else {return false;}" >Delete <i class="icon-trash "></i></a> 
                      <!-- <a href='<?php echo base_url("top/youdetail/".$row->video_id."__".strtotime($row->created_date).""); ?>' class="btn btn-warning btn-xs tooltips" rel="tooltip"  data-placement="bottom" data-original-title="Preview changes" target="_blank">Preview</a> -->
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