<?php ob_start();
date_default_timezone_set('asia/bangkok');
include('db.php');
include('/../config/yd.php');

$data[] = array('เดือน','จำนวนเสียชีวิต');
$sql = " SELECT  CASE 
WHEN date_part('MONTH' ,d.death_date) = 1 THEN 'ม.ค.'
WHEN date_part('MONTH' ,d.death_date) = 2 THEN 'ก.พ.' 
WHEN date_part('MONTH' ,d.death_date) = 3 THEN 'มี.ค.'
WHEN date_part('MONTH' ,d.death_date) = 4 THEN 'เม.ย.'
WHEN date_part('MONTH' ,d.death_date) = 5 THEN 'พ.ค.'
WHEN date_part('MONTH' ,d.death_date) = 6 THEN 'มิ.ย'
WHEN date_part('MONTH' ,d.death_date) = 7 THEN 'ก.ค.'
WHEN date_part('MONTH' ,d.death_date) = 8 THEN 'ส.ค'
WHEN date_part('MONTH' ,d.death_date) = 9 THEN 'ก.ย.'
WHEN date_part('MONTH' ,d.death_date) = 10 THEN 'ต.ค.'
WHEN date_part('MONTH' ,d.death_date) = 11 THEN 'พ.ย.'
WHEN date_part('MONTH' ,d.death_date) = 12 THEN 'ธ.ค.'
ELSE '-'
END AS md 
,date_part('MONTH' ,d.death_date) as dm
,date_part('YEAR' ,d.death_date) as dy
 ,count(*) as cc
         FROM death d
         LEFT OUTER JOIN patient pt ON pt.hn = d.hn
         LEFT OUTER JOIN rpt_504_name c1 ON c1.ID = CAST ( COALESCE ( d.death_cause, '0' ) AS INTEGER )
         LEFT OUTER JOIN icd101 i1 ON i1.code = d.death_diag_1 
         WHERE d.death_date between '".$yd."'
         GROUP BY md,dm,dy  
          ORDER BY dy,dm ASC";
$query = pg_query($sql);
while($result = pg_fetch_array($query))
{
 $data[] = array($result['md'],(int)$result['cc']);
}
echo json_encode($data);
?>

