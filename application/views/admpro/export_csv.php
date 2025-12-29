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
	 ?>
       
        <div class="site-form">
          <div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
            <a href="<?php echo adm_base_url();?>/explort_vehicles_info" class="btn btn-success">Export Vehicles</a> &nbsp; &nbsp;
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- right container start here -->
