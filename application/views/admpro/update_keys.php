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
			$all_keys_array = array();
			
				foreach($all_keys as $keys){
					$keys_product = $keys['Products'];
					$keys_product_array = array();
				    if($keys_product != ""){
					 $blitz_cutter_Aks_vehicles_products = get_Aks_vehicles_products_least_price($keys_product);	
					 $keys_product_array = array('products_id' => $keys_product, 'least_price' =>  $blitz_cutter_Aks_vehicles_products[0]['MIN(products_price)'],'imagePath' => $blitz_cutter_Aks_vehicles_products[0]['products_image']);
				    }else{
				  	$keys_product_array = array('products_id' =>'', 'least_price' =>'','imagePath' =>'');										  
				    }
				    $substitutes = '';
				    //echo $keys['Substitute_UUID'].'----------';
				    if($keys['Substitute_UUID'] == ""){
				    	$substitutes = '';
				    }else{
					    $substitute_UUID = explode(',', $keys['Substitute_UUID']);
					    for($sb = 0; $sb < count($substitute_UUID); $sb++){				    	
					    	$get_key_name  = get_key_name($substitute_UUID[$sb]);
					    	$substitutes .= $get_key_name[0]['Key_Name'].',';
					    }
					}
					$substitutes2 = rtrim($substitutes,",");
				   // print_r($substitutes);
				    //echo $substitutes. '<br>';
					$Key_Type_UUID = get_key_type($keys['Key_Type_UUID']);
					$all_keys_array[$keys['id']] = array(
						'Name'=>($keys['Key_Name'] != '' )?$keys['Key_Name']:"-",
						'key_type'=>$Key_Type_UUID[0]['Key_Type_Name'],
						'products'=>$keys_product_array,
						'Images'=>($keys['Key_Image'] != '' )?$keys['Key_Image']:"-",
						'Ilco'=>($keys['Alt_Ilco'] != '' )?$keys['Alt_Ilco']:"-",
						'Axxess'=>($keys['Alt_Axxess'] != '' )?$keys['Alt_Axxess']:"-",
						'Curtis'=>($keys['Alt_Curtis'] != '' )?$keys['Alt_Curtis']:"-",
						'ESP'=>($keys['Alt_ESP'] != '' )?$keys['Alt_ESPAlt_ESP']:"-",
						'Hillman'=>($keys['Alt_Hillman'] != '' )?$keys['Alt_Hillman']:"-",
						'Jet'=>($keys['Alt_Jet'] != '' )?$keys['Alt_Jet']:"-",
						'JMA'=>($keys['Alt_JMA'] != '' )?$keys['Alt_JMA']:"-",
						'Silca'=>($keys['Alt_Silca'] != '' )?$keys['Alt_Silca']:"-",
						'Strattec'=>($keys['Alt_Strattec'] != '' )?$keys['Alt_Strattec']:"-",
						'Taylor'=>($keys['Alt_Taylor'] != '' )?$keys['Alt_Taylor']:"-",
						'OEM'=>($keys['Alt_OEM'] != '' )?$keys['Alt_OEM']:"-",
						'Other'=>($keys['Alt_Other'] != '' )?$keys['Alt_Other']:"-",
						'substitutes' =>trim($substitutes2)
					);
				}
				//print_r($all_keys_array);
				$data = json_encode($all_keys_array);
				//print_r($data);
				$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';						
				$cSession = curl_init(); 				
				curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/app_keys.json?". http_build_query($options));
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