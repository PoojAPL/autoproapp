<div class="container-fluid">  
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form" method ="post" id="add_key" action="<?php echo adm_base_url();?>/vehicles/update_vehicle_type" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add New User</h2>-->
    <input type="hidden" class="form-control" placeholder="UUID" name="uuid" id= "uuid" value="<?php echo md5(uniqid(mt_rand(), true));?>">
    <div class="row">
      <div class="col-sm-2">
        <div class="labelcol">
          <label class="control-label">Type</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="hidden" value="<?php echo $id?>" name="id"  />	
         <input type="text" class="form-control" placeholder="Vehicle Type" name="type" value="<?php echo $vehicle_types_info[0]['type']?>">
        </div>
      </div>
    </div> 
        
    <hr>
     <div class="row">
      <div class="col-sm-2">
        <div class="labelcol">
          <label class="control-label">&nbsp;</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
          <button type="sumit" class="btn btn-success" name="post">Submit</button>
          <a href="<?php echo adm_base_url();?>/vehicles/vehicle_types" class="btn btn-danger">Cancel</a>
        </div>
      </div>
    </div>
   </form>
  </div>
  </div>
</div>
