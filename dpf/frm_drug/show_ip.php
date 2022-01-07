<?php
session_start();
include('my_con.class.php');
date_default_timezone_set("Asia/Bangkok");
$subItems = " SELECT DISTINCT view_ip FROM index_menu_cmax_log ORDER BY id DESC limit 10 ";
$res      = mysqli_query($con, $subItems);
foreach ($res as $subItem) {
  echo  " <img src='assets/vendors/svg-loaders/rings.svg' class='me-4' style='width: 3rem' alt='audio'>".$menu_name  = $subItem['view_ip']."<br>";
}
?>
