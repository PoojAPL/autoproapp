<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form class="site-form " method ="post" id="AddObpRemoteForm" action="<?php echo adm_base_url();?>/vehicles/save_obp_remote">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
      <!--<h2 class="titleheadng">Add Model</h2>-->
        <input type="hidden" value="<?php echo time();?>" name="unique_id"  />
        <fieldset>
            <legend>VEHICLE</legend>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Make</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <select class="form-control select_obp_Models" name="Make_UUID">
                    <option value="">Select make</option>
                    <?php foreach($getAllMakeNames as $makes){?>
                        <option value="<?php echo $makes['UUID'];?>"><?php echo $makes['Make_Name'];?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Model</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol getModels">
                  <select class="form-control" name="Model_UUID">
                    <option value="">Select model</option>
                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Vehicle</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol getVehicles">
                  <select class="form-control" name="Vehicle_UUID">
                    <option value="">Select vehicle</option>                    
                  </select>
                </div>
              </div>
            </div> 
           
        </fieldset> 
         <div class="getAnotherVehicle"></div>
        	<a href="javascript:void(0)" class="pull-right addAnotherVehicle" data-id="1">
         		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add More Vehicle
         	</a>      
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
            <input type="hidden" name="Procedure_Number[]" value="1"  />            
        </fieldset>  
         <div class="getAnotherProcedure"></div>
         <a href="javascript:void(0)" class="pull-right addAnotherProcedure" data-id="1">
         	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Another Procedure
         </a>
        <hr>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label"></label>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-success" name="post">Submit</button>
            <a href="<?php echo adm_base_url();?>/vehicles/obp_remotes" class="btn btn-danger" >Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>