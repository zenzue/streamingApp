<?php
    include_once '../config/dbconfig.php';
?>

<form id='create-album-song-form' action='create-song-album.php' method='POST' enctype="multipart/form-data" border='0'>
<div id="show-one">
    <div class="form-group">
        <label for='artistname'>Album Name</label>
        <?php
            echo '<select id="album" class="form-control" name="albumone">';
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
        <input type="file" class="form-control" id="songnameone" name="songnameone" placeholder="Album Name" required>
    </div>

    <div class="form-group">
        <label for='genere'>Genere</label>
        <?php
            echo '<select id="genere" class="form-control" name="genereone">';
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
        <label for="songname">Song Favourite Type</label>
        <div class="radio">
            <label><input type="radio" id="song_roleone" name="song_roleone" value="original" checked>Original</label>
            <label><input type="radio" id="song_roleone" name="song_roleone" value="local_favourite">Local Favourite</label>
            <label><input type="radio" id="song_roleone" name="song_roleone" value="foreign_favourite">Foreign Favourite</label>
        </div>
    </div>

    <div class="form-group">
        <label for="song">Song</label>
        <input type="file" class="form-control" id="songone" name="songone[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songlyric">Song Lyric</label>
        <input type="file" class="form-control" id="lyricone" name="lyricone[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songphoto">Song Photo</label>
        <input type="file" class="form-control" id="imageone" name="imageone[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>
<!--     <button type="submit" class="btn btn-primary">Save</button> -->
    <a id="btn-show-two" class="btn btn-default">Add More</a>
</div>

<div id="show-two">
    <hr>
    <div class="form-group">
        <label for='artistname'>Album Name</label>
        <?php
            echo '<select id="album" class="form-control" name="albumtwo">';
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
        <input type="file" class="form-control" id="songnametwo" name="songnametwo" placeholder="Album Name">
    </div>

    <div class="form-group">
        <label for='genere'>Genere</label>
        <?php
            echo '<select id="genere" class="form-control" name="generetwo">';
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
        <label for="songname">Song Favourite Type</label>
        <div class="radio">
            <label><input type="radio" id="song_roletwo" name="song_roletwo" value="original" checked>Original</label>
            <label><input type="radio" id="song_roletwo" name="song_roletwo" value="local_favourite">Local Favourite</label>
            <label><input type="radio" id="song_roletwo" name="song_roletwo" value="foreign_favourite">Foreign Favourite</label>
        </div>
    </div>

    <div class="form-group">
        <label for="song">Song</label>
        <input type="file" class="form-control" id="songtwo" name="songtwo[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songlyric">Song Lyric</label>
        <input type="file" class="form-control" id="lyrictwo" name="lyrictwo[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songphoto">Song Photo</label>
        <input type="file" class="form-control" id="imagetwo" name="imagetwo[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>
    <a id="btn-show-three" class="btn btn-default">Add More</a>
    <a id="btn-hide-two" class="btn btn-default">Remove</a>
</div>

<!-- three -->

<div id="show-three">
    <hr>
    <div class="form-group">
        <label for='artistname'>Album Name</label>
        <?php
            echo '<select id="album" class="form-control" name="albumthree">';
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
        <input type="file" class="form-control" id="songnamethree" name="songnamethree" placeholder="Album Name">
    </div>

    <div class="form-group">
        <label for='genere'>Genere</label>
        <?php
            echo '<select id="genere" class="form-control" name="generethree">';
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
        <label for="songname">Song Favourite Type</label>
        <div class="radio">
            <label><input type="radio" id="song_rolethree" name="song_rolethree" value="original" checked>Original</label>
            <label><input type="radio" id="song_rolethree" name="song_rolethree" value="local_favourite">Local Favourite</label>
            <label><input type="radio" id="song_rolethree" name="song_rolethree" value="foreign_favourite">Foreign Favourite</label>
        </div>
    </div>

    <div class="form-group">
        <label for="song">Song</label>
        <input type="file" class="form-control" id="songthree" name="songthree[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songlyric">Song Lyric</label>
        <input type="file" class="form-control" id="lyricthree" name="lyricthree[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songphoto">Song Photo</label>
        <input type="file" class="form-control" id="imagethree" name="imagethree[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>
    <a id="btn-show-four" class="btn btn-default">Add More</a>
    <a id="btn-hide-three" class="btn btn-default">Remove</a>
