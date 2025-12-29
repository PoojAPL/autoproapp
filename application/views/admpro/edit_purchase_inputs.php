<form method="post">
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
	<?php if( $column=='Support_Paid_Date'){
		$get_support_paid_amt = get_support_paid_amt($dataId);
		if($get_support_paid_amt[0]['Support_Paid_Amount'] == NULL){
			$support_Paid_Amount= "";
		}else{
			$support_Paid_Amount = $get_support_paid_amt[0]['Support_Paid_Amount'];
		}
		
		?>
        <input type="text" class="form-control datepickerDate" name="Support_Paid_Date" value="<?php echo $value;?>">
    	<input type="text" class="form-control Support_Paid_Amount" placeholder="0.00"  name="Support_Paid_Amount" value="<?php echo $support_Paid_Amount;?>"> 
        <input type="hidden" name="key" value="<?php echo $dataId;?>"  />      
    <?php }else{
		
		if( $column == 'Order_Date'){
			$datepickerDate = 'datepickerDate';
		}else{
			$datepickerDate = '';
		} ?>
    <input type="text" class="form-control <?php echo $datepickerDate;?>" name="<?php echo $column;?>[<?php echo $dataId;?>]" value="<?php echo $value;?>" style="width: 130px;" />    
    <?php } ?>
    <input type="hidden" name="columnName" value="<?php echo $column;?>" />
    <button type="button" class="btn btn-success custom-button2 purchase_input_update"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
    <button type="button" class="btn btn-danger custom-button2  purchase_input_remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
</form>
<script>
$(function() {
     $( ".datepickerDate" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,	 
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
});
</script>