<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">      	  	    	
      <div class="col-sm-24">
        <div class="form-group pull-right"> <a href="<?php echo adm_base_url();?>/vehicles/add_obp_option" class="btn btn-danger"  title="Add New Option">Add New Option</a> </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php if($this->session->flashdata('message_display')){?>
        <?php echo $this->session->flashdata('message_display');?>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="table-responsive tool_data chips_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>  
                  <th>Category 
                  	<a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom obp_cat_options" data_id="DESC" data-sort="Category_UUID"></a>
                  </th>	               
                  <th>Default Text 
                  	<a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom obp_cat_options" data_id="DESC" data-sort="Default_Text"></a>
                  </th> 
                  <th>Image </th>                                 
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach($results as $value){?>
					<tr>
                    	<td>
							<?php 
								$get_obp_category = get_obp_category($value['Category_UUID']);
								echo $get_obp_category[0]['Name'];
							?>
                        </td>
                    	<td><?php echo $value['Default_Text'];?></td>
                        <td>
                        	<?php 
								$get_image = get_image($value['Default_Image_UUID']);
								if($get_image[0]['Filename'] != ""){?>
                                <img class="customImage" src="<?php echo base_url();?>images/<?php echo $get_image[0]['Filename'];?>" />
							<?php } ?>
                        </td>
                        <td>
                        	<a href="<?php echo adm_base_url();?>/vehicles/edit_obp_options/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>   
                      		<a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/vehicles/delete_obp_options/')" class="btn btn-danger" >Delete</a>
                        </td>
                    </tr>
				<?php }	?>
              </tbody>
            </table>            
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here --> 