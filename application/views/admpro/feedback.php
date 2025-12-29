<?php
if( isset($this->session->userdata['remotes_pagination'])){
	$per_page1 = $this->session->userdata['remotes_pagination'];
	$per_page = $per_page1['per_page'];
}else{
	$per_page = "";
}
$addressed_hide = '';
$addressed_checked = '';
if(isset($_COOKIE['Addressed_cookie'])){ 
	 $cookieValue = $_COOKIE['Addressed_cookie'];
	 if( $cookieValue == 1){
		$addressed_hide = 'hide';
		$addressed_checked = 'checked';
	 }else{
		$addressed_hide = '';
		$addressed_checked = '';
	 }
}
?>
<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
      <div class="col-sm-6">
        <form method="post" id="search_feedbacks">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            <div class="form-group">                     
             <input type="text" name="search_key" class="form-control" style="width: auto;" placeholder="Vehicle,Description,Submitted By">
             <button type="submit" class="btn btn-primary custom-button">Search</button>
            </div>
        </form>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
        	 <label>Show Only:</label>
             <select class="form-control select-field feedback_worked_filter">
             	<option value="all">All</option>
                <option value="Yes">Worked</option>
                <option value="No">Did Not Work</option>
                <option value="Partial">Partially Worked</option>
             </select>
      	</div>
      </div>	
      <div class="col-sm-12">
        <div class="form-group addCodeSeries">          
          <a href="<?php echo adm_base_url();?>/add_feedback" class="btn btn-danger">Add New Feedback</a>        
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
     <input type="checkbox" class="HideAddressed" <?php echo $addressed_checked;?> /> Hide All Addressed<br /><br />
        <form class="site-form" method="post">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
          <div class="table-responsive chips_data" style="overflow:visible">
            <table class="table table-bordered  table-data mar0 tab-con">
              <thead>
                <tr>  
                  <th>Date 
                  <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="id" data_id="DESC"></a>
                  </th>	               
                  <th>Vehicle 
                  	<a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Vehicle" data_id="DESC"></a>
                  </th>
                  <th>Worked <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Worked" data_id="DESC"></a></th>
                  <th>Description 
                  <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Description" data_id="DESC"></a>
                  </th> 
                  <th>Submitted By
                  <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Submitted_By" data_id="DESC"></a>
                  </th>
                  <th>Addressed   
                  <a href="javascript:void(0)" class="glyphicon glyphicon-triangle-bottom feedback_sorting" data-by="Addressed" data_id="DESC"></a>
                  </th> 
                  <th>Confirmed Working</th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php 
			  $i =1;
			  foreach($results as $value){
				if($value['Addressed'] == 'No'){
					$no_check = 'checked';
					$yes_check = '';
					$addressed = '';
					$addressed_hide1 = '';
				}else{
					$no_check = '';
					$yes_check = 'checked';	
					$addressed = 'addressed';
					$addressed_hide1 = $addressed_hide;	
				}
				?>
                 <tr class=" <?php echo $addressed;?> <?php echo $addressed_hide1;?>">
                  	<td>
                    	<span class="td_data"><?php echo $value['Date'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Date'];?>" data-id="<?php echo $value['id'];?>" data-col="Date"></span><div class="get_column_data"></div>
                    </td>
                    <td>
                    	<span class="td_data"><?php echo $value['Vehicle'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Vehicle'];?>" data-id="<?php echo $value['id'];?>" data-col="Vehicle"></span><div class="get_column_data"></div>
                    </td>
                    <td><?php echo $value['Worked'];?></td>
                    <td>
                    	<span class="td_data" style="width:200px;word-wrap: break-word;white-space: pre-line;"><?php echo $value['Description'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Description'];?>" data-id="<?php echo $value['id'];?>" data-col="Description"></span><div class="get_column_data"></div>
                    </td>
                    <td>
                    	 <span class="td_data" style="width:200px;"><?php echo $value['Submitted_By'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Submitted_By'];?>" data-id="<?php echo $value['id'];?>" data-col="Submitted_By"></span><div class="get_column_data"></div>
                        <?php if($value['Phone'] != ""){?>
                           <?php echo $value['Phone'];?>
                        <?php } ?>                       
                    </td>
                    <td><input type="checkbox" data-toggle="toggle" name="Addressed" <?php echo $yes_check;?>></td>
                    <td>
                    	<span class="td_data" style="width:200px;"><?php echo $value['Confirmed_Working'];?></span>
                        <span class="glyphicon glyphicon-pencil edit_feedback_inputs" aria-hidden="true" data-val="<?php echo $value['Confirmed_Working'];?>" data-id="<?php echo $value['id'];?>" data-col="Confirmed_Working"></span><div class="get_column_data"></div>                      
                    </td>
                    <td>   
                         <a href="<?php echo adm_base_url();?>/edit_feedback/<?php echo $value['id']?>" type="button" class="btn btn-success">Edit</a>
                         <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/delete_feedbacks/')"  type="button" class="btn btn-danger">Delete</a></td>
                 </tr>                
			  <?php }?>
               </tbody>
            </table>
            <nav class="site-pg">
                <ul class="pagination">               
                <?php foreach ($links as $link) {
                        echo '<li>'. $link.'</li>';
                } ?>	
               </ul>
     	  </nav>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>

<!-- right container start here -->
