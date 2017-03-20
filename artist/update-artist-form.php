<?php

	include_once '../config/dbconfig.php';

	$artist_id=isset($_GET['artist_id']) ? $_GET['artist_id'] : die('ERROR: Artist ID not found.');
	$query = "SELECT artist_id, artist_name,artist_title,artist_info, artist_photo FROM artists WHERE artist_id = " .$artist_id;
	$stmt = $db_con->prepare($query);
	if ($stmt->execute()) {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$artist_id = $row['artist_id'];
		$artist_name = $row['artist_name'];
		$artist_title = $row['artist_title'];
		$artist_info = $row['artist_info'];
		$photo = $row['artist_photo'];
		// $show_path = $row['show_path'];
  //       $file_name = $row['file_name'];
	} else {
		echo "Unable to read record.";
	}

?>

<form id="update-artist-form" method="POST" action="#">
    <div class="form-group">
        <label for="artistname">Artist Name</label>
        <input type="text" class="form-control" id="artist_name" name="artist_name" value='<?php echo htmlspecialchars($artist_name, ENT_QUOTES); ?>' placeholder="Artist Name" required>
    </div>

    <div class="form-group">
        <label for="artistphoto">Artist Photo</label>
    	<img src="<?php echo $photo;?>" style="width:70px;" />
        <input type="file" class="form-control" id="artist_image" name="artist_image">
    </div>
  
    <div class="form-group">
        <label for="artisttitle">Artist Title</label>
        <input type="text" class="form-control" id="artist_title" name="artist_title" value='<?php echo htmlspecialchars($artist_title, ENT_QUOTES); ?>' placeholder="Artist Title" required>
    </div>

    <div class="form-group">
        <label for="artistinfo">Artist Info</label>
        <textarea class="form-control" id="artist info" name="artist_info" rows="3"><?php echo htmlspecialchars($artist_info); ?></textarea>
    </div>
    <input type='hidden' id="artist_id" name='artist_id' value='<?php echo $artist_id ?>' />
    <button type="submit" class="btn btn-primary">Submit</button>
</form>