<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form " method ="post" id="AddPurchaseForm" action="<?php echo adm_base_url();?>/update_user_feedback">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <input type="hidden" name="id" value="<?php echo $id;?>" />
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">User</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" value="<?php echo $all_feedbacks[0]['User_Email'];?>" name="User_Email">
            </div>
          </div>
        </div>        
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Type</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" value="<?php echo $all_feedbacks[0]['Feedback_type'];?>" name="Feedback_type">
            </div>
          </div>
        </div> 
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Title</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" value="<?php echo $all_feedbacks[0]['title'];?>" name="title">
            </div>
          </div>
        </div> 
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Vehicle</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" value="<?php echo $all_feedbacks[0]['vehicle'];?>" name="vehicle">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Other Vehicle</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" value="<?php echo $all_feedbacks[0]['other_vehicle'];?>" name="other_vehicle">
            </div>
          </div>
        </div> 
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Image</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" value="<?php echo $all_feedbacks[0]['Images'];?>" name="Images">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Status</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <select class="form-control" name="status">
                 <?php   
                 $correction_status = array('pending' => 'Waiting for Review','reviewed' => 'Reviewed');             
                  foreach($correction_status as $skey => $status){
                    if( $all_feedbacks[0]['status'] == $skey){
                      $selected = 'selected';
                      $disabled = 'disabled';
                    }else{
                      $selected = '';
                    }?>
                    <option <?php echo $selected;?> value="<?php echo $skey;?>"><?php echo $status;?></option>
                  <?php  } ?>
                </select>
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
    <div class="col-md-20">
        <button type="submit" class="btn btn-success" name="post">Save</button>
        <a href="<?php echo adm_base_url();?>/user_submissions" class="btn btn-danger">Cancel</a>
        <?php if($all_feedbacks[0]['Feedback_type'] == 'key_making'){?>
        <a href="<?php echo adm_base_url();?>/add_method/<?php echo $all_feedbacks[0]['id'];?>" class="btn btn-info">Create New Keymaking Method</a>
        <?php } ?>
        <?php if($all_feedbacks[0]['Feedback_type'] == 'vehicle_tips_tricks'){?>
        <a href="<?php echo adm_base_url();?>/vehicles/add_tip_tricks/<?php echo $all_feedbacks[0]['id'];?>" class="btn btn-info">Create New Tip & Trick</a>
        <?php } ?>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
