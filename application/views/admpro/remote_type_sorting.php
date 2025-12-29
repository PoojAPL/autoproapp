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
$hide_remote_Vehicles = '';
$checked_remote_Vehicles = "";
$v_value = 'true';
if( isset($_POST['remote_Vehicles']) && $_POST['remote_Vehicles'] !=""){
  $_SESSION['hide_remote_Vehicles'] = $_POST['remote_Vehicles'];
}
if( isset($_SESSION['hide_remote_Vehicles']) && $_SESSION['hide_remote_Vehicles'] == 'true'){  
  $hide_remote_Vehicles = 'hide';
  $checked_remote_Vehicles = 'checked';
  $v_value = 'false';
}

$hide_remote_image = '';
$checked_remote_image = "";
$img_value = 'true';
if( isset($_POST['remote_image']) && $_POST['remote_image'] !=""){
  $_SESSION['hide_remote_image'] = $_POST['remote_image'];
}
if( isset($_SESSION['hide_remote_image']) && $_SESSION['hide_remote_image'] == 'true'){  
  $hide_remote_image = 'hide';
  $checked_remote_image = 'checked';
  $img_value = 'false';
}

$hide_remote_OEM_Part_Number = '';
$checked_remote_OEM_Part_Number = "";
$OEM_Part_Number_value = 'true';
if( isset($_POST['remote_OEM_Part_Number']) && $_POST['remote_OEM_Part_Number'] !=""){
  $_SESSION['hide_remote_OEM_Part_Number'] = $_POST['remote_OEM_Part_Number'];
}
if( isset($_SESSION['hide_remote_OEM_Part_Number']) && $_SESSION['hide_remote_OEM_Part_Number'] == 'true'){  
  $hide_remote_OEM_Part_Number = 'hide';
  $checked_remote_OEM_Part_Number = 'checked';
  $OEM_Part_Number_value = 'false';
}


$hide_remote_Buttons = '';
$checked_remote_Buttons = "";
$Buttons_value = 'true';
if( isset($_POST['remote_Buttons']) && $_POST['remote_Buttons'] !=""){
  $_SESSION['hide_remote_Buttons'] = $_POST['remote_Buttons'];
}
if( isset($_SESSION['hide_remote_Buttons']) && $_SESSION['hide_remote_Buttons'] == 'true'){  
  $hide_remote_Buttons = 'hide';
  $checked_remote_Buttons = 'checked';
  $Buttons_value = 'false';
}
$hide_remote_fcci = '';
$checked_remote_fcci = "";
$fcci_value = 'true';
if( isset($_POST['remote_fcci']) && $_POST['remote_fcci'] !=""){
  $_SESSION['hide_remote_fcci'] = $_POST['remote_fcci'];
}
if( isset($_SESSION['hide_remote_fcci']) && $_SESSION['hide_remote_fcci'] == 'true'){  
  $hide_remote_fcci = 'hide';
  $checked_remote_fcci = 'checked';
  $fcci_value = 'false';
}
$hide_remote_keys = '';
$checked_remote_keys = "";
$keys_value = 'true';
if( isset($_POST['remote_keys']) && $_POST['remote_keys'] !=""){
  $_SESSION['hide_remote_keys'] = $_POST['remote_keys'];
}
if( isset($_SESSION['hide_remote_keys']) && $_SESSION['hide_remote_keys'] == 'true'){  
  $hide_remote_keys = 'hide';
  $checked_remote_keys = 'checked';
  $keys_value = 'false';
}
$hide_remote_Reusable = '';
$checked_remote_Reusable = "";
$Reusable_value = 'true';
if( isset($_POST['remote_Reusable']) && $_POST['remote_Reusable'] !=""){
  $_SESSION['hide_remote_Reusable'] = $_POST['remote_Reusable'];
}
if( isset($_SESSION['hide_remote_Reusable']) && $_SESSION['hide_remote_Reusable'] == 'true'){  
  $hide_remote_Reusable = 'hide';
  $checked_remote_Reusable = 'checked';
  $Reusable_value = 'false';
}
$hide_remote_Frequency = '';
$checked_remote_Frequency = "";
$Frequency_value = 'true';
if( isset($_POST['remote_Frequency']) && $_POST['remote_Frequency'] !=""){
  $_SESSION['hide_remote_Frequency'] = $_POST['remote_Frequency'];
}
if( isset($_SESSION['hide_remote_Frequency']) && $_SESSION['hide_remote_Frequency'] == 'true'){  
  $hide_remote_Frequency = 'hide';
  $checked_remote_Frequency = 'checked';
  $Frequency_value = 'false';
}

