<?php

    function downlondEsub($data) {
    
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.$data['spec_id'].'_'.$data['dataset_name'].'_V'.$data['version_id'].'_eSub_Spec.csv');
    $fd = fopen("php://output", "w");
    ob_end_clean();
     $columns= array('Variable', 'Label', 'Comment', 'Codes');

    fputs($fd, implode(",",$columns) . "\n");
    fputs($fd, implode(",",array('*', 'Some random text')) . "\n");
    fputs($fd, implode(",",array('*', 'More random text')) . "\n");
    fputs($fd, implode(",",array('DSLABEL', $data['dataset_label'])) . "\n");

    // fputs($fd, implode($columns, ",") . "\n");
    // fputs($fd, implode(array('*', 'Some random text'), ",") . "\n");
    // fputs($fd, implode(array('*', 'More random text'), ",") . "\n");
    // fputs($fd, implode(array('DSLABEL', $data['dataset_label']), ",") . "\n");

    $lname = $_SESSION["passvalue"];
    $pieces = explode("@@", $lname);
 
    // for( $i = 0; $i<count($pieces)/4-1; $i++ ) {
    //                $row = array_slice($pieces, $i*4, 4);
    //                $row = array_map(function($value) { return '"'. str_replace('"', "'", str_replace("\n", "", str_replace("\r", " ", $value))) .'"';}, $row);

    //                 fputs($fd, implode(",",array_values($row)) . "\n");
    //                 $csv_data .= implode(",",array_values($row)) . "\n";
    //     }

        for( $i = 0; $i<count($pieces)/4-1; $i++ ) {
            $row = array_slice($pieces, $i*4, 4);
            $newrow = [];
            foreach($row as $key=>$value)
            {
                if($key == 0)
                {
                    $newrow[] = strtoupper($value);
                }
                else
                {
                    $newrow[] = $value;
                }
            } 

            $row = $newrow;
           
           $row = array_map(function($value) { return '"'. str_replace('"', "'", str_replace("\n", "", str_replace("\r", " ", $value))) .'"';}, $row);

           fputs($fd, implode(",",array_values($row)) . "\n");
           $csv_data .= implode(",",array_values($row)) . "\n";
        }
}  
?> 