<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
      <div class="col-sm-24">
        <div class="form-group addCodeSeries">
        <a href="<?php echo adm_base_url();?>/autopropad/add_testimonials" class="btn btn-danger">Add New Testimonials</a>   
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
                  <th>Testimonial</th>
                  <th>Author Name</th>
                  <th>Business Name</th>
                  <th>Location</th>
                  <th>Sort Order</th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($results as $value){?>
                <tr>
                  <td>
                    <div class="notes-holder">
                        <span class="td_data"><?php echo $value['testimonial'];?></span> <span class="glyphicon glyphicon-pencil edit_all_inputs" data-val="<?php echo $value['testimonial'];?>" data-id="<?php echo $value['id'];?>" data-col="testimonial" data-table="t_AUtoProPAD_Testimonials"></span><div class="get_column_data"></div>
                    </div>
                  </td>
                  <td><div class="product-holder" style="width: auto;">
                  <span class="td_data"><?php echo $value['authorName'];?></span> <span class="glyphicon glyphicon-pencil edit_all_inputs" data-val="<?php echo $value['authorName'];?>" data-id="<?php echo $value['id'];?>" data-col="authorName" data-table="t_AUtoProPAD_Testimonials"></span><div class="get_column_data"></div>
                  </div>
                  </td>
                  <td>
                  	<span class="td_data"><?php echo $value['businessName'];?></span>
                    <span class="glyphicon glyphicon-pencil edit_all_inputs" data-val="<?php echo $value['businessName'];?>" data-id="<?php echo $value['id'];?>" data-col="businessName" data-table="t_AUtoProPAD_Testimonials"></span><div class="get_column_data"></div>
                  </td>
                  <td>
                    <span class="td_data"><?php echo $value['location'];?></span>
                    <span class="glyphicon glyphicon-pencil edit_all_inputs" data-val="<?php echo $value['location'];?>" data-id="<?php echo $value['id'];?>" data-col="location" data-table="t_AUtoProPAD_Testimonials"></span><div class="get_column_data"></div>
                  </td>
                  <td>
                    <input type="number" class="form-control testimonials_sort_order" value="<?php echo $value['sortOrder'];?>" id="<?php echo $value['id'];?>" >
                  </td>
                  <td>
                    <a href="<?php echo adm_base_url();?>/autopropad/edit_testimonials/<?php echo $value['id'];?>"   class="btn btn-success">Edit</a>
                    <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/autopropad/delete_testimonials/')" type="button" class="btn btn-danger">Delete</a>
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