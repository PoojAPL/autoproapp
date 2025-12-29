<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
if(isset($_COOKIE['db_Submitted_By_cookie'])){ 
   $submitted_By_cookie_value = $_COOKIE['db_Submitted_By_cookie'];
}else{
  $submitted_By_cookie_value = ""; 
}
if(isset($_COOKIE['db_Phone_By_cookie'])){ 
   $Phone_cookie_value = $_COOKIE['db_Phone_By_cookie'];
}else{
  $Phone_cookie_value = ""; 
}
 ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form " method ="post" id="AddPurchaseForm" action="<?php echo adm_base_url();?>/save_feedback">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add Model</h2>-->
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Date</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Date" value="<?php echo date('m/d/Y');?>" id="prchaseDate" name="Date">
            </div>
          </div>
        </div>        
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Submitted By</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Submitted By" value="<?php echo $submitted_By_cookie_value;?>" name="Submitted_By">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Cell Phone Number</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
                <input type="text" class="form-control" id="phone_number" name="Phone">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Vehicle(s)</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="text" class="form-control" id="vehicle"  name="Vehicle">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Did it work?</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="radio" class="custom-radio"  name="Worked" value="Yes" checked="checked"> Yes
              <input type="radio" class="custom-radio"  name="Worked" value="No"> No
              <input type="radio" class="custom-radio"  name="Worked" value="Partial"> Partially   
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Description</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <textarea placeholder="Description" name="Description"></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Addressed</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="checkbox" data-toggle="toggle" name="Addressed">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Confirmed Working</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="text" class="form-control"  name="Confirmed_Working">
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
        <a href="<?php echo adm_base_url();?>/feedback" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
