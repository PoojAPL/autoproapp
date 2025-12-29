<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
      <div class="col-sm-12">
        <form method="post" id="globalSearchKyes">
            <div class="form-group">                     
                  <input type="text" name="search_global_key" class="form-control search_global_key">
                  <button type="submit" class="btn btn-primary custom-button" name="search" value="batteries">Search</button>
            </div>
        </form>
      </div>
      <div class="col-sm-12">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/add_battery" class="btn btn-danger" >Add New Battery </a>        
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
                  <th>ID</th> 
                  <th>AKG#</th>                
                  <th>Name 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom battery_sorting" data-by="Battery_Name" data_id="DESC"></a>
                  </th>
                  <th>Images 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom battery_sorting" data-by="Battery_Image_Url" data_id="DESC"></a>
                  </th>                  
                  <th>Products
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom battery_sorting" data-by="Products" data_id="DESC"></a>
                  </th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($getAllbatteries as $value){?>
                    <tr> 
                      <td><?php echo $value['id'];?></td> 
                      <td>
                        <span class="td_data"><?php echo $value['akg_num'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['akg_num'];?>" data-id="<?php echo $value['id'];?>" data-col="akg_num" data-table="t_Batteries" data-img="Battery_Image_Url"></span><div class="get_column_data"></div>
                      </td>                    
                      <td class="sorting-column">                      	 
                        <span class="td_data"><?php echo $value['Battery_Name'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Battery_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Battery_Name" data-table="t_Batteries" data-img="Battery_Image_Url"></span><div class="get_column_data"></div> 
                      </td>
                      <td>
                      <?php
					  $images = $value['Battery_Image_Url'];
					  if($images ==""){					  
					  }else{
					  	echo '<span class="td_data"><img class="customImage" src ="'.aks_img_url().$images.' "></span>';
					  }					  
					  ?>
                       <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Battery_Image_Url'];?>" data-id="<?php echo $value['id'];?>" data-col="Battery_Image_Url" data-table="t_Batteries" data-img="Battery_Image_Url"></span><div class="get_column_data"></div>
                  	</td>
                      	<td><span class="td_data"><?php echo $value['Products'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Products'];?>" data-id="<?php echo $value['id'];?>" data-col="Products" data-table="t_Batteries" data-img="Battery_Image_Url"></span><div class="get_column_data"></div>
                     </td>
                       <td><a  href="<?php echo adm_base_url();?>/edit_battery/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                      <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_battery/')" type="button"class="btn btn-danger" >Delete</a></td>
                     
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
