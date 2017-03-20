<?php
	
	include_once '../config/dbconfig.php';

	$playlist_id = $_POST['playlist_id'];
	$response = array();
	
	$query = 'DELETE FROM admin_playlist WHERE playlist_id = "'.$playlist_id.'"';
	$stmt = $db_con->prepare($query);
	if ($stmt->execute()) {

		$sql = 'DELETE FROM admin_playlist_det WHERE playlist_id = "'.$playlist_id.'"';
		$stmt = $db_con->prepare($sql);

		if ($stmt->execute()) {
			$response['status']='success';
			header('Content-Type: application/json');
			echo json_encode($response);
		} else {
			$response['status']='faild';
			header('Content-Type: application/json');
			echo json_encode($response);
		}
	} else {
		$response['status']='failed';
		header('Content-Type: application/json');
		echo json_encode($response);
	}



?>