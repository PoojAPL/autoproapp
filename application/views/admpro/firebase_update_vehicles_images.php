<?php error_reporting(0);?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">     
      <div class="col-sm-24">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/vehicles/vehicle_images" class="btn btn-danger" >Back<<</a>        
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
                      $get_key_making_method = get_vehicles_images($vehciles_id);
                       $i=1;
                      if($get_key_making_method){
                            foreach ($get_key_making_method as $methods) {
                               $search = $vehciles_id;
                              if(preg_match("/\b$search\b/",$methods['vehicles'])){
                                //echo $vehciles_id .'---'.$methods['vehicles'].'<br>';
                                $images_data_array = array();
                                $images_data = explode(',',$methods['Image_path']);
                                for($im = 0; $im < count($images_data); $im++){
                                  $images_data_array[$i] = array(
                                              'image' =>  $images_data[$im]
                                              );
                                }
                                $key_making_method_array = $images_data_array;
                                //print_r($key_making_method_array);
                                //echo '<br><br>';
                                $data = json_encode($key_making_method_array);
                                
                                $options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';            
                                $cSession = curl_init();        
                                curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/vehicle1/".$vehciles['id']."/vehicle_image.json?". http_build_query($options));
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
$i++;
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