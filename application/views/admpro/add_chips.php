<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form "  method ="post" id="chips" action="<?php echo adm_base_url();?>/Chips_added" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
     <!--<h2 class="titleheadng">Add New Chip</h2>-->
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"> Name</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" class="form-control" placeholder="Name" name="name" id= "name">
        </div>
      </div>
    </div> 
    
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Cloneable</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
        <input type="radio" name="cloneable" value="1" checked="checked" /> Yes  &nbsp;&nbsp; <input type="radio" name="cloneable" value="0" /> No
       
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Reusable</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
        
         <input type="radio" name="reusable" value="1" checked="checked" /> Yes  &nbsp;&nbsp; <input type="radio" name="reusable" value="0" /> No
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Cloning Chip</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
        <input type="radio" name="cloning_chip" value="1"  /> Yes  &nbsp;&nbsp; <input type="radio" name="cloning_chip" value="0" checked="checked" /> No
        
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Cloning Type</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
        <input type="text" class="form-control cloning_type"  name="Cloning_type" readonly >
        </div>
      </div>
    </div> 
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Image Filename</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" class="form-control upload-file" id="uploadFile" name="profileImage">
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
         <input type="text" class="form-control" placeholder="Products" name="products" id= "products">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Clone With</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <select type="text" class="form-control" name="Clone_With[]">
         	<option value="">Please select</option>
            <?php $get_clonabnle_chips = get_clonabnle_chips();
			foreach($get_clonabnle_chips as $chips){?>
				<option value="<?php echo $chips['UUID'];?>"><?php echo $chips['Chip_Name'];?></option>
			<?php } ?>
         </select>
        </div>
        <div class="addMoreCloneWithRow"></div>
        <button type="button" class="btn btn-info addMoreCloneWith pull-right" title="Add More"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Cloning Machine</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <select type="text" class="form-control Cloning_Machine" name="Cloning_Machine[]" disabled="disabled">
         	<option value="">Please select</option>
            <?php $get_clonabnle_tools = get_clonabnle_tools();
			foreach($get_clonabnle_tools as $tools){?>
				<option value="<?php echo $tools['Tool_Name'];?>"><?php echo $tools['Tool_Name'];?></option>
			<?php } ?>
         </select>
        </div>
        <div class="addMoreCloneMachineRow"></div>
        <button type="button" class="btn btn-info addMoreCloneMachine pull-right" title="Add More"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
      </div>
    </div> 	
     <hr>
    <div class="row">
    <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"></label>
        </div>
      </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/Chips" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
