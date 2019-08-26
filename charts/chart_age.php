<?php
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

$data[] = array('age','จำนวณ_คน');
$sql = " SELECT '1.ต่ำกว่า 18 ปี' AS age,COUNT(*)AS จำนวณ_คน	FROM 
(SELECT ov.hn,age(pt.birthday) As age FROM ovst ov
inner join patient pt on pt.hn = ov.hn and EXTRACT(YEAR FROM age(pt.birthday)) < '18'
where ov.vstdate = CURRENT_DATE
group by ov.hn,age)AS LESS18
UNION ALL
SELECT '2.19-40 ปี' AS age, COUNT(*)AS BETWEEN19AND40	FROM 
(SELECT ov.hn,age(pt.birthday) As age FROM ovst ov
inner join patient pt on pt.hn = ov.hn and EXTRACT(YEAR FROM age(pt.birthday)) BETWEEN '18' AND '40'
where ov.vstdate = CURRENT_DATE
group by ov.hn,age
order by ov.hn)AS BETWEEN20AND40
UNION ALL	
SELECT '3.41-60 ปี' AS age,COUNT(*)AS BETWEEN41AND60	FROM 
(SELECT ov.hn,age(pt.birthday) As age FROM ovst ov
inner join patient pt on pt.hn = ov.hn and EXTRACT(YEAR FROM age(pt.birthday)) BETWEEN '41' AND '60'
where ov.vstdate = CURRENT_DATE
group by ov.hn,age)AS BETWEEN41AND60
UNION ALL
SELECT '4.60 -80 ปี' AS age,COUNT(*)AS morethan80	FROM 
(SELECT ov.hn,age(pt.birthday) As age FROM ovst ov
inner join patient pt on pt.hn = ov.hn and EXTRACT(YEAR FROM age(pt.birthday))  BETWEEN '61' AND '80'
where ov.vstdate = CURRENT_DATE
group by ov.hn,age)AS BETWEEN61AND80 
UNION ALL
SELECT '5.มากกว่า 80 ปี' AS age,COUNT(*)AS morethan80	FROM 
(SELECT ov.hn,age(pt.birthday) As age FROM ovst ov
inner join patient pt on pt.hn = ov.hn and EXTRACT(YEAR FROM age(pt.birthday)) > '80'
where ov.vstdate = CURRENT_DATE
group by ov.hn,age)AS morethan80 
ORDER BY age; ";
$query = pg_query($sql);

while($result = pg_fetch_array($query))
{
$data[] = array($result['age'],(int)$result['จำนวณ_คน']);
  
}
echo json_encode($data);
?>
