<?php
    include_once '../config/dbconfig.php';
?>

<form id='create-album-form' action='#' method='POST' enctype="multipart/form-data" border='0'>
    <div class="form-group">
        <label for='artistname'>Artist Name</label>
        <?php
            echo '<select id="artist" class="form-control" name="artist">';
            $query = "SELECT * FROM artists";
            $stmt = $db_con->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'. $row['artist_id'] .'">'. $row['artist_name'] .'</option>';
                }
            }
            echo '</select>';
        ?>
    </div>
    <div class="form-group">
        <label for="albumname">Album Name</label>
        <input type="text" class="form-control" id="album_name" name="album_name" placeholder="Album Name" required>
    </div>

    <div class="form-group">
        <label for="albumphoto">Album Photo</label>
        <input type="file" class="form-control" id="album_image" name="album_image">
    </div>
  
    <div class="form-group">
        <label for="albumtitle">Album Title</label>
        <input type="text" class="form-control" id="album_title" name="album_title" placeholder="Album Title" required>
    </div>

    <div class="form-group">
        <label for="albuminfo">Album Info</label>
        <textarea class="form-control" id="album_info" name="album_info" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>