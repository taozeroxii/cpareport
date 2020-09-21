<?php
include 'connect.php';
date_default_timezone_set('asia/bangkok');
 $id = $_POST['id'];
 $sql = "  UPDATE network_ad_user SET status_pass = 'Y' WHERE username = '$id' ";
$query = mysql_query($sql);
//header("Location: admin_uppass.php");	
?>