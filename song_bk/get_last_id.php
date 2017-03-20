<?php

	include_once '../config/dbconfig.php';

	$sql = 'SELECT id FROM tbl_last_id';
	$stmt = $db_con->prepare($sql);
	$stmt->execute();
	$num = $stmt->rowCount();

	if ($num > 0) {

		if ($num > 0) {
		    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    	$lastID = $row['id'];
		    }
		}
	}


?>