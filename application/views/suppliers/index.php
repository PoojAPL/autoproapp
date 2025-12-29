<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Suppliers</title>

    <!-- Bootstrap -->
    <link href="<?php echo asset_url(); ?>admin/css/futurico.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>admin/css/app.css" rel="stylesheet" type="text/css">
	<link href="<?php echo asset_url(); ?>admin/css/style.css" rel="stylesheet" type="text/css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body class="suppliers">
    <!--site nav start here-->
    <nav class="navbar navbar-inverse navbar-fixed-top" id="site-nav">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>" title="AutoPro"><img src="<?php echo asset_url(); ?>/images/logo_maintenance.jpg" alt="AutoPro"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        	<div class="nav navbar-nav">
            	<h1 class="pg-heading1">Suppliers Login</h1>
            </div>
        </div>
      </div>
    </nav>
    <div class="hide" id="loader"></div>
    <!--site nav end here-->
   	<!--user login section-->
    <main id="main-con" class="userlogin white-box">
      <div class="container-fluid">
      <?php if($this->session->flashdata('message_display')){?>
      <div class="alert alert-danger"><?php echo $this->session->flashdata('message_display');?></div>
      <?php } ?>
      <form method ="post" id="suppliers_login_form" action="<?php echo base_url();?>suppliers/login" >
      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
        <!--<form id="login_form">-->
            <div class="row">
              <div class="col-md-24">
                <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Enter your username" name="user_name" required>
                      <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>                     
                    </div>
                </div>
                 <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" placeholder="Password" name="password" id="i_password" required>
                      <div class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></div>
                    </div>
                </div>
                <?php if($this->session->flashdata('login_count_display')){?>
                <div class="form-group">
                    <label>Recaptcha</label>
                    <div class="input-group">
                      <div class="g-recaptcha" data-sitekey="6LdqHQ4UAAAAANoDAtfViLXzEKsddB37hjbts7yp"></div>
                      <div class="captcha_error hide">Captcha is required</div>
                    </div>
                </div>
                <?php } ?>
              </div>
           </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
            	<button type="submit" class="btn btn-success" id="loginButton">Login</button>
            </div>            
          </div>
        </form>
</div>
    </main>
  <div >
    <footer id="footer-login">
  		© <?php echo date('Y');?>  American Key Supply, Inc.  All rights reserved.
    </footer>
    </div>
<script src="<?php echo asset_url(); ?>admin/js/jquery-1.11.3.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo asset_url(); ?>admin/js/bootstrap.min.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/jquery-ui.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/multiselect.min.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/choosen.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/jquery.validate.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/custom.js"></script>
<script src="<?php echo asset_url(); ?>admin/js/md5.js"></script>
</body>
</html>
 