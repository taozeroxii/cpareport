<?php
	/*header('Content-Type: application/json');
	$serverName = "172.16.0.251";
	$userName = "report";
	$userPassword = "report";
	$dbName = "cpareportdb";
	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);
*/
	$conn = new mysqli('172.16.0.251', 'report', 'report', 'cpareportdb');

	$kpi_code 		= $_POST['kpi_code'];
	$kpi_ym 		= trim($kpi_year).'-'.trim($kpi_month);
	$kpi_endym 		= "";
	$kpi_year 		= $_POST['kpi_year'];
	$kpi_month 		= $_POST['kpi_month'];
	$kpi_cal_a 		= $_POST['kpi_cal_a'];
	$kpi_cal_b 		= $_POST['kpi_cal_b'];
	$kpi_cal_c 		= ( $kpi_cal_a / $kpi_cal_b ) * 100;
	$kpi_order 		= "";
	$kpi_link 		= "";
	$kpi_status 	= "1";
	$kpi_dateupdate = date('Y-m-d H:i:s');
	$kpi_ipupdate 	= "";
	$kpi_sync 		= "";



	$sql = " INSERT INTO cpareport_kpi_data (kpi_code,kpi_ym,kpi_endym,kpi_year,kpi_month,kpi_cal_a,kpi_cal_b,kpi_cal_c,kpi_order,kpi_link,kpi_status,kpi_dateupdate,kpi_ipupdate,kpi_sync) 
	VALUES ('".$kpi_code."','".$kpi_ym."','".$kpi_endym."'
	,'".$kpi_year."','".$kpi_month."','".$kpi_cal_a."'
	,'".$kpi_cal_b."','".$kpi_cal_c."','".$kpi_order."'
	,'".$kpi_link."','".$kpi_status."','".$kpi_dateupdate."','".$kpi_ipupdate."','".$kpi_sync."')";

	if ($conn->query($sql) === TRUE) {
		echo "data inserted";
	}
	else 
	{
		echo "failed";
	}

?>