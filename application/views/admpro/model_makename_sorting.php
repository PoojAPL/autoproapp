<?php 
if($sorting == 'DESC'){
	$sorting_id = 'ASC';
}else if($sorting == 'ASC'){
	$sorting_id = 'DESC';
}
if($angle == 'bottom'){
	$angle_id = 'top';
}else if($angle == 'top'){
	$angle_id = 'bottom';
}
?>
<table class="table table-striped table-data mar0">
  <thead>
    <tr>
     
       <th>Make </th>
      <th>Model Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle_id;?> " data_id="<?php echo $sorting_id;?>" id="makesname_sorting" data-angle ="<?php echo $angle_id;?>"> </a></th>
     
      <th style="width: 137px;">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
   $i =1;
  foreach($data as $users){
		$make_id = $users['Make_UUID'];
		$make_name_info = admin_makeNameInfo($make_id );?>
      <tr>
        <td>                     
            <span class="td_data"><?php echo  $make_name_info[0]['Make_Name'];?> </span>
            <span class="glyphicon glyphicon-pencil edit_table_dropbox" aria-hidden="true" data-val="<?php echo $users['Make_UUID'];?>" data-id="<?php echo $users['id'];?>" data-col="Make_UUID" data-table="t_Models" data-img="" data-type="makeInfo"></span><div class="get_column_data"></div>
        </td>
        <td class="sorting-column">
            <span class="td_data"><?php echo $users['Model_Name'];?></span>
            <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $users['Model_Name'];?>" data-id="<?php echo $users['id'];?>" data-col="Model_Name" data-table="t_Models" data-img=""></span><div class="get_column_data"></div>
        </td>               
        <td><a  href="<?php echo adm_base_url();?>/vehicles/edit_model/<?php echo $users['id'];?>" type="button" class="btn btn-success">Edit</a> 
        <a  href="javascript:void(0)" onclick="DeleteModelFunction(<?php echo $users['id'];?>, '<?php echo adm_base_url();?>/vehicles/deleteModel/')" type="button"class="btn btn-danger">Delete</a>
       </td>
      </tr>
    <?php }  ?>
  </tbody>
</table>
