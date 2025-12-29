<?php
if( isset($this->session->userdata['remotes_pagination'])){
	$per_page1 = $this->session->userdata['remotes_pagination'];
	$per_page = $per_page1['per_page'];
}else{
	$per_page = "";
}
if(isset($_SESSION['search_remote_key'])){
	$search_key = $_SESSION['search_remote_key'];
}else{
	$search_key = "";
}
if(isset($_SESSION['filtermotebydate'])){
	$datefilterromote = $_SESSION['filtermotebydate'];
}else{
	$datefilterromote ="";
}
if(isset($_SESSION['remotebytype'])){
	$type = $_SESSION['remotebytype'];
}else{
	$type = "";
}
$hide_remote_Vehicles = '';
$checked_remote_Vehicles = "";
$v_value = 'true';
if( isset($_POST['remote_Vehicles']) && $_POST['remote_Vehicles'] !=""){
  $_SESSION['hide_remote_Vehicles'] = $_POST['remote_Vehicles'];
}
if( isset($_SESSION['hide_remote_Vehicles']) && $_SESSION['hide_remote_Vehicles'] == 'true'){  
  $hide_remote_Vehicles = 'hide';
  $checked_remote_Vehicles = 'checked';
  $v_value = 'false';
}

$hide_remote_image = '';
$checked_remote_image = "";
$img_value = 'true';
if( isset($_POST['remote_image']) && $_POST['remote_image'] !=""){
  $_SESSION['hide_remote_image'] = $_POST['remote_image'];
}
if( isset($_SESSION['hide_remote_image']) && $_SESSION['hide_remote_image'] == 'true'){  
  $hide_remote_image = 'hide';
  $checked_remote_image = 'checked';
  $img_value = 'false';
}

$hide_remote_OEM_Part_Number = '';
$checked_remote_OEM_Part_Number = "";
$OEM_Part_Number_value = 'true';
if( isset($_POST['remote_OEM_Part_Number']) && $_POST['remote_OEM_Part_Number'] !=""){
  $_SESSION['hide_remote_OEM_Part_Number'] = $_POST['remote_OEM_Part_Number'];
}
if( isset($_SESSION['hide_remote_OEM_Part_Number']) && $_SESSION['hide_remote_OEM_Part_Number'] == 'true'){  
  $hide_remote_OEM_Part_Number = 'hide';
  $checked_remote_OEM_Part_Number = 'checked';
  $OEM_Part_Number_value = 'false';
}


$hide_remote_Buttons = '';
$checked_remote_Buttons = "";
$Buttons_value = 'true';
if( isset($_POST['remote_Buttons']) && $_POST['remote_Buttons'] !=""){
  $_SESSION['hide_remote_Buttons'] = $_POST['remote_Buttons'];
}
if( isset($_SESSION['hide_remote_Buttons']) && $_SESSION['hide_remote_Buttons'] == 'true'){  
  $hide_remote_Buttons = 'hide';
  $checked_remote_Buttons = 'checked';
  $Buttons_value = 'false';
}
$hide_remote_fcci = '';
$checked_remote_fcci = "";
$fcci_value = 'true';
if( isset($_POST['remote_fcci']) && $_POST['remote_fcci'] !=""){
  $_SESSION['hide_remote_fcci'] = $_POST['remote_fcci'];
}
if( isset($_SESSION['hide_remote_fcci']) && $_SESSION['hide_remote_fcci'] == 'true'){  
  $hide_remote_fcci = 'hide';
  $checked_remote_fcci = 'checked';
  $fcci_value = 'false';
}
$hide_remote_keys = '';
$checked_remote_keys = "";
$keys_value = 'true';
if( isset($_POST['remote_keys']) && $_POST['remote_keys'] !=""){
  $_SESSION['hide_remote_keys'] = $_POST['remote_keys'];
}
if( isset($_SESSION['hide_remote_keys']) && $_SESSION['hide_remote_keys'] == 'true'){  
  $hide_remote_keys = 'hide';
  $checked_remote_keys = 'checked';
  $keys_value = 'false';
}
$hide_remote_Reusable = '';
$checked_remote_Reusable = "";
$Reusable_value = 'true';
if( isset($_POST['remote_Reusable']) && $_POST['remote_Reusable'] !=""){
  $_SESSION['hide_remote_Reusable'] = $_POST['remote_Reusable'];
}
if( isset($_SESSION['hide_remote_Reusable']) && $_SESSION['hide_remote_Reusable'] == 'true'){  
  $hide_remote_Reusable = 'hide';
  $checked_remote_Reusable = 'checked';
  $Reusable_value = 'false';
}

