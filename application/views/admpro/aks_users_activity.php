<?php 
$outputs1 = $this->session->userdata('login_firebase_user');
?>
<div id="right-container">
  <div class="site-form form-inline">
    <div class="row"> 
    <div class="col-sm-6">      
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="table-responsive tool_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>  
                  <th>BASIC USER INFO </th>  
                  <th>PURCHASING ACTIVITY</th>
                  <th>AUTOPROAPP ACTIVITY SUMMARY</th>  
                  <th>AUTOPROAPP CONTRIBUTIONS</th>    
                </tr>
              </thead>
             	<tbody>
                  <td style="vertical-align: top;"><?php echo $aks_users_info[0]['FirstName'];?> <?php echo $aks_users_info[0]['FirstName'];?>
                  <br><?php echo $aks_users_info[0]['Email'];?>
                  <br><?php echo $aks_users_info[0]['PhoneNumber'];?>                  
                </td>
                <td style="vertical-align: top;">Order with AKS (
                  <?php 
                    $customers_orders = get_aks_customers_orders($id); 
                    if($customers_orders){
                       echo count($customers_orders);
                     }else{ 
                      echo 0;
                    } 
                  ?>)<br>
                  Orders total with AKS (
                  <?php 
                    $Orders_total = 0;                    
                    if($customers_orders){
                      foreach ($customers_orders as $value) {
                        $aks_orders_total = aks_orders_total($value['orders_id']);
                        
                        foreach ($aks_orders_total as $order_value) {
                          $Orders_total += $order_value['value'];
                        }                        
                      }
                      echo '$'.number_format($Orders_total,2);
                     }else{ 
                      echo '$'.number_format($Orders_total,2);
                    } 
                  ?>)<br>
                  Average order with AKS (
                    <?php $avg_orders = $Orders_total/count($customers_orders);
                    echo number_format($avg_orders,2);
                    ?>
                  )<br>
                </td>
                <td> 
                    <div style="float: right">  
                    <strong>Device: </strong>   <br>           
                    <?php foreach($outputs1['devices'] as $devices_key => $devices_value){                       
                          echo $devices_value['modelName'];                      
                    } ?>
                    </div> 
                    <div style="float: left"> 
                      <strong>Logins: </strong><br>
                    <?php foreach($outputs1['logins'] as $login_value){ ?>                     
                      <div id="<?php echo $login_value?>"></div>
                      <script type="text/javascript">
                        var timestamp = <?php echo $login_value;?>;
                        var myDate = new Date(timestamp);
                        var formatedTime= myDate.getMonth()+'/'+myDate.getDate()+'/'+myDate.getFullYear();
                        document.getElementById(<?php echo $login_value;?>).innerHTML = formatedTime;
                      </script>                     
                    <?php } ?> 
                    </div>                 
                </td>
                <td style="vertical-align: top;">
                  <?php $data_contribution  = data_contribution($id);
                  if($data_contribution){
                    foreach ($data_contribution as $correction) {
                      $Dated = explode(' ',$correction['Dated']);
                      $Image_path = explode(',',$correction['Images']);
                      $type = $correction['Feedback_type'];
                      if($type == 'key_making'){
                        $Feedback_type_data = ','.$correction['content'];
                      }elseif( $type=='submit_correction'){
                         $Feedback_type_data = ','.$correction['content'];;
                      }elseif( $type=='tips_tricks'){
                         $Feedback_type_data = ','.$correction['content'];;
                      }else{
                        $Feedback_type_data = '';
                      }
                      echo '('.$Dated[0].'), '.$correction['vehicle'].' '.$Feedback_type_data;?>
                     <?php for($im=0; $im < count($Image_path);$im++) {?>
                        <span class="image-holder">
                          <a href="<?php echo $Image_path[$im];?>" target="_blank"><img src="<?php echo $Image_path[$im];?>" style="width:100px;" /></a>
                          </span>
                      <?php } 
                      echo '<br>';
                    }
                  }
                  ?>

                </td>
                <!-- <tr>
                  <td colspan="5"><div class="alert alert-danger"> Data not found.</div></td>
                </tr> -->
              </tbody>
            </table>            
          </div>          
        </div>
      </section>
    </div>
  </div>
</div>