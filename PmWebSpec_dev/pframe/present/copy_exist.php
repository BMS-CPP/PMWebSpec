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

$user_name = $this->session->user_details;
$fullname = $user_name[0]['first_name']." ".$user_name[0]['last_name'];

?>
<style>
	input[type=text], select, textarea {
		width: 100%;
		padding: 12px;
		/*border: 1px solid #ccc;
		border-radius: 4px;*/
		box-sizing: border-box;
		resize: vertical;
	}
</style>
<div class="container" style="text-align: end;margin-top: 2%;">
	<!-- Last Activity Time : <span id='lastactivitytime'>Loading </span><br> -->
	<b style="background-color: skyblue;">Time Remaining For Session Timeout : <span id='timeremainingforsessiontimeout'>Loading </span><br></b>
	<!-- After Activity Timespent : <span id='afteractivity_timespent'>Loading </span><br> -->
	<!-- Time Reamining for session Timeout in Sec : <span id='timeremainingforsessiontimeoutinsec'>Loading </span> -->
</div>
<form method="post" action="<?php echo base_url('/home/create/save'); ?>" enctype="multipart/form-data" onsubmit="return validateMyForm();">
	<input id="passvalue" name="passvalue" type="hidden" />
	<input id="pkdata" name="pkdata" type="hidden" />
	<input id="clinical" name="clinical" type="hidden" />
	<input id="pkms" name="pkms" type="hidden" />
	<input id="derive" name="derive" type="hidden" />
	<input id="flgs" name="flgs" type="hidden" />
	<input id="confs" name="confs" type="hidden" />
