<?php
    error_reporting(0);
    include_once('tcpdf/config/lang/eng.php');
    include_once('tcpdf/tcpdf.php');

    function initiateDirectorySetup($post_data) {
        // ob_end_flush();
        // ob_start();

        // Create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'utf-8', false);

        // Set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetHeaderData("", 0, "", "Drive Path Directory Structure Request Form");

        // Front page
        $pdf->AddPage('L');

        $html = '<style type="text/css">
                	table {
                		border:none;
                		border: 1px solid black;
                       	border-collapse: collapse;
                       	padding: 5px;
                       	border-spacing: 5px;
                       	width: 100%;
                	}
                    th, td {
                       	border: 1px solid black;
                       	border-collapse: collapse;
                       	padding: 5px;
                       	border-spacing: 5px;
                       	width: 100%;
                    }
                    td.hide_all{
                        border: none;
                    }
                </style>

            	<h3 align="center"> Drive Path Directory Structure Request From</h3>
            	<h4 align="center">' . date("Y-m-d") .'</h4>

                <table>
                	<tr>
                		<td class="hide_all" width="60%"> Level 1:</td>
                		<td width="40%"> '. $post_data['level1'] .'</td>
                	</tr>
                	<tr>
                		<td class="hide_all" width="60%"> Level 2:</td>
                		<td width="40%"> '. $post_data['level2'] .'</td>
                	</tr>
                	<tr>
                		<td class="hide_all" width="60%"> Level 3:</td>
                		<td width="40%"> '. $post_data['level3'] .'</td>
                	</tr>
                    
                	<tr>
                		<td class="hide_all" width="60%"> Level 4:</td>
                		<td width="40%"> '. $post_data['level4'] .'</td>
                	</tr>
                </table>';

        $pdf->writeHTML($html, true, false, false, false, '');
        ob_end_clean();

        ## send the PDF by email
        $pdf->Output($post_data['file_path'], 'F');
        $pdf->Output($post_data['file_path'], 'I');
    
        return 1;

    }
?>
