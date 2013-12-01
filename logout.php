<?php
	
	include_once("config.php");
	unset($_SESSION['uid']);
	header("Location: index.php");

?>