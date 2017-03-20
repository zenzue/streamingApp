<?php

	$db_host = "localhost";
	$db_name = "song_ringtune";
	$db_user = "root";
	// $db_pass = "neOrIbcytTal";
	$db_pass = "password";
	
	try{
		
		$db_con = new PDO("mysql:host={$db_host};dbname={$db_name};charset=utf8",$db_user,$db_pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}


?>

