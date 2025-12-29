<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <?php if($column == 'gen'){
        $value = explode('__',$value);
        $value1 = $value[0];
        $value2 = $value[1]; ?>
        <input type="text" class="form-control decimalGen" step="0.1" pattern="\d+(\.\d{1})?" name="<?php echo $column;?>[<?php echo $dataId;?>]" placeholder="Gen" value="<?php echo $value1;?>" style="width: 130px;" />
        <input type="text" class="form-control decimalGenNotes" name="gen_notes[<?php echo $dataId;?>]" value="<?php echo $value2;?>" style="width: 130px;" placeholder="Gen Notes" />
    <?php }else{?>
        <input type="text" class="form-control" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="<?php echo $value;?>" style="width: 130px;" />
    <?php } ?>
    <input type="hidden" name="columnName" class="columnName" value="<?php echo $column;?>" />
    <button type="button" class="btn btn-success custom-button2 vh_input_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  vh_input_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>