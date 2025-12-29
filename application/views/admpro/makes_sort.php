<?php 
if($sorting == 'DESC'){
	$sorting_id = 'ASC';
}else if($sorting == 'ASC'){
	$sorting_id = 'DESC';
}
?>
<?php 
if($angle == 'bottom'){
	$angle_id = 'top';
}else if($angle == 'top'){
	$angle_id = 'bottom';
}
?>
<table class="table table-striped table-data mar0">
  <thead>
    <tr>
      
      <th>Name <a href="javascript:void(0)" type="button" data_id="<?php echo $sorting_id;?>" id="sortlist" class="glyphicon glyphicon-triangle-<?php echo $angle_id;?>" data-angle ="<?php echo $angle_id;?>"></a> </th>
      <th style="width: 137px;">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $i =1;
  foreach($data as $users){?>
        <tr>
         <td class="sorting-column">
            <span class="td_data"><?php echo $users['Make_Name'];?></span>
            <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $users['Make_Name'];?>" data-id="<?php echo $users['id'];?>" data-col="Make_Name" data-table="t_Makes" data-img=""></span><div class="get_column_data"></div>
         </td>
          <td><a  href="<?php echo adm_base_url();?>/vehicles/edit_MakeName/<?php echo $users['id'];?>" type="button" class="btn btn-success" >Edit</a>   
          <a  href="javascript:void(0)" onclick="DeleteMakeName(<?php echo $users['id'];?>, '<?php echo adm_base_url();?>/vehicles/deletemakesname/')" type="button"class="btn btn-danger" >Delete</a>
          </td>
        </tr>
  <?php }  ?>                
   </tbody>
</table>

