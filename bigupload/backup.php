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
		$valid_extensions = array('mp3', 'm4a'); // valid extensions

		if (isset($_FILES['song'])) {

			$count = 0;
			$file = $_FILES['song'];
			$name = $file['name'];
			$tmp_name = $file['tmp_name'];



		    foreach ($_FILES['song']['name'] as $i => $name) {
		        if (strlen($_FILES['song']['name'][$i]) > 1) {

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
	        		
	        		if (in_array($ext, $valid_extensions)) {

	        			$id3 = new Zend_Media_Id3v2($tmp_name);


	        			/* Get audio title name tag */

	        			$frame = $id3->getFramesByIdentifier('TIT2');
	        			if (empty($frame)) {
	        				$title = "";
	        			} else {
	        				$title = addslashes($frame[0]->getText());
	        			}

	        			/* Get audio artist name tag */

	        			$frame = $id3->getFramesByIdentifier('TPE1');
	        			if (empty($frame)) {
	        				$artist = "";
	        			} else {
	        				$artist = addslashes($frame[0]->getText());
	        			}

	        			/* Get audio album name tag */

	        			$frame = $id3->getFramesByIdentifier('TALB');
	        			if (empty($frame)) {
	        				$album = "";
	        				$albumId = 0;
	        			} else {
	        				$album = addslashes($frame[0]->getText());
	        				/* Get album id from database */
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

	        			/* Get audio lyric tag */

	        			$frame = $id3->getFramesByIdentifier('USLT');
	        			if (empty($frame)) {
	        				$lyric = "";
	        			} else {
	        				$lyric = addslashes($frame[0]->getText());
	        			}


	        			/* Get music bitrate */
	        			$data = getMP3BitRateSampleRate($music);
	        			$cur_bitrate = $data['bitRate'];
	        			$low_bitrate = $cur_bitrate / 2;


	        		}

	        	} catch (S3Exception $e) {
	        		
	        		if (in_array($ext, $valid_extensions)) {
	        			move_uploaded_file($tmp_name, $tmp_file_path);

	        			exec('ffmpeg -i '.$tmp_file_path.' -acodec libmp3lame -b:a '.$bitrate.'k -ac 1 -ar 11025 '.$tmp_low_path);
	        		}

	        	}



		            // if (move_uploaded_file($_FILES['files']['tmp_name'][$i], 'folder/'.$name)) {
		            //     $count++;
		            // }


		        }
		    }

		}

?>