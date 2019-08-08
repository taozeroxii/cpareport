<?php
date_default_timezone_set("Asia/Bangkok");
ob_start();
system('ipconfig /all');
$mycom=ob_get_contents(); 
ob_clean(); 
$cpm_name = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$findme = "Physical";
$pmac = strpos($mycom, $findme); 
$mac=substr($mycom,($pmac+36),17); 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$datelog = date('Y-m-d H:i:s')."<br>";

 $datetime_read = $datelog;
 $ip_addess 	= $ipaddress;
 $mac_addess 	= $mac;
 $com_name  	= $cpm_name;
 $type_join		= "1";
 $atv_code		= "Y";
 $func_code		= "N";


$servername = "172.16.0.251";
$usernamez   = "report";
$password   = "report";
$database   = "cpareportdb";
$conn = new mysqli($servername, $usernamez, $password, $database);
if ($conn->connect_errno) {
    die( "Failed to connect to MySQL : (" . $conn->connect_errno . ") " . $conn->connect_error);
}
$conn->set_charset("utf8");

$log = "INSERT INTO cpareport_logfile_read (com_name, type_join, ip_addess, mac_addess, datetime_read, atv_code, func_code) VALUES ('$com_name','$type_join','$ip_addess','$mac_addess','$datetime_read','$atv_code','$func_code')";
$query = mysqli_query($conn,$log); 
echo $log;
?>