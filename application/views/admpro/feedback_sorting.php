<?php
$angle = ""; 
$sorting_id = "";
if($sorting == 'DESC'){
	$sorting_id = 'ASC';
	$angle = 'top';
}else if($sorting == 'ASC'){
	$sorting_id = 'DESC';
	$angle = 'bottom';
}
$addressed_hide = '';
$addressed_checked = '';
if(isset($_COOKIE['Addressed_cookie'])){ 
	 $cookieValue = $_COOKIE['Addressed_cookie'];
	 if( $cookieValue == 1){
		$addressed_hide = 'hide';
		$addressed_checked = 'checked';
	 }else{
		$addressed_hide = '';
		$addressed_checked = '';
	 }
}
?>
<table class="table table-bordered  table-data mar0 tab-con">
  <thead>
    <tr>  
      <th>Date 
      <?php if($sorting_by == 'id'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> feedback_sorting" data-by="id" data_id="<?php echo $sorting_id;?>"></a>
      <?php }else{?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="id" data_id="DESC"></a>
      <?php } ?>
      </th>	               
      <th>Vehicle 
      <?php if($sorting_by == 'Vehicle'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> feedback_sorting" data-by="Vehicle" data_id="<?php echo $sorting_id;?>"></a>
      <?php }else{?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Vehicle" data_id="DESC"></a>
       <?php } ?>
      </th>
      <th>Worked 
       <?php if($sorting_by == 'Worked'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> feedback_sorting" data-by="Worked" data_id="<?php echo $sorting_id;?>"></a>
      <?php }else{?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Worked" data_id="DESC"></a>
      <?php } ?>
      </th>
      <th>Description 
      <?php if($sorting_by == 'Description'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> feedback_sorting" data-by="Description" data_id="<?php echo $sorting_id;?>"></a>
      <?php }else{?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Description" data_id="DESC"></a>
      <?php } ?>
      </th> 
      <th>Submitted By
      <?php if($sorting_by == 'Submitted_By'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> feedback_sorting" data-by="Submitted_By" data_id="<?php echo $sorting_id;?>"></a>
      <?php }else{?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Submitted_By" data_id="DESC"></a>
      <?php } ?>
      </th>
      <th >Addressed 
      <?php if($sorting_by == 'Addressed'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> feedback_sorting" data-by="Addressed" data_id="<?php echo $sorting_id;?>"></a>
      <?php }else{?>  
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Addressed" data_id="DESC"></a>
      <?php } ?>
      </th> 
      <th>Confirmed Working</th>
      <th style="width:137px">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $i =1;
  foreach($results as $value){
	  if($value['Addressed'] == 'No'){
		  $no_check = 'checked';
		  $yes_check = '';
		  $addressed = '';
		  $addressed_hide1 = '';
	  }else{
		  $no_check = '';
		  $yes_check = 'checked';	
		  $addressed = 'addressed';
		  $addressed_hide1 = $addressed_hide;	
	  }?>
     <tr class="<?php echo $addressed;?> <?php echo $addressed_hide1;?>">
          <td>
              <span class="td_data"><?php echo $value['Date'];?></span>
              <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Date'];?>" data-id="<?php echo $value['id'];?>" data-col="Date"></span><div class="get_column_data"></div>
          </td>
          <td>
              <span class="td_data"><?php echo $value['Vehicle'];?></span>
              <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Vehicle'];?>" data-id="<?php echo $value['id'];?>" data-col="Vehicle"></span><div class="get_column_data"></div>
          </td>
          <td><?php echo $value['Worked'];?></td>
          <td>
              <span class="td_data" style="width:200px;word-wrap: break-word;white-space: pre-line;"><?php echo $value['Description'];?></span>
              <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Description'];?>" data-id="<?php echo $value['id'];?>" data-col="Description"></span><div class="get_column_data"></div>
          </td>
          <td>
               <span class="td_data" style="width:200px;"><?php echo $value['Submitted_By'];?></span>
              <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Submitted_By'];?>" data-id="<?php echo $value['id'];?>" data-col="Submitted_By"></span><div class="get_column_data"></div>
              <?php if($value['Phone'] != ""){?>
                 <?php echo $value['Phone'];?>
              <?php } ?>                       
          </td>
          <td><input type="checkbox" class="addressed_button" data-toggle="toggle" name="Addressed" <?php echo $yes_check;?>></td>
          <td>
              <span class="td_data" style="width:200px;"><?php echo $value['Confirmed_Working'];?></span>
              <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Confirmed_Working'];?>" data-id="<?php echo $value['id'];?>" data-col="Confirmed_Working"></span><div class="get_column_data"></div>                      
          </td>
          <td>   
               <a href="<?php echo adm_base_url();?>/edit_feedback/<?php echo $value['id']?>" type="button" class="btn btn-success">Edit</a>
               <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_feedbacks/')"  type="button" class="btn btn-danger">Delete</a></td>
       </tr>                
  <?php }?>
 </tbody>
</table>
<script>
  $(function() {
    $('.addressed_button').bootstrapToggle();
  })
</script>