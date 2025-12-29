<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <input type="text" class="form-control" name="<?php echo $input_column;?>[<?php echo $input_id;?>]" value="<?php echo $input_val;?>" style="width: 130px;" />
    <input type="hidden" name="columnName" value="<?php echo $input_column;?>" />
    <button type="button" class="btn btn-success custom-button2 csinput_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2 csinput_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>