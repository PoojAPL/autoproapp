<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
  <input type="hidden" name="columnName" value="<?php echo $column;?>" />
  <select class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]">
    <option value="">Select</option>
    <?php if($dataType == 'machineInfo'){
			 $table = 't_Machines_Info_Types'; 
			 $column_name = 'Machines_Info_Type_Name'; 
			 foreach($getMachinesTypes as $machine_type){
				if( $value == $machine_type['UUID']){
					$selected = 'selected';
				}else{
					$selected = '';
				}?>
    			<option value="<?php echo $machine_type['UUID'];?>" <?php echo $selected;?>><?php echo $machine_type['Machines_Info_Type_Name'];?></option>
   		<?php } 
	 }else if($dataType == 'makeInfo'){
			 $table = 't_Makes'; 
			 $column_name = 'Make_Name'; 
			foreach($getallmakes as $value1){
			   $make_id = $value1['UUID'];			 
			  if($value == $value1['UUID'] ){
				  $selected = 'selected';
			  }else{
				  $selected ='';
			  }
			  ?>
		   <option value ="<?php echo $value1['UUID'];?>" <?php echo $selected;?>><?php echo $value1['Make_Name'];?></option>	
   		<?php } 
	 }?>
  </select>
  <input type="hidden" name="tableName" value="<?php echo $table;?>" />
  <input type="hidden" name="tableColName" value="<?php echo $column_name;?>"  />
  <input type="hidden" name="dataTable" value="<?php echo $dataTable;?>" />
  <input type="hidden" name="image" value="<?php echo $image;?>" />
  <button type="button" class="btn btn-success custom-button2 table_dropbox_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
  <button type="button" class="btn btn-danger custom-button2  table_dropbox_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>
