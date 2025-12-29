<?php
$users_details = array(); 
if(count($results) > 0){
	foreach($results as $customers){
		$id = $customers['customers_id'];
		$User_UUID = $customers['customers_id'];
		$customers_firstname = $customers['customers_firstname'];
		$customers_lastname = $customers['customers_lastname'];
		$customers_email_address = $customers['customers_email_address'];
		$customers_telephone = $customers['customers_telephone'];
		$customers_password = $customers['customers_password'];
		$Status = "";
		$Company = "";
		$user_class = "";
		$user_score = "";
		$users_details[] = array('id'=> $id, 'customers_id' => $customers['customers_id'],'customers_firstname' => $customers_firstname,'customers_lastname' => $customers_lastname,'email'=> $customers_email_address, 'phone'=> $customers_telephone,'Status'=>'', 'Company'=> '', 'user_class' => '','user_score' => '', 'password' => $customers_password);
		$syc_custimers = syc_custimers($User_UUID, $customers_firstname, $customers_lastname, $customers_email_address, $customers_telephone, $customers_password);
	}
	echo json_encode($users_details);
}else{
	echo '';
}
?>