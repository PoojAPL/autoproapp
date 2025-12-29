<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form " method ="post" id="AddPurchaseForm" action="<?php echo adm_base_url();?>/update_feedback">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <input type="hidden" name="id" value="<?php echo $id;?>" />
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Date</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Date" value="<?php echo $feedback_info[0]['Date'];?>" id="prchaseDate" name="Date">
            </div>
          </div>
        </div>        
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Cell Phone Number</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
                <input type="text" class="form-control" id="phone_number" name="Phone" value="<?php echo $feedback_info[0]['Phone'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Did it work?</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="radio" class="custom-radio"  name="Worked" value="Yes" checked="checked"> Yes
              <input type="radio" class="custom-radio"  name="Worked" value="No"> No
              <input type="radio" class="custom-radio"  name="Worked" value="Partial"> Partially   
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Vehicle(s)</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" id="vehicle"  name="Vehicle" value="<?php echo $feedback_info[0]['Vehicle'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Did it work?</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
				 <?php 
                if($feedback_info[0]['Worked'] == 'Yes' ){
                    $yes = 'checked';
                    $no = "";
                    $partial = "";
                }else if($feedback_info[0]['Worked'] == 'No' ){
                    $yes = '';
                    $no = "checked";
                    $partial = "";
                }else if($feedback_info[0]['Worked'] == 'Partial' ){
                    $yes = '';
                    $no = "";
                    $partial = "checked";
                }else{
                    $yes = 'checked';
                    $no = "";
                    $partial = "";
                }
                ?>            
                  <label >Did it work?</label><br />
                  <input type="radio" class="custom-radio"  name="Worked" value="Yes" <?php echo $yes;?> > Yes
                  <input type="radio" class="custom-radio"  name="Worked" value="No" <?php echo $no;?> > No
                  <input type="radio" class="custom-radio"  name="Worked" value="Partial" <?php echo $partial;?> > Partially     
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Description</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <textarea placeholder="Description" name="Description"><?php echo $feedback_info[0]['Description'];?></textarea>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Addressed</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
            	<?php if($feedback_info[0]['Addressed'] == 'No'){
					$no_check = 'checked';
					$yes_check = '';
				}else{
					$no_check = '';
					$yes_check = 'checked';		
				}?>               
                <input type="checkbox" data-toggle="toggle" name="Addressed" <?php echo $yes_check;?>>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Confirmed Working</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="text" class="form-control"  name="Confirmed_Working" value="<?php echo $feedback_info[0]['Confirmed_Working'];?>">
            </div>
          </div>
        </div>
      <hr>
    <div class="row">
   		 <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label"></label>
        </div>
      </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/feedback" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
