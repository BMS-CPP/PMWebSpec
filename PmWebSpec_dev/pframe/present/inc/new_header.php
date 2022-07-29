<html>
<head>


	<style type="text/css">

		.vid-info {
			display             : flex;
			flex-direction      : column;
			width               : 100%;
			background-image    : url("<?php echo base_url('assets/imgs/bg2.jpg'); ?>");
			background-repeat   : no-repeat;
			background-size     : 100% 500%;
			height              : 150px;
		}

		.info-container {
			display         : flex;
			flex-direction  : column;
			text-align      : center;
			margin-right    : 5rem;
			color           : white;
		}

		.info-container h1 {
			display         : flex;
			flex-direction  : column;
			text-align      : center;
			margin-right    : 5rem;
			color           : white;
			margin-top      : 25px;
		}

		.info-container h1 > font {
			font-size     : xx-large;
			font-weight   : bold;
		}

		.info-container a {
			margin-right      : 80px;
			font-size         : 15pt;
			text-decoration   : none;
		}

		.info-container ul {
			list-style-type : none;
			padding         : 5px;
			margin          : 0;
			text-align      : right;
		}

		.main, .main-body {
			align-items    : center;
			font-family    : Avenir, Helvetica, sans-serif;
			font-size      : 18px;
			margin-left    : 10%;
			width          : 95%;
			margin         : 0 auto;
			padding-left   : 25px;
			padding-top    : 20px;
			padding-bottom : 20px;
			padding-right  : 25px;
		}

		.button {
			color               : white;
			background-color    : black;
			border-color        : white;
			font-family         : Avenir, Helvetica, sans-serif;
			margin-right        : 5rem;
			font-size           : 1.1rem;
			padding             : 10px;
			width               : 150px;
			border-style        : solid;
			border-radius       : 25px;
			outline             : none;
			border-width        : 1.5px;
		}

		.button:hover {
			color       : #9FCCFA;
			font-weight : bold;
		}

		/* import existing */
		.button2 {
			color               : white;
			background-color    : #9FCCFA;
			border-color        : white;
			font-family         : Avenir, Helvetica, sans-serif;
			font-size           : 1.1rem;
			padding             : 2px;
			width               : 160px;
			border-style        : solid;
			border-radius       : 25px;
			display             : inline-flex;
			vertical-align      : middle;
		}

		.button2:hover {
			color           : #067EF9;
			font-weight     : bold;
		}

		.input-style input {
			padding             : 5px 8px;
			width               : 10%;
			border              : 1px solid #ccc;
			box-shadow          : none;
			background          : transparent;
			background-image    : none;
			-webkit-appearance  : none;
			margin-right        : 20px;
			margin-left         : 10px;
			padding-left        : 10px;
			border-radius       : 15px;
			font-size           : 16px;
		}

		table {
			border-collapse   : collapse;
			width             : 100%;
		}

		th {
			padding-top       : 12px;
			padding-bottom    : 12px;
			text-align        : left;
			background-color  : #9FCCFA;
			color             : white;
			border            : 1px solid #ddd;
		}

		td {
			border   : 1px;
		}

		tr:nth-child(even) {
			background-color  : #f2f2f2;
		}

		.select {
			padding               : 5px 8px;
			width                 : 95%;
			border                : 1px solid #ccc;
			box-shadow            : none;
			background            : transparent;
			background-image      : none;
			-webkit-appearance    : none;
		}
		/* import existing end */

		/* create new */
		.main input[type=text], select#SpecType {
			width            : 50%;
			padding          : 12px;
			border           : 1px solid #ccc;
			border-radius    : 4px;
			box-sizing       : border-box;
			resize           : vertical;
			font-size        : 13px;
		}
		/* create new ends */

		/* Review Approve Starts */
		#sign {
			margin-left  : 70px;
		}

		.title-head {
			align-items      : center;
			font-family      : Avenir, Helvetica, sans-serif;
			font-size        : 18px;
			margin-left      : 10%;
			background       : #f1f1f1;
			width            : 95%;
			margin           : 0px auto;
			padding-left     : 25px;
			padding-top      : 20px;
			padding-bottom   : 20px;
			padding-right    : 25px;
		}

		fieldset {
			display         : block;
			margin-left     : 2px;
			margin-right    : 2px;
			padding-top     : 0.35em;
			padding-bottom  : 0.625em;
			padding-left    : 0.75em;
			padding-right   : 0.75em;
			border          : 10px groove;
		}
		/* Review Approve Ends */

		/* Directory Setup Starts */
		.col-60 {
			float      : left;
			width      : 50%;
			margin-top : 6px;
		}

		.col-40 {
			float      : right;
			width      : 50%;
			margin-top : 6px;
		}

		.col-100 {
			float      : left;
			width      : 100%;
			margin-top : 6px;
		}

		.required label:after {
			color       : #e32;
			content     : ' *';
			display     : inline;
		}

		.helptip {
			position    : relative;
			display     : inline-block;
			color       : #063F7F;
			font-weight : 900;
		}

		.helptip .helptiptext {
			visibility          : hidden;
			width               : 400px;
			background-color    : #1E2021;
			color               : #fff;
			text-align          : left;
			border-radius       : 10px;
			padding             : 3px;
			position            : absolute;
			box-shadow          : 1px 1px 1px rgba(0, 0, 0, 0.2);
			z-index             : 1;
			left                : -4px;
			margin-left         : -60px;
			font-weight         : normal;
		}

		.helptip .helptiptext::after {
			content       : "";
			position      : absolute;
			top           : 100%;
			left          : 50%;
			margin-left   : -5px;
			border-width  : 5px;
			border-style  : solid;
			border-color  : black transparent transparent transparent;
		}

		.helptip:hover .helptiptext {
			visibility    : visible;
		}

		a.button2 {
			color               : white;
			background-color    : black;
			border-color        : black;
			text-decoration     : none;
			font-family         : Avenir, Helvetica, sans-serif;
			margin-right        : 5rem;
			font-size           : 1.1rem;
			padding             : 10px;
			width               : 120px;
			border-radius       : 20px;
			display             : inline-block;
			text-align          : center;
		}

		a.button2:hover {
			color           : #9FCCFA;
			font-weight     : bold;
			border-color    : white;
		}
		/* Directory Setup Ends */

		/* Manage Users */
		.button-container {
			display             : flex;
			justify-content     : space-evenly;
			text-align          : center;
			width               : 15%;
			height              : 100%;
			left                : auto;
			position            : absolute;
			/*background-color    : #317ecb;*/
			background-image    : url("<?php echo base_url('assets/imgs/bg2.jpg'); ?>");
			background-repeat   : round;
			vertical-align      : top;
		}

		.main textarea {
			width  : 60%;
		}

		.main-role {
			align-items    : left;
			font-family    : Avenir, Helvetica, sans-serif;
			font-size      : 18px;
			margin-left    : 0px;
			width          : 80%;
		}

		.main-role input[type=text] {
			width          : 20%;
			padding        : 12px;
			border         : 1px solid #ccc;
			border-radius  : 4px;
			box-sizing     : border-box;
			resize         : vertical;
		}

		.main-role select {
			width: 25%;
			height: 25%;
			padding: 12px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			resize: vertical;
		}

		.button-container input {
			margin: 10px;
		}

		/*             .button { */
		/*                 color: white; */
		/*                 background-color: black; */
		/*                 border-color: white; */
		/*                 font-family: Avenir, Helvetica, sans-serif; */
		/*                 margin-right: 5rem; */
		/*                 font-size: 1.1rem; */
		/*                 padding: 10px; */
		/*                 width: 130px; */
		/*                 border-style: solid; */
		/*                 border-radius: 20px; */
		/*             } */

		.button-section {
			align-items: center;
			font-family: Avenir, Helvetica, sans-serif;
			font-size: 18px;
			margin: 0 auto;
			width: 900px;
		}

		.display {
			position: absolute;
			display: flex;
			left: 15%;
			width: 85%;
			height: 575px;
		}

		.col-25 {
			float: left;
			width: 25%;
			margin-top: 6px;
		}

		.col-75 {
			float: right;
			width: 75%;
			margin-top: 6px;
		}

		.row:after {
			content: "";
			display: table;
			clear: both;
		}

		.mainshort {
			width: 100%;
		}
		/* Manage Users Ends */


		/*start New Header*/
		body {
			margin: 0;
			font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
			font-size: 1rem;
			font-weight: 400;
			line-height: 1.5;
			color: #212529;
			background-color: #f7f7f7;
		}
		.navbar {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			-ms-flex-align: center;
			align-items: center;
			-ms-flex-pack: justify;
			justify-content: space-between;
			padding: 5px;
		}

		/*
		headeer top
		*/
		.topbar{
			background-color: #212529;
			padding: 0;
		}

		.topbar .container .row {
			margin:-7px;
			padding:0;
		}

		.topbar .container .row .col-md-12 {
			padding:0;
		}

		.topbar p{
			margin:0;
			display:inline-block;
			font-size: 13px;
			color: #f1f6ff;
		}

		.topbar p > i{
			margin-right:5px;
		}
		.topbar p:last-child{
			text-align:right;
		}

		header .navbar {
			margin-bottom: 0;
		}

		.topbar li.topbar {
			display: inline;
			padding-right: 18px;
			line-height: 52px;
			transition: all .3s linear;
		}

		.topbar li.topbar:hover {
			color: #1bbde8;
		}

		.topbar ul.info i {
			color: #131313;
			font-style: normal;
			margin-right: 8px;
			display: inline-block;
			position: relative;
			top: 4px;
		}

		.topbar ul.info li {
			float: right;
			padding-left: 30px;
			color: #ffffff;
			font-size: 13px;
			line-height: 44px;
		}

		.topbar ul.info i span {
			color: #aaa;
			font-size: 13px;
			font-weight: 400;
			line-height: 50px;
			padding-left: 18px;
		}

		ul.social-network {
			border:none;
			margin:0;
			padding:0;
		}

		ul.social-network li {
			border:none;
			margin:0;
		}

		ul.social-network li i {
			margin:0;
		}

		ul.social-network li {
			display:inline;
			margin: 0 5px;
			border: 0px solid #2D2D2D;
			padding: 5px 0 0;
			width: 32px;
			display: inline-block;
			text-align: center;
			height: 32px;
			vertical-align: baseline;
			color: #000;
		}

		ul.social-network {
			list-style: none;
			margin: 5px 0 10px -25px;
			float: right;
		}

		.waves-effect {
			position: relative;
			cursor: pointer;
			display: inline-block;
			overflow: hidden;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			-webkit-tap-highlight-color: transparent;
			vertical-align: middle;
			z-index: 1;
			will-change: opacity, transform;
			transition: .3s ease-out;
			color: #fff;
		}
		a {
			color: #0a0a0a;
			text-decoration: none;
		}

		li {
			list-style-type: none;
		}
		.bg-image-full {
			background-position: center center;
			background-repeat: no-repeat;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			background-size: cover;
			-o-background-size: cover;
		}
		.bg-dark {
			background-color: #222!important;
		}

		.mx-background-top-linear {
			background: -webkit-linear-gradient(45deg, #0099d4 48%, #1b1e21 48%);
			background: -webkit-linear-gradient(left, #0099d4 48%, #1b1e21 48%);
			background: linear-gradient(45deg, #0099d4 48%, #1b1e21 48%);
		}

		/*end New Header*/
	</style>
</head>

<!-- Navigation -->
<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet"></link>


<!------ Include the above in your HEAD tag ---------->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Navigation -->
<div class="fixed-top1">
	<header class="topbar">
		<div class="container">
			<div class="row">
				<!-- social icon-->
				<div class="col-sm-12">
					<ul class="social-network">
						<li><a class="waves-effect waves-dark" href="#"></a></li>
						<li><a class="waves-effect waves-dark" href="#"></a></li>
						<li><a class="waves-effect waves-dark" href="#"></a></li>
						<li><a class="waves-effect waves-dark" href="#"></a></li>
						<li><a class="waves-effect waves-dark" href="#"></a></li>
					</ul>
				</div>

			</div>
		</div>
	</header>
	<nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
		<div class="container">
			<a class="navbar-brand" href="index.html" style="text-transform: uppercase;"> Pharmacometric Analysis Dataset Cloud Specification </a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">

				<ul class="navbar-nav ml-auto">

					<li class="nav-item active">
						<a class="nav-link" href="<?php echo base_url("/home"); ?>">Home
							<span class="sr-only">(current)</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('help'); ?>">Help Guide</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="mailto:email@domain.com?subject=Web-based%20Spec%20Feedback">Send Feedback</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url('about') ?>">About Us</a>
					</li>

				</ul>
			</div>
		</div>
	</nav>
</div>
