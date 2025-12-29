<?php 
$altr_kyes_hide = '';
$altr_kyes_checked = '';
if(isset($_COOKIE['AlternativeKeys_cookie'])){ 
   $cookieValue = $_COOKIE['AlternativeKeys_cookie'];
   if( $cookieValue == 1){
    $altr_kyes_hide = 'hide';
    $altr_kyes_checked = 'checked';
   }else  if( $cookieValue == 2){
    $altr_kyes_hide = '';
    $altr_kyes_checked = '';
   }
 }else{
  $altr_kyes_hide = '';
  $altr_kyes_checked = '';
}
$value_key = "";
if(isset($this->session->userdata['show_keysby_types'])){
 $value_key1 = $this->session->userdata['show_keysby_types'];
 $value_key =  $value_key1['key_types'];
}
?>
<table class="table table-bordered table-data mar0 tab-con">
 <thead>
                <tr> 
                <th rowspan="2" style="min-width:220px;">Action</th>
                  <th rowspan="2">ID</th>                
                  <th rowspan="2">Name 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Key_Name" data_id="DESC"></a>
                  </th>
                  <th rowspan="2">AKG#
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="id" data_id="DESC"></a></th> 
                  <th rowspan="2">Images 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Key_Image" data_id="DESC"></a>
                  </th> 
                  <th rowspan="2">Key Type
                     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Key_Type_UUID" data_id="DESC"></a>
                  </th>
                  <th rowspan="2">Lock Type
                     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="lock_type" data_id="DESC"></a>
                  </th>
                  <th rowspan="2">Chip
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Chip_UUID" data_id="DESC"></a>
                  </th>                                 
                  <th rowspan="2">Products
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Products" data_id="DESC"></a>
                  </th>
                  <th rowspan="2">Key Shell
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Key_Shell_UUID" data_id="DESC"></a>
                  </th> 
                  <th rowspan="2">Test Key
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="TestKey_UUID" data_id="DESC"></a>
                  </th> 
                  <th rowspan="2">Replacement Blade
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Replacement_blade" data_id="DESC"></a>
                  </th> 
                  <th colspan="12" class="alternative <?php echo $altr_kyes_hide;?>">Alternative Key Names
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Other" data_id="DESC"></a>
                  </th>
                  <th rowspan="2">Substitutes
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Substitute_UUID" data_id="DESC"></a>
                  </th>
                  <th rowspan="2" style="width:200px">Action</th>
                </tr>
                <tr>
                  <th class="alternative <?php echo $altr_kyes_hide;?>">Ilco
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Ilco" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">Axxess
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Axxess" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">Curtis
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Curtis" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">ESP
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_ESP" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">Hillman
                     <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Hillman" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">Jet
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Jet" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">JMA
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_JMA" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">Silca
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Silca" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">Strattec
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Strattec" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">Taylor
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Taylor" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">OEM
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_OEM" data_id="DESC"></a>
                    </th>
                    <th class="alternative <?php echo $altr_kyes_hide;?>">Other
                    <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom keys_sorting" data-by="Alt_Other" data_id="DESC"></a>
                    </th>
                </tr>
              </thead>
