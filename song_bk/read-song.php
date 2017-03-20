
<table id="songs" class="display" cellspacing="0" width="100%">
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
        $('#songs').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "./song_data_table.php"
        } );
    } );

</script>