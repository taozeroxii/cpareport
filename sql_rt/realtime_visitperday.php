<?php 
include "pg_con.class.php";

$sql_rt = "SELECT type ,
sum (case when vstdate = CURRENT_DATE  then cc else 0 end )  as ข้อมูลปัจจุบัน  ,
sum (case when vstdate = CURRENT_DATE -1 then cc  else 0 end )as ย้อนหลังหนึ่งวัน    ,
sum (case when vstdate = CURRENT_DATE -2 then cc  else 0 end )as ย้อนหลังสองวัน  ,
sum (case when vstdate = CURRENT_DATE -3 then cc  else 0 end )as ย้อนหลังสามวัน  ,
sum (case when vstdate = CURRENT_DATE -4 then cc  else 0 end )as ย้อนหลังสี่วัน  
FROM(
SELECT 'OPD' as type,vstdate,count(hn)as cc FROM ovst where vstdate between CURRENT_DATE -4  and CURRENT_DATE 
GROUP BY vstdate 
UNION ALL
SELECT 'admit' as type,regdate,count(an) as cc  FROM ipt where regdate between CURRENT_DATE -4  and CURRENT_DATE 
GROUP BY regdate 
UNION ALL
SELECT 'ผู้ป่วยจำหน่าย' as type,dchdate,count(an) as cc  FROM ipt WHERE  dchdate between CURRENT_DATE -4  and CURRENT_DATE
GROUP BY dchdate 
UNION ALL
select 'ผ่าตัด' as type,os.operation_request_date,count(*) as cc  from operation_set os where os.operation_request_date between CURRENT_DATE -4  and CURRENT_DATE 
GROUP BY os.operation_request_date 
UNION ALL
SELECT 'ทันตกรรม' as type,d1.vstdate,count(d1.dtmain_id) as cc  FROM dtmain d1 WHERE d1.vstdate BETWEEN CURRENT_DATE -4   and CURRENT_DATE 
GROUP BY vstdate  
UNION ALL 
SELECT  'refer_in' as type,refer_date,count(*) as cc  FROM referin  WHERE refer_date BETWEEN CURRENT_DATE -4   and CURRENT_DATE 
GROUP BY refer_date  
UNION ALL 
SELECT 'refer_out' as type,refer_date,count(*) as cc FROM referout  WHERE refer_date  BETWEEN CURRENT_DATE -4   and CURRENT_DATE 
GROUP BY refer_date  
)as OPD
GROUP BY TYPE;  ";
$result_rt = pg_query($sql_rt);

$curdate = strtotime("now");
$lastday = strtotime("last day");
$day_3 = strtotime("-2 day");
$day_4 = strtotime("-3 day");
$day_5 = strtotime("-4 day");

$dhc_rt = '<br><table class="table table-bordered " style= "margin-left:9px"> <tr>
	<th>รายการ</th>
	<th>'.date("Y-m-d",$curdate) .'</th>
	<th>'.date("Y/m/d",$lastday).'</th>
	<th>'.date("Y/m/d",$day_3).'</th>
	<th>'.date("Y/m/d",$day_4).'</th>
	<th>'.date("Y/m/d",$day_5).'</th>
</tr>';
while ($row_result = pg_fetch_assoc($result_rt)) {
   $dhc_rt .= 
   '<tr>
	   <td>'.$row_result['type'].' </td>
	   <td>'.$row_result['ข้อมูลปัจจุบัน'].'</td>
	   <td>'.$row_result['ย้อนหลังหนึ่งวัน'].'</td>
	   <td>'.$row_result['ย้อนหลังสองวัน'].'</td>
	   <td>'.$row_result['ย้อนหลังสามวัน'].'</td>
	   <td>'.$row_result['ย้อนหลังสี่วัน'].'</td>
   </tr>';
}
$dhc_rt .= '</table><br><hr>';
echo json_encode($dhc_rt);
