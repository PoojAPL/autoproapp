<?php 
error_reporting(0);
$i=1;
$column = array();
$column[] = 'Name';
$column[] = 'Spaces';
$column[] = 'Depths';
$column[] = 'MACS';
$column[] = 'Key Style';
$column[] = 'First Cut';
$column[] = 'Between Cuts';
$column[] = 'Notes';
//HPC Blitz
$column[] = 'HPC Blitz Card';
$column[] = 'HPC Blitz Cutter';
$column[] = 'HPC Blitz Position';
$column[] = 'HPC Blitz Side';
$column[] = 'HPC Blitz Silca Card';
$column[] = 'HPC Blitz Silca Cutter';
$column[] = 'HPC Blitz Notes';
//HPC Punch
$column[] = 'HPC Punch Card';
$column[] = 'HPC Punch';
$column[] = 'HPC Punch Side';
$column[] = 'HPC Punch Notes';
//HPC CodeMax
$column[] = 'HPC CodeMax DSD';
$column[] = 'HPC CodeMax Side';
$column[] = 'HPC CodeMax Position';
$column[] = 'HPC CodeMax Cutter';
$column[] = 'HPC CodeMax Notes';
//ITL
$column[] = 'ITL ID';
$column[] = 'ITL Insert';
$column[] = 'ITL Notes';
//Curtis
$column[] = 'Curtis Cam Set';
$column[] = 'Curtis Carriage';
$column[] = 'Curtis Cutter';
$column[] = 'Curtis Cutter Notes';
//Keyline Ninja
$column[] = 'Keyline Ninja Vise';
$column[] = 'Keyline Ninja Side';
$column[] = 'Keyline Ninja Position';
$column[] = 'Keyline Ninja Cutter';
//A1 Pak-A-Punch
$column[] = 'A1 Pak-A-Punch QC Kit ';
$column[] = 'A1 Pak-A-Punch Vise';
$column[] = 'A1 Pak-A-Punch Punch';
$column[] = 'A1 Pak-A-Punch Die';
//Framon
$column[] = 'Framon Block';
$column[] = 'Framon Cutter';
$column[] = 'Framon First Cut';
$column[] = 'Framon Between Cuts';
$column[] = 'Framon Notes';
//Sidewinder 2
$column[] = 'Sidewinder 2 Space Rod ';
$column[] = 'Sidewinder 2 Depth Rod ';
$column[] = 'Sidewinder 2 Cutter ';
$column[] = 'Sidewinder 2 Guide';
$column[] = 'Sidewinder 2 Vise Set';
$column[] = 'Sidewinder 2 Stop';
//LKP 3D Xtreme
$column[] = 'LKP 3D Xtreme DSD';
$column[] = 'LKP 3D Xtreme Jaw';
$column[] = 'LKP 3D Xtreme Jaw Clamp ';
$column[] = 'LKP 3D Xtreme Stop';
$column[] = 'LKP 3D Xtreme Cutter';
$column[] = 'LKP 3D Xtreme Notes';
//Keyline 994
$column[] = 'Keyline 994 Vise';
$column[] = 'Keyline 994 Side';
$column[] = 'Keyline 994 Position';
$column[] = 'Keyline 994 Cutter	';
//Silca Futura
$column[] = 'Silca Futura SSN';
$column[] = 'Silca Futura Card';
//Condor XC Mini
$column[] = 'Condor XC Mini Key Name ';
$column[] = 'Condor XC Mini  Cutter ';
$column[] = 'Condor XC Mini Jaw';
$column[] = 'Condor XC Mini  Side';
$column[] = 'Condor XC Mini Stop';
$column[] = 'Condor XC Mini  Notes';

