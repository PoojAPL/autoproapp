<table class="table table-striped table-data mar0">
<thead>
<tr> 
  <th>Submission Date/User</th>   
  <th>Type</th>  
  <th>Title</th>            
  <th>Vehicle</th>
  <th>Content</th>
  <th>Other Vehicles</th>   
  <th>Images</th>                                 
  <th>Status</th>
  <th>Action</th>                 
</tr>
</thead>
<tbody>
	<?php 
	$correction_status = array('pending' => 'Waiting for Review','approved' => 'Approved','rejected'=>'Rejected');
	foreach($outputs1 as  $image_value){
			 $key = $image_value['Vehicle_UUID'];
			 $key1 = $image_value['Feedback_type'];
		     $type = $key1;
			//echo $image_value['approved'].'<br>';
			  if( $image_value['Status']=='approved' ){
				  $disabled = '';
				  $Status = 'approved';
				  $rejected_hide = '';
				  $approved_hide = 'approved hide';
				  $pending_hide = '';
			  }else if( $image_value['Status']=='rejected'){
				  $disabled = '';
				  $Status = 'rejected';
				  $rejected_hide = 'rejected_hide hide';
				  $approved_hide = '';
				  $pending_hide = '';
			  }else{
				  $disabled = '';
				  $Status = 'pending';
				  $rejected_hide = '';
				  $approved_hide = '';
				  $pending_hide = 'pending'; 
			  } 
			  
			  $VehicleID = $key;
			  $User_Email = $image_value['User_Email'];
			  $User_Name = '';
			  $User_Type = '';
			  $Vehicle_UUID = $image_value['Vehicle_UUID'];
			  $Feedback_type = $type;
			  $User_Review = '';
			  $full_path = $image_value['Images'];
			  $User_UUID = '';
			  $vehcile_info = $image_value['Vehicle_UUID']; 
			  //echo '<br>';
			  $Image_path = $image_value['Images'];
			  $Title = $image_value['title'];
			  $CorrectionID = ''; 
			  $Dated = explode(' ',$image_value['Dated']);
			  if($type == 'key_making'){
			  	$Feedback_type_name = 'New Keymaking<br />Method';
			  }else{
			  	$Feedback_type_name = str_replace('_', ' ',ucwords($type));
			  }?>
              <tr class="<?php echo $rejected_hide;?> <?php echo $approved_hide;?> <?php echo $pending_hide;?>">
              <td><?php echo $Dated[0];?><br>
              	<?php $user_id =  $image_value['User_Email'];
		          $get_aks_users_info = get_aks_users_info2($user_id);
		          echo $get_aks_users_info[0]['customers_firstname'].' '.$get_aks_users_info[0]['customers_lastname'].' <span style="color:#8d8d8d;">('.$image_value['User_Email'].')</span>';
		          ?>	
              </td>  
                 
              <td><?php echo $Feedback_type_name;?></td>  
              <td><?php echo $image_value['title'];?></td>           
              <td><?php echo $image_value['vehicle'];?></td>
              <td><div class="user_feed_content"><?php echo $image_value['content'];?></div></td>
              <td><?php echo $image_value['other_vehicle'];?></td>   
              <td><img src="<?php echo $image_value['Images'];?>" style="width:100px;" /></td>                                 
              <td>
              <select style="width: 160px;" class="form-control" onchange="ChangeImageSatus(event)" data-cid="<?php echo $key.'/'.$key1.'/'.$image_key;?>" data-image="<?php echo $image_value['imagePath'];?>" <?php echo $disabled;?> data-date="<?php echo $image_value['date'];?>" data-userID="<?php echo $image_value['userID'];?>" data-vehicleName="<?php echo $image_value['vehicleName'];?>" data-otherVehicles="<?php echo $image_value['otherVehicles'];?>" data-title="<?php echo $image_value['title'];?>" data-tipTrickData="<?php echo $image_value['tipTrickData'];?>" >                                
                <?php								
					foreach($correction_status as $skey => $status){
						if( $Status == $skey){
							$selected = 'selected';
							$disabled = 'disabled';
						}else{
							$selected = '';
						}?>
						<option <?php echo $selected;?> value="<?php echo $skey;?>"><?php echo $status;?></option>
					<?php  } ?>
                </select>
                </td>
                <td><a href="<?php echo adm_base_url();?>/edit_user_feedback/<?php echo $image_value['UUID'];?>/<?php echo $image_value['Vehicle_UUID'];?>" class="btn btn-success">Edit</a>	
				                &nbsp; <a href="javascript:void(0)" onClick="DeleteFunction2('<?php echo adm_base_url();?>/delete_user_feedback/<?php echo $image_value['UUID'];?>/<?php echo $image_value['id'];?>')" class="btn btn-danger">Delete</a></td>	
               </tr>
<?php } ?>              	
</tbody>              
</table>   