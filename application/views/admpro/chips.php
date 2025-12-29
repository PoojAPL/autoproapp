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
      	<div class="form-group">
        	 <label>Show</label>
             <select class="form-control show_chips_filter" style="width: auto;">
             	<?php foreach($show_chips_filter_array as $chip_key => $chips){
					if($chip_value == $chip_key){
						$selected = 'selected';
					}else{
						$selected = '';
					}?>
                <option value="<?php echo $chip_key;?>" <?php echo $selected;?>><?php echo $chips;?></option>
                <?php }?>
             </select>
      	</div>
      </div>
      <div class="col-sm-6">
        <form method="post" id="globalSearchKyes">
            <div class="form-group">                     
                  <input type="text" name="search_global_key" class="form-control search_global_key">
                  <button type="submit" class="btn btn-primary custom-button" name="search" value="chips">Search</button>
            </div>
        </form>
      </div>
      <div class="col-sm-12">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/add_chips" class="btn btn-danger"  title="Sign Out">Add Chips</a>        
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    	<?php echo $this->session->flashdata('message_display');?>
     <?php } ?>
        <form class="site-form" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="table-responsive chips_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>
				          <th style="width:137px">Action</th>
                  <th>ID</th> 
                  <th>AKG#</th>              
                  <th> Name 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Chip_Name" data_id="DESC"></a>
                  </th>
                  <th>Images 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Chip_Image_Url" data_id="DESC"></a>
                  </th>
                  <th>Cloning Type
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Cloning_type" data_id="DESC"></a>
                  </th>
                  <th>Cloneable
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Clonable" data_id="DESC"></a>
                  </th>
                  <th>Reusable
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Reusable" data_id="DESC"></a>
                  </th>
                  <th>Cloning Chip
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="CloningChip" data_id="DESC"></a>
                  </th>
                  <th>Products
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Products" data_id="DESC"></a>
                  </th>
                  <th>Clone With
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Clone_With" data_id="DESC"></a>
                  </th>
                  <th>Cloning Machine
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom chips_sorting" data-by="Cloning_Machine" data_id="DESC"></a>
                  </th>
                 
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($getAllChips as $value){?>
                    <tr>
					                     
                       <td><a  href="<?php echo adm_base_url();?>/edit_chips/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                      <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/deletechips/')" type="button"class="btn btn-danger" >Delete</a></td>
					            <td><?php echo $value['id'];?></td>     
					   
                      <td>
                        <span class="td_data"><?php echo $value['akg_num'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['akg_num'];?>" data-id="<?php echo $value['id'];?>" data-col="akg_num" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div>
                      </td>
                                     
                      <td>
					            <span class="td_data"><?php echo $value['Chip_Name'];?></span>
                      <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Chip_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Chip_Name" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div> 
                      </td>
                      <td>
                      <?php
                        $images = $value['Chip_Image_Url'];
                        if($images ==""){					  
                        }else{
                        echo '<span class="td_data"><img class="customImage" src ="'.aks_img_url().$images.'"></span>';
                        }					  
                      ?>
                     <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Chip_Image_Url'];?>" data-id="<?php echo $value['id'];?>" data-col="Chip_Image_Url" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div> 
                  	</td>
                    <td>
                      <span class="td_data"><?php echo $value['Cloning_type'];?></span>
                      <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Cloning_type'];?>" data-id="<?php echo $value['id'];?>" data-col="Cloning_type" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div>
                      </td>
                      <td>
                      <span class="td_data"><?php if($value['Clonable'] == 1){echo 'Yes';}else{echo 'No';}?></span>
                      <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Clonable'];?>" data-id="<?php echo $value['id'];?>" data-col="Clonable" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div>
                      </td>
                      <td>
                          <span class="td_data"><?php if($value['Reusable'] == 1){echo 'Yes';}else{echo 'No';}?></span>
                          <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Reusable'];?>" data-id="<?php echo $value['id'];?>" data-col="Reusable" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div>
                      </td>
                       <td>
                          <span class="td_data"><?php if($value['CloningChip'] == 1){echo 'Yes';}else{echo 'No';}?></span>
                          <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['CloningChip'];?>" data-id="<?php echo $value['id'];?>" data-col="CloningChip" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div>
                      </td>
                                        
                      <td><span class="td_data"><?php echo $value['Products'];?></span>
                      <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products" data-table="t_Chips" data-img="Chip_Image_Url"></span><div class="get_column_data"></div> </td>
                      
                      <td><?php $chips_data = explode(',',$value['Clone_With']);
                      for($c = 0; $c < count($chips_data); $c++){
                          $get_chips = get_chips($chips_data[$c]);
                          echo $get_chips[0]['Chip_Name'].'<br>';
                      }?></td>                      
                     
                     <td><?php echo $value['Cloning_Machine'];?></td> 
                      </tr>
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
