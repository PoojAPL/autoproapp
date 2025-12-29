<?php 
error_reporting(0);
$i=1;
$column = array();
$column[] = 'ID';
$column[] = 'EZ#';
$column[] = 'AKG#';
$column[] = 'Type';
$column[] = 'Name';
$column[] = 'Vehicles';
$column[] = 'Image';
$column[] = 'OEM Part Number';
$column[] = 'Buttons';
$column[] = 'FCC/IC/Continental IDs';
$column[] = 'Frequency';
$column[] = 'Battery';
$column[] = 'Chip';
$column[] = 'Test Key';
$column[] = 'Emergency Keys';
$column[] = 'Remote Shell';
$column[] = 'Reusable?';
$column[] = 'Products';
header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=AutoProApp_remotes_'.date('m-d-y').'.csv');  
$output = fopen("php://output", "w");  
fputcsv($output,$column); 
$data = array();
foreach($getAllVehiclesDataCSV as $value){
    $data['ID'] = $value['id'];
    $data['ez'] = $value['ez'];
    $data['akg_num'] = $value['akg_num'];
    $get_remote_types = get_remote_types($value['Remote_Type_UUID']);
    $data['Remote_Type_Name'] = $get_remote_types[0]['Remote_Type_Name'];

    $data['Remote_Name'] = $value['Remote_Name'];

    $vehicles_names = '';
    if( $value['Vehicles_UUID'] != ""){
        $vehicles_UUIDs = explode(',', $value['Vehicles_UUID']);
        for($v = 0; $v < count($vehicles_UUIDs); $v++){
        $get_vehicles = get_vehicles($vehicles_UUIDs[$v]);
        $years = explode(',',$get_vehicles[0]['Years']);
        $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
        $get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
        $vehicles_names .= $get_make_name[0]['Make_Name'].' ' .$get_models_name[0]['Model_Name'].'  '.$years[0].'-'.$years[count($years)-1].', ';
        }
    }
    $data['vehicles_names'] = $vehicles_names;

    $images = $value['Remote_Image_Url'];
    $data['Remote_Image_Url'] = aks_img_url().$images;

    $data['OEM_Part_Number'] = $value['OEM_Part_Number'];

    $get_buttons_info_name = '';
    $buttons_array  = explode(',',$value['Buttons']);
    for($i = 0; $i < count( $buttons_array)-1; $i++ ){
        $get_buttons_info = get_buttons_info($buttons_array[$i]);	
        if( count($get_buttons_info) > 0){
            $get_buttons_info_name .= $get_buttons_info[0]['Name'].', ';
        }
    }
    $data['buttons'] = $get_buttons_info_name;

    $data['FCCID'] = $value['FCCID'].'/'.$value['IC'].'/'.$value['Continental_ID'];
    
    $get_frequency_info = get_frequency_info($value['Frequency']);
    $data['Frequency'] = $get_frequency_info[0]['Name'];

    $get_batteries = get_batteries($value['Battery_UUID']);
    $data['Battery'] = $get_batteries[0]['Battery_Name'];

    $get_chips = get_chips($value['Chip_UUID']);
    $data['Chip'] = $get_chips[0]['Chip_Name'];

    $get_kyes = get_key_name($value['TestKey_UUID']);
    $data['TestKey'] = $get_kyes[0]['Key_Name'];

    $Emergency_Keys = '';
    $explode =  explode(',',$value['Emergency_Key_UUID']);
    foreach($explode as $emr_key){
        $get_kyes = get_key_name($emr_key);
        $Emergency_Keys .= $get_kyes[0]['Key_Name'].', ';
    }
    $data['Emergency_Key'] = $Emergency_Keys;

    $shell_array  = $value['Shell_UUID'];
    $get_remote_name = get_remote_shell_name($shell_array);
    $data['Shell'] = $get_remote_name[0]['Remote_Name'];

    $data['Reusable'] = $value['Reusable'];
    $data['Products'] = $value['Products'];

    fputcsv($output, $data); 
}
fclose($output);  

//print_r($getAllVehiclesDataCSV );
?>