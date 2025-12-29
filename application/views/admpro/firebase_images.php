<?php 
error_reporting(0);
$correction_status = array('pending' => 'Waiting for Review','approved' => 'Approved','rejected'=>'Rejected');
?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
   	 <div class="col-sm-8">
   	 	<form method="post" id="searchFeedbacks" novalidate="novalidate">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
					<div class="form-group">                     
						<input type="text" name="search_key" class="form-control" style="width:300px !important;" placeholder="Enter at least 3 characters for searching">
						<button type="submit" class="btn btn-primary custom-button">Search</button>
					</div>
			</form>
   	 </div>
   	 <div class="col-sm-4">
      	<div class="form-group ">
        	 <label>Show Type</label>
             <select class="form-control select-field show_feedback_by_type">
             	<option value="All">All</option>
             	<?php $get_feedback_type = get_feedback_type();
             	foreach ($get_feedback_type as $key => $value) {
             		$type = $value['Feedback_type'];?>
             		<option value="<?php echo $type;?>"><?php echo str_replace('_', ' ',ucwords($type));?></option>
             	<?php } 	?>                            	
             </select>            
      	</div>
      </div>
   	 <div class="col-sm-18"></div> 
     </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      	<div class="row">
		   	 <div class="col-sm-4">
				<?php 
				if( isset($_SESSION['user_submissions_status']) && in_array('approved', explode(',',$_SESSION['user_submissions_status'])) ){
					$approved = 'checked';
				}else if( isset($_SESSION['user_submissions_status']) && !in_array('approved', explode(',',$_SESSION['user_submissions_status'])) ){
					$approved = '';
				}else{
					$approved = 'checked';
				}
				if( isset($_SESSION['user_submissions_status']) && in_array('rejected', explode(',',$_SESSION['user_submissions_status'])) ){
					$rejected = 'checked';
				}else if( isset($_SESSION['user_submissions_status']) && !in_array('rejected', explode(',',$_SESSION['user_submissions_status'])) ){
					$rejected = '';
				}else{
					$rejected = 'checked';
				}
				if( isset($_SESSION['user_submissions_status']) && in_array('pending', explode(',',$_SESSION['user_submissions_status'])) ){
					$pending = 'checked';
				}else if( isset($_SESSION['user_submissions_status']) && !in_array('pending', explode(',',$_SESSION['user_submissions_status'])) ){
					$pending = '';
				}else{
					$pending = 'checked';
				} ?>
		   	 	<input type="checkbox" class="show_approved showStatus" value="approved"  <?php echo $approved;?>>&nbsp;Show Approved
		   	 </div>
		   	 <div class="col-sm-4">
		   	 	<input type="checkbox" class="show_rejected showStatus" value="rejected"  <?php echo $rejected;?>>&nbsp;Show Rejected
		   	 </div>
		   	 <div class="col-sm-6">
		   	 	<input type="checkbox" class="show_pending showStatus" value="pending" <?php echo $pending;?>>&nbsp;Show Waiting for Review
		   	 </div> 
	     </div>
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div id="fireResult" style="text-align:left;"></div><br />
        <div class="site-form" method="post">
          <div class="table-responsive userSubmission_data" style="overflow: visible;">
          <table class="table table-data mar0">
				<thead>
				<tr> 
				  <th>Submission Date/User</th>   
				  <th>Type</th>  
				  <th>Title</th>            
				  <th>Vehicle</th>
				  <th>Content</th>
				  <th>Other Vehicles</th>   
				  <th>Images</th> 
				  <th>Video</th>                                
				  <th>Status</th>
				  <th>Action</th>                 
				</tr>
				</thead>
				<tbody>
					<?php 					
					foreach($users_contributed_content as  $image_value){
							 $key = $image_value['Vehicle_UUID'];
							 $key1 = $image_value['Feedback_type'];
						     $type = $key1;
							 //echo $image_value['id'].'------'.$image_value['Status'].'<br>';
							  if( $image_value['Status']=='approved' ){
								  $disabled = '';
								  $Status = 'approved';
								  $rejected_hide = '';
								  $approved_hide = 'approved';
								  $pending_hide = '';
							  }else if( $image_value['Status']=='rejected'){
								  $disabled = '';
								  $Status = 'rejected';
								  $rejected_hide = 'rejected_hide';
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
							  $Image_path = explode(',',$image_value['Images']);
							  $Title = $image_value['title'];
							  $CorrectionID = '';
							  $Dated = explode(' ',$image_value['Dated']);
							  if($type == 'key_making'){
							  	$Feedback_type_name = 'New Keymaking<br />Method';
							  }elseif( $type=='vehicle_image'){
							  	 $Feedback_type_name ='New Vehicle Image';
							  }elseif( $type=='submit_correction'){
							  	 $Feedback_type_name ='Correction';
							  }elseif( $type=='tips_tricks_submit'){
							  	 $Feedback_type_name ='New Tip & Trick';
							  }else{
							  	$Feedback_type_name = str_replace('_', ' ',ucwords($type));
							  } 
							 
							if( isset($_SESSION['user_submissions_status']) && in_array('approved', explode(',',$_SESSION['user_submissions_status'])) && $image_value['Status']=='approved'){
								$approved_hide_status = '';
							}else if( isset($_SESSION['user_submissions_status']) && !in_array('approved', explode(',',$_SESSION['user_submissions_status'])) && $image_value['Status']=='approved'){
								$approved_hide_status = 'hide';
							}else{
								$approved_hide_status = '';
							}
							if( isset($_SESSION['user_submissions_status']) && in_array('rejected', explode(',',$_SESSION['user_submissions_status'])) && $image_value['Status']=='rejected'){
								$rejected_hide_status = '';
							}else if( isset($_SESSION['user_submissions_status']) && !in_array('rejected', explode(',',$_SESSION['user_submissions_status'])) && $image_value['Status']=='rejected'){
								$rejected_hide_status = 'hide';
							}else{
								$rejected_hide_status = '';
							}
							if( isset($_SESSION['user_submissions_status']) && in_array('pending', explode(',',$_SESSION['user_submissions_status'])) && $image_value['Status']=='pending'){
								$pending_hide_status = 'pending';
							}else if( isset($_SESSION['user_submissions_status']) && !in_array('pending', explode(',',$_SESSION['user_submissions_status'])) && $image_value['Status']=='pending'){
								$pending_hide_status = 'hide';
							}else{
								$pending_hide_status = '';
							}
							if($image_value['Vehicle_UUID'] ==""){
								$Vehicle_UUID_id = $image_value['id'];
							}else{
								$Vehicle_UUID_id = $image_value['Vehicle_UUID'];
							}						 
							 ?>
				              <tr class="<?php echo $rejected_hide;?> <?php echo $approved_hide;?> <?php echo $pending_hide;?> <?php echo $rejected_hide_status;?> <?php echo $approved_hide_status;?> <?php echo $pending_hide_status;?>">
				              <td><?php 
								echo $image_value['Dated'];
				              ?><br>
				              	<?php //echo $image_value['User_Email'];?>
				              	<?php $user_id =  $image_value['User_Email'];
		                          $get_aks_users_info = get_aks_users_info2($user_id);
		                          echo $get_aks_users_info[0]['customers_firstname'].' '.$get_aks_users_info[0]['customers_lastname'].' <span style="color:#8d8d8d;">('.$image_value['User_Email'].')</span>';
		                          ?>
				              </td>				                 
				              <td><?php echo $Feedback_type_name;?>
				              	<?php if($image_value['category'] != NULL){?>
				              		<br>(<?php echo $image_value['category'];?>)
				              	<?php } ?>
				              </td>  
				              <td><?php echo $image_value['title'];?></td>           
				              <td><a style="text-decoration: underline;" href="<?php echo adm_base_url();?>/vehicles/vehicle/id_<?php echo $image_value['Vehicle_UUID'];?>" target="_blank" > 
				              	<?php echo $image_value['vehicle'];?>				              		
				              </a><br>
				              <a style="text-decoration: underline;" href="<?php echo adm_base_url();?>/vehicles/vehicle/id_<?php echo $image_value['Vehicle_UUID'];?>" target="_blank" > 	<?php 
				              	$vehicle = $image_value['Vehicle_UUID'];
				              	$get_vehicle = get_vehicles_by_id($vehicle);
				              	$vehicles = $get_vehicle[0];
                    			echo str_replace(',','-',$vehicles['Years']);?>
                    		  </a>	
				              </td>
				              <td><div class="user_feed_content"><?php echo $image_value['content'];?></div></td>
				              <td><?php echo $image_value['other_vehicle'];?></td>   
				              <td>
				              	<?php for($im=0; $im < count($Image_path);$im++) {?>
				              		<span class="image-holder">
				              			<a href="<?php echo $Image_path[$im];?>" target="_blank"><img src="<?php echo $Image_path[$im];?>" style="width:100px;" /></a>
				              	    </span>
				              	<?php } ?>
				              	
				              </td> 
				              <td>
				              	<?php $videos = explode(',', $image_value['video']);
				              	for($v = 0; $v < count($videos); $v++ ){?>
				              	<a href="https://youtu.be/<?php echo $videos[$v];?>" target="_blank">
				              		<?php echo $videos[$v];?>
				                </a>
				                <?php } ?>          		
				              </td>                                
				              <td>
				              <?php if($type == 'key_making'){ ?>
				              	<select style="width: 160px;" class="form-control" onchange="ChangeImageSatus(event)" data-cid="<?php echo $image_value['Vehicle_UUID'].'/'.$type.'/'.$image_value['UUID'];?>" data-image="<?php echo $image_value['Images'];?>" <?php echo $disabled;?> data-date="<?php echo $image_value['Dated'];?>" data-userID="<?php echo $image_value['User_Email'];?>" data-vehicleName="<?php echo $image_value['vehicle'];?>" data-otherVehicles="<?php echo $image_value['other_vehicle'];?>" data-title="<?php echo $image_value['title'];?>" data-tipTrickData="" data-vehicle="<?php echo $image_value['Vehicle_UUID'].'/'.$type.'_methods/methods/'.$image_value['UUID'];?>" data-key="<?php echo $image_value['UUID'];?>" data-cat="<?php echo $image_value['category'];?>" data-type="<?php echo $type;?>" data-id="<?php echo $image_value['id'];?>" data-video="<?php echo $image_value['video'];?>" data-year="<?php echo $image_value['year_range'];?>" >
				              <?php }else if($type == 'tips_tricks' || $type =='tips_tricks_submit'){?>
				              		<select style="width: 160px;" class="form-control" onchange="ChangeImageSatus(event)" data-cid="<?php echo $image_value['Vehicle_UUID'].'/'.$type.'/'.$image_value['UUID'];?>" data-image="<?php echo $image_value['Images'];?>" <?php echo $disabled;?> data-date="<?php echo $image_value['Dated'];?>" data-userID="<?php echo $image_value['User_Email'];?>" data-vehicleName="<?php echo $image_value['vehicle'];?>" data-otherVehicles="<?php echo $image_value['other_vehicle'];?>" data-title="<?php echo $image_value['title'];?>" data-tipTrickData="" data-vehicle="<?php echo $image_value['Vehicle_UUID'].'/'.$type.'_methods/methods/'.$image_value['category'].'/'.$image_value['UUID'];?>" data-key="<?php echo $image_value['UUID'];?>" data-cat="<?php echo $image_value['category'];?>" data-type="<?php echo $type;?>" data-id="<?php echo $image_value['id'];?>" data-video="<?php echo $image_value['video'];?>" data-year="<?php echo $image_value['year_range'];?>" >
				              <?php }else{?>
				              		<select style="width: 160px;" class="form-control" onchange="ChangeImageSatus(event)" data-cid="<?php echo $image_value['Vehicle_UUID'].'/'.$type.'/'.$image_value['UUID'];?>" data-image="<?php echo $image_value['Images'];?>" <?php echo $disabled;?> data-date="<?php echo $image_value['Dated'];?>" data-userID="<?php echo $image_value['User_Email'];?>" data-vehicleName="<?php echo $image_value['vehicle'];?>" data-otherVehicles="<?php echo $image_value['other_vehicle'];?>" data-title="<?php echo $image_value['title'];?>" data-tipTrickData="" data-vehicle="<?php echo $image_value['Vehicle_UUID'].'/'.$type.'/'.$image_value['UUID'];?>" data-key="<?php echo $image_value['UUID'];?>" data-cat="<?php echo $image_value['category'];?>" data-type="<?php echo $type;?>" data-id="<?php echo $image_value['id'];?>" data-video="<?php echo $image_value['video'];?>" data-year="<?php echo $image_value['year_range'];?>" >
				              <?php } ?>	
				                                              
				                <?php								
									foreach($correction_status as $skey => $status2){
										if( $Status == $skey){
											$selected = 'selected';
											$disabled = 'disabled';
										}else{
											$selected = '';
										}?>
										<option <?php echo $selected;?> value="<?php echo $skey;?>"><?php echo $status2;?></option>
									<?php  } ?>
				                </select>
				                </td>
				                <td style="white-space: nowrap;">
				                	<?php if( $type=='vehicle_image'){?>
				                		<a href="<?php echo adm_base_url();?>/vehicles/add_vehicles_images/<?php echo $image_value['id'];?>" target="_blank" class="btn btn-info">Create</a>
				                	<?php }?>
				                	<?php if( $type=='tips_tricks' || $type =='tips_tricks_submit'){?>
				                		<a href="<?php echo adm_base_url();?>/vehicles/add_tip_tricks/<?php echo $image_value['id'];?>" target="_blank" class="btn btn-info">Create</a>
				                	<?php }?>
				                	<?php if( $type=='key_making'){?>
				                		<a href="<?php echo adm_base_url();?>/add_method/<?php echo $image_value['id'];?>" class="btn btn-info" target="_blank" >Create</a>
				                	<?php }?>
				                	<?php if( $type=='submit_correction'){?>
				                	<?php }else{?>				                	
				                	<a href="<?php echo adm_base_url();?>/edit_user_feedback/<?php echo $image_value['UUID'];?>/<?php echo $image_value['Vehicle_UUID'];?>" class="btn btn-success">Edit</a>
				                	<?php } ?>	
				                <a href="javascript:void(0)" onClick="DeleteFunction2('<?php echo adm_base_url();?>/delete_user_feedback/<?php echo $image_value['UUID'];?>/<?php echo $image_value['id'];?>')" class="btn btn-danger">Delete</a></td>	
				               </tr>
				<?php } ?>              	
				</tbody>              
				</table>
				<?php if(isset($links)){?>
					<nav class="site-pg">
						<ul class="pagination">               
									<?php foreach ($links as $link) {
													echo '<li>'. $link.'</li>';
									} ?>	
						</ul>
					</nav>
				<?php }?>	           
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<script src="https://www.gstatic.com/firebasejs/4.3.1/firebase.js"></script>
<script>
var config = {
    apiKey: "AIzaSyA1kkLsRv7v_tTafk5aCQWnXeWV_plC5_k",
    authDomain: "autoproapp2017.firebaseapp.com",
    databaseURL: "https://autoproapp2017.firebaseio.com",
    projectId: "autoproapp2017",
    storageBucket: "autoproapp2017.appspot.com",
    messagingSenderId: "988140303282"
};
/*var config = {
    apiKey: "AIzaSyAOGEGaxRqauTKn14rrg7NsfSpgAgqmWQ4",
    authDomain: "american-key.firebaseapp.com",
    databaseURL: "https://american-key.firebaseio.com",
    projectId: "american-key",
    storageBucket: "american-key.appspot.com",
    messagingSenderId: "699615089846"
};*/
var bse_url = 'http://autoproapp.com/';
firebase.initializeApp(config);
function ChangeImageSatus(e){	
	document.getElementById("loader").className = ""; 
	var status_val = e.target.value;
	var image_root_path = e.target.getAttribute("data-cid");
	var image_full_path = e.target.getAttribute("data-image");
	var image_array = image_full_path.split(',');
	var data_date = e.target.getAttribute("data-date");
	var data_userid = e.target.getAttribute("data-userid");
	var data_othervehicles = e.target.getAttribute("data-othervehicles"); 
	var data_vehiclename = e.target.getAttribute("data-vehiclename");
	var data_title = e.target.getAttribute("data-title");
	var data_tiptrickdata = e.target.getAttribute("data-tiptrickdata");
	var data_key = e.target.getAttribute('data-key');
	var data_category = e.target.getAttribute('data-cat');
	var fireBaseRef3 = firebase.database().ref('submitted_feedback/'+image_root_path);
	var fireBaseRef4 = firebase.database().ref('approved_feedback/'+image_root_path);
	var vehicle_path = e.target.getAttribute("data-vehicle");;
	var fireBaseRef5 = firebase.database().ref('vehicle1/'+vehicle_path);
	var newPostKey = firebase.database().ref().child('posts').push().key;
	var data_type = e.target.getAttribute('data-type');
	var video_array = e.target.getAttribute('data-video');
	var video = video_array.split(',');
	var range = e.target.getAttribute('data-year');
	
	var id = e.target.getAttribute('data-id');
	var csrf_test_name =  "<?php echo $this->security->get_csrf_hash();?>";
	if(status_val != ''){

		var http = new XMLHttpRequest();
		var url = bse_url+'admpro/update_user_contribution';
		var params = "id="+id+"&status="+status_val+"&csrf_test_name="+csrf_test_name;
		http.open("POST", url, true);		
		//Send the proper header information along with the request
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
		http.onreadystatechange = function() {
			if(http.readyState == 4 && http.status == 200) {
				arr = http.responseText;
				//alert('')
			}
		}
		http.send(params);	
		fireBaseRef3.update( { status:status_val}, function(error) {})
		fireBaseRef4.update( {date:data_date,imagePaths:image_array,otherVehicles:data_othervehicles,methodDescription:data_tiptrickdata,title:data_title,userID:data_userid,vehicleName:data_vehiclename,key:data_key,category:data_category,video:video,range:range}, function(error) {
			//console.log(error)	
		})
		
		if(status_val == 'approved'){
			if(data_type == 'vehicle_image'){
				fireBaseRef5.update( {imagePath:image_array}, function(error) {
					//console.log(error)	
				})
			}else{
				fireBaseRef5.update( {date:data_date,imagePaths:image_array,otherVehicles:data_othervehicles,methodDescription:data_tiptrickdata,title:data_title,userID:data_userid,vehicleName:data_vehiclename,key:data_key,category:data_category,video:video,range:range}, function(error) {
					//console.log(error)	
				})
			}
		}
		setTimeout(function(){ 
			document.getElementById('fireResult').innerText = 'Data updated succesfully';
			document.getElementById("loader").className = "hide";
		}, 2000);	
	}else{
		location.reload();
	}
}
function ChangeCorrection(e){	
	document.getElementById("loader").className = ""; 
	var status_val = e.target.value;
	var image_root_path = e.target.getAttribute("data-cid");
	var fireBaseRef3 = firebase.database().ref(image_root_path);
	var newPostKey = firebase.database().ref().child('posts').push().key;
	if(status_val != ''){
		fireBaseRef3.update( { Status:status_val}, function(error) {})
		setTimeout(function(){ 
			document.getElementById('fireResult').innerText = 'Data updated succesfully';
			document.getElementById("loader").className = "hide";
		}, 2000);	
	}else{
		location.reload();
	}
}
</script>