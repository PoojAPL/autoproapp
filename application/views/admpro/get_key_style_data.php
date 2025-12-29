<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <select name="<?php echo $column;?>[<?php echo $dataId;?>]">  
    <option value="">Select</option>
    <?php foreach($getAllKeyStyles as $key_style){
			if($UUID == $key_style['UUID']){
                $selected = 'selected';
            }else{
                $selected = '';
            }
		 ?>
          <option value="<?php echo $key_style['UUID'];?>" <?php echo $selected;?>><?php echo $key_style['Key_Style_Name'];?></option>
      <?php }?>                  
    </select>
    <br />
    <button type="button" class="btn btn-success custom-button2 keyStyle_data_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2 keyStyle_data_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>