<table class="table table-striped table-data mar0">
              <thead>
                <tr>
                  <th style="width:80px;">Sr.No</th>
                  <th>Model <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom " data_id="DESC" id="makesname_sorting" data-angle ="bottom"></a></th>
                  <th>Make Name </th>                  
                  <th style="width: 137px;">Action</th>
                </tr>
              </thead>
              <tbody>
            
               <?php 
			   //echo $page;
			   //print_r($results);
			   $i =1;
			  foreach($data as $users){
			  		$make_id = $users['Make_UUID'];
					$make_name_info = admin_makeNameInfo($make_id );
			  ?>
                <tr>
                      <td><?php echo $i++;?></td>
                      <td><?php echo $users['Model_Name'];?></td>
                      <td><?php echo  $make_name_info[0]['Make_Name'];?></td>
                      <td><a  href="<?php echo adm_base_url();?>/edit_model/<?php echo $users['id'];?>" type="button" class="btn btn-success">Edit</a> 
                      <a  href="javascript:void(0)" onClick="DeleteModelFunction(<?php echo $users['id'];?>, '<?php echo adm_base_url();?>/deleteModel/')" type="button"class="btn btn-danger">Delete</a>        </td>
                    </tr>
			<?php }  ?>  
               </tbody>
            </table>
           <nav class="site-pg">
        <ul class="pagination">        
        <!-- Show pagination links -->
        <?php foreach ($links as $link) {
        		echo '<li>'. $link.'</li>';
        } ?>	
         
        </ul>
     	</nav>