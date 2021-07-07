<?php
header('Content-Type: application/json');
date_default_timezone_set('asia/bangkok');
$serverName = "172.16.0.251";
$userName = "report";
$userPassword = "report";
$dbName = "cpareportdb";

$conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);
$id_device = $_POST['id_device'];
$cstatus = $_POST['cstatus'];
$msg = $_POST['msg'];
$datecheck = DATE('Y-m-d H:i:s');
$usercheck = "Bear";


$sql = "INSERT INTO network_status_check (id_device, cstatus, msg, datecheck, usercheck) 
		VALUES ('".$id_device."','".$cstatus."','".$msg."','".$datecheck."','".$usercheck."')";
mysqli_set_charset($conn, "utf8");
$query = mysqli_query($conn, $sql);


if ($query) {
    echo json_encode(array('status' => '1', 'message' => 'Record add Successfully'));
} else {
    echo json_encode(array('status' => '0', 'message' => 'Error Insert Data!'));
}

mysqli_close($conn);
