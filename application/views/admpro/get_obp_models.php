<select class="form-control select_obp_vehicles" name="Model_UUID" data-id = "<?php echo $makeId;?>">
  <option value="">Select model</option>
  <?php foreach($get_models as $model){?>
  <option value="<?php echo $model['UUID'];?>"> <?php echo $model['Model_Name'];?></option>
  <?php } ?>
</select>
