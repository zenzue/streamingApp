<table id="main-playlist" class="display" cellspacing="0" width="100%">
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
        $('#main-playlist').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "./main_playlist_data_table.php"
        } );
    } );

</script>