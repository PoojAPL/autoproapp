<div id="right-container">
  <div class="site-form form-inline remotePage">
    <div class="row">
      <div class="col-sm-24">
        <div class="form-group addCodeSeries">
        <a href="<?php echo adm_base_url();?>/autopropad/add_distributors" class="btn btn-danger">Add New Distributor</a>   
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
                  <th>imagePath</th>
                  <th>Content</th>
                  <th>Display on autopropad.com</th>
                  <th>Sort Order</th>
                  <th style="width:137px">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($results as $value){?>
                <tr>
                  <td>                    
                        <img src="<?php echo asset_url(); ?>distributor/<?php echo $value['imagePath'];?>" width="100">                   
                  </td>
                  <td>
                    <div class="notes-holder">
                      <?php echo $value['content'];?>
                    </div>
                  </td>
                  <td>
                    <?php if( $value['show1']== 1){
                      $checked = "checked";
                      $chkvalue = 0;
                    }else{
                      $checked = "";
                      $chkvalue = 1;
                    } ?>
                    <input class="showOnAutoPad" checkid="<?php echo $value['id'];?>" <?php echo $checked;?> type="checkbox" value="<?php echo $chkvalue;?>">
                  </td>
                  <td>
                    <input type="number" class="form-control testimonials_sort_order" value="<?php echo $value['sortOrder'];?>" id="<?php echo $value['id'];?>" data-table="t_AutoProPAD_Distributors" >
                  </td>
                  <td>
                    <a href="<?php echo adm_base_url();?>/autopropad/edit_distributors/<?php echo $value['id'];?>"   class="btn btn-success">Edit</a>
                    <a href="javascript:void(0)" onclick="DeleteFunction(<?php echo $value['id'];?>, '<?php echo adm_base_url();?>/autopropad/delete_distributors/')" type="button" class="btn btn-danger">Delete</a>
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