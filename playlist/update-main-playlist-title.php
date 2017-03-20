<?php

    require_once "../config/dbconfig.php";
    $playlist_id=isset($_GET['playlist_id']) ? $_GET['playlist_id'] : die('ERROR: Playlist ID not found.');
    $query = "SELECT playlist_name, playlist_rating,playlist_photo FROM admin_playlist WHERE playlist_id = " .$playlist_id;
        $stmt = $db_con->prepare($query);
        if ($stmt->execute()) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $playlist_name = $row['playlist_name'];
            $photo = $row['playlist_photo'];
        } else {
            echo "Unable to read record.";
        }

?>
    <form id="update-main-playlist-title-form" method="POST" action="#">
        <div class="form-group">
            <label for="playlistname">Playlist Title Name</label>
            <input type="text" class="form-control" id="title_name" name="title_name" value="<?php echo htmlspecialchars($playlist_name, ENT_QUOTES); ?>" placeholder="Playlist Title Name" required>
        </div>

        <div class="form-group">
            <label for="titlephoto">Title Photo</label>
            <img src="<?php echo $photo;?>" style="width:70px;" />
            <input type="file" class="form-control" id="title_image" name="title_image">
        </div>
      
        <div class="form-group">
            <label for="playlistrating">Playlist Rating</label>
            <input id="rating-input" type="number" name="playlist_rating" />

        </div>
        <input type="hidden" name="playlist_id" value="<?php echo $playlist_id;?>"/>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        jQuery(document).ready(function () {
            
            $('#rating-input').rating({
                  min: 0,
                  max: 5,
                  step: 1,
                  size: 'sm'
               });
        });
    </script>