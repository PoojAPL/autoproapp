<?php 
error_reporting(0);
$i=1;
$column = array();
$column[] = 'ID';
$column[] = 'Type';
$column[] = 'Image';
$column[] = 'Make';
$column[] = 'Model';
$column[] = 'Year';
$column[] = 'Code Series';
$column[] = 'Tumblers';
$column[] = 'Retainer';
$column[] = 'Mechanical Key';
$column[] = 'Chip Key';
$column[] = 'System';
$column[] = 'Dongle';
$column[] = 'Smart Card';
$column[] = 'Software';
$column[] = 'PIN Required';
$column[] = 'PIN Read';
$column[] = '10-Min Bypass';
$column[] = 'Notes';

$column[] = 'AutoProPAD System';
$column[] = 'Add-A-Key';
$column[] = 'All-Keys-Lost';
$column[] = 'AutoProPAD PIN Read';
$column[] = 'Programs Remotes';
$column[] = 'Resync Available';
$column[] = 'AutoProPAD Notes';

$column[] = 'Hotwire Key Prog';
$column[] = 'Hotwire Remote Prog';
$column[] = 'Hotwire Misc Prog';

$column[] = 'TKO / SDD System';
$column[] = 'SDD Adapter';
$column[] = 'SDD Cable';
$column[] = 'TKO Cable';
$column[] = 'TKO / SDD Notes';

$column[] = 'DMax System';
$column[] = 'DMax Method';

$column[] = 'Pro-Lok Tool';
$column[] = 'Pro-Lok Linkage';

$column[] = 'Parts Ignition';
$column[] = 'Parts Door/Glove';
$column[] = 'Parts Accessories';

$column[] = 'OBD Port Location Text';
$column[] = 'OBD Port Location Image';

header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=AutoProPAD_'.date('m-d-y').'.csv');  
$output = fopen("php://output", "w");  
fputcsv($output,$column); 
$data = array();
foreach($getAllVehiclesDataCSV as $value){
    $data['ID'] = $value['id'];
    $vehicle_Type_UUID_info = vehicle_Type_UUID_info($value['Vehicle_Type_UUID']);
    $data['type'] = $vehicle_Type_UUID_info[0]['type'];
    $data['Image'] = base_url().'assets/vechileImages/150/'.$value['image_url'];
    $data['Make'] = $value['Make_Name'];
    $data['Model'] = $value['Model_Name'];
    $data['Years'] = str_replace(',','-',$value['Years']);
    $get_Code_Series_name_data = '';
    $got_series_data = explode(',',$value['Code_Series_UUID']);
    if( count($got_series_data) > 1){
        for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
            $got_series_val = explode('|',$got_series_data[$cs]);
            $code_series_id = $got_series_val[0];
            //$code_series_note = $got_series_val[1];
            $get_Code_Series_name = get_Code_Series_name($code_series_id);
            $get_Code_Series_name_data .= $get_Code_Series_name[0]['Code_Series_Name'].', ';
        }    
    }else{
        $got_series_val = explode('|',$got_series_data[0]);
        $code_series_id = $got_series_val[0];
        $get_Code_Series_name = get_Code_Series_name($code_series_id);
    }
    $data['Code Series'] = $get_Code_Series_name_data;
    $data['Tumblers'] = $value['Tumblers'];
    $get_Retainer_name = get_Retainer_name($value['Retainer_UUID']);
    $data['Retainer_name'] = $get_Retainer_name[0]['Retainer_Name'];

    $mach_keys_uuids = "";								
    $mach_keys_array = explode(',',$value['Mechanical_Key_UUID']);
    for($i = 0; $i < count($mach_keys_array); $i++ ){
        $get_key_name = get_key_name($mach_keys_array[$i]);
        $mach_keys_uuids .=  $get_key_name[0]['Key_Name'].', ';
    }
    $data['Mechanical_Key'] = $mach_keys_uuids;

    $chip_keys_uuids = "";								
    $chip_keys_array = explode(',',$value['Chip_Key_UUID']);
    for($i = 0; $i < count($chip_keys_array); $i++ ){
        $get_key_name = get_key_name($chip_keys_array[$i]);
        $chip_keys_uuids .=  $get_key_name[0]['Key_Name'].', ';
    }
    $data['chip_Key'] = $chip_keys_uuids;

    $data['MVP_System'] = $value['MVP_System'];

    $get_tool_name = get_tool_name($value['MVP_Dongle_UUID']);
    $data['tool_name'] = $get_tool_name[0]['Tool_Name'];
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
    $data['SmartCard'] = $SmartCard;
    $get_tool_name = get_tool_name($value['MVP_Software']);
    $data['MVP_Software'] = $get_tool_name[0]['Tool_Name'];
    if( $value['MVP_PIN_Required'] == 1){
        $PIN_Required = 'Yes';
     }else if( $value['MVP_PIN_Required'] === ""){
        $PIN_Required = '';
     }else if( $value['MVP_PIN_Required'] == 0){
        $PIN_Required = 'No';
     }
    $data['PIN_Required'] = $PIN_Required;
    $data['MVP_PIN_Read'] = $value['MVP_PIN_Read'];
    $get_10_mint_bypass = get_10_mint_bypass($value['id']);
    $data['10_mint_bypass'] = $get_10_mint_bypass[0]['MVP_10-Minute_Bypass'];
    $data['MVP_Notes'] = $value['MVP_Notes'];

    $data['APP_System'] = $value['APP_System'];
    $data['APP_Add_Keys'] = $value['APP_Add_Keys'];
    $data['APP_All_Keys_Lost'] = $value['APP_All_Keys_Lost'];
    $data['PIN_Read'] = $value['PIN_Read'];
    $data['APP_Programs_Remote'] = $value['APP_Programs_Remote'];
    $data['APP_Resync_Available'] = $value['APP_Resync_Available'];
    $data['APP_Notes'] = $value['APP_Notes']; 
    
    $data['HW_Key_Prog'] = $value['HW_Key_Prog'];    
    $data['HW_Remote_Prog'] = $value['HW_Remote_Prog'];    
    $data['HW_Misc_Prog'] = $value['HW_Misc_Prog'];    

    $data['TKOSDD_System'] = $value['TKOSDD_System'];    
    $data['TKOSDD_SDD_Adapter'] = $value['TKOSDD_SDD_Adapter'];    
    $data['TKOSDD_SDD_Cable'] = $value['TKOSDD_SDD_Cable'];  
    $data['TKOSDD_TKO_Cable'] = $value['TKOSDD_TKO_Cable'];    
    $data['TKOSDD_Notes'] = $value['TKOSDD_Notes'];  
    
    $data['DMax_System'] = $value['DMax_System'];  
    $data['DMax_Method'] = $value['DMax_Method'];  
    
    $get_tool_name = get_tool_name($value['ProLok_Tool_UUID']);
    $data['ProLok_Tool'] = $get_tool_name[0]['Tool_Name'];
    $data['ProLok_Linkage'] = $value['ProLok_Linkage']; 

    $data['Parts_Ignition'] = $value['Parts_Ignition'];  
    $data['Parts_Door'] = $value['Parts_Door'];
    $data['Parts_Accessories'] = $value['Parts_Accessories'];  

    $data['OBD_Location_Text'] = $value['OBD_Location_Text'];
    $data['OBD_Location_Image'] = $value['OBD_Location_Image'];

    fputcsv($output, $data); 
}
fclose($output);  

//print_r($getAllVehiclesDataCSV );
?>