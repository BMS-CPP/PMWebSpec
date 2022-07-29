<!DOCTYPE html>
<html>
	<head>
	  	<title>Pharmacometric Dataset Specification</title>
	  	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	  	
	  	<link rel="icon" type="image/x-icon" href="PADS_logo.ico" />
	  	<style>
			.vid-info {
			    color:white;
			    display: flex;
			    flex-direction: column;
			    width: 100%;  
			    background-image: url('../../assets/imgs/sb-bg.jpg');
			    background-repeat: no-repeat;
				background-size: 100% 500%;
			    font-family: Avenir, Helvetica, sans-serif; 
			    height: 150px;
			}

			.info-container {
			    display: flex;
			    flex-direction: column;
			    text-align: center;
			    margin-right:5rem;			    
			    color: white;
			    vertical-align: middle;
                padding-top: 50px;
			}

			.info-container a {
				color: white !important;   
	    		text-decoration: none; 
	    		display: inline;
	    		text-align: right;
	    		font-size: 15pt;
		    	margin-right: 80px;
			}

			.info-container ul {
	    		list-style-type: none;
	    		padding: 5px;
	    		margin: 0;
	    		text-align: right;
		    }

			.button {
			    color:white;
			    background-color:black;
			    border-color:white;
			    font-family: Avenir, Helvetica, sans-serif;
			    margin-right:5rem;
			    font-size:1rem;
			    padding: 10px;
			    width:150px;
			    border-style:solid;
				border-radius: 25px;
			}

			.button:hover {
			    color: #3498DB;
				font-weight: bold;
			}

			.main {
				align-items: center;
				font-family: Avenir, Helvetica, sans-serif; 
				font-size: 18px;
				margin-left: 10%;
				width:95%; 
				margin:0 auto; 
				padding-left:25px; 
				padding-top:20px;
				padding-bottom:20px;
				padding-right:25px; 
			}

			.main input[type=text], select {
				width: 50%;
				padding: 12px;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
				resize: vertical;
			}

			.chbox {
				text-align: left;
				left: 0px;
			}
			
			.main-body {
                align-items: center;
                font-family: Avenir, Helvetica, sans-serif;
                font-size: 18px;
                margin-left: 10%;
                width: 95%;
                margin: 0 auto;
                padding-left: 25px;
                padding-top: 20px;
                padding-bottom: 20px;
                padding-right: 25px;
            }

        </style>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <!-- <link rel="stylesheet" href="<?php // echo base_url('assets/css/landing.css'); ?>"></link> -->
        <!-- <link rel="stylesheet" href="<?php // echo base_url('assets/css/home.css'); ?>"></link>-->
        <link rel="icon" type="image/x-icon" href="PADS_logo.ico" />
	</head>

	<body>

    	<div class="vid-info info-container">

    		<h1><font size="6">Pharmacometric Analysis Dataset Cloud Specification - Data Science</font></h1>
    		<ul id="topbar-menu">
    			<li><a href="<?php echo base_url("/home"); ?>">Home</a></li>
    		</ul>
    	</div>

    	<br/><br/>
