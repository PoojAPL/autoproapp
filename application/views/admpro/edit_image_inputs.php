<?php 
error_reporting(0);
$outputs1 = $this->session->userdata('login_firebase_user');
$user_type = $getUsersInfo[0]['type'];
if( ($user_type == 0) || ($user_type == 1) || ($user_type == 2) ){
	$status = 'approved';
}else{
	$status = 'pending';
} 
?>  
<form method="post">
    <input type="hidden" value="<?php echo $getUsersInfo[0]['User_uid'];?>" id="user_uuid" />
    <input type="hidden" id="i_email" value="<?php echo $getUsersInfo[0]['email'];?>" />
    <input type="hidden" id="i_password" value="<?php echo $outputs1['password'];?>" />
    <input type="hidden" id="status" value="<?php echo $status;?>" />
    <input type="text" class="form-control" id="imagename" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="<?php echo $value;?>" style="width: 130px;" />
    <input type="hidden" name="columnName" id="columnName" value="<?php echo $column;?>" />
    <button type="button" id="btn" class="btn btn-success custom-button2"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <img crossOrigin="Anonymous" src="<?php echo $value;?>" id="image_vale" style="display:none;" />
    <button type="button" class="btn btn-danger custom-button2  vh_input_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
     <input type="hidden" id="getError" />
     <input type="hidden" id="vehicle_id"  value="<?php echo $dataId;?>" />
     <input type="hidden" id="UUID" value="<?php echo $img_uuid;?>" />
     <input type="hidden" id="data_id" value="<?php echo $dataId;?>" />
</form>
<canvas id="mcanvas" height="500" width="500" style="display:none"></canvas>
<script>
load();
var gCanvas;
var gCtx;
function load(){
  console.log("loaded");
  gCanvas = document.getElementById("mcanvas");
 
  if (gCanvas.getContext){
	gCtx = gCanvas.getContext("2d");
  } else console.log("no Canvas?");
}
/*------------------------- Firebase Function JS -------------------------------------*/
var uuid = document.getElementById('UUID').value; 

//var bse_url = "/";
var bse_url = "http://localhost/autoproapp/";

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
const auth = firebase.auth();

var loginEmail = document.getElementById('i_email');
var loginPassword = document.getElementById('i_password');
var imageAddButton = document.getElementById('imagename');

imageAddButton.addEventListener('change' , e => {
	var file_path = e.target.value;
	var storageRef = firebase.storage().ref();
	document.getElementById('image_vale').src = file_path;
	
})
var vehicleImageButton = document.getElementById('btn');
vehicleImageButton.addEventListener('click' , e => {
		var columnName = document.getElementById('columnName').value;
		var id = document.getElementById('data_id').value;
		var image_name = document.getElementById('imagename').value;
		var http = new XMLHttpRequest();
		var url = bse_url+'admin/vehicles/update_vehicle_image1';
		var params = "columnName="+columnName+"&id="+id+"&image_name="+image_name;
		http.open("POST", url, true);		
		//Send the proper header information along with the request
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		http.onreadystatechange = function() {//Call a function when the state changes.
			if(http.readyState == 4 && http.status == 200) {
				console.log(http.responseText);
				
			}
		}
		http.send(params);
			
		document.getElementById("loader").className = ""; 
		var file_path = e.target.value;
		var storageRef = firebase.storage().ref();
		var sampleImage = document.getElementById('image_vale'),
		img_canvas_path1 = doProcess(sampleImage);
		//console.log(img_canvas_path1);
		var img_canvas_path = img_canvas_path1.replace("data:image/png;base64,", "");
		 //var uInt8Array = new Uint8Array(img_canvas_path);
		//console.log(img_canvas_path1);	
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
					var d = new Date();
   var modifieddate = d.getFullYear()+'/'+d.getMonth()+'/'+d.getDate()+' '+d.getHours()+'-'+d.getMinutes()+'-'+d.getSeconds()+':'+d.toString().match(/([A-Z]+[\+-][0-9]+)/)[1];
				 	var updates = {};
					var uploader = document.getElementById('uploader');
					var folderName = document.getElementById('vehicle_id').value;
					var userID = document.getElementById('user_uuid').value;
					var correctionId = '';
					var file_name = '';
					var title = '';
					var status = document.getElementById('status').value;
					//alert(folderName)
					var storageRef =  firebase.storage().ref('/vehicle-info/'+folderName+'/'+folderName+'_image.png');
					//var storageRef =  firebase.storage().ref('images/'+folderName+'/'+file.name); 
					var task = storageRef.putString(img_canvas_path,'base64');
					
					var fireBaseRef = firebase.database().ref("/vehicle-info/"+folderName+'/images/'+uuid);
										
					var data = {correctionID: correctionId, imagePath: 'images/'+folderName+'/'+folderName+'_image.png', status:status,userID: userID,title: title}
					updates["/vehicle-info/"+folderName+'/images/'+uuid] = data;
			 		const returnPromise = firebase.database().ref().update(updates);
					var fireBaseRef4 = firebase.database().ref("/vehicle-info/"+folderName+'/images/'+uuid+'/management');
						fireBaseRef4.update({userID:userID, date: modifieddate}, function(error) {
					})
					document.getElementById("loader").className = "hide";					 
			}else{
				/*alert('You are not allowed to add Image');*/
				document.getElementById("loader").className = "hide"; 
			}
		}, 2000);
})
function doProcess(f){	
	var o=[];
	var reader = new FileReader();
	reader.onload = (function(theFile) {
		var img = new Image();
		img.src = theFile;
		img.onload = function(){
		  gCtx.clearRect(0, 0, gCanvas.width, gCanvas.height);
		  gCtx.drawImage(img,0,0);
		}
		return;
	})(f);
	//console.log(reader);
    return convertCanvasToImage(gCanvas);
	//console.log(img_canvas_path1)
}
function convertCanvasToImage(gCanvas) {
	//console.log(gCanvas)
	var image = new Image();
	image.src = gCanvas.toDataURL("image/png");
	//return image;
	return gCanvas.toDataURL("image/png");
}
</script>

