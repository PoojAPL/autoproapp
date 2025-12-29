<div class="series_holder">
    <div class="inputcol">
      <select class="custom_input" name="Code_Series_UUID[]">
          <option value="">Select Code Series</option>
          <?php foreach($get_t_code_series as $code_s){?>
              <option value="<?php echo $code_s['UUID'];?>"><?php echo $code_s['Code_Series_Name'];?></option>
          <?php  } ?>
        </select>
        <input type="text" name="code_note[]" class="custom_input" placeholder="(Note)" />
    </div>
<span class="glyphicon glyphicon-remove remove_series_holder" aria-hidden="true"></span>
<div class="clearfix"></div>
</div>
