<?php
error_reporting(0);
$user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
$email = $user_data['email'];
$get_admin_deatils = get_admin_deatils($email);

$angle = ""; 
$sorting_id = "";
if($sorting == 'DESC'){
	$sorting_id = 'ASC';
	$angle = 'top';
}else if($sorting == 'ASC'){
	$sorting_id = 'DESC';
	$angle = 'bottom';
}
$cancelReturn_hide = '';
$cancelReturn_checked = '';
if(isset($_COOKIE['CancelReturns_cookie'])){ 
	 $cookieValue = $_COOKIE['CancelReturns_cookie'];
	 if( $cookieValue == 1){
		$cancelReturn_hide = 'hide';
		$cancelReturn_checked = 'checked';
	 }else{
		$cancelReturn_hide = '';
		$cancelReturn_checked = '';
	 }
}
$support_paid_hide = '';
$support_paid_checked = '';
if(isset($_COOKIE['SupportPaid_cookie'])){ 
	 $cookieValue = $_COOKIE['SupportPaid_cookie'];
	 if( $cookieValue == 1){
		$support_paid_hide = 'hide';
		$support_paid_checked = 'checked';
	 }else{
		$support_paid_hide = '';
		$support_paid_checked = '';
	 }
}
?>
<?php if($search == 1){?>
<a href="<?php echo adm_base_url();?>/purchase_history" class="btn btn-info">Show All</a><br /><br />
<?php } ?>
<table class="table table-bordered  table-data mar0 tab-con">
  <thead>
    <tr>  
      <th>Serial# 
      <?php if($sorting_by == 'Serial_Number'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> purchases_sorting" data-by="Serial_Number" data_id="<?php echo $sorting_id;?>"></a></th>	      <?php } else{?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom purchases_sorting" data-by="Serial_Number" data_id="DESC"></a>
      <?php } ?>         
      <th>Order # 
      <?php if($sorting_by == 'Order_Number'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> purchases_sorting" data-by="Order_Number" data_id="<?php echo $sorting_id;?>"></a></th>	      <?php } else{?>
        <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom purchases_sorting" data-by="Order_Number" data_id="DESC"></a>
      <?php } ?>     
      </th>
      <th>Date 
      <?php if($sorting_by == 'Order_Date'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> purchases_sorting" data-by="Order_Date" data_id="<?php echo $sorting_id;?>"></a></th>	      <?php } else{?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom purchases_sorting" data-by="Order_Date" data_id="DESC"></a>
      <?php } ?> 
      </th> 
      <th>Product
      <?php if($sorting_by == 'Product'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> purchases_sorting" data-by="Product" data_id="<?php echo $sorting_id;?>"></a></th>	      <?php } else{?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom purchases_sorting" data-by="Product" data_id="DESC"></a>
      <?php } ?>
      </th>
      <th>Customer
      <?php if($sorting_by == 'Customer_Name'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> purchases_sorting" data-by="Customer_Name" data_id="<?php echo $sorting_id;?>"></a></th>	      <?php } else{?>  
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom purchases_sorting" data-by="Customer_Name" data_id="DESC"></a>
      <?php } ?>
      </th> 
      <th>Status
      <?php if($sorting_by == 'Status'){?>
      <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> purchases_sorting" data-by="Status" data_id="<?php echo $sorting_id;?>"></a></th>	      <?php } else{?>
       <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom purchases_sorting" data-by="Status" data_id="DESC"></a>
       <?php } ?>
      </th>
       <th>Sale Price
       <?php if($sorting_by == 'Sale_Price'){?>
       <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> purchases_sorting" data-by="Sale_Price" data_id="<?php echo $sorting_id;?>"></a>
       <?php } else{?>
       <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom purchases_sorting" data-by="Sale_Price" data_id="DESC"></a>
       <?php } ?>
      </th>
      <th>Support Paid
      <?php if($sorting_by == 'Support_Paid_Date'){?>
       <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-<?php echo $angle;?> purchases_sorting" data-by="Support_Paid_Date" data_id="<?php echo $sorting_id;?>"></a>
       <?php } else{?>
        <a href="javascript:void(0)"  class="glyphicon glyphicon-triangle-bottom purchases_sorting" data-by="Support_Paid_Date" data_id="DESC"></a>
        <?php } ?>
      </th>
      <th>Notes</th>
      <th style="width:137px">Action</th>
    </tr>
  </thead>
  <tbody>
        <?php 
			  $emails = "";
			  $i =1;
        if(count($results) > 0){
			  foreach($results as $value){
				  	if($value['Status'] == 'OK'){
						$status_row = '';
						$cancelReturn_cls = '';
						$cancelReturn_hide1 = '';
						$emails .= $value['Customer_Email'].'|';
					}else if( $value['Status'] == 'Canceled' || $value['Status'] == 'Returned'){
						$status_row = 'warning';
						$cancelReturn_cls = 'cancelReturn';
						$cancelReturn_hide1 = $cancelReturn_hide;
					}else{
						$status_row = 'warning';
						$cancelReturn_cls = '';
						$cancelReturn_hide1 = '';
					}
					//$support_Paid_Amount1 = ($value['Sale_Price']*10)/100;
					if($value['Support_Paid_Amount'] == NULL){
						$support_Paid_Amount= "";
					}else{
						$support_Paid_Amount = '$'.number_format($value['Support_Paid_Amount'],2);
					}
					if($value['Support_Paid_Date'] == NULL){
						$support_paid_cls = '';
						$support_paid_hide1 = '';
					}else{
						$support_paid_cls = 'SupportPaid';
						$support_paid_hide1 = $support_paid_hide;
					}?>
				   <tr class="<?php echo $status_row;?> <?php echo $cancelReturn_cls;?> <?php echo $cancelReturn_hide1;?> <?php echo $support_paid_cls;?> <?php echo $support_paid_hide1;?>">
                                <td>
                                    <span class="td_data"><?php echo $value['Serial_Number'];?></span>
                                    <span class="glyphicon glyphicon-pencil edit_purchase_inputs" aria-hidden="true" data-val="<?php echo $value['Serial_Number'];?>" data-id="<?php echo $value['id'];?>" data-col="Serial_Number"></span><div class="get_column_data"></div>
                                </td>
                                <td>
                                    <span class="td_data"><?php echo $value['Order_Number'];?></span>
                                    <span class="glyphicon glyphicon-pencil edit_purchase_inputs" aria-hidden="true" data-val="<?php echo $value['Order_Number'];?>" data-id="<?php echo $value['id'];?>" data-col="Order_Number"></span><div class="get_column_data"></div>
                                </td>
                                <td>
                                    <span class="td_data"><?php echo date('m/d/Y', strtotime($value['Order_Date']));?></span>
                                    <span class="glyphicon glyphicon-pencil edit_purchase_inputs" aria-hidden="true" data-val="<?php echo date('m/d/Y', strtotime($value['Order_Date']));?>" data-id="<?php echo $value['id'];?>" data-col="Order_Date"></span><div class="get_column_data"></div>
                                </td>
                                <td>
                                    <span class="td_data"><?php echo $value['Product'];?></span>
                                    <span class="glyphicon glyphicon-pencil edit_purchase_inputs" aria-hidden="true" data-val="<?php echo $value['Product'];?>" data-id="<?php echo $value['id'];?>" data-col="Product"></span><div class="get_column_data"></div>
                                </td>
                                <td><?php echo $value['Customer_Name'];?> <br />
                                    <?php echo $value['Customer_Company'];?><br />
                                   <?php echo $value['Customer_Email'];?>
                                </td>
                                <td>
                                    <span class="td_data"><?php echo $value['Status'];?></span>
                                    <span class="glyphicon glyphicon-pencil edit_purchase_inputs" aria-hidden="true" data-val="<?php echo $value['Status'];?>" data-id="<?php echo $value['id'];?>" data-col="Status"></span><div class="get_column_data"></div>
                                </td>
                                 <?php if( ($user_data['user_type'] == 0) || ($user_data['user_type'] == 1)){?>
                                <td>
                                <span class="td_data"><?php if($value['Sale_Price'] != ""){?>$<?php echo $value['Sale_Price'];?><?php } ?></span>
                                    <span class="glyphicon glyphicon-pencil edit_purchase_inputs" aria-hidden="true" data-val="<?php echo $value['Sale_Price'];?>" data-id="<?php echo $value['id'];?>" data-col="Sale_Price"></span><div class="get_column_data"></div>
                                </td>
                                <td>
                               <span class="td_data"><?php echo $value['Support_Paid_Date'];?><br /> <?php echo $support_Paid_Amount;?></span>
                                    <span class="glyphicon glyphicon-pencil edit_purchase_inputs" aria-hidden="true" data-val="<?php echo $value['Support_Paid_Date'];?>" data-id="<?php echo $value['id'];?>" data-col="Support_Paid_Date"></span><div class="get_column_data"></div>
                                </td>
                                <?php }else{ ?>
                                <td><span class="td_data"><?php if($value['Sale_Price'] != ""){?>$<?php echo number_format($value['Sale_Price'],2);?><?php } ?></span></td>
                                <td>
                                 <span class="td_data"><?php echo $value['Support_Paid_Date'];?></span>
                                 <?php echo '<br>'.$support_Paid_Amount;?>
                                </td>
                                <?php } ?>
                                <td>
                                    <span class="td_data"><?php echo $value['Notes'];?></span>
                                    <span class="glyphicon glyphicon-pencil edit_purchase_inputs" aria-hidden="true" data-val="<?php echo $value['Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="Notes"></span><div class="get_column_data"></div>
                                </td>
                                <td>   
                                      <?php  if(($user_data['user_type'] == 3)|| ($user_data['user_type'] == 7)){}else{?>   
                           <a href="<?php echo adm_base_url();?>/edit_purchases/<?php echo $value['id']?>" type="button" class="btn btn-success">Edit</a>
                           <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_purchases/')"  type="button" class="btn btn-danger">Delete</a>
                         <?php } ?></td>
                             </tr>
				<?php }
      }else{
        echo '<tr><td colspan="15"><div class="alert alert-danger">Data not found for selected product.</div></td></tr>';
      }?>
      </tbody>
</table>
<?php 
if(($user_data['user_type'] == 3)|| ($user_data['user_type'] == 7)){}else{
	$emails2 = "";
	$get_purchase_emails = explode('|',$emails);
	foreach($get_purchase_emails as $evalue){
	  $emails2 .= $evalue.';';
	}
	?>
	<div class="row email_listing">
		  <div class="col-sm-24">
			  <div class="">
				  <label>&nbsp;E-mail List</label>
				  <textarea id="email_list" style="min-height:180px;"><?php echo rtrim($emails2, ';'); ?></textarea>
				</div>
		  </div>
	  </div>
<?php } ?>  