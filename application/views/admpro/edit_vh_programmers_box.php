<?php $table = 't_Tools'; 
$column_name = 'Tool_Name'; 
$programm_array = explode(',',$value);?>
<form method="post"> 
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />   
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />  
    <input type="hidden" value="<?php echo $dataId;?>" name="id" />  
    <select class="form-control" name="Mechanical_Key_UUID[]" multiple="multiple" style="height:200px;width: 180px;">
      <option value="">Select Mechanical Key</option>
      <?php 
      $get_machanical_keys = get_machanical_keys('Mechanical Key');
      foreach($get_machanical_keys as $keys){
		  if( in_array($keys['UUID'], $programm_array) ){
			  $selected = 'selected';
		  }else{
			  $selected = '';
		  }
		  ?>
          <option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
      <?php  } ?>
    </select>
    <input type="hidden" name="tableName" value="<?php echo $table;?>" />
    <input type="hidden" name="tableColName" value="<?php echo $column_name;?>"  />
    <button type="button" class="btn btn-success custom-button2 vh_programmers_dropbox_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  vh_dropbox_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>