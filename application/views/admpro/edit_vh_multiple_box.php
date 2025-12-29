<?php $programm_array = explode(',',$value);?>
<form method="post">  
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />  
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />  
    <input type="hidden" value="<?php echo $dataId;?>" name="id" /> 
    <input type="hidden" value="<?php echo $type;?>" name="type" />
     <?php if( $column == "Chip_Key_UUID"){ ?>
        <select class="form-control" name="Chip_Key_UUID[]" multiple="multiple" style="height:200px; width:150px;">
              	<option value="">Select Chip Key</option>
                <?php 
				$get_machanical_keys = get_machanical_keys('Transponder Key');
				foreach($get_machanical_keys as $keys){
					if( in_array($keys['UUID'], $programm_array) ){
						  $selected = 'selected';
					  }else{
						  $selected = '';
					  }
					?>
                	<option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
                <?php  } ?>
                <?php 
				$get_machanical_keys2 = get_machanical_keys('VATS Key');
				foreach($get_machanical_keys2 as $keys){
					if( in_array($keys['UUID'], $programm_array) ){
						  $selected = 'selected';
					  }else{
						  $selected = '';
					  }
					?>
                	<option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
                <?php  } ?>
              </select>
    <?php }else if($column == "Remote_UUID"){ ?>
    		<select class="form-control" name="Remote_UUID[]" multiple="multiple" style="height:auto; width:150px;">
              	<option value="">Select Remote </option>
                <?php 
				$get_remotes = get_remotes('Remote (Keyless Entry)');
				foreach($get_remotes as $remote){
					  if( in_array($remote['UUID'], $programm_array) ){
						  $selected = 'selected';
					  }else{
						  $selected = '';
					  }?>
                	<option value="<?php echo $remote['UUID'];?>" <?php echo  $selected;?>><?php echo $remote['Remote_Name'];?></option>
                <?php  } ?>
                
              </select>
    <?php }else if($column == "RHK_UUID"){ ?>
    		<select class="form-control" name="RHK_UUID[]" multiple="multiple" style="height:auto;">
              	<option value="">Select Remote Head Key  </option>
                <?php 
				$get_remotes = get_remotes('Remote Head Key');
				foreach($get_remotes as $remote){
					 if( in_array($remote['UUID'], $programm_array) ){
						  $selected = 'selected';
					  }else{
						  $selected = '';
					  }?>
                	<option value="<?php echo $remote['UUID'];?>" <?php echo  $selected;?>><?php echo $remote['Remote_Name'];?></option>
                <?php  } ?>
                
              </select>
    <?php }else if($column == "SmartKey_UUID"){ ?>
    		<select class="form-control" name="SmartKey_UUID[]" multiple="multiple" style="height:200px;">
              	<option value="">Select Smart Key  </option>
                <?php 
				$get_remotes = get_remotes('Smart Key');
				foreach($get_remotes as $remote){
					if( in_array($remote['UUID'], $programm_array) ){
						  $selected = 'selected';
					  }else{
						  $selected = '';
					  }?>
                	<option value="<?php echo $remote['UUID'];?>" <?php echo  $selected;?>><?php echo $remote['Remote_Name'];?></option>
                <?php  } ?>
                
              </select>
    <?php } ?>
    <button type="button" class="btn btn-success custom-button2 vh_multiple_dropbox_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  vh_multiple_dropbox_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>