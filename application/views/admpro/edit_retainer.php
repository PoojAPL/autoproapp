<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form class="site-form " method ="post" id="AddRetainerForm" action="<?php echo adm_base_url();?>/update_retainer">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <!--<h2 class="titleheadng">Add Model</h2>-->
        <input type="hidden" name="ratainerId" value="<?php echo $ratainerId;?>" />
         <div class="row">
          <div class=" col-sm-4">
            <div class="labelcol">
              <label class="control-label">Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="text" class="form-control" placeholder="Name" name="Retainer_Name" value="<?php echo $getRetainersInfo[0]['Retainer_Name'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4">
            <div class="labelcol">
              <label class="control-label">Image Filename</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="text" class="form-control" placeholder="" name="Retainer_Image_Url" value="<?php echo $getRetainersInfo[0]['Retainer_Image_Url'];?>">
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class=" col-sm-4">
            <div class="labelcol">
              <label class="control-label"></label>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-success" name="post">Submit</button>
            <a href="<?php echo adm_base_url();?>/retainers" class="btn btn-danger">Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>
