<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
      <div class="col-sm-24">
        <div class="form-group addCodeSeries">
        <a href="<?php echo adm_base_url();?>/autopropad/add_video" class="btn btn-danger">Add New Video</a>   
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
        <div class="site-form" method="post">
          <div class="table-responsive chips_data" style="overflow:visible">
            <table class="table table-bordered  table-data mar0 tab-con">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Make</th>
                  <th>Title</th>
                  <th>Youtube ID</th>
                  <th>Sort Order</th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($results as $value){?>
                <tr>
                  <td>
                    
                        <span class="td_data"><?php echo $value['category'];?></span> <span class="glyphicon glyphicon-pencil edit_all_inputs" data-val="<?php echo $value['category'];?>" data-id="<?php echo $value['id'];?>" data-col="category" data-table="t_AutoProPAD_Videos"></span><div class="get_column_data"></div>
                    
                  </td>
                  <td>
                  <span class="td_data"><?php echo $value['make'];?></span> <span class="glyphicon glyphicon-pencil edit_all_inputs" data-val="<?php echo $value['make'];?>" data-id="<?php echo $value['id'];?>" data-col="make" data-table="t_AutoProPAD_Videos"></span><div class="get_column_data"></div>
                  
                  </td>
                  <td>
                  	<span class="td_data"><?php echo $value['title'];?></span>
                    <span class="glyphicon glyphicon-pencil edit_all_inputs" data-val="<?php echo $value['title'];?>" data-id="<?php echo $value['id'];?>" data-col="title" data-table="t_AutoProPAD_Videos"></span><div class="get_column_data"></div>
                  </td>
                  <td>
                    <a href="https://youtu.be/<?php echo $value['youtubeid'];?>"><span class="td_data"><?php echo $value['youtubeid'];?></span></a>
                    <span class="glyphicon glyphicon-pencil edit_all_inputs" data-val="<?php echo $value['youtubeid'];?>" data-id="<?php echo $value['id'];?>" data-col="youtubeid" data-table="t_AutoProPAD_Videos"></span><div class="get_column_data"></div>
                  </td>
                  <td>
                    <input type="number" class="form-control testimonials_sort_order" value="<?php echo $value['sortOrder'];?>" id="<?php echo $value['id'];?>" data-table="t_AutoProPAD_Videos" >
                  </td>
                  <td>
                    <a href="<?php echo adm_base_url();?>/autopropad/edit_videos/<?php echo $value['id'];?>"   class="btn btn-success">Edit</a>
                    <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/autopropad/delete_videos/')" type="button" class="btn btn-danger">Delete</a>
                  </td>
                </tr>
                <?php } ?>
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
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here --> 