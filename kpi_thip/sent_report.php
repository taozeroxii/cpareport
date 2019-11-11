<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
date_default_timezone_set("Asia/Bangkok");
$con = new mysqli("172.16.0.251", "report", "report", "cpareportdb");
mysqli_set_charset($con, "utf8");

 $kpi_code 		= $_GET['kpi_code'];
 $kpi_ym 		= $_GET['kpi_ym'];
 $kpi_y 		= $_GET['dch_y'];
 $kpi_m 		= $_GET['dch_m'];
 $kpi_cal_a 	= $_GET['kpi_cal_a'];
 $kpi_cal_b 	= $_GET['kpi_cal_b'];


$sql = "INSERT INTO cpareport_kpi_data (kpi_code, kpi_ym, kpi_year, kpi_month, kpi_cal_a, kpi_cal_b)
								VALUES (' $kpi_code', '$kpi_ym', '$kpi_y', '$kpi_m','$kpi_cal_a','$kpi_cal_b')";

if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();


?>

</body>
</html>
