<?php 
error_reporting(0);
$user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
$outputs1 = $this->session->userdata('login_firebase_user');
$user_type = $getUsersInfo[0]['type'];
if( ($user_type == 0) || ($user_type == 1) || ($user_type == 2) ){
	$status = 'approved';
}else{
	$status = 'pending';
} ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">
      <section class="innerUserlogin white-box">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <div id="fireResult"></div>
      <form class="site-form " method ="post" id="AddVehicleForm" action="<?php echo adm_base_url();?>/vehicles/save_vehicle">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        <!--<h2 class="titleheadng">Add Model</h2>-->
        <input type="hidden" id="vehicle_id" value="<?php echo $get_all_vehicles[0]['id']+1;?>" /> 
        <input type="hidden" value="<?php echo $getUsersInfo[0]['User_uid'];?>" id="user_uuid" />
        <input type="hidden" id="i_email" value="<?php echo $getUsersInfo[0]['email'];?>" />
        <input type="hidden" id="i_password" value="<?php echo $outputs1['password'];?>" />
        <input type="hidden" id="status" value="<?php echo $status;?>" />
        <input type="hidden" id="UUID" value="<?php echo gen_uuid();?>" /> 
        <?php $vtype_array = vehicle_type_array();?>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Vehicle Type</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <select class="form-control" name="Vehicle_Type">
              	<option value="">Select type</option>
                <?php foreach($vtype_array as $types){
					if($types['type'] == 'Car'){
						$selected = 'selected';
					}else{
						$selected = '';
					}?>
                	<option <?php echo $selected;?>><?php echo $types['type'];?></option>
                <?php  } ?>
              </select>
            </div>
          </div>
        </div>      
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Make</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <select class="form-control selectModels" name="Make_UUID">
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
              <label class="control-label">Years</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="number" class="custom-input" placeholder="From" name="fromYear">
              <input type="number" class="custom-input" placeholder="To" name="toYear">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Main Vehicle Image</label>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="inputcol vehicle_image">
              <input type="text" name="Vehicle_Image" id="imagename" class="form-control" placeholder="Image Url"  />              
              <div id="imageProgress"> <div id="imageBar" class="progress-bar-striped"></div> </div>         
            </div>
          </div>
          <div class="col-sm-2"><button type="button" id="btn" class="btn btn-info vehicle_images">Upload</button></div>
          <div class="col-sm-2"> <img  src="" id="image_vale" style="width: 80px;height: 46px;" /> </div>              
        </div>
        <div id="image_preview"></div>
        <div class="addMoreVehicleImage"></div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Code Series</label>
            </div>
          </div>
          
          <div class="col-sm-10">          
            <div class="inputcol">
              <select class="custom_input" name="Code_Series_UUID[]">
              	<option value="">Select Code Series</option>
                <?php foreach($get_t_code_series as $code_s){?>
                	<option value="<?php echo $code_s['UUID'];?>"><?php echo $code_s['Code_Series_Name'];?></option>
                <?php  } ?>
              </select>
              <input type="text" name="code_note[]" class="custom_input" placeholder="(Note)" />
            </div>
           <div class="code_series_box"></div> 
           <a href="javascript:void(0)" class="addAnotherCodeSeries"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Another Code Series</a> 
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Tumblers</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <input type="text" class="form-control Tumblers" name="Tumblers"  />
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Retainer</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <select class="form-control" name="Retainer_UUID">
              	<option value="">Select Retainer</option>
                <?php foreach($getRetainers as $retainer){?>
                	<option value="<?php echo $retainer['UUID'];?>"><?php echo $retainer['Retainer_Name'];?></option>
                <?php  } ?>
              </select>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Mechanical Key</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <select class="form-control" name="Mechanical_Key_UUID[]" multiple="multiple" style="height:200px">
              	<option value="">Select Mechanical Key</option>
                <?php 
				$get_machanical_keys = get_machanical_keys('Mechanical Key');
				foreach($get_machanical_keys as $keys){?>
                	<option value="<?php echo $keys['UUID'];?>"><?php echo $keys['Key_Name'];?></option>
                <?php  } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Chip Key</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <select class="form-control" name="Chip_Key_UUID[]" multiple="multiple" style="height:200px;">
              	<option value="">Select Chip Key</option>
                <?php 
				$get_machanical_keys = get_machanical_keys('Transponder Key');
				foreach($get_machanical_keys as $keys){?>
                	<option value="<?php echo $keys['UUID'];?>"><?php echo $keys['Key_Name'];?></option>
                <?php  } ?>
                <?php 
				$get_machanical_keys2 = get_machanical_keys('VATS Key');
				foreach($get_machanical_keys2 as $keys){?>
                	<option value="<?php echo $keys['UUID'];?>"><?php echo $keys['Key_Name'];?></option>
                <?php  } ?>
              </select>
            </div>
          </div>
        </div>        
        
        <fieldset>
        <legend>Parts</legend>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Ignitions</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" name="Parts_Ignition" class="form-control" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Door/Glove Locks</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" name="Parts_Door" class="form-control" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Accessories</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" name="Parts_Accessories" class="form-control" />
                </div>
              </div>
            </div>
        </fieldset>
        <fieldset>
        <legend>OBD Port Location</legend>            
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Text Description</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" name="OBD_Location_Text" class="form-control" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Image</label>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="inputcol">
                  <input type="text" name="OBD_Location_Image" class="form-control" id="someImageTagID" readonly="readonly" />
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
        </fieldset>
        <fieldset>
          <legend>AutoProPAD</legend>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">System</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="APP_System"  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Add Keys</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="APP_Add_Keys" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">All Keys Lost</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="APP_All_Keys_Lost" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">PIN Read</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="PIN_Read" />
                </div>
              </div>
            </div>
			 <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Programs Remote</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="APP_Programs_Remote" />
                </div>
              </div>
            </div>
			 <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Resync Available</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="APP_Resync_Available" />
                </div>
              </div>
            </div>
			
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">10-Min Bypass</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="APP_10-Minute_Bypass" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Confirmed</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="APP_Confirmed_Working" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Notes</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="APP_Notes" />
                </div>
              </div>
            </div>
        </fieldset>
        <fieldset>
        <legend>Advanced Diagnostics</legend>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">System </label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" name="System" class="form-control" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Dongle  </label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <select class="form-control" name="Dongle_UUID">
                    <option value="">Select Dongle </option>
                    <?php 
                    $get_programmer_tools = get_programmer_tools('Dongle');
                    foreach($get_programmer_tools as $remote){?>
                        <option value="<?php echo $remote['UUID'];?>"><?php echo $remote['Tool_Name'];?></option>
                    <?php  } ?>
                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Smart Card </label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                 <!-- <input type="radio" value="1" name="SmartCard" /> Yes &nbsp; &nbsp; <input type="radio" value="0" name="SmartCard" /> No-->
                  <select class="form-control" name="SmartCard">
                  	<option value="">Please select</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">TCode Software</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <select class="form-control" name="TCode_Software">
                    <option value="">Select TCode Software </option>
                    <?php $get_programmer_tools = get_programmer_tools('TCode SW');
                    	foreach($get_programmer_tools as $remote){?>
                        <option value="<?php echo $remote['UUID'];?>"><?php echo $remote['Tool_Name'];?></option>
                    <?php  } ?>                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">PIN Required  </label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="PIN_Required" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">PIN Read </label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="MVP_PIN_Read" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">10-Minute Bypass </label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="10-Minute_Bypass" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Notes </label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <textarea class="form-control" name="MVP_Notes"></textarea>
                </div>
              </div>
            </div>
        </fieldset>
        
        
        
        <fieldset>
        	<legend>Hotwire </legend>            
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Key Prog</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="HW_Key_Prog" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Remote Prog</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="HW_Remote_Prog" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Misc Prog</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="HW_Misc_Prog" />
                </div>
              </div>
            </div>
        </fieldset>
        
        <fieldset>
        	<legend>TKO / SDD</legend>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">System</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="TKOSDD_System"  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">SDD Adapter</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="TKOSDD_SDD_Adapter" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">SDD Cable</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="TKOSDD_SDD_Cable" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">TKO Cable</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="TKOSDD_TKO_Cable" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Notes</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="TKOSDD_Notes" />
                </div>
              </div>
            </div>
        </fieldset>
        
        <fieldset>
        	<legend>DMax</legend>            
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">System</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="DMax_System" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Method</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="DMax_Method" />
                </div>
              </div>
            </div>
        </fieldset>
        
        <fieldset>
        	<legend>Pro-Lok</legend>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Tool</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <select class="form-control" name="ProLok_Tool_UUID">
                    <option value="">Select Tool</option>
                    <?php 
                    $get_programmer_tools = get_manufacure_tools('Pro-Lok');
                    foreach($get_programmer_tools as $remote){?>
                        <option value="<?php echo $remote['UUID'];?>"><?php echo $remote['Tool_Name'];?></option>
                    <?php  } ?>
                    
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Linkage</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                  <input type="text" class="form-control" name="ProLok_Linkage" />
                </div>
              </div>
            </div>
        </fieldset>        
        <hr>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label"></label>
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-success" name="post">Submit</button>
            <a href="<?php echo adm_base_url();?>/vehicles/vehicle" class="btn btn-danger">Cancel</a> </div>
        </div>
         <input type="hidden" id="getError" />
      </form>
     <canvas id="mcanvas" height="500" width="500" style="display:none"></canvas>
    </div>
  </div>
