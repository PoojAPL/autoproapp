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
      <th> Name
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> manufacturers_sorting" data-by="Manufacturer_Name" data_id="<?php echo $sorting_id;?>"></a>
      </th>
      <th style="width: 137px;">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $i =1;
  foreach($getAllManufacturer as $users){?>
        <tr>
           <td>
            <span class="td_data"><?php echo $users['Manufacturer_Name'];?></span>
            <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $users['Manufacturer_Name'];?>" data-id="<?php echo $users['id'];?>" data-col="Manufacturer_Name" data-table="t_Manufacturers" data-img=""></span><div class="get_column_data"></div> 
           </td>
          <td><a  href="<?php echo adm_base_url();?>/edit_manufacturer/<?php echo $users['id'];?>" type="button" class="btn btn-success" >Edit</a>   
          <a href="javascript:void(0)" type="button"class="btn btn-danger" onClick="DeleteModelFunction(<?php echo $users['id'];?>, '<?php echo adm_base_url();?>/delete_manufacturer/')">Delete</a>
          </td>
        </tr>
  <?php }  ?>                
   </tbody>
</table>