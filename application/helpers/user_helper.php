<?php
function admin_makeNameInfo($make_id){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Makes WHERE UUID = '$make_id' ");;       
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}


function admin_KeyNameInfo($key_id){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Key_Styles WHERE UUID = '$key_id' ");;       
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}


function get_tool_type($tool_Type_UUID){
   $ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Tool_Types WHERE UUID = '$tool_Type_UUID' ");;       
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}

function get_manufacturer($manufacturer_UUID){
	 $ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Manufacturers WHERE UUID = '$manufacturer_UUID' ");;       
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}

function get_tools_by_types($type_uuid){
   $ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Tools WHERE Tool_Type_UUID = '$type_uuid' ");;       
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}

function get_tools_by_manufacturer($type_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Tools WHERE Manufacturer_UUID = '$type_uuid' ");;       
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}

function get_key_type($uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Key_Types WHERE UUID = '$uuid' ");      
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}

function get_chips($uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Chips WHERE UUID = '$uuid' ");      
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}

function get_batteries($uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Batteries WHERE UUID = '$uuid' ");      
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}


function get_remote_types($uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Remote_Types WHERE UUID = '$uuid' ");      
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}


function get_tools_determinater( $value) {	
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Manufacturers WHERE Manufacturer_Name = '$value' ORDER BY Manufacturer_Name");   
      
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   $manu_uuid =  $result[0]['UUID'];
	   $query2 = $ci->db->query("SELECT * FROM t_Tools WHERE Manufacturer_UUID = '$manu_uuid' ORDER BY Tool_Name"); 
	   return $query2->result_array();
   }else{
	   return false;
   }
}

function get_tools_type_tools( $value) {	
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Tool_Types WHERE Tool_Type_Name = '$value' ORDER BY Tool_Type_Name");   
      
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   $manu_uuid =  $result[0]['UUID'];
	   $query2 = $ci->db->query("SELECT * FROM t_Tools WHERE Tool_Type_UUID = '$manu_uuid' ORDER BY Tool_Name"); 
	   return $query2->result_array();
   }else{
	   return false;
   }
}


function get_tools_determinater2($manu_fact , $tool_type){
   $ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database
   $query = $ci->db->query("SELECT * FROM t_Manufacturers WHERE Manufacturer_Name = '$manu_fact' ORDER BY Manufacturer_Name"); 
   
   $query2 = $ci->db->query("SELECT * FROM t_Tool_Types WHERE Tool_Type_Name = '$tool_type' ORDER BY Tool_Type_Name");    
   if($query->num_rows() > 0){
	   $result = $query->result_array();	   
	   $manu_uuid =  $result[0]['UUID'];
	   
	   $result2 = $query2->result_array();
	   $tool_type_uuid =  $result2[0]['UUID'];
	   $query2 = $ci->db->query("SELECT * FROM t_Tools WHERE Manufacturer_UUID = '$manu_uuid' AND Tool_Type_UUID = '$tool_type_uuid' ORDER BY Tool_Name"); 
	   return $query2->result_array();
   }else{
	   return false;
   }
}


function get_manufactyrer_by_uuid( $value_uuid ){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	 $query = $ci->db->query("SELECT * FROM t_Tools WHERE UUID = '$value_uuid'");
   if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_toolType_by_uuid($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Tool_Types WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}


function get_toolName_by_uuid($value_uuid){
	$ci =& get_instance();       
   //load databse library
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Tools WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}
function get_machanical_keys($value){
	$ci =& get_instance();       
  	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Key_Types WHERE Key_Type_Name = '$value'");
	
	if($query->num_rows() > 0){
	 $result =  $query->result_array();
	 $value_uuid =  $result[0]['UUID'];
	 $query2 = $ci->db->query("SELECT * FROM t_Keys WHERE Key_Type_UUID = '$value_uuid'  ORDER BY Key_Name"); 
	 return $query2->result_array();
  	}else{
	   return false;
    }
}

function get_machanical_test_keys($value1, $value2){
	$ci =& get_instance();       
  	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Key_Types WHERE Key_Type_Name = '$value1' OR Key_Type_Name = '$value2' ");	
	if($query->num_rows() > 0){
	 $result =  $query->result_array();
	 $value_uuid =  $result[0]['UUID'];
	 $query2 = $ci->db->query("SELECT * FROM t_Keys WHERE Key_Type_UUID = '$value_uuid'  ORDER BY Key_Name"); 
	 return $query2->result_array();
  	}else{
	   return false;
    }
}

function get_machanical_keys2($value1, $value2){
	$ci =& get_instance();       
  	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Key_Types WHERE Key_Type_Name = '$value1' OR Key_Type_Name = '$value2' ");	
	if($query->num_rows() > 0){
	 $result =  $query->result_array();
	 $value_uuid =  $result[0]['UUID'];
	 $query2 = $ci->db->query("SELECT * FROM t_Keys WHERE Key_Type_UUID = '$value_uuid'  ORDER BY Key_Name"); 
	 return $query2->result_array();
  	}else{
	   return false;
    }
}

function get_remotes($value){
	$ci =& get_instance();       
  	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Remote_Types WHERE Remote_Type_Name = '$value'");	
	if($query->num_rows() > 0){
	 $result =  $query->result_array();
	 $value_uuid =  $result[0]['UUID'];
	 $query2 = $ci->db->query("SELECT * FROM t_Remotes WHERE Remote_Type_UUID = '$value_uuid' ORDER BY Remote_Name"); 
	 return $query2->result_array();
  	}else{
	   return false;
    }
}

function get_programmer_tools($value){
	$ci =& get_instance();       
  	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Tool_Types WHERE Tool_Type_Name = '$value'");
	
	if($query->num_rows() > 0){
	 $result =  $query->result_array();
	 $value_uuid =  $result[0]['UUID'];
	 $query2 = $ci->db->query("SELECT * FROM t_Tools WHERE Tool_Type_UUID = '$value_uuid' ORDER BY Tool_Name "); 
	 return $query2->result_array();
  	}else{
	   return false;
    }
}

function get_manufacure_tools($value){
	$ci =& get_instance();       
  	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Manufacturers WHERE Manufacturer_Name = '$value'");
	
	if($query->num_rows() > 0){
	 $result =  $query->result_array();
	 $value_uuid =  $result[0]['UUID'];
	 $query2 = $ci->db->query("SELECT * FROM t_Tools WHERE Manufacturer_UUID = '$value_uuid' "); 
	 return $query2->result_array();
  	}else{
	   return false;
    }
}

function get_models_name($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Models WHERE UUID = '$value_uuid' ORDER BY Model_Name");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_firebase_makes($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Makes WHERE UUID = '$value_uuid' ORDER BY Make_Name");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}



