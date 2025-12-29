<?php 
error_reporting(0);
$user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
$outputs1 = $this->session->userdata('login_firebase_user'); ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php }
	  	$user_type = $getUsersInfo[0]['type'];
		if( ($user_type == 0) || ($user_type == 1) || ($user_type == 2) ){
			$status = 'approved';
		}else{
			$status = 'pending';
		}
	   ?>
      <div id="fireResult"></div>
      <form class="site-form">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <!--<h2 class="titleheadng">Add Model</h2>-->
        <input type="hidden" value="<?php echo $getUsersInfo[0]['User_uid'];?>" id="user_uuid" />
        <input type="hidden" id="i_email" value="<?php echo $getUsersInfo[0]['email'];?>" />
        <input type="hidden" id="i_password" value="<?php echo $outputs1['password'];?>" />
        <input type="hidden" id="status" value="<?php echo $status;?>" />
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
                  <select class="form-control select_obp_Models2" name="Make_UUID">
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
                  <select class="form-control" name="Vehicle_UUID" id="Vehicle_ID">
                    <option value="">Select vehicle</option>                    
                  </select>
                </div>
              </div>
            </div> 
        </fieldset> 
        <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Title</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                 <input type="text" class="form-control" id="title" />
                </div>
              </div>
            </div>      
        <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Image</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                 <input type="file" class="form-control" id="file" />
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
             <input type="button" id="fileButton" value="upload" class="btn btn-success">
            <!--<a href="<?php echo adm_base_url();?>/vehicles/v_images" class="btn btn-danger" >Cancel</a>-->
          </div>
            <div id="uploader" class="hide">0</div>
        </div>
        <input type="hidden" id="getError" />
      </form>
    </div>
  </div>
</div>
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

  
  var uploader = document.getElementById('uploader');
  var fileButton = document.getElementById('fileButton');
  
  const loginEmail = document.getElementById('i_email');
  const loginPassword = document.getElementById('i_password');
  
  fileButton.addEventListener('click' , function(e) { 
  		document.getElementById("loader").className = ""; 
  		const i_email = loginEmail.value;
		const i_password = loginPassword.value;
		const auth = firebase.auth();
		const encrypt_passw = calcMD5(i_password);		
		const encrypt_64 = Base64.encode(encrypt_passw);
		// Sign In
		const returnPromise = auth.signInWithEmailAndPassword(i_email, encrypt_64);
		returnPromise.catch( e =>  document.getElementById('getError').value = e.message);		
		setTimeout(function(){ 
			var error = document.getElementById('getError').value;
			if(error === ""){
				add_images();
			}else{
				alert('You are not allowed to add Image');
				document.getElementById("loader").className = "hide"; 
			}
			
		}, 2000);
  })
  
  function add_images(){	   
	 	 //alert('')
		//var file = e.target.files[0];
		var file = document.getElementById('file').files[0];
		var folderName = document.getElementById('Vehicle_ID').value;
		var userID = document.getElementById('user_uuid').value;
		var correctionId = document.getElementById('correctionId').value;
		var file_name = file.name;
		var title = document.getElementById('title').value;
		var status = document.getElementById('status').value;
		console.log(folderName)
		if(folderName == ""){
			alert('Please select vehicle');
			document.getElementById("loader").className = "hide"; 
		}else{
			var storageRef =  firebase.storage().ref('vehicle-info/'+folderName+'/'+file.name);
			//var storageRef =  firebase.storage().ref('images/'+folderName+'/'+file.name); 
			var task = storageRef.put(file);
			var fireBaseRef = firebase.database().ref("/vehicle-info/"+folderName+'/images/'+uuid);
			var fireBaseRef_mng = firebase.database().ref("/vehicle-info/"+folderName+'/images/'+uuid+'/management');
			var d = new Date();
   		var modifieddate = d.getFullYear()+'/'+d.getMonth()+'/'+d.getDate()+' '+d.getHours()+'-'+d.getMinutes()+'-'+d.getSeconds()+':'+d.toString().match(/([A-Z]+[\+-][0-9]+)/)[1];
   			var user_id_mng = document.getElementById('user_uuid').value;
			fireBaseRef_mng.set( {userID:user_id_mng, date: modifieddate}, function(error) {
				 
			  });
			// var fireBaseRef = firebase.database().ref("/users/"+folderName+'/images/');
			 fireBaseRef.set( {correctionID: correctionId, imagePath: '/vehicle-info/'+folderName+'/images/'+file_name, status:status,userID: userID,title: title}, function(error) {
				  if (error !== null) {
					  alert(error);
				  }else{
					 document.getElementById('fireResult').innerText = 'Image added succesfully';
					 document.getElementById("loader").className = "hide";  
				  }
			  });			
			  task.on('state_changed', 					
				function progress(snapshot){
					var percentage = (snapshot.bytesTransferred / snapshot.totalBytes)*100;
					//alert(percentage)
					uploader.innerText = percentage+'%';
				},				
				function error(err){
					//alert('Error')
				}, 
				function complete(){
					//alert('Completed')
					document.getElementById("loader").className = "hide"; 
				}
			) 
		}
 }
</script>