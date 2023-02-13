<?php


function downlondCsv($data) {
		//print_r($data);exit;

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$data['spec_id'].'_'.$data['dataset_name'].'_V'.$data['version_id'].'_Simba_Spec.csv');
		
		$fd = fopen("php://output", "w");

		
		// Prints the column names
		function print_titles($row){
			echo implode(array_keys($row), ",") . "\n";
		}
		ob_end_clean();
		fputs($fd, implode(array('Dataset name', $data['dataset_name']), ",") . "\n");
		fputs($fd, implode(array('Dataset label', $data['dataset_label']), ",") . "\n");
		fputs($fd, implode(array('Dataset will be sorted by', $data['dataset_sort']), ",") . "\n");
		fputs($fd, implode(array('Dataset will contain', $data['dataset_criteria']), ",") . "\n");
		fputs($fd, implode(array('Dataset will have', $data['dataset_multiple_record']), ",") . "\n");


		$columns= array('Name', 'Label', 'Units', 'Type', 'Rounding', 'Missing');
		fputs($fd, implode($columns, ",") . "\n");



		// -------------- dataset structure table;
		foreach($data['dataset_structure'] as $row) {
			fputcsv($fd, $row);
		}


		
   }


  
   ?>
