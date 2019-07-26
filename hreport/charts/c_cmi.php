<?php ob_start();
date_default_timezone_set('asia/bangkok');
include('db.php');
$todate2 = date('m')-1;
$todate3 = date('Y');
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

$data[] = array('เดือน','ค่า CMI');
$sql = " SELECT  CASE 
          WHEN date_part('MONTH' ,i.dchdate) = 1 THEN 'ม.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 2 THEN 'ก.พ.' 
          WHEN date_part('MONTH' ,i.dchdate) = 3 THEN 'มี.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 4 THEN 'เม.ย.'
          WHEN date_part('MONTH' ,i.dchdate) = 5 THEN 'พ.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 6 THEN 'มิ.ย'
          WHEN date_part('MONTH' ,i.dchdate) = 7 THEN 'ก.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 8 THEN 'ส.ค'
          WHEN date_part('MONTH' ,i.dchdate) = 9 THEN 'ก.ย.'
          WHEN date_part('MONTH' ,i.dchdate) = 10 THEN 'ต.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 11 THEN 'พ.ย.'
          WHEN date_part('MONTH' ,i.dchdate) = 12 THEN 'ธ.ค.'
          ELSE '-'
          END AS md 
          ,date_part('MONTH' ,i.dchdate) as dm
          ,date_part('YEAR' ,i.dchdate) as yy
          ,ROUND(avg(adjrw),4) cmi
         FROM ipt i
          left join pttype p1 on i.pttype = p1.pttype
         WHERE i.dchdate between '2018-10-01' AND '2019-09-30'
         GROUP BY md,dm ,yy 
         ORDER BY yy,dm ASC";
$query = pg_query($sql);
while($result = pg_fetch_array($query))
{
 $data[] = array($result['md'],(int)$result['cc']);
}
echo json_encode($data);
?>

