<select class="form-control" name="Model_UUID">
  <option value="">Select model</option>
  <?php foreach($get_models as $model){?>
  <option value="<?php echo $model['UUID'];?>"> <?php echo $model['Model_Name'];?></option>
  <?php } ?>
</select>
