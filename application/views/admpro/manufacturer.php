<div id="right-container">
  <form class="site-form form-inline"  style="margin-top: 10px;">
    <div class="row">
      <div class="col-sm-24">
        <div class="form-group addmakesButton">          
          <a href="<?php echo adm_base_url();?>/add_manufacturer" class="btn btn-danger"  title="Sign Out">Add New Manufacturer</a>        
        </div>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    		<?php echo $this->session->flashdata('message_display');?>
     <?php } ?>
        <form class="site-form" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="table-responsive make_users chips_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>                  
                  <th> Name
                   <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom manufacturers_sorting" data-by="Manufacturer_Name" data_id="DESC"></a>
                  </th>
                  <th style="width: 137px;">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($getAllManufacturer as $users){?>
                    <tr>
                       <td>
                        <span class="td_data"><?php echo $users['Manufacturer_Name'];?></span>
                    	<span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $users['Manufacturer_Name'];?>" data-id="<?php echo $users['id'];?>" data-col="Manufacturer_Name" data-table="t_Manufacturers" data-img=""></span><div class="get_column_data"></div> 
                       </td>
                      <td><a  href="<?php echo adm_base_url();?>/edit_manufacturer/<?php echo $users['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                      <a href="javascript:void(0)" type="button"class="btn btn-danger" onClick="DeleteModelFunction(<?php echo $users['id'];?>, '<?php echo adm_base_url();?>/delete_manufacturer/')">Delete</a>
                      </td>
                    </tr>
			  <?php }  ?>                
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
            <?php } ?>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>

<!-- right container start here -->
