<div class="container-fluid"> 
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
  <form class="site-form add_user" method ="post" action="<?php echo adm_base_url();?>/vehicles/MakesName" id="edit_makename">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
   <!-- <h2 class="titleheadng">Update Makes Name</h2>  --> 
    <div class="row">
      <div class=" col-sm-4">
        <div class="labelcol">
          <label class="control-label">Makes Name</label>
        </div>
      </div>
      <div class=" col-sm-10 ">
        <div class="inputcol">
        <input type="hidden" value="<?php echo $id;?>" name="makeID">
         <input type="text" class="form-control" placeholder="Name" name="make_name" value="<?php echo $getMakeInfo[0]['Make_Name'];?>" >
        </div>
      </div>
    </div> 
     <hr>
    <div class="row">
    <div class=" col-sm-4">
        <div class="labelcol">
          <label class="control-label"></label>
        </div>
      </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary" name="post" clas="update">Submit</button>
        <a href="<?php echo adm_base_url();?>/vehicles/makes" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>