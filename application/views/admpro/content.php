<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
      <div class="col-sm-24">
        <div class="form-group addCodeSeries">
        <a href="<?php echo adm_base_url();?>/autopropad/add_content" class="btn btn-danger">Add New Distributor</a>   
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
                  <th>Description</th>
                  <th>Content</th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($results as $value){?>
                <tr>
                  <td>                    
                        <?php echo $value['Description'];?>                   
                  </td>
                  <td>
                    <div class="notes-holder">
                      <?php echo $value['Content'];?>
                    </div>
                  </td>
                  <td>
                    <a href="<?php echo adm_base_url();?>/autopropad/edit_content/<?php echo $value['id'];?>"   class="btn btn-success">Edit</a>
                    <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/autopropad/delete_content/')" type="button" class="btn btn-danger">Delete</a>
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