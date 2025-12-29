<div class="container-fluid"> 
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
  <form class="site-form add_user" method ="post" action="<?php echo adm_base_url();?>/update_keystyle" >
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
   <!-- <h2 class="titleheadng">Update Key Type</h2>   -->
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"> Name</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
        <input type="hidden" value="<?php echo $id;?>" name="keyId">
         <input type="text" class="form-control" placeholder="Name" name="keystyle" value="<?php echo $getKeyStyleInfo[0]['Key_Style_Name'];?>" >
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
        <button type="sumit" class="btn btn-primary" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/keyStyle" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>