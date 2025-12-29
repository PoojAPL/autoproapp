<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
      <div class="col-sm-24">
        <div class="form-group addUserButton">          
          <a href="<?php echo adm_base_url();?>/add_autoproapp_version" class="btn btn-success">Add New Update Version</a>        
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    		<div class="alert alert-info"><?php echo $this->session->flashdata('message_display');?></div>
     <?php } ?>
        <div class="site-form">
          <div class="table-responsive usersData">          	
            <table class="table table-striped table-data mar0">
              <thead>
                <tr> 
                  <th>ID</th> 
                  <th>Version Name</th>	           
                  <th>Download Path</th> 
                  <th>Version Code</th>
                  <th>Message</th>
                  <th>Action</th>        
                 </tr>
                </thead> 
                <tbody>
                	<?php foreach ($results as $value) {?>
                    <tr>
                      <td><?php echo $value['id'];?></td>
                      <td><?php echo $value['versionName'];?></td>
                      <td>
                        <a href="<?php echo base_url();?>version_uploads/<?php echo $value['Download_Path'];?>" target="_blank" >Download <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                      </td>
                      <td><?php echo $value['version_code'];?></td>
                      <td><div class="notes-holder"><?php echo $value['version_message'];?></div></td>
                      <td><button onclick="DeleteFunction(<?php echo $value['id'];?>,'<?php echo adm_base_url();?>/delete_autoproapp_vesrion/')" class="btn btn-danger">Delete</button></td>
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