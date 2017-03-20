<?php
    include_once '../config/dbconfig.php';
?>

<form id='bigupload-form' action='#' method='POST' enctype="multipart/form-data" border='0'>

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
        <label for="song">Upload Path</label>
        <!-- <input type="text" class="form-control" id="song" name="song"> -->
    	<input type="file" name="song[]" id="song" multiple="" directory="" webkitdirectory="" mozdirectory="">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>

</form>
