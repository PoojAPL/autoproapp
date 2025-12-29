<div class="container-fluid">  
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form" method ="post" id="add_image_types" action="<?php echo adm_base_url();?>/save_image_types" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add New User</h2>-->
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Name</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" class="form-control" placeholder="Name" name="Name" >
        </div>
      </div>
    </div>  
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Image Path</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" class="form-control" placeholder="Image Path" name="Path" >
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
          <a href="<?php echo adm_base_url();?>/image_types" class="btn btn-danger">Cancel</a>
        </div>
      </div>
    </div>
   </form>
  </div>
  </div>
</div>
