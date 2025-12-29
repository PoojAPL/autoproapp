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
        <div class="form-group pull-right"> <a href="<?php echo adm_base_url();?>/vehicles/add_obp_options_categories" class="btn btn-danger">Add New Category</a> </div>
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
                  <th>Name
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom obp_opt_cateogry_sort" data-by="Name" data_id="DESC"></a>
                   </th>	               
                                                  
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach($results as $value){?>
					<tr>
                    	<td><?php echo $value['Name'];?></td>                    	
                        <td>
                        	<a href="<?php echo adm_base_url();?>/vehicles/edit_obp_options_cat/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>   
                      		<a href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/vehicles/delete_obp_options_cat/')" class="btn btn-danger" >Delete</a>
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