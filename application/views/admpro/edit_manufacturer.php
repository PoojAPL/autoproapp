<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form "  method ="post" id="addManufacture" action="<?php echo adm_base_url();?>/update_manufacture" >
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add Manufacturer</h2>-->
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"> Name</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="hidden" value="<?php echo $manu_id;?>" name="manu_id" />	
         <input type="text" class="form-control" placeholder="Name" name="manufacturer_name" value="<?php echo $getManufacturerInfo[0]['Manufacturer_Name'];?>">
        </div>
      </div>
    </div>   	
     <hr>
    <div class="row">
    <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"></label>
        </div>
      </div>
    <div class="col-md-12">
        <button type="sumit" class="btn btn-primary" name="post">Update</button>
        <a href="<?php echo adm_base_url();?>/manufacturers" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
