<?php
error_reporting(0);
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
      <th>Tool Type <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> tools_sorting_by_type" data_id="<?php echo $sorting_id;?>"  data-sort="tool_type"></a></th>
      <th>Manufacturer  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom tools_sorting_by_manufacturer" data_id="DESC"></a></th>
      <th>Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom tools_sorting" data_id="DESC"></a></th>
      <th>Note</th>
     
      <th>Products</th>
      <th style="width:137px">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php                   
    foreach($getAllToolsType as $t_value){
		$type_uuid = $t_value['UUID'];
		$get_tools_by_types = get_tools_by_types($type_uuid);		
		if( count($get_tools_by_types) > 0){
			foreach($get_tools_by_types as $value){?>
			<tr>
              <td><?php
              $images = $value['Tool_Image_Url'];
              if($images ==""){					  
              }else{					  
                echo '<span class="td_data"><img class="customImage" src ="'.aks_img_url().$images.' "></span>';
              }					  
              ?>                     
              <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Tool_Image_Url'];?>" data-id="<?php echo $value['id'];?>" data-col="Tool_Image_Url"></span><div class="get_column_data"></div> 
              </td>
              <td class="sorting-column">
              <?php   
				$Tool_Type_Name = "";
				$Tool_Type_UUID = explode(',',$value['Tool_Type_UUID']);
				for($tl = 0; $tl < count($Tool_Type_UUID); $tl++){
					$get_tool_type = get_tool_type($Tool_Type_UUID[$tl]);
					$Tool_Type_Name .= $get_tool_type[0]['Tool_Type_Name'].'<br>';
				}
				?>
			  <?php echo $Tool_Type_Name;?>
              </td>
              <td class="sorting-column">
                <?php $manufacturer_UUID =  $value['Manufacturer_UUID'];
                $get_manufacturer = get_manufacturer($manufacturer_UUID);
                 ?>
                <span class="td_data"><?php echo $get_manufacturer[0]['Manufacturer_Name']; ?></span>
               <span class="glyphicon glyphicon-pencil edit_tools_dropbox" aria-hidden="true" data-val="<?php echo $value['Manufacturer_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Manufacturer_UUID" data-key="Manufacturer_UUID" data-type="Manufacturer_UUID"></span><div class="get_column_data" ></div>
              </td>                     
              <td class="sorting-column"><span class="td_data"><?php echo $value['Tool_Name'];?></span>
              <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Tool_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Tool_Name"></span><div class="get_column_data"></div>
              </td>
              <td><span class="td_data"><?php echo $value['Tool_Note'];?></span>
              <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Tool_Note'];?>" data-id="<?php echo $value['id'];?>" data-col="Tool_Note"></span><div class="get_column_data"></div>
              </td>
              <td><span class="td_data"><?php echo $value['Products'];?></span>
              <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products"></span><div class="get_column_data"></div>
              </td>                      
             
              <td>
              <a href="<?php echo adm_base_url();?>/edit_tools/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a> 
              <a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_tools/')" type="button"class="btn btn-danger" >Delete</a>
              </td>
            </tr>             
    <?php }
		}	
	}?>
  </tbody>
</table>
         