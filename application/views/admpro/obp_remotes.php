<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">  
    	<div class="col-sm-5">
        	<div class="form-group">
            	<label>Type: </label>
            	<select class="form-control selectImageTypes" data-id="Image_Type_UUID">
                  <option value="all">All</option>
                  <?php foreach($image_types as $type){?>
                    <option value="<?php echo $type['UUID'];?>"><?php echo $type['Name'];?></option>
                 <?php } ?>
                </select>
            </div>
        </div>  	    	
      <div class="col-sm-19">
        <div class="form-group pull-right"> <a href="<?php echo adm_base_url();?>/vehicles/add_obp_remotes" class="btn btn-danger">Add New Procedure</a> </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php if($this->session->flashdata('message_display')){?>
        <?php echo $this->session->flashdata('message_display');?>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="table-responsive tool_data chips_data">
            <table class="table table-bordered table-data mar0">
              <thead>
                <tr>  
                  <th>Vehicle</th>	               
                  <th>Procedure </th>
                  <th>Step</th> 
                  <th>Image </th>
                  <th>Text</th>                                
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php 
				$get_distinct_vehicles = get_distinct_obp_vehicles();
				//print_r($get_distinct_vehicles);
				$count = 1;
				foreach($get_distinct_vehicles as $distinct_vehicle1){
					$vehicle_results_array = get_obp_obp_vehicles($distinct_vehicle1['unique_id']);
					$results_array = get_obp_remotes($distinct_vehicle1['unique_id']);
					$results_array1 = get_obp_remotes1($distinct_vehicle1['unique_id']);
					$results_array2 = get_obp_remotes2($distinct_vehicle1['unique_id']);
					
					if($results_array1 == true){
						$count1 = (count($results_array1));
					}else{
						$count1 = 0;
					}
					if($results_array2 == true){
						$count2 = (count($results_array2));
					}else{
						$count2 = 0;
					}
					$total_rowspan = $count1 + $count2;
					?>
				    <tr>
                    	<td rowspan="<?php echo $total_rowspan;?>">
							<?php 
								$get_vehicle_ids = explode('|',$vehicle_results_array[0]['Vehicle_UUID']);  
								foreach($get_vehicle_ids as $vids){
									$get_vehicles = get_vehicles($vids);								
									$get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
									echo $get_make_name[0]['Make_Name'].' ';
									$get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
									echo $get_models_name[0]['Model_Name'];
									$years = explode(',',$get_vehicles[0]['Years']);
									echo ' '.$years[0];?>-<?php echo $years[count($years)-1].'<br>';
								}								
							?>                           
                        </td>
                          <?php if($results_array1 == true){?>         
                                <td rowspan="<?php echo $count1;?>"><?php  echo $results_array1[0]['Procedure_Number'];?></td>
                                <td><?php  echo $results_array1[0]['Sort_Order'];?></td> 
                                <td>
                                    <?php 
                                        $get_image = get_image($results_array1[0]['Image_UUID']);
                                        if($get_image[0]['Filename'] != ""){?>
                                   <img class="customImage" src="<?php echo base_url();?>images/<?php echo $get_image[0]['Filename'];?>" />
                                    <?php } ?>
                                </td> 
                                <td><div class="product-holder"><?php echo $results_array1[0]['Text'];?></div></td> 
                          <?php }else{ ?>
                          		<td rowspan="<?php echo $count2;?>"><?php  echo $results_array2[0]['Procedure_Number'];?></td>
                                <td><?php  echo $results_array2[0]['Sort_Order'];?></td> 
                                <td>
                                    <?php 
                                        $get_image = get_image($results_array2[0]['Image_UUID']);
                                        if($get_image[0]['Filename'] != ""){?>
                                     <img class="customImage" src="<?php echo base_url();?>images/<?php echo $get_image[0]['Filename'];?>" />
                                    <?php } ?>
                                </td> 
                                <td><div class="product-holder"><?php echo $results_array2[0]['Text'];?></div></td>   
                          <?php } ?> 
                        <td rowspan="<?php echo $total_rowspan;?>">
                            <a href="<?php echo adm_base_url();?>/vehicles/edit_obp_remotes/<?php echo $distinct_vehicle1['unique_id'];?>" class="btn btn-success" >Edit</a>   
                            <a href="javascript:void(0)"class="btn btn-danger" >Delete</a>
                        </td>
                   </tr> 
                   <?php if($results_array1 == true){?>                        
                          <?php 
						  $index1 = 1;						  
						  foreach($results_array1 as $value){
							  if($index1 > 1){  ?>
                                <tr>                                 
                                    <td><?php  echo $value['Sort_Order'];?></td> 
                                    <td>
                                        <?php 
                                            $get_image = get_image($value['Image_UUID']);
                                            if($get_image[0]['Filename'] != ""){?>
                                         <img class="customImage" src="<?php echo base_url();?>images/<?php echo $get_image[0]['Filename'];?>" />
                                        <?php } ?>
                                    </td> 
                                    <td><div class="product-holder"><?php echo $value['Text'];?></div></td>                         
                                </tr>
                        <?php }	
							 $index1++;
						  }
				     }
					if($results_array2 == true){
						if($results_array1 == true){?>
					  		<tr>
                            	<td rowspan="<?php echo $count2;?>"><?php  echo $results_array2[0]['Procedure_Number'];?></td>
                                 <td><?php  echo $results_array2[0]['Sort_Order'];?></td> 
                                <td>
                                    <?php 
                                        $get_image = get_image($results_array2[0]['Image_UUID']);
                                        if($get_image[0]['Filename'] != ""){?>
                                        <img class="customImage" src="<?php echo base_url();?>images/<?php echo $get_image[0]['Filename'];?>" />
                                    <?php } ?>
                                </td> 
                                <td><div class="product-holder"><?php echo $results_array2[0]['Text'];?></div></td>
                            </tr>
                            <?php 
							$index2 = 1;
							foreach($results_array2 as $value){
								 if($index2 > 1){  ?>
                                <tr>
                                    <td><?php  echo $value['Sort_Order'];?></td> 
                                    <td>
                                        <?php 
                                            $get_image = get_image($value['Image_UUID']);
                                            if($get_image[0]['Filename'] != ""){?>
                                           <img class="customImage" src="<?php echo base_url();?>images/<?php echo $get_image[0]['Filename'];?>" />
                                        <?php } ?>
                                    </td> 
                                    <td><div class="product-holder"><?php echo $value['Text'];?></div></td>
                                 </tr>
                            <?php }	
								$index2++;
							}?>
                      	<?php }else{ ?>                       		
							<?php foreach($results_array2 as $value){?>
                                <tr>
                                    <td><?php  echo $value['Sort_Order'];?></td> 
                                    <td>
                                        <?php 
                                            $get_image = get_image($value['Image_UUID']);
                                            if($get_image[0]['Filename'] != ""){?>
                                            <img class="customImage" src="<?php echo base_url();?>images/<?php echo $get_image[0]['Filename'];?>" />
                                        <?php } ?>
                                    </td> 
                                    <td><div class="product-holder"><?php echo $value['Text'];?></div></td>
                                 </tr>
                            <?php }	
					         }
					     }?>
				<?php }?>
              </tbody>
            </table>            
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here --> 