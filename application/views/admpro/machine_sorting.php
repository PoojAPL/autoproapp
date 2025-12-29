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
  	<?php if($sort_by == 'Type'){?> 
    <th>Type <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> machine_sorting" data_id="<?php echo $sorting_id;?>" data-sort="Type"></a></th> 
    <?php }else{ ?>
    	 <th>Type <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom machine_sorting" data_id="DESC" data-sort="Type"></a></th>
    <?php } ?>
    <?php if($sort_by == 'Name'){?> 
    <th>Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> machine_sorting" data_id="<?php echo $sorting_id;?>" data-sort="Name"></a></th>
    <?php }else{ ?>
    	 <th>Type <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom machine_sorting" data_id="DESC" data-sort="Name"></a></th>
    <?php } ?>
    <th>Products</th>                  
    <th style="width:137px">Action</th>
  </tr>
</thead>
<tbody>
  <?php                   
  foreach($results as $value){?>
          <tr>
              <td>
                  <?php $get_mchine_type_info =  get_mchine_type_info($value['Type']);?>
                  <span class="td_data"><?php echo $get_mchine_type_info[0]['Machines_Info_Type_Name'];;?></span>                                
              </td>
              <td>
              <span class="td_data"><?php echo $value['Name'];?></span>            		 		
              </td>
              <td>
              <span class="td_data"><?php echo $value['Products'];?></span>            		 		
              </td>
              <td>
                  <a  href="<?php echo adm_base_url();?>/edit_machine/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>   
                  <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_machine/')" class="btn btn-danger" >Delete</a>
              </td>
          </tr>         
  <?php }?>
</tbody>
</table>            
          