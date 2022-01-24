<?php
	$servername = "172.16.0.251";
	$username = "report";
	$password = "report";
	$db="cpareportdb";
	$conn = mysqli_connect($servername, $username, $password,$db);
	mysqli_set_charset($conn,"utf8");

?>