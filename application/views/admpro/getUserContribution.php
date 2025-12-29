<?php 
error_reporting(0);
$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe'; 
$cSession1 = curl_init();         
curl_setopt($cSession1,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/submitted_feedback.json?". http_build_query($options));
curl_setopt($cSession1, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));  
curl_setopt($cSession1, CURLOPT_CUSTOMREQUEST, "GET");            
curl_setopt($cSession1, CURLOPT_POSTFIELDS,''); 
curl_setopt($cSession1,CURLOPT_RETURNTRANSFER,true);  
curl_setopt($cSession1, CURLOPT_SSL_VERIFYPEER, false);    
$result_output1 = curl_exec($cSession1);       
curl_error($cSession1);                   
$outputs1 = json_decode($result_output1, true);
foreach($outputs1 as $key => $value){
          //echo $key .'=>'. $value.'<br>';
          foreach($value as $key1 => $value1){
            $type = $key1;
            foreach($value1 as $image_key => $image_value){
              //echo $image_value['approved'].'<br>';
                if( $image_value['status']=='approved' ){
                  $disabled = '';
                  $Status = 'approved';
                  $rejected_hide = '';
                  $approved_hide = 'approved hide';
                  $pending_hide = '';
                }else if( $image_value['status']=='rejected'){
                  $disabled = '';
                  $Status = 'rejected';
                  $rejected_hide = 'rejected_hide hide';
                  $approved_hide = '';
                  $pending_hide = '';
                }else{
                  $disabled = '';
                  $Status = 'pending';
                  $rejected_hide = '';
                  $approved_hide = '';
                  $pending_hide = 'pending'; 
                } 
                $date = $image_value['date'];
                $UUID = $image_key;
                $VehicleID = $image_value['vehicleID'];
                //$key = $VehicleID;
                $User_Email = $image_value['userID'];
                $User_Name = '';
                $User_Type = '';
                $Vehicle_UUID = $image_value['vehicleName'];
                $Feedback_type = $type;
                $User_Review = '';                
                $User_UUID = '';
                $vehcile_info = $image_value['vehicleName']; 
                //echo '<br>';
                $imagepaths = "";
                if (isset($image_value['imagepaths']) && $image_value['imagepaths'] != "") {
                  $Image_path_data = $image_value['imagepaths'];
                  foreach ($Image_path_data as $key => $images) {
                    $imagepaths .= $images.',';
                  }
                  $full_path = rtrim($imagepaths,',');
                }else if (isset($image_value['imagePaths']) && $image_value['imagePaths'] != "") {
                  $Image_path_data = $image_value['imagePaths'];
                  foreach ($Image_path_data as $key => $images) {
                    $imagepaths .= $images.',';
                  }
                  $full_path = rtrim($imagepaths,',');
                }else{
                  $Image_path_data = explode(',',$image_value['imagePath']);
                  foreach ($Image_path_data as $key => $images) {
                    $imagepaths .= $images.',';
                  }
                  $full_path = rtrim($imagepaths,',');
                }
                //echo $full_path.'<br>';
                $Title = $image_value['title'];
                $videospaths = "";
                $video_path_data = $image_value['video'];
                  foreach ($video_path_data as $key => $videos) {
                  $videospaths .= $videos.',';
                }
                $video = rtrim($videospaths,',');;
                $CorrectionID = '';
                $other_vehicle = $image_value['otherVehicles'];
                if($Feedback_type == 'key_making'){
                  $content = $image_value['content'];
                }else{
                    $content = $image_value['content'];
                }
                $category = $image_value['category'];
                if( isset($image_value['range']) && $image_value['range'] != ""){
                  $year_range = $image_value['range'];
                }else{
                  $year_range = $image_value['yearRange'];
                }
                
                //$save_vehicle_images = save_vehicle_images($UUID,$VehicleID,$Image_path,$Title,$Status,$CorrectionID);
                if($Feedback_type == 'vehicle_tips_tricks' || $Feedback_type == 'key_making'){
                  $likes = 0; 
                $dislikes = 0; 
                $info = '';
                $save_app_corrections2 = save_app_corrections2($UUID,$User_Email,$User_Name,$User_Type,$Feedback_type,$Status,$User_UUID,$likes,$dislikes,$info, $full_path,$Title,$other_vehicle,$content,$VehicleID,$Vehicle_UUID,$date,$category,$video,$year_range);
                }else{
                  $save_app_corrections = save_app_corrections($UUID,$User_Email,$User_Name,$User_Type,$Vehicle_UUID,$Feedback_type,$Status,$User_Review,$full_path,$User_UUID,$vehcile_info,$Title,$other_vehicle,$content,$VehicleID,$date,$category,$video,$year_range);
                }
             }
             $saved = 1;
          }
 }
 echo $get_user_submission = get_users_contribution_count();
?>