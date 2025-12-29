<div class="row tryout_keys_row">
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
                foreach( $get_tools_type_tools as $tools){?>
        <option value="<?php echo $tools['UUID'];?>"><?php echo $tools['Tool_Name'];?></option>
        <?php }	?>
      </select>
    </div>
  </div>
  <a href="javascript:void(0)" class="pull-right removeTryOutKey"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
</div>
