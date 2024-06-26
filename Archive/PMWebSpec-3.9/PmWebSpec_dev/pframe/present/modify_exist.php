<script src="<?php echo base_url("assets/js/scripts.js"); ?>"></script>
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

$approved =& get_instance();
$approved->load->model('CIModSpec');
$approved_info = $approved->CIModSpec->getApprovedInfo($spec_id);
if($approved_info == 1) {
	echo "<script>alert('You can not modify the Spec which is approved') </script>";
	redirect(base_url(), 'refresh');
}

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

	<b style="background-color: skyblue;">Time Remaining For Session Timeout : <span id='timeremainingforsessiontimeout'>Loading </span><br>
		<?php 
		if(!empty($lockedby))
		{
			echo '<span style="text-align: left;background-color: lightyellow;margin-top: 1%;">This Specification is being modified by: ' . $lockedby . '</span>';
		}
		?>
		</b>
</div>
<!-- <div class="container" style="text-align: end;margin-top: 2%;">
	<b style="background-color: skyblue;">Time Remaining For Session Timeout : <span id='timeremainingforsessiontimeout'>Loading </span><br></b>
</div> -->


	<form method="post"  action=<?php echo base_url('home/update/save'); ?> enctype="multipart/form-data" onsubmit="return validateMyForm();">
		<input id="passvalue" name="passvalue" type="hidden" />
		<input id="pkdata" name="pkdata" type="hidden" />
		<input id="clinical" name="clinical" type="hidden" />
		<input id="pkms" name="pkms" type="hidden" />
		<input id="derive" name="derive" type="hidden" />
		<input id="flgs" name="flgs" type="hidden" />
		<input id="confs" name="confs" type="hidden" />
		<input id="spec_type" name="spec_type" value="<?php echo $user_spec['type']; ?>" type="hidden" />
    	<br/>
		<div class="required title-info">
    	<font size="4" color="red" style="margin-left: 10px">*</font><font size="4"><b>  Required input from Pharmacometrician</b></font>
    	<p><font size="4" style="margin-left: 10px">Please fill out all the required field and variable name and label in the data structure table. Otherwise, you will not be able to submit your form.</font></p>
    		<fieldset>
                <?php 
                if($islocked == '1' && $spec_status == '1')
                {
                	$changes_madeext = $changes_made;
                }
                else
                {
                	$changes_madeext = '';
                } ?>

                 <legend>Specification information</legend>
                <label><b>Specification ID: </b></label><input id="spec_id" name="spec_id" type="text" size="80" value="<?php  echo htmlspecialchars($spec_id); ?>" readonly/>
                <label><b>Changes made: (Please track your changes to the specification)</b></label><input name="changes_made" value="<?php echo $changes_madeext; ?>"  <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> type="text" size="80" required />
                <label><b>Revised by: </b></label><input name="revised_by" type="text" size="80" value="<?php  echo $fullname; ?>" required  />
                 <input id="cname" name="cname" type="hidden" size="20"  value="<?php echo $user_spec['compound']; ?>" title="Compound name must start with letter Ex:Test- and followed by the compound number" oninput="cnameCheck();" required />

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

    		    <div class="panel container-fuild required">
					<br/>
					<div class="row required">
						<div class="col-25"><label>Analysis title (eg. Population Pharmacokinetic Analysis of Compound Name): </label></div>
						<div class="col-75"><input id="title" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> name="title" type="text" size="80" value="<?php  echo htmlspecialchars($title); ?>" /></div>
					</div>
					<div class="row required">
						<div class="col-25"><label>Project (Compound Name, Protocol Name): </label></div>
						<div class="col-75"><input id="project_name" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> name="project_name" type="text" size="80" value="<?php  echo htmlspecialchars($project_name); ?>" /></div>
					</div>
					<?php
						$temp_var =& get_instance();
						$temp_var->load->model('CIModSpec');
						$var_id = $temp_var->CIModSpec->getMaxVersion('spec_general',$spec_id);
						$version_id = $var_id + 1;
					?>
					<div class="row required">
						<div class="col-25"><label>Document Version: </label></div>
						<div class="col-75"><input id="version_id" name="version_id" type="text" size="80" readonly value="<?php  echo htmlspecialchars($version_id); ?>" /></div>
					</div>
					<div class="row required">
						<div class="col-25"><label>Date: </label></div>
						<div class="col-75"><input name="cdate" type="text" readonly="readonly" value="<?php echo date("Y-m-d"); ?>" /></div>
					</div>
					<br/>
    			</div>

				<button type="button" class="accordion required" onclick="openpanel();"><label>Accountable Team Members</label></button>

                <div class="panel container-fuild">
                	<div class="row required">
						<br/>
                        <div class="col-25"><label>PK scientist (Enter NA if not applicable)</label></div>
                        <div class="col-75"><input id="pk_scientist" type="text" name="pk_scientist" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> value="<?php echo htmlspecialchars($pk_scientist); ?>" /></div>
                	</div>
                
                	<div class="row required">
                        <div class="col-25"><label>Pharmacometric Scientist</label></div>
                        <div class="col-75"><input id="pm_scientist" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> type="text" name="pm_scientist" value="<?php  echo htmlspecialchars($pm_scientist); ?>" /></div>
                	</div>
                	
                	<div class="row required">
                        <div class="col-25"><label>Statistician and/or Programmer</label></div>
                        <div class="col-75"><input id="statistician" type="text" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> name="statistician" value="<?php  echo htmlspecialchars($statistician); ?>" /></div>
                	</div>

                    <div class="row">
                        <div class="col-25">Data Science Programmer</div>
                        <div class="col-75">
                            <?php 
                                echo $ds_programmer; 
                            ?>
                           
                        </div>
                    </div>

    				<div class="row">
    	                <div class="col-25">Modify above ,(comma) separated Data Science Programmer :</div>
    	                <div class="col-75">
                            <?php $ds_programmers = explode(",",$ds_programmer); ?>
    	                    <select name="ds_programmer[]" multiple="multiple">
    						   <?php
							   		foreach ($programmers as $programmer) 
							   		{

							   			$row['full_name'] = $programmer['first_name']." ".$programmer['last_name'];
							   			if (in_array($row['full_name'], $ds_programmers)) 
							   			{
										    $selected = "selected='selected'";
										}
										else
										{
											$selected = '';
										}

										

     									echo "<option ". $selected ." value='". $row['full_name'] ."'".($row['full_name']).">".  $row['full_name']."</option>";
     								}
    						    ?>
    	                    </select>
    	                </div>
    				</div>
					<br/>
	        	</div>
		    	<button type="button" class="accordion required" onclick="openpanel();"><label>Purpose</label></button>

    		    <div class="panel container-fuild">
					<br/>
    				The purpose of this document is to specify the scope and content of the following Pharmacometric analysis dataset. 
    				Please note that <b>dataset name</b> must be <b>less than or equal to 8 characters</b> and <b>dataset label</b> must be <b>less than or equal to 40 characters</b>:

					<br/><br/>

    				<div class="row required">
    	                 <div class="col-25"><label>Dataset Name: </label></div>
    	                 <div class="col-75"><input type="text" id="dataset_name" name="dataset_name" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> maxlength="8" value="<?php  echo htmlspecialchars($dataset_name); ?>" /></div>
    				</div>

                    <div class="row required">
                        <div class="col-25"><label>Dataset Label:</label></div>
                        <div class="col-75"><input type="text" id="dataset_label" name="dataset_label" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> value="<?php  echo htmlspecialchars($dataset_label); ?>" maxlength="40" /></div>
                    </div>
                    
                    <div class="row required">
                        <div class="col-25"><label>Dataset Description: purpose of this analysis dataset</label></div>
                        <div class="col-75"><input type="text" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> id="dataset_descriptor" name="dataset_descriptor" value="<?php  echo htmlspecialchars($dataset_description); ?>" /></div>
                    </div>
				
                    <div class="row required">
                        <div class="col-25"><label>The dataset will containe </label></div>
                        <div class="col-75">
                        	<select id="dataset_records" name="dataset_records">    
                        		<option><?php  echo htmlspecialchars($dataset_multiple_record); ?></option>
                        		<option>multiple records per subject</option>
                        		<option>single record per subject</option>
                        		<option>one record per subject per time point</option>
                        		<option>multiple records per subject per time point</option>
                    		</select>
                    	</div>
                    </div>
				
                    <div class="row required">
                         <div class="col-25"><label>The dataset will include records that meet the criteria: </label></div>
                         <div class="col-75"><input type="text" id="dataset_criteria" name="dataset_criteria" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> value="<?php  echo htmlspecialchars($dataset_inclusion); ?>"/></div>
                    </div>
                    
                    <div class="row required">
                    	 <div class="col-25"><label>The dataset will be sorted by: </label></div>
                         <div class="col-75"><input type="text" id="dataset_sort" name="dataset_sort" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> value="<?php  echo htmlspecialchars($dataset_sort); ?>" style="text-transform:uppercase"/></div>
                    </div>
                    
                    <div class="row">
                         <div class="col-25"><label>Dataset Location:</label></div>
                         <div class="col-75"><input type="text" id="dataset_path" name="dataset_path" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> value="<?php  echo htmlspecialchars($dataset_path); ?>"/></div>
                    </div>

                    <div class="row required">
                         <div class="col-25"><label>Delivery Date:</label></div>
                         <div class="col-75"><input type="date" id="dataset_date" name="ds_due_date" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> value="<?php  echo htmlspecialchars($dataset_due_date); ?>"/></div>
                    </div>
					<br/>
                </div>

		    	<button type="button" class="accordion" onclick="openpanel();">PK data sources</button>

    		    <div class="panel container-fuild">
    				<br/>
    	            <table id="pkTable" border="5" cellpadding="5" cellspacing="5" style="width:85%; background-color:#ffffff; border-collapse:collapse; border:1px solid #808B96;">
    					<tbody>
    						<tr>
    							<th style="width: 30px;"></th>
    							<th style="width: 120px;">Study</th>
    							<th style="width: 200px;">Study Type</th>
    							<th style="width: 200px;">Lock Type</th>
    						</tr>						
    					</tbody>

					<?php
 						foreach($pk_data as $arr) {
 							echo '<tr>';
 							echo '<td><input type="checkbox"  class="checkboxc"/>&nbsp;</td>';
 							echo '<td><input type="text" class="struct" value="' . $arr['study'] . '"></td>';
 							echo '<td><input type="text" class="struct" value="' . $arr['study_type'] . '"></td>';
 							echo '<td><input type="text" class="struct" value="' . $arr['lock_type'] . '"></td>';
 							echo '</tr>';
 						}
					?>
				</table>

				<br/>
				<button type="button" onClick="addStudypk();" class="w3-btn w3-round-large w3-grey w3-medium">Add<i class="w3-margin-left material-icons">add_box</i></button>	  			
		  		<button type="button" onClick="showdelete('pkTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete<i class="w3-margin-left material-icons">delete</i></button>
				<br/><br/>
		    </div>

		    	<button type="button" class="accordion" onclick="openpanel();">Clinical Data Sources (includes all Clinical, Biomarker, Safety and Efficacy)</button>

    		    <div class="panel container-fuild">
					<br/>
    				<p>Location(path) of each study:</p>
    	            <table id="pathTable" border="5" cellpadding="5" cellspacing="5" style="background-color:#ffffff; border-collapse:collapse; border:1px solid #808B96;">
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
    					<?php
     						foreach($clinical_data as $arr) {
     							echo '<tr>';
     							echo '<td><input type="checkbox"  class="checkboxc"/>&nbsp;</td>';
     							echo '<td><input type="text" class="struct" value="' . $arr['study'] . '"></td>';
     							echo '<td><input type="text" class="struct" value="' . $arr['statistician'] . '"></td>';
     							echo '<td><input type="text" class="struct" value="' . $arr['level0'] . '"></td>';
     							echo '<td><input type="text" class="struct" value="' . $arr['level1'] . '"></td>';
     							echo '<td><input type="text" class="struct" value="'. $arr['level2'] . '"></td>';
     							echo '<td><input type="text" class="struct" value="' . $arr['format'] . '"></td>';
     							echo '</tr>';
     						}
    					?>
    				</table>
    				<br/>
    
    				<button type="button" onClick="addPath();" class="w3-btn w3-round-large w3-grey w3-medium">Add<i class="w3-margin-left material-icons">add_box</i></button>
    				<button type="button" onClick="showdelete('pathTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete<i class="w3-margin-left material-icons">delete</i></button>
    				<br/><br/>
    		    </div>

		    	<button type="button" class="accordion" onclick="openpanel();">Source data path on Drive</button>

    		    <div class="panel container-fuild">
					<br/>
    				<p>Location(path) of each study:</p>
    				<table id="libTable" border="5" cellpadding="5" cellspacing="5" style="width:85%; background-color:#ffffff; border-collapse:collapse; border:1px solid #808B96;">
                        <tbody>
                            <tr>
                            	<th style='width:30px;'></th>
                            	<th style='width:150px;'>Path Name</th>
                            	<th style='width:800px;'>Dataset Location</th>				
                            </tr>
                        </tbody>
    					<?php
     					   foreach($pkms_path as $arr) {
     							echo '<tr>';
     							echo '<td><input type="checkbox"  class="checkboxc"/>&nbsp;</td>';
     							echo '<td><input type="text" class="struct" value="' . $arr['libname'] . '"></td>';
     							echo '<td><input type="text" class="struct" value="' . $arr['libpath'] . '"></td>';
     							echo '</tr>';
     					   }
    					?>				  
    				</table>
    				<br/>
    				
    	 			<button type="button" onClick="addLib();" class="w3-btn w3-round-large w3-grey w3-medium">Add<i class="w3-margin-left material-icons">add_box</i></button>
    				<button type="button" onClick="showdelete('libTable');" class="w3-btn w3-round-large w3-grey w3-medium">Delete<i class="w3-margin-left material-icons">delete</i></button>
    				<br/><br/>

    		    </div>

		    	<button type="button" class="accordion" onclick="openpanel();">Location of the analysis dataset development directory</button>

    		    <div class="panel container-fuild">
					<br/>
    			    <p><b>Program development path: <input name="dataset_dev_path" type="text" size="80" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> value="<?php  echo htmlspecialchars($dataset_dev_path);?>"></b></p>
    	            <p><b>Program QC path: <input name="dataset_qc_path" type="text" <?php if($existmodifying == 'inprocess'){ echo 'readonly="readonly"';} ?> size="80" value="<?php  echo htmlspecialchars($dataset_qc_path);?>"></b></p>
    		    </div>	
    
    		    <button type="button" class="accordion" onclick="openpanel();">Dataset Requirements and Specifications</button>

    		    <div class="panel container-fuild">
					<br/>
    				<p><b>This section specifies overall requirements for datasets: names, dataset labels, and other requirements for a data set as a whole. The next section contains variable-by-variable specifications.</b></p>
    				<p><b>Together, these sections detail all requirements, and supersede any previous discussions and agreements concerning these datasets.</b></p>
    				<button type="button" onclick="getvalues();" class="w3-btn w3-round-large w3-grey w3-medium">Click to view the result</button>
    				<br/><br/>

    				<table border="5" cellpadding="5" cellspacing="5" style="width:85%; background-color:#ffffff; border-collapse:collapse; border:1px solid #808B96;">
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
        			<table id="myTable" name="myTable" border="5" cellpadding="5" cellspacing="5" style="width:100%; background-color:#ffffff; border-collapse:collapse; border: 0px solid #808B96;">
        				<thead class="fixdHeader">
        				    <tr>
            				  <th style="width:30px;"></th>
                                <th style="width:61px;">#</th>
                                <th style="width: 100%;" hidden>Required</th>
                                <th style="width: 100%;" hidden>nameChange</th>
                                <th style="width: 100%;" hidden>labelChange</th>
                                <th style="width: 100%;" hidden>unitChange</th>
                                <th style="width: 100%;" hidden>typeChange</th>
                                <th style="width: 100%;" hidden>roundChange</th>
                                <th style="width: 100%;" hidden>missValChange</th>
                                <th style="width: 100%;" hidden>noteChange</th>
                                <th style="width: 100%;" hidden>sourceChange</th>
                                <th style="width: 111px;">Variable Name</th>
                                <th style="width: 279px;">Variable Label</th>
                                <th style="width: 93px;">Units</th>
                                <th style="width: 93px;">Type</th>
                                <th style="width: 93px;">Rounding</th>
                                <th style="width: 93px;">Missing Value</th>
                                <th style="width: 270px;">Notes</th>
                                <th style="width: 255px;">Source</th>
        				    </tr>
        				</thead>

        				<tbody class="scrollContent">
            				<?php
							$i = 0;
                                $dataset_structure_value = [];
             					foreach($dataset_structure as $k => $arr) {
                                    //print_r($arr);exit;
                                    $dataset_structure_value[] = $arr['var_name'];
             						echo "<tr>";

             						echo "<td style='width:30px;'><input type='checkbox'  class='checkboxc' />&nbsp;</td>";
        
             						## variable number
             						echo '<td style="width:70px;"><input type="text" class="struct" value="' .str_pad($k, 3, '0', STR_PAD_LEFT). '" readonly /></td>';
        						
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
        				

        					if($user_spec['type'] == 'Blank Template')
        					{
                                if($existmodifying == 'inprocess')
                                {
                                    $readonlyvariablename = 'readonly';
                                }
                                else
                                {
                                    $readonlyvariablename = '';
                                }

        						//name
                                echo '<td style="width:130px;"><input type="text" class="struct" ' . $readonlymissingval . ' maxlength="8" value="' . $arr['var_name'] . '" style="text-transform:uppercase" ' . ($arr['nameChange'] == 0? '':'') . ' /></td>';

             						// echo '<td style="width:130px;"><input type="text" class="struct" maxlength="8" value="' . $arr['var_name'] . '" style="text-transform:uppercase" ' . ($arr['nameChange'] == 0? '':'') . ' /></td>';
             						//label
             						echo '<td style="width:340px;"><input type="text" class="struct" maxlength="40" value="' . $arr['var_label'] . '" ' . ($arr['labelChange'] == 0? '':'') . ' /></td>';
             						//unit
             						echo '<td style="width:108px;"><input type="text" class="struct" value="' . $arr['var_units'] . '" ' . ($arr['unitChange'] == 0? '':'') . ' /></td>';
                     			    //type
         						echo '<td style="width:108px;"><select class="struct" ' . ($arr['typeChange'] == 0? '':'') . '>';
         						$row = array('Char','Num');
         						$selected = $arr['var_type'] ;
         						$i = 0;
         						while ($i < count($row)){
         							echo "<option value='". $row[$i] ."' ".($row[$i]==$selected?'selected="selected"':"").">". $row[$i]."</option>";
         							$i++;
         						}
         						echo '</select></td>';
         						//round
                                //print_r($arr['roundChange'] );
         						echo '<td style="width:108px;"><select class="struct" '. ($arr['roundChange'] == 0 ? '':'') . '>';
         						$row = array('NA', '0.1', '0.01', '0.001', '1', '3 significant digits', '4 significant digits');
         						$selected = $arr['var_rounding'] ;
         						$i = 0;
         						while ($i < count($row)){
         							echo "<option value='". $row[$i] ."'".($row[$i]==$selected?' selected="selected"':"").">". $row[$i]."</option>";
         							$i++;
         						}
         						echo '</select></td>';

                                if($existmodifying == 'inprocess')
                                {
                                    $readonlymissingval = 'readonly';
                                }
                                else
                                {
                                    $readonlymissingval = '';
                                }

                                echo '<td style="width:108px;"><input type="text" class="struct" value="' . $arr['var_missing_value'] . '" ' . $readonlymissingval . ' /></td>';
                                //note
                                echo '<td style="width:325px;"><textarea class="struct" ' . $readonlymissingval . ' >'.htmlspecialchars($arr['var_notes']).'</textarea></td>';
                                //source
                                echo '<td style="width:310px;"><textarea class="struct" ' . $readonlymissingval . ' >'. htmlspecialchars($arr['var_source']) .'</textarea></td>';


         						// //miss value
         						// echo '<td style="width:108px;"><input type="text" class="struct" value="' . $arr['var_missing_value'] . '" ' . ($arr['missValChange'] == 0? '':'') . ' /></td>';
         						// //note
         						// echo '<td style="width:325px;"><textarea class="struct" ' . ($arr['noteChange'] == 0 ? '':'') . ' >'.htmlspecialchars($arr['var_notes']).'</textarea></td>';
         						// //source
         						// echo '<td style="width:310px;"><textarea class="struct" ' . ($arr['sourceChange'] == 0? '':'') . ' >'. htmlspecialchars($arr['var_source']) .'</textarea></td>';
        					}
        					else
        					{
                                if($arr['nameChange'] == 0)
                                {
                                    $readonlyvariablename = 'readonly';
                                }
                                elseif($existmodifying == 'inprocess')
                                {
                                    $readonlyvariablename = 'readonly';
                                }
                                else
                                {
                                    $readonlyvariablename = '';
                                }

                                echo '<td style="width:130px;"><input type="text" class="struct" maxlength="8" value="' . $arr['var_name'] . '" style="text-transform:uppercase" ' . $readonlyvariablename . ' /></td>';

        						//name
             						// echo '<td style="width:130px;"><input type="text" class="struct" maxlength="8" value="' . $arr['var_name'] . '" style="text-transform:uppercase" ' . ($arr['nameChange'] == 0? 'readonly':'') . ' /></td>';

                                if($arr['labelChange'] == 0)
                                {
                                    $readonlyvariablelabel = 'readonly';
                                }
                                elseif($existmodifying == 'inprocess')
                                {
                                    $readonlyvariablelabel = 'readonly';
                                }
                                else
                                {
                                    $readonlyvariablelabel = '';
                                }

                                echo '<td style="width:340px;"><input type="text" class="struct" maxlength="40" value="' . $arr['var_label'] . '" ' . $readonlyvariablelabel . ' /></td>';
             						//label
             						// echo '<td style="width:340px;"><input type="text" class="struct" maxlength="40" value="' . $arr['var_label'] . '" ' . ($arr['labelChange'] == 0? 'readonly':'') . ' /></td>';

                                if($arr['unitChange'] == 0)
                                {
                                    $readonlyvariableunit = 'readonly';
                                }
                                elseif($existmodifying == 'inprocess')
                                {
                                    $readonlyvariableunit = 'readonly';
                                }
                                else
                                {
                                    $readonlyvariableunit = '';
                                }

                                    echo '<td style="width:108px;"><input type="text" class="struct" value="' . $arr['var_units'] . '" ' . $readonlyvariableunit . ' /></td>';

             						//unit
             						// echo '<td style="width:108px;"><input type="text" class="struct" value="' . $arr['var_units'] . '" ' . ($arr['unitChange'] == 0? 'readonly':'') . ' /></td>';
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

                                if($arr['roundChange'] == 0)
                                {
                                    $readonlyvariableround = 'disabled';
                                }
                                elseif($existmodifying == 'inprocess')
                                {
                                    $readonlyvariableround = 'disabled';
                                }
                                else
                                {
                                    $readonlyvariableround = '';
                                }

                                echo '<td style="width:108px;"><select class="struct" ' . $readonlyvariableround . '>';

         						//round
                         
         						// echo '<td style="width:108px;"><select class="struct" '. ($arr['roundChange'] == 0 ? 'disabled':'') . '>';

         						$row = array('NA', '0.1', '0.01', '0.001', '1', '3 significant digits', '4 significant digits');
         						$selected = $arr['var_rounding'] ;
         						$i = 0;
         						while ($i < count($row)){
         							echo "<option value='". $row[$i] ."'".($row[$i]==$selected?' selected="selected"':"").">". $row[$i]."</option>";
         							$i++;
         						}
         						echo '</select></td>';

                                if($arr['missValChange'] == 0)
                                {
                                    $readonlymissingval = 'readonly';
                                }
                                elseif($existmodifying == 'inprocess')
                                {
                                    $readonlymissingval = 'readonly';
                                }
                                else
                                {
                                    $readonlymissingval = '';
                                }


                                echo '<td style="width:108px;"><input type="text" class="struct" value="' . $arr['var_missing_value'] . '" ' . $readonlymissingval . ' /></td>';

         						//miss value
         						// echo '<td style="width:108px;"><input type="text" class="struct" value="' . $arr['var_missing_value'] . '" ' . ($arr['missValChange'] == 0? 'readonly':'') . ' /></td>';

                                if($arr['noteChange'] == 0)
                                {
                                    $readonlynotes = 'readonly';
                                }
                                elseif($existmodifying == 'inprocess')
                                {
                                    $readonlynotes = 'readonly';
                                }
                                else
                                {
                                    $readonlynotes = '';
                                }

                                echo '<td style="width:325px;"><textarea class="struct" ' . $readonlynotes . ' >'.htmlspecialchars($arr['var_notes']).'</textarea></td>';

         						//note
         						// echo '<td style="width:325px;"><textarea class="struct" ' . ($arr['noteChange'] == 0 ? 'readonly':'') . ' >'.htmlspecialchars($arr['var_notes']).'</textarea></td>';

                                if($arr['sourceChange'] == 0)
                                {
                                    $readonlysource = 'readonly';
                                }
                                elseif($existmodifying == 'inprocess')
                                {
                                    $readonlysource = 'readonly';
                                }
                                else
                                {
                                    $readonlysource = '';
                                }

                                echo '<td style="width:310px;"><textarea class="struct" ' . $readonlysource . ' >'. htmlspecialchars($arr['var_source']) .'</textarea></td>';

         						//source
         						// echo '<td style="width:310px;"><textarea class="struct" ' . ($arr['sourceChange'] == 0? 'readonly':'') . ' >'. htmlspecialchars($arr['var_source']) .'</textarea></td>';
        					}	
        						
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
			<br/>

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
     					echo "<td><input type='checkbox' class='checkboxc' onchange='handleClick(this);'  id=".$arr['var_name'] .">&nbsp;</td>";
     					echo '<td class="varname">' . $arr['var_name'] . '</td>';
     					echo '<td>' . $arr['var_label'] . '</td>';
     					echo '<td>' . $units . '</td>';
     					echo '<td>' . $arr['type'] . '</td>';
     					echo '<td>' . $arr['round'] . '</td>';
     					echo '<td>' . $arr['missVal'] . '</td>';

                        if($arr['note'] == 0)
                        {
                            $readonlynotes1 = 'readonly';
                        }
                        elseif($existmodifying == 'inprocess')
                        {
                            $readonlynotes1 = 'readonly';
                        }
                        else
                        {
                            $readonlynotes1 = '';
                        }

                        echo '<td style="width:325px;"><textarea class="struct" ' . $readonlynotes1 . ' >'.htmlspecialchars($arr['note']).'</textarea></td>';

     					//echo '<td style="width:325px;"><textarea class="struct" ' . ($arr['note'] == 0 ? 'readonly':'') . ' >'.htmlspecialchars($arr['note']).'</textarea></td>';
     					// echo '<td>' . $arr['note'] . '</td>';

                        if($arr['source'] == 0)
                        {
                            $readonlysource1 = 'readonly';
                        }
                        elseif($existmodifying == 'inprocess')
                        {
                            $readonlysource1 = 'readonly';
                        }
                        else
                        {
                            $readonlysource1 = '';
                        }

                         echo '<td style="width:325px;"><textarea class="struct" ' . $readonlysource1 . ' >'.htmlspecialchars($arr['source']).'</textarea></td>';

     					// echo '<td>' . $arr['source'] . '</td>';
     					echo "</tr>";
 				    }
                }

				echo '</tbody></table> 	';	
				echo '<br/>';
				// echo '<p><button type="button" onClick="addOptional();" class="w3-btn w3-round-large w3-grey w3-medium">Add optional variable<i class="w3-margin-left material-icons">add_box</i></button></p>';
				echo '</div>';
			?>
	
		<br/><br/>			

		</div>

		<div id="Derivations" class="tabcontent">
	 		<button type="button" class="accordion" onclick="openpanel();">Derivations</button>
	        <div class="panel container-fuild">
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
                        if($existmodifying == 'inprocess')
                        {
                            $readonlyalgo = 'readonly';
                        }
                        else
                        {
                            $readonlyalgo = '';
                        }

                        foreach($derivations as $arr) {
                            echo '<tr>';
                            echo '<td><input type="checkbox"  class="checkboxc" />&nbsp;</td>';
                            echo '<td><input type="text" class="struct" '.$readonlyalgo.' value="' . $arr['field'] . '" /></td>';
                            echo '<td><textarea '.$readonlyalgo.' class="struct">' . htmlspecialchars($arr['algorithm']) . '</textarea></td>';
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
				<p>This section describes the handling of missing data and any imputation of missing data to be performed.</p>
				<br/>
				<p><span id="missingtext" name="missingtext"><?php  echo htmlspecialchars($missing_outlier['missing']) ?></span></p>
				<br/>
				<textarea id="missingadd" name="missingadd"> </textarea>
				<br/><br/>
				<button type="button" onClick="addText('missingadd', 'missingtext');" class="w3-btn w3-round-large w3-grey w3-medium">Edit description<i class="w3-margin-left material-icons">note_add</i></button>
				<br/><br/>
			</div>

			<button type="button" class="accordion" onclick="openpanel();">Programming Algorithms and Imputations</button>
	        <div class="panel">
				<br/>
				<p>This section provides the algorithms and imputation rules for the creation of analysis datasets, such as dosing or concomitant medications.</p>

				<button type="button" onClick="window.open('<?php echo base_url('home/create/flagcheck'); ?>');" class="w3-btn w3-round-large w3-grey w3-medium">Check all existing flags</button> <br /><br />

				<table id="flagTable" border="5" cellpadding="5" cellspacing="5" style="width:50%; background-color:#ffffff; border-collapse:collapse; border:2px solid #808B96;">
					<tbody>
						<tr>
							<th style="width: 30px;"></th>
							<th style="width: 60px;">Flag #</th>
							<th style="width: 400px;">Flag comment</th>
							<th style="width: 800px;">Flag description</th>
							<th style="width: 100px;" hidden>Required</th>
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


                            if($arr['required'] == 1)
                            {
                                $requiredflag = 'readonly';
                            }
                            elseif($existmodifying == 'inprocess')
                            {
                                $requiredflag = 'readonly';
                            }
                            else
                            {
                                $requiredflag = '';
                            }

                            echo '<td><textarea class="struct" ' . $requiredflag . ' >' . htmlspecialchars($arr['flag_comment']) . '</textarea></td>';

 							//echo '<td><textarea class="struct" ' . ($arr['required'] == 1? 'readonly':'') . ' >' . htmlspecialchars($arr['flag_comment']) . '</textarea></td>';

                            if($existmodifying == 'inprocess')
                            {
                                $requiredcomment = 'readonly';
                            }
                            else
                            {
                                $requiredcomment = '';
                            }

 							//echo '<td><textarea class="struct" >' . htmlspecialchars($arr['flag_notes']) . '</textarea></td>';
                            echo '<td><textarea '.$requiredcomment.' class="struct" >' . htmlspecialchars($arr['flag_notes']) . '</textarea></td>';

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
			<h4>Saved Confirmations</h4>		
			<table id="confirmTableshow" border="5" cellpadding="5" cellspacing="5" style="width:50%; background-color:#ffffff; border-collapse:collapse; border:2px solid #808B96;">
			<tbody>
				<tr>
					<th style="width: 30px;"></th>
					<th style="width: 400px;">Confirmed item</th>
					<th style="width: 400px;">Documents</th>
				</tr>
			</tbody>
			<?php
 				foreach ($files as $arr) {
 					echo '<tr>';
 					echo "<td><input type='checkbox' class='checkboxc' disabled />&nbsp;</td>";
 					echo '<td>'. $arr['confirmed'] . '</td>';
 					echo '<td>'. $arr['name'] . '</td>';
 					echo '</tr>';
 				}
			?>
			</table>
			<br/>
			
			<h4>New Confirmations</h4>	
			<table id="confirmTable" border="5" cellpadding="5" cellspacing="5" style="width:50%; background-color:#ffffff; border-collapse:collapse; border:2px solid #808B96;">
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
	<input type="hidden" name="existmodifying" id="existmodifying" value="<?php echo $existmodifying; ?>">

	<br/>
	<center>
		<input id="saveprogress" class="button" type="submit" value="Save Progress" name="submitform" onclick="displaytext();" />

		<input id="specsubmit" class="button" type="submit" value="Submit" name="submitform" onclick="displaytext();" />
		<a title="Click to discard changes" class = "button" id="discardchange" href="<?php echo base_url().'home/discardchange/'.$spec_id; ?>"> Discard Change
			<!-- <input style="background-color:#7b93ab !important;" disabled="disabled" id="specsubmit" class="button" type="submit" value="Discard Changes" /> -->
		</a>
		<div id="viewmode" style="display:none;"> <b>You are in View Only Mode!</b></div>
	</form>

	<!-- <form method="post" action="#" target="_blank">
		<input id="spec_idd" name="spec_idd" type="hidden" size="80" value="<?php  echo htmlspecialchars($spec_id); ?>" readonly/>
		<input class="button" type="submit" value="Discard Change" name="discardchange" />
	</center> -->

	
	<script>
		$(document).ready(function() 
		{
			var existmodifying = document.getElementById("existmodifying").value;
            if(existmodifying == 'otherusing')
            {
                document.getElementById("viewmode").style.display = 'block';
                document.getElementById("discardchange").style.display = 'none';
                document.getElementById("specsubmit").style.display = 'none';
                document.getElementById("saveprogress").style.display = 'none';

                var lockedby = '<?php echo $lockedby; ?>';
                var msg =  'You wont be able to make any changes as this specification is currently being modified by: ';
                var lockedmsg = msg + lockedby;
                alert(lockedmsg);


                var spec_id_change = document.getElementById("spec_id").value;
                var version = document.getElementById("version_id").value;
                var url ="<?php echo base_url(); ?>home/viewonlyspec/"+spec_id_change+"/"+version;

                window.location = url;  
            }
            else
            {
                var existmodifying = document.getElementById("existmodifying").value;
                if(existmodifying == 'inprocess')
                {
                    // document.getElementById("specsubmit").disabled = true;
                    document.getElementById("viewmode").style.display = 'block';
                    document.getElementById("discardchange").style.display = 'none';
                    document.getElementById("specsubmit").style.display = 'none';
                    document.getElementById("saveprogress").style.display = 'none';

                    var lockedspecids = '<?php echo $lockedspecids; ?>';
                    var msg =  'You have reached maximum limit (3) of specifications you can modify. Please submit one of the previous specifications to proceed. These specifications are: ';
                    var lockedmsg = msg + lockedspecids;
                    alert(lockedmsg);

                    //alert('A specification is currently being modified by you. Please submit the previous specification to proceed.');
                }
                else if(existmodifying == 'otherusing')
                {
                    // document.getElementById("specsubmit").disabled = true;
                    document.getElementById("viewmode").style.display = 'block';
                    document.getElementById("discardchange").style.display = 'none';
                    document.getElementById("specsubmit").style.display = 'none';
                    document.getElementById("saveprogress").style.display = 'none';

                    alert('Current specification modifying other user please wait until they will finish it!');
                }
                else
                {
                    if (confirm('To modify this specification, click on OK. Click on Cancel to view the specification')) 
                    {
                        var existmodifying = document.getElementById("existmodifying").value;
                        if(existmodifying == 'inprocess')
                        {
                            document.getElementById("viewmode").style.display = 'block';
                            document.getElementById("discardchange").style.display = 'none';
                            document.getElementById("specsubmit").style.display = 'none';
                            document.getElementById("saveprogress").style.display = 'none';

                            alert('A specification is currently being modified by you. Please submit the previous specification to proceed.');
                        }
                        else if(existmodifying == 'otherusing')
                        {
                            document.getElementById("viewmode").style.display = 'block';
                            document.getElementById("discardchange").style.display = 'none';
                            document.getElementById("specsubmit").style.display = 'none';
                            document.getElementById("saveprogress").style.display = 'none';

                            alert('Current specification modifying other user please wait until they will finish it!');
                        }
                        else
                        {
                            var spec_id_change = document.getElementById("spec_id").value;
                            var version = document.getElementById("version_id").value;

                            $.ajax({
                                url: "<?php echo base_url(); ?>home/lockspec/"+spec_id_change+"/"+version,
                                type: "post",
                                data: {spec_id: +encodeURIComponent(spec_id_change), version: +version},
                                success: function (response) 
                                {
                                    //alert('This specification is now locked for you.');
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                   console.log(textStatus, errorThrown);
                                }
                            });
                        }
                    } else 
                    {
                        var spec_id_change = document.getElementById("spec_id").value;
                        var version = document.getElementById("version_id").value;
                        var url ="<?php echo base_url(); ?>home/viewonlyspec/"+spec_id_change+"/"+version;

                        // alert(url);

                        window.location = url;                       

                        document.getElementById("viewmode").style.display = 'block';
                        document.getElementById("discardchange").style.display = 'none';
                        document.getElementById("specsubmit").style.display = 'none';
                        document.getElementById("saveprogress").style.display = 'none';
                    }
                }
            }
			// if(existmodifying == 'otherusing')
			// {
			// 	document.getElementById("viewmode").style.display = 'block';
			// 	document.getElementById("discardchange").style.display = 'none';
			// 	document.getElementById("specsubmit").style.display = 'none';
			// 	document.getElementById("saveprogress").style.display = 'none';

			// 	var lockedby = '<?php echo $lockedby; ?>';
			// 	var msg =  'You wont be able to make any changes as this specification is currently being modified by: ';
			// 	var lockedmsg = msg + lockedby;
			// 	alert(lockedmsg);
			// }
			// else
			// {
			// 	var existmodifying = document.getElementById("existmodifying").value;
			// 	if(existmodifying == 'inprocess')
			// 	{
   //                  document.getElementById("viewmode").style.display = 'block';
   //                  document.getElementById("discardchange").style.display = 'none';
   //                  document.getElementById("specsubmit").style.display = 'none';
   //                  document.getElementById("saveprogress").style.display = 'none';

   //                  var lockedspecids = '<?php echo $lockedspecids; ?>';
   //                  var msg =  'You have reached maximum limit (3) of specifications you can modify. Please submit one of the previous specifications to proceed. These specifications are: ';
   //                  var lockedmsg = msg + lockedspecids;
   //                  alert(lockedmsg);
			// 	}
			// 	else if(existmodifying == 'otherusing')
			// 	{
			// 		// document.getElementById("specsubmit").disabled = true;
			// 		document.getElementById("viewmode").style.display = 'block';
			// 		document.getElementById("discardchange").style.display = 'none';
			// 		document.getElementById("specsubmit").style.display = 'none';
			// 		document.getElementById("saveprogress").style.display = 'none';

			// 		alert('Current specification modifying other user please wait until they will finish it!');
			// 	}
			// 	else
			// 	{
			// 		if (confirm('To modify this specification, click on OK. Click on Cancel to view the specification')) 
			// 		{
			// 			var existmodifying = document.getElementById("existmodifying").value;
			// 			if(existmodifying == 'inprocess')
			// 			{
			// 				document.getElementById("viewmode").style.display = 'block';
			// 				document.getElementById("discardchange").style.display = 'none';
			// 				document.getElementById("specsubmit").style.display = 'none';
			// 				document.getElementById("saveprogress").style.display = 'none';

			// 				alert('A specification is currently being modified by you. Please submit the previous specification to proceed.');
			// 			}
			// 			else if(existmodifying == 'otherusing')
			// 			{
			// 				document.getElementById("viewmode").style.display = 'block';
			// 				document.getElementById("discardchange").style.display = 'none';
			// 				document.getElementById("specsubmit").style.display = 'none';
			// 				document.getElementById("saveprogress").style.display = 'none';

			// 				alert('Current specification modifying other user please wait until they will finish it!');
			// 			}
			// 			else
			// 			{
			// 				var spec_id_change = document.getElementById("spec_id").value;
			// 				var version = document.getElementById("version_id").value;

			// 				$.ajax({
			// 			        url: "<?php echo base_url(); ?>home/lockspec/"+spec_id_change+"/"+version,
			// 			        type: "post",
			// 			        data: {spec_id: +encodeURIComponent(spec_id_change), version: +version},
			// 			        success: function (response) 
			// 			        {
			// 			        	//alert('This specification is now locked for you.');
			// 			        },
			// 			        error: function(jqXHR, textStatus, errorThrown) {
			// 			           console.log(textStatus, errorThrown);
			// 			        }
			// 			    });
			// 			}
			// 		} else 
			// 		{
			// 			document.getElementById("viewmode").style.display = 'block';
			// 			document.getElementById("discardchange").style.display = 'none';
			// 			document.getElementById("specsubmit").style.display = 'none';
			// 			document.getElementById("saveprogress").style.display = 'none';

			// 			//alert('You can only view this spec!');
			// 		}
			// 	}
			// }

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


    // function handleClick(cb) 
    // {
    //     var spec_type = document.getElementById("spec_type");

    //     var select_value =  cb.id;

    //     if(select_value == "TTYPEF") {
    //         document.getElementById("TTYPEN").checked = true;    
    //     }
    //     if(select_value == "TTYPEN") {
    //         document.getElementById("TTYPEF").checked = true;    
    //     }
        


    //     if((select_value == "SEX")) {
    //          document.getElementById("SEXN").checked = true;
    //     }
    //     if(select_value == "SEXN") {
    //         document.getElementById("SEX").checked = true;   
    //     }
           


    //     if(select_value == "RACE") {
    //          document.getElementById("RACEN").checked = true;
    //     }
    //     if(select_value == "RACEN") {
    //          document.getElementById("RACE").checked = true;
    //     }
        

    //     if(select_value == "HEPA") {
    //          document.getElementById("HEPAN").checked = true;
    //     }
    //     if(select_value == "HEPAN") {
    //          document.getElementById("HEPA").checked = true;
    //     }
            

    //     if(select_value == "ETHC") {
    //          document.getElementById("ETHCN").checked = true;
    //     }
    //     if(select_value == "ETHCN") {
    //          document.getElementById("ETHC").checked = true;
    //     }

    //     if(select_value == "ETHJ") {
    //          document.getElementById("ETHJN").checked = true;
    //     }
    //     if(select_value == "ETHJN") {
    //          document.getElementById("ETHJ").checked = true;
    //     }

    //     if(select_value == "ETH") {
    //          document.getElementById("ETHN").checked = true;
    //     }
    //     if(select_value == "ETHN") {
    //          document.getElementById("ETH").checked = true;
    //     }

    //     if(select_value == "LINEC") {
    //          document.getElementById("LINEN").checked = true;
    //     }
    //     if(select_value == "LINEN") {
    //          document.getElementById("LINEC").checked = true;
    //     }

    //     if(select_value == "BOR") {
    //          document.getElementById("BORN").checked = true;
    //     }
    //     if(select_value == "BORN") {
    //          document.getElementById("BOR").checked = true;
    //     }

    //     if(select_value == "ETIOLOGN") {
    //          document.getElementById("ETIOLOGY").checked = true;
    //     }
    //     if(select_value == "ETIOLOGY") {
    //          document.getElementById("ETIOLOGN").checked = true;
    //     }

    //     if(select_value == "EVID") {
    //          document.getElementById("MDV").checked = true;
    //     }
    //     if(select_value == "MDV") {
    //          document.getElementById("EVID").checked = true;
    //     }

    //     if(select_value == "ADDL") {
    //          document.getElementById("II").checked = true;
    //     }
    //     if(select_value == "II") {
    //          document.getElementById("ADDL").checked = true;
    //     }

    //     if(select_value == "FLAG") {
    //          document.getElementById("FLAGC").checked = true;
    //     }
    //     if(select_value == "FLAGC") {
    //          document.getElementById("FLAG").checked = true;
    //     }

    //     if(select_value == "EXCLF") {
    //          document.getElementById("EXCLFC").checked = true;
    //     }
    //     if(select_value == "EXCLFC") {
    //          document.getElementById("EXCLF").checked = true;
    //     }

    //     if(select_value == "STUDYID") {
    //          document.getElementById("STUDYIDN").checked = true;
    //     }
    //     if(select_value == "STUDYIDN") {
    //          document.getElementById("STUDYID").checked = true;
    //     }

    //     if(select_value == "USUBJID") {
    //          document.getElementById("USUBJIDN").checked = true;
    //     }
    //     if(select_value == "USUBJIDN") {
    //          document.getElementById("USUBJID").checked = true;
    //     }

    //     if(select_value == "DOSEP1") {
    //          document.getElementById("DU1").checked = true;
    //     }
    //     if(select_value == "DU1") {
    //          document.getElementById("DOSEP1").checked = true;
    //     }

    //     if(select_value == "DOSEPSS") {
    //          document.getElementById("DUSS").checked = true;
    //     }
    //     if(select_value == "DUSS") {
    //          document.getElementById("DOSEPSS").checked = true;
    //     }

    //     if(select_value == "FORM") {
    //          document.getElementById("FORMN").checked = true;
    //     }
    //     if(select_value == "FORMN") {
    //          document.getElementById("FORM").checked = true;
    //     }

    //     if(select_value == "PROC") {
    //          document.getElementById("PROCN").checked = true;
    //     }
    //     if(select_value == "PROCN") {
    //          document.getElementById("PROC").checked = true;
    //     }

    //     if(select_value == "ROUTE") {
    //          document.getElementById("ROUTEN").checked = true;
    //     }
    //     if(select_value == "ROUTEN") {
    //          document.getElementById("ROUTE").checked = true;
    //     }

    //     if(select_value == "SUBJTYP") {
    //          document.getElementById("SUBJTYPN").checked = true;
    //     }
    //     if(select_value == "SUBJTYPN") {
    //          document.getElementById("SUBJTYP").checked = true;
    //     }

    //     if(select_value == "ETHNIC") {
    //         document.getElementById("ETHNICN").checked = true;
    //     }
    //     if(select_value == "ETHNICN") {
    //          document.getElementById("ETHNIC").checked = true;
    //     }
        
    //     addOptional();         
    // }

	function handleClick(cb) 
	{
		var spec_type = document.getElementById("spec_type").value;
		var select_value =  cb.id;

		if(select_value == "EVID") {
			 document.getElementById("MDV").checked = true;
		}
		if(select_value == "MDV") {
			 document.getElementById("EVID").checked = true;
		}
		if(select_value == "ADDL") {
			 document.getElementById("II").checked = true;
		}
		if(select_value == "II") {
			 document.getElementById("ADDL").checked = true;
		}
		if(select_value == "FLGREAS") {
			 document.getElementById("FLGREASC").checked = true;
		}
		if(select_value == "FLGREASC") {
			 document.getElementById("FLGREAS").checked = true;
		}

		// New case 
		if(spec_type == 'PPK-CDISC')
		{
			if(select_value == "EXCLF") {
				 document.getElementById("EXCLFCOM").checked = true;
			}
			if(select_value == "EXCLFCOM") {
				 document.getElementById("EXCLF").checked = true;
			}
		}
		else
		{
			if(select_value == "EXCLF") {
				 document.getElementById("EXCLFC").checked = true;
			}
			if(select_value == "EXCLFC") {
				 document.getElementById("EXCLF").checked = true;
			}
		}

		if(spec_type == 'PPK-CDISC')
		{
			if(select_value == "SUBJTYP") {
				 document.getElementById("SUBJTYPC").checked = true;
			}
			if(select_value == "SUBJTYPC") {
				 document.getElementById("SUBJTYP").checked = true;
			}
		}
		else
		{
			if(select_value == "SUBJTYP") {
				 document.getElementById("SUBJTYPN").checked = true;
			}
			if(select_value == "SUBJTYPN") {
				 document.getElementById("SUBJTYP").checked = true;
			}
		}

		// if(select_value == "STUDYID") {
		// 	 document.getElementById("STUDYIDN").checked = true;
		// }
		// if(select_value == "STUDYIDN") {
		// 	 document.getElementById("STUDYID").checked = true;
		// }

		
		// if(select_value == "USUBJID") {
		// 	 document.getElementById("USUBJIDN").checked = true;
		// }
		// if(select_value == "USUBJIDN") {
		// 	 document.getElementById("USUBJID").checked = true;
		// }
		if(select_value == "FORM") {
			 document.getElementById("FORMN").checked = true;
		}
		if(select_value == "FORMN") {
			 document.getElementById("FORM").checked = true;
		}
		if(select_value == "ROUTE") {
			 document.getElementById("ROUTEN").checked = true;
		}
		if(select_value == "ROUTEN") {
			 document.getElementById("ROUTE").checked = true;
		}
		

		if(select_value == "AETHNIC") {
			 document.getElementById("AETHNICN").checked = true;
		}
		if(select_value == "AETHNICN") {
			 document.getElementById("AETHNIC").checked = true;
		}
		if(select_value == "HEPA") {
			 document.getElementById("HEPAN").checked = true;
		}
		if(select_value == "HEPAN") {
			 document.getElementById("HEPA").checked = true;
		}	
		if(select_value == "TTYPEF") {
  		document.getElementById("TTYPEN").checked = true; 	 
		}
		if(select_value == "TTYPEN") {
  		document.getElementById("TTYPEF").checked = true; 	 
		}
		if((select_value == "SEX")) {
			 document.getElementById("SEXN").checked = true;
		}
		if(select_value == "SEXN") {
  		document.getElementById("SEX").checked = true; 	 
		}
		if(select_value == "RACE") {
			 document.getElementById("RACEN").checked = true;
		}
		if(select_value == "RACEN") {
			 document.getElementById("RACE").checked = true;
		}

		if(select_value == "ARACE") {
			 document.getElementById("ARACEN").checked = true;
		}
		if(select_value == "ARACEN") {
			 document.getElementById("ARACE").checked = true;
		}

		// below old one
		if(select_value == "ETHNIC") {
		 	document.getElementById("ETHNICN").checked = true;
		}
		if(select_value == "ETHNICN") {
			 document.getElementById("ETHNIC").checked = true;
		}
		if(select_value == "ETHC") {
			 document.getElementById("ETHCN").checked = true;
		}
		if(select_value == "ETHCN") {
			 document.getElementById("ETHC").checked = true;
		}
		if(select_value == "ETHJ") {
			 document.getElementById("ETHJN").checked = true;
		}
		if(select_value == "ETHJN") {
			 document.getElementById("ETHJ").checked = true;
		}
		if(select_value == "ETH") {
			 document.getElementById("ETHN").checked = true;
		}
		if(select_value == "ETHN") {
			 document.getElementById("ETH").checked = true;
		}
		if(select_value == "LINEC") {
			 document.getElementById("LINEN").checked = true;
		}
		if(select_value == "LINEN") {
			 document.getElementById("LINEC").checked = true;
		}
		if(select_value == "BOR") {
			 document.getElementById("BORN").checked = true;
		}
		if(select_value == "BORN") {
			 document.getElementById("BOR").checked = true;
		}
		if(select_value == "ETIOLOGN") {
			 document.getElementById("ETIOLOGY").checked = true;
		}
		if(select_value == "ETIOLOGY") {
			 document.getElementById("ETIOLOGN").checked = true;
		}
		if(select_value == "FLAG") {
			 document.getElementById("FLAGC").checked = true;
		}
		if(select_value == "FLAGC") {
			 document.getElementById("FLAG").checked = true;
		}
		if(select_value == "DOSEP1") {
			 document.getElementById("DU1").checked = true;
		}
		if(select_value == "DU1") {
			 document.getElementById("DOSEP1").checked = true;
		}
		if(select_value == "DOSEPSS") {
			 document.getElementById("DUSS").checked = true;
		}
		if(select_value == "DUSS") {
			 document.getElementById("DOSEPSS").checked = true;
		}
		if(select_value == "PROC") {
			 document.getElementById("PROCN").checked = true;
		}
		if(select_value == "PROCN") {
			 document.getElementById("PROC").checked = true;
		}

  		addOptional();
	}
	</script>
	</body>
</html>