
<?php $angle = ""; 
$sorting_id = "";
if($sorting == 'DESC'){
  $sorting_id = 'ASC';
  $angle = 'top';
}else if($sorting == 'ASC'){
  $sorting_id = 'DESC';
  $angle = 'bottom';
}

?>
<table class="table table-striped table-data mar0">
  <thead>
    <tr>  
      <th>User
        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> aks_users_sorting" data_id="<?php echo $sorting_id;?>" data-col="FirstName"></a>
      </th> 
      <th style="width: 200px;">Account Status</th>  
      <th>User Class</th>  
      <th>User Score
        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> aks_users_sorting" data_id="<?php echo $sorting_id;?>" data-col="FirstName"></a>
      </th> 
      <th style="text-align: center;">Action</th>      
    </tr>
  </thead>
 	<tbody>
    	<?php 
			if(count($aks_results) > 0){
        //$aks_results = array_unique($aks_results);
				foreach($aks_results as $users){?>
				<tr>
					<td> <?php echo $users['FirstName']; ?> <?php echo $users['LastName']; ?><br>
          <?php echo $users['Email']; ?><br /><?php echo $users['PhoneNumber']; ?>
          <?php if($users['zipcode'] != ""){
              //echo '<br>Zip Code: '.$users['zipcode'];
          }?><br>
          <strong>AutoProApp Points: </strong><?php echo get_aks_cutomers_points($users['User_UUID']);?><br>
          <u><a style="color: #337ab7;" href="https://admin.americankeysupply.com/admV2/customers.php?page=1&cID=<?php echo $users['User_UUID']; ?>&action=edit" target="_blank">Edit</a></u>
        </td>                            
          <td> 
          	<?php 
             $status_array = $customers_authorization_array = customers_authorization_array();
          	 foreach($status_array as $skey=> $status){
                if($users['Status'] == $skey){
                    echo $status;
                }
             }?>           
          </td>
          <td></td>
          <td></td>
          <td style="float: right;">            
            <a href="<?php echo adm_base_url();?>/aks_users_activity/<?php echo $users['Id']; ?>" class="btn btn-info">Show User Activity</a>
            <a href="javascript:void(0)" onclick="clearDevice(event)" data_id="<?php echo $users['User_UUID'];?>" class="btn btn-primary">Clear Devices</a>
            <a href="javascript:void(0)" class="btn btn-danger">Change PW</a>
          </td>  
				</tr>
        <?php } 					
			}?>
    </tbody>
   <tbody id="aks_user_data2cc"></tbody>
</table> 