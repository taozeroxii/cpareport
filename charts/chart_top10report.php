<?php
include('db.php');
$data[] = array('ชื่อรายงาน','จำนวน');
$sql = " SELECT sql_file,cm.menu_sub,count(*)as cc FROM viewer v left join cpareport_menu cm on v.sql_file = cm.menu_file group by sql_file order by cc desc limit 10";
$query = mysqli_query($con,$sql);
while($result = mysqli_fetch_assoc($query))
{
$data[] = array($result['menu_sub'],(int)$result['cc']);
}
echo json_encode($data);
