<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="0;url=admin_uppass.php">
</head>
<body>
<?php
include 'connect.php';
date_default_timezone_set('asia/bangkok');
 $username = $_POST['username'];
 $sql = "  UPDATE network_ad_user SET flage = '1' WHERE username = '$id' ";
$query = mysql_query($sql);
?>  
    </body>
</html>