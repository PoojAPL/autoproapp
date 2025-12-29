<!-- right container start here -->
               
<div id="right-container">
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <form method="post">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label>Show Make</label>
                        <select name="make" class="form-control select-field filterVehicleByMake">
                            <option value="All">All Make</option>
                            <?php foreach($getAllMakeNames as $makes){
                            if($makes['UUID'] == $post_make_id){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }?>
                                <option value="<?php echo $makes['UUID'];?>" <?php echo $selected;?>><?php echo $makes['Make_Name'];?></option>
                            <?php }	?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group ">
                        <label>Show Model</label>
                        <span class="getModels filterVehicleByModel">
                        <select class="form-control select-field model" name="Model_UUID">
                            <?php
                            if($make_id =='All'){}else{
                                $makeId =  $post_make_id;
                                $getmodel = getmodel($makeId);					
                                    echo "<option value=''>Select model</option>";
                                    foreach($getmodel as $model){						
                                        if($model['UUID'] == $post_model){
                                            $selected = 'selected';
                                        }else{
                                            $selected = '';
                                        }  
                            ?>
                            <option value="<?php echo $model['UUID'];?>" <?php echo $selected;?>> <?php echo $model['Model_Name'];?></option>
                            <?php } } ?>
                            
                        </select>
                        </span>
                    </div>
                </div>
                <div class="col-sm-2">
                    <button name="postdata" type="submit" style="margin-top:25px;" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form><br>
         
        <div class="site-form">
          <div class="table-responsive">
            <table class="table table-striped table-data quick_update_data faq_data">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Make</th>
                  <th>Model</th>
                  <th>Year</th>
                  <th>Gen</th>
                  <th>Keys</th>
                  <th>Remotes</th>
                  <th>Locks</th>
                </tr>
              </thead>
              <tbody>
                <?php if($results){
                    foreach($results as $value){?>
                    <tr>
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
                        <td>
                          <div class="vh_value_holder">
                            <span class="td_data"><?php echo $value['gen'];?> <br> <?php echo $value['gen_notes'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['gen'];?>__<?php echo $value['gen_notes'];?>" data-id="<?php echo $value['id'];?>" data-col="gen"></span><div class="get_column_data"></div>
                          </div>
                        </td> 
                        <td>
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
                        <td></td>
                        <td>
                            <table class="table" border="1" bordercolor="#ccc" style="font-size:12px;">
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Product</th>
                                    <th>Action</th>
                                </tr>
                                <?php $vehciles_id = $value['Vehicle_UUID'];
                                $get_vehicles_locks =  get_vehicles_locks($vehciles_id);
                                if($get_vehicles_locks){
                                    foreach($get_vehicles_locks as $locks){?>
                                        <tr>
                                            <td><?php echo $locks['Part_Name'];?></td>
                                            <td><?php echo $locks['Part_Name'];?></td>
                                            <td>
                                                <span class="td_data"><?php echo $locks['Products'];?></span>
                                                <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $locks['Products'];?>" data-id="<?php echo $locks['id'];?>" data-col="Products" data-table="t_Locks"></span>
                                                <div class="get_column_data"></div>
                                            </td>
                                            <td>
                                                <a target="_blank" href="edit_locks/<?php echo $locks['id'];?>" class="btn btn-sm btn-success"> Edit</a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                <?php }?>
                            </table>
                        </td>
                    </tr>
                    <?php }
                }?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->
