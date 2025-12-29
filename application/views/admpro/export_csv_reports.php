<?php 
error_reporting(0);
$i=1;
$column = array();
$column[] = 'VID';
$column[] = 'Make';
$column[] = 'Model';
$column[] = 'Year';
$column[] = 'Mechanical Key';
$column[] = 'MK Products';
$column[] = 'MK Chip Products';
$column[] = 'Transponder Key';
$column[] = 'TK Products';
$column[] = 'TK Chip Products';
header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=AutoProApp_vehicles_'.date('m-d-y').'.csv');  
$output = fopen("php://output", "w");  
fputcsv($output,$column); 
$data = array();
foreach($results as $vehciles){
    $mach_key_products_id = '';
    $mach_key_names = '';
    $mach_chip_uuid = '';
    if($vehciles['Mechanical_Key_UUID'] != ""){
        $mach_keys_array = explode(',',$vehciles['Mechanical_Key_UUID']);
        for($i = 0; $i < count($mach_keys_array); $i++ ){
            $value_uuid = $mach_keys_array[$i];
            $get_rows = get_key_name($value_uuid);//$this->db->query("SELECT Replacement_blade,Products FROM t_Keys WHERE UUID ='".$value_uuid."' "); 
            //$get_rows = $get_result->result_array();Chip_UUID
            if(count($get_rows) > 0){
                $mach_key_products_id .= rtrim($get_rows[0]['Products'],',').',';   
                $mach_key_names .= rtrim($get_rows[0]['Key_Name'],',').',';
                if( $get_rows[0]['Chip_UUID'] !=""){
                    $mach_chip_uuid .= $get_rows[0]['Chip_UUID'].","; 
                }                   
            }
        }
        $mach_key_products_id = rtrim($mach_key_products_id,',');
        $mach_key_names = rtrim( $mach_key_names,',');
    }
    $chip_products_id1 = '';
    $chip_key_names = '';
    $TK_chip_uuid = '';
    if($vehciles['Chip_Key_UUID'] !=""){  
        $mach_keys_array1 = explode(',',$vehciles['Chip_Key_UUID']); // Transponder Chip Keys         
        for($i = 0; $i < count($mach_keys_array1); $i++ ){
            $value_uuid1 = $mach_keys_array1[$i];
            $get_rows =  get_key_name($value_uuid1);//$this->db->query("SELECT Products FROM t_Keys WHERE UUID ='".$value_uuid1."' ");
            if(count($get_rows) > 0){
                $chip_products_id1 .= rtrim($get_rows[0]['Products'],',').','; 
                $chip_key_names .= rtrim($get_rows[0]['Key_Name'],',').',';  
                if( $get_rows[0]['Chip_UUID'] !=""){
                 $TK_chip_uuid .= $get_rows[0]['Chip_UUID'].","; 
                }                    
            }
        }
        $chip_products_id1 = rtrim($chip_products_id1,',');
        $chip_key_names = rtrim( $chip_key_names,',');
    }
    $mach_chip_uuid = explode(',',$mach_chip_uuid);
    $mk_chip_products2 = "";
    for($mc = 0; $mc < count($mach_chip_uuid); $mc++){
        $get_rows =  get_chips($mach_chip_uuid[$mc]);//$this->db->query("SELECT Products FROM t_Keys WHERE UUID ='".$value_uuid1."' ");
        if(count($get_rows) > 0){
            $mk_chip_products2 .= rtrim($get_rows[0]['Products'],',').', ';                   
        }
    }

    $TK_chip_uuid = explode(',',$TK_chip_uuid);
    $tk_chip_products2 = "";
    for($mc = 0; $mc < count($TK_chip_uuid); $mc++){
        $get_rows =  get_chips($TK_chip_uuid[$mc]);//$this->db->query("SELECT Products FROM t_Keys WHERE UUID ='".$value_uuid1."' ");
        if(count($get_rows) > 0){
            $tk_chip_products2 .= rtrim($get_rows[0]['Products'],',').', ';                   
        }
    }

    $data['vid'] = $vehciles['VID'];
    $data['Make_Name'] = $vehciles['Make_Name'];
    $data['Model_Name'] = $vehciles['Model_Name'];
    $data['Years'] = str_replace(',','-',$vehciles['Years']);
    $data['mach_key_names'] = $mach_key_names;
    $data['mach_key_products_id'] = $mach_key_products_id;
    $data['mk_chip_products2'] = rtrim($mk_chip_products2,', ');
    $data['chip_key_names'] = $chip_key_names;
    $data['chip_products_id1'] = $chip_products_id1;    
    $data['tk_chip_products2'] = rtrim($tk_chip_products2,', ');
    fputcsv($output, $data);
    // echo '<pre>';
    // print_r($data);
}
fclose($output); 

?>