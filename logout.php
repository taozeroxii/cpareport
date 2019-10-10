<?php
include "config/pg_con.class.php";
include "config/func.class.php";
include "config/time.class.php";
include "config/sql.class.php";
include 'config/my_con.class.php';
session_start();
$useronline = session_id();
$time = 0;
$ud = ("UPDATE useronline set time_online = '" . $time. "' where session = '".$useronline."' AND  username = '".$_SESSION['username'] ."'");
$uf = mysqli_query($con, $ud);
mysqli_query($con, $uf);
session_destroy();
header('location:index.php');
?>