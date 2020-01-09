<?php ob_start();
date_default_timezone_set('asia/bangkok');
include('db.php');
include('/../config/yd.php');

$data[] = array('เดือน','จำนวนAdmit');
$sql = " SELECT  CASE 
WHEN date_part('MONTH' ,regdate) = 1 THEN 'ม.ค.'
WHEN date_part('MONTH' ,regdate) = 2 THEN 'ก.พ.' 
WHEN date_part('MONTH' ,regdate) = 3 THEN 'มี.ค.'
WHEN date_part('MONTH' ,regdate) = 4 THEN 'เม.ย.'
WHEN date_part('MONTH' ,regdate) = 5 THEN 'พ.ค.'
WHEN date_part('MONTH' ,regdate) = 6 THEN 'มิ.ย'
WHEN date_part('MONTH' ,regdate) = 7 THEN 'ก.ค.'
WHEN date_part('MONTH' ,regdate) = 8 THEN 'ส.ค'
WHEN date_part('MONTH' ,regdate) = 9 THEN 'ก.ย.'
WHEN date_part('MONTH' ,regdate) = 10 THEN 'ต.ค.'
WHEN date_part('MONTH' ,regdate) = 11 THEN 'พ.ย.'
WHEN date_part('MONTH' ,regdate) = 12 THEN 'ธ.ค.'
ELSE '-'
END AS md 
,date_part('MONTH' ,regdate) as dm
,date_part('YEAR'  ,regdate) as dy
 ,count(an) AS cc 
 FROM ipt 
 WHERE regdate between '".$yd."'
 GROUP BY md,dm,dy  
ORDER BY dy,dm ASC ";
$query = pg_query($sql);
while($result = pg_fetch_array($query))
{
 $data[] = array($result['md'],(int)$result['cc']);
}
echo json_encode($data);
?>

