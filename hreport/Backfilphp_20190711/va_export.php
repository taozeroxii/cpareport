<?php
header("Content-Disposition: attachment; filename=va".date(Ymd_His).".txt");
$objConnect = "host=172.16.11.13 dbname=cpahdb user=iptscanview password=iptscanview";
$conn = pg_connect($objConnect);
pg_set_client_encoding($conn, "utf8");

$ds = $_GET['ds'];
$dt = $_GET['de'];	

$filName = "va/va_".date(YmdHis).".txt";
$objWrite = fopen($filName, "w");

$strSQL = " SELECT p.cid,p.pname,p.fname,p.lname,to_char(p.birthday, 'DD/MM/YYYY')AS birthday,p.sex,p.addrpart AS address,p.moopart AS moo,t.addressid AS aid,'F' AS unit
,CASE
WHEN e.r01 = '20/20'  THEN '14'
WHEN e.r01 = '20/30'  THEN '6'
WHEN e.r01 = '20/40'  THEN '5'
WHEN e.r01 = '20/50'  THEN '4'
WHEN e.r01 = '20/70'  THEN '3'
WHEN e.r01 = '20/100' THEN '2'
WHEN e.r01 = '20/200' THEN '1'    
WHEN e.r01 = '15/200' THEN '17' 
WHEN e.r01 = '10/200' THEN '15' 
WHEN e.r01 = '5/200'  THEN '16' 
WHEN e.r01 = 'CF 3'   THEN '7'  
WHEN e.r01 = 'CF 2'   THEN '8'  
WHEN e.r01 = 'CF 1'   THEN '9'  
WHEN e.r01 = 'HM'     THEN '10' 
WHEN e.r01 = 'PJ'     THEN '11' 
WHEN e.r01 = 'PL'     THEN '12' 
WHEN e.r01 = 'no PL'  THEN '13' 
ELSE ' '
END AS va_r
,CASE
WHEN e.l01 = '20/20'  THEN '14'
WHEN e.l01 = '20/30'  THEN '6'
WHEN e.l01 = '20/40'  THEN '5'
WHEN e.l01 = '20/50'  THEN '4'
WHEN e.l01 = '20/70'  THEN '3'
WHEN e.l01 = '20/100' THEN '2'
WHEN e.l01 = '20/200' THEN '1'    
WHEN e.l01 = '15/200' THEN '17' 
WHEN e.l01 = '10/200' THEN '15' 
WHEN e.l01 = '5/200'  THEN '16' 
WHEN e.l01 = 'CF 3'   THEN '7'  
WHEN e.l01 = 'CF 2'   THEN '8'  
WHEN e.l01 = 'CF 1'   THEN '9'  
WHEN e.l01 = 'HM'     THEN '10' 
WHEN e.l01 = 'PJ'     THEN '11' 
WHEN e.l01 = 'PL'     THEN '12' 
WHEN e.l01 = 'no PL'  THEN '13'       
ELSE ' '
END AS va_l
-- ,o.vstdate AS va_date
,to_char(o.vstdate, 'YYYY/MM/DD')AS va_date
,'10665' AS hospcode
FROM ovst AS o
LEFT JOIN eye_screen AS e ON e.vn = o.vn
INNER JOIN patient AS p ON p.hn = o.hn
INNER JOIN thaiaddress AS t ON t.tmbpart = p.tmbpart AND t.amppart = p.amppart AND t.chwpart = p.chwpart 
WHERE o.vstdate BETWEEN '".$ds."' AND '".$dt."'
AND o.main_dep IN ('232','233','234','354','355')";
$objQuery = pg_query($strSQL);
$objdetail = pg_query($strSQL);
//	echo ("cid|pname|fname|lname|birthday|sex|address|moo|aid|unit|va_r|va_l|va_date|hospcode \r\n");	
while($objResult = pg_fetch_array($objQuery))
//	fwrite("cid|pname|fname|lname|birthday|sex|address|moo|aid|unit|va_r|va_l|va_date|hospcode \r\n");
{
	fwrite($objWrite, "$objResult[cid]|");
	fwrite($objWrite, "$objResult[pname]|");
	fwrite($objWrite, "$objResult[fname]|");
	fwrite($objWrite, "$objResult[lname]|");
	fwrite($objWrite, "$objResult[birthday]|");
	fwrite($objWrite, "$objResult[sex]|");
	fwrite($objWrite, "$objResult[address]|");
	fwrite($objWrite, "$objResult[moo]|");
	fwrite($objWrite, "$objResult[aid]|");
	fwrite($objWrite, "$objResult[unit]|");
	fwrite($objWrite, "$objResult[va_r]|");
	fwrite($objWrite, "$objResult[va_l]|");
	fwrite($objWrite, "$objResult[va_date]|");
	fwrite($objWrite, "$objResult[hospcode] \r\n");
}
fclose($objWrite);

echo "cid|pname|fname|lname|birthday|sex|address|moo|aid|unit|va_r|va_l|va_date|hospcode \r\n";	
while($objResult = pg_fetch_array($objdetail))

{
	echo $objResult['cid']."|";
	echo $objResult['pname']."|";
	echo $objResult['fname']."|";
	echo $objResult['lname']."|";
	echo $objResult['birthday']."|";
	echo $objResult['sex']."|";
	echo $objResult['address']."|";
	echo $objResult['moo']."|";
	echo $objResult['aid']."|";
	echo $objResult['unit']."|";
	echo $objResult['va_r']."|";
	echo $objResult['va_l']."|";
	echo $objResult['va_date']."|";
	echo$objResult['hospcode']." \r\n";
}
?>
