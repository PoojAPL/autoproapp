<?php 
error_reporting(0);
$user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
$outputs1 = $this->session->userdata('login_firebase_user');
 ?>
<input type="hidden" value="<?php echo $getUsersInfo[0]['User_uid'];?>" id="user_uuid" />
<input type="hidden" id="i_email" value="<?php echo $getUsersInfo[0]['email'];?>" />
<input type="hidden" id="i_password" value="<?php echo $outputs1['password'];?>" /> 
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
   	 <div class="col-sm-6">
        <form method="post">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            <div class="form-group"> 
                 <label>Show Status</label>                    
                 <select class="form-control select-field show_status_user_submission" style="width: 170px;">
                    <option value="pending">Waiting For Review</option>
                    <option value="approved">Approved</option> 
                    <option value="rejected">Rejected</option>                        
                </select>
            </div>
        </form>
      </div> 
      <div class="col-sm-6">
        <form method="post">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            <div class="form-group"> 
                 <label>Show Type</label>                    
                 <select class="form-control select-field show_type_user_submission" style="width: 170px;">
                    <option value="all">All</option>
                    <option value="corrections">Correction</option> 
                    <option value="images">Vehicle Images</option>
                    <option value="methods">Method</option> 
                    <option value="tips">Tip</option>                         
                </select>
            </div>
        </form>
      </div> 
   	  <div class="col-sm-6">
        <form method="post" id="search_user_submissions">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            <div class="form-group">                     
                 <input type="text" name="search_key" class="form-control"><button type="submit" class="btn btn-primary custom-button">Search</button>
            </div>
        </form>
      </div> 
     </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="table-responsive userSubmission_data" style="overflow: visible;">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr> 
                  <th>Submitted <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom" data_id="DESC"></a></th>  
                  <th>User</th>                
                  <th>Type</th>  
                  <th>Vehicle</th>  
                  <th>Details</th>
                  <th>Other Vehicles</th>   
                  <th>Images</th>                                 
                  <th>Status</th>                 
                </tr>
              </thead>
              <tbody>
              <tbody>
                	<?php //print_r($get_all_vehicles);
						//foreach($get_all_vehicles as $vehicles){
						$options['auth'] = 'tDpktmFrLHJRZIBCoyPUU68ba4gbnQRUhqdn6y9H'; 
						$cSession = curl_init(); 				
						curl_setopt($cSession,CURLOPT_URL,"https://autopro-75ac3.firebaseio.com/vehicle-info.json?". http_build_query($options));
						curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
						curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "GET");						
						curl_setopt($cSession, CURLOPT_POSTFIELDS,''); 
						curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);	
						curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);		 
						$result_output = curl_exec($cSession);			 
						curl_error($cSession);			  						
						$outputs = json_decode($result_output, true);
						//print_r($outputs);
					   
						foreach($outputs as $key => $v_info){
							//echo $v_info['modifiedTime'].'<br>';
							foreach($v_info['images'] as $img_key => $v_images){
								 $UUID = $img_key;
								 $VehicleID = $key;
								 $Image_path = $v_images['imagePath'];
								 $Title = $v_images['title'];
								 $Status = $v_images['status'];
								 $CorrectionID = $v_images['correctionID'];
								 $save_vehicle_images = save_vehicle_images($UUID,$VehicleID,$Image_path,$Title,$Status,$CorrectionID);
								?>
							<tr>
                              	<td>
									<?php if($v_images['management']['date'] ==""){
										 	  // date('Y-m-d H:i:s');
											   $newDate = date('Y-m-d');;
											   $seconds = time() - strtotime($newDate); // 3600
											   $time = '10:24:15'; 
											   echo secondsToTime($seconds).'<br>';
											   echo date("M d", strtotime($newDate)).' @ '.date('h:i A ', $seconds);
										  }else{
											   $time_data1 = explode(':', $v_images['management']['date']);
											   $date = explode(' ', $time_data1[0]);
											   $originalDate = $date[0];
											   $newDate = date("Y-m-d", strtotime($originalDate));
											   $time = str_replace('-',':',$date[1]);
											   $seconds = time() - strtotime($newDate); // 3600
											   echo secondsToTime($seconds).'<br>';
											   echo date("M d", strtotime($originalDate)).' @ '.date('h:i A ', strtotime($time));;
										  	   //echo $v_images['management']['date'];
										  }
									?>
                                  </td>
                                <td></td>
                                <td></td>
                              
                                <td>
                                	<?php  
										$get_vehicles = get_vehicles_by_id($key);	
										if($get_vehicles == true){							
											$get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
											echo $get_make_name[0]['Make_Name'].' ';
											$get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
											echo $get_models_name[0]['Model_Name'];
											$years = explode(',',$get_vehicles[0]['Years']);?>
											 <?php echo $years[0];?>-<?php echo $years[count($years)-1];?>
										<?php }else{
											echo 'Vehicle ID: '. $key;
										}
									?> 
                                </td>
                                 <td><?php echo $v_images['title'];?></td>
                                 <td></td>
                                 <td><div class="vehicle_images" src="" id="<?php echo $img_key;?>$<?php echo $Image_path;?>"  /></div>
                                 	<img src=""  id="<?php echo $img_key;?>" width="100" />
                                  </td>
                                 <td>
                                	<?php if( $v_images['correctionID'] == ""){?>
                                    <select class="form-control" style="width: 170px;" onchange="ChangeEventListener(event)" data-id="/vehicle-info/<?php echo $key;?>/images/<?php echo $img_key;?>" data-cid=""> 
                                    <?php }else{ ?>
                                    
                                	<select class="form-control" style="width: 170px;" onchange="ChangeEventListener(event)" data-id="/vehicle-info/<?php echo $key;?>/images/<?php echo $img_key;?>"data-cid="/vehicle-corrections/<?php echo $v_images['correctionID'];?>"> 
									<?php } ?>                               
									<?php 
									$correction_status = correction_status();
									foreach($correction_status as $skey => $status){
										if($Status == $status){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										?>
										<option <?php echo $selected;?> value="<?php echo $status;?>"><?php echo $skey;?></option>
									<?php  } ?>
                                  </select>
                                </td>
                              </tr>	
							<?php }
						} ?>
                 </tbody>
              	<!--<tr><td colspan="10"><div class="alert alert-danger">Data not available.</div></td></tr>-->
             <tbody id="user_data">
             <?php 
				  $delete_app_corrections = delete_app_corrections();
				  $options['auth'] = 'tDpktmFrLHJRZIBCoyPUU68ba4gbnQRUhqdn6y9H'; 
				  $cSession = curl_init(); 				
				  curl_setopt($cSession,CURLOPT_URL,"https://autopro-75ac3.firebaseio.com/vehicle-corrections.json?". http_build_query($options));
				  curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
				  curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "GET");						
				  curl_setopt($cSession, CURLOPT_POSTFIELDS,''); 
				  curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);	
				  curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);		 
				  $result_output = curl_exec($cSession);			 
				  curl_error($cSession);			  						
				  $correction_outputs = json_decode($result_output, true);
				 // print_r($outputs);
				 foreach($correction_outputs as $key => $value1){
						$UUID = $value1['id'];;							
						$Vehicle_UUID =  $value1['vehicleInfo'];
						$Feedback_type =  $value1['type'];
						$Status =  $value1['status'];							
						$User_Review =  $value1['description'];
						$User_UUID = $value1['userID'];
						$get_sks_user_info = get_sks_user_info($User_UUID);
						$User_Name = $get_sks_user_info[0]['FirstName'].' '.$get_sks_user_info[0]['FirstName'];
						$User_Email = $get_sks_user_info[0]['Email'];
						$User_Type = 'App User';
						$full_path = "";
						if($value1['type'] == 'images'){						
							foreach($value1['images'] as $images){
								$image_path =  str_replace('/', '%2F', $images);
								//$file_get_contents = file_get_contents('https://firebasestorage.googleapis.com/v0/b/autopro-75ac3.appspot.com/o/'.$image_path);
								//$image_list = json_decode($file_get_contents ,true);
								$base_path = 'https://firebasestorage.googleapis.com/v0/b/autopro-75ac3.appspot.com/o/';
								$full_path .= $base_path.$image_path.'?alt=media'.'|';
							}
							?>
							<tr>
							<td><?php if($value1['management']['date'] ==""){
									  // date('Y-m-d H:i:s');
									   $newDate = date('Y-m-d');;
									   $seconds = time() - strtotime($newDate); // 3600
									   $time = '10:24:15'; 
									   echo secondsToTime($seconds).'<br>';
									   echo date("M d", strtotime($newDate)).' @ '.date('h:i A ', $seconds);
								  }else{
									   $time_data1 = explode(':', $value1['management']['date']);
									   $date = explode(' ', $time_data1[0]);
									   $originalDate = $date[0];
									   $newDate = date("Y-m-d", strtotime($originalDate));
									   $time = str_replace('-',':',$date[1]);
									   $seconds = time() - strtotime($newDate); // 3600
									   echo secondsToTime($seconds).'<br>';
									   echo date("M d", strtotime($originalDate)).' @ '.date('h:i A ', strtotime($time));;
									   //echo $v_images['management']['date'];
								  }
							?></td>
							<!--<td><strong>Username:  </strong><?php echo $User_Name;?><br />
								<strong>E-mail:  </strong><?php echo $User_Email;?><br />
								<strong>Type: </strong><?php echo $User_Type;?>
							</td>-->
							<td><?php echo $User_UUID;?></td>
                            <td><?php echo $Feedback_type;?></td>  
							<td><?php  
									$get_vehicles = get_vehicles($value['Vehicle_UUID']);	
									if($get_vehicles == true){							
										$get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
										echo $get_make_name[0]['Make_Name'].' ';
										$get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
										echo $get_models_name[0]['Model_Name'];
										$years = explode(',',$get_vehicles[0]['Years']);?>
										 <?php echo $years[0];?>-<?php echo $years[count($years)-1];?>
									<?php }else{
										echo 'Vehicle: '.$value1['vehicleInfo'];
									}
								?>                           
								</td>
							                      
							<td><?php echo $User_Review;?></td>  
                            <td></td>
                            <td></td>
							<td>
								<select class="form-control feedbackStatus" data-type="<?php echo $value1['type'];?>" onchange="ChangeCorrection(event)" data-cid="/vehicle-corrections/<?php echo $value1['id'];?>">                                
									<?php 
									$correction_status = correction_status();
									foreach($correction_status as $skey => $status){
										if($Status == $status){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										?>
										<option <?php echo $selected;?> value="<?php echo $status;?>"><?php echo $skey;?></option>
									<?php  } ?>
								  </select>
							</td>            
						</tr>
					   <?php 
				     $vehcile_info = $value1['vehicleInfo'];
					 $save_app_corrections = save_app_corrections($UUID,$User_Email,$User_Name,$User_Type,$Vehicle_UUID,$Feedback_type,$Status,$User_Review,$full_path,$User_UUID,$vehcile_info );
				  }else if( ($value1['type'] == 'keymaking') || ($value1['type'] == 'tip_tricks') ){
					  $UUID = $key;
					  $full_path1 = "";
					  foreach($value1['pictures'] as $images){
						  $image_path =  str_replace('/', '%2F', $images);
						  $base_path1 = 'https://firebasestorage.googleapis.com/v0/b/autopro-75ac3.appspot.com/o/';
						  $full_path1 .= $base_path.$image_path.'?alt=media'.'|';
					   }
					  $likes = $value1['likes']; 
					  $dislikes = $value1['dislikes']; 
					  $info = $value1['steps'];
				  	  $save_app_corrections2 = save_app_corrections2($UUID,$User_Email,$User_Name,$User_Type,$Feedback_type,$Status,$User_UUID,$likes,$dislikes,$info, $full_path1);
				     ?>                  		
                  	<tr>
                    	<td><?php if($value1['management']['date'] ==""){
									  // date('Y-m-d H:i:s');
									   $newDate = date('Y-m-d');;
									   $seconds = time() - strtotime($newDate); // 3600
									   $time = '10:24:15'; 
									   echo secondsToTime($seconds).'<br>';
									   echo date("M d", strtotime($newDate)).' @ '.date('h:i A ', $seconds);
								  }else{
									   $time_data1 = explode(':', $value1['management']['date']);
									   $date = explode(' ', $time_data1[0]);
									   $originalDate = $date[0];
									   $newDate = date("Y-m-d", strtotime($originalDate));
									   $time = str_replace('-',':',$date[1]);
									   $seconds = time() - strtotime($newDate); // 3600
									   echo secondsToTime($seconds).'<br>';
									   echo date("M d", strtotime($originalDate)).' @ '.date('h:i A ', strtotime($time));;
									   //echo $v_images['management']['date'];
								  }
							?></td>
                        <!--<td><strong>Username:  </strong><?php echo $User_Name;?><br />
                        	<strong>E-mail:  </strong><?php echo $User_Email;?><br />
                            <strong>Type: </strong><?php echo $User_Type;?>
                        </td>-->
                        <td><?php echo $User_UUID;?></td>
                        <td>Steps: <?php echo $value1['steps'];?></td>
                        <td><?php echo $value1['type'];?></td>                        
                        <td>likes: <?php echo $value1['likes'];?><br /> Dislikes: <?php echo $value1['dislikes'];?></td>  
                        <td></td>
                        <td></td>
                        <td>
                        	<select class="form-control feedbackStatus" data-type="<?php echo $value1['type'];?>" onchange="ChangeCorrection(event)" data-cid="/vehicle-corrections/<?php echo $key;?>">                                
                                <?php 
									$correction_status = correction_status();
									foreach($correction_status as $skey => $status){
										if($Status == $status){
											$selected = 'selected';
										}else{
											$selected = '';
										}
										?>
										<option <?php echo $selected;?> value="<?php echo $status;?>"><?php echo $skey;?></option>
									<?php  } ?>
                                </select>    
                        </td>            
                    </tr>
                  	
				  <?php }
				} ?>     
              </tbody>
              <tbody>
                	<?php foreach( $results  as $value){?>
                	<tr>
                    	<td>
                         <?php 
                           $newDate = date('Y-m-d');;
                           $seconds = time() - strtotime($newDate); // 3600
                           $time = '10:24:15'; 
                           echo secondsToTime($seconds).'<br>';
                           echo date("M d", strtotime($newDate)).' @ '.date('h:i A ', $seconds);
						 ?>  
						</td>
                        <td> 
                        	<?php 
								$get_users_info = get_users_info( $value['User_UUID'] ); 
								echo $get_users_info[0]['FirstName'].' '.$get_users_info[0]['LastName'];
							?> 
                        </td>
                        <td>Method</td>
                    	<td> 
                        	<?php 
								  $Vehicles_UUID = $value['Vehicle_UUID'];
								  $get_vehicles = get_vehicles($Vehicles_UUID);
								  $years = explode(',',$get_vehicles[0]['Years']);
								  $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
								  echo $get_models_name[0]['Model_Name'].', '.$years[0].'-'.$years[count($years)-1];
							  ?>
                        </td>
                        <td> <?php echo $value['Title'];?> 
                        <br /> <?php echo $value['Content'];?> </td>
                        <td></td>
                        <td> 
                        	<?php 
								$get_image_type = get_image_type( $value['Images_UUID'] ); 
								echo $get_image_type[0]['Name'];
							?> 
                        </td>
                        <td> <?php echo $value['Status'];?> </td>
                        
                         <!--<td>
                              <a href="<?php echo adm_base_url();?>/edit_method/<?php echo $value['Id'];?>" type="button" class="btn btn-success" >Edit</a> 
                              <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['Id'];?>, '<?php echo adm_base_url();?>/delete_method/')" class="btn btn-danger" >Delete</a>
                           </td>-->
                    </tr>
                    <?php } ?>
                </tbody>
            </table>            
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->
<script src="https://www.gstatic.com/firebasejs/3.6.3/firebase.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/md5.js"></script>
<script>
  // Initialize Firebase
  var uuid = generateUUID();  
  function generateUUID(){
    var d = new Date().getTime();
    if(window.performance && typeof window.performance.now === "function"){
        d += performance.now(); //use high-precision timer if available
    }
    var uuid = 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = (d + Math.random()*16)%16 | 0;
        d = Math.floor(d/16);
        return (c=='x' ? r : (r&0x3|0x8)).toString(16);
    });
    return uuid;
}
 var config = {
    apiKey: "AIzaSyDBwhVzLZRZVf4tFRqRQa6dD0KgUl1IBj4",
    authDomain: "autopro-75ac3.firebaseapp.com",
    databaseURL: "https://autopro-75ac3.firebaseio.com",
    storageBucket: "autopro-75ac3.appspot.com",
    messagingSenderId: "905741934132"
  };
 /*var config = {
    apiKey: "AIzaSyAOGEGaxRqauTKn14rrg7NsfSpgAgqmWQ4",
    authDomain: "american-key.firebaseapp.com",
    databaseURL: "https://american-key.firebaseio.com",
    storageBucket: "american-key.appspot.com",
    messagingSenderId: "699615089846"
  };*/
  firebase.initializeApp(config);
  /*var changeButton = document.getElementById("vImagesStatus"); 
  changeButton.addEventListener('change' , function(e) { 
  		console.log(e.target.value)
  })*/
  
