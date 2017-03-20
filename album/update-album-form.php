<?php

    include_once '../config/dbconfig.php';

    $album_id=isset($_GET['album_id']) ? $_GET['album_id'] : die('ERROR: Album ID not found.');
    $query = "SELECT album_id, artist_id, album_name, album_title, album_info, album_image FROM albums WHERE album_id = " .$album_id;
    $stmt = $db_con->prepare($query);
    if ($stmt->execute()) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $album_id = $row['album_id'];
        $artist_id = $row['artist_id'];
        $album_name = $row['album_name'];
        $album_title = $row['album_title'];
        $album_info = $row['album_info'];
        $show_path = $row['album_image'];
        // $file_name = $row['file_name'];
    } else {
        echo "Unable to read record.";
    }

?>

<form id='update-album-form' action='#' method='POST' enctype="multipart/form-data" border='0'>
    <div class="form-group">
        <label for='artistname'>Artist Name</label>
        
        <?php
            echo '<select id="artist" class="form-control" name="artist">';
            $query = "SELECT * FROM artists";
            $stmt = $db_con->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num > 0) {
                while ($res_row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    //echo '<option value="'. $row['artist_id'] .'">'. $row['artist_name'] .'</option>';
                    ?>
                    <option value="<?php echo $res_row['artist_id']?>" <?php echo ($res_row['artist_id'] == $artist_id) ? 'selected' : ''; ?>><?php echo $res_row['artist_name'];?></option>
            <?php    }
            }
            echo '</select>';
        ?>
        
    </div>
    <div class="form-group">
        <label for="albumname">Album Name</label>
        <input type="text" class="form-control" id="album_name" name="album_name" placeholder="Album Name" value='<?php echo htmlspecialchars($album_name, ENT_QUOTES); ?>' required>
    </div>

    <div class="form-group">
        <img src="<?php echo $show_path;?>" style="width:70px;" />
       <!--  <input type="hidden" id="upd_album_img" name="upd_album_img" value="<?php //echo $picture;?>"/>
        <input type="hidden" name="file_name" value="<?php //echo $file_name;?>"> -->
        <input type="hidden" name="album_id" value='<?php echo $album_id;?>'>
        <label for="albumphoto">Album Photo</label>
        <input type="file" class="form-control" id="album_image" name="album_image">
    </div>
  
    <div class="form-group">
        <label for="albumtitle">Album Title</label>
        <input type="text" class="form-control" id="album_title" name="album_title" placeholder="Album Title" value='<?php echo htmlspecialchars($album_title, ENT_QUOTES); ?>' required>
    </div>

    <div class="form-group">
        <label for="albuminfo">Album Info</label>
        <textarea class="form-control" id="album_info" name="album_info" rows="3"><?php echo htmlspecialchars($album_info, ENT_QUOTES); ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>