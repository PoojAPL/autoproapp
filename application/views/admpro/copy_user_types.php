<?php error_reporting(0); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
       <form class="site-form" id="add_user_type" method ="post" action="<?php echo adm_base_url();?>/save_user_types"> 
       <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">User Type Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">  
              <input type="text" class="form-control" name="type" id="users_types" required="required" value="<?php echo $type_info[0]['type'];?>" >
              <div class="availabilty"></div>
            </div>
          </div>
        </div>
        <fieldset>
        <legend>Users </legend>
          <?php $other_total = count(explode(',', $type_info[0]['user']));
          $other_access_total = count(user_access());
          if($other_total == $other_access_total){
            $checkedAllItems = 'checked';
          }else{
            $checkedAllItems = ''; 
          }?>
          <div class="row">
              <div class="col-sm-12">
                  <div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems" <?php echo $checkedAllItems;?>>&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <?php $user_access = user_access();
            foreach ($user_access as $key => $value) {
              if( in_array($value,  explode(',', $type_info[0]['user']) ) ){
                $checked = 'checked';
              }else{
                $checked = '';
              }?>
               <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="<?php echo $value;?>" name="user[]" <?php echo $checked;?>>
                  <?php echo $key;?>
                </div>
              </div>              
            </div>
            <?php } ?>       
        </fieldset> 
        <fieldset>
        <legend>Content</legend>
          <?php $other_total = count(explode(',', $type_info[0]['content']));
          $other_access_total = count(content_access());
          if($other_total == $other_access_total){
            $checkedAllItems = 'checked';
          }else{
            $checkedAllItems = ''; 
          }?>
          <div class="row">
              <div class="col-sm-12">
                  <div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems" <?php echo $checkedAllItems;?>>&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <?php $content_access = content_access();
            foreach ($content_access as $key => $value) {
              if( in_array($value,  explode(',', $type_info[0]['content']) ) ){
                $checked = 'checked';
              }else{
                $checked = '';
              }?>
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="<?php echo $value;?>" name="content[]" <?php echo $checked;?>>
                  <?php echo $key;?>
                </div>
              </div>              
            </div> 
            <?php } ?>      
        </fieldset>    
        <fieldset>
        <legend>Key Codes</legend>
          <?php $other_total = count(explode(',', $type_info[0]['key_codes']));
          $other_access_total = count(keyCodes_access());
          if($other_total == $other_access_total){
            $checkedAllItems = 'checked';
          }else{
            $checkedAllItems = ''; 
          }?>
          <div class="row">
              <div class="col-sm-12">
                  <div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems" <?php echo $checkedAllItems;?> >&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <?php $keyCodes_access = keyCodes_access();
            foreach ($keyCodes_access as $key => $value) {
              if( in_array($value,  explode(',', $type_info[0]['key_codes']) ) ){
                $checked = 'checked';
              }else{
                $checked = '';
              }?>
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="<?php echo $value;?>" name="keyCodes[]" <?php echo $checked;?>>
                  <?php echo $key;?>
                </div>
              </div>              
            </div>
            <?php } ?>      
        </fieldset> 
        <fieldset>
        <legend>Admin </legend>
          <?php $other_total = count(explode(',', $type_info[0]['admin']));
          $other_access_total = count(admin_access());
          if($other_total == $other_access_total){
            $checkedAllItems = 'checked';
          }else{
            $checkedAllItems = ''; 
          }?>
          <div class="row">
              <div class="col-sm-12">
                  <div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems" <?php echo $checkedAllItems;?>>&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <?php $admin_access = admin_access();
            foreach ($admin_access as $key => $value) {
              if( in_array($value,  explode(',', $type_info[0]['admin']) ) ){
                $checked = 'checked';
              }else{
                $checked = '';
              }?>
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="<?php echo $value;?>" name="admin[]" <?php echo $checked;?>>
                  <?php echo $key;?>
                </div>
              </div>              
            </div>
            <?php } ?>      
        </fieldset>  
        <fieldset>
        <legend>Other</legend>
          <?php $other_total = count(explode(',', $type_info[0]['other']));
          $other_access_total = count(other_access());
          if($other_total == $other_access_total){
            $checkedAllItems = 'checked';
          }else{
            $checkedAllItems = ''; 
          }?>
          <div class="row">
              <div class="col-sm-12">
                  <div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems" <?php echo $checkedAllItems;?>>&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <?php $other_access = other_access();
            foreach ($other_access as $key => $value) {
              if( in_array($value,  explode(',', $type_info[0]['other']) ) ){
                $checked = 'checked';
              }else{
                $checked = '';
              }?>
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="<?php echo $value;?>" name="other[]" <?php echo $checked;?>>
                 <?php echo $key;?>
                </div>
              </div>              
            </div> 
            <?php } ?>       
        </fieldset>              
        <hr>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label"></label>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-success" value="post">Submit</button>
            <a href="<?php echo adm_base_url();?>/users_types" class="btn btn-danger">Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  myFunction();
  function myFunction() {
    document.getElementById("users_types").focus();
}
</script>