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
}else{
	$sorting_id = 'ASC';
	$angle = 'bottom';
}
$advanced_hide = '';
$advanced_checked = '';
 if(isset($_COOKIE['Advanced_cookie'])){ 
	 $cookieValue = $_COOKIE['Advanced_cookie'];
	 if( $cookieValue == 1){
		$advanced_hide = 'hide';
		$advanced_checked = 'checked';
	 }else{
		$machine_hide = '';
		$advanced_checked = '';
	 }
} 
$prolok_hide = '';
$prolok_checked = '';
 if(isset($_COOKIE['Prolok_cookie'])){ 
	 $cookieValue = $_COOKIE['Prolok_cookie'];
	 if( $cookieValue == 1){
		$prolok_hide = 'hide';
		$prolok_checked = 'checked';
	 }else{
		$prolok_hide = '';
		$prolok_checked = '';
	 }
 }
 $code_keyInfo_hide = '';
$code_keyInfo_checked = '';
 if(isset($_COOKIE['code_keyInfo_cookie'])){ 
	 $cookieValue = $_COOKIE['code_keyInfo_cookie'];
	 if( $cookieValue == 1){
		$code_keyInfo_hide = 'hide';
		$code_keyInfo_checked = 'checked';
	 }else{
		$code_keyInfo_hide = '';
		$code_keyInfo_checked = '';
	 }
 }

$autopropad_hide = '';
$autopropad_checked = '';
 if(isset($_COOKIE['autopropad_cookie'])){ 
	 $cookieValue = $_COOKIE['autopropad_cookie'];
	 if( $cookieValue == 1){
		$autopropad_hide = 'hide';
		$autopropad_checked = 'checked';
	 }else{
		$autopropad_hide = '';
		$autopropad_checked = '';
	 }
 }
 
$hotwire_hide = '';
$hotwire_checked = '';
 if(isset($_COOKIE['hotwire_cookie'])){ 
	 $cookieValue = $_COOKIE['hotwire_cookie'];
	 if( $cookieValue == 1){
		$hotwire_hide = 'hide';
		$hotwire_checked = 'checked';
	 }else{
		$hotwire_hide = '';
		$hotwire_checked = '';
	 }
 }
$tko_sdd_hide = '';
$tko_sdd_checked = '';
 if(isset($_COOKIE['tko_sdd_cookie'])){ 
	 $cookieValue = $_COOKIE['tko_sdd_cookie'];
	 if( $cookieValue == 1){
		$tko_sdd_hide = 'hide';
		$tko_sdd_checked = 'checked';
	 }else{
		$tko_sdd_hide = '';
		$tko_sdd_checked = '';
	 }
 }
 $dmaxcheckbox_hide = '';
$dmaxcheckbox_checked = '';
 if(isset($_COOKIE['dmaxcheckbox_cookie'])){ 
	 $cookieValue = $_COOKIE['dmaxcheckbox_cookie'];
	 if( $cookieValue == 1){
		$dmaxcheckbox_hide = 'hide';
		$dmaxcheckbox_checked = 'checked';
	 }else{
		$dmaxcheckbox_hide = '';
		$dmaxcheckbox_checked = '';
	 }
 } 
$hideimage_hide = '';
$hideimage_checked = '';
 if(isset($_COOKIE['hideimage_cookie'])){ 
	 $cookieValue = $_COOKIE['hideimage_cookie'];
	 if( $cookieValue == 1){
		$hideimage_hide = 'hide';
		$hideimage_checked = 'checked';
	 }else{
		$hideimage_hide = '';
		$hideimage_checked = '';
	 }
 } 
$hideParts_hide = '';
$hideParts_checked = '';
 if(isset($_COOKIE['hideParts_cookie'])){ 
	 $cookieValue = $_COOKIE['hideParts_cookie'];
	 if( $cookieValue == 1){
		$hideParts_hide = 'hide';
		$hideParts_checked = 'checked';
	 }else{
		$hideParts_hide = '';
		$hideParts_checked = '';
	 }
 }

