<?php $order_id = 'asc';
$angle = 'bottom';
if($order_by == 'asc'){
  $order_id = 'desc';
  $angle = 'top';
}else if($order_by == 'desc'){
  $order_id = 'asc';
  $angle = 'bottom';
}
$type_array = array('GTL-' => 'GTL Products','BRK-' => 'BlueRocket Products','STR-' => 'STR Products');?>
<div id="right-container">
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <div class="site-form">
          <div class="table-responsive">
            <h3>Products</h3>
            <div class="row">
                <div class="col-sm-4">
                    <form method="post" action="">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                        <label>&nbsp;Filter By Type</label>
                        <select class="form-control" name="product_type" onChange="this.form.submit();">
                            <option value="">All</option>
                            <?php $user_data = $this->session->userdata('login_supplier');
                            $product_type = $user_data['product_type'];
                            $product_type = explode(',',$product_type);
                            for($i = 0; $i < count($product_type); $i++){
                                if(trim($product_type[$i]) == $_SESSION['product_type']){
                                    $selected = 'selected';
                                }else{
                                    $selected = ''; 
                                }
                                echo '<option '.$selected.' value="'.trim($product_type[$i]).'">'.$type_array[ trim($product_type[$i]) ].'</option>';
                            }?>
                        </select>
                    </form>
                </div>
                <div class="col-sm-4">
                  <form method="post" action="<?php echo base_url();?>suppliers/products">
                    <br><br><?php //echo $this->input->cookie('active_products',true);?>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />  
                    <input type="hidden" name="as" value="aS" /> 
                    <?php if($this->input->cookie('active_products',true) > 0){?>
                      <input type="hidden" value="0" name="active_products"> 
                      <input type="checkbox" checked onClick="this.form.submit();">&nbsp; View Inactive Products
                   <?php }else{?> 
                    <input type="hidden" value="1" name="active_products">    
                    <input type="checkbox"  onClick="this.form.submit();">&nbsp; View Inactive Products
                   <?php } ?>
                  </form>
                </div>
                <div class="col-sm-7 pull-right">
                    <form method="post" action="" class="pull-right">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                        <input style="display: inline-block;width: 250px;margin-top: 30px;" type="text" class="form-control" name="product_search" placeholder="Name, Model, Item" value="<?php echo $_SESSION['product_search'];?>">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </div>
            </div><br>
            <table class="table table-data mar0">
            <thead>
                <tr>
                  <th>Product Name
                    <a href="<?php echo base_url();?>suppliers/products/<?php echo $page;?>/?sort=pd.products_name-<?php echo $order_id;?>" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?>"></a>
                  </th>
                  <th>AKS Item #
                    <a href="<?php echo base_url();?>suppliers/products/<?php echo $page;?>/?sort=p.products_id-<?php echo $order_id;?>" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?>"></a>
                  </th>  
                  <th>Model
                    <a href="<?php echo base_url();?>suppliers/products/<?php echo $page;?>/?sort=p.products_model-<?php echo $order_id;?>" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?>"></a>
                  </th>
                  <th>Cost</th>
                  <th>Price</th>
                  <th>Qty 
                    <a href="<?php echo base_url();?>suppliers/products/<?php echo $page;?>/?sort=p.products_quantity-<?php echo $order_id;?>" type="button" class="glyphicon glyphicon-triangle-<?php echo $angle;?>"></a>
                  </th>
                  <th>Sales History</th>
                  <th>Days Remaining</th>                  
                </tr>
              </thead>
              <tbody>
                <?php foreach ($result as  $value) {
                    if( $value['products_status']== 0){
                      $class = 'danger';
                    }else{
                      $class = '';
                    }  ?>
                    <tr class="<?php echo $class;?>">                        
                        <td><?php echo $value['products_name'];?></td>
                        <td><?php echo $value['products_id'];?></td>
                        <td><?php echo $value['products_model'];?></td>
                        <td>$<?php echo number_format($value['products_cost'],2);?></td>
                        <td>$<?php echo number_format($value['products_price'],2);?></td>
                        <td><?php echo $value['products_quantity'];?></td>
                        <td>
                        <?php $sold_num_30 = num_sold($value['products_id'], 30); ?>
                            <?php $sold_num_60 = num_sold($value['products_id'], 60) - $sold_num_30; ?>
                            <?php $sold_num_90 = num_sold($value['products_id'], 90) - num_sold($value['products_id'], 60); ?>
                            <?php $total_sold  = num_sold($value['products_id'], 90);
                        echo (int)$sold_num_30.'/'.(int)$sold_num_60.'/'.(int)$sold_num_90.' ('.(int)$total_sold,')';?>   
                        </td>
                        <td><?php echo product_remaining_days($value['products_id']);?></td>                        
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
