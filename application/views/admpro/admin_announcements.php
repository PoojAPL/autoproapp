<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
      <div class="col-sm-6">
          <div class="form-group">
              <label>Show Type: </label>
                <select class="form-control select-field filter_announcements_types" style="width: 180px;">
                  <option value="all">All</option>  
                  <?php $announcements_type = announcements_type(); 
                   foreach ($announcements_type as $value) {
                      echo '<option>'.$value.'</option>';
                    } ?>                           
                </select>
            </div>
      </div>
      <div class="col-sm-6">
            <form method="post" id="searchAnnouncements" novalidate="novalidate">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control" style="width: 200px;" placeholder="Enter at least 3 characters for searching">
                     <button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
      </div>
      <div class="col-sm-6">
        <div class="form-group addCodeSeries">
          <a href="<?php echo adm_base_url();?>/firebase_update_announcements" class="btn btn-success">Firebase Update</a>   
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group addCodeSeries">
        <a href="<?php echo adm_base_url();?>/add_announcements" class="btn btn-danger">Add New Announcement</a>   
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <input type="checkbox" name="show_enabled" class="show_enabled_announcements"> &nbsp;Show Enabled Only
        <br><br>
        <?php if($this->session->flashdata('message_display')){?>
        <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="table-responsive chips_data" style="overflow:visible">
            <table class="table table-bordered  table-data mar0 tab-con">
              <thead>
                <tr>
                  <th>ID </th>
                  <th>Title</th>
                  <th>Message</th>
                  <th>Image</th>
                  <th>Type</th>
                  <th>Expiration</th>
                  <th>Priority</th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($announcements as $value) {
                  if($value['Active'] =='Yes'){
                    $checked = 'checked';
                    $hide_inactive = '';
                  }else{
                    $checked = '';
                    $hide_inactive = 'inactive';
                  }
                  $Expiration = strtotime($value['Expiration']);
                  $crrent_date = strtotime(date('m/d/Y'));
                  if($Expiration < $crrent_date){
                    $checked = '';
                    $update_status = announcements_status($value['id']);
                  }else{
                    $checked = $checked;
                  }
                  ?>
                  <tr class="<?php echo $hide_inactive;?>">
                    <td><?php echo $value['id'];?></td>
                    <td><?php echo $value['Title'];?></td>
                    <td><div class="notes-holder"><?php echo $value['Message'];?></div></td>
                    <td>
                      <?php if($value['Image'] !=""){
                              $images_data = explode(',',$value['Image']);
                              for($im = 0; $im < count($images_data); $im++){?>
                            <img src="<?php echo $images_data[$im];?>" width="50">
                            <?php }
                            } ?>
                    </td>
                    <td>
                      <?php if($value['Type'] == 'View With Version Update'){?>
                          <?php echo $value['Type'];?><br><?php echo $value['Version'];?>
                      <?php }else{ ?>
                          <?php echo $value['Type'];?>
                      <?php } ?>
                    </td>
                    <td><?php echo $value['Expiration'];?></td>
                    <td><?php echo $value['Priority'];?></td>
                    <td>
                      <input class="changeActivation" data-id="<?php echo $value['id'];?>" type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled" <?php echo $checked;?>>
                    <a href="<?php echo adm_base_url();?>/edit_announcements/<?php echo $value['id'];?>" type="button" class="btn btn-success">Edit</a>   
                      <a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_admin_announcement/')" type="button" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here --> 