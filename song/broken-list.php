
<table id="brk" class="display" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Artist Name</th>
        <th>Album Name</th>
        <th>Song Name</th>
        <th>Genere</th>
        <th>Publisher</th>
        <th>Date</th>
        <th style='text-align:center;'>Action</th>
    </tr>
</thead>
</table>

<script type="text/javascript">

    $(document).ready(function() {
        $('#brk').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "./broken-list-data-table.php"
        });
    } );

</script>