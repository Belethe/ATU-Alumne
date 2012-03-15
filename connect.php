<?php
	
	$dbhost = 'localhost';
	$dbuser = 'alumne';
	$dbpass = 'Kummefryser';

	$conn = mysql_connect($dbhost,$dbuser,$dbpass) or die(mysql_error());

	if(!isset($conn)) {
		die("Couldn't connect to database.");
	} else {
		mysql_select_db('alumne') or die (mysql_error());
	}
?>
