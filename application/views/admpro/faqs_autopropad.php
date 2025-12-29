<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
      <div class="col-sm-24">
        <div class="form-group addCodeSeries">
        <a href="<?php echo adm_base_url();?>/autopropad/add_faqs" class="btn btn-danger">Add New FAQ</a>   
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
          <div class="table-responsive faq_data" style="overflow:visible">
            <table class="table table-bordered  table-data mar0 tab-con">
              <thead>
                <tr>
                  <th width="130px">Title</th>
                  <th>Content</th>
                  <th width="130px">Sort Order</th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($results as $value){?>
                <tr>
                  <td>                    
                        <span class="td_data"><?php echo $value['title'];?></span> <span class="glyphicon glyphicon-pencil edit_all_inputs" data-val="<?php echo $value['title'];?>" data-id="<?php echo $value['id'];?>" data-col="title" data-table="t_AutoProPAD_FAQs"></span><div class="get_column_data"></div>                    
                  </td>
                  <td>
                    <div class="faq_content">
                      <?php echo $value['content'];?>
                    </div>
                  </td>
                  <td>
                    <input type="number" class="form-control testimonials_sort_order" value="<?php echo $value['sortOrder'];?>" id="<?php echo $value['id'];?>" data-table="t_AutoProPAD_FAQs" >
                  </td>
                  <td>
                    <a href="<?php echo adm_base_url();?>/autopropad/edit_faqs/<?php echo $value['id'];?>"   class="btn btn-success">Edit</a>
                    <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/autopropad/delete_faqs/')" type="button" class="btn btn-danger">Delete</a>
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