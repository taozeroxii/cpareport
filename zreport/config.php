<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '10665');
define('DB_NAME', 'hreportdb');
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($link,"utf8");  
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
