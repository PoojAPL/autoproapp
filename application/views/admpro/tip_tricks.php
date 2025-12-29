<div id="right-container">
  <div class="site-form form-inline">
    <div class="row"> 
    <div class="col-sm-6">
      <form method="post" id="searchTipsTricks" novalidate="novalidate">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control" style="width: 500px !important;" placeholder="Enter at least 3 characters for searching">
                     <button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
     </div>   	
      <div class="col-sm-18">
        <div class="form-group addCodeSeries"> 
          <a href="<?php echo adm_base_url();?>/update_vehicle_info" class="btn btn-success firebaseUpdate">Firebase Update</a>&nbsp;
          <a href="<?php echo adm_base_url();?>/vehicles/add_tip_tricks" class="btn btn-danger">Add New Tips & Tricks</a>
     </div>
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
          <div class="tool_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr> 
                  <th>Vehicle</th>  
                  <th>Title</th>                
                  <th>Content</th>  
                  <th>User</th>
                  <th>Category</th>
                  <th>YouTube Video IDs</th>
                  <th>Images</th>
                  <th>Score
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom tips_tricks_sorting" data_id="DESC" data-col="Score"></a>
                  </th>                                   
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
             	<tbody>
                	<?php foreach( $results  as $value){?>
                	<tr>
                    	<td>
                        <div class="notes-holder2">
                        <?php 
                         $Vehicle_UUID_data = explode('|',$value['Vehicle_UUID']);
                         sort($Vehicle_UUID_data);
                         foreach ($Vehicle_UUID_data as $value2) {
                          $value2_data = explode('__', $value2);
                          $get_vehicles_by_id = get_vehicles_by_id($value2_data[0]);
                          $vehicles = $get_vehicles_by_id[0];
                          $years = explode(',',$vehicles['Years']);
                          $get_models_name = get_models_name($vehicles['Model_UUID']);
                          $get_make_name = get_make_name($vehicles['Model_UUID']);
                          $Code_Series_Name = '';                 
                          $got_series_data = explode(',',$vehicles['Code_Series_UUID']);

                           if($Code_Series_Name !=""){
                            $option_name = $get_make_name[0]['Make_Name'].' '.$get_models_name[0]['Model_Name'].' ('.$years[0].'-'.$years[count($years)-1].') ('.$Code_Series_Name.')';
                           }else{
                            $option_name = $get_make_name[0]['Make_Name'].' '.$get_models_name[0]['Model_Name'].' ('.$years[0].'-'.$years[count($years)-1].')';
                          }
                          echo $option_name.'<br>';
                         };
                        ?>
                      </div>
                        </td>
                        <td><div class="coldata-holder"><?php echo $value['Title'];?></div></td>
                        <td> <div class="notes-holder2"><?php echo $value['Content'];?></div> </td>
                        <td> 
                        	<?php $user_id =  $value['User_UUID'];
                          $get_aks_users_info = get_aks_users_info2($user_id);
                          echo $get_aks_users_info[0]['customers_email_address'];
                          ?> 
                        </td>
                        <td><?php echo $value['Category'];?></td>
                        <td>
                          <div class="coldata-holder">
                            <a href="https://youtu.be/<?php echo $value['Videos'];?>" target="_blank">
                              <?php echo $value['Videos'];?>
                            </a>
                          </div>
                        </td>
                        <td>
                           <div class="coldata-holder"> <?php if($value['Images'] !=""){
                              $images_data = explode(',',$value['Images']);
                              for($im = 0; $im < count($images_data); $im++){?>
                                <a href="<?php echo $images_data[$im];?>" target="_blank">
                                 <img src="<?php echo $images_data[$im];?>" width="50">
                                </a> 
                             <?php }
                            } ?>
                          </div>
                        </td>
                        <td>
                          <input type="number" class="form-control tipTrick_score_order" value="<?php echo $value['Score'];?>" id="<?php echo $value['Id'];?>" style="width: 70px;">
                        </td>
                         <td>
                            <a href="<?php echo adm_base_url();?>/vehicles/copy_tip_tricks/<?php echo $value['Id'];?>" type="button" class="btn btn-info" >Copy</a> 
                             <a href="<?php echo adm_base_url();?>/vehicles/edit_tip_tricks/<?php echo $value['Id'];?>" type="button" class="btn btn-success" >Edit</a> 
                              <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['Id'];?>, '<?php echo adm_base_url();?>/vehicles/delete_tip_tricks/')" class="btn btn-danger" >Delete</a>
                           </td>
                    </tr>
                    <?php } ?>
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
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- right container start here --> 
