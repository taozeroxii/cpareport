<!-- SELECT count(an)as cc FROM ipt WHERE  dchdate IS NULL; -->
<?php 
include "pg_con.class.php";
$sql_rt = " SELECT count(an)as cc FROM ipt WHERE  dchdate IS NULL; ";
$result_rt = pg_query($sql_rt);
$row_rt = pg_fetch_array($result_rt);
$dhc_rt = 495- $row_rt['cc'];
echo json_encode($dhc_rt);
?>