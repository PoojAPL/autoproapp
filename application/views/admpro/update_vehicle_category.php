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
				$vahicle_arr = array();
				$vahicle_arr2 = array();
				//print_r($all_makes);
				foreach($all_makes as $makes){
					$get_models = get_model_makes($makes['UUID']);
					$model_array = array();
					foreach($get_models as $models){
						       $get_vehicles_year = get_vehicles_year($models['UUID']);
							   $year_range = array();
							   $year_array = array();
							   $years_ids = array();
							   $get_years_id = get_years_id($models['id']);
							   foreach($get_years_id as $years_id){
							   		 $years_ids[] = array('id' => $years_id['vehicles_id'],'year' => $years_id['vehicles_description']);
							   }
							   if($get_vehicles_year == 0){
							   		$year_range[] = array('from' => '', 'to' => '');
									$year_array[] = array('year' =>'', 'vehicleID' => '');
								}else{
									foreach($get_vehicles_year as $vahicle_year){
										$year_array[] =  array('year' => str_replace(',', '-', $vahicle_year['Years']) , 'vehicleID' => $vahicle_year['id'],'yearlist'=>$years_ids);
										$yearsRange = explode(',',$vahicle_year['Years']);
										$from_yr = $yearsRange[0];
										$to_yr = $yearsRange[1];
										$year_range[] = array('from' => $from_yr, 'to' => $to_yr);
									}
								}								
								$model_array[] = array('modelName' => $models['Model_Name'], 'modelID' => $models['id'],'yearRange' => $year_range,'years' => $year_array);
								//print_r($model_array);
								 //echo count($get_vehicles_year);
								//echo '-----------'.$models['Model_Name'].'<br><br>';
					 }
					 $Make_Name = str_replace('/','-',$makes['Make_Name']);
					 $Make_Name = str_replace('.','_',$makes['Make_Name']);
					 $vahicle_arr[$Make_Name] = array('make' => $makes['Make_Name'], 'makeID' => $makes['id'], 'model' => $model_array);
					 $vahicle_arr2[$Make_Name] = array('make' => $makes['Make_Name'], 'makeID' => $makes['id']);
					$make_name[] = $makes['Make_Name'];
				}
				$main_array= array('date' => date('dmYhms'), 'categoryList' => $vahicle_arr,'makeList' => $vahicle_arr2, 'makes' => $make_name);		
				$data = json_encode($main_array);
				//print_r($main_array);
				$options['auth'] = 'tDpktmFrLHJRZIBCoyPUU68ba4gbnQRUhqdn6y9H'; 
				$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';
				$cSession = curl_init(); 				
				curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/vehicle_category_list.json?". http_build_query($options));
				//curl_setopt($cSession,CURLOPT_URL,"https://american-key.firebaseio.com/vehicle-category-list-test.json?");
				curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
				curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "PUT");						
				curl_setopt($cSession, CURLOPT_POSTFIELDS,$data); 
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);												
				//step3
				$result_output = curl_exec($cSession);
				//step4
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
			?>
           <!-- <div class="alert alert-danger">Data not found!</div>-->
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->