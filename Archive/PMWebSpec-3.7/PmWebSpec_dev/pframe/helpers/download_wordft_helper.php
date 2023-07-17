<?php
function downlondDocxft($data)
{

// Load library
    include_once 'HtmlToDoc.class.php';

// Initialize class
    $htd = new HTML_TO_DOC();

    $htmlContent = ' 
     <html
    xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:w="urn:schemas-microsoft-com:office:word"
    xmlns="http://www.w3.org/TR/REC-html40">
    <link href="'.base_url("assets/css/bootstrap.min.css").'" rel="stylesheet" />
    <head>
      
        <!--[if gte mso 9]-->
    <xml>
        <w:WordDocument>
            <w:View>Print</w:View>
            <w:Zoom>90</w:Zoom>
            <w:DoNotOptimizeForBrowser/>
        </w:WordDocument>
    </xml>
    <!-- [endif]-->
    <style>
        p.MsoFooter, li.MsoFooter, div.MsoFooter{
            margin: 0cm;
            margin-bottom: 0001pt;
            mso-pagination:widow-orphan;
            font-size: 12.0 pt;
            text-align: right;
        }


        @page Section1{
            size: 29.7cm 21cm;
            margin: 1cm 1cm 1cm 1cm;
            mso-page-orientation: landscape;
            mso-footer:f1;
        }
        div.Section1 { page:Section1;}
        
       
    </style>
</head>
<div class="Section1">
       
        <br/>
        <h2 align="center" style="font-size:20pt;">Pharmacometric <br/> Analysis Dataset Specification </h2>
        <h1 align="center" style="font-size:18pt;">' . $data['title'] . '</h1>
        <h2 align="center"  style="font-size:18pt;">Project: ' . $data['project_name'] . '</h2>
        <h3 align="center"  style="font-size:16pt;">Document Version: ' . $data['version_id'] . '</h3>
        <h3 align="center"  style="font-size:16pt;">Date: ' . $data['modification_date'] . '</h3>
          
        <br clear=all style="mso-special-character:line-break;page-break-after:always" />
   

        <h4><b>Accountable Team Members:</b></h4>
        <table id=team_table border="1" cellspacing="0" cellpadding="2">
            <tr>
                <th style="width: 30%;">Role/Department</th>
                <th style="width: 20%;">Designee</th>
                <th style="width: 20%;">Accountable for Section</th>
            </tr>
    
            <tr>
                <td style="font-size:13px;">PK Scientist</td>
                <td style="font-size:13px;">' . $data['pk_scientist'] . '</td>
                <td style="font-size:13px;">2.1</td>
            </tr>
    
            <tr>
                <td style="font-size:13px;">Pharmacometric Scientist</td>
                <td style="font-size:13px;">' . $data['pm_scientist'] . '</td>
                <td style="font-size:13px;">1, 2, 3, 4</td>
            </tr>
            
            <tr>
                <td style="font-size:13px;">Statistician and/or Programmer</td>
                <td style="font-size:13px;">' . $data['statistician'] . '</td>
                <td style="font-size:13px;">2.2</td>
            </tr>
            
            <tr>
                <td style="font-size:13px;">Programmer</td>
                <td style="font-size:13px;">' . $data['ds_programmer'] . '</td>
                <td style="font-size:13px;">2.4, 2.5, 4.4</td>
            </tr>
       </table>
        <br/>
        <br/>

    
         <br clear=all style="mso-special-character:line-break;page-break-after:always" />

       <h4><b>Request Revision History:</b></h4>
        <table id=history_table border="1" cellspacing="0" cellpadding="2">
            <tr>
                <th style="width: 10%;">Version </th>
                <th style="width: 15%;">Date </th>
                <th style="width: 15%;">Revised by </th>
                <th style="width: 60%;">Changes Made </th>
            </tr>';
    foreach ($data['spec_general'] as $arr) {
        $htmlContent .= '<tr>
            <td style="font-size:13px;">' . $arr['version_id'] . '</td>
            <td style="font-size:13px;">' . $arr['modification_date'] . '</td>
            <td style="font-size:13px;">' . $arr['revised_by'] . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['changes_made']) . '</td>
            </tr>';
    }

    $htmlContent .= '</table>
      <br clear=all style="mso-special-character:line-break;page-break-after:always" />';

   

    $htmlContent .= '
        <h2>1. Purpose</h2>
        <p>The purpose of this document is to specify the scope and content of the following Pharmacometric analysis dataset: </p>

        <table id=dataset_info border="1" cellspacing="0" cellpadding="2">
            <tr>
                <th style="width: 15%;">Dataset Name </th>
                <th style="width: 25%;">Dataset Descriptor </th>
                <th style="width: 48%;">Location (path) </th>
                <th style="width: 12%;">Delivery Date </th>
            </tr>

            <tr>
                <td style="font-size:13px;">' . $data['dataset_name'] . '</td>
                <td style="font-size:13px;">' . htmlspecialchars($data['dataset_description']) . '</td>
                <td style="font-size:13px;">' . $data['dataset_path'] . '</td>
                <td style="font-size:13px;">' . $data['dataset_due_date'] . '</td>
            </tr>
        </table>

    <br/><br/>

    <p>Specification of the scope and content of the above datasets includes specification of:</p>
    <p>Studies from which data are to be obtained, and the location of the source data (Section 2)</p>
    <p>Dataset structure and variables (Section 3)</p>
    <p>Derivations and handling of missing data (Section 4)</p>

    <br/><br/>  <br clear=all style="mso-special-character:line-break;page-break-after:always" />';

    $htmlContent .= '
    <h2>2. Study Description</h2>
    <p>Brief descriptions of the studies to be included in the analysis dataset are provided below.</p>
    <h3>2.1 PK Data Sources</h3>
    <table border="1" cellspacing="0" cellpadding="2">
        <tr>
            <th style="width: 20%;">Study</th>
            <th style="width: 35%;">Study Type</th>
            <th style="width: 35%;">Lock Type</th>
        </tr>';

    $htmlContent .= '';

    foreach ($data['pk_data'] as $arr) {
        $htmlContent .= '<tr>
            <td style="font-size:13px;">' . $arr['study'] . '</td>
            <td style="font-size:13px;">' . $arr['study_type'] . '</td>
            <td style="font-size:13px;">' . $arr['lock_type'] . '</td>
            </tr>';
    }

    $htmlContent .= '</table>

    <br /><br />
     <br clear=all style="mso-special-character:line-break;page-break-after:always" />
    

    <h3>2.2 Source data path for clinical, safety, efficacy and biomarker data</h3>
    <table border="1">
        <tr>
            <th style="width: 8%;word-wrap: break-word!important;">Study</th>
            <th style="width: 8%;word-wrap: break-word!important;">Statistician</th>
            <th style="width: 18%;word-wrap: break-word!important;">RAW</th>
            <th style="width: 18%;word-wrap: break-word!important;">SDTM</th>
            <th style="width: 18%;word-wrap: break-word!important;">ADaM</th>
            <th style="width: 30%;word-wrap: break-word!important;">Other</th>
        </tr>';

    $htmlContent .= '';

    foreach ($data['clinical_data'] as $arr) {
        $htmlContent .= '<tr>
            <td style="font-size:13px;">' . $arr['study'] . '</td>
            <td style="font-size:13px;">' . $arr['statistician'] . '</td>
            <td style="font-size:13px;">' . $arr['level0'] . '</td>
            <td style="font-size:13px;">' . $arr['level1'] . '</td>
            <td style="font-size:13px;">' . $arr['level2'] . '</td>
            <td style="font-size:13px;">' . $arr['format'] . '</td>
            </tr>';
    }

    $htmlContent .= '</table>
    <br/><br/>

    <h3>2.3 Clinical data sources</h3>
    <table border="1" cellspacing="0" cellpadding="2">
        <tr>
            <th style="width: 25%;">Raw Datasets Path Name</th>
            <th style="width: 75%;">Dataset Location</th>
        </tr>';

    $htmlContent .= '';

    foreach ($data['pkms_path'] as $arr) {

        $htmlContent .= '<tr>
            <td style="font-size:13px;">' . $arr['libname'] . '</td>
            <td style="font-size:13px;">' . $arr['libpath'] . '</td>
            </tr>';
    }

    $htmlContent .= '</table>

    <br/><br/>
    <h3>2.4 Location of the analysis dataset development directory</h3>
    <p>Program development path:</p>
    <p>' . $data['dataset_dev_path'] . '</p>

    <p>Program qc path:</p>
    <p>' . $data['dataset_qc_path'] . '</p>

    <br /><br />
     <br clear=all style="mso-special-character:line-break;page-break-after:always" />
    <h3>2.5 Dataset requirements and Specification</h3>
    <p>This section specifies overall requirements for datasets: names, dataset labels, and other requirements for a data set as a whole.  The next section contains variable-by-variable specifications.</p>
    <p>Together, these sections detail all requirements, and supersede any previous discussions and agreements concerning these datasets.</p>

    <table border="1" cellspacing="0" cellpadding="2">
        <tr>
            <th style="width: 12%;">Requirement Number</th>
            <th style="width: 88%;">Requirement/Description</th>
        </tr>

        <tr>
            <td style="font-size:13px;">1.01</td>
            <td style="font-size:13px;">The dataset will be named ' . $data['dataset_name'] . '</td>
        </tr>

        <tr>
            <td style="font-size:13px;">1.02</td>
            <td style="font-size:13px;">The dataset label will be: ' . $data['dataset_label'] . '</td>
        </tr>

        <tr>
            <td style="font-size:13px;">1.03</td>
            <td style="font-size:13px;">The dataset will contain ' . $data['dataset_multiple_record'] . '</td>
        </tr>

        <tr>
            <td style="font-size:13px;">1.04</td>
            <td style="font-size:13px;">The dataset will only contain records that meet the following criteria: ' . htmlspecialchars($data['dataset_inclusion']) . '</td>
        </tr>

        <tr>
            <td style="font-size:13px;">1.05</td>
            <td style="font-size:13px;">The dataset will conform to the structure and content as defined in section 3, Dataset Structure. </td>
        </tr>

        <tr>
            <td style="font-size:13px;">1.06</td>
            <td style="font-size:13px;">Coded data within this dataset, if any, will conform to the format specifications provided in section 3, Controlled Terms or Format Descriptions. For the datasets that need to be imported back into eToolbox the labels will be made same as variable names. Please refer to section 3 for variable labels </td>
        </tr>

        <tr>
            <td style="font-size:13px;">1.07</td>
            <td style="font-size:13px;">The dataset will be a SAS dataset. Please provide in both sas7dat and xpt formats. Note: use extension .sas7bdat for SAS datasets, .rdata for R datasets, and .sdata for S-Plus datasets. </td>
        </tr>

        <tr>
            <td style="font-size:13px;">1.08</td>
            <td style="font-size:13px;">The dataset will be sorted by the following fields: ' . $data['dataset_sort'] . '</td>
        </tr>
    </table>
';

    $htmlContent .= '
     <br clear=all style="mso-special-character:line-break;page-break-after:always" />
    <h2>3. Dataset structure</h2>
    <table border="1" cellspacing="0" cellpadding="2">
        <tr>
            <th style="width: 10%;">Variable Name</th>
            <th style="width: 20%;">Variable Label</th>
            <th style="width: 10%;">Units</th>
            <th style="width: 6%;">Type</th>
            <th style="width: 8%;">Rounding</th>
            <th style="width: 8%;">Missing Value</th>
            <th style="width: 20%;">Notes</th>
            <th style="width: 20%;">Source</th>
        </tr>';

    $htmlContent .= '';

    foreach ($data['dataset_structure'] as $arr) {

        $htmlContent .= '<tr>
            <td style="font-size:13px;">' . htmlspecialchars($arr['var_name']) . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['var_label']) . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['var_units']) . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['var_type']) . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['var_rounding']) . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['var_missing_value']) . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['var_notes']) . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['var_source']) . '</td>
        </tr>';
    }

    $htmlContent .= '</table>';


    $htmlContent .= '
        <h2>4. Derivations/Outliers/Missing data</h2>
        <h3>4.1 Derivations</h3>
        <p>This section provides a list of all derivations and algorithms required for the creation of datasets.</p>
        <br />

        <table border="1" cellspacing="0" cellpadding="2">
            <tr>
                <th style="width: 10%;">Field</th>
                <th style="width: 90%;">Algorithm</th>
            </tr>';

    $htmlContent .= '';

    foreach ($data['derivations'] as $arr) {

        $htmlContent .= '<tr>
            <td style="font-size:13px;">' . htmlspecialchars($arr['field']) . '</td>
            <td style="font-size:13px;">' . $arr['algorithm'] . '</td>
        </tr>';
    }

    $htmlContent .= '</table>
        <br />
        <h3>4.2 Handling of missing data</h3>
        <p>This section describes the handling of missing data and any imputation of missing data to be performed.</p>

        <p>' . htmlspecialchars($data['missings']) . '</p>
    
        <br/>

        <h3>4.3 Programming Algorithms and Imputations</h3>
        <p>This section provides the algorithms and imputation rules for the creation of analysis datasets, such as dosing or concomitant medications.</p>
    
        <table border="1" cellspacing="0" cellpadding="2">
            <tr>
                <th style="width: 8%;">Flag Number</th>
                <th style="width: 40%;">FLAGCOM</th>
                <th style="width: 52%;">Notes</th>
            </tr> ';

    $htmlContent .= '';

    foreach ($data['flag'] as $arr) {
        //print_r($arr);exit;
        $htmlContent .= '<tr>
            <td style="font-size:13px;">' . htmlspecialchars($arr['flag_number']) . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['flag_comment']) . '</td>
            <td style="font-size:13px;">' . htmlspecialchars($arr['flag_notes']) . '</td>
        </tr>';
    }




    /*start*/

    $filename = $data['dataset_path'];

    $filename = str_replace('/', '_', $filename);
    $specid = str_replace(':', '-', $data['spec_id']);

    ob_end_clean();

    if(!is_dir(pdfspecpath)){
        mkdir(pdfspecpath, 0755, true);
    }

    $htmlContent .= '</table></div></body></html>';
    
    $file_name = exportcsvpath.$specid.'_'.$data['dataset_name'].'_v'.$data['version_id'].'_'.'docx_spec';



    $htd->createDoc($htmlContent, $file_name);
    
    $target_path = $data['dataset_path'];
    $source_path = s3_bucket_path;
    $status = "Pending";


   
  
    $file_name = $specid.'_'.$data['dataset_name'].'_v'.$data['version_id'].'_'.'docx_spec'.'.doc';
   
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
}