$hideTypes_hide = '';
$hideTypes_checked = '';
 if(isset($_COOKIE['hideTypes_cookie'])){ 
	 $cookieValue = $_COOKIE['hideTypes_cookie'];
	 if( $cookieValue == 1){
		$hideTypes_hide = 'hide';
		$hideTypes_checked = 'checked';
	 }else{
		$hideTypes_hide = '';
		$hideTypes_checked = '';
	 }
 }   
?>
<table class="table table-bordered table-data mar0 tab-con">
<thead>
                <tr> 
                  <th rowspan="2">Action</th>
                  <th class="Types <?php echo $hideTypes_hide;?>" rowspan="2">Type</th>
                  <th class="HImage <?php echo $hideimage_hide;?>" rowspan="2">Image
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="Vehicle_Image" data_id="<?php echo $sorting_id;?>"></a>
                  </th>	 
                  <th rowspan="2">Make <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sorting_make" data_id="<?php echo $sorting_id;?>"></a></th> 
                  <th rowspan="2">Model <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sorting_model" data_id="<?php echo $sorting_id;?>"></a></th> 
                  <th rowspan="2">Year <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sorting_year" data_id="<?php echo $sorting_id;?>"></a></th>           		  <th class="code_keyInfo <?php echo $code_keyInfo_hide;?>" colspan="5">Code & Key Info </th> 	
                  <th colspan="8" class="AdvDiagn <?php echo $advanced_hide;?>">MVP </th> 
                  <th class="AutoProPAD <?php echo $autopropad_hide;?>" colspan="7">AutoProPAD </th>  
                  <th class="Hotwire <?php echo $hotwire_hide;?>" colspan="3">Hotwire</th>
                  <th class="TKOSDD <?php echo $tko_sdd_hide;?>" colspan="5">TKO / SDD</th>
                  <th class="Dmax <?php echo $dmaxcheckbox_hide;?>" colspan="2">DMax</th>
                  <th colspan="2" class="ProLok <?php echo $prolok_hide;?>">Pro-Lok </th> 
                  <th class="Parts <?php echo $hideParts_hide;?>" colspan="3">Parts</th>  
                  <th class="" colspan="2">OBD Port Location</th>
                </tr>
                <tr>
                <th class="code_keyInfo <?php echo $code_keyInfo_hide;?>">Code Series</th>
                 <th class="code_keyInfo <?php echo $code_keyInfo_hide;?>">Tumblers</th> 
                  <th class="code_keyInfo <?php echo $code_keyInfo_hide;?>">Retainer 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="Retainer_UUID" data_id="<?php echo $sorting_id;?>"></a>                  </th> 
                  <th class="code_keyInfo <?php echo $code_keyInfo_hide;?>">Mechanical Key
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="Mechanical_Key_UUID" data_id="<?php echo $sorting_id;?>"></a>
                  </th> 
                  <th class="code_keyInfo <?php echo $code_keyInfo_hide;?>">Chip Key
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="Chip_Key_UUID" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  
                  <th class="AdvDiagn <?php echo $advanced_hide;?>">System
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="MVP_System" data_id="<?php echo $sorting_id;?>"></a>
                  </th> 
                  <th class="AdvDiagn <?php echo $advanced_hide;?>">Dongle
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="MVP_Dongle_UUID" data_id="<?php echo $sorting_id;?>"></a>
                  </th> 
                  <th class="AdvDiagn <?php echo $advanced_hide;?>">Smart Card
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="MVP_SmartCard" data_id="<?php echo $sorting_id;?>"></a>
                  </th> 
                  <th class="AdvDiagn <?php echo $advanced_hide;?>">Software
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="MVP_Software" data_id="<?php echo $sorting_id;?>"></a>
                  </th> 
                  <th class="AdvDiagn <?php echo $advanced_hide;?>">PIN Required
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="MVP_PIN_Required" data_id="<?php echo $sorting_id;?>"></a>
                  </th> 
                  <th class="AdvDiagn <?php echo $advanced_hide;?>">PIN Read
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="MVP_PIN_Read" data_id="<?php echo $sorting_id;?>"></a>
                  </th> 
                  <th class="AdvDiagn <?php echo $advanced_hide;?>">10-Min Bypass
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="MVP_10-Minute_Bypass" data_id="<?php echo $sorting_id;?>"></a>
                  </th> 
                  <th class="AdvDiagn <?php echo $advanced_hide;?>">Notes
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="MVP_Notes" data_id="<?php echo $sorting_id;?>"></a>
                  </th>                 
                  
                  <th class="AutoProPAD <?php echo $autopropad_hide;?>">System
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="APP_System" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th class="AutoProPAD <?php echo $autopropad_hide;?>">Add-A-Key
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom vehicle_sort_retainer" data-by="APP_Add_Keys" data_id="DESC"></a>
                  </th>
                  <th class="AutoProPAD <?php echo $autopropad_hide;?>">All-Keys-Lost
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom vehicle_sort_retainer" data-by="APP_All_Keys_Lost" data_id="DESC"></a>
                  </th>
                  <th class="AutoProPAD <?php echo $autopropad_hide;?>">PIN Read 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom vehicle_sort_retainer" data-by="PIN_Read" data_id="DESC"></a>
                  </th>
                  <th class="AutoProPAD <?php echo $autopropad_hide;?>">Programs Remotes</th>
                  <th class="AutoProPAD <?php echo $autopropad_hide;?>">Resync Available</th>
                  <th class="AutoProPAD <?php echo $autopropad_hide;?>">Notes
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="APP_Notes" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  
                  <th class="Hotwire <?php echo $hotwire_hide;?>">Key Prog
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="HW_Key_Prog" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th class="Hotwire <?php echo $hotwire_hide;?>">Remote Prog
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="HW_Remote_Prog" data_id="<?php echo $sorting_id;?>"></a>
                  </th class="Hotwire ><?php echo $hotwire_hide;?>">
                  <th class="Hotwire <?php echo $hotwire_hide;?>">Misc Prog
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="HW_Misc_Prog" data_id="<?php echo $sorting_id;?>"></a>
                  </th>                  
                  
                  <th class="TKOSDD <?php echo $tko_sdd_hide;?>">System
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="TKOSDD_System" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th class="TKOSDD <?php echo $tko_sdd_hide;?>">SDD Adapter
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="TKOSDD_SDD_Adapter" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th class="TKOSDD <?php echo $tko_sdd_hide;?>">SDD Cable
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="TKOSDD_SDD_Cable" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th class="TKOSDD <?php echo $tko_sdd_hide;?>">TKO Cable
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="TKOSDD_TKO_Cable" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th class="TKOSDD <?php echo $tko_sdd_hide;?>">Notes
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="TKOSDD_Notes" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th class="Dmax <?php echo $dmaxcheckbox_hide;?>">System</th>
                  <th class="Dmax <?php echo $dmaxcheckbox_hide;?>">Method</th>
                  <th class="ProLok <?php echo $prolok_hide;?>">Tool
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="ProLok_Tool_UUID" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th class="ProLok <?php echo $prolok_hide;?>">Linkage
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> vehicle_sort_retainer" data-by="ProLok_Linkage" data_id="<?php echo $sorting_id;?>"></a>
                  </th> 
                  <th class="Parts <?php echo $hideParts_hide;?>">Ignition </th>
                  <th class="Parts <?php echo $hideParts_hide;?>">Door/Glove</th>
                  <th class="Parts <?php echo $hideParts_hide;?>">Accessories </th> 
                  <th class="">Text</th> 
                  <th class="">Image</th>                          
                </tr>
              </thead>
