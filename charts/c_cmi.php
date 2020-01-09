<?php ob_start();
date_default_timezone_set('asia/bangkok');
include('db.php');
include('/../config/yd.php');

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
         WHERE i.dchdate between '".$yd."'
         GROUP BY md,dm ,yy 
         ORDER BY yy,dm ASC";
$query = pg_query($sql);
while($result = pg_fetch_array($query))
{
 $data[] = array($result['md'],(int)$result['cc']);
}
echo json_encode($data);
?>

