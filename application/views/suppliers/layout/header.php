<?php
$user_data = $this->session->userdata('login_supplier');
$user_username = $user_data['username'];
$get_url = explode('/',$_SERVER["REQUEST_URI"]);
$get_last = explode('?',$get_url[count($get_url)-1]);
$url = $get_last[0];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title><?php echo str_replace('>','|', strip_tags($subTitle));?> | Suppliers Login</title>
    <link href="<?php echo asset_url(); ?>admin/css/futurico.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>admin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>admin/css/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo asset_url(); ?>admin/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>admin/css/app.css" rel="stylesheet" type="text/css">
    
	  <link href="<?php echo asset_url(); ?>admin/css/style.css?v=<?php echo time();?>" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
  </head>
 <body class="suppliers">
    <nav class="navbar navbar-inverse navbar-fixed-top" id="site-nav">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url();?>suppliers/dashboard" title="AutoPro"><img src="<?php echo asset_url(); ?>/images/logo_maintenance.jpg" alt="AutoPro"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        	<div class="nav navbar-nav">
            	<h1 class="pg-heading1"><?php echo $subTitle;?></h1>
            </div>
            <ul class="nav navbar-nav navbar-right">
              <p>Logged in as <?php echo $user_username;?></p>
              <a href="<?php echo base_url();?>suppliers/logout" title="Sign Out">Sign Out</a>
          </ul>
       </div>
      </div>
    </nav>
<!--site nav end here-->
<!--site main-con start here-->
<main id="main-con">
  <div class="container-fluid">
    <!--sidebar start here-->
      <section class="sidebar">
          <ul class="nav nav-sidebar">               
              <li class="<?php echo ($url == 'payments' )?'active':"";?>" ><a href="<?php echo base_url();?>suppliers/products"  title="Products">Products</a></li> 
          </ul>
        <p class="affix affix-bottom">
            © <?php echo date('Y');?><br>
            American Key Supply, Inc.<br>
            All rights reserved.<br>
        </p>
      </section>
      <!--sidebar start here--> 
      <div class="loading hide"></div>
      <div class="hide" id="loader"></div>
      <div class="updatingLoading hide">
        <div class="progress" style="margin: 10px 10px 10px 200px;">
          <div id="myBar" class="progress-bar progress-bar-striped progress-bar-animated active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      </div>