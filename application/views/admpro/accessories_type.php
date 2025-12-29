
<div id="right-container">
  <form class="site-form form-inline">
    <div class="row">
      <div class="col-sm-24">
        <div class="form-group addCodeSeries"> <a href="<?php echo adm_base_url();?>/add_accessories_type" class="btn btn-danger"  title="Add New Accessories Type">Add New Accessories Type</a> </div>
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
          <div class="table-responsive accessories_type chips_data">
            <table class="table table-striped table-data mar0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php                   
        		foreach($getAllaccessoriesType as $value){?>
                <tr>
                  <td>
                  	<span class="td_data"><?php echo $value['accessories_Type_Name'];?></span>
                    <span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $value['accessories_Type_Name'];?>" data-id="<?php echo $value['id'];?>" data-col="accessories_Type_Name" data-table="t_accessories_Types" data-img=""></span><div class="get_column_data"></div> 
                  </td>
                  <td><a  href="<?php echo adm_base_url();?>/edit_accessories_type/<?php echo $value['id'];?>" type="button" class="btn btn-success" >Edit</a> 
                  <a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/deleteaccessoriestype/')" type="button"class="btn btn-danger" >Delete</a></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
			<?php 
			if(isset($links)){?>
			  <nav class="site-pg">
			 <ul class="pagination">               
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>	
               </ul>
			   </nav>
			<?php }?>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>

<!-- right container start here --> 
