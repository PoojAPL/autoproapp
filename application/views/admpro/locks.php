<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">  
    <div class="col-sm-12">
        <form method="post" id="globalSearchKyes">
            <div class="form-group">                     
                  <input type="text" name="search_global_key" class="form-control search_global_key">
                  <button type="submit" class="btn btn-primary custom-button" name="search" value="locks">Search</button>
            </div>
        </form>
      </div>  	
      <div class="col-sm-12">
        <div class="form-group addCodeSeries"> <a href="<?php echo adm_base_url();?>/add_locks" class="btn btn-danger"  title="Add New Lock">Add New Lock</a> </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="table-responsive tool_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr> 
				   <th style="width:137px">Action</th>
                  <th>ID</th> 
                  <th>Name
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom part_sorting" data-by="Part_Name" data_id="DESC"></a>
                  </th> 
                  
                  <th>Type</th>                   
                  <th>Vehicles</th>
                  <th>Image Url</th> 
                  <th>Products</th>                 
                </tr>
              </thead>
             	<tbody>
                	<?php foreach($results as $value){?>
                    	<tr>
						 <td>
                              <a href="<?php echo adm_base_url();?>/edit_locks/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a> 
                              <a href="<?php echo adm_base_url();?>/copy_locks/<?php echo $value['id'];?>" type="button" class="btn btn-info" >Copy</a>
                              <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_parts/')" class="btn btn-danger" >Delete</a>
                           </td>
                         <td><?php echo $value['id'];?></td>
                        	<td><?php echo $value['Part_Name'];?></td>
                           
                            <td>
								<?php 
								 $PartType_UUID = $value['PartType_UUID'];
								 $get_part_type_info = get_part_type_info($PartType_UUID);
								 echo $get_part_type_info[0]['Name'];
								?>
                            </td>
                            
                            <td>
								<?php 
                                    if( $value['Vehicles_UUID'] != ""){
									$vehicles_UUIDs = explode(',', $value['Vehicles_UUID']);
										for($v = 0; $v < count($vehicles_UUIDs); $v++){
											$get_vehicles = get_vehicles($vehicles_UUIDs[$v]);
											$years = explode(',',$get_vehicles[0]['Years']);
											$get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
											$get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
											echo $get_make_name[0]['Make_Name'].' ' .$get_models_name[0]['Model_Name'].'  '.$years[0].'-'.$years[count($years)-1].'<br>';
										}
									}
                                ?>
                            </td>
                            <td><?php echo $value['Part_Image_Url'];?></td>
                            <td><?php echo $value['Products'];?></td>
                           
                        </tr>
                    <?php } ?>
                </tbody>
            </table> 
		<?php if(isset($links)){?>
		   <nav class="site-pg">
			 <ul class="pagination">               
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>	
               </ul>
			   </nav>
			<?php }?>				
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->