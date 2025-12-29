<form method="post">  
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />  
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />    
    <select class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" <?php echo $multiple;?>>
    	<option value="">Select</option>
       	<?php if($type == 'Manufacturer_UUID'){
				 $table = 't_Manufacturers'; 
				 $column_name = 'Manufacturer_Name'; 
				 foreach($getAllManufacturer as $manufacture){
						if( $value == $manufacture['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
					?>
            	<option value="<?php echo $manufacture['UUID'];?>" <?php echo $selected;?>><?php echo $manufacture['Manufacturer_Name'];?></option>
               <?php  } 
              }else if($type == 'Tool_Type_UUID'){
				  $table = 't_Tool_Types'; 
				  $column_name = 'Tool_Type_Name'; 
				  foreach($getAllToolType as $tool_type){
					if( $value == $tool_type['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
					<option value="<?php echo $tool_type['UUID'];?>" <?php echo $selected;?>><?php echo $tool_type['Tool_Type_Name'];?></option>
                <?php  } 
		   }?>		       
    </select>
    <input type="hidden" name="tableName" value="<?php echo $table;?>" />
    <input type="hidden" name="tableColName" value="<?php echo $column_name;?>"  />
    <button type="button" class="btn btn-success custom-button2 tools_dropbox_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  tools_dropbox_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>