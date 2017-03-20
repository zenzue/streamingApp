<?php
	
	include_once '../config/dbconfig.php';

	$playlist_det_id = $_POST['playlist_det_id'];
	$response = array();
	
	$query = 'DELETE FROM admin_playlist_det WHERE playlist_det_id = "'.$playlist_det_id.'"';
	$stmt = $db_con->prepare($query);
	if ($stmt->execute()) {
		$response['status']='success';
		header('Content-Type: application/json');
		echo json_encode($response);
	} else {
		$response['status']='failed';
		header('Content-Type: application/json');
		echo json_encode($response);
	}



?>