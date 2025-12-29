<div class="row">
  <div class=" col-sm-4 ">
    <div class="labelcol">
      <label class="control-label">Selection</label>
    </div>
  </div>
  <div class="col-sm-10">
    <div class="inputcol">
      <select class="form-control select_image_uuid" name="selection">
        <option value="">Select</option>
         <?php 		   
		  foreach($get_obp_ptions as $obp_options){?>
		  <option value="<?php echo $obp_options['UUID'];?>">
				<?php echo $obp_options['Default_Text'];?> 
		   </option>
		  <?php } ?>
      </select>
    </div>
  </div>
</div>