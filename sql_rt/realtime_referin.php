<?php 
include "pg_con.class.php";
$sql_rt = " SELECT count(*) as cc FROM referin  WHERE refer_date = CURRENT_DATE; ";
$result_rt = pg_query($sql_rt);
$row_rt = pg_fetch_array($result_rt);
$dhc_rt = $row_rt['cc'];
echo json_encode($dhc_rt);
?>