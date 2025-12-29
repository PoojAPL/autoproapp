<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<?php if($column == 'type'){?>
    	<select class="form-control select-field" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="<?php echo $value;?>" style="width: 130px;">
		  <?php  $get_users_type = users_type();
          foreach( $get_users_type as $key => $user_type){
			  if($value == $key){
				$selected = 'selected';
			  }else{
				  $selected = '';	
			  }?>
              <option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $user_type;?></option>
          <?php } ?>
        </select>
    <?php }else{ ?>
    	<input type="text" class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="<?php echo $value;?>" style="width: 130px;" />
    <?php } ?>
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <button type="button" class="btn btn-success custom-button2 adminAccess_input_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  adminAccess_input_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>