
<!--flex-section start here-->
<section class="flex-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-14">
        <figure class="feedback-flex-item">
          <?php if($this->session->flashdata('message_display')){?>
          <br>
          <div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?> <a href="<?php echo base_url();?>feedback">Submit Another</a> </div>
          <?php }
		 	  if(isset($_COOKIE['Submitted_By_cookie'])){ 
				 $submitted_By_cookie_value = $_COOKIE['Submitted_By_cookie'];
			  }else{
				$submitted_By_cookie_value = ""; 
			  }
			  if(isset($_COOKIE['Phone_By_cookie'])){ 
				 $Phone_cookie_value = $_COOKIE['Phone_By_cookie'];
			  }else{
				$Phone_cookie_value = ""; 
			  }
		  	  
		  ?>
          <h3>AutoProPAD Customer Feedback</h3>
          <form method ="post" id="AddPurchaseForm" action="<?php echo base_url();?>home/update_feedback">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="id" value="<?php echo $id;?>" />
            <div class="form-group">
              <label >Date</label>
              <input type="text" class="form-control"  value="<?php echo date('m/d/Y');?>" id="prchaseDate" name="Date">
            </div>
            <div class="form-group">
              <label >Submitted By</label>
              <input type="text" class="form-control"  name="Submitted_By" value="<?php echo $users_feedback_info[0]['Submitted_By'];?>">
            </div>
            <div class="form-group">
              <label >Cell Phone Number*</label>
              <input type="text" class="form-control" id="phone_number" name="Phone" value="<?php echo $users_feedback_info[0]['Phone'];?>">
            </div>
            <div class="form-group">
              <label >Vehicle(s)* (please list Make first, then Model, then Year(s)</label>
              <input type="text" class="form-control"  name="Vehicle" value="<?php echo $users_feedback_info[0]['Vehicle'];?>">
            </div>
            <div class="form-group">
              <label >Description</label>
              <p>Please tell us what happened, especially if things didn't work or if you had to do something funny to make it work. What steps worked for you? Was it successful with a different machine? Do you have suggestions to make it better for this vehicle?</p>
              <textarea  class="form-control" name="Description" style="height: 200px;"><?php echo $users_feedback_info[0]['Description'];?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="post">Update</button>
            <br>
            <br>
          </form>
        </figure>
      </div>
    </div>
  </div>
</section>