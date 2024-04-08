<?php

function downlondCsvft($data) {

	$specid = str_replace(':', '-', $data['spec_id']);
	$file_name = $specid .'_'. $data['dataset_name'] . '_v' . $data['version_id'] .'_Simba_spec' .'.csv';
	$target_path = $data['dataset_path'];

	$source_path = s3_bucket_path;
	//date_default_timezone_set('US/Eastern');
	$status = "Pending";

	$fileData = [
		'spec_id' => $specid,
		'file_name' => $file_name,
		'source_path' => $source_path,
		'target_path' => $target_path,
		'status' => $status,
		'created_by'=>'testu1',
	];
	//print_r($fileData);
	$files_details =& get_instance();
	$files_details->load->model('CIModSpec');
	$files_details->CIModSpec->insert_file("file_transfer", $fileData);

	if(!is_dir(exportcsvpath)){
		mkdir(exportcsvpath, 0755, true);
	}



	$csv_filename = exportcsvpath . $file_name;
	$fd = fopen ($csv_filename, "w");
	// Prints the column names
	function print_titles($row){
		echo implode(array_keys($row), ",") . "\n";
	}
	ob_end_clean();

	fputs($fd, implode(",",array("Dataset name", $data['dataset_name'])) . "\n");
	fputs($fd, implode(",",array('Dataset label', $data['dataset_label'])) . "\n");
	fputs($fd, implode(",",array('Dataset will be sorted by', $data['dataset_sort'])) . "\n");
	fputs($fd, implode(",",array('Dataset will contain', $data['dataset_criteria'])) . "\n");
	fputs($fd, implode(",",array('Dataset will have', $data['dataset_multiple_record'])) . "\n");


	$columns= array('Name', 'Label', 'Units', 'Type', 'Rounding', 'Missing');

	fputs($fd, implode(",",$columns). "\n");

	// -------------- dataset structure table;
	foreach($data['dataset_structure'] as $row) {
		fputcsv($fd, $row);
	}
}
?>