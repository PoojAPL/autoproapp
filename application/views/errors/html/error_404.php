<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>AutoProAdmin Error</title>
<style type="text/css">
*, *:after, *:before {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -ms-box-sizing: border-box;
  box-sizing: border-box; 
}
html {
  background: #fff;
  font: bold 14px/20px "Trajan Pro", "Times New Roman", Times, serif;
  color: #430400;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.15); 
}
.error-page-wrap {
	width: 70%;
  margin: 155px auto; 
}
.error-page-wrap:before {
    box-shadow: 0 0 200px 150px #fff;
    border-radius: 50%;
    position: relative;
    z-index: -1;
    content: '';
    display: block; 
}
.error-page{
	text-align: center;
}
.error-back {
  text-decoration: none;
  color: #430400;
  font-size: 15px;
}

.error-page h1{
	font-size: 40px;
    color: #ccc;
}
.error-page h2{
	font-size: 24px;
    color: #e34d4d;
}
</style>
</head>
<body>
	<div id="container">
	<div class="error-page-wrap">
		<article class="error-page gradient">
			<hgroup>
				<h1><?php echo $heading; ?></h1>
				<h2><?php echo $message; ?></h2>
			</hgroup>
			<a href="https://www.autoproapp.com" title="Back to site" class="error-back">Back</a>
		</article>
	</div>
	</div>
</body>
</html>