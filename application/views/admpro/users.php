<?php
$user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
$email = $user_data['email'];
$get_admin_deatils = get_admin_deatils($email);
$user_type = $get_admin_deatils[0]['type'];
$get_type_access = get_type_access($user_type);
$user_type_access = explode(',',$get_type_access[0]['user']);
?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
      <div class="col-sm-6">
      		<div class="form-group">
            <?php if( in_array('editUsers', $user_type_access)){?>
            	<label>Show Type: </label>
                <select class="form-control select-field show_userby_types" style="width:auto;">
                	<option value="all">All</option>                    
            		  <?php  $get_users_type = users_type();
        					foreach( $get_users_type as $key => $user_type){ ?>
        						<option value="<?php echo $key;?>"><?php echo $user_type;?></option>
        					<?php } ?>          
                </select>
              <?php } ?>  
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
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control" style="width: 200px;" placeholder="Enter at least 3 characters for searching">
                     <button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
      </div>
      <div class="col-sm-6">
        <div class="form-group addUserButton">          
          <a href="<?php echo adm_base_url();?>/add_user" class="btn btn-danger"  title="Sign Out">Add New User</a>        
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
               
                  <th>Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom user_sorting" data_id="DESC" data-sort="user_name"></a></th>
                  <th class="">User Type
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom user_sorting" data_id="DESC" data-sort="type"></a></th>
                  <th>Company</th>
                  <th>Email Address (Username)</th>  
                  <th>Access</th>                
                  <th style="width: 137px;">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  $sr = 1;			  
			  foreach($getAllUsers as $users){
				  	$get_users_type = users_type();
					foreach( $get_users_type as $key => $user_type){
						if($users['type'] == $key){
							$user = $user_type;
						}	
					} 			  		
					if($users['APP_switcher'] == 1){
						$enabled = 'Enabled';
						 $on_check = 'checked';
						 $value = 0;
					}else{
						$enabled = 'Disabled';
						 $on_check = '';
						 $value = 1;
					}
			  		?>
                    <tr>                      
                      <td>
                      <span class="td_data"><?php echo $users['user_name'];?></span>
                     <span class="glyphicon glyphicon-pencil edit_adminAccess_inputs" aria-hidden="true" data-val="<?php echo $users['user_name'];?>" data-id="<?php echo $users['UserID'];?>" data-col="user_name"></span><div class="get_column_data"></div>
                      </td>
                      <td>
                       <span class="td_data"><?php echo $user;?></span>
                      <span class="glyphicon glyphicon-pencil edit_adminAccess_inputs" aria-hidden="true" data-val="<?php echo $users['type'];?>" data-id="<?php echo $users['UserID'];?>" data-col="type"></span><div class="get_column_data"></div>
                      </td>
                      <td>
                      <span class="td_data"><?php echo $users['Company'];?></span>
                      <span class="glyphicon glyphicon-pencil edit_adminAccess_inputs" aria-hidden="true" data-val="<?php echo $users['Company'];?>" data-id="<?php echo $users['UserID'];?>" data-col="Company"></span><div class="get_column_data"></div>
                      </td>
                      <td>
                      <span class="td_data"><?php echo $users['email'];?></span>
                      <span class="glyphicon glyphicon-pencil edit_adminAccess_inputs" aria-hidden="true" data-val="<?php echo $users['email'];?>" data-id="<?php echo $users['UserID'];?>" data-col="email"></span><div class="get_column_data"></div>
                      </td>
                      <td>
                  <input type="checkbox" class="appSwitcher" id="<?php echo $users['UserID'];?>" data-toggle="toggle" data-on="Enabled" data-off="Disabled" <?php echo $on_check;?> >
                      </td>
                      <td>
                        <?php if( in_array('editUsers', $user_type_access)){?>
                        <a  href="<?php echo adm_base_url();?>/edit_users/<?php echo $users['UserID'];?>" type="button" class="btn btn-success">Edit</a> 
                        <?php } ?> 
                      <a  href="javascript:void(0)" type="button" onclick="DeleteFunction(<?php echo $users['UserID'];?>, '<?php echo adm_base_url();?>/deleteUsers/')" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
			  <?php }  ?>                
               </tbody>
            </table>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->