
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
          <form method ="post" id="AddPurchaseForm" action="<?php echo base_url();?>home/save_feedback">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            <div class="form-group">
              <label >Date</label>
              <input type="text" class="form-control"  value="<?php echo date('m/d/Y');?>" id="prchaseDate" name="Date">
            </div>
            <div class="form-group">
              <label >Submitted By</label>
              <input type="text" class="form-control"  name="Submitted_By" value="<?php echo $submitted_By_cookie_value;?>">
            </div>
            <div class="form-group">
              <label >Cell Phone Number*</label>
              <input type="text" class="form-control" id="phone_number" name="Phone" value="<?php echo $Phone_cookie_value;?>">
            </div>
            <div class="form-group">
              <label >Vehicle(s)* (please list Make first, then Model, then Year(s)</label>
              <input type="text" class="form-control"  name="Vehicle">
            </div>
            <div class="form-group">
              <label >Description</label>
              <p>Please tell us what happened, especially if things didn't work or if you had to do something funny to make it work. What steps worked for you? Was it successful with a different machine? Do you have suggestions to make it better for this vehicle?</p>
              <textarea  class="form-control" name="Description" style="height: 200px;"></textarea>
            </div>
            <!--<div class="form-group">
              <label >Addressed &nbsp;</label>
              <input type="checkbox" data-toggle="toggle" name="Addressed">
            </div>-->
            <button type="submit" class="btn btn-success" name="post">Submit</button>
            <br>
            <br>
          </form>
        </figure>
      </div>
    </div>
  </div>
</section>
<!--flex-section end here--> 
<!--btn android section start here--> 
<!--btn android section ens here--> 
<!--footer section start here-->
<footer id="main-footer">
  <div class="container">
    <div class="table-data" style="font-family: 'chaletlondonnineteensixty';">
    <h5>All AutoProPAD Feedback</h5>
      <table class="table table-bordered  table-data mar0 tab-con">
        <thead>
          <tr>
            <th>Date </th>
            <th>Vehicle </th>
            <th>Description</th>            
            <th class="addressed ">Addressed </th>
            <th style="width:137px">Action</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach( $get_users_feedback as $feedback){?>
          <tr>
            <td><?php echo $feedback['Date'];?></td>
            <td><?php echo $feedback['Vehicle'];?></td>
            <td><?php echo $feedback['Description'];?></td>
            <td><?php echo $feedback['Addressed'];?></td>            
            <td><a href="<?php echo base_url();?>edit_feedback/<?php echo $feedback['id'];?>" type="button" class="btn btn-success">Edit</a> </td>
          </tr>
         <?php } ?>
        </tbody>
      </table>
    </div><br>
    
  </div>
</footer>
