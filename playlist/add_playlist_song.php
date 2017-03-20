<?php
	
	include_once '../config/dbconfig.php';
	
	$playlist_id = $_POST['playlist_id'];
	$song_id = $_POST['song_id'];

	$sql = 'SELECT * FROM admin_playlist_det WHERE playlist_id = "'.$playlist_id.'"';
	$stmt = $db_con->prepare($sql);
	$stmt->execute();
	$num = $stmt->rowCount();

	if ($num == 20) {
		    // echo 'success';
		    $response['status']='data_full';
		    header('Content-Type: application/json');
		    echo json_encode($response);	
	} else {
		$sql = "INSERT INTO admin_playlist_det(playlist_id, song_id) VALUES('".$playlist_id."', '".$song_id."')";
		$stmt = $db_con->prepare($sql);
		if ($stmt->execute()) {
		    // echo 'success';
		    $response['status']='success';
		    header('Content-Type: application/json');
		    echo json_encode($response);
		} else {
			$response['status']='failed';
			header('Content-Type: application/json');
			echo json_encode($response);
		}
	}

?>