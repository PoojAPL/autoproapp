<?php
$sort = '';
$sort_col = '';
if( isset($this->session->userdata['pagination_per_page2'])){
	$per_page1 = $this->session->userdata['pagination_per_page2'];
	$per_page1['per_page'];
}
if(isset($this->session->userdata['tools_sorting_session'])){
  $sorting_data = $this->session->userdata['tools_sorting_session']; 
  $sort = $sorting_data['sorting'];
  $sort_col = $sorting_data['column'];
}
$angle = ""; 
$sorting_id = "";
if($sort == 'DESC'){
	$sorting_id = 'ASC';
	$angle = 'top';
}else if($sort == 'ASC'){
	$sorting_id = 'DESC';
	$angle = 'bottom';
}
echo $sort_col;
?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
    	<div class="col-sm-6">
        <div class="form-group">
          <label>Results Per Page</label>
   			 <select class="form-control select-field" id="tools_result" name="searching">              
             	<option value ="50" >50 </option>                
                <?php if($per_page1['per_page'] == 100){
                	echo '<option value ="100" selected="selected">100</option>';
				}else{
					 echo '<option value ="100" >100</option>';
				}				
				if($per_page1['per_page'] == 150){
                	echo '<option value ="150" selected="selected">150</option>';
				}else{
					 echo '<option value ="150" >150</option>';
				}				
				if($per_page1['per_page'] == 200){
                	echo '<option value ="200" selected="selected">200</option>';
				}else{
					 echo '<option value ="200" >200</option>';
				}
				if($per_page1['per_page'] == $totalrows){?>
                	<option value="<?php echo $totalrows;?>" selected="selected">Show All</option>  
				<?php }else{ ?>
					 <option value="<?php echo $totalrows;?>">Show All</option>  
				<?php }	?>                                  
          </select>
          <!--<input type="text" class="form-control sm-input" placeholder="" id="result">-->
        </div>
      </div>
    	<div class="col-sm-4">
        	<div  class="form-group">
            	<label>Type: </label>
            	<select class="form-control selectByTypes" data-id="Tool_Type_UUID">
                  <option value="all">All</option>
                  <?php foreach($getAllToolType as $tool_types){?>
                  <option value="<?php echo $tool_types['UUID'];?>"><?php echo $tool_types['Tool_Type_Name'];?></option>
                  <?php }?>
                </select>
            </div>
        </div>
        <div class="col-sm-7">
        	<div  class="form-group">
            	<label>Manufacturer: </label>
            	<select class="form-control selectByTypes" data-id="Manufacturer_UUID" style="width: 200px;">
                  <option value="all">All</option>
                  <?php foreach($getAllManufacturer as $manufacturer){?>
                  <option value="<?php echo $manufacturer['UUID'];?>"><?php echo $manufacturer['Manufacturer_Name'];?></option>
                  <?php }?>
                </select>
            </div>
        </div>
        <div class="col-sm-5">
            <form method="post" id="searchTools">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control"  /><button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
      </div>
      <div class="col-sm-2">
        <div class="form-group addCodeSeries"> <a href="<?php echo adm_base_url();?>/add_tools" class="btn btn-danger"  title="Add New Tool Type">Add New Tool</a> </div>
      </div>
    </div>
    <div clas=="row">
      <div class="col-sm-22"><a href="<?php echo adm_base_url();?>/export_all_tools_info" target="_blank" class="btn btn-primary">Export to CSV</a></div>
      <div class="col-sm-2">
        <div class="form-group addCodeSeries"><a href="<?php echo adm_base_url();?>/firebase_update_tools" class="btn btn-success">Update Tools</a>
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
          <div class="table-responsive tool_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>  
                  <th>Image</th>
                  <?php if($sort_col == 'Tool_Type_Name' ){ ?>               
                  <th class="tools_sorting">Tool Type 
                  <a href="javascript:void(0)"  class="glyphicon glyphicon-triangle-<?php echo $angle;?> tools_sorting_by_type" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <?php }else{ ?>
                  	<th>Tool Type <a href="javascript:void(0)"  class="glyphicon glyphicon-triangle-bottom tools_sorting_by_type" data_id="DESC"></a></th>
                  <?php } ?>
                  <?php if($sort_col == 'Manufacturer_Name' ){ ?> 
                  	<th class="tools_sorting">Manufacturer  
                 	 <a href="javascript:void(0)"  class="glyphicon glyphicon-triangle-<?php echo $angle;?> tools_sorting_by_manufacturer" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                    <?php }else{ ?>
                  <th>Manufacturer  
                 	 <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom tools_sorting_by_manufacturer" data_id="DESC"></a>
                  </th>
                  <?php } ?>
                   <?php if($sort_col == 'Tool_Name' ){ ?> 
                  	  <th class="tools_sorting">Name 
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom tools_sorting" data_id="DESC"></a>
                      </th>
                  <?php }else{ ?>
                  	  <th>Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom tools_sorting" data_id="DESC"></a></th>
                  <?php } ?>
                  <th>Note</th>
                  <th>Useful For</th>  
                  <th>Difficulty</th>               
                  <th>Products</th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <?php if(isset($this->session->userdata['tools_sorting_session']) && ($sort_col == 'Tool_Type_Name' ) || ($sort_col == 'Manufacturer_Name' )){?>
				  <tbody>
					<?php                   
					foreach($results as $t_value){
						$type_uuid = $t_value['UUID'];
						if($sort_col == 'Tool_Type_Name' ){
							$get_tools_by_types = get_tools_by_types($type_uuid);
						}else if($sort_col == 'Manufacturer_Name' ){
							$get_tools_by_types = get_tools_by_manufacturer($type_uuid);
						}								
						if( $get_tools_by_types == true){
							foreach($get_tools_by_types as $value){?>
							<tr>
							  <td><?php
							  $images = $value['Tool_Image_Url'];
							  if($images ==""){					  
							  }else{					  
								echo '<span class="td_data"><img class="customImage" src ="'.$images.' "></span>';
							  }					  
							  ?>                     
							  <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Tool_Image_Url'];?>" data-id="<?php echo $value['id'];?>" data-col="Tool_Image_Url"></span><div class="get_column_data"></div> 
							  </td>
							  <td class="sorting-column">
							   <?php   
								$Tool_Type_Name = "";
								$Tool_Type_UUID = explode(',',$value['Tool_Type_UUID']);
								for($tl = 0; $tl < count($Tool_Type_UUID); $tl++){
									$get_tool_type = get_tool_type($Tool_Type_UUID[$tl]);
									$Tool_Type_Name .= $get_tool_type[0]['Tool_Type_Name'].'<br>';
								}
								?>
							   <?php echo $Tool_Type_Name;?>							   
							  </td>
							  <td class="sorting-column">
								<?php $manufacturer_UUID =  $value['Manufacturer_UUID'];
								$get_manufacturer = get_manufacturer($manufacturer_UUID);
								 ?>
								<span class="td_data"><?php echo $get_manufacturer[0]['Manufacturer_Name']; ?></span>
							   <span class="glyphicon glyphicon-pencil edit_tools_dropbox" aria-hidden="true" data-val="<?php echo $value['Manufacturer_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Manufacturer_UUID" data-key="Manufacturer_UUID" data-type="Manufacturer_UUID"></span><div class="get_column_data" ></div>
							  </td>                     
							  <td class="sorting-column"><span class="td_data notes-holder"><?php echo $value['Tool_Name'];?></span>
							  <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Tool_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Tool_Name"></span><div class="get_column_data"></div>
							  </td>
							  <td><span class="td_data"><?php echo $value['Tool_Note'];?></span>
							  <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Tool_Note'];?>" data-id="<?php echo $value['id'];?>" data-col="Tool_Note"></span><div class="get_column_data"></div>
							  </td>
                <td>
                        <span class="td_data"><?php echo $value['Useful_For'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Useful_For'];?>" data-id="<?php echo $value['id'];?>" data-col="Useful_For"></span><div class="get_column_data"></div>
                      </td>
                <td>
                  <span class="td_data"><?php echo $value['Difficulty'];?></span>
                  <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Difficulty'];?>" data-id="<?php echo $value['id'];?>" data-col="Difficulty"></span><div class="get_column_data"></div>
                </td>
							  <td><span class="td_data"><?php echo $value['Products'];?></span>
							  <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products"></span><div class="get_column_data"></div>
							  </td>                      
							 
							  <td>
							  <a href="<?php echo adm_base_url();?>/edit_tools/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a> 
							  <a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_tools/')" type="button"class="btn btn-danger" >Delete</a>
							  </td>
							</tr>             
					<?php }
						}	
					}?>
				  </tbody>
			  <?php }else{ ?>              
              <tbody>
                <?php                   
         		foreach($results as $value){?>
                    <tr>
                      <td><?php
					  $images = $value['Tool_Image_Url'];
					  if($images ==""){					  
					  }else{					  
						echo '<span class="td_data"><img class="customImage" src ="'.$images.' "></span>';
					  }					  
					  ?>                     
                      <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Tool_Image_Url'];?>" data-id="<?php echo $value['id'];?>" data-col="Tool_Image_Url"></span><div class="get_column_data"></div> 
                      </td>
                      
					  <td class="sorting-column">
					   <?php   
                        $Tool_Type_Name = "";
                        $Tool_Type_UUID = explode(',',$value['Tool_Type_UUID']);
                        for($tl = 0; $tl < count($Tool_Type_UUID); $tl++){
                            $get_tool_type = get_tool_type($Tool_Type_UUID[$tl]);
                            $Tool_Type_Name .= $get_tool_type[0]['Tool_Type_Name'].'<br>';
                        }
                        ?>
                       <?php echo $Tool_Type_Name;?>	
                      </td>
                      <td class="sorting-column">
                      	<?php $manufacturer_UUID =  $value['Manufacturer_UUID'];
					  	$get_manufacturer = get_manufacturer($manufacturer_UUID);
						 ?>
                        <span class="td_data"><?php echo $get_manufacturer[0]['Manufacturer_Name']; ?></span>
                       <span class="glyphicon glyphicon-pencil edit_tools_dropbox" aria-hidden="true" data-val="<?php echo $value['Manufacturer_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Manufacturer_UUID" data-key="Manufacturer_UUID" data-type="Manufacturer_UUID"></span><div class="get_column_data" ></div>
                      </td>                     
                      <td class="sorting-column"><span class="td_data notes-holder"><?php echo $value['Tool_Name'];?></span>
                      <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Tool_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Tool_Name"></span><div class="get_column_data"></div>
                      </td>
                      <td><span class="td_data"><?php echo $value['Tool_Note'];?></span>
                      <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Tool_Note'];?>" data-id="<?php echo $value['id'];?>" data-col="Tool_Note"></span><div class="get_column_data"></div>
                      </td>
                      <td>
                        <span class="td_data"><?php echo $value['Useful_For'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Useful_For'];?>" data-id="<?php echo $value['id'];?>" data-col="Useful_For"></span><div class="get_column_data"></div>
                      </td>
                      <td>
                        <span class="td_data"><?php echo $value['Difficulty'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Difficulty'];?>" data-id="<?php echo $value['id'];?>" data-col="Difficulty"></span><div class="get_column_data"></div>
                      </td>
                      <td><span class="td_data"><?php echo $value['Products'];?></span>
                      <span class="glyphicon glyphicon-pencil edit_tools_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products"></span><div class="get_column_data"></div>
                      </td>                      
                     
                      <td>
                      <a href="<?php echo adm_base_url();?>/edit_tools/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a> 
                      <a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_tools/')" type="button"class="btn btn-danger" >Delete</a>
                      </td>
                    </tr>             
                <?php }?>
              </tbody>
              <?php } ?>
            </table>
            <nav class="site-pg">
                <ul class="pagination">        
                <!-- Show pagination links -->
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>	
            	</ul>
     	  </nav>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- right container start here --> 
