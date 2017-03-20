<?php
	use Aws\S3\Exception\S3Exception;
	    // include to get database connection
	    include_once '../config/dbconfig.php';
	    require "genere_start.php";
	try{

		$serverpath = 'http://139.59.250.169';
		$genere_id = $_POST['genere_id'];
		$genere_name = $_POST['genere_name'];
		$response = array();

		$img = $_FILES['genere_image']['name'];

		$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

		$response = array();

		if ($img === "") {
			$query = "UPDATE genere SET genere = '".$genere_name."' WHERE genere_id = " . $genere_id;
				$stmt = $db_con->prepare($query);
				if ($stmt->execute()) { 
				    // echo 'success';
				    $response['status']='success';
				    header('Content-Type: application/json');
				    echo json_encode($response);
				} else {
				    // echo 'failed';
				    $response['status']='failed';
				    header('Content-Type: application/json');
				    echo json_encode($response);
			    }
		} else {

			try {
				
				$file = $_FILES['genere_image'];
				$name = $file['name'];
				$tmp_name = $file['tmp_name'];

				$key = md5(uniqid());
				$tmp_file_name = "{$key}.{$name}";
				$tmp_file_path = "./tmp/{$tmp_file_name}";

				// get uploaded file's extension
				$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
				$photo = 'https://s3-ap-southeast-1.amazonaws.com/atrw/genere/' . $tmp_file_name;

				if (in_array($ext, $valid_extensions)) {
					move_uploaded_file($tmp_name, $tmp_file_path);

					$result = $s3->putObject([
					    'Bucket' => $config['s3']['bucket'],
					    'Key' => 'genere/' . $tmp_file_name,
					    'Body' => fopen($tmp_file_path, 'r+'),
					    'ACL' => 'public-read'
					]);

					unlink($tmp_file_path);
					if ($result) {
						$query = "UPDATE genere SET genere = '".$genere_name."', genere_image = '".$photo."' WHERE genere_id = " . $genere_id;
					   	$stmt = $db_con->prepare($query);
					   	if ($stmt->execute()) { 
					       // echo 'success';
					       $response['status']='success';
					       header('Content-Type: application/json');
					       echo json_encode($response);
					   	} else {
					       // echo 'failed';
					       $response['status']='failed';
					       header('Content-Type: application/json');
					       echo json_encode($response);
					    }
					}

				}

			} catch (S3Exception $e) {
				$xml = $e->getResponse()->xml();
				// Access a property:
				echo $xml->ArgumentValue;
			}

		}

	}
	 
	// handle error
	catch(PDOException $exception){
	    echo "Error: " . $exception->getMessage();
	}
?>