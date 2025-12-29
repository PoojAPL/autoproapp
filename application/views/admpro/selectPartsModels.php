<select class="form-control select_parts_vehicles_years models" name="Model_UUID" data-id = "<?php echo $makeId;?>">
  <?php if( count($get_models) > 0){?>
  <option value="">Select model</option>
  <?php foreach($get_models as $model){?>
  <option value="<?php echo $model['UUID'];?>"> <?php echo $model['Model_Name'];?></option>
  <?php } 
  }else{?>
  	<option value="">Data not found</option>
  <?php } ?>
</select>
