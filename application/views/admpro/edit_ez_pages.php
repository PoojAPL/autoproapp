<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form " method ="post" id="AddRemoteForm" action="<?php echo adm_base_url();?>/update_ez_pages">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add Model</h2>-->
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Sort Order</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="number" class="form-control" placeholder="Sort Order" name="Sort_Order" value="<?php echo $ez_page_info[0]['Sort_Order'];?>">
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
                <option value="">Please select</option>
                <?php foreach($Locations as $locations){
                  if($locations == $ez_page_info[0]['Location']){
                    $selected = 'selected';
                  }else{
                    $selected = '';  
                  }?>
                  <option <?php echo $selected;?>><?php echo $locations;?></option>
                  <?php }?>
               </select>
            </div>
          </div>
    </div>
    <?php if($ez_page_info[0]['Location'] =='Tool References'){
      $manu_hide = '';
    }else{
      $manu_hide = 'hide';
    }?>
    <div class="row ManufacturerRow <?php echo $manu_hide;?>">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Manufacturer</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <select type="text" class="form-control" name="Manufacturer_UUID">
                <option>Please select</option>
                <?php foreach($getAllManufacturer as $manufacturer){
                  if($manufacturer['UUID'] == $ez_page_info[0]['Manufacturer_UUID']){
                    $selected = 'selected';
                  }else{
                    $selected = '';  
                  }?>
                  <option value="<?php echo $manufacturer['UUID'];?>" <?php echo $selected;?>><?php echo $manufacturer['Manufacturer_Name'];?></option>
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
               <select type="text" class="form-control select_page_types1" name="Page_Type">
                <option>Please select</option>
                <?php foreach($page_types as $page_type){
                  if($page_type == $ez_page_info[0]['Page_Type']){
                    $selected = 'selected';
                  }else{
                    $selected = '';  
                  }?>
                  <option <?php echo $selected;?>><?php echo $page_type;?></option>
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
               <input type="text" class="form-control" placeholder="Page Name" name="Page_Name" value="<?php echo $ez_page_info[0]['Page_Name'];?>">
            </div>
          </div>
        </div>
       <?php if($ez_page_info[0]['Page_Type'] == 'HTML'){?>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Page Content </label>
            </div>
          </div>
          <div class="col-sm-20">
            <div class="inputcol">
               <textarea class="form-control pageContentHolder" name="Content"><?php echo $ez_page_info[0]['Content'];?></textarea>
            </div>
          </div>
        </div>
        <script src="<?php echo asset_url(); ?>admin/js/ckeditor/ckeditor.js"></script>
        <script>
                    CKEDITOR.replace( 'Content',{
                      height: '300px',
                    } );
        </script>
        <?php }else{ ?>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Page Content </label>
                </div>
              </div>
              <div class="col-sm-20">
                <div class="inputcol pageContentHolder">
                   <textarea class="form-control" name="Content" style="width: 434px;"><?php echo $ez_page_info[0]['Content'];?></textarea>
                </div>
              </div>
            </div>
        <?php } ?>
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
