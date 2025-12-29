<?php 
$id = array();
$Year = array();
$Make = array();
$Model = array();
$System = array();
$PinRequired = array();
$PinRead = array();
$PinReadPossible = array();
$MinBypass = array();
$PinCalculate = array();
$ProgramMaster = array();
$ProgramValet = array();
$AllKeysLost = array();
$AddKey = array();
$EraseKey = array();
$AddRemote = array();
$EraseRemote = array();
$ResetProx = array();
$ResetFunction = array();
$ReplaceFunction = array();
$KeyInfo = array();
$FobInfo = array();
$MaxKeys = array();
$ProgramType = array();
$RegisterSmartAccess = array();
$IdEngStartBox = array();
$IdRegSmartBox = array();
$SpecialFunction = array();
$KeysRequired = array();
$Reusable = array();
$ComponentsMatch = array();
$Possible = array();
$Needed = array();
$Notes = array();
$Testing = array();
foreach($results as $value){
	if($value['Year'] != '')
	  $Year[] = array($value['Year']);
	if($value['Make'] != '')
	  $Make[] = array($value['Make']);
	if($value['Model'] != '')
	  $Model[] = array($value['Model']);
	if($value['System'] != '')
	  $System[] = array($value['System']);
	if($value['PinRequired'] != '')
	  $PinRequired[] = array($value['PinRequired']);
	if($value['PinRead'] != '')
	  $PinRead[] = array($value['PinRead']);
	if($value['PinReadPossible'] != '')
	  $PinReadPossible[] = array($value['PinReadPossible']);
	if($value['10MinBypass'] != '')
	  $MinBypass[] = array($value['10MinBypass']);
	if($value['PinCalculate'] != '')
	  $PinCalculate[] = array($value['PinCalculate']);
	if($value['ProgramMaster'] != '')
	  $ProgramMaster[] = array($value['ProgramMaster']);
	if($value['ProgramValet'] != '')
	  $ProgramValet[] = array($value['ProgramValet']);
	if($value['AllKeysLost'] != '')
	  $AllKeysLost[] = array($value['AllKeysLost']);
	if($value['AddKey'] != '')
	  $AddKey[] = array($value['AddKey']);
	if($value['EraseKey'] != '')
	  $EraseKey[] = array($value['EraseKey']);
	if($value['AddRemote'] != '')
	  $AddRemote[] = array($value['AddRemote']);
	if($value['EraseRemote'] != '')
	  $EraseRemote[] = array($value['EraseRemote']);
	if($value['ResetProx'] != '')
	  $ResetProx[] = array($value['ResetProx']);
	if($value['ResetFunction'] != '')
	  $ResetFunction[] = array($value['ResetFunction']);
	if($value['ReplaceFunction'] != '')
	  $ReplaceFunction[] = array($value['ReplaceFunction']);
	if($value['KeyInfo'] != '')
	  $KeyInfo[] = array($value['KeyInfo']);
	if($value['FobInfo'] != '')
	  $FobInfo[] = array($value['FobInfo']);
	if($value['MaxKeys'] != '')
	  $MaxKeys[] = array($value['MaxKeys']);
	if($value['ProgramType'] != '')
	  $ProgramType[] = array($value['ProgramType']);
	if($value['RegisterSmartAccess'] != '')
	  $RegisterSmartAccess[] = array($value['RegisterSmartAccess']);
	if($value['IdEngStartBox'] != '')
	  $IdEngStartBox[] = array($value['IdEngStartBox']);
	if($value['IdRegSmartBox'] != '')
	  $IdRegSmartBox[] = array($value['IdRegSmartBox']);
	if($value['SpecialFunction'] != '')
	  $SpecialFunction[] = array($value['SpecialFunction']);
	if($value['2KeysRequired'] != '')
	  $KeysRequired[] = array($value['2KeysRequired']);
	if($value['Reusable'] != '')
	  $Reusable[] = array($value['Reusable']);
	if($value['ComponentsMatch'] != '')
	  $ComponentsMatch[] = array($value['ComponentsMatch']);
	if($value['Possible'] != '')
	  $Possible[] = array($value['Possible']);
	if($value['Needed'] != '')
	  $Needed[] = array($value['Needed']);
	if($value['Notes'] != '')
	  $Notes[] = array($value['Notes']);
	if($value['Testing'] != '')
	  $Testing[] = array($value['Testing']);
}
?>
<?php 
$angle = ""; 
$sorting_id = "";
if(isset($this->session->userdata['application_sorting_sess'])){
   $session_data = $this->session->userdata('application_sorting_sess');
   $sorting_by = $session_data['application_sorting'];
   $sorting = $session_data['application_order'];
   if($sorting == 'DESC'){
		$sorting_id = 'ASC';
		$angle = 'top';
	}else if($sorting == 'ASC'){
		$sorting_id = 'DESC';
		$angle = 'bottom';
	}
}else{
	$sorting_by ="";
	$sorting_id = 'DEC';
	$angle = 'bottom';
}
?>
<table class="table table-bordered  table-data mar0 tab-con">
              <thead>
                <tr>
                  <th>Make</th>
                  <th>Model</th>
                  <th>Year</th>
                  <?php if( count($System) > 0) {?>
                  <th>System</th>
                  <?php } ?>
                  <?php if( count($PinRequired) > 0) {?>
                  <th>Pin <br />Req'd</th>
                  <?php } ?>
                  <?php if( count($PinRead) > 0) {?>
                  <th>Pin <br />Read</th>
                  <?php } ?>
                  <?php if( count($PinReadPossible) > 0) {?>
                  <th>Pin Read <br />Possible</th>
                  <?php } ?>
                  <?php if( count($MinBypass) > 0) {?>
                  <th>10 Min <br />Bypass</th>
                  <?php } ?>
                  <?php if( count($PinCalculate) > 0) {?>
                  <th>Pin <br />Calculate</th>
                  <?php } ?>
                  <?php if( count($ProgramMaster) > 0) {?>
                  <th>Program <br />Master</th>
                  <?php } ?>
                  <?php if( count($ProgramValet) > 0) {?>
                  <th>Program <br />Valet</th>
                  <?php } ?>
                  <?php if( count($AllKeysLost) > 0) {?>
                  <th>All Keys <br />Lost</th>
                  <?php } ?>
                  <?php if( count($AddKey) > 0) {?>
                  <th>Add <br />Key</th>
                  <?php } ?>
                  <?php if( count($EraseKey) > 0) {?>
                  <th>Erase <br />Key</th>
                  <?php } ?>
                  <?php if( count($AddRemote) > 0) {?>
                  <th>Add <br />Remote</th>
                  <?php } ?>
                  <?php if( count($EraseRemote) > 0) {?>
                  <th>Erase <br />Remote</th>
                  <?php } ?>
                  <?php if( count($ResetProx) > 0) {?>
                  <th>Reset <br />Prox</th>
                  <?php } ?>
                  <?php if( count($ResetFunction) > 0) {?>
                  <th>Reset <br />Function</th>
                  <?php } ?>
                  <?php if( count($ReplaceFunction) > 0) {?>
                  <th>Replace <br />Function</th>
                  <?php } ?>
                  <?php if( count($KeyInfo) > 0) {?>
                  <th>Key <br />Info</th>
                  <?php } ?>
                  <?php if( count($FobInfo) > 0) {?>
                  <th>Fob Info</th>
                  <?php } ?>
                  <?php if( count($MaxKeys) > 0) {?>
                  <th>Max <br />Keys</th>
                  <?php } ?>
                  <?php if( count($ProgramType) > 0) {?>
                  <th>Program <br />Type</th>
                  <?php } ?>
                  <?php if( count($RegisterSmartAccess) > 0) {?>
                  <th>Register Smart <br />Access</th>
                  <?php } ?>
                  <?php if( count($IdEngStartBox) > 0) {?>
                  <th>ID Eng Start <br />Box</th>
                  <?php } ?>
                  <?php if( count($IdRegSmartBox) > 0) {?>
                  <th>ID Reg Smart <br />Box</th>
                  <?php } ?>
                  <?php if( count($SpecialFunction) > 0) {?>
                  <th>Special <br />Function</th>
                  <?php } ?>
                  <?php if( count($KeysRequired) > 0) {?>
                  <th>2Keys <br />Required</th>
                  <?php } ?>
                  <?php if( count($Reusable) > 0) {?>
                  <th>Reusable</th>
                  <?php } ?>
                  <?php if( count($ComponentsMatch) > 0) {?>
                  <th>Components <br />Match</th>
                  <?php } ?>
                  <?php if( count($Possible) > 0) {?>
                  <th>Possible</th>
                  <?php } ?>
                  <?php if( count($Needed) > 0) {?>
                  <th>Needed</th>
                  <?php } ?>
                  <?php if( count($Notes) > 0) {?>
                  <th>Notes</th>
                  <?php } ?>
                  <?php if( count($Testing) > 0) {?>
                  <th>Testing</th> 
                  <?php } ?>  
                  <th style="width:137px">Action</th>               
                </tr>
              </thead>
              <tbody>
              <?php foreach($results as $value){
				  if( $value['Testing']=='Worked'){
				  	$row_style = 'style="background:#CEFFE0"';
				  }else if( $value['Testing']=='Issues'){
				  	$row_style = 'style="background:#FFDEF8"';
				  }else if( $value['Testing']=='Tested' || $value['Testing']=='Same Protocol Worked'){
				  	$row_style = 'style="background:#FDFFDE"';
				  }else{
				  	$row_style = '';
				  }?>
              	  <tr <?php echo $row_style;?>>
                  		<?php if( count($Make) > 0) {?>
                    	<td><?php echo $value['Make'];?></td>
                        <?php } ?>
                        <?php if( count($Model) > 0) {?>
                        <td><?php echo $value['Model'];?></td>
                        <?php } ?>
                        <?php if( count($Year) > 0) {?>
                        <td><?php echo $value['Year'];?></td>
                        <?php } ?>
                        <?php if( count($System) > 0) {?>
                        <td><?php echo $value['System'];?></td>
                        <?php } ?>
                        <?php if( count($PinRequired) > 0) {?>
                        <td><?php echo $value['PinRequired'];?></td>
                        <?php } ?>
                        <?php if( count($PinRead) > 0) {?>
                        <td><?php echo $value['PinRead'];?></td>
                        <?php } ?>
                        <?php if( count($PinReadPossible) > 0) {?>
                        <td><?php echo $value['PinReadPossible'];?></td>
                        <?php } ?>
                        <?php if( count($MinBypass) > 0) {?>
                        <td><?php echo $value['10MinBypass'];?></td>
                        <?php } ?>
                        <?php if( count($PinCalculate) > 0) {?>
                        <td><?php echo $value['PinCalculate'];?></td>
                        <?php } ?>
                        <?php if( count($ProgramMaster) > 0) {?>
                        <td><?php echo $value['ProgramMaster'];?></td>
                        <?php } ?>
                        <?php if( count($ProgramValet) > 0) {?>
                        <td><?php echo $value['ProgramValet'];?></td>
                        <?php } ?>
                        <?php if( count($AllKeysLost) > 0) {?>
                        <td><?php echo $value['AllKeysLost'];?></td>
                        <?php } ?>
                        <?php if( count($AddKey) > 0) {?>
                        <td><?php echo $value['AddKey'];?></td>
                        <?php } ?>
                        <?php if( count($EraseKey) > 0) {?>
                        <td><?php echo $value['EraseKey'];?></td>
                        <?php } ?>
                        <?php if( count($AddRemote) > 0) {?>
                        <td><?php echo $value['AddRemote'];?></td>
                        <?php } ?>
                        <?php if( count($EraseRemote) > 0) {?>
                        <td><?php echo $value['EraseRemote'];?></td>
                        <?php } ?>
                        <?php if( count($ResetProx) > 0) {?>
                        <td><?php echo $value['ResetProx'];?></td>
                        <?php } ?>
                        <?php if( count($ResetFunction) > 0) {?>
                        <td><?php echo $value['ResetFunction'];?></td>
                        <?php } ?>
                        <?php if( count($ReplaceFunction) > 0) {?>
                        <td><?php echo $value['ReplaceFunction'];?></td>
                        <?php } ?>
                        <?php if( count($KeyInfo) > 0) {?>
                        <td><?php echo $value['KeyInfo'];?></td>
                        <?php } ?>
                        <?php if( count($FobInfo) > 0) {?>
                        <td><?php echo $value['FobInfo'];?></td>
                        <?php } ?>
                        <?php if( count($MaxKeys) > 0) {?>
                        <td><?php echo $value['MaxKeys'];?></td>
                        <?php } ?>
                        <?php if( count($ProgramType) > 0) {?>
                        <td><?php echo $value['ProgramType'];?></td>
                        <?php } ?>
                        <?php if( count($RegisterSmartAccess) > 0) {?>
                        <td><?php echo $value['RegisterSmartAccess'];?></td>
                        <?php } ?>
                        <?php if( count($IdEngStartBox) > 0) {?>
                        <td><?php echo $value['IdEngStartBox'];?></td>
                        <?php } ?>
                        <?php if( count($IdRegSmartBox) > 0) {?>
                        <td><?php echo $value['IdRegSmartBox'];?></td>
                        <?php } ?>
                        <?php if( count($SpecialFunction) > 0) {?>
                        <td><?php echo $value['SpecialFunction'];?></td>
                        <?php } ?>
                        <?php if( count($KeysRequired) > 0) {?>
                        <td><?php echo $value['2KeysRequired'];?></td>
                        <?php } ?>
                        <?php if( count($Reusable) > 0) {?>
                        <td><?php echo $value['Reusable'];?></td>
                        <?php } ?>
                        <?php if( count($ComponentsMatch) > 0) {?>
                        <td><?php echo $value['ComponentsMatch'];?></td>
                        <?php } ?>
                        <?php if( count($Possible) > 0) {?>
                        <td><?php echo $value['Possible'];?></td>
                        <?php } ?>
                        <?php if( count($Needed) > 0) {?>
                        <td><?php echo $value['Needed'];?></td>
                        <?php } ?>
                        <?php if( count($Notes) > 0) {?>
                        <td><?php echo $value['Notes'];?></td>
                        <?php } ?>
                        <?php if( count($Testing) > 0) {?>
                        <td><?php echo $value['Testing'];?></td>
                        <?php } ?> 
                        <td>
                        	<a href="<?php echo adm_base_url();?>/autopropad/edit_application/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>
                            <a href="<?php echo adm_base_url();?>/autopropad/copy_application/<?php echo $value['id'];?>" type="button" class="btn btn-info" >Copy</a> 
                            <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/autopropad/delete_application/')" class="btn btn-danger" >Delete</a>
                        </td>                       
                    </tr>
              <?php } ?>      
              </tbody>              
            </table>
<nav class="site-pg">
      <ul class="pagination">               
      <?php foreach ($links as $link) {
              echo '<li>'. $link.'</li>';
      } ?>	
     </ul>
</nav>
          