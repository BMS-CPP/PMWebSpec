<?php
function import_database($data) {
print_r($data);exit;
set_time_limit(500);
	$dbhost1 = 'Domain.com:3306';
	$dbuser1 = 'username';
	$dbpass1 = 'password';
	$dbname1 = 'dbstruct';
	
	// check if connection is successful
	try {
		$conn = new mysqli($dbhost1, $dbuser1, $dbpass1, $dbname1);
	} catch (mysqli_sql_exception $e) {
		error_log("dbstruct database not connected: " . $e->errorMessage(), 0);
		die("dbstruct database not connected!");
	}
//$fp = fopen("PmWebSpec-template-20201118.csv", "r");



$fileName = 'PmWebSpec-template-20201118.csv';

$file = fopen($fileName, "r");

while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
    
    $varorder = "";
    if (isset($column[0])) {
        $varorder = mysqli_real_escape_string($conn, $column[0]);
    }

    if (isset($column[1])) {
         $var_name = mysqli_real_escape_string($conn, $column[1]);
    }

    if (isset($column[2])) {
         $var_label = mysqli_real_escape_string($conn, $column[2]);
    }

    if (isset($column[3])) {
        $units = mysqli_real_escape_string($conn, $column[3]);
    }

     if (isset($column[4])) {
       $type = mysqli_real_escape_string($conn, $column[4]); 
    }

    if (isset($column[5])) {
        $round = mysqli_real_escape_string($conn, $column[5]);
    }
    if (isset($column[6])) {
        $missVal = mysqli_real_escape_string($conn, $column[6]);
    }

   if (isset($column[7])) {
        $note = mysqli_real_escape_string($conn, $column[7]);
    }
    if (isset($column[8])) {
        $source = mysqli_real_escape_string($conn, $column[8]);
    }
    if (isset($column[9])) {
        $requiredFlag = mysqli_real_escape_string($conn, $column[9]);
    }
    if (isset($column[10])) {
        $SpecType = mysqli_real_escape_string($conn, $column[10]);
    } 
    if (isset($column[11])) {
        $nameChange = mysqli_real_escape_string($conn, $column[11]);
    }
    if (isset($column[12])) {
        $labelChange = mysqli_real_escape_string($conn, $column[12]);
    }
    if (isset($column[13])) {
        $unitChange = mysqli_real_escape_string($conn, $column[13]);
    }
    if (isset($column[14])) {
        $typeChange = mysqli_real_escape_string($conn, $column[14]);
    }
    if (isset($column[15])) {
        $roundChange = mysqli_real_escape_string($conn, $column[15]);
    }
    if (isset($column[16])) {
        $missValChange = mysqli_real_escape_string($conn, $column[16]);
    }
    if (isset($column[17])) {
        $noteChange = mysqli_real_escape_string($conn, $column[17]);
    }
    if (isset($column[18])) {
        $sourceChange = mysqli_real_escape_string($conn, $column[18]);
    }
    if (isset($column[19])) {
        $erflag = mysqli_real_escape_string($conn, $column[19]);
    } else {
    	$erflag = '';
    }


    $sql ="INSERT INTO dsstruct (varorder,var_name,var_label,units,type,round,missVal,note,source,requiredFlag,SpecType,nameChange,labelChange,	unitChange,typeChange,roundChange,missValChange,noteChange,sourceChange,erflag)
		VALUES ('$varorder','$var_name','$var_label','$units','$type','$round','$missVal','$note','$source','$requiredFlag','$SpecType','$nameChange','$labelChange',	'$unitChange','$typeChange','$roundChange','$missValChange','$noteChange','$sourceChange','$erflag')";


     // $insertId = $conn->insert($sql);

$result = $conn->query($sql);

 if (!$result) {	
		echo $conn->error;
		die("An error has occurred!");
	}


}
    
echo "done";
$conn->query($result);
}

?>

