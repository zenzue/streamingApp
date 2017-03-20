<?php

	/*
	reference
	
	https://code.google.com/archive/p/php-reader/wikis/ID3v2.wiki
	
	reference
	*/

use Aws\S3\Exception\S3Exception;
	include_once '../config/dbconfig.php';
	require 'start.php';
	require 'bitrate.php';

	$response = array();

	$songpath = $_POST['song'];

	$musicArr = ScanForlderDir($songpath);

	$ArrCount = count($musicArr);
	$count = 0;

	$valid_extensions = array('mp3', 'm4a');

	foreach ($musicArr as $music) {

		$arrmusic = explode("/", $music);
		$musicname = end($arrmusic);

		$id3 = new Zend_Media_Id3v2($music);

		$frame = $id3->getFramesByIdentifier('TIT2');
		if (empty($frame)) {
			$title = "";
		} else {
			$title = addslashes($frame[0]->getText());
		}

		$frame = $id3->getFramesByIdentifier('TPE1');
		if (empty($frame)) {
			$artist = "";
		} else {
			$artist = addslashes($frame[0]->getText());
		}

		$frame = $id3->getFramesByIdentifier('TALB');
		if (empty($frame)) {
			$album = "";
			$albumId = 0;
		} else {
			$album = addslashes($frame[0]->getText());
			$sql = "SELECT album_id FROM albums WHERE album_name = '".$album."'";
			$stmt = $db_con->prepare($sql);
			$stmt->execute();
			$num = $stmt->rowCount();
			if ($num > 0) {
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$albumId = $row['album_id'];
			} else {
				$albumId = 11111;
			}
			
		}

		$frame = $id3->getFramesByIdentifier('USLT');
		if (empty($frame)) {
			$lyric = "";
		} else {
			$lyric = addslashes($frame[0]->getText());
		}
		
		$data = getMP3BitRateSampleRate($music);
		$cur_bitrate = $data['bitRate'];
		$low_bitrate = $cur_bitrate / 2;

		$low_name = explode('/', $music);
		$low_name = end($low_name);
		$ext = explode(".", $low_name);
		$ext = $ext['1'];

		$key = md5(uniqid());
		$tmp_file_name = "{$key}.{$ext}";
		$tmp_file_path = "upload/{$key}.{$ext}";
		$tmp_low_name = "low{$key}.{$ext}";
		$tmp_low_path = "upload/low{$key}.{$ext}";

		$song_high = 'https://s3-ap-southeast-1.amazonaws.com/atrw/high_qty/' . $tmp_file_name;
		$song_low = 'https://s3-ap-southeast-1.amazonaws.com/atrw/low_qty/' . $tmp_low_name;

		try {
			
			if(in_array($ext, $valid_extensions)) {

				exec('ffmpeg -i "'.$music.'" -acodec libmp3lame -b:a '.$cur_bitrate.'k -ac 1 -ar 11025 '.$tmp_file_path);
				exec('ffmpeg -i "'.$music.'" -acodec libmp3lame -b:a '.$low_bitrate.'k -ac 1 -ar 11025 '.$tmp_low_path);

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

				$sql = "INSERT INTO `songs`(`album_id`, `song_name`, `song_rating`, `song_favourite`, genere_id, `song_high_path`, `song_low_path`, `lyric`, `song_role`) VALUES ('".$albumId."', '".$title."', '3', 'blah', '1', '".$song_high."', '".$song_low."', 'blah', 'blah blah')";
				$stmt = $db_con->prepare($sql);
				if ($stmt->execute()) {
					$count++;
				}
			}

		} catch (S3Exception $e) {
			$xml = $e->getResponse()->xml();
			echo $xml->ArgumentValue;
		}

	}


	if ($ArrCount == $count) {
		header('Content-Type: application/json');
		$response['status'] = "success";
		echo json_encode($response);
	} else {
		header('Content-Type: application/json');
		$response['status'] = "success";
		echo json_encode($response);
	}

	function ScanForlderDir($dir){

		$res = array();
	    $ffs = scandir($dir);

	    foreach($ffs as $ff){
	        if($ff != '.' && $ff != '..'){
	        	if (is_dir($dir.'/'.$ff)) {
	        		ScanForlderDir($dir.'/'.$ff);
	        	} else {

	        		$aPathInfo = pathinfo($ff);
	        		$sExt = strtolower($aPathInfo['extension']);
	        			if ($sExt == 'mp3' || $sExt == 'm4a') {

	        				$res[] = $dir . "/" . $ff;

	        			}
	        		}
	        	}
	        }

	        return $res;
		}


	function uploadFTP($server, $username, $password, $local_file, $remote_file){
	    // connect to server
	    $connection = ftp_connect($server);

	    // login
	    if (@ftp_login($connection, $username, $password)){
	        // successfully connected
	    }else{
	        return false;
	    }

	    ftp_put($connection, $remote_file, $local_file, FTP_BINARY);
	    ftp_close($connection);
	    return true;
	}
	


?>