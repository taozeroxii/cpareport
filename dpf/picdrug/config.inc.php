<?php
// $objConnect = mysqli_connect("172.16.0.251","report","report") or die("Error Connect to Database");
$mysqli = new mysqli("172.16.0.251","report","report","cpareportdb");
$mysqli -> set_charset("utf8");
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
// $objDB = mysqli_select_db("cpareportdb");

// mysqli_query("SET character_set_results=utf8");
// mysqli_query("SET character_set_client=utf8");
// mysqli_query("SET character_set_connection=utf8");
// mysqli_query("collation_connection = utf8_general_ci");
// mysqli_query("collation_database = utf8_general_ci");
// mysqli_query("collation_server = utf8_general_ci");

?>