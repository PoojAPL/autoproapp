<div class="container-fluid">
  <div class="row">
     <form class="site-form "  method ="post"  action="<?php echo adm_base_url();?>/vehicles/code_added" > 
     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <div class="col-sm-24 col-md-24">             
    <section class="innerUserlogin white-box code-series-page">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  		
        <div class="row">
          <div class="col-sm-12 col-md-8 left-panal">
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Code Series Name</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <input type="text" class="form-control"  name="code_series_name" value="<?php echo $getCodeSeries[0]['Code_Series_Name'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Spaces</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <input type="text" class="form-control"  name="space" value="<?php echo $getCodeSeries[0]['Spaces'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Depths</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <input type="text" class="form-control"  name="depth" value="<?php echo $getCodeSeries[0]['Depths'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">MACS</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <input type="text" class="form-control"  name="macs" value="<?php echo $getCodeSeries[0]['MACS'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Key Style</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="key_style_uuid">
                    <option value="">Select key style</option>
                    <?php foreach($getAllKeyStyles as $key_style){
						if( $getCodeSeries[0]['Key_Style_UUID'] ==  $key_style['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						 ?>
                    	<option value="<?php echo $key_style['UUID'];?>" <?php echo $selected;?>><?php echo $key_style['Key_Style_Name'];?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">First Cut</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <input type="text" class="form-control"  name="first_cut" value="<?php echo $getCodeSeries[0]['First_Cut'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Space Between Cuts</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <input type="text" class="form-control"  name="space_between_cuts" value="<?php echo $getCodeSeries[0]['Space_Between_Cuts'];?>">
                </div>
              </div>
            </div>
            <div class="row notesBox">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Notes</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <textarea name="notes"><?php echo $getCodeSeries[0]['Code_Series_Notes'];?></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Determinator</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="Determinator_UUID">
                    <option value="">Select Determinator</option>
                    <?php $get_tools_determinater = get_tools_determinater('Determinator');
					foreach( $get_tools_determinater as $tools){
						if( $getCodeSeries[0]['Determinator_UUID'] ==  $tools['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						?>
						<option value="<?php echo $tools['UUID'];?>" <?php echo $selected;?>><?php echo $tools['Tool_Name'];?></option>
					<?php }	?>                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Lishi</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                 <select class="form-control select-field" name="Lishi_UUID">
                    <option value="">Select Lishi</option>
                    <?php $get_tools_determinater = get_tools_determinater('Lishi');
					foreach( $get_tools_determinater as $tools){
						if( $getCodeSeries[0]['Lishi_UUID'] ==  $tools['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						?>
						<option value="<?php echo $tools['UUID'];?>" <?php echo $selected;?>><?php echo $tools['Tool_Name'];?></option>
					<?php }	?>                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Accu-Reader</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="Accu-Reader_UUID">
                    <option value="">Select Accu-Reader</option>
                    <?php $get_tools_determinater = get_tools_determinater('Accu-Reader');
					foreach( $get_tools_determinater as $tools){
						if( $getCodeSeries[0]['Accu-Reader_UUID'] ==  $tools['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						?>
						<option value="<?php echo $tools['UUID'];?>" <?php echo $selected;?>><?php echo $tools['Tool_Name'];?></option>
					<?php }	?>                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">EEZ Reader</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="EEZ-Reader_UUID">
                    <option value="">Select EEZ Reader</option>
                    <?php $get_tools_determinater = get_tools_determinater('EEZ Reader');
					foreach( $get_tools_determinater as $tools){
						if( $getCodeSeries[0]['EEZ-Reader_UUID'] ==  $tools['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						?>
						<option value="<?php echo $tools['UUID'];?>" <?php echo $selected;?>><?php echo $tools['Tool_Name'];?></option>
					<?php }	?>                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Space & Depth Keys</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="SDKeys_UUID">
                    <option value="">Select Space & Depth Keys</option>
                    <?php $get_tools_type_tools = get_tools_type_tools('Space & Depth Keys');
					foreach( $get_tools_type_tools as $tools){
						if( $getCodeSeries[0]['SDKeys_UUID'] ==  $tools['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						?>
						<option value="<?php echo $tools['UUID'];?>" <?php echo $selected;?>><?php echo $tools['Tool_Name'];?></option>
					<?php }	?>                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">Build-A-Key</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="BuildAKey_UUID">
                    <option value="">Select Build-A-Key</option>
                    <?php $get_tools_type_tools = get_tools_determinater2('BlueRocket', 'Space & Depth Keys');
					foreach( $get_tools_type_tools as $tools){
						if( $getCodeSeries[0]['Build_A_Key'] ==  $tools['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						?>
						<option value="<?php echo $tools['UUID'];?>" <?php echo $selected;?>><?php echo $tools['Tool_Name'];?></option>
					<?php }	?>                    
                  </select>
                </div>
              </div>
            </div>
            <!--<div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">LockTech IRT</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="LockTech_IRT">
                    <option value="">Select LockTech IRT</option>
                    <?php $get_tools_type_tools = get_tools_determinater2('LockTech', 'Ignition Removal');
					foreach( $get_tools_type_tools as $tools){?>
						<option value="<?php echo $tools['UUID'];?>"><?php echo $tools['Tool_Name'];?></option>
					<?php }	?>                    
                  </select>
                </div>
              </div>
            </div>-->
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">A1 Auto Picks</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="A1AutoPicks_UUID">
                    <option value="">Select A1 Auto Picks</option>
                    <?php $get_tools_type_tools = get_tools_determinater2('A1 Security', 'Ignition Removal');
					foreach( $get_tools_type_tools as $tools){
						if( $getCodeSeries[0]['A1AutoPicks_UUID'] ==  $tools['UUID']){
							$selected = 'selected';
						}else{
							$selected = '';
						}
						?>
						<option value="<?php echo $tools['UUID'];?>" <?php echo $selected;?> ><?php echo $tools['Tool_Name'];?></option>
					<?php }	?>                    
                  </select>
                </div>
              </div>
            </div>
            
           	 <div class="TryOutKeysData">
             	<?php 
					$try_out_keys_array  = explode(',',$getCodeSeries[0]['TryOutKeys_UUID']);
					for($tr = 0; $tr < count($try_out_keys_array); $tr++){
						//$get_toolType_by_uuid = get_toolName_by_uuid($try_out_keys_array[$tr]);
						//echo $get_toolType_by_uuid[0]['Tool_Name'].'<br>';?>
                        <div class="row">
                          <div class="col-xs-10 col-sm-11">
                            <div class="labelcol">
                              <label class="control-label">Try-Out Keys</label>
                            </div>
                          </div>
                          <div class="col-xs-14 col-sm-13">
                            <div class="inputcol">
                              <select class="form-control select-field" name="TryOutKeys_UUID[]">
                                <option value="">Select Try-Out Keys</option>
                                <?php $get_tools_type_tools = get_tools_type_tools('Try-Out Keys');
                                foreach( $get_tools_type_tools as $tools){
                                    if( $try_out_keys_array[$tr]  ==  $tools['UUID']){
                                        $selected = 'selected';
                                    }else{
                                        $selected = '';
                                    }							
                                    ?>
                                    <option value="<?php echo $tools['UUID'];?>" <?php echo $selected;?>><?php echo $tools['Tool_Name'];?></option>
                                <?php }	?>                    
                              </select>
                            </div>
                          </div>
                        </div>
				<?php }	?>             	
             </div>     
            <a href="javascript:void(0)" class="pull-right addAnotherTryOutKey"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Another Try-Out Keys</a>
          </div>
          <div class="col-sm-12 col-md-16">
           <fieldset>
              <legend>HPC Blitz</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Card</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="HPC_Blitz_Card" value="<?php echo $getCodeSeries[0]['HPC_Blitz_Card'];?>">
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                   
                    <select class="form-control select-field" name="HPC_Blitz_Cutter">
                        <option value="">Select Cutter</option>
                        <?php $get_t_machines_info = get_t_machines_info('HPC Cutter');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['HPC_Blitz_Cutter'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>> <?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Position</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                    <select class="form-control select-field" name="HPC_Blitz_Position">
                        <option value="">Select Position</option>
                        <?php $get_t_machines_info = get_t_machines_info('HPC Position');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['HPC_Blitz_Position'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="HPC_Blitz_Side" value="<?php echo $getCodeSeries[0]['HPC_Blitz_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Silca Card</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Silca_Card" value="<?php echo $getCodeSeries[0]['Silca_Card'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Silca Cutter</label>
                    
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                   
                    <select class="form-control select-field" name="Silca_Cutter">
                        <option value="">Select Silca Cutter</option>
                        <?php $get_t_machines_info = get_t_machines_info('Silca Cutter');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['Silca_Cutter'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Notes</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <textarea name="HPC_Blitz_Notes"> <?php echo $getCodeSeries[0]['HPC_Blitz_Notes'];?></textarea>
                  </div>
                </div>
              </div>
             </fieldset>
             <fieldset>
              <legend>HPC Punch</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Card</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="HPC_Punch_Card" value="<?php echo $getCodeSeries[0]['HPC_Punch_Card'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Punch</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                    <select class="form-control select-field" name="HPC_Punch_Punch">
                        <option value="">Select Punch</option>
                        <?php $get_t_machines_info = get_t_machines_info('HPC Punch');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['HPC_Punch_Punch'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="HPC_Punch_Side" value="<?php echo $getCodeSeries[0]['HPC_Punch_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Notes</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <textarea name="HPC_Punch_Notes"><?php echo $getCodeSeries[0]['HPC_Punch_Notes'];?></textarea>
                  </div>
                </div>
              </div>
             </fieldset>
             <fieldset>
              <legend>HPC CodeMax</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">DSD</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="HPC_CodeMax_DSD" value="<?php echo $getCodeSeries[0]['HPC_CodeMax_DSD'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="HPC_CodeMax_Side" value="<?php echo $getCodeSeries[0]['HPC_CodeMax_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Position </label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                    <select class="form-control select-field" name="HPC_CodeMax_Position">
                        <option value="">Select Position</option>
                        <?php $get_t_machines_info = get_t_machines_info('HPC Position');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['HPC_CodeMax_Position'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                    <select class="form-control select-field" name="HPC_CodeMax_Cutter">
                        <option value="">Select Cutter</option>
                        <?php $get_t_machines_info = get_t_machines_info('HPC Cutter');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['HPC_CodeMax_Cutter'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Notes</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <textarea name="HPC_CodeMax_Notes"><?php echo $getCodeSeries[0]['HPC_CodeMax_Notes'];?></textarea>
                  </div>
                </div>
              </div>
             </fieldset>
             <fieldset>
              <legend>ITL</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">ID</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="ITL_ID" value="<?php echo $getCodeSeries[0]['ITL_ID'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Insert </label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="ITL_Insert" value="<?php echo $getCodeSeries[0]['ITL_Insert'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Notes</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <textarea name="ITL_Notes"><?php echo $getCodeSeries[0]['ITL_Notes'];?></textarea>
                  </div>
                </div>
              </div>
             </fieldset>
             <fieldset>
              <legend>Curtis</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Cam Set</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Curtis_CamSet" value="<?php echo $getCodeSeries[0]['Curtis_CamSet'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Carriage</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Curtis_Carriage" value="<?php echo $getCodeSeries[0]['Curtis_Carriage'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Curtis_Cutter" value="<?php echo $getCodeSeries[0]['Curtis_Cutter'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Notes</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Curtis_Notes" value="<?php echo $getCodeSeries[0]['Curtis_Notes'];?>">
                  </div>
                </div>
              </div>
             </fieldset>
             <fieldset>
              <legend>Keyline Ninja</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Vice</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                   
                    <select class="form-control select-field" name="Keyline_Ninja_Vice">
                        <option value="">Select Vice</option>
                        <?php $get_t_machines_info = get_t_machines_info('Ninja Vise');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['Keyline_Ninja_Vice'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Keyline_Ninja_Side" value="<?php echo $getCodeSeries[0]['Keyline_Ninja_Side'];?>">  
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Position</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Keyline_Ninja_Position" value="<?php echo $getCodeSeries[0]['Keyline_Ninja_Position'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                   
                    <select class="form-control select-field" name="Keyline_Ninja_Cutter">
                        <option value="">Select Cutter</option>
                        <?php $get_t_machines_info = get_t_machines_info('Ninja Cutter');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['Keyline_Ninja_Cutter'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
             </fieldset>
             <fieldset>
              <legend>A1 Pak-A-Punch</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">QC Kit</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                    <select class="form-control select-field" name="Pak_QCKit">
                        <option value="">Select QC Kit</option>
                        <?php $get_t_machines_info = get_t_machines_info('Pak-A-Punch QC Kit');
                        foreach( $get_t_machines_info as $options){
							if( ($getCodeSeries[0]['Pak_QCKit'] ==  $options['UUID']) || ($getCodeSeries[0]['Pak_QCKit'] ==  $options['Name']) ){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Vise</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Pak_Vise" value="<?php echo $getCodeSeries[0]['Pak_Vise'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Punch</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                    <select class="form-control select-field" name="Pak_Punch">
                        <option value="">Select Punch</option>
                        <?php $get_t_machines_info = get_t_machines_info('Pak-A-Punch Punch');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['Pak_Punch'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Die</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                    <select class="form-control select-field" name="Pak_Die">
                        <option value="">Select Die</option>
                        <?php $get_t_machines_info = get_t_machines_info('Pak-A-Punch Die');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['Pak_Die'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
             </fieldset>
             <fieldset>
              <legend>Framon</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Block</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Framon_Block" value="<?php echo $getCodeSeries[0]['Framon_Block'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                     <select class="form-control select-field" name="Framon_Cutter">
                        <option value="">Select Cutter</option>
                        <?php $get_t_machines_info = get_t_machines_info('Framon Cutter');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['Framon_Cutter'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">First Cut</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Framon_FirstCut" value="<?php echo $getCodeSeries[0]['Framon_FirstCut'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Between Cuts</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Framon_BetweenCuts" value="<?php echo $getCodeSeries[0]['Framon_BetweenCuts'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Notes</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Framon_Notes" value="<?php echo $getCodeSeries[0]['Framon_Notes'];?>">
                  </div>
                </div>
              </div>
             </fieldset>
             <fieldset>
              <legend>Sidewinder 2</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Space Rod</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="SW2_SpaceRod" value="<?php echo $getCodeSeries[0]['SW2_SpaceRod'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Depth Rod</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="SW2_DepthRod" value="<?php echo $getCodeSeries[0]['SW2_DepthRod'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                    <select class="form-control select-field" name="SW2_Cutter">
                        <option value="">Select Cutter</option>
                        <?php $get_t_machines_info = get_t_machines_info('SW2 Cutter');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['SW2_Cutter'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Guide</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                   
                    <select class="form-control select-field" name="SW2_Guide">
                        <option value="">Select Guide</option>
                        <?php $get_t_machines_info = get_t_machines_info('SW2 Guide');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['SW2_Guide'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Vise Set</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="SW2_ViseSet" value="<?php echo $getCodeSeries[0]['SW2_ViseSet'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Stop</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                     <select class="form-control select-field" name="SW2_Stop">
                        <option value="">Select Stop</option>
                        <?php $get_t_machines_info = get_t_machines_info('SW2 Stop');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['SW2_Stop'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
             </fieldset>
             <fieldset>
              <legend>LKP 3D Xtreme</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">DSD</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="LKP_3DX_DSD" value="<?php echo $getCodeSeries[0]['LKP_3DX_DSD'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class=" col-sm-4 ">
                  <div class="labelcol">
                    <label class="control-label">Jaw</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <select  class="form-control"  name="LKP_3DX_Jaw">
                    <option value="">Select Jaw</option>
                        <?php $get_t_machines_info = get_t_machines_info('3DX Jaw');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['LKP_3DX_Jaw'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class=" col-sm-4 ">
                  <div class="labelcol">
                    <label class="control-label">Jaw Clamp</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <select  class="form-control"  name="LKP_3DX_JawClamp">
                    <option value="">Select Jaw Clamp</option>
                        <?php $get_t_machines_info = get_t_machines_info('3DX Jaw Clamp');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['LKP_3DX_JawClamp'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class=" col-sm-4 ">
                  <div class="labelcol">
                    <label class="control-label">Stop </label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <select class="form-control" name="LKP_3DX_Stop">
                     <option value="">Select Stop</option>
                        <?php $get_t_machines_info = get_t_machines_info('3DX Stop');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['LKP_3DX_Stop'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                    </select>
                  </div>
                </div>
              </div> 
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                    
                      <select class="form-control select-field" name="LKP_3DX_Cutter">
                        <option value="">Select Cutter</option>
                        <?php $get_t_machines_info = get_t_machines_info('3DX Cutter');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['LKP_3DX_Cutter'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>  
              <div class="row">
                <div class=" col-sm-4 ">
                  <div class="labelcol">
                    <label class="control-label">Notes</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <textarea name="LKP_3DX_Notes"><?php echo $getCodeSeries[0]['LKP_3DX_Notes'];?></textarea>
                  </div>
                </div>
              </div>         
             </fieldset>
             <fieldset>
              <legend>Keyline 994</legend>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Vise</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                   
                    <select class="form-control select-field" name="Keyline_994_Vise">
                        <option value="">Select Vise</option>
                        <?php $get_t_machines_info = get_t_machines_info('994 Vise');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['Keyline_994_Vise'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Keyline_994_Side" value="<?php echo $getCodeSeries[0]['Keyline_994_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Position</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Keyline_994_Position" value="<?php echo $getCodeSeries[0]['Keyline_994_Position'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">                   
                    <select class="form-control select-field" name="Keyline_994_Cutter">
                        <option value="">Select Cutter</option>
                        <?php $get_t_machines_info = get_t_machines_info('994 Cutter');
                        foreach( $get_t_machines_info as $options){
							if( $getCodeSeries[0]['Keyline_994_Cutter'] ==  $options['UUID']){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?>><?php echo $options['Name'];?></option>
                        <?php }	?>                    
                      </select>
                  </div>
                </div>
              </div>           
             </fieldset>
             <fieldset>
              <legend>Silca Futura</legend>
              
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">SSN</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Silca_Futura_SSN" value="<?php echo $getCodeSeries[0]['Silca_Futura_SSN'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Card</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" placeholder="" name="Silca_Futura_Card" value="<?php echo $getCodeSeries[0]['Silca_Futura_Card'];?>">
                  </div>
                </div>
              </div>                         
             </fieldset>
             <fieldset>
               <legend>Condor XC Mini</legend>              
              <div class="row">
                <div class=" col-sm-4 ">
                  <div class="labelcol">
                    <label class="control-label">Key Name</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control" value="<?php echo $getCodeSeries[0]['Condor_KeyName'];?>" name="Condor_KeyName">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class=" col-sm-4 ">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <select class="form-control" name="Condor_Cutter">
                    <option value="">Please Select</option>
                        <?php $get_t_machines_info = get_t_machines_info('Condor Cutter');
                        foreach( $get_t_machines_info as $options){
                          if( $getCodeSeries[0]['Condor_Cutter'] ==  $options['UUID']){
                              $selected = 'selected';
                            }else{
                              $selected = '';
                            }?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?> ><?php echo $options['Name'];?></option>
                        <?php } ?> 
                    </select>    
                    </div>    
                  </div>
                </div>
                <div class="row">
                <div class=" col-sm-4 ">
                  <div class="labelcol">
                    <label class="control-label">Jaw</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <select class="form-control" name="Condor_Jaw">
                    <option value="">Please Select</option>
                        <?php $get_t_machines_info = get_t_machines_info('Condor Jaw');
                        foreach( $get_t_machines_info as $options){
                          if( $getCodeSeries[0]['Condor_Jaw'] ==  $options['UUID']){
                              $selected = 'selected';
                            }else{
                              $selected = '';
                            }?>
                            <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?> ><?php echo $options['Name'];?></option>
                        <?php } ?> 
                    </select>  
                    </div>    
                  </div>
                </div>
                <div class="row">
                  <div class=" col-sm-4 ">
                    <div class="labelcol">
                      <label class="control-label">Jaw Side</label>
                    </div>
                  </div>
                  <div class="col-xs-14 col-sm-13 col-md-8">
                    <div class="inputcol">
                      <select class="form-control" name="Condor_JawSide">
                      <option value="">Please Select</option>
                          <?php $get_t_machines_info = get_t_machines_info('Condor Side');
                          foreach( $get_t_machines_info as $options){
                            if( $getCodeSeries[0]['Condor_JawSide'] ==  $options['UUID']){
                              $selected = 'selected';
                            }else{
                              $selected = '';
                            }?>
                              <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?> ><?php echo $options['Name'];?></option>
                          <?php } ?> 
                      </select>  
                      </div>    
                    </div>
                </div>
                <div class="row">
                  <div class=" col-sm-4 ">
                    <div class="labelcol">
                      <label class="control-label">Stop</label>
                    </div>
                  </div>
                  <div class="col-xs-14 col-sm-13 col-md-8">
                    <div class="inputcol">
                      <select class="form-control" name="Condor_Stop">
                      <option value="">Please Select</option>
                          <?php $get_t_machines_info = get_t_machines_info('Condor Stop');
                          foreach( $get_t_machines_info as $options){
                            if( $getCodeSeries[0]['Condor_Stop'] ==  $options['UUID']){
                              $selected = 'selected';
                            }else{
                              $selected = '';
                            }?>
                              <option value="<?php echo $options['UUID'];?>" <?php echo $selected;?> ><?php echo $options['Name'];?></option>
                          <?php } ?> 
                      </select>  
                      </div>    
                    </div>
                </div>
                <div class="row">
                  <div class=" col-sm-4 ">
                    <div class="labelcol">
                      <label class="control-label">Notes</label>
                    </div>
                  </div>
                  <div class="col-xs-14 col-sm-13 col-md-8">
                    <div class="inputcol">
                      <textarea class="form-control" name="Condor_Notes"><?php echo $getCodeSeries[0]['Condor_Notes'];?></textarea>  
                      </div>    
                    </div>
                </div>
              </div>                         
          </fieldset>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-xs-8 col-sm-10 col-md-6">
            <div class="labelcol">
              <label class="control-label"></label>
            </div>
          </div>
          <div class="col-md-12">
            <button type="sumit" class="btn btn-primary" name="post">Submit</button>
            <a href="<?php echo adm_base_url();?>/vehicles/codeseries" class="btn btn-danger">Cancel</a>
          </div>
        </div>
       </form>
  </div>
  </div>
</div>
