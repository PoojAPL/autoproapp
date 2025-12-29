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
      <th>ID</th>   
      <th>AKG#</th>              
      <th>Name 
        <?php if($sorting_by == 'Battery_Name'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> battery_sorting" data-by="Battery_Name"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom battery_sorting" data-by="Battery_Name" data_id="DESC"></a>
       <?php } ?> 
      </th>
      <th>Images 
      <?php if($sorting_by == 'Battery_Image_Url'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> battery_sorting" data-by="Battery_Image_Url"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom battery_sorting" data-by="Battery_Image_Url" data_id="DESC"></a>
       <?php } ?> 
      </th>                  
      <th>Products
      <?php if($sorting_by == 'Products'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> battery_sorting" data-by="Products"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom battery_sorting" data-by="Products" data_id="DESC"></a>
      <?php } ?> 
      </th>
      <th style="width:137px">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $i =1;
  foreach($getAllbatteries as $value){?>
        <tr> 
        <td><?php echo $value['id'];?></td> 
        <td>
          <span class="td_data"><?php echo $value['akg_num'];?></span>
          <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['akg_num'];?>" data-id="<?php echo $value['id'];?>" data-col="akg_num" data-table="t_Batteries" data-img="Battery_Image_Url"></span><div class="get_column_data"></div>
        </td>                     
        <td class="sorting-column">                      	 
          <span class="td_data"><?php echo $value['Battery_Name'];?></span>
          <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Battery_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Battery_Name" data-table="t_Batteries" data-img="Battery_Image_Url"></span><div class="get_column_data"></div> 
        </td>
        <td>
        <?php
        $images = $value['Battery_Image_Url'];
        if($images ==""){					  
        }else{
          echo '<span class="td_data"><img class="customImage" src ="'.aks_img_url().$images.' "></span>';
        }					  
        ?>
         <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Battery_Image_Url'];?>" data-id="<?php echo $value['id'];?>" data-col="Battery_Image_Url" data-table="t_Batteries" data-img="Battery_Image_Url"></span><div class="get_column_data"></div>
      </td>
          <td><span class="td_data"><?php echo $value['Products'];?></span>
          <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products" data-table="t_Batteries" data-img="Battery_Image_Url"></span><div class="get_column_data"></div>
       </td>
         <td><a  href="<?php echo adm_base_url();?>/edit_battery/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
        <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_battery/')" type="button"class="btn btn-danger" >Delete</a></td>
      </tr>   
    <?php }?>
   </tbody>
</table>
         
