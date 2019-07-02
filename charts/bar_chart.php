<?php
include('db.php');
$data[] = array('ward','name');
$sql = "select * from ward";
$query = pg_query($sql);
while($result = pg_fetch_array($query))
{
$data[] = array($result['ward'],(int)$result['name']);
  
}




//	$data = array($data);			
echo json_encode($data);
?>