<tbody>
<?php 
$i =1;
if($getkeys){
foreach($getkeys as $value){?>
      <tr> 
                    <td>
                    <a  href="<?php echo adm_base_url();?>/edit_key/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>
                        <a  href="<?php echo adm_base_url();?>/copy_key/<?php echo $value['id'];?>" type="button" class="btn btn-info" >Copy</a>
                        <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_key/')" type="button"class="btn btn-danger" >Delete</a>
                    </td>  
                    <td><?php echo $value['id'];?></td>                   
                      <td class="sorting-column">   
                      <div class="product-holder"><span class="td_data"><?php echo $value['Key_Name'];?></span></div>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Key_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Key_Name"></span><div class="get_column_data"></div> 
                      </td>

                      <td style="white-space:nowrap;">
                        <span class="td_data"><?php echo $value['akg_num'];?></span></div>
                        <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['akg_num'];?>" data-id="<?php echo $value['id'];?>" data-col="akg_num"></span><div class="get_column_data"></div> 
                      </td>
                      <td>
              <?php
                $images = $value['Key_Image'];
                if($images ==""){           
                }else{
                echo '<span class="td_data"><img class="customImage" src ="'.aks_img_url().$images.' "></span>';
                }           
                          ?>
                          <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Key_Image'];?>" data-id="<?php echo $value['id'];?>" data-col="Key_Image"></span><div class="get_column_data"></div> 
                      </td>
                      <td>
              <?php $get_key_type = get_key_type($value['Key_Type_UUID']);?>
                       <span class="td_data"><?php echo $get_key_type[0]['Key_Type_Name'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_dropbox" aria-hidden="true" data-val="<?php echo $value['Key_Type_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Key_Type_UUID" data-key="Key_Type_UUID" data-type="Key_Type_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td>
                          <div class="product-holder">
                            <span class="td_data"><?php echo $value['lock_type'];?></span>
                           <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['lock_type'];?>" data-id="<?php echo $value['id'];?>" data-col="lock_type"></span>
                          </div>
                          <div class="get_column_data"></div>
                      </td>
                      <td>
                       <?php $get_chips = get_chips($value['Chip_UUID']);?>
                        <span class="td_data"><?php echo $get_chips[0]['Chip_Name'];;?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_dropbox" aria-hidden="true" data-val="<?php echo $value['Chip_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Chip_UUID" data-key="Chip_UUID" data-type="Chip_UUID"></span><div class="get_column_data" ></div>
                     </td>
                      <td>
                          <div class="product-holder">
                            <span class="td_data"><?php echo $value['Products'];?></span>
                           <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products"></span>
                          </div>
                          <div class="get_column_data"></div>
                      </td>
                      <td>
              <?php $get_key_type = get_key_name($value['Key_Shell_UUID']);?>
                         <span class="td_data"><?php echo $get_key_type[0]['Key_Name'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_dropbox" aria-hidden="true" data-val="<?php echo $value['Key_Shell_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Key_Shell_UUID" data-key="Transponder Key Shell" data-type="Key_Shell_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td>
                        <?php $get_key_type = get_key_name($value['TestKey_UUID']);?>
                        <span class="td_data"><?php echo $get_key_type[0]['Key_Name'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_dropbox" aria-hidden="true" data-val="<?php echo $value['TestKey_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="TestKey_UUID" data-key="TestKey_UUID" data-type="TestKey_UUID"></span><div class="get_column_data" ></div>
                      </td>
                      <td>
                      	<?php $get_key_type = get_key_name($value['Replacement_blade']);?>
                        <span class="td_data"><?php echo $get_key_type[0]['Key_Name'];?></span>
                      </td>
                      <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_Ilco'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_Ilco'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_Ilco"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_Axxess'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_Axxess'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_Axxess"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_Curtis'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_Curtis'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_Curtis"></span><div class="get_column_data"></div> 
                      </td>
                       <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_ESP'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_ESP'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_ESP"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_Hillman'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_Hillman'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_Hillman"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_Jet'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_Jet'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_Jet"></span><div class="get_column_data"></div> 
                      </td>
                     <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_JMA'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_JMA'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_JMA"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_Silca'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_Silca'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_Silca"></span><div class="get_column_data"></div> 
                      </td>
                       <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_Strattec'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_Strattec'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_Strattec"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_Taylor'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_Taylor'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_Taylor"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><?php echo $value['Alt_OEM'];?></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_OEM'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_OEM"></span><div class="get_column_data"></div> 
                      </td>
                      <td class="alternative <?php echo $altr_kyes_hide;?>">
                       <span class="td_data"><div class="notes-holder2"><?php echo $value['Alt_Other'];?></div></span>
                       <span class="glyphicon glyphicon-pencil edit_keys_inputs" aria-hidden="true" data-val="<?php echo $value['Alt_Other'];?>" data-id="<?php echo $value['id'];?>" data-col="Alt_Other"></span><div class="get_column_data"></div> 
                      </td>                     
                      <td>
             <?php $substitute_UUID = explode(',', $value['Substitute_UUID']);
                            for($sb = 0; $sb < count($substitute_UUID)-1; $sb++){;
                                $get_key_type = get_key_name($substitute_UUID[$sb]);
                                echo $get_key_type[0]['Key_Name'].'<br>';
                            }
                          ?>
                      </td>
                      <td style="white-space: nowrap;">
                       <a  href="<?php echo adm_base_url();?>/copy_key/<?php echo $value['id'];?>" type="button" class="btn btn-info" >Copy</a>
                         
                      <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_key/')" type="button"class="btn btn-danger" >Delete</a></td>
                     
                      </tr> 
<?php }}else{
	
	echo "<div class='alert alert-danger'>Data not found .Please try again </div>";
}?>
 </tbody>
</table>       
