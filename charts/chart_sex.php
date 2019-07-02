<?php ob_start();
date_default_timezone_set('asia/bangkok');
include('db.php');

$data[] = array('เดือน','จำนวนเสียชีวิต');
$sql = " SELECT s.name as aa ,COUNT(*) AS c_pttype
          FROM ovst as a
          INNER JOIN patient as b ON b.hn = a.hn 
          INNER JOIN sex as s ON s.code = b.sex
          WHERE a.vstdate = CURRENT_DATE 
          GROUP BY aa 
/*
          UNION

          SELECT 'ทั้งหมด' as  aa ,COUNT(*) AS c_pttype
          FROM ovst as a
          INNER JOIN patient as b ON b.hn = a.hn 
          WHERE a.vstdate = CURRENT_DATE
          GROUP BY aa */";
$query = pg_query($sql);
while($result = pg_fetch_array($query))
{
 $data[] = array($result['aa'],(int)$result['c_pttype']);
}
echo json_encode($data);
?>