$hide_remote_Frequency = '';
$checked_remote_Frequency = "";
$Frequency_value = 'true';
if( isset($_POST['remote_Frequency']) && $_POST['remote_Frequency'] !=""){
  $_SESSION['hide_remote_Frequency'] = $_POST['remote_Frequency'];
}
if( isset($_SESSION['hide_remote_Frequency']) && $_SESSION['hide_remote_Frequency'] == 'true'){  
  $hide_remote_Frequency = 'hide';
  $checked_remote_Frequency = 'checked';
  $Frequency_value = 'false';
}

$hide_remote_Battery = '';
$checked_remote_Battery = "";
$Battery_value = 'true';
if( isset($_POST['remote_Battery']) && $_POST['remote_Battery'] !=""){
  $_SESSION['hide_remote_Battery'] = $_POST['remote_Battery'];
}
if( isset($_SESSION['hide_remote_Battery']) && $_SESSION['hide_remote_Battery'] == 'true'){  
  $hide_remote_Battery = 'hide';
  $checked_remote_Battery = 'checked';
  $Battery_value = 'false';
}

$hide_remote_Chip = '';
$checked_remote_Chip = "";
$Chip_value = 'true';
if( isset($_POST['remote_Chip']) && $_POST['remote_Chip'] !=""){
  $_SESSION['hide_remote_Chip'] = $_POST['remote_Chip'];
}
if( isset($_SESSION['hide_remote_Chip']) && $_SESSION['hide_remote_Chip'] == 'true'){  
  $hide_remote_Chip = 'hide';
  $checked_remote_Chip = 'checked';
  $Chip_value = 'false';
}

$hide_remote_Shells = '';
$checked_remote_Shells = "";
$Shells_value = 'true';
if( isset($_POST['remote_Shells']) && $_POST['remote_Shells'] !=""){
  $_SESSION['hide_remote_Shells'] = $_POST['remote_Shells'];
}
if( isset($_SESSION['hide_remote_Shells']) && $_SESSION['hide_remote_Shells'] == 'true'){  
  $hide_remote_Shells = 'hide';
  $checked_remote_Shells = 'checked';
  $Shells_value = 'false';
}
?>

