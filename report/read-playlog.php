
<table id="playlog" class="display" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>ID</th>
        <th>MSIDM</th>
        <th>Publisher</th>
        <th>Artist Name</th>
        <th>Song Name</th>
        <th>Duration</th>
        <th>Date</th>
<!--         <th style='text-align:center;'>Action</th> -->
    </tr>
</thead>
</table>

<script type="text/javascript">

    $(document).ready(function() {
        $('#playlog').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "./playlog_data_table.php"
        } );
    } );

</script>