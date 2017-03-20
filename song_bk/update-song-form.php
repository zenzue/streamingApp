<?php

    include_once '../config/dbconfig.php';

    $song_id=isset($_GET['song_id']) ? $_GET['song_id'] : die('ERROR:Song ID not found.');
    $query = "SELECT song_id, album_id, song_name, song_rating, song_role, song_high_path,lyric FROM songs WHERE song_id = " .$song_id;
    $stmt = $db_con->prepare($query);
    if ($stmt->execute()) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $song_id = $row['song_id'];
        $album_id = $row['album_id'];
        $song_name = $row['song_name'];
        $song_role = $row['song_role'];
        $lyric = $row['lyric'];
        
    } else {
        echo "Unable to read record.";
    }

?>
<form id="update-song-form" method="POST" enctype="multipart/form-data" action="#">
        <div class="form-group">
            <label for='artistname'>Album Name</label>
                <?php
                    echo '<select id="album" class="form-control" name="album">';
                    $query = "SELECT * FROM albums";
                    $stmt = $db_con->prepare($query);
                    $stmt->execute();
                    $num = $stmt->rowCount();
                    if ($num > 0) {
                        while ($res_row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        //    echo '<option value="'. $row['album_id'] .'">'. $row['album_name'] .'</option>';
                            ?>
                        <option value="<?php echo $res_row['album_id']?>" <?php echo ($res_row['album_id'] == $album_id) ? 'selected' : ''; ?>><?php echo $res_row['album_name'];?></option>

                    <?php    }
                    }
                    echo '</select>';
                ?>
        </div>
        
        <div class="form-group">
            <label for="song_name">Song Name</label>
                <input type='text' id="song_name" name='song_name' class='form-control' value='<?php echo htmlspecialchars($song_name, ENT_QUOTES); ?>' required />
        </div>

        <div class="form-group">
            <label for='genere'>Genere</label>
            <?php
                echo '<select id="genere" class="form-control" name="genere">';
                $query = "SELECT * FROM genere";
                $stmt = $db_con->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
                if ($num > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo '<option value="'. $row['genere_id'] .'">'. $row['genere'] .'</option>';
                    }
                }
                echo '</select>';
            ?>
        </div>

        <div class="form-group">
            <label for="year">Year</label>
            <?php 
                $current_selected = date('Y');
                $earliest_year = 1950;
                $latest_year = date('Y');

                echo '<select class="form-control" id="year" name="year"> ';
                    foreach (range($latest_year, $earliest_year) as $i) {
                        echo '<option value="'.$i.'"'.($i===$current_selected ? 'selected="selected"' : '').' >'.$i.'</option>';
                    }
                echo '</select>';
            ?>
        </div>

        <div class="form-group">
            <label for="songname">Song Rating</label>
            <input id="rating-input" type="number" name="reating_input"/>

        </div>

        <div class="form-group">
            <label for="songname">Song Favourite Type</label>
            <div class="radio">
                <label><input type="radio" id="song_role" name="song_role" value="1" <?php if ($song_role == '1') {echo 'checked';}?> >Original</label>
                <label><input type="radio" id="song_role" name="song_role" value="2" <?php if ($song_role == '2') {echo 'checked';}?> >Myanmar Favourite</label>
                <label><input type="radio" id="song_role" name="song_role" value="3" <?php if ($song_role == '3') {echo 'checked';}?> >English Favourite</label>
                <label><input type="radio" id="song_role" name="song_role" value="4"<?php if ($song_role == '4') {echo 'checked';}?> >Korea Favourite</label>
                <label><input type="radio" id="song_role" name="song_role" value="5" <?php if ($song_role == '5') {echo 'checked';}?> >Thai Favourite</label>
                <label><input type="radio" id="song_role" name="song_role" value="6" <?php if ($song_role == '6') {echo 'checked';}?> >Japan Favourite</label>
            </div>
        </div>
        
        <div class="form-group">
        <img src=""
            <label for="song">Song</label>
                <input type='file' id="song" name='song' class='form-control' />
        </div>
        
        <div class="form-group">
            <label for="songlyric">Song Lyric</label>
            <textarea class="form-control" name ="song_lyric" id="song_lyric" rows="20" id="comment"> <?php echo $lyric; ?> </textarea>
        </div>

        <button type='submit' class='btn btn-primary'>
            <span class='glyphicon glyphicon-plus'></span> Update
        </button>
        <!-- hidden ID field so that we could identify what record is to be updated -->
        <input type='hidden' id="song_id" name='song_id' value='<?php echo $song_id ?>' />
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