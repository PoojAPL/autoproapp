<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form class="site-form " method ="post" id="AddObpRemoteForm" action="#">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <!--<h2 class="titleheadng">Add Model</h2>-->
        <input type="hidden" name="obpId" value="<?php echo $id;?>" />
	  <?php	
          //print_r($obp_remote_info[0]['Vehicle_UUID']);
          $get_vehicle_ids = explode('|',$obp_remote_info[0]['Vehicle_UUID']);  
          foreach($get_vehicle_ids as $vids){		
          $get_vehicles = get_vehicles($vids);
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
                  <select class="form-control" name="Vehicle_UUID[]">
                    <option value="">Select vehicle</option> 
                    <?php $get_model_makes_vehicles =  get_model_makes_vehicles($vids);
					foreach($get_model_makes_vehicles as $vehicle){
						if($vids == $vehicle['UUID']){
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
        <?php } ?>
        <fieldset>
		<legend>PROCEDURE#1 </legend> 
        <?php $results_array1 = get_obp_remotes1($obp_remote_info[0]['unique_id']);
		if($results_array1 == true){
			foreach($results_array1 as $value){
				$get_Category = get_Category($value['Image_UUID']);?>    
			
				<div class="row">
				  <div class=" col-sm-4 ">
					<div class="labelcol">
					  <label class="control-label">Step #</label>
					</div>
				  </div>
				  <div class="col-sm-10">
					<div class="inputcol">
					  <input type="number" class="form-control" name="Sort_Order[]" value="1"  />
					</div>
				  </div>
				</div> 
				<div class="row">
				  <div class=" col-sm-4 ">
					<div class="labelcol">
					  <label class="control-label">Category</label>
					</div>
				  </div>
				  <div class="col-sm-10">
					<div class="inputcol">
					  <select class="form-control select_obp_category" name="category">
						<option value="">Select category</option>
						<?php foreach($obp_option_categories as $type){
							if($get_Category[0]['Category_UUID'] == $type['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
						<option value="<?php echo $type['UUID'];?>" <?php echo $selected;?> ><?php echo $type['Name'];?></option>
					<?php } ?>
					  </select>
					</div>
				  </div>
				</div> 
				<div class="get_default_image_data">
                	<div class="row">
                      <div class=" col-sm-4 ">
                        <div class="labelcol">
                          <label class="control-label">Selection</label>
                        </div>
                      </div>
                      <div class="col-sm-10">
                        <div class="inputcol">
                          <select class="form-control select_image_uuid" name="selection">                           
                             <?php
							  $get_obp_ptions_selection = get_obp_ptions_selection($get_Category[0]['Category_UUID']);		   
                              foreach($get_obp_ptions_selection as $obp_options){
								  if($get_Category[0]['Category_UUID'] == $obp_options['Category_UUID']){
										$selected = 'selected';
								  }else{
										$selected = '';
								  }
								  ?>
                                  <option value="<?php echo $obp_options['UUID'];?>" <?php echo $selected;?>>
                                        <?php echo $obp_options['Default_Text'];?> 
                                   </option>
                              <?php } ?>
                               <option value="">Select</option>
                          </select>
                        </div>
                      </div>
                    </div>
                </div> 
				<div class="get_default_image_uuid_data">
                	<div class="row">
                      <div class=" col-sm-4 ">
                        <div class="labelcol">
                          <label class="control-label">Image </label>
                        </div>
                      </div>
                      <div class="col-sm-10">
                        <div class="inputcol">
                          <select class="form-control selectImageDeafultText" name="Image_UUID[]"> 
                            <option value="">Select</option>      
                             <?php 
							  $get_obp_ptions_selection = get_obp_ptions_selection($get_Category[0]['Category_UUID']);			   
                              foreach($get_obp_ptions as $obp_options){?>
                              <option value="<?php echo $obp_options['UUID'];?>">
                                    <?php $get_image = get_image($obp_options['Default_Image_UUID']);?>
                                     <?php echo $get_image[0]['Filename'];?>
                               </option>
                              <?php } ?>
                          </select>
                           <button type="button" class="btn btn-info pull-right changeImage">Change Image</button>
                        </div>    
                      </div> 
                    </div>
                </div> 
				<div class="getImageDeafultText">
                <div class="row">
                  <div class=" col-sm-4 ">
                    <div class="labelcol">
                      <label class="control-label">Text </label>
                    </div>
                  </div>
                  <div class="col-sm-10">
                    <div class="inputcol">
                        <textarea class="form-control" name="Text[]" style="height: 60px;"><?php if(isset($get_Category[0]['Default_Text'])){echo $get_Category[0]['Default_Text'];}?></textarea>
                     </div>    
                  </div> 
                </div>
                </div>
				<input type="hidden" name="Procedure_Number[]" value="2"  />            
			
			<?php }
		  }?>  
          </fieldset>
         <div class="getAnotherProcedure">
         <fieldset>
				<legend>PROCEDURE#2 </legend> 
         <?php $results_array2 = get_obp_remotes2($obp_remote_info[0]['unique_id']);
		if($results_array2 == true){
			foreach($results_array2 as $value){
				$get_Category = get_Category($value['Image_UUID']);?>    
			 
				<div class="row">
				  <div class=" col-sm-4 ">
					<div class="labelcol">
					  <label class="control-label">Step #</label>
					</div>
				  </div>
				  <div class="col-sm-10">
					<div class="inputcol">
					  <input type="number" class="form-control" name="Sort_Order[]" value="1"  />
					</div>
				  </div>
				</div> 
				<div class="row">
				  <div class=" col-sm-4 ">
					<div class="labelcol">
					  <label class="control-label">Category</label>
					</div>
				  </div>
				  <div class="col-sm-10">
					<div class="inputcol">
					  <select class="form-control select_obp_category" name="category">
						<option value="">Select category</option>
						<?php foreach($obp_option_categories as $type){
							if($get_Category[0]['Category_UUID'] == $type['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
						<option value="<?php echo $type['UUID'];?>" <?php echo $selected;?> ><?php echo $type['Name'];?></option>
					   <?php } ?>
					  </select>
					</div>
				  </div>
				</div> 
				<div class="get_default_image_data">
                	<div class="row">
                      <div class=" col-sm-4 ">
                        <div class="labelcol">
                          <label class="control-label">Selection</label>
                        </div>
                      </div>
                      <div class="col-sm-10">
                        <div class="inputcol">
                          <select class="form-control select_image_uuid" name="selection">                           
                             <?php
							  $get_obp_ptions_selection = get_obp_ptions_selection($get_Category[0]['Category_UUID']);		   
                              foreach($get_obp_ptions_selection as $obp_options){
								  if($get_Category[0]['Category_UUID'] == $obp_options['Category_UUID']){
										$selected = 'selected';
								  }else{
										$selected = '';
								  }
								  ?>
                                  <option value="<?php echo $obp_options['UUID'];?>" <?php echo $selected;?>>
                                        <?php echo $obp_options['Default_Text'];?> 
                                   </option>
                              <?php } ?>
                               <option value="">Select</option>
                          </select>
                        </div>
                      </div>
                    </div>
                </div> 
				<div class="get_default_image_uuid_data">
                	<div class="row">
                      <div class=" col-sm-4 ">
                        <div class="labelcol">
                          <label class="control-label">Image </label>
                        </div>
                      </div>
                      <div class="col-sm-10">
                        <div class="inputcol">
                          <select class="form-control selectImageDeafultText" name="Image_UUID[]"> 
                            <option value="">Select</option>      
                             <?php 
							  $get_obp_ptions_selection = get_obp_ptions_selection($get_Category[0]['Category_UUID']);			   
                              foreach($get_obp_ptions as $obp_options){?>
                              <option value="<?php echo $obp_options['UUID'];?>">
                                    <?php $get_image = get_image($obp_options['Default_Image_UUID']);?>
                                     <?php echo $get_image[0]['Filename'];?>
                               </option>
                              <?php } ?>
                          </select>
                           <button type="button" class="btn btn-info pull-right changeImage">Change Image</button>
                        </div>    
                      </div> 
                    </div>
                </div> 
				<div class="getImageDeafultText">
                    <div class="row">
                      <div class=" col-sm-4 ">
                        <div class="labelcol">
                          <label class="control-label">Text </label>
                        </div>
                      </div>
                      <div class="col-sm-10">
                        <div class="inputcol">
                            <textarea class="form-control" name="Text[]" style="height: 60px;"><?php if(isset($get_Category[0]['Default_Text'])){echo $get_Category[0]['Default_Text'];}?></textarea>
                         </div>    
                      </div> 
                    </div>
                </div>
				<input type="hidden" name="Procedure_Number[]" value="1"  />            
			
			<?php }
		  }?>
         </fieldset>	
         </div>
         <?php if($results_array1 == true){?>
         	<a href="javascript:void(0)" class="pull-right addAnotherProcedure" data-id="2">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Another Procedure
             </a>
         <?php }else{ ?>
         <a href="javascript:void(0)" class="pull-right addAnotherProcedure" data-id="1">
         	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Another Procedure
         </a>
        <?php } ?>
        <hr>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label"></label>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-success" name="post">Submit</button>
            <a href="<?php echo adm_base_url();?>/vehicles/obp_remotes" class="btn btn-danger" >Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>