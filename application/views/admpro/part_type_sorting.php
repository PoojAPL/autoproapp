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
      <th>Name
      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> part_type_sorting" data-by="Name" data_id="<?php echo $sorting_id;?>"></a>
      </th>                  
      <th style="width:137px">Action</th>
    </tr>
  </thead>
    <tbody>
        <?php foreach($results as $value){?>
            <tr>
                <td><?php echo $value['Name'];?></td>
                <td>
                  <a href="<?php echo adm_base_url();?>/edit_part_type/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a> 
                  <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_part_type/')" class="btn btn-danger" >Delete</a>
               </td>
            </tr>
        <?php } ?>
    </tbody>
</table>