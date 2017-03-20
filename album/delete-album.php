<?php
// include to get database connection
include_once '../config/dbconfig.php';
 
try {
     
    $album_id = $_POST['album_id'];

    // $query = "SELECT file_name FROM albums WHERE album_id = " . $album_id;
    // $stmt = $db_con->prepare($query);
    // if ($stmt->execute()) {
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $path = './images/'; // upload directory
    //     $file_name = $row['file_name'];
    //     unlink($path.$file_name);
    // }

    // PDO delete query
    $query = "DELETE FROM albums WHERE album_id = " . $album_id;
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