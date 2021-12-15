<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> </title>
</head>

<body>
    <?php
    $connstring = "host=172.16.0.192 dbname=cpahdb user=iptscanview password=iptscanview";
    $conn = pg_connect($connstring);
    pg_set_client_encoding($conn, "utf8");

    $start_date = '2021-10-01';
    $end_date   = '2021-10-30';

$sql_1 = " SELECT COUNT(DISTINCT vn) AS s1 
FROM vn_stat 
WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'UCS')
AND vstdate BETWEEN '$start_date' AND '$end_date' ";
$sql_2 = " SELECT COUNT(DISTINCT vn) AS s2 
FROM vn_stat 
WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'SSS')
AND vstdate BETWEEN '$start_date' AND '$end_date' ";
$sql_3 = " SELECT COUNT(DISTINCT vn) AS s3 
FROM vn_stat 
WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'OFC')
and vstdate BETWEEN '$start_date' AND '$end_date' ";
$sql_4 = " SELECT COUNT(DISTINCT vn) AS s4 
FROM vn_stat 
WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'LGO')
AND vstdate BETWEEN '$start_date' AND '$end_date' ";
$sql_5 = " SELECT COUNT(DISTINCT vn) AS s5 
FROM vn_stat 
WHERE vstdate BETWEEN '$start_date' AND '$end_date' ";
$sql_6 = " SELECT COUNT(DISTINCT hn) AS s6 FROM vn_stat WHERE vstdate BETWEEN '$start_date' AND '$end_date' ";
$sql_7 = " SELECT COUNT(DISTINCT vn) AS s7 
FROM ipt WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'UCS')
AND regdate BETWEEN '$start_date' AND '$end_date' ";
$sql_8 = " SELECT COUNT(DISTINCT vn) AS s8 
FROM ipt WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'SSS')
AND regdate BETWEEN '$start_date' AND '$end_date' ";
$sql_9 = " SELECT COUNT(DISTINCT vn) AS s9 
FROM ipt WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'OFC')
AND regdate BETWEEN '$start_date' AND '$end_date' ";
$sql_10 = " SELECT COUNT(DISTINCT vn) AS s10 
FROM ipt WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'LGO')
AND regdate BETWEEN '$start_date' AND '$end_date' ";
$sql_11 = " SELECT Count(DISTINCT vn) AS s11 FROM ipt WHERE regdate BETWEEN '$start_date' AND '$end_date' ";
$sql_12 = " SELECT SUM(CASE WHEN admdate = 0 THEN 1
ELSE admdate
END ) AS s12
FROM an_stat WHERE dchdate BETWEEN '$start_date' AND '$end_date' ";
$sql_13 = " SELECT COUNT(hn) AS s13
FROM death 
WHERE death_date BETWEEN '$start_date' AND '$end_date' ";
$sql_14 = " SELECT COUNT(DISTINCT hn) AS s14 FROM vn_stat WHERE vstdate BETWEEN '$start_date' AND '$end_date'  AND pdx IN ('E10','E14','I10','I15') ";
$sql_15 = " SELECT SUM(ipt.adjrw) AS s15 FROM ipt WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'UCS') AND dchdate BETWEEN '$start_date' AND '$end_date' ";
$sql_16 = " SELECT SUM(ipt.adjrw) AS s16 FROM ipt WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'SSS') AND dchdate BETWEEN '$start_date' AND '$end_date' ";
$sql_17 = " SELECT SUM(ipt.adjrw) AS s17 FROM ipt WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'OFC') AND dchdate BETWEEN '$start_date' AND '$end_date' ";
$sql_18 = " SELECT SUM(ipt.adjrw) AS s18 FROM ipt WHERE pttype IN (SELECT pttype FROM pttype WHERE hipdata_code = 'LGO') AND dchdate BETWEEN '$start_date' AND '$end_date'";
$sql_19 = " SELECT SUM(ipt.adjrw) AS s19 FROM ipt WHERE  dchdate BETWEEN '$start_date' AND '$end_date' ";
        
$result_1   = pg_query($sql_1);    
$result_2   = pg_query($sql_2);  
$result_3   = pg_query($sql_3);  
$result_4   = pg_query($sql_4);  
$result_5   = pg_query($sql_5);  
$result_6   = pg_query($sql_6);  
$result_7   = pg_query($sql_7);  
$result_8   = pg_query($sql_8);  
$result_9   = pg_query($sql_9);  
$result_10  = pg_query($sql_10);  
$result_11  = pg_query($sql_11);  
$result_12  = pg_query($sql_12);  
$result_13  = pg_query($sql_13);  
$result_14  = pg_query($sql_14);  
$result_15  = pg_query($sql_15);  
$result_16  = pg_query($sql_16);  
$result_17  = pg_query($sql_17);  
$result_18  = pg_query($sql_18);  
$result_19  = pg_query($sql_19);  

$row_1   = pg_fetch_array($result_1);    
$row_2   = pg_fetch_array($result_2);  
$row_3   = pg_fetch_array($result_3);  
$row_4   = pg_fetch_array($result_4);  
$row_5   = pg_fetch_array($result_5);  
$row_6   = pg_fetch_array($result_6);  
$row_7   = pg_fetch_array($result_7);  
$row_8   = pg_fetch_array($result_8);  
$row_9   = pg_fetch_array($result_9);  
$row_10  = pg_fetch_array($result_10);  
$row_11  = pg_fetch_array($result_11);  
$row_12  = pg_fetch_array($result_12);  
$row_13  = pg_fetch_array($result_13);  
$row_14  = pg_fetch_array($result_14);  
$row_15  = pg_fetch_array($result_15);  
$row_16  = pg_fetch_array($result_16);  
$row_17  = pg_fetch_array($result_17);  
$row_18  = pg_fetch_array($result_18);  
$row_19  = pg_fetch_array($result_19); 


   echo  $row_1['s1'];
   echo  $row_2['s2'];
   echo  $row_3['s3'];
   echo  $row_4['s4'];
   echo  $row_5['s5'];
   echo  $row_6['s6'];
   echo  $row_7['s7'];
   echo  $row_8['s8'];
   echo  $row_9['s9'];
   echo  $row_10['s10'];
   echo  $row_11['s11'];
   echo  $row_12['s12'];
   echo  $row_13['s13'];
   echo  $row_14['s14'];
   echo  $row_15['s15'];
   echo  $row_16['s16'];
   echo  $row_17['s17'];
   echo  $row_18['s19'];
   echo  $row_19['s19'];







/*
$sql_q =  $_POST['sql_q'];

$sql = " $sql_q ";
$result = pg_query($sql);

                while($row_result = pg_fetch_array($result)) 
                { 

               $row_result[$fieldname];
                              
                }
               
*/
?>

</body>
</html>


