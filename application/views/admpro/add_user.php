<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <div id="fireResult"></div>
      <!-- <form class="site-form add_user" method ="post" id="add_user" action="<?php echo adm_base_url();?>/user_add">-->
      <form class="site-form add_user" method ="post"  action="<?php echo adm_base_url();?>/user_add">
        <!--<h2 class="titleheadng">Add New User</h2>-->
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <input type="hidden" id="errorValue" />
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Name</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <input type="text" class="form-control" placeholder="Name" name="user_name" id="userName"  required>
              <input type="hidden" id="userUUID"  />
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">User Type</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <select class="form-control select-field" name="select_admin" id="adminType">
                <?php  $get_users_type = users_type();
				foreach( $get_users_type as $key => $user_type){ ?>
                	<option value="<?php echo $key;?>"><?php echo $user_type;?></option>
				<?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Company</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <input type="text" class="form-control" placeholder="Company" name="company" id="company" >
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Email</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <input type="email" class="form-control" placeholder="Email" name="email" id="email"  required>
              <span class="availability_email"></span>
              <div class="emailAvailability"></div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Password</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" required >
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Access</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
             <!--<input type="radio" name="admin_access" id="admin_access" value="1" /> Enabled
             <input type="radio" name="admin_access" id="admin_access" value="0" checked="checked" /> Disabled-->
             <input type="checkbox" name="admin_access" id="admin_access"  data-toggle="toggle" data-on="Enabled" data-off="Disabled">
            </div>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">&nbsp;</label>
            </div>
          </div>
          <div class="col-sm-10 ">
            <div class="inputcol">
              <input type="submit" class="btn btn-success" name="post" id="addUserBtn" value="Add New User">
              <a href="<?php echo adm_base_url();?>/manage_user" class="btn btn-danger">Cancel</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://www.gstatic.com/firebasejs/3.4.1/firebase.js"></script> 
<script src="<?php echo asset_url(); ?>admin/js/md5.js"></script> 
<script>
	/*------------------------- Firebase Function JS -------------------------------------*/
// var bse_url = "/";
//  var config = {
//     apiKey: "AIzaSyDBwhVzLZRZVf4tFRqRQa6dD0KgUl1IBj4",
//     authDomain: "autopro-75ac3.firebaseapp.com",
//     databaseURL: "https://autopro-75ac3.firebaseio.com",
//     storageBucket: "autopro-75ac3.appspot.com",
//     messagingSenderId: "905741934132"
//   };
// // Initialize Firebase
// /*var config = {
//     apiKey: "AIzaSyAOGEGaxRqauTKn14rrg7NsfSpgAgqmWQ4",
//     authDomain: "american-key.firebaseapp.com",
//     databaseURL: "https://american-key.firebaseio.com",
//     storageBucket: "american-key.appspot.com",
//     messagingSenderId: "699615089846"
//   };*/
// firebase.initializeApp(config);

// const auth = firebase.auth();
// // get Elements
// const textEmail = document.getElementById('email');
// const textPassword =  document.getElementById('password');
// const btnSignUp = document.getElementById('addUserBtn');

// //const btnLogin = 
// btnSignUp.addEventListener('click' , e => {
// 	add_aks_uers();
// })

// //document.getElementsByTagName("input").addEventListener("keypress", myEnterFunction());

// function myEnterFunction(event) {
// 	var x = event.which || event.keyCode;
//     if(x === 13){
// 		add_aks_uers();
// 	}
// }

// function add_aks_uers(){
//  document.getElementById('fireResult').innerText = "";
//  //document.getElementById("loader").className = "";
//  document.getElementById('errorValue').value = "";	
//  const email = textEmail.value;
//  const pass = textPassword.value;
//  const auth = firebase.auth();
//  //conts  email = trim_email.trim()
//  const encrypt_passw = calcMD5(pass);		
//  const encrypt_64 = Base64.encode(encrypt_passw);
//  const promise = auth.createUserWithEmailAndPassword(email, encrypt_64);
//  document.getElementById("loader").className = "";
//  promise.then( user =>  document.getElementById('userUUID').value = user.uid );
//  promise.catch( e => document.getElementById('errorValue').value = e.message); 	
//  setTimeout(function(){
// 	 var error = document.getElementById('errorValue').value;
// 	 if(error != ""){			
// 			document.getElementById('fireResult').innerText = error;
// 			document.getElementById("loader").className = "hide";  
// 	 }else{	 
// 		 var userUUID = document.getElementById('userUUID').value;
// 		 if(userUUID == ""){
// 				document.getElementById('fireResult').innerText = "Error: user cannot added";
// 				document.getElementById("loader").className = "hide";  
// 		 }else{
// 			 var username =  document.getElementById('userName').value;
// 			 var Type =  'Admin';
// 			 var user_type = document.getElementById('adminType').value;
// 			 var adminType = document.getElementById('adminType').value; 
// 			 var company = document.getElementById('company').value; 
// 			 var u_email = textEmail.value;
// 			 var u_pass = textPassword.value;	
// 			 var admin_access = document.getElementById('admin_access').value; 		 
// 			 var fireBaseRef = firebase.database().ref("/users/"+userUUID);
// 			 fireBaseRef.set( {Company: company, email: u_email, password:u_pass, type:  Type,user_type: user_type, UserName: username, user_UUID: userUUID,encrypt_64:encrypt_64	}, function(error) {
// 				  if (error !== null) {
// 					  alert(error);
// 				  }else{
// 					 document.getElementById('fireResult').innerText = 'User add succesfully';
// 					 document.getElementById("loader").className = "hide";  
// 				  }
// 			  });	
// 			  var http = new XMLHttpRequest();
// 				var url = bse_url+'admin/user_add';
// 				var params = "user_name="+username+"&select_admin="+adminType+"&email="+u_email+"&password="+u_pass+"&company="+company+"&user_uid="+userUUID+"&admin_access="+admin_access;
// 				http.open("POST", url, true);		
// 				//Send the proper header information along with the request
// 				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				
// 				http.onreadystatechange = function() {//Call a function when the state changes.
// 					if(http.readyState == 4 && http.status == 200) {
// 						//alert(http.responseText);
// 					}
// 				}
// 				http.send(params);
// 		 }
			
// 	 }
	  
//   }, 6000);	 
// }
/*---------------------Update User With Firebase ---------------------------------------------------*/
</script> 