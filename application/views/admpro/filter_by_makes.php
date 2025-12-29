<table class="table table-striped table-data mar0">
  <thead>
    <tr>
      
       <th>Make </th>
      <th>Model Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom" data_id="ASC" id="makesname_sorting" data-angle ="bottom"> </a></th>
     <th> Type</th>
      <th style="width: 137px;">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
   $i =1;
  if( count($filter_data) > 0) {
  foreach($filter_data as $users){
	$make_id = $users['Make_UUID'];
	$make_name_info = admin_makeNameInfo($make_id );?>
    <tr>
      
      <td><?php echo  $make_name_info[0]['Make_Name'];?></td>
      <td class="sorting-column"><?php echo $users['Model_Name'];?></td>
      <td><?php 
				$vehicle_Type_UUID_info = vehicle_Type_UUID_info($users['Vehicle_Type_UUID']);
				echo $vehicle_Type_UUID_info[0]['type'];?>
       </td> 
      <td><a  href="<?php echo adm_base_url();?>/vehicles/edit_model/<?php echo $users['id'];?>" type="button" class="btn btn-success">Edit</a> <a  href="javascript:void(0)" onclick="DeleteModelFunction(<?php echo $users['id'];?>, '<?php echo adm_base_url();?>/vehicles/deleteModel/')" type="button"class="btn btn-danger">Delete</a> </td>
    </tr>
    <?php }
  }else{?>
  	<tr>
    	<td colspan="5">
        	<div class="alert alert-danger">Data not found!</div>
        </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
