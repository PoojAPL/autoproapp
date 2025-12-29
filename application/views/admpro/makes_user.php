<div id="right-container">
  <form class="site-form form-inline">
    <div class="row">      
      <div class="col-sm-24">
        <div class="form-group addmakesButton">          
          <a href="<?php echo adm_base_url();?>/vehicles/add_makes" class="btn btn-danger"  title="Sign Out">Add New Make</a>        
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
                 <th> Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom " data_id="DESC" id="sortlist" data-angle ="bottom" ></a> </th>
                 <th width="200px">Sort Order</th>
                  <th style="width: 137px;">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($getAllMakeNames as $users){?>
                    <tr>
                     <td class="sorting-column">
                     	<span class="td_data"><?php echo $users['Make_Name'];?></span>
                    	<span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $users['Make_Name'];?>" data-id="<?php echo $users['id'];?>" data-col="Make_Name" data-table="t_Makes" data-img=""></span><div class="get_column_data"></div>
                     </td>
                     <td class="sorting-column">
                     	<span class="td_data"><?php echo $users['Make_Sort'];?></span>
                    	<span class="glyphicon glyphicon-pencil edit_chips_inputs" aria-hidden="true" data-val="<?php echo $users['Make_Sort'];?>" data-id="<?php echo $users['id'];?>" data-col="Make_Sort" data-table="t_Makes" data-img=""></span><div class="get_column_data"></div>
                     </td>
                      <td><a  href="<?php echo adm_base_url();?>/vehicles/edit_MakeName/<?php echo $users['id'];?>" type="button" class="btn btn-success" >Edit</a>   
                      <a  href="javascript:void(0)" onclick="DeleteMakeName(<?php echo $users['id'];?>, '<?php echo adm_base_url();?>/vehicles/deletemakesname/')" type="button"class="btn btn-danger" >Delete</a>
                      </td>
                    </tr>
			  <?php }  ?>                
               </tbody>
            </table>
			<?php if(isset($links)){?>
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
