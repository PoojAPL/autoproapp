<div id="right-container">
  
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box vehicles_checkbox">
              
         <div class="site-form">
          <div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
            <table class="table table-bordered table-data mar0 tab-con">
            <thead>
                <tr> 
                  <th class="Types" rowspan="2">Type</th>
                  <th class="HImage" rowspan="2">Image</th>	 
                  <th rowspan="2">Make</th> 
                  <th rowspan="2">Model</th> 
                  <th rowspan="2">Year</th>
                  <th class="code_keyInfo " colspan="5">Code &amp; Key Info </th> 	
                  <th colspan="8" class="AdvDiagn ">MVP </th> 
                  <th class="AutoProPAD" colspan="7">AutoProPAD </th>  
                  <th class="Hotwire" colspan="3">Hotwire</th>
                  <th class="TKOSDD" colspan="5">TKO / SDD</th>
                  <th class="Dmax" colspan="2">DMax</th>
                  <th colspan="2" class="ProLok ">Pro-Lok </th> 
                  <th class="Parts" colspan="3">Parts</th>
                  <th class="" colspan="2">OBD Port Location</th>
                </tr>
                <tr>
                <th class="code_keyInfo ">Code Series</th>
                 <th class="code_keyInfo ">Tumblers</th> 
                  <th class="code_keyInfo ">Retainer</th> 
                  <th class="code_keyInfo ">Mechanical Key</th> 
                  <th class="code_keyInfo ">Chip Key</th>
                  
                  <th class="AdvDiagn ">System</th> 
                  <th class="AdvDiagn ">Dongle</th> 
                  <th class="AdvDiagn ">Smart Card</th> 
                  <th class="AdvDiagn ">Software</th> 
                  <th class="AdvDiagn ">PIN Required</th> 
                  <th class="AdvDiagn ">PIN Read</th> 
                  <th class="AdvDiagn ">10-Min Bypass</th> 
                  <th class="AdvDiagn ">Notes</th>                 
                  
                  <th class="AutoProPAD ">System</th>
                  <th class="AutoProPAD ">Add-A-Key</th>
                  <th class="AutoProPAD ">All-Keys-Lost</th>
                  <th class="AutoProPAD ">PIN Read</th>
                  <th class="AutoProPAD ">Programs Remotes</th>
                  <th class="AutoProPAD ">Resync Available</th>
                  <th class="AutoProPAD ">Notes</th>
                  
                  <th class="Hotwire ">Key Prog</th>
                  <th class="Hotwire ">Remote Prog</th>
                  <th class="Hotwire ">Misc Prog</th>                  
                  
                  <th class="TKOSDD ">System</th>
                  <th class="TKOSDD ">SDD Adapter</th>
                  <th class="TKOSDD ">SDD Cable</th>
                  <th class="TKOSDD ">TKO Cable</th>
                  <th class="TKOSDD ">Notes</th>

                  <th class="Dmax ">System</th>
                  <th class="Dmax ">Method</th>

                  <th class="ProLok ">Tool</th>
                  <th class="ProLok ">Linkage</th>

                  <th class="Parts ">Ignition </th>
                  <th class="Parts ">Door/Glove</th>
                  <th class="Parts ">Accessories </th>

                  <th class="">Text</th> 
                  <th class="">Image</th>                           
                </tr>
            </thead>
                <tbody>	
                    <?php foreach($results as $value){
                        $years = explode(',',$value['Years']);
                        // if($years[0] == $years[count($years)-1]){
                        //     $years = array($years[0]);
                        // }
                        ?>		  
                        <tr <?php echo $bgcolor;?>>
                        <td class="Types <?php echo $hideTypes_hide;?>">
          							<?php
          							$vehicle_Type_UUID_info = vehicle_Type_UUID_info($value['Vehicle_Type_UUID']);
          							echo $vehicle_Type_UUID_info[0]['type'];
          							?>							
                        </td> 
                    	<td class="HImage <?php echo $hideimage_hide;?>" style="padding:0">
                          <div class="vh_value_holder">
                            <?php if($value['image_url'] !=""){?>
                                <img src="<?php echo base_url().'assets/vechileImages/150/'.$value['image_url'];?>" width="150"  />
                            <?php }elseif($value['Vehicle_Image'] !=""){?>
                            <img src="<?php echo $value['Vehicle_Image'];?>" width="150"  />							 
                              <?php }?>
                          </div>
                        </td>                   	
                        <td> <?php 	echo $value['Make_Name'];?></td>
                        <td>
                        	<div class="vh_value_holder"> 
                            <span class="td_data"><?php echo $value['Model_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['Model_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Model_UUID" data-key="Model_UUID" data-type="Model_UUID"></span><div class="get_column_data"></div>     
                            </div>                     
                        </td>
                        <td> 
                        <div class="vh_value_holder">                                       
                        <?php
                            $years = explode(',',$value['Years']); 
                            if($years[0] == $years[count($years)-1]){?>
                                 <span class="td_data"><?php echo $years[0];?></span>
                            <?php }else{?>
                                 <span class="td_data"><?php echo $years[0];?>-<?php echo $years[count($years)-1];?></span>
                            <?php } ?>
                        <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Years'];?>" data-id="<?php echo $value['id'];?>" data-col="Years"></span><div class="get_column_data"></div>
                        </div>
                        </td>                        
                        <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>"> 
                        	<div class="vh_value_holder" >
                        	<?php 
            							$got_series_data = explode(',',$value['Code_Series_UUID']);
            							if( count($got_series_data) > 1){
                            echo '<div style="max-height: 200px;overflow-y: scroll;" class="td_data">';
            								for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
            									$got_series_val = explode('|',$got_series_data[$cs]);
            									$code_series_id = $got_series_val[0];
            									$code_series_note = $got_series_val[1];
            									$get_Code_Series_name = get_Code_Series_name($code_series_id);?>
            									<span><?php echo $get_Code_Series_name[0]['Code_Series_Name'];?> 
            									<?php if((isset($code_series_note)) && ($code_series_note !="" )){?>(<?php echo $code_series_note;?>)<?php } ?></span><br />
                              

            								<?php } ?>
                            </div>
                            <span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['Code_Series_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Code_Series_UUID" data-key="Code_Series_UUID" data-type="Code_Series_UUID"></span><div class="get_column_data" ></div>
                            <div>
            							<?php }else{
            								$got_series_val = explode('|',$got_series_data[0]);
            								$code_series_id = $got_series_val[0];
            								$code_series_note = $got_series_val[1];
            								$get_Code_Series_name = get_Code_Series_name($code_series_id);?>
                            	<span class="td_data"><?php echo $get_Code_Series_name[0]['Code_Series_Name'];?><?php if((isset($code_series_note)) && ($code_series_note !="" )){?>(<?php echo $code_series_note;?>)<?php } ?> </span>						
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['Code_Series_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Code_Series_UUID" data-key="Code_Series_UUID" data-type="Code_Series_UUID"></span><div class="get_column_data" ></div>
                            <?php } ?>
                            </div>
                        </td>
                        <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>">
                        <div class="vh_value_holder notes-holder">
                            <span class="td_data"><?php echo $value['Tumblers'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Tumblers'];?>" data-id="<?php echo $value['id'];?>" data-col="Tumblers" data-key="Tumblers" data-type="Tumblers"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                        <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>">
                        <div class="vh_value_holder">
                        	<?php $get_Retainer_name = get_Retainer_name($value['Retainer_UUID']);?>
                            <span class="td_data"><?php echo $get_Retainer_name[0]['Retainer_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['Retainer_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Retainer_UUID" data-key="Retainer_UUID" data-type="Retainer_UUID"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                       <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>">
                       <div class="vh_value_holder">
                        	<?php
            								$mach_keys_uuids = "";								
            								$mach_keys_array = explode(',',$value['Mechanical_Key_UUID']);
            								for($i = 0; $i < count($mach_keys_array); $i++ ){
            									$get_key_name = get_key_name($mach_keys_array[$i]);
            									$mach_keys_uuids .=  $get_key_name[0]['Key_Name'].'<br>';
            								}
            							?>
                            <span class="td_data"><?php echo $mach_keys_uuids;?></span>                            
                        	<span class="glyphicon glyphicon-pencil edit_vh_programmers_box" aria-hidden="true" data-val="<?php echo $value['Mechanical_Key_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Mechanical_Key_UUID" data-key="Mechanical Key" data-type="Keys"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                        <td class="code_keyInfo <?php echo $code_keyInfo_hide;?>">
                        <div class="vh_value_holder">
                       		 <?php
              								$chip_keys_uuids = "";								
              								$chip_keys_array = explode(',',$value['Chip_Key_UUID']);
              								for($i = 0; $i < count($chip_keys_array); $i++ ){
              									$get_key_name = get_key_name($chip_keys_array[$i]);
              									$chip_keys_uuids .=  $get_key_name[0]['Key_Name'].'<br>';
              								}
              							?>
                            <span class="td_data"><?php echo $chip_keys_uuids;?></span>                            
                        	<span class="glyphicon glyphicon-pencil edit_vh_multiple_box" aria-hidden="true" data-val="<?php echo $value['Chip_Key_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Chip_Key_UUID" data-key="Transponder Key" data-type="Keys"></span><div class="get_column_data" ></div>
                           </div> 
                        </td>
                                             
                        <td class="AdvDiagn <?php echo $advanced_hide;?>">
                        <div class="vh_value_holder">
                        <span class="td_data"><?php echo $value['MVP_System'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_System'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_System"></span><div class="get_column_data"></div>
                        </div>
                        </td>
                        <td class="AdvDiagn <?php echo $advanced_hide;?>">
                        <div class="vh_value_holder">
                        	<?php $get_tool_name = get_tool_name($value['MVP_Dongle_UUID']);?>
                            <span class="td_data"><?php echo $get_tool_name[0]['Tool_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['MVP_Dongle_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_Dongle_UUID" data-key="Dongle" data-type="Tools"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                        <td class="AdvDiagn <?php echo $advanced_hide;?>">
                        <div class="vh_value_holder">
                        <?php
            						 $SmartCard = ""; 
            						 if( $value['MVP_SmartCard'] == 1){
            							$SmartCard = 'Yes';
            						 }else if( $value['MVP_SmartCard'] === NULL){
            							$SmartCard = '';
            						 }else if( $value['MVP_SmartCard'] == ""){
            							$SmartCard = '';
            						 }else if( $value['MVP_SmartCard'] == 0){
            							$SmartCard = 'No';
            						 }
            						 ?>
                        <span class="td_data"><?php echo $SmartCard;?></span>
                        <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_SmartCard'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_SmartCard"></span><div class="get_column_data"></div>
                        </div>
                        </td>
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder">
                        	<?php $get_tool_name = get_tool_name($value['MVP_Software']);?>
                            <span class="td_data"><?php echo $get_tool_name[0]['Tool_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['MVP_Software'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_Software" data-key="TCode SW" data-type="Tools"></span><div class="get_column_data" ></div>
                            </div>
                        </td>
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder">
                         <?php 
              						 if( $value['MVP_PIN_Required'] == 1){
              							$PIN_Required = 'Yes';
              						 }else if( $value['MVP_PIN_Required'] === ""){
              							$PIN_Required = '';
              						 }else if( $value['MVP_PIN_Required'] == 0){
              							$PIN_Required = 'No';
              						 }
              						 ?>
                        <span class="td_data"><?php echo $PIN_Required;?></span>
                        <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_PIN_Required'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_PIN_Required"></span><div class="get_column_data"></div>
                        </div>
                         </td>
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder">
                            <span class="td_data"><?php echo $value['MVP_PIN_Read'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_PIN_Read'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_PIN_Read"></span><div class="get_column_data"></div>
                            </div>
                         </td>                       
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder">
                         <?php $get_10_mint_bypass = get_10_mint_bypass($value['id']); ?>
                            <span class="td_data"><?php echo $get_10_mint_bypass[0]['MVP_10-Minute_Bypass'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $get_10_mint_bypass[0]['MVP_10-Minute_Bypass'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_10-Minute_Bypass"></span><div class="get_column_data"></div>
                            </div>
                         </td>
                         <td class="AdvDiagn <?php echo $advanced_hide;?>">
                         <div class="vh_value_holder notes-holder">
						 <?php
							$MVP_Notes = strlen($value['MVP_Notes']);
								  if( $MVP_Notes > 100){
										echo substr($value['MVP_Notes'], 0, 100).'... <a href="#" data-toggle="modal" data-target="#MVP_Notes'.$value['id'].'">Read More</a>';  ?>
										<div class="modal" id="MVP_Notes<?php echo $value['id'];?>">
											  <div class="modal-dialog">
												<div class="modal-content">									 
												  <div class="modal-header">
													<h4 class="modal-title">MVP (Notes)</h4>
													<button type="button" class="close" data-dismiss="modal">×</button>
												  </div>									 
													<div class="modal-body">
													<span class="td_data"><?php echo $value['MVP_Notes'];?></span>
													<span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_Notes"></span><div class="get_column_data"></div>
													</div>									
												  <div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												  </div>
												</div>
											  </div>
											</div>
								  <?php }else{?>
											<span class="td_data"><?php echo $value['MVP_Notes'];?></span>
											<span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['MVP_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="MVP_Notes"></span><div class="get_column_data"></div>
                         
								  <?php } ?>
                          </div>
                         </td>                        
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder notes-holder">
                          <span class="td_data"><?php echo $value['APP_System'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_System'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_System"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['APP_Add_Keys'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_Add_Keys'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_Add_Keys"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                           <span class="td_data"><?php echo $value['APP_All_Keys_Lost'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_All_Keys_Lost'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_All_Keys_Lost"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                           <span class="td_data"><?php echo $value['PIN_Read'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['PIN_Read'];?>" data-id="<?php echo $value['id'];?>" data-col="PIN_Read"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['APP_Programs_Remote'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_Programs_Remote'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_Programs_Remote"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['APP_Resync_Available'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_Resync_Available'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_Resync_Available"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
						   <?php 						   
							   $APP_Notes = strlen($value['APP_Notes']);
								  if( $APP_Notes > 50){
										echo substr($value['APP_Notes'], 0, 50).'... <a href="#" data-toggle="modal" data-target="#APP_Notes'.$value['id'].'">Read More</a>';  ?>
										<div class="modal" id="APP_Notes<?php echo $value['id'];?>">
											  <div class="modal-dialog">
												<div class="modal-content">									 
												  <div class="modal-header">
													<h4 class="modal-title">AutoProPAD (Notes)</h4>
													<button type="button" class="close" data-dismiss="modal">×</button>
												  </div>									 
													<div class="modal-body">
													<span class="td_data notes-holder"><?php echo $value['APP_Notes'];?></span>
													  <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_Notes"></span><div class="get_column_data"></div>
													 </div>									
												  <div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												  </div>
												</div>
											  </div>
											</div>
								  <?php }else{?>
											<span class="td_data notes-holder"><?php echo $value['APP_Notes'];?></span>
											<span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_Notes"></span><div class="get_column_data"></div>
                         
								  <?php } ?>
                           </div>
                          </td>                          
                          <td class="Hotwire <?php echo $hotwire_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['HW_Key_Prog'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['HW_Key_Prog'];?>" data-id="<?php echo $value['id'];?>" data-col="HW_Key_Prog"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                  		  <td class="Hotwire <?php echo $hotwire_hide;?>">
                          <div class="vh_value_holder">
                          	<span class="td_data"><?php echo $value['HW_Remote_Prog'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['HW_Remote_Prog'];?>" data-id="<?php echo $value['id'];?>" data-col="HW_Remote_Prog"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                  		  <td class="Hotwire <?php echo $hotwire_hide;?>">
                          <div class="vh_value_holder">
                          <span class="td_data"><?php echo $value['HW_Misc_Prog'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['HW_Misc_Prog'];?>" data-id="<?php echo $value['id'];?>" data-col="HW_Misc_Prog"></span><div class="get_column_data"></div>
                          </div>
                          </td>                          
                         <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                         <div class="vh_value_holder">
                         <span class="td_data"><?php echo $value['TKOSDD_System'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_System'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_System"></span><div class="get_column_data"></div>
                          </div>
                         </td>
                  		 <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                         <div class="vh_value_holder">
                         <span class="td_data"><?php echo $value['TKOSDD_SDD_Adapter'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_SDD_Adapter'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_SDD_Adapter"></span><div class="get_column_data"></div>
                          </div>
                         </td>
                 		 <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                         <div class="vh_value_holder">
                        <span class="td_data"> <?php echo $value['TKOSDD_SDD_Cable'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_SDD_Cable'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_SDD_Cable"></span><div class="get_column_data"></div>
                          </div>
                         </td>
                  		 <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                         <div class="vh_value_holder">
                         <span class="td_data"><?php echo $value['TKOSDD_TKO_Cable'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_TKO_Cable'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_TKO_Cable"></span><div class="get_column_data"></div>
                          </div>
                         </td>
                  		 <td class="TKOSDD <?php echo $tko_sdd_hide;?>">
                         <div class="vh_value_holder">
						 <?php 
							$TKOSDD_Notes = strlen($value['TKOSDD_Notes']);
							  if( $TKOSDD_Notes > 100){
								echo substr($value['TKOSDD_Notes'], 0, 100).'... <a href="#" data-toggle="modal" data-target="#TKOSDD_Notes'.$value['id'].'">Read More</a>';  ?>
								<div class="modal" id="TKOSDD_Notes<?php echo $value['id'];?>">
									  <div class="modal-dialog">
										<div class="modal-content">									 
										  <div class="modal-header">
											<h4 class="modal-title">TKO / SDD (Notes)</h4>
											<button type="button" class="close" data-dismiss="modal">×</button>
										  </div>									 
											<div class="modal-body">
											 <span class="td_data"><?php echo $value['TKOSDD_Notes'];?></span>
											  <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_Notes"></span><div class="get_column_data"></div>
											 </div>									
										  <div class="modal-footer">
											<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
										  </div>
										</div>
									  </div>
									</div>
							  <?php }else{?>
								  <span class="td_data"><?php echo $value['TKOSDD_Notes'];?></span>
											  <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['TKOSDD_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="TKOSDD_Notes"></span><div class="get_column_data"></div>
											
							<?php  } ?>
							</div>
                         </td>                          
                         <td class="Dmax <?php echo $dmaxcheckbox_hide;?>">
                           <div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['DMax_System'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['DMax_System'];?>" data-id="<?php echo $value['id'];?>" data-col="DMax_System"></span><div class="get_column_data"></div>
                          </div>
                         </td>
                        <td class="Dmax <?php echo $dmaxcheckbox_hide;?>">
                         	<div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['DMax_Method'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['DMax_Method'];?>" data-id="<?php echo $value['id'];?>" data-col="DMax_Method"></span><div class="get_column_data"></div>
                          </div>
                        </td>
                        <td class="ProLok <?php echo $prolok_hide;?>">
                        <div class="vh_value_holder">
                        	<?php $get_tool_name = get_tool_name($value['ProLok_Tool_UUID']);?>
                            <span class="td_data"><?php echo $get_tool_name[0]['Tool_Name'];?></span>
                        	<span class="glyphicon glyphicon-pencil edit_vh_dropbox" aria-hidden="true" data-val="<?php echo $value['ProLok_Tool_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="ProLok_Tool_UUID" data-key="Pro-Lok" data-type="Tools"></span><div class="get_column_data" ></div>
                            </div>
                        </td>                         
                        <td class="ProLok <?php echo $prolok_hide;?>">
                        <div class="vh_value_holder">
                            <span class="td_data"><?php echo $value['ProLok_Linkage'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['ProLok_Linkage'];?>" data-id="<?php echo $value['id'];?>" data-col="ProLok_Linkage"></span><div class="get_column_data"></div>
                            </div>
                         </td>
                         <td class="Parts <?php echo $hideParts_hide;?>">
                         	<div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['Parts_Ignition'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Parts_Ignition'];?>" data-id="<?php echo $value['id'];?>" data-col="Parts_Ignition"></span><div class="get_column_data"></div>
                              </div>
                         </td>
                        <td class="Parts <?php echo $hideParts_hide;?>">
                        	<div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['Parts_Door'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Parts_Door'];?>" data-id="<?php echo $value['id'];?>" data-col="Parts_Door"></span><div class="get_column_data"></div>
                              </div>
                        </td>
                        <td class="Parts <?php echo $hideParts_hide;?>">
                        	<div class="vh_value_holder">
                              <span class="td_data"><?php echo $value['Parts_Accessories'];?></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['Parts_Accessories'];?>" data-id="<?php echo $value['id'];?>" data-col="Parts_Accessories"></span><div class="get_column_data"></div>
                              </div>
                        </td>
                        <td>
                          <div class="vh_value_holder notes-holder">
						   <?php 						   
							  $OBD_Location_Text =  strlen($value['OBD_Location_Text']);
								  if( $OBD_Location_Text > 100){
										echo substr($value['OBD_Location_Text'], 0, 100).'... <a href="#" data-toggle="modal" data-target="#OBDPORT'.$value['id'].'">Read More</a>';  ?>
										<div class="modal" id="OBDPORT<?php echo $value['id'];?>">
											  <div class="modal-dialog">
												<div class="modal-content">									 
												  <div class="modal-header">
													<h4 class="modal-title">OBD Port Location (Text)</h4>
													<button type="button" class="close" data-dismiss="modal">×</button>
												  </div>									 
													<div class="modal-body">
													 <span class="td_data"><?php echo $value['OBD_Location_Text'];?></span>
													  <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['OBD_Location_Text'];?>" data-id="<?php echo $value['id'];?>" data-col="OBD_Location_Text"></span><div class="get_column_data"></div>
													</div>									
												  <div class="modal-footer">
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												  </div>
												</div>
											  </div>
											</div>
								  <?php }else{?>
												<span class="td_data"><?php echo $value['OBD_Location_Text'];?></span>
												<span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['OBD_Location_Text'];?>" data-id="<?php echo $value['id'];?>" data-col="OBD_Location_Text"></span><div class="get_column_data"></div>
													
								  <?php } ?>
                              </div>
                        </td>
                        <td>
                          
                          <div class="vh_value_holder">
                              <span class="td_data"><a href="<?php echo $value['OBD_Location_Image'];?>" target="_blank">
                                <?php if($value['OBD_Location_Image'] !=""){?>
                                <img src="<?php echo $value['OBD_Location_Image'];?>" style="width:50px;">
                                <?php } ?>
                              </a></span>
                              <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['OBD_Location_Image'];?>" data-id="<?php echo $value['id'];?>" data-col="OBD_Location_Image"></span><div class="get_column_data"></div>
                          </div>
                          
                        </td>                      
                    </tr>
                    <?php }
                     ?>
				</tbody>
            </table>  
          </div>
        </div>          
      </section>
    </div>
  </div>
</div>