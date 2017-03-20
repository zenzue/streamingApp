
<table id="album" class="display" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Album Name</th>
        <th>album Title</th>
        <th  style="width:500px;">Album Info</th>
        <th style='text-align:center;'>Action</th>
    </tr>
</thead>
</table>





<script type="text/javascript">

    $(document).ready(function() {
        $('#album').DataTable( {
            "processing": true,
            "serverSide": true,
            "autoWidth" : true,
            "ajax": "./album_data_table.php"
        } );
    } );

</script>