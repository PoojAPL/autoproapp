<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form"  method ="post" action="<?php echo adm_base_url();?>/save_success_report" enctype="multipart/form-data">
  	 <!--<h2 class="titleheadng">Add New Chip</h2>-->
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
     <fieldset>
         <legend>Vehicle</legend>
          <div class="row">
            <div class="col-sm-10">
              <div class="inputcol">
                <label class="control-label">Available Vehicles 
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="limitVehicleTransponder">Limit to Transponder Vehicles Only</a>  
                </label>
                <input type="text" name="q" class="form-control searchAvailableVehiclesMethod" placeholder="Search...">
                <div class="searchAvailableVehiclesHolder">
                 <select id="search" class="form-control" size="15" multiple="multiple" >
                  <?php 
                  $get_all_vehicles = get_all_vehicles();
                  foreach($get_all_vehicles as $vehicles){
                    $years = explode(',',$vehicles['Years']);
                    $get_models_name = get_models_name($vehicles['Model_UUID']);
                    $get_make_name = get_make_name($vehicles['Model_UUID']);
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
                        $option_name = $get_make_name[0]['Make_Name'].' '.$get_models_name[0]['Model_Name'].' ('.$years[0].'-'.$years[count($years)-1].') ('.$Code_Series_Name.')';
                       }else{
                        $option_name = $get_make_name[0]['Make_Name'].' '.$get_models_name[0]['Model_Name'].' ('.$years[0].'-'.$years[count($years)-1].')';
                      }
                    ?>
                    <option value="<?php echo $vehicles['id'];?>"> <?php echo $option_name;?></option>
                  <?php } ?>
                 </select>
               </div>
              </div>
            </div>
            <div class="col-sm-2 upDownButton">                
                <button type="button" id="search_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="search_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>                
            </div>
            <div class="col-sm-10">
              <div class="inputcol">
                <label class="control-label">Selected Vehicles</label>
                 <select name="Vehicle_UUID[]" id="search_to" class="form-control" size="17" multiple="multiple">
                  <?php if($vehicle != ""){
                    $get_vehicle = get_vehicles_by_id($vehicle);
                    $vehicles = $get_vehicle[0];
                    $years = explode(',',$vehicles['Years']);
                    $get_models_name = get_models_name($vehicles['Model_UUID']);
                    $get_make_name = get_make_name($vehicles['Model_UUID']);
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
                        $option_name = $get_make_name[0]['Make_Name'].' '.$get_models_name[0]['Model_Name'].' ('.$years[0].'-'.$years[count($years)-1].') ('.$Code_Series_Name.')';
                       }else{
                        $option_name = $get_make_name[0]['Make_Name'].' '.$get_models_name[0]['Model_Name'].' ('.$years[0].'-'.$years[count($years)-1].')';
                      }?>
                    <option value="<?php echo $vehicle;?>"><?php echo $option_name;?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
        </fieldset>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Machine</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <select class="form-control" required="required" placeholder="Machine" name="Machine">
                <option value="">Please select</option>
                <?php $get_programmer_tools = get_success_rating_machine();
                  foreach($get_programmer_tools as $remote){
                    if($remote['Machine'] == 'AUTOPROPAD'){
                      $Machine = 'AutoProPAD';
                    }else if($remote['Machine'] == 'MVP_TCODE_SMART_PRO'){
                      $Machine = 'Smart Pro / MVP Pro / TCode Pro';
                    }else if($remote['Machine'] == 'HOTWIRE'){
                      $Machine = 'Hotwire';
                    }else if($remote['Machine'] == 'DMAX'){
                      $Machine = 'DMax';
                    }else{
                      $Machine = ucwords( str_replace('_', ' ',$remote['Machine']));
                    }
                    if($Machine !=""){?>
                    <option value="<?php echo $remote['Machine'];?>"><?php echo $Machine;?></option>
                <?php  }
                } ?>   
              </select>
        </div>
      </div>
    </div> 
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Submitted by User</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <!-- <input type="text"  class="form-control"  name="User_UUID" value="<?php echo $User_Email;?>"> -->
           <input type="text" name="" class="form-control searhAksUser" placeholder="Search User...">
          <div class="usersResults">
           <select class="form-control" value="<?php echo $User_Email;?>"  name="User_UUID">
            <option value="">Please select</option>
            <?php $get_all_aks_users = get_all_aks_users();
            foreach ($get_all_aks_users as $key => $value) {
              if($User_Email == $value['User_UUID']){
                $selected = 'selected';
              }else{
                $selected = '';
              }?>
              <option value="<?php echo $value['User_UUID'];?>" <?php echo $selected;?>><?php echo $value['Email'];?> (<?php echo $value['User_UUID'];?>)</option>
            <?php } ?>
           </select>
          </div> 
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Result</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">        
         <input type="radio" name="Result" value="Yes" checked="checked" /> Worked  &nbsp;&nbsp; <input type="radio" name="Result" value="No" /> Didn't work
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Comment</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <textarea class="form-control" placeholder="Comment" name="Comment"></textarea>
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
        <button type="submit" class="btn btn-success" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/success_reporting" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
