<table class="table table-striped table-data mar0">
  <thead>
    <tr>               
      <th>Date/Time</th>
      <th class="">User UUID </th>
      <th>Details</th>
      <th>Feedback Type</th>
      <th>Review</th>  
      <th>Status</th>                                                    
      
    </tr>
  </thead> 
  <tbody>
    <?php if( count($results) > 0){
         foreach($results as $value){?>
        <tr>
                    	<td><?php echo $value['Dated'];?></td>
                        <!--<td><strong>Username:  </strong><?php echo $value['User_Name'];?><br />
                        	<strong>E-mail:  </strong><?php echo $value['User_Email'];?><br />
                            <strong>Type: </strong>
							<?php  $get_users_type = users_type();
							foreach( $get_users_type as $key => $user_type){
									if($value['User_Type'] == $key){
										$selected = 'selected';?>
										<?php echo $user_type;?>
								<?php }
							} ?>
                        </td>-->
                        <td> <?php echo $value['User_UUID'];?></td>
                        <td><?php echo $value['Info'];?></td>
                        <td><?php echo $value['Feedback_type'];?></td>
                        
                        <td><?php echo $value['User_Review'];?></td>  
                        <td>
                        	  <select class="form-control feedbackStatus" id="<?php echo $value['id'];?>">                                
                                <?php 
								$correction_status = correction_status();
								foreach($correction_status as $status){
									if($status == $value['Status']){
										$selected = 'selected';
									}else{
										$selected = '';
									}
									?>
                                    <option <?php echo $selected;?>><?php echo $status;?></option>
                                <?php  } ?>
                              </select>
                        </td>                                              
                        
                    </tr>
    <?php }
    }else{?>
        <tr><td colspan="10"><div class="alert alert-danger">Data not available!</div></td></tr>
    <?php } ?>
  </tbody>             
</table>       