<br/>
	<div class="required title-info">
	<font size="4" color="red" style="margin-left: 10px">*</font><font size="4"><b> Required input from Pharmacometrician</b></font>
	<p><font size="4" style="margin-left: 10px">Please fill out all the required field and variable name and label in the data structure table. Otherwise, you will not be able to submit your form.</font></p>

		<fieldset>
			<legend>Specification information</legend>
		<div class="container-fuild">
        	<div class="row">
                <div class="col col-md-6 pull-left">
                  <label><b>Your Full Name: (First Last)</b></label><input readonly="readonly" id="username" name="username" type="text" size="20" value="<?php  echo $fullname; ?>" required />
                </div>
                <div class="col col-md-6 pull-right">
                	<?php 
                		$cname = '';
                	?>
                  <label><b>Compound Name:</b></label><input id="cname" name="cname" type="text" size="20"  value="<?php echo $cname; ?>" title="Compound name must start with letter Ex:Test- and followed by the compound number" oninput="cnameCheck();" required />
                </div>

              	<div class="col col-md-6 pull-left">
                	<label><b>Dataset Type: </b></label>
					<!-- <?php
						$temp_var =& get_instance();
						$temp_var->load->model('CIModUser');
						$templates = $temp_var->CIModUser->getTeamplate();
						//print_r($templates['temp']);exit;
					?> -->
					<input name="dstype" type="text" value="<?php echo $user_spec['type'];?>"  required readonly/>
					<!-- <select name="dstype">
						<option></option>
						<?php
						echo "<option selected disabled>" . $user_spec['type']. "</option>";
						foreach ($templates['temp'] as $programmer) {
							//$selected = $user_spec['type'];
							//	echo "<option>" . $user_spec['type']. "</option>";
							//echo "<option value='".$programmer ."'".($programmer ==$user_spec['type']?' selected="selected"':"").">".  $programmer."</option>";
						}
						?>
					</select> -->

				</div>
				
				<div class="col col-md-6 pull-right">
                	<label><b>Indication : (if multiple indications, separate with a hyphen)</b></label>
                	<input name="ctype" type="text" size="40" placeholder="e.g. NSCLC-CRC" pattern="^[A-Za-z0-9 -]+$" style="text-transform:uppercase" required />
        		</div>
        		<div style="clear:both;">&nbsp;</div>
        		
        		<div class="col col-md-6">
        			<label><b>Date : </b></label>
        			<input name="cdate" type="text" readonly="true" value="<?php echo date("Y-m-d"); ?>" />
        		</div>
        	</div>
        </div>

		</fieldset>
	</div>
	<div class="title-info">	
	<fieldset>
		<legend>Specification content</legend>
    <div class="tab">
        <button type="button" class="tablinks" onclick="openTab(event, 'General Information')" id="defaultOpen">General Information</button>
        <button type="button" class="tablinks" onclick="openTab(event, 'Dataset Structure')">Dataset Structure</button>
        <button type="button" class="tablinks" onclick="openTab(event, 'Derivations')">Derivations</button>
	    <button type="button" class="tablinks" onclick="openTab(event, 'Confirmations')">Confirmations</button>
    </div> 
	 
	<div id="General Information" class="tabcontent">
	    <button type="button" class="accordion required" onclick="openpanel();"><label>General Information</label></button>

	    <div class="panel container-fluid required">
		<br/>
			<div class="row required">
				<div class="col-25"><label>Analysis title (eg. Population Pharmacokinetic Analysis of Compound Name): </label></div>
				<div class="col-75"><input id="title" name="title" type="text" size="80" /></div>
			</div>
			<div class="row required">
				<div class="col-25"><label>Project (Compound Name, Protocol Name): </label></div>
				<div class="col-75"><input id="project_name" name="project_name" type="text" size="80" /></div>
			</div>
			<div class="row required">
				<div class="col-25"><label>Document Version: </label></div>
				<div class="col-75"><input id="version_id" name="version_id" type="text" size="80" readonly value="1.0" /></div>
			</div>
			<br/>
		</div>

	    <button type="button" class="accordion required" onclick="openpanel();"><label>Accountable Team Members</label></button>

	    <div class="panel container-fluid">
			<br/>
			<div class="row required">
                <div class="col-25"><label>PK scientist (Enter NA if not applicable)</label></div>
                <div class="col-75"><input id="pk_scientist" type="text" name="pk_scientist" /></div>
			</div>
			
			<div class="row required">
                <div class="col-25"><label>Pharmacometric Scientist</label></div>
                <div class="col-75"><input id="pm_scientist" type="text" name="pm_scientist" /></div>
			</div>
			
			<div class="row required">
                <div class="col-25"><label>Statistician and/or Programmer</label></div>
                <div class="col-75"><input id="statistician" type="text" name="statistician" /></div>
			</div>
			
			<div class="row required">
                <div class="col-25">Data Science Programmer</div>
                <div class="col-75">
                    <select name="ds_programmer[]" multiple="multiple">
						<!-- <option> ------------- </option> -->
						<?php
 							foreach ($programmers as $programmer) {
								$row['full_name'] = $programmer['first_name']." ".$programmer['last_name'];
 								echo "<option>" . $row['full_name']. "</option>";
 							}
						?>
                    </select>
                 </div>
			</div>
		<br/>
        </div>

	    <button type="button" class="accordion required" onclick="openpanel();"><label>Purpose</label></button>

	    <div class="panel container-fluid">
			<br/>
			The purpose of this document is to specify the scope and content of the following Pharmacometric analysis dataset(s).
			Please note that <b>dataset name</b> must be <b>less than or equal to 8 characters</b> and <b>dataset label</b> must be <b>less than or equal to 40 characters</b>:
			<br/><br/>
			
			<?php //print_r($user_spec);
			//if ($user_spec['type'] == 'PPK-standard') {
			if($user_spec['type'] == 'PPK-standard') {
				echo '<div class="row required">
                <div class="col-25"><label>Dataset Name: </label></div>
                <div class="col-75"><input type="text" id="dataset_name" name="dataset_name" maxlength="8" value = "adppk" placeholder="<=8 characters, only letters, numbers and underscores are allowed" /></div>
			</div>';
			} else {
				echo '<div class="row required">
                <div class="col-25"><label>Dataset Name: </label></div>
                <div class="col-75"><input type="text" id="dataset_name" name="dataset_name" maxlength="8" placeholder="<=8 characters, only letters, numbers and underscores are allowed" /></div>
			</div>';
			}
			?>

			<div class="row required">
				<div class="col-25"><label>Dataset Label:</label></div>
				<div class="col-75"><input type="text" id="dataset_label" name="dataset_label" value="<?php echo $ds_label; ?>" maxlength="40" title="Dataset label must be <= 40 characters!"/></div>
			</div>
			

			<div class="row required">
				<div class="col-25"><label>Dataset Descriptiom: purpose of this analysis dataset</label></div>
                <div class="col-75"><input type="text" id="dataset_descriptor" name="dataset_descriptor" /></div>
			</div>

			<div class="row required">
				<div class="col-25"><label>The dataset will contain </label></div>
                <div class="col-75">
                    <select id="dataset_records" name="dataset_records">    
    					<option>multiple records per subject</option>
    					<option>single record per subject</option>
    					<option>one record per subject per time point</option>
    					<option>multiple records per subject per time point</option>
    				</select>
				</div>
			</div>
			
			<div class="row required">
                <div class="col-25"><label>The dataset will include records that meet the criteria: </label></div>
                <div class="col-75"><input type="text" id="dataset_criteria" name="dataset_criteria" placeholder="Study and cohort to include" /></div>
			</div>

			<div class="row required">
				<div class="col-25"><label>The dataset will be sorted by (if multiple, separated by comma): </label></div>
				<div class="col-75"><input type="text" id="dataset_sort" name="dataset_sort" value="<?php echo $dataset_sorted;?>"  style="text-transform:uppercase" /></div>
			</div>		

			<div class="row">
                <div class="col-25"><label>Dataset Location: </label></div>
                <div class="col-75"><input type="text" id="dataset_path" name="dataset_path" value="<?php  echo htmlspecialchars(pkms_path);  ?>" /></div>
			</div>

			<div class="row required">
                <div class="col-25"><label>Delivery Date: </label></div>
                <div class="col-75"><input type="date" id="dataset_date" name="dataset_date" /></div>		
			</div>
			<br/>
	    </div>	   

	    <button type="button" class="accordion" onclick="openpanel();">PK data sources</button>
	    <div class="panel container-fluid">
			<br/>
			<font size="2" >
            <table id="pkTable" border="5" cellpadding="5" cellspacing="5" style="width:85%; background-color:#ffffff; border-collapse:collapse; border:2px solid #808B96;">
				<tbody>
					<tr>
						<th style="width: 30px;"></th>
						<th style="width: 120px;">Study</th>
						<th style="width: 200px;">Study Type</th>
						<th style="width: 200px;">Lock Type</th>
					</tr>
					
				</tbody>
			</table>
			</font>
			<br/>
			<button type="button" onClick="addStudypk();" class="w3-btn w3-round-large w3-grey w3-medium">Add<i class="w3-margin-left material-icons">add_box</i></button>	  			
	  		<button type="button" onClick="showdelete('pkTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete<i class="w3-margin-left material-icons">delete</i></button>
			<br/><br/>
	    </div>

	    <button type="button" class="accordion" onclick="openpanel();">Clinical Data Sources (includes all Clinical, Biomarker, Safety and Efficacy)</button>
	    <div class="panel container-fluid">
			<br/>
			<p>Location(path) of each study:</p>
			<font size="2" >
            <table id="pathTable" border="5" cellpadding="5" cellspacing="5" style="background-color:#ffffff; border-collapse:collapse; border:2px solid #808B96;">
				<tbody>
					<tr>
						<th style="width:30px;"></th>
						<th style="width:100px;">Study</th>
						<th style="width:150px;">Statistician</th>
						<th style="width:280px;">Raw</th>
						<th style="width:280px;">SDTM</th>
						<th style="width:280px;">ADaM</th>
						<th style="width:280px;">Other</th>						
					</tr>
				</tbody>
			</table>
			</font>
			<br/>
			<button type="button" onClick="addPath();" class="w3-btn w3-round-large w3-grey w3-medium">Add<i class="w3-margin-left material-icons">add_box</i></button>
			<button type="button" onClick="showdelete('pathTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete<i class="w3-margin-left material-icons">delete</i></button>
			<br/><br/>
	    </div>

	    <button type="button" class="accordion" onclick="openpanel();">Source data path on Drive Path</button>
	    <div class="panel container-fluid">
		<br/>
			<p>Location(path) of each study:</p>
            <table id="libTable" border="5" cellpadding="5" cellspacing="5" style="width:85%; background-color:#ffffff; border-collapse:collapse; border:2px solid #808B96;">
				<tbody>
					<tr>
						<th style='width:30px;'></th>
						<th style='width:150px;'>Path Name</th>
						<th style='width:800px;'>Dataset Location</th>				
					</tr>
				</tbody>			  
			</table>
			<br/>
 			<button type="button" onClick="addLib();" class="w3-btn w3-round-large w3-grey w3-medium">Add<i class="w3-margin-left material-icons">add_box</i></button>
			<button type="button" onClick="showdelete('libTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete<i class="w3-margin-left material-icons">delete</i></button>
			<br/><br/>
	    </div>

	    <button type="button" class="accordion" onclick="openpanel();">Location of the analysis dataset development directory</button>
	    <div class="panel container-fluid">
			<br/>
		    <p><b>Program development path: <input name="dataset_dev_path" type="text" size="80" value="<?php echo htmlspecialchars($dataset_dev_path);?>" /></b></p>
            <p><b>Program QC path: <input name="dataset_qc_path" type="text" size="80" value="<?php echo htmlspecialchars($dataset_qc_path);?>" /></b></p>
	    </div>	

	    <button type="button" class="accordion" onclick="openpanel();">Dataset Requirements and Specifications</button>
	    <div class="panel container-fluid">
		<br/>
			<p><b>This section specifies overall requirements for datasets: names, dataset labels, and other requirements for a data set as a whole. The next section contains variable-by-variable specifications.</b></p>
			<p><b>Together, these sections detail all requirements, and supersede any previous discussions and agreements concerning these datasets.</b></p>
			<button type="button" onclick="getvalues();" class="w3-btn w3-round-large w3-grey w3-medium">Click to view the result</button>
			<br/><br/>
			<table border="5" cellpadding="5" cellspacing="5" style="width:85%; background-color:#ffffff; border-collapse:collapse; border:2px solid #808B96;">
				  <tbody>
                        <tr>
                        	<th style='width: 80px;'>Requirement Number</th>
                        	<th style='width: 500px;'>Requirement / Description</th>				
                        </tr>
                        <tr>
                        	<td>1.01</td>
                        	<td id="td1">&nbsp;</td>
                        </tr>
                        <tr>
                        	<td>1.02</td>
                        	<td id="td2">&nbsp;</td>
                        </tr>
                        <tr>
                        	<td>1.03</td>
                        	<td id="td3">&nbsp;</td>
                        </tr>
                        <tr>
                        	<td>1.04</td>
                        	<td id="td4">&nbsp;</td>
                        </tr>
                        <tr>
                        	<td>1.05</td>
                        	<td>The dataset will conform to the structure and content as defined in section 3, Dataset Structure.</td>
                        </tr>
                        <tr>
                        	<td>1.06</td>
                        	<td>Coded data within this dataset, if any, will conform to the format specifications provided in section 3, Controlled Terms or Format Descriptions. For the datasets that need to be imported back into eToolbox the labels will be made same as variable names. Please refer to section 3 for variable labels</td>
                        </tr>
                        <tr>
                        	<td>1.07</td>
                        	<td>The dataset will be a SAS dataset in sas7bdat and xpt formats. Note: use extension .sas7bdat for SAS datasets, .rdata for R datasets, and .sdata for S-Plus datasets.</td>
                        </tr>
                        <tr>
                        	<td>1.08</td>
                        	<td id="td8">&nbsp;</td>
                        </tr>
				  </tbody>
			</table>
	    </div>
    </div>
	  
	<div id="Dataset Structure" class="tabcontent">
		<div class="scrollit">
    		<table id="myTable" name="myTable" border="5" cellpadding="5" cellspacing="5" style="table-layout: fixed;width: 1377px; border-collapse: collapse; border: 2px solid #808B96;">
    			<thead class="fixdHeader">				  
    			  <tr>
    			    <th style="width:30px;"></th>
    				<th style="width:70px;">#</th>
    				<th style="width: 100%;" hidden>Required</th>
    				<th style="width: 100%;" hidden>nameChange</th>
    				<th style="width: 100%;" hidden>labelChange</th>
    				<th style="width: 100%;" hidden>unitChange</th>
    				<th style="width: 100%;" hidden>typeChange</th>
    				<th style="width: 100%;" hidden>roundChange</th>
    				<th style="width: 100%;" hidden>missValChange</th>
    				<th style="width: 100%;" hidden>noteChange</th>
    				<th style="width: 100%;" hidden>sourceChange</th> 
    				<th style="width: 115px;">Variable Name</th>
    				<th style="width: 275px;">Variable Label</th>
    				<th style="width: 93px;">Units</th>
					<th style="width: 92px;">Type</th>
					<th style="width: 92px;">Rounding</th>
					<th style="width: 92px;">Missing Value</th>
					<th style="width: 270px;">Notes</th>
					<th style="width: 255px;">Source</th>
    			  </tr>
    			</thead>

    			<tbody class="scrollContent">
				<?php
				$dataset_structure_value = [];

				foreach($dataset_structure as $k => $arr) {
					//print_r($k);exit;
					$dataset_structure_value[] = $arr['var_name'];
					echo "<tr>";

					echo "<td style='width:32px;'><input type='checkbox'  class='checkboxc' />&nbsp;</td>";

					## variable number
					echo '<td style="width:76px;"><input type="text" class="struct" value="' .str_pad($k, 3, '0', STR_PAD_LEFT). '" readonly /></td>';

					## flags
					echo '<td style="display:none;"><input type="text" class="struct" value="' . $arr['required'] . '" readonly /></td>';
					echo '<td style="display:none;"><input type="text" class="struct" value="' . $arr['nameChange'] . '" readonly /></td>';
					echo '<td style="display:none;"><input type="text" class="struct" value="' . $arr['labelChange'] . '" readonly /></td>';
					echo '<td style="display:none;"><input type="text" class="struct" value="' . $arr['unitChange'] . '" readonly /></td>';
					echo '<td style="display:none;"><input type="text" class="struct" value="' . $arr['typeChange'] . '" readonly /></td>';
					echo '<td style="display:none;"><input type="text" class="struct" value="' . $arr['roundChange'] . '" readonly /></td>';
					echo '<td style="display:none;"><input type="text" class="struct" value="' . $arr['missValChange'] . '" readonly /></td>';
					echo '<td style="display:none;"><input type="text" class="struct" value="' . $arr['noteChange'] . '" readonly /></td>';
					echo '<td style="display:none;"><input type="text" class="struct" value="' . $arr['sourceChange'] . '" readonly /></td>';

					//name
					echo '<td style="width:140px;"><input type="text" class="struct" maxlength="8" value="' . $arr['var_name'] . '" style="text-transform:uppercase" ' . ($arr['nameChange'] == 0? 'readonly':'') . ' /></td>';
					//label
					echo '<td style="width:340px;"><input type="text" class="struct" maxlength="40" value="' . $arr['var_label'] . '" ' . ($arr['labelChange'] == 0? 'readonly':'') . ' /></td>';
					//unit
					 $units = wordwrap($arr['var_units'], 10, "<br />\n", true);
					echo '<td style="width:108px;"><input type="text" class="struct" value="' .  $units . '" ' . ($arr['unitChange'] == 0? 'readonly':'') . ' /></td>';
					//type
					echo '<td style="width:108px;"><select class="struct" ' . ($arr['typeChange'] == 0? 'disabled':'') . '>';
					$row = array('Char','Num');
					$selected = $arr['var_type'] ;
					$i = 0;
					while ($i < count($row)){
						echo "<option value='". $row[$i] ."' ".($row[$i]==$selected?'selected="selected"':"").">". $row[$i]."</option>";
						$i++;
					}
					echo '</select></td>';
					//round
					echo '<td style="width:108px;"><select class="struct" '. ($arr['roundChange'] == 0? 'disabled':'') . '>';
					$row = array('NA', '0.1', '0.01', '0.001', '1',  '3 significant digits', '4 significant digits');
					$selected = $arr['var_rounding'] ;
					$i = 0;
					while ($i < count($row)){
						echo "<option value='". $row[$i] ."'".($row[$i]==$selected?' selected="selected"':"").">". $row[$i]."</option>";
						$i++;
					}
					echo '</select></td>';
					//miss value
					echo '<td style="width:108px;"><input type="text" class="struct" value="' . $arr['var_missing_value'] . '" ' . ($arr['missValChange'] == 0? 'readonly':'') . ' /></td>';
					//notes
					echo '<td style="width:325px;"><textarea class="struct" ' . ($arr['noteChange'] == 0? 'readonly':'') . ' >'. $arr['var_notes'].'</textarea></td>';
					//source

					echo '<td style="width:310px;"><textarea class="struct" ' . ($arr['sourceChange'] == 0? 'readonly':'') . ' >'. htmlspecialchars($arr['var_source']) .'</textarea></td>';

					echo "</tr>";
				}
				?>
				</tbody>
		</table>
		</div>
		
		<br/>
		<b>Variable name maximum length: 8 characters, variable label maximum length: 40 characters. Variable name can only contain letters, numbers or underscore</b>
		<br/>
		<button type="button" onClick="addInput('dynamicInput');" class="w3-btn w3-round-large w3-grey w3-medium">Add new variable<i class="w3-margin-left material-icons">add_box</i></button>
		<button type="button" onClick="showdelete('myTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete selected variables<i class="w3-margin-left material-icons">delete</i></button>
		<button type="button" onClick="clearChecked();" class="w3-btn w3-round-large w3-grey w3-medium">Clear selected variables<i class="w3-margin-left material-icons">close</i></button>	
		<br/><br/>
		<button type="button" onClick="sortTable(10);" class="w3-btn w3-round-large w3-grey w3-medium">Sort by variable name</button>
		<button type="button" onClick="sortTable(0);" class="w3-btn w3-round-large w3-grey w3-medium">Sort by variable order</button>
		<br/><br/>
		<b>Select variable to move up or down </b>
		<button type="button" onClick="updown('up');" class="w3-btn w3-round-large w3-grey w3-medium">Move variable up<i class="w3-margin-left material-icons">arrow_upward</i></button>
		<button type="button" onClick="updown('down');" class="w3-btn w3-round-large w3-grey w3-medium">Move variable down<i class="w3-margin-left material-icons">arrow_downward</i></button>
		<br/><br/>
		<?php
	
			echo '<b>Please select optional variables to add:</b>';	
			echo '<div id="allspecs" class="">
					<table id="allspectable" name="allspectable" border="1px solid #ddd;" cellpadding="5" cellspacing="5" style="width:85%;background-color:#ffffff;border-collapse:collapse;border:2px solid #808B96">
					<tbody>			  
					  <tr>
						<th style="width:30px;"></th>
						<th style="width:100px;">Variable Name</th>
						<th style="width:200px;">Variable Label</th>
						<th style="width:100px;">Units</th>
						<th style="width:100px;">Type</th>			
						<th style="width:100px;">Rounding</th>
						<th style="width:100px;">Missing Value</th>
						<th style="width:300px;">Notes</th>
						<th style="width:300px;">Source</th>
					  </tr>';
		$otheroptional_value = [];	
		foreach($otheroptional as $arr) {
			$otheroptional_value[] = $arr['var_name'];
		}		
		
		$result = array_intersect($otheroptional_value,$dataset_structure_value);
	
		foreach($otheroptional as $arr) {
			if(!in_array($arr['var_name'], $result)) {
				 $units = wordwrap($arr['units'], 10, "<br />\n", true);
				echo "<tr>";
				echo "<td><input type='checkbox' class='checkboxc' onchange='handleClick(this);'  id=".$arr['var_name'] ." >&nbsp;</td>";
				echo '<td class="varname">' . $arr['var_name'] . '</td>';
				echo '<td>' . $arr['var_label'] . '</td>';
				echo '<td>' . $units . '</td>';
				echo '<td>' . $arr['type'] . '</td>';
				echo '<td>' . $arr['round'] . '</td>';
				echo '<td>' . $arr['missVal'] . '</td>';
				echo '<td>' . $arr['note'] . '</td>';
				echo '<td>' . $arr['source'] . '</td>';
				echo "</tr>";
			}			
		}

			echo '</tbody>
                </table>';	
			echo '<br/>';
			echo '<p><button type="button" onClick="addOptional();" class="w3-btn w3-round-large w3-grey w3-medium">Add optional variable<i class="w3-margin-left material-icons">add_box</i></button></p>';
			echo '</div>';
			?>

	</div>
		
	<div id="Derivations" class="tabcontent">
		<button type="button" class="accordion" onclick="openpanel();">Derivations</button>
        <div class="panel container-fluid">
			<br/>
			<p>This section provides a list of all derivations and algorithms required for the creation of datasets.</p>
			   
			<table id="deriveTable" border="5" cellpadding="5" cellspacing="5" style="width:50%; background-color:#ffffff; border-collapse:collapse; border:2px solid #808B96;">
				<tbody>
					<tr>
						<th style="width: 30px;"></th>
						<th style="width: 120px;">Field</th>
						<th style="width: 800px;">Algorithm</th>
					</tr>															
				</tbody>
				<?php
				foreach($derivations as $arr) {
					echo '<tr>';
					echo '<td><input type="checkbox"  class="checkboxc" />&nbsp;</td>';
					echo '<td><input type="text" class="struct" value="' . $arr['field'] . '" /></td>';
					echo '<td><textarea class="struct">' . htmlspecialchars($arr['algorithm']) . '</textarea></td>';
					echo '</tr>';
				}
				?>
			</table>
			<br/>

			<button type="button" onClick="addDerivation();" class="w3-btn w3-round-large w3-grey w3-medium">Add<i class="w3-margin-left material-icons">add_box</i></button>
			<button type="button" onClick="showdelete('deriveTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete<i class="w3-margin-left material-icons">delete</i></button> 				
			<br/><br/>				
		</div>

		<button type="button" class="accordion" onclick="openpanel();">Handling of Missing Data</button>
            <div class="panel">
				<br/>
				<p style="color: #0a0a0a">This section describes the handling of missing data and any imputation of missing data to be performed.</p>
				<br/>
				<p style="color: #0a0a0a"><span id="missingtext" name="missingtext"><?php  echo $missing_outlier['missing']; ?></span></p>
				<br/>
				<textarea id="missingadd" name="missingadd"> </textarea>
				<br/><br/>
				<button type="button" onClick="addText('missingadd', 'missingtext');" class="w3-btn w3-round-large w3-grey w3-medium">Add description<i class="w3-margin-left material-icons">note_add</i></button>
				<br/><br/>
		    </div>
		   
		<button type="button" class="accordion" onclick="openpanel();">Programming Algorithms and Imputations</button>
            <div class="panel">
				<br/>
			    <p>This section provides the algorithms and imputation rules for the creation of analysis datasets, such as dosing or concomitant medications.</p>

			    <button type="button" onClick="window.open('<?php echo base_url('home/create/flagcheck'); ?>');" class="w3-btn w3-round-large w3-grey w3-medium">Check all existing flags</button> <br /><br />
			   
			    <table id="flagTable" border="5" cellpadding="5" cellspacing="5" style="width:50%;background-color:#ffffff;border-collapse:collapse;border:2px solid #808B96">
				<tbody>
					<tr>
						<th style="width: 30px;"></th>
						<th style="width: 60px;">Flag #</th>
						<th style="width: 400px;">Flag comment</th>
						<th style="width: 800px;">Flag description</th>
					</tr>				
				</tbody>
					<?php
					foreach ($flag as $arr) {
						echo '<tr>';

						if ($arr['required'] == 1) {
							echo "<td><input type='checkbox' class='checkboxc' disabled />&nbsp;</td>";
						}
						else {
							echo "<td><input type='checkbox' class='checkboxc'/>&nbsp;</td>";
						}
						echo '<td><input type="text" class="struct" value="' . $arr['flag_number'] . '" readonly /></td>';
						echo '<td><textarea class="struct" ' . ($arr['required'] == 1? 'readonly':'') . ' >' . htmlspecialchars($arr['flag_comment']) . '</textarea></td>';
						echo '<td><textarea class="struct" >' . htmlspecialchars($arr['flag_notes']) . '</textarea></td>';
						echo '<td style="display:none;"><textarea class="struct" readonly>' . $arr['required'] . '</textarea></td>';
						echo '</tr>';
					}
					?>
			    </table>

				<br/>
				<button type="button" onClick="addFlag();" class="w3-btn w3-round-large w3-grey w3-medium">Add<i class="w3-margin-left material-icons">add_box</i></button>
				<button type="button" onClick="showdelete('flagTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete<i class="w3-margin-left material-icons">delete</i></button>	
				<br/><br/>
				<button type="button" onClick="updown2('up');" class="w3-btn w3-round-large w3-grey w3-medium">Move flag up<i class="w3-margin-left material-icons">arrow_upward</i></button>
				<button type="button" onClick="updown2('down');" class="w3-btn w3-round-large w3-grey w3-medium">Move flag down<i class="w3-margin-left material-icons">arrow_downward</i></button>
				<br/><br/>						   		   
		    </div>
	</div>
	
	<div id="Confirmations" class="tabcontent">
		<table id="confirmTable" border="5" cellpadding="5" cellspacing="5" style="width:50%;background-color:#ffffff;border-collapse:collapse;border:2px solid #808B96">
		<tbody>
			<tr>
				<th style="width: 30px;"></th>
				<th style="width: 400px;">Confirmed item</th>
				<th style="width: 400px;">Documents</th>
			</tr>
		</tbody>
		</table>

		<br/>
		<button type="button" onClick="addDoc();" class="w3-btn w3-round-large w3-grey w3-medium">Add<i class="w3-margin-left material-icons">add_box</i></button>
		<button type="button" onClick="showdelete('confirmTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete<i class="w3-margin-left material-icons">delete</i></button>
		<br/>
	</div>
		
	</fieldset>
	</div>

	<input type="hidden" name="timestamp" id="timestamp" value="<?php echo $lastactivitytimeold; ?>">


	    <br/>
	<center>
		<?php 
		$dstype = $user_spec['type'];
		$specnotallowed = $this->config->item('specnotallowed');
        $stringtodisplay = implode(",",$specnotallowed);

   		if(in_array(strtoupper($dstype),$specnotallowed))
		{ ?>
			<span style="color:red;"> Note : <?php
					$specnotallowed = $this->config->item('specnotallowed');
           			echo $stringtodisplay = implode(",",$specnotallowed)." Specs are not allowed to import";
					?></span> <?php
		}
		else
		{
			?><input class="button" type="submit" value="submit" name="submitform" onclick="displaytext();"><?php
		}
		?>

		<!-- <input class="button" type="submit" value="submit" name="submitform" onclick="displaytext();"> -->
	</center>
	</form>
	<br/><br/>
	

	<script>
	$(document).ready(function() 
			{
				setInterval(function()
				{
					<?php 
					if (isset($lastactivitytimeold)) 
					{
						?>
						var lastactivitytimeold = document.getElementById("timestamp").value;

						$.ajax({
					        url: "<?php echo base_url(); ?>home/getsessiontime/"+lastactivitytimeold,
					        type: "post",
					        data: "values" ,
					        success: function (response) 
					        {
					        	var response = JSON.parse(response);
					        	var lastactivitytime = response.lastactivitytime;
					        	var afteractivity_timespent = response.afteractivity_timespent;
					        	var timeremainingforsessiontimeout = response.timeremainingforsessiontimeout;
					        	var timeremainingforsessiontimeoutinsec = response.timeremainingforsessiontimeoutinsec;

					        	// document.getElementById("lastactivitytime").innerHTML = lastactivitytime;
					        	// document.getElementById("afteractivity_timespent").innerHTML = afteractivity_timespent;
					        	document.getElementById("timeremainingforsessiontimeout").innerHTML = timeremainingforsessiontimeout;
					        	// document.getElementById("timeremainingforsessiontimeoutinsec").innerHTML = timeremainingforsessiontimeoutinsec;

					        	if(timeremainingforsessiontimeoutinsec <= 300)
					        	{
					        		if (confirm('Your Session is about to expire in 5 Minute, Click "OK" to extend your session.')) 
					        		{
					        			document.getElementById("timestamp").value = Math.floor(Date.now() / 1000);
									  // Save it!
									  $.ajax({
								            url:"<?php echo base_url(); ?>home",
								            type: "post",    //request type,
								            dataType: 'json',
								            data: {registration: "success", name: "xyz", email: "abc@gmail.com"},
								            success:function(result){
								                console.log(result.abc);
								                //document.getElementById("timestamp").value = '';
					        					//document.getElementById("timestamp").value = <?php echo time(); ?>;
								            }
								        });
									} else 
									{
										document.location = '<?php echo base_url(); ?>home';
									}
					        	}
					        	

					        	// alert(lastactivitytime.lastactivitytime);
					           // You will get response from your PHP page (what you echo or print)
					        },
					        error: function(jqXHR, textStatus, errorThrown) {
					           console.log(textStatus, errorThrown);
					        }
					    });

						<?php
						}
					?>
			    },5000);
			});

			var acc = document.getElementsByClassName("accordion");
			var i;
				  
			for (i = 0; i < acc.length; i++) {
				acc[i].onclick = function() {
					this.classList.toggle("active");
					var panel = this.nextElementSibling;
					if (panel.style.maxHeight){
						panel.style.maxHeight = null;
					} else {
						panel.style.maxHeight = "700px";
					} 
					
				}
			}		

			var optional = <?php echo json_encode($optional); ?>;
			var otheroptional = <?php echo json_encode($otheroptional); ?>;

			$(function(){
	 $("#char_select").on('change', function(){
	   alert("Works");
	 })
	  
	});
			var acc = document.getElementsByClassName("accordion");
			var i;
                  
			for (i = 0; i < acc.length; i++) {
				acc[i].onclick = function() {
					this.classList.toggle("active");
					var panel = this.nextElementSibling;
					if (panel.style.maxHeight){
						panel.style.maxHeight = null;
					} else {
						panel.style.maxHeight = "500px";
					} 
					
				}
			}

			var otheroptional = <?php echo json_encode($otheroptional); ?>;

	function handleClick(cb) {
  		var select_value =  cb.id;

  		if(select_value == "TTYPEF") {
	  		document.getElementById("TTYPEN").checked = true; 	 
  		}
  		if(select_value == "TTYPEN") {
	  		document.getElementById("TTYPEF").checked = true; 	 
  		}
  		if((document.getElementById("TTYPEN").checked == false) || (document.getElementById("TTYPEF").checked == false)) 
  		{
  			document.getElementById("TTYPEF").checked = false;	 
	  		document.getElementById("TTYPEN").checked = false; 	 
  		}


  		if((select_value == "SEX")) {
  			 document.getElementById("SEXN").checked = true;
  		}
  		if(select_value == "SEXN") {
	  		document.getElementById("SEX").checked = true; 	 
  		}
  		if((document.getElementById("SEXN").checked == false) || (document.getElementById("SEX").checked == false)) 
  		{
  			document.getElementById("SEX").checked = false;	 
	  		document.getElementById("SEXN").checked = false; 	 
  		}


  		if(select_value == "RACE") {
  			 document.getElementById("RACEN").checked = true;
  		}
  		if(select_value == "RACEN") {
  			 document.getElementById("RACE").checked = true;
  		}
  		if((document.getElementById("RACEN").checked == false) || (document.getElementById("RACE").checked == false)) 
  		{
  			document.getElementById("RACE").checked = false;	 
	  		document.getElementById("RACEN").checked = false; 	 
  		}

  		if(select_value == "HEPA") {
  			 document.getElementById("HEPAN").checked = true;
  		}
  		if(select_value == "HEPAN") {
  			 document.getElementById("HEPA").checked = true;
  		}
  		if((document.getElementById("HEPAN").checked == false) || (document.getElementById("HEPA").checked == false)) 
  		{
  			document.getElementById("HEPA").checked = false;	 
	  		document.getElementById("HEPAN").checked = false; 	 
  		}		
	}

		
	</script>	
	   </body>
</html>

