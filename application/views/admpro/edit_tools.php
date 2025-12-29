<?php 
error_reporting(0);
$user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
$outputs1 = $this->session->userdata('login_firebase_user');?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form "  method ="post" id="addTool" action="<?php echo adm_base_url();?>/update_tool" enctype="multipart/form-data">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <input type="hidden" id="i_email" value="<?php echo $getUsersInfo[0]['email'];?>" />
      <input type="hidden" id="i_password" value="<?php echo $outputs1['password'];?>" />
      <input type="hidden" id="UUID" name="UUID" value="<?php echo $getToolsInfo[0]['UUID'];?>" /> 
  	<!-- <h2 class="titleheadng">Add Tool</h2>-->
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"> Name</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="hidden" value="<?php echo $toolid;?>" name="toolid" />
         <input type="text" class="form-control" placeholder="Name" name="tool_name" value="<?php echo $getToolsInfo[0]['Tool_Name'];?>">
        </div>
      </div>
    </div>    
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"> Tool Type</label>
        </div>
      </div>
      <div class="col-sm-10">        
        <?php  $Tool_Type_UUID = explode(',',$getToolsInfo[0]['Tool_Type_UUID']);
		for($tl = 0; $tl < count($Tool_Type_UUID); $tl++){?>
            <div class="clone-with-holder">
                <div class="inputcol">
                     <select class="form-control" name="Tool_Type_UUID[]">
                        <option value="">Select Tool Type</option>
                        <?php foreach($getAllToolType as $tool_type){
                            if($Tool_Type_UUID[$tl] == $tool_type['UUID']){
                                $selected ='selected';
                            }else{
                                $selected ='';
                            }?>
                            <option value="<?php echo $tool_type['UUID'];?>" <?php echo $selected;?>><?php echo $tool_type['Tool_Type_Name'];?></option>
                        <?php } ?>
                     </select>
                      <?php if( $tl > 0){?>
                      <span class="glyphicon glyphicon-remove removeMoreToolType" aria-hidden="true"></span>
                      <?php } ?>
                </div>
            </div>
        <?php } ?>
         <div class="addMoreToolTypeRow"></div>
        <button type="button" class="btn btn-info addMoreToolType pull-right" title="Add More"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
      </div>
    </div>
     <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label"> Manufacturer</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <select class="form-control" name="manufacture">
         	<option value="">Select Manufacturer</option>
            <?php foreach($getAllManufacturer as $manufacture){
					if( $getToolsInfo[0]['Manufacturer_UUID'] == $manufacture['UUID']){
						$selected = 'selected';
					}else{
						$selected = '';
					}
				?>
            	<option value="<?php echo $manufacture['UUID'];?>" <?php echo $selected;?>><?php echo $manufacture['Manufacturer_Name'];?></option>
            <?php } ?>
         </select>
        </div>
      </div>
    </div>
    <div class="row">
          <div class="col-sm-4">
            <div class="labelcol">
              <label class="control-label">Image</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
             <input type="text" class="form-control" name="toolImage" id="someImageTagID" readonly="readonly"  value="<?php echo $getToolsInfo[0]['Tool_Image_Url'];?>">
            </div>
          </div>
          <div class="col-sm-3" style="width: 11.9%;">
              <span id="fileselector">
                <label class="btn btn-info" for="upload-file-selector" style="margin-top: 15px;">
                    <input id="photo" type="file" name="filename" onchange="imageUpload()" >
                </label>
            </span>
          </div>
        </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Note</label> 
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" name="tool_note" class="form-control" value="<?php echo $getToolsInfo[0]['Tool_Note'];?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Useful For</label> 
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" name="Useful_For" class="form-control" value="<?php echo $getToolsInfo[0]['Useful_For'];?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Difficulty</label> 
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" name="Difficulty" class="form-control" value="<?php echo $getToolsInfo[0]['Difficulty'];?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="labelcol">
          <label class="control-label">Products</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
         <input type="text" name="product" class="form-control" value="<?php echo $getToolsInfo[0]['Products'];?>" />
        </div>
      </div>
    </div>    
    <hr>
      <div class="row">
        <div class="col-sm-4">
            <div class="labelcol">
              <label class="control-label"></label>
            </div>
          </div>   
        <div class="col-md-12">
            <button type="sumit" class="btn btn-primary" name="post">Submit</button>  
            <a href="<?php echo adm_base_url();?>/tools" class="btn btn-danger">Cancel</a>          
        </div>   
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
