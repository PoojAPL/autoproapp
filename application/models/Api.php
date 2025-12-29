<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('user_helper'));
        //load database library
        $this->load->database();
        $this->admin_db = $this->load->database('dev_db', true);
    }
    function getRows($id = ""){
        if(!empty($id)){
            $query = $this->db->get_where('t_Users', array('id' => $id));
            return $query->row_array();
        }else{
            $query = $this->db->get('t_Users');
            return $query->result_array();
        }
    }

    public function getMakes(){
        $sql = "SELECT mk.Make_Name as name,mk.id,mk.Make_Sort as sort FROM t_Makes as mk JOIN t_Models md ON mk.UUID = md.Make_UUID JOIN t_Vehicles vh ON md.UUID = vh.Model_UUID WHERE md.Vehicle_Type_UUID NOT IN('58f1abb2e01d02.56859808') ORDER BY mk.Make_Sort";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
             $array_unique = array_unique($result->result_array(), SORT_REGULAR);
             $res[] = $array_unique;
        } else {
            $res['error'] = true;
            $res['message'] = 'No result found.';
        }
        return $res;
    }
    public function getmodel($mk_id){
        if($mk_id > 0){
            $make_result = $this->db->select('UUID')->from('t_Makes')->where('id', $mk_id)->get();
            if ($make_result->num_rows() > 0) {
                $make_row = $make_result->result_array();
                $make_uuid = $make_row[0]['UUID'];
                $sql = "SELECT md.Model_Name as name,md.id FROM t_Makes as mk JOIN t_Models md ON mk.UUID = md.Make_UUID JOIN t_Vehicles vh ON md.UUID = vh.Model_UUID WHERE md.Make_UUID='".$make_uuid."' and md.Vehicle_Type_UUID NOT IN('58f1abb2e01d02.56859808') ORDER BY md.Model_Name";
                $result = $this->db->query($sql);
                if ($result->num_rows() > 0) {
                    $array_unique = array_unique($result->result_array(), SORT_REGULAR);
                    $res[] = $array_unique;
                } else {
                    $res[] = array();
                }
            }else {
                $res[] = array();
            }
        }else {
            $res[] = array();
        }
        return $res;
    }
    public function getyears($mk_id){
        if($mk_id > 0){
            $make_result = $this->db->select('UUID')->from('t_Models')->where('id', $mk_id)->get();
            if ($make_result->num_rows() > 0) {            
                $make_row = $make_result->result_array();
                $make_uuid = $make_row[0]['UUID'];
                $sql = "SELECT id,Years as year FROM t_Vehicles WHERE Model_UUID='".$make_uuid."' AND duplicate_of=0 ORDER BY Years";
                $result = $this->db->query($sql);
                if ($result->num_rows() > 0) {
                    $years_result = $result->result_array();
                    //print_r($years_result);
                    $year_array = array();
                    foreach($years_result as $value){
                        //echo $value['Years'];
                        $years = explode(',',$value['year']); 
                        if($years[0] == $years[count($years)-1]){
                            $year_val = $years[0];
                        }else{
                            $year_val = $years[0].'-'.$years[count($years)-1];
                        }
                        $year_array[] = array('id' => $value['id'],'year' => $year_val);
                    }
                    $array_unique = array_unique($year_array, SORT_REGULAR);
                    $res[] = $array_unique;
                } else {
                    $res[] = array();
                }
            } else {
                $res[] = array();
            } 
        }else {
            $res[] = array();
        }        
        return $res;
    }

    public function get_vehicle_products($vh_id){
        $data =  explode('_',$vh_id);
        if(strpos($vh_id,'_')){
            $id = $data[0]; 
            $sorting = $data[1];
        }elseif($vh_id > 0){
            $id = $data[0]; 
            $sorting = $data[1];
        }else{
            $id = 0; 
            $sorting = 'default';
        }
        
        if (is_null($sorting)){
            $sorting = 'default';
        }else{
            $sorting = $sorting;
        }    
        $product_sorting = array('name-ascending'=>'pd.products_name-asc','name-descending'=>'pd.products_name-DESC','price-ascending'=>'p.products_price-asc','price-descending'=>'p.products_price-desc','created-ascending'=>'p.products_id-asc','created-descending'=>'p.products_id-desc','default'=>'pd.products_name-asc');
        if(isset($product_sorting[$sorting])){
            $order_by = str_replace('-',' ',$product_sorting[$sorting]);
        }else{
            $order_by = str_replace('-',' ',$product_sorting['default']);
        }
            
        if($id > 0){
            $sql = "SELECT vh.UUID as vuuid,mk.Make_Name,md.Model_Name,md.id as md_id,vh.id, vh.Years, vh.Code_Series_UUID,vh.Mechanical_Key_UUID,vh.Chip_Key_UUID,vh.Remote_UUID,vh.RHK_UUID,vh.SmartKey_UUID,vh.Vehicle_Image,vh.Parts_Ignition,vh.Parts_Door,vh.Parts_Accessories FROM t_Makes as mk JOIN t_Models md ON mk.UUID = md.Make_UUID JOIN t_Vehicles vh ON md.UUID = vh.Model_UUID WHERE vh.id = ".$id."";
            $result = $this->db->query($sql);
            if ($result->num_rows() > 0) {
                $vh_value = $result->result_array();    
                $vh_value = $vh_value[0];          
                $mechanical_key = array();
                if($vh_value['Mechanical_Key_UUID'] != ""){
                    $mach_key_products_id = '';
                    $Replacement_blade = '';
                    $mach_keys_array = explode(',',$vh_value['Mechanical_Key_UUID']);
                    for($i = 0; $i < count($mach_keys_array); $i++ ){
                        $value_uuid = $mach_keys_array[$i];
                        $get_result = $this->db->query("SELECT Replacement_blade,Products FROM t_Keys WHERE UUID ='".$value_uuid."' "); 
                        $get_rows = $get_result->result_array();
                        if(count($get_rows) > 0){
                            $mach_key_products_id .= rtrim($get_rows[0]['Products'],',').',';  
                            $Replacement_blade .= $get_rows[0]['Replacement_blade'].',';                      
                        }
                    }
                    $mach_key_products_id = rtrim($mach_key_products_id,',');
                    $mechanical_key = getVehicleKeysproducts($mach_key_products_id,$order_by);

                    /*---------- Replacement_blade Keys ------------------------------*/ 
                    
                    $replacement_products = "";                    
                    $Replacement_blade = rtrim($Replacement_blade,',');
                    $replacement_blade_id = explode(',',$Replacement_blade);                        
                    foreach ($replacement_blade_id as $replacement) {
                        $get_result = $this->db->query("SELECT Products FROM t_Keys WHERE UUID ='".$replacement."' "); 
                        $get_rows = $get_result->result_array();
                        if( count($get_rows) > 0){
                            $replacement_products .= $get_rows[0]['Products'].',';
                        }else{
                            $replacement_products .= '';
                        }
                    } 
                    $products_rep = rtrim($replacement_products,',');
                    $replacement_blade_key = getVehicleKeysproducts($products_rep,$order_by); // Replacement_blade Keys
                }
                
                $transponer_key = array();
                $transponer_key_shell = array();
                $transponer_chips = array();
                $cloning_chips = array();
                if($vh_value['Chip_Key_UUID'] !=""){  
                    $mach_keys_array1 = explode(',',$vh_value['Chip_Key_UUID']); // Transponder Chip Keys  
                    $chip_products_id1 = ''; 
                    $key_shell_products_id1 = '';  
                    $trans_chip_products_id1 = '';  
                    $products_clone = "";         
                    for($i = 0; $i < count($mach_keys_array1); $i++ ){
                        $value_uuid1 = $mach_keys_array1[$i];
                        $get_result = $this->db->query("SELECT Products FROM t_Keys WHERE UUID ='".$value_uuid1."' ");
                        $get_rows = $get_result->result_array();
                        if(count($get_rows) > 0){
                            $chip_products_id1 .= rtrim($get_rows[0]['Products'],',').',';                        
                        }

                        $get_result = $this->db->query("SELECT Key_Shell_UUID FROM t_Keys WHERE UUID ='".$value_uuid1."' "); // Transponder Key Shell
                        $get_rows = $get_result->result_array();
                        if(count($get_rows) > 0){
                            $Key_Shell_UUID = $get_rows[0]['Key_Shell_UUID'];
                            $get_result = $this->db->query("SELECT Products FROM t_Keys WHERE UUID ='".$Key_Shell_UUID."' ");
                            $get_rows = $get_result->result_array();
                            if(count($get_rows) > 0){
                                $key_shell_products_id1 .= rtrim($get_rows[0]['Products'],',').',';                            
                            }
                        }
                        $get_result = $this->db->query("SELECT tc.Products,tc.Chip_Name FROM t_Keys as tk JOIN t_Chips as tc ON tc.UUID=tk.Chip_UUID  WHERE tk.UUID ='".$value_uuid1."' "); // Transponder Chips
                        $get_rows = $get_result->result_array();
                        if(count($get_rows) > 0){
                            $trans_chip_products_id1 .= rtrim($get_rows[0]['Products'],',').',';                         
                        }

                        $get_result = $this->db->query("SELECT tc.Products,tc.Clone_With FROM t_Keys as tk JOIN t_Chips as tc ON tc.UUID=tk.Chip_UUID  WHERE tk.UUID ='".$value_uuid1."' "); // Cloning Chips
                        $get_rows = $get_result->result_array();
                            if(count($get_rows) > 0){
                                $Clone_With = explode(',',$get_rows[0]['Clone_With']);                            
                                foreach ($Clone_With as $Clone_With1) {
                                    $get_result = $this->db->query("SELECT Products FROM t_Chips  WHERE UUID ='".$Clone_With1."' ");
                                    $get_rows = $get_result->result_array();
                                    if( count($get_rows) > 0){
                                        $products_clone .= $get_rows[0]['Products'].',';
                                    }else{
                                        $products_clone = 0;
                                    }
                                }
                                                    
                            } 
                    } 
                    $chip_products_id1 = rtrim($chip_products_id1,',');
                    $transponer_key = getVehicleKeysproducts($chip_products_id1,$order_by); 
                    
                    $key_shell_products_id1 = rtrim($key_shell_products_id1,',');
                    $transponer_key_shell = getVehicleKeysproducts($key_shell_products_id1,$order_by); 

                    $trans_chip_products_id1 = rtrim($trans_chip_products_id1,',');
                    $transponer_chips = getVehicleKeysproducts($trans_chip_products_id1,$order_by);

                    $cloning_chip_products_id = rtrim($products_clone,',');                        
                    $cloning_chips = getVehicleKeysproducts($cloning_chip_products_id,$order_by);  
                }// end Chip_Key_UUID
            
                $remotes = array();
                $remote_shell = array();
                $batteries = array();
                $emergency_key = array();
                $get_result1 = $this->db->query("SELECT Remote_Type_UUID,id,Products,Emergency_Key_UUID,Shell_UUID,Battery_UUID FROM t_Remotes WHERE Vehicles_UUID LIKE '%".$vh_value['vuuid']."%' "); // Remotes
                $get_rows2 = $get_result1->result_array();            
                if(count($get_rows2) > 0){
                    $products_id = "";
                    $Shell_UUID = "";
                    $Battery_UUID = "";
                    $Emergency_Key_UUID ="";
                    $shell_products_id = "";
                    $rmote_shell_type = array('a5451618-49ec-11e6-beb8-9e71128cae77','a5451b68-49ec-11e6-beb8-9e71128cae77','a54519b0-49ec-11e6-beb8-9e71128cae77','');
                    foreach($get_result1->result_array() as $get_rows1 ){
                        if( in_array($get_rows1['Remote_Type_UUID'],$rmote_shell_type)){
                            $shell_products_id .= rtrim($get_rows1['Products'],',').',';
                        }else{
                            $products_id .= rtrim($get_rows1['Products'],',').',';
                        }                    
                        $Shell_UUID .= rtrim($get_rows1['Shell_UUID'],',').',';
                        $Battery_UUID .= rtrim($get_rows1['Battery_UUID'],',').',';
                        $Emergency_Key_UUID .= rtrim($get_rows1['Emergency_Key_UUID'],',').',';

                    }   
                    $products_id = rtrim( $products_id,','); 
                    $remotes = getVehicleKeysproducts($products_id,$order_by); // Remotes
                
                    /*--------Remote Shell ------------ */                
                    $Clone_With = explode(',',$Shell_UUID); //Remote Shells               
                    $products_clone = "";
                    foreach ($Clone_With as $Clone_With1) {
                        $get_result = $this->db->query("SELECT Products FROM t_Remotes WHERE UUID ='".$Clone_With1."' "); 
                        $get_rows = $get_result->result_array();   
                        if( count($get_rows) > 0){
                            $products_clone .= $get_rows[0]['Products'].',';
                        }else{
                            $products_clone .= '';
                        }
                    }
                    $products_clone2 = rtrim($products_clone,',');
                    $products_id = $products_clone2.','.rtrim($shell_products_id,','); 
                    $products_id = rtrim( $products_id,',');                        
                    $remote_shell = getVehicleKeysproducts($products_id,$order_by); 

                    /*---------- Emergency Keys ------------------------------*/ 
                    $products_clone = "";  
                    
                    $Emergency_Key_UUID = rtrim($Emergency_Key_UUID,',');
                    $Clone_With = explode(',',$Emergency_Key_UUID);                        
                    foreach ($Clone_With as $Clone_With1) {
                        $get_result = $this->db->query("SELECT Products FROM t_Keys WHERE UUID ='".$Clone_With1."' "); 
                        $get_rows = $get_result->result_array();
                        if( count($get_rows) > 0){
                            $products_clone .= $get_rows[0]['Products'].',';
                        }else{
                            $products_clone .= '';
                        }
                    } 
                    $products_emgk = rtrim($products_clone,',');
                    $emergency_key = getVehicleKeysproducts($products_emgk,$order_by); // Emergency Keys                    
                        
                    /*---------------- Batteries -----------------------*/
                    $rhk_products = 0;
                    $smk_products = 0;
                    if($vh_value['RHK_UUID'] != ""){
                        $RHK_UUID = $vh_value['RHK_UUID'];
                        $get_result = $this->db->query("SELECT Products FROM t_Remotes WHERE UUID ='".$RHK_UUID."' "); 
                        $get_rows = $get_result->result_array();  
                        if(count($get_rows) > 0){
                            $rhk_products = $get_rows[0]['Products'];
                        }
                    }
                    if($vh_value['SmartKey_UUID'] != ""){
                        $SmartKey_UUID = $vh_value['SmartKey_UUID'];
                        $get_result = $this->db->query("SELECT Products FROM t_Remotes WHERE UUID ='".$SmartKey_UUID."' "); 
                        $get_rows = $get_result->result_array(); 
                        if(count($get_rows) > 0){
                            $smk_products = $get_rows[0]['Products'];
                        }
                    }
                    $Clone_With = explode(',',$Battery_UUID);
                    $products_clone = "";
                    foreach ($Clone_With as $Clone_With1){
                        $get_result = $this->db->query("SELECT Products FROM t_Batteries WHERE UUID ='".$Clone_With1."' "); 
                        $get_rows = $get_result->result_array();
                        if( count($get_rows) > 0){
                            $b_Products = explode('(',$get_rows[0]['Products']);
                            $products_clone .= $b_Products[0].',';
                        }else{
                            $products_clone .= '';
                        }
                    }
                    $all_prducts = $rhk_products.','.$smk_products.','.$products_clone;
                    $products_clone2 = rtrim($all_prducts,',');
                    $products_id = $products_clone2;                        
                    $batteries = getVehicleKeysproducts($products_id,$order_by);
                }
                $remote_head_keys = array();
                
                $remote_head_keys_fobik_shell = array();
                $products_id = 0;
                $products_clone = 0;
                $products_headKey = 0;
                if($vh_value['RHK_UUID'] !=""){                
                    $mach_keys_array6 = explode(',',$vh_value['RHK_UUID']);                
                    for($i = 0; $i < count($mach_keys_array6); $i++ ){
                        $value_uuid3 = $mach_keys_array6[$i];
                        $get_result = $this->db->query("SELECT Products,Emergency_Key_UUID,Shell_UUID FROM t_Remotes WHERE UUID ='".$value_uuid3."' "); 
                        $get_rows = $get_result->result_array();
                        if(count($get_rows) > 0){
                            $products_id .= rtrim($get_rows['Products'],',').','; 

                            /*---------- Remote Head Key / FOBIK Shells ------------------------------*/    
                            $Clone_With = explode(',',$get_result['Shell_UUID']);                        
                            foreach ($Clone_With as $Clone_With1) {
                                $get_result = $this->db->query("SELECT Products FROM t_Remotes WHERE UUID ='".$Clone_With1."' "); 
                                $get_rows = $get_result->result_array();
                                if( count($get_rows) > 0){
                                    $products_headKey .= $get_rows['Products'].',';
                                }else{
                                    $products_headKey .= '';
                                }
                            } 
                        }
                    } 
                }
                $products_id = rtrim($products_id,',');
                $remote_head_keys = getVehicleKeysproducts($products_id,$order_by);  // Remote Head Keys

                $products_headKey = rtrim($products_headKey,',');
                $remote_head_keys_fobik_shell = getVehicleKeysproducts($products_headKey,$order_by); // Remote Head Key / FOBIK Shells 
                
                
                $smark_keys = array();
                $smark_keys_shell = array();
                $products_id = "";
                $products_clone = "";
                if($vh_value['SmartKey_UUID'] !=""){                   
                    $mach_keys_array6 = explode(',',$vh_value['SmartKey_UUID']);                
                    for($i = 0; $i < count($mach_keys_array6); $i++ ){
                        $value_uuid3 = $mach_keys_array6[$i];
                        $get_result = $this->db->query("SELECT Products,Shell_UUID FROM t_Remotes WHERE UUID ='".$value_uuid3."' "); 
                        $get_rows = $get_result->result_array();
                        if(count($get_rows) > 0){
                            $products_id .= rtrim($get_rows['Products'],',').',';  

                            /*---------- Smart Key Shells------------------------------*/
                            $Clone_With = explode(',',$get_rows['Shell_UUID']);                            
                            foreach ($Clone_With as $Clone_With1) {
                                $get_result = $this->db->query("SELECT Products FROM t_Remotes WHERE UUID ='".$Clone_With1."' "); 
                                $get_rows = $get_result->result_array();
                                if( count($get_rows) > 0){
                                    $products_clone .= $get_rows['Products'].',';
                                }else{
                                    $products_clone .= '';
                                }
                            }                          
                        }
                    }
                    $products_id = rtrim($products_id,',');
                    $smark_keys = getVehicleKeysproducts($products_id,$order_by); // Smart Keys

                    $products_smks = rtrim($products_clone,',');
                    $smark_keys_shell = getVehicleKeysproducts($products_smks,$order_by); // Smart Keys Shell
                } 
                
                /*---------- Ignitions ------------------------------*/
                $Ignitions = array();
                if($vh_value['Parts_Ignition'] !=""){
                    $mach_keys_array6 = explode(',',$vh_value['Parts_Ignition']);
                    for($i = 0; $i < count($mach_keys_array6); $i++ ){
                        $value_uuid3 = $mach_keys_array6[$i];
                        $get_result = $this->db->query("SELECT Products FROM t_Locks WHERE UUID ='".$value_uuid3."' "); 
                        $get_rows = $get_result->result_array();
                        if(count($get_rows) > 0){
                            $products_id .= $get_rows['Products'].',';                            
                        }                    
                    }
                    $products_id = rtrim($products_id,',');
                    $Ignitions = getVehicleKeysproducts($products_id,$order_by);
                }
                /*---------- Door / Trunk Locks ------------------------------*/
                $door_trunks_locks = array();
                if($vh_value['Parts_Door'] !=""){
                    $mach_keys_array6 = explode(',',$vh_value['Parts_Door']);
                    for($i = 0; $i < count($mach_keys_array6); $i++ ){
                        $value_uuid3 = $mach_keys_array6[$i];
                        $get_result = $this->db->query("SELECT Products FROM t_Locks WHERE UUID ='".$value_uuid3."' "); 
                        $get_rows = $get_result->result_array();
                        if(count($get_rows) > 0){
                            $products_id .= $get_rows['Products'].','; 
                        }                    
                    }
                    $products_id = rtrim($products_id,',');
                    $door_trunks_locks = getVehicleKeysproducts($products_id,$order_by);
                }

                /*---------- Lock Accessories ------------------------------*/
                $Parts_Accessories = array();
                if($vh_value['Parts_Accessories'] !=""){ 
                    $mach_keys_array6 = explode(',',$vh_value['Parts_Accessories']);
                    for($i = 0; $i < count($mach_keys_array6); $i++ ){
                        $value_uuid3 = $mach_keys_array6[$i];
                        $get_result = $this->db->query("SELECT Products FROM t_Locks WHERE UUID ='".$value_uuid3."' "); 
                        $get_rows = $get_result->result_array();
                        if(count($get_rows) > 0){
                            $products_id .= $get_rows['Products'].','; 
                        }                                     
                    }
                    $products_id = rtrim($products_id,',');
                    $Parts_Accessories = getVehicleKeysproducts($products_id,$order_by);
                }

                /*---------- Locks ------------------------------*/
                $parts_locks = array();
                //echo "SELECT Products FROM t_Locks WHERE Vehicles_UUID LIKE '%".$vh_value['vuuid']."%' ";
                $get_result1 = $this->db->query("SELECT Products FROM t_Locks WHERE Vehicles_UUID LIKE '%".$vh_value['vuuid']."%' ");
                $get_rows = $get_result1->result_array();
                if(count($get_rows) > 0){
                    foreach($get_result1->result_array() as $get_rows1 ){
                        $products_id .= rtrim($get_rows1['Products'],',').',';
                    }   
                    $products_id = rtrim( $products_id,',');                   
                    $parts_locks = getVehicleKeysproducts($products_id,$order_by);
                }
                //echo  'locks: '.$products_id; 
                /*---------- Tools ------------------------------*/
                $tools = array();
                $Lishi_UUID_names = '';
                if($vh_value['Code_Series_UUID'] !=""){               
                    $mechanical_key16 = array();
                    $mach_keys_array6 = explode(',', str_replace('|',',',$vh_value['Code_Series_UUID']) );
                    $all_prducts1 = "";
                    for($i = 0; $i < count($mach_keys_array6); $i++ ){
                        $value_uuid3 = $mach_keys_array6[$i];
                        $get_result  = $this->db->query("SELECT * FROM t_Code_Series WHERE UUID ='".$value_uuid3."' ");
                        $get_key_name3 = $get_result->result_array();
                        //print_r($get_key_name3);
                        if(count($get_key_name3) > 0){
                                $Lishi_UUID = $get_key_name3[0]['Lishi_UUID'];
                                $get_key_name4  = $this->db->query("SELECT Products,Tool_Name FROM t_Tools WHERE UUID ='".$Lishi_UUID."' ");
                                $get_key_name4 = $get_key_name4->result_array();
                                if(count($get_key_name4) > 0){
                                    $products_ids = $get_key_name4[0]['Products'].',';
                                    $Lishi_UUID_names .= $get_key_name4[0]['Tool_Name'].'<br>';
                                }else{
                                    $products_ids = "";
                                }
                                $Accu_Reader_UUID = $get_key_name3[0]['Accu-Reader_UUID'];                            
                                $get_key_name5  = $this->db->query("SELECT Products FROM t_Tools WHERE UUID ='".$Accu_Reader_UUID."' ");
                                $get_key_name5 = $get_key_name5->result_array();
                                if(count($get_key_name5) > 0){
                                    $products_ids1 = $get_key_name5[0]['Products'].',';
                                }else{
                                    $products_ids1 = "";
                                }
                                $EEZ_Reader_UUID = $get_key_name3[0]['EEZ-Reader_UUID'];
                                $get_key_name6  = $this->db->query("SELECT Products FROM t_Tools WHERE UUID ='".$EEZ_Reader_UUID."' ");
                                $get_key_name6 = $get_key_name6->result_array();
                                if(count($get_key_name6) > 0){
                                    $products_ids2 = $get_key_name6[0]['Products'];
                                }else{
                                    $products_ids2 = "";
                                }
                                $all_prducts1 .= $products_ids.$products_ids1.$products_ids2.',';
                        }
                        $get_result1 = $this->db->query("SELECT products FROM t_Tools_Software WHERE vehicles LIKE '%".$vh_value['vuuid']."%' ");//software
                        $get_rows2 = $get_result1->result_array(); 
                        $software_products_id = "";          
                        if(count($get_rows2) > 0){
                            foreach($get_result1->result_array() as $get_rows1 ){
                                $software_products_id .= rtrim($get_rows1['products'],',').',';
                            } 
                            $software_products_id = $software_products_id;  
                        }
                        $all_prducts1 .= $software_products_id;
                        $get_result1 = $this->db->query("SELECT products FROM t_Tools_accessories WHERE vehicles LIKE '%".$vh_value['vuuid']."%' ");//software
                        $get_rows2 = $get_result1->result_array(); 
                        $accessories_products_id = "";          
                        if(count($get_rows2) > 0){
                            foreach($get_result1->result_array() as $get_rows1 ){
                                $accessories_products_id .= rtrim($get_rows1['products'],',').',';
                            }  
                        }
                        $all_prducts1 .= $accessories_products_id;   
                        if($all_prducts1 !=""){
                            $products_id = rtrim($all_prducts1,',');
                            $tools = getVehicleKeysproducts($products_id,$order_by);
                        }                  
                    }
                }
            $Code_Series_Name = "";
            $cs_row2_cut = '';
            $Spaces = 'N/A';
            $Depths = 'N/A';
            $Code_Series_id = '';
            if( $vh_value['Code_Series_UUID'] != "" || $vh_value['Code_Series_UUID'] !='|'){
                $Code_Series_UUID = explode('|',$vh_value['Code_Series_UUID']);
                $Code_Series_UUID = $Code_Series_UUID[0];
                $cs = $this->db->query("SELECT id,Code_Series_Name,Spaces,Depths,MACS,HPC_Blitz_Card,HPC_Blitz_Cutter FROM t_Code_Series WHERE UUID ='".$Code_Series_UUID."' "); 
                $cs_row = $cs->result_array();              
                if( count($cs_row) > 0){
                    $Code_Series_id = $cs_row[0]['id'];
                    $Code_Series_Name = $cs_row[0]['Code_Series_Name'];
                    $Code_Series_Name1 = explode('-',$Code_Series_Name);
                    $Code_Range__Start = trim($Code_Series_Name1[0]);
                    $Code_Range__End = trim($Code_Series_Name1[1]);
                    $query_search = $this->db->query("select h.Auto_Num,h.Title,c.The_Code,c.The_Cut,h.Code_Range__Start,h.Code_Range__End,h.Code_Series_UUID FROM cs_auto_codes_headers as h JOIN cs_auto_codes_cuts c ON h.Auto_Num = c.Header_ID WHERE h.Code_Range__Start = '".$Code_Range__Start."' AND h.Code_Range__End = '".$Code_Range__End."' " );
                    $cs_row2 = $query_search->result_array(); 
                    if($cs_row2[0]['The_Cut'] != ''){
                        $cs_row2_cut = $cs_row2[0]['The_Cut'];
                    }else{
                        $cs_row2_cut = 'N/A';
                    } 
                    if($cs_row[0]['Spaces'] != ''){
                        $Spaces = $cs_row[0]['Spaces'];
                    }
                    if($cs_row[0]['Depths'] != ''){
                        $Depths = $cs_row[0]['Depths'];
                    }
                    if($cs_row[0]['MACS'] != ''){
                        $MACS = $cs_row[0]['MACS'];
                    }
                    if($cs_row[0]['HPC_Blitz_Card'] != ''){
                        $HPC_Blitz_Card = $cs_row[0]['HPC_Blitz_Card'];
                    }
                    if($cs_row[0]['HPC_Blitz_Cutter'] != ''){
                        $get_machines_info = get_machines_info($cs_row[0]['HPC_Blitz_Cutter']);
                        $HPC_Blitz_Cutter = $get_machines_info[0]['Name'];
                    }                   
                }else{
                    $Code_Series_Name = 'N/A';
                    $Code_Range__Start = 'N/A';
                    $Code_Range__End = 'N/A';
                    $cs_row2_cut = 'N/A';
                }    
            }else{
                $Code_Series_Name = 'N/A'; 
                $Code_Range__Start = 'N/A';
                $Code_Range__End = 'N/A';
                $cs_row2_cut = 'N/A';
            }
            $mach_keys_uuids = "";	
            $MachKeys = array();
            if($vh_value['Mechanical_Key_UUID'] !=""){							
                $mach_keys_array = explode(',',$vh_value['Mechanical_Key_UUID']);
                for($i = 0; $i < count($mach_keys_array); $i++ ){
                    $get_key_name = get_key_name($mach_keys_array[$i]);
                    $mach_keys_uuids .=  $get_key_name[0]['Key_Name'];
                    $Alt_Ilco =  $get_key_name[0]['Alt_Ilco'];
                    $Alt_Silca =  $get_key_name[0]['Alt_Silca'];
                    $Alt_JMA =  $get_key_name[0]['Alt_JMA'];
                    $Alt_Jet =  $get_key_name[0]['Alt_Jet'];
                    $MachKeys[$get_key_name[0]['Key_Name']] = array('Alt_Ilco'=>$Alt_Ilco,'Alt_Silca'=>$Alt_Silca,'Alt_JMA'=>$Alt_JMA,'Alt_Jet'=>$Alt_Jet,'id' => 'mach_id'.$get_key_name[0]['id']);
                }
            }else{
                $mach_keys_uuids = "N/A";	
                $Alt_Ilco = "N/A";	
                $Alt_Silca = "N/A";	
                $Alt_JMA = "N/A";	
                $Alt_Jet = "N/A";
                $MachKeys = array();	
            }
            
            $TransponderKey = array();
            $Chip_UUID_name =  '';
            $TestKey_UUID_name = '';
            if($vh_value['Chip_Key_UUID'] !=""){								
                $chip_keys_array = explode(',',$vh_value['Chip_Key_UUID']);
                for($i = 0; $i < count($chip_keys_array); $i++ ){
                    $get_key_name = get_key_name($chip_keys_array[$i]);
                    $TransponderKey_name =  $get_key_name[0]['Key_Name'];

                    $TestKey_UUID = get_key_name($get_key_name[0]['TestKey_UUID']);
                    $Chip_UUID = get_chips($get_key_name[0]['Chip_UUID']);

                    if($Chip_UUID[0]['Chip_Name'] !=""){
                        $Chip_UUID_name =  $Chip_UUID[0]['Chip_Name'];
                        $TransponderKey[$TransponderKey_name] = array('chip' => $Chip_UUID_name,'id' => 'chip_'.$Chip_UUID[0]['id']);
                    }
                    if($TestKey_UUID[0]['Key_Name'] !=""){
                        $TestKey_UUID_name .= $TestKey_UUID[0]['Key_Name'].'<br>'; 
                    }                                      
                }
            }else{
                $TransponderKey = array();
            }
            if( $Lishi_UUID_names ==''){
                $Lishi_UUID_names = 'N/A';
            }
            if( $Chip_UUID_name ==''){
                $Chip_UUID_name = 'N/A';
            }
            if( $TestKey_UUID_name ==''){
                $TestKey_UUID_name = 'N/A';
            }
            //$MachKeys = array('Alt_Ilco'=>$Alt_Ilco,'Alt_Silca'=>$Alt_Silca,'Alt_JMA'=>$Alt_JMA,'Alt_Jet'=>$Alt_Jet);
            $TransKey = array('TestKey_UUID_name'=>$TestKey_UUID_name,'Chip_UUID_name'=>$Chip_UUID_name);

            $year_array2 = array();
            $mk_id = $vh_value['md_id'];
            $make_result = $this->db->select('UUID')->from('t_Models')->where('id', $mk_id)->get();
            if ($make_result->num_rows() > 0) {            
                $make_row = $make_result->result_array();
                $make_uuid = $make_row[0]['UUID'];
                $sql = "SELECT id,Years as year FROM t_Vehicles WHERE Model_UUID='".$make_uuid."' AND duplicate_of=0 ORDER BY Years";
                $result = $this->db->query($sql);
                if ($result->num_rows() > 0) {
                    $years_result = $result->result_array();
                    //print_r($years_result);
                    $year_array = array();
                    foreach($years_result as $value){
                        //echo $value['Years'];
                        $years = explode(',',$value['year']); 
                        if($years[0] == $years[count($years)-1]){
                            $year_val = $years[0];
                        }else{
                            $year_val = $years[0].'-'.$years[count($years)-1];
                        }
                        $year_array[] = array('id' => $value['id'],'year' => $year_val);
                    }
                    $array_unique = array_unique($year_array, SORT_REGULAR);
                    $year_array2 = $array_unique;
                } else {
                    $year_array2 = array();
                }
            } else {
                $year_array2 = array();
            } 
            $default_prd_array = array('Products'=> array());
            $res = array(
                    'vehcile_info' => array(
                        'Make_Name' => $vh_value['Make_Name'],
                        'Model_Name' => $vh_value['Model_Name'],
                        'Years' => $vh_value['Years'],
                        'Code_Series_Name'=> $Code_Series_Name,
                        'Vehicle_Image' => $vh_value['Vehicle_Image'],
                        'MechanicalKey' => $mach_keys_uuids,
                        'TransponderKey' => $TransponderKey,
                        'Lishi' => $Lishi_UUID_names,
                        'codeConversion' => $Code_Range__Start,
                        'cuts' => $cs_row2_cut,
                        'Spaces' => $Spaces,
                        'Depths' => $Depths,
                        'MACS' => $MACS,
                        'HPC_Blitz_Card' => $HPC_Blitz_Card,
                        'HPC_Blitz_Cutter' => $HPC_Blitz_Cutter,
                        'yearsArray' => $year_array2,
                        'codeId' => $Code_Series_id,
                        'vh_id' =>$id
                    ),
                    'moreInfoData'=> array(
                        'MachKeys' =>  $MachKeys, 
                        'TransKey' => $TransponderKey
                    ),
                    'keys' => array(
                        'Remotes' => (count($remotes['Products']) > 0) ? $remotes : $default_prd_array,                      
                        'Transponder / Chip Keys' => (count($transponer_key['Products']) > 0) ? $transponer_key : $default_prd_array,
                        'Locks' => (count($parts_locks['Products']) > 0) ? $parts_locks : $default_prd_array,
                        'Transponder Key Shells' => (count($transponer_key_shell['Products']) > 0) ? $transponer_key_shell : $default_prd_array,
                        'Transponder Chips' => (count($transponer_chips['Products']) > 0) ? $transponer_chips : $default_prd_array,
                        'Mechanical Keys' => (count($mechanical_key['Products']) > 0) ? $mechanical_key : $default_prd_array, 
                        'Cloning Chips'=> (count($cloning_chips['Products']) > 0) ? $cloning_chips : $default_prd_array,                          
                        'Remote Shells' => (count($remote_shell['Products']) > 0) ? $remote_shell : $default_prd_array,  
                        'Batteries' => (count($batteries['Products']) > 0) ? $batteries : $default_prd_array,
                        'Remote Head Keys / FOBIKs'=> (count($remote_head_keys['Products']) > 0) ? $remote_head_keys : $default_prd_array, 
                        'Emergency Keys'=> (count($emergency_key['Products']) > 0) ? $emergency_key : $default_prd_array,  
                        'Replacement Blade' => (count($replacement_blade_key['Products']) > 0) ? $replacement_blade_key : $default_prd_array,   
                        'Remote Head Key / FOBIK Shells'=> (count($remote_head_keys_fobik_shell['Products']) > 0) ? $remote_head_keys_fobik_shell : $default_prd_array,  
                        'Smart Keys' => (count($smark_keys['Products']) > 0) ? $smark_keys : $default_prd_array,
                        'Smart Key Shells' => (count($smark_keys_shell['Products']) > 0) ? $smark_keys_shell : $default_prd_array,
                        'Ignitions' => (count($Ignitions['Products']) > 0) ? $Ignitions : $default_prd_array,
                        'Door / Trunk Locks' => (count($door_trunks_locks['Products']) > 0) ? $door_trunks_locks : $default_prd_array,
                        'Lock Accessories' => (count($Parts_Accessories['Products']) > 0) ? $Parts_Accessories : $default_prd_array,
                        'Tools' =>  (count($tools['Products']) > 0) ? $tools : $default_prd_array 
                    )
                );
            } else {
                $res['error'] = true;
                $res['message'] = 'No result found.';
            }
        }else {
            $res['error'] = true;
            $res['message'] = 'No result found.';
        }
        return $res;
    }

    public function returns_add(){
        $data = array(
            'refund_method' => $this->input->post('refund_method'),
            'refund_amount_shown' => $this->input->post('refund_amount_shown'),
            'label_sent' =>$this->input->post('label_sent'),
            'label_sent_to' => $this->input->post('label_sent_to'),
            'label_message' => $this->input->post('label_message'),
            'label_ship_method' => $this->input->post('label_ship_method'),
            'label_tracking' => $this->input->post('label_tracking'),
            'label_amount_paid' => $this->input->post('label_amount_paid'),
            'return_by_date_given' => $this->input->post('return_by_date_given'),
        );	
        $data = $this->security->xss_clean($data);			
        $this->admin_db->insert('returns', $data);	
        $id =  $this->admin_db->insert_id();
        $query = $this->admin_db->get_where('returns', array('return_id' => $id));
        return $query->row();
    }

    public function return_items_add(){
        $data = array(
            'orders_products_id' => $this->input->post('orders_products_id'),
            'orders_id' => $this->input->post('orders_id'),
            'quantity' => $this->input->post('quantity'),
            'return_id' => $this->input->post('return_id'),
            'return_reason' =>$this->input->post('return_reason'),
            'return_comments' => $this->input->post('return_comments'),
        );	
        $data = $this->security->xss_clean($data);			
        $this->admin_db->insert('returns_items', $data);	
        $id =  $this->admin_db->insert_id();
        $query = $this->admin_db->get_where('returns_items', array('id' => $id));
        return $query->row();
    }

    public function return_items_get($id){
        $query = $this->admin_db->select('orders_products_id')->where('orders_id',$id)->get('returns_items');
        if ($query->num_rows() > 0) {
            return array($query->result_array());
        }else{
            return array();
        }        
    }
    public function all_return_items(){
        $query = $this->admin_db->select('return_id')->get('returns');
        if ($query->num_rows() > 0) {
            return array($query->result_array());
        }else{
            return array();
        }        
    }

    public function get_vehicle_info($vh_id){
        $sql = "SELECT vh.Vehicle_Image,vh.image_url,mk.Make_Name,md.Model_Name,vh.Years,vh.APP_System,vh.APP_Add_Keys,vh.APP_All_Keys_Lost,vh.APP_Notes,vh.APP_Confirmed_Working,vh.APP_Programs_Remote,vh.APP_Resync_Available,vh.PIN_Read FROM t_Makes as mk JOIN t_Models md ON mk.UUID = md.Make_UUID JOIN t_Vehicles vh ON md.UUID = vh.Model_UUID WHERE vh.id = ".$vh_id."";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }else{
            return array();
        }     
    }

    public function vehicle_assignments_needed($id){
        $get_result1 = $this->db->query("SELECT Products FROM t_Remotes"); // Remotes
        $products_id = '';
        foreach($get_result1->result_array() as $get_rows1 ){
            if($get_rows1['Products'] !="")
                $products_id .= rtrim($get_rows1['Products'],',').',';
        }   
        $products_id = rtrim( $products_id,','); // Remotes

        $get_result2 = $this->db->query("SELECT Products FROM t_Chips"); // Chips
        $products_id2 = '';
        foreach($get_result2->result_array() as $get_rows2 ){
            if($get_rows2['Products'] !="")
                $products_id2 .= rtrim($get_rows2['Products'],',').',';
        }
        $products_id2 = rtrim( $products_id2,','); // Chips

        $get_result3 = $this->db->query("SELECT Products FROM t_Keys"); // Keys
        $products_id3 = '';
        foreach($get_result3->result_array() as $get_rows3 ){
            if($get_rows3['Products'] !="")
                $products_id3 .= rtrim($get_rows3['Products'],',').',';
        }
        $products_id3 = rtrim( $products_id3,',');

        $get_result4 = $this->db->query("SELECT Products FROM t_Batteries"); // batteries
        $products_id4 = '';
        foreach($get_result4->result_array() as $get_rows4 ){
            if($get_rows4['Products'] !="")
                $products_id4 .= rtrim($get_rows4['Products'],',').',';
        }
        $products_id4 = rtrim( $products_id4,',');

        $get_result5 = $this->db->query("SELECT Products FROM t_Locks"); // Locks
        $products_id5 = '';
        foreach($get_result5->result_array() as $get_rows5 ){
            if($get_rows5['Products'] !="")
                $products_id5 .= rtrim($get_rows5['Products'],',').',';
        }
        $products_id5 = rtrim( $products_id5,',');

        $products_id_total = $products_id.','.$products_id2.','.$products_id3.','.$products_id4.','.$products_id5;
        $products_id_array = explode(',',$products_id_total);
        $products_id_array = array_filter($products_id_array, 'is_numeric');
        return array_unique($products_id_array);
    }

    public function get_codeconvert($code,$code_series){  
        $cs = $this->db->query("SELECT UUID,Code_Series_Name FROM t_Code_Series WHERE id ='".$code_series."' "); 
        $cs_row = $cs->result_array();
        $Code_Series_id = $cs_row[0]['UUID'];
        $sentence = $code;
        $string = '0'; 
        $position = '1';
        $code2 = substr_replace( $sentence, $string, $position, 0 ); 
        $code3 = substr_replace( $sentence, '00', $position, 0 ); 
        $code4 = substr_replace( $sentence, '000', $position, 0 );
        $code5 = substr_replace( $sentence, '0000', $position, 0 );
        $code6 = substr_replace( $sentence, '00000', $position, 0 );
        $result = $this->db->query("select c.The_Cut,The_Cut_Bot FROM cs_auto_codes_headers as h JOIN cs_auto_codes_cuts c ON h.Auto_Num = c.Header_ID WHERE h.Code_Series_UUID='".$Code_Series_id."' AND  (c.The_Code='".$code."' OR c.The_Code='".$code2."' OR c.The_Code='".$code3."' OR c.The_Code='".$code4."' OR c.The_Code='".$code5."' OR c.The_Code='".$code6."')" );
        if ($result->num_rows() > 0) {
           $result2 = $result->result_array();
            $res[] = array('cut'=>$result2[0]['The_Cut'],'Code_Series_Name'=>$cs_row[0]['Code_Series_Name'],'bottom_cut'=>$result2[0]['The_Cut_Bot']);
       } else {
            $res['error'] = true;
            $res['message'] = 'Invalid Code for this Vehicle';
       }
       return $res;
    }

    public function getCid($id){
        if(is_numeric($id)){
            $query = $this->admin_db->select('clicks,redirect_to,cid')->where('cid',$id)->get('campaign_manager');
        }else{
            $query = $this->admin_db->select('clicks,redirect_to,cid')->where('short_code',$id)->get('campaign_manager');
        }
        if ($query->num_rows() > 0) {
            $result2 = $query->result_array();
            $last_count = 1;
            $cid = $result2[0]['cid'];
            if($result2[0]['clicks'] > 0){
                $last_count = $result2[0]['clicks']+1;
            }else{
                $last_count = 1;
            }
            $data = array(
				'clicks' => $last_count,
				'last_clicked' => date('Y-m-d')
			);
            $this->admin_db->where('cid', $cid);
            $data = $this->security->xss_clean($data);
            $this->admin_db->update('campaign_manager', $data);
            return $query->result_array();
        }else{
            return array();
        }   
    }

    public function productsData(){
        return productsData();
    }

    public function deleteFacility($id){
        $this->admin_db->where('id', $id);
		$this->admin_db->delete('customers_inventory_setup'); 
    }
    public function deleteInventoryItem($id){
        $this->admin_db->where('products_id', $id);
		$this->admin_db->delete('inventory_items'); 
    } 
    public function clearInventory($id){
        $this->admin_db->where('fc_id', $id);
		$this->admin_db->delete('inventory_setup_stock'); 
    } 
    
    public function productsSearch($search){
        //return productsData();
        $search = str_replace('__',' ', $search);
        $explode_search =  explode(' ',$search);
        
        $name_search_data = '';
        foreach($explode_search as $s_val){
           $name_search_data .= "pd.products_name LIKE '%".$s_val."%' OR ";
        }
        $name_search_data = rtrim($name_search_data,'OR ');
        if (is_numeric($search)) {
            $products  = $this->admin_db->query("SELECT p.products_id FROM products p LEFT JOIN products_description pd ON (p.products_id = pd.products_id) where 
            p.products_id = ".$search." "); 
        }else{
            // echo "SELECT p.products_id FROM products p LEFT JOIN products_description pd ON (p.products_id = pd.products_id) where
            // p.products_model LIKE '%".$search."%'  OR 
            // p.cross_ref LIKE '%".$search."%'  OR
            // p.oem_part_number LIKE '%".$search."%'  OR
            // p.product_new_description LIKE '%".$search."%'  OR
            // p.products_remote LIKE '%".$search."%'  OR
            // pd.products_name LIKE '%".$search."%'  OR
            // p.vendor_multiples LIKE '%".$search."%'  OR
            // ".$name_search_data."";

            $products  = $this->admin_db->query("SELECT p.products_id FROM products p LEFT JOIN products_description pd ON (p.products_id = pd.products_id) where
            p.products_model LIKE '%".$search."%'  OR 
            p.cross_ref LIKE '%".$search."%'  OR
            p.oem_part_number LIKE '%".$search."%'  OR
            pd.product_new_description LIKE '%".$search."%'  OR
            p.products_remote LIKE '%".$search."%'  OR
            pd.products_name LIKE '%".$search."%'  OR
            p.vendor_multiples LIKE '%".$search."%'  OR
            ".$name_search_data."");
        } 
        if( $products->num_rows() > 0){
            $p_query_arr = array_unique($products->result_array(), SORT_REGULAR);
            return $p_query_arr;
        }else{
            return array();
        } 
    }


    


    
}