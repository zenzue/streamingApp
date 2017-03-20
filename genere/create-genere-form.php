<form id="create-genere-form" method="POST" action="#" enctype="multipart/form-data">
    <div class="form-group">
        <label for="generename">Genere Name</label>
        <input type="text" class="form-control" id="genere_name" name="genere_name" placeholder="Genere Name" required>
    </div>

    <div class="form-group">
        <label for="genrephoto">Genere Photo</label>
        <input type="file" class="form-control" id="genere_image" name="genere_image">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>