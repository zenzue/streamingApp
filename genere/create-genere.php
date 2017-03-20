<?php

use Aws\S3\Exception\S3Exception;
    // include to get database connection
    include_once '../config/dbconfig.php';
    require "genere_start.php";

    $serverpath = 'http://139.59.250.169';
    $genere = $_POST['genere_name'];
    $response = array();


    $valid_extensions = array('jpeg', 'jpg', 'png'); // valid extensions

    if (isset($_FILES['genere_image'])) {

        $file = $_FILES['genere_image'];
        $name = $file['name'];
        $tmp_name = $file['tmp_name'];

        $key = md5(uniqid());
        $tmp_file_name = "{$key}.{$name}";
        $tmp_file_path = "./tmp/{$tmp_file_name}";

        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $photo = 'https://s3-ap-southeast-1.amazonaws.com/atrw/genere/' . $tmp_file_name;

        try {
            
            if(in_array($ext, $valid_extensions)) {

                move_uploaded_file($tmp_name, $tmp_file_path);

                $result = $s3->putObject([
                    'Bucket' => $config['s3']['bucket'],
                    'Key' => 'genere/' . $tmp_file_name,
                    'Body' => fopen($tmp_file_path, 'r+'),
                    'ACL' => 'public-read'
                ]);
                unlink($tmp_file_path);

                if ($result) {
                    $query = "INSERT INTO genere(genere, genere_image) VALUES('".$genere."', '".$photo."')";
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
                }

            }

        } catch (S3Exception $e) {
            $xml = $e->getResponse()->xml();
            // Access a property:
            echo $xml->ArgumentValue;
        }
    }

?>