<div class="get_obp_remote_vehicle">
 <fieldset>
    <legend>VEHICLE</legend>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Make</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
          <select class="form-control select_obp_more_Models" name="Make_UUID">
            <option value="">Select make</option>
            <?php foreach($getAllMakeNames as $makes){?>
                <option value="<?php echo $makes['UUID'];?>"><?php echo $makes['Make_Name'];?></option>
            <?php  } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Model</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol get_more_Models">
          <select class="form-control" name="Model_UUID">
            <option value="">Select model</option>            
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Vehicle</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol getMoreVehicles">
          <select class="form-control" name="Vehicle_UUID">
            <option value="">Select vehicle</option>                    
          </select>
        </div>
      </div>
    </div>
    <span class="glyphicon glyphicon-remove remove_obp_vehcile" aria-hidden="true"></span>
  </fieldset> 
</div>