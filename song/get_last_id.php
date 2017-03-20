<?php

	function get_last_id ($publisher_id) {

		include_once '../config/dbconfig.php';

		$query = 'SELECT * FROM publisher WHERE pub_id = "'.$publisher_id.'"';
		$stmt = $db_con->prepare($query);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$prefix = $row['pub_prefix'];
		}

		$sql = 'SELECT id FROM tbl_last_id';
		$stmt = $db_con->prepare($sql);

	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	    	$lastID = $row['id'];
	    }

		return $prefix . $lastID;

	}


?>