$hide_remote_Battery = '';
$checked_remote_Battery = "";
$Battery_value = 'true';
if( isset($_POST['remote_Battery']) && $_POST['remote_Battery'] !=""){
  $_SESSION['hide_remote_Battery'] = $_POST['remote_Battery'];
}
if( isset($_SESSION['hide_remote_Battery']) && $_SESSION['hide_remote_Battery'] == 'true'){  
  $hide_remote_Battery = 'hide';
  $checked_remote_Battery = 'checked';
  $Battery_value = 'false';
}

$hide_remote_Chip = '';
$checked_remote_Chip = "";
$Chip_value = 'true';
if( isset($_POST['remote_Chip']) && $_POST['remote_Chip'] !=""){
  $_SESSION['hide_remote_Chip'] = $_POST['remote_Chip'];
}
if( isset($_SESSION['hide_remote_Chip']) && $_SESSION['hide_remote_Chip'] == 'true'){  
  $hide_remote_Chip = 'hide';
  $checked_remote_Chip = 'checked';
  $Chip_value = 'false';
}

$hide_remote_Shells = '';
$checked_remote_Shells = "";
$Shells_value = 'true';
if( isset($_POST['remote_Shells']) && $_POST['remote_Shells'] !=""){
  $_SESSION['hide_remote_Shells'] = $_POST['remote_Shells'];
}
if( isset($_SESSION['hide_remote_Shells']) && $_SESSION['hide_remote_Shells'] == 'true'){  
  $hide_remote_Shells = 'hide';
  $checked_remote_Shells = 'checked';
  $Shells_value = 'false';
}
?>
<table class="table table-striped table-data mar0 tab-con">
<thead>
  <tr> 
    <th style="width:137px">Action</th>
    <th>EZ#
    <?php if($sorting_by == 'id'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="id" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="id" data_id="DESC"></a>
     <?php } ?>
    </th> 
    <th>AKG#
    <?php if($sorting_by == 'id'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="id" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="id" data_id="DESC"></a>
     <?php } ?>
    </th> 
    <th>Type 
    <?php if($sorting_by == 'Remote_Type_UUID'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="Remote_Type_UUID" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Remote_Type_UUID" data_id="DESC"></a>
     <?php } ?> 
    </th>	               
    <th>Name 
     <?php if($sorting_by == 'Remote_Name'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="Remote_Name" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Remote_Name" data_id="DESC"></a>
     <?php } ?>   
    </th>
    <th class="<?php echo $hide_remote_Vehicles;?>">Vehicles</th>
    <th class="<?php echo $hide_remote_image;?>">Image
     <?php if($sorting_by == 'Remote_Image_Url'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="Remote_Image_Url" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Remote_Image_Url" data_id="DESC"></a>
     <?php } ?>   
    </th> 
    <th class="<?php echo $hide_remote_OEM_Part_Number;?>">OEM Part Number
    <?php if($sorting_by == 'OEM_Part_Number'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="OEM_Part_Number" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="OEM_Part_Number" data_id="DESC"></a>
     <?php } ?>   
    </th>
    <th class="<?php echo $hide_remote_Buttons;?>">Buttons 
     <?php if($sorting_by == 'Buttons'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="Buttons" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Buttons" data_id="DESC"></a>
      <?php } ?>   
    </th> 
    <th class="<?php echo $hide_remote_fcci;?>">FCC/IC/Continental IDs
     <?php if($sorting_by == 'FCCID'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="FCCID" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="FCCID" data_id="DESC"></a>
     <?php } ?>   
    </th>
    
    <th class="<?php echo $hide_remote_Frequency;?>">Frequency
     <?php if($sorting_by == 'Frequency'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="Frequency" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Frequency" data_id="DESC"></a>
    <?php } ?>   
    </th>                                 
    <th class="<?php echo $hide_remote_Battery;?>">Battery
    <?php if($sorting_by == 'Battery_UUID'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="Battery_UUID" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Battery_UUID" data_id="DESC"></a>
     <?php } ?>   
    </th>
    <th class="<?php echo $hide_remote_Chip;?>">Chip
    <?php if($sorting_by == 'Chip_UUID'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="Chip_UUID" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Chip_UUID" data_id="DESC"></a>
    <?php } ?>   
    </th>
    <th class="<?php echo $hide_remote_keys;?>">Test Key
     <?php if($sorting_by == 'TestKey_UUID'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="TestKey_UUID" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="TestKey_UUID" data_id="DESC"></a>
    <?php } ?> 
    </th>
	 <th class="<?php echo $hide_remote_keys;?>">Emergency Keys</th>
    <th class="<?php echo $hide_remote_Shells;?>">Remote Shell</th>
    <th  class="<?php echo $hide_remote_Reusable;?>">Reusable? 
    <?php if($sorting_by == 'Reusable'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="Reusable" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Reusable" data_id="DESC"></a>
    <?php } ?> 
    </th>                                   
    <th>Products
    <?php if($sorting_by == 'Products'){?>
     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> remote_type_sorting" data-by="Products" data_id="<?php echo $sorting_id;?>"></a>
     <?php }else{ ?>
    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Products" data_id="DESC"></a>
    <?php } ?> 
    </th>    
  </tr>
