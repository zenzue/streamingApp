
<?php
    
    $song_id = $_GET['song_id'];

?>
<div class="col-sm-6"></div>
<div class="col-sm-6">
    
    <button id="new-playlist">Create New</button>

</div>
<table id="playlist" class="display" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Playlist Name</th>
        <th style='text-align:center;'>Action</th>
    </tr>
</thead>
</table>

<script type="text/javascript">

    $(document).ready(function() {
        $('#playlist').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "./playlist_data_table.php"
        } );
    } );

</script>