<tbody>
<?php 	
			 
				if($results){
				foreach($results as $value){      					
					 if( $value['Image_UUID'] == ""){
						  $img_uuid = gen_uuid();
					 }else{ 
						 $img_uuid = $value['Image_UUID']; 
					 } 
					 
					 if($value['id'] == $lastupdate_val){
						 $bgcolor = "style='background: #badffd;'";
					 }else{
						 $bgcolor ="";
					 }
					
				?>
                	<tr>
                    	<td>
                        <a  href="<?php echo adm_base_url();?>/vehicles/edit_vehicles/<?php echo $value['id'];?>" type="button" class="btn btn-success">Edit</a>
                        <a  href="<?php echo adm_base_url();?>/vehicles/copy_vehicle/<?php echo $value['id'];?>" type="button" class="btn btn-info">Copy</a>                            
                        <a  href="javascript:void(0)" onclick="DeleteCodeFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/vehicles/delete_vehicles/')" type="button"class="btn btn-danger" >Delete</a>
                       </td>
                        <td class="Types <?php echo $hideTypes_hide;?>">
							<?php
							$vehicle_Type_UUID_info = vehicle_Type_UUID_info($value['Vehicle_Type_UUID']);
							echo $vehicle_Type_UUID_info[0]['type'];
							?>							
                        </td> 
                    	<td class="HImage <?php echo $hideimage_hide;?>" style="padding:0">
                        <div class="vh_value_holder">
                            <?php $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
                            $path = $protocol . "://" .$_SERVER['SERVER_NAME'].'/assets/vechileImages/150/'.$value['image_url'];
                            if(is_url_exist($path) == 1){
                              $file_path = $value['image_url'];
                            }else{
                              $file_path = "";
                            }                            
                            if($file_path !=""){?>
                              <?php if($value['image_url'] != ""){?><img src="<?php echo asset_url();?>vechileImages/150/<?php echo $value['image_url'];?>" width="100"  /><?php } ?>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['image_url'];?>" data-id="<?php echo $value['id'];?>" data-col="image_url" data-uuid="<?php echo $img_uuid;?>" ></span><div id="<?php echo $value['id'];?>" class="get_column_data"></div>
                            <?php }else{ ?>
                              <?php if($value['Vehicle_Image'] != ""){?><img src="<?php echo $value['Vehicle_Image'];?>" width="100"  /><?php } ?>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Vehicle_Image'];?>" data-id="<?php echo $value['id'];?>" data-col="Vehicle_Image" data-uuid="<?php echo $img_uuid;?>" ></span><div id="<?php echo $value['id'];?>" class="get_column_data"></div>                            
                            <?php } ?>
                          </div>
                        </td>                   	
                        <td>
							<?php 
							echo $value['Make_Name'];
							?>                            
                        </td>
                        <td>
                        	<div class="vh_value_holder"> 
                            <span class="td_data"><?php echo $value['Model_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['Model_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Model_UUID" data-key="Model_UUID" data-type="Model_UUID"></span><div class="get_column_data"></div>     
                            </div>                     
                        </td>
                        <td> 
                        <div class="vh_value_holder">                                       
							<?php
                            $years = explode(',',$value['Years']); 
                            if($years[0] == $years[count($years)-1]){?>
                                 <span class="td_data"><?php echo $years[0];?></span>
                            <?php }else{?>
                                 <span class="td_data"><?php echo $years[0];?>-<?php echo $years[count($years)-1];?></span>
                            <?php } ?>
                        <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Years'];?>" data-id="<?php echo $value['id'];?>" data-col="Years"></span><div class="get_column_data"></div>
                        </div>
                        </td>                        
                        <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>"> 
                        	<div class="vh_value_holder">
                        	<?php 
							$got_series_data = explode(',',$value['Code_Series_UUID']);
							if( count($got_series_data) > 1){
                                echo '<div style="max-height: 200px;overflow-y: scroll;" class="td_data">';
								for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
									$got_series_val = explode('|',$got_series_data[$cs]);
									$code_series_id = $got_series_val[0];
									$code_series_note = $got_series_val[1];
									$get_Code_Series_name = get_Code_Series_name($code_series_id);?>
									<span><?php echo $get_Code_Series_name[0]['Code_Series_Name'];?> 
									<?php if((isset($code_series_note)) && ($code_series_note !="" )){?>(<?php echo $code_series_note;?>)<?php } ?></span><br />
                                    <?php } ?>
                              <div>
                              <span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['Code_Series_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Code_Series_UUID" data-key="Code_Series_UUID" data-type="Code_Series_UUID"></span><div class="get_column_data" ></div> 
                              <div>
							<?php }else{
								$got_series_val = explode('|',$got_series_data[0]);
								$code_series_id = $got_series_val[0];
								$code_series_note = $got_series_val[1];
								$get_Code_Series_name = get_Code_Series_name($code_series_id);?>
                            	<span class="td_data"><?php echo $get_Code_Series_name[0]['Code_Series_Name'];?><?php if((isset($code_series_note)) && ($code_series_note !="" )){?>(<?php echo $code_series_note;?>)<?php } ?> </span>						
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['Code_Series_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Code_Series_UUID" data-key="Code_Series_UUID" data-type="Code_Series_UUID"></span><div class="get_column_data" ></div>
                            <?php } ?>
                            </div>
                        </td>
                        <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>">
                        <div class="vh_value_holder notes-holder">
                            <span class="td_data"><?php echo $value['Tumblers'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Tumblers'];?>" data-id="<?php echo $value['id'];?>" data-col="Tumblers" data-key="Tumblers" data-type="Tumblers"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                        <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>">
                        <div class="vh_value_holder">
                        	<?php $get_Retainer_name = get_Retainer_name($value['Retainer_UUID']);?>
                            <span class="td_data"><?php echo $get_Retainer_name[0]['Retainer_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['Retainer_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Retainer_UUID" data-key="Retainer_UUID" data-type="Retainer_UUID"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                       <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>">
                       <div class="vh_value_holder">
                        	<?php
								$mach_keys_uuids = "";								
								$mach_keys_array = explode(',',$value['Mechanical_Key_UUID']);
								for($i = 0; $i < count($mach_keys_array); $i++ ){
									$get_key_name = get_key_name($mach_keys_array[$i]);
									$mach_keys_uuids .=  $get_key_name[0]['Key_Name'].'<br>';
								}
							?>
                            <span class="td_data"><?php echo $mach_keys_uuids;?></span>                            
                        	<span class="glyphicon glyphicon-pencil edit_vh_programmers_box" aria-hidden="true" data-val="<?php echo $value['Mechanical_Key_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Mechanical_Key_UUID" data-key="Mechanical Key" data-type="Keys"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                        <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>">
                        <div class="vh_value_holder">
                       		 <?php
								$chip_keys_uuids = "";								
								$chip_keys_array = explode(',',$value['Chip_Key_UUID']);
								for($i = 0; $i < count($chip_keys_array); $i++ ){
									$get_key_name = get_key_name($chip_keys_array[$i]);
									$chip_keys_uuids .=  $get_key_name[0]['Key_Name'].'<br>';
								}
							?>
                            <span class="td_data"><?php echo $chip_keys_uuids;?></span>                            
                        	<span class="glyphicon glyphicon-pencil edit_vh_multiple_box" aria-hidden="true" data-val="<?php echo $value['Chip_Key_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Chip_Key_UUID" data-key="Transponder Key" data-type="Keys"></span><div class="get_column_data" ></div>
                           </div> 
                        </td>
                                             
                        <td class="AdvDiagn <?php echo $advanced_hide;?>">
                        <div class="vh_value_holder">
                        <span class="td_data"><?php echo $value['MVP_System'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_System'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_System"></span><div class="get_column_data"></div>
                        </div>
                        </td>
                        <td class="AdvDiagn <?php echo $advanced_hide;?>">
                        <div class="vh_value_holder">
                        	<?php $get_tool_name = get_tool_name($value['MVP_Dongle_UUID']);?>
                            <span class="td_data"><?php echo $get_tool_name[0]['Tool_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['MVP_Dongle_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_Dongle_UUID" data-key="Dongle" data-type="Tools"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                        <td class="AdvDiagn <?php echo $advanced_hide;?>">
                        <div class="vh_value_holder">
                        <?php
						 $SmartCard = ""; 
						 if( $value['MVP_SmartCard'] == 1){
							$SmartCard = 'Yes';
						 }else if( $value['MVP_SmartCard'] === NULL){
							$SmartCard = '';
						 }else if( $value['MVP_SmartCard'] == ""){
							$SmartCard = '';
						 }else if( $value['MVP_SmartCard'] == 0){
							$SmartCard = 'No';
						 }
						 ?>
                        <span class="td_data"><?php echo $SmartCard;?></span>
                        <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_SmartCard'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_SmartCard"></span><div class="get_column_data"></div>
                        </div>
                        </td>
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder">
                        	<?php $get_tool_name = get_tool_name($value['MVP_Software']);?>
                            <span class="td_data"><?php echo $get_tool_name[0]['Tool_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['MVP_Software'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_Software" data-key="TCode SW" data-type="Tools"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder">
                         <?php 
						 if( $value['MVP_PIN_Required'] == 1){
							$PIN_Required = 'Yes';
						 }else if( $value['MVP_PIN_Required'] === ""){
							$PIN_Required = '';
						 }else if( $value['MVP_PIN_Required'] == 0){
							$PIN_Required = 'No';
						 }
						 ?>
                        <span class="td_data"><?php echo $PIN_Required;?></span>
                        <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_PIN_Required'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_PIN_Required"></span><div class="get_column_data"></div>
                        </div>
                         </td>
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder">
                            <span class="td_data"><?php echo $value['MVP_PIN_Read'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_PIN_Read'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_PIN_Read"></span><div class="get_column_data"></div>
                            </div>
                         </td>                       
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder">
                         <?php $get_10_mint_bypass = get_10_mint_bypass($value['id']); ?>
                            <span class="td_data"><?php echo $get_10_mint_bypass[0]['MVP_10-Minute_Bypass'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $get_10_mint_bypass[0]['MVP_10-Minute_Bypass'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_10-Minute_Bypass"></span><div class="get_column_data"></div>
                            </div>
                         </td>
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder notes-holder">
                         <span class="td_data"><?php echo $value['MVP_Notes'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_Notes"></span><div class="get_column_data"></div>
                          </div>
                         </td>                        
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder notes-holder">
                          <span class="td_data"><?php echo $value['APP_System'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_System'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_System"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['APP_Add_Keys'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_Add_Keys'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_Add_Keys"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                           <span class="td_data"><?php echo $value['APP_All_Keys_Lost'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_All_Keys_Lost'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_All_Keys_Lost"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                           <span class="td_data"><?php echo $value['PIN_Read'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['PIN_Read'];?>" data-id="<?php echo $value['id'];?>" data-col="PIN_Read"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['APP_Programs_Remote'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_Programs_Remote'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_Programs_Remote"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['APP_Resync_Available'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_Resync_Available'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_Resync_Available"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data notes-holder"><?php echo $value['APP_Notes'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_Notes"></span><div class="get_column_data"></div>
                          </div>
                          </td>                          
                          <td class="Hotwire <?php echo $hotwire_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['HW_Key_Prog'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['HW_Key_Prog'];?>" data-id="<?php echo $value['id'];?>" data-col="HW_Key_Prog"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                  		  <td class="Hotwire <?php echo $hotwire_hide;?>">
                          <div class="vh_value_holder">
                          	<span class="td_data"><?php echo $value['HW_Remote_Prog'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['HW_Remote_Prog'];?>" data-id="<?php echo $value['id'];?>" data-col="HW_Remote_Prog"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                  		  <td class="Hotwire <?php echo $hotwire_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['HW_Misc_Prog'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['HW_Misc_Prog'];?>" data-id="<?php echo $value['id'];?>" data-col="HW_Misc_Prog"></span><div class="get_column_data"></div>
                          </div>
                          </td>                          
                         <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                         <div class="vh_value_holder">
                         <span class="td_data"><?php echo $value['TKOSDD_System'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_System'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_System"></span><div class="get_column_data"></div>
                          </div>
                         </td>
                  		 <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                         <div class="vh_value_holder">
                         <span class="td_data"><?php echo $value['TKOSDD_SDD_Adapter'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_SDD_Adapter'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_SDD_Adapter"></span><div class="get_column_data"></div>
                          </div>
                         </td>
                 		 <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                         <div class="vh_value_holder">
                        <span class="td_data"> <?php echo $value['TKOSDD_SDD_Cable'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_SDD_Cable'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_SDD_Cable"></span><div class="get_column_data"></div>
                          </div>
                         </td>
                  		 <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                           <div class="vh_value_holder">
                           <span class="td_data"><?php echo $value['TKOSDD_TKO_Cable'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_TKO_Cable'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_TKO_Cable"></span><div class="get_column_data"></div></div>
                         </td>
                  		 <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                         <div class="vh_value_holder">
                         <span class="td_data"><?php echo $value['TKOSDD_Notes'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_Notes"></span><div class="get_column_data"></div>
                          </div>
                         </td>                          
                         <td class="Dmax <?php echo $dmaxcheckbox_hide;?>">
                           <div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['DMax_System'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['DMax_System'];?>" data-id="<?php echo $value['id'];?>" data-col="DMax_System"></span><div class="get_column_data"></div>
                          </div>
                         </td>
                        <td class="Dmax <?php echo $dmaxcheckbox_hide;?>">
                         	<div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['DMax_Method'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['DMax_Method'];?>" data-id="<?php echo $value['id'];?>" data-col="DMax_Method"></span><div class="get_column_data"></div>
                          </div>
                        </td>
                        <td class="ProLok <?php echo $prolok_hide;?>">
                        <div class="vh_value_holder">
                        	<?php $get_tool_name = get_tool_name($value['ProLok_Tool_UUID']);?>
                            <span class="td_data"><?php echo $get_tool_name[0]['Tool_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['ProLok_Tool_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="ProLok_Tool_UUID" data-key="Pro-Lok" data-type="Tools"></span><div class="get_column_data" ></div>
                            </div>
                        </td>                         
                        <td class="ProLok <?php echo $prolok_hide;?>">
                        <div class="vh_value_holder">
                            <span class="td_data"><?php echo $value['ProLok_Linkage'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['ProLok_Linkage'];?>" data-id="<?php echo $value['id'];?>" data-col="ProLok_Linkage"></span><div class="get_column_data"></div>
                            </div>
                         </td>
                         <td class="Parts <?php echo $hideParts_hide;?>">
                         	<div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['Parts_Ignition'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Parts_Ignition'];?>" data-id="<?php echo $value['id'];?>" data-col="Parts_Ignition"></span><div class="get_column_data"></div>
                              </div>
                         </td>
                        <td class="Parts <?php echo $hideParts_hide;?>">
                        	<div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['Parts_Door'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Parts_Door'];?>" data-id="<?php echo $value['id'];?>" data-col="Parts_Door"></span><div class="get_column_data"></div>
                              </div>
                        </td>
                        <td class="Parts <?php echo $hideParts_hide;?>">
                        	<div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['Parts_Accessories'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Parts_Accessories'];?>" data-id="<?php echo $value['id'];?>" data-col="Parts_Accessories"></span><div class="get_column_data"></div>
                              </div>
                        </td> 
                        <td>
                          <div class="vh_value_holder notes-holder">
                              <span class="td_data"><?php echo $value['OBD_Location_Text'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['OBD_Location_Text'];?>" data-id="<?php echo $value['id'];?>" data-col="OBD_Location_Text"></span><div class="get_column_data"></div>
                              </div>
                        </td>
                        <td>
                          <div class="vh_value_holder">
                              <span class="td_data"><a href="<?php echo $value['OBD_Location_Image'];?>" target="_blank">
                                <?php if($value['OBD_Location_Image'] !=""){?>
                                <img src="<?php echo $value['OBD_Location_Image'];?>" style="width:50px;">
                                <?php } ?>
                              </a></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['OBD_Location_Image'];?>" data-id="<?php echo $value['id'];?>" data-col="OBD_Location_Image"></span><div class="get_column_data"></div>
                          </div>
                        </td> 
                                          
                    </tr>
<?php } }else{echo "<div class='alert alert-danger'>Data not Found</div>";}?>
</tbody>
</table>
<?php  if($_SESSION['search_key'] !=""){
        $sesshide = "hide";
    }elseif($make_id  == "All"){
        $sesshide = "";
    }elseif($vehicle_type =="All"){
        $sesshide = "";
    }else{
        $sesshide = "";
      }
    if($totalrows2 > 0){
    $count = $totalrows2;
    }else{
    $count = $totalrows;
    }
    if($count > 50){?>
      <nav class="site-pg <?php echo $sesshide;?>">
          <ul class="pagination">               
          <?php foreach ($links as $link) {
                echo '<li>'. $link.'</li>';
          } ?>	
          </ul>
      </nav>
<?php } ?>