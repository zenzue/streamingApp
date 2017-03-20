<?php

use Aws\S3\Exception\S3Exception;

    // include to get database connection
    include_once '../config/dbconfig.php';
    require 'artist_start.php';
 
try{
    // posted values
    
    $serverpath = 'http://139.59.250.169';
    $artist_name = $_POST['artist_name'];
    $artist_title = addslashes($_POST['artist_title']);
    $artist_info = addslashes($_POST['artist_info']);
    $response = array();


    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

    if(isset($_FILES['artist_image']))
    {
     
        $file = $_FILES['artist_image'];
        $name = $file['name'];
        $tmp_name = $file['tmp_name'];

        $key = md5(uniqid());
        $tmp_file_name = "{$key}.{$name}";
        $tmp_file_path = "./tmp/{$tmp_file_name}";

        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $photo = 'https://s3-ap-southeast-1.amazonaws.com/atrw/artists/' . $tmp_file_name;

        try {

            if(in_array($ext, $valid_extensions)) { 
                move_uploaded_file($tmp_name, $tmp_file_path);

                $result = $s3->putObject([
                    'Bucket' => $config['s3']['bucket'],
                    'Key' => 'artists/' . $tmp_file_name,
                    'Body' => fopen($tmp_file_path, 'r+'),
                    'ACL' => 'public-read'
                ]);
                
                unlink($tmp_file_path);

                if ($result) {
                    $query = "INSERT INTO artists(artist_name, artist_title, artist_info, artist_photo) VALUES('".$artist_name."','".$artist_title."', '".$artist_info."', '".$photo."')";
                    $stmt = $db_con->prepare($query);
                    if ($stmt->execute()) {
                        // echo 'success';
                        $response['status']='success';
                        header('Content-Type: application/json');
                        echo json_encode($response);
                    } else {
                        $response['status']='failed';
                        header('Content-Type: application/json');
                        echo json_encode($response);
                    }
                }
            }

        } catch (S3Exception $e) {
            $xml = $e->getResponse()->xml();
            // Access a property:
            echo $xml->ArgumentValue;
        }
    }

}
 
// handle error
catch(PDOException $exception){
    echo "Error: " . $exception->getMessage();
}
 
?>