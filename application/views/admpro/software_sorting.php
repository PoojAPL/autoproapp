<table class="table table-striped table-data mar0">
    <thead>
    <tr>
        <th style="width:137px">Action</th>
        <th>ID</th> 
        <th>Type
        <!-- <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="type" data_id="DESC"></a> -->
        </th>                
        <th> Name </th>
        <th>Vehicles</th>
        <th>Images </th>
        <th>Part #</th>
        <th>Products </th>    
    </tr>
    </thead>
    <tbody>
    <?php 
    $i =1;
    foreach($results as $value){?>
        <tr>					                     
            <td>
                <a  href="<?php echo adm_base_url();?>/edit_software/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_software/')" type="button"class="btn btn-danger" >Delete</a>
                <a  href="<?php echo adm_base_url();?>/copy_software/<?php echo $value['id'];?>" type="button" class="btn btn-info" >Copy</a> 
            </td>
            <td><?php echo $value['id'];?></td>     
            <td><?php echo $value['type'];?></td>                                     
            <td>
                <span class="td_data"><?php echo $value['name'];?></span>
                <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['name'];?>" data-id="<?php echo $value['id'];?>" data-col="name" data-table="t_Tools_Software"></span><div class="get_column_data"></div> 
            </td>
            <td>
                <?php 
                if( $value['vehicles'] != ""){
                    $vehicles_UUIDs = explode(',', $value['vehicles']);
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
            <td>
                <?php if( $value['image'] != ""){ ?>
                <img src="<?php echo asset_url();?>/images/<?php echo $value['image'];?>" width="50px">
                <?php } ?>
            </td>
            <td>
                <span class="td_data"><?php echo $value['part'];?></span>
                <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['part'];?>" data-id="<?php echo $value['id'];?>" data-col="part" data-table="t_Tools_Software"></span><div class="get_column_data"></div> 
            </td>
            <td>
                <span class="td_data"><?php echo $value['products'];?></span>
                <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['products'];?>" data-id="<?php echo $value['id'];?>" data-col="products" data-table="t_Tools_Software"></span><div class="get_column_data"></div> 
            </td>
        </tr> 
    <?php }?>
    </tbody>
</table>