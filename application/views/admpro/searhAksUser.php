<select class="form-control"  name="User_UUID">
<?php
foreach ($get_all_aks_users as $key => $value) {
  if($User_Email == $value['User_UUID']){
    $selected = 'selected';
  }else{
    $selected = '';
  }?>
  <option value="<?php echo $value['User_UUID'];?>" <?php echo $selected;?>><?php echo $value['Email'];?> (<?php echo $value['User_UUID'];?>)</option>
<?php } ?>
</select>