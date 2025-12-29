<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form "  method ="post" id="makes_name" action="<?php echo adm_base_url();?>/vehicles/makes_user_add" >
    <!--<h2 class="titleheadng">Add Makes User</h2>-->
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
   <input type="hidden" class="form-control" placeholder="UUID" name="uuid" id= "uuid" value="<?php echo md5(uniqid(mt_rand(), true));?>">
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Makes Name</label>
        </div>
      </div>
      <div class=" col-sm-10 ">
        <div class="inputcol">
         <input type="text" class="form-control" placeholder="Name" name="make_name" id= "make_name">
         
        </div>
      </div>
    </div>   	
     <hr>
    <div class="row">
    <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label"></label>
        </div>
      </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/vehicles/makes" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
