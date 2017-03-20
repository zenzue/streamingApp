<?php

	include_once '../config/dbconfig.php';

	try {
		
		$serverpath = 'http://139.59.250.169';
		$response = array();


		// One //

		$album_idone = $_POST['albumone'];
		$genereone = $_POST['genereone'];
		$song_ratingone = "1";
		$song_roleone = $_POST['song_roleone'];
		$song_typeone = $_POST['song_roleone'];


		$counttwo = 0;
		$album_idtwo = $_POST['albumtwo'];
		$generetwo = $_POST['generetwo'];
		$song_ratingtwo = "1";
		$song_roletwo = $_POST['song_roletwo'];
		$song_typetwo = $_POST['song_roletwo'];

		$countthree = 0;
		$album_idthree = $_POST['albumthree'];
		$generethree = $_POST['generethree'];
		$song_ratingthree = "1";
		$song_rolethree = $_POST['song_rolethree'];
		$song_typethree = $_POST['song_rolethree'];

		$countfour = 0;
		$album_idfour = $_POST['albumfour'];
		$generefour = $_POST['generefour'];
		$song_ratingfour = "1";
		$song_rolefour = $_POST['song_rolefour'];
		$song_typefour = $_POST['song_rolefour'];


		$countfive = 0;
		$album_idfive = $_POST['albumfive'];
		$generefive = $_POST['generefive'];
		$song_ratingfive = "1";
		$song_rolefive = $_POST['song_rolefive'];
		$song_typefive = $_POST['song_rolefive'];



		$count = 0;

		$fp = fopen($_FILES['songnameone']['tmp_name'], 'rb');
		    while ( ($line = fgets($fp)) !== false) {
		      $songnameone[] = $line;
		    }

			$songsone = $_FILES['songone']['name'];
			$lyricsone = $_FILES['lyricone']['name'];
			$imgsone = $_FILES['imageone']['name'];
			sort($songsone);
			sort($lyricsone);
			sort($imgsone);
			$upload_song_path = "../song/songs/";
			$upload_image_path = "../song/images/";
			$upload_lyric_path = "../song/lyrics/";

		$fp = fopen($_FILES['songnametwo']['tmp_name'], 'rb');
		    while ( ($line = fgets($fp)) !== false) {
		      $songnametwo[] = $line;
		    }

			$songstwo = $_FILES['songtwo']['name'];
			$lyricstwo = $_FILES['lyrictwo']['name'];
			$imgstwo = $_FILES['imagetwo']['name'];
			sort($songstwo);
			sort($lyricstwo);
			sort($imgstwo);


		$fp = fopen($_FILES['songnamethree']['tmp_name'], 'rb');
		    while ( ($line = fgets($fp)) !== false) {
		      $songnamethree[] = $line;
		    }

			$songsthree = $_FILES['songthree']['name'];
			$lyricsthree = $_FILES['lyricthree']['name'];
			$imgsthree = $_FILES['imagethree']['name'];
			sort($songsthree);
			sort($lyricsthree);
			sort($imgsthree);

		$fp = fopen($_FILES['songnamefour']['tmp_name'], 'rb');
		    while ( ($line = fgets($fp)) !== false) {
		      $songnamefour[] = $line;
		    }

			$songsfour = $_FILES['songfour']['name'];
			$lyricsfour = $_FILES['lyricfour']['name'];
			$imgsfour = $_FILES['imagefour']['name'];
			sort($songsfour);
			sort($lyricsfour);
			sort($imgsfour);

		$fp = fopen($_FILES['songnamefive']['tmp_name'], 'rb');
		    while ( ($line = fgets($fp)) !== false) {
		      $songnamefive[] = $line;
		    }

			$songsfive = $_FILES['songfive']['name'];
			$lyricsfive = $_FILES['lyricfive']['name'];
			$imgsfive = $_FILES['imagefive']['name'];
			sort($songsfive);
			sort($lyricsfive);
			sort($imgsfive);

		foreach ($songnameone as $i => $nameone) {

			$songone = $songsone[$i];
			$lyricone = $lyricsone[$i];
			$imgone = $imgsone[$i];

			$song_pathone = $serverpath . '/song/songs/'. $songone;
			$lyric_pathone = $serverpath . '/song/lyrics/'. $lyricone;
			$image_pathone = $serverpath . '/song/images/'. $imgone;

			if (move_uploaded_file($_FILES['songone']['tmp_name'][$i], $upload_song_path . $songone)) {
				if (move_uploaded_file($_FILES['lyricone']['tmp_name'][$i], $upload_lyric_path . $lyricone)) {
					if (move_uploaded_file($_FILES['imageone']['tmp_name'][$i], $upload_image_path . $imgone)) {
						$sql = "INSERT INTO `songs_bk`(`album_id`, `song_name`, `song_rating`, `song_favourite`, `genere_id`, `song_path`, `song_photo_path`, `lyric_path`, `song_role`) VALUES ('".$album_idone."', '".$nameone."', '".$song_ratingone."', '".$song_roleone."','".$genereone."', '".$song_pathone."', '".$lyric_pathone."', '".$image_pathone."', '".$song_roleone."')";
						$stmt = $db_con->prepare($sql);
						$stmt->execute();
						$count++;
					}
				}
			}
		}

		// ONE //

		foreach ($songnametwo as $i => $nametwo) {

			$songtwo = $songstwo[$i];
			$lyrictwo = $lyricstwo[$i];
			$imgtwo = $imgstwo[$i];

			$song_pathtwo = $serverpath . '/song/songs/'. $songtwo;
			$lyric_pathtwo = $serverpath . '/song/lyrics/'. $lyrictwo;
			$image_pathtwo = $serverpath . '/song/images/'. $imgtwo;

			if (move_uploaded_file($_FILES['songtwo']['tmp_name'][$i], $upload_song_path . $songtwo)) {
				if (move_uploaded_file($_FILES['lyrictwo']['tmp_name'][$i], $upload_lyric_path . $lyrictwo)) {
					if (move_uploaded_file($_FILES['imagetwo']['tmp_name'][$i], $upload_image_path . $imgtwo)) {
						$sql = "INSERT INTO `songs_bk`(`album_id`, `song_name`, `song_rating`, `song_favourite`, `genere_id`, `song_path`, `song_photo_path`, `lyric_path`, `song_role`) VALUES ('".$album_idtwo."', '".$nametwo."', '".$song_ratingtwo."', '".$song_roletwo."','".$generetwo."', '".$song_pathtwo."', '".$lyric_pathtwo."', '".$image_pathtwo."', '".$song_roletwo."')";
						$stmt = $db_con->prepare($sql);
						$stmt->execute();
						$counttwo++;
					}
				}
			}
		}


		foreach ($songnamethree as $i => $namethree) {

			$songthree = $songsthree[$i];
			$lyricthree = $lyricsthree[$i];
			$imgthree = $imgsthree[$i];

			$song_paththree = $serverpath . '/song/songs/'. $songthree;
			$lyric_paththree = $serverpath . '/song/lyrics/'. $lyricthree;
			$image_paththree = $serverpath . '/song/images/'. $imgthree;

			if (move_uploaded_file($_FILES['songthree']['tmp_name'][$i], $upload_song_path . $songthree)) {
				if (move_uploaded_file($_FILES['lyricthree']['tmp_name'][$i], $upload_lyric_path . $lyricthree)) {
					if (move_uploaded_file($_FILES['imagethree']['tmp_name'][$i], $upload_image_path . $imgthree)) {
						$sql = "INSERT INTO `songs_bk`(`album_id`, `song_name`, `song_rating`, `song_favourite`, `genere_id`, `song_path`, `song_photo_path`, `lyric_path`, `song_role`) VALUES ('".$album_idthree."', '".$namethree."', '".$song_ratingthree."', '".$song_rolethree."','".$generethree."', '".$song_paththree."', '".$lyric_paththree."', '".$image_paththree."', '".$song_rolethree."')";
						$stmt = $db_con->prepare($sql);
						$stmt->execute();
						$countthree++;
					}
				}
			}
		}


		foreach ($songnamefour as $i => $namefour) {

			$songfour = $songsfour[$i];
			$lyricfour = $lyricsfour[$i];
			$imgfour = $imgsfour[$i];

			$song_pathfour = $serverpath . '/song/songs/'. $songfour;
			$lyric_pathfour = $serverpath . '/song/lyrics/'. $lyricfour;
			$image_pathfour = $serverpath . '/song/images/'. $imgfour;

			if (move_uploaded_file($_FILES['songfour']['tmp_name'][$i], $upload_song_path . $songfour)) {
				if (move_uploaded_file($_FILES['lyricfour']['tmp_name'][$i], $upload_lyric_path . $lyricfour)) {
					if (move_uploaded_file($_FILES['imagefour']['tmp_name'][$i], $upload_image_path . $imgfour)) {
						$sql = "INSERT INTO `songs_bk`(`album_id`, `song_name`, `song_rating`, `song_favourite`, `genere_id`, `song_path`, `song_photo_path`, `lyric_path`, `song_role`) VALUES ('".$album_idfour."', '".$namefour."', '".$song_ratingfour."', '".$song_rolefour."','".$generefour."', '".$song_pathfour."', '".$lyric_pathfour."', '".$image_pathfour."', '".$song_rolefour."')";
						$stmt = $db_con->prepare($sql);
						$stmt->execute();
						$countfour++;
					}
				}
			}
		}


		foreach ($songnamefive as $i => $namefive) {

			$songfive = $songsfive[$i];
			$lyricfive = $lyricsfive[$i];
			$imgfive = $imgsfive[$i];

			$song_pathfive = $serverpath . '/song/songs/'. $songfive;
			$lyric_pathfive = $serverpath . '/song/lyrics/'. $lyricfive;
			$image_pathfive = $serverpath . '/song/images/'. $imgfive;

			if (move_uploaded_file($_FILES['songfive']['tmp_name'][$i], $upload_song_path . $songfive)) {
				if (move_uploaded_file($_FILES['lyricfive']['tmp_name'][$i], $upload_lyric_path . $lyricfive)) {
					if (move_uploaded_file($_FILES['imagefive']['tmp_name'][$i], $upload_image_path . $imgfive)) {
						$sql = "INSERT INTO `songs_bk`(`album_id`, `song_name`, `song_rating`, `song_favourite`, `genere_id`, `song_path`, `song_photo_path`, `lyric_path`, `song_role`) VALUES ('".$album_idfive."', '".$namefive."', '".$song_ratingfive."', '".$song_rolefive."','".$generefive."', '".$song_pathfive."', '".$lyric_pathfive."', '".$image_pathfive."', '".$song_rolefive."')";
						$stmt = $db_con->prepare($sql);
						$stmt->execute();
						$countfour++;
					}
				}
			}
		}



	} catch (PDOException $exception) {
		echo "Error: " . $exception->getMessage();
	}


?>