function get_Code_Series_name($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Code_Series WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_firebase_Code_Series_name($value_uuid){
	$ci =& get_instance();       
   //load databse library
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Code_Series WHERE UUID = '$value_uuid' AND HPC_Blitz_Card IS NOT NULL");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_Retainer_name($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Retainers WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}
function get_key_name($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Keys WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_key_name_chips($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Keys WHERE Chip_UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_remote_name($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Remotes WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_tool_name($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Tools WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_make_name($value_uuid){
	$ci =& get_instance();       
   //load databse library
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Models WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
		 $result =  $query->result_array();
		 $value_uuid2 =  $result[0]['Make_UUID'];
		 $query2 = $ci->db->query("SELECT * FROM t_Makes WHERE UUID = '$value_uuid2' ORDER BY Make_Name"); 
		 return $query2->result_array();	
  	}else{
	   return false;
    }
}

function get_model_makes($makes_uuid){
	$ci =& get_instance();       
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Models WHERE Make_UUID = '$makes_uuid' ORDER BY Model_Name");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}


function get_t_machines_info($value_uuid){
	$ci =& get_instance();       
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Machines_Info_Types WHERE Machines_Info_Type_Name = '$value_uuid'");
	if($query->num_rows() > 0){
		 $result =  $query->result_array();
		 $value_uuid2 =  $result[0]['UUID'];
		 $query2 = $ci->db->query("SELECT * FROM t_Machines_Info WHERE Type = '$value_uuid2' ORDER BY Name "); 
		 return $query2->result_array();	
  	}else{
	   return false;
    }
}

function get_t_machines_info2($value_uuid){
	$ci =& get_instance();       
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Machines_Info_Types WHERE Machines_Info_Type_Name = '$value_uuid'");
	if($query->num_rows() > 0){
		 return $query->result_array();	
  	}else{
	   return false;
    }
}



function get_machines_info($value_uuid){
	$ci =& get_instance();       
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Machines_Info WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}


function get_buttons(){
	$ci =& get_instance();       
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Buttons");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_Frequency(){
	$ci =& get_instance();       
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Frequencies ORDER BY Name");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_frequency_info($val_uuid){
	$ci =& get_instance();       
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Frequencies WHERE UUID = '$val_uuid' ");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_buttons_info($val_uuid){
	$ci =& get_instance();       
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Buttons WHERE UUID = '$val_uuid' ");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}
function get_remote_shell_name($value_uuid){
	$ci =& get_instance();       
   //load databse library
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Remotes WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function get_remote_shell_keys($remote_shell){
	$ci =& get_instance();       
  	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Remotes WHERE UUID = '$remote_shell'");	
	if($query->num_rows() > 0){
	 $result =  $query->result_array();
	 $value_uuid =  $result[0]['Remote_Type_UUID'];
	 $query2 = $ci->db->query("SELECT * FROM t_Remotes WHERE Remote_Type_UUID = '$value_uuid' ORDER BY Remote_Name"); 
	 return $query2->result_array();
  	}else{
	   return false;
    }
}

function get_remote_shell_keys_info($remote_shell){
	$ci =& get_instance();       
  	$ci->load->database(); 
	$query2 = $ci->db->query("SELECT * FROM t_Remotes WHERE Remote_Type_UUID = '$remote_shell' ORDER BY Remote_Name"); 
	if($query2->num_rows() > 0){ 
	 return $query2->result_array();
  	}else{
	   return false;
    }
}

function get_mchine_type_info($value_uuid){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Machines_Info_Types WHERE UUID = '$value_uuid'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_key_type_by_key($key_uuid){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Keys WHERE UUID = '$key_uuid'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_substitute_keys($Key_Type_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Keys WHERE Key_Type_UUID = '$Key_Type_UUID' ORDER BY Key_Name");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_image_type( $image_Type_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Image_Types WHERE UUID = '$image_Type_UUID'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_obp_category($category_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_OBP_Option_Categories WHERE UUID = '$category_UUID'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_image($default_Image_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Images WHERE UUID = '$default_Image_UUID'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_vehicles($vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicles WHERE UUID = '$vehicle_UUID'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}
function get_vehicles_by_id($vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicles WHERE id = '$vehicle_UUID'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_distinct_vehicles(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT DISTINCT Vehicle_UUID FROM t_OBP_Remotes");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_obp_remotes($distinct_vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_OBP_Remotes WHERE Vehicle_UUID = '$distinct_vehicle_UUID'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_obp_remotes1($distinct_vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_OBP_Remotes WHERE unique_id = '$distinct_vehicle_UUID' AND Procedure_Number=1");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_obp_remotes2($distinct_vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_OBP_Remotes WHERE unique_id = '$distinct_vehicle_UUID' AND Procedure_Number=2");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_model_makes_vehicles($vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicles WHERE UUID = '$vehicle_UUID'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_Category($image_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_OBP_Options WHERE Default_Image_UUID = '$image_UUID'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_obp_ptions_selection($category_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_OBP_Options WHERE Category_UUID = '$category_UUID'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}
/*-------------------------------- Update data to firebase --------------------------------------------*/

function get_models($make_uuid){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Models WHERE Make_UUID = '$make_uuid'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}


function get_vehicles_year($model_uuid){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicles WHERE Model_UUID = '$model_uuid'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function get_Firebase_vehicles_year(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicles");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_Firebase_vehicles_year2(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicles ORDER BY id");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_Firebase_vehicles_count(){
	// $ci =& get_instance();
	// $ci->load->database(); 
	// $query = $ci->db->query("SELECT * FROM t_Vehicles ORDER BY id");
	// if($query->num_rows() > 0){
	//  	return $query->num_rows();
  	// }else{
	//    return false;
    // }
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT t_Vehicles.id FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID   ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
	if($query->num_rows() > 0){
	 	return $query->num_rows();
  	}else{
	   return false;
    }
}

function get_Firebase_vehicles_year_vehicleInfo1($start_from, $limit){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID   ORDER BY t_Makes.Make_Name,t_Models.Model_Name LIMIT $start_from, $limit");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_Firebase_vehicles_year_vehicleInfo2($limit_start,$limit_end){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT t_Makes.Make_Name,t_Vehicles.UUID,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Model_UUID,t_Vehicles.Years,t_Vehicles.Code_Series_UUID,t_Vehicles.Retainer_UUID,t_Vehicles.Mechanical_Key_UUID,t_Vehicles.Chip_Key_UUID,t_Vehicles.Remote_UUID,t_Vehicles.RHK_UUID,t_Vehicles.SmartKey_UUID,t_Vehicles.MVP_System,t_Vehicles.MVP_Dongle_UUID,t_Vehicles.MVP_SmartCard,t_Vehicles.MVP_Software,t_Vehicles.MVP_PIN_Required,t_Vehicles.MVP_PIN_Read,t_Vehicles.ProLok_Tool_UUID,t_Vehicles.ProLok_Linkage,t_Vehicles.Vehicle_Image,t_Vehicles.Image_UUID,t_Vehicles.MVP_Notes,t_Vehicles.APP_System,t_Vehicles.APP_Add_Keys,t_Vehicles.APP_All_Keys_Lost,t_Vehicles.APP_Notes,t_Vehicles.HW_Key_Prog,t_Vehicles.HW_Remote_Prog,t_Vehicles.HW_Misc_Prog,t_Vehicles.TKOSDD_System,t_Vehicles.TKOSDD_SDD_Adapter,t_Vehicles.TKOSDD_SDD_Cable,t_Vehicles.TKOSDD_TKO_Cable,t_Vehicles.TKOSDD_Notes,t_Vehicles.APP_Confirmed_Working,t_Vehicles.DMax_System,t_Vehicles.DMax_Method,t_Vehicles.Parts_Ignition,t_Vehicles.Parts_Door,t_Vehicles.Parts_Accessories,t_Vehicles.Vehicle_Type,t_Vehicles.Tumblers,t_Vehicles.OBD_Location_Text,t_Vehicles.OBD_Location_Image FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID ORDER BY t_Makes.Make_Name,t_Models.Model_Name LIMIT $limit_start, $limit_end");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_all_vehicles(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicles");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_part_type_info($PartType_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Lock_Types WHERE UUID = '$PartType_UUID' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}


function get_aks_users(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Users ORDER BY FirstName");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}


function get_users_info($value_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Users WHERE User_UUID = '$value_UUID' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function users_type(){
	return array('Administrator','American Key Supply','AutoProAPP Moderator','KeyLogic','Laser Key Products','LogiKey','WH Software','XTool');
	//return array('Admin','Mediator','Expert','Contributor','Newbie','Override Expert','Override Contributor');
}

function feedback_type(){
	return array('images','tip_tricks','corrections','keymaking');
}

function correction_status(){
	return array('Waiting for Review' => 'pending','Approved' => 'approved','Rejected' => 'rejected');
}


function get_sks_user_info($User_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Users WHERE User_UUID = '$User_UUID' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function delete_app_corrections(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("DELETE FROM t_Corrections WHERE feed_from = 'App' ");
	if($query){
	 	return true;
  	}else{
	   return false;
    }
}

function save_app_corrections($UUID,$User_Email,$User_Name,$User_Type,$Vehicle_UUID,$Feedback_type,$Status,$User_Review,$full_path,$User_UUID,$vehcile_info,$Title,$other_vehicle,$content,$key,$date,$category,$video,$year_range){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Corrections WHERE UUID = '$UUID' ");
	if($query->num_rows() > 0){
	 	$data = array(				
			'User_Email' => $User_Email,	
			'User_Name' => $User_Name,
			'User_Type' => $User_Type,
			'vehicle' => $Vehicle_UUID,
			'Feedback_type' => $Feedback_type,
			'Status' => $Status,
			'User_Review' => $User_Review, 
			'Images' => $full_path,
			'feed_from' => 'App',
			'User_UUID' => $User_UUID,
			'Info' => $vehcile_info,
			'title' => $Title,
			'other_vehicle' => $other_vehicle,
			'content' => $content,
			'Vehicle_UUID'=>$key,
			'Dated' => $date,
			'category' => $category,
			'video' => $video,
			'year_range' => $year_range
		);
		$ci->db->where('UUID', $UUID);
		$ci->db->update('t_Corrections', $data);
  	}else{
		 $data = array(
			'UUID' => $UUID,							
			'User_Email' => $User_Email,	
			'User_Name' => $User_Name,
			'User_Type' => $User_Type,
			'vehicle' => $Vehicle_UUID,
			'Feedback_type' => $Feedback_type,
			'Status' => $Status,
			'User_Review' => $User_Review, 
			'Images' => $full_path,
			'feed_from' => 'App',
			'User_UUID' => $User_UUID,
			'Info' => $vehcile_info,
			'title' => $Title,
			'other_vehicle' => $other_vehicle,
			'content' => $content,
			'Vehicle_UUID'=>$key,
			'Dated' => $date,
			'category' => $category,
			'video' => $video,
			'year_range' => $year_range
		);
		$return_res = $ci->db->insert('t_Corrections', $data);
		if($return_res){
			return 1;
		}else{
			return 0;
		}
    }
	
}

function save_app_corrections2($UUID,$User_Email,$User_Name,$User_Type,$Feedback_type,$Status,$User_UUID,$likes,$dislikes,$info, $full_path1,$Title,$other_vehicle,$content,$key,$Vehicle_UUID,$date,$category,$video,$year_range){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Corrections WHERE UUID = '$UUID' ");
	if($query->num_rows() > 0){
	 	$data = array(
			'User_Email' => $User_Email,	
			'User_Name' => $User_Name,
			'User_Type' => $User_Type,			
			'Feedback_type' => $Feedback_type,
			'Status' => $Status,			
			'Images' => $full_path1,
			'feed_from' => 'App',
			'User_UUID' => $User_UUID,
			'Info' => $info,
			'likes' => $likes,
			'dislikes' => $dislikes,
			'title' => $Title,
			'other_vehicle' => $other_vehicle,
			'content' => $content,
			'vehicle' => $Vehicle_UUID,
			'Vehicle_UUID'=>$key,
			'Dated' => $date,
			'category' => $category,
			'video' => $video,
			'year_range' => $year_range
		);
		$ci->db->where('UUID', $UUID);
		$ci->db->update('t_Corrections', $data);
  	}else{
		 $data = array(
			'UUID' => $UUID,							
			'User_Email' => $User_Email,	
			'User_Name' => $User_Name,
			'User_Type' => $User_Type,			
			'Feedback_type' => $Feedback_type,
			'Status' => $Status,			
			'Images' => $full_path1,
			'feed_from' => 'App',
			'User_UUID' => $User_UUID,
			'Info' => $info,
			'likes' => $likes,
			'dislikes' => $dislikes,
			'title' => $Title,
			'other_vehicle' => $other_vehicle,
			'content' => $content,
			'vehicle' => $Vehicle_UUID,
			'Vehicle_UUID'=>$key,
			'Dated' => $date,
			'category' => $category,
			'video' => $video,
			'year_range' => $year_range
		);
		$return_res = $ci->db->insert('t_Corrections', $data);
		if($return_res){
			return 1;
		}else{
			return 0;
		}
    }
	
}

function save_vehicle_images($UUID,$VehicleID,$Image_path,$Title,$Status,$CorrectionID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM vehicle_images WHERE UUID = '$UUID' ");
	if($query->num_rows() > 0){
	 	$data = array(				
			'Status' => $Status
		);
		$ci->db->where('UUID', $UUID);
		$ci->db->update('vehicle_images', $data);
  	}else{
		 $data = array(
			'UUID' => $UUID,							
			'VehicleID' => $VehicleID,	
			'Image_path' => $Image_path,
			'Title' => $Title,			
			'Status' => $Status,
			'CorrectionID' => $CorrectionID
		);
		$return_res = $ci->db->insert('vehicle_images', $data);
		if($return_res){
			return 1;
		}else{
			return 0;
		}
    }
}


function get_correctionId($vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Corrections WHERE Vehicle_UUID = '$vehicle_UUID' GROUP BY UUID ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function  get_admin_deatils($email){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM add_user WHERE email = '$email' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function secondsToTime($seconds) {
  $dtF = new DateTime("@0");
  $dtT = new DateTime("@$seconds");
  $days = $dtF->diff($dtT)->format('%a days');
  if($days > 2){
	  return $dtF->diff($dtT)->format('%adays ago');
  }else if($days > 1){
	  return $dtF->diff($dtT)->format('%adays, %hhours ago');
  }else if($days == 1 ){
	  return $dtF->diff($dtT)->format('%aday, %hhours ago');
  }else{
	  return $dtF->diff($dtT)->format('%hhours ago');
  }  
}

function gen_uuid() {
    return md5(uniqid(mt_rand(), true));
}

function get_all_makes_models($make_uuid){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Models WHERE Make_UUID = '$make_uuid' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_Firebase_vehicles_models($make_id){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Models WHERE Make_UUID = '$make_uuid' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_make_and_models(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT t_Vehicles.Chip_Key_UUID,t_Vehicles.UUID,t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Years,t_Vehicles.Mechanical_Key_UUID FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID   ORDER BY t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.Years");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_10_mint_bypass($vehicle_id){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicles WHERE id = '$vehicle_id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function syc_custimers($User_UUID, $customers_firstname, $customers_lastname, $customers_email_address, $customers_telephone, $customers_password){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Users WHERE User_UUID = '$User_UUID' ");
	if($query->num_rows() > 0){
	 	return 0;
	}else{
		$data = array(
			'User_UUID' => $User_UUID,							
			'FirstName' => $customers_firstname,	
			'LastName' => $customers_lastname,
			'PhoneNumber' => $customers_telephone,
			'Email' => $customers_email_address,
			'Password' => $customers_password,
			'customer' => 1
		);
		$return_res = $ci->db->insert('t_Users', $data);
		if($return_res){
			return 1;
		}else{
			return 0;
		}
	}
}

function get_purchase_emails(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Machine_Purchases WHERE Status = 'OK' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}


function add_aks_custimers($User_UUID, $customers_firstname, $customers_lastname, $customers_email_address, $customers_password, $customers_telephone,$customers_referral,$customers_last_modified){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Users WHERE User_UUID = '$User_UUID' ");
	if($query->num_rows() > 0){
	 	return 0;
	}else{
		$data = array(
			'User_UUID' => $User_UUID,							
			'FirstName' => $customers_firstname,	
			'LastName' => $customers_lastname,
			'PhoneNumber' => $customers_telephone,
			'Email' => $customers_email_address,
			'Password' => $customers_password,
			'Referral' => $customers_referral,
			'customer' => 1
		);
		$return_res = $ci->db->insert('t_Users', $data);
		if($return_res){
			return 1;
		}else{
			return 0;
		}
	}
}

function add_aks_custimers_all($User_UUID, $customers_firstname, $customers_lastname, $customers_email_address, $customers_password, $customers_telephone,$customers_referral,$customers_last_modified,$status,$entry_postcode){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Users WHERE User_UUID = '$User_UUID' ");
	if($query->num_rows() > 0){
	 	$data = array(							
			'FirstName' => $customers_firstname,	
			'LastName' => $customers_lastname,
			'PhoneNumber' => $customers_telephone,
			'Email' => $customers_email_address,
			'Password' => $customers_password,
			'Referral' => $customers_referral,
			'customer' => 1,
			'Status'=>$status,
			'zipcode' =>$entry_postcode
		);	
		$ci->db->where('User_UUID', $User_UUID);
		$ci->db->update('t_Users', $data);
	}else{
		$data = array(
			'User_UUID' => $User_UUID,							
			'FirstName' => $customers_firstname,	
			'LastName' => $customers_lastname,
			'PhoneNumber' => $customers_telephone,
			'Email' => $customers_email_address,
			'Password' => $customers_password,
			'Referral' => $customers_referral,
			'customer' => 1,
			'Status'=>$status,
			'zipcode' =>$entry_postcode
		);
		$return_res = $ci->db->insert('t_Users', $data);
		if($return_res){
			return $User_UUID;
		}else{
			return 0;
		}
	}
	return $User_UUID;
}


function get_support_paid_amt($dataId){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Machine_Purchases WHERE id = '$dataId' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }	
}

/*function update_v_types(){
	$ci =& get_instance();
	$ci->load->database(); 
	$data = array(				
		'Vehicle_Type' => 'Car'
	);
	$ci->db->update('t_Vehicles', $data);
}*/

/*function insert_v_types($product){
    $ci =& get_instance();
	$ci->load->database(); 
	$data = array(				
		'machine' => $product
	);
	$return_res = $ci->db->insert('purchases_machine', $data);
}*/

function vehicle_type_array(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicle_Types");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }	
}

function get_distinct_obp_vehicles(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT DISTINCT unique_id FROM t_OBP_Remotes");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_obp_obp_vehicles($unique_id){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_OBP_Remotes WHERE unique_id = '$unique_id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}
/*--------- new function------*/
function getModeluuid($model_uuid){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Models WHERE UUID = '$model_uuid' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function vehicle_Type_UUID_info($v_type_uuid){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Vehicle_Types WHERE UUID = '$v_type_uuid' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_purchase_machines(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM purchases_machine ORDER BY machine");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_Firebase_vehicles_parts(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT id,Parts_Ignition FROM t_Vehicles WHERE Parts_Ignition IS NOT NULL ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }	
}

function get_Aks_vehicles_products($products_id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT * FROM products WHERE products_id = '$products_id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }	
}

function get_Aks_vehicles_products_info($products_id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT pd.products_name,p.products_price FROM products_description pd JOIN products p ON p.products_id = pd.products_id WHERE p.products_id = '$products_id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

function get_Aks_vehicles_products_info2($mach_Products){
	if($mach_Products == ""){
		return 0;
	}else{
		$ci =& get_instance();
		$ci->admin_db = $ci->load->database('dev_db', true);
		$query = $ci->admin_db->query("SELECT * FROM products WHERE products_id IN ($mach_Products)");
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
		   return $query->num_rows();
		}
	}
}

function get_Aks_vehicles_products_least_price($mach_Products){
	if($mach_Products == ""){
		return 0;
	}else{
		$mach_Products = str_replace(', ',',',$mach_Products);
		$mach_Products = str_replace(',,',',',$mach_Products);
		$mach_Products = str_replace(',,,',',',$mach_Products);
		$mach_Products = str_replace(',,,,',',',$mach_Products);
		$mach_Products = str_replace(',,,,,',',',$mach_Products);
		$mach_Products = str_replace(',,,,,',',',$mach_Products);
		$mach_Products = str_replace('.',',',$mach_Products);
		$mach_Products = str_replace('. ',',',$mach_Products);
		$mach_Products = ltrim($mach_Products,',');
		$mach_Products = rtrim($mach_Products,',');
		$ci =& get_instance();
		$ci->admin_db = $ci->load->database('dev_db', true);
		$query = $ci->admin_db->query("SELECT MIN(products_price),products_image FROM products WHERE products_id IN ($mach_Products)");
		//'select products_price, products_image,products_id from products WHERE products_price = ( select min(products_price)from products where products_id IN(1,2,3) )';
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
		   return $query->num_rows();
		}
	}
}

function get_Aks_vehicles_products_des($products_id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT * FROM products_description WHERE products_id = '$products_id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

function get_products_manufacture($manufacturers_id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT * FROM manufacturers WHERE manufacturers_id = '$manufacturers_id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

function get_years_id($models_id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT vehicles_id,vehicles_description FROM vehicles WHERE vehicles_parent='$models_id'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

function  get_Key_Shell_UUID($Key_Shell_UUID){
	$ci =& get_instance();       
   //load databse library
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Keys WHERE Key_Shell_UUID = '$Key_Shell_UUID'");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function  get_Key_Shell_UUID2($Key_Shell_UUID, $key_uuid){
	$ci =& get_instance();       
   //load databse library
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Keys WHERE Key_Shell_UUID = '$Key_Shell_UUID' AND UUID = '$key_uuid' ");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}

function application_testing(){
	return  array('Tested','Worked','Same Protocol Worked','Issues');
}

function get_clonabnle_chips(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Chips WHERE Clonable = '1' ORDER BY Chip_Name");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_clonabnle_tools(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Tools WHERE Tool_Type_UUID = '628cfeab-a8a0-11e7-b079-525400df8778' ORDER BY Tool_Name");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_vehicles_remotes($vehciles_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Remotes WHERE Vehicles_UUID LIKE '%$vehciles_UUID%'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function get_NissanBCM5(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_NissanBCM5");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function get_lock_types(){
	return array('Automotive/Motorcycle', 'Mailbox', 'Combination', 'Flat Steel', 'Locker', 'Office/Other' );
}

function get_bcm_data(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM TABLE45");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }	
}

function update_bcm_data($bcm,$PIN_Old,$PIN_New){
	$ci =& get_instance();
	$ci->load->database();
	 $data = array(
			'BCM' => $bcm,							
			'PIN_Old' => $PIN_Old,	
			'PIN_New' => $PIN_New
		);
		$return_res = $ci->db->insert('t_NissanBCM5_test', $data);
}


function add_user_feedback($uuid,$email,$feedback,$firstName,$lastName,$subject,$imageURL,$status,$userid){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Feedback WHERE UUID = '$uuid' ");
	if($query->num_rows() > 0){
	 	$data = array(
			'User_Email' => str_replace('-','',$email),	
			'User_Name' => $firstName.' '.$lastName,
			'feedback' => $feedback,			
			'subject' => $subject,
			'imageURL' => $imageURL,
			'status' => $status,
			'userid' => $userid
		);
		$ci->db->where('UUID', $uuid);
		$ci->db->update('t_Feedback', $data);
  	}else{
		 $data = array(
			'UUID' => $uuid,							
			'User_Email' => str_replace('-','',$email),	
			'User_Name' => $firstName.' '.$lastName,
			'feedback' => $feedback,			
			'subject' => $subject,
			'imageURL' => $imageURL,			
			'dated' => date('Y-m-d'),
			'status' => $status,
			'userid' => $userid
		);
		$return_res = $ci->db->insert('t_Feedback', $data);
		if($return_res){
			return 1;
		}else{
			return 0;
		}
    }
}

function get_user_feedbacks(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->select("*")->order_by('id','desc')->get('t_Feedback');
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }	
}

function get_feedback_type(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT DISTINCT Feedback_type FROM t_Corrections WHERE deleted='0'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }		
}

function get_ezpages_Manufacturer(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT DISTINCT Manufacturer_UUID FROM t_EZ_Pages");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }		
}

function get_user_submission_feedback($us_id){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Corrections WHERE deleted='0' AND id = '$us_id' GROUP BY UUID");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }	
}

function get_key_making_method($vehciles_id){
	$vehciles_id2 = $vehciles_id;
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Methods WHERE Vehicle_UUID LIKE '%$vehciles_id2%' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }	
}

function get_tip_trips_method($vehciles_id){
	$vehciles_id2 = $vehciles_id;
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Tips WHERE Vehicle_UUID LIKE '%$vehciles_id2%' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }	
}

function get_aks_all_customers_count(){
	$ci =& get_instance();
	$ci->load->database(); 
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT customers_id FROM customers ORDER BY customers_id");
	if($query->num_rows() > 0){
	 	return $query->num_rows();
  	}else{
	   return false;
    }
}

function get_aks_all_customers($start_from, $limit){
	$ci =& get_instance();
	$ci->load->database(); 
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT customers_id,customers_firstname,customers_lastname,customers_email_address,customers_telephone,customers_password,customers_authorization FROM customers WHERE 1 ORDER BY customers_id LIMIT $start_from, $limit");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

function get_aks_users_info2($user_id){
	$ci =& get_instance();
	$ci->load->database();
	$ci->admin_db = $ci->load->database('dev_db', true); 
	$query = $ci->admin_db->query("SELECT customers_firstname,customers_lastname,customers_email_address,customers_telephone FROM customers WHERE customers_id='$user_id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function get_aks_customers_zip($customers_id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT entry_postcode FROM address_book WHERE customers_id = '$customers_id'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

function get_aks_customers_orders($id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT * FROM orders WHERE customers_id='$id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

function get_users_feedback_count(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Feedback WHERE status='pending'");
	return $query->num_rows();
}
function get_users_contribution_count(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT DISTINCT UUID FROM t_Corrections WHERE deleted='0' AND Status='pending'");
	return $query->num_rows();
}

function get_vehicles_images($vehciles_id){
	$vehciles_id2 = $vehciles_id;
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM vehicle_images WHERE vehicles LIKE '%$vehciles_id2%' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function get_all_aks_users(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT Email,User_UUID FROM t_Users ORDER BY Email ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }	
}

function get_aks_users_info($user_id){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Users WHERE User_UUID='$user_id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function announcements_type(){
	return array('View Once Per User','View With Version Update','Show Every Time to Every User');
}

function announcements_status($id){
	$ci =& get_instance();
	$ci->load->database(); 
	$data = array(
			'Active' => 'No'
	);
	$ci->db->where('id', $id);
	$ci->db->update('t_Announcements', $data);
}

function get_assigned_users($id){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT type FROM add_user WHERE type='$id' ");
	if($query->num_rows() > 0){
	 	return $query->num_rows();
  	}else{
	   return 0;
    }
}
function admin_users_count(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT type FROM add_user");
	return $query->num_rows();
}
function user_access(){
	return array('View User Info'=>'userInfo','Edit User Info'=>'editUsers');
}

function content_access(){
	return array('Moderate User Feedback'=>'moderateUserFeedback','Moderate User Contributions'=>'moderateUserContribution','Manage Vehicle Data'=>'vehicleData');
}

function keyCodes_access(){
	return array('Key Codes'=>'keyCodes');
}

function admin_access(){
	return array('Manage Announcements'=>'announcements','Manage Home Screen Menus'=>'homeScreenMenu','Manage Firebase Updates'=>'firebaseUpdates','Manage Admin Access'=>'adminAccess');
}

function other_access(){
	return array('Manage Machine Reports'=>'machineReports','Manage AutoProPAD'=>'autoProPAD','View Machine Purchases'=>'viewMachinePurchase','Manage Machine Purchases'=>'manageMachinePurchase');
}

function get_type_access($user_type){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_User_Types WHERE id='$user_type' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function aks_orders_total($id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT * FROM orders_total WHERE orders_id='$id' AND title='Total:' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

function data_contribution($id){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Corrections WHERE User_Email='$id' GROUP BY UUID");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }	
}

function getActiveCustomers(){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$customers2 = $ci->admin_db->query("select c.customers_id, c.customers_gender, c.customers_firstname, c.customers_tax_exempt,
                                          c.customers_lastname, c.customers_dob, c.customers_email_address, customers_openend_credit,
                                          c.customers_secret_status, c.customers_company_specific_products,
                                          a.entry_company, a.entry_street_address, a.entry_suburb,
                                          a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id,
                                          a.entry_country_id, c.customers_telephone, c.customers_fax,
                                          c.customers_newsletter, c.customers_default_address_id,
                                          c.customers_email_format, c.customers_group_pricing,
                                          c.customers_authorization, c.customers_referral,
                                          cei.customers_story,
                                          c.customers_ip
                                  from customers c left join 	address_book a
                                  on c.customers_default_address_id = a.address_book_id
                                  left join customers_extra_info cei on (c.customers_id = cei.customers_id)
                                  where a.customers_id = c.customers_id");
      return $customers2->result_array();
}

function get_aks_customers_excel(){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$interval_in_days = 730;   
    $time_interval = 'AND o.date_purchased > DATE_ADD(NOW(), INTERVAL -' . $interval_in_days. ' DAY)';  
	$customers2 = $ci->admin_db->query("SELECT c.customers_id, c.customers_firstname, c.customers_lastname,
	o.customers_company,o.customers_street_address,o.customers_suburb,o.customers_city,o.customers_state,
	o.customers_postcode,o.customers_country,o.customers_telephone,o.date_purchased,c.customers_authorization,
	 sum(ot.value) as order_total from customers c, orders_total ot, orders o where c.customers_id = o.customers_id and (o.orders_id = ot.orders_id and ot.class = 'ot_total') ".$time_interval." group by c.customers_firstname, c.customers_lastname");
	return $customers2->result_array();
}


function get_aks_customers_info_excel($customers_id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$sql = "select customers_info_date_account_created as date_account_created
                            from customers_info
                            where customers_info_id = '" . $customers_id. "'";
      $info =$ci->admin_db->query($sql);
      return $info->result_array();
} 

function add_success_rating($uuid,$comment,$programmer,$result,$time,$userID,$userName,$vehicleID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Success_Reporting WHERE UUID = '$uuid' ");
	if($query->num_rows() > 0){
	 	$data = array(
			'Date' => $time,	
			'User' => $userName,			
			'Machine' => $programmer,
			'Vehicle' => $vehicleID,
			'userid' => $userID,
			'Result' => $result,
		);
		$ci->db->where('UUID', $uuid);
		$ci->db->update('t_Success_Reporting', $data);
  	}else{
  		if($programmer == ""){
  		}else{
			 $data = array(
				'UUID' => $uuid,							
				'Date' => $time,	
				'User' => $userName,			
				'Machine' => $programmer,
				'Vehicle' => $vehicleID,
				'Result' => $result,
				'userid' => $userID,
				'Comment' => $comment
			);
			$return_res = $ci->db->insert('t_Success_Reporting', $data);
			if($return_res){
				return 1;
			}else{
				return 0;
			}
		}
    }
}

function get_success_rating_machine(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT DISTINCT Machine FROM t_Success_Reporting ORDER BY Machine ");
	if($query->num_rows() > 0){
		return $query->result_array();
	}else{

	}	
}

function get_success_rating($machine,$vehciles_id){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Success_Reporting WHERE Machine='$machine' AND Vehicle='$vehciles_id' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function get_ls_vehicle($vehicle){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT m.Make_Name,d.Model_Name,p.Veh_Year_Start, p.Veh_Year_End, p.Auto_Num FROM cs_ls_pricing as p, cs_vehicle_makes as m, cs_vehicle_models as d where p.Key_Grid='$vehicle' and p.Veh_Make=m.Make_ID and p.Veh_Model=d.Model_ID ORDER BY p.Veh_Year_Start LIMIT 500");
	if($query->num_rows() > 0){
	 	$get_vehicle = $query->result_array();
	 	foreach ($get_vehicle as $key1 => $value1) {
            $vehicle_array[] =  array('vehicele_list' => $value1['Make_Name'].' '.$value1['Model_Name'].' '.$value1['Veh_Year_Start']);
        } 
        return $vehicle_array;                    
  	}else{
	   return 0;
    }
}

function ls_veh_make_name($Veh_Make){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT DISTINCT Make_Name FROM cs_vehicle_makes WHERE Make_ID = '$Veh_Make'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function ls_veh_model_name($Veh_Make){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT DISTINCT Model_Name FROM cs_vehicle_models WHERE Model_ID = '$Veh_Make'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function cs_ls_pricing_year($make,$model){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT Veh_Year_Start FROM cs_ls_pricing WHERE Veh_Make = '$make' AND Veh_Model='$model' LIMIT 1");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}


function customers_authorization_array(){
	return $customers_authorization_array = array('Approved', 'Pending Approval - Must be Authorized to Browse', 'Pending Approval - May Browse No Prices','Banned - Not allowed to login or shop','Pending Approval - May browse with prices and buy');
}

function unique_multidim_array($array, $key) { 
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
    return $temp_array; 
}

function keyCodeCutsRange($header_id){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT The_Code FROM cs_auto_codes_cuts WHERE Header_ID = '$header_id'");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return 0;
    }
}

function lock_type(){
	return array('Vehicle Locks','Motorcycle Locks','Padlocks','Mailbox Locks','Office/Misc Locks');
}

function get_machine_data_count($machine,$result){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Success_Reporting WHERE Machine = '$machine' AND Result='$result' AND deleted='0' ORDER BY id DESC");
	if($query->num_rows() > 0){
	 	return $query->num_rows();
  	}else{
	   return 0;
    }
} 

function video_category(){
	return array('Setup', 'EEPROM', 'OBD2');
}
function video_make(){
	return array('BMW','Chrysler','Ford','GM','Harley','Honda','Hyundai','Isuzu','Jaguar','Kia','Land Rover','Mazda','Mercedes','Mitsubishi','Nissan','Hyundai & Kia','Porsche','Saab','Subaru','Toyota','Volvo','VW');
}

function aks_products_excel(){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT pd.products_id,m.manufacturers_name,p.products_model,pd.products_description,pd.products_name,p.products_price,p.products_cost FROM products_description pd JOIN products p ON p.products_id = pd.products_id JOIN manufacturers m ON p.manufacturers_id=m.manufacturers_id");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

function aks_blankTitle_products_excel(){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$query = $ci->admin_db->query("SELECT pd.products_id,pd.products_name FROM products_description pd JOIN products p ON p.products_id = pd.products_id");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return $query->num_rows();
    }
}

 function add_vehicle_search_history(){
 	
 }
function getmodel($makeId){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database();       
   //get data from database   
   $query = $ci->db->query("SELECT * FROM t_Models WHERE Make_UUID = '$makeId' ORDER BY Model_Name");;       
   if($query->num_rows() > 0){
	   $result = $query->result_array();
	   return $result;
   }else{
	   return false;
   }
}
function getVehicleKeysproducts($products_id,$order_by){
	$ci =& get_instance();       
   //load databse library
    $ci->admin_db = $ci->load->database('dev_db', true);
	$ids = str_replace(', ',',',$products_id);
	$ids = str_replace(',,',',',$ids);
	$ids = str_replace(',,,',',',$ids);
	$ids = str_replace(',,,',',',$ids);
	$ids = str_replace(',,,,',',',$ids);
	$ids = str_replace(',,,,,',',',$ids);
	$ids = str_replace(',,,,,',',',$ids);
	$ids = str_replace('.',',',$ids);
	$ids = str_replace('. ',',',$ids);
	$ids = str_replace(',,,',',',$ids);
	$ids = str_replace(',,',',',$ids);
	$ids = ltrim($ids,',');
	if($ids == ""){
		return array();
	}
	$products = $ci->admin_db->query("SELECT p.products_id,sp.specials_new_products_price,sp.expires_date,sp.status,p.products_quantity,p.products_image,p.products_quantity_order_min,p.products_quantity_order_units,pd.products_name,p.products_model,p.products_price,p.products_secret FROM products p 
	JOIN products_description pd ON p.products_id=pd.products_id 
	LEFT JOIN specials sp ON sp.products_id = p.products_id 
	WHERE p.products_id IN(".$ids.") AND p.products_status='1' ORDER BY ".$order_by." "); 
	if( $products->num_rows() > 0){
        $p_query_arr = array_unique($products->result_array(), SORT_REGULAR);
        return array('Products'=>$p_query_arr);
    }else{
        return array();
    } 
 }

 function get_all_available_vehicles(){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT t_Vehicles.UUID,t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Years,t_Vehicles.Code_Series_UUID FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID   ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}
function get_selected_vehicles_by_id($vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT t_Vehicles.UUID,t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Years,t_Vehicles.Code_Series_UUID FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.id = '$vehicle_UUID' ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}
function get_selected_vehicles_by_UUI($vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT t_Vehicles.UUID,t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Years,t_Vehicles.Code_Series_UUID FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID WHERE t_Vehicles.UUID = '$vehicle_UUID' ORDER BY t_Makes.Make_Name,t_Models.Model_Name");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}
function updateimg($vid,$newfilename){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("UPDATE t_Vehicles SET image_url='$newfilename' WHERE id = '$vid'");	
}
function is_url_exist($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}

function num_sold($product_id,$interval_in_days){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$sql = 'SELECT SUM(products_quantity) as num FROM orders o JOIN orders_products op on o.orders_id = op.orders_id WHERE op.products_id = ' . $product_id .  ' AND date_purchased > DATE_ADD(NOW(), INTERVAL -' . $interval_in_days. ' DAY);';
   $total = $ci->admin_db->query($sql);
   $num = $total->result_array();
   return round($num[0]['num']);
}

function product_remaining_days($products_id){
	$ci =& get_instance();
	$ci->admin_db = $ci->load->database('dev_db', true);
	$ndays_sql = "SELECT ( 90/ SUM(op.products_quantity) ) * p.products_quantity as ndays FROM orders o 
	JOIN orders_products op ON o.orders_id = op.orders_id 
	JOIN products p ON op.products_id = p.products_id 
	WHERE op.products_id = ".$products_id." AND o.date_purchased > DATE_ADD(NOW(), INTERVAL -90 DAY) ";
	$ndays_products = $ci->admin_db->query($ndays_sql);
	$num = $ndays_products->result_array();
   	return round($num[0]['ndays']);
}

function get_Code_Series_not_in($value_uuid){
	$ci =& get_instance();       
   //load databse library
   $ci->load->database(); 
	$query = $ci->db->query("SELECT UUID,Code_Series_Name FROM t_Code_Series WHERE UUID NOT IN ($value_uuid)");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}
function get_aks_cutomers_points($cid){
	$ci =& get_instance(); 
	$ci->load->database();
	$ci->admin_db = $ci->load->database('dev_db', true); 
	$query = $ci->admin_db->query("SELECT * FROM sp_customers WHERE customers_id='$cid' ");
	if($query->num_rows() > 0){
		$data = $query->result_array();
	 	return $data[0]['amount'];
  	}else{
	   return 0;
    }
}
function software_type(){
	$ci =& get_instance(); 
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Software_Types ORDER BY Software_Type_Name");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}
function accessories_type(){
	$ci =& get_instance(); 
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_accessories_Types ORDER BY accessories_Type_Name");
	if($query->num_rows() > 0){
	 return $query->result_array();
  	}else{
	   return false;
    }
}


function productsData(){
	$ci =& get_instance(); 
    $ci->admin_db = $ci->load->database('dev_db', true);
	$products  = $ci->admin_db->query("SELECT pd.products_name as title, p.products_id as id,pd.products_description as description, p.products_image as image 
	 FROM products p LEFT JOIN products_description pd ON (p.products_id = pd.products_id) where p.products_id = pd.products_id and pd.language_id = '1' LIMIT 100"); 
	if( $products->num_rows() > 0){
        $p_query_arr = array_unique($products->result_array(), SORT_REGULAR);
        return array('Products'=>$p_query_arr);
    }else{
        return array();
    } 
 }

 function productsKey($ids){
	$ci =& get_instance(); 
    $ci->load->database(); 
	$ids = explode(',', $ids);
	$where = '';
	if(count($ids) > 0){
		foreach($ids as $id){
			$where .= "Products LIKE '%".$id."%' OR ";
		}
		$where = rtrim($where,'OR ');
		//return "SELECT * FROM t_Keys WHERE 1 AND (".$where.")";
		$query = $ci->db->query("SELECT id,UUID,Key_Name,Products FROM t_Keys WHERE 1 AND (".$where.")");
		if($query->num_rows() > 0){
			$get_data= $query->result_array();
			foreach ($get_data as $key1 => $value1) {
				foreach($ids as $id){
					if(in_array(  $id, explode(',', $value1['Products']))){						
						$query_key = $ci->db->query("SELECT t_Makes.Make_Name,t_Models.Model_Name,t_Vehicles.id,t_Vehicles.Years FROM t_Makes JOIN  t_Models ON t_Makes.UUID = t_Models.Make_UUID 
						JOIN t_Vehicles ON  t_Models.UUID = t_Vehicles.Model_UUID 
						WHERE t_Vehicles.Mechanical_Key_UUID LIKE'%". $value1['UUID']."%' OR t_Vehicles.Chip_Key_UUID LIKE'%". $value1['UUID']."%'");
						$get_key_data = $query_key->result_array();
						$result[$value1['id']] =  array('Key_Name' => $value1['Key_Name'],'UUID' => $value1['UUID'],'Products'=>$value1['Products'],'info'=>$get_key_data);
					}
				}
			} 
			return $result;
		}else{
			return false;
		}
	}
	return false;
 }

 function get_vehicles_locks($vehciles_id){
	$vehciles_id2 = $vehciles_id;
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Locks WHERE Vehicles_UUID LIKE '%$vehciles_id2%' ");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return array();
    }
 }
?>