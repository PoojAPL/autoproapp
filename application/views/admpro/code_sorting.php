<?php
$angle = ""; 
$sorting_id = "";
if($sorting == 'DESC'){
	$sorting_id = 'ASC';
	$angle = 'bottom';
}else if($sorting == 'ASC'){
	$sorting_id = 'DESC';
	$angle = 'top';
}
?>
<table class="table table-striped table-data mar0">
  <thead>
    <tr>                  
      <th>Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> code_sorting" data_id="<?php echo $sorting_id;?>"></a></th>
      <th>Spaces </th>
      <th>Depths</th>
      <th>MACS</th>
      <th>Key Style</th>
      <th>HPC PUNCH</th>
      <th>HPC Blitz Card</th>
      <th style="width:137px;"> Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
   $i = 1;
   foreach($getAllCodeSeries as $value){
        $key_id = $value['Key_Style_UUID'];
        $key_name_info = admin_KeyNameInfo($key_id );
        ?>
        <tr>
          <td><?php echo $value['Code_Series_Name'];?></td>
          <td><?php echo $value['Spaces'];?></td>
          <td><?php echo $value['Depths'];?></td>
          <td><?php echo $value['MACS'];?></td>
          <td><?php echo  $key_name_info[0]['Key_Style_Name'];?></td>
          <td></td>
          <td></td>
          <td><a  href="<?php echo adm_base_url();?>/vehicles/edit_codeSeries/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
          <a  href="javascript:void(0)" onclick="DeleteCodeFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/vehicles/deleteCode/')" type="button"class="btn btn-danger" >Delete</a></td>
          </tr>
        </tr> 
    <?php } ?>
   </tbody>
</table>
         