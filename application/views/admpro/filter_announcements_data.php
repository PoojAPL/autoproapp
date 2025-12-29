
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
    <?php 
    if( count($announcements) > 0){
    foreach ($announcements as $value) {?>
      <tr>
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
          <?php if($value['Active'] =='Yes'){
            $checked = 'checked';
          }else{
            $checked = '';
          }
          ;?>
          <input type="checkbox" class="toggle-two" data-toggle="toggle" data-on="Enabled" data-off="Disabled" <?php echo $checked;?> disabled>
        <a href="<?php echo adm_base_url();?>/edit_announcements/<?php echo $value['id'];?>" type="button" class="btn btn-success">Edit</a>   
          <a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_admin_announcement/')" type="button" class="btn btn-danger">Delete</a>
        </td>
      </tr>
    <?php }
    }else{?>
      <tr>
        <td colspan="10"> <div class="alert alert-danger">Data not found. </div></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<script>
  $(function() {
    $('.toggle-two').bootstrapToggle({
      on: 'Enabled',
      off: 'Disabled'
    });
  })
</script>