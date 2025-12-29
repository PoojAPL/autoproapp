<div id="vehicle_models">
  <?php if($type == 'modal'){?>
    <select class="form-control">
      <option value="">Select model</option>
      <?php foreach($get_models as $model){?>
      <option value="<?php echo $model['UUID'];?>|<?php echo $model['Model_Name'];?>"> <?php echo $model['Model_Name'];?></option>
      <?php } ?>
    </select>
<?php }else if($type == 'years'){ ?>
    <select class="form-control">
      <option value="">Select year</option>
      <?php foreach($get_years as $years){
        $years = explode(',',$years['Years']); 
        if($years[0] == $years[count($years)-1]){?>
           <option><?php echo $years[0];?></option>
        <?php }else{?>
           <option><?php echo $years[0];?>-<?php echo $years[count($years)-1];?></option>
        <?php } ?>   
      <?php } ?>
    </select>
<?php } ?>
</div>
<?php $angle = ""; 
$sorting_id = "";
$sorting = '';
if($sorting == 'DESC'){
  $sorting_id = 'ASC';
  $angle = 'top';
}else if($sorting == 'ASC'){
  $sorting_id = 'DESC';
  $angle = 'bottom';
}
$vehicles_ids = explode(',', $get_all_vehicles_images['vehicle']);
?>
<div id="vehicle_data">
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
    <?php 
    if(count($get_all_vehicles_images['result']) > 0){
    foreach ($get_all_vehicles_images['result'] as $key => $value) { 
      $Vehicle_UUID_data = explode('|',$value['vehicles']);
          if( $get_all_vehicles_images['vehicle'] != ""){
           if(array_intersect($vehicles_ids,$Vehicle_UUID_data)){?>
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
                <a href="<?php echo adm_base_url();?>/vehicles/edit_vehicle_image/<?php echo $value['Image_id'];?>" type="button" class="btn btn-success" >Edit</a> 
                <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['Image_id'];?>, '<?php echo adm_base_url();?>/vehicles/delete_vehicle_image/')" class="btn btn-danger" >Delete</a>
              </td>
             </tr>
        <?php }
        }else{?>
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
       <?php }  ?>
    <?php }
    }else{?>
      <tr>
        <td colspan="5"><div class="alert alert-danger">Data not found.</div></td>
      </tr>
    <?php } ?>  
  </tbody>
</table>
</div>