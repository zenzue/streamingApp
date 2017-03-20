<?php

use Aws\S3\Exception\S3Exception;
	include_once '../config/dbconfig.php';
	require 'playlist_start.php';

	try{

		$playlist_id = $_POST['playlist_id'];
		$title_name = $_POST['title_name'];
		$playlist_rating = $_POST['playlist_rating'];
		$response = array();

		$img = $_FILES['title_image']['name'];

		$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

		$response = array();

		if ($img === "") {
			$query = "UPDATE admin_playlist SET playlist_name = '".$title_name."', playlist_rating ='".$playlist_rating."' WHERE playlist_id = " . $playlist_id;
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

			$file = $_FILES['title_image'];
			$name = $file['name'];
			$tmp_name = $file['tmp_name'];

			$key = md5(uniqid());
			$tmp_file_name = "{$key}.{$name}";
			$tmp_file_path = "./tmp/{$tmp_file_name}";

			// get uploaded file's extension
			$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
			$photo = 'https://s3-ap-southeast-1.amazonaws.com/atrw/playlist/' . $tmp_file_name;

			try {
				

				if(in_array($ext, $valid_extensions)) { 
				    move_uploaded_file($tmp_name, $tmp_file_path);

				    $result = $s3->putObject([
				        'Bucket' => $config['s3']['bucket'],
				        'Key' => 'playlist/' . $tmp_file_name,
				        'Body' => fopen($tmp_file_path, 'r+'),
				        'ACL' => 'public-read'
				    ]);

				    unlink($tmp_file_path);

				    if ($result) {
			        	$query = "UPDATE admin_playlist SET playlist_name = '".$title_name."', playlist_rating='".$playlist_rating."', playlist_photo = '".$photo."' WHERE playlist_id = " . $playlist_id;
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