<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">    	
      <div class="col-sm-24">
        <div class="form-group addCodeSeries"> <a href="<?php echo adm_base_url();?>/add_lock_types" class="btn btn-danger"  title="Add New Part Type">Add New Lock Types</a> </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="table-responsive tool_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>  
                  <th>Name
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom part_type_sorting" data-by="Name" data_id="DESC"></a>
                  </th>                  
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
             	<tbody>
                	<?php foreach($results as $value){?>
                    	<tr>
                        	<td><?php echo $value['Name'];?></td>
                            <td>
                              <a href="<?php echo adm_base_url();?>/edit_lock_type/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a> 
                              <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_part_type/')" class="btn btn-danger" >Delete</a>
                           </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
          </div>
        </div>
      </section>
    </div>
  </div>
</div>

<!-- right container start here --> 