$column[] = 'Determinator';
$column[] = 'Lishi';
$column[] = 'Accu-Reader';
$column[] = 'EEZ-Reader';
$column[] = 'Space & Depth Keys';
$column[] = 'Try-Out Keys';
$column[] = 'Build A Key';
$column[] = 'A1 Auto Picks';
header('Content-Type: text/csv; charset=utf-8');  
header('Content-Disposition: attachment; filename=AutoProApp_Code_Series_'.date('m-d-y').'.csv');  
$output = fopen("php://output", "w");  
fputcsv($output,$column); 
$data = array();
foreach($getAllExportCodeSeries as $value){   

    $data['Code_Series_Name'] = $value['Code_Series_Name'];
    $data['Spaces'] = $value['Spaces'];
    $data['Depths'] = $value['Depths'];    
    $data['MACS'] = $value['MACS'];
    //key style
    $key_id = $value['Key_Style_UUID'];
    $key_name_info = admin_KeyNameInfo($key_id );
    $Key_Style_Name =   $key_name_info[0]['Key_Style_Name'];
    $data['Key_Style_Name'] = $Key_Style_Name;
    $data['First_Cut'] = $value['First_Cut'];    
    $data['Space_Between_Cuts'] = $value['Space_Between_Cuts'];  
    $data['Code_Series_Notes'] = $value['Code_Series_Notes'];  
    //HPC Blitz    
    $get_machines_info = get_machines_info($value['HPC_Blitz_Cutter']);
    $HPC_Blitz_Cutter  =  $get_machines_info[0]['Name'];    
	$get_machines_info = get_machines_info($value['HPC_Blitz_Position']);
    $HPC_Blitz_Position  = $get_machines_info[0]['Name'];    
	$get_machines_info = get_machines_info($value['Silca_Cutter']);
    $Silca_Cutter =  $get_machines_info[0]['Name'];    
    $data['HPC_Blitz_Card'] = $value['HPC_Blitz_Card'];  
    $data['Space_Between_Cuts'] = $value['Space_Between_Cuts'];    
    $data['HPC_Blitz_Cutter'] = $HPC_Blitz_Cutter;  
    $data['HPC_Blitz_Position'] = $HPC_Blitz_Position;  
    $data['HPC_Blitz_Side'] =$value['HPC_Blitz_Side'];  
    $data['Silca_Card'] = $value['Silca_Card'];  
    $data['Silca_Cutter'] = $Silca_Cutter;  
    $data['HPC_Blitz_Notes'] = $value['HPC_Blitz_Notes'];
    //HPC Punch
    $get_t_machines_info = get_t_machines_info2('HPC Punch');
	$get_machines_info = get_machines_info($value['HPC_Punch_Punch']);
    $HPC_Punch_Punch = $get_machines_info[0]['Name'];
    $get_t_machines_info = get_t_machines_info2('HPC Position');	
    $data['HPC_Punch_Card'] = $value['HPC_Punch_Card'];  
    $data['HPC_Punch_Punch'] = $HPC_Punch_Punch;  
    $data['HPC_Punch_Side'] = $value['HPC_Punch_Side']; 
    $data['HPC_Punch_Notes'] = $value['HPC_Punch_Notes'];
    //HPC CodeMax
    $get_machines_info = get_machines_info($value['HPC_CodeMax_Position']);
    $HPC_CodeMax_Position = $get_machines_info[0]['Name'];
    $get_t_machines_info = get_t_machines_info2('HPC Cutter');
	$get_machines_info = get_machines_info($value['HPC_CodeMax_Cutter']);
    $HPC_CodeMax_Cutter = $get_machines_info[0]['Name'];    
    $data['HPC_CodeMax_DSD'] = $value['HPC_CodeMax_DSD'];  
    $data['HPC_CodeMax_Side'] = $value['HPC_CodeMax_Side'];  
    $data['HPC_CodeMax_Position'] = $HPC_CodeMax_Position; 
    $data['HPC_CodeMax_Cutter'] = $HPC_CodeMax_Cutter;  
    $data['HPC_CodeMax_Notes'] = $value['HPC_CodeMax_Notes'];  
    //ITL
    $data['ITL_ID'] = $value['ITL_ID'];  
    $data['ITL_Insert'] = $value['ITL_Insert']; 
    $data['ITL_Notes'] = $value['ITL_Notes']; 
    //Curtis
    $data['Curtis_CamSet'] = $value['Curtis_CamSet']; 
    $data['Curtis_Carriage'] = $value['Curtis_Carriage']; 
    $data['Curtis_Cutter'] = $value['Curtis_Cutter']; 
    $data['Curtis_Notes'] = $value['Curtis_Notes']; 
    //Keyline Ninja   
	$get_machines_info = get_machines_info($value['Keyline_Ninja_Vice']);
    $Keyline_Ninja_Vice = $get_machines_info[0]['Name'];    
	$get_machines_info = get_machines_info($value['Keyline_Ninja_Cutter']);
    $Keyline_Ninja_Cutter = $get_machines_info[0]['Name'];
    $data['Keyline_Ninja_Vice'] = $Keyline_Ninja_Vice; 
    $data['Keyline_Ninja_Side'] = $value['Keyline_Ninja_Side']; 
    $data['Keyline_Ninja_Position'] = $value['Keyline_Ninja_Position']; 
    $data['Keyline_Ninja_Cutter'] = $Keyline_Ninja_Cutter; 
    //A1 Pak-A-Punch
    $get_machines_info = get_machines_info($value['Pak_QCKit']);
    $Pak_QCKit = $get_machines_info[0]['Name'];    
    $get_machines_info = get_machines_info($value['Pak_Punch']);
    $Pak_Punch = $get_machines_info[0]['Name'];   
    $get_machines_info = get_machines_info($value['Pak_Die']);
    $Pak_Die = $get_machines_info[0]['Name'];
    $data['Pak_QCKit'] = $Pak_QCKit; 
    $data['Pak_Vise'] = $value['Pak_Vise']; 
    $data['Pak_Punch'] = $Pak_Punch; 
    $data['Pak_Die'] = $Pak_Die; 
    //Framon
    $get_machines_info = get_machines_info($value['Framon_Cutter']);
    $Framon_Cutter = $get_machines_info[0]['Name'];
    $data['Framon_Block'] = $value['Framon_Block'];
    $data['Framon_Cutter'] = $Framon_Cutter;
    $data['Framon_FirstCut'] = $value['Framon_FirstCut'];
    $data['Framon_BetweenCuts'] = $value['Framon_BetweenCuts'];
    $data['Framon_Notes'] = $value['Framon_Notes'];
    //Sidewinder 2
    $get_machines_info = get_machines_info($value['SW2_Cutter']);
    $SW2_Cutter = $get_machines_info[0]['Name'];   
	$get_machines_info = get_machines_info($value['SW2_Guide']);
    $SW2_Guide =  $get_machines_info[0]['Name'];
    $get_machines_info = get_machines_info($value['SW2_Stop']);
    $SW2_Stop =  $get_machines_info[0]['Name'];
    $data['SW2_SpaceRod'] = $value['SW2_SpaceRod'];
    $data['SW2_DepthRod'] = $value['SW2_DepthRod'];
    $data['SW2_Cutter'] = $SW2_Cutter;
    $data['SW2_Guide'] = $SW2_Guide;
    $data['SW2_ViseSet'] = $value['SW2_ViseSet'];    
    $data['SW2_Stop'] = $SW2_Stop;
    //LKP 3D Xtreme    
    $get_machines_info = get_machines_info($value['LKP_3DX_Jaw']);
    $LKP_3DX_Jaw = $get_machines_info[0]['Name'];
	$get_machines_info = get_machines_info($value['LKP_3DX_JawClamp']);
    $LKP_3DX_JawClamp = $get_machines_info[0]['Name'];
	$get_machines_info = get_machines_info($value['LKP_3DX_Stop']);
    $LKP_3DX_Stop = $get_machines_info[0]['Name'];
    $get_machines_info1 = get_machines_info($value['LKP_3DX_Cutter']);
    $LKP_3DX_Cutter = $get_machines_info1[0]['Name'];
    $data['LKP_3DX_DSD'] = $value['LKP_3DX_DSD'];
    $data['LKP_3DX_Jaw'] = $LKP_3DX_Jaw;
    $data['LKP_3DX_JawClamp'] = $LKP_3DX_JawClamp;
    $data['LKP_3DX_Stop'] = $LKP_3DX_Stop;
    $data['LKP_3DX_Cutter'] = $LKP_3DX_Cutter;
    $data['LKP_3DX_Notes'] = $value['LKP_3DX_Notes'];
    //Keyline 994
    $get_machines_info = get_machines_info($value['Keyline_994_Vise']);
    $Keyline_994_Vise =  $get_machines_info[0]['Name'];
    $get_machines_info = get_machines_info($value['Keyline_994_Cutter']);
    $Keyline_994_Cutter = $get_machines_info[0]['Name'];
    $data['Keyline_994_Vise'] = $Keyline_994_Vise;
    $data['Keyline_994_Side'] = $value['Keyline_994_Side'];
    $data['Keyline_994_Position'] = $value['Keyline_994_Position'];
    $data['Keyline_994_Cutter'] = $Keyline_994_Cutter;
    //Silca Futura
    $data['Silca_Futura_SSN'] = $value['Silca_Futura_SSN']; 
    $data['Silca_Futura_Card'] = $value['Silca_Futura_Card']; 
    //Condor XC Mini
     $get_machines_info1 = get_machines_info($value['Condor_Cutter']);
    $Condor_Cutter = $get_machines_info1[0]['Name'];    
    $get_machines_info1 = get_machines_info($value['Condor_Jaw']);
    $Condor_Jaw = $get_machines_info1[0]['Name'];    
    $get_machines_info1 = get_machines_info($value['Condor_JawSide']);
    $Condor_JawSide = $get_machines_info1[0]['Name'];    
    $get_machines_info1 = get_machines_info($value['Condor_Stop']);
    $Condor_Stop = $get_machines_info1[0]['Name'];    
    $data['Condor_KeyName'] = $value['Condor_KeyName']; 
    $data['Condor_Cutter'] = $Condor_Cutter; 
    $data['Condor_Jaw'] = $Condor_Jaw;
    $data['Condor_JawSide'] = $Condor_JawSide;
    $data['Condor_Stop'] = $Condor_Stop;  
    $data['Condor_Notes'] =  $value['Condor_Notes'];
    //Determinator
    $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($value['Determinator_UUID']);
    $Determinator_UUID = $get_manufactyrer_by_uuid[0]['Tool_Name'];
    $data['Determinator_UUID'] = $Determinator_UUID;
    //Lishi
    $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($value['Lishi_UUID']);
    $Lishi_UUID = $get_manufactyrer_by_uuid[0]['Tool_Name'] ;
    $data['Lishi_UUID'] = $Lishi_UUID;
    //Accu-Reader
    $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($value['Accu-Reader_UUID']);
    $Reader_UUID = $get_manufactyrer_by_uuid[0]['Tool_Name'] ;
    $data['Accu-Reader_UUID'] = $Reader_UUID;
    //EEZ Reader
    $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($value['EEZ-Reader_UUID']);
    $EEZ_Reader_UUID = $get_manufactyrer_by_uuid[0]['Tool_Name'] ;    
    $data['EEZ_Reader_UUID'] = $EEZ_Reader_UUID;
    //Space & Depth Keys
    $get_toolType_by_uuid = get_toolName_by_uuid($value['SDKeys_UUID']);
    $SDKeys_UUID = $get_toolType_by_uuid[0]['Tool_Name'] ;
    $data['SDKeys_UUID'] = $SDKeys_UUID;
    //Try-Out Keys
    $try_out_keys_array  = explode(',',$value['TryOutKeys_UUID']);
    $TryOutKeys_UUID = "";
    for($tr = 0; $tr < count($try_out_keys_array); $tr++){
        $get_toolType_by_uuid = get_toolName_by_uuid($try_out_keys_array[$tr]);
        $TryOutKeys_UUID .=  $get_toolType_by_uuid[0]['Tool_Name'].',';
    }
   $TryOutKeys_UUID =  rtrim($TryOutKeys_UUID,',');
    $data['TryOutKeys_UUID'] = $TryOutKeys_UUID;
   //Build A Key
   $get_toolType_by_uuid = get_toolName_by_uuid($value['BuildAKey_UUID']);
   $BuildAKey_UUID = $get_toolType_by_uuid[0]['Tool_Name'] ;   
   $data['BuildAKey_UUID'] = $BuildAKey_UUID;
   //A1 Auto Picks 
   $get_toolType_by_uuid = get_toolName_by_uuid($value['A1AutoPicks_UUID']);
   $A1AutoPicks_UUID = $get_toolType_by_uuid[0]['Tool_Name'] ;
   $data['A1AutoPicks_UUID'] = $A1AutoPicks_UUID;
    fputcsv($output, $data); 
}
fclose($output);  

//print_r($getAllVehiclesDataCSV );
?>