<form id="create-artist-form" method="POST" action="#">
    <div class="form-group">
        <label for="artistname">Artist Name</label>
        <input type="text" class="form-control" id="artist_name" name="artist_name" placeholder="Artist Name" required>
    </div>

    <div class="form-group">
        <label for="artistphoto">Artist Photo</label>
        <input type="file" class="form-control" id="artist_image" name="artist_image">
    </div>
  
    <div class="form-group">
        <label for="artisttitle">Artist Title</label>
        <input type="text" class="form-control" id="artist_title" name="artist_title" placeholder="Artist Title" required>
    </div>

    <div class="form-group">
        <label for="artistinfo">Artist Info</label>
        <textarea class="form-control" id="artist info" name="artist_info" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>