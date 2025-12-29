
<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">  
    	  	    	
      <div class="col-sm-24">
        <div class="form-group pull-right"> <a href="<?php echo adm_base_url()?>/vehicles/add_vehicle_type" class="btn btn-danger">Add New Vehicle Type</a> </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    	<div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
     <?php } ?>
    
        <form class="site-form" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="table-responsive chips_data" style="overflow:visible">
            <table class="table table-bordered  table-data mar0 tab-con">
              <thead>
                <tr>  
                  <th style="width:50px;"># </th>	               
                  <th style="text-align: left;">Type </th>                  
                  <th style="width:137px;text-align: left;">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($results as $value){?>
                 <tr>
                  	<td><?php echo $i++;?></td>
                    <td><?php echo $value['type'];?></td>                    
                    <td>
                    <a href="<?php echo adm_base_url()?>/vehicles/edit_vehicle_type/<?php echo $value['id'];?>" type="button" class="btn btn-success">Edit</a>
                    <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url()?>/vehicles/delete_vehicle_type/')" type="button" class="btn btn-danger">Delete</a>
                    </td>
                 </tr>                
			  <?php }?>
               </tbody>
            </table>
            
          </div>
        </form>
      </section>
    </div>
  </div>
</div>

<!-- right container start here -->
