<?php
/*
$host = '172.16.0.251';
$user = 'report';
$password = 'report';
$database = 'cpareportdb';

$connection =  mysqli_connect($host, $user, $password);
$db = mysqli_select_db($database ,$connection);
mysqli_query("SET NAMES UTF8");
*/
/*
$mysqli = new mysqli("172.16.0.251","report","report","cpareportdb");
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
//   $mysqli->query('SET NAMES UTF8');
  mysqli_query($mysqli,"SET CHARACTER SET 'utf8'");
}
*/
$servername = '172.16.0.251';
$username = 'report';
$password = 'report';
$dbname = 'cpareportdb';
$conn = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");


?>