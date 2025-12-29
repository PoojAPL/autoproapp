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
          <a href="<?php echo adm_base_url();?>/add_update_version" class="btn btn-danger"  title="Sign Out">Add New Update Version</a>        
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
                  <th>App</th>	           
                  <th>Update Heading</th> 
                  <th>Update Button</th>                   
                  <th>Message</th>
                  <th>Force</th>  
                  <th>Cancel Button</th>         
                 </tr>
                </thead> 
                <tbody id="user_data">
                	<?php //print_r($get_all_vehicles);						
					$options['auth'] = 'tDpktmFrLHJRZIBCoyPUU68ba4gbnQRUhqdn6y9H'; 
					$cSession = curl_init(); 				
					curl_setopt($cSession,CURLOPT_URL,"https://autopro-75ac3.firebaseio.com/version-ios.json?". http_build_query($options));
					curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
					curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "GET");						
					curl_setopt($cSession, CURLOPT_POSTFIELDS,''); 
					curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);	
					curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);		 
					$result_output = curl_exec($cSession);			 
					curl_error($cSession);			  						
					$outputs = json_decode($result_output, true);
					//print_r($outputs);
					foreach($outputs as $key => $v_versions){?>
						<tr>
						  <td><strong>App: </strong><?php echo $key;?><br />
						  <strong>Version: </strong><?php echo $v_versions['version'];?><br />
						  <strong>Url: </strong><?php echo $v_versions['url'];?></td>
						  <td><?php echo $v_versions['updateHeading'];?></td>
						  <td><?php echo $v_versions['updateButton'];?></td>
						  <td><div style="width:210px;"><?php echo $v_versions['message'];?></div></td>
						  <td><?php echo $v_versions['force'];?></td>
						  <td><?php echo $v_versions['cancelButton'];?></td>
						</tr>
					<?php } ?>
                    <?php //print_r($get_all_vehicles);						
					$options['auth'] = 'tDpktmFrLHJRZIBCoyPUU68ba4gbnQRUhqdn6y9H'; 
					$cSession = curl_init(); 				
					curl_setopt($cSession,CURLOPT_URL,"https://autopro-75ac3.firebaseio.com/version-android.json?". http_build_query($options));
					curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
					curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "GET");						
					curl_setopt($cSession, CURLOPT_POSTFIELDS,''); 
					curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);	
					curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);		 
					$result_output = curl_exec($cSession);			 
					curl_error($cSession);			  						
					$outputs = json_decode($result_output, true);
					//print_r($outputs);
					foreach($outputs as $key => $v_versions){?>
						<tr>
						  <td><strong>App: </strong><?php echo $key;?><br />
						  <strong>Version: </strong><?php echo $v_versions['version'];?><br />
						  <strong>Url: </strong><?php echo $v_versions['url'];?></td>
						  <td><?php echo $v_versions['updateHeading'];?></td>
						  <td><?php echo $v_versions['updateButton'];?></td>
						  <td><div style="width:210px;"><?php echo $v_versions['message'];?></div></td>
						  <td><?php echo $v_versions['force'];?></td>
						  <td><?php echo $v_versions['cancelButton'];?></td>
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

const auth = firebase.auth();
var database = firebase.database();

firebase.auth().signOut().then(function() {
  console.log('Sign-out successful.')
}, function(error) {
  console.log(error);
});

/*----------------------Login User-----------------------------------------------*/

const loginEmail = document.getElementById('i_email');
const loginPassword = document.getElementById('i_password'); 

const i_email = loginEmail.value;
const i_password = loginPassword.value;

const encrypt_passw = calcMD5(i_password);		
const encrypt_64 = Base64.encode(encrypt_passw);

const returnPromise1 = auth.signInWithEmailAndPassword(i_email, encrypt_64);
var user = firebase.auth().currentUser;

firebase.auth().onAuthStateChanged(function(user) {
	if (user) {
		//console.log(user)	   
	} else {
	  console.log('No user is signed in.')
	}
});

/*----------------------/ Login User-----------------------------------------------*/

var arr ="";;
var arr1 ="";;
var array = [];
var array1 = [];
var html = "";
var starCountRef = firebase.database().ref('/version-ios');
starCountRef.on('value', function(snapshot) {  
  //console.log(snapshot.val())
 // preObject.innerText =  JSON.stringify(snapshot.val(), 3);
  html = "";
  arr = JSON.stringify(snapshot.val(), 3);
  var parsed = JSON.parse(arr);
  for(var x in parsed){
	  array.push(parsed[x]);
  }
  for(i=0; i < array.length; i++){
	 //console.log(array); 
	 html +='<tr><td><strong>App: </strong>ios<br><strong>Version: </strong>'+array[i]['version']+'<br><strong>Url: </strong>'+array[i]['url']+'</td><td>'+array[i]['updateHeading']+'</td><td>'+array[i]['updateButton']+'</td><td><div style="width:210px;">'+array[i]['message']+'</div></td><td>'+array[i]['force']+'</td><td>'+array[i]['cancelButton']+'</td></tr>';
	
  }
   document.getElementById('user_data').innerHTML = html;
});

var starCountRef1 = firebase.database().ref('/version-android');
starCountRef1.on('value', function(snapshot) {  
  //console.log(snapshot.val())
 // preObject.innerText =  JSON.stringify(snapshot.val(), 3);
  arr1 = JSON.stringify(snapshot.val(), 3);
  var parsed = JSON.parse(arr1);
  for(var x in parsed){
	  array1.push(parsed[x]);
  }
  for(i=0; i < array1.length; i++){
	 //console.log(array1[i]); 
	 html +='<tr><td><strong>App: </strong>android<br><strong>Version: </strong>'+array1[i]['version']+'<br><strong>Url: </strong>'+array1[i]['url']+'</td><td>'+array1[i]['updateHeading']+'</td><td>'+array1[i]['updateButton']+'</td><td><div style="width:210px;">'+array1[i]['message']+'</div></td><td>'+array1[i]['force']+'</td><td>'+array1[i]['cancelButton']+'</td></tr>';
	
  }
   document.getElementById('user_data').innerHTML = html;
   html = "";
});


/*----------------------Update Image Status -------------------------------------------------*/	

  /* var fireBaseRef = firebase.database().ref(full_path);
   // var fireBaseRef = firebase.database().ref("/users/"+folderName+'/images/');
   document.getElementById("loader").className = ""; 
   fireBaseRef.update( { status:status_val}, function(error) {
		if (error !== null) {
			alert(error);
			document.getElementById("loader").className = "hide"; 
		}else{					 
		   document.getElementById("loader").className = "hide";  
		}
	});*/
		
			

</script>