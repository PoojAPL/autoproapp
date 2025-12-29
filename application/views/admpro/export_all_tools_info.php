<?php 
error_reporting(0);
$i=1;
$column = array();
$column[] = 'Image';
$column[] = 'Tool Type';
$column[] = 'Manufacturer';
$column[] = 'Name';
$column[] = 'Note';
$column[] = 'Useful For';
$column[] = 'Difficulty';
$column[] = 'Products';
header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=AutoProApp_tools_'.date('m-d-y').'.csv');  
$output = fopen("php://output", "w");  
fputcsv($output,$column); 
$data = array();
foreach($getAllExportTools as $value){    
    $get_tool_type = get_toolType_by_uuid($value['Tool_Type_UUID']);
    $tool_type = $get_tool_type[0]['Tool_Type_Name'];
    $get_manufacturer = get_manufacturer($value['Manufacturer_UUID']);
    $manufacturer_Name = $get_manufacturer[0]['Manufacturer_Name'];
    $tool_Name = $value['Tool_Name'];
    $note = $value['Tool_Note'];
    $useful_for = $value['Useful_For'];
    $difficulty = $value['Difficulty'];
    $products = $value['Products']; 
    if($value['Tool_Image_Url'] !=""){
        $images = $value['Tool_Image_Url'];
    } else{
        $images = "";
    }  
    $data['Tool_Image_Url'] = $images;
    $data['Tool_Type_Name'] = $tool_type;    
    $data['Manufacturer_Name'] = $manufacturer_Name;
    $data['tool_Name'] = $tool_Name;
    $data['Tool_Note'] = $note;    
    $data['Useful_For'] = $useful_for;
    $data['Difficulty'] = $difficulty;
    $data['products'] = $products;    
    fputcsv($output, $data); 
}
fclose($output);  

//print_r($getAllVehiclesDataCSV );
?>