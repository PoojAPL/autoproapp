<div id="right-container">
  <div class="site-form form-inline remotePage">  
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php 
		error_reporting(0);
		if($this->session->flashdata('message_display')){?>
        <div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
        <?php }  ?>
        <div class="site-form" method="post">
          <div class="table-responsive">
            <table class="table table-bordered  table-data mar0 tab-con">
              <thead>
                <tr style="white-space:nowrap;">
					<th>Action</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Company Name</th>
                  <th>Address1</th>
                  <th>Address2</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zip Code</th>
                  <th>Phone</th>
                  <th>Email</th>
				  <th>Payament Entity</th>
                <th>Qualifying Machine Number</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php foreach($getCashBackRequest as $value){?>
                <tr>
				<td style="white-space:nowrap;">
                    <a href="<?php echo adm_base_url();?>/autopropad/edit_cashback_request/<?php echo $value['id'];?>"   class="btn btn-success">Edit</a>
                    <a href="javascript:void(0)" onclick="DeleteCashBackRequest(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/autopropad/delete_cashback_request/')" type="button" class="btn btn-danger">Delete</a>
                  </td>
                    <td>  <?php echo $value['first_name'];?> </td>
                    <td>  <?php echo $value['last_name'];?> </td>
                    <td>  <?php echo $value['company_name'];?> </td>
                    <td>  <?php echo $value['address1'];?> </td>
                    <td>  <?php echo $value['address2'];?> </td>
                    <td>  <?php echo $value['city'];?> </td>
                    <td>  <?php echo $value['state'];?> </td>
                    <td>  <?php echo $value['zip_code'];?> </td>
                    <td>  <?php echo $value['phone'];?> </td>
                    <td>  <?php echo $value['email'];?> </td>
					<td>  <?php echo $value['payment_entity'];?> </td>
					<td>
					<?php if($value['checktype'] !=""){?>
					<h5><strong >Qualifying Machine Number 1</strong></h5>
						<strong >Type:</strong> <?php echo $value['checktype'];?><br>
						<strong >Serial Number:</strong> <?php echo $value['serial_number'];?><br>
						<strong >Distributor Purchased From:</strong> <?php echo $value['distributor_purchased'];?><br>
						<strong >Purchase Date:</strong> <?php echo $value['purchase_date'];?><br>
            <strong >Attachment:</strong>  <?php if($value['file'] !=""){ ?>
              <a href="https://autopropad.com/upload/<?php echo $value['file'];?>" download="Images" target="_blank">
                <img src="https://autopropad.com/upload/<?php echo $value['file'];?>" width="100"/>
              </a>							
					<?php } }?>
					<?php if($value['checktype2'] !=""){?>
					<h5><strong >Qualifying Machine Number 2</strong></h5>
						<strong >Type:</strong> <?php echo $value['checktype2'];?><br>
						<strong >Serial Number:</strong> <?php echo $value['serial_number2'];?><br>
						<strong >Distributor Purchased From:</strong> <?php echo $value['distributor_purchased2'];?><br>
						<strong >Purchase Date:</strong> <?php echo $value['purchase_date2'];?><br>
            <strong >Attachment:</strong>  <?php if($value['file2'] !=""){ ?>
              <a href="https://autopropad.com/upload/<?php echo $value['file2'];?>" download="Images" target="_blank">
                <img src="https://autopropad.com/upload/<?php echo $value['file2'];?>" width="100"/>	
              </a>						
					<?php }}?>
					<?php 
					if($value['qualifying_machine_Array'] !=""){?>
						<h5><strong >More Attachmentments</strong></h5>
						<?php
						$data =  explode(",",$value['qualifying_machine_Array']);
						array_pop($data);
            foreach($data as $files){?>
            <a href="https://autopropad.com/upload/<?php echo $files;?>" download="Images" target="_blank">
              <img src="https://autopropad.com/upload/<?php echo $files;?>" width="100"/>	
            </a>						  
						
					<?php }  }?>
					</td>                   
                  
                </tr>
                <?php } ?>
              </tbody>
            </table>
            
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

