<?php
include 'connect.php'; 
$sqlq      = " SELECT RIGHT(MAX(username),'5') as maxid 
                   -- MAX(username) as maxid 
               FROM network_ad_user 
               WHERE username LIKE 'cpa%%'  ";
$querysql  = mysqli_query($conn,$sqlq);
$resultmax = mysqli_fetch_assoc($querysql);
//$usernew    = substr($resultmax['maxid'], -3);
$usernew    = $resultmax['maxid'];

$firstname  = $_POST['firstname'];
$lastname   = $_POST['lastname'];
$email      = $_POST['email'];
$department = $_POST['department'];
$telephone  = $_POST['telephone'];
$jobtitle   = $_POST['jobtitle'];
$user       = $usernew+1;
$usernewadd = str_pad($user , 5, "0",STR_PAD_LEFT);
$username   = "cpa".$usernewadd;
$password   = "P@123456";
$company    = "CPA Hospital";
$vpn        = "N";
$ou         = "OU=CPA,DC=cpa,DC=local";
$dateupdate = DATE('Y-m-d H:i:s');
$flage      = "0";
$link_p = " http://172.16.0.251/report/network_ad_user_check/admin_uppass.php";

$line       = "เพิ่มข้อมูล ".$firstname." ".$lastname." USER:".$username." ".$link_p;

$status_pass = "N";

//$query = mysqli_query(
$result = $conn -> query("insert into network_ad_user(firstname,lastname,username,email,department,password,status_pass,telephone,jobtitle,company,vpn,ou,dateupdate,flage) 
                      values ('$firstname','$lastname','$username','$email','$department','$password','$status_pass','$telephone','$jobtitle','$company','$vpn','$ou','$dateupdate','$flage')");
echo "บันทึกข้อมูลของคุณ".$firstname." ".$lastname." สำเร็จ กรุณารอการยืนยันการใช้งาน";

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
mysqli_close($conn);
?>
