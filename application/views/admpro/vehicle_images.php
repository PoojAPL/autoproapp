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
      <div class="col-sm-24">
        <div class="form-group addUserButton">          
          <a href="<?php echo adm_base_url();?>/vehicles/add_vh_images" class="btn btn-danger"  title="Sign Out">Add New Image</a>        
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
        <div class="site-form">
          <div class="table-responsive usersData">          	
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>               
                  <th>Date/Time</th>
                  <th class="">Vehicle </th>
                  <th>Image Path</th> 
                  <th>Title</th>                   
                  <th>Status</th>       
                </tr>
                </thead>  
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
							//echo $key.'<br>';
							foreach($v_info['images'] as $img_key => $v_images){?>
							<tr>
                              	<td><?php echo date('Y-m-d H:i:s');?></td>
                                <td>
                                	<?php  
										$get_vehicles = get_vehicles($key);	
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
                                <td><?php echo $v_images['imagePath'];?></td>
                                <td><?php echo $v_images['title'];?></td>
                                <td>
                                	<?php if( $v_images['correctionID'] == ""){?>
                                    <select class="form-control" onchange="ChangeEventListener(event)" data-id="/vehicle-info/<?php echo $key;?>/images/<?php echo $img_key;?>" data-cid=""> 
                                    <?php }else{ ?>
                                    
                                	<select class="form-control" onchange="ChangeEventListener(event)" data-id="/vehicle-info/<?php echo $key;?>/images/<?php echo $img_key;?>"data-cid="/vehicle-corrections/<?php echo $v_images['correctionID'];?>"> 
									<?php } ?>                               
									<?php 
                                    $correction_status = correction_status();
                                    foreach($correction_status as $status){
                                        if($v_images['status'] == $value['Status']){
                                            $selected = 'selected';
                                        }else{
                                            $selected = '';
                                        }
                                        ?>
                                        <option <?php echo $selected;?>><?php echo $status;?></option>
                                    <?php  } ?>
                                  </select>
                                </td>
                              </tr>	
							<?php }
						} ?>
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
</script>