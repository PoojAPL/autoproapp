<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">   	
      <div class="col-sm-24">
        <div class="form-group addCodeSeries"> 
          <a href="<?php echo adm_base_url();?>/firebase_update_avtars" class="btn btn-success firebaseUpdate">Firebase Update</a>&nbsp;
          <a href="<?php echo adm_base_url();?>/add_avtars" class="btn btn-danger">Add New Avatars</a>
     </div>
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
          <div class="tool_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr> 
                  <th>ID</th>  
                  <th>Image</th>                
                  <th style="width: 120px;">Sort Order</th>                                   
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
             	<tbody>
                	<?php foreach( $results  as $value){?>
                	   <tr>
                    	  <td> <?php echo $value['id'];?></td>
                        <td>
                          <?php if($value['Image_Path'] !=""){?>
                          <img src="<?php echo $value['Image_Path'];?>" width="100">
                          <?php } ?>
                        </td>
                        <td>
                          <input type="number" class="form-control avatars_sort_order" value="<?php echo $value['Sort_Order'];?>" id="<?php echo $value['id'];?>">
                        </td>                        
                        <td>
                          <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_avtars/')" class="btn btn-danger" >Delete</a>
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