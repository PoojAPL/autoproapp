<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
      <!-- <div class="col-sm-6">
      		<div class="form-group">
            	<label>Show Type: </label>
                <select class="form-control select-field show_userby_types" style="width:auto;">
                	<option value="all">All</option>                    
            		<?php  $get_users_type = users_type();
					foreach( $get_users_type as $key => $user_type){ ?>
						<option value="<?php echo $key;?>"><?php echo $user_type;?></option>
					<?php } ?>          
                </select>
            </div>
      </div>
      <div class="col-sm-6">
      		<div class="form-group">
            	<label>Show Only: </label>
                <select class="form-control select-field show_userby_access" style="width:auto;">
                	<option value="all">All Users</option>                    
            		<option value="1">Only Enabled Users</option> 
                    <option value="0">Only Disabled Users</option>         
                </select>
            </div>
      </div>
      <div class="col-sm-6">
            <form method="post" id="searchAdminUsers" novalidate="novalidate">
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control" style="width: 200px;" placeholder="Enter at least 3 characters for searching">
                     <button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
      </div> -->
      <div class="col-sm-24">
        <div class="form-group addUserButton">          
          <a href="<?php echo adm_base_url();?>/add_user_type" class="btn btn-danger"  title="Sign Out">Add New User Type</a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    		<div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
     <?php } ?>
        <form class="site-form">
          <div class="table-responsive usersData tool_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>               
                  <th>ID</th>
                  <th class="">User Type Name</th>
                  <th> # of Users Assigned</th>              
                  <th style="width: 137px;">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(count($results)){
                  $i = 1;
                  foreach ($results as $value) {?>
                    <tr>
                      <td><?php echo $i;?></td>
                      <td><?php echo $value['type'];?></td>
                      <td>
                        <?php echo $get_assigned_users = get_assigned_users($value['id']);?>
                      </td>
                      <td>
                        <a href="<?php echo adm_base_url();?>/copy_user_types/<?php echo $value['id'];?>" type="button" class="btn btn-info">Copy</a>
                    <a href="<?php echo adm_base_url();?>/edit_user_types/<?php echo $value['id'];?>" type="button" class="btn btn-success">Edit</a>
                    <?php if($get_assigned_users == 0){?>   
                      <a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_user_types/')" type="button" class="btn btn-danger">Delete</a>
                     <?php } ?> 
                    </td>
                    </tr>
                 <?php $i++;
                    }
                }else{?>
                  <tr>
                    <td colspan="5"><div class="alert alert-danger">Data not found.</div></td>
                  </tr>
               <?php  } ?>
              </tbody>
            </table>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->