function ChangeEventListener(e){
//console.log(e);
var status_val = e.target.value;
var full_path = e.target.getAttribute("data-id");
//var full_path = '/users/-KTiWvW7RHSx0twe4pHM';
var correction_path = e.target.getAttribute("data-cid");	
//console.log(full_path);

/*----------------------Update Image Status -------------------------------------------------*/	

   var fireBaseRef = firebase.database().ref(full_path);
   var fireBaseRef3 = firebase.database().ref(full_path+'/management');
   // var fireBaseRef = firebase.database().ref("/users/"+folderName+'/images/');
   document.getElementById("loader").className = ""; 
   var d = new Date();
   var modifieddate = d.getFullYear()+'/'+d.getMonth()+'/'+d.getDate()+' '+d.getHours()+'-'+d.getMinutes()+'-'+d.getSeconds()+':'+d.toString().match(/([A-Z]+[\+-][0-9]+)/)[1];
   var user_id_mng = document.getElementById('user_uuid').value;
   fireBaseRef3.update( {userID:user_id_mng, date: modifieddate}, function(error) {
   })
   fireBaseRef.update( { status:status_val}, function(error) {
		if (error !== null) {
			alert(error);
			document.getElementById("loader").className = "hide"; 
		}else{					 
		   document.getElementById("loader").className = "hide";  
		}
	});
		
/*----------------------Update Correction ID Status --------------------------------------------*/	
	if(correction_path != ""){
		var fireBaseRef2 = firebase.database().ref(correction_path);
		var fireBaseRef4 = firebase.database().ref(correction_path+'/management');
		fireBaseRef4.update( {userID:user_id_mng, date: modifieddate}, function(error) {
   		})		  
		fireBaseRef2.update( { status:status_val}, function(error) {
			if (error !== null) {
				alert(error);
				document.getElementById("loader").className = "hide"; 
			}else{					 
			   document.getElementById("loader").className = "hide";  
			}
		});	
	}
}