</div>

<!-- three -->

<!-- four -->


<div id="show-four">
    <hr>
    <div class="form-group">
        <label for='artistname'>Album Name</label>
        <?php
            echo '<select id="album" class="form-control" name="albumfour">';
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
        <input type="file" class="form-control" id="songnamefour" name="songnamefour" placeholder="Album Name">
    </div>

    <div class="form-group">
        <label for='genere'>Genere</label>
        <?php
            echo '<select id="genere" class="form-control" name="generefour">';
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
        <label for="songname">Song Favourite Type</label>
        <div class="radio">
            <label><input type="radio" id="song_rolefour" name="song_rolefour" value="original" checked>Original</label>
            <label><input type="radio" id="song_rolefour" name="song_rolefour" value="local_favourite">Local Favourite</label>
            <label><input type="radio" id="song_rolefour" name="song_rolefour" value="foreign_favourite">Foreign Favourite</label>
        </div>
    </div>

    <div class="form-group">
        <label for="song">Song</label>
        <input type="file" class="form-control" id="songfour" name="songfour[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songlyric">Song Lyric</label>
        <input type="file" class="form-control" id="lyricfour" name="lyricfour[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songphoto">Song Photo</label>
        <input type="file" class="form-control" id="imagefour" name="imagefour[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>
    <a id="btn-show-five" class="btn btn-default">Add More</a>
    <a id="btn-hide-four" class="btn btn-default">Remove</a>
</div>


<!-- four -->

<!-- five -->

<div id="show-five">
    <hr>
    <div class="form-group">
        <label for='artistname'>Album Name</label>
        <?php
            echo '<select id="album" class="form-control" name="albumfive">';
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
        <input type="file" class="form-control" id="songnamefive" name="songnamefive" placeholder="Album Name">
    </div>

    <div class="form-group">
        <label for='genere'>Genere</label>
        <?php
            echo '<select id="genere" class="form-control" name="generefive">';
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
        <label for="songname">Song Favourite Type</label>
        <div class="radio">
            <label><input type="radio" id="song_rolefive" name="song_rolefive" value="original" checked>Original</label>
            <label><input type="radio" id="song_rolefive" name="song_rolefive" value="local_favourite">Local Favourite</label>
            <label><input type="radio" id="song_rolefive" name="song_rolefive" value="foreign_favourite">Foreign Favourite</label>
        </div>
    </div>

    <div class="form-group">
        <label for="song">Song</label>
        <input type="file" class="form-control" id="songfive" name="songfive[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songlyric">Song Lyric</label>
        <input type="file" class="form-control" id="lyricfive" name="lyricfive[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <div class="form-group">
        <label for="songphoto">Song Photo</label>
        <input type="file" class="form-control" id="imagefive" name="imagefive[]" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>
    <a id="btn-hide-five" class="btn btn-default">Remove</a>
</div>


<!-- five -->

<hr>
<button type="submit" class="btn btn-primary">Save</button>

</form>

<script type="text/javascript">
    
    $(document).ready(function () {
        $('#show-two').hide();
        $('#show-three').hide();
        $('#show-four').hide();
        $('#show-five').hide();
        
        $('#btn-show-two').click(function () {
            $('#show-two').show();
        });
        
        $("#btn-hide-two").click(function () {
            $('#show-two').hide();
        });

        $('#btn-show-three').click(function () {
            $('#show-three').show();
        });

        $('#btn-hide-three').click(function () {
            $('#show-three').hide();
        });

        $('#btn-show-four').click(function () {
            $('#show-four').show();
        });
        $('#btn-hide-four').click(function () {
            $('#show-four').hide();
        });

        $('#btn-show-five').click(function () {
            $('#show-five').show();
        });

        $('#btn-hide-five').click(function () {
            $('#show-five').hide();
        })

    });

</script>