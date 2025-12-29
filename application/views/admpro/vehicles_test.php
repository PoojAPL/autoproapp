<?php 
$autopropad_hide = '';
$autopropad_checked = '';
 if(isset($_COOKIE['autopropad_cookie'])){ 
	 $cookieValue = $_COOKIE['autopropad_cookie'];
	 if( $cookieValue == 1){
		$autopropad_hide = 'hide';
		$autopropad_checked = 'checked';
	 }else{
		$autopropad_hide = '';
		$autopropad_checked = '';
	 }
 }
?>
<div id="right-container">
  
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    	<?php echo $this->session->flashdata('message_display');?>
     <?php } ?>
        
        <input type="checkbox" class="HideAutoProPAD" <?php echo $autopropad_checked;?> /> Hide AutoProPAD &nbsp; &nbsp;
       
        <br /><br />
         <div class="site-form">
          <div class="table-responsive chips_data vehiclesData" style="overflow:visible"> 
            <table class="table table-bordered table-data mar0 tab-con">
              <thead>
                
                <tr>
                
                  <th class="AutoProPAD <?php echo $autopropad_hide;?>">All Keys Lost
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom vehicle_sort_retainer" data-by="APP_All_Keys_Lost" data_id="DESC"></a>
                  </th>
                                        
                </tr>
              </thead>
              <tbody>
             	<?php 				
				foreach($results as $value){
					if($value['APP_All_Keys_Lost'] !="" &&  $value['APP_All_Keys_Lost']==='no'){?>
                	<tr>
                    	
                          <td class="AutoProPAD <?php echo $autopropad_hide;?>">
                          <div class="vh_value_holder">
                           <span class="td_data"><?php echo $value['APP_All_Keys_Lost'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_vh_inputs" aria-hidden="true" data-val="<?php echo $value['APP_All_Keys_Lost'];?>" data-id="<?php echo $value['id'];?>" data-col="APP_All_Keys_Lost"></span><div class="get_column_data"></div>
                          </div>
                          </td>
                                               
                    </tr>
                <?php } 
				}?>
              </tbody>
            </table>
          </div>
          
        </div>
      </section>
    </div>
  </div>
</div>