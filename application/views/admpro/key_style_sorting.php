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
?>
<table class="table table-striped table-data mar0">
  <thead>
    <tr>
      <th> Name 
       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?> key_style_sorting" data-by="Key_Style_Name"  data_id="<?php echo $sorting_id;?>"></a>
      </th>
      <th style="width: 137px;">Action</th>
    </tr>
  </thead>
  <tbody>
   <?php
   $i =1;
  foreach($getAllkeyStyles as $value){?>
        <tr>                    	
          <td>
            <span class="td_data"><?php echo $value['Key_Style_Name'];?></span>
            <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Key_Style_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Key_Style_Name" data-table="t_Key_Styles" data-img=""></span><div class="get_column_data"></div> 
          </td>
          <td><a  href="<?php echo adm_base_url();?>/edit_keystyle/<?php echo $value['id'];?>" type="button" class="btn btn-success">Edit</a> 
          <a  href="javascript:void(0)" onclick="DeleteKeystyle(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/deleteKeyStyle/')" type="button"class="btn btn-danger">Delete</a>        </td>
         
        </tr> 
      <?php }?>
   </tbody>
</table>