</thead>
<tbody>
 <?php 
 if($results){
        $i =1;
        foreach($results as $value){?>
                    <tr> 
                      <td>
                       <a  href="<?php echo adm_base_url();?>/copy_remote/<?php echo $value['id'];?>" type="button" class="btn btn-info" >Copy</a>                       
                       <a  href="<?php echo adm_base_url();?>/edit_remote/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                      <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_remote/')" type="button"class="btn btn-danger" >Delete</a></td>
                      <td style="white-space:nowrap;">
                            <div class="product-holder"><span class="td_data"><?php echo $value['ez'];?></span></div>
                            <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['ez'];?>" data-id="<?php echo $value['id'];?>" data-col="ez"></span>
                            <div class="get_column_data"></div>
                      </td>
                      <td style="white-space:nowrap;">
                            <div class="product-holder"><span class="td_data"><?php echo $value['akg_num'];?></span></div>
                            <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['akg_num'];?>" data-id="<?php echo $value['id'];?>" data-col="akg_num"></span>
                            <div class="get_column_data"></div>
                      </td> 
                      <td>
                        <?php $get_remote_types = get_remote_types($value['Remote_Type_UUID']);?>
                        <div class="product-holder"><span class="td_data"><?php echo $get_remote_types[0]['Remote_Type_Name'];?></span></div>
                       <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Remote_Type_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Remote_Type_UUID" data-key="Remote_Type_UUID" data-type="Remote_Type_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="sorting-column">
                          <div class="product-holder"><span class="td_data"><?php echo $value['Remote_Name'];?></span></div>
                            <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['Remote_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Remote_Name"></span><div class="get_column_data"></div>                          
                      </td>
                      <td class="<?php echo $hide_remote_Vehicles;?>">
					   <div class="remoteInfoRow">
                        <?php 
							  if( $value['Vehicles_UUID'] != ""){
							  $vehicles_UUIDs = explode(',', $value['Vehicles_UUID']);
								for($v = 0; $v < count($vehicles_UUIDs); $v++){
								  $get_vehicles = get_vehicles($vehicles_UUIDs[$v]);
								  $years = explode(',',$get_vehicles[0]['Years']);
								  $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
								  $get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
								  echo $get_make_name[0]['Make_Name'].' ' .$get_models_name[0]['Model_Name'].'  '.$years[0].'-'.$years[count($years)-1].'<br>';
								}
							  }
							?>
						</div>
                      </td>                      
                      <td class="<?php echo $hide_remote_image;?>">
                        <?php
                        $images = $value['Remote_Image_Url'];
                        if($images ==""){           
                        }else{
                        echo '<span class="td_data"><img class="customImage" src ="'.aks_img_url().$images.' "></span>';
                        }           
                        ?>
                        <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['Remote_Image_Url'];?>" data-id="<?php echo $value['id'];?>" data-col="Remote_Image_Url"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="<?php echo $hide_remote_OEM_Part_Number;?>">
                        <div class="product-holder"><span class="td_data"><?php echo $value['OEM_Part_Number'];?></span></div>
                        <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['OEM_Part_Number'];?>" data-id="<?php echo $value['id'];?>" data-col="OEM_Part_Number"></span><div class="get_column_data"></div>
                      </td>
                      <td class="<?php echo $hide_remote_Buttons;?>">
                         <span class="td_data remoteInfoRow">
                          <?php $buttons_array  = explode(',',$value['Buttons']);
                            for($i = 0; $i < count( $buttons_array)-1; $i++ ){
                                $get_buttons_info = get_buttons_info($buttons_array[$i]); 
                                if( count($get_buttons_info) > 0){
                                        echo $get_buttons_info[0]['Name'].'<br>';
                                }
                            }
                            ?>
                        </span>
                       <!--<span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Buttons'];?>" data-id="<?php echo $value['id'];?>" data-col="Buttons" data-key="Buttons" data-type="Buttons"></span><div class="get_column_data" ></div>-->
                      </td>
                      <td class="<?php echo $hide_remote_fcci;?>">
                      <?php if($value['FCCID'] != ""){?>
                          <span class="td_data"><strong>FCC:</strong> <?php echo $value['FCCID'];?></span><br>
                      <?php } ?>
                      <?php if($value['IC'] != ""){?>
                          <span class="td_data"><strong>IC:</strong> <?php echo $value['IC'];?></span><br>
                      <?php } ?>
                      <?php if($value['Continental_ID'] != ""){?>
                          <span class="td_data"><strong>Cont:</strong> <?php echo $value['Continental_ID'];?></span> 
                      <?php } ?>
                      </td>                      
                      <td class="<?php echo $hide_remote_Frequency;?>">
                        <?php $get_frequency_info = get_frequency_info($value['Frequency']);?>
                        <span class="td_data"><?php echo $get_frequency_info[0]['Name'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Frequency'];?>" data-id="<?php echo $value['id'];?>" data-col="Frequency" data-key="Frequency" data-type="Frequency"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_Battery;?>">
                        <?php $get_batteries = get_batteries($value['Battery_UUID']);?>
                        <span class="td_data"><?php echo $get_batteries[0]['Battery_Name'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Battery_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Battery_UUID" data-key="Battery_UUID" data-type="Battery_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_Chip;?>">
                      <?php $get_chips = get_chips($value['Chip_UUID']);?> 
                        <div class="product-holder"><span class="td_data"><?php echo $get_chips[0]['Chip_Name'];?></span></div>
                        <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Chip_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Chip_UUID" data-key="Chip_UUID" data-type="Chip_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_keys;?>">
                      <?php $get_kyes = get_key_name($value['TestKey_UUID']);?> 
                        <span class="td_data"><?php echo $get_kyes[0]['Key_Name'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['TestKey_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="TestKey_UUID" data-key="TestKey_UUID" data-type="TestKey_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_keys;?>">
					   <div class="remoteInfoRow">
							<?php 
							$explode =  explode(',',$value['Emergency_Key_UUID']);
							foreach($explode as $emr_key){						
							$get_kyes = get_key_name($emr_key);
							echo $get_kyes[0]['Key_Name'].'<br>';;
							}?> 
						</div>						
                      </td>
                     
                      <td class="<?php echo $hide_remote_Shells;?>">
                      <?php $shell_array  = $value['Shell_UUID'];
                            $get_remote_name = get_remote_shell_name($shell_array);?>
                        <div class="product-holder"><span class="td_data"><?php  echo $get_remote_name[0]['Remote_Name'];?></span></div>
                        <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Shell_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Shell_UUID" data-key="Shell_UUID" data-type="Shell_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_Reusable;?>">
                        <div class="product-holder"><span class="td_data"><?php echo $value['Reusable'];?></span></div>
                        <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Reusable'];?>" data-id="<?php echo $value['id'];?>" data-col="Reusable" data-key="Reusable" data-type="Reusable"></span><div class="get_column_data"></div> 
                      </td>
                      <td>
                        <span class="td_data"><?php echo $value['Products'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products"></span><div class="get_column_data"></div> 
                      </td>                                    
                      </tr>                   
        <?php }}else{

	echo "<div class='alert alert-danger'>Data not found .Please try again </div>";
}?>
               </tbody>
</table>

            