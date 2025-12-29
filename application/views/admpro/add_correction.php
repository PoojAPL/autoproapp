<?php 
$user_data = $this->session->userdata['login_user'];
$user_email = $user_data['email'];

$getUsersInfo = $this->admin_model->usersInInfo($user_email);
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <div id="fireResult"></div>
       <form class="site-form" method ="post" action="<?php echo adm_base_url();?>/save_correction" id="correctionForm">  
       <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />    
        <input type="hidden" id="errorValue" />
         <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">User Name</label>
            </div>
          </div>
          <div class=" col-sm-10 ">
            <div class="inputcol">              
              <input type="text" class="form-control"  value="<?php echo $getUsersInfo[0]['user_name'];?>" disabled="disabled" id="userName" >
               <input type="hidden" name="user_name" value="<?php echo $getUsersInfo[0]['user_name'];?>">
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
              <?php 
				if($getUsersInfo[0]['type'] == 1){
					$subuser = 'selected';
					$user = '';
				}else{
					$user = 'selected';
					$subuser = '';
				}
			  ?>
              <select class="form-control select-field" name="user_type" id="adminType">
                 <?php  $get_users_type = users_type();
					foreach( $get_users_type as $key => $user_type){
						if($getUsersInfo[0]['type'] == $key){
							$selected = 'selected';?>
                            <option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $user_type;?></option>
					<?php }
				} ?>
              </select>
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
              <input type="email" class="form-control"  value="<?php echo $getUsersInfo[0]['email'];?>"  disabled="disabled">
              <input type="hidden" name="email" value="<?php echo $getUsersInfo[0]['email'];?>" id="email2">
            </div>
          </div>
        </div>
        <fieldset>
            <legend>VEHICLE</legend>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Make</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <select class="form-control select_obp_Models" name="Make_UUID">
                    <option value="">Select make</option>
                    <?php foreach($getAllMakeNames as $makes){?>
                        <option value="<?php echo $makes['UUID'];?>"><?php echo $makes['Make_Name'];?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Model</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol getModels">
                  <select class="form-control" name="Model_UUID">
                    <option value="">Select model</option>
                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Vehicle</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol getVehicles">
                  <select class="form-control" name="Vehicle_UUID">
                    <option value="">Select vehicle</option>                    
                  </select>
                </div>
              </div>
            </div> 
        </fieldset>        
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Feedback Type</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
            	<select class="form-control" name="feed_type">
                <option value="">Please select feedback type</option>
               <?php  $get_users_type = feedback_type();
				foreach( $get_users_type as $key => $user_type){ ?>
                	<option><?php echo $user_type;?></option>
				<?php } ?>
                </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Review</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
            	<textarea class="form-control" name="review" style="height:150px;"></textarea>
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
              <button type="submit" class="btn btn-success" name="post" id="addUserBtn">Add New Correction</button>
              <a href="<?php echo adm_base_url();?>/corrections" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>