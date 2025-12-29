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
      <th>Category 
      <?php if($sort_by == 'Category_UUID'){?>
          		<a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> obp_cat_options" data_id="<?php echo $sorting_id;?>" data-sort="Category_UUID"></a>
          <?php }else{ ?>
              <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom obp_cat_options" data_id="DESC" data-sort="Category_UUID"></a>
        <?php }?>       
      </th>	               
      <th>Default Text 
		 <?php if($sort_by == 'Default_Text'){?>
            <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> obp_cat_options" data_id="<?php echo $sorting_id;?>" data-sort="Default_Text"></a>
      	<?php }else{ ?>
          <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom obp_cat_options" data_id="DESC" data-sort="Default_Text"></a>
    	<?php }?>     
      </th> 
      <th>Image </th>                                 
      <th style="width:137px">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($results as $value){?>
        <tr>
            <td>
                <?php 
                    $get_obp_category = get_obp_category($value['Category_UUID']);
                    echo $get_obp_category[0]['Name'];
                ?>
            </td>
            <td><?php echo $value['Default_Text'];?></td>
            <td>
                <?php 
                    $get_image = get_image($value['Default_Image_UUID']);
                    if($get_image[0]['Filename'] != ""){?>
                    <img class="customImage" src="<?php echo base_url();?>images/<?php echo $get_image[0]['Filename'];?>" />
                <?php } ?>
            </td>
            <td>
                <a href="<?php echo adm_base_url();?>/vehicles/edit_obp_options/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>   
                <a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/vehicles/delete_obp_options/')" class="btn btn-danger" >Delete</a>
            </td>
        </tr>
    <?php }	?>
  </tbody>
</table>            
         