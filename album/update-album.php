<?php

use Aws\S3\Exception\S3Exception;

    include_once '../config/dbconfig.php';
    require 'album_start.php';

	try{

		$serverpath = 'http://139.59.250.169';
		$artist_id = $_POST['artist'];
		$album_id = $_POST['album_id'];
		$album_name = addslashes($_POST['album_name']);
		$album_title = addslashes($_POST['album_title']);
		$album_info = addslashes($_POST['album_info']);
		$response = array();

		$img = $_FILES['album_image']['name'];

		$valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

		$response = array();

		if ($img === "") {
			$query = "UPDATE `albums` SET `artist_id`='".$artist_id."',`album_name`='".$album_name."',`album_title`='".$album_title."',`album_info`='".$album_info."' WHERE album_id = " . $album_id;
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

			$file = $_FILES['album_image'];
			$name = $file['name'];
			$tmp_name = $file['tmp_name'];

			$key = md5(uniqid());
			$tmp_file_name = "{$key}.{$name}";
			$tmp_file_path = "./tmp/{$tmp_file_name}";

			// get uploaded file's extension
			$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
			$photo = 'https://s3-ap-southeast-1.amazonaws.com/atrw/albums/' . $tmp_file_name;


			// check's valid format
			if(in_array($ext, $valid_extensions)) {
			
				move_uploaded_file($tmp_name, $tmp_file_path);

				$result = $s3->putObject([
				    'Bucket' => $config['s3']['bucket'],
				    'Key' => 'albums/' . $tmp_file_name,
				    'Body' => fopen($tmp_file_path, 'r+'),
				    'ACL' => 'public-read'
				]);

				unlink($tmp_file_path);

				if ($result) {
					$query = "UPDATE albums SET artist_id = '". $artist_id."', album_name = '".$album_name."', album_title = '".$album_title."', album_info = '".$album_info."', album_image = '".$photo."' WHERE album_id = '".$album_id."'";
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
			} else {
					$response['status']='exist';
					header('Content-Type: application/json');
					echo json_encode($response);
			}

		}

	}
	 
	// handle error
	catch(PDOException $exception){
	    echo "Error: " . $exception->getMessage();
	}
?>