<?php
$user_data = $this->session->userdata('login_user');
$user_username = $user_data['username'];
$email = $user_data['email'];
$get_admin_deatils = get_admin_deatils($email);
$user_type = $get_admin_deatils[0]['type'];
$get_type_access = get_type_access($user_type);
$user_type_access = explode(',',$get_type_access[0]['user']);
$content_type_access = explode(',',$get_type_access[0]['content']);
$key_codes_type_access = explode(',',$get_type_access[0]['key_codes']);
$admin_type_access = explode(',',$get_type_access[0]['admin']);
$other_type_access = explode(',',$get_type_access[0]['other']);
if( isset($this->session->userdata['remotes_pagination'])){
	$per_page1 = $this->session->userdata['remotes_pagination'];
	$per_page = $per_page1['per_page'];
}else{
	$per_page = "";
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

$angle = ""; 
$sorting_id = "";
if(isset($this->session->userdata['purchases_sorting_sess'])){
   $session_data = $this->session->userdata('purchases_sorting_sess');
   $sorting_by = $session_data['purchases_sorting'];
   $sorting = $session_data['purchase_sort_order'];
   if($sorting == 'DESC'){
		$sorting_id = 'ASC';
		$angle = 'top';
	}else if($sorting == 'ASC'){
		$sorting_id = 'DESC';
		$angle = 'bottom';
	}
}else{
	$sorting_by ="";
	$sorting_id = 'ASC';
	$angle = 'top';
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

if(isset($this->session->userdata['purchases_search'])){
   $session_data = $this->session->userdata('purchases_search');
   $purchases_search_val = $session_data['purchases_search_val'];
}else{
	$purchases_search_val = "";
}
$purchase_machines = get_purchase_machines();
/*$product_array = array('PS80', 'PS90', 'AutoProPAD', '3D Xtreme', '3D Elite','Condor XC Mini','PS80, PS90 & AutoProPAD','VVDI MB','VVDI2', 'VVDI Key Tool','All VVDI Machines','Diagspeed', 'VVDI MB', 'VVDI2','VVDI Key Tool');
foreach($product_array as $product){
	insert_v_types($product);
}*/

?>
<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
     <div class="col-sm-4">
     	<div style="margin-top: 5px;">
        	<input type="checkbox" class="HideCancelReturns" <?php echo $cancelReturn_checked;?> /> Hide Cancels & Returns             
        </div>
     </div>
     <div class="col-sm-3">
     	<div style="margin-top: 5px;">        	
            <input type="checkbox" class="HideSupportPaid" <?php echo $support_paid_checked;?> /> Hide Support Paid
        </div>
     </div>
    <div class="col-sm-8">
      	<div class="form-group">
        	 <label>Show Only:</label>
             <select class="form-control select-field purchase_products_filter" style="width: auto;">
             	 <option value="all">All Products</option>
               <option value="All VVDI Machines">All VVDI Machines</option>
                <?php foreach($purchase_machines as $product){					
      					if($purchases_search_val == $product['machine']){
      						$selected = 'selected';
      					}else{
      						$selected = '';
      					}?>
                <option <?php echo $selected;?>><?php echo $product['machine'];?></option>               
                <?php }?>                
             </select>
             <small><u><a href="<?php echo adm_base_url();?>/product_to_machine_purchase" style="color:#337ab7;">Add New Product to Machine Purchases</a></u></small>
      	</div>        
      </div>
      <div class="col-sm-6">
            <form method="post" id="search_purchases">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control" placeholder="customer,order,serial,note" style="width:auto;">
                     <button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
      </div>
     
      <div class="col-sm-3">
        <div class="form-group addCodeSeries"> 
        <?php if( in_array('manageMachinePurchase', $other_type_access)){?>          
          <a href="<?php echo adm_base_url();?>/add_purchase_history" class="btn btn-danger" >Add New</a> 
        <?php } ?>         
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
       <?php  if(($user_data['user_type'] == 3)|| ($user_data['user_type'] == 7)){
					$remove_editing = 'remove_editing';
			  }else{
				$remove_editing = '';
			  }
		//echo count($get_all_purchase_history_rows);?> 
     <span class="pull-right"> <strong>Last updated <?php echo date('m/d/Y', strtotime($get_all_purchase_history_rows[0]['Order_Date']));?></strong></span><br /><br />
        <form class="site-form" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="table-responsive chips_data <?php echo $remove_editing;?>" style="overflow:visible">
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
                  <?php if( in_array('manageMachinePurchase', $other_type_access)){?>          
                    <th style="width:137px">Action</th> 
                  <?php } ?>                 
                </tr>
              </thead>
              <tbody>
              <?php 
			  $emails = "";
			  $i =1;
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
                                <?php if( in_array('manageMachinePurchase', $other_type_access)){?>  
                                   <a href="<?php echo adm_base_url();?>/edit_purchases/<?php echo $value['id']?>" type="button" class="btn btn-success">Edit</a>
                                   <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_purchases/')"  type="button" class="btn btn-danger">Delete</a>
                              <?php } ?></td>
                             </tr>
      				        <?php }?>
                     </tbody>
                  </table>
                  <?php 
                  if(($user_data['user_type'] == 3)|| ($user_data['user_type'] == 7)){
                  }else{
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
              </div>
              <div class="row">
                      <div class="col-sm-20">                               
                        <nav class="site-pg">
                              <ul class="pagination">               
                              <?php foreach ($links as $link) {
                                      echo '<li>'. $link.'</li>';
                              } ?>	
                             </ul>
                        </nav>                
                      </div>
                  </div> 
              
        </form>        
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->
<script type="text/javascript">
    var textBox = document.getElementById("email_list");
    textBox.onfocus = function() {
        textBox.select();
		textBox.onmouseup = function() {
            textBox.onmouseup = null;
            return false;
        };
    };
</script>