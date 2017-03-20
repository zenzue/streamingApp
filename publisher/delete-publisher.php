<?php
	include_once '../config/dbconfig.php';

	try{
	    // posted values
	    $publisher_id = $_POST['publisher_id'];

	    $query = "DELETE FROM publisher WHERE pub_id = " . $publisher_id;
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