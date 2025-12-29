<?php 
error_reporting(0);
$i=1;
$column = array();
foreach($getAllVehiclesDataCSV as $key => $vehciles){
  
    foreach($vehciles as $key1 => $vehciles1){
      if($i > 1){
          break;
      }else{
         $column[] = $key1; 
       } 
       
    } 
     $i++;
}
header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=AutoProPAD_'.date('m-d-y').'.csv');  
$output = fopen("php://output", "w");  
fputcsv($output,$column); 
foreach($getAllVehiclesDataCSV as $vehciles){
  $got_series_data = explode(',',$vehciles['Code_Series_UUID']);
  if( count($got_series_data) > 1){
      for( $cs = 0; $cs <= count($got_series_data); $cs++ ){
        $got_series_val = explode('|',$got_series_data[$cs]);
        $code_series_id = $got_series_val[0];
        $code_series_note = $got_series_val[1];
        $get_Code_Series_name = get_Code_Series_name($code_series_id);
       $Code_Series_Name2 .= $get_Code_Series_name[0]['Code_Series_Name'].',';
      }
      $Code_Series_Name = rtrim($Code_Series_Name2, ',') ;
   }else{
    $got_series_val = explode('|',$got_series_data[0]);
    $code_series_id = $got_series_val[0];
    $code_series_note = $got_series_val[1];
    $get_Code_Series_name = get_Code_Series_name($code_series_id);
    $Code_Series_Name = $get_Code_Series_name[0]['Code_Series_Name'];
  }
  $vehciles['Years'] = str_replace(',','-',$vehciles['Years']);
  $vehciles['Code_Series_UUID'] = '"' . $Code_Series_Name. '"';
  $vehciles['Code_Series_UUID'] = str_replace('"',' ',$vehciles['Code_Series_UUID']);
    fputcsv($output, $vehciles); 
}
fclose($output);  

//print_r($getAllVehiclesDataCSV );
?>