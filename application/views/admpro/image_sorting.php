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
     <th>Image</th>		 
      <th>Type 
        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> image_sorting_by_type" data_id="<?php echo $sorting_id;?>" data-sort="Image_Type_UUID"></a>
      </th>	               
      <th>Filename </th>                                  
      <th style="width:137px">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($results as $value){?>
        <tr>
        	 <td>
                <?php 
                if($value['Filename'] != ""){?>
                    <img src="<?php echo base_url();?>images/<?php echo $value['Filename'];?>" class="customImage" />
                <?php } ?>                        
            </td>
            <td>
                <?php 
                    $get_image_type = get_image_type( $value['Image_Type_UUID'] ); 
                    echo $get_image_type[0]['Name'];
                ?>                        
            </td>
           <td><?php echo $value['Filename'];?></td>
            <td>
                <a href="<?php echo adm_base_url();?>/edit_image/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>   
                <a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_image/')" class="btn btn-danger" >Delete</a>
            </td>
        </tr>
    <?php }	?>
  </tbody>
</table>            
         