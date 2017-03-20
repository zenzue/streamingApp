<table id="genere" class="display" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Genere Name</th>
        <th style='text-align:center;'>Action</th>
    </tr>
</thead>
</table>





<script type="text/javascript">

	$(document).ready(function() {
	    $('#genere').DataTable( {
	        "processing": true,
	        "serverSide": true,
	        "ajax": "./genere_data_table.php"
	    } );
	} );

</script>