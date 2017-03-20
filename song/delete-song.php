<?php
	include_once '../config/dbconfig.php';

	try{
	    // posted values
	    $song_id = $_POST['song_id'];

	    // $query = "SELECT song_file_name, song_photo_file_name, lyric_file_name FROM albums WHERE album_id = " . $album_id;
	    // $stmt = $db_con->prepare($query);
	    // if ($stmt->execute()) {
	    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    //     $song_high_path = $row['song_high_path'];
	    //     $song_low_path = $row['song_low_path'];
	    // }

	    

	    $query = "DELETE FROM songs WHERE song_id = " . $song_id;
	    $stmt = $db_con->prepare($query);
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