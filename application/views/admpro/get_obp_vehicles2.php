<?php error_reporting(0);?>
<select class="form-control" name="Vehicle_UUID" id="Vehicle_ID">
<?php 
  $get_make_name = get_make_name($modelId);  
  foreach($get_vehicles as $model){?>
  <option value="<?php echo $model['id'];?>">
   		<?php 
		$get_models_name = get_models_name($model['Model_UUID']);
		$years = explode(',',$model['Years']);
		echo $get_make_name[0]['Make_Name'];?>  <?php echo $get_models_name[0]['Model_Name'];?>  <?php echo $years[0];?>-<?php echo $years[count($years)-1];?>
   </option>
  <?php } ?>
</select>
<?php $get_correctionId = get_correctionId($get_vehicles[0]['UUID']);?>
<input type="hidden" id="correctionId" value="<?php echo $get_correctionId[0]['UUID'];?>"  />
