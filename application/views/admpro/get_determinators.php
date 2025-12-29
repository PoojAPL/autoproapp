<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <select class="determinator_uuids" name="<?php echo $column;?>[<?php echo $dataId;?>]">  
        <option value="">Select</option>                              
    <?php $get_tools_determinater = get_tools_determinater($key);
        foreach( $get_tools_determinater as $tools){
            if($UUID == $tools['UUID']){
                $selected = 'selected';
            }else{
                $selected = '';
            }
        ?>
        <option value="<?php echo $tools['UUID'];?>" <?php echo $selected;?> data-name="<?php echo $tools['Tool_Name'];?>"><?php echo $tools['Tool_Name'];?></option>
    <?php }	?>                    
    </select><br />
    <button type="button" class="btn btn-success custom-button2 determinator_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2 determinator_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>