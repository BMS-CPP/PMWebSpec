<?php

	require './aws-sdk/aws-autoloader.php';

 	use Aws\S3\S3Client; 
 	use Aws\S3\Exception\S3Exception; 

 	function file_transfer($filepath, $S3_bucket)
	{

 		$key = basename($filepath);
		$bucket = $S3_bucket;
		
		try{

			$s3Client = S3Client::factory( 
			array( 
			//	'credentials' => array( 
			//	'key' => $IAM_KEY, 
			//	'secret' => $IAM_SECRET 
			//	), 
				'version' => 'latest', 
				'region'  => 'us-east-1', 
				) 
			); 
	
    		$result1 = $s3Client->putObject([
        		'Bucket'     => $bucket,
        		'Key'        => $key,
        		'SourceFile' => $filepath,
        		'ACL' => 'bucket-owner-full-control',
				'ServerSideEncryption' => 'AES256',
    		]);    
		} catch (S3Exception $e) {
    		echo $e->getMessage() . "\n";
			error_log("An error has occurred: " . $e->getMessage(), 0);
		}
		unlink($filepath);
 	}

?>
