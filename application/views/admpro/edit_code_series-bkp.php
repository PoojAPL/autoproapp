<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box code-series-page">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form "  method ="post"  action="<?php echo adm_base_url();?>/vehicles/update_code_series" >
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
  		<input type="hidden" name="code_series_id" value="<?php echo $id;?>" />
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
            <div class="row">
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
                  <label class="control-label">Determinater</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="determinator_uuid">
                    <option value="">Select Determinater</option>
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
                 <select class="form-control select-field" name="lishi_uuid">
                    <option value="">Select lishi</option>
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
                  <select class="form-control select-field" name="accu_reader_uuid">
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
                  <select class="form-control select-field" name="eez_reader_uuid">
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
                  <label class="control-label">Space & Depth keys</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="sd_keys_uuid">
                    <option value="">Select Space & Depth keys</option>
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
            </div>
            <div class="row">
              <div class="col-xs-10 col-sm-11">
                <div class="labelcol">
                  <label class="control-label">A1 Auto Picks</label>
                </div>
              </div>
              <div class="col-xs-14 col-sm-13">
                <div class="inputcol">
                  <select class="form-control select-field" name="A1_Auto_Picks">
                    <option value="">Select A1 Auto Picks</option>
                    <?php $get_tools_type_tools = get_tools_determinater2('A1 Security', 'Ignition Removal');
					foreach( $get_tools_type_tools as $tools){?>
						<option value="<?php echo $tools['UUID'];?>"><?php echo $tools['Tool_Name'];?></option>
					<?php }	?>                    
                  </select>
                </div>
              </div>
            </div>
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
							if( $getCodeSeries[0]['TryOutKeys_UUID'] ==  $tools['UUID']){
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
           	 <div class="TryOutKeysData"></div>     
            <a href="javascript:void(0)" class="pull-right addAnotherTryOutKey"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Another Try-Out Keys</a>
          </div>
          <div class="col-sm-12 col-md-16">
            <article class="form_boxart">
              <h2>HPC Blitz</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Card</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_Blitz_Card" value="<?php echo $getCodeSeries[0]['HPC_Blitz_Card'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_Blitz_Cutter" value="<?php echo $getCodeSeries[0]['HPC_Blitz_Cutter'];?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Position</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_Blitz_Position" value="<?php echo $getCodeSeries[0]['HPC_Blitz_Position'];?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_Blitz_Side" value="<?php echo $getCodeSeries[0]['HPC_Blitz_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Silca Card</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Silca_Card" value="<?php echo $getCodeSeries[0]['Silca_Card'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Silca Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Silca_Cutter" value="<?php echo $getCodeSeries[0]['Silca_Cutter'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Notes</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <textarea name="HPC_Blitz_Notes"><?php echo $getCodeSeries[0]['HPC_Blitz_Notes'];?></textarea>
                  </div>
                </div>
              </div>
            </article>
            <article class="form_boxart">
              <h2>HPC Punch</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Card</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_Punch_Card" value="<?php echo $getCodeSeries[0]['HPC_Punch_Card'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Punch</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_Punch_Punch" value="<?php echo $getCodeSeries[0]['HPC_Punch_Punch'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_Punch_Side" value="<?php echo $getCodeSeries[0]['HPC_Punch_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
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
            </article>
            <article class="form_boxart">
              <h2>HPC CodeMax</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">DSD</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_CodeMax_DSD" value="<?php echo $getCodeSeries[0]['HPC_CodeMax_DSD'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_CodeMax_Side" value="<?php echo $getCodeSeries[0]['HPC_CodeMax_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Position </label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_CodeMax_Position" value="<?php echo $getCodeSeries[0]['HPC_CodeMax_Position'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="HPC_CodeMax_Cutter" value="<?php echo $getCodeSeries[0]['HPC_CodeMax_Cutter'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
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
            </article>
            <article class="form_boxart">
              <h2>ITL</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">ID</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="ITL_ID" value="<?php echo $getCodeSeries[0]['ITL_ID'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Insert </label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="ITL_Insert" value="<?php echo $getCodeSeries[0]['ITL_Insert'];?>" >
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
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
            </article>
            <article class="form_boxart">
              <h2>Curtis</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Cam Set</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Curtis_CamSet" value="<?php echo $getCodeSeries[0]['Curtis_CamSet'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Carriage</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Curtis_Carriage" value="<?php echo $getCodeSeries[0]['Curtis_Carriage'];?>">
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-xs-10 col-sm-11 col-md-6">
                    <div class="labelcol">
                      <label class="control-label">Cutter</label>
                    </div>
                  </div>
                  <div class="col-xs-14 col-sm-13 col-md-8">
                    <div class="inputcol">
                      <input type="text" class="form-control"  name="Curtis_Cutter" value="<?php echo $getCodeSeries[0]['Curtis_Cutter'];?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-10 col-sm-11 col-md-6">
                    <div class="labelcol">
                      <label class="control-label">Notes</label>
                    </div>
                  </div>
                  <div class="col-xs-14 col-sm-13 col-md-8">
                    <div class="inputcol">
                      <input type="text" class="form-control"  name="Curtis_Notes" value="<?php echo $getCodeSeries[0]['Curtis_Notes'];?>">
                    </div>
                  </div>
                </div>
            </article>
            <article class="form_boxart">
              <h2>Keyline Ninja</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Vice</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Keyline_Ninja_Vice" value="<?php echo $getCodeSeries[0]['Keyline_Ninja_Vice'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Keyline_Ninja_Side" value="<?php echo $getCodeSeries[0]['Keyline_Ninja_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Position</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Keyline_Ninja_Position" value="<?php echo $getCodeSeries[0]['Keyline_Ninja_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Keyline_Ninja_Cutter" value="<?php echo $getCodeSeries[0]['Keyline_Ninja_Cutter'];?>">
                  </div>
                </div>
              </div>
            </article>
            <article class="form_boxart">
              <h2>A1 PAK-A-Punch</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">QCKit</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Pak_QCKit" value="<?php echo $getCodeSeries[0]['Pak_QCKit'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Vise</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Pak_Vise" value="<?php echo $getCodeSeries[0]['Pak_Vise'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Punch</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Pak_Punch" value="<?php echo $getCodeSeries[0]['Pak_Punch'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Die</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Pak_Die" value="<?php echo $getCodeSeries[0]['Pak_Die'];?>">
                  </div>
                </div>
              </div>
            </article>
            <article class="form_boxart">
              <h2>Framon</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Block</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Framon_Block" value="<?php echo $getCodeSeries[0]['Framon_Block'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Framon_Cutter" value="<?php echo $getCodeSeries[0]['Framon_Cutter'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">First Cut</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Framon_FirstCut" value="<?php echo $getCodeSeries[0]['Framon_FirstCut'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Between Cuts</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Framon_BetweenCuts" value="<?php echo $getCodeSeries[0]['Framon_BetweenCuts'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Notes</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Framon_Notes" value="<?php echo $getCodeSeries[0]['Framon_Notes'];?>">
                  </div>
                </div>
              </div>
            </article>
            <article class="form_boxart">
              <h2>Sidewinder 2</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Space Rod</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="SW2_SpaceRod" value="<?php echo $getCodeSeries[0]['SW2_SpaceRod'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Depth Rod</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="SW2_DepthRod" value="<?php echo $getCodeSeries[0]['SW2_DepthRod'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="SW2_Cutter" value="<?php echo $getCodeSeries[0]['SW2_Cutter'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Guide</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="SW2_Guide" value="<?php echo $getCodeSeries[0]['SW2_Guide'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Vise Set</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="SW2_ViseSet" value="<?php echo $getCodeSeries[0]['SW2_ViseSet'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Stop</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="SW2_Stop"  value="<?php echo $getCodeSeries[0]['SW2_Stop'];?>">
                  </div>
                </div>
              </div>
            </article>
            <article class="form_boxart">
              <h2>LKP 3D Xtreme</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">DSD</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="LKP_3DX_DSD" value="<?php echo $getCodeSeries[0]['LKP_3DX_DSD'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Jaw</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="LKP_3DX_Jaw" value="<?php echo $getCodeSeries[0]['LKP_3DX_Jaw'];?>">
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="LKP_3DX_Cutter" value="<?php echo $getCodeSeries[0]['LKP_3DX_Cutter'];?>">
                  </div>
                </div>
              </div>           
            </article>
            <article class="form_boxart">
              <h2>Keyline 994</h2>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Vise</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Keyline_994_Vise" value="<?php echo $getCodeSeries[0]['Keyline_994_Vise'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Side</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Keyline_994_Side" value="<?php echo $getCodeSeries[0]['Keyline_994_Side'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Position</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Keyline_994_Position" value="<?php echo $getCodeSeries[0]['Keyline_994_Position'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Cutter</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Keyline_994_Cutter" value="<?php echo $getCodeSeries[0]['Keyline_994_Cutter'];?>">
                  </div>
                </div>
              </div>           
            </article>
            <article class="form_boxart">
              <h2>Silca Futura</h2>
              
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">SSN</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Silca_Futura_SSN" value="<?php echo $getCodeSeries[0]['Silca_Futura_SSN'];?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-10 col-sm-11 col-md-6">
                  <div class="labelcol">
                    <label class="control-label">Card</label>
                  </div>
                </div>
                <div class="col-xs-14 col-sm-13 col-md-8">
                  <div class="inputcol">
                    <input type="text" class="form-control"  name="Silca_Futura_Card" value="<?php echo $getCodeSeries[0]['Silca_Futura_Card'];?>">
                  </div>
                </div>
              </div>                         
            </article>
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
