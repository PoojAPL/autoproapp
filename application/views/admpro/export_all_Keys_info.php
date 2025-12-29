<?php 
error_reporting(0);
$i=1;
$column = array();
$column[] = 'ID';
$column[] = 'Name';
$column[] = 'Images';
$column[] = 'Key Type';
$column[] = 'Lock Type';
$column[] = 'Chip';
$column[] = 'Products';
$column[] = 'Key Shell';
$column[] = 'Test Key';
$column[] = 'Replacement Blade';
$column[] = 'Ilco';
$column[] = 'Axxess';
$column[] = 'Curtis';
$column[] = 'ESP';
$column[] = 'Hillman';
$column[] = 'Jet';
$column[] = 'JMA';
$column[] = 'Silca';
$column[] = 'Strattec';
$column[] = 'Taylor';
$column[] = 'OEM';
$column[] = 'Other';
$column[] = 'Substitutes';

header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=AutoProApp_keys_'.date('m-d-y').'.csv');  
$output = fopen("php://output", "w");  
fputcsv($output,$column); 
$data = array();
foreach($getAllVehiclesDataCSV as $value){
    $data['ID'] = $value['id'];
    $data['name'] = $value['Key_Name'];
    $get_key_type = get_key_type($value['Key_Type_UUID']);
    $data['Key_Image'] = aks_img_url().$images;
    $data['Key_Type_Name'] = $get_key_type[0]['Key_Type_Name'];
    
    $data['lock_type'] = $value['lock_type'];

    $get_chips = get_chips($value['Chip_UUID']);
    $data['Chip_Name'] = $get_chips[0]['Chip_Name'];
    $data['Products'] = $value['Products'];

    $get_key_type = get_key_name($value['Key_Shell_UUID']);
    $data['Key_Name'] = $get_key_type[0]['Key_Name'];

    $get_key_type = get_key_name($value['TestKey_UUID']);
    $data['TestKey_UUID'] = $get_key_type[0]['Key_Name'];

    $get_key_type = get_key_name($value['Replacement_blade']);
    $data['Replacement_blade'] = $get_key_type[0]['Key_Name'];

    $data['Alt_Ilco'] = $value['Alt_Ilco'];
    $data['Alt_Axxess'] = $value['Alt_Axxess'];
    $data['Alt_Curtis'] = $value['Alt_Curtis'];
    $data['Alt_ESP'] = $value['Alt_ESP'];
    $data['Alt_Hillman'] = $value['Alt_Hillman'];
    $data['Alt_Jet'] = $value['Alt_Jet'];

    $data['Alt_JMA'] = $value['Alt_JMA'];
    $data['Alt_Silca'] = $value['Alt_Silca'];
    $data['Alt_Strattec'] = $value['Alt_Strattec'];
    $data['Alt_Taylor'] = $value['Alt_Taylor'];
    $data['Alt_OEM'] = $value['Alt_OEM'];
    $data['Alt_Other'] = $value['Alt_Other'];
    $Substitute_UUID_data = '';
    $substitute_UUID = explode(',', $value['Substitute_UUID']);
    for($sb = 0; $sb < count($substitute_UUID)-1; $sb++){;
        $get_key_type = get_key_name($substitute_UUID[$sb]);
        $Substitute_UUID_data .= $get_key_type[0]['Key_Name'].', ';
    }
    $data['Substitute_UUID'] = rtrim($Substitute_UUID_data,',');
    fputcsv($output, $data); 
}
fclose($output);  

//print_r($getAllVehiclesDataCSV );
?>