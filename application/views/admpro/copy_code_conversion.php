<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form class="site-form " method ="post" action="<?php echo adm_base_url();?>/save_code_conversion">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
      <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Title</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">	
              <input type="text" class="form-control" name="Title" required="required" value="<?php echo $results[0]['Title'];?>" >
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Code Series</label>
            </div>
          </div>
          
          <div class="col-sm-10">          
            <div class="inputcol">
              <select class="form-control" name="Code_Series_UUID">
                <option value="">Select Code Series</option>
                <?php foreach($get_t_code_series as $code_s){
                  if( $code_s['UUID'] == $results[0]['Code_Series_UUID']){
                      $selected = 'selected';
                  }else{
                    $selected = '';
                  }?>
                  <option value="<?php echo $code_s['UUID'];?>" <?php echo $selected;?>><?php echo $code_s['Code_Series_Name'];?></option>
                <?php  } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Code Range Start / End</label>
            </div>
          </div>
          <div class="col-sm-5">
            <div class="inputcol">  
              <input type="text" class="form-control" name="Code_Range__Start" required="required" value="<?php echo $results[0]['Code_Range__Start'];?>" >
            </div>
          </div>
          <div class="col-sm-5">
            <div class="inputcol">  
              <input type="text" class="form-control" name="Code_Range__End" required="required" value="<?php echo $results[0]['Code_Range__End'];?>" >
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Lock Type</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">  
              <select class="form-control" name="Lock_Type">
                <option value="">Please select</option>
                <?php $lock_type = lock_type();
                foreach ($lock_type as $value) {
                if($value == $results[0]['Lock_Type']){
                  $selected = 'selected';
                }else{
                  $selected = '';
                } ?>
                   <option value="<?php echo $value;?>" <?php echo $selected;?> ><?php echo $value;?></option>
                <?php } ?>
              </select> 
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Notes</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">  
              <textarea class="form-control" name="Notes" ><?php echo $results[0]['Notes'];?></textarea> 
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
            <a href="<?php echo adm_base_url();?>/code_conversion" class="btn btn-danger">Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>