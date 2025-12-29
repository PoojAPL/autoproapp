<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">    	
      <div class="col-sm-24">
        <div class="form-group pull-right"> <a href="<?php echo adm_base_url();?>/add_buttons" class="btn btn-danger"  title="Add New Tool Type">Add New Button</a> </div>
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
          <div class="table-responsive tool_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>                              
                  <th>Name 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom buttons_sorting" data-by="Name" data_id="DESC"></a>
                  </th>                                 
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php                   
         		foreach($results as $value){?>
                        <tr>                        	
                            <td><?php echo $value['Name'];?></td>                            
                            <td>
                            	<a  href="<?php echo adm_base_url();?>/edit_buttons/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>   
                      			<a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_buttons/')" class="btn btn-danger" >Delete</a>
                            </td>
                        </tr>         
                <?php }?>
              </tbody>
            </table>            
          </div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here --> 