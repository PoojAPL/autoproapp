<?php 
error_reporting(0);
?>
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
     <?php } 
	  /*$headers = "";
	  $order_message_data = 'Testing';
	  $admin_email	='Orders <orders@americankeysupply.com>';
	  $to = 'thakur.pooja14@gmail.com';
	  $subject = "New Order | American Key Supply";
	  $headers.= 'From: '.$admin_email.''."\r\n";
	  $headers .= "MIME-Version: 1.0\r\n";					
	  $headers .= "Content-type: text/html\r\n";
	  $sent = mail($to,$subject,$order_message_data,$headers);
	  if($sent){
		echo "E-mail Sent"; 
    }*/
    // $directory = "assets/vechileImages";
    // $jpg_images = glob($directory . "/*.*");
    // $response = array();
    // foreach($jpg_images as $image){
    //   $newfilename=str_replace('assets/vechileImages/','', $image);
    //   $v_data = explode('___',$newfilename);
    //   $vid =  $v_data[0];
    //   //$updateimg = updateimg($vid,$newfilename);
    //   $updateimg[] = array('id'=>$vid,'image_url'=>$newfilename);
    // }

    // $fp = fopen('vehicleImages.json', 'w');
    // fwrite($fp, json_encode($updateimg));
    // fclose($fp);
    // die();
    // $str = file_get_contents('vehicleImages.json');
    // $json = json_decode($str, true);
    // array_multisort( array_column($json, "id"), SORT_ASC, $json );
    // $n = 2000;//1000;//0;
    // for($i = 2620; $i < 3000; $i++){
    //   $vid = $json[$i]['id'];
    //   $newfilename = $json[$i]['image_url'];
    //   if($vid > 0){
    //     echo $vid;
    //     $updateimg = updateimg($vid,$newfilename); 
    //   }      
    //   echo '--'.$i.'<br>';
    // }
	 ?>
       
        <div class="site-form">
          <div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
            <a href="<?php echo adm_base_url();?>/update_vehicle" class="btn btn-success">Update Vehicle Category</a> &nbsp; &nbsp;
            <a href="<?php echo adm_base_url();?>/update_vehicle_info" class="btn btn-info">Update Vehicle Info</a> &nbsp; &nbsp;
            <a href="<?php echo adm_base_url();?>/update_code_series_info" class="btn btn-danger">Update Code Series</a>&nbsp; &nbsp;
            <a href="<?php echo adm_base_url();?>/update_NissanBCM5" class="btn btn-primary">Update NissanBCM5</a>
            &nbsp; &nbsp;<a href="<?php echo adm_base_url();?>/update_ez_pages_content" class="btn btn-success">Update EZ Pages Content</a>
          </div>
        </div><br>
         <div class="site-form">
          <div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
            <a href="<?php echo adm_base_url();?>/update_keys" class="btn btn-primary">Update Keys</a>
            &nbsp; &nbsp;<a href="<?php echo adm_base_url();?>/firebase_update_remotes" class="btn btn-danger">Update Remote</a>
            &nbsp; &nbsp;<a href="<?php echo adm_base_url();?>/update_vehicle_info" class="btn btn-info">Update Keymaking Method</a>
            &nbsp; &nbsp;<a href="<?php echo adm_base_url();?>/update_vehicle_info" class="btn btn-success">Update Tip & Tricks</a>
            &nbsp; &nbsp;<a href="<?php echo adm_base_url();?>/firebase_update_tools" class="btn btn-primary">Update 
            Tools</a>
            &nbsp; &nbsp;<a href="<?php echo adm_base_url();?>/firebase_update_machines" class="btn btn-danger">Update 
            Machines</a><!-- 
            &nbsp; &nbsp;<a href="<?php echo adm_base_url();?>/aks_products_excel" class="btn btn-danger">
            	AKS Products Excel -->
            </a>
          </div>
        </div>        
      </section>
    </div>
  </div>
</div>

<!-- right container start here -->
