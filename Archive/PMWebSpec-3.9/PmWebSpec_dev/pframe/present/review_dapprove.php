<?php
$user_id_session =& get_instance();
$user_id_session->load->model('CIModSession');
$users_id = $user_id_session->CIModSession->checkIsSessionExist();

if ($users_id == 0) {
	echo "Please Login";
	die();
}
$user_name = $this->session->user_details;
$url = base_url();
if ($user_name[0]['user_id'] == NULL) {
	if (!(strpos($url, 'localhost') != 0)) {
		redirect(base_url('error/unauthorized'));
	}
}
?>
<script type="text/javascript" src="<?php echo base_url('assets/js/canvas.js')?>"></script>
    <br/>
	<style>
	   table {
		     font-family: Avenir, Helvetica, sans-serif;
		     border-collapse: collapse;
		     width: 90%;
		     margin-left: auto;
		     margin-right: auto;
             box-shadow: 5px 5px 5px grey;
		}

		table tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        table td, th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

         table td, th {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
            word-wrap: break-word!important;
        }

        h4, h3, h2 {
            margin-left: 50px;
        }

        p {
            margin-left: 70px;
        }

        #sign {
                margin-left:70px;
            }
	   table {
		   width: 94%!important;

	   }
	</style>

	<div class="title-head">
		<fieldset>
			<legend>Cover page</legend>
			<h1 align="center"> <?php  echo $title; ?> </h1><br/>
			<h1 align="center">Project:  <?php  echo $project_name; ?></h1><br/>
			<h1 align="center">Version: <?php  echo $version_id; ?></h1>
			<h1 align="center">Modification Date: <?php  echo $modification_date; ?></h1>

			<form method="post" target="_blank" action="<?php echo base_url('home/download/pdfreview'); ?>" >
				<input type="text" value="<?php  echo $spec_id;?>" name="spec_id" hidden>
	      		<input type="text" value="<?php  echo $version_id;?>" name="version_id" hidden>
		  		<p align="center"><input class = "button" type="submit" value="View as PDF" name="submit3"></p>
		  	</form>
		</fieldset>
	</div>
	<br/>

	<?php
    	// Accountable team members
    	echo "<h4><b>Accountable Team Members:</b></h4>";
    	echo "<table style='padding: 5px;' id=team_table border=1>";
    	echo "<tr>";
    	echo "<th style='width: 200px;'>Role/Department</th>";
    	echo "<th style='width: 250px;'>Designee</th>";
    	echo "<th style='width: 120px;'>Accountable for Section</th>";
    	echo "</tr>";
    
    	echo "<tr>";
    	echo "<td>PK Scientist</td>";
    	echo "<td>" .  $pk_scientist .  "</td>";
    	echo "<td>2.1</td>";
    	echo "</tr>";
    		
    	echo "<tr>";
    	echo "<td>Pharmacometric Scientist</td>";
    	echo "<td>" .  $pm_scientist .  "</td>";
    	echo "<td>1, 2, 3, 4</td>";
    	echo "</tr>";
    		
    	echo "<tr>";
    	echo "<td>Statistician and/or Programmer</td>";
    	echo "<td>" .  $statistician .  "</td>";
    	echo "<td>2.2</td>";	
    	echo "</tr>";
    		
    	echo "<tr>";
    	echo "<td>Programmer</td>";
    	echo "<td>" .  $ds_programmer .  "</td>";
    	echo "<td>2.4, 2.5, 4.4</td>";		
    	echo "</tr>";
    	echo "</table>";

    	echo "<br/><br/>";
	
    	// Request Revision History
    	echo "<h4><b>Request Revision History:</b></h4>";
    	echo "<table id=history_table border=1>";
    	echo "<tr>";
    	echo "<th style='width: 120px;'>Version</th>";
    	echo "<th style='width: 180px;'>Date</th>";
    	echo "<th style='width: 120px;'>Revised by</th>";
    	echo "<th style='width: 500px;'>Changes Made</th>";
    	echo "</tr>";
        foreach($spec_general as $arr) { 
            echo "<tr>";
            echo "<td>"  . $arr['version_id'] . '</td>';
            echo "<td>"  . $arr['modification_date'] . '</td>';
            echo "<td>"  .  $arr['revised_by'] . '</td>';
            echo "<td>"  . htmlspecialchars($arr['changes_made']). '</td>';
            echo "</tr>";
        } 
        echo "</table><br/><br/>";
	
        // Section 1
        echo "<h2>1. Purpose</h2>";
        echo "<p>The purpose of this document is to specify the scope and content of the following Pharmacometric analysis dataset: </p>";
	
        // Dataset table
        echo "<table border='1' class='dataset_table'>";
        echo "<tr>";
        echo "<th style='width: 120px;'>Dataset Name</th>";
        echo "<th style='width: 300px;'>Dataset Descriptor</th>";
        echo "<th style='width: 250px;'>Location (path)</th>";
        echo "<th style='width: 150px;'>Delivery Date</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" .  $dataset_name . '</td>';
        echo "<td>" .  $dataset_description .  '</td>';
        echo "<td>" .  $dataset_path .  '</td>';
        echo "<td>" .  $dataset_due_date . '</td>';
        echo "</tr>";	

        echo "</table><br/><br/>";

        echo "<p>Specification of the scope and content of the above datasets includes specification of:</p>";
        echo "<p>Studies from which data are to be obtained, and the location of the source data (Section 2)</p>";
        echo "<p>Dataset structure and variables (Section 3)</p>";
        echo "<p>Derivations and handling of missing data (Section 4)</p><br/><br/>";

    	// Section 2
    	echo "<h2>2. Study Description</h2>";

    	// Section 2.1
    	echo "<h3>2.1 PK data sources</h3>";
    	echo "<table border=1>";
    	echo "<tr>";
    	echo "<th style='width: 120px;'>Study</th>";
    	echo "<th style='width: 250px;'>Study Type</th>";
    	echo "<th style='width: 120px;'>Lock Type</th>";
    	echo "</tr>";

        	foreach($pk_data as $arr) {	
                echo "<tr>";
        		echo "<td>"  .$arr['study'] . '</td>';
        		echo "<td>"  .  $arr['study_type'] . '</td>';
        		echo "<td>"  .  $arr['lock_type'] . '</td>';
        		echo "</tr>";
        	}

        echo "</table><br/>";

    	//Section 2.2
    	echo "<h3>2.2 Source data path for clinical, safety, efficacy and biomarker data</h3>";
    	echo "<table border=1>";
    	echo "<tr>";
    	echo "<th style='width: 8%;word-wrap: break-word!important;'>Study</th>";
        echo "<th style='width: 8%;word-wrap: break-word!important;'>Statistician</th>";
        echo "<th style='width: 18%;word-wrap: break-word!important;'>Raw</th>";
        echo "<th style='width: 18%;word-wrap: break-word!important;'>SDTM</th>";
        echo "<th style='width: 20%;word-wrap: break-word!important;'>ADaM</th>";
        echo "<th style='width: 30%;word-wrap: break-word!important;'>Other</th>";
    	echo "</tr>";	

        	foreach ($clinical_data as $arr) {	
                echo "<tr>";
        		echo "<td>" . $arr['study']  . '</td>';
        		echo "<td>" . $arr['statistician']  . '</td>';
        		echo "<td>" . $arr['level0']  . '</td>';
        		echo "<td>" . $arr['level1']  . '</td>';
        		echo "<td>" . $arr['level2']  . '</td>';
        		echo "<td>" . $arr['format']  . '</td>';
        		echo "</tr>";	
         	}	

        echo "</table><br/>";

    	// Section 2.3
    	echo "<h3>2.3 Clinical data sources</h3>";
    	echo "<table border=1>";
    	echo "<tr>";
    	echo "<th style='width: 120px;'>Raw Datasets Path Name (libname)</th>";
    	echo "<th style='width: 500px;'>Dataset Location</th>";
    	echo "</tr>";

         	foreach($pkms_path as $arr) {	
                echo "<tr>";
        		echo "<td>"  .  $arr['libname'] . '</td>';
        		echo "<td>"  .  $arr['libpath'] . '</td>';
        		echo "</tr>";
         	}
    	echo "</table><br/>";

    	// Section 2.4
    	echo "<h3>2.4 Location of the analysis dataset development directory</h3>";
    	echo "<p>Program development path:</p>";
    	echo "<p>"  . $dataset_dev_path . '</p>';
    
    	echo "<p>Program qc path:</p>";
    	echo "<p>"  . $dataset_qc_path  . '</p>';
    
    	echo "<br/>";

    	// Section 2.5
    	echo "<h3>2.5 Dataset requirements and Specification</h3>";
    	echo "<p>This section specifies overall requirements for datasets: names, dataset labels, and other requirements for a data set as a whole.  The next section contains variable-by-variable specifications.</p>";
    	echo "<p>Together, these sections detail all requirements, and supersede any previous discussions and agreements concerning these datasets.</p>";

    	echo "<table border=1>";
    	echo "<tr>";
    	echo "<th style='width: 120px;'>Requirement Number</th>";
    	echo "<th style='width: 500px;'>Requirement/Description</th>";
    	echo "</tr>";
    	echo "<tr>";
    	echo "<td>1.01</td>";
    	echo "<td>The dataset will be named ".  $dataset_name.  "</td>";
    	echo "</tr>";
    	echo "<tr>";
    	echo "<td>1.02</td>";
    	echo "<td>The dataset label will be: ".  $dataset_label.  "</td>";
    	echo "</tr>";
    	echo "<tr>";
    	echo "<td>1.03</td>";
    	echo "<td>The dataset will contain ".  $dataset_multiple_record.  "</td>";
    	echo "</tr>";
    	echo "<tr>";
    	echo "<td>1.04</td>";
    	echo "<td>The dataset will only contain records that meet the following criteria: ".  $dataset_inclusion.  "</td>";
    	echo "</tr>";
    	echo "<tr>";
    	echo "<td>1.05</td>";
    	echo "<td>The dataset will conform to the structure and content as defined in section 3, Dataset Structure.</td>";
    	echo "</tr>";
    	echo "<tr>";
    	echo "<td>1.06</td>";
    	echo "<td>Coded data within this dataset, if any, will conform to the format specifications provided in section 3, Controlled Terms or Format Descriptions.
                For the datasets that need to be imported back into eToolbox the labels will be made same as variable names.
                Please refer to section 3 for variable labels</td>";
    	echo "</tr>";
    	echo "<tr>";
    	echo "<td>1.07</td>";
    	echo "<td>The dataset will be a SAS dataset. Please provide in both sas7dat and xpt formats. Note: use extension .sas7bdat for SAS datasets, .rdata for R datasets, and .sdata for S-Plus datasets.</td>";
    	echo "</tr>";
    	echo "<tr>";
    	echo "<td>1.08</td>";
    	echo "<td>The dataset will be sorted by the following fields: " .$dataset_sort ."</td>";
    	echo "</tr>";
    	echo "</table>";

    	echo "<br/>";

    	//Section 3	
    	echo "<h2>3. Dataset structure</h2>";
    	echo "<table border=1 >";
    	echo "<tr>";
    	echo "<th style='width: 120px;'>Variable Name</th>";
    	echo "<th style='width: 250px;'>Variable Label</th>";
    	echo "<th style='width: 120px;'>Units</th>";
    	echo "<th style='width: 120px;'>Type</th>";
    	echo "<th style='width: 120px;'>Rounding</th>";
    	echo "<th style='width: 120px;'>Missing Value</th>";
    	echo "<th style='width: 200px;'>Notes</th>";
    	echo "<th style='width: 400px;'>Source</th>";
    	echo "</tr>";

            foreach($dataset_structure as $arr)  {		
                echo "<tr>";
        		echo "<td>" . htmlspecialchars($arr['var_name']) . '</td>';
        		echo "<td>" . htmlspecialchars($arr['var_label']) . '</td>';
        		echo "<td>" . htmlspecialchars($arr['var_units']) . '</td>';
        		echo "<td>" . htmlspecialchars($arr['var_type']) . '</td>';
        		echo "<td>" . htmlspecialchars($arr['var_rounding']) . '</td>';
        		echo "<td>" . htmlspecialchars($arr['var_missing_value']) . '</td>';
        		echo "<td>" . htmlspecialchars($arr['var_notes']) . '</td>';
        		echo "<td>" . htmlspecialchars($arr['var_source']) . '</td>';
        		echo "</tr>";		
            }
        
    	echo "</table>";

        // Section 4
        echo "<h2>4. Derivations/Outliers/Missing data</h2>";
        echo "<h3>4.1 Derivations</h3>";
        echo "<p>This section provides a list of all derivations and algorithms required for the creation of datasets.</p>";
        echo "<table border=1>";
        echo "<tr>";
        echo "<th style='width: 120px;'>Field</th>";
        echo "<th style='width: 400px;'>Algorithm</th>";
        echo "</tr>";

        	foreach($derivations as $arr)  {	
                echo "<tr>";
        		echo "<td>" . htmlspecialchars($arr['field']) . '</td>';
        		echo "<td>" . htmlspecialchars($arr['algorithm']) . '</td>';
        		echo "</tr>";	
        	}

    	echo "</table><br/>";
    	echo "<h3>4.2 Handling of Missing Data</h3>";
    	echo "<p>This section describes the handling of missing data and any imputation of missing data to be performed.</p>";
         	echo htmlspecialchars($missings);

        echo "<h3>4.3 Programming Algorithms and Imputations</h3>";
        echo "<p>This section provides the algorithms and imputation rules for the creation of analysis datasets, such as dosing or concomitant medications.</p>";
        echo "<table border=1>";
        echo "<tr>";
        echo "<th style='width: 120px;'>Flag Number</th>";
        echo "<th style='width: 300px;'>FLAGCOM</th>";
        echo "<th style='width: 500px;'>Notes</th>";
        echo "</tr>";

        	foreach ($flag as $arr) {	
                echo "<tr>";
        		echo "<td>" . htmlspecialchars($arr['flag_number']) . '</td>';
        		echo "<td>" . $arr['flag_comment'] . '</td>';
        		echo "<td>" . $arr['flag_notes'] . '</td>';
        		echo "</tr>";	
        	}

        echo "</table>";
        echo "<hr>";
        echo "<h3>Confirmation Files</h3>";
        echo "<table border=1>";
        echo "<tr>";
        echo "<th style='width: 450px;'>Confirmed items</th>";
        echo "<th style='width: 600px;'>Documents</th>";
        echo "</tr>";	

        	foreach ($files as $arr) {	
                echo "<tr>";
        		echo "<td>" . $arr['confirmed'] . '</td>';
        		echo "<td>" . $arr['name'] . '</td>';
        		echo "</tr>";	
        	}

        echo "</table><br/><br/>";
    	
         
?>
</body>
<script type="text/javascript">
   
 function onSubmit(e) {
  console.log({
    'signature':  document.getElementById("saveSignature").value,
  });
  return false;
}
 
</script>
<!--
'<form method="post" action="'.base_url('home/import/existing/reviewapprove').'" onsubmit="return confirm(\'Are you sure you want to approve this spec?\')">
                <div id="sign">
                <canvas class="roundCorners" id="newSignature" style="top:10%;left:10%;border:3px groove;"></canvas></div>
                <script>signatureCapture();</script>
                <div style="margin-left: 5%;margin-top: 2%;">
                    <button type="button" onclick="signatureSave()">Approve</button>
                    <button type="button" onclick="signatureClear()">Clear</button>
                </div>
                </br>
                Saved Image
                </br>
                <img id="saveSignature" alt="Saved image png"/>
           </form>'
    -->
</html>

