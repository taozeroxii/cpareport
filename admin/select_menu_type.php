<?php
/*
 * connection database
 */
include "../config/pg_con.class.php";
include "../config/func.class.php";
include "../config/time.class.php";
include "../config/head.class.php"; 
include '../config/my_con.class.php';
/*
 * check POST
 */
 $menutypes = isset($_POST['menu_link']) ? $_POST['menu_link'] : "";
 $menut = "SELECT * FROM cpareport_report where report_name = '{$menutypes}' ";
 $qry = mysqli_query($con, $menut);
 $menutypeRes = mysqli_fetch_assoc($qry);

echo '<small style = "color:orange">'.$menutypeRes['paramitor1'].' '.$menutypeRes['paramitor2'].' '.$menutypeRes['paramitor3'].$menutypeRes['paramitor4'].'</small>';
?>
