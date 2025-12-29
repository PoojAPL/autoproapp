
<?php $angle = ""; 
$sorting_id = "";
if($sorting == 'DESC'){
  $sorting_id = 'ASC';
  $angle = 'top';
}else if($sorting == 'ASC'){
  $sorting_id = 'DESC';
  $angle = 'bottom';
}
$vehicles_ids = explode(',', $results['vehicle']);
?><table class="table table-striped table-data mar0">
  <thead>
    <tr> 
      <th>Vehicle</th>  
      <th>Title</th>                
      <th>Content</th>  
      <th>User</th>
      <th>Image</th> 
      <th>YouTube Video IDs</th>
      <th>Score
          <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> keymaking_method_sorting" data_id="<?php echo $sorting_id;?>" data-col="Score"></a>
      </th>                                   
      <th style="width:137px">Action</th>
    </tr>
  </thead>
 	<tbody>
    	<?php 
      if(count($results['result']) > 0){
      foreach( $results['result']  as $value){
          $Vehicle_UUID_data = explode('|',$value['Vehicle_UUID']);
          if( $results['vehicle'] != ""){
          if(array_intersect($vehicles_ids,$Vehicle_UUID_data)){?>
        	<tr>
            	<td> 
                	<?php 
                   $Vehicle_UUID_data = explode('|',$value['Vehicle_UUID']);
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
                 <td> <?php echo stripslashes($value['Title']);?> </td>
                 <td><div class="notes-holder"> <?php echo stripslashes($value['Content']);?></div> </td>
                <td> 
                	<?php $user_id =  $value['User_UUID'];
                  $get_aks_users_info = get_aks_users_info2($user_id);
                  echo $get_aks_users_info[0]['customers_email_address'];
                  ?> 
                </td>
               <td>
                    <?php if($value['Images'] !=""){
                      $images_data = explode(',',$value['Images']);
                      for($im = 0; $im < count($images_data); $im++){?>
                    <img src="<?php echo $images_data[$im];?>" width="50">
                    <?php }
                    } ?>
                </td>
                <td>
                  <div class="coldata-holder">
                    <a href="https://youtu.be/<?php echo $value['Videos'];?>" target="_blank">
                      <?php echo $value['Videos'];?>
                    </a>
                  </div>
                </td>
                <td>
                  <input type="number" class="form-control keymakingMethod_score_order" value="<?php echo $value['Score'];?>" id="<?php echo $value['Id'];?>" style="width: 70px;">
                </td>
                 <td>
                      <a href="<?php echo adm_base_url();?>/copy_method/<?php echo $value['Id'];?>" type="button" class="btn btn-info" >Copy</a>
                      <a href="<?php echo adm_base_url();?>/edit_method/<?php echo $value['Id'];?>" type="button" class="btn btn-success" >Edit</a> 
                      <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['Id'];?>, '<?php echo adm_base_url();?>/delete_method/')" class="btn btn-danger" >Delete</a>
                   </td>
            </tr>

          <?php }
             }else{?> 
             <tr>
              <td> 
                  <?php 
                   $Vehicle_UUID_data = explode('|',$value['Vehicle_UUID']);
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
                 <td> <?php echo stripslashes($value['Title']);?> </td>
                 <td><div class="notes-holder"> <?php echo stripslashes($value['Content']);?></div> </td>
                <td> 
                  <?php $user_id =  $value['User_UUID'];
                  $get_aks_users_info = get_aks_users_info2($user_id);
                  echo $get_aks_users_info[0]['customers_email_address'];
                  ?> 
                </td>
               <td>
                    <?php if($value['Images'] !=""){
                      $images_data = explode(',',$value['Images']);
                      for($im = 0; $im < count($images_data); $im++){?>
                    <img src="<?php echo $images_data[$im];?>" width="50">
                    <?php }
                    } ?>
                </td>
                <td><?php echo $value['Videos'];?></td>
                <td>
                  <input type="number" class="form-control keymakingMethod_score_order" value="<?php echo $value['Score'];?>" id="<?php echo $value['Id'];?>" style="width: 70px;">
                </td>
                 <td>
                      <a href="<?php echo adm_base_url();?>/copy_method/<?php echo $value['Id'];?>" type="button" class="btn btn-info" >Copy</a>
                      <a href="<?php echo adm_base_url();?>/edit_method/<?php echo $value['Id'];?>" type="button" class="btn btn-success" >Edit</a> 
                      <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['Id'];?>, '<?php echo adm_base_url();?>/delete_method/')" class="btn btn-danger" >Delete</a>
                   </td>
            </tr>
          <?php } 
        }?>  
        <?php  
      }else{?>
      <tr>
        <td colspan="10"><div class="alert alert-danger">Data not found.</div></td>
      </tr>
    <?php } ?>
    </tbody>
</table>