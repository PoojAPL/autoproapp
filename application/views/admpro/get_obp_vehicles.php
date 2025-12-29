<select class="form-control" name="Vehicle_UUID[]" id="Vehicle_ID">

  <?php 
  $get_make_name = get_make_name($modelId);  
  foreach($get_vehicles as $model){?>
  <option value="<?php echo $model['UUID'];?>">
   		<?php 
		$get_models_name = get_models_name($model['Model_UUID']);
		$years = explode(',',$model['Years']);
		echo $get_make_name[0]['Make_Name'];?>  <?php echo $get_models_name[0]['Model_Name'];?>  <?php echo $years[0];?>-<?php echo $years[count($years)-1];?>
   </option>
  <?php } ?>
</select>
