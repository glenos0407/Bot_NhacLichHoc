<?php
	$host = "localhost";
	$username = "id11841805_glensama";
	$password = "01265818918";
	$dbName = "id11841805_glensama";

	$connect = mysqli_connect($host,$username,$password,$dbName);

	if(!$connect){
		echo 'Not Connect !';
		die();
	}
?>
