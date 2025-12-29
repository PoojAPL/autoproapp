<?php error_reporting(0);?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">    	
    	<div class="col-sm-24">
        <div class="form-group addCodeSeries">          
         <!-- <a href="<?php echo adm_base_url();?>/vehicles/add_vehicle" class="btn btn-danger" >Add New Vehicle</a>-->        
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
			       $all_remotes_array = array();
			       $i =1;
             foreach($all_remotes as $value){
                  $get_remote_types = get_remote_types($value['Remote_Type_UUID']);
                  $Remote_Type_Name = $get_remote_types[0]['Remote_Type_Name'];
                  $Remote_Name_1 = $value['Remote_Name'];
                  $vehicles_ar = array();
                  if( $value['Vehicles_UUID'] != ""){
                      $vehicles_UUIDs = explode(',', $value['Vehicles_UUID']);
                        for($v = 0; $v < count($vehicles_UUIDs); $v++){
                          $get_vehicles = get_vehicles($vehicles_UUIDs[$v]);
                          $years = explode(',',$get_vehicles[0]['Years']);
                          $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
                          $get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
                          $vehicles_ar[] = $get_make_name[0]['Make_Name'].' ' .$get_models_name[0]['Model_Name'].'  '.$years[0].'-'.$years[count($years)-1];
                        }
                      }
                   
                      $images = $value['Remote_Image_Url'];
                      $OEM_Part_Number = $value['OEM_Part_Number'];
                      $buttons_array  = explode(',',$value['Buttons']);
                      $buttons_array2 = array();
                      for($i = 0; $i < count( $buttons_array)-1; $i++ ){
                          $get_buttons_info = get_buttons_info($buttons_array[$i]); 
                          if( count($get_buttons_info) > 0){
                                  $buttons_array2[] = $get_buttons_info[0]['Name'];
                          }
                      }
                      $FCCID =  $value['FCCID'];
                      $IC = $value['IC'];
                      $get_frequency_info = get_frequency_info($value['Frequency']);
                      $Frequency_Name =  $get_frequency_info[0]['Name'];
                      $get_batteries = get_batteries($value['Battery_UUID']);
                      $Battery_Name = $get_batteries[0]['Battery_Name'];
                      $get_chips = get_chips($value['Chip_UUID']);
                      $Chip_Name = $get_chips[0]['Chip_Name'];
                      $get_kyes = get_key_name($value['TestKey_UUID']);
                      $Key_Name = $get_kyes[0]['Key_Name'];
                      $shell_array  = $value['Shell_UUID'];
                      $get_remote_name = get_remote_shell_name($shell_array);
                      $Remote_Name_2 = $get_remote_name[0]['Remote_Name'];
                      $Reusable = $value['Reusable'];
                      $Products = $value['Products'];
                      $mach_Products = $Products;
                      $mck_product_array = array();
                      if($mach_Products != ""){
                        $mck_Aks_vehicles_products = get_Aks_vehicles_products_least_price($mach_Products);                 
                        $mck_product_array = array('products_id' => $mach_Products, 'least_price' =>  $mck_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $mck_Aks_vehicles_products[0]['products_image']);
                      }
                      $all_remotes_array[$value['id']] = array('Type'=>$Remote_Type_Name,
                                           'Name'=>$Remote_Name_1,
                                           'Vehicles'=>$vehicles_ar,
                                           'Image'=>$images,
                                           'OEM_Part_Number'=>$OEM_Part_Number,
                                           'Buttons'=>$buttons_array2,
                                           'FCCID'=>$FCCID,
                                           'IC'=>$IC,
                                           'Frequency'=>$Frequency_Name,
                                           'Battery_Name'=>$Battery_Name,
                                           'Chip_Name'=>$Chip_Name,
                                           'Test_Key'=>$Key_Name,
                                           'Remote_Shell'=>$Remote_Name_2,
                                           'Reusable'=>$Reusable, 
                                           'Products' =>$mck_product_array
                                          );              
                 }
          			 //print_r($all_keys_array);
          			$data = json_encode($all_remotes_array);
          			//print_r($data);
          			$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';						
          			$cSession = curl_init(); 				
          			curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/app_remotes.json?". http_build_query($options));
          			//curl_setopt($cSession,CURLOPT_URL,"https://american-key.firebaseio.com/vehicle2.json");
          			curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
          			curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "PUT");						
          			curl_setopt($cSession, CURLOPT_POSTFIELDS,$data); 
          			curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);	
          			curl_setopt($cSession,CURLOPT_SSL_VERIFYPEER,false);
          			$result_output = curl_exec($cSession);
          			$curl_error = curl_error($cSession);
                $httpcode = curl_getinfo($cSession, CURLINFO_HTTP_CODE);						
                $curl_error = curl_error($cSession);
                $result_output = json_decode($result_output, True);
                if(isset($result_output['error']) && $result_output['error'] != ""){
                  echo '<div class="alert alert-danger">'.$result_output['error'].'</div>';
                }else if( $httpcode == 200){
                  echo '<div class="alert alert-success">Data added Successfully!</div>';
                }else if( $httpcode == 400){
                  echo '<div class="alert alert-danger">HTTP 400 Bad Request, please try again</div>';
                }else if( !empty($curl_error)){
                  echo '<div class="alert alert-danger">'.$curl_error.'</div>';
                }else{
                  echo '<div class="alert alert-danger">Something went wrong, please try again</div>';
                }					
          			curl_close($cSession);			
          		
          		/******************** Delete Firebase Node *****************************/
          			/*$data_tips = json_encode($vehicle_info_tpis);
          			$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';						
          			$cSession1 = curl_init(); 				
          			curl_setopt($cSession1,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/vehicle1.json?". http_build_query($options));
          			//curl_setopt($cSession1,CURLOPT_URL,"https://american-key.firebaseio.com/vehicle.json");
          			curl_setopt($cSession1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
          			curl_setopt($cSession1, CURLOPT_CUSTOMREQUEST, "DELETE");						
          			curl_setopt($cSession1, CURLOPT_POSTFIELDS,$data_tips); 
          			curl_setopt($cSession1,CURLOPT_RETURNTRANSFER,true);												
          			$result_output1 = curl_exec($cSession1);
          			echo curl_error($cSession1);						
          			curl_close($cSession1);*/
          		
          		?>			
           <!-- <div class="alert alert-danger">Data not found!</div>-->
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->