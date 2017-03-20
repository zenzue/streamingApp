<?php

	use Aws\S3\Exception\S3Exception;
		include_once '../config/dbconfig.php';
		require 'start.php';
		require 'bitrate.php';
			
			$response = array();
			$valid_extensions = array('mp3', 'm4a');
			$song_role = $_POST['song_role'];


		foreach ($_FILES['song']['name'] as $i => $song) {
			$file = $_FILES['song'];
			$name = $file['name'][$i];
			$tmp_name = $file['tmp_name'][$i];
			$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
			if (in_array($ext, $valid_extensions)) {
				$arr[] = $name;
			}	
		}

		$arrCount = count($arr);
		$resCount = 0;

	if (isset($_FILES['song'])) {

		foreach ($_FILES['song']['name'] as $i => $name) {
			
			$file = $_FILES['song'];
			$name = $file['name'][$i];
			$tmp_name = $file['tmp_name'][$i];
			$ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

			if (in_array($ext, $valid_extensions)) {

				/* Get Bitrate of song */

				$data = getMP3BitRateSampleRate($tmp_name);
				$bitrate = $data['bitRate'] / 2;


				$id3 = new Zend_Media_Id3v2($tmp_name);


				/* Get audio artist name tag */

				$frame = $id3->getFramesByIdentifier('TPE1');
				if (empty($frame)) {
					$artist = "";
				} else {
					$artist = addslashes($frame[0]->getText());
				}


				/* Get audio title name tag */

				$frame = $id3->getFramesByIdentifier('TIT2');
				if (empty($frame)) {
					$title = "UNKNOWN";
				} else {
					$title = addslashes($frame[0]->getText());
				}

				/* Get audio album name tag */

				$frame = $id3->getFramesByIdentifier('TALB');
				if (empty($frame)) {
					$album = "UNKNOWN";
				} else {
					$album = $frame[0]->getText();
				}

				/* Get album id from database */
				$sql = "SELECT album_id FROM albums WHERE album_name = '".$album."'";
				$stmt = $db_con->prepare($sql);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$albumId = $row['album_id'];


				/* Get audio year tag */

				$frame = $id3->getFramesByIdentifier('TYER');
				if (empty($frame)) {
					$year = "";
				} else {
					$year = $frame[0]->getText();
				}

				/* Get audio genere tag */

				$frame = $id3->getFramesByIdentifier('TCON');
				if (empty($frame)) {
					$genere = "UNKNOWN";
				} else {
					$genere = $frame[0]->getText();
				}

				$query = 'SELECT * FROM genere WHERE genere = "'.$genere.'"';
				$stmt = $db_con->prepare($query);
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				    $genere_id = $row['genere_id'];
				}

				/* Get audio lyric tag */

				$frame = $id3->getFramesByIdentifier('USLT');
				if (empty($frame)) {
					$lyric = "";
				} else {
					$lyric = addslashes($frame[0]->getText());
				}

				$frame = $id3->getFramesByIdentifier('TPUB');
				if (empty($frame)) {
					$publisher = "UNKNOWN";
				} else {
					$publisher = $frame[0]->getText();
				}
				
				$prefix = str_replace(' ', '', $publisher);
				$prefix = substr($prefix,0,2);
				$prefix = strtoupper($prefix);

				$query = 'SELECT * FROM publisher WHERE pub_prefix = "'.$prefix.'"';
				$stmt = $db_con->prepare($query);
				$stmt->execute();
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				    $pub_id = $row['pub_id'];
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

			$key = md5(uniqid());
			$tmp_file_name = "{$i}{$key}.{$ext}";
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

			$song_high = 'https://s3-ap-southeast-1.amazonaws.com/atrw/high/' . $tmp_file_name;
			$song_low = 'https://s3-ap-southeast-1.amazonaws.com/atrw/low/' . $tmp_low_name;

			move_uploaded_file($tmp_name, $tmp_file_path);

			exec('ffmpeg -i '.$tmp_file_path.' -acodec libmp3lame -b:a '.$bitrate.'k -ac 1 -ar 11025 '.$tmp_low_path);			

			$response['status'] = $title . "was uploaded";

			$result = $s3->putObject([
			    'Bucket' => $config['s3']['bucket'],
			    'Key' => 'high/' . $tmp_file_name,
			    'Body' => fopen($tmp_file_path, 'r+'),
			    'ACL' => 'public-read'
			]);
			unlink($tmp_file_path);

			$result = $s3->putObject([
			    'Bucket' => $config['s3']['bucket'],
			    'Key' => 'low/' . $tmp_low_name,
			    'Body' => fopen($tmp_low_path, 'r+'),
			    'ACL' => 'public-read'
			]);

			unlink($tmp_low_path);

				if ($result) {

				$sql = "INSERT INTO `songs`(`pub_song_id`, `album_id`, `song_name`, `song_rating`, `song_favourite`, genere_id, `song_high_path`, `song_low_path`, `lyric`, `year`, `song_role`, `publisher_id`) VALUES ('".$ID."', '".$albumId."', '".$title."', '1', '".$song_role."', '".$genere_id."', '".$song_high."', '".$song_low."', '".$lyric."', '".$year."', '".$song_role."', '".$pub_id."')";

					    $stmt = $db_con->prepare($sql);
					if ($stmt->execute()) {
					    $resCount++;
					    $response[]= $title . 'was uploaded';
					} else {
					    $response[]='failed';
					}

				}

			}
		}

		if ($arrCount == $resCount) {
			header('Content-Type: application/json');
			echo json_encode($response);
		}

	}

?>