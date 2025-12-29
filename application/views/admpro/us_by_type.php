<table class="table table-striped table-data mar0">
<thead>
  <tr> 
    <th>Submitted <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom" data_id="DESC"></a></th>  
    <th>User</th>                
    <th>Type</th>  
    <th>Vehicle</th>  
    <th>Details</th>
    <th>Other Vehicles</th>   
    <th>Images</th>                                 
    <th>Status</th>                 
  </tr>
</thead>
<tbody>
<?php if($type == 'corrections'){?>
<tbody>
      <?php //echo $key.'<br>';
              foreach($vehicle_images as $v_images){
				  $Status = $v_images['Status'];
				  ?>
              <tr>
                  <td><?php echo $v_images['Dated'];?></td>
                  <td></td>
                  <td></td>
                  <td>
                      <?php  
                          $get_vehicles = get_vehicles_by_id($v_images['VehicleID']);	
                          if($get_vehicles == true){							
                              $get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
                              echo $get_make_name[0]['Make_Name'].' ';
                              $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
                              echo $get_models_name[0]['Model_Name'];
                              $years = explode(',',$get_vehicles[0]['Years']);?>
                               <?php echo $years[0];?>-<?php echo $years[count($years)-1];?>
                          <?php }else{
                              echo 'Vehicle ID: '. $v_images['VehicleID'];
                          }
                      ?> 
                  </td>
                   <td><?php echo $v_images['Title'];?></td>
                   <td></td>
                  <td><?php echo $v_images['Image_path'];?></td>
                  
                  <td>
                      <?php if( $v_images['CorrectionID'] == ""){?>
                      <select class="form-control" style="width: 170px;" onchange="ChangeEventListener(event)" data-id="/vehicle-info/<?php echo $v_images['VehicleID'];?>/images/<?php echo $img_key['UUID'];?>" data-cid=""> 
                      <?php }else{ ?>                      
                      <select class="form-control" style="width: 170px;" onchange="ChangeEventListener(event)" data-id="/vehicle-info/<?php echo $v_images['VehicleID'];?>/images/<?php echo $img_key['UUID'];?>"data-cid="/vehicle-corrections/<?php echo $v_images['CorrectionID'];?>"> 
                      <?php } ?>                               
                      <?php 
						$correction_status = correction_status();
						foreach($correction_status as $skey => $status){
							if($Status == $status){
								$selected = 'selected';
							}else{
								$selected = '';
							}
							?>
							<option <?php echo $selected;?> value="<?php echo $status;?>"><?php echo $skey;?></option>
						<?php  } ?>
                    </select>
                  </td>
                </tr>	
              <?php } ?>             
  		 </tbody>
<?php }else if($type == 'images'){  ?>
<tbody id="user_data">
<?php 
     foreach($user_correction as $key => $value1){
           $Status = $value1['Status'];
          if($value1['Feedback_type'] == 'images'){
			 	 ?>
              <tr>
              <td><?php echo $value1['Dated'];?></td>
              <td><?php echo $value1['User_UUID'];?></td>
              <td><?php echo $value1['Feedback_type'];?></td>  
              <td><?php echo $value1['Info'];?> </td>
              <td><?php echo $value1['User_Review'];?></td>  
              <td></td>
              <td></td>
              <td>
                  <select class="form-control feedbackStatus" data-type="<?php echo $value1['type'];?>" onchange="ChangeCorrection(event)" data-cid="/vehicle-corrections/<?php echo $value1['UUID'];?>">                                
                     <?php 
					  $correction_status = correction_status();
					  foreach($correction_status as $skey => $status){
						  if($Status == $status){
							  $selected = 'selected';
						  }else{
							  $selected = '';
						  }
						  ?>
						  <option <?php echo $selected;?> value="<?php echo $status;?>"><?php echo $skey;?></option>
					  <?php  } ?>
                    </select>
              </td>            
          </tr>
         <?php 
       
    }else if( ($value1['Feedback_type'] == 'keymaking') || ($value1['Feedback_type'] == 'tip_tricks') ){ ?>                  		
      <tr>
          <td><?php echo $value1['Dated'];?></td>
          <td><?php echo $value1['User_UUID'];?></td>
          <td>Steps: <?php echo $value1['Info'];?></td>
          <td><?php echo $value1['Feedback_type'];?></td>                        
          <td>likes: <?php echo $value1['likes'];?><br /> Dislikes: <?php echo $value1['dislikes'];?></td>  
          <td></td>
          <td></td>
          <td>
              <select class="form-control feedbackStatus" data-type="<?php echo $value1['Feedback_type'];?>" onchange="ChangeCorrection(event)" data-cid="/vehicle-corrections/<?php echo $value1['UUID'];?>">                                
                  <?php 
				  $correction_status = correction_status();
				  foreach($correction_status as $skey => $status){
					  if($Status == $status){
						  $selected = 'selected';
					  }else{
						  $selected = '';
					  }
					  ?>
					  <option <?php echo $selected;?> value="<?php echo $status;?>"><?php echo $skey;?></option>
				  <?php  } ?>
                </select>
          </td>            
      </tr>
      
    <?php }
  } ?>     
</tbody>
<?php }else if($type == 'methods'){  ?>
<tbody>
      <?php foreach( $methods  as $value){?>
      <tr>
          <td><?php echo date('Y-m-d H:i:s');?></td>
          <td> 
              <?php 
                  $get_users_info = get_users_info( $value['User_UUID'] ); 
                  echo $get_users_info[0]['FirstName'].' '.$get_users_info[0]['LastName'];
              ?> 
          </td>
          <td>Method</td>
          <td> 
              <?php 
                    $Vehicles_UUID = $value['Vehicle_UUID'];
                    $get_vehicles = get_vehicles($Vehicles_UUID);
                    $years = explode(',',$get_vehicles[0]['Years']);
                    $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
                    echo $get_models_name[0]['Model_Name'].', '.$years[0].'-'.$years[count($years)-1];
                ?>
          </td>
          <td> <?php echo $value['Title'];?> 
          <br /> <?php echo $value['Content'];?> </td>
          <td></td>
          <td> 
              <?php 
                  $get_image_type = get_image_type( $value['Images_UUID'] ); 
                  echo $get_image_type[0]['Name'];
              ?> 
          </td>
          <td> <?php echo $value['Status'];?> </td>
          
           <!--<td>
                <a href="<?php echo adm_base_url();?>/edit_method/<?php echo $value['Id'];?>" type="button" class="btn btn-success" >Edit</a> 
                <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['Id'];?>, '<?php echo adm_base_url();?>/delete_method/')" class="btn btn-danger" >Delete</a>
             </td>-->
      </tr>
      <?php } ?>
  </tbody>
<?php }else{  ?>
<tr><td colspan="10"><div class="alert alert-danger">Data not available.</div></td></tr> 
<?php } ?>
</table>
