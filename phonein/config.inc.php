<?php
$objConnect = mysql_connect("172.16.0.251","report","report") or die("Error Connect to Database");
$objDB = mysql_select_db("cpareportdb");

mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
mysql_query("collation_connection = utf8_general_ci");
mysql_query("collation_database = utf8_general_ci");
mysql_query("collation_server = utf8_general_ci");

?>