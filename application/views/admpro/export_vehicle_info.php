<?php 
error_reporting(0);
?>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Mechanical Key> Product</th>
        <th>Chip Key> Product</th>
        <th>Remote> Product</th>
    </tr>

<?php 
foreach($getAllVehiclesDataCSV as $vehciles){
    $mach_keys_uuids = array();
    $mach_Products = '';
    if($vehciles['Mechanical_Key_UUID'] ==""){
        $mach_keys_uuids[]=  array('value' => '','products' => '');
    }else{								
        $mach_keys_array = explode(',',$vehciles['Mechanical_Key_UUID']);
        for($i = 0; $i < count($mach_keys_array); $i++ ){
            $mck_product_array = array();
            $get_key_name = get_key_name($mach_keys_array[$i]);
            $mach_Products .= rtrim($get_key_name[0]['Products'],',').' | ';
        }
        $mach_Products = rtrim($mach_Products,' |');
    }
    $transponder_Products = '';
    if($vehciles['Chip_Key_UUID'] ==""){
        $transponder_Products = '';
    }else{								
        $chip_keys_array = explode(',',$vehciles['Chip_Key_UUID']);
        for($i = 0; $i < count($chip_keys_array); $i++ ){
            $transponder_Products_array = array();
            $get_key_name = get_key_name($chip_keys_array[$i]);
            $Chip_UUID =  $get_key_name[0]['Chip_UUID'];
            $get_chips = get_chips($Chip_UUID);
            $get_key_type = get_key_type($get_key_name[0]['Key_Type_UUID']);
            $transponder_Products .= rtrim($get_key_name[0]['Products'],',').' | ';
        }
        $transponder_Products = rtrim($transponder_Products,' |');
    }
    $remote_Products = '';
    $get_vehicles_remotes = get_vehicles_remotes($vehciles['UUID']);
    if($get_vehicles_remotes){
        foreach($get_vehicles_remotes as $get_remote_name){
            $remote_Products .= trim($get_remote_name['Products'],',').' | ';
        }
        $remote_Products = rtrim($remote_Products,' |');
    }?>
    <tr>
        <td><?php echo $vehciles['id'];?></td>
        <td><?php echo $vehciles['Make_Name'];?></td>
        <td><?php echo $vehciles['Model_Name'];?></td>
        <td><?php echo str_replace(',','-',$vehciles['Years']);?></td>
        <td><?php echo $mach_Products;?></td>
        <td><?php echo $transponder_Products;?></td>
        <td><?php echo $remote_Products;?></td>
    </tr>
<?php }

//print_r($getAllVehiclesDataCSV );
?>
</table>