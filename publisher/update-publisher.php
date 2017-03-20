<?php

use Aws\S3\Exception\S3Exception;
	include_once '../config/dbconfig.php';
	require 'publisher-start.php';

	try{

		$pub_id = $_POST['publisher_id'];
		$pub_name = $_POST['publisher_name'];
	    $pub_prefix = str_replace(' ', '', $pub_name);
	    $pub_prefix = substr($pub_prefix,0,2);
	    $pub_prefix = strtoupper($pub_prefix);
	    $response = array();

	    $sql = "SELECT COUNT(*) AS count FROM publisher WHERE pub_prefix= '".$pub_prefix."'";
	    $stmt = $db_con->prepare($sql);
	    if ($stmt->execute()) {
	        $row = $stmt->fetch(PDO::FETCH_ASSOC);
	        $count = $row["count"];
	        
	    } else {
	        $count = 0;
	    }

	    if ($count == 0) {
	        
	        $query = "UPDATE publisher SET pub_name = '".$pub_name."', pub_prefix = '".$pub_prefix."' WHERE pub_id = " . $pub_id;
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
	    } else {
	        
	        $response['status']='exist';
	        header('Content-Type: application/json');
	        echo json_encode($response);
	    }

	}
	 
	// handle error
	catch(PDOException $exception){
	    echo "Error: " . $exception->getMessage();
	}
?>