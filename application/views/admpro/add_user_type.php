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
              <label class="control-label">User Type value</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">	
              <input type="text" class="form-control" name="type" id="users_types" required="required" >
              <div class="availabilty"></div>
            </div>
          </div>
        </div>
        <fieldset>
        <legend>Users </legend>
         	<div class="row">
            	<div class="col-sm-12">
                	<div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems">&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="userInfo" name="user[]">
                  View User Info
                </div>
              </div>              
            </div>  
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="editUsers" name="user[]">
                  Edit User Info
                </div>
              </div>              
            </div>        
        </fieldset> 
        <fieldset>
        <legend>Content</legend>
         	<div class="row">
            	<div class="col-sm-12">
                	<div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems">&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="moderateUserFeedback" name="content[]">
                  Moderate User Feedback
                </div>
              </div>              
            </div>  
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle"  data-on="Enabled" data-off="Disabled" value="moderateUserContribution" name="content[]">
                  Moderate User Contributions
                </div>
              </div>              
            </div>  
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="vehicleData" name="content[]">
                  Manage Vehicle Data
                </div>
              </div>              
            </div>      
        </fieldset>    
        <fieldset>
        <legend>Key Codes</legend>
         	<div class="row">
            	<div class="col-sm-12">
                	<div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems">&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="keyCodes" name="keyCodes[]">
                  Manage Key Codes 
                </div>
              </div>              
            </div>      
        </fieldset> 
        <fieldset>
        <legend>Admin </legend>
         	<div class="row">
            	<div class="col-sm-12">
                	<div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems">&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="homeScreenMenu" name="admin[]">
                  Manage Home Screen Menus  
                </div>
              </div>              
            </div>  
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="firebaseUpdates" name="admin[]">
                  Manage Firebase Updates
                </div>
              </div>              
            </div>  
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="adminAccess" name="admin[]">
                  Manage Admin Access
                </div>
              </div>              
            </div>      
        </fieldset>  
        <fieldset>
        <legend>Other</legend>
         	<div class="row">
            	<div class="col-sm-12">
                	<div class="labelcol">
                    <input type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Enabled" data-off="Disabled" class="enableAllItems">&nbsp;Enable All Items
                   </div> 
                </div>
            </div>
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="machineReports" name="other[]">
                 Manage Machine Reports  
                </div>
              </div>              
            </div>  
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="autoProPAD" name="other[]">
                  Manage AutoProPAD
                </div>
              </div>              
            </div>  
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="viewMachinePurchase" name="other[]">
                  View Machine Purchases
                </div>
              </div>              
            </div> 
            <div class="row">
              <div class=" col-sm-12">
                <div class="labelcol">
                  <input type="checkbox" class="inputToggel" data-toggle="toggle" data-on="Enabled" data-off="Disabled" value="manageMachinePurchase" name="other[]">
                  Manage Machine Purchases
                </div>
              </div>              
            </div>      
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