<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form class="site-form" method ="post" action="<?php echo adm_base_url();?>/save_software" enctype="multipart/form-data">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Type</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <select required="required" class="form-control" name="type">
               <?php foreach (software_type() as $value) {
                   if($software_info[0]['type'] == $value['Software_Type_Name']){
                       $selected = 'selected';
                   }else{
                    $selected = '';
                   }?>
                 <option <?php echo $selected;?>><?php echo $value['Software_Type_Name'];?></option>
               <?php }?>
             </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
            <input type="text" required="required" class="form-control" name="name" value="<?php echo $software_info[0]['name'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Image</label>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="inputcol">
             <input type="file" class="form-control" name="image">
             <input type="hidden" name="copy_image" value="<?php echo $software_info[0]['image'];?>">
            </div>
          </div>
          <div class="col-sm-8">
            <?php if( $software_info[0]['image'] != ""){ ?>
                <img src="<?php echo asset_url();?>/images/<?php echo $software_info[0]['image'];?>" width="30px">
            <?php } ?>
          </div>  
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Part #</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="text"class="form-control" name="part" value="<?php echo $software_info[0]['part'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Products</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="text" class="form-control" name="products" value="<?php echo $software_info[0]['products'];?>">
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
                   <?php
                    if($software_info[0]['vehicles'] != ""){ 
                      $vehicles_UUIDs = explode(',', $software_info[0]['vehicles']);
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
          <div class="col-md-12">
            <button type="submit" class="btn btn-success" name="post">Submit</button>
            <a href="<?php echo adm_base_url();?>/software" class="btn btn-danger">Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>
