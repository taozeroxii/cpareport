
<?php
        $connstring = "host=172.16.0.192 dbname=cpahdb user=iptscanview password=iptscanview";
        $conn = pg_connect($connstring);
        pg_set_client_encoding($conn, "utf8");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
$sql_rt = " SELECT 'DH0101' AS kpi_code
			,CONCAT(EXTRACT(YEAR FROM a.dchdate),'-',EXTRACT(MONTH FROM a.dchdate)) as kpi_ym
			,EXTRACT(YEAR FROM a.dchdate) as dch_y
			,EXTRACT(MONTH FROM a.dchdate) as dch_m
			,COUNT(*) as kpi_cal_a
			,COUNT(*) as kpi_cal_b
			-- ,COUNT(*) + COUNT(*) as kpi_cal_c
			FROM an_stat a
			WHERE a.dchdate BETWEEN '2019-11-01' AND '2019-11-30'
			GROUP BY kpi_ym,dch_y,dch_m; ";

$result_rt 	= pg_query($sql_rt);
$row_rt 	= pg_fetch_array($result_rt);

$kpi_code 	= $row_rt['kpi_code'];
$kpi_ym 	= $row_rt['kpi_ym'];
$dch_y 		= $row_rt['dch_y'];
$dch_m 		= $row_rt['dch_m'];
$kpi_cal_a 	= $row_rt['kpi_cal_a'];
$kpi_cal_b 	= $row_rt['kpi_cal_b'];

//echo json_encode($row_rt);
?>
<a href="sent_report.php?kpi_code=<?php echo $kpi_code;?>
						&kpi_ym=<?php echo $kpi_ym;?>
						&dch_y=<?php echo $dch_y;?>
						&dch_m=<?php echo $dch_m;?>
						&kpi_cal_a=<?php echo $kpi_cal_a;?>
						&kpi_cal_b=<?php echo $kpi_cal_b;?>
	" target="_blank"><?php echo $kpi_code; ?></a>

</body>
</html>