</div>
<script src="https://www.gstatic.com/firebasejs/3.6.3/firebase.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/md5.js"></script>
<script >
/*------------------------- Firebase Function JS -------------------------------------*/
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
var uuid = document.getElementById('UUID').value; 

var bse_url = "/";
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

const ref2 = firebase.storage().ref('/vehicle-images/'+uuid+'');
var imageAddButton = document.getElementById('imagename');
imageAddButton.addEventListener('change' , e => {
	var file_path = e.target.value;
	var storageRef = firebase.storage().ref();
	document.getElementById('image_vale').src = file_path;
	
})

const loginEmail = document.getElementById('i_email');
const loginPassword = document.getElementById('i_password');

var vehicleImageButton = document.getElementById('btn');
vehicleImageButton.addEventListener('click' , e => {
		document.getElementById("loader").className = ""; 
		var file_path = e.target.value;
		var storageRef = firebase.storage().ref();
		var sampleImage = document.getElementById('image_vale'),
		img_canvas_path1 = doProcess(sampleImage);
		console.log(img_canvas_path1);
		var img_canvas_path = img_canvas_path1.replace("data:image/png;base64,", "");
		 //var uInt8Array = new Uint8Array(img_canvas_path);
		console.log(img_canvas_path1);	
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
							// var fireBaseRef = firebase.database().ref("/users/"+folderName+'/images/');
			 fireBaseRef.set( {correctionID: correctionId, imagePath: 'images/'+folderName+'/'+folderName+'_image.png', status:status,userID: userID,title: title}, function(error) {
						  if (error !== null) {
							  alert(error);
						  }else{
							 document.getElementById('fireResult').innerText = 'Image added succesfully';
							 document.getElementById("loader").className = "hide";  
						  }
					  });			
					  task.on('state_changed', 					
						function progress(snapshot){
							document.getElementById("loader").className = "hide"; 
							 var elem = document.getElementById("imageBar");   
							  var width = 1;
							  var id = setInterval(frame, 10);
							  function frame() {
								if (width >= 100) {
								  clearInterval(id);
								} else {
								  width++; 
								  elem.style.width = width + '%'; 
								}
							  }
							  
						},				
						function error(err){
							//alert('Error')
						}, 
						function complete(){
							//alert('Completed')
							
						}
					)
			}else{
				alert('You are not allowed to add Image');
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



// var locationImageButton = document.getElementById('btn2');
// locationImageButton.addEventListener('click' , e => {
//     document.getElementById("loader").className = ""; 
//     var file_path = e.target.value;
//     var storageRef = firebase.storage().ref();
//     var sampleImage = document.getElementById('image_vale2'),
//     img_canvas_path1 = doProcess(sampleImage);
//     console.log(img_canvas_path1);
//     var img_canvas_path = img_canvas_path1.replace("data:image/png;base64,", "");
//      //var uInt8Array = new Uint8Array(img_canvas_path);
// })

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
          const task = ref2.child(name).put(file, metadata);
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
</script>