 <?php 
  include('connect/db.php');

$query =" SELECT date_part('YEAR', o.vstdate)+543 as yy,date_part('MONTH', o.vstdate) as mm,
CASE
    WHEN date_part('MONTH', o.vstdate) = '01' THEN CONCAT('มกราคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '02' THEN CONCAT('กุมภาพันธ์',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '03' THEN CONCAT('มีนาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '04' THEN CONCAT('เมษายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '05' THEN CONCAT('พฤษภาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '06' THEN CONCAT('มิถุนายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '07' THEN CONCAT('กรกฎาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '08' THEN CONCAT('สิงหาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '09' THEN CONCAT('กันยายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '10' THEN CONCAT('ตุลาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '11' THEN CONCAT('พฤศจิกายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '12' THEN CONCAT('ธันวาคม',' ',date_part('YEAR', o.vstdate)+543)
    ELSE ''
END AS label
, count(*) as y
FROM ovst as o 
WHERE  date(o.vstdate )  BETWEEN '2019-10-01' AND '2020-09-30'
GROUP BY label,yy,mm
ORDER BY yy DESC ,mm ASC 
";
  $result = pg_query($conn, $query) or die ("Cannot execute query: $query\n");
  if (!$result) {
          echo "An error occurred.\n";
          exit;
  }
      $visit = pg_fetch_all($result);  


$query =" SELECT date_part('YEAR', o.vstdate)+543 as yy,date_part('MONTH', o.vstdate) as mm,
CASE
    WHEN date_part('MONTH', o.vstdate) = '01' THEN CONCAT('มกราคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '02' THEN CONCAT('กุมภาพันธ์',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '03' THEN CONCAT('มีนาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '04' THEN CONCAT('เมษายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '05' THEN CONCAT('พฤษภาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '06' THEN CONCAT('มิถุนายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '07' THEN CONCAT('กรกฎาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '08' THEN CONCAT('สิงหาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '09' THEN CONCAT('กันยายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '10' THEN CONCAT('ตุลาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '11' THEN CONCAT('พฤศจิกายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '12' THEN CONCAT('ธันวาคม',' ',date_part('YEAR', o.vstdate)+543)
    ELSE ''
END AS label
, count(DISTINCT hn ) as y
FROM ovst as o 
WHERE  date(o.vstdate )  BETWEEN '2019-10-01' AND '2020-09-30'
GROUP BY label,yy,mm
ORDER BY yy DESC ,mm ASC ";
  $result = pg_query($conn, $query) or die ("Cannot execute query: $query\n");
  if (!$result) {
          echo "An error occurred.\n";
          exit;
  }
      $hn = pg_fetch_all($result);  


$query =" SELECT date_part('YEAR', o.cancel_date)+543 as yy,date_part('MONTH', o.cancel_date) as mm,
CASE
    WHEN date_part('MONTH', o.cancel_date) = '01' THEN CONCAT('มกราคม',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '02' THEN CONCAT('กุมภาพันธ์',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '03' THEN CONCAT('มีนาคม',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '04' THEN CONCAT('เมษายน',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '05' THEN CONCAT('พฤษภาคม',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '06' THEN CONCAT('มิถุนายน',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '07' THEN CONCAT('กรกฎาคม',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '08' THEN CONCAT('สิงหาคม',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '09' THEN CONCAT('กันยายน',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '10' THEN CONCAT('ตุลาคม',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '11' THEN CONCAT('พฤศจิกายน',' ',date_part('YEAR', o.cancel_date)+543)
    WHEN date_part('MONTH', o.cancel_date) = '12' THEN CONCAT('ธันวาคม',' ',date_part('YEAR', o.cancel_date)+543)
    ELSE ''
END AS label
, count(*) as y
FROM ovst_cancel as o 
WHERE  date(o.cancel_date )  BETWEEN '2019-10-01' AND '2020-09-30'
GROUP BY label,yy,mm
ORDER BY yy DESC ,mm ASC ";
  $result = pg_query($conn, $query) or die ("Cannot execute query: $query\n");
  if (!$result) {
          echo "An error occurred.\n";
          exit;
  }
      $cancelvisit = pg_fetch_all($result);  

$query =" SELECT date_part('YEAR', o.vstdate)+543 as yy,date_part('MONTH', o.vstdate) as mm,
CASE
    WHEN date_part('MONTH', o.vstdate) = '01' THEN CONCAT('มกราคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '02' THEN CONCAT('กุมภาพันธ์',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '03' THEN CONCAT('มีนาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '04' THEN CONCAT('เมษายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '05' THEN CONCAT('พฤษภาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '06' THEN CONCAT('มิถุนายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '07' THEN CONCAT('กรกฎาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '08' THEN CONCAT('สิงหาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '09' THEN CONCAT('กันยายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '10' THEN CONCAT('ตุลาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '11' THEN CONCAT('พฤศจิกายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '12' THEN CONCAT('ธันวาคม',' ',date_part('YEAR', o.vstdate)+543)
    ELSE ''
END AS label
, count(*) as y
FROM ovst as o 
WHERE  date(o.vstdate )  BETWEEN '2019-10-01' AND '2020-09-30'
AND o.staff = 'kiosk'
GROUP BY label,yy,mm
ORDER BY yy DESC ,mm ASC ";
  $result = pg_query($conn, $query) or die ("Cannot execute query: $query\n");
  if (!$result) {
          echo "An error occurred.\n";
          exit;
  }
      $kiosk_y = pg_fetch_all($result); 

$query =" SELECT date_part('YEAR', o.vstdate)+543 as yy,date_part('MONTH', o.vstdate) as mm,
CASE
    WHEN date_part('MONTH', o.vstdate) = '01' THEN CONCAT('มกราคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '02' THEN CONCAT('กุมภาพันธ์',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '03' THEN CONCAT('มีนาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '04' THEN CONCAT('เมษายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '05' THEN CONCAT('พฤษภาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '06' THEN CONCAT('มิถุนายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '07' THEN CONCAT('กรกฎาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '08' THEN CONCAT('สิงหาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '09' THEN CONCAT('กันยายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '10' THEN CONCAT('ตุลาคม',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '11' THEN CONCAT('พฤศจิกายน',' ',date_part('YEAR', o.vstdate)+543)
    WHEN date_part('MONTH', o.vstdate) = '12' THEN CONCAT('ธันวาคม',' ',date_part('YEAR', o.vstdate)+543)
    ELSE ''
END AS label
, count(*) as y
FROM ovst as o 
WHERE  date(o.vstdate )  BETWEEN '2019-10-01' AND '2020-09-30'
AND o.staff <> 'kiosk'
GROUP BY label,yy,mm
ORDER BY yy DESC ,mm ASC ";
  $result = pg_query($conn, $query) or die ("Cannot execute query: $query\n");
  if (!$result) {
          echo "An error occurred.\n";
          exit;
  }
      $kiosk_n = pg_fetch_all($result); 
/*
$query10 =" SELECT 'จำนวน visit' as label, count(*) as y
FROM ovst as o 
WHERE o.vstdate BETWEEN '2019-10-01' AND '2019-10-31'
union
SELECT 'จำนวน hn' as label, count(DISTINCT hn) as y
FROM ovst as o 
WHERE o.vstdate BETWEEN '2019-10-01' AND '2019-10-31'
union
SELECT  ' ยกเลิก visit' as label, count(*) as y
FROM ovst_cancel
WHERE cancel_date BETWEEN '2019-10-01' AND '2019-10-31'
union
SELECT  'opdcard YES kiosk' as label, count(*) as y
FROM ovst 
WHERE vstdate BETWEEN '2019-10-01' AND '2019-10-31'
AND staff = 'kiosk'
union
SELECT  'opdcard NO kiosk' as label, count(*) as y
FROM ovst 
WHERE vstdate BETWEEN '2019-10-01' AND '2019-10-31'
AND staff <> 'kiosk'
union
SELECT  'จำหน่าย' as label, count(*) as y
FROM ipt
WHERE dchdate BETWEEN '2019-10-01' AND '2019-10-31'
union
SELECT  'ADMIT' as label, count(*) as y
FROM ipt
WHERE regdate BETWEEN '2019-10-01' AND '2019-10-31'
union
SELECT  'admit on' as label, count(*) as y
FROM ipt
WHERE dchdate is null;";
  $result10 = pg_query($conn, $query10) or die ("Cannot execute query: $query\n");
  if (!$result10) {
          echo "An error occurred.\n";
          exit;
  }
      $c_10 = pg_fetch_all($result10); 
 */     

?>