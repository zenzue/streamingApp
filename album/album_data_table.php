<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'albums';
 
// Table's primary key
$primaryKey = 'album_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'album_name', 'dt' => 0 ),
    array( 'db' => 'album_title',  'dt' => 1 ),
    array( 'db' => 'album_info',   'dt' => 2 ),
    array(
        'db'        => 'album_id',
        'dt'        => 3,
        'formatter' => function( $d, $row ) {
            return '
            	<div class="album-id" style="display:none;"">'.$d.'</div>
	            	<div id="edit-album" class="btn btn-info edit-btn margin-right-1em">
		 	                <span class="glyphicon glyphicon-edit"></span> Edit
		 	        </div>
		 	        <div id="delete-album" class="btn btn-danger delete-btn">
		 	        	<span class="glyphicon glyphicon-remove"></span> Delete
		 	        </div>
	 	        ';
        }
    )
);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => 'password',
    'db'   => 'song_ringtune',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( '../ssp.customized.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);