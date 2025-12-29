<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; 
error_reporting(0);
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
    <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
    <?php } ?>
    <form method="post" enctype="multipart/form-data" id="editcashbackRequest" action="<?php echo adm_base_url();?>/autopropad/update_cashback_request" autocomplete="on">
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">First Name</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
            <input type="hidden" name="Requestid" value="<?php echo $id;?>">
            <input type="text" class="form-control" placeholder="First Name" name="first_name" value="<?php echo $getCashbackDetail[0]['first_name'];?>">
          </div>
        </div>
        </div>
        <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Last Name</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
            <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="<?php echo $getCashbackDetail[0]['last_name'];?>">
          </div>
        </div>
      </div>
     <div class="row">
         <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Company Name</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
        <input type="text" class="form-control"  placeholder="Company Name" name="company_name" value="<?php echo $getCashbackDetail[0]['company_name'];?>">
      </div>
      </div>
      </div>
       <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Line 1</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="text" class="form-control" placeholder="Line 1" name="address1" value="<?php echo $getCashbackDetail[0]['address1'];?>">
        </div>
        </div>
        </div>
         <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Line 2</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
       
          <input type="text" class="form-control" placeholder="Line 2" name="address2" value="<?php echo $getCashbackDetail[0]['address2'];?>">
          
          </div>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">City</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $getCashbackDetail[0]['city'];?>">
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">State</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <select class="form-control" name="state">
            <option value="">Select State</option>
            <?php						  
						  if($getCashbackDetail[0]['state'] !=""){
							  ?>
            <option value="<?php echo $getCashbackDetail[0]['state'];?>" selected>
            <?php echo $getCashbackDetail[0]['state'];?>
            </option>
            <?php   }?>
            <option value="Alabama">Alabama</option>
            <option value="Alaska">Alaska</option>
            <option value="Arizona">Arizona</option>
            <option value="Arkansas">Arkansas</option>
            <option value="California">California</option>
            <option value="Colorado">Colorado</option>
            <option value="Connecticut">Connecticut</option>
            <option value="Delaware">Delaware</option>
            <option value="District Of Columbia">District Of Columbia</option>
            <option value="Florida">Florida</option>
            <option value="Georgia">Georgia</option>
            <option value="Hawaii">Hawaii</option>
            <option value="Idaho">Idaho</option>
            <option value="Illinois">Illinois</option>
            <option value="Indiana">Indiana</option>
            <option value="Iowa">Iowa</option>
            <option value="Kansas">Kansas</option>
            <option value="Kentucky">Kentucky</option>
            <option value="Louisiana">Louisiana</option>
            <option value="Maine">Maine</option>
            <option value="Maryland">Maryland</option>
            <option value="Massachusetts">Massachusetts</option>
            <option value="Michigan">Michigan</option>
            <option value="Minnesota">Minnesota</option>
            <option value="Mississippi">Mississippi</option>
            <option value="Missouri">Missouri</option>
            <option value="Montana">Montana</option>
            <option value="Nebraska">Nebraska</option>
            <option value="Nevada">Nevada</option>
            <option value="New Hampshire">New Hampshire</option>
            <option value="New Jersey">New Jersey</option>
            <option value="New Mexico">New Mexico</option>
            <option value="New York">New York</option>
            <option value="North Carolina">North Carolina</option>
            <option value="North Dakota">North Dakota</option>
            <option value="Ohio">Ohio</option>
            <option value="Oklahoma">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="Pennsylvania">Pennsylvania</option>
            <option value="Rhode Island">Rhode Island</option>
            <option value="South Carolina">South Carolina</option>
            <option value="South Dakota">South Dakota</option>
            <option value="Tennessee">Tennessee</option>
            <option value="Texas">Texas</option>
            <option value="Utah">Utah</option>
            <option value="Vermont">Vermont</option>
            <option value="Virginia">Virginia</option>
            <option value="Washington">Washington</option>
            <option value="West Virginia">West Virginia</option>
            <option value="Wisconsin">Wisconsin</option>
            <option value="Wisconsin">Wyoming</option>
          </select>
          </div>
          </div>
        </div>
        <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Zip Code</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="number" class="form-control" placeholder="Zip Code" name="zip_code" value="<?php echo $getCashbackDetail[0]['zip_code'];?>">
          </div>
          </div>
        </div>
         <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Phone</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="number" class="form-control" placeholder="Phone Number" name="phone" value="<?php echo $getCashbackDetail[0]['phone'];?>">
        </div>
        </div>
      </div>
       <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Email</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="text" class="form-control" placeholder="Email Address" name="email" value="<?php echo $getCashbackDetail[0]['email'];?>">
        </div>
        </div>
        </div>
		<span> <h5><strong >Qualifying Machine Number 1</strong></h5></span>
        <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Type</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol"><span class="form-check first-checkbox">
        
	
			<?php
					$checktype = $getCashbackDetail[0]['checktype'];	
					if($checktype == "AutoProPAD"){						
						$AutoProPAD = "checked";
					}elseif($checktype == "AutoProPAD LITE"){
						$AutoProPAD_lite = "checked";
					}else{
						$AutoProPAD="";
						$AutoProPAD_lite ="";
					}

				?>
          <input class="form-check-input" type="radio" id="gridCheck1" name="checktype" value="AutoProPAD" <?php echo $AutoProPAD;?> >
          <label class="form-check-label" for="gridCheck1"> AutoProPAD </label>
          </span> <span class="form-check">
          <input class="form-check-input" type="radio" id="gridCheck2" name="checktype" value="AutoProPAD LITE" <?php echo $AutoProPAD_lite;?>>
          <label class="form-check-label" for="gridCheck2"> AutoProPAD LITE </label>
          </span> </div>
          </div>
          </div>
        <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Serial Number</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="text" class="form-control" placeholder="Serial Number" name="serial_number" value="<?php echo $getCashbackDetail[0]['serial_number'];?>">
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Distributor Purchased From</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="text" class="form-control" placeholder="Distributor Purchased From" name="distributor_purchased" value="<?php echo $getCashbackDetail[0]['distributor_purchased'];?>">
        </div>
        </div>
        </div>
         <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Purchase Date</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="text" class="form-control " placeholder="Purchase Date" name="purchase_date" id="datepicker" value="<?php echo $getCashbackDetail[0]['purchase_date'];?>" >
        </div>
        </div>
        </div>
		<h5><strong >Qualifying Machine Number 2</strong></h5>
       <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Type</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol"><span class="form-check first-checkbox">
        
	
			<?php
					$checktype2 = $getCashbackDetail[0]['checktype2'];	
					if($checktype2 == "AutoProPAD"){						
						$AutoProPAD = "checked";
					}elseif($checktype2 == "AutoProPAD LITE"){
						$AutoProPAD_lite = "checked";
					}else{
						$AutoProPAD="";
						$AutoProPAD_lite ="";
					}

				?>
          <input class="form-check-input" type="radio" id="gridCheck1" name="checktype" value="AutoProPAD" <?php echo $AutoProPAD;?> >
          <label class="form-check-label" for="gridCheck1"> AutoProPAD </label>
          </span> <span class="form-check">
          <input class="form-check-input" type="radio" id="gridCheck2" name="checktype" value="AutoProPAD LITE" <?php echo $AutoProPAD_lite;?>>
          <label class="form-check-label" for="gridCheck2"> AutoProPAD LITE </label>
          </span> </div>
          </div>
          </div>
        <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Serial Number</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="text" class="form-control" placeholder="Serial Number" name="serial_number" value="<?php echo $getCashbackDetail[0]['serial_number2'];?>">
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Distributor Purchased From</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="text" class="form-control" placeholder="Distributor Purchased From" name="distributor_purchased" value="<?php echo $getCashbackDetail[0]['distributor_purchased2'];?>">
        </div>
        </div>
        </div>
         <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Purchase Date</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
          <input type="text" class="form-control " placeholder="Purchase Date" name="purchase_date" id="datepicker" value="<?php echo $getCashbackDetail[0]['purchase_date2'];?>" >
        </div>
        </div>
        </div>
              <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Payment Entity</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
     			 <?php
	
				$payment_entity = $getCashbackDetail[0]['payment_entity'];		
				if($payment_entity == "Cash back check should be made out to the person’s name as written above"){								
					$checked = "checked";
				}elseif($payment_entity == "Cash back check should be made out to the company name as written above"){								
					$checked2 = "checked";
				}else{
					$checked="";
					$checked2="";
					}

				?>
			
          <div class="form-check">
            <input class="form-check-input" type="radio" id="gridCheck3" name="payment_entity" value="Cash back check should be made out to the person’s name as written above" <?php echo $checked;?>>
            <label class="form-check-label" for="gridCheck3">Cash back check should be made out to the person’s name as written above. </label>
          </div>
       
          <div class="form-check">
            <input class="form-check-input" type="radio" id="gridCheck3" name="payment_entity" value="Cash back check should be made out to the company name as written above" <?php echo $checked2;?>>
            <label class="form-check-label" for="gridCheck3">Cash back check should be made out to the company name as written above </label>
       
        </div>
      </div>
      </div>
      </div>
      
      <div class="col-md-12">
        <button type="submit" class="btn btn-success submit-btn" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/autopropad/cash_back_request_detail" class="btn btn-danger">Cancel</a>
         </div><br><br>
         
    </form>
    
  </div>
</div>
</div>
