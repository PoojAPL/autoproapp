<select class="form-control parts_years" name="years">
<?php if( count($get_vehicles) > 0){?>
      <option value="">Select Years</option>
      <?php  
      foreach($get_vehicles as $model){?>
      <option value="<?php echo $model['UUID'];?>">
            <?php 
            $get_models_name = get_models_name($model['Model_UUID']);
            $years = explode(',',$model['Years']);
            echo $years[0];?>-<?php echo $years[count($years)-1];?>
       </option>
      <?php }
    }else{?>
  	<option value="">Data not found</option>
  <?php } ?>?>
</select>