/*--------------------------------Correction Firebase Functions --------------------------------*/

const auth = firebase.auth();
var database = firebase.database();

firebase.auth().signOut().then(function() {
  //console.log('Sign-out successful.')
}, function(error) {
  //console.log(error);
});

  
 
var arr ="";;
var array = [];  
var html = "";
var preObject = document.getElementById('object');


/*----------------------Login User-----------------------------------------------*/

const loginEmail = document.getElementById('i_email');
const loginPassword = document.getElementById('i_password'); 

const i_email = loginEmail.value;
const i_password = loginPassword.value;

const encrypt_passw = calcMD5(i_password);		
const encrypt_64 = Base64.encode(encrypt_passw);

const returnPromise1 = auth.signInWithEmailAndPassword(i_email, encrypt_64);
var user = firebase.auth().currentUser;
var storage = firebase.storage();
firebase.auth().onAuthStateChanged(function(user) {
	if (user) {
		getImages();
		} else {
	  console.log('No user is signed in.')
	}
});
var i=0;
var vehicle_images = document.getElementsByClassName("vehicle_images");

function getImages(){	
			
		    var image_data = (vehicle_images[i].id).split('$');		   
		    var img_path = image_data[1];
			var img_id = image_data[0];			
			 storage.ref(img_path).getDownloadURL().then(function(url) {				 
			  var img = document.getElementById(img_id);
			  img.src = url;					
			   if(i < vehicle_images.length){
					getImages();
				}			
			}).catch(function(error) {
			  // Handle any errors
			  if(i < vehicle_images.length){
					getImages();
				}
			
			});			
			 i++;
	
	}
