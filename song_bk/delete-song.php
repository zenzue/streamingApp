<?php
	include_once '../config/dbconfig.php';

	try{
	    // posted values
	    $song_id = $_POST['song_id'];

	    // $query = "SELECT song_file_name, song_photo_file_name, lyric_file_name FROM albums WHERE album_id = " . $album_id;
	    // $stmt = $db_con->prepare($query);
	    // if ($stmt->execute()) {
	    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
	    //     $song_path = './songs/';
	    //     $song_file_name = $row['song_file_name'];
	    //     $image_path = './images/';
	    //     $image_file_name = $row['song_photo_file_name'];
	    //     $lyric_path = './lyrics/';
	    //     $lyric_file_name = $row['lyric_file_name'];
	    //     unlink($song_path.$song_file_name);
	    //     unlink($image_path.$image_file_name);
	    //     unlink($lyric_path.$lyric_file_name);
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