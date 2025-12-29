<footer id="main-footer">
<div class="container">
<article class="copy-rt">
      <div class="row">
        <div class="col-sm-12">
          <p>© <?php echo date('Y');?> American Key Supply, Inc. All rights reserved.</p>
        </div>
        <div class="col-sm-12">
          <article class="site-links"> <!--<a href="<?php echo base_url();?>feedback" title="Add Feeback">Add Feeback</a> &nbsp;|&nbsp;--> <a href="#" title="Contact">Contact</a> &nbsp;|&nbsp; <a href="<?php echo base_url();?>privacy" title="Privacy Policy">Privacy Policy</a> &nbsp;|&nbsp; <a href="#" title="Legal">Legal</a> </article>
        </div>
      </div>
    </article>
</div>    
<!--footer section end here--> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo asset_url();?>js/jquery-1.11.3.min.js"></script> 
<script src="<?php echo asset_url(); ?>admin/js/bootstrap-toggle.min.js"></script> 
<script src="<?php echo asset_url();?>js/bootstrap.min.js"></script> 
<script src="<?php echo asset_url();?>js/jquery.mask.js"></script> 
<script>
$(window).load(function(){
$("#phone_number").mask("999-999-9999");
});
</script>
</body>
</html>