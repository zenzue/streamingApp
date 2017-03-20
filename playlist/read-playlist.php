
<?php
    
    $song_id = $_GET['song_id'];
?>

<table id="playlist" class="display" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Playlist Name</th>
        <th>Playlist Rating</th>
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