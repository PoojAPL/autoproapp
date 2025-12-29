<div class="container-fluid">  
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form" method ="post" id="add_images" action="<?php echo adm_base_url();?>/save_image" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add New User</h2>-->
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Filename</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="file" class="form-control" name="Filename" >
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Image Type</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <select class="form-control" name="Image_Type_UUID" >
         	<option value="">Select image type</option>
            <?php foreach($image_types as $type){?>
            	<option value="<?php echo $type['UUID'];?>"><?php echo $type['Name'];?></option>
            <?php } ?>
         </select>
        </div>
      </div>
    </div>        
    <hr>
     <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">&nbsp;</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
          <button type="sumit" class="btn btn-success" name="post">Submit</button>
          <a href="<?php echo adm_base_url();?>/images" class="btn btn-danger">Cancel</a>
        </div>
      </div>
    </div>
   </form>
  </div>
  </div>
</div>
