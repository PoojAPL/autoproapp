<div class="container-fluid">  
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form" method ="post" id="add_images" action="<?php echo adm_base_url();?>/vehicles/save_obp_options" enctype="multipart/form-data">    
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Category</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <select class="form-control" name="Category_UUID" >
         	<option value="">Select Category</option>
            <?php foreach($obp_option_categories as $type){?>
            	<option value="<?php echo $type['UUID'];?>"><?php echo $type['Name'];?></option>
            <?php } ?>
         </select>
        </div>
      </div>
    </div>   
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Default Text</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" class="form-control" name="Default_Text">
        </div>
      </div>
    </div>  
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Image </label>
        </div>
      </div>
      <div class="col-sm-20">
        <div class="inputcol">
        <!-- <select class="form-control" name="Default_Image_UUID" >
         	<option value="">Select Image</option>
            
         </select>-->
         <?php foreach($get_image as $type){?>
         		<div class="obp_options_imgs">
            	<input type="radio" value="<?php echo $type['UUID'];?>" name="Default_Image_UUID">
                <img src="<?php echo base_url();?>images/<?php echo $type['Filename'];?>" width="50" />
                </div>
          <?php } ?>
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
          <a href="<?php echo adm_base_url();?>/vehicles/obp_options" class="btn btn-danger">Cancel</a>
        </div>
      </div>
    </div>
   </form>
  </div>
  </div>
</div>