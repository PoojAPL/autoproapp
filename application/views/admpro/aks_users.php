<script src="https://www.gstatic.com/firebasejs/4.3.1/firebase.js"></script>
<div id="right-container" class="white-box">
  <div class="site-form form-inline">
    <div class="row"> 
    <div class="col-sm-6">
      <form method="post" id="searchUsers" novalidate="novalidate">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <div class="form-group">                     
             <input type="text" name="search_key" class="form-control" style="width: 400px !important; " placeholder="Enter at least 3 characters for searching">
             <button type="submit" class="btn btn-primary custom-button">Search</button>
        </div>
     </form>
     </div>
     <div class="col-sm-6">
        <div class="form-group addCodeSeries"> </div>
      </div>
     <div class="col-sm-12">
        <div class="form-group addCodeSeries"> <a href="<?php echo adm_base_url();?>/update_aks_users_with_aks" class="btn btn-info"  title="Update Users With AKS">Update Users From AKS</a> </div>

        

        
      </div>   	
      <!-- <div class="col-sm-6">
        <div class="form-group addCodeSeries"> <a href="javascript:void(0)" class="btn btn-danger UpdateFirebaseUsers"  title="Update Users">Update Users With Firebase</a> </div>
      </div> -->
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
    <!-- <table width="100%">
    <thead>
      <th>Make</th>
      <th>Model</th>
      <th>Year</th>
      <th>Mechanical Key</th>
      <th>Chip Key</th>
      <th>Chip Name</th>
      <th>Products(Mechanical Key)</th>
      <th>Products(Chip Key)</th>
      <th>Products(Remote)</th>
      <th>Products(Chip)</th>
    </thead> -->
    <?php 
        // foreach(get_make_and_models() as $value){
        //   $mach_keys_uuids = "";								
        //   $mach_keys_array = explode(',',$value['Mechanical_Key_UUID']);
        //   for($i = 0; $i < count($mach_keys_array); $i++ ){
        //     $get_key_name = get_key_name($mach_keys_array[$i]);
        //     $mach_keys_uuids .=  $get_key_name[0]['Key_Name'].'<br>';
        //   }
        //   $chip_keys_uuids = "";	
        //   $Chip_UUID_name = "";	
        //   $Chip_UUID_Products = "";						
        //   $chip_keys_array = explode(',',$value['Chip_Key_UUID']);
        //   for($i = 0; $i < count($chip_keys_array); $i++ ){
        //     $get_key_name = get_key_name($chip_keys_array[$i]);
        //     $chip_keys_uuids .=  $get_key_name[0]['Key_Name'].'<br>';
        //     $get_chips = get_chips($get_key_name[0]['Chip_UUID']);
        //     $Chip_UUID_name .=  $get_chips[0]['Chip_Name'].'<br>';
        //     $Chip_UUID_Products .=  $get_chips[0]['Products'].'<br>';
        //   }
        //   //echo $value['UUID'].'<br>';
        //   $remotes_Products = "";
        //   $get_vehicles_remotes = get_vehicles_remotes($value['UUID']);
        //   foreach($get_vehicles_remotes as $get_remote_name){
        //     $remotes_Products .= $get_remote_name['Products'].',';
        //   }
        //   $mach_Products = "";
        //   for($i = 0; $i < count($mach_keys_array); $i++ ){
        //       $mck_product_array = array();
        //       $get_key_name = get_key_name($mach_keys_array[$i]);
        //       $mach_Products .= $get_key_name[0]['Products'].',';
        //   } 
        //   $chip_Products = "";
        //   for($i = 0; $i < count($chip_keys_array); $i++ ){
        //     $get_key_name = get_key_name($chip_keys_array[$i]);
        //     $chip_Products .= $get_key_name[0]['Products'].',';	
        //   }   
        //   $mach_Products2 = rtrim($mach_Products,',');
        //   $chip_Products2 = rtrim($chip_Products,',');
        //   $remotes_Products2 = rtrim($remotes_Products,',');
        //   echo '<tr><td>'.$value['Make_Name'].'</td>
        //   <td>'.$value['Model_Name'].'</td>
        //   <td>'.str_replace(',','-',$value['Years']).'</td>
        //   <td>'.rtrim($mach_keys_uuids,'<br>').'</td>
        //   <td>'.rtrim($chip_keys_uuids,'<br>').'</td>
        //   <td>'.rtrim($Chip_UUID_name,'<br>').'</td>
        //   <td>'.str_replace(',',' , ',$mach_Products2).'</td>
        //   <td>'.str_replace(',',' , ',$chip_Products2).'</td>
        //   <td>'.str_replace(',',' , ',$remotes_Products2).'</td> 
        //   <td>'.str_replace(',',' , ',$Chip_UUID_Products).'</td>         
        //   <tr>';
        // }
        
        ?>
      <!-- </table>   -->
      <section>
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div id="fireResult" style="text-align:left;"></div><br />
        <div class="site-form" method="post" data-id="<?php echo $last_aks_results[0]['User_UUID'];?>">
          <br><div class="table-responsive users_data"></div>
        </div>
      </section>
    </div>
  </div>
</div>
<?php
if(isset($last_aks_results[0]['User_UUID'])){
	$value = $last_aks_results[0]['User_UUID'];
}else{ 
	$value = 0;
}	
if(is_numeric($value)){
	$last_inserted_id = $value;
}else{
	$last_inserted_id = 0;
}
?>
<input type="hidden" id="aks_object" value="<?php echo $last_inserted_id;?>" >
<script>
var config = {
    apiKey: "AIzaSyA1kkLsRv7v_tTafk5aCQWnXeWV_plC5_k",
    authDomain: "autoproapp2017.firebaseapp.com",
    databaseURL: "https://autoproapp2017.firebaseio.com",
    projectId: "autoproapp2017",
    storageBucket: "autoproapp2017.appspot.com",
    messagingSenderId: "988140303282"
};
/*var config = {
    apiKey: "AIzaSyAOGEGaxRqauTKn14rrg7NsfSpgAgqmWQ4",
    authDomain: "american-key.firebaseapp.com",
    databaseURL: "https://american-key.firebaseio.com",
    projectId: "american-key",
    storageBucket: "american-key.appspot.com",
    messagingSenderId: "699615089846"
};*/
var bse_url = 'http://autoproapp.com/';
firebase.initializeApp(config);
  function clearDevice(e) {
    document.getElementById("loader").className = ""; 
    var status_val = e.target.value;
    var userid = e.target.getAttribute('data_id');
    var user_root_path = '/users/'+userid+'/devices';
    //var user_root_path2 = '/users/'+userid+'/devices/device2';
    var fireBaseRef3 = firebase.database().ref(user_root_path);
    //var fireBaseRef4 = firebase.database().ref(user_root_path2);    
    fireBaseRef3.remove();
    setTimeout(function(){ 
      document.getElementById('fireResult').innerText = 'Data updated succesfully';
      document.getElementById("loader").className = "hide";
    }, 2000);   
    setTimeout(function(){ 
      document.getElementById('fireResult').innerText = '';
      //document.getElementById("loader").className = "hide";
    }, 4000);   
}
</script>