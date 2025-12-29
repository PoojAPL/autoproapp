<?php error_reporting(0);?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">    	
    	<div class="col-sm-24">
        <div class="form-group addCodeSeries">          
         <a href="<?php echo adm_base_url();?>/vehicles/vehicle" class="btn btn-danger" >Back<<</a>        
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    	<?php echo $this->session->flashdata('message_display');?>
     <?php } ?>       
     <div class="site-form">
          <div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
            <?php 
			$year_array = array();
			$main_array = array();
			//$vahicle_arr = array();			
			$vehicle_info_array2 = array();
			$vehicle_info_array3 = array();	
			$get_Firebase_vehicles_year2 = get_Firebase_vehicles_count();
			$limit_start = round($get_Firebase_vehicles_year2/2);
			$limit_end = $get_Firebase_vehicles_year2;
			$all_vehciles = get_Firebase_vehicles_year_vehicleInfo2($limit_start,$limit_end);
			//echo '--'.$limit_start.'--'.$limit_end.'<br>';
			foreach($all_vehciles as $vehciles){
						//echo $vehciles['Code_Series_UUID'].'<br>';
						$OBD_Location_array = array();
						$OBD_Location_array = array('OBD_Location_Text'=>$vehciles['OBD_Location_Text'],'OBD_Location_Image'=>$vehciles['OBD_Location_Image']);
					    $key_making_method_array = array();
						$vehciles_id = $vehciles['id'];
						$get_key_making_method = get_key_making_method($vehciles_id);
						if($get_key_making_method){
							foreach ($get_key_making_method as $methods) {
								$search = $vehciles_id;
								if(preg_match("/\b$search\b/",$methods['Vehicle_UUID'])){
									//echo $vehciles_id.'--'. $methods['Vehicle_UUID'].'<br><br>';
									$images_data_array = array();
	                                $images_data = explode(',',$methods['Images']);
	                                for($im = 0; $im < count($images_data); $im++){
	                                  $images_data_array[] = $images_data[$im];
	                                }
	                                //$get_make_name = get_make_name($vehciles['Model_UUID']);
	                                $Make_Name = $vehciles['Make_Name'];
	                                //$get_models_name = get_models_name($vehciles['Model_UUID']);
	                                $Model_Name = $vehciles['Model_Name'];
	                                $years = explode(',',$vehciles['Years']); 
	                                if($years[0] == $years[count($years)-1]){
	                                  $years =  $years[0];
	                                }else{
	                                  $years = $years[0].'-'.$years[count($years)-1];
	                                }
	                                $Code_Series_Name = '';                 
	                                $got_series_data = explode(',',$vehciles['Code_Series_UUID']);
	                                if( count($got_series_data) > 1){
	                                    for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
	                                      $got_series_val = explode('|',$got_series_data[$cs]);
	                                      $code_series_id = $got_series_val[0];
	                                      $code_series_note = $got_series_val[1];
	                                      $get_Code_Series_name = get_Code_Series_name($code_series_id);
	                                      if($get_Code_Series_name[0]['Code_Series_Name'] !=""){
	                                        $Code_Series_Name .= $get_Code_Series_name[0]['Code_Series_Name'].',';
	                                      }
	                                    } 
	                                    $Code_Series_Name = rtrim($Code_Series_Name,',');
	                                  }else{
	                                    $got_series_val = explode('|',$got_series_data[0]);
	                                    $code_series_id = $got_series_val[0];
	                                    $code_series_note = $got_series_val[1];
	                                    $get_Code_Series_name = get_Code_Series_name($code_series_id);
	                                    $Code_Series_Name = $get_Code_Series_name[0]['Code_Series_Name'];
	                                }
	                                if($Code_Series_Name !=""){
	                                  $vehicleName = $Make_Name.' '.$Model_Name.' ( '.$years.' ) ('.$Code_Series_Name.')';
	                                }else{
	                                  $vehicleName = $Make_Name.' '.$Model_Name.' ( '.$years.' )';
	                                }
	                                $user_id =  $methods['User_UUID'];
                               		$get_aks_users_info = get_aks_users_info2($user_id);
                                	$methods_user = $get_aks_users_info[0]['customers_email_address'];
									$key_making_method_array['methods'][] = array('title' => $methods['Title'],
																	'content' => $methods['Content'],
																	'imagePaths' => $images_data_array,
																	'video' => $methods['Videos'],
																	'userID' => $methods['User_UUID'],
																	'user' => $methods_user,
																	'score' => $methods['Score'],
																	'date' => $methods['dated'],
					                                                'vehicleName' => $vehicleName,
					                                                'otherVehicles' => '',
					                                                'vehicleID' => $vehciles_id
																 );

								}
								
							}
							//print_r($key_making_method_array);
							//echo '<br><br>';
						}
						
						$tips_tricks_array = array();
						$vehciles_id = $vehciles['id'];
						$get_tip_trips_method = get_tip_trips_method($vehciles_id);
						if($get_tip_trips_method){
							foreach ($get_tip_trips_method as $methods1) {
								//echo $vehciles_id.'--'. $methods['Vehicle_UUID'].'<br><br>';
								$search = $vehciles_id;
								if(preg_match("/\b$search\b/",$methods1['Vehicle_UUID'])){
									$images_data_array = array();
	                                $images_data = explode(',',$methods1['Images']);
	                                for($im = 0; $im < count($images_data); $im++){
	                                  $images_data_array[] = $images_data[$im];
	                                }
	                               // $get_make_name = get_make_name($vehciles['Model_UUID']);
	                                $Make_Name = $vehciles['Make_Name'];
	                                //$get_models_name = get_models_name($vehciles['Model_UUID']);
	                                $Model_Name = $vehciles['Model_Name'];
	                                $years = explode(',',$vehciles['Years']); 
	                                if($years[0] == $years[count($years)-1]){
	                                  $years =  $years[0];
	                                }else{
	                                  $years = $years[0].'-'.$years[count($years)-1];
	                                }
	                                $Code_Series_Name = '';                 
	                                $got_series_data = explode(',',$vehciles['Code_Series_UUID']);
	                                if( count($got_series_data) > 1){
	                                    for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
	                                      $got_series_val = explode('|',$got_series_data[$cs]);
	                                      $code_series_id = $got_series_val[0];
	                                      $code_series_note = $got_series_val[1];
	                                      $get_Code_Series_name = get_Code_Series_name($code_series_id);
	                                      if($get_Code_Series_name[0]['Code_Series_Name'] !=""){
	                                        $Code_Series_Name .= $get_Code_Series_name[0]['Code_Series_Name'].',';
	                                      }
	                                    } 
	                                    $Code_Series_Name = rtrim($Code_Series_Name,',');
	                                  }else{
	                                    $got_series_val = explode('|',$got_series_data[0]);
	                                    $code_series_id = $got_series_val[0];
	                                    $code_series_note = $got_series_val[1];
	                                    $get_Code_Series_name = get_Code_Series_name($code_series_id);
	                                    $Code_Series_Name = $get_Code_Series_name[0]['Code_Series_Name'];
	                                }
	                                if($Code_Series_Name !=""){
	                                  $vehicleName = $Make_Name.' '.$Model_Name.' ( '.$years.' ) ('.$Code_Series_Name.')';
	                                }else{
	                                  $vehicleName = $Make_Name.' '.$Model_Name.' ( '.$years.' )';
	                                }
	                                $user_id =  $methods1['User_UUID'];
                               		$get_aks_users_info = get_aks_users_info2($user_id);
                                	$methods_user = $get_aks_users_info[0]['customers_email_address'];
                                	$Category = str_replace('/', '_', $methods1['Category']);
                                	$Category = trim($Category);
                                	if($Category != ""){
										$tips_tricks_array['methods'][$Category][] = array(
												  'title' => $methods1['Title'],
	                                              'methodDescription' => $methods1['Content'],
	                                              'imagePaths' =>$images_data_array,
	                                              'video' => $methods1['Videos'],
	                                              'userID' => $methods1['User_UUID'],
	                                              'user' => $methods_user,
	                                              'score' => $methods1['Score'],
	                                              'category'=>$methods1['Category'],
	                                              'date' => $methods1['dated'],
	                                              'vehicleName' => $vehicleName,
	                                              'otherVehicles' => '',
	                                              'vehicleID' => $vehciles_id
	                                             );
									}
								}								
							}
						}
						//print_r($get_key_making_method);
					  $get_vehicles_images_array = array();	
					  $imm = 1;
					  $get_vehicles_images = get_vehicles_images($vehciles_id);                      
                      if($get_vehicles_images){
                            foreach ($get_vehicles_images as $images) {
                               $search = $vehciles_id;
                              if(preg_match("/\b$search\b/",$images['vehicles'])){
                                //echo $vehciles_id .'---'.$methods['vehicles'].'<br>';
                                $images_data_array = array();
                                $images_data = explode(',',$images['Image_path']);
                                for($im = 0; $im < count($images_data); $im++){
                                  $images_data_array[$imm] = array( 'image' =>  $images_data[$im] );
                                }
                                $get_vehicles_images_array = $images_data_array;
                               }
                               $imm++;
                            }
                        }
						$vehicle_image_array_def =  array();
						if($vehciles['Vehicle_Image'] == "" || $vehciles['Vehicle_Image'] == NULL){
							$vehicle_image_array_def = array();
						}else{
							$vehicle_image_array_def['image'] = $vehciles['Vehicle_Image'];
						}
						array_push($get_vehicles_images_array,$vehicle_image_array_def);

						$vehicle_info_array = array();			
					    $got_series_data = explode(',',$vehciles['Code_Series_UUID']);
					    //echo $vehciles['Model_UUID'].'<br>';
						$year_range = array();
						$year_array = array();
						$model_array = array();
					    $get_vehicles_year = get_vehicles_year($vehciles['Model_UUID']);
						$getModeluuid = getModeluuid($vehciles['Model_UUID']);
						$years_ids = array();
						$get_years_id = get_years_id($getModeluuid[0]['id']);
						
						foreach($get_years_id as $years_id){							
							   $years_ids['yearlist'][] = array('id' => $years_id['vehicles_id'],'year' => $years_id['vehicles_description']);
						}
									
					    foreach($get_vehicles_year as $vahicle_year){							
							$year_array[] =  array('year' => str_replace(',', '-', $vahicle_year['Years']) , 'vehicleID' => $vahicle_year['id']);
						}						
						
						$remote_array = array();
						$get_vehicles_remotes = get_vehicles_remotes($vehciles['UUID']);
						if($get_vehicles_remotes){
							  foreach($get_vehicles_remotes as $get_remote_name){			 
								$chip_remote_Battery_UUID =  $get_remote_name['Battery_UUID'];
								if($chip_remote_Battery_UUID == NULL){
								  $Battery_Name = ' ';
								}else{
								  $get_batteries = get_batteries($chip_remote_Battery_UUID);
								  $Battery_Name = $get_batteries[0]['Battery_Name'];
								}											  
								if($get_remote_name['FCCID'] == NULL){
								  $FCCID = ' ';
								}else{
								  $FCCID = $get_remote_name['FCCID'];
								}									  
								if($get_remote_name['Frequency'] == NULL){
								  $Frequency = ' ';
								}else{
								  $get_frequency_info = get_frequency_info($get_remote_name['Frequency']);   
								  $Frequency = $get_frequency_info[0]['Name'];
								}	
								if($get_remote_name['IC'] == NULL){
								  $IC = ' ';
								}else{
								  $IC = $get_remote_name['IC'];
								}	
								if($get_remote_name['Remote_Image_Url'] == NULL){
								  $Remote_Image_Url = ' ';
								}else{
								  $Remote_Image_Url = $get_remote_name['Remote_Image_Url'];
								}
								if($get_remote_name['Remote_Name'] == NULL){
								  $Remote_Name = ' ';
								}else{
								  $Remote_Name = $get_remote_name['Remote_Name'];
								}
								if($get_remote_name['Reusable'] == NULL){
								  $Reusable = ' ';
								}else{
								  $Reusable = $get_remote_name['Reusable'];
								}									  	
								$remote_Products = $get_remote_name['Products'];	
								$remote_product_array = array();									
								if($remote_Products != ""){
									$chk_Aks_remote_Products = get_Aks_vehicles_products_least_price($remote_Products);								  
									$remote_product_array = array('products_id' => $remote_Products, 'least_price' =>$chk_Aks_remote_Products[0]['MIN(products_price)'],'imagePath' => $chk_Aks_remote_Products[0]['products_image']);
								}else{
								   $remote_product_array = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');	 
								}
								$remote_key_array2 = array();	
								if($get_remote_name['Remote_Type_UUID'] == NULL){
								  $Remote_Type_UUID = '';
								  $Remote_Type_Name = '';
								  $remote_key_array2 = array('value'=>'','products' =>'');
								}else{
								  $Remote_Type_UUID = $get_remote_name['Remote_Type_UUID'];
								  $remote_keys_info = get_remote_types($Remote_Type_UUID);
								  $Remote_Type_Name = $remote_keys_info[0]['Remote_Type_Name'];
								  $Chip_UUID = $get_remote_name['Chip_UUID'];																							
								  $get_key_name = get_key_name_chips($Chip_UUID);
								  $transponder_Products22 = $get_key_name[0]['Products'];										
								  /*if($transponder_Products22 != ""){
										$chk_Aks_vehicles_products22 = get_Aks_vehicles_products_least_price($transponder_Products22);								  													  $remote_key_array = array('products_id' => $transponder_Products22, 'least_price' =>  $chk_Aks_vehicles_products22[0]['MIN(products_price)'],'imagePath' => $chk_Aks_vehicles_products22[0]['products_image']);
								   }	
								   $remote_key_array2 = array('image' => $Remote_Image_Url,'name'=>$get_key_name[0]['Key_Name'],'products' =>$remote_key_array,
									'IC' => $IC,'battery' => $Battery_Name,'fcc_id' => $FCCID,'frequency' => $Frequency);	*/											
								}						  
								$get_frequency_info = get_frequency_info($get_remote_name['Frequency']);
								$remote_array[$Remote_Type_Name][] = array('image' => $Remote_Image_Url,'name' => $Remote_Name,'products' =>$remote_product_array,
								  'IC' => $IC,'battery' => $Battery_Name,'fcc_id' => $FCCID,'frequency' => $Frequency,'Reusable' => $Reusable);
							  
							  } 
						}else{
						  $remote_array = array('Remote'=> 
							  array('IC' =>'','battery' =>'','fcc_id' =>'','frequency' =>''),
							  'image' =>'',
							  'name' => '',
							  'products' => array('products_id' =>'', 'least_price' =>'','imagePath' =>'')
							);
						}							  
						
						$the_basic = array();
						if($vehciles['Retainer_UUID'] == ""){
							$Retainer_Name = '';
						}else{
							$get_Retainer_name = get_Retainer_name($vehciles['Retainer_UUID']);
							$Retainer_Name = $get_Retainer_name[0]['Retainer_Name'];
						}
						
						$mach_keys_uuids = array();
						if($vehciles['Mechanical_Key_UUID'] ==""){
							$mach_keys_uuids[]=  array('value' => '','products' => '');
						}else{								
							$mach_keys_array = explode(',',$vehciles['Mechanical_Key_UUID']);
							for($i = 0; $i < count($mach_keys_array); $i++ ){
								$mck_product_array = array();
								$get_key_name = get_key_name($mach_keys_array[$i]);
								$mach_Products = $get_key_name[0]['Products'];
								if($mach_Products != ""){
									$mck_Aks_vehicles_products = get_Aks_vehicles_products_least_price($mach_Products);								  
									$mck_product_array = array('products_id' => $mach_Products, 'least_price' =>  $mck_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $mck_Aks_vehicles_products[0]['products_image']);
								}
								$mach_keys_uuids[] =  array('value' => $get_key_name[0]['Key_Name'],'products' => $mck_product_array,'image'=>$get_key_name[0]['Key_Image']);
							}
						}
						$transpondar_keys_uuids = array();
						if($vehciles['Chip_Key_UUID'] ==""){
							$transpondar_keys_uuids=  array();
							$transpondar_keys_uuids['Mechanical_Key']= $mach_keys_uuids;
						}else{								
						    $chip_keys_array = explode(',',$vehciles['Chip_Key_UUID']);
							for($i = 0; $i < count($chip_keys_array); $i++ ){
								$transponder_Products_array = array();
								$get_key_name = get_key_name($chip_keys_array[$i]);
								$Chip_UUID =  $get_key_name[0]['Chip_UUID'];
								$get_chips = get_chips($Chip_UUID);
								//echo $vehciles['id'].'---';
								
								//echo '<br>';
								$get_key_type = get_key_type($get_key_name[0]['Key_Type_UUID']);
								$transponder_Products = $get_key_name[0]['Products'];										
								if($transponder_Products != ""){
									$chk_Aks_vehicles_products = get_Aks_vehicles_products_least_price($transponder_Products);								  
									$transponder_Products_array = array('products_id' => $transponder_Products, 'least_price' =>  $chk_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $chk_Aks_vehicles_products[0]['products_image']);
								}	
								/*------------- Chip Key -----------------------------------*/	
									$chk_Products = $get_key_name[0]['Products'];										
									 if($chk_Products != ""){
										$chk_Aks_vehicles_products = get_Aks_vehicles_products_least_price($chk_Products);								  
										$chk_product_array = array('products_id' => $chk_Products, 'least_price' =>  $chk_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $chk_Aks_vehicles_products[0]['products_image']);
									}
									$chip_keys_uuids =  array('value' => $get_key_name[0]['Key_Name'],'products' => $chk_product_array);
									
								/*------------- Key Shell ------------------------------------*/											  
									$Key_Shell_UUID =  $get_key_name[0]['Key_Shell_UUID'];
									$get_Key_Shell_UUID = get_key_name($Key_Shell_UUID);
									$chk_shell_Products = $get_Key_Shell_UUID[0]['Products'];										
									if($chk_shell_Products != ""){
									   $chk_shell_Aks_vehicles_products = get_Aks_vehicles_products_least_price($chk_shell_Products);								  
										$chk_shell_product_array = array('products_id' => $chk_shell_Products, 'least_price' =>  $chk_shell_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $chk_shell_Aks_vehicles_products[0]['products_image']);
									}	
									$key_shell_uuids = array('value' => $get_Key_Shell_UUID[0]['Key_Name'],'chip_key' => $get_key_name[0]['Key_Name'],'products' =>  $chk_shell_product_array);	
									if($get_chips[0]['Reusable'] == 1){
										$Reusable = 'Yes';
									}else{
										$Reusable = 'No';
									}
									$transpondar_keys_uuids[$get_key_type[0]['Key_Type_Name']][] = array('value' => $get_chips[0]['Chip_Name'],'chip_key_name' => $get_key_name[0]['Key_Name'],'products' =>  $transponder_Products_array,'chip_key' => $chip_keys_uuids,'clonning_chip' =>'','key_shell' => $key_shell_uuids,'Reusable'=>$Reusable);

							}
							$transpondar_keys_uuids['Mechanical_Key']= $mach_keys_uuids;
						}
						//$get_make_name = get_make_name($vehciles['Model_UUID']);
						$Make_Name = $vehciles['Make_Name'];

						if($Make_Name == 'Toyota' || $Make_Name == 'Scion' || $Make_Name == 'Lexus'){
							$X100T = array('comments' => "");
						}else{
							$X100T = array();
						}

						if($Make_Name == 'Mercedes' || $Make_Name == 'Smart Car'){
							$DIAGSPEED = array('comments' => "");
						}else{
							$DIAGSPEED = array();
						}

						if($Make_Name == 'Mercedes' || $Make_Name == 'Smart Car'){
							$VVDI_MB = array('comments' => "");
						}else{
							$VVDI_MB = array();
						}

						if($Make_Name == 'Chrysler' || $Make_Name == 'Dodge' || $Make_Name == 'Jeep'){
							$DMax = array(
								'System'=>($vehciles['DMax_System'] != '' )?$vehciles['DMax_System']:"-",
								'Method'=>$vehciles['DMax_Method'],
							);
						}else{
							$DMax = array();
						}

						$key_programming_array = array('AUTOPROPAD'=>'-');
						$get_tool_name = get_tool_name($vehciles['MVP_Dongle_UUID']);
						$get_tool_name2 = get_tool_name($vehciles['MVP_Software']);
						// $get_success_rating = get_success_rating('AUTOPROPAD',$vehciles['id']);
						// $AUTOPROPAD_comments = array();
						// foreach ($get_success_rating as $key => $value) {
						// 	$AUTOPROPAD_comments[ $value['UUID'] ] = array(
						// 		'comment' => $value['UUID'] 
						// 	);
						// }
						$key_programming_array = array(
							'AUTOPROPAD'=> array(
								'System'=> ($vehciles['APP_System'] != '' )?$vehciles['APP_System']:"-",
								'Add Keys'=>($vehciles['APP_Add_Keys'] != '' )?$vehciles['APP_Add_Keys']:"-",
								'All Keys Lost'=>$vehciles['APP_All_Keys_Lost'],
								'10-Min Bypass'=>$vehciles['APP_10-Minute_Bypass'],
								'Confirmed'=>$vehciles['APP_Confirmed_Working'],
								'Notes'=>$vehciles['APP_Notes'],
							),
							'TKO_SDD'=> array(
								'System'=>$vehciles['TKOSDD_System'],
								'SDD Adapter'=>($vehciles['TKOSDD_SDD_Adapter'] != '' )?$vehciles['TKOSDD_SDD_Adapter']:"-",
								'SDD Cable'=>$vehciles['TKOSDD_SDD_Cable'],
								'TKO Cable'=>$vehciles['TKOSDD_TKO_Cable'],
								'Notes'=>$vehciles['TKOSDD_Notes'],
							),
							'HOTWIRE'=> array(
								'Key Program'=>($vehciles['HW_Key_Prog'] != '' )?$vehciles['HW_Key_Prog']:"-",
							 	'Remote Program'=>$vehciles['HW_Remote_Prog'],
							 	'SMisc Program'=>$vehciles['HW_Misc_Prog'],
							),
							'MVP_TCODE_SMART_PRO'=>array(
								'System'=>($vehciles['MVP_System'] != '' )?$vehciles['MVP_System']:"-",
								'Dongle'=>$get_tool_name[0]['Tool_Name'],
								'Smart Card'=>$vehciles['MVP_SmartCard'],
								'Software'=>$get_tool_name2[0]['Tool_Name'],
								'PIN Required'=>$vehciles['MVP_PIN_Required'],
								'PIN Read'=>$vehciles['MVP_PIN_Read'],
								'10-Min Bypass'=>($vehciles['MVP_10-Minute_Bypass'] != '' )?$vehciles['MVP_10-Minute_Bypass']:"-",
								'Notes'=>$vehciles['MVP_Notes'],
							),
							'DMAX'=>$DMax,
							'ZED_FULL'=>array('comments' => ""),
							'X100T'=>$X100T,
							'VVDI2'=>array('comments' => ""),
							'DIAGSPEED'=>$DIAGSPEED,
							'VVDI_MB'=>$VVDI_MB,
							'SKP900'=>array('comments' => ""),
							'SKP1000'=>array('comments' => ""),
							'SMART_BOX'=>array('comments' => ""),
							'TRUE_CODE'=>array('comments' => ""),
							'ABRITES'=>array('comments' => ""),
						);
						//print_r($key_programming_array);
						//echo '<br><br><br>';							  
						$tubmler_data = array();
						if($vehciles['Tumblers'] == ""){
							$tubmler_data = '';
						}else{
							$tumblers = explode(';',$vehciles['Tumblers']);
							$str = 'A';
							for($tb=0; $tb < count($tumblers); $tb++){
								//echo $vehciles['id'].'--'.$tumblers[$tb].'---';	
								$tubmler_part = explode(')', $tumblers[$tb]);	
								$tubmer_name = str_replace('(','',$tubmler_part[0]);
								$tubmer_value = explode(',',$tubmler_part[1]);
								$tubmler_start = 1;
								$tubmler_end = explode('-',$tubmer_value[count($tubmer_value)-1]);
								$tubmler_end_data = $tubmler_end[count($tubmler_end)-1];
								$number_data = "";
								$t = 1;
								$data_array1 = array();
								if( strrchr($tubmler_end_data,'S') ){
									 $tubmler_end = 10;
								}else{
									$tubmler_end = $tubmler_end_data;
								}
								$s_num = '';
								//foreach ($tubmer_value as $tb_key => $tb_value) {
								for($tb1 = 0; $tb1 < $tubmler_end;$tb1++){
									$tb_value = $tubmer_value[$tb1];
									$tb_value_array = explode(',',$tb_value);
									
									foreach ($tb_value_array as $key => $value) {
										$tb_value2 = explode('-',$value);
										if( strrchr($value,'S') ){
											 $number_data  .= $value.',';
											 $s_num = str_replace('S','',$value);
										}else{
											$number_one = $tb_value2[0];
											$number_last = $tb_value2[1];
											if(count($tb_value2) > 1){
											$numbers = range($number_one, $number_last);
											for($i=$number_one; $i<=$number_last; $i++) {
												   $number_data  .= $i.',';
												}
											}else if(count($tb_value2) == 1){
												$number_data  .= $number_one.',';	
											}
										}
									}
									$tubmer_name1 = str_replace('*', '', $tubmer_name);
									$tubmer_name2 = $tubmer_name1;
									//echo $number_data;
									$number_data_array =  explode(',',$number_data);
									if( in_array($t, $number_data_array)){
										if ($s_num == $t) {
											$data_array1[$tb1.'S']='true';
										}else{
											$data_array1[$tb1]='true';
										}
									}else{
										if ($s_num == $t) {
											$data_array1[$tb1.'S']='false';
										}else{
											$data_array1[$tb1]='false';
										}
									}
									$t++;
									$tubmer_name2 = str_replace('&', '&', $tubmer_name2);
									$tubmer_name2 = str_replace('/', '', $tubmer_name2);
									$tubmer_name2 = trim($tubmer_name2);
									$tubmer_name3 = $str.'_'.str_replace(' ', '_', $tubmer_name2);
									//$vehciles['id'].'--'.$tubmer_name3.'<br>';
									$tubmler_data[$tubmer_name3] = $data_array1;
								}
								$str++;
							}
						}
						//print_r($tubmler_data);							
						if( count($got_series_data) > 1){
							 $the_basic = array();
							for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
								  $got_series_val = explode('|',$got_series_data[$cs]);
								  $code_series_id = $got_series_val[0];
								  $code_series_note = $got_series_val[1];
								  $get_Code_Series_name = get_firebase_Code_Series_name($code_series_id);
								  if($get_Code_Series_name == true){
									   /*------------------- Bliz_section -------------------------------*/
									  	  $blitz_card = array();
										  $title_blitz = 'blitz';
										  $get_cutter_machines_info = get_machines_info($get_Code_Series_name[0]['HPC_Blitz_Cutter']);
										  $blitz_cutter_product = $get_cutter_machines_info[0]['Products'];
										  if($get_cutter_machines_info[0]['Name'] == ""){
											  $blitz_cutter_name = '';
										  }else{
										  	$blitz_cutter_name = $get_cutter_machines_info[0]['Name'];
										  }
										  $blitz_cutter_product_array = array();
										  if($blitz_cutter_product != ""){
											 $blitz_cutter_Aks_vehicles_products = get_Aks_vehicles_products_least_price($blitz_cutter_product);								  
											 $blitz_cutter_product_array = array('products_id' => $blitz_cutter_product, 'least_price' =>  $blitz_cutter_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $blitz_cutter_Aks_vehicles_products[0]['products_image']);
										  }else{
										  	$blitz_cutter_product_array = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');										  
										  }
										  
										  $get_position_machines_info = get_machines_info($get_Code_Series_name[0]['HPC_Blitz_Position']);
										  $blitz_position_product = $get_position_machines_info[0]['Products'];
										  if($get_position_machines_info[0]['Name'] == ""){
											 $blitz_position_name = '';
										  }else{
										  	$blitz_position_name = $get_position_machines_info[0]['Name'];
										  }
										  
										  $blitz_position_product_array = array();
										  if($blitz_position_product != ""){
											 $blitz_cutter_Aks_vehicles_products = get_Aks_vehicles_products_least_price($blitz_position_product);								  
											 $blitz_position_product_array = array('products_id' => $blitz_cutter_product, 'least_price' =>  $blitz_cutter_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $blitz_cutter_Aks_vehicles_products[0]['products_image']);
										  }else{
										  	$blitz_position_product_array = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');										  
										  }
										  $get_silica_cutter_machines_info = get_machines_info($get_Code_Series_name[0]['Silca_Cutter']);
										  $blitz_silica_cutter_product = $get_silica_cutter_machines_info[0]['Products'];
										  if($get_silica_cutter_machines_info[0]['Name'] == ""){
											 $blitz_silica_cutter_name = '';
										  }else{
										  	$blitz_silica_cutter_name = $get_silica_cutter_machines_info[0]['Name'];
										  }						  
										  if($get_Code_Series_name[0]['HPC_Blitz_Side'] == ""){										  
										  	$hpc_blitz_side = '';
										  }else{
										   $hpc_blitz_side = $get_Code_Series_name[0]['HPC_Blitz_Side'];
										  }
										  
										  if($get_Code_Series_name[0]['Silca_Card'] == ""){										  
										  	$hpc_blitz_silica_card = '';
										  }else{
										   $hpc_blitz_silica_card = $get_Code_Series_name[0]['Silca_Card'];
										  }
										    
										  $blitz_card = array('card' => $get_Code_Series_name[0]['HPC_Blitz_Card'],
										  'cutter' => array('value' =>$blitz_cutter_name,'products'=>$blitz_cutter_product_array),
										  'position' => array('value' =>$blitz_position_name,'products'=>$blitz_position_product_array),
										  'side' => $hpc_blitz_side,
										  'silca_card' => $hpc_blitz_silica_card,
										  'silica_cutter' => $blitz_silica_cutter_name 									  
										  );
										  
									  /*------------------- HPC PUNCH Section -------------------------------*/
									  	  $hpc_punch = array();	
										  $get_HPC_Punch_Punch = get_machines_info($get_Code_Series_name[0]['HPC_Punch_Punch']);
										  if($get_HPC_Punch_Punch[0]['Name'] == ""){
											  $hpc_name = '';
										  }else{
										  	$hpc_name = $get_HPC_Punch_Punch[0]['Name'];
										  }
										  if($get_Code_Series_name[0]['HPC_Punch_Card'] == ""){
											  $HPC_Punch_Card = '';
										  }else{
										  	$HPC_Punch_Card = $get_Code_Series_name[0]['HPC_Punch_Card'];
										  }
										  if($get_Code_Series_name[0]['HPC_Punch_Side'] == ""){
											  $HPC_Punch_Side = '';
										  }else{
										  	$HPC_Punch_Side = $get_Code_Series_name[0]['HPC_Punch_Side'];
										  }
										  $hpc_punch = array('card' => $HPC_Punch_Card,
										  'punch' => $hpc_name,
										  'side' => $HPC_Punch_Side									  
										  ); 	  
									
									  /*------------------- HPC CODEMAX Section -------------------------------*/
									  	  $hpc_codemax = array();	
										  $get_cutter_machines_info1 = get_machines_info($get_Code_Series_name[0]['HPC_CodeMax_Cutter']);
										  $blitz_cutter_product1 = $get_cutter_machines_info1[0]['Products'];
										  if($get_cutter_machines_info1[0]['Name'] == ""){
											  $blitz_cutter_name1 = '';
										  }else{
										  	$blitz_cutter_name1 = $get_cutter_machines_info1[0]['Name'];
										  }
										  $blitz_cutter_product_array1 = array();
										  if($blitz_cutter_product1 != ""){
											 $blitz_cutter_Aks_vehicles_products1 = get_Aks_vehicles_products_least_price($blitz_cutter_product1);								  
											 $blitz_cutter_product_array1 = array('products_id' => $blitz_cutter_produc1t, 'least_price' =>  $blitz_cutter_Aks_vehicles_products1[0]['MIN(products_price)'],'imagePath' => $blitz_cutter_Aks_vehicles_products1[0]['products_image']);
										  }else{
										  	$blitz_cutter_product_array1 = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');
										  }
										  
										  $get_position_machines_info1 = get_machines_info($get_Code_Series_name[0]['HPC_CodeMax_Position']);
										  $blitz_position_product1 = $get_position_machines_info1[0]['Products'];
										  if($get_position_machines_info1[0]['Name'] == ""){
											  $blitz_position_name1 = '';
										  }else{
										  	$blitz_position_name1 = $get_position_machines_info1[0]['Name'];
										  }
										  
										  $blitz_position_product_array1 = array();
										  if($blitz_position_product1 != ""){
											 $blitz_cutter_Aks_vehicles_products1 = get_Aks_vehicles_products_least_price($blitz_position_product1);								  
											 $blitz_position_product_array1 = array('products_id' => $blitz_cutter_product1, 'least_price' =>  $blitz_cutter_Aks_vehicles_products1[0]['MIN(products_price)'],'imagePath' => $blitz_cutter_Aks_vehicles_products1[0]['products_image']);
										  }else{
										  	 $blitz_position_product_array1 = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');
										  }
										  if($get_Code_Series_name[0]['HPC_CodeMax_DSD'] == ""){
										  	$HPC_CodeMax_DSD = '';
										  }else{
										  	$HPC_CodeMax_DSD = $get_Code_Series_name[0]['HPC_CodeMax_DSD'];
										  }
										  if($get_Code_Series_name[0]['HPC_CodeMax_Side'] == ""){
										  	$HPC_CodeMax_Side = '';
										  }else{
										  	$HPC_CodeMax_Side = $get_Code_Series_name[0]['HPC_CodeMax_Side'];
										  }
										  $hpc_codemax = array('dsd' => $HPC_CodeMax_DSD,										  
										  'side' => $HPC_CodeMax_Side,
										  'cutter' => array('value' =>$blitz_cutter_name1,'products'=>$blitz_cutter_product_array1),
										  'position' => array('value' =>$blitz_position_name1,'products'=>$blitz_position_product_array1),									  
										  ); 
									  /*------------------- ITL Section -------------------------------*/
									  	  $itl = array();
										  if($get_Code_Series_name[0]['ITL_ID'] == ""){
										  	$ITL_ID = '';
										  }else{
										  	$ITL_ID = $get_Code_Series_name[0]['ITL_ID'];
										  }
										  if($get_Code_Series_name[0]['ITL_Insert'] == ""){
										  	$ITL_Insert = '';
										  }else{
										  	$ITL_Insert = $get_Code_Series_name[0]['ITL_Insert'];
										  }
										  $itl = array('id' => $ITL_ID,
										  'insert' => $ITL_Insert									  
										  );  
										
										/*------------------- ITL Section -------------------------------*/
									  	  $curtis = array();
										  if($get_Code_Series_name[0]['Curtis_CamSet'] == ""){
										  	$Curtis_CamSet = '';
										  }else{
										  	$Curtis_CamSet = $get_Code_Series_name[0]['Curtis_CamSet'];
										  }
										  if($get_Code_Series_name[0]['Curtis_Carriage'] == ""){
										  	$Curtis_Carriage = '';
										  }else{
										  	$Curtis_Carriage = $get_Code_Series_name[0]['Curtis_Carriage'];
										  }
										  if($get_Code_Series_name[0]['Curtis_Cutter'] == ""){
										  	$Curtis_Cutter = '';
										  }else{
										  	$Curtis_Cutter = $get_Code_Series_name[0]['Curtis_Cutter'];
										  }
										  $curtis = array('cam_set' => $Curtis_CamSet,
										  'carriage' => $Curtis_Carriage,
										  'cutter' => $Curtis_Cutter									  
										  );
										
									/*------------------- Keyline Ninja Section -------------------------------*/
									  	  $keyline_ninja = array();	
										  $get_Keyline_Ninja_Vice = get_machines_info($get_Code_Series_name[0]['Keyline_Ninja_Vice']);
										  if($get_Keyline_Ninja_Vice[0]['Name'] == ""){
										  	$keyline_vice__name = '';
										  }else{
										  	$keyline_vice__name = $get_Keyline_Ninja_Vice[0]['Name'];
										  }										  
										  $get_Keyline_Ninja_Cutter = get_machines_info($get_Code_Series_name[0]['Keyline_Ninja_Cutter']);
										  if($get_Keyline_Ninja_Cutter[0]['Name'] == ""){
										  	$keyline_cutter__name = '';
										  }else{
										  	$keyline_cutter__name = $get_Keyline_Ninja_Cutter[0]['Name'];
										  }
										  if($get_Code_Series_name[0]['Keyline_Ninja_Side'] == ""){
										  	$Keyline_Ninja_Side = '';
										  }else{
										  	$Keyline_Ninja_Side = $get_Code_Series_name[0]['Keyline_Ninja_Side'];
										  }
										  if($get_Code_Series_name[0]['Keyline_Ninja_Position'] == ""){

										  	$Keyline_Ninja_Position = '';
										  }else{
										  	$Keyline_Ninja_Position = $get_Code_Series_name[0]['Keyline_Ninja_Position'];
										  }
										  $keyline_ninja = array('vise' => $keyline_vice__name,
										  'side' => $Keyline_Ninja_Side,
										  'position' => $Keyline_Ninja_Position,
										  'cutter'	=>$keyline_cutter__name 								  
										  );

									/*------------------------------ PAK Punch ----------------------------------------*/

									  $pak_a_punch_array = array();
									  $title_pak_punch = 'pak_a_punch';
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Pak_QCKit']);
									  $get_machines_info2 = get_machines_info($get_Code_Series_name[0]['Pak_Punch']);
									  $get_machines_info3 = get_machines_info($get_Code_Series_name[0]['Pak_Die']);
									  if($get_machines_info[0]['Name'] != ""){
										$Pak_QCKit = $get_machines_info[0]['Name'];
									  }else{
									  	$Pak_QCKit = '';
									  }
									  if($get_machines_info2[0]['Name'] != ""){
										$Pak_Punch = $get_machines_info2[0]['Name'];
									  }else{
									  	$Pak_Punch = '';
									  }
									  if($get_machines_info3[0]['Name'] != ""){
										$Pak_Die = $get_machines_info3[0]['Name'];
									  }else{
									  	$Pak_Die = '';
									  }
									  if($get_Code_Series_name[0]['Pak_Vise'] !=""){
									  	$Pak_Vise = $get_Code_Series_name[0]['Pak_Vise'];
									  }else{
									  	$Pak_Vise = '';
									  }
									  $pak_dsd = $Pak_QCKit.$get_Code_Series_name[0]['Pak_Vise'].','.$Pak_Punch.$Pak_Die;
									  
									  $pak_a_punch_array = array(
									  	  'QCKit' => $Pak_QCKit,
									  	  'vise' => $Pak_Vise,	
										  'punch' => $Pak_Punch,
										  'die' => $Pak_Die,
										  'cutter'	=>$keyline_cutter__name 								  
										);

									/*------------------------------ Framon Block ----------------------------------------*/

									  $framon_Block_array = array();
									  if($get_Code_Series_name[0]['Framon_Block'] != ""){
										$Framon_Block = $get_Code_Series_name[0]['Framon_Block'];
									  }else{
									  	$Framon_Block = '';
									  }
									  $Framon_Cutter_info= get_machines_info($get_Code_Series_name[0]['Framon_Cutter']);
									  if($Framon_Cutter_info[0]['Name']){
									 	$Framon_Cutter = $Framon_Cutter_info[0]['Name'];
									  }else{
									 	$Framon_Cutter = '';
									  }
									  if($get_Code_Series_name[0]['Framon_FirstCut'] != ""){
										$Framon_FirstCut = $get_Code_Series_name[0]['Framon_FirstCut'];
									  }else{
									  	$Framon_FirstCut = '';
									  }
									  if($get_Code_Series_name[0]['Framon_BetweenCuts'] != ""){
										$Framon_BetweenCuts = $get_Code_Series_name[0]['Framon_BetweenCuts'];
									  }else{
									  	$Framon_BetweenCuts = '';
									  }
									  if($get_Code_Series_name[0]['Framon_Notes'] != ""){
										$Framon_Notes = $get_Code_Series_name[0]['Framon_Notes'];
									  }else{
									  	$Framon_Notes = '';
									  }
									  
									  $framon_Block_array = array(
									  	  'block' => $Framon_Block,
									  	  'cutter' => $Framon_Cutter,	
										  'first_cutter' => $Framon_FirstCut,
										  'between_cuts' => $Framon_BetweenCuts,
										  'note'	=>$Framon_Notes 								  
										);									  
									/*------------------------------ Sidewinder 2 ----------------------------------------*/

									  $sw2_array = array();
									  if($get_Code_Series_name[0]['SW2_SpaceRod'] != ""){
										$SW2_SpaceRod = $get_Code_Series_name[0]['SW2_SpaceRod'];
									  }else{
									  	$SW2_SpaceRod = '';
									  }
									  if($get_Code_Series_name[0]['SW2_DepthRod'] != ""){
										$SW2_DepthRod = $get_Code_Series_name[0]['SW2_DepthRod'];
									  }else{
									  	$SW2_DepthRod = '';
									  }
									  if($get_Code_Series_name[0]['SW2_ViseSet'] != ""){
										$SW2_ViseSet = $get_Code_Series_name[0]['SW2_ViseSet'];
									  }else{
									  	$SW2_ViseSet = '';
									  }	
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['SW2_Cutter']);			
									  if($get_machines_info[0]['Name']){
									 	$SW2_Cutter = $get_machines_info[0]['Name'];
									  }else{
									 	$SW2_Cutter = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['SW2_Guide']);			
									  if($get_machines_info[0]['Name']){
									 	$SW2_Guide = $get_machines_info[0]['Name'];
									  }else{
									 	$SW2_Guide = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['SW2_Stop']);			
									  if($get_machines_info[0]['Name']){
									 	$SW2_Stop = $get_machines_info[0]['Name'];
									  }else{
									 	$SW2_Stop = '';
									  }	  
									  $sw2_array = array(
									  	  'space_rod' => $SW2_SpaceRod,
									  	  'depth_rod' => $SW2_DepthRod,	
										  'cutter' => $SW2_Cutter,
										  'guide' => $SW2_Guide,
										  'stop'	=>$SW2_Stop 								  
										);
									  
									/*------------------------------ LKP_3DX_DSD ----------------------------------------*/

									  $lkp_3dx_dsd_array = array();
									  if($get_Code_Series_name[0]['LKP_3DX_DSD'] != ""){
										$LKP_3DX_DSD = $get_Code_Series_name[0]['LKP_3DX_DSD'];
									  }else{
									  	$LKP_3DX_DSD = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['LKP_3DX_Jaw']);			
									  if($get_machines_info[0]['Name']){
									 	$LKP_3DX_Jaw = $get_machines_info[0]['Name'];
									  }else{
									 	$LKP_3DX_Jaw = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['LKP_3DX_JawClamp']);		
									  if($get_machines_info[0]['Name']){
									 	$LKP_3DX_JawClamp = $get_machines_info[0]['Name'];
									  }else{
									 	$LKP_3DX_JawClamp = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['LKP_3DX_Stop']);			
									  if($get_machines_info[0]['Name']){
									 	$LKP_3DX_Stop = $get_machines_info[0]['Name'];
									  }else{
									 	$LKP_3DX_Stop = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['LKP_3DX_Cutter']);		
									  if($get_machines_info[0]['Name']){
									 	$LKP_3DX_Cutter = $get_machines_info[0]['Name'];
									  }else{
									 	$LKP_3DX_Cutter = '';
									  }	  
									  $lkp_3dx_dsd_array = array(
									  	  'dsd' => $LKP_3DX_DSD,
									  	  'jaw' => $LKP_3DX_Jaw,	
										  'stop' => $LKP_3DX_Stop,
										  'cutter' => $LKP_3DX_Cutter								  
										);

									/*------------------------------ Keyline_994_Vise ----------------------------------------*/

									  $Keyline_Vise_array = array();
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Keyline_994_Vise']);		
									  if($get_machines_info[0]['Name']){
									 	$Keyline_994_Vise = $get_machines_info[0]['Name'];
									  }else{
									 	$Keyline_994_Vise = '';
									  }
									  if($get_Code_Series_name[0]['Keyline_994_Side'] != ""){
										$Keyline_994_Side = $get_Code_Series_name[0]['Keyline_994_Side'];
									  }else{
									  	$Keyline_994_Side = '';
									  }
									  if($get_Code_Series_name[0]['Keyline_994_Position'] != ""){
										$Keyline_994_Position = $get_Code_Series_name[0]['Keyline_994_Position'];
									  }else{
									  	$Keyline_994_Position = '';
									  }									  
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Keyline_994_Cutter']);	
									  if($get_machines_info[0]['Name']){
									 	$Keyline_994_Cutter = $get_machines_info[0]['Name'];
									  }else{
									 	$Keyline_994_Cutter = '';
									  }	  
									  $Keyline_Vise_array = array(
									  	  'vise' => $Keyline_994_Vise,
									  	  'side' => $Keyline_994_Side,	
										  'position' => $Keyline_994_Position,
										  'cutter' => $Keyline_994_Cutter								  
										);

				/*------------------------------ Silca_Futura_SSN ----------------------------------------*/

									  $silca_Futura_array = array();									  
									  if($get_Code_Series_name[0]['Silca_Futura_SSN'] != ""){
										$Silca_Futura_SSN = $get_Code_Series_name[0]['Silca_Futura_SSN'];
									  }else{
									  	$Silca_Futura_SSN = '';
									  }
									  if($get_Code_Series_name[0]['Silca_Futura_Card'] != ""){
										$Silca_Futura_Card = $get_Code_Series_name[0]['Silca_Futura_Card'];
									  }else{
									  	$Silca_Futura_Card = '';
									  }	  
									  $silca_Futura_array = array(
									  	  'ssn' => $Silca_Futura_SSN,
									  	  'card' => $Silca_Futura_Card								  
										);

									  $conodor_array = array();									  
									  if($get_Code_Series_name[0]['Condor_KeyName'] != ""){
										$Condor_KeyName = $get_Code_Series_name[0]['Condor_KeyName'];
									  }else{
									  	$Condor_KeyName = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Condor_Cutter']);			
									  if($get_machines_info[0]['Name']){
									 	$Condor_Cutter = $get_machines_info[0]['Name'];
									  }else{
									 	$Condor_Cutter = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Condor_Jaw']);			
									  if($get_machines_info[0]['Name']){
									 	$Condor_Jaw = $get_machines_info[0]['Name'];
									  }else{
									 	$Condor_Jaw = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Condor_JawSide']);			
									  if($get_machines_info[0]['Name']){
									 	$Condor_JawSide = $get_machines_info[0]['Name'];
									  }else{
									 	$Condor_JawSide = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Condor_Stop']);			
									  if($get_machines_info[0]['Name']){
									 	$Condor_Stop = $get_machines_info[0]['Name'];
									  }else{
									 	$Condor_Stop = '';
									  }
									  if($get_Code_Series_name[0]['Condor_Notes'] != ""){
										$Condor_Notes = $get_Code_Series_name[0]['Condor_Notes'];
									  }else{
									  	$Condor_Notes = '';
									  }
									    
									  $conodor_array = array(
									  	  'keyname' => $Condor_KeyName,
									  	  'cutter' => $Condor_Cutter,
									  	  'jaw' => $Condor_Jaw,
									  	  'jawSide' => $Condor_JawSide,
									  	  'stop' => $Condor_Stop,
									  	  'notes' => $Condor_Notes,								  
										);

									 $title_3dXtreme = 'xtreme_3d';							 
									  $xterem_dsd = $get_Code_Series_name[0]['LKP_3DX_DSD'];
									  $eez_reader = array();
									  if($get_Code_Series_name[0]['EEZ-Reader_UUID'] == NULL){
										   $eez_reader = array('value' => '','products' =>'','note'=>'','Difficulty'=>'');
									  }else{
										  $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($get_Code_Series_name[0]['EEZ-Reader_UUID']);
										  $eez_reader_tool = $get_manufactyrer_by_uuid[0]['Tool_Name'];
										  if($get_manufactyrer_by_uuid[0]['Tool_Note'] == NULL){
										  	  $tool_note = '';	
										  }else{
											  $tool_note = $get_manufactyrer_by_uuid[0]['Tool_Note'];	
										  }
										  if($get_manufactyrer_by_uuid[0]['Difficulty'] == NULL){
										  	  $Difficulty = '';	
										  }else{
											  $Difficulty = $get_manufactyrer_by_uuid[0]['Difficulty'];	
										  }
										  $eez_reader_product = $get_manufactyrer_by_uuid[0]['Products'];
										  $eez_reader_product_array = array();
										  if($eez_reader_product != ""){
											 $eez_reader_Aks_vehicles_products = get_Aks_vehicles_products_least_price($eez_reader_product);								  
											 $eez_reader_product_array = array('products_id' => $eez_reader_product, 'least_price' =>  $eez_reader_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $eez_reader_Aks_vehicles_products[0]['products_image']);
										  }
										   $eez_reader = array('value' => $eez_reader_tool,'products' => $eez_reader_product_arra,'note'=>$tool_note,'Difficulty'=>$Difficulty);
									  }
									  
									  
									  $try_out_keys = array();
									  if($get_Code_Series_name[0]['TryOutKeys_UUID'] == NULL || $get_Code_Series_name[0]['TryOutKeys_UUID'] == ""){
										   $try_out_keys = array('value' => '','products' =>'','note'=>'','Difficulty'=>'');
									  }else{
										  $try_out_keys_array  = explode(',',$get_Code_Series_name[0]['TryOutKeys_UUID']);
										  for($tr = 0; $tr < count($try_out_keys_array); $tr++){											  
											  $get_toolType_by_uuid = get_toolName_by_uuid($try_out_keys_array[$tr]);
											  $try_Tool_Name =  $get_toolType_by_uuid[0]['Tool_Name'];	
											  if($get_manufactyrer_by_uuid[0]['Tool_Note'] == NULL){
										  	  	   $tool_note = '';	
											  }else{
												  $tool_note = $get_manufactyrer_by_uuid[0]['Tool_Note'];	
											  }
											  if($get_manufactyrer_by_uuid[0]['Difficulty'] == NULL){
											  	  $Difficulty = '';	
											  }else{
												  $Difficulty = $get_manufactyrer_by_uuid[0]['Difficulty'];	
											  }										  
											  $try_product = $get_toolType_by_uuid[0]['Products'];
											  $try_out_product_array = array();
											  if($try_product != ""){
												 $try_out_Aks_vehicles_products = get_Aks_vehicles_products_least_price($try_product);								  
												 $try_out_product_array = array('products_id' => $try_product, 'least_price' =>  $try_out_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $try_out_Aks_vehicles_products[0]['products_image']);
											  }
											  $try_out_keys[] = array('value' => $try_Tool_Name,'products' => $try_out_product_array,'note'=>$tool_note,'Difficulty'=>$Difficulty);											  
										 }
									  }
									  
									  $accu_reader = array();
									  if($get_Code_Series_name[0]['Accu-Reader_UUID'] == NULL){
										   $accu_reader = array('value' => '','products' =>'','note'=>'','Difficulty'=>'');
									  }else{
										  $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($get_Code_Series_name[0]['Accu-Reader_UUID']);
										  $accu_reader_tool = $get_manufactyrer_by_uuid[0]['Tool_Name'];
										  if($get_manufactyrer_by_uuid[0]['Tool_Note'] == NULL){
										  	  $tool_note = '';	
										  }else{
											  $tool_note = $get_manufactyrer_by_uuid[0]['Tool_Note'];	
										  }
										  if($get_manufactyrer_by_uuid[0]['Difficulty'] == NULL){
										  	  $Difficulty = '';	
										  }else{
											  $Difficulty = $get_manufactyrer_by_uuid[0]['Difficulty'];	
										  }
										  $accu_reader_product = $get_manufactyrer_by_uuid[0]['Products'];
										  $accu_reader_product_array = array();
										  if($accu_reader_product != ""){
											 $accu_reader_Aks_vehicles_products = get_Aks_vehicles_products_least_price($accu_reader_product);								  
											 $accu_reader_product_array = array('products_id' => $accu_reader_product, 'least_price' =>  $accu_reader_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $accu_reader_Aks_vehicles_products[0]['products_image']);
										  }
										   $accu_reader = array('value' => $accu_reader_tool,'products' => $accu_reader_product_array,'note'=>$tool_note,'Difficulty'=>$Difficulty);
									  }
									  $title_accu_reader = 'accu_reader';
									  
									  $battery = array();
									  if($get_Code_Series_name[0]['Determinator_UUID'] == NULL){
										  $battery = array('value' => '','products' => '','note'=>'','Difficulty'=>'');
									  }else{
										  $battery_product_array = array();
										  $get_manufactyrer_by_uuid1 = get_manufactyrer_by_uuid($get_Code_Series_name[0]['Determinator_UUID']);
										  $battery_tool = $get_manufactyrer_by_uuid1[0]['Tool_Name'];
										  if($get_manufactyrer_by_uuid1[0]['Tool_Note'] == NULL){
										  	  $tool_note = '';	
										  }else{
											  $tool_note = $get_manufactyrer_by_uuid1[0]['Tool_Note'];	
										  }
										  if($get_manufactyrer_by_uuid1[0]['Difficulty'] == NULL){
										  	  $Difficulty = '';	
										  }else{
											  $Difficulty = $get_manufactyrer_by_uuid1[0]['Difficulty'];	
										  }
										  $battery_product = $get_manufactyrer_by_uuid1[0]['Products'];
										  if($battery_product != ""){
											 $battery_Aks_vehicles_products = get_Aks_vehicles_products_least_price($battery_product);								  
											 $battery_product_array = array('products_id' => $battery_product, 'least_price' =>  $battery_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $battery_Aks_vehicles_products[0]['products_image']);
										  }
										   $battery = array('value' => $battery_tool,'products' => $battery_product_array,'note'=>$tool_note,'Difficulty'=>$Difficulty);
									  }									  
									  $lishi = array();
									   if($get_Code_Series_name[0]['Lishi_UUID'] == NULL){
										  $lishi = array('value' => '','products' => '','lishi_note'=>'','Difficulty'=>'');
									  }else{
									  	  $lishi_note = "";	
										  $lishi_product_array = array();
										  $get_manufactyrer_by_uuid2 = get_manufactyrer_by_uuid($get_Code_Series_name[0]['Lishi_UUID']);
										  $lishi_tool = $get_manufactyrer_by_uuid2[0]['Tool_Name'];
										  if($get_manufactyrer_by_uuid2[0]['Tool_Note'] == NULL){
										  	  $lishi_note = '';	
										  }else{
											  $lishi_note = $get_manufactyrer_by_uuid2[0]['Tool_Note'];	
										  }
										  if($get_manufactyrer_by_uuid2[0]['Difficulty'] == NULL){
										  	  $Difficulty = '';	
										  }else{
											  $Difficulty = $get_manufactyrer_by_uuid2[0]['Difficulty'];	
										  }									  
										  $lishi_product = $get_manufactyrer_by_uuid2[0]['Products'];
										  if($lishi_product != ""){
											  $lishi_Aks_vehicles_products = get_Aks_vehicles_products_least_price($lishi_product);								  
											 $lishi_product_array = array('products_id' => $lishi_product, 'least_price' =>  $lishi_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $lishi_Aks_vehicles_products[0]['products_image']);
										  }
										   $lishi = array('value' => $lishi_tool,'products' => $lishi_product_array,'lishi_note'=>$lishi_note,'Difficulty'=>$Difficulty);
									  }	



									  $the_basic[] = array('code_series' => $get_Code_Series_name[0]['Code_Series_Name'],'depths' => $get_Code_Series_name[0]['Depths'],'ignition' => $Retainer_Name,'macs' => $get_Code_Series_name[0]['MACS'],'spaces' => $get_Code_Series_name[0]['Spaces']);											 
									  $vehicle_info_array = array('decode_with' =>  array($title_accu_reader => $accu_reader,'determinator' => $battery,'lishi' => $lishi,'try_out_keys'=>$try_out_keys,'eez_reader'=> $eez_reader),
									  'key_cutting' => array($title_blitz => $blitz_card,'hpc_punch' => $hpc_punch,'hpc_codemax' => $hpc_codemax,'itl' => $itl,'curtis' => $curtis,
									  		'keyline_ninja' => $keyline_ninja,
									  		'pak_a_punch' => $pak_a_punch_array,
										   'framon' => $framon_Block_array,
										   'sidewinder' => $sw2_array,
										   'lkp_3dx_xtreme'=> $lkp_3dx_dsd_array,
										   'silca_futura' => $silca_Futura_array,
										   'condor' => $conodor_array,
										   'keyline_vise' => $Keyline_Vise_array
									  ),
									  'key_programming' => $key_programming_array,
									  'the_basics' => $the_basic,
									  'the_keys' => array('key_type'=>$transpondar_keys_uuids),
									  'the_remotes' => $remote_array,
									  'OBD_Location' => $OBD_Location_array
									  );
									}
								  }
								}else{
								  $got_series_val = explode('|',$got_series_data[0]);
								  $code_series_id = $got_series_val[0];
								  $code_series_note = $got_series_val[1];
								  $get_Code_Series_name = get_Code_Series_name($code_series_id);
								  if($get_Code_Series_name == true){
								  	
									   /*------------------- Bliz_section -------------------------------*/
									  	  $blitz_card = array();
										  $title_blitz = 'blitz';
										  $get_cutter_machines_info = get_machines_info($get_Code_Series_name[0]['HPC_Blitz_Cutter']);
										  $blitz_cutter_product = $get_cutter_machines_info[0]['Products'];
										  if($get_cutter_machines_info[0]['Name'] == ""){
											  $blitz_cutter_name = '';
										  }else{
										  	$blitz_cutter_name = $get_cutter_machines_info[0]['Name'];
										  }
										  $blitz_cutter_product_array = array();
										  if($blitz_cutter_product != ""){
											 $blitz_cutter_Aks_vehicles_products = get_Aks_vehicles_products_least_price($blitz_cutter_product);	
											 						  
											 $blitz_cutter_product_array = array('products_id' => $blitz_cutter_product, 'least_price' =>  $blitz_cutter_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $blitz_cutter_Aks_vehicles_products[0]['products_image']);
										  }else{
										  	$blitz_cutter_product_array = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');										  
										  }
										  
										  $get_position_machines_info = get_machines_info($get_Code_Series_name[0]['HPC_Blitz_Position']);
										  $blitz_position_product = $get_position_machines_info[0]['Products'];
										  if($get_position_machines_info[0]['Name'] == ""){
											 $blitz_position_name = '';
										  }else{
										  	$blitz_position_name = $get_position_machines_info[0]['Name'];
										  }
										  
										  $blitz_position_product_array = array();
										  if($blitz_position_product != ""){
											 $blitz_cutter_Aks_vehicles_products = get_Aks_vehicles_products_least_price($blitz_position_product);								  
											 $blitz_position_product_array = array('products_id' => $blitz_cutter_product, 'least_price' =>  $blitz_cutter_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $blitz_cutter_Aks_vehicles_products[0]['products_image']);
										  }else{
										  	$blitz_position_product_array = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');										  
										  }
										  $get_silica_cutter_machines_info = get_machines_info($get_Code_Series_name[0]['Silca_Cutter']);
										  $blitz_silica_cutter_product = $get_silica_cutter_machines_info[0]['Products'];
										  if($get_silica_cutter_machines_info[0]['Name'] == ""){
											 $blitz_silica_cutter_name = '';
										  }else{
										  	$blitz_silica_cutter_name = $get_silica_cutter_machines_info[0]['Name'];
										  }						  
										  if($get_Code_Series_name[0]['HPC_Blitz_Side'] == ""){										  
										  	$hpc_blitz_side = '';
										  }else{
										   $hpc_blitz_side = $get_Code_Series_name[0]['HPC_Blitz_Side'];
										  }
										  
										  if($get_Code_Series_name[0]['Silca_Card'] == ""){										  
										  	$hpc_blitz_silica_card = '';
										  }else{
										   $hpc_blitz_silica_card = $get_Code_Series_name[0]['Silca_Card'];
										  }
										    
										  $blitz_card = array('card' => $get_Code_Series_name[0]['HPC_Blitz_Card'],
										  'cutter' => array('value' =>$blitz_cutter_name,'products'=>$blitz_cutter_product_array),
										  'position' => array('value' =>$blitz_position_name,'products'=>$blitz_position_product_array),
										  'side' => $hpc_blitz_side,
										  'silca_card' => $hpc_blitz_silica_card,
										  'silica_cutter' => $blitz_silica_cutter_name 									  
										  );
										  
									  /*------------------- HPC PUNCH Section -------------------------------*/
									  	  $hpc_punch = array();	
										  $get_HPC_Punch_Punch = get_machines_info($get_Code_Series_name[0]['HPC_Punch_Punch']);
										  if($get_HPC_Punch_Punch[0]['Name'] == ""){
											  $hpc_name = '';
										  }else{
										  	$hpc_name = $get_HPC_Punch_Punch[0]['Name'];
										  }
										  if($get_Code_Series_name[0]['HPC_Punch_Card'] == ""){
											  $HPC_Punch_Card = '';
										  }else{
										  	$HPC_Punch_Card = $get_Code_Series_name[0]['HPC_Punch_Card'];
										  }
										  if($get_Code_Series_name[0]['HPC_Punch_Side'] == ""){
											  $HPC_Punch_Side = '';
										  }else{
										  	$HPC_Punch_Side = $get_Code_Series_name[0]['HPC_Punch_Side'];
										  }
										  $hpc_punch = array('card' => $HPC_Punch_Card,
										  'punch' => $hpc_name,
										  'side' => $HPC_Punch_Side									  
										  ); 	  
									
									  /*------------------- HPC CODEMAX Section -------------------------------*/
									  	  $hpc_codemax = array();	
										  $get_cutter_machines_info1 = get_machines_info($get_Code_Series_name[0]['HPC_CodeMax_Cutter']);
										  $blitz_cutter_product1 = $get_cutter_machines_info1[0]['Products'];
										  if($get_cutter_machines_info1[0]['Name'] == ""){
											  $blitz_cutter_name1 = '';
										  }else{
										  	$blitz_cutter_name1 = $get_cutter_machines_info1[0]['Name'];
										  }
										  $blitz_cutter_product_array1 = array();
										  if($blitz_cutter_product1 != ""){
											 $blitz_cutter_Aks_vehicles_products1 = get_Aks_vehicles_products_least_price($blitz_cutter_product1);								  
											 $blitz_cutter_product_array1 = array('products_id' => $blitz_cutter_produc1t, 'least_price' =>  $blitz_cutter_Aks_vehicles_products1[0]['MIN(products_price)'],'imagePath' => $blitz_cutter_Aks_vehicles_products1[0]['products_image']);
										  }else{
										  	$blitz_cutter_product_array1 = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');
										  }
										  
										  $get_position_machines_info1 = get_machines_info($get_Code_Series_name[0]['HPC_CodeMax_Position']);
										  $blitz_position_product1 = $get_position_machines_info1[0]['Products'];
										  if($get_position_machines_info1[0]['Name'] == ""){
											  $blitz_position_name1 = '';
										  }else{
										  	$blitz_position_name1 = $get_position_machines_info1[0]['Name'];
										  }
										  
										  $blitz_position_product_array1 = array();
										  if($blitz_position_product1 != ""){
											 $blitz_cutter_Aks_vehicles_products1 = get_Aks_vehicles_products_least_price($blitz_position_product1);								  
											 $blitz_position_product_array1 = array('products_id' => $blitz_cutter_product1, 'least_price' =>  $blitz_cutter_Aks_vehicles_products1[0]['MIN(products_price)'],'imagePath' => $blitz_cutter_Aks_vehicles_products1[0]['products_image']);
										  }else{
										  	 $blitz_position_product_array1 = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');
										  }
										  if($get_Code_Series_name[0]['HPC_CodeMax_DSD'] == ""){
										  	$HPC_CodeMax_DSD = '';
										  }else{
										  	$HPC_CodeMax_DSD = $get_Code_Series_name[0]['HPC_CodeMax_DSD'];
										  }
										  if($get_Code_Series_name[0]['HPC_CodeMax_Side'] == ""){
										  	$HPC_CodeMax_Side = '';
										  }else{
										  	$HPC_CodeMax_Side = $get_Code_Series_name[0]['HPC_CodeMax_Side'];
										  }
										  $hpc_codemax = array('dsd' => $HPC_CodeMax_DSD,										  
										  'side' => $HPC_CodeMax_Side,
										  'cutter' => array('value' =>$blitz_cutter_name1,'products'=>$blitz_cutter_product_array1),
										  'position' => array('value' =>$blitz_position_name1,'products'=>$blitz_position_product_array1),									  
										  ); 
									  /*------------------- ITL Section -------------------------------*/
									  	  $itl = array();
										  if($get_Code_Series_name[0]['ITL_ID'] == ""){
										  	$ITL_ID = '';
										  }else{
										  	$ITL_ID = $get_Code_Series_name[0]['ITL_ID'];
										  }
										  if($get_Code_Series_name[0]['ITL_Insert'] == ""){
										  	$ITL_Insert = '';
										  }else{
										  	$ITL_Insert = $get_Code_Series_name[0]['ITL_Insert'];
										  }
										  $itl = array('id' => $ITL_ID,
										  'insert' => $ITL_Insert									  
										  );  
										
										/*------------------- ITL Section -------------------------------*/
									  	  $curtis = array();
										  if($get_Code_Series_name[0]['Curtis_CamSet'] == ""){
										  	$Curtis_CamSet = '';
										  }else{
										  	$Curtis_CamSet = $get_Code_Series_name[0]['Curtis_CamSet'];
										  }
										  if($get_Code_Series_name[0]['Curtis_Carriage'] == ""){
										  	$Curtis_Carriage = '';
										  }else{
										  	$Curtis_Carriage = $get_Code_Series_name[0]['Curtis_Carriage'];
										  }
										  if($get_Code_Series_name[0]['Curtis_Cutter'] == ""){
										  	$Curtis_Cutter = '';
										  }else{
										  	$Curtis_Cutter = $get_Code_Series_name[0]['Curtis_Cutter'];
										  }
										  $curtis = array('cam_set' => $Curtis_CamSet,
										  'carriage' => $Curtis_Carriage,
										  'cutter' => $Curtis_Cutter									  
										  );
										
									/*------------------- Keyline Ninja Section -------------------------------*/
									  	  $keyline_ninja = array();	
										  $get_Keyline_Ninja_Vice = get_machines_info($get_Code_Series_name[0]['Keyline_Ninja_Vice']);
										  if($get_Keyline_Ninja_Vice[0]['Name'] == ""){
										  	$keyline_vice__name = '';
										  }else{
										  	$keyline_vice__name = $get_Keyline_Ninja_Vice[0]['Name'];
										  }										  
										  $get_Keyline_Ninja_Cutter = get_machines_info($get_Code_Series_name[0]['Keyline_Ninja_Cutter']);
										  if($get_Keyline_Ninja_Cutter[0]['Name'] == ""){
										  	$keyline_cutter__name = '';
										  }else{
										  	$keyline_cutter__name = $get_Keyline_Ninja_Cutter[0]['Name'];
										  }
										  if($get_Code_Series_name[0]['Keyline_Ninja_Side'] == ""){
										  	$Keyline_Ninja_Side = '';
										  }else{
										  	$Keyline_Ninja_Side = $get_Code_Series_name[0]['Keyline_Ninja_Side'];
										  }
										  if($get_Code_Series_name[0]['Keyline_Ninja_Position'] == ""){
										  	$Keyline_Ninja_Position = '';
										  }else{
										  	$Keyline_Ninja_Position = $get_Code_Series_name[0]['Keyline_Ninja_Position'];
										  }
										  $keyline_ninja = array('vise' => $keyline_vice__name,
										  'side' => $Keyline_Ninja_Side,
										  'position' => $Keyline_Ninja_Position,
										  'cutter'	=>$keyline_cutter__name 								  
										  );
									  
									/*------------------------------ PAK Punch ----------------------------------------*/

									  $pak_a_punch_array = array();
									  $title_pak_punch = 'pak_a_punch';
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Pak_QCKit']);
									  $get_machines_info2 = get_machines_info($get_Code_Series_name[0]['Pak_Punch']);
									  $get_machines_info3 = get_machines_info($get_Code_Series_name[0]['Pak_Die']);
									  if($get_machines_info[0]['Name'] != ""){
										$Pak_QCKit = $get_machines_info[0]['Name'];
									  }else{
									  	$Pak_QCKit = '';
									  }
									  if($get_machines_info2[0]['Name'] != ""){
										$Pak_Punch = $get_machines_info2[0]['Name'];
									  }else{
									  	$Pak_Punch = '';
									  }
									  if($get_machines_info3[0]['Name'] != ""){
										$Pak_Die = $get_machines_info3[0]['Name'];
									  }else{
									  	$Pak_Die = '';
									  }
									  if($get_Code_Series_name[0]['Pak_Vise'] !=""){
									  	$Pak_Vise = $get_Code_Series_name[0]['Pak_Vise'];
									  }else{
									  	$Pak_Vise = '';
									  }
									  $pak_dsd = $Pak_QCKit.$get_Code_Series_name[0]['Pak_Vise'].','.$Pak_Punch.$Pak_Die;
									  
									  $pak_a_punch_array = array(
									  	  'QCKit' => $Pak_QCKit,
									  	  'vise' => $Pak_Vise,	
										  'punch' => $Pak_Punch,
										  'die' => $Pak_Die,
										  'cutter'	=>$keyline_cutter__name 								  
										);

									/*------------------------------ Framon Block ----------------------------------------*/

									  $framon_Block_array = array();
									  if($get_Code_Series_name[0]['Framon_Block'] != ""){
										$Framon_Block = $get_Code_Series_name[0]['Framon_Block'];
									  }else{
									  	$Framon_Block = '';
									  }
									  $Framon_Cutter_info= get_machines_info($get_Code_Series_name[0]['Framon_Cutter']);
									  if($Framon_Cutter_info[0]['Name']){
									 	$Framon_Cutter = $Framon_Cutter_info[0]['Name'];
									  }else{
									 	$Framon_Cutter = '';
									  }
									  if($get_Code_Series_name[0]['Framon_FirstCut'] != ""){
										$Framon_FirstCut = $get_Code_Series_name[0]['Framon_FirstCut'];
									  }else{
									  	$Framon_FirstCut = '';
									  }
									  if($get_Code_Series_name[0]['Framon_BetweenCuts'] != ""){
										$Framon_BetweenCuts = $get_Code_Series_name[0]['Framon_BetweenCuts'];
									  }else{
									  	$Framon_BetweenCuts = '';
									  }
									  if($get_Code_Series_name[0]['Framon_Notes'] != ""){
										$Framon_Notes = $get_Code_Series_name[0]['Framon_Notes'];
									  }else{
									  	$Framon_Notes = '';
									  }
									  
									  $framon_Block_array = array(
									  	  'block' => $Framon_Block,
									  	  'cutter' => $Framon_Cutter,	
										  'first_cutter' => $Framon_FirstCut,
										  'between_cuts' => $Framon_BetweenCuts,
										  'note'	=>$Framon_Notes 								  
										);									  
									/*------------------------------ Sidewinder 2 ----------------------------------------*/

									  $sw2_array = array();
									  if($get_Code_Series_name[0]['SW2_SpaceRod'] != ""){
										$SW2_SpaceRod = $get_Code_Series_name[0]['SW2_SpaceRod'];
									  }else{
									  	$SW2_SpaceRod = '';
									  }
									  if($get_Code_Series_name[0]['SW2_DepthRod'] != ""){
										$SW2_DepthRod = $get_Code_Series_name[0]['SW2_DepthRod'];
									  }else{
									  	$SW2_DepthRod = '';
									  }
									  if($get_Code_Series_name[0]['SW2_ViseSet'] != ""){
										$SW2_ViseSet = $get_Code_Series_name[0]['SW2_ViseSet'];
									  }else{
									  	$SW2_ViseSet = '';
									  }	
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['SW2_Cutter']);			
									  if($get_machines_info[0]['Name']){
									 	$SW2_Cutter = $get_machines_info[0]['Name'];
									  }else{
									 	$SW2_Cutter = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['SW2_Guide']);			
									  if($get_machines_info[0]['Name']){
									 	$SW2_Guide = $get_machines_info[0]['Name'];
									  }else{
									 	$SW2_Guide = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['SW2_Stop']);			
									  if($get_machines_info[0]['Name']){
									 	$SW2_Stop = $get_machines_info[0]['Name'];
									  }else{
									 	$SW2_Stop = '';
									  }	  
									  $sw2_array = array(
									  	  'space_rod' => $SW2_SpaceRod,
									  	  'depth_rod' => $SW2_DepthRod,	
										  'cutter' => $SW2_Cutter,
										  'guide' => $SW2_Guide,
										  'stop'	=>$SW2_Stop 								  
										);
									  
									/*------------------------------ LKP_3DX_DSD ----------------------------------------*/

									  $lkp_3dx_dsd_array = array();
									  if($get_Code_Series_name[0]['LKP_3DX_DSD'] != ""){
										$LKP_3DX_DSD = $get_Code_Series_name[0]['LKP_3DX_DSD'];
									  }else{
									  	$LKP_3DX_DSD = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['LKP_3DX_Jaw']);			
									  if($get_machines_info[0]['Name']){
									 	$LKP_3DX_Jaw = $get_machines_info[0]['Name'];
									  }else{
									 	$LKP_3DX_Jaw = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['LKP_3DX_JawClamp']);		
									  if($get_machines_info[0]['Name']){
									 	$LKP_3DX_JawClamp = $get_machines_info[0]['Name'];
									  }else{
									 	$LKP_3DX_JawClamp = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['LKP_3DX_Stop']);			
									  if($get_machines_info[0]['Name']){
									 	$LKP_3DX_Stop = $get_machines_info[0]['Name'];
									  }else{
									 	$LKP_3DX_Stop = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['LKP_3DX_Cutter']);		
									  if($get_machines_info[0]['Name']){
									 	$LKP_3DX_Cutter = $get_machines_info[0]['Name'];
									  }else{
									 	$LKP_3DX_Cutter = '';
									  }	  
									  $lkp_3dx_dsd_array = array(
									  	  'dsd' => $LKP_3DX_DSD,
									  	  'jaw' => $LKP_3DX_Jaw,	
										  'stop' => $LKP_3DX_Stop,
										  'cutter' => $LKP_3DX_Cutter								  
										);

									/*------------------------------ Keyline_994_Vise ----------------------------------------*/

									  $Keyline_Vise_array = array();
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Keyline_994_Vise']);		
									  if($get_machines_info[0]['Name']){
									 	$Keyline_994_Vise = $get_machines_info[0]['Name'];
									  }else{
									 	$Keyline_994_Vise = '';
									  }
									  if($get_Code_Series_name[0]['Keyline_994_Side'] != ""){
										$Keyline_994_Side = $get_Code_Series_name[0]['Keyline_994_Side'];
									  }else{
									  	$Keyline_994_Side = '';
									  }
									  if($get_Code_Series_name[0]['Keyline_994_Position'] != ""){
										$Keyline_994_Position = $get_Code_Series_name[0]['Keyline_994_Position'];
									  }else{
									  	$Keyline_994_Position = '';
									  }									  
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Keyline_994_Cutter']);	
									  if($get_machines_info[0]['Name']){
									 	$Keyline_994_Cutter = $get_machines_info[0]['Name'];
									  }else{
									 	$Keyline_994_Cutter = '';
									  }	  
									  $Keyline_Vise_array = array(
									  	  'vise' => $Keyline_994_Vise,
									  	  'side' => $Keyline_994_Side,	
										  'position' => $Keyline_994_Position,
										  'cutter' => $Keyline_994_Cutter								  
										);

						/*------------------------------ Silca_Futura_SSN -------------------------*/

									  $silca_Futura_array = array();									  
									  if($get_Code_Series_name[0]['Silca_Futura_SSN'] != ""){
										$Silca_Futura_SSN = $get_Code_Series_name[0]['Silca_Futura_SSN'];
									  }else{
									  	$Silca_Futura_SSN = '';
									  }
									  if($get_Code_Series_name[0]['Silca_Futura_Card'] != ""){
										$Silca_Futura_Card = $get_Code_Series_name[0]['Silca_Futura_Card'];
									  }else{
									  	$Silca_Futura_Card = '';
									  }	  
									  $silca_Futura_array = array(
									  	  'ssn' => $Silca_Futura_SSN,
									  	  'card' => $Silca_Futura_Card								  
										);

									  $conodor_array = array();									  
									  if($get_Code_Series_name[0]['Condor_KeyName'] != ""){
										$Condor_KeyName = $get_Code_Series_name[0]['Condor_KeyName'];
									  }else{
									  	$Condor_KeyName = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Condor_Cutter']);			
									  if($get_machines_info[0]['Name']){
									 	$Condor_Cutter = $get_machines_info[0]['Name'];
									  }else{
									 	$Condor_Cutter = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Condor_Jaw']);			
									  if($get_machines_info[0]['Name']){
									 	$Condor_Jaw = $get_machines_info[0]['Name'];
									  }else{
									 	$Condor_Jaw = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Condor_JawSide']);			
									  if($get_machines_info[0]['Name']){
									 	$Condor_JawSide = $get_machines_info[0]['Name'];
									  }else{
									 	$Condor_JawSide = '';
									  }
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Condor_Stop']);			
									  if($get_machines_info[0]['Name']){
									 	$Condor_Stop = $get_machines_info[0]['Name'];
									  }else{
									 	$Condor_Stop = '';
									  }
									  if($get_Code_Series_name[0]['Condor_Notes'] != ""){
										$Condor_Notes = $get_Code_Series_name[0]['Condor_Notes'];
									  }else{
									  	$Condor_Notes = '';
									  }
									    
									  $conodor_array = array(
									  	  'keyname' => $Condor_KeyName,
									  	  'cutter' => $Condor_Cutter,
									  	  'jaw' => $Condor_Jaw,
									  	  'jawSide' => $Condor_JawSide,
									  	  'stop' => $Condor_Stop,
									  	  'notes' => $Condor_Notes,								  
										);


									  $title_3dXtreme = 'xtreme_3d';							 
									  $xterem_dsd = $get_Code_Series_name[0]['LKP_3DX_DSD'];		  
									  $title_pak_punch = 'pak_a_punch';
									  $get_machines_info = get_machines_info($get_Code_Series_name[0]['Pak_QCKit']);
									  $get_machines_info2 = get_machines_info($get_Code_Series_name[0]['Pak_Punch']);
									  $get_machines_info3 = get_machines_info($get_Code_Series_name[0]['Pak_Die']);
									  if($get_machines_info[0]['Name'] != ""){
										$Pak_QCKit = $get_machines_info[0]['Name'].',';
									  }
									  if($get_machines_info2[0]['Name'] != ""){
										$Pak_Punch = $get_machines_info2[0]['Name'].',';
									  }
									  if($get_machines_info3[0]['Name'] != ""){
										$Pak_Die = $get_machines_info3[0]['Name'].',';
									  }
									  $pak_dsd = $Pak_QCKit.$get_Code_Series_name[0]['Pak_Vise'].','.$Pak_Punch.$Pak_Die;
									  
									  $eez_reader = array();
									  if($get_Code_Series_name[0]['EEZ-Reader_UUID'] == NULL){
										   $eez_reader = array('value' => '','products' =>'','note'=>'','Difficulty'=>'');
									  }else{
										  $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($get_Code_Series_name[0]['EEZ-Reader_UUID']);
										  $eez_reader_tool = $get_manufactyrer_by_uuid[0]['Tool_Name'];
										  if($get_manufactyrer_by_uuid[0]['Tool_Note'] == NULL){
										  	  $tool_note = '';	
										  }else{
											  $tool_note = $get_manufactyrer_by_uuid[0]['Tool_Note'];	
										  }
										  if($get_manufactyrer_by_uuid[0]['Difficulty'] == NULL){
										  	  $Difficulty = '';	
										  }else{
											  $Difficulty = $get_manufactyrer_by_uuid[0]['Difficulty'];	
										  }
										  $eez_reader_product = $get_manufactyrer_by_uuid[0]['Products'];
										  $eez_reader_product_array = array();
										  if($eez_reader_product != ""){
											 $eez_reader_Aks_vehicles_products = get_Aks_vehicles_products_least_price($eez_reader_product);								  
											 $eez_reader_product_array = array('products_id' => $eez_reader_product, 'least_price' =>  $eez_reader_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $eez_reader_Aks_vehicles_products[0]['products_image']);
										  }
										   $eez_reader = array('value' => $eez_reader_tool,'products' => $eez_reader_product_array,'note'=>$tool_note,'Difficulty'=>$Difficulty);
									  }
									  
									  
									  $try_out_keys = array();
									  if($get_Code_Series_name[0]['TryOutKeys_UUID'] == NULL || $get_Code_Series_name[0]['TryOutKeys_UUID'] == ""){
										   $try_out_keys = array('value' => '','products' =>'','note'=>'','Difficulty'=>'');
									  }else{
										  $try_out_keys_array  = explode(',',$get_Code_Series_name[0]['TryOutKeys_UUID']);
										  for($tr = 0; $tr < count($try_out_keys_array); $tr++){											  
											  $get_toolType_by_uuid = get_toolName_by_uuid($try_out_keys_array[$tr]);
											  $try_Tool_Name =  $get_toolType_by_uuid[0]['Tool_Name'];	
											  if($get_manufactyrer_by_uuid[0]['Tool_Note'] == NULL){
										  	  	   $tool_note = '';	
											  }else{
												  $tool_note = $get_manufactyrer_by_uuid[0]['Tool_Note'];	
											  }
											  if($get_manufactyrer_by_uuid[0]['Difficulty'] == NULL){
											  	  $Difficulty = '';	
											  }else{
												  $Difficulty = $get_manufactyrer_by_uuid[0]['Difficulty'];	
											  }										  
											  $try_product = $get_toolType_by_uuid[0]['Products'];
											  $try_out_product_array = array();
											  if($try_product != ""){
												 $try_out_Aks_vehicles_products = get_Aks_vehicles_products_least_price($try_product);								  
												 $try_out_product_array = array('products_id' => $try_product, 'least_price' =>  $try_out_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $try_out_Aks_vehicles_products[0]['products_image']);
											  }
											  $try_out_keys[] = array('value' => $try_Tool_Name,'products' => $try_out_product_array,'note'=>$tool_note,'Difficulty'=>$Difficulty);											  
										 }
									  }
									  
									  $accu_reader = array();
									  if($get_Code_Series_name[0]['Accu-Reader_UUID'] == NULL){
										   $accu_reader = array('value' => '','products' =>'','note'=>'','Difficulty'=>'');
									  }else{
										  $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($get_Code_Series_name[0]['Accu-Reader_UUID']);
										  $accu_reader_tool = $get_manufactyrer_by_uuid[0]['Tool_Name'];
										  if($get_manufactyrer_by_uuid[0]['Tool_Note'] == NULL){
										  	  $tool_note = '';	
										  }else{
											  $tool_note = $get_manufactyrer_by_uuid[0]['Tool_Note'];	
										  }
										  if($get_manufactyrer_by_uuid[0]['Difficulty'] == NULL){
										  	  $Difficulty = '';	
										  }else{
											  $Difficulty = $get_manufactyrer_by_uuid[0]['Difficulty'];	
										  }
										  $accu_reader_product = $get_manufactyrer_by_uuid[0]['Products'];
										  $accu_reader_product_array = array();
										  if($accu_reader_product != ""){
											 $accu_reader_Aks_vehicles_products = get_Aks_vehicles_products_least_price($accu_reader_product);								  
											 $accu_reader_product_array = array('products_id' => $accu_reader_product, 'least_price' =>  $accu_reader_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $accu_reader_Aks_vehicles_products[0]['products_image']);
										  }
										   $accu_reader = array('value' => $accu_reader_tool,'products' => $accu_reader_product_array,'note'=>$tool_note,'Difficulty'=>$Difficulty);
									  }
									  $title_accu_reader = 'accu_reader';
									  
									  $battery = array();
									  if($get_Code_Series_name[0]['Determinator_UUID'] == NULL){
										  $battery = array('value' => '','products' => '','note'=>'','Difficulty'=>'');
									  }else{
										  $battery_product_array = array();
										  $get_manufactyrer_by_uuid1 = get_manufactyrer_by_uuid($get_Code_Series_name[0]['Determinator_UUID']);
										  $battery_tool = $get_manufactyrer_by_uuid1[0]['Tool_Name'];
										  if($get_manufactyrer_by_uuid1[0]['Tool_Note'] == NULL){
										  	  $tool_note = '';	
										  }else{
											  $tool_note = $get_manufactyrer_by_uuid1[0]['Tool_Note'];	
										  }
										  if($get_manufactyrer_by_uuid1[0]['Difficulty'] == NULL){
										  	  $Difficulty = '';	
										  }else{
											  $Difficulty = $get_manufactyrer_by_uuid1[0]['Difficulty'];	
										  }
										  $battery_product = $get_manufactyrer_by_uuid1[0]['Products'];
										  if($battery_product != ""){
											 $battery_Aks_vehicles_products = get_Aks_vehicles_products_least_price($battery_product);								  
											 $battery_product_array = array('products_id' => $battery_product, 'least_price' =>  $battery_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $battery_Aks_vehicles_products[0]['products_image']);
										  }
										   $battery = array('value' => $battery_tool,'products' => $battery_product_array,'note'=>$tool_note,'Difficulty'=>$Difficulty);
									  }
									  
									   $lishi = array();
									   if($get_Code_Series_name[0]['Lishi_UUID'] == NULL){
										  $lishi = array('value' => '','products' => '','lishi_note'=>'','Difficulty'=>'');
									  }else{
										  $lishi_product_array = array();
										  $lishi_note = "";
										  $get_manufactyrer_by_uuid2 = get_manufactyrer_by_uuid($get_Code_Series_name[0]['Lishi_UUID']);
										  $lishi_tool = $get_manufactyrer_by_uuid2[0]['Tool_Name'];
										  if($get_manufactyrer_by_uuid2[0]['Tool_Note'] == NULL){
										  	  $lishi_note = '';	
										  }else{
											  $lishi_note = $get_manufactyrer_by_uuid2[0]['Tool_Note'];	
										  }
										  if($get_manufactyrer_by_uuid2[0]['Difficulty'] == NULL){
										  	  $Difficulty = '';	
										  }else{
											  $Difficulty = $get_manufactyrer_by_uuid2[0]['Difficulty'];	
										  }
										  $lishi_product = $get_manufactyrer_by_uuid2[0]['Products'];
										  if($lishi_product != ""){
											  $lishi_Aks_vehicles_products = get_Aks_vehicles_products_least_price($lishi_product);								  
											 $lishi_product_array = array('products_id' => $lishi_product, 'least_price' =>  $lishi_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $lishi_Aks_vehicles_products[0]['products_image']);
										  }
										   $lishi = array('value' => $lishi_tool,'products' => $lishi_product_array,'lishi_note'=>$lishi_note,'Difficulty'=>$Difficulty);
									  }										  
									  $the_basic[] = array('code_series' => $get_Code_Series_name[0]['Code_Series_Name'],'depths' => $get_Code_Series_name[0]['Depths'],'ignition' => $Retainer_Name,'macs' => $get_Code_Series_name[0]['MACS'],'spaces' => $get_Code_Series_name[0]['Spaces']);
									  	 $vehicle_info_array = array(
											  'decode_with' =>  array(
											  				$title_accu_reader => $accu_reader,
											  				'determinator' => $battery,
											  				'lishi' => $lishi,
											  				'try_out_keys'=>$try_out_keys,
											  				'eez_reader'=> $eez_reader
											  	),
											    'key_cutting' => array(
											    	$title_blitz => $blitz_card,
											       'hpc_punch' => $hpc_punch,
											       'hpc_codemax' => $hpc_codemax,
											       'itl' => $itl,'curtis' => $curtis,
											  	   'keyline_ninja' => $keyline_ninja,
											  	   'pak_a_punch' => $pak_a_punch_array,
												   'framon' => $framon_Block_array,
												   'sidewinder' => $sw2_array,
												   'lkp_3dx_xtreme'=> $lkp_3dx_dsd_array,
												   'silca_futura' => $silca_Futura_array,
												   'condor' => $conodor_array,
												   'keyline_vise' => $Keyline_Vise_array
											    ),
											  'key_programming' => $key_programming_array,
											  'the_basics' => $the_basic,
											  'the_keys' => array('key_type'=>$transpondar_keys_uuids),
											  'the_remotes' => $remote_array,
											  'OBD_Location' => $OBD_Location_array
									   );									      											   
								  }else{
								  	$vehicle_info_array = array(
											  'key_programming' => $key_programming_array,
											  'the_keys' => array('key_type'=>$transpondar_keys_uuids),
											  'the_remotes' => $remote_array,
											  'OBD_Location' => $OBD_Location_array
									   );					
								  }
								  
						}	
						//print_r($vehicle_info_array);				
						$vehicle_parts_array = array();			
						$parts_Ignition = explode(',',$vehciles['Parts_Ignition']);	
						if($vehciles['Parts_Ignition'] == NULL || $vehciles['Parts_Ignition'] == ""){
							    $price = 0;
								$vehicle_parts_array[] = array(
									'image' => '',
									'inStock' => '',
									'itemID' =>0,
									'make' => '',
									'manufacturerName'=> '',
									'modelName' => '',
									'name' => '',
									'price' => $price,
									'rating' => $price
							  );
						
						}else{			
							for($i = 0; $i < count($parts_Ignition); $i++){
								$products_id = trim($parts_Ignition[$i]);					
								$get_Aks_vehicles_products = get_Aks_vehicles_products($products_id);
								if($get_Aks_vehicles_products == 0){
									$price = 0;
									// $vehicle_parts_array[] = array(
									// 	'image' => '',
									// 	'inStock' => '',
									// 	'itemID' =>0,
									// 	'make' => '',
									// 	'manufacturerName'=> '',
									// 	'modelName' => '',
									// 	'name' => '',
									// 	'price' => $price,
									// 	'rating' => $price
								 //  );
								}else{
									//echo $vehciles_parts['id'].'<br>';	
									//$get_make_name = get_make_name($vehciles['Model_UUID']);
									$get_Aks_vehicles_products_des = get_Aks_vehicles_products_des($products_id);
									$products_manufacture = get_products_manufacture($get_Aks_vehicles_products[0]['manufacturers_id']);
									if($get_Aks_vehicles_products[0]['products_status'] == 1){
										$stock_sts = true;
									}else{
										$stock_sts = false;
									}
									if($products_id !=""){
										$vehicle_parts_array[$products_id] = array(
											  'image' => $get_Aks_vehicles_products[0]['products_image'],
											  'inStock' => $stock_sts,
											  'itemID' =>(int)$products_id,
											  'make' => $vehciles['Make_Name'],
											  'manufacturerName'=> $products_manufacture[0]['manufacturers_name'],
											  'modelName' => $get_Aks_vehicles_products[0]['products_model'],
											  'name' => $get_Aks_vehicles_products_des[0]['products_name'],
											  'price'=>floatval(number_format($get_Aks_vehicles_products[0]['products_price'],1)),
											  'rating' => 0 
										);
									}							
								}					
							}
						}												
						$vehicle_info_array2['vehicle_info'] = $vehicle_info_array;
						
						$vehicle_info_tpis =  array();
						$vehicle_info_tpis[] = array('dislikes' => '0', 'dislikesby' => 'TEST','likedby'=>'TESTING', 'likes'=>'2',
						 'pictures' => array('sample.jpg'), 'steps' => 'steps test','tip_name' => 'Tip 1' );											
						$vehicle_info_array2['vehicle_parts'] = $vehicle_parts_array;						
						$vehicle_info_array2['years'] = $year_array;
						$vehicle_info_array2['tubmler_data'] = $tubmler_data;
						$vehicle_info_array2['key_making_methods'] = $key_making_method_array;
						$vehicle_info_array2['tips_tricks_methods']  = $tips_tricks_array;
						$vehicle_info_array2['vehicle_image'] = $get_vehicles_images_array;
						
						$vehicle_info_array3[ $vehciles['id'] ] = $vehicle_info_array2;

						$message =  '<div class="alert alert-success">Data added Successfully!</div>';
					}
				$vehicle_info_array_test = array();	
				$vehicle_info_array_test['years'] = $tips_tricks_array;
				//print_r($vehicle_info_array3);				
				$data = json_encode($vehicle_info_array3);				
				$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';						
				$cSession = curl_init(); 				
				curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/vehicle1.json?". http_build_query($options));
				//curl_setopt($cSession,CURLOPT_URL,"https://american-key.firebaseio.com/vehicle2.json");
				curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
				curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "PATCH");						
				curl_setopt($cSession, CURLOPT_POSTFIELDS,$data); 
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);	
				curl_setopt($cSession,CURLOPT_SSL_VERIFYPEER,false);
				$result_output = curl_exec($cSession);
				//echo '<br>'.curl_error($cSession);						
				curl_close($cSession);	
				//print_r($result_output);
				$message =  '<div class="alert alert-success">Data added Successfully!</div>';					
				echo $message;			
			
			/******************** Delete Firebase Node *****************************/
				// $data_tips = json_encode($vehicle_info_tpis);
				// $options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';						
				// $cSession1 = curl_init(); 				
				// curl_setopt($cSession1,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/vehicle2.json?". http_build_query($options));
				// //curl_setopt($cSession1,CURLOPT_URL,"https://american-key.firebaseio.com/vehicle.json");
				// curl_setopt($cSession1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
				// curl_setopt($cSession1, CURLOPT_CUSTOMREQUEST, "DELETE");						
				// curl_setopt($cSession1, CURLOPT_POSTFIELDS,$data_tips); 
				// curl_setopt($cSession1,CURLOPT_SSL_VERIFYPEER,false);
				// curl_setopt($cSession1,CURLOPT_RETURNTRANSFER,true);												
				// $result_output1 = curl_exec($cSession1);
				// echo curl_error($cSession1);						
				// curl_close($cSession1);
			
			?>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->	