/*----------------------/ Login User-----------------------------------------------*/
var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"];
var correction_date1 = "";
var d = new Date();
var date = d.getDate()+'-'+d.getMonth()+'-'+d.getFullYear()+'-'+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
var starCountRef = firebase.database().ref('/vehicle-corrections');
starCountRef.on('value', function(snapshot) {  
  //console.log(snapshot.val())
 // preObject.innerText =  JSON.stringify(snapshot.val(), 3);
  arr = JSON.stringify(snapshot.val(), 3);
  var parsed = JSON.parse(arr);
  for(var x in parsed){
	  //array.push(parsed[x]);
	  //console.log(x, parsed[x]['type']);
	     var status = parsed[x]['status'];
		 var p_selected = '';
		 var approved = '';
		 var rejected = '';
		 var skey = "";
		 if( status == 'pending'){
			 p_selected = 'selected';
			 approved = '';
			 rejected = '';
			 skey = 'Waiting for Review';
		 }else if( status == 'approved'){
			 p_selected = '';
			 approved = 'selected'
			 rejected = '';
			  skey = 'Approved';
		 }else if( status == 'rejected'){
			 p_selected = '';
			 approved = '';
			 rejected = 'selected';
			 skey = 'Rejected'; 
		 }
		
	    var correction_date = d.getFullYear()+'/'+d.getMonth()+'/'+d.getDate()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds();
		var correction_date2 = monthNames[d.getMonth()]+' '+d.getDate();
		//console.log(correction_date);
		
		var timeout =  new Date(correction_date);
		var seconds = timeout.getTime();
		var date1 = new Date(seconds * 1000);
		var hh = date1.getUTCHours();
		var mm = date1.getUTCMinutes();
		var ss = date1.getSeconds();
		if (hh < 10) {hh = "0"+hh;}
		if (mm < 10) {mm = "0"+mm;}
		if (ss < 10) {ss = "0"+ss;}
		var t = hh+":"+mm;		
		var mod_date = tConvert(t);
		var hours = timeout.getHours();
		if(parsed[x]['type'] == 'images'){
		 html +='<tr><td>'+hours+'hours ago <br>'+correction_date2+' @ '+mod_date+'</td><td>'+parsed[x]['userID']+'</td><td>'+parsed[x]['type']+'</td><td>Vehicle: '+parsed[x]['vehicleInfo']+'</td><td></td><td></td><td></td><td><select class="form-control feedbackStatus" data-type="'+parsed[x]['type']+'" onchange="ChangeCorrection(event)" data-cid="/vehicle-corrections/'+parsed[x]['id']+'"><option '+p_selected+' value="pending">'+skey+'</option><option '+approved+' value="approved">'+skey+'</option><option '+rejected+' value="rejected">'+skey+'</option></select></td></tr>';
		 }else  if( (parsed[x]['type'] == 'keymaking') || (parsed[x]['type'] == 'tip_tricks') ){
			 //console.log(parsed[x]); 
			 //console.log(Object.values(array[1]))
			html +='<tr><td>'+hours+'hours ago <br>'+correction_date2+' @ '+mod_date+'</td><td></td><td>Steps: '+parsed[x]['steps']+'</td><td>'+parsed[x]['type']+'</td><td>Likes: '+parsed[x]['likes']+'<br>Dislikes: '+parsed[x]['dislikes']+'</td><td></td><td></td><td><select class="form-control feedbackStatus" data-type="'+parsed[x]['type']+'" onchange="ChangeCorrection(event)" data-cid="/vehicle-corrections/'+x+'"><option '+p_selected+' value="pending">'+skey+'</option><option '+approved+' value="approved">'+skey+'</option><option '+rejected+' value="rejected">'+skey+'</option></select></td></tr>';
		 }
  }
  document.getElementById('user_data').innerHTML = html;
});
//console.log(array);

