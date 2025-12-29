<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <select name="<?php echo $column;?>[<?php echo $dataId;?>]">  
    <option value="">Select</option>
      <?php $get_t_machines_info = get_t_machines_info($key);
      foreach( $get_t_machines_info as $options){
		   if($UUID == $options['UUID']){
                $selected = 'selected';
            }else{
                $selected = '';
            }
		  ?>
          <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
      <?php }	?>                    
    </select>
        <br />
    <button type="button" class="btn btn-success custom-button2 machine_data_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2 machine_data_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>