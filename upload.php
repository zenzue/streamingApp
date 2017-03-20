<?php

use Aws\S3\Exception\S3Exception;

	require 's3_img_start.php';

	if (isset($_FILES['file'])) {
		
		$file = $_FILES['file'];
		$name = $file['name'];
		$tmp_name = $file['tmp_name'];
		// $extension = explode('.', $name);
		// $extension = strtolower(end($extension));
		

		// Temp details
		$key = md5(uniqid());
		$tmp_file_name = "{$key}.{$name}";
		$tmp_file_path = "./{$tmp_file_name}";
		move_uploaded_file($tmp_name, $tmp_file_path);

		try {
			
			// var_dump($config['s3']['bucket']);			
			// // $result = $s3->putObject([
			// // 	'Bucket' => $config['s3']['bucket'];
			// // ]);		

			$s3->putObject([
				'Bucket' => $config['s3']['bucket'],
				'Key' => 'high_qty/' . $name,
				'Body' => fopen($tmp_file_path, 'r+'),
				'ACL' => 'public-read'
			]);

			unlink($tmp_file_path);

		} catch (S3Exception $e) {
			$xml = $e->getResponse()->xml();
			// Access a property:
			echo $xml->ArgumentValue;
		}

	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Upload</title>
</head>
<body>
	<form action="upload.php" method="post" enctype="multipart/form-data">
		<input type="file" name="file">
		<input type="submit" name="Upload">
	</form>
</body>
</html>