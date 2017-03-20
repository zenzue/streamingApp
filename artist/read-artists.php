
<table id="artist" class="display" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Artist Name</th>
        <th>Artist Title</th>
        <th style="width:500px;">Artist Info</th>
        <th style='text-align:center;'>Action</th>
    </tr>
</thead>
</table>





<script type="text/javascript">

	$(document).ready(function() {
	    $('#artist').DataTable( {
	        "processing": true,
	        "serverSide": true,
	        "ajax": "./artist_data_table.php"
	    } );
	} );

</script>