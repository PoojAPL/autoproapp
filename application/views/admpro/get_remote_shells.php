<select class="form-control" name="Shell_UUID" id="Shell_UUID">
  <option value="">Select Shell Key  </option>
  <?php $get_remotes = get_remotes($data_type);
  foreach($get_remotes as $remote){?>
      <option value="<?php echo $remote['UUID'];?>"><?php echo $remote['Remote_Name'];?></option>
  <?php  } ?>  
</select>