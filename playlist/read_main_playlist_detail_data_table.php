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


$playlist_id = $_GET['playlist_id'];
$table = 'admin_playlist';
 
// Table's primary key
$primaryKey = 'playlist_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => '`ar`.`artist_name`', 'dt' => 0, 'field' => 'artist_name' ),
    array( 'db' => '`al`.`album_name`', 'dt' => 1, 'field' => 'album_name' ),
    array( 'db' => '`s`.`song_name`', 'dt' => 2, 'field' => 'song_name' ),
    array(
        'db'        => '`p`.`playlist_det_id`',
        'dt'        => 3,
        'field' => 'playlist_det_id',
        'formatter' => function( $d, $row ) {
            return '
                <div style="display:none;"">'.$d.'</div>
                <div class="playlist-det-id" style="display:none;"">'.$d.'</div>
                    <div id="delete-playlist" class="btn btn-danger delete-btn">
                        <span class="glyphicon glyphicon-remove"></span> Remove from playlist
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

    $joinQuery = "FROM `artists` AS `ar` JOIN `albums` AS `al` ON `ar`. `artist_id` = `al`.`artist_id` JOIN `songs` AS `s` ON `s`.`album_id` = `al`.`album_id` JOIN `admin_playlist_det` AS `p` ON `p`.`song_id` = `s`.`song_id` WHERE `p`.`playlist_id` = '".$playlist_id."'";


echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery )
);