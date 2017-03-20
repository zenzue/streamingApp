<?php
	
	include_once '../config/dbconfig.php';

	try{
	    // posted values
	    $genere_id = $_POST['genere_id'];

	    	// $query = "SELECT genere_file_name FROM genere WHERE genere_id = " .$genere_id;
	    	// $stmt = $db_con->prepare($query);
	    	// if ($stmt->execute()) {
	    	// 	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	    	// 	$path = './images/'; // upload directory
	    	// 	$file_name = $row['genere_file_name'];
	    	// 	unlink($path.$file_name);
	    	// }

	    $query = "DELETE FROM genere WHERE genere_id = " . $genere_id;
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