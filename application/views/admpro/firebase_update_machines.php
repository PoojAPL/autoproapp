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
            <?php $all_remotes_array=array();
                 $get_programmer_tools = get_success_rating_machine();
                  foreach($get_programmer_tools as $remote){
                      if($remote['Machine'] == 'AUTOPROPAD'){
                        $Machine = 'AutoProPAD';
                      }else if($remote['Machine'] == 'MVP_TCODE_SMART_PRO'){
                        $Machine = 'Smart Pro / MVP Pro / TCode Pro';
                      }else if($remote['Machine'] == 'HOTWIRE'){
                        $Machine = 'Hotwire';
                      }else if($remote['Machine'] == 'DMAX'){
                        $Machine = 'DMax';
                      }else{
                        $Machine = ucwords( str_replace('_', ' ',$remote['Machine']));
                      } 
                      if($remote['Machine'] !=""){
                        $all_remotes_array[]= array('name'=>$Machine);
                      }                                        
                  }
                $data = json_encode($all_remotes_array);
                //print_r($data);
                $options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';            
                $cSession = curl_init();        
                curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/app_machines.json?". http_build_query($options));
                //curl_setopt($cSession,CURLOPT_URL,"https://american-key.firebaseio.com/vehicle2.json");
                curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
                curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "PUT");           
                curl_setopt($cSession, CURLOPT_POSTFIELDS,$data); 
                curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true); 
                curl_setopt($cSession,CURLOPT_SSL_VERIFYPEER,false);
                $result_output = curl_exec($cSession);
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