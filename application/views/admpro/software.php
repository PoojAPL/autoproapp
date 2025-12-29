<?php 
$chip_value = "";
if(isset($this->session->userdata['chips_filter_session'])){
	$session_data = $this->session->userdata('chips_filter_session');
	$chip_value = $session_data['chips_filter_val'];
}
$show_chips_filter_array = array('all' => 'All Chips', '1' => 'Standard Chips Only','2' => 'Cloning Chip Only');
?>
<div id="right-container">
  <div class="site-form form-inline">
  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    <div class="row">
      <div class="col-sm-6">
        <form method="post" id="globalSearchKyes">
            <div class="form-group">                     
                  <input type="text" name="search_global_key" class="form-control search_global_key">
                  <button type="submit" class="btn btn-primary custom-button" name="search" value="software">Search</button>
            </div>
        </form>
      </div>
      <div class="col-sm-18">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/add_software" class="btn btn-danger">Add Software</a>        
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
        <form class="site-form" method="post" >
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="table-responsive chips_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>
				          <th style="width:137px">Action</th>
                  <th>ID</th> 
                  <th>Type
                  <!-- <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="type" data_id="DESC"></a> -->
                  </th>                
                  <th> Name </th>
                  <th>Vehicles</th>
                  <th>Images </th>
                  <th>Part #</th>
                  <th>Products </th>     
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($results as $value){?>
                    <tr>					                     
                        <td>
                            <a  href="<?php echo adm_base_url();?>/edit_software/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                            <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_software/')" type="button"class="btn btn-danger" >Delete</a>
                            <a  href="<?php echo adm_base_url();?>/copy_software/<?php echo $value['id'];?>" type="button" class="btn btn-info" >Copy</a> 
                        </td>
                        <td><?php echo $value['id'];?></td>     
                        <td><?php echo $value['type'];?></td>                                     
                        <td>
                            <span class="td_data"><?php echo $value['name'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['name'];?>" data-id="<?php echo $value['id'];?>" data-col="name" data-table="t_Tools_Software"></span><div class="get_column_data"></div> 
                        </td>
                        <td>
                            <?php 
                            if( $value['vehicles'] != ""){
                                $vehicles_UUIDs = explode(',', $value['vehicles']);
                                for($v = 0; $v < count($vehicles_UUIDs); $v++){
                                $get_vehicles = get_vehicles($vehicles_UUIDs[$v]);
                                $years = explode(',',$get_vehicles[0]['Years']);
                                $get_models_name = get_models_name($get_vehicles[0]['Model_UUID']);
                                $get_make_name = get_make_name($get_vehicles[0]['Model_UUID']);
                                echo $get_make_name[0]['Make_Name'].' ' .$get_models_name[0]['Model_Name'].'  '.$years[0].'-'.$years[count($years)-1].'<br>';
                                }
                            }
                            ?>
                        </td>
                        <td>
                            <?php if( $value['image'] != ""){ ?>
                            <img src="<?php echo asset_url();?>/images/<?php echo $value['image'];?>" width="50px">
                            <?php } ?>
                        </td>
                        <td>
                            <span class="td_data"><?php echo $value['part'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['part'];?>" data-id="<?php echo $value['id'];?>" data-col="part" data-table="t_Tools_Software"></span><div class="get_column_data"></div> 
                        </td>
                        <td>
                            <span class="td_data"><?php echo $value['products'];?></span>
                            <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['products'];?>" data-id="<?php echo $value['id'];?>" data-col="products" data-table="t_Tools_Software"></span><div class="get_column_data"></div> 
                        </td>
                    </tr> 
				<?php }?>
               </tbody>
            </table>
			<?php if(isset($links)){?>
			  <nav class="site-pg">
			 <ul class="pagination">               
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>	
               </ul>
			   </nav>
			<?php }?>	
          </div>
        </form>
      </section>
    </div>
  </div>
</div>

<!-- right container start here -->
