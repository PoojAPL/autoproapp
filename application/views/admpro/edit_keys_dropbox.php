<form method="post">  
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />  
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />    
    <select class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" <?php echo $multiple;?>>
    	<option value="">Select</option>
       	<?php if($type == 'Key_Type_UUID'){
				 $table = 't_Key_Types'; 
				 $column_name = 'Key_Type_Name'; 
				 foreach($getAllkeyType as $chips){
					 if($value == $chips['UUID']){
						 $selected = 'selected';
					 }else{
						 $selected = '';
					  }					
					 ?>
                <option value="<?php echo $chips['UUID'];?>" <?php echo $selected;?>><?php echo $chips['Key_Type_Name'];?></option>               
               <?php  } 
               }else if($type == 'Chip_UUID'){
				  $table = 't_Chips'; 
				  $column_name = 'Chip_Name'; 
				  foreach($getAllChips as $chips1){ 
                        if($value == $chips1['UUID']){
                             $selected = 'selected';
                         }else{
                             $selected = '';
                         }
                    ?>
                    <option value="<?php echo $chips1['UUID'];?>" <?php echo  $selected;?>><?php echo $chips1['Chip_Name'];?></option>
                <?php  } 
		   }else if($type == 'Key_Shell_UUID'){
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
		   }else if($type == 'TestKey_UUID'){
				  $table = 't_Keys'; 
				  $column_name = 'Key_Name'; 
				  $get_machanical_keys = get_machanical_keys('Mechanical Key');
					$get_machanical_keys2 = get_machanical_keys('Transponder Key Shell');
					$array_merge = array_merge($get_machanical_keys, $get_machanical_keys2);
					$sort_array = asort($array_merge);
					//print_r($sort_array);
                    foreach($array_merge as $keys){
					 if($value == $keys['UUID']){
						 $selected = 'selected';
					 }else{
						 $selected = '';
					 }
					?>
                    <option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
                <?php  } 
		   }?>		       
    </select>
    <input type="hidden" name="tableName" value="<?php echo $table;?>" />
    <input type="hidden" name="tableColName" value="<?php echo $column_name;?>"  />
    <button type="button" class="btn btn-success custom-button2 keys_dropbox_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  keys_dropbox_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>