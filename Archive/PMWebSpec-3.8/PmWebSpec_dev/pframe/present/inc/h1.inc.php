<?php

ini_set('session.cookie_httponly',1);
ini_set('session.use_only_cookies',1);
ini_set('session.cookie_secure', 1);
?>
<html>
	<head>
		<title>Pharmacometric Dataset Specification</title>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

		
		<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/scripts.js?v=52'); ?>"></script> -->

		<script type="text/javascript" src="<?php echo base_url('assets/js/scripts.js?v=" + File.GetLastWriteTime(HttpContext.Current.Request.PhysicalApplicationPath + filename).ToString("yyMMddHHHmmss");'); ?>"></script> 

		<!-- Navigation -->
		<!-- <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" /> -->

		<!------ Include the above in your HEAD tag ---------->
		<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" /> -->
			<link rel="stylesheet" id="bootstrap-css" href="<?php echo base_url("assets/css/bootstrap_custom.min.css"); ?>">
		<!-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		
		<!------ Include the above in your HEAD tag ---------->
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="<?php echo base_url("assets/css/internal.css"); ?>">
		
		<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/imgs/PADS_logo.ico'); ?>"/>

		<script src='https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.2/MathJax.js?config=TeX-MML-AM_CHTML'>
			MathJax.Hub.Config({
				tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
		</script>
	</head>


	<!-- Navigation -->
	<div class="fixed-top1" style="background-image: url('<?php echo base_url('assets/imgs/bg2.jpg'); ?>');
		background-repeat: no-repeat;
		background-size: 100% 500%;">
		<header class="topbar">
			<div class="container">
				<div class="row">
					<!-- social icon-->
					<div class="col-sm-12">
						<br/>
						<h1><font size="6" style="color: #fff;">Pharmacometric Analysis Dataset Cloud Specification - Data Science</font></h1>
					</div>

				</div>
			</div>
		</header>
		<nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
			<div class="container">

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">

					<ul class="navbar-nav ml-auto " >

						<li class="nav-item active">
							<a class="nav-link" href="<?php echo base_url("/home"); ?>">Home

							</a>
						</li>

					</ul>
				</div>
			</div>
		</nav>
	</div>