<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
    	<div class="col-sm-6">
        <div class="form-group">
          <label>Results Per Page</label>
          <?php $pagination_array = array(50,100,150,200);?>
   			 <select class="form-control select-field" id="remotes_pagination" name="searching">              
             	<?php foreach($pagination_array as $page){
					if($per_page == $page){
						$selected = 'selected';
					}else{
						if($per_page == $totalrows){
							$selected = 'selected';
						}else{
							$selected = '';
						}
					}
					
					?>
                <option <?php echo $selected;?>><?php echo $page;?></option>
                <?php } ?>
                <option value="<?php echo $totalrows;?>" <?php echo $selected;?>>Show All</option>  				                                  
          </select>         
        </div>
      </div>
      <div class="col-sm-6">
      		<div class="form-group">
            	<label>Show Type: </label>
                <select class="form-control select-field show_remoteby_types custom-select">
                	<option value="all">All</option>                 	                  
            		 <?php foreach($getAllRemoteType as $remote_type){
							
						 if($remote_type['UUID'] ==  $type){
							$selected = "selected";
						}else{
							$selected  = "";;
						}
							
						 ?>
                    <option value="<?php echo $remote_type['UUID'];?>" <?php echo $selected;?>><?php echo $remote_type['Remote_Type_Name'];?></option>
							<?php  }?>          
                </select>
            </div>
      </div>
      <div class="col-sm-4">
        <form method="post" id="searchRemotes">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            <div class="form-group">	
                 <input type="text" name="search_key" class="form-control search_romate_key" value="<?php echo $search_key;?>"><button type="submit" class="btn btn-primary custom-button" >Search</button>
            </div>
        </form>
      </div>
      <div class="col-sm-6">
      		<div class="form-group">
            	<label>Sort by: </label>
                <select class="form-control sortByDate">
                	 <option value="">Select</option> 
						<?php
						if($datefilterromote){
							$selected = "selected";
						}else{
							$selected  = "";;
						}
						?>
            		 <option <?php echo $selected ;?>>Date added</option>       
                </select>
            </div>
      </div>
      <div class="col-sm-2">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/add_remote" class="btn btn-danger" >Add New Remote</a>        
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <a href="<?php echo adm_base_url();?>/export_all_remotes_info" target="_blank" class="btn btn-primary">Export to CSV</a>
      </div>
	  <div class="col-sm-4">
		<form method="post" id="import_csv" enctype="multipart/form-data" action="<?php echo adm_base_url();?>/import_remotes">
		   <div class="form-group">			
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
			<input type="file" name="csv_file" id="csv_file" class="inline" required accept=".csv" />
			<br><span class="importmsg" style="color: #f51616;"></span>
			 <br />
		   <button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn" onclick="target='_blank'; return true;" >Import CSV to Database</button>
		   </div>
		  
		  </form>
		  
		</div>
    </div><br>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    	<?php echo $this->session->flashdata('message_display');?>
     <?php } ?>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_Vehicles" value="<?php echo $v_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $v_value;?>" name="hide_remote_Vehicles" <?php echo $checked_remote_Vehicles;?> /> Hide Vehicles &nbsp; &nbsp;
        </form>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_image" value="<?php echo $img_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $img_value;?>" name="hide_remote_image" <?php echo $checked_remote_image;?> /> Hide Image &nbsp; &nbsp;
        </form>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_OEM_Part_Number" value="<?php echo $OEM_Part_Number_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $OEM_Part_Number_value;?>" name="hide_remote_OEM_Part_Number" <?php echo $checked_remote_OEM_Part_Number;?> /> Hide OEM Part Number &nbsp; &nbsp;
        </form>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_Buttons" value="<?php echo $Buttons_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $Buttons_value;?>" name="hide_remote_Buttons" <?php echo $checked_remote_Buttons;?> /> Hide Buttons &nbsp; &nbsp;
        </form>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_fcci" value="<?php echo $fcci_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $fcci_value;?>" name="hide_remote_fcci" <?php echo $checked_remote_fcci;?> /> Hide FCC/IC/Continental IDs &nbsp; &nbsp;
        </form>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_keys" value="<?php echo $keys_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $keys_value;?>" name="hide_remote_keys" <?php echo $checked_remote_keys;?> /> Hide Test and Emergency Keys &nbsp; &nbsp;
        </form>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_Reusable" value="<?php echo $Reusable_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $Reusable_value;?>" name="hide_remote_Reusable" <?php echo $checked_remote_Reusable;?> /> Hide Reusable &nbsp; &nbsp;
        </form>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_Frequency" value="<?php echo $Frequency_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $Frequency_value;?>" name="hide_remote_Frequency" <?php echo $checked_remote_Frequency;?> /> Hide Frequency &nbsp; &nbsp;
        </form>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_Battery" value="<?php echo $Battery_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $Battery_value;?>" name="hide_remote_Battery" <?php echo $checked_remote_Battery;?> /> Hide Battery &nbsp; &nbsp;
        </form>
        <form method="post" class="inline">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_Chip" value="<?php echo $Chip_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $Chip_value;?>" name="hide_remote_Chip" <?php echo $checked_remote_Chip;?> /> Hide Chip &nbsp; &nbsp;
        </form>
        <form method="post" class="inline m-t">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <input type="hidden" name="remote_Shells" value="<?php echo $Shells_value;?>">
          <input type="checkbox" onclick="this.form.submit()" value="<?php echo $Shells_value;?>" name="hide_remote_Shells" <?php echo $checked_remote_Shells;?> /> Hide Remote Shells 
        </form>
        <br><br>
        <form class="site-form" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="table-responsive chips_data" style="overflow:visible">
            <table class="table table-data mar0 tab-con">
              <thead>
                <tr>
                  <th style="width:137px">Action</th>
                  <th>EZ#
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="id" data_id="DESC"></a>
                  </th> 
                  <th>AKG#
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="id" data_id="DESC"></a>
                  </th>    
                  <th>Type 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Remote_Type_UUID" data_id="DESC"></a>
                  </th>	               
                  <th>Name 
                  	<a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Remote_Name" data_id="DESC"></a>
                  </th>
                  <th class="<?php echo $hide_remote_Vehicles;?>">Vehicles</th>
                  <th class="<?php echo $hide_remote_image;?>">Image
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Remote_Image_Url" data_id="DESC"></a>
                  </th> 
                  <th class="<?php echo $hide_remote_OEM_Part_Number;?>">OEM Part Number
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="OEM_Part_Number" data_id="DESC"></a>
                  </th>
                  <th class="<?php echo $hide_remote_Buttons;?>">Buttons 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Buttons" data_id="DESC"></a>
                  </th> 
                  <th class="<?php echo $hide_remote_fcci;?>">FCC/IC/Continental IDs
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="FCCID" data_id="DESC"></a>
                  </th>
                  
                  <th class="<?php echo $hide_remote_Frequency;?>">Frequency
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Frequency" data_id="DESC"></a>
                  </th>                                 
                  <th class="<?php echo $hide_remote_Battery;?>">Battery
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Battery_UUID" data_id="DESC"></a>
                  </th>
                  <th class="<?php echo $hide_remote_Chip;?>">Chip
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Chip_UUID" data_id="DESC"></a>
                  </th>
                  <th class="<?php echo $hide_remote_keys;?>">Test Key
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="TestKey_UUID" data_id="DESC"></a>
                  </th>
				        <th class="<?php echo $hide_remote_keys;?>">Emergency Keys
                 <!-- <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Emergency_Key_UUID" data_id="DESC"></a>-->
                  </th>
                  <th class="<?php echo $hide_remote_Shells;?>">Remote Shell</th>
                  <th class="<?php echo $hide_remote_Reusable;?>">Reusable?
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Reusable" data_id="DESC"></a>
                  </th>                                   
                  <th>Products
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remote_type_sorting" data-by="Products" data_id="DESC"></a>
                  </th>                  
                </tr>
              </thead>
              <tbody>
              <?php 
                  $i =1;
                  if(isset($_SESSION['lastUpdatedRomote'])){
                    $lastupdate_val = $_SESSION['lastUpdatedRomote'];
                  }else{
                    $lastupdate_val = "";
                  }
                  foreach($results as $value){
                      if($value['id'] == $lastupdate_val){
                      $bgcolor = "style='background: #badffd;'";
                    }else{
                      $bgcolor ="";
                    }
                    ?>
                    <tr <?php echo $bgcolor;?>>
                      <td>
                         <a  href="<?php echo adm_base_url();?>/copy_remote/<?php echo $value['id'];?>" type="button" class="btn btn-info" >Copy</a>                       
                         <a  href="<?php echo adm_base_url();?>/edit_remote/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                        <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_remote/')" type="button"class="btn btn-danger" >Delete</a>
                      </td>
                      <td style="white-space:nowrap;">
                            <div class="product-holder"><span class="td_data"><?php echo $value['ez'];?></span></div>
                            <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['ez'];?>" data-id="<?php echo $value['id'];?>" data-col="ez"></span>
                            <div class="get_column_data"></div>
                        <!-- <br><?php echo $value['id'];?> -->
                      </td>
                      <td style="white-space:nowrap;">
                            <div class="product-holder"><span class="td_data"><?php echo $value['akg_num'];?></span></div>
                            <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['akg_num'];?>" data-id="<?php echo $value['id'];?>" data-col="akg_num"></span>
                            <div class="get_column_data"></div>
                        <!-- <br><?php echo $value['id'];?> -->
                      </td>  
                      <td>
                      	<?php $get_remote_types = get_remote_types($value['Remote_Type_UUID']);?>
                        <div class="product-holder"><span class="td_data"><?php echo $get_remote_types[0]['Remote_Type_Name'];?></span></div>
                       <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Remote_Type_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Remote_Type_UUID" data-key="Remote_Type_UUID" data-type="Remote_Type_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="sorting-column">
                          <div class="product-holder"><span class="td_data"><?php echo $value['Remote_Name'];?></span></div>
                            <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['Remote_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Remote_Name"></span><div class="get_column_data"></div>                          
                      </td>
                      <td class="<?php echo $hide_remote_Vehicles;?> ">
					  <div class="remoteInfoRow">
                      	<?php 
                          if( $value['Vehicles_UUID'] != ""){
							  
                          $vehicles_UUIDs = explode(',', $value['Vehicles_UUID']);
                            for($v = 0; $v < count($vehicles_UUIDs); $v++){
                              $get_vehicles = get_vehicles($vehicles_UUIDs[$v]);
                              $years = explode(',',$get_vehicles[0]['Years']);
                              $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
                              $get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
                              echo $get_make_name[0]['Make_Name'].' ' .$get_models_name[0]['Model_Name'].'  '.$years[0].'-'.$years[count($years)-1].'<br>';
                            }
                          }
                        ?>
						</div>
                      </td>                      
                      <td class="<?php echo $hide_remote_image;?>">
                      	 <?php
                          $images = $value['Remote_Image_Url'];
                          if($images ==""){					  
                          }else{
                          echo '<span class="td_data"><img class="customImage" src ="'.aks_img_url().$images.' "></span>';
                          }					  
                          ?>
                        <span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['Remote_Image_Url'];?>" data-id="<?php echo $value['id'];?>" data-col="Remote_Image_Url"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="<?php echo $hide_remote_OEM_Part_Number;?>">
                      	<div class="product-holder"><span class="td_data"><?php echo $value['OEM_Part_Number'];?></span></div>
                      	<span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['OEM_Part_Number'];?>" data-id="<?php echo $value['id'];?>" data-col="OEM_Part_Number"></span><div class="get_column_data"></div>
                      </td>
                      <td class="<?php echo $hide_remote_Buttons;?>">
                      	 <span class="td_data remoteInfoRow">
							              <?php $buttons_array  = explode(',',$value['Buttons']);
                            for($i = 0; $i < count( $buttons_array)-1; $i++ ){
                                $get_buttons_info = get_buttons_info($buttons_array[$i]);	
                                if( count($get_buttons_info) > 0){
                                        echo $get_buttons_info[0]['Name'].'<br>';
                                }
                            }
                            ?>
                        </span>
                       <!--<span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Buttons'];?>" data-id="<?php echo $value['id'];?>" data-col="Buttons" data-key="Buttons" data-type="Buttons"></span><div class="get_column_data" ></div>-->
                      </td>
                      <td class="<?php echo $hide_remote_fcci;?>">
                      <?php if($value['FCCID'] != ""){?>
                          <span class="td_data"><strong>FCC:</strong> <?php echo $value['FCCID'];?></span><br>
                      <?php } ?>
                      <?php if($value['IC'] != ""){?>
                          <span class="td_data"><strong>IC:</strong> <?php echo $value['IC'];?></span><br>
                      <?php } ?>
                      <?php if($value['Continental_ID'] != ""){?>
                          <span class="td_data"><strong>Cont:</strong> <?php echo $value['Continental_ID'];?></span> 
                      <?php } ?>
                      </td>                      
                      <td class="<?php echo $hide_remote_Frequency;?>">
					  	          <?php $get_frequency_info = get_frequency_info($value['Frequency']);?>
                        <span class="td_data"><?php echo $get_frequency_info[0]['Name'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Frequency'];?>" data-id="<?php echo $value['id'];?>" data-col="Frequency" data-key="Frequency" data-type="Frequency"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_Battery;?>">
                      	<?php $get_batteries = get_batteries($value['Battery_UUID']);?>
                        <span class="td_data"><?php echo $get_batteries[0]['Battery_Name'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Battery_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Battery_UUID" data-key="Battery_UUID" data-type="Battery_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_Chip;?>">
                     	<?php $get_chips = get_chips($value['Chip_UUID']);?> 
                        <div class="product-holder"><span class="td_data"><?php echo $get_chips[0]['Chip_Name'];?></span></div>
                        <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Chip_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Chip_UUID" data-key="Chip_UUID" data-type="Chip_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_keys;?>">
                     	<?php $get_kyes = get_key_name($value['TestKey_UUID']);?> 
                        <span class="td_data"><?php echo $get_kyes[0]['Key_Name'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['TestKey_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="TestKey_UUID" data-key="TestKey_UUID" data-type="TestKey_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_keys;?>"> 
					   <div class="remoteInfoRow">
                        <?php
                        $explode =  explode(',',$value['Emergency_Key_UUID']);
                        foreach($explode as $emr_key){
                        $get_kyes = get_key_name($emr_key);
                        echo $get_kyes[0]['Key_Name'].'<br>';
                        }?> 
						</div>
                       <!-- <span class="td_data"><?php echo $get_kyes[0]['Key_Name'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Emergency_Key_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Emergency_Key_UUID" data-key="Emergency_Key_UUID" data-type="Emergency_Key_UUID"></span><div class="get_column_data" ></div>-->
						
                      </td>
                      <td class="<?php echo $hide_remote_Shells;?>">
						          <?php $shell_array  = $value['Shell_UUID'];
                            $get_remote_name = get_remote_shell_name($shell_array);?>
                        <div class="product-holder"><span class="td_data"><?php  echo $get_remote_name[0]['Remote_Name'];?></span></div>
                        <span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Shell_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Shell_UUID" data-key="Shell_UUID" data-type="Shell_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td class="<?php echo $hide_remote_Reusable;?>">
                      	<div class="product-holder"><span class="td_data"><?php echo $value['Reusable'];?></span></div>
                      	<span class="glyphicon glyphicon-pencil edit_remotes_dropbox" aria-hidden="true" data-val="<?php echo $value['Reusable'];?>" data-id="<?php echo $value['id'];?>" data-col="Reusable" data-key="Reusable" data-type="Reusable"></span><div class="get_column_data"></div> 
                      </td>
                      <td>
					  	          <span class="td_data"><?php echo $value['Products'];?></span>
                      	<span class="glyphicon glyphicon-pencil edit_remotes_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products"></span><div class="get_column_data"></div> 
                      </td>                                 
                      </tr>                   
				<?php }?>
               </tbody>
            </table>
			
            <nav class="site-pg">
			<?php
			if($search_key !="" || $datefilterromote !="" ||($type !="" && $type !="all") ){
				$sesshide = "hide";
			}elseif($type =="all"){
				$sesshide = "";
			}else{
				$sesshide = "";
			}
			
			?>
                <ul class="pagination <?php echo $sesshide;?>">               
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>	
               </ul>
     	  </nav>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>

<!-- right container start here -->
