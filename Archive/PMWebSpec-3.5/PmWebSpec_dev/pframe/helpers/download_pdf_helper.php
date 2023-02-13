<?php

 //error_reporting(0);
    include_once('tcpdf/config/lang/eng.php');
    include_once('tcpdf/tcpdf.php');

function downlondPdf($data) {

 //create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8', false);

    //set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
    $pdf->SetCreator(PDF_CREATOR);

    // Front page
    $pdf->AddPage('L');
    $pdf->Write(0, 'Pharmacometric Analysis Dataset Specification', '', 0, 'C', true, 0, false, false, 0);

    $html = '
    	<br><br><br><br><br>
    	<h1 align="center">'. $data['title'] . '</h1>
    	<h2 align="center">Project: ' . $data['project_name'] . '</h2>
    	<h3 align="center">Version: ' . $data['version_id'] . '</h3>
    	<h3 align="center">Modification Date: ' . $data['modification_date'] . '</h3>';

    $pdf->writeHTML($html, true, false, false, false, '');

    // Accountable team members
    $pdf->AddPage('L');
    $pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);

    $html = '
    	<h4><b>Accountable Team Members:</b></h4>
    	<table id=team_table border="1" cellspacing="0" cellpadding="2">
    		<tr nobr="true">
    			<th style="width: 40%;">Role/Department</th>
    			<th style="width: 30%;">Designee</th>
    			<th style="width: 30%;">Accountable for Section</th>
    		</tr>
    
    		<tr nobr="true">
    			<td>PK Scientist</td>
    			<td>' . $data['pk_scientist'] . '</td>
    			<td>2.1</td>
    		</tr>
    
    		<tr nobr="true">
    			<td>Pharmacometric Scientist</td>
    			<td>' . $data['pm_scientist'] . '</td>
    			<td>1, 2, 3, 4</td>
    		</tr>
    		
    		<tr nobr="true">
    			<td>Statistician and/or Programmer</td>
    			<td>' . $data['statistician'] . '</td>
    			<td>2.2</td>
    		</tr>
    		
    		<tr nobr="true">
    			<td>Programmer</td>
    			<td>' . $data['ds_programmer'] . '</td>
    			<td>2.4, 2.5, 4.4</td>
    		</tr>
	   </table>';

    $pdf->writeHTML($html, true, false, false, false, '');
 $pdf->AddPage('L');
    $html_header = '
   
    	<h4><b>Request Revision History:</b></h4>
    	<table id=history_table border="1" cellspacing="0" cellpadding="2">
    		<tr nobr="true">
    			<th style="width: 10%;">Version </th>
    			<th style="width: 15%;">Date </th>
    			<th style="width: 15%;">Revised by </th>
    			<th style="width: 60%;">Changes Made </th>
    		</tr>';

    $html = '';

	foreach($data['spec_general'] as $arr) {
		$html .= '<tr nobr="true">
			<td>' . $arr['version_id'] . '</td>
			<td>' . $arr['modification_date'] . '</td>
			<td>' . $arr['revised_by'] . '</td>
			<td>' . htmlspecialchars($arr['changes_made']) . '</td>
			</tr>';
	}

    $html_footer = '</table>';

    $pdf->writeHTML($html_header . $html . $html_footer, true, false, false, false, '');

    // Dataset specification
    $pdf->AddPage('L');
    $pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);

    $html_header = '
    	<h2>1. Purpose</h2>
    	<p>The purpose of this document is to specify the scope and content of the following Pharmacometric analysis dataset(s): </p>

    	<table id=dataset_info border="1" cellspacing="0" cellpadding="2">
    		<tr nobr="true">
    			<th style="width: 15%;">Dataset Name </th>
    			<th style="width: 25%;">Dataset Descriptor </th>
    			<th style="width: 48%;">Location (path) </th>
    			<th style="width: 12%;">Delivery Date </th>
    		</tr>

    		<tr nobr="true">
    			<td>' . $data['dataset_name'] . '</td>
    			<td>' . htmlspecialchars($data['dataset_description']) . '</td>
    			<td>' . $data['dataset_path'] . '</td>
    			<td>' . $data['dataset_due_date'] . '</td>
    		</tr>
    	</table>

	<br/><br/>

	<p>Specification of the scope and content of the above datasets includes specification of:</p>
	<p>Studies from which data are to be obtained, and the location of the source data (Section 2)</p>
	<p>Dataset structure and variables (Section 3)</p>
	<p>Derivations and handling of missing data (Section 4)</p>

	<br/><br/>';

$pdf->writeHTML($html_header, true, false, false, false, '');

//PK data source
$pdf->AddPage('L');
$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);

$html1 = '
	<h2>2. Study Description</h2>
	<h3>2.1 PK data sources</h3>
	<table border="1" cellspacing="0" cellpadding="2">
		<tr nobr="true">
			<th style="width: 35%;">Study</th>
			<th style="width: 35%;">Study Type</th>
			<th style="width: 30%;">Lock Type</th>
		</tr>';

