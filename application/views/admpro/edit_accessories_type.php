<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form "  method ="post" id="accessories_type" action="<?php echo adm_base_url();?>/update_accessories_type" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add accessories Type</h2>-->
    <input type="hidden" name="accessoriesTypeId" value="<?php echo $accessoriesTypeId;?>">
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"> Name</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" class="form-control" placeholder="Name" name="accessories_Type_Name" value="<?php echo $getaccessoriesTypeInfo[0]['accessories_Type_Name'];?>" id= "name">
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
        <button type="sumit" class="btn btn-success" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/accessories_type" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
 
   </form>
  </div>
  </div>
</div>
