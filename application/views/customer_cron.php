<?php //print_r($aks_customer);

foreach($aks_customer as $key_customer => $customer){
	echo $customer['customers_firstname'].' '.$customer['customers_lastname'].'<br>';
}

 ?>