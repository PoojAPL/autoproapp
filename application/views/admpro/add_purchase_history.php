<?php $user_data = $this->session->userdata('login_user');
$user_username = $user_data['username']; ?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-24 col-md-24">                         
    <section class="innerUserlogin white-box">
    <?php if($this->session->flashdata('message_display')){?>
  <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
  <?php } ?>
  <form class="site-form " method ="post" id="AddPurchaseForm" action="<?php echo adm_base_url();?>/save_purchases">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <?php $product_array = get_purchase_machines();
			$status_array = array('OK', 'Returned', 'Canceled');
		?>
        <div class="row">
              <div class=" col-sm-4 ">
                <div class="labelcol">
                  <label class="control-label">Product</label>
                </div>
              </div>
              <div class="col-sm-10">
                <div class="inputcol">
                   <select class="form-control" name="Product">
                   		<option value="">Please select</option>
                        <?php foreach($product_array as $product){?>
						<option><?php echo $product['machine'];?></option>
						<?php }?>
                   </select>
                </div>
              </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Customer Name</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Customer Name" name="Customer_Name">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Company</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Company" name="Customer_Company">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Email Address</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Email Address" name="Customer_Email">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Order #</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Order Number" name="Order_Number">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Order Date</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" id="prchaseDate" name="Order_Date" value="<?php echo date('m/d/Y');?>">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Serial #</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Serial Number" name="Serial_Number">
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Status</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">              
               <select class="form-control" name="Status">
                    <?php foreach($status_array as $status){?>
                    <option><?php echo $status;?></option>
                    <?php }?>
               </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Sale Price</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="number" class="form-control purchase_sale_price" placeholder="00.00" step="0.00" name="Sale_Price">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Support Paid Amount</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
              <!-- <input type="text" class="form-control Support_Paid_Amount" placeholder="Support Paid Amount" disabled="disabled">-->
              <input type="text" class="form-control" name="Support_Paid_Amount">
            </div>
          </div>
        </div>
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Support Paid Date</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control datepickerDate" placeholder="Support Paid Date" name="Support_Paid_Date">
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class=" col-sm-4 ">
            <div class="labelcol">
              <label class="control-label">Notes</label>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="inputcol">
               <input type="text" class="form-control" placeholder="Notes" name="Notes">
            </div>
          </div>
        </div>
      <hr>
    <div class="row">
   		 <div class=" col-sm-4 ">
        <div class="labelcol">
          <label class="control-label"></label>
        </div>
      </div>
    <div class="col-md-12">
        <button type="submit" class="btn btn-success" name="post">Submit</button>
        <a href="<?php echo adm_base_url();?>/purchase_history" class="btn btn-danger">Cancel</a>
    </div>   
  </div>
   </form>
  </div>
  </div>
</div>
