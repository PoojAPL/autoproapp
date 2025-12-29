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
                        <div id="<?php echo $value['id'];?>"></div>
                      </td>
                      <td style="width: 100px;white-space: inherit;">                         
                        <?php
                         $user_id =  $value['userid']; 
                         $get_aks_users_info = get_aks_users_info2($user_id);
                         echo $get_aks_users_info[0]['customers_firstname'].' '.$get_aks_users_info[0]['customers_lastname'].' ('.$user_id.')';?> <br>
                        <?php                         
                          echo $get_aks_users_info[0]['customers_email_address'];
                          if( $get_aks_users_info[0]['customers_telephone'] != ""){
                            echo '<br>Phone: '.$get_aks_users_info[0]['customers_telephone'];
                          }?>
                          <script type="text/javascript">
                            var timestamp = <?php echo $value['Date'];?>;
                            var myDate = new Date(timestamp);
                            var formatedTime= myDate.getMonth()+'/'+myDate.getDate()+'/'+myDate.getFullYear()+'<br>'+myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds();
                            document.getElementById(<?php echo $value['id'];?>).innerHTML = formatedTime;
                          </script> 
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