<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<input type="hidden" name="columnName" value="<?php echo $input_column;?>" />
    <select name="<?php echo $input_column;?>[<?php echo $input_id;?>]"> 
      <option value="">Select</option>
      <?php 
	  if($key2 == ""){
		  $get_tools_type_tools = get_tools_type_tools($key1);
	   }else{
		  $get_tools_type_tools = get_tools_determinater2($key1, $key2);
	   }
      foreach( $get_tools_type_tools as $tools){?>
          <option value="<?php echo $tools['UUID'];?>"><?php echo $tools['Tool_Name'];?></option>
      <?php }	?>                    
    </select><br />
    <button type="button" class="btn btn-success custom-button2 csKyes_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2 csKyes_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>