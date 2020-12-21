<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
include 'connect.php';
date_default_timezone_set('asia/bangkok');
$username = $_GET['username'];
 $sql = "  UPDATE network_ad_user SET flage = '1' WHERE username = '$username' ";
$query = mysql_query($sql);
?>  
    </body>
</html>
<SCRIPT LANGUAGE='JavaScript'>
        window.alert('เพิ่มรายการสำเร็จครับ...');
        window.location="admin_uppass.php";
</SCRIPT>