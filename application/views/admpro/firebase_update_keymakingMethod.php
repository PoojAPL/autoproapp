<?php error_reporting(-1);?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">    	
    	<div class="col-sm-24">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/keymaking_methods" class="btn btn-danger" >Back<<</a>        
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
                                $get_make_name = get_make_name($vehciles['Model_UUID']);
                                $Make_Name = $get_make_name[0]['Make_Name'];
                                $get_models_name = get_models_name($vehciles['Model_UUID']);
                                $Model_Name = $get_models_name[0]['Model_Name'];
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
                                                'methodDescription' => $methods['Content'],
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

                                $data = json_encode($key_making_method_array);
                                //print_r($data);
                                $options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';            
                                $cSession = curl_init();        
                                curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/vehicle1/".$vehciles['id']."/key_making_methods.json?". http_build_query($options));
                                //curl_setopt($cSession,CURLOPT_URL,"https://american-key.firebaseio.com/vehicle2.json");
                                curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
                                curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "PATCH");           
                                curl_setopt($cSession, CURLOPT_POSTFIELDS,$data); 
                                curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true); 
                                curl_setopt($cSession,CURLOPT_SSL_VERIFYPEER,false);
                                $result_output = curl_exec($cSession);
                                echo curl_error($cSession);           
                                curl_close($cSession);
                                $message =  '<div class="alert alert-success">Data added Successfully!</div>';

                              }
                              
                            }
                        
                      } 
                               
                   }
      
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
<script type="text/javascript">
  document.getElementById("right-container").onload = function() {move()};
  function move() {
    alert('')
  var elem = document.getElementById("myBar");   
  var width = 1;
  var id = setInterval(frame, 50);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
    }
  }
}
</script>
