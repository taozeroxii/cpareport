<?php
    header('Content-Type: application/json');
    include 'config/db.php';
    date_default_timezone_set('Asia/Bangkok');
    
    $name_send  = $_POST['name_send'];
    $dep        = $_POST['dep'];
    $phone      = $_POST['phone'];
    $cc         = $_POST['cc'];
    $startdate  = $_POST['startdate'];
    $wifi_name  = $_POST['wifi_name']; 
    $pay        = $_POST['pay'];
    $ment       = $_POST['ment'];
    $user_count = $_POST['user_count'];
    $enddate    = $_POST['enddate'];		
	    
    $ipupdate   =  $_SERVER['REMOTE_ADDR'];
    $MAC        = strtok($MAC, ' '); 
    $macupdate  = $MAC;
    $flage      = "Y";
    $type_main  = "Y";
    $expi       = "Y";
    $file_paht  = "Y";

	$sql = "INSERT INTO cpa_wifiauthen (name_send,dep,phone,cc,startdate,wifi_name,pay,ment,user_count,enddate,ipupdate,macupdate,flage,type_main,expi,file_paht) 
	VALUES ('$name_send','$dep','$phone','$cc','$startdate','$wifi_name','$pay','$ment','$user_count','$enddate','$ipupdate','$macupdate','$flage','$type_main','$expi','$file_paht')";
if (mysqli_query($conn, $sql)) {
        echo json_encode(array("statusCode"=>200));
  }else {
        echo json_encode(array("statusCode"=>201));
	}
    mysqli_close($conn);



$line       = "ขอใช้ Wi-Fi ABH-GUEST โดย : ".$name_send." จำนวนผู้ใช้ ".$user_count." ระหว่างวันที่ " .$startdate." ถึง ".$enddate."http://172.16.0.251/report/wifi/checkwifi.php";   
define('LINE_API',"https://notify-api.line.me/api/notify");
define('LINE_TOKEN','jthNhCWSp3XYNZxy5ZF29SecT0zvKuFBs2kmWQb7sWH');

function notify_message($message){

    $queryData = array('message' => $message);
    $queryData = http_build_query($queryData,'','&');
    $headerOptions = array(
        'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
        )
    );
    $context = stream_context_create($headerOptions);
    $result = file_get_contents(LINE_API,FALSE,$context);
    $res = json_decode($result);
    return $res;
}
$res = notify_message($line);
    
?>