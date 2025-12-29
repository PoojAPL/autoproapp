<?php
$angle = ""; 
$sorting_id = "";
if($sorting == 'DESC'){
	$sorting_id = 'ASC';
	$angle = 'top';
}else if($sorting == 'ASC'){
	$sorting_id = 'DESC';
	$angle = 'bottom';
}
?>
<table class="table table-striped table-data mar0">
              <thead>
                <tr> 
                <th style="width:137px">Action</th>
                  <th>ID</th> 
                  <th>Name
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> part_sorting" data-by="Part_Name" data_id="<?php echo $sorting_id;?>"></a>
                  </th>  
                  
                  <th>Type</th>  
                 
                  <th>Vehicles</th>
                  <th>Image Url</th> 
                  <th>Products</th>                   
                  
                </tr>
              </thead>
              <tbody>
                  <?php foreach($results as $value){?>
                      <tr>
                      <td>
                              <a href="<?php echo adm_base_url();?>/edit_locks/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a> 
                              <a href="<?php echo adm_base_url();?>/copy_locks/<?php echo $value['id'];?>" type="button" class="btn btn-info" >Copy</a>
                              <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_parts/')" class="btn btn-danger" >Delete</a>
                           </td>
                         <td><?php echo $value['id'];?></td>
                          <td><?php echo $value['Part_Name'];?></td>
                           
                            <td>
                <?php 
                 $PartType_UUID = $value['PartType_UUID'];
                 $get_part_type_info = get_part_type_info($PartType_UUID);
                 echo $get_part_type_info[0]['Name'];
                ?>
                            </td>
                            
                            <td>
                <?php 
                                    if( $value['Vehicles_UUID'] != ""){
                  $vehicles_UUIDs = explode(',', $value['Vehicles_UUID']);
                    for($v = 0; $v < count($vehicles_UUIDs); $v++){
                      $get_vehicles = get_vehicles($vehicles_UUIDs[$v]);
                      $years = explode(',',$get_vehicles[0]['Years']);
                      $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
                      $get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
                      echo $get_make_name[0]['Make_Name'].' ' .$get_models_name[0]['Model_Name'].'  '.$years[0].'-'.$years[count($years)-1].'<br>';
                    }
                  }
                                ?>
                            </td>
                            <td><?php echo $value['Part_Image_Url'];?></td>
                            <td><?php echo $value['Products'];?></td>
                            
                        </tr>
                    <?php } ?>
                </tbody>
            </table>