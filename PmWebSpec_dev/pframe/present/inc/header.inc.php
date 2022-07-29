<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico"></link>

        <title>Pharmacometric Web - Based Specification - Domain</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        

        <link rel="canonical" href="<?php echo base_url(); ?>"></link>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet"></link>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/landing.css'); ?>?v=<?php echo date('Y-m-d'); ?>"></link>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/home.css'); ?>"></link>
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/imgs/PADS_logo.ico'); ?>" />

        <style>
            @media all and (max-width: 600px) {
                .vid-info { width: 50%; padding: .5rem; }
                .vid-info h1 { margin-bottom: .2rem; }
            }

            @media all and (max-width: 500px) {
                .vid-info .acronym { display: none; }
            }

            .vid-info {
                color:white;
                display: flex;
                flex-direction: column;
                width: 100%;  
            }

            .info-container {
                display: flex;
                flex-direction: column;
                text-align: center;
                margin-right:0;
            }

            .info-container a {
                color: white !important;   
                text-decoration: none; 
                display: inline;
                text-align: right;
                font-size: 12pt;
                margin-right: 30px;
            }

            .button-container {
                display: flex;
                justify-content: space-evenly;
                align-items:center;
                margin-top:10rem;
                width: 900px;
                margin: 0px auto;
                height: 300px;
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
                outline: none;
            }

            a.button {
                color:white;
                background-color:black;
                border-color:white;
                font-family: Avenir, Helvetica, sans-serif;
                margin-right:5rem;
                font-size:1rem;
                padding: 10px;
                width:150px;
                border-top: 2px solid;
                border-bottom: 2px solid;
                border-left: 2px solid;
                border-right: 2px solid;
                border-radius: 25px;
            }

            .new-spec-inputs a:hover {
                color: #3498DB;
                font-weight: bold;
                border-color: white;
            }

            .other-inputs a:hover {
                color: #3498DB;
                font-weight: bold;
                border-color: white;
            }

            .button:hover {
                color: #3498DB;
                font-weight: bold;
                outline: none;
            }

            .footer {
                color: white;
                left: 2%;
                bottom: 20px;
                height: 150px;
                width: 100%;
                overflow:hidden;
                display: flex;
                background-color:transparent;
                border-color:transparent;
                flex-direction: column;
                font-family: Avenir, Helvetica, sans-serif;
                position:absolute;
            }

            .footer ul {
                list-style: none;
                margin: 0;
            }

            .footer a {
                color: white !important;   
                text-decoration: none; 
            }

            .footer a:hover {
                font-weight: bold;
            }

            .body-container {
                display: flex;
                justify-content: center;
                min-height: 100%;
                min-width: 100%;
            }

            .new-spec-form {
                width: 1rem;
            }

            .input-container {
                display: flex;
                flex-direction: column;
            }

            .new-spec-inputs {
                margin-bottom: 3rem;
                align-items: center;
            }

            .new-spec-inputs, .other-inputs {
                display: flex;
                justify-content: center;
            }

            .footer-container {
                display: flex;
                justify-content: left;
                width: 400px;
                margin: 0 auto;
                text-align: left;
                margin-left: 100px;
                bottom: 150px;
            }

            .footer-copyright {
                position:fixed;
                text-align: right;
                bottom:0;
                width:100%;
                display:block;
                color:white;
                font-family: Avenir, Helvetica, sans-serif;
                font-size:.75rem;
                list-style-type:none;
                right: 100px;
            }
        </style>
        
    </head>

    <body>

        <div id="vidtop-content">

            <div class="vid-info">
                <div class="info-container">
                    <a href="<?php echo base_url('logout') ?>">Logout</a>
                    <h1><font size="6">Pharmacometric Analysis Dataset Cloud Specification - Data Science</font></h1>
    			</div>

				<br/><br/>