$html2 = '';

	foreach($data['pk_data'] as $arr) {
		$html2 .= '<tr nobr="true">
			<td>' . $arr['study'] . '</td>
			<td>' . $arr['study_type'] . '</td>
			<td>' . $arr['lock_type'] . '</td>
			</tr>';
	}

$html3 = '</table>

	<br /><br />

	<h3>2.2 Source data path for clinical, safety, efficacy and biomarker data</h3>
	<table border="1" cellspacing="0" cellpadding="2">
		<tr nobr="true">
			<th style="width: 10%;">Study</th>
			<th style="width: 10%;">Statistician</th>
			<th style="width: 20%;">Raw</th>
			<th style="width: 20%;">SDTM</th>
			<th style="width: 20%;">ADaM</th>
			<th style="width: 20%;">Other</th>
		</tr>';

$html4 = '';

	foreach($data['clinical_data'] as $arr) {
		$html4 .= '<tr nobr="true">
			<td>' . $arr['study'] . '</td>
			<td>' . $arr['statistician'] . '</td>
			<td>' . $arr['level0'] . '</td>
			<td>' . $arr['level1'] . '</td>
			<td>' . $arr['level2'] . '</td>
			<td>' . $arr['format'] . '</td>
			</tr>';
	}

$html5 = '</table>
	<br/><br/>

	<h3>2.3 Clinical data sources</h3>
	<table border="1" cellspacing="0" cellpadding="2">
		<tr nobr="true">
			<th style="width: 25%;">Raw Datasets Path Name</th>
			<th style="width: 75%;">Dataset Location</th>
		</tr>';

$html6 = '';

	foreach($data['pkms_path'] as $arr) {

		$html6 .= '<tr nobr="true">
			<td>' . $arr['libname'] . '</td>
			<td>' . $arr['libpath'] . '</td>
			</tr>';
	}

$html7 = '</table>

	<br/><br/>
	<h3>2.4 Location of the analysis dataset development directory</h3>
	<p>Program development path:</p>
	<p>' . $data['dataset_dev_path'] . '</p>

	<p>Program qc path:</p>
	<p>' . $data['dataset_qc_path'] . '</p>

	<br /><br />
	<h3>2.5 Dataset requirements and Specification</h3>
	<p>This section specifies overall requirements for datasets: names, dataset labels, and other requirements for a data set as a whole.  The next section contains variable-by-variable specifications.</p>
	<p>Together, these sections detail all requirements, and supersede any previous discussions and agreements concerning these datasets.</p>

	<table border="1" cellspacing="0" cellpadding="2">
		<tr nobr="true">
			<th style="width: 12%;">Requirement Number</th>
			<th style="width: 88%;">Requirement/Description</th>
		</tr>

		<tr nobr="true">
			<td>1.01</td>
			<td>The dataset will be named ' . $data['dataset_name'] . '</td>
		</tr>

		<tr nobr="true">
			<td>1.02</td>
			<td>The dataset label will be: ' . $data['dataset_label'] . '</td>
		</tr>

		<tr nobr="true">
			<td>1.03</td>
			<td>The dataset will contain ' . $data['dataset_multiple_record'] . '</td>
		</tr>

		<tr nobr="true">
			<td>1.04</td>
			<td>The dataset will only contain records that meet the following criteria: ' . htmlspecialchars($data['dataset_inclusion']) . '</td>
		</tr>

		<tr nobr="true">
			<td>1.05</td>
			<td>The dataset will conform to the structure and content as defined in section 3, Dataset Structure. </td>
		</tr>

		<tr nobr="true">
			<td>1.06</td>
			<td>Coded data within this dataset, if any, will conform to the format specifications provided in section 3, Controlled Terms or Format Descriptions. For the datasets that need to be imported back into eToolbox the labels will be made same as variable names. Please refer to section 3 for variable labels </td>
		</tr>

		<tr nobr="true">
			<td>1.07</td>
			<td>The dataset will be a SAS dataset. Please provide in both sas7dat and xpt formats. Note: use extension .sas7bdat for SAS datasets, .rdata for R datasets, and .sdata for S-Plus datasets. </td>
		</tr>

		<tr nobr="true">
			<td>1.08</td>
			<td>The dataset will be sorted by the following fields: ' . $data['dataset_sort'] . '</td>
		</tr>
	</table>
';

$pdf->writeHTML($html1 . $html2 . $html3 . $html4 . $html5 . $html6 . $html7, true, false, false, false, '');


//dataset structure table
$pdf->AddPage('L');
$pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);

