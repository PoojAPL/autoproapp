<?php 
$procedure_num = $procedure+1;
?>
<fieldset>
    <legend>PROCEDURE </legend> 
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Step #</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
          <input type="number" class="form-control" name="Sort_Order[]" value="1"  />
        </div>
      </div>
    </div> 
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Category</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
          <select class="form-control select_obp_category" name="category">
            <option value="">Select category</option>
            <?php foreach($obp_option_categories as $type){?>
            <option value="<?php echo $type['UUID'];?>"><?php echo $type['Name'];?></option>
        <?php } ?>
          </select>
        </div>
      </div>
    </div> 
    <div class="get_default_image_data"></div> 
    <div class="get_default_image_uuid_data"></div> 
    <div class="getImageDeafultText"></div>
    <input type="hidden" name="Procedure_Number[]" value="<?php echo $procedure_num;?>"  />
    <span class="glyphicon glyphicon-remove removeProcedure" aria-hidden="true" style="margin-left: 57%;"></span>            
</fieldset>