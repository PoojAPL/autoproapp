<?php 
error_reporting(0);
$user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
$outputs1 = $this->session->userdata('login_firebase_user');
 ?>
<input type="hidden" value="<?php echo $getUsersInfo[0]['User_uid'];?>" id="user_uuid" />
<input type="hidden" id="i_email" value="<?php echo $getUsersInfo[0]['email'];?>" />
<input type="hidden" id="i_password" value="<?php echo $outputs1['password'];?>" />
<input type="hidden" id="getError" />
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
      <div class="col-sm-6">
      		<div class="form-group">
            	<label>Show feedback Type: </label>
                <select class="form-control select-field show_feedback_types" data-id="Feedback_type">
                	<option value="all">All</option>                    
            		<?php  $get_users_type = feedback_type();
					foreach( $get_users_type as  $feed_type){ ?>
						<option value="<?php echo $feed_type;?>"><?php echo $feed_type;?></option>
					<?php } ?>          
                </select>
            </div>
      </div>
      <div class="col-sm-6">
      		<form method="post" id="feed_search">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">
                    <label>Search: </label>
                    <input type="text" name="searchkey" class="form-control" />
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
      </div>
      <div class="col-sm-12">
        <div class="form-group addUserButton">          
          <a href="<?php echo adm_base_url();?>/add_correction" class="btn btn-danger"  title="Sign Out">Add New Correction</a>        
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
     <div id="fireResult"></div>
        <div class="site-form">
        
        </div>
      </section>
    </div>
  </div>
</div>
<div id="object"></div>
<img src="" id="myimg" />
<!-- right container start here -->
<script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script> 
<script src="<?php echo asset_url(); ?>admin/js/md5.js"></script> 
<script>
/*------------------------- Firebase Function JS -------------------------------------*/

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

var bse_url = "/";
 var config = {
    apiKey: "AIzaSyDBwhVzLZRZVf4tFRqRQa6dD0KgUl1IBj4",
    authDomain: "autopro-75ac3.firebaseapp.com",
    databaseURL: "https://autopro-75ac3.firebaseio.com",
    storageBucket: "autopro-75ac3.appspot.com",
    messagingSenderId: "905741934132"
  };
// Initialize Firebase
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

firebase.auth().onAuthStateChanged(function(user) {
	if (user){
		var storage = firebase.storage();
		storage.ref('/images/vechile_id.png').getDownloadURL().then(function(url) {
		  var xhr = new XMLHttpRequest();
		  xhr.responseType = 'blob';
		  xhr.onload = function(event) {
			var blob = xhr.response;
		  };
		  xhr.open('GET', url);
		  xhr.send();
		  var img = document.getElementById('myimg');
		  img.src = url;
		}).catch(function(error) {
		  // Handle any errors
		});
	} else {
	  console.log('No user is signed in.')
	}
});
</script>