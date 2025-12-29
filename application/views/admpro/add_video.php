<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form class="site-form" method ="post" action="<?php echo adm_base_url();?>/autopropad/save_videos">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Category</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <select required="required" class="form-control obdcategory" name="category">
               <?php foreach (video_category() as $value) {?>
                 <option><?php echo $value;?></option>
               <?php }?>
             </select>
            </div>
          </div>
        </div>
        <div class="row Obdmake hide">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Make</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <select  class="form-control" name="make">
                <option value="">Please select</option>
               <?php foreach (video_make() as $value) {?>
                 <option><?php echo $value;?></option>
               <?php }?>
             </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Title</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="text" required="required" class="form-control" name="title">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Youtube ID</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="text" required="required" class="form-control" name="youtubeid">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Sort Order</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="number" class="form-control" name="sortOrder">
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
            <a href="<?php echo adm_base_url();?>/autopropad/videos" class="btn btn-danger">Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>
