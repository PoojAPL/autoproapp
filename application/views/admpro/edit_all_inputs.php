<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<?php if($column == 'Code_Series_UUID'){?>
		<select class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]">
                <option value="">Select Code Series</option>
                <?php foreach($get_t_code_series as $code_s){
                  if( $code_s['UUID'] == $results[0]['Code_Series_UUID']){
                      $selected = 'selected';
                  }else{
                    $selected = '';
                  }?>
                  <option value="<?php echo $code_s['UUID'];?>" <?php echo $selected;?>><?php echo $code_s['Code_Series_Name'];?></option>
                <?php  } ?>
              </select>
	<?php }else if($column == 'Lock_Type'){?>
    <select class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]">
                <option value="">--</option>
                <?php $lock_type = lock_type();
                 foreach($lock_type as $value1){
                  if( $value1 == $value){
                      $selected = 'selected';
                  }else{
                    $selected = '';
                  }?>
                  <option value="<?php echo $value1;?>" <?php echo $selected;?> ><?php echo $value1;?></option>
                <?php  } ?>
              </select>
  <?php }else{?>
    <input type="text" class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="<?php echo $value;?>" />
    <?php } ?>
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <input type="hidden" name="tableName"  value="<?php echo $tableName;?>" >
    <button type="button" class="btn btn-success custom-button2 all_input_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  all_input_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>