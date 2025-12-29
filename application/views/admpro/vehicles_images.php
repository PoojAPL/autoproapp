<div id="right-container">
  <div class="site-form form-inline">
    <div class="row displayFlexRow"> 
      <div class="col-sm-5">
        <div class="form-group">
           <label>Show Make</label>
             <select class="form-control select-field filterVehicleImagesByMake">
              <option value="">Select Make</option>
                <?php foreach($getAllMakeNames as $makes){ ?>
                  <option value="<?php echo $makes['UUID'];?>|<?php echo $makes['Make_Name'];?>"><?php echo $makes['Make_Name'];?></option>
                <?php } ?>
             </select>
        </div>
      </div>
      <div class="col-sm-5">
        <div class="form-group ">
           <label>Show Model</label>
             <span class="getModels filterVehicleImageByModel">
             <select class="form-control select-field">               
             </select>
            </span>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group ">
           <label>Show Year</label>
             <span class="getYears filterVehicleImageByYears">
             <select class="form-control select-field">               
             </select>
            </span>
        </div>
      </div>
      <div class="col-sm-7">
      <form method="post" id="searchVehicleImage" novalidate="novalidate">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control searchingV" placeholder="Enter at least 3 characters for searching">
                     <button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
     </div>   	
      <div class="col-sm-3">
        <div class="form-group addCodeSeries">
          <a href="<?php echo adm_base_url();?>/vehicles/firebase_update_vehicles_images" class="btn btn-success firebaseUpdate" style="margin-bottom: 10px;">Firebase Update</a>
          <a href="<?php echo adm_base_url();?>/vehicles/add_vehicles_images" class="btn btn-danger">Add New Image</a>
     </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="table-responsive tool_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr> 
                  <th>Vehicle(s)</th>   
                  <th>User</th> 
                  <th>Image</th>                                
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
             	<tbody>
                <?php foreach ($get_all_vehicles_images as $key => $value) { ?>
                 <tr>
                  <td>
                    <?php 
                     $Vehicle_UUID_data = explode('|',$value['vehicles']);
                     sort($Vehicle_UUID_data);
                     foreach ($Vehicle_UUID_data as $value2) {
                      $value2_data = explode('__', $value2);
                      $get_vehicles_by_id = get_vehicles_by_id($value2_data[0]);
                      $vehicles = $get_vehicles_by_id[0];
                      $years = explode(',',$vehicles['Years']);
                      $get_models_name = get_models_name($vehicles['Model_UUID']);
                      $get_make_name = get_make_name($vehicles['Model_UUID']);
                      $Code_Series_Name = '';                 
                      $got_series_data = explode(',',$vehicles['Code_Series_UUID']);

                       if($Code_Series_Name !=""){
                        $option_name = $get_make_name[0]['Make_Name'].' '.$get_models_name[0]['Model_Name'].' ('.$years[0].'-'.$years[count($years)-1].') ('.$Code_Series_Name.')';
                       }else{
                        $option_name = $get_make_name[0]['Make_Name'].' '.$get_models_name[0]['Model_Name'].' ('.$years[0].'-'.$years[count($years)-1].')';
                      }
                      echo $option_name.'<br>';
                     };
                    ?>
                  </td>
                  <td>
                    <?php $user_id =  $value['user'];
                    $get_aks_users_info = get_aks_users_info2($user_id);
                    echo $get_aks_users_info[0]['customers_email_address'];
                    ?>
                  </td>
                  <td>
                    <?php if($value['Image_path'] != ""){
                     $image_data = explode(',',$value['Image_path']);
                     for($i=0; $i < count($image_data);$i++){?>
                        <img src="<?php echo $image_data[$i];?>" width="50">
                    <?php }
                    } ?>
                  </td>
                  <td>
                    <a href="<?php echo adm_base_url();?>/vehicles/copy_vehicle_image/<?php echo $value['Image_id'];?>" type="button" class="btn btn-info" >Copy</a>
                    <a href="<?php echo adm_base_url();?>/vehicles/edit_vehicle_image/<?php echo $value['Image_id'];?>" type="button" class="btn btn-success" >Edit</a> 
                    <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['Image_id'];?>, '<?php echo adm_base_url();?>/vehicles/delete_vehicle_image/')" class="btn btn-danger" >Delete</a>
                  </td>
                 </tr>
                <?php } ?>	
              </tbody>
            </table>
            
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- right container start here --> 
