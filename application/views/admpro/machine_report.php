<div id="right-container">
  <div class="site-form form-inline">
    <div class="row"> 
      <div class="col-sm-6">
      <form method="post" id="searchMacineReports" novalidate="novalidate">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control" style="width: 200px;" placeholder="Enter at least 3 characters for searching">
                     <button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
     </div>
     <div class="col-sm-8">
        <div class="form-group">
           <label>Show Machine</label>
              <select style="width: 200px;" col-name="Machine" class="form-control select-field filterMacineReport">
                <option value="all">All</option>
                <?php $get_programmer_tools = get_success_rating_machine();
                  foreach($get_programmer_tools as $remote){
                    if($remote['Machine'] == 'AUTOPROPAD'){
                      $Machine = 'AutoProPAD';
                    }else if($remote['Machine'] == 'MVP_TCODE_SMART_PRO'){
                      $Machine = 'Smart Pro / MVP Pro / TCode Pro';
                    }else if($remote['Machine'] == 'HOTWIRE'){
                      $Machine = 'Hotwire';
                    }else if($remote['Machine'] == 'DMAX'){
                      $Machine = 'DMax';
                    }else{
                      $Machine = ucwords( str_replace('_', ' ',$remote['Machine']));
                    }
                    if($Machine !=""){?>
                    <option value="<?php echo $remote['Machine'];?>"><?php echo $Machine;?></option>
                <?php  }
                } ?>   
              </select>
        </div>
       </div>
      <div class="col-sm-8">
        <div class="form-group">
           <label>Result</label>
              <select style="width: 200px;" col-name="Result" class="form-control select-field filterMacineResultReport">
                <option value="all">All</option>
                <option value="Yes">Worked</option>
                <option value="No">Didn't Work</option>  
              </select>
        </div>
       </div> 
      <div class="col-sm-2">
        <div class="form-group" style="margin-left: -10px;margin-top: 5px;">
          <a href="<?php echo adm_base_url();?>/add_success_report" class="btn btn-success">Add New</a>           
        </div>
       </div>       
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
        <div class="machineData">
          <table class="table">
            <tr>
              <th></th>
              <?php $get_programmer_tools = get_success_rating_machine();
                foreach($get_programmer_tools as $remote){
                  if($remote['Machine'] == 'AUTOPROPAD'){
                      $Machine = 'AutoProPAD';
                    }else if($remote['Machine'] == 'MVP_TCODE_SMART_PRO'){
                      $Machine = 'Smart Pro';
                    }else if($remote['Machine'] == 'HOTWIRE'){
                      $Machine = 'Hotwire';
                    }else if($remote['Machine'] == 'DMAX'){
                      $Machine = 'DMax';
                    }else{
                      $Machine = ucwords( str_replace('_', ' ',$remote['Machine']));
                    }
                   if($remote['Machine'] !=""){?> 
                      <th style="color: #000;text-decoration: none;" class="m_data" data-val="<?php echo $remote['Machine'];?>"><?php echo $Machine;?></th>
                  <?php  } 
                }?>
            </tr> 
            <tr>
              <th>It Worked</th>
              <?php $get_programmer_tools = get_success_rating_machine();
              foreach($get_programmer_tools as $remote){
                if($remote['Machine'] !=""){?>
                <td class="m_data" data-val="<?php echo $remote['Machine'];?>" data-result='Yes' >
                  <?php echo $get_machine_data_count = get_machine_data_count($remote['Machine'],'Yes');?>
                </td>
              <?php  }
              } ?>
            </tr>
            <tr>
              <th>It Didn't Work</th>
              <?php $get_programmer_tools = get_success_rating_machine();
              foreach($get_programmer_tools as $remote){
                if($remote['Machine'] !=""){?>
                <td class="m_data" data-val="<?php echo $remote['Machine'];?>" data-result='No' >
                  <?php echo $get_machine_data_count = get_machine_data_count($remote['Machine'],'No');?>
                </td>
              <?php  } 
            }?>
            </tr>
          </table>
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
                  <th>Date/Time</th>
                  <th>User</th> 
                  <th>Machine</th>
                  <th>Vehicle</th>
                  <th>Worked?</th> 
                  <th>Notes</th>                                  
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
             	<tbody>
                	<?php foreach( $results  as $value){
                    if($value['Machine'] == 'AUTOPROPAD'){
                      $Machine = 'AutoProPAD';
                    }else if($value['Machine'] == 'MVP_TCODE_SMART_PRO'){
                      $Machine = 'Smart Pro / MVP Pro / TCode Pro';
                    }else if($value['Machine'] == 'HOTWIRE'){
                      $Machine = 'Hotwire';
                    }else if($value['Machine'] == 'DMAX'){
                      $Machine = 'DMax';
                    }else{
                      $Machine = strtolower( str_replace('_', ' ',$value['Machine']));
                    }

                    if($value['Result'] == 'Yes'){
                      $hide_row = 'hide';
                      $on_check = 'Yes';
                    }else{
                      $hide_row = '';
                      $on_check = 'No';
                    }?>
                	<tr>
                      <td style="width: 100px;white-space: inherit;">
                        <?php if($value['added_from'] == 'Admin'){
                          echo date('m/d/Y <br> H:i:s',$value['Date']);
                        }else{ ?>
                        <div id="<?php echo $value['id'];?>"></div>
                        <script type="text/javascript">
                            var timestamp = <?php echo $value['Date'];?>;
                            var myDate = new Date(timestamp);
                            var formatedTime= myDate.getMonth()+'/'+myDate.getDate()+'/'+myDate.getFullYear()+'<br>'+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds();
                            document.getElementById(<?php echo $value['id'];?>).innerHTML = formatedTime;
                          </script> 
                        <?php } ?>  
                      </td>
                      <td style="width: 100px;white-space: inherit;">                         
                        <?php
                         $user_id =  $value['userid']; 
                         $get_aks_users_info = get_aks_users_info2($user_id);
                         echo $get_aks_users_info[0]['customers_firstname'].' '.$get_aks_users_info[0]['customers_lastname'].' ('.$user_id.')';?> <br>
                        <?php                         
                          echo $get_aks_users_info[0]['Email'];
                          if( $get_aks_users_info[0]['PhoneNumber'] != ""){
                            echo '<br>Phone: '.$get_aks_users_info[0]['PhoneNumber'];
                          }?>
                          
                      </td>
                      <td style="width: 100px;white-space: inherit;"> <?php echo $Machine;?> </td>
                    	<td style="width: 100px;white-space: inherit;"> 
                          <?php 
                          if( $value['Vehicle'] != ""){
                          $vehicles_UUIDs = explode(',', $value['Vehicle']);
                            for($v = 0; $v < count($vehicles_UUIDs); $v++){
                              $get_vehicles = get_vehicles_by_id($vehicles_UUIDs[$v]);
                              $years = explode(',',$get_vehicles[0]['Years']);
                              $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
                              $get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
                              echo '<b>'.$get_make_name[0]['Make_Name'].' ' .$get_models_name[0]['Model_Name'].'  '.$years[0].'-'.$years[count($years)-1].'</b><br>';
                            }
                          }
                        ?>
                      </td>
                      <td style="width: 100px;white-space: inherit;text-align: center;">
                        <?php echo $on_check;?>
                      </td>
                      <td style="width: 100px;white-space: inherit;"><div class="notes-holder">
                        <span class="td_data"> <?php echo $value['Comment'];?></span></div>
                        <span class="glyphicon glyphicon-pencil edit_all_inputs" aria-hidden="true" data-val="<?php echo $value['Comment'];?>" data-id="<?php echo $value['id'];?>" data-col="Comment" data-table="t_Success_Reporting"></span><div class="get_column_data"></div>
                      </td>                      
                      <td> 
                        <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_machine_report/')" class="btn btn-danger" >Delete</a>
                      </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table> 
				<?php 
			if(isset($links)){?>
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
<script type="text/javascript">
  setTimeout(function(){
  // window.location.reload(1);
}, 60000);
</script>