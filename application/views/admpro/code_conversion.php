<div id="right-container">
  <div class="site-form form-inline">
    <div class="row"> 
    <div class="col-sm-6">
      <form method="post" id="searchCodeList" novalidate="novalidate">
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="form-group">                     
                     <input type="text" name="search_key" class="form-control" style="width: 200px;" placeholder="Enter at least 3 characters for searching">
                     <button type="submit" class="btn btn-primary custom-button">Search</button>
                </div>
            </form>
     </div>     
      <div class="col-sm-18"></div>
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
                  <th>Code Series Name</th>
                  <th>AutoProAPP Code Series</th>
                  <th>Type</th> 
                  <th>Range</th>               
                  <th>Notes</th>                                   
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
             	<tbody>
                	<?php foreach($results  as $value){?>
                	   <tr>
                    	  <td> <?php echo $value['Auto_Num'];?></td>
                        <td><span class="td_data"> <?php echo $value['Title'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_all_inputs" aria-hidden="true" data-val="<?php echo $value['Title'];?>" data-id="<?php echo $value['id'];?>" data-col="Title" data-table="cs_auto_codes_headers"></span><div class="get_column_data"></div>
                        </td>
                        <td><?php $code_series_id = $value['Code_Series_UUID'];
                          $get_Code_Series_name = get_Code_Series_name($code_series_id);?>
                          <span class="td_data"><?php echo $get_Code_Series_name[0]['Code_Series_Name'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_all_inputs" aria-hidden="true" data-val="<?php echo $value['Code_Series_UUID'];?>" data-id="<?php echo $value['id'];?>" data-col="Code_Series_UUID" data-table="cs_auto_codes_headers"></span><div class="get_column_data"></div>
                        </td>
                        <td>
                          <span class="td_data"> <?php echo $value['Lock_Type'];?></span>
                          <span class="glyphicon glyphicon-pencil edit_all_inputs" aria-hidden="true" data-val="<?php echo $value['Lock_Type'];?>" data-id="<?php echo $value['id'];?>" data-col="Lock_Type" data-table="cs_auto_codes_headers"></span><div class="get_column_data"></div>
                        </td>
                        <td> <?php echo $value['Code_Range__Start'];?> 
                          <?php if($value['Code_Range__End'] !=""){ ?>
                              - <?php echo $value['Code_Range__End'];?>
                           <?php } ?>
                         </td>
                        <td><div class="notes-holder"><span class="td_data"><?php echo $value['Notes'];?></span></div>
                          <span class="glyphicon glyphicon-pencil edit_all_inputs" aria-hidden="true" data-val="<?php echo $value['Notes'];?>" data-id="<?php echo $value['id'];?>" data-col="Notes" data-table="cs_auto_codes_headers"></span><div class="get_column_data"></div>
                        </td> 
                        <td>
                          <a href="<?php echo adm_base_url();?>/edit_code_conversion/<?php echo $value['id'];?>" class="btn btn-success" >Edit</a>
                          <a href="<?php echo adm_base_url();?>/copy_code_conversion/<?php echo $value['id'];?>" class="btn btn-info" >Copy</a>
                       </td>
                    </tr>
                  <?php } ?>
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