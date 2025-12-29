<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form "  method ="post"  action="<?php echo adm_base_url();?>/Update_ChipsEdit" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
     <!--<h2 class="titleheadng">Add Code</h2>-->
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"> Name</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
        <input type="hidden" value="<?php echo $id;?>" name="chipsid">
         <input type="text" class="form-control" placeholder="Name" name="name" id= "name" value="<?php echo $getallChipsInfo[0]['Chip_Name'];?>">
        </div>
      </div>
    </div> 
    
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Clonable</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
        <?php if($getallChipsInfo[0]['Clonable'] == 1){
				$yes_checked = 'checked';
				$no_checked = '';
		     }else{
				 $yes_checked = '';
				 $no_checked = 'checked';
			 }?>
       	 <input type="radio" name="cloneable" value="1" <?php echo $yes_checked;?> />
          Yes  &nbsp;&nbsp; <input type="radio" name="cloneable" value="0" <?php echo  $no_checked;?> /> No
         
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
          <?php if($getallChipsInfo[0]['Reusable'] == 1){
				$yes_checked = 'checked';
				$no_checked = '';
		     }else{
				 $yes_checked = '';
				 $no_checked = 'checked';
			 }?>   
        
         <input type="radio" name="reusable" value="1" <?php echo $yes_checked;?> />
          Yes  &nbsp;&nbsp; <input type="radio" name="reusable" value="0" <?php echo  $no_checked;?>  /> No
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
        	<?php if($getallChipsInfo[0]['CloningChip'] == 1){
				$yes_checked = 'checked';
				$no_checked = '';
				$chip_type_disabled = '';
				$Cloning_Machine_disabled = '';
		     }else{
				 $yes_checked = '';
				 $no_checked = 'checked';
				 $chip_type_disabled = 'readonly';
				 $Cloning_Machine_disabled = 'disabled';
			 }?>      
         <input type="radio" name="cloning_chip" value="1" <?php echo $yes_checked;?>  /> 
         Yes  &nbsp;&nbsp; <input type="radio" name="cloning_chip" value="0" <?php echo  $no_checked;?> /> No
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
        <input type="text" class="form-control cloning_type"  name="Cloning_type" value="<?php echo $getallChipsInfo[0]['Cloning_type'];?>" <?php echo $chip_type_disabled;?> >
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
        <input type="hidden" value="<?php echo $id;?>" name="chipsid">
          <input type="text" class="form-control upload-file" id="uploadFile" name="profileImage" value="<?php echo $getallChipsInfo[0]['Chip_Image_Url'];?>" >
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
         <input type="text" class="form-control" placeholder="Products" name="Products" id= "Products" value="<?php echo $getallChipsInfo[0]['Products'];?>">
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
      	<?php $Clone_With = explode(',',$getallChipsInfo[0]['Clone_With']);
		for($cl = 0; $cl < count($Clone_With); $cl++){?>
			<div class="clone-with-holder">
                <div class="inputcol">
                 <select type="text" class="form-control" name="Clone_With[]">
                    <option value="">Please select</option>
                    <?php $get_clonabnle_chips = get_clonabnle_chips();
                    foreach($get_clonabnle_chips as $chips){
                        if($Clone_With[$cl] == $chips['UUID']){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }?>
                        <option value="<?php echo $chips['UUID'];?>" <?php echo $selected;?>><?php echo $chips['Chip_Name'];?></option>
                    <?php } ?>
                 </select>
                  <?php if( $cl > 0){?>
                    <span class="glyphicon glyphicon-remove removeMoreCloneWith" aria-hidden="true"></span>
                    <?php } ?>
                </div>
               
            </div>
		<?php }?>        
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
      <?php $Cloning_Machine = explode(',',$getallChipsInfo[0]['Cloning_Machine']);
		for($clm = 0; $clm < count($Cloning_Machine); $clm++){?>
			<div class="clone-with-holder">
            <div class="inputcol">
             <select type="text" class="form-control Cloning_Machine" name="Cloning_Machine[]" <?php echo $Cloning_Machine_disabled;?>>
                <option value="">Please select</option>
                <?php $get_clonabnle_tools = get_clonabnle_tools();
                foreach($get_clonabnle_tools as $tools){
					if($Cloning_Machine[$clm] == $tools['Tool_Name']){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }?>
                    <option value="<?php echo $tools['Tool_Name'];?>" <?php echo $selected;?>><?php echo $tools['Tool_Name'];?></option>
                <?php } ?>
             </select>
             <?php if( $clm > 0){?>
              <span class="glyphicon glyphicon-remove removeMoreCloneWith" aria-hidden="true"></span>
              <?php } ?>
            </div>
        <?php }?>  
        <div class="addMoreCloneMachineRow"></div>
        <button type="button" class="btn btn-info addMoreCloneMachine pull-right" title="Add More"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
      </div>
    </div> 	
     <hr>
    <div class="row">    
    <div class="col-md-12">
        <button type="submit" class="btn btn-primary" name="post">Update</button>
        <a href="<?php echo adm_base_url();?>/Chips" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
