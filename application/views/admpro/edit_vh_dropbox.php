<form method="post">  
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />  
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <?php 
	if($column == 'Code_Series_UUID'){
		$multiple = 'multiple';
		$height = 'style="height: 500px;"';
		echo "<input type='hidden' name='vehicle_id' value='".$dataId."'>";
		$dataId = "";
	}else{
		$multiple = "";
		$height = "";
	}
	?>
    <select class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" <?php echo $multiple;?> <?php echo $height;?>>
    	<option value="">Select</option>
        <?php if($type == 'Code_Series_UUID'){
			 $table = 't_Code_Series'; 
			 $column_name = 'Code_Series_Name'; 
			 $got_series_data = explode(',',$value);	
			 $code_series_id2 = "";			
			for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
				$got_series_val = explode('|',$got_series_data[$cs]);
				$code_series_id = $got_series_val[0];
				$code_series_id2 .= "'".$got_series_val[0]."',";
				$code_series_note = $got_series_val[1];
				$get_Code_Series_name = get_Code_Series_name($code_series_id);
				if($get_Code_Series_name[0]['Code_Series_Name'] !=""){?>
					<option value="<?php echo $code_series_id;?>" selected><?php echo $get_Code_Series_name[0]['Code_Series_Name'];?> 
					<?php if((isset($code_series_note)) && ($code_series_note !="" )){?>(<?php echo $code_series_note;?>)<?php } ?></option>
			<?php  } 
			}
			$code_series_id2 = rtrim($code_series_id2,',');
			$get_Code_Series = get_Code_Series_not_in($code_series_id2);
			foreach($get_Code_Series as $code){?>
				<option value="<?php echo $code['UUID'];?>"><?php echo $code['Code_Series_Name'];?></option>
			<?php }
          }else if($type == 'Retainer_UUID'){
			 $table = 't_Retainers'; 
			  $column_name = 'Retainer_Name'; 
			 foreach($getRetainers as $retainer){
					if($value == $retainer['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                	<option value="<?php echo $retainer['UUID'];?>" <?php echo $selected;?>><?php echo $retainer['Retainer_Name'];?></option>
                <?php  } 
		 }else if($type == 'Keys'){
			 $table = 't_Keys'; 
			 $column_name = 'Key_Name'; 
			 $get_machanical_keys = get_machanical_keys($key);
				foreach($get_machanical_keys as $keys){
					if($value == $keys['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                	<option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
                <?php  }
				if($column == 'Chip_Key_UUID'){
					$get_machanical_keys2 = get_machanical_keys('VATS Key');
					foreach($get_machanical_keys2 as $keys){
					if($value == $keys['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                	<option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
                <?php  } 
				} 
		 }else if($type == 'Remotes'){
			 $table = 't_Remotes'; 
			  $column_name = 'Remote_Name'; 
			  $get_remotes = get_remotes($key);
				foreach($get_remotes as $remote){			
					if($value == $remote['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                	<option value="<?php echo $remote['UUID'];?>" <?php echo $selected;?>><?php echo $remote['Remote_Name'];?></option>
                <?php  } 
		 }else if($type == 'Tools'){
			  $table = 't_Tools'; 
			  $column_name = 'Tool_Name'; 
			  $get_programmer_tools = get_programmer_tools($key);
			  foreach($get_programmer_tools as $remote){
				  if($value == $remote['UUID']){
					  $selected = 'selected';
				  }else{
					  $selected = '';
				  }
				  ?>
				  <option value="<?php echo $remote['UUID'];?>" <?php echo $selected;?>><?php echo $remote['Tool_Name'];?></option>
                <?php  } 
		 }else if($type == 'Model_UUID'){
			 $get_make_name = get_make_name($value);
			  $table = 't_Models'; 
			  $column_name = 'Model_Name'; 
			  $get_model_makes =  get_model_makes($get_make_name[0]['UUID']);
			  foreach($get_model_makes as $models){
				  if($value == $models['UUID']){
					  $selected = 'selected';
				  }else{
					  $selected = '';
				  }
				  ?>
				  <option value="<?php echo $models['UUID'];?>" <?php echo $selected;?>> <?php echo $models['Model_Name'];?></option>	
                <?php  } 
		 }else if($type == 'Vehicle_Type'){
			  $vtype_array = array("Car", "Motorcycle", "Watercraft", "Large Truck");
			  $table = 't_Vehicles'; 
			  $column_name = 'Vehicle_Type'; 
			  foreach($vtype_array as $types){
				  if($value == $types){
					  $selected = 'selected';
				  }else{
					  $selected = '';
				  }
				  ?>
				  <option <?php echo $selected;?>> <?php echo $types;?></option>	
                <?php  } 
		 }?>		       
    </select>
    <input type="hidden" name="tableName" value="<?php echo $table;?>" />
    <input type="hidden" name="tableColName" value="<?php echo $column_name;?>"  />
    <button type="button" class="btn btn-success custom-button2 vh_dropbox_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  vh_dropbox_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>