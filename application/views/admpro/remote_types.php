<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
    	<div class="col-sm-24">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/add_remote_type" class="btn btn-danger" >Add New Remote Type</a>        
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
        <div class="site-form">
          <div class="table-responsive chips_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>  
                  <th>Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom remoteTypeSorting" data_id="DESC"></a></th>                  
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($getAllRemoteType as $value){?>
                    <tr>                      
                      <td class="sorting-column"><?php echo $value['Remote_Type_Name'];?></td>                      
                     <td><a  href="<?php echo adm_base_url();?>/edit_remote_type/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                      <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_remote_type/')" type="button"class="btn btn-danger" >Delete</a></td>
                     
                      </tr>
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
