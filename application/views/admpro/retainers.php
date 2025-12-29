<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
    	<div class="col-sm-24">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/add_retainer" class="btn btn-danger" >Add New Retainer</a>        
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
                  <th>Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom ratainer_sorting" data_id="DESC"></a></th>                  
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($getRetainers as $value){?>
                    <tr>                      
                      <td class="sorting-column">
                      <span class="td_data"><?php echo $value['Retainer_Name'];?></span>
            		  <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['Retainer_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="Retainer_Name" data-table="t_Retainers" data-img=""></span><div class="get_column_data"></div>
                      </td>                      
                     <td><a  href="<?php echo adm_base_url();?>/edit_retainer/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                      <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_retainer/')" type="button"class="btn btn-danger" >Delete</a></td>
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
