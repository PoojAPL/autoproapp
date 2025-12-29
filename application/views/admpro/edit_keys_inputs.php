<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <input type="text" class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="<?php echo $value;?>" style="width: 130px;" />
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <button type="button" class="btn btn-success custom-button2 keys_input_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  keys_input_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>