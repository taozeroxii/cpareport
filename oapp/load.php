<?php
header("Content-type:application/json; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false); 
        $connect = "host=172.16.0.192 dbname=cpahdb user=iptscanview password=iptscanview";
        $conn = pg_connect($connect);
        pg_set_client_encoding($conn, "utf8");

//$cli = "คลินิกอายุรกรรม";
$cli = $_GET['cli'];        
$data = array();
$query = "SELECT o.nextdate,c.name,count(*) as total
          FROM oapp as o
          INNER JOIN clinic as c ON c.clinic = o.clinic
          WHERE o.nextdate > CURRENT_DATE
          AND c.name = '".$cli."'
          GROUP BY o.nextdate,c.name
          ORDER BY o.nextdate ASC ";
          $result = pg_query($query);
          while($row = pg_fetch_array($result)) 
{
 $data[] = array(
  //'title'   	=> $row["name"].' :: '.$row["total"],
  'title'    =>  " ".$row["total"]." ",
  'start'   	=> $row["nextdate"],
  //'ctotal'    => $row["total"]
  'ctotal'    => $row["name"]
 );
}
echo json_encode($data);
?>