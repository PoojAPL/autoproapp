<div class="clone-with-holder">
      <div class="inputcol">
       <select class="form-control" name="Tool_Type_UUID[]">
          <option value="">Select Tool Type</option>
          <?php foreach($getAllToolType as $tool_type){?>
              <option value="<?php echo $tool_type['UUID'];?>"><?php echo $tool_type['Tool_Type_Name'];?></option>
          <?php } ?>
       </select>
       <span class="glyphicon glyphicon-remove removeMoreToolType" aria-hidden="true"></span>
   </div>
</div>