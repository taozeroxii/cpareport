<?php
include 'connect.php'; 
$sqlq      = " SELECT MAX(username) as maxid FROM network_ad_user WHERE username LIKE 'cpa%%'  ";
$querysql  = mysql_query($sqlq);
$resultmax = mysql_fetch_assoc($querysql);
$usernew    = substr($resultmax['maxid'], -3);

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

$query = mysql_query("insert into network_ad_user(firstname,lastname,username,email,department,password,telephone,jobtitle,company,vpn,ou,dateupdate,flage) 
                      values ('$firstname','$lastname','$username','$email','$department','$password','$telephone','$jobtitle','$company','$vpn','$ou','$dateupdate','$flage')");
echo "บันทึกข้อมูลของคุณ".$firstname." ".$lastname." สำเร็จ กรุณารอการยืนยันการใช้งาน";
mysql_close($connection);
?>