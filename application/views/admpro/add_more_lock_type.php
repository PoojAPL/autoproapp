
      <div class="row row-holder"> 
       <div class="col-sm-4">
            <div class="labelcol">
              <label class="control-label">Lock Type</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <select class="form-control"  name="lock_type[]" >
                  <?php 
                  $get_lock_Type = get_lock_types();
                  foreach($get_lock_Type as $lock){ ?>
                  <option value="<?php echo $lock;?>"><?php echo $lock;?></option>
                  <?php } ?>
             </select>
             <span class="glyphicon glyphicon-remove removeLockType" aria-hidden="true"></span>
            </div>
          </div>          
      </div>