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

$objConnect = mysql_connect("172.16.0.251","report","report") or die("Error Connect to Database");
$objDB = mysql_select_db("cpareportdb");
$strSQL = "INSERT INTO cpareport_logfile_read ";
$strSQL .=" (com_name, type_join, ip_addess, mac_addess, datetime_read, atv_code, func_code) ";
$strSQL .=" VALUES ";
$strSQL .=" ('".$com_name."','".$type_join."','".$ip_addess."','".$mac_addess."','".$datetime_read."','".$atv_code."','".$func_code."')";

$objQuery = mysql_query($strSQL);

echo $strSQL;
if($objQuery)
{
	echo "Save Done.";
}
else
{
	echo "Error Save ";
} 
mysql_close($objConnect);
?>