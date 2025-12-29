<?php //error_reporting(0);?>
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
			$year_array = array();
			$main_array = array();
			//$vahicle_arr = array();			
			$vehicle_info_array2 = array();
			$vehicle_info_array3 = array();	
			$all_vehciles = get_Firebase_vehicles_year2();
				foreach($all_vehciles as $vehciles){						
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
								}						  
								$get_frequency_info = get_frequency_info($get_remote_name['Frequency']);
								$remote_array[] = array($Remote_Type_Name=> 
								  array('image' => $Remote_Image_Url,'name' => $Remote_Name,'products' =>$remote_product_array,
								  'IC' => $IC,'battery' => $Battery_Name,'fcc_id' => $FCCID,'frequency' => $Frequency)
								);
							  
							  } 
						}else{
						  $remote_array = array('Remote'=> 
							  array('IC' =>'','battery' =>'','fcc_id' =>'','frequency' =>''),
							  'image' =>'',
							  'name' => '',
							  'products' => array('products_id' =>'', 'least_price' =>'','imagePath' =>'')
							);
						}
						$vehicle_info_array = array(
									  'the_remotes' => $remote_array
									  );							  
						
					}
			
			print_r($vehicle_info_array);	
			$data = json_encode($vehicle_info_array);
				$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';						
				$cSession = curl_init(); 				
				//curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/vehicle1.json?". http_build_query($options));
				curl_setopt($cSession,CURLOPT_URL,"https://american-key.firebaseio.com/vehicle2.json");
				curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
				curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "PUT");						
				curl_setopt($cSession, CURLOPT_POSTFIELDS,$data); 
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);	
				curl_setopt($cSession,CURLOPT_SSL_VERIFYPEER,false);
				$result_output = curl_exec($cSession);
				echo curl_error($cSession);						
				curl_close($cSession);					
				echo $message;	
			?>
           <!-- <div class="alert alert-danger">Data not found!</div>-->
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->