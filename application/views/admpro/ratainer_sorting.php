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
      <th>Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> ratainer_sorting" data_id="<?php echo $sorting_id;?>"></a></th>                  
      <th style="width:137px">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $i =1;
  foreach($getRetainers as $value){?>
        <tr>                      
          <td class="sorting-column"><?php echo $value['Retainer_Name'];?></td>                      
         <td><a  href="<?php echo adm_base_url();?>/edit_retainer/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
          <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_retainer/')" type="button"class="btn btn-danger" >Delete</a></td>
         </tr>
        </tr> 
    <?php }?>
   </tbody>
</table>
         
