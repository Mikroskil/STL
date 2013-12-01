<?php

	$koneksi = mysql_connect("localhost", "root", "");
	mysql_select_db("jadwal");
	session_start();

	if(!$koneksi)
		die("ERROR: " . mysql_error());
	
?>