$html1 = '
	<h2>3. Dataset structure</h2>
	<table border="1" cellspacing="0" cellpadding="2">
		<tr nobr="true" >
			<th style="width: 10%;">Variable Name</th>
			<th style="width: 20%;">Variable Label</th>
			<th style="width: 6%;">Units</th>
			<th style="width: 6%;">Type</th>
			<th style="width: 8%;">Rounding</th>
			<th style="width: 8%;">Missing Value</th>
			<th style="width: 22%;">Notes</th>
			<th style="width: 22%;">Source</th>
		</tr>';

$html2 = '';

    foreach($data['dataset_structure'] as $arr)  {

    	$html2 .= '<tr nobr="true">
			<td>' . htmlspecialchars($arr['var_name']) . '</td>
			<td>' . htmlspecialchars($arr['var_label']) . '</td>
			<td>' . htmlspecialchars($arr['var_units']) . '</td>
			<td>' . htmlspecialchars($arr['var_type']) . '</td>
			<td>' . htmlspecialchars($arr['var_rounding']) . '</td>
			<td>' . htmlspecialchars($arr['var_missing_value']) . '</td>
			<td>' . htmlspecialchars($arr['var_notes']) . '</td>
			<td>' . htmlspecialchars($arr['var_source']) . '</td>
		</tr>';
    }

    $html3 = '</table>';
    $pdf->writeHTML($html1 . $html2 . $html3, true, false, false, false, '');

    //Derivations
    //$pdf->AddPage('L');
    $pdf->Write(0, '', '', 0, 'C', true, 0, false, false, 0);

    $html1 = '
    	<h2>4. Derivations/Outliers/Missing data</h2>
    	<h3>4.1 Derivations</h3>
    	<p>This section provides a list of all derivations and algorithms required for the creation of datasets.</p>
    	<br />

    	<table border="1" cellspacing="0" cellpadding="2">
    		<tr nobr="true">
    			<th style="width: 10%;">Field</th>
    			<th style="width: 90%;">Algorithm</th>
    		</tr>';

    $html2 = '';

    foreach($data['derivations'] as $arr)  {

    	$html2 .= '<tr nobr="true">
			<td>' . htmlspecialchars($arr['field']) . '</td>
			<td>' . htmlspecialchars($arr['algorithm']) . '</td>
		</tr>';
   }

   $pdf->AddPage('L');
   

    $html3 = '</table>
    	<br />
    	<h3>4.2 Handling of missing data</h3>
    	<p>This section describes the handling of missing data and any imputation of missing data to be performed.</p>

        <p>' . htmlspecialchars($data['missings']) . '</p>
    
        <br/>

    	<h3>4.3 Programming Algorithms and Imputations</h3>
    	<p>This section provides the algorithms and imputation rules for the creation of analysis datasets, such as dosing or concomitant medications.</p>
    
    	<table border="1" cellspacing="0" cellpadding="2">
    		<tr nobr="true">
    			<th style="width: 8%;">Flag Number</th>
    			<th style="width: 40%;">FLAGCOM</th>
    			<th style="width: 52%;">Notes</th>
    		</tr> ';

    $html4 = '';

	foreach ($data['flag'] as $arr) {
		//print_r($arr);exit;
    	$html4 .= '<tr nobr="true">
			<td>' . htmlspecialchars($arr['flag_number']) . '</td>
			<td>' . htmlspecialchars($arr['flag_comment']) . '</td>
			<td>' . htmlspecialchars($arr['flag_notes']) . '</td>
		</tr>';
	}

    $html5 = '</table>';

    $pdf->writeHTML($html1 . $html2 . $html3 . $html4 . $html5, true, false, false, false, '');

	$filename = $data['dataset_path'];

	$filename = str_replace(pkms_path, '', $filename);
	$filename = str_replace(pkms_path2, '', $filename);

	$filename = str_replace('/', '_', $filename);
	$specid = str_replace(':', '-', $data['spec_id']);

    ob_end_clean();

    if(!is_dir(pdfspecpath)){
    	mkdir(pdfspecpath, 0755, true);
    }

   $pdf->Output(pdfspecpath.$specid.'_'.$data['dataset_name'].'_v'.$data['version_id'].'_'.'dataset_spec'.'.pdf', 'F');
   $pdf->Output(pdfspecpath.$specid.'_'.$data['dataset_name'].'_v'.$data['version_id'].'_'.'dataset_spec'.'.pdf', 'I');

	$file_name = $specid.'_'.$data['dataset_name'].'_v'.$data['version_id'].'_'.'dataset_spec'.'.pdf';

	$target_path = $data['dataset_path'];
	$source_path = s3_bucket_path;
	$status = "Pending";

	$fileData = [
		'spec_id' => $specid,
		'file_name' => $file_name,
		'source_path' => $source_path,
		'target_path' => $target_path,
		'status' => $status,
	];
	$files_details =& get_instance();
	$files_details->load->model('CIModSpec');
	$files_details->CIModSpec->insert_file("file_transfer", $fileData);
	return 1;
}

?>