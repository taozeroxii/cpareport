<?php
ob_start();
date_default_timezone_set('asia/bangkok');
include('db.php');

$data[] = array('รหัสโรค','จำนวน');
$sql = " SELECT death_diag_1 as pdx,count(*) as cc
        FROM death
        WHERE 1 = 1
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