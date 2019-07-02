<?php 
include "pg_con.class.php";
$sql_death = " SELECT 	count(*) as cc
			FROM death d
			LEFT OUTER JOIN patient pt ON pt.hn = d.hn
			LEFT OUTER JOIN rpt_504_name c1 ON c1.ID = CAST ( COALESCE ( d.death_cause, '0' ) AS INTEGER )
			LEFT OUTER JOIN icd101 i1 ON i1.code = d.death_diag_1 
			WHERE d.death_date = CURRENT_DATE; ";
$result_death = pg_query($sql_death);
$row_death = pg_fetch_array($result_death);
$dhc_death = $row_death['cc'];
echo json_encode($dhc_death);
?>