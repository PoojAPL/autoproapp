<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form class="site-form " method ="post" action="<?php echo adm_base_url();?>/autopropad/update_applications" id="applicationForm">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
      <input type="hidden" name="id" value="<?php echo $id; ?>"  />
        <div class="row">
          <div class="col-sm-12">
          	<div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label" >Make</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                 <select class="form-control selectPartsModels makes" name="Make">
                    <option value="">Select make</option>
                    <?php foreach($getAllMakeNames as $makes){
						if($get_applications_info[0]['Make'] == $makes['Make_Name']){
							$selected = 'selected';
							$make_uuid = $makes['UUID'];
						}else{
							$selected = '';	
						}?>
                        <option value="<?php echo $makes['UUID'];?>" <?php echo $selected;?>><?php echo $makes['Make_Name'];?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
            </div>  
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Model</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol getModels">
                  <select class="form-control models" name="Model_UUID">
                    <option value="">Select model</option>
					<?php $get_model_makes =  get_model_makes($make_uuid);
                    foreach($get_model_makes as $models){
                        if($get_applications_info[0]['Model'] == $models['Model_Name']){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                        ?>
                        <option value="<?php echo $models['UUID'];?>" <?php echo $selected;?>> <?php echo $models['Model_Name'];?></option>	
                    <?php }	?>
                  </select>                           
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Year</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="Year" value="<?php echo $get_applications_info[0]['Year'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">System</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="System" value="<?php echo $get_applications_info[0]['System'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Pin Required</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">        
         			<input type="radio" name="PinRequired" value="Yes" checked="checked"> Yes  &nbsp;&nbsp;
                    <input type="radio" name="PinRequired" value="No"> No
       			</div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Pin Read</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="PinRead" value="<?php echo $get_applications_info[0]['PinRead'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Pin Read Possible</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="PinReadPossible" value="<?php echo $get_applications_info[0]['PinReadPossible'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">10 Min Bypass</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="PinCalculate" value="<?php echo $get_applications_info[0]['10MinBypass'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Pin Calculate</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="PinCalculate" value="<?php echo $get_applications_info[0]['PinCalculate'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Program Master</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="ProgramMaster" value="<?php echo $get_applications_info[0]['ProgramMaster'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Program Valet</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="ProgramValet" value="<?php echo $get_applications_info[0]['ProgramValet'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">All Keys Lost</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="AllKeysLost" value="<?php echo $get_applications_info[0]['AllKeysLost'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Add Key</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="AddKey" value="<?php echo $get_applications_info[0]['AddKey'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Erase Key</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="EraseKey" value="<?php echo $get_applications_info[0]['EraseKey'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Add Remote</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="AddRemote" value="<?php echo $get_applications_info[0]['AddRemote'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Erase Remote</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="EraseRemote" value="<?php echo $get_applications_info[0]['EraseRemote'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Notes</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <textarea class="form-control" name="Notes" style="height: 60px;"><?php echo $get_applications_info[0]['Notes'];?> </textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
          	<div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label" >Reset Prox</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                 <input type="text" class="form-control" name="ResetProx" value="<?php echo $get_applications_info[0]['ResetProx'];?>">
                </div>
              </div>
            </div>  
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Reset Function</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="ResetFunction" value="<?php echo $get_applications_info[0]['ResetFunction'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Replace Function</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="ReplaceFunction" value="<?php echo $get_applications_info[0]['ReplaceFunction'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">KeyInfo</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="KeyInfo" value="<?php echo $get_applications_info[0]['KeyInfo'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Fob Info</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">        
         			<input type="text" class="form-control" name="FobInfo" value="<?php echo $get_applications_info[0]['FobInfo'];?>">
       			</div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Max Keys</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="MaxKeys" value="<?php echo $get_applications_info[0]['MaxKeys'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Program Type</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="ProgramType" value="<?php echo $get_applications_info[0]['ProgramType'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Register Smart Access</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="RegisterSmartAccess" value="<?php echo $get_applications_info[0]['RegisterSmartAccess'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">IdEng StartBox</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="IdEngStartBox" value="<?php echo $get_applications_info[0]['IdEngStartBox'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">IdReg SmartBox</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="IdRegSmartBox" value="<?php echo $get_applications_info[0]['IdRegSmartBox'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Special Function</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="SpecialFunction" value="<?php echo $get_applications_info[0]['SpecialFunction'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">2Keys Required</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="2KeysRequired" value="<?php echo $get_applications_info[0]['2KeysRequired'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Reusable</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <div class="inputcol">        
         			<input type="text" class="form-control" name="Reusable" value="<?php echo $get_applications_info[0]['Reusable'];?>">
       			</div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Components Match</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="ComponentsMatch" value="<?php echo $get_applications_info[0]['ComponentsMatch'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Possible</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="Possible" value="<?php echo $get_applications_info[0]['Possible'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Needed</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <input type="text" class="form-control" name="Needed" value="<?php echo $get_applications_info[0]['Needed'];?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-6">
                <div class="labelcol">
                  <label class="control-label">Testing</label>
                </div>
              </div>
              <div class="col-sm-18">
                <div class="inputcol">
                  <select type="text" class="form-control" name="Testing">
                    <option value=""></option>
                    <?php $application_testing = application_testing();
                        foreach($application_testing as $testing){
                            if($get_applications_info[0]['Testing'] == $testing){
                                $selected = 'selected';
                            }else{
                                $selected = '';	
                            }?>
                            <option value="<?php echo $testing;?>" <?php echo $selected;?>><?php echo $testing;?></option>
                    <?php	}   ?>
                </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class=" col-sm-1 ">
            <div class="labelcol">
              <label class="control-label"></label>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-success" name="post">Submit</button>
            <a href="<?php echo adm_base_url();?>/autopropad/applications" class="btn btn-danger">Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>
