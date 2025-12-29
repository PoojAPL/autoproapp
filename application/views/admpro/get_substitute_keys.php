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
          <?php foreach($result as $chips){ ?>
          <option value="<?php echo $chips['UUID'];?>"><?php echo $chips['Key_Name'];?></option>
          <?php } ?>
     </select>
    </div>
  </div>
</div>
