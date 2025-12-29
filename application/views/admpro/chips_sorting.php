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
      <th style="width:137px">Action</th>  
      <th>ID</th>       
      <th>AKG#</th>         
      <th> Name 
      <?php if($sorting_by == 'Chip_Name'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> chips_sorting" data-by="Chip_Name"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Chip_Name" data_id="DESC"></a>
       <?php } ?> 
      </th>
      <th>Images 
       <?php if($sorting_by == 'Chip_Image_Url'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> chips_sorting" data-by="Chip_Image_Url"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Chip_Image_Url" data_id="DESC"></a>
       <?php } ?> 
      </th>
      <th>Cloning Type
     <?php if($sorting_by == 'Cloning_type'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> chips_sorting" data-by="Chip_Image_Url"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Cloning_type" data_id="DESC"></a>
       <?php } ?> 
      </th>
      <th>Cloneable
       <?php if($sorting_by == 'Clonable'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> chips_sorting" data-by="Clonable"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Clonable" data_id="DESC"></a>
       <?php } ?> 
      </th>
      <th>Reusable
       <?php if($sorting_by == 'Reusable'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> chips_sorting" data-by="Reusable"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Reusable" data_id="DESC"></a>
       <?php } ?> 
      </th>
      <th>Cloning Chip
       <?php if($sorting_by == 'CloningChip'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> chips_sorting" data-by="CloningChip"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="CloningChip" data_id="DESC"></a>
       <?php } ?> 
      </th>
      <th>Products
       <?php if($sorting_by == 'Products'){?>
      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> chips_sorting" data-by="Products"  data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Products" data_id="DESC"></a>
       <?php } ?> 
      </th>
      <th>Clone With
       <?php if($sorting_by == 'Clone_With'){?>
        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> chips_sorting" data-by="Clone_With" data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Clone_With" data_id="DESC"></a>
      <?php } ?> 
      </th>
      <th>Cloning Machine
       <?php if($sorting_by == 'Clone_With'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> chips_sorting" data-by="Cloning_Machine" data_id="<?php echo $sorting_id;?>"></a>
        <?php }else{ ?>
      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Cloning_Machine" data_id="DESC"></a>
      <?php } ?>
      </th> 
    </tr>
  </thead>
  <tbody>
  <?php 
  $i =1;
  foreach($getAllChips as $value){?>
        <tr> 
          <td><a  href="<?php echo adm_base_url();?>/edit_chips/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
          <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/deletechips/')" type="button"class="btn btn-danger">Delete</a></td> 
          <td><?php echo $value['id'];?></td>  
          <td>
            <span class="td_data"><?php echo $value['akg_num'];?></span>
            <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['akg_num'];?>" data-id="<?php echo $value['id'];?>" data-col="akg_num" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div>
          </td>
          <td>
          <span class="td_data"><?php echo $value['Chip_Name'];?></span>
          <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Chip_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Chip_Name"></span><div class="get_column_data"></div> 
          </td>
          <td>
          <?php
              $images = $value['Chip_Image_Url'];
              if($images ==""){					  
              }else{
                echo '<span class="td_data"><img class="customImage" src ="'.aks_img_url().$images.' "></span>';
              }					  
          ?>
         <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Chip_Image_Url'];?>" data-id="<?php echo $value['id'];?>" data-col="Chip_Image_Url"></span><div class="get_column_data"></div> 
        </td>
        <td>
        <span class="td_data"><?php echo $value['Cloning_type'];?></span>
        <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Cloning_type'];?>" data-id="<?php echo $value['id'];?>" data-col="Cloning_type" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div>
        </td>
          <td>
          <span class="td_data"><?php if($value['Clonable'] == 1){echo 'Yes';}else{echo 'No';}?></span>
          <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Clonable'];?>" data-id="<?php echo $value['id'];?>" data-col="Clonable"></span><div class="get_column_data"></div>
          </td>
          <td>
              <span class="td_data"><?php if($value['Reusable'] == 1){echo 'Yes';}else{echo 'No';}?></span>
              <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Reusable'];?>" data-id="<?php echo $value['id'];?>" data-col="Reusable"></span><div class="get_column_data"></div>
          </td>
           <td>
              <span class="td_data"><?php if($value['CloningChip'] == 1){echo 'Yes';}else{echo 'No';}?></span>
              <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['CloningChip'];?>" data-id="<?php echo $value['id'];?>" data-col="CloningChip"></span><div class="get_column_data"></div>
          </td>
                            
          <td><span class="td_data"><?php echo $value['Products'];?></span>
          <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products"></span><div class="get_column_data"></div> </td>
          
          <td><span class="td_data">
            <?php $chips_data = explode(',',$value['Clone_With']);
                      for($c = 0; $c < count($chips_data); $c++){
                          $get_chips = get_chips($chips_data[$c]);
                          echo $get_chips[0]['Chip_Name'].'<br>';
                      }?>
          </span></td>
          <td><span class="td_data"><?php echo $value['Cloning_Machine'];?></span>
          <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Cloning_Machine'];?>" data-id="<?php echo $value['id'];?>" data-col="Cloning_Machine" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div> </td>                   
          <td>
                 
          </tr>        
    <?php }?>
   </tbody>
</table>      
