<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">  
    	<div class="col-sm-5">
        	<div class="form-group">
            	<label>Type: </label>
            	<select class="form-control selectImageTypes" data-id="Image_Type_UUID">
                  <option value="all">All</option>
                  <?php foreach($image_types as $type){?>
                    <option value="<?php echo $type['UUID'];?>"><?php echo $type['Name'];?></option>
                 <?php } ?>
                </select>
            </div>
        </div>  	    	
      <div class="col-sm-19">
        <div class="form-group pull-right"> <a href="<?php echo adm_base_url();?>/add_image" class="btn btn-danger"  title="Add New Image">Add New Image</a> </div>
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
                  <th>Image</th>	 
                  <th>Type 
                  	<a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom image_sorting_by_type" data_id="DESC" data-sort="Image_Type_UUID"></a>
                  </th>	               
                  <th>Filename </th>                                  
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach($results as $value){?>
					<tr>
                    	<td>
							<?php 
							if($value['Filename'] != ""){?>
                            	<img src="<?php echo base_url();?>images/<?php echo $value['Filename'];?>" class="customImage" />
							<?php } ?>                        
                        </td>
                    	<td>
							<?php 
								$get_image_type = get_image_type( $value['Image_Type_UUID'] ); 
								echo $get_image_type[0]['Name'];
							?>                        
                        </td>
                    	<td><?php echo $value['Filename'];?></td>
                        <td>
                        	<a href="<?php echo adm_base_url();?>/edit_image/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>   
                      		<a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_image/')" class="btn btn-danger" >Delete</a>
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