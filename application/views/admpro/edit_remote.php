<?php
$_SESSION['lastUpdatedRomote'] = $remoteId;
 $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];

if(isset($_SESSION['remote_page_number'])){
	 $page_id =  $_SESSION['remote_page_number'];
}else{
	$page_id =  "";
}

 ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
	 <a href="<?php echo adm_base_url();?>/remotes/<?php echo $page_id;?>" class="btn btn-primary" style="float:right;">BACK</a>
    <?php if($this->session->flashdata('message_display')){?>
  		<?php echo $this->session->flashdata('message_display');?>
    <?php } ?>
  <form class="site-form " method ="post" action="<?php echo adm_base_url();?>/update_remote">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add Model</h2>-->
        <input type="hidden" name="remoteId" value="<?php echo $remoteId;?>" />
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">EZ#</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="EZ" name="ez" value="<?php echo $getRemotesInfo[0]['ez'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Name" name="Remote_Name" value="<?php echo $getRemotesInfo[0]['Remote_Name'];?>">
            </div>
          </div>
        </div>
      <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Type</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <select class="form-control selectRemoteType1"  name="Remote_Type_UUID">
           		<option value="">Select Type</option>
                <?php foreach($getAllRemoteType as $remote_type){
      					if($getRemotesInfo[0]['Remote_Type_UUID'] == $remote_type['UUID']){
      						$selected = 'selected';
      					}else{
      						$selected = '';
      					}
      					?>
                <option value="<?php echo $remote_type['UUID'];?>" <?php echo $selected;?>><?php echo $remote_type['Remote_Type_Name'];?></option>
                <?php  }?>
           </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Key Shell </label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol shellData">
		
          <select class="form-control " name="Shell_UUID" id="Shell_UUID" >
            <option value="">Select Shell Key</option>
			   <?php			   	  
			   	  if(($getRemotesInfo[0]['Remote_Type_UUID'] == "d8d12888-49eb-11e6-beb8-9e71128cae77")||($getRemotesInfo[0]['Remote_Type_UUID'] == "a5451618-49ec-11e6-beb8-9e71128cae77")){
					  $remote_shell = "a5451618-49ec-11e6-beb8-9e71128cae77";
					  $get_remote_shell_keys = get_remote_shell_keys_info($remote_shell);						
			 	  }elseif(($getRemotesInfo[0]['Remote_Type_UUID'] == "a5451b68-49ec-11e6-beb8-9e71128cae77")||($getRemotesInfo[0]['Remote_Type_UUID'] == "d8d12d60-49eb-11e6-beb8-9e71128cae77")){
					  $remote_shell = "a5451b68-49ec-11e6-beb8-9e71128cae77";
					  $get_remote_shell_keys = get_remote_shell_keys_info($remote_shell);
				  }elseif(($getRemotesInfo[0]['Remote_Type_UUID'] == "d8d12afe-49eb-11e6-beb8-9e71128cae77")||($getRemotesInfo[0]['Remote_Type_UUID'] == "a54519b0-49ec-11e6-beb8-9e71128cae77")){
					  $remote_shell = "a54519b0-49ec-11e6-beb8-9e71128cae77";
					  $get_remote_shell_keys = get_remote_shell_keys_info($remote_shell);
				  }else{
					// $get_remote_shell_keys = get_remote_shell_keys($getRemotesInfo[0]['Shell_UUID']);
				  }                
                  foreach($get_remote_shell_keys as $shells){
                  if($getRemotesInfo[0]['Shell_UUID'] == $shells['UUID']){
                      $selected = 'selected';
                  }else{
                      $selected = '';
                  }
                ?>
                <option value="<?php echo $shells['UUID'];?>" <?php echo $selected;?>><?php echo $shells['Remote_Name'];?></option>
            <?php }?>
          </select>
        </div>
      </div>
    </div>
     <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">OEM Part Number </label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <textarea class="form-control" name="OEM_Part_Number"><?php echo $getRemotesInfo[0]['OEM_Part_Number'];?></textarea>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Buttons</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
        	<?php $get_buttons = get_buttons();?>          
           	<select class="form-control multiple-select"  name="Buttons[]" multiple="multiple">
           		<option value="">Select Buttons</option>
                <?php 
        				$buttons_array  = explode(',',$getRemotesInfo[0]['Buttons']);
        				foreach($get_buttons as $buttons){
        					if(in_array($buttons['UUID'], $buttons_array)){
        						$selected = 'selected';
        					}else{
        						$selected = '';
        					}
        					?>
                <option value="<?php echo $buttons['UUID'];?>" <?php echo $selected;?>><?php echo $buttons['Name'];?></option>
                <?php  }?>
           </select>           
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Frequency</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">           
           <?php $get_Frequency = get_Frequency();?>          
           	<select class="form-control"  name="Frequency" id="frequency">
           		<option value="">Select Frequency</option>
                <?php 
        				foreach($get_Frequency as $frequency){
        					if($getRemotesInfo[0]['Frequency'] == $frequency['UUID']){
        						$selected = 'selected';
        					}else{
        						$selected = '';
        					}
        					?>
                <option value="<?php echo $frequency['UUID'];?>" <?php echo $selected;?>><?php echo $frequency['Name'];?></option>
                <?php  }?>
           </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">FCC ID</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <input type="text" class="form-control"  name="Fcc_ID" value="<?php echo $getRemotesInfo[0]['FCCID'];?>" id="Fcc_ID">
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">IC</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <input type="text" class="form-control"  name="IC" value="<?php echo $getRemotesInfo[0]['IC'];?>" id="IC">
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Chip</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <select class="form-control"  name="Chips_UUID" id="Chips_UUID">
           		<option value="">Select Chip</option>
                <?php foreach($getAllChips as $chip){
					if($getRemotesInfo[0]['Chip_UUID'] == $chip['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                <option value="<?php echo $chip['UUID'];?>" <?php echo $selected;?>><?php echo $chip['Chip_Name'];?></option>
                <?php  }?>
           </select>
        </div>
      </div>
    </div>
    <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Test Key</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol TestKey_UUID">
           <select class="form-control"  name="TestKey_UUID" id="TestKey_UUID">
                <option value="">Select Test Key</option>
                <?php 
                $get_machanical_keys = get_machanical_keys('Mechanical Key');
                foreach($get_machanical_keys as $keys){
					if($getRemotesInfo[0]['TestKey_UUID'] == $keys['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					 ?>
                <option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
                <?php } ?>
           </select>
          </div>
        </div>
      </div>
      <?php 
	  	$emergency_keys_data = explode(',', $getRemotesInfo[0]['Emergency_Key_UUID']);
		if( $emergency_keys_data[0] !== ""){
			$em_keys = '';
		}else{
			$em_keys = '';//'disabled';
		}
		//print_r($emergency_keys_data);
	  ?>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Emergency Keys </label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <select class="form-control"  name="Emergency_Key_UUID[]" id="Emergency_Key_UUID">
                <option value="">Select Emergency Key</option>
                <?php 
                $get_machanical_keys = get_machanical_keys('Emergency Key');
                foreach($get_machanical_keys as $keys){
					if($emergency_keys_data[0] == $keys['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
				?>
                <option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?>(<?php echo $keys['Products'];?>)</option>
                <?php } ?>
           </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Emergency Keys </label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <select class="form-control"  name="Emergency_Key_UUID[]" id="Emergency_Key_UUID2" <?php echo $em_keys;?>>
                <option value="">Select Emergency Key</option>
                <?php 
                $get_machanical_keys = get_machanical_keys('Emergency Key');
                foreach($get_machanical_keys as $keys){
					if($emergency_keys_data[1] == $keys['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					 ?>
                <option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?>(<?php echo $keys['Products'];?>)</option>
                <?php } ?>
           </select>
          </div>
        </div>
      </div>
   	 <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Battery</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <select class="form-control"  name="Battery_UUID" id="Battery_UUID">
           		<option value="">Select Battery</option>
                <?php foreach($getAllbatteries as $battery){
					if($getRemotesInfo[0]['Battery_UUID'] == $battery['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                <option value="<?php echo $battery['UUID'];?>" <?php echo $selected;?>><?php echo $battery['Battery_Name'];?></option>
                <?php  }?>
           </select>
        </div>
      </div>
    </div>
    <?php $reusable_array = array('Yes', 'Yes (After Unlocking)','No');?>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Reusable?</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <select class="form-control" name="Reusable">
          <option value="">Please select</option>
            <?php foreach ($reusable_array as $value) {
            if($getRemotesInfo[0]['Reusable'] == $value){
              $selected = 'selected';
            }else{
              $selected = '';
            } ?>
            <option <?php echo $selected;?>><?php echo $value;?></option>
          <?php } ?>
         </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Image Filename</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <input type="text" class="form-control"  name="Remote_Image_Url" value="<?php echo $getRemotesInfo[0]['Remote_Image_Url'];?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Products</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <input type="text" class="form-control"  name="Products" value="<?php echo $getRemotesInfo[0]['Products'];?>">
        </div>
      </div>
    </div>    
    
    <fieldset>
              <legend>Add Vehicle</legend>
                <div class="row">
            <div class="col-sm-10">
              <div class="inputcol">
                <label class="control-label">Available Vehicles</label>
                <input type="text" name="q" class="form-control searchAvailableVehicles2" placeholder="Search...">
                <div class="searchAvailableVehiclesHolder">
                 <select id="search" class="form-control" size="15" multiple="multiple" >
                  <?php 
                  $get_all_vehicles = get_all_available_vehicles();
                  foreach($get_all_vehicles as $vehicles){
                    $years = explode(',',$vehicles['Years']);
                    $get_make_name = $vehicles['Make_Name'];
                    $get_models_name = $vehicles['Model_Name'];
                    $Code_Series_Name = '';                 
                    $got_series_data = explode(',',$vehicles['Code_Series_UUID']);
                    if( count($got_series_data) > 1){
                        for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
                          $got_series_val = explode('|',$got_series_data[$cs]);
                          $code_series_id = $got_series_val[0];
                          $code_series_note = $got_series_val[1];
                          $get_Code_Series_name = get_Code_Series_name($code_series_id);
                          if($get_Code_Series_name[0]['Code_Series_Name'] !=""){
                            $Code_Series_Name .= $get_Code_Series_name[0]['Code_Series_Name'].',';
                          }
                        } 
                        $Code_Series_Name = rtrim($Code_Series_Name,',');
                      }else{
                        $got_series_val = explode('|',$got_series_data[0]);
                        $code_series_id = $got_series_val[0];
                        $code_series_note = $got_series_val[1];
                        $get_Code_Series_name = get_Code_Series_name($code_series_id);
                        $Code_Series_Name = $get_Code_Series_name[0]['Code_Series_Name'];
                       }
                       if($Code_Series_Name !=""){
                        $option_name = $get_make_name.' '.$get_models_name.' ('.$years[0].'-'.$years[count($years)-1].') ('.$Code_Series_Name.')';
                       }else{
                        $option_name = $get_make_name.' '.$get_models_name.' ('.$years[0].'-'.$years[count($years)-1].')';
                      }
                    ?>
                    ?>
                    <option value="<?php echo $vehicles['UUID'];?>"> <?php echo $option_name;?></option>
                  <?php } ?>
                 </select>
                 </div>
              </div>
            </div>
            <div class="col-sm-2 upDownButton">
                <!-- <button type="button" id="search_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button> -->
                <button type="button" id="search_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="search_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                <!-- <button type="button" id="search_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button> -->
            </div>
            <div class="col-sm-10">
              <div class="inputcol">
                <label class="control-label">Selected Vehicles</label>
                 <select name="parts_vehicle[]" id="search_to" class="form-control" size="17" multiple="multiple">
                  <?php if($vehicle != ""){?>
                    <option value="<?php echo $vehicle;?>"><?php echo $vehicle;?></option>
                  <?php } ?>
                   <?php
                    if($getRemotesInfo[0]['Vehicles_UUID'] != ""){ 
                      $vehicles_UUIDs = explode(',', $getRemotesInfo[0]['Vehicles_UUID']);
                      for($v = 0; $v < count($vehicles_UUIDs); $v++){
                        $get_vehicles = get_selected_vehicles_by_UUI($vehicles_UUIDs[$v]);
                        $years = explode(',',$get_vehicles[0]['Years']);
                        $get_make_name = $get_vehicles[0]['Make_Name'];
                        $get_models_name = $get_vehicles[0]['Model_Name'];
                        ?>
                        <option value="<?php echo $vehicles_UUIDs[$v];?>" selected>
                        <?php echo $get_make_name;?>  <?php echo $get_models_name.', '.$years[0].'-'.$years[count($years)-1];?>
                        </option>
                      <?php } 
                    }?>
                 </select>
              </div>
            </div>
          </div>
      </fieldset>
    <hr>
    <div class="row">
   		 <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label"></label>
        </div>
      </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/remotes/<?php echo $page_id;?>" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
