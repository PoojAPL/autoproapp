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
    	<div class="alert alert-info"> <?php echo $this->session->flashdata('message_display');?></div>
       <?php }  ?>       
        <div class="site-form">
          <div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
            <a href="<?php echo adm_base_url();?>/firebase_feedback" class="btn btn-success">Get Users Feedback</a> &nbsp; &nbsp;
            <a href="<?php echo adm_base_url();?>/firebase_contribution" class="btn btn-info">Get Users Contributions</a> &nbsp; &nbsp;
            <a href="<?php echo adm_base_url();?>/firebase_success_rate" class="btn btn-danger">Get Success Rates</a>&nbsp; &nbsp;
          </div>
        </div>       
      </section>
    </div>
  </div>
</div>

<!-- right container start here -->
