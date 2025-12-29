<select class="form-control" name="TestKey_UUID" id="TestKey_UUID">
  <option value="">Select Key  </option>
  <?php 
	$get_machanical_keys = get_machanical_keys($data_type);
	foreach($get_machanical_keys as $keys){ ?>
	<option value="<?php echo $keys['UUID'];?>"><?php echo $keys['Key_Name'];?></option>
<?php } ?> 
</select>