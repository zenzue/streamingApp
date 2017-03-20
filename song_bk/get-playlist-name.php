<?php
	
	include_once '../config/dbconfig.php';

	$query = "SELECT * FROM admin_playlist where playlist_id = 3";
	$stmt = $db_con->prepare($query);
	$stmt->execute();
	$num = $stmt->rowCount();

	$response = array();
	if ($num > 0 ) {
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		  
			$res[] = $row;
		}

		header('Content-Type: application/json');
		echo json_encode($res);
	
	} else {
		header('Content-Type: application/json');
		echo json_encode($response);
	}

?>