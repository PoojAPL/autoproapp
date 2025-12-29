<div class="container-fluid">  
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form" method ="post" id="add_key" action="<?php echo adm_base_url();?>/save_key" enctype="multipart/form-data">
    <!--<h2 class="titleheadng">Add New User</h2>-->
    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">EZ#</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="EZ" name="ez">
            </div>
          </div>
        </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Key Name</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" class="form-control" placeholder="Key Name" name="key_name" >
        </div>
      </div>
    </div> 
    <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Key Type</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <select class="form-control selectKeyType"  name="key_type" >
           		<option value="">Select key type</option>
                <?php foreach($getAllkeyType as $chips){ ?>
                <option value="<?php echo $chips['UUID'];?>"><?php echo $chips['Key_Type_Name'];?></option>
                <?php } ?>
           </select>
          </div>
        </div>
      </div>
      <div class="row"> 
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
            </div>
          </div>          
      </div>
      <div class="more_lock_type_holder"></div> 
      <button type="button" class="btn btn-info addMoreLockType">Add More</button>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Image Filename</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" name="key_image" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Products</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Products" name="products" >
          </div>
        </div>
      </div> 
      <div class="TestkeyShellRow hide">
          <div class="row">
            <div class="col-sm-4">
              <div class="labelcol">
                <label class="control-label">Test Key</label>
              </div>
            </div>
            <div class="col-sm-10">
              <div class="inputcol">
               <select class="form-control"  name="TestKey_UUID" >
                    <option value="">Select Test Key</option>
                    <?php $get_machanical_keys = get_machanical_test_keys('Mechanical Key','Transponder Key Shell');
					foreach($get_machanical_keys as $keys){ ?>
                    <option value="<?php echo $keys['UUID'];?>"><?php echo $keys['Key_Name'];?></option>
                    <?php } ?>                    
               </select>
              </div>
            </div>
          </div>
      </div>
      <div class="ChipRow hide">
          <div class="row">
            <div class="col-sm-4">
              <div class="labelcol">
                <label class="control-label">Chip</label>
              </div>
            </div>
            <div class="col-sm-10">
              <div class="inputcol">
               <select class="form-control"  name="chips" >
                    <option value="">Select chip</option>
                    <?php foreach($getAllChips as $chips){ ?>
                    <option value="<?php echo $chips['UUID'];?>"><?php echo $chips['Chip_Name'];?></option>
                    <?php } ?>
               </select>
              </div>
            </div>
          </div>
        </div>    
      <div class="row keyShellDiv hide">
          <div class="col-sm-4">
            <div class="labelcol">
              <label class="control-label">Key Shell</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <select class="form-control" name="Key_Shell_UUID">
                <option value="">Select Key Shell</option>
                <?php 
                $get_machanical_keys = get_machanical_keys('Transponder Key Shell');
				
                foreach($get_machanical_keys as $keys){?>
                    <option value="<?php echo $keys['UUID'];?>"><?php echo $keys['Key_Name'];?></option>
                <?php  } ?>               
              </select>
            </div>
          </div>
      </div> 
      <div class="row replcaementBlade hide">
          <div class=" col-sm-4 ">
              <div class="labelcol">
                  <label class="control-label">Replacement blade</label>
              </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <select class="form-control" name="Replacement_blade" id="Replacement_blade">
              <option value="">Select Replacement Blade</option>
              <?php 
              $get_machanical_keys = get_machanical_keys('Replacement Blade');
              foreach($get_machanical_keys as $keys){ ?>
              <option value="<?php echo $keys['UUID'];?>"><?php echo $keys['Key_Name'];?>(<?php echo $keys['Products'];?>)</option>
              <?php } ?>
              </select>
            </div>
          </div>
      </div>
      <fieldset>
      	<legend>Alternative Key Names</legend>
        <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Ilco</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Ilco" name="Alt_Ilco" >
          </div>
        </div>
      </div>
          <div class="row">
            <div class="col-sm-4">
              <div class="labelcol">
                <label class="control-label">Axxess</label>
              </div>
            </div>
            <div class="col-sm-10">
              <div class="inputcol">
               <input type="text" class="form-control" placeholder="Axxess" name="Alt_Axxess" >
              </div>
            </div>
          </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Curtis</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Curtis" name="Alt_Curtis" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">ESP</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="ESP" name="Alt_ESP" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Hillman</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Hillman" name="Alt_Hillman" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Jet</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Jet" name="Alt_Jet" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">JMA</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="JMA" name="Alt_JMA" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Silca</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Silca" name="Alt_Silca" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Strattec</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Strattec" name="Alt_Strattec" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Taylor</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Taylor" name="Alt_Taylor" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">OEM</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="OEM" name="Alt_OEM" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="labelcol">
            <label class="control-label">Other</label>
          </div>
        </div>
        <div class="col-sm-10">
          <div class="inputcol">
           <input type="text" class="form-control" placeholder="Other" name="Alt_Other" >
          </div>
        </div>
      </div>
      </fieldset>       
      <fieldset class="availableSubstitutes">
      	<legend>Available Substitutes</legend>
        	 <div class="substituteData">                 
                  <div class="get_substitute_keys"></div>
              </div>
          <div class="availableSubstitutes2"></div>
         <a href="javascript:void(0)" class="pull-right addAnotherSubstitute"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Another Substitute</a>  
      </fieldset>       
    <hr>
     <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">&nbsp;</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
          <button type="sumit" class="btn btn-success" name="post">Submit</button>
          <a href="<?php echo adm_base_url();?>/keys" class="btn btn-danger">Cancel</a>
        </div>
      </div>
    </div>
   </form>
  </div>
  </div>
</div>
