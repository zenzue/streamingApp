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

$table = 'play_log';
 
// Table's primary key
$primaryKey = 'play_log_id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes


// SELECT s.pub_song_id,sb.cust_phno,p.pub_name,ar.artist_name,s.song_name,pl.duration 
$columns = array(
    array( 'db' => '`s`.`pub_song_id`', 'dt' => 0, 'field' => 'pub_song_id' ),
    array( 'db' => '`sb`.`cust_phno`', 'dt' => 1, 'field' => 'cust_phno' ),
    array( 'db' => '`p`.`pub_name`', 'dt' => 2, 'field' => 'pub_name' ),
    array( 'db' => '`ar`.`artist_name`', 'dt' => 3, 'field' => 'artist_name' ),
    array( 'db' => '`s`.`song_name`', 'dt' => 4, 'field' => 'song_name' ),
    array( 'db' => '`pl`.`duration`', 'dt' => 5, 'field' => 'duration' ),
    array( 'db' => '`pl`.`play_log_time`', 'dt' => 6, 'field' => 'play_log_time' ),
 
    // array(
    //     'db'        => '`s`.`song_id`',
    //     'dt'        => 4,
    //     'field' => 'song_id',
    //     'formatter' => function( $d, $row ) {
    //         return '
    //             <div style="display:none;"">'.$d.'</div>
    //                 <div id="add-playlist" class="btn btn-primary">
    //                     <span class="glyphicon glyphicon-plus"></span> Add To Play List
    //             </div>
    //             <div style="display:none;"">'.$d.'</div>
    //                 <div id="edit-song" class="btn btn-primary">
    //                     <span class="glyphicon glyphicon-plus"></span> Edit
    //             </div>
    //         	<div class="song-id" style="display:none;"">'.$d.'</div>
    //                 <div id="delete-song" class="btn btn-danger delete-btn">
    //                     <span class="glyphicon glyphicon-remove"></span> Delete
    //                 </div>
	 	 //        ';
    //     }
    // )
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

    $joinQuery = "FROM `artists` as `ar` JOIN `albums` AS `al` ON `al`.`artist_id` = `ar`.`artist_id` JOIN `songs` AS `s` ON `s`.`album_id` = `al`.`album_id` JOIN `publisher` AS `p` on `p`.`pub_id` = `s`.`publisher_id` JOIN `play_log` AS `pl` ON `pl`.`song_id` = `s`.`song_id` JOIN `subscribe` AS `sb` ON `sb`.`cust_id` = `pl`.`cust_id`";


echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery )
);