<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <div id="status"></div>
      <div id="fireResult"></div>
      <form class="site-form" id="autoproapp_version_form" method="post" action="<?php echo adm_base_url();?>/save_autoproapp_version">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <!-- <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">App version</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="radio" name="app_version" value="ios" checked="checked" /> iOS
              <input type="radio"  name="app_version" value="android" /> Android 
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Version Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="text" class="form-control" required="required" name="versionName" value="<?php echo $results[0]['versionName'];?>" />
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Upload Version</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="file" class="form-control" required="required" name="Download_Path" />
            </div>
            <div class="progress">
                <div class="bar"></div >
                <div class="percent">0%</div >
            </div>            
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Version Code</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="number" class="form-control" required="required" name="version_code" value="<?php echo $results[0]['version_code'];?>" />
            </div>
          </div>
        </div>
         <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Message</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <textarea class="form-control" name="version_message"></textarea>
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
            <input type="submit" id="addVersionButton" value="Submit" class="btn btn-success">
            <a href="<?php echo adm_base_url();?>/autopro_app_updates" class="btn btn-danger" >Cancel</a>
          </div>
         
        </div>        
      </form>
    </div>
  </div>
</div>