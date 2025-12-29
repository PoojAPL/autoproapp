<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">    	    	
      <div class="col-sm-24">
        <div class="form-group pull-right"> <a href="<?php echo adm_base_url();?>/add_image_types" class="btn btn-danger"  title="Add New Image Type">Add New Image Type </a> </div>
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
                  <th>Name </th>  
                  <th>Path </th>                                    
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
              	<?php foreach($results as $value){?>
					<tr>
                    	<td><?php echo $value['Name'];?></td>
                        <td><?php echo $value['Path'];?></td>
                        <td>
                        	<a  href="<?php echo adm_base_url();?>/edit_image_types/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>   
                      		<a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_image_types/')" class="btn btn-danger" >Delete</a>
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