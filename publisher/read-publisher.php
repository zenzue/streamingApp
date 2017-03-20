
<table id="publisher" class="display" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Publisher Name</th>
        <th style='text-align:center;'>Action</th>
    </tr>
</thead>
</table>





<script type="text/javascript">

	$(document).ready(function() {
	    $('#publisher').DataTable( {
	        "processing": true,
	        "serverSide": true,
	        "ajax": "./publisher_data_table.php"
	    } );
	} );

</script>