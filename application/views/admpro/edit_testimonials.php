<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form class="site-form " method ="post" action="<?php echo adm_base_url();?>/autopropad/update_testimonials">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Author Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="text" required="required" class="form-control" name="authorName" value="<?php echo $testimonials_info[0]['authorName'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Business Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="text" class="form-control" name="businessName" value="<?php echo $testimonials_info[0]['businessName'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Location</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="text" class="form-control" name="location" value="<?php echo $testimonials_info[0]['location'];?>">
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
             <input type="number" class="form-control" name="sortOrder" value="<?php echo $testimonials_info[0]['sortOrder'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Testimonial</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <textarea name="testimonial"> <?php echo $testimonials_info[0]['testimonial'];?></textarea>
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
            <a href="<?php echo adm_base_url();?>/autopropad/testimonials" class="btn btn-danger">Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>
