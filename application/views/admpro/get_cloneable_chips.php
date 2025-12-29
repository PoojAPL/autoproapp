<div class="clone-with-holder">
      <div class="inputcol">
       <select type="text" class="form-control" name="Clone_With[]">
          <option value="">Please select</option>
          <?php $get_clonabnle_chips = get_clonabnle_chips();
          foreach($get_clonabnle_chips as $chips){?>
              <option value="<?php echo $chips['Chip_Name'];?>"><?php echo $chips['Chip_Name'];?></option>
          <?php } ?>
       </select>
       <span class="glyphicon glyphicon-remove removeMoreCloneWith" aria-hidden="true"></span>
   </div>
</div>