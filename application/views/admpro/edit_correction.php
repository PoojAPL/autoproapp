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
       <form class="site-form" method ="post" action="<?php echo adm_base_url();?>/update_correction" id="correctionForm"> 
       <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />     
        <input type="hidden" value="<?php echo $id;?>" name="id" />
        <?php		
			$get_vehicles = get_vehicles($get_corrections_info[0]['Vehicle_UUID']);
			//print_r($get_vehicles);
			$get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
			$get_make_name[0]['UUID'];
		?>
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
                    <?php foreach($getAllMakeNames as $makes){
					if($get_make_name[0]['UUID'] == $makes['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                	<option value="<?php echo $makes['UUID'];?>" <?php echo $selected;?>><?php echo $makes['Make_Name'];?></option>
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
                    <?php $get_model_makes =  get_model_makes($get_make_name[0]['UUID']);
						foreach($get_model_makes as $models){
							if($get_vehicles[0]['Model_UUID'] == $models['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
							<option value="<?php echo $models['UUID'];?>" <?php echo $selected;?>> <?php echo $models['Model_Name'];?></option>	
						<?php }	?>                    
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
                    <?php $get_model_makes_vehicles =  get_model_makes_vehicles($get_corrections_info[0]['Vehicle_UUID']);
					foreach($get_model_makes_vehicles as $vehicle){
						if($get_corrections_info[0]['Vehicle_UUID'] == $vehicle['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						?>
						<option value="<?php echo $vehicle['UUID'];?>" <?php echo $selected;?>> 
						<?php 
						$get_models_name = get_models_name($vehicle['Model_UUID']);
						$years = explode(',',$vehicle['Years']);
						echo $get_make_name[0]['Make_Name'];?>  <?php echo $get_models_name[0]['Model_Name'];?>  <?php echo $years[0];?>-<?php echo $years[count($years)-1];?>
						</option>	
					<?php }	?>                     
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
				foreach( $get_users_type as $feed_type){
					if($get_corrections_info[0]['Feedback_type'] == $feed_type){
							$selected = 'selected';
						}else{
							$selected = '';
						}
					 ?>
                	<option <?php echo $selected;?>><?php echo $feed_type;?></option>
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
            	<textarea class="form-control" name="review" style="height:150px;"><?php echo $get_corrections_info[0]['User_Review'];?></textarea>
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
              <button type="submit" class="btn btn-primary" name="post" id="addUserBtn">Update Correction</button>
              <a href="<?php echo adm_base_url();?>/corrections" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>