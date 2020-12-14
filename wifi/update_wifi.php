<?php
 header( "location: checkwifi.php" );
    header('Content-Type: application/json');
    include 'config/db.php';
    date_default_timezone_set('Asia/Bangkok');
    
    $id  = $_GET['id'];
    $flage      = "OK";

	$sql = " UPDATE cpa_wifiauthen SET flage = '$flage' WHERE id = '$id' ";
if (mysqli_query($conn, $sql)) {
       // echo json_encode(array("statusCode"=>200));
  }else {
      //  echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);
    ?>