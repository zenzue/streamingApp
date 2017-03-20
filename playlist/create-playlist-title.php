<?php
    
    $song_id = $_GET['song_id'];

?>
<form id="create-playlist-title-form" method="POST" action="#">
    <div class="form-group">
        <label for="playlistname">Playlist Title Name</label>
        <input type="text" class="form-control" id="title_name" name="title_name" placeholder="Playlist Title Name" required>
    </div>

    <div class="form-group">
        <label for="titlephoto">Title Photo</label>
        <input type="file" class="form-control" id="title_image" name="title_image">
    </div>
  
    <div class="form-group">
        <label for="playlistrating">Playlist Rating</label>
        <input id="rating-input" type="number" name="playlist_rating" />

    </div>

    <input type="hidden" id="song_id" name="song_id" value="<?php echo $song_id;?>">

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