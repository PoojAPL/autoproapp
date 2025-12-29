<?php
$angle = ""; 
$sorting_id = "";
if($sorting == 'DESC'){
	$sorting_id = 'ASC';
	$angle = 'bottom';
}else if($sorting == 'ASC'){
	$sorting_id = 'DESC';
	$angle = 'top';
}
?>
<table class="table table-striped table-data mar0">
  <thead>
    <tr>
      
      <th>Name 
      <?php if($sort_by == 'user_name'){?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> user_sorting" data_id="<?php echo $sorting_id;?>" data-sort="user_name"></a>
       <?php }else{ ?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom user_sorting" data_id="DESC" data-sort="user_name"></a>
       <?php } ?>
      </th>
      <th>User Type 
      <?php if($sort_by == 'type'){?>
      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> user_sorting" data_id="<?php echo $sorting_id;?>" data-sort="type"></a>
      <?php }else{ ?>
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom user_sorting" data_id="DESC" data-sort="type"></a>
       <?php } ?>
      </th>
      <th>Company</th>
      <th>E-mail</th>
      <th>Access</th>    
      <th style="width:137px;">Action</th>
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
                      <td><a  href="<?php echo adm_base_url();?>/edit_users/<?php echo $users['UserID'];?>" type="button" class="btn btn-success">Edit</a>  
                      <a  href="javascript:void(0)" type="button" onclick="DeleteFunction(<?php echo $users['UserID'];?>, '<?php echo adm_base_url();?>/deleteUsers/')" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
			  <?php }  ?>                
               </tbody>
</table>
<script>
  $(function() {
    $('.appSwitcher').bootstrapToggle();
  })
</script>