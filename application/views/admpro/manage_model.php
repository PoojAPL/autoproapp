<?php
if( isset($this->session->userdata['pagination_per_page'])){
	$per_page1 = $this->session->userdata['pagination_per_page'];
	$per_page1['per_page'];
}
?>
<div id="right-container">
  <div class="site-form form-inline" method ="post" action="" id="form_model">
    <div class="row">      
      <div class="col-sm-6">
        <div class="form-group">
          <label>Results Per Page</label>
   			 <select class="form-control select-field" id="result" name="searching">              
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
      <div class="col-sm-6">
      	<div class="form-group">
        	 <label>Show Make</label>
             <select class="form-control select-field filterByMakes">
             	<option value="all">All</option>
                <?php foreach($getAllMakeNames as $makes){ ?>
					<option value="<?php echo $makes['UUID'];?>"><?php echo $makes['Make_Name'];?></option>
				<?php }	?>
             </select>
      	</div>
      </div>
      <div class="col-sm-6">
            <form method="post" id="searchModels">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control"  /><button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
      </div>
      <div class="col-sm-6">
        <div class="form-group addmodel">          
          <a href="<?php echo adm_base_url();?>/vehicles/add_model" class="btn btn-danger"  title="Add New Model" >Add New Model</a>        
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
		  <?php if($this->session->flashdata('message_display')){?>
                <?php echo $this->session->flashdata('message_display');?>
         <?php } ?>          
          <div class="table-responsive make_names table-data chips_data">
            <table class="table table-striped  mar0">
              <thead>
                <tr>
                  
                  <th>Make </th> 
                  <th>Model Name<a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom " data_id="DESC" id="makesname_sorting" data-angle ="bottom"></a></th>
                  <th> Type</th>
                                   
                  <th style="width: 137px;">Action</th>
                </tr>
              </thead>
              <tbody>
            
               <?php 
			   //echo $page;
			   //print_r($results);
			   $i =1;
			  foreach($results as $users){
			  		$make_id = $users['Make_UUID'];
					$make_name_info = admin_makeNameInfo($make_id );
			  ?>
                <tr>
                <td>                     
                    <span class="td_data"><?php echo  $make_name_info[0]['Make_Name'];?> </span>
                    <span class="glyphicon glyphicon-pencil edit_table_dropbox" aria-hidden="true" data-val="<?php echo $users['Make_UUID'];?>" data-id="<?php echo $users['id'];?>" data-col="Make_UUID" data-table="t_Models" data-img="" data-type="makeInfo"></span><div class="get_column_data"></div>
                </td>
                <td class="sorting-column">
                	<span class="td_data"><?php echo $users['Model_Name'];?></span>
            		<span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $users['Model_Name'];?>" data-id="<?php echo $users['id'];?>" data-col="Model_Name" data-table="t_Models" data-img=""></span><div class="get_column_data"></div>
                </td> 
                <td><?php 
				$vehicle_Type_UUID_info = vehicle_Type_UUID_info($users['Vehicle_Type_UUID']);
				echo $vehicle_Type_UUID_info[0]['type'];?></td>              
                <td><a  href="<?php echo adm_base_url();?>/vehicles/edit_model/<?php echo $users['id'];?>" type="button" class="btn btn-success">Edit</a> 
                <a  href="javascript:void(0)" onclick="DeleteModelFunction(<?php echo $users['id'];?>, '<?php echo adm_base_url();?>/vehicles/deleteModel/')" type="button"class="btn btn-danger">Delete</a>
               </td>
              </tr>
			<?php }  ?>  
               </tbody>
            </table>
            <nav class="site-pg">
                <ul class="pagination">               
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>	
               </ul>
     	  </nav>
          </div>	
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->
