<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<?php if($column =='Testing'){ ?>    
    <select type="text" class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" style="width: auto;">
    	<option value=""></option>
        <?php $application_testing = application_testing();
			foreach($application_testing as $testing){
				if($value == $testing){
					$selected = 'selected';
				}else{
					$selected = '';	
				}?>
				<option value="<?php echo $testing;?>" <?php echo $selected;?>><?php echo $testing;?></option>
		<?php	}
		?>
    </select>
	<?php }else{ ?>
    	<input type="text" class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="<?php echo $value;?>" />
    <?php } ?>
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <button type="button" class="btn btn-success custom-button2 application_input_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  application_input_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>