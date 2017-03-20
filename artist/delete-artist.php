<?php
	include_once '../config/dbconfig.php';

	try{
	    // posted values
	    $artist_id = $_POST['artist_id'];

	    	// $query = "SELECT file_name FROM artists WHERE artist_id = " .$artist_id;
	    	// $stmt = $db_con->prepare($query);
	    	// if ($stmt->execute()) {
	    	// 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	    	// 	$path = './images/'; // upload directory
	    	// 	$file_name = $row['file_name'];
	    	// 	unlink($path.$file_name);
	    	// }

	    $query = "DELETE FROM artists WHERE artist_id = " . $artist_id;
	    $stmt = $db_con->prepare($query);


	    // execute the query
	    if($stmt->execute()){
	        $response_array['status'] = "success";
	        header('Content-type: application/json');
	        echo json_encode($response_array);
	    }else{
	        $response_array['status'] = "failed";
	        header('Content-type: application/json');
	        echo json_encode($response_array);
	    }

	}
	 
	// handle error
	catch(PDOException $exception){
	    echo "Error: " . $exception->getMessage();
	}

?>