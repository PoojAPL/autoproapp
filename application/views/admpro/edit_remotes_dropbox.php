<form method="post"> 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />   
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />    
    <select class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" <?php echo $multiple;?>>
    	<option value="">Select</option>
       	<?php if($type == 'Remote_Type_UUID'){
				 $table = 't_Remote_Types'; 
				 $column_name = 'Remote_Type_Name'; 
				 foreach($getAllRemoteType as $remote_type){
					if($value == $remote_type['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                <option value="<?php echo $remote_type['UUID'];?>" <?php echo $selected;?>><?php echo $remote_type['Remote_Type_Name'];?></option>               
               <?php  } 
               }else if($type == 'Frequency'){
				  $table = 't_Frequencies'; 
				  $column_name = 'Name'; 
				  $get_Frequency = get_Frequency();
					foreach($get_Frequency as $frequency){
					if($value == $frequency['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                <option value="<?php echo $frequency['UUID'];?>" <?php echo $selected;?>><?php echo $frequency['Name'];?></option>
                <?php  } 
		   }else if($type == 'Battery_UUID'){
				  $table = 't_Batteries'; 
				  $column_name = 'Battery_Name'; 
				  foreach($getAllbatteries as $battery){
					if($value == $battery['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                <option value="<?php echo $battery['UUID'];?>" <?php echo $selected;?>><?php echo $battery['Battery_Name'];?></option>
                <?php  } 
		   }else if($type == 'Chip_UUID'){
				  $table = 't_Chips'; 
				  $column_name = 'Chip_Name'; 
				  foreach($getAllChips as $chip){
					if($value == $chip['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                <option value="<?php echo $chip['UUID'];?>" <?php echo $selected;?>><?php echo $chip['Chip_Name'];?></option>
                <?php  } 
		   }else if($type == 'TestKey_UUID'){
				  $table = 't_Keys'; 
				  $column_name = 'Key_Name'; 
				  $get_machanical_keys = get_machanical_keys('Mechanical Key');
                  foreach($get_machanical_keys as $keys){
					if($value == $keys['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					 ?>
                <option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
                <?php  } 
		   }else if($type == 'Shell_UUID'){
				  $table = 't_Remotes'; 
				  $column_name = 'Remote_Name'; 
				  $get_remote_shell_keys = get_remote_shell_keys($value);
                  foreach($get_remote_shell_keys as $shells){
                  if($value == $shells['UUID']){
                      $selected = 'selected';
                  }else{
                      $selected = '';
                  }
                ?>
                <option value="<?php echo $shells['UUID'];?>" <?php echo $selected;?>><?php echo $shells['Remote_Name'];?></option>
                <?php  } 
		   }else if($type == 'Reusable'){
				  $table = 't_Remotes'; 
				  $column_name = 'Reusable'; 
				  $reusable_array = array('Yes', 'Yes (After Unlocking)','No');
                  foreach($reusable_array as $reusable){
                  if($value == $reusable){
                      $selected = 'selected';
                  }else{
                      $selected = '';
                  }
                ?>
                <option value="<?php echo $reusable;?>" <?php echo $selected;?>><?php echo $reusable;?></option>
                <?php  } 
		   }?>?>		       
    </select>
    <input type="hidden" name="tableName" value="<?php echo $table;?>" />
    <input type="hidden" name="tableColName" value="<?php echo $column_name;?>"  />
    <button type="button" class="btn btn-success custom-button2 remotes_dropbox_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  remotes_dropbox_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>