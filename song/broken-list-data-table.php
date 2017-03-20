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
// $table = 'songs';

$table = 'songs';
 
// Table's primary key
$primaryKey = 'song_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array( 'db' => '`ar`.`artist_name`', 'dt' => 0, 'field' => 'artist_name' ),
    array( 'db' => '`al`.`album_name`', 'dt' => 1, 'field' => 'album_name' ),
    array( 'db' => '`s`.`song_name`', 'dt' => 2, 'field' => 'song_name' ),
    array( 'db' => '`g`.`genere`', 'dt' => 3, 'field' => 'genere' ),
    array( 'db' => '`p`.`pub_name`', 'dt' => 4, 'field' => 'pub_name' ),
    array( 'db' => '`s`.`create_date`', 'dt' => 5, 'field' => 'create_date' ),
    array(
        'db'        => '`s`.`song_id`',
        'dt'        => 6,
        'field' => 'song_id',
        'formatter' => function( $d, $row ) {
            return '
                <div style="display:none;"">'.$d.'</div>
                    <div id="add-playlist" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span> Add To Play List
                </div>
                <div style="display:none;"">'.$d.'</div>
                    <div id="edit-song" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span> Edit
                </div>
            	<div class="song-id" style="display:none;"">'.$d.'</div>
                    <div id="delete-song" class="btn btn-danger delete-btn">
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

    // $joinQuery = "FROM `artists` AS `ar` JOIN `albums` AS `al` ON `ar`. `artist_id` = `al`.`artist_id` JOIN `songs` AS `s` ON `s`.`album_id` = `al`.`album_id` JOIN `publisher` as `p` ON p.pub_id = `s`.`publisher_id` WHERE `s`.`genere_id` = 0 OR `s`.`album_id` = 0";

$joinQuery = "from songs as s left join albums as al on al.album_id = s.album_id left join artists as ar on ar.artist_id = al.artist_id left join genere as g on g.genere_id = s.genere_id LEFT join publisher as p on p.pub_id = s.publisher_id WHERE s.album_id = 0 or s.genere_id = 0 or s.publisher_id = 0";


echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery )
);