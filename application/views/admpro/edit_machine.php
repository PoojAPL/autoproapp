<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form " method ="post" id="AddMachineForm" action="<?php echo adm_base_url();?>/update_machines">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
  <input type="hidden" name="id" value="<?php echo $id;?>" />
    <!--<h2 class="titleheadng">Add Model</h2>-->
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Name" name="Name" value="<?php echo $getMachinesInfo[0]['Name'];?>">
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
           <select class="form-control"  name="Type">
           		<option value="">Select Type</option>
                <?php foreach($getMachinesTypes as $machine_type){
					if( $getMachinesInfo[0]['Type'] == $machine_type['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
					?>
                <option value="<?php echo $machine_type['UUID'];?>" <?php echo $selected;?>><?php echo $machine_type['Machines_Info_Type_Name'];?></option>
                <?php  }?>
           </select>
        </div>
      </div>
    </div>    
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Products</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
           <input type="text" class="form-control"  name="Products" value="<?php echo $getMachinesInfo[0]['Products'];?>">
        </div>
      </div>
    </div>    
    <hr>
    <div class="row">
   		 <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label"></label>
        </div>
      </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/machines" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
