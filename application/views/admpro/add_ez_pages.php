<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form " method ="post" id="AddRemoteForm" action="<?php echo adm_base_url();?>/save_ez_pages">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add Model</h2>-->
    <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Sort Order</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="number" class="form-control" placeholder="Sort Order" name="Sort_Order">
            </div>
          </div>
    </div>   
    <?php $Locations = array('Locksmith References','Tool References','Articles & Tutorials','Pin Codes');?>
    <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Location</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <select type="text" class="form-control ez_pages_locations" name="Location">
                <option>Please select</option>
                <?php foreach($Locations as $locations){?>
                  <option><?php echo $locations;?></option>
                  <?php }?>
               </select>
            </div>
          </div>
    </div>
    <div class="row ManufacturerRow hide">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Manufacturer</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <select type="text" class="form-control" name="Manufacturer_UUID">
                <option value="">Please select</option>
                <?php foreach($getAllManufacturer as $manufacturer){?>
                  <option value="<?php echo $manufacturer['UUID'];?>"><?php echo $manufacturer['Manufacturer_Name'];?></option>
                  <?php }?>
               </select>
            </div>
          </div>
    </div>
    <?php $page_types = array('HTML', 'Link', 'Fragment','PDF','Video');?>
    <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Page Type</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <select type="text" class="form-control select_page_types" name="Page_Type">
                <option>Please select</option>
                <?php foreach($page_types as $page_type){?>
                  <option><?php echo $page_type;?></option>
                  <?php }?>
               </select>
            </div>
          </div>
    </div>
    <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Page Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Page Name" name="Page_Name">
            </div>
          </div>
    </div>   
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Page Content </label>
        </div>
      </div>
      <div class="col-sm-20">
        <div class="inputcol pageContentHolder">
           <textarea class="form-control" name="Content"></textarea>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
   		 <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label"></label>
        </div>
      </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/home_screen_menus" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
<script src="<?php echo asset_url(); ?>admin/js/ckeditor/ckeditor.js"></script>
<script>
            CKEDITOR.replace( 'Content',{
              height: '300px',
            } );
</script>
