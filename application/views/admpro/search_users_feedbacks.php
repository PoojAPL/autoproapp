
<table class="table table-data mar0">
<thead>
<tr>
  <th>Date/User</th>   
  <th>Subject</th>  
  <th>Message</th>    
  <th>Image</th> 
  <th>Status</th>                                                  
</tr>
</thead>
  <tbody>
  	<?php 
	$correction_status = array('pending' => 'Waiting for Review','reviewed' => 'Reviewed');
  	foreach ($get_user_feedbacks as $value) {
  			$Status = $value['status'];
  			if( $Status=='reviewed'){
				  $pending_hide = 'pending';
			  }else{
				  $pending_hide = ''; 
			  }?>
  		 <tr class="<?php echo $pending_hide;?>">
  		 	<td><?php echo $value['dated'];?>/
  		 		<?php echo $value['dated'];?>
      		 	<br><?php echo $value['User_Name'];?>
      		 	<br><?php echo $value['User_Email'];?>	
  		 	</td>
  		 	<td><?php echo $value['subject'];?></td>
  		 	<td><?php echo $value['feedback'];?></td>
  		 	<td>
  		 		<?php if( isset( $value['imageURL'] ) ){ ?>
  		 		<a href="<?php echo $value['imageURL'];?>" target="_blank"><img src="<?php echo $value['imageURL'];?>" style="width:100px;"></a>
  		 		<?php } ?>
  		 	</td>
  		 	<td>
  		 		<select style="width: 160px;" class="form-control" onchange="ChangeCorrection(event)" data-cid="/feedbacks/<?php echo $value['UUID'];?>">
  		 		 <?php								
					foreach($correction_status as $skey => $status){
						if( $Status == $skey){
							$selected = 'selected';
							$disabled = 'disabled';
						}else{
							$selected = '';
						}?>
						<option <?php echo $selected;?> value="<?php echo $skey;?>"><?php echo $status;?></option>
					<?php  } ?>
                </select>
  		 	</td>
  		 </tr>
  	<?php } ?>
  	
  </tbody>             
</table>            
