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

$data[] = array('รหัสโรค','จำนวน');
$sql = " SELECT death_diag_1 as pdx,count(*) as cc
        FROM death
        WHERE death_date  between '".$datein."' AND '".$dateout."'
        AND death_diag_1 <> '' AND death_diag_1 is not null
        group by pdx
        order by cc desc 
        limit 10";
$query = pg_query($sql);
while($result = pg_fetch_array($query))
{
$data[] = array($result['pdx'],(int)$result['cc']);
  
}
echo json_encode($data);
?>
