<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form class="site-form " method ="post" action="<?php echo adm_base_url();?>/autopropad/save_applications" id="applicationForm">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
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
                    <?php foreach($getAllMakeNames as $makes){?>
                        <option value="<?php echo $makes['UUID'];?>"><?php echo $makes['Make_Name'];?></option>
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
                  <input type="text" class="form-control" name="Year">
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
                  <input type="text" class="form-control" name="System">
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
                  <input type="text" class="form-control" name="PinRead">
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
                  <input type="text" class="form-control" name="PinReadPossible">
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
                  <input type="text" class="form-control" name="10MinBypass">
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
                  <input type="text" class="form-control" name="PinCalculate">
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
                  <input type="text" class="form-control" name="ProgramMaster">
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
                  <input type="text" class="form-control" name="ProgramValet">
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
                  <input type="text" class="form-control" name="AllKeysLost">
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
                  <input type="text" class="form-control" name="AddKey">
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
                  <input type="text" class="form-control" name="EraseKey">
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
                  <input type="text" class="form-control" name="AddRemote">
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
                  <input type="text" class="form-control" name="EraseRemote">
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
                  <textarea class="form-control" name="Notes" style="height: 60px;"> </textarea>
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
                 <input type="text" class="form-control" name="ResetProx">
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
                  <input type="text" class="form-control" name="ResetFunction">
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
                  <input type="text" class="form-control" name="ReplaceFunction">
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
                  <input type="text" class="form-control" name="KeyInfo">
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
         			<input type="text" class="form-control" name="FobInfo">
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
                  <input type="text" class="form-control" name="MaxKeys">
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
                  <input type="text" class="form-control" name="ProgramType">
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
                  <input type="text" class="form-control" name="RegisterSmartAccess">
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
                  <input type="text" class="form-control" name="IdEngStartBox">
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
                  <input type="text" class="form-control" name="IdRegSmartBox">
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
                  <input type="text" class="form-control" name="SpecialFunction">
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
                  <input type="text" class="form-control" name="2KeysRequired">
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
         			<input type="text" class="form-control" name="Reusable" >
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
                  <input type="text" class="form-control" name="ComponentsMatch">
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
                  <input type="text" class="form-control" name="Possible">
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
                  <input type="text" class="form-control" name="Needed">
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
                        foreach($application_testing as $testing){?>
                            <option value="<?php echo $testing;?>"><?php echo $testing;?></option>
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
