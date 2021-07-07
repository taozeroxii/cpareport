<?php
header('Content-Type: application/json');
date_default_timezone_set('asia/bangkok');
$serverName = "172.16.0.251";
$userName = "report";
$userPassword = "report";
$dbName = "cpareportdb";

$conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);
$id_device = $_POST['id_device'];

$aa = $_POST['cstatus-aa'];
$bb = $_POST['cstatus-bb'];
$cc = $_POST['cstatus-cc'];
$dd = $_POST['cstatus-dd'];
$ee = $_POST['cstatus-ee'];
$ff = $_POST['cstatus-ff'];

if ($aa != "" ) {
   $cs = $aa;
  } elseif ($bb != "") {
    $cs = $bb;
  } elseif ($cc != "") {
    $cs = $cc;
  }elseif ($dd != "") {
    $cs = $dd;
  }elseif ($ee != "") {
    $cs = $ee;
  }elseif ($ff != "") {
    $cs = $ff;
  }else{
    $cs ="Y";
  }
$cstatus = $cs;

$msg = $_POST['msg'];
$datecheck = DATE('Y-m-d H:i:s');
$usercheck = "Bear";


$sql = "INSERT INTO network_status_check (id_device, cstatus, msg, datecheck, usercheck) 
		VALUES ('".$id_device."','".$cstatus."','".$msg."','".$datecheck."','".$usercheck."')";
mysqli_set_charset($conn, "utf8");
$query = mysqli_query($conn, $sql);


if ($query) {
    echo json_encode(array('status' => '1', 'message' => 'บันทึกการตรวจสอบ สำเร็จ'));
} else {
    echo json_encode(array('status' => '0', 'message' => 'ไม่สามารถบันทึกข้อมูลได้!'));
}

mysqli_close($conn);
