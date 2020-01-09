<?php ob_start();
date_default_timezone_set('asia/bangkok');
include('db.php');
include('/../config/yd.php');



/*
if ($todate2 == 0) 
{
   $todate2 = 12;
   $todate3 = $todate3-1;
}
$todate = $todate3."-".$todate2."-";
if ($todate2 == 1 or $todate2 ==3 or $todate2 ==5 or $todate2 ==7 or $todate2 ==8 or $todate2 ==10 or $todate2 ==12) 
{
  $datein = $todate."1";
  $dateout = $todate."31";
}
elseif ($todate2 == 4 or $todate2 ==6 or $todate2 ==9 or $todate2 ==11) 
{
  $datein = $todate."1";
  $dateout = $todate."30";
}
elseif ($todate2 == 2 ) 
{
  $datein = $todate."1";
  if ($todate3 %4 == 0) $dateout = $todate."29";
  else $dateout == $todate."28";
}


$todate_mback_start = $datein;
$todate_mback_stop  = $dateout;
*/




$data[] = array('เดือน','จำนวนจำหน่าย');
$sql = " SELECT  CASE 
WHEN date_part('MONTH' ,dchdate) = 1 THEN 'ม.ค.'
WHEN date_part('MONTH' ,dchdate) = 2 THEN 'ก.พ.' 
WHEN date_part('MONTH' ,dchdate) = 3 THEN 'มี.ค.'
WHEN date_part('MONTH' ,dchdate) = 4 THEN 'เม.ย.'
WHEN date_part('MONTH' ,dchdate) = 5 THEN 'พ.ค.'
WHEN date_part('MONTH' ,dchdate) = 6 THEN 'มิ.ย'
WHEN date_part('MONTH' ,dchdate) = 7 THEN 'ก.ค.'
WHEN date_part('MONTH' ,dchdate) = 8 THEN 'ส.ค'
WHEN date_part('MONTH' ,dchdate) = 9 THEN 'ก.ย.'
WHEN date_part('MONTH' ,dchdate) = 10 THEN 'ต.ค.'
WHEN date_part('MONTH' ,dchdate) = 11 THEN 'พ.ย.'
WHEN date_part('MONTH' ,dchdate) = 12 THEN 'ธ.ค.'
ELSE '-'
END AS md 
,date_part('MONTH' ,dchdate) as dm
,date_part('YEAR'  ,dchdate) as dy
,count(an)as cc 
 FROM ipt 
 WHERE dchdate between '".$yd."'
 GROUP BY md,dm,dy  
 ORDER BY dy,dm ASC ";
$query = pg_query($sql);
//echo $sql;
while($result = pg_fetch_array($query))
{
 $data[] = array($result['md'],(int)$result['cc']);
}
echo json_encode($data);

?>
