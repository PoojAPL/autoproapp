<div class="container-fluid">  
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form" method ="post" action="<?php echo adm_base_url();?>/save_key" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add New User</h2>-->
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Key Name</label>
        </div>
      </div>
      <div class="col-sm-10 ">
        <div class="inputcol">
        <input type="hidden" name="keyid" value="<?php echo $keyid;?>" />
         <input type="text" class="form-control" placeholder="Key Name" name="key_name" value="<?php echo $getkeysInfo[0]['Key_Name'];?>" >
        </div>
      </div>
    </div> 
    <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Key Type</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <select class="form-control selectKeyType"  name="key_type" >
           		<option value="">Select key type</option>
                	<?php foreach($getAllkeyType as $chips){
					 if($getkeysInfo[0]['Key_Type_UUID'] == $chips['UUID']){
						 $selected = 'selected';
					 }else{
						 $selected = '';
					  }					
					 ?>
                <option value="<?php echo $chips['UUID'];?>" <?php echo $selected;?>><?php echo $chips['Key_Type_Name'];?></option>
                <?php } ?>
           </select>
          </div>
        </div>
      </div>   
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Image Filename</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" name="key_image" value="<?php echo $getkeysInfo[0]['Key_Image'];?>" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Products</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Products" name="products" value="<?php echo $getkeysInfo[0]['Products'];?>">
          </div>
        </div>
      </div>
      <?php 
	   $test_key_hide = '';
	   $chip_row = '';
	   $key_shell = '';	
	  if( ($getkeysInfo[0]['Key_Type_UUID'] == '706fb41c-3ce7-11e6-8f40-525400180921') || ( $getkeysInfo[0]['Key_Type_UUID'] == '391021e9-3d59-11e6-8f40-525400180921') ){
			 $test_key_hide = '';
			 $chip_row = '';
			 $key_shell = '';			
	  }else if( $getkeysInfo[0]['Key_Type_UUID'] == '706fb125-3ce7-11e6-8f40-525400180921' ){
		 	  $chip_row = 'hide';
			  $test_key_hide = 'hide';	
			  $key_shell = '';
	   }else if( $getkeysInfo[0]['Key_Type_UUID'] == 'ea244906-4d80-11e6-8f40-525400180921' ){
		 	  $chip_row = 'hide';
			  $test_key_hide = '';	
			  $key_shell = 'hide';
	   }else{
		 $hide = 'hide';
		 $key_shell = 'hide';	
	   }
	  ?>      
      <div class="TestkeyShellRow <?php echo $test_key_hide;?>">
      	<div class="row">
            <div class=" col-sm-4 ">
              <div class="labelcol">
                <label class="control-label">Test Key</label>
              </div>
            </div>
            <div class="col-sm-10">
              <div class="inputcol">
               <select class="form-control"  name="TestKey_UUID" >
                    <option value="">Select Test Key</option>
                    <?php 
                    $get_machanical_keys = get_machanical_test_keys('Mechanical Key','Transponder Key Shell');
					$get_machanical_keys2 = get_machanical_keys('Transponder Key Shell');
					$array_merge = array_merge($get_machanical_keys, $get_machanical_keys2);
					$sort_array = asort($array_merge);
					//print_r($sort_array);
                    foreach($get_machanical_keys as $keys){
						 if($getkeysInfo[0]['TestKey_UUID'] == $keys['UUID']){
							 $selected = 'selected';
						 }else{
							 $selected = '';
						 }
					?>
                    <option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
                    <?php } ?>
               </select>
              </div>
            </div>
          </div>
      </div>    
      <div class="ChipRow <?php echo $test_key_hide;?>"> 
          <div class="row">
            <div class=" col-sm-4 ">
              <div class="labelcol">
                <label class="control-label">Chip</label>
              </div>
            </div>
            <div class="col-sm-10">
              <div class="inputcol">
               <select class="form-control"  name="chips" >
                    <option value="">Select chip</option>
                    <?php foreach($getAllChips as $chips1){ 
                        if($getkeysInfo[0]['Chip_UUID'] == $chips1['UUID']){
                             $selected = 'selected';
                         }else{
                             $selected = '';
                         }
                    ?>
                    <option value="<?php echo $chips1['UUID'];?>" <?php echo  $selected;?>><?php echo $chips1['Chip_Name'];?></option>
                    <?php } ?>
               </select>
              </div>
            </div>
          </div>
      </div>       
      <div class="row keyShellDiv <?php echo $key_shell;?>">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Key Shell</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <select class="form-control" name="Key_Shell_UUID">
              	<option value="">Select Key Shell</option>
                <?php 
				$get_machanical_keys = get_machanical_keys('Transponder Key Shell');
				foreach($get_machanical_keys as $keys){
					if($getkeysInfo[0]['Key_Shell_UUID'] == $keys['UUID']){
						 $selected = 'selected';
					 }else{
						 $selected = '';
					  }
					?>
                	<option value="<?php echo $keys['UUID'];?>" <?php echo $selected;?>><?php echo $keys['Key_Name'];?></option>
                <?php  } ?>               
              </select>
            </div>
          </div>
        </div>  
        <fieldset>
      	<legend>Alternative Key Names</legend>
        <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Ilco</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Ilco" name="Alt_Ilco" value="<?php echo $getkeysInfo[0]['Alt_Ilco'];?>">
          </div>
        </div>
      </div>
          <div class="row">
            <div class=" col-sm-4 ">
              <div class="labelcol">
                <label class="control-label">Axxess</label>
              </div>
            </div>
            <div class="col-sm-10 ">
              <div class="inputcol">
               <input type="text" class="form-control" placeholder="Axxess" name="Alt_Axxess" value="<?php echo $getkeysInfo[0]['Alt_Axxess'];?>" >
              </div>
            </div>
          </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Curtis</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Curtis" name="Alt_Curtis" value="<?php echo $getkeysInfo[0]['Alt_Curtis'];?>" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">ESP</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="ESP" name="Alt_ESP" value="<?php echo $getkeysInfo[0]['Alt_ESP'];?>" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Hillman</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Hillman" name="Alt_Hillman" value="<?php echo $getkeysInfo[0]['Alt_Hillman'];?>" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Jet</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Jet" name="Alt_Jet" value="<?php echo $getkeysInfo[0]['Alt_Jet'];?>"  >
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">JMA</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="JMA" name="Alt_JMA" value="<?php echo $getkeysInfo[0]['Alt_JMA'];?>" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Silca</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Silca" name="Alt_Silca" value="<?php echo $getkeysInfo[0]['Alt_Silca'];?>" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Strattec</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Strattec" name="Alt_Strattec" value="<?php echo $getkeysInfo[0]['Alt_Strattec'];?>" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Taylor</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Taylor" name="Alt_Taylor"  value="<?php echo $getkeysInfo[0]['Alt_Taylor'];?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">OEM</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="OEM" name="Alt_OEM"  value="<?php echo $getkeysInfo[0]['Alt_OEM'];?>" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class=" col-sm-4 ">
          <div class="labelcol">
            <label class="control-label">Other</label>
          </div>
        </div>
        <div class="col-sm-10 ">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Other" name="Alt_Other"  value="<?php echo $getkeysInfo[0]['Alt_Other'];?>" >
          </div>
        </div>
      </div>
      </fieldset>
           
      <fieldset class="availableSubstitutes">
      	<legend>Available Substitutes</legend>
        	
            	<?php $substitute_UUID = explode(',', $getkeysInfo[0]['Substitute_UUID']);
				$get_key_type_by_key1 = get_key_type_by_key( $substitute_UUID[0] );	?>                
                	<div class="substituteData">                        
                      <div class="get_substitute_keys">
                      	<div class="row">
                          <div class=" col-sm-4 ">
                            <div class="labelcol">
                              <label class="control-label">Key Name</label>
                            </div>
                          </div>
                          <div class="col-sm-10 ">
                            <div class="inputcol">
                             <select class="form-control"  name="Substitute_UUID[]" >
                                  <option value="">Select key</option>
                                  <?php 
								     $get_substitute_keys = get_substitute_keys( $get_key_type_by_key1[0]['Key_Type_UUID'] );
								     foreach($get_substitute_keys as $chips){
									  	if($substitute_UUID[0] == $chips['UUID']){
											 $selected = 'selected';
										 }else{
											 $selected = '';
										 }
									   ?>
                                  <option value="<?php echo $chips['UUID'];?>" <?php echo  $selected;?>><?php echo $chips['Key_Name'];?></option>
                                  <?php } ?>
                             </select>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="availableSubstitutes2">                
					<?php for($sb = 1; $sb < count($substitute_UUID)-1; $sb++){					
                        $get_key_type_by_key = get_key_type_by_key( $substitute_UUID[$sb] );?>
                        <div class="row anotherSubs">
                          <div class=" col-sm-4 ">
                            <div class="labelcol">
                              <label class="control-label">Key Name</label>
                            </div>
                          </div>
                          <div class="col-sm-10 ">
                            <div class="inputcol">
                             <select class="form-control"  name="Substitute_UUID[]" >
                                  <option value="">Select key</option>
                                  <?php 
								     $get_substitute_keys = get_substitute_keys( $get_key_type_by_key[0]['Key_Type_UUID'] );
								     foreach($get_substitute_keys as $chips){
									  	if($substitute_UUID[$sb] == $chips['UUID']){
											 $selected = 'selected';
										 }else{
											 $selected = '';
										 }
									   ?>
                                  <option value="<?php echo $chips['UUID'];?>" <?php echo  $selected;?>><?php echo $chips['Key_Name'];?></option>
                                  <?php } ?>
                             </select>
                            </div>
                          </div>
                          <span class="glyphicon glyphicon-remove subsitutesRemove" aria-hidden="true"></span>
						  <div class="clearfix"></div>
                        </div>
                    <?php }	?>        
                  </div>
         <a href="javascript:void(0)" class="pull-right addAnotherSubstitute"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Another Substitute</a>  
      </fieldset>         
     <hr>
     <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">&nbsp;</label>
        </div>
      </div>
      <div class="col-sm-10 ">
        <div class="inputcol">
          <button type="sumit" class="btn btn-primary" name="post">Submit </button>
          <a href="<?php echo adm_base_url();?>/keys" class="btn btn-danger">Cancel</a>
        </div>
      </div>
    </div>
   </form>
  </div>
  </div>
</div>
