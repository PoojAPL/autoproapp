<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
     <form class="site-form add_user" method ="post" id="" action="<?php echo adm_base_url();?>/update_aks_db_users">
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" /> 
     	<input type="hidden" name="id" value="<?php echo $id;?>" />     
        <div class="row">
          <div class=" col-sm-3 ">
            <div class="labelcol">
              <label class="control-label">First Name</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
              <input type="text" class="form-control" name="FirstName" value="<?php echo $aks_users_info[0]['FirstName'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-3 ">
            <div class="labelcol">
              <label class="control-label">Last Name</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
              <input type="text" class="form-control" name="LastName" value="<?php echo $aks_users_info[0]['LastName'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-3 ">
            <div class="labelcol">
              <label class="control-label">Company</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
              <input type="text" class="form-control" name="user_name">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-3 ">
            <div class="labelcol">
              <label class="control-label">E-mail</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
              <input type="text" class="form-control" name="Email" value="<?php echo $aks_users_info[0]['Email'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-3 ">
            <div class="labelcol">
              <label class="control-label">Phone</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
              <input type="text" class="form-control" name="PhoneNumber" value="<?php echo $aks_users_info[0]['PhoneNumber'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-3 ">
            <div class="labelcol">
              <label class="control-label">Status</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
             <?php 
			   $status_array = array('waiting for approved', 'approved', 'rejected');?>
			   <select  class="form-control"  name="Status">
				 <?php foreach($status_array as $status){
					  if($aks_users_info[0]['Status'] == $status){
						  $selected  =  'selected';
					  }else{
						  $selected  =  '';
					  }
					  ?>
				   <option <?php echo $selected;?>><?php echo $status;?></option>
				 <?php }?>
			   </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-3 ">
            <div class="labelcol">
              <label class="control-label">User Class</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
              <select class="form-control select-field" name="select_admin" id="adminType">
                 <?php  $get_users_type = users_type();
					foreach( $get_users_type as $key => $user_type){
						if($aks_users_info[0]['type'] == $key){
							$selected = 'selected';
						}else{
							$selected = '';
						}
					 ?>
                	<option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $user_type;?></option>
				<?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-3 ">
            <div class="labelcol">
              <label class="control-label">User Score</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
              <input type="text" class="form-control" name="user_name">
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class=" col-sm-3 ">
            <div class="labelcol">
              <label class="control-label">&nbsp;</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="<?php echo adm_base_url();?>/users" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
