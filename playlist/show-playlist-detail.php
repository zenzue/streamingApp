
<?php
    
    $playlist_id = $_GET['playlist_id'];
    $playlist_name = $_GET['playlist_name'];

    echo $playlist_id;
    echo '=========';
    echo $playlist_name;
?>

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