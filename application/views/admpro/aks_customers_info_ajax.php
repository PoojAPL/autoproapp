<?php 
    $get_Firebase_vehicles_year2 = get_aks_all_customers_count();
    $limit_end = $get_Firebase_vehicles_year2;
    $part = $_POST['part'];
    $limit = 500;       
    if (isset($part)) {  
        $pn  = $part;  
    }else {  
        $pn=1;  
    }; 
    $start_from = ($pn-1) * $limit;   
    $total_records = $limit_end; 
    $get_aks_all_customers = get_aks_all_customers($start_from, $limit);
    foreach ($get_aks_all_customers as $key => $value) {
        $User_UUID = $value['customers_id']; 
        $customers_firstname = $value['customers_firstname']; 
        $customers_lastname = $value['customers_lastname']; 
        $customers_email_address = $value['customers_email_address']; 
        $customers_password = $value['customers_password'];
        $customers_telephone = $value['customers_telephone'];
        $customers_referral ='';
        $customers_last_modified = '';
        $status = $value['customers_authorization'];
        $get_aks_customers_zip = get_aks_customers_zip($value['customers_id']);
        $entry_postcode = $get_aks_customers_zip[0]['entry_postcode'];
        $add_aks_custimers = add_aks_custimers_all($User_UUID, $customers_firstname, $customers_lastname, $customers_email_address, $customers_password, $customers_telephone,$customers_referral,$customers_last_modified,$status,$entry_postcode);     

    }
    echo $add_aks_custimers;
?>