<?php
include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";
include "config/sql.class.php";
include 'config/my_con.class.php';
session_start();
$useronline = session_id();
$time = 0;
date_default_timezone_set("Asia/Bangkok");
$now =  date('Y/m/d h:i:s a');
echo $ud = ("UPDATE useronline set status = 'offline',logoutdate_time = '".$now."' where username = '".$_SESSION['username'] ."' AND session = '$useronline'");
$uf = mysqli_query($con, $ud);
mysqli_query($con, $uf);
session_destroy();
header('location:../');
?>