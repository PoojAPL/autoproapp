<div class="container-fluid"> 
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
  <form class="site-form " method ="post"  action="<?php echo adm_base_url();?>/vehicles/ModelName" >
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Update Model</h2>-->
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Make</label>
        </div>
      </div>
      <div class="col-sm-10">
       <div class="inputcol">
       <input type="hidden" value="<?php echo $id;?>" name="modelID">
        <select  name="make_name" class="form-control select-field ">
		  <?php
           foreach($getallmakes as $value){
               $make_id = $value['UUID'];
              //$make_name_info = admin_makeNameInfo($make_id );
              if($getModelInfo[0]['Make_UUID'] == $value['UUID'] ){
                  $selected = 'selected';
              }else{
                  $selected ='';
              }
              ?>
           <option value ="<?php echo $value['UUID'];?>" <?php echo $selected;?>><?php echo $value['Make_Name'];?></option>		
         <?php } ?>
       </select>
      </div>
    </div> 
   </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Model Name</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="hidden" value="<?php echo $id;?>" name="modelID">
         <input type="text" class="form-control" placeholder="Name" name="model_name" value="<?php echo $getModelInfo[0]['Model_Name'];?>" >
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Type</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
          <select type="text" class="form-control"  name="vehicle_type" id= "vehicle_type">
          <option value=""> Please select Vehicles type</option>
           <?php 
		    foreach($results as $value){
				if($getModelInfo[0]['Vehicle_Type_UUID'] == $value['UUID']){
					 $selected = 'selected';
				  }else{
					  $selected ='';
				  }
					
				?>			   
           	<option value="<?php echo $value['UUID'];?>" <?php echo  $selected;?> ><?php echo $value['type'];?> </option>
            <?php  }?>
           </select>
        </div>
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
        <button type="submit" class="btn btn-primary" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/vehicles/model" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
  
   </form>
  </div>
  </div>
</div>
