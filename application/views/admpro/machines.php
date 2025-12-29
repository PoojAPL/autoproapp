<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">
    	<div class="col-sm-6">
        <div class="form-group">
            <label>Type: </label>
            <select class="form-control selectByMachineTypes">
              <option value="all">All</option>
              <?php foreach($getMachinesTypes as $machine_type){?>
              <option value="<?php echo $machine_type['UUID'];?>"><?php echo $machine_type['Machines_Info_Type_Name'];?></option>
              <?php } ?>
            </select>
        </div>
       </div> 
       <div class="col-sm-6">
        <form method="post" id="globalSearchKyes">
            <div class="form-group">                     
                  <input type="text" name="search_global_key" class="form-control search_global_key">
                  <button type="submit" class="btn btn-primary custom-button" name="search" value="machines_info">Search</button>
            </div>
        </form>
      </div>    	
      <div class="col-sm-12">
        <div class="form-group pull-right"> <a href="<?php echo adm_base_url();?>/add_machines" class="btn btn-danger"  title="Add New Tool Type">Add New Machine Info</a> </div>
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
                  <th>Type <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom machine_sorting" data_id="DESC" data-sort="Type"></a></th>                  <th>Name <a href="javascript:void(0)" type="button" class="glyphicon glyphicon-triangle-bottom machine_sorting" data_id="DESC" data-sort="Name"></a></th>
                  <th>Products</th>                  
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php                   
         		foreach($results as $value){?>
                        <tr>
                        	<td>
								<?php $get_mchine_type_info =  get_mchine_type_info($value['Type']);?>
                                <span class="td_data"><?php echo $get_mchine_type_info[0]['Machines_Info_Type_Name'];;?></span>                                
                            </td>
                            <td>
                            <span class="td_data"><?php echo $value['Name'];?></span>            		 		
                            </td>
                            <td>
                            <span class="td_data"><?php echo $value['Products'];?></span>            		 		
                            </td>
                            <td>
                            	<a  href="<?php echo adm_base_url();?>/edit_machine/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>   
                      			<a  href="javascript:void(0)" onclick="DeleteChipsFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_machine/')" class="btn btn-danger" >Delete</a>
                            </td>
                        </tr>         
                <?php }?>
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
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here --> 