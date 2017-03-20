<?php

use Aws\S3\Exception\S3Exception;
    // include to get database connection
    include_once '../config/dbconfig.php';
    require 'song_start.php';
    require 'bitrate.php';
    require 'get_last_id.php';
     
    try{

        $album_id = $_POST['album'];
        $song_name = addslashes($_POST['song_name']);
        $genere = $_POST['genere'];
        $song_rating = $_POST['reating_input'];
        $song_role = $_POST['song_role'];
        $song_type = $_POST['song_role'];
        $lyric = $_POST['song_lyric'];
        $publisher = $_POST['publisher'];
        $response = array();

        $valid_extensions = array('mp3'); // valid extensions

        if(isset($_FILES['song'])) {

            $file = $_FILES['song'];
            $name = $file['name'];
            $tmp_name = $file['tmp_name'];

            $data = getMP3BitRateSampleRate($_FILES['song']['tmp_name']);
            $bitrate = $data['bitRate'] / 2;
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            $key = md5(uniqid());
            $tmp_file_name = "{$key}.{$ext}";
            $tmp_file_name = str_replace(' ', '', $tmp_file_name);
            $tmp_file_name = preg_replace('/\s+/', '', $tmp_file_name);
            $tmp_file_path = "tmp/{$tmp_file_name}";
            $tmp_file_path = str_replace(' ', '', $tmp_file_path);
            $tmp_file_path = preg_replace('/\s+/', '', $tmp_file_path);


            $tmp_low_name = "low{$key}.{$ext}";
            $tmp_low_name = str_replace(' ', '', $tmp_low_name);
            $tmp_low_name = preg_replace('/\s+/', '', $tmp_low_name);
            $tmp_low_path = "tmp/{$tmp_low_name}";
            $tmp_low_path = str_replace(' ', '', $tmp_low_path);
            $tmp_low_path = preg_replace('/\s+/', '', $tmp_low_path);

            $song_high = 'https://s3-ap-southeast-1.amazonaws.com/atrw/high_qty/' . $tmp_file_name;
            $song_low = 'https://s3-ap-southeast-1.amazonaws.com/atrw/low_qty/' . $tmp_low_name;

            try {
                
                if(in_array($ext, $valid_extensions)) { 
                    move_uploaded_file($tmp_name, $tmp_file_path);

                    exec('ffmpeg -i '.$tmp_file_path.' -acodec libmp3lame -b:a '.$bitrate.'k -ac 1 -ar 11025 '.$tmp_low_path);

                    $result = $s3->putObject([
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => 'high_qty/' . $tmp_file_name,
                        'Body' => fopen($tmp_file_path, 'r+'),
                        'ACL' => 'public-read'
                    ]);
                    unlink($tmp_file_path);

                    $result = $s3->putObject([
                        'Bucket' => $config['s3']['bucket'],
                        'Key' => 'low_qty/' . $tmp_low_name,
                        'Body' => fopen($tmp_low_path, 'r+'),
                        'ACL' => 'public-read'
                    ]);
                    unlink($tmp_low_path);

                    $query = 'SELECT * FROM publisher WHERE pub_id = "'.$publisher.'"';
                    $stmt = $db_con->prepare($query);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $prefix = $row['pub_prefix'];
                    }

                    $sql = 'SELECT id FROM tbl_last_id';
                    $stmt = $db_con->prepare($sql);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $lastID = $row['id'];
                    }
                    $lastID = $lastID + 1;

                    $yearID = date('y');
                    $monthID = date('m');

                    $sql = 'UPDATE tbl_last_id SET id = "'.$lastID.'"';
                    $stmt = $db_con->prepare($sql);
                    $stmt->execute();

                    $ID = $prefix . $yearID . $monthID . $lastID;

                    if ($result) {
                        $sql = "INSERT INTO 
                            `songs`(`pub_song_id`, `album_id`, `song_name`, `song_rating`,`song_favourite`,`genere_id`, `song_high_path`,`song_low_path`, `lyric`, `song_role`, `publisher_id`) 
                            VALUES ('".$ID."','".$album_id."','". $song_name ."','". $song_rating ."','". $song_role ."','". $genere ."','".$song_high."','".$song_low."','". $lyric ."','".$song_role."','".$publisher."')";

                            $stmt = $db_con->prepare($sql);
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