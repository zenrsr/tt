<?php
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="pathways_db";
	$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

	if(!$con)
	{
		die("falied to connect!");
	}
?>