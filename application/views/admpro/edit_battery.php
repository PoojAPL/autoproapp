<div class="container-fluid">  
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form" method ="post" action="<?php echo adm_base_url();?>/update_battery" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add New User</h2>-->
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Name</label>
        </div>
      </div>
      <div class="col-sm-10 ">
        <div class="inputcol">
        <input type="hidden" name="batteryId" value="<?php echo $batteryId;?>" />
         <input type="text" class="form-control" placeholder="Battery Name" name="battery_name" value="<?php echo $batteriesInfo[0]['Battery_Name'];?>" >
        </div>
      </div>
    </div>    
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Image Filename</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control"  name="battery_image" value="<?php echo $batteriesInfo[0]['Battery_Image_Url'];?>" > 
          </div>
        </div>
      </div> 
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Products</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Products" name="products" value="<?php echo $batteriesInfo[0]['Products'];?>" >
          </div>
        </div>
      </div> 
    <hr>
     <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">&nbsp;</label>
        </div>
      </div>
      <div class="col-sm-10 ">
        <div class="inputcol">
          <button type="sumit" class="btn btn-primary" name="post">Submit</button>
          <a href="<?php echo adm_base_url();?>/batteries" class="btn btn-danger">Cancel</a>
        </div>
      </div>
    </div>
   </form>
  </div>
  </div>
</div>
