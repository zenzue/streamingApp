<?php
    
    $playlist_id = $_REQUEST['playlist_id'];
    $playlist_name = $_REQUEST['playlist_name'];

?>

<div class="page-header">
    <h1><?php echo $playlist_name;?></h1>
</div>

<input type="hidden" id="playlist_id" name="playlist_id" value="<?php echo $playlist_id;?>">
<input type="hidden" id="playlist_name" name="playlist_name" value="<?php echo $playlist_name;?>">

<table id="read-main-playlist-detail" class="display" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Artist Name</th>
        <th>Album Name</th>
        <th>Song Name</th>
        <th style='text-align:center;'>Action</th>
    </tr>
</thead>
</table>

<script type="text/javascript">

    $(document).ready(function() {
        $('#read-main-playlist-detail').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "./read_main_playlist_detail_data_table.php?playlist_id=<?php echo $playlist_id;?>"
        } );
    } );

</script>