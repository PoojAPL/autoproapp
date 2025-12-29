<div id="right-container">
  <form class="site-form form-inline">
    <div class="row">
      
      <div class="col-sm-24">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/addKeytype" class="btn btn-danger"  title="Sign Out">Add New Key Type</a>        
        </div>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
      <?php if($this->session->flashdata('message_display')){?>
    		<?php echo $this->session->flashdata('message_display');?>
     <?php } ?>
        <form class="site-form" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="table-responsive make_users chips_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>                  
                  <th> Name 
                  <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom key_type_sorting" data-by="Key_Type_Name" data_id="DESC"></a>
                  </th>
                  <th style="width: 137px;">Action</th>
                </tr>
              </thead>
              <tbody>
               <?php
			   $i =1;
			  foreach($getAllkeyType as $value){?>
                    <tr>                    
                      <td>
                         <span class="td_data"><?php echo $value['Key_Type_Name'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Key_Type_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Key_Type_Name" data-table="t_Key_Types" data-img=""></span><div class="get_column_data"></div> 
                      </td>
                      <td><a  href="<?php echo adm_base_url();?>/edit_keytype/<?php echo $value['id'];?>" type="button" class="btn btn-success">Edit</a> 
                      <a  href="javascript:void(0)" onClick="DeleteKeytype(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/deletekeytype/')" type="button"class="btn btn-danger">Delete</a>        </td>
                     
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
