<?php
$con = MySQLi_connect(
   "172.16.0.251", 
   "report",
   "report",
   "cpareportdb"
);
if (MySQLi_connect_errno()) {
   echo "Failed to connect to MySQL: " . MySQLi_connect_error();
}
   mysqli_set_charset($con,"utf8");
?>