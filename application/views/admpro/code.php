<?php
if( isset($this->session->userdata['code_series_pagination'])){
	$per_page1 = $this->session->userdata['code_series_pagination'];
	$per_page = $per_page1['per_page'];
}else{
	$per_page = "";
}
$machine_hide = '';
$machine_checked = '';
if(isset($_COOKIE['MachineInfo_cookie'])){ 
	 $cookieValue = $_COOKIE['MachineInfo_cookie'];
	 if( $cookieValue == 1){
		$machine_hide = 'hide';
		$machine_checked = 'checked';
	 }else{
		$machine_hide = '';
		$machine_checked = '';
	 }
}
 
$decoder_hide = '';
$decoder_checked = '';
 if(isset($_COOKIE['Decoders_cookie'])){ 
	 $cookieValue = $_COOKIE['Decoders_cookie'];
	 if( $cookieValue == 1){
		$decoder_hide = 'hide';
		$decoder_checked = 'checked';
	 }else{
		$decoder_hide = '';
		$decoder_checked = '';
	 }
}
?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
          <label>Results Per Page</label>
          <?php $pagination_array = array(50,100,150,200);?>
   			 <select class="form-control select-field" id="code_series_pagination" name="searching">              
             	<?php foreach($pagination_array as $page){
					if($per_page == $page){
						$selected = 'selected';
					}else{
						if($per_page == $totalrows){
							$selected = 'selected';
						}else{
							$selected = '';
						}
					}
					?>
                <option <?php echo $selected;?>><?php echo $page;?></option>
                <?php } ?>
                <option value="<?php echo $totalrows;?>" <?php echo $selected;?>>Show All</option>  				                                  
          </select>
          <!--<input type="text" class="form-control sm-input" placeholder="" id="result">-->
        </div>
      </div>
      <div class="col-sm-6">
      	<div class="form-group">
        	 <label>Show Key Style </label>
             <select class="form-control select-field filterCsBykstyle">
             	<option value="all">All</option>
                <?php foreach($getAllKeyStyles as $k_style){ ?>
					<option value="<?php echo $k_style['UUID'];?>"><?php echo $k_style['Key_Style_Name'];?></option>
				<?php }	?>
             </select>
      	</div>
      </div>
      <div class="col-sm-6">
            <form method="post" id="searchCodeSeries">
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control"  /><button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
      </div>
      <div class="col-sm-6">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/vehicles/add_code" class="btn btn-danger"  title="Sign Out">Add New Code Series</a>        
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-22"><a href="<?php echo adm_base_url();?>/export_all_codeseries_info" target="_blank" class="btn btn-primary">Export to CSV</a></div>
      <div class="col-sm-2">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/update_code_series_info" class="btn btn-success">Firebase Update</a>       
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    		<?php echo $this->session->flashdata('message_display');?>
     <?php }?>
     	<input type="checkbox" class="HideMachineInfo" <?php echo $machine_checked;?> /> Hide Machine Info &nbsp; &nbsp;
        <input type="checkbox" class="HideDecoders" <?php echo $decoder_checked;?> /> Hide Decoders <br /><br />         
        <div class="site-form code_series_data">
          <div class="table-responsive">
            <table class="table table-bordered  table-data mar0 tab-con">
                <thead>
                    <tr class="first_tr">
					<th style="width:137px;" rowspan="2"> Action</th>
                        <th rowspan="2">Name
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Code_Series_Name" data_id="DESC"></a>
                        </th>
                        <th rowspan="2">Spaces
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Spaces" data_id="DESC"></a>
                        </th>
                        <th rowspan="2">Depths
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Depths" data_id="DESC"></a>
                        </th>
                        <th rowspan="2">MACS
                         <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="MACS" data_id="DESC"></a>
                        </th>
                        <th rowspan="2">Key Style
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="Key_Style_UUID" data_id="DESC"></a>
                        </th>
                        <th rowspan="2">First Cut
                         <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="First_Cut" data_id="DESC"></a>
                        </th>
                        <th rowspan="2">Between <br /> Cuts
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Space_Between_Cuts" data_id="DESC"></a>
                        </th>
                        <th rowspan="2">Notes</th>
                        <th colspan="7" class="machine <?php echo $machine_hide;?>">HPC Blitz</th>
                        <th colspan="4" class="machine <?php echo $machine_hide;?>">HPC Punch</th>
                        <th colspan="5" class="machine <?php echo $machine_hide;?>">HPC CodeMax</th>
                        <th colspan="3" class="machine <?php echo $machine_hide;?>">ITL</th>
                        <th colspan="4" class="machine <?php echo $machine_hide;?>">Curtis</th>
                        <th colspan="4" class="machine <?php echo $machine_hide;?>">Keyline Ninja</th>
                        <th colspan="4" class="machine <?php echo $machine_hide;?>">A1 Pak-A-Punch</th>
                        <th colspan="5" class="machine <?php echo $machine_hide;?>">Framon</th>
                        <th colspan="6" class="machine <?php echo $machine_hide;?>">Sidewinder 2</th>
                        <th colspan="6" class="machine <?php echo $machine_hide;?>">LKP 3D Xtreme</th>
                        <th colspan="4" class="machine <?php echo $machine_hide;?>">Keyline 994</th>
                        <th colspan="2" class="machine <?php echo $machine_hide;?>">Silca Futura</th>
                        <th colspan="6" class="condor">Condor XC Mini</th>
                        <th rowspan="2" class="decoder <?php echo $decoder_hide;?>">Determinator
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Determinator_UUID" data_id="DESC"></a>
                        </th>
                        <th rowspan="2" class="decoder <?php echo $decoder_hide;?>">Lishi
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Lishi_UUID" data_id="DESC"></a>
                        </th>
                        <th rowspan="2" class="decoder <?php echo $decoder_hide;?>">Accu-Reader</th>
                        <th rowspan="2" class="decoder <?php echo $decoder_hide;?>">EEZ-Reader</th>
                        <th rowspan="2" class="decoder <?php echo $decoder_hide;?>">Space &amp; Depth Keys
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="SDKeys_UUID" data_id="DESC"></a>
                        </th>
                        <th rowspan="2" class="decoder <?php echo $decoder_hide;?>">Try-Out Keys
                         <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="TryOutKeys_UUID" data_id="DESC"></a>
                        </th>
                        <th rowspan="2" class="decoder <?php echo $decoder_hide;?>">Build A Key
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="BuildAKey_UUID" data_id="DESC"></a>
                        </th>
                        <th rowspan="2" class="decoder <?php echo $decoder_hide;?>">A1 Auto Picks
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="A1AutoPicks_UUID" data_id="DESC"></a>
                        </th>
                        
                    </tr>
                    <tr>
                      <th class="machine <?php echo $machine_hide;?>">Card
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="HPC_Blitz_Card" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Cutter
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="HPC_Blitz_Cutter" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Position
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="HPC_Blitz_Position" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Side
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="HPC_Blitz_Side" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Silca Card
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Silca_Card" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Silca Cutter
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="Silca_Cutter" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Notes</th>
                      <th class="machine <?php echo $machine_hide;?>">Card
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="HPC_Punch_Card" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Punch
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="HPC_Punch_Punch" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Side
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="HPC_Punch_Side" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Notes</th>
                      <th class="machine <?php echo $machine_hide;?>">DSD
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="HPC_CodeMax_DSD" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Side
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="HPC_CodeMax_Side" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Position
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="HPC_CodeMax_Position" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Cutter
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="HPC_CodeMax_Cutter" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Notes</th>
                      <th class="machine <?php echo $machine_hide;?>">ID
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="ITL_ID" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Insert
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="ITL_Insert" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Notes</th>
                      <th class="machine <?php echo $machine_hide;?>">Cam Set
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Curtis_CamSet" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Carriage
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Curtis_Carriage" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Cutter
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Curtis_Cutter" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Notes</th>
                      <th class="machine <?php echo $machine_hide;?>">Vise
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="Keyline_Ninja_Vice" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Side
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Keyline_Ninja_Side" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Position
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Keyline_Ninja_Position" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Cutter
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="Keyline_Ninja_Cutter" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">QC Kit
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="Pak_QCKit" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Vise
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Pak_Vise" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Punch
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="Pak_Punch" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Die
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="Pak_Die" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Block
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Framon_Block" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Cutter
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="Framon_Cutter" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">First Cut
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Framon_FirstCut" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Between Cuts
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Framon_BetweenCuts" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Notes</th>
                      <th class="machine <?php echo $machine_hide;?>">Space Rod
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="SW2_SpaceRod" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Depth Rod
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="SW2_DepthRod" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Cutter</th>
                      <th class="machine <?php echo $machine_hide;?>">Guide</th>
                      <th class="machine <?php echo $machine_hide;?>">Vise Set
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="SW2_ViseSet" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Stop
                       <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="SW2_Stop" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">DSD
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="LKP_3DX_DSD" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Jaw
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="LKP_3DX_Jaw" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Jaw Clamp
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="LKP_3DX_JawClamp" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Stop 
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="LKP_3DX_Stop" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Cutter
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="LKP_3DX_Cutter" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Notes</th>
                      <th class="machine <?php echo $machine_hide;?>">Vise
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_uuid_sort" data-by="Keyline_994_Vise" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Side
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Keyline_994_Side" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Position
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Keyline_994_Position" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Cutter</th>
                      <th class="machine <?php echo $machine_hide;?>">SSN
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Silca_Futura_SSN" data_id="DESC"></a>
                      </th>
                      <th class="machine <?php echo $machine_hide;?>">Card
                      <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Silca_Futura_Card" data_id="DESC"></a>
                      </th> 
                      <th>Key Name
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Condor_KeyName" data_id="DESC"></a>
                      </th>
                      <th>Cutter
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Condor_Cutter" data_id="DESC"></a>
                      </th>
                      <th>Jaw
                         <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Condor_Jaw" data_id="DESC"></a>
                      </th>
                      <th>Side
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Condor_JawSide" data_id="DESC"></a>
                      </th>
                      <th>Stop
                         <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Condor_Stop" data_id="DESC"></a>
                      </th>
                      <th>Notes
                        <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom code_series_sort" data-by="Condor_Notes" data_id="DESC"></a>
                      </th>                                                  
                    </tr>
                  </thead>
              <tbody>
              <?php
			   $i = 1;
			   foreach($results as $value){?>
                     <tr>
							<td>
                              <a  href="<?php echo adm_base_url();?>/vehicles/copy_code/<?php echo $value['id'];?>" type="button" class="btn btn-info">Copy</a> 
                              <a  href="<?php echo adm_base_url();?>/vehicles/edit_codeSeries/<?php echo $value['id'];?>" type="button" class="btn btn-success">Edit</a>
                          <a  href="javascript:void(0)" onclick="DeleteCodeFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/vehicles/deleteCode/')" type="button"class="btn btn-danger" >Delete</a>
                          </td>					 
                          <td  class="column_data"><span class="tdvalue"><?php echo $value['Code_Series_Name'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Code_Series_Name'];?>" data-id="<?php echo $value['id'];?>" data-col = "Code_Series_Name"></span>
                            <div class="get_column_data"></div>
                          </td>                          
                          <td  class="column_data"><span class="tdvalue"><?php echo $value['Spaces'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Spaces'];?>" data-id="<?php echo $value['id'];?>" data-col = "Spaces"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class="column_data"><span class="tdvalue"><?php echo $value['Depths'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Depths'];?>" data-id="<?php echo $value['id'];?>" data-col = "Depths"></span>
                            <div class="get_column_data"></div>
                          </td>
                         <td  class="column_data"><span class="tdvalue"><?php echo $value['MACS'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['MACS'];?>" data-id="<?php echo $value['id'];?>" data-col = "MACS"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td class="dropbox_data">
                              <?php 
                                  $key_id = $value['Key_Style_UUID'];
                                  $key_name_info = admin_KeyNameInfo($key_id );
                                  if(isset($key_name_info[0]['Key_Style_Name'])){
                                      echo '<span class="tdvalue">'.$key_name_info[0]['Key_Style_Name'].'</span>';
                                  }
                              ?>
                              <span class="glyphicon glyphicon-pencil edit_cs_key_style" aria-hidden="true" data-val="<?php echo $value['Key_Style_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col= "Key_Style_UUID"></span>
                            <div class="get_column_data"></div>
                          </td>                         
                          <td  class="column_data"><span class="tdvalue"><?php echo $value['First_Cut'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['First_Cut'];?>" data-id="<?php echo $value['id'];?>" data-col = "First_Cut"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class="column_data"><span class="tdvalue"><?php echo $value['Space_Between_Cuts'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Space_Between_Cuts'];?>" data-id="<?php echo $value['id'];?>" data-col = "Space_Between_Cuts"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class="column_data">
                          <div class="product-holder"><span class="tdvalue"><?php echo $value['Code_Series_Notes'];?></span></div>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Code_Series_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col = "Code_Series_Notes"></span>
                            <div class="get_column_data"></div>
                          </td>                   
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['HPC_Blitz_Card'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['HPC_Blitz_Card'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_Blitz_Card"></span>
                            <div class="get_column_data"></div>
                          </td> 
                          <td class="machine <?php echo $machine_hide;?>">
                          <?php 
							$class = "";
							$get_t_machines_info = get_t_machines_info2('HPC Cutter');
							$get_machines_info = get_machines_info($value['HPC_Blitz_Cutter']);
							if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
								$class = "";
							}else{
								$class = "uuid_error";
							}	
							?> 						  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['HPC_Blitz_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_Blitz_Cutter" data-key="HPC Cutter"></span>
                            <div class="get_column_data"></div>                        
                          </td>                         
                          <td class="machine <?php echo $machine_hide;?>">
                          <?php 
							$class = "";
							$get_t_machines_info = get_t_machines_info2('HPC Position');
							$get_machines_info = get_machines_info($value['HPC_Blitz_Position']);
							if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
								$class = "";
							}else{
								$class = "uuid_error";
							}	
							?> 						  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['HPC_Blitz_Position'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_Blitz_Position" data-key="HPC Position"></span>
                            <div class="get_column_data"></div>                      
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['HPC_Blitz_Side'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['HPC_Blitz_Side'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_Blitz_Side"></span>
                            <div class="get_column_data"></div>
                          </td> 
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Silca_Card'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Silca_Card'];?>" data-id="<?php echo $value['id'];?>" data-col = "Silca_Card"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td class="machine <?php echo $machine_hide;?>">	
                          	<?php 
							$class = "";
							$get_t_machines_info = get_t_machines_info2('Silca Cutter');
							$get_machines_info = get_machines_info($value['Silca_Cutter']);
							if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
								$class = "";
							}else{
								$class = "uuid_error";
							}	
							?>                           
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Silca_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "Silca_Cutter" data-key="Silca Cutter"></span>
                            <div class="get_column_data"></div>                           
                          </td>
                         <td  class=" machine <?php echo $machine_hide;?> column_data "><div class="product-holder"><span class="tdvalue"><?php echo $value['HPC_Blitz_Notes'];?></span></div>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['HPC_Blitz_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_Blitz_Notes"></span>
                            <div class="get_column_data"></div>
                          </td>
                            
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['HPC_Punch_Card'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['HPC_Punch_Card'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_Punch_Card"></span>
                            <div class="get_column_data"></div>
                          </td>                       
                          <td class="machine <?php echo $machine_hide;?>">	
                          	<?php 
							$class = "";
							$get_t_machines_info = get_t_machines_info2('HPC Punch');
							$get_machines_info = get_machines_info($value['HPC_Punch_Punch']);
							if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
								$class = "";
							}else{
								$class = "uuid_error";
							}	
							?>                          
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['HPC_Punch_Punch'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_Punch_Punch" data-key="HPC Punch"></span>
                            <div class="get_column_data"></div>                                       
                          </td>
                         
                           <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['HPC_Punch_Side'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['HPC_Punch_Side'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_Punch_Side"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><div class="product-holder"><span class="tdvalue"><?php echo $value['HPC_Punch_Notes'];?></span></div>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['HPC_Punch_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_Punch_Notes"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['HPC_CodeMax_DSD'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['HPC_CodeMax_DSD'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_CodeMax_DSD"></span>
                            <div class="get_column_data"></div>
                          </td>
                         <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['HPC_CodeMax_Side'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['HPC_CodeMax_Side'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_CodeMax_Side"></span>
                            <div class="get_column_data"></div>
                          </td>                
                          <td class="machine <?php echo $machine_hide;?>">
                            <?php 
							$class = "";
							$get_t_machines_info = get_t_machines_info2('HPC Position');
							$get_machines_info = get_machines_info($value['HPC_CodeMax_Position']);
							if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
								$class = "";
							}else{
								$class = "uuid_error";
							}	
							?>						  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['HPC_CodeMax_Position'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_CodeMax_Position" data-key="HPC Position"></span>
                            <div class="get_column_data"></div>                       
                          </td>                        
                          <td class="machine <?php echo $machine_hide;?>">
                          	<?php 
							$class = "";
							$get_t_machines_info = get_t_machines_info2('HPC Cutter');
							$get_machines_info = get_machines_info($value['HPC_CodeMax_Cutter']);
							if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
								$class = "";
							}else{
								$class = "uuid_error";
							}	
							?>							  
                           <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['HPC_CodeMax_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_CodeMax_Cutter" data-key="HPC Cutter"></span>
                            <div class="get_column_data"></div>                         
                          </td>
                         
                          <td  class=" machine <?php echo $machine_hide;?> column_data ">
                          <div class="product-holder"><span class="tdvalue"><?php echo $value['HPC_CodeMax_Notes'];?></span></div>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['HPC_CodeMax_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col = "HPC_CodeMax_Notes"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['ITL_ID'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['ITL_ID'];?>" data-id="<?php echo $value['id'];?>" data-col = "ITL_ID"></span>
                            <div class="get_column_data"></div>
                          </td>
                         <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['ITL_Insert'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['ITL_Insert'];?>" data-id="<?php echo $value['id'];?>" data-col = "ITL_Insert"></span>
                            <div class="get_column_data"></div>
                          </td>
                         <td  class=" machine <?php echo $machine_hide;?> column_data "><div class="product-holder"><span class="tdvalue"><?php echo $value['ITL_Notes'];?></span></div>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['ITL_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col = "ITL_Notes"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Curtis_CamSet'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Curtis_CamSet'];?>" data-id="<?php echo $value['id'];?>" data-col = "Curtis_CamSet"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Curtis_Carriage'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Curtis_Carriage'];?>" data-id="<?php echo $value['id'];?>" data-col = "Curtis_Carriage"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Curtis_Cutter'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Curtis_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "Curtis_Cutter"></span>
                            <div class="get_column_data"></div>
                          </td>                         
                         <td  class=" machine <?php echo $machine_hide;?> column_data "><div class="product-holder"><span class="tdvalue"><?php echo $value['Curtis_Notes'];?></span></div>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Curtis_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col = "Curtis_Notes"></span>
                            <div class="get_column_data"></div>
                          </td>
                                                
                          <td class="machine <?php echo $machine_hide;?>">
                          	<?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('Ninja Vise');
								$get_machines_info = get_machines_info($value['Keyline_Ninja_Vice']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?>                           
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Keyline_Ninja_Vice'];?>" data-id="<?php echo $value['id'];?>" data-col = "Keyline_Ninja_Vice" data-key="Ninja Vise"></span>
                            <div class="get_column_data"></div>                          
                          </td>
                         
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Keyline_Ninja_Side'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Keyline_Ninja_Side'];?>" data-id="<?php echo $value['id'];?>" data-col = "Keyline_Ninja_Side"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Keyline_Ninja_Position'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Keyline_Ninja_Position'];?>" data-id="<?php echo $value['id'];?>" data-col = "Keyline_Ninja_Position"></span>
                            <div class="get_column_data"></div>
                          </td>
                                                  
                          <td class="machine <?php echo $machine_hide;?>">
                          	<?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('Ninja Cutter');
								$get_machines_info = get_machines_info($value['Keyline_Ninja_Cutter']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?>  						  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Keyline_Ninja_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "Keyline_Ninja_Cutter" data-key="Ninja Cutter"></span>
                            <div class="get_column_data"></div>                       
                          </td>
                          <td class="machine <?php echo $machine_hide;?>">
                          	<?php 
              								$class = "";
              								$get_t_machines_info = get_t_machines_info2('Pak-A-Punch QC Kit');
              								$get_machines_info = get_machines_info($value['Pak_QCKit']);
              								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
              									$class = "";
              								}else{
              									$class = "uuid_error";
              								}	
              							?>  						  	
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Pak_QCKit'];?>" data-id="<?php echo $value['id'];?>" data-col = "Pak_QCKit" data-key="Pak-A-Punch QC Kit"></span>
                            <div class="get_column_data"></div>  
                          </td>                          
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Pak_Vise'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Pak_Vise'];?>" data-id="<?php echo $value['id'];?>" data-col = "Pak_Vise"></span>
                            <div class="get_column_data"></div>
                          </td>                        
                           <td class="machine <?php echo $machine_hide;?>">	
                           	<?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('Pak-A-Punch Punch');
								$get_machines_info = get_machines_info($value['Pak_Punch']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?> 					  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Pak_Punch'];?>" data-id="<?php echo $value['id'];?>" data-col = "Pak_Punch" data-key="Pak-A-Punch Punch"></span>
                            <div class="get_column_data"></div>                         
                          </td>
                           <td class="machine <?php echo $machine_hide;?>">	
                            <?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('Pak-A-Punch Die');
								$get_machines_info = get_machines_info($value['Pak_Die']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?> 					  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Pak_Die'];?>" data-id="<?php echo $value['id'];?>" data-col = "Pak_Die" data-key="Pak-A-Punch Die"></span>
                            <div class="get_column_data"></div>                         
                          </td>                        
                          <td class="machine <?php echo $machine_hide;?>"><?php echo $value['Framon_Block'];?></td>                          
                           <td class="machine <?php echo $machine_hide;?>">	
                           	<?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('Framon Cutter');
								$get_machines_info = get_machines_info($value['Framon_Cutter']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?> 					  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];;?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Framon_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "Framon_Cutter" data-key="Framon Cutter"></span>
                            <div class="get_column_data"></div>                        
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Framon_FirstCut'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Framon_FirstCut'];?>" data-id="<?php echo $value['id'];?>" data-col = "Framon_FirstCut"></span>
                            <div class="get_column_data"></div>
                          </td> 
                           <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Framon_BetweenCuts'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Framon_BetweenCuts'];?>" data-id="<?php echo $value['id'];?>" data-col="Framon_BetweenCuts"></span>
                            <div class="get_column_data"></div>
                          </td> 
                          <td  class=" machine <?php echo $machine_hide;?> column_data ">
                          <div class="product-holder"><span class="tdvalue"><?php echo $value['Framon_Notes'];?></span></div>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Framon_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="Framon_Notes"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['SW2_SpaceRod'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['SW2_SpaceRod'];?>" data-id="<?php echo $value['id'];?>" data-col="SW2_SpaceRod"></span>
                            <div class="get_column_data"></div>
                          </td>
                         <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['SW2_DepthRod'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['SW2_DepthRod'];?>" data-id="<?php echo $value['id'];?>" data-col="SW2_DepthRod"></span>
                            <div class="get_column_data"></div>
                          </td>                                                   
                           <td class="machine <?php echo $machine_hide;?>">
                           	<?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('SW2 Cutter');
								$get_machines_info = get_machines_info($value['SW2_Cutter']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?>                            
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['SW2_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "SW2_Cutter" data-key="SW2 Cutter"></span>
                            <div class="get_column_data"></div>                       
                          </td>
                          <td class="machine <?php echo $machine_hide;?>">
                          	<?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('SW2 Guide');
								$get_machines_info = get_machines_info($value['SW2_Guide']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?> 				  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['SW2_Guide'];?>" data-id="<?php echo $value['id'];?>" data-col = "SW2_Guide" data-key="SW2 Guide"></span>
                            <div class="get_column_data"></div>                        
                          </td>                         
                         
                           <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['SW2_ViseSet'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['SW2_ViseSet'];?>" data-id="<?php echo $value['id'];?>" data-col="SW2_ViseSet"></span>
                            <div class="get_column_data"></div>
                          </td>                       
                           <td class="machine <?php echo $machine_hide;?>">						  
                            <?php 
                                $get_machines_info = get_machines_info($value['SW2_Stop']);							
                                echo $get_machines_info[0]['Name'];
                            ?>                          
                          </td> 
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['LKP_3DX_DSD'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['LKP_3DX_DSD'];?>" data-id="<?php echo $value['id'];?>" data-col="LKP_3DX_DSD"></span>
                            <div class="get_column_data"></div>
                          </td> 
                          <td class="machine <?php echo $machine_hide;?>">	
                          	 <?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('3DX Jaw');
								$get_machines_info = get_machines_info($value['LKP_3DX_Jaw']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?>			  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['LKP_3DX_Jaw'];?>" data-id="<?php echo $value['id'];?>" data-col = "LKP_3DX_Jaw" data-key="3DX Jaw"></span>
                            <div class="get_column_data"></div>                        
                          </td>
                          <td class="machine <?php echo $machine_hide;?>">	
                          	<?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('3DX Jaw Clamp');
								$get_machines_info = get_machines_info($value['LKP_3DX_JawClamp']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?>					  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['LKP_3DX_JawClamp'];?>" data-id="<?php echo $value['id'];?>" data-col = "LKP_3DX_JawClamp" data-key="3DX Jaw Clamp"></span>
                            <div class="get_column_data"></div>                        
                          </td>
                          <td class="machine <?php echo $machine_hide;?>">	
                          	<?php 
								$class = "";
								$get_t_machines_info = get_t_machines_info2('3DX Stop');
								$get_machines_info = get_machines_info($value['LKP_3DX_Stop']);
								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
									$class = "";
								}else{
									$class = "uuid_error";
								}	
							?>                            
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['LKP_3DX_Stop'];?>" data-id="<?php echo $value['id'];?>" data-col = "LKP_3DX_Stop" data-key="3DX Stop"></span>
                            <div class="get_column_data"></div>                        
                          </td>                       
                          <td class="machine <?php echo $machine_hide;?>">						  
                            <?php 
              							$class = "";
              							$get_t_machines_info = get_t_machines_info2('3DX Cutter');
              							$get_machines_info1 = get_machines_info($value['LKP_3DX_Cutter']);
              							if($get_machines_info1[0]['Type'] == $get_t_machines_info[0]['UUID']){
              								$class = "";
              							}else{
              								$class = "uuid_error";
              							}	
              							?>  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info1[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['LKP_3DX_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "LKP_3DX_Cutter" data-key="3DX Cutter"></span>
                            <div class="get_column_data"></div>                        
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data ">
                          <div class="product-holder"><span class="tdvalue"><?php echo $value['LKP_3DX_Notes'];?></span></div>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['LKP_3DX_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="LKP_3DX_Notes"></span>
                            <div class="get_column_data"></div>
                          </td>                         
                          <td class="machine <?php echo $machine_hide;?>">	
                          	<?php 
              								$class = "";
              								$get_t_machines_info = get_t_machines_info2('994 Vise');
              								$get_machines_info = get_machines_info($value['Keyline_994_Vise']);
              								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
              									$class = "";
              								}else{
              									$class = "uuid_error";
              								}	
              							?>					  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Keyline_994_Vise'];?>" data-id="<?php echo $value['id'];?>" data-col = "Keyline_994_Vise" data-key="994 Vise"></span>
                            <div class="get_column_data"></div>                           
                          </td>                           
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Keyline_994_Side'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Keyline_994_Side'];?>" data-id="<?php echo $value['id'];?>" data-col="Keyline_994_Side"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Keyline_994_Position'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Keyline_994_Position'];?>" data-id="<?php echo $value['id'];?>" data-col="Keyline_994_Position"></span>
                            <div class="get_column_data"></div>
                          </td>
                                                
                          <td class="machine <?php echo $machine_hide;?>">	
                          	<?php 
              								$class = "";
              								$get_t_machines_info = get_t_machines_info2('994 Cutter');
              								$get_machines_info = get_machines_info($value['Keyline_994_Cutter']);
              								if($get_machines_info[0]['Type'] == $get_t_machines_info[0]['UUID']){
              									$class = "";
              								}else{
              									$class = "uuid_error";
              								}	
              							?>					  
                            <span class="tdvalue <?php echo $class;?>"><?php echo $get_machines_info[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Keyline_994_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "Keyline_994_Cutter" data-key="994 Cutter"></span>
                            <div class="get_column_data"></div>                         
                          </td>                          
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Silca_Futura_SSN'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Silca_Futura_SSN'];?>" data-id="<?php echo $value['id'];?>" data-col="Silca_Futura_SSN"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td  class=" machine <?php echo $machine_hide;?> column_data "><span class="tdvalue"><?php echo $value['Silca_Futura_Card'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Silca_Futura_Card'];?>" data-id="<?php echo $value['id'];?>" data-col="Silca_Futura_Card"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td class="condor column_data">
                            <span class="tdvalue"><?php echo $value['Condor_KeyName'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Condor_KeyName'];?>" data-id="<?php echo $value['id'];?>" data-col="Condor_KeyName"></span><div class="get_column_data"></div>
                          </td>
                          <td class="condor column_data">
                            <?php 
                            $class = "";
                            $get_t_machines_info = get_t_machines_info2('Condor Cutter');
                            $get_machines_info1 = get_machines_info($value['Condor_Cutter']);
                            if($get_machines_info1[0]['Type'] == $get_t_machines_info[0]['UUID']){
                              $class = "";
                            }else{
                              $class = "uuid_error";
                            } 
                            ?>  
                            <span class="tdvalue"><?php echo $get_machines_info1[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Condor_Cutter'];?>" data-id="<?php echo $value['id'];?>" data-col = "Condor_Cutter" data-key="Condor Cutter"></span>
                            <div class="get_column_data"></div> 
                          </td>
                          <td class="condor column_data">
                            <?php 
                            $class = "";
                            $get_t_machines_info = get_t_machines_info2('Condor Jaw');
                            $get_machines_info1 = get_machines_info($value['Condor_Jaw']);
                            if($get_machines_info1[0]['Type'] == $get_t_machines_info[0]['UUID']){
                              $class = "";
                            }else{
                              $class = "uuid_error";
                            } 
                            ?>  
                            <span class="tdvalue"><?php echo $get_machines_info1[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Condor_Jaw'];?>" data-id="<?php echo $value['id'];?>" data-col = "Condor_Jaw" data-key="Condor Jaw"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td class="condor column_data">
                            <?php 
                            $class = "";
                            $get_t_machines_info = get_t_machines_info2('Condor Side');
                            $get_machines_info1 = get_machines_info($value['Condor_JawSide']);
                            if($get_machines_info1[0]['Type'] == $get_t_machines_info[0]['UUID']){
                              $class = "";
                            }else{
                              $class = "uuid_error";
                            } 
                            ?>  
                            <span class="tdvalue"><?php echo $get_machines_info1[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Condor_JawSide'];?>" data-id="<?php echo $value['id'];?>" data-col = "Condor_JawSide" data-key="Condor Jaw"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td class="condor column_data">
                            <?php 
                            $class = "";
                            $get_t_machines_info = get_t_machines_info2('Condor Stop');
                            $get_machines_info1 = get_machines_info($value['Condor_Stop']);
                            if($get_machines_info1[0]['Type'] == $get_t_machines_info[0]['UUID']){
                              $class = "";
                            }else{
                              $class = "uuid_error";
                            } 
                            ?>  
                            <span class="tdvalue"><?php echo $get_machines_info1[0]['Name'];?></span> 
                            <span class="glyphicon glyphicon-pencil editMachineData" aria-hidden="true" data-val="<?php echo $value['Condor_Stop'];?>" data-id="<?php echo $value['id'];?>" data-col = "Condor_Stop" data-key="Condor Jaw"></span>
                            <div class="get_column_data"></div>
                          </td>
                          <td class="condor column_data">
                            <span class="tdvalue"><?php echo $value['Condor_Notes'];?></span>
                            <span class="glyphicon glyphicon-pencil editInputType" aria-hidden="true" data-val = "<?php echo $value['Condor_Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="Condor_Notes"></span><div class="get_column_data"></div>
                          </td>
                          <td class="decoder <?php echo $decoder_hide;?>" ><?php $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($value['Determinator_UUID']);?>
                          <span class="tdvalue"><?php echo $get_manufactyrer_by_uuid[0]['Tool_Name'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_determinator" aria-hidden="true" id="<?php echo $value['Determinator_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Determinator_UUID" data-key="Determinator"></span>
                          <div class="determinatorDropbox"></div>
                          </td>
                          <td class="decoder <?php echo $decoder_hide;?>">
                              <?php $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($value['Lishi_UUID']);?>
                              <span class="tdvalue"><?php echo $get_manufactyrer_by_uuid[0]['Tool_Name'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_determinator" aria-hidden="true" id="<?php echo $value['Lishi_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Lishi_UUID" data-key="Lishi"></span>
                          <div class="determinatorDropbox"></div>
                          </td>
                          <td class="decoder <?php echo $decoder_hide;?>">
                              <?php $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($value['Accu-Reader_UUID']);?>
                              <span class="tdvalue"><?php echo $get_manufactyrer_by_uuid[0]['Tool_Name'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_determinator" aria-hidden="true" id="<?php echo $value['Accu-Reader_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Accu-Reader_UUID" data-key="Accu-Reader"></span>
                          <div class="determinatorDropbox"></div>
                          </td>
                          <td class="decoder <?php echo $decoder_hide;?>">
                              <?php $get_manufactyrer_by_uuid = get_manufactyrer_by_uuid($value['EEZ-Reader_UUID']);?>
                           <span class="tdvalue"><?php echo $get_manufactyrer_by_uuid[0]['Tool_Name'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_determinator" aria-hidden="true" id="<?php echo $value['EEZ-Reader_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="EEZ-Reader_UUID" data-key="EEZ Reader"></span>
                          <div class="determinatorDropbox"></div>
                          </td>                         
                          <td class="decoder <?php echo $decoder_hide;?>">                          
                          <?php $get_toolType_by_uuid = get_toolName_by_uuid($value['SDKeys_UUID']); ?>
                               <span class="tdvalue"><?php echo $get_toolType_by_uuid[0]['Tool_Name'];?></span>
                               <span class="glyphicon glyphicon-pencil edit_cs_keys" aria-hidden="true" id="<?php echo $value['SDKeys_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="SDKeys_UUID" data-key1="Aerolock" data-key2="Space & Depth Keys"></span>
                          <div class="ckKeysDropbox"></div>
                          </td>
                          <td class="decoder <?php echo $decoder_hide;?>">
                            <?php 
              							$try_out_keys_array  = explode(',',$value['TryOutKeys_UUID']);
              							for($tr = 0; $tr < count($try_out_keys_array); $tr++){
              								$get_toolType_by_uuid = get_toolName_by_uuid($try_out_keys_array[$tr]);
              								echo $get_toolType_by_uuid[0]['Tool_Name'].'<br>';
              							}
              							?>
                             <!--<span class="tdvalue"><?php echo $get_toolType_by_uuid[0]['Tool_Name'];?></span>
                               <span class="glyphicon glyphicon-pencil edit_cs_keys" aria-hidden="true" id="<?php echo $value['TryOutKeys_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="TryOutKeys_UUID" data-key1="Try-Out Keys" data-key2=""></span>
                          <div class="ckKeysDropbox"></div>-->
                           </td>
                          <td class="decoder <?php echo $decoder_hide;?>">
                            <?php $get_toolType_by_uuid = get_toolName_by_uuid($value['BuildAKey_UUID']);?>
                                <span class="tdvalue"><?php echo $get_toolType_by_uuid[0]['Tool_Name'];?></span>
                               <span class="glyphicon glyphicon-pencil edit_cs_keys" aria-hidden="true" id="<?php echo $value['BuildAKey_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="BuildAKey_UUID" data-key1="BlueRocket" data-key2="Space & Depth Keys"></span>
                          <div class="ckKeysDropbox"></div>
                          </td>
                          <td class="decoder <?php echo $decoder_hide;?>">
                            <?php $get_toolType_by_uuid = get_toolName_by_uuid($value['A1AutoPicks_UUID']);?>
                                <span class="tdvalue"><?php echo $get_toolType_by_uuid[0]['Tool_Name'];?></span>
                               <span class="glyphicon glyphicon-pencil edit_cs_keys" aria-hidden="true" id="<?php echo $value['A1AutoPicks_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="A1AutoPicks_UUID" data-key1="A1 Security" data-key2="Ignition Removal"></span>
                          <div class="ckKeysDropbox"></div>
                          </td>
                         
                        </tr>
                    <?php } ?>                    
               </tbody>
            </table>
          </div>
          <nav class="site-pg">
                <ul class="pagination">               
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>	
               </ul>
     	  </nav>
        </div>       
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->