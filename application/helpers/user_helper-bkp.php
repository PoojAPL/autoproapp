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
	 $query2 = $ci->db->query("SELECT * FROM t_Tools WHERE Tool_Type_UUID = '$value_uuid' "); 
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
	$query = $ci->db->query("SELECT * FROM t_Models WHERE UUID = '$value_uuid'");
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
		 $query2 = $ci->db->query("SELECT * FROM t_Makes WHERE UUID = '$value_uuid2' "); 
		 return $query2->result_array();	
  	}else{
	   return false;
    }
}

function get_model_makes($makes_uuid){
	$ci =& get_instance();       
    $ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_Models WHERE Make_UUID = '$makes_uuid'");
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
	$query = $ci->db->query("SELECT * FROM t_Keys WHERE Key_Type_UUID = '$Key_Type_UUID'");
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
	$query = $ci->db->query("SELECT * FROM t_OBP_Remotes WHERE Vehicle_UUID = '$distinct_vehicle_UUID' AND Procedure_Number=1");
	if($query->num_rows() > 0){
	 	return $query->result_array();
  	}else{
	   return false;
    }
}

function get_obp_remotes2($distinct_vehicle_UUID){
	$ci =& get_instance();
	$ci->load->database(); 
	$query = $ci->db->query("SELECT * FROM t_OBP_Remotes WHERE Vehicle_UUID = '$distinct_vehicle_UUID' AND Procedure_Number=2");
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
	   return false;
    }
}
?>