/*----------------------Update Correction ID Status --------------------------------------------*/	
function ChangeCorrection(e){	
	var status_val = e.target.value;
	
	var correction_path = e.target.getAttribute("data-cid");
	var type = e.target.getAttribute("data-type");	
	var modifieddate = d.getFullYear()+'/'+d.getMonth()+'/'+d.getDate()+' '+d.getHours()+'-'+d.getMinutes()+'-'+d.getSeconds()+':'+d.toString().match(/([A-Z]+[\+-][0-9]+)/)[1];
	var fireBaseRef2 = firebase.database().ref(correction_path);
	var fireBaseRef3 = firebase.database().ref(correction_path+'/management');
	var user_id_mng = document.getElementById('user_uuid').value;
	fireBaseRef3.set( { userID:user_id_mng, date: modifieddate}, function(error) {
	
	})		  
	fireBaseRef2.update( { status:status_val, modifiedTime: modifieddate}, function(error) {
		if (error !== null) {
			alert(error);
			document.getElementById("loader").className = "hide"; 
		}else{
			var base_path = '';
			if(status_val == 'approved'){
					if( (type == 'tip_tricks') || (type == 'keymaking') ){
						if(type == 'tip_tricks'){
							base_path = 'tip-tricks-methods';
						}else if(type == 'keymaking'){
							base_path = 'keymaking-methods';
						}
						const i_email = loginEmail.value;
						const i_password = loginPassword.value;
						const auth = firebase.auth();
						const encrypt_passw = calcMD5(i_password);		
						const encrypt_64 = Base64.encode(encrypt_passw);
						// Sign In
						const returnPromise = auth.signInWithEmailAndPassword(i_email, encrypt_64);	
						returnPromise.catch( e =>  document.getElementById('getError').value = e.message);
						setTimeout(function(){ 
							var error1 = document.getElementById('getError').value;
							if(error1 === ""){
								var starCountRef1 = firebase.database().ref(correction_path);
								starCountRef1.on('value', function(snapshot) {
									console.log(snapshot.val().type)
									 var arr_json = JSON.stringify(snapshot.val(), 3);
									 var parsed_son = JSON.parse(arr_json);
									 var fireBaseRef = firebase.database().ref(base_path+'/'+uuid);						  
									 fireBaseRef.set(parsed_son, function(error) {
										if (error != null) {
											alert(error);
										}else{
										   document.getElementById('fireResult').innerText = 'Data added succesfully';
										   document.getElementById("loader").className = "hide";  
										}
									 })
								})
							
							
							}else{
								alert('You are not allowed to add Update Vesrsion');
								document.getElementById("loader").className = "hide"; 
							}
							
						}, 2000);	
					}
			}
		   document.getElementById("loader").className = "hide";  
		}
	});	
}
function tConvert (time) {  
  time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
  if (time.length > 1) { // If time format correct
	time = time.slice (1);  // Remove full string match value
	time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
	time[0] = +time[0] % 12 || 12; // Adjust hours
  }
  return time.join (''); // return adjusted time or original string
}


/*var starCountRef_img = firebase.database().ref('/vehicle-info');
starCountRef_img.on('value', function(snapshot) {
	var img_arr = JSON.stringify(snapshot.val(), 3);
	var imgparsed = JSON.parse(img_arr);
	for(var im in imgparsed){
		//console.log(im);
		for(var img in imgparsed[im]['images']){
		//array.push(parsed[x]);
			var img_path = imgparsed[im]['images'][img]['imagePath'];
			var storage = firebase.storage();
			storage.ref(img_path).getDownloadURL().then(function(url) {
			  var xhr = new XMLHttpRequest();
			  xhr.responseType = 'blob';
			  xhr.onload = function(event) {
				var blob = xhr.response;
			  };
			  xhr.open('GET', url);
			  xhr.send();
			  var img = document.getElementById(im);
			  img.src = url;
			}).catch(function(error) {
			  // Handle any errors
			});
		}
		
	 }
});
*/		   
	
</script>