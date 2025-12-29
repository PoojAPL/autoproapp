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
	}else{
		$sorting_by ="";
		$sorting_id = 'DESC';
		$angle = 'bottom';
	}
}else{
	$sorting_by ="";
	$sorting_id = 'DESC';
	$angle = 'bottom';
}
?>
<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
      <div class="col-sm-5">
      	<div class="form-group">
        	 <label>Show Make</label>
             <select class="form-control select-field filterApplicationByMake" style="width:auto;">
             	<option value="">Select Make</option>
                <?php foreach($getAllMakeNames as $makes){ ?>
					<option value="<?php echo $makes['Make_Name'];?>"><?php echo $makes['Make_Name'];?></option>
				<?php }	?>
             </select>
      	</div>
      </div>
      <div class="col-sm-7">
      	<form method="post" id="searchApplication">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control" style="width: 300px;" placeholder="Enter at least 3 characters for searching"  />
                     <button type="submit" class="btn btn-primary custom-button" >Search</button>
                </div>
            </form>
      </div>	
      <div class="col-sm-12">
        <div class="form-group addCodeSeries">
        <a href="<?php echo adm_base_url();?>/autopropad/add_applications" class="btn btn-danger">Add New Application</a>   
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php if($this->session->flashdata('message_display')){?>
        <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="table-responsive chips_data" style="overflow:visible">
            <table class="table table-bordered  table-data mar0 tab-con">
              <thead>
                <tr>
                  <th>Make
            		<a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> applications_sorting" data-by="Make" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th>Model
            		<a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> applications_sorting" data-by="Model" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th>Year
            		<a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> applications_sorting" data-by="Year" data_id="<?php echo $sorting_id;?>"></a>
                  </th>
                  <th>System</th>
                  <th>Pin Req'd</th>
                  <th>Pin Read</th>
                  <th>Pin Read <br />Possible</th>
                  <th>10 Min <br />Bypass</th>
                  <th>Pin <br />Calculate</th>
                  <th>Program <br />Master</th>
                  <th>Program <br />Valet</th>
                  <th>AllKeys <br /> Lost</th>
                  <th>Add <br />Key</th>
                  <th>Erase<br /> Key</th>
                  <th>Add <br />Remote</th>
                  <th>Erase <br />Remote</th>
                  <th>Reset <br />Prox</th>
                  <th>Reset <br />Function</th>
                  <th>Replace <br />Function</th>
                  <th>Key <br />Info</th>
                  <th>Fob <br />Info</th>
                  <th>Max <br />Keys</th>
                  <th>Program <br />Type</th>
                  <th>Register Smart <br />Access</th>
                  <th>ID Eng <br />Start Box</th>
                  <th>ID Reg <br />Smart Box</th>
                  <th>Special <br />Function</th>
                  <th>2Keys <br />Required</th>
                  <th>Reusable</th>
                  <th>Components <br />Match</th>
                  <th>Possible</th>
                  <th>Needed</th>
                  <th>Notes</th>
                  <th>Testing</th>
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
                    	<td>
                        	<span class="td_data"><?php echo $value['Make'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['Make'];?>" data-id="<?php echo $value['id'];?>" data-col="Make"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['Model'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['Model'];?>" data-id="<?php echo $value['id'];?>" data-col="Model"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['Year'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['Year'];?>" data-id="<?php echo $value['id'];?>" data-col="Year"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['System'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['System'];?>" data-id="<?php echo $value['id'];?>" data-col="System"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['PinRequired'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['PinRequired'];?>" data-id="<?php echo $value['id'];?>" data-col="PinRequired"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['PinRead'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['PinRead'];?>" data-id="<?php echo $value['id'];?>" data-col="PinRead"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['PinReadPossible'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['PinReadPossible'];?>" data-id="<?php echo $value['id'];?>" data-col="PinReadPossible"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['10MinBypass'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['10MinBypass'];?>" data-id="<?php echo $value['id'];?>" data-col="10MinBypass"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['PinCalculate'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['PinCalculate'];?>" data-id="<?php echo $value['id'];?>" data-col="PinCalculate"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['ProgramMaster'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['ProgramMaster'];?>" data-id="<?php echo $value['id'];?>" data-col="ProgramMaster"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['ProgramValet'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['ProgramValet'];?>" data-id="<?php echo $value['id'];?>" data-col="ProgramValet"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['AllKeysLost'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['AllKeysLost'];?>" data-id="<?php echo $value['id'];?>" data-col="AllKeysLost"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['AddKey'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['AddKey'];?>" data-id="<?php echo $value['id'];?>" data-col="AddKey"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['EraseKey'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['EraseKey'];?>" data-id="<?php echo $value['id'];?>" data-col="EraseKey"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['AddRemote'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['AddRemote'];?>" data-id="<?php echo $value['id'];?>" data-col="AddRemote"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['EraseRemote'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['EraseRemote'];?>" data-id="<?php echo $value['id'];?>" data-col="EraseRemote"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['ResetProx'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['ResetProx'];?>" data-id="<?php echo $value['id'];?>" data-col="ResetProx"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['ResetFunction'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['ResetFunction'];?>" data-id="<?php echo $value['id'];?>" data-col="ResetFunction"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['ReplaceFunction'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['ReplaceFunction'];?>" data-id="<?php echo $value['id'];?>" data-col="ReplaceFunction"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['KeyInfo'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['KeyInfo'];?>" data-id="<?php echo $value['id'];?>" data-col="KeyInfo"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['FobInfo'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['FobInfo'];?>" data-id="<?php echo $value['id'];?>" data-col="FobInfo"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['MaxKeys'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['MaxKeys'];?>" data-id="<?php echo $value['id'];?>" data-col="MaxKeys"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['ProgramType'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['ProgramType'];?>" data-id="<?php echo $value['id'];?>" data-col="ProgramType"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['RegisterSmartAccess'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['RegisterSmartAccess'];?>" data-id="<?php echo $value['id'];?>" data-col="RegisterSmartAccess"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['IdEngStartBox'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['IdEngStartBox'];?>" data-id="<?php echo $value['id'];?>" data-col="IdEngStartBox"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['IdRegSmartBox'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['IdRegSmartBox'];?>" data-id="<?php echo $value['id'];?>" data-col="IdRegSmartBox"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['SpecialFunction'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['SpecialFunction'];?>" data-id="<?php echo $value['id'];?>" data-col="SpecialFunction"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['2KeysRequired'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['2KeysRequired'];?>" data-id="<?php echo $value['id'];?>" data-col="2KeysRequired"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['Reusable'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['Reusable'];?>" data-id="<?php echo $value['id'];?>" data-col="Reusable"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['ComponentsMatch'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['ComponentsMatch'];?>" data-id="<?php echo $value['id'];?>" data-col="ComponentsMatch"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['Possible'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['Possible'];?>" data-id="<?php echo $value['id'];?>" data-col="Possible"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['Needed'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['Needed'];?>" data-id="<?php echo $value['id'];?>" data-col="Needed"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['Notes'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="Notes"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                        	<span class="td_data"><?php echo $value['Testing'];?></span> <span class="glyphicon glyphicon-pencil edit_application_cols" data-val="<?php echo $value['Testing'];?>" data-id="<?php echo $value['id'];?>" data-col="Testing"></span><div class="get_column_data"></div>
                        </td>
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
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here --> 