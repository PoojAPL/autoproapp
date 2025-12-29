<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <div id="fireResult"></div>     	
      <form class="site-form add_user" method ="post" id="" action="<?php echo adm_base_url();?>/update_user2">   
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />   
        <!-- <h2 class="titleheadng">Update User</h2>-->
        <input type="hidden" id="errorValue" />
        <input type="hidden" id="userUUID" value="<?php echo $getUsersInfo[0]['User_uid'];?>" />
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Name</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
              <input type="hidden" value="<?php echo $id;?>" name="userId" id="userId">
              <input type="text" class="form-control" name="user_name" value="<?php echo $getUsersInfo[0]['user_name'];?>" id="userName" onkeypress="myEnterFunction(event)">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">User Type</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
             <select class="form-control select-field" name="select_admin" id="adminType">
                 <?php  $get_users_type = users_type();
                  foreach( $get_users_type as $key => $user_type){
                    if($getUsersInfo[0]['type'] == $key){
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
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Company</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <input type="text" class="form-control" name="company" value="<?php echo $getUsersInfo[0]['Company'];?>" id="company" onkeypress="myEnterFunction(event)">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Email</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">
              <input type="email" class="form-control"  value="<?php echo $getUsersInfo[0]['email'];?>" name="email">
              <!-- <input type="hidden" name="email" value="<?php echo $getUsersInfo[0]['email'];?>" id="email2">
              <input type="hidden" name="password1" id="password">   -->           
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">New Password</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <input type="password" class="form-control" placeholder="New Password" name="password" id="password" >
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Access </label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
            <?php 				
				if($getUsersInfo[0]['APP_switcher'] == 1){
					 $enabled = 'Enabled';
					 $on_check = 'checked';
					 $value = 0;
				}else{
					$enabled = 'Disabled';
					 $on_check = '';
					 $value = 1;
				}
			?>
            <input type="checkbox" name="admin_access" id="admin_access"  data-toggle="toggle" data-on="Enabled" data-off="Disabled" <?php echo  $on_check;?>>
             <!--<input type="radio" name="admin_access" id="admin_access" value="1" <?php echo $on_check;?> /> Enabled
             <input type="radio" name="admin_access" id="admin_access" value="0" <?php echo $ff_check;?> /> Disabled-->
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">&nbsp;</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <button type="submit" class="btn btn-success">Submit</button>
              <a href="<?php echo adm_base_url();?>/manage_user" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
