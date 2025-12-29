<?php error_reporting(0);?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">     
      <div class="col-sm-24">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/avatars" class="btn btn-danger" >Back<<</a>        
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
              $data = json_encode($results); 
              //print_r($data);                               
              $options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';            
              $cSession = curl_init();        
              curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/avatars.json?". http_build_query($options));
              //curl_setopt($cSession,CURLOPT_URL,"https://american-key.firebaseio.com/vehicle2.json");
              curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
              curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "PUT");           
              curl_setopt($cSession, CURLOPT_POSTFIELDS,$data); 
              curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true); 
              curl_setopt($cSession,CURLOPT_SSL_VERIFYPEER,false);
              $result_output = curl_exec($cSession);
              echo curl_error($cSession);           
              curl_close($cSession);
              $message =  '<div class="alert alert-success">Data added Successfully!</div>';
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