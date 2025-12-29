<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<?php if( ($column == 'Clonable') || ( $column == 'Reusable') || ( $column == 'CloningChip')){
   			if($value == 1){
				$yes_checked = 'checked';
				$no_checked = '';
		     }else{
				 $yes_checked = '';
				 $no_checked = 'checked';
			 }?>
       	 <input type="radio" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="1" <?php echo $yes_checked;?> />
          Yes  &nbsp;&nbsp; <input type="radio" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="0" <?php echo  $no_checked;?> /> No<br /><br />
    <?php }else{?>    	 	
           <input type="text" class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="<?php echo $value;?>" style="width: 130px;" />
    <?php } ?>   
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <input type="hidden" name="dataTable" value="<?php echo $dataTable;?>" />
    <input type="hidden" name="image" value="<?php echo $image;?>" />
    <button type="button" class="btn btn-success custom-button2 chips_input_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  chips_input_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>