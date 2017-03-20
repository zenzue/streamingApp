<?php


use Aws\S3\Exception\S3Exception;

    include_once '../config/dbconfig.php';
    require 'album_start.php';
         
    try{

        $serverpath = 'http://139.59.250.169';
        $artist_id = $_POST['artist'];
        $album_name = addslashes($_POST['album_name']);
        $album_title = addslashes($_POST['album_title']);
        $album_info = addslashes($_POST['album_info']);
        $response = array();

        $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

        if(isset($_FILES['album_image'])) {

            $file = $_FILES['album_image'];
            $name = $file['name'];
            $tmp_name = $file['tmp_name'];

            $key = md5(uniqid());
            $tmp_file_name = "{$key}.{$name}";
            $tmp_file_path = "./tmp/{$tmp_file_name}";

            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $photo = 'https://s3-ap-southeast-1.amazonaws.com/atrw/albums/' . $tmp_file_name;
        try {
            
            if(in_array($ext, $valid_extensions)) {
                move_uploaded_file($tmp_name, $tmp_file_path);

                $result = $s3->putObject([
                    'Bucket' => $config['s3']['bucket'],
                    'Key' => 'albums/' . $tmp_file_name,
                    'Body' => fopen($tmp_file_path, 'r+'),
                    'ACL' => 'public-read'
                ]);
                unlink($tmp_file_path);

                if ($result) {

                    $query = "INSERT INTO `albums`(`artist_id`, `album_name`, `album_title`,`album_info`, `album_image`) VALUES ('".$artist_id."', '".$album_name."', '".$album_title."', '".$album_info."', '".$photo."')";
                    $stmt = $db_con->prepare($query);
                    if ($stmt->execute()) { 
                        // echo 'success';
                        $response['status']='success';
                        header('Content-Type: application/json');
                        echo json_encode($response);
                    } else {
                        // echo 'failed';
                         $response['status']='failed';
                         header('Content-Type: application/json');
                         echo json_encode($response);
                        }

                }
            }


        } catch (S3Exception $e) {
            $xml = $e->getResponse()->xml();
            echo $xml->ArgumentValue;
        }
        
        }
    }
     
    // handle error
    catch(PDOException $exception){
        echo "Error: " . $exception->getMessage();
    }
 
?>