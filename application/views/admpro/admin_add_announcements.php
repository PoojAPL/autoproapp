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
      <?php } ?>
      <form class="site-form " method ="post" action="<?php echo adm_base_url();?>/save_admin_announcement">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <input type="hidden" id="i_email" value="<?php echo $getUsersInfo[0]['email'];?>" />
      <input type="hidden" id="i_password" value="<?php echo $outputs1['password'];?>" />
      <input type="hidden" id="UUID" name="UUID" value="<?php echo gen_uuid();?>" /> 
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Title</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">	
              <input type="text" class="form-control" name="Title" required="required" >
            </div>
          </div>
        </div>
        <div class="row">
         
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Type</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <select class="form-control select_announcements_type" name="Type" >
               <option value="">Please select</option>
               <?php $announcements_type = announcements_type(); 
               foreach ($announcements_type as $value) {
                  if ($value == 'View Once Per User') {
                    $selected = 'selected';
                  }else{
                    $selected = '';
                  }
                  echo '<option '.$selected.' >'.$value.'</option>';
                } ?>
             </select> 
            </div>
          </div>
          
        </div>
        <div class="row versionRow hide">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Version</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol"> 
              <input type="text" class="form-control" name="Version" >
            </div>
          </div>
        </div>
        <div class="row">
           <div class="imageRow">
          <div class="col-sm-4">
            <div class="labelcol">
              <label class="control-label">Image</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="text" class="form-control" name="Image_path[]" id="someImageTagID" readonly="readonly" >
            </div>
          </div>
          <div class="col-sm-3" style="width: 11.9%;">
              <span id="fileselector">
                <label class="btn btn-info" for="upload-file-selector" style="margin-top: 15px;">
                    <input id="photo" type="file" name="filename" onchange="imageUpload()" >
                </label>
            </span>
          </div>
          <span class="glyphicon glyphicon-remove removeImageRow" aria-hidden="true"></span> 
          </div> 
        </div>        
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Active</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol"> 
              <label class="checkbox-inline">
                <input type="checkbox" checked="checked" data-toggle="toggle" data-on="Enabled" data-off="Disabled" name="Active">
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Priority</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">  
              <input type="number" value="10" required="required" class="form-control" name="Priority" >
              <small>Lower number = higher priority</small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Expiration</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="'text'" value="<?php echo date('m/d/Y', strtotime(' +14 day'));?>" class="form-control" required="required" id="prchaseDate" name="Expiration" >
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label" >Message</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <textarea class="form-control"  name="Message" ></textarea>
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
            <button type="submit" class="btn btn-success" name="post">Submit</button>
            <a href="<?php echo adm_base_url();?>/announcements" class="btn btn-danger">Cancel</a> </div>
        </div>
      </form>
    </div>
  </div>
</div>
<input type="hidden" id="getError" />
<script src="https://www.gstatic.com/firebasejs/3.6.3/firebase.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/md5.js"></script>
<script type="text/javascript">
  var bse_url = "/";
  var config = {
    apiKey: "AIzaSyA1kkLsRv7v_tTafk5aCQWnXeWV_plC5_k",
    authDomain: "autoproapp2017.firebaseapp.com",
    databaseURL: "https://autoproapp2017.firebaseio.com",
    projectId: "autoproapp2017",
    storageBucket: "autoproapp2017.appspot.com",
    messagingSenderId: "988140303282"
  };

  // var config = {
  //   apiKey: "AIzaSyAOGEGaxRqauTKn14rrg7NsfSpgAgqmWQ4",
  //   authDomain: "american-key.firebaseapp.com",
  //   databaseURL: "https://american-key.firebaseio.com",
  //   storageBucket: "american-key.appspot.com",
  //   messagingSenderId: "699615089846"
  // };
  firebase.initializeApp(config);
  const auth = firebase.auth();
  var uuid = document.getElementById('UUID').value; 
  const ref = firebase.storage().ref('/announcements-images/'+uuid+'');
  const loginEmail = document.getElementById('i_email');
  const loginPassword = document.getElementById('i_password');
  
  function imageUpload(){
    var error = document.getElementById('getError').value;
    if(error === ""){
          document.getElementById("loader").className = "";
          const i_email = loginEmail.value;
          const i_password = loginPassword.value;
          const auth = firebase.auth();
          const encrypt_passw = calcMD5(i_password);    
          const encrypt_64 = Base64.encode(encrypt_passw);
          // Sign In
          const returnPromise = auth.signInWithEmailAndPassword(i_email, encrypt_64);
          returnPromise.catch( e =>  document.getElementById('getError').value = e.message);  
          const file = document.querySelector('#photo').files[0]
          const name = (+new Date()) + '-' + file.name;
          const metadata = {
            contentType: file.type
          };
          const task = ref.child(name).put(file, metadata);
          task.then((snapshot) => {
            const url = snapshot.downloadURL;
            //console.log(url);
            document.querySelector('#someImageTagID').value = url;
            document.getElementById("loader").className = "hide";
          }).catch((error) => {
            console.error(error);
          });
    }else{
        alert('User does not have permission to access the object');
        document.getElementById("loader").className = "hide"; 
      }
  }
  function imageUpload2(e){
    var error = document.getElementById('getError').value;
    var ids =  e.target.getAttribute("data-id");    
    document.getElementById("loader").className = "";
    const i_email = loginEmail.value;
    const i_password = loginPassword.value;
    const auth = firebase.auth();
    const encrypt_passw = calcMD5(i_password);    
    const encrypt_64 = Base64.encode(encrypt_passw);
    // Sign In
    const returnPromise = auth.signInWithEmailAndPassword(i_email, encrypt_64);
    returnPromise.catch( e =>  document.getElementById('getError').value = e.message);  
    const file = e.target.files[0]
    const name = (+new Date()) + '-' + file.name;    
    const metadata = {
      contentType: file.type
    };
    const task = ref.child(name).put(file, metadata);
    task.then((snapshot) => {
      const url = snapshot.downloadURL;
      console.log(url);
     document.querySelector('#'+ids+'').value = url;
      document.getElementById("loader").className = "hide";
    }).catch((error) => {
      console.error(error);
    });    
  }
</script>