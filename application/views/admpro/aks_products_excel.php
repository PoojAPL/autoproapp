<?php //print_r($results);'
$get_aks_all_customers = aks_products_excel();
//$get_aks_all_customers = get_aks_customers_excel();//aks_blankTitle_products_excel();
$i=1;
$column = array();
// print_r($get_aks_all_customers);
// die();
foreach($get_aks_all_customers as $key => $vehciles){
  
    foreach($vehciles as $key1 => $vehciles1){
      if($i > 1){
          break;
      }else{
         if($key1 == 'products_id'){
            $column[] ='ID';
         }
         if($key1 == 'manufacturers_name'){
            $column[] ='Manufacturer Name';
         }
         if($key1 == 'products_model'){
            $column[] ='Model';
         }
         if($key1 == 'products_description'){
            $column[] ='Description';
         }
         if($key1 == 'products_name'){
            $column[] ='Products Name';
         }
         if($key1 == 'products_price'){
            $column[] ='Price';
         }
         if($key1 == 'products_cost'){
            $column[] ='Cost';
         }
         // if($key1 == 'products_cost'){
         //    $column[] ='Products Cost';
         // } 
         // if($key1 == 'customers_state'){
         //    $column[] ='State';
         // }
         // if($key1 == 'customers_postcode'){
         //    $column[] ='ZIP/Postal Code';
         // }
         // if($key1 == 'customers_country'){
         //    $column[] ='Country';
         // }
         // if($key1 == 'customers_telephone'){
         //    $column[] =' Phone Number';
         // }
         // if($key1 == 'date_purchased'){
         //    $column[] ='Date Purchased';
         // }

         // if($key1 == 'customers_authorization'){
         //    $column[] ='Approval';
         // }

         // if($key1 == 'order_total'){
         //    $column[] ='Total Purchased';
         // }

         

        }

        
       
    } 
     $i++;

}
// $column[] ='Dat Account Created';
// echo '<pre>';
// print_r($get_aks_all_customers);
// echo '</pre>';
// die();
header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=aks_products_cost_price_'.date('m-d-y').'.csv');  
$output = fopen("php://output", "w");  
fputcsv($output,$column); 
foreach ( $get_aks_all_customers as $value) {
    // if($value['customers_authorization'] == 0){
    //     $get_aks_customers_info_excel = get_aks_customers_info_excel($value['customers_id']);
    //     $value['date_account_created'] = $get_aks_customers_info_excel[0]['date_account_created'];
    //     $value['customers_authorization'] = 'Approved';
    //     fputcsv($output, $value);
    // }
    if($value['products_cost'] == $value['products_price']){
         fputcsv($output, $value);
    }
}
fclose($output); 
?>