<?php 
  $options['auth'] = 'tDpktmFrLHJRZIBCoyPUU68ba4gbnQRUhqdn6y9H'; 
  $cSession = curl_init(); 				
  curl_setopt($cSession,CURLOPT_URL,"https://autopro-75ac3.firebaseio.com/users.json?". http_build_query($options));
  curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
  curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "GET");						
  curl_setopt($cSession, CURLOPT_POSTFIELDS,''); 
  curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);	
  curl_setopt($cSession, CURLOPT_SSL_VERIFYPEER, false);							
  //step3
  $result_output = curl_exec($cSession);
  //step4
  curl_error($cSession);
  if($result_output == false){
	  //echo curl_error($cSession);
  }else{
	  //echo '<div class="alert alert-success">Data not  found</div>';
  }						
$outputs = json_decode($result_output, true);
//print_r($outputs);
if(count($outputs) > 0){
	foreach($outputs as $key => $users){
		
	}
}
?>