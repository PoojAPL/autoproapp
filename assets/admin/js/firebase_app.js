/*------------------------- Firebase Function JS -------------------------------------*/
var bse_url = "/";
 var config = {
    apiKey: "AIzaSyDBwhVzLZRZVf4tFRqRQa6dD0KgUl1IBj4",
    authDomain: "autopro-75ac3.firebaseapp.com",
    databaseURL: "https://autopro-75ac3.firebaseio.com",
    storageBucket: "autopro-75ac3.appspot.com",
    messagingSenderId: "905741934132"
  };
firebase.initializeApp(config);

 // Initialize Firebase
/*var config = {
    apiKey: "AIzaSyAOGEGaxRqauTKn14rrg7NsfSpgAgqmWQ4",
    authDomain: "american-key.firebaseapp.com",
    databaseURL: "https://american-key.firebaseio.com",
    storageBucket: "american-key.appspot.com",
    messagingSenderId: "699615089846"
  };
firebase.initializeApp(config);*/

const auth = firebase.auth();
// get Elements
const textEmail = document.getElementById('email');
const textPassword =  document.getElementById('password');
const btnSignUp = document.getElementById('addUserBtn');
var result = document.getElementById('userUUID');
//const btnLogin = 
btnSignUp.addEventListener('click' , e => {
 document.getElementById('fireResult').innerText = "";
 //document.getElementById("loader").className = "";
 document.getElementById('errorValue').value = "";	
 const email = textEmail.value;
 const pass = textPassword.value;
 const auth = firebase.auth();
 //conts  email = trim_email.trim()
 const encrypt_passw = calcMD5(pass);		
 const encrypt_64 = Base64.encode(encrypt_passw);
 const promise = auth.createUserWithEmailAndPassword(email, encrypt_64);
 document.getElementById("loader").className = "";
 promise.then( user =>  result.value = user.uid );
 promise.catch( e => document.getElementById('errorValue').value = e.message); 	
 setTimeout(function(){
	 var error = document.getElementById('errorValue').value;
	 if(error != ""){			
			document.getElementById('fireResult').innerText = error;
			document.getElementById("loader").className = "hide";  
	 }else{	 
		 var userUUID = document.getElementById('userUUID').value;
		 if(userUUID == ""){
				document.getElementById('fireResult').innerText = "Error: user cannot added";
		 }else{
			 var username =  document.getElementById('userName').value;
			 var Type =  'Admin';
			 var adminType = document.getElementById('adminType').value; 
			 var company = document.getElementById('company').value; 
			 var u_email = textEmail.value;
			 var u_pass = textPassword.value;			 
			 var fireBaseRef = firebase.database().ref("/users/"+userUUID);
			 fireBaseRef.set( {Company: company, email: u_email, password:u_pass, type:  Type, UserName: username, user_UUID: userUUID	}, function(error) {
				  if (error !== null) {
					  alert(error);
				  }else{
					 document.getElementById('fireResult').innerText = 'User add succesfully';
					 document.getElementById("loader").className = "hide";  
				  }
			  });	
			  var http = new XMLHttpRequest();
				var url = bse_url+'admin/user_add';
				var params = "user_name="+username+"&select_admin="+adminType+"&email="+u_email+"&password="+u_pass+"&company="+company+"&user_uid="+userUUID;
				http.open("POST", url, true);		
				//Send the proper header information along with the request
				http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				
				http.onreadystatechange = function() {//Call a function when the state changes.
					if(http.readyState == 4 && http.status == 200) {
						//alert(http.responseText);
					}
				}
				http.send(params);
		 }
			
	 }
	  
  }, 3000);	 
   
})


/*---------------------Update User With Firebase ---------------------------------------------------*/
