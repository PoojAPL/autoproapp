<?php error_reporting(0);?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">    	
    	<div class="col-sm-24">
        <div class="form-group addCodeSeries">          
         <a href="<?php echo adm_base_url();?>/vehicles/codeseries" class="btn btn-danger" >Back<<</a>        
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    	<?php echo $this->session->flashdata('message_display');?>
       <?php } ?>       
        <div class="site-form">
          <div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
            <?php 						
				
				$code_series_array = array();
				foreach($getAllCodeSeries as $value){
					$HPC_Blitz = array();
					$HPC_Punch = array();
					$HPC_CodeMax = array();
					$ITL = array();
					$Curtis = array();
					$Keyline_Ninja = array();
					$Pak = array();
					$Framon = array();
					$SW2 = array();
					$LKP_3DX = array();
					$Keyline_994 = array();
					$Silca_Futura = array();
					$Code_Series_Name =  $value['Code_Series_Name'];
					$HPC_Blitz = array('HPC_Blitz_Card' => $value['HPC_Blitz_Card'],'HPC_Blitz_Cutter' => $value['HPC_Blitz_Cutter'],'HPC_Blitz_Position' => $value['HPC_Blitz_Position'],'HPC_Blitz_Card' => $value['HPC_Blitz_Card'],'HPC_Blitz_Card' => $value['HPC_Blitz_Card'],'HPC_Blitz_Cutter' => $value['HPC_Blitz_Cutter'],'HPC_Blitz_Position' => $value['HPC_Blitz_Position'],'HPC_Blitz_Side' => $value['HPC_Blitz_Side'], 'HPC_Blitz_Notes' => $value['HPC_Blitz_Notes'],'Silca_Card' => $value['Silca_Card'],'Silca_Cutter' => $value['Silca_Cutter']);
					
					$HPC_Punch = array('HPC_Punch_Card' => $value['HPC_Punch_Card'],'HPC_Punch_Punch' => $value['HPC_Punch_Punch'],'HPC_Punch_Side' => $value['HPC_Punch_Side'],'HPC_Punch_Notes' => $value['HPC_Punch_Notes']);
					
					$HPC_CodeMax = array('HPC_CodeMax_DSD' => $value['HPC_CodeMax_DSD'],'HPC_CodeMax_Side' => $value['HPC_CodeMax_Side'],'HPC_CodeMax_Position' => $value['HPC_CodeMax_Position'],'HPC_CodeMax_Cutter' => $value['HPC_CodeMax_Cutter'],'HPC_CodeMax_Notes' => $value['HPC_CodeMax_Notes']);
					
					$ITL = array('ITL_ID' => $value['ITL_ID'],'ITL_Insert' => $value['ITL_Insert'],'ITL_Notes' => $value['ITL_Notes']);
					
					$Curtis = array('Curtis_CamSet' => $value['Curtis_CamSet'],'Curtis_Carriage' => $value['Curtis_Carriage'],'Curtis_Cutter' => $value['Curtis_Cutter'],'Curtis_Notes' => $value['Curtis_Notes']);
					
					$Keyline_Ninja = array('Keyline_Ninja_Vice' => $value['Keyline_Ninja_Vice'],'Keyline_Ninja_Side' => $value['Keyline_Ninja_Side'],'Keyline_Ninja_Position' => $value['Keyline_Ninja_Position'],'Keyline_Ninja_Cutter' => $value['Keyline_Ninja_Cutter']);
					
					$Pak = array('Pak_QCKit' => $value['Pak_QCKit'],'Pak_Vise' => $value['Pak_Vise'],'Pak_Punch' => $value['Pak_Punch'],'Pak_Die' => $value['Pak_Die']);
					
					$Framon = array('Framon_Block' => $value['Framon_Block'],'Framon_Cutter' => $value['Framon_Cutter'],'Framon_FirstCut' => $value['Framon_FirstCut'],'Framon_BetweenCuts' => $value['Framon_BetweenCuts'],'Framon_Notes' => $value['Framon_Notes']);
					
					$SW2 = array('SW2_SpaceRod' => $value['SW2_SpaceRod'],'SW2_DepthRod' => $value['SW2_DepthRod'],'SW2_Cutter' => $value['SW2_Cutter'],'SW2_Guide' => $value['SW2_Guide'],'SW2_ViseSet' => $value['SW2_ViseSet'],'SW2_Stop' => $value['SW2_Stop']);
					
					$LKP_3DX = array('LKP_3DX_DSD' => $value['LKP_3DX_DSD'],'LKP_3DX_Jaw' => $value['LKP_3DX_Jaw'],'LKP_3DX_JawClamp' => $value['LKP_3DX_JawClamp'],'LKP_3DX_Stop' => $value['LKP_3DX_Stop'],'LKP_3DX_Cutter' => $value['LKP_3DX_Cutter'],'LKP_3DX_Notes' => $value['LKP_3DX_Notes']);
					
					$Keyline_994 = array('Keyline_994_Vise' => $value['Keyline_994_Vise'],'Keyline_994_Side' => $value['Keyline_994_Side'],'Keyline_994_Position' => $value['Keyline_994_Position'],'Keyline_994_Cutter' => $value['Keyline_994_Cutter']);					
					
					$Silca_Futura = array('Silca_Futura_SSN' => $value['Silca_Futura_SSN'],'Silca_Futura_Card' => $value['Silca_Futura_Card']);
						
					$series_array[$Code_Series_Name] = array('Spaces' => $value['Spaces'], 'Depths' => $value['Depths'],'MACS' => $value['MACS'],'Key_Style_UUID' => $value['Key_Style_UUID'],'First_Cut' => $value['First_Cut'],'Space_Between_Cuts' => $value['Space_Between_Cuts'],'Code_Series_Notes' => $value['Code_Series_Notes'],'HPC Blitz' => $HPC_Blitz,'HPC Punch' => $HPC_Punch,'HPC CodeMax' => $HPC_CodeMax, 'ITL' => $ITL, 'Curtis' => $Curtis,'Keyline Ninja' => $Keyline_Ninja,'A1 Pak-A-Punch' => $Pak,'Framon' => $Framon,'SW2' => $SW2, 'LKP_3DX' => $LKP_3DX,'Keyline_994' => $Keyline_994, 'Silca_Futura' => $Silca_Futura,'Determinator_UUID' => $value['Determinator_UUID'],'Lishi_UUID'=>$value['Lishi_UUID'],'Accu-Reader_UUID' =>  $value['Accu-Reader_UUID'],'EEZ-Reader_UUID'=> $value['EEZ-Reader_UUID'],'SDKeys_UUID'=>$value['SDKeys_UUID'],$value['BuildAKey_UUID'],'TryOutKeys_UUID' => $value['TryOutKeys_UUID'],'A1AutoPicks_UUID' => $value['A1AutoPicks_UUID']);
						
				}
				$main_array = array('date' => date('dmYhms'), 'code_series_list' => $series_array);	
				$data = json_encode($main_array);
				//print_r($data);
				//$options['auth'] = 'tDpktmFrLHJRZIBCoyPUU68ba4gbnQRUhqdn6y9H'; 
				$options['auth'] = 'PomxyBl1zWE3q6fUAlVL6BhpntIWGwFmD47NlWbe';
				$cSession = curl_init(); 				
				curl_setopt($cSession,CURLOPT_URL,"https://autoproapp2017.firebaseio.com/code_series_list.json?". http_build_query($options));
				//curl_setopt($cSession,CURLOPT_URL,"https://american-key.firebaseio.com/code_series_list.json?");
				curl_setopt($cSession, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));	
				curl_setopt($cSession, CURLOPT_CUSTOMREQUEST, "PUT");						
				curl_setopt($cSession, CURLOPT_POSTFIELDS,$data); 
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);												
				//step3
				$result_output = curl_exec($cSession);
				//step4
				$httpcode = curl_getinfo($cSession, CURLINFO_HTTP_CODE);						
                $curl_error = curl_error($cSession);
				$result_output = json_decode($result_output, True);
                if(isset($result_output['error']) && $result_output['error'] != ""){
                  echo '<div class="alert alert-danger">'.$result_output['error'].'</div>';
                }else if( $httpcode == 200){
					echo '<div class="alert alert-success">Data added Successfully!</div>';
				}else if( $httpcode == 400){
					echo '<div class="alert alert-danger">HTTP 400 Bad Request, please try again</div>';
				}else if( !empty($curl_error)){
					echo '<div class="alert alert-danger">'.$curl_error.'</div>';
				}else{
					echo '<div class="alert alert-danger">Something went wrong, please try again</div>';
				} 
				curl_close($cSession);
				//step5
				
				//echo $result_output;
			?>
           <!-- <div class="alert alert-danger">Data not found!</div>-->
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->