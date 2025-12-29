<?php $outputs1 = $this->session->userdata('login_firebase_user');
$user_data = $this->session->userdata['login_user'];
$user_email = $user_data['email'];
  ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form" method ="post" id="AddMethods" action="<?php echo adm_base_url();?>/save_method">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <!--<h2 class="titleheadng">Add Model</h2>-->
      <input type="hidden" id="i_email" value="<?php echo $user_email;?>" />
      <input type="hidden" id="i_password" value="<?php echo $outputs1['password'];?>" />
      <input type="hidden" id="UUID" name="UUID" value="<?php echo gen_uuid();?>" />
    	<input type="hidden" name="id" value="<?php echo $id;?>" />
        <fieldset>
         <legend>Vehicle</legend>
          <div class="row">
            <div class="col-sm-10">
              <div class="inputcol">
                <label class="control-label">Available Vehicles
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="limitVehicleTransponder">Limit to Transponder Vehicles Only</a>
                </label>
                <input type="text" name="q" class="form-control searchAvailableVehicles" placeholder="Search...">
                <div class="searchAvailableVehiclesHolder">
                 <select   id="search" class="form-control" size="15" multiple="multiple" >
                  <?php 
                  $get_all_vehicles = get_all_available_vehicles();
                  foreach($get_all_vehicles as $vehicles){
                    $years = explode(',',$vehicles['Years']);
                    $get_make_name = $vehicles['Make_Name'];
                    $get_models_name = $vehicles['Model_Name'];  
                    $Code_Series_Name = '';                 
                    $got_series_data = explode(',',$vehicles['Code_Series_UUID']);
                    if( count($got_series_data) > 1){
                        for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
                          $got_series_val = explode('|',$got_series_data[$cs]);
                          $code_series_id = $got_series_val[0];
                          $code_series_note = $got_series_val[1];
                          $get_Code_Series_name = get_Code_Series_name($code_series_id);
                          if($get_Code_Series_name[0]['Code_Series_Name'] !=""){
                            $Code_Series_Name .= $get_Code_Series_name[0]['Code_Series_Name'].',';
                          }
                        } 
                        $Code_Series_Name = rtrim($Code_Series_Name,',');
                      }else{
                        $got_series_val = explode('|',$got_series_data[0]);
                        $code_series_id = $got_series_val[0];
                        $code_series_note = $got_series_val[1];
                        $get_Code_Series_name = get_Code_Series_name($code_series_id);
                        $Code_Series_Name = $get_Code_Series_name[0]['Code_Series_Name'];
                       }
                       if($Code_Series_Name !=""){
                        $option_name = $get_make_name.' '.$get_models_name.' ('.$years[0].'-'.$years[count($years)-1].') ('.$Code_Series_Name.')';
                       }else{
                        $option_name = $get_make_name.' '.$get_models_name.' ('.$years[0].'-'.$years[count($years)-1].')';
                      }
                    ?>
                    <option value="<?php echo $option_name;?>"> <?php echo $option_name;?></option>
                  <?php } ?>
                 </select>
               </div>
              </div>
            </div>
            <div class="col-sm-2 upDownButton"> 
                <button type="button" id="search_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                <button type="button" id="search_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                
            </div>
            <div class="col-sm-10">
              <div class="inputcol">
                <label class="control-label">Selected Vehicles</label>
                 <select name="Vehicle_UUID[]" id="search_to" class="form-control" size="17" multiple="multiple">
                  <?php $Vehicle_UUID = explode('|',$method_info[0]['Vehicle_UUID']);
                  for ($i=0; $i < count($Vehicle_UUID); $i++) {
                    $Vehicle_UUID_data = explode('__',$Vehicle_UUID[$i]);
                    $get_vehicles_by_id = get_selected_vehicles_by_id($Vehicle_UUID_data[0]);
                      $vehicles = $get_vehicles_by_id[0];
                      $years = explode(',',$vehicles['Years']);
                      $get_make_name = $vehicles['Make_Name'];
                      $get_models_name = $vehicles['Model_Name'];  
                      $Code_Series_Name = '';                 
                      $got_series_data = explode(',',$vehicles['Code_Series_UUID']);
                      if( count($got_series_data) > 1){
                        for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
                          $got_series_val = explode('|',$got_series_data[$cs]);
                          $code_series_id = $got_series_val[0];
                          $code_series_note = $got_series_val[1];
                          $get_Code_Series_name = get_Code_Series_name($code_series_id);
                          if($get_Code_Series_name[0]['Code_Series_Name'] !=""){
                            $Code_Series_Name .= $get_Code_Series_name[0]['Code_Series_Name'].',';
                          }
                        } 
                        $Code_Series_Name = rtrim($Code_Series_Name,',');
                      }else{
                        $got_series_val = explode('|',$got_series_data[0]);
                        $code_series_id = $got_series_val[0];
                        $code_series_note = $got_series_val[1];
                        $get_Code_Series_name = get_Code_Series_name($code_series_id);
                        $Code_Series_Name = $get_Code_Series_name[0]['Code_Series_Name'];
                       }  
                       if($Code_Series_Name !=""){
                        $option_name = $get_make_name.' '.$get_models_name.' ('.$years[0].'-'.$years[count($years)-1].') ('.$Code_Series_Name.')';
                       }else{
                        $option_name = $get_make_name.' '.$get_models_name.' ('.$years[0].'-'.$years[count($years)-1].')';
                      } ?>
                    <option value="<?php echo $Vehicle_UUID[$i];?>" selected><?php echo $option_name;?></option>
                  <?php } ?>
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
               <input type="text" class="form-control" name="Title" value="<?php echo $method_info[0]['Title'];?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Content</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol customTextarea">
               <textarea name="Content"><?php echo $method_info[0]['Content'];?></textarea>
            </div>
          </div>
        </div>
    <div class="row">
      <div class="imageRow">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Images</label>
                  </div>
                </div>
                <?php $image_data = explode(',',$method_info[0]['Images']);?>
                <div class="col-sm-10">
                  <div class="inputcol">
                   <input type="text" class="form-control" name="Image_path[]" id="someImageTagID" readonly="readonly" value="<?php echo $image_data[0];?>">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div id="someImageTagIDImg">
                <?php if($image_data[0] != ""){?>
                  <img src="<?php echo $image_data[0];?>">
                <?php }?>
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
    <div class="moreImageHolder">
    <?php if($method_info[0]['Images'] != ""){
           
           for($i=1; $i < count($image_data);$i++){?>
              <div class="row">
                <div class="imageRow" id="imageRow">
                <div class="col-sm-4">
                  <div class="labelcol">
                    <label class="control-label">Images</label>
                  </div>
                </div>
                <div class="col-sm-10">
                  <div class="inputcol">
                   <input type="text" class="form-control" name="Image_path[]" id="id_<?php echo $i;?>" readonly="readonly" value="<?php echo $image_data[$i];?>">
                  </div>
                </div>
                <div class="col-sm-2">
                  <div id="id_<?php echo $i;?>Img"><img src="<?php echo $image_data[$i];?>"></div>
                </div>
                <div class="col-sm-3" style="width: 11.9%;">
                        <span id="fileselector">
                          <label class="btn btn-info" for="upload-file-selector" style="margin-top: 15px;">
                              <input id="photo" type="file" name="filename_<?php echo $i;?>" data-id="id_<?php echo $i;?>" onchange="imageUpload2(event)" >
                          </label>
                      </span>
                    </div>
                    <span class="glyphicon glyphicon-remove removeImageRow" aria-hidden="true"></span>
              </div>
            </div>
          <?php }
          } ?>
    </div> 
    <?php if(count($image_data) < 4){?>
    <div class="pull-right"><button class="btn btn-success addMoreImages" type="button"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add More </button></div>
    <div class="clearfix"></div>  
    <?php } ?>
    <div class="row">
      <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label">Submitted by User</label>
        </div>
      </div>
      <div class="col-sm-10">
        <div class="inputcol">
          <input type="text" name="" class="form-control searhAksUser" placeholder="Search User...">
          <div class="usersResults">
           <select class="form-control" value="<?php echo $User_Email;?>"  name="User_UUID">
            <option value="">Please select</option>
            <?php $get_all_aks_users = get_all_aks_users();
            foreach ($get_all_aks_users as $key => $value) {
              if($method_info[0]['User_UUID'] == $value['User_UUID']){
                $selected = 'selected';
              }else{
                $selected = ''; 
              }
              ?>
              <option value="<?php echo $value['User_UUID'];?>" <?php echo $selected;?>><?php echo $value['Email'];?> (<?php echo $value['User_UUID'];?>)</option>
            <?php } ?>
           </select>
         </div>
        </div>
      </div>
    </div>
     <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Score</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text"  class="form-control"  name="Score" value="<?php echo $method_info[0]['Score'];?>">
            </div>
          </div>
        </div> 
      <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Video IDs</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text"  class="form-control"  name="Videos[]" value="<?php echo $method_info[0]['Videos'];?>">
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
        <a href="<?php echo adm_base_url();?>/keymaking_methods" class="btn btn-danger">Cancel</a>
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
  const ref = firebase.storage().ref('/keymaking-images/'+uuid+'');
  const loginEmail = document.getElementById('i_email');
  const loginPassword = document.getElementById('i_password');
  var uuid = document.getElementById('UUID').value; 
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
            document.querySelector('#someImageTagIDImg').innerHTML = '<img src="'+url+'">';
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
     document.querySelector('#'+ids+'Img').innerHTML = '<img src="'+url+'">';
      document.getElementById("loader").className = "hide";
    }).catch((error) => {
      console.error(error);
    });    
  }
</script>