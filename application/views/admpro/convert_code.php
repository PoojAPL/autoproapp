<div id="right-container">
  <div class="site-form form-inline">
    <div class="row">   	
      <div class="col-sm-24">
        
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-24">
      <section class="white-box">
        <?php if($this->session->flashdata('message_display')){?>
        	<div class="alert alert-success"><?php echo $this->session->flashdata('message_display');?></div>
        <?php } ?>
        <div class="site-form" method="post">
          <div class="searchCodeListHolder"> 
            <form method="post" id="searchConvertCodeList">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                <div class="input-group">
                  <input type="text" class="form-control" name="search_key" placeholder="Search for...">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Search</button>
                  </span>
                </div><!-- /input-group -->
            </form>
          </div><br>
          <div class="tool_data"></div>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- right container start here -->