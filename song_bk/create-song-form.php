<?php
    include_once '../config/dbconfig.php';
?>


<form id='create-song-form' action='#' method='POST' enctype="multipart/form-data" border='0'>
    <div class="form-group">
        <label for='artistname'>Album Name</label>
        <?php
            echo '<select id="album" class="form-control" name="album">';
            $query = "SELECT * FROM albums";
            $stmt = $db_con->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo '<option value="'. $row['album_id'] .'">'. $row['album_name'] .'</option>';
                }
            }
            echo '</select>';
        ?>
    </div>
    <div class="form-group">
        <label for="songname">Song Name</label>
        <input type="text" class="form-control" id="song_name" name="song_name" placeholder="Song Name" required>
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

        $currently_selected = date('Y');
        $earliest_year = 1950; 
        $latest_year = date('Y'); 

        echo '<select class="form-control" id="year" name="year">';
          // Loops over each int[year] from current year, back to the $earliest_year [1950]
          foreach (range($latest_year, $earliest_year) as $i ) {
            // Prints the option with the next year in range.
            echo '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>';
          }
          echo '</select>';
    ?>

    </div>

    <div class="form-group">
        <label for="songname">Song Rating</label>
        <input id="rating-input" type="number" name="reating_input" />

    </div>

    <div class="form-group">
        <label for="songname">Song Favourite Type</label>
        <div class="radio">
            <label><input type="radio" id="song_role" name="song_role" value="1" checked>Original</label>
            <label><input type="radio" id="song_role" name="song_role" value="2">Myanmar Favourite</label>
            <label><input type="radio" id="song_role" name="song_role" value="3">English Favourite</label>
            <label><input type="radio" id="song_role" name="song_role" value="4">Korea Favourite</label>
            <label><input type="radio" id="song_role" name="song_role" value="5">Thai Favourite</label>
            <label><input type="radio" id="song_role" name="song_role" value="4">Japan Favourite</label>
        </div>
    </div>

    <div class="form-group">
        <label for="song">Song</label>
        <input type="file" class="form-control" id="song" name="song">
    </div>

    <div class="form-group">
        <label for="songlyric">Song Lyric</label>
        <textarea class="form-control" name ="song_lyric" id="song_lyric" rows="20" id="comment"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
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