<?php
	$servername = "172.16.0.21";
	$username = "root";
	$password = "Cpa@10665";
	$db="cpadb";
	$conn = mysqli_connect($servername, $username, $password,$db);
	mysqli_set_charset($conn,"utf8");

?>