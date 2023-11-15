<?php
 $target_path = $dataset_path;

echo ' 
		<style>
			    .center1 {
				display: flex;
				justify-content: center;
				align-items: center;
				height: 20%;
			}
			.btn_css {
				padding: 1%;
				width: 15%;
				background-color: #f50758;
				weight: 100;
				font-weight: bold;
				color: white;
			}
			
			.btn_css:hover {
				background-color: #2a346f;
				color: white;
			}
			.center {
				 text-align: center;
  				 margin: auto;
 				 width: 80%;
 				 padding: 10px;
		}

    </style>
    <div class = "center">
    	<form class="form-horizontal" name="upload_excel" enctype="multipart/form-data" method = "post" action= '.base_url('home/download/doxc').'>
       			<br/>
       			
       			<input type="text" name = "version_id" value = '.$version_id.' hidden>
       			<input type="text" name = "spec_id" value = "'.$spec_id.'" hidden>
			<p ><font size="5">Your Doc file is successfully processed by this application. Please check the target directory for the downloaded file "'.$target_path.'". If any error occurs, an email notification will be sent to you.</font></p>
        	
        	 <br/>
	   		 <input type="submit" name="Export" class="button" id="download_word" value="Download File"/>
	   		
        </form>
     </div>
 ';

?>




