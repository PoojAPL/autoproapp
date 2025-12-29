<?php 
if($sorting == 'DESC'){
	$sorting_id = 'ASC';
}else if($sorting == 'ASC'){
	$sorting_id = 'DESC';
}
?>

<table class="table table-striped table-data mar0">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Make Name</th>
                  <th>Model  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom " data_id="<?php echo $sorting_id;?>" id="model_sorting" ></a></th>
                  <th style="width: 200px;">Action<th>
                </tr>
              </thead>
              <tbody>
            
               <?php 
			   $i =1;
			  foreach($data as $users){
			  		$make_id = $users['Make_UUID'];
					$make_name_info = admin_makeNameInfo($make_id );
			  ?>
					
                    <tr>
                      <td><?php echo $i++;?></td>
                      <td><?php echo  $make_name_info[0]['Make_Name'];?></td>
                      <td><?php echo $users['Model_Name'];?></td>
                      <td><a  href="<?php echo adm_base_url();?>/edit_model/<?php echo $users['id'];?>" type="button" class="btn btn-success">Edit</a> 
                      <a  href="javascript:void(0)" onClick="DeleteModelFunction(<?php echo $users['id'];?>, '<?php echo adm_base_url();?>/deleteModel/')" type="button"class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
			<?php }  ?>                
			             
               </tbody>
            </table>

