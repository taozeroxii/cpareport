
<?php 
include "conf.php";
function thf($datetime)
{
 if(!is_null($datetime))
 {
   list($date,$time) = split('T',$datetime);
   list($Y,$m,$d) = split('-',$date);
   $Y = $Y+543;
   switch($m)
   {
    case "01":$m = "มกราคม"; break;
    case "02":$m = "กุมภาพันธ์"; break;
    case "03":$m = "มีนาคม"; break;
    case "04":$m = "เมษายน"; break;
    case "05":$m = "พฤษภาคม"; break;
    case "06":$m = "มิถุนายน"; break;
    case "07":$m = "กรกฎาคม"; break;
    case "08":$m = "สิงหาคม"; break;
    case "09":$m = "กันยายน"; break;
    case "10":$m = "ตุลาคม"; break;
    case "11":$m = "พฤศจิกายน"; break;
    case "12":$m = "ธันวาคม"; break;
  }
  return $d." ".$m." ".$Y."";
}
return "";
}
$sql_rt = "SELECT ord as ord,type ,
sum (case when vstdate = CURRENT_DATE  then cc else 0 end )  as aa  ,
sum (case when vstdate = CURRENT_DATE -1 then cc  else 0 end )as bb    ,
sum (case when vstdate = CURRENT_DATE -2 then cc  else 0 end )as cc  ,
sum (case when vstdate = CURRENT_DATE -3 then cc  else 0 end )as dd  ,
sum (case when vstdate = CURRENT_DATE -4 then cc  else 0 end )as ee  
FROM(
SELECT '1' :: integer as ord,'ผู้รับบริการผู้ป่วยนอก OPD' as type,vstdate,count(hn)as cc FROM ovst where vstdate between CURRENT_DATE -4  and CURRENT_DATE 
GROUP BY vstdate ,ord 
UNION ALL
SELECT '2' :: integer as ord,'คลินิกระบบทางเดินหายใจ (ARI Clinic)' as type,vstdate,count(hn)as cc 
FROM ovst 
where vstdate between CURRENT_DATE -4  and CURRENT_DATE 
AND main_dep in ('396','397')
GROUP BY vstdate,ord 
UNION ALL
SELECT '3' :: integer as ord,'คลินิกระบบทางเดินหายใจ (ARI เจ้าหน้าที่ รพ.)' as type,a.vstdate,count(a.hn)as cc
FROM ovst AS a
INNER JOIN vn_stat AS b ON a.vn = b.vn
INNER JOIN patient AS p ON p.hn = a.hn
INNER JOIN doctor AS d ON p.cid = d.cid AND d.active = 'Y'
INNER JOIN provider_type AS v ON v.provider_type_code = d.provider_type_code
WHERE 1 = 1
AND a.vstdate BETWEEN  CURRENT_DATE -4  and CURRENT_DATE 
AND a.main_dep in ('396','397')
GROUP BY a.vstdate,ord 
UNION ALL
SELECT '4' :: integer as ord,'คลินิกระบบทางเดินหายใจ ( ช่วงอายุ น้อยกว่าหรือเท่ากับ 15 ปี)' as type,o.vstdate,count(o.hn)as cc 
FROM ovst as o 
INNER JOIN vn_stat as v on v.vn = o.vn
where o.vstdate between CURRENT_DATE -4  and CURRENT_DATE 
AND o.main_dep in ('396','397')
AND v.age_y <= '15'
GROUP BY o.vstdate,ord 
UNION ALL
SELECT '5' :: integer as ord,'คลินิกระบบทางเดินหายใจ (ช่วงอายุ มากกว่า 15 ปี)' as type,o.vstdate,count(o.hn)as cc 
FROM ovst as o 
INNER JOIN vn_stat as v on v.vn = o.vn
where o.vstdate between CURRENT_DATE -4  and CURRENT_DATE 
AND o.main_dep in ('396','397')
AND v.age_y > '15'
GROUP BY o.vstdate,ord 
UNION ALL
SELECT '6' :: integer as ord,'ผู้ป่วย Admit' as type,regdate,count(an) as cc  FROM ipt where regdate between CURRENT_DATE -4  and CURRENT_DATE 
GROUP BY regdate,ord  
UNION ALL
SELECT '7' :: integer as ord,'ผู้ป่วย จำหน่าย' as type,dchdate,count(an) as cc  FROM ipt WHERE  dchdate between CURRENT_DATE -4  and CURRENT_DATE
GROUP BY dchdate ,ord 
UNION ALL
select '8' :: integer as ord,'ผู้รับบริการ ผ่าตัด' as type,os.operation_request_date,count(*) as cc  from operation_set os where os.operation_request_date between CURRENT_DATE -4  and CURRENT_DATE 
GROUP BY os.operation_request_date ,ord 
UNION ALL
SELECT '9' :: integer as ord,'ผู้รับบริการ ทันตกรรม' as type,d1.vstdate,count(d1.dtmain_id) as cc  FROM dtmain d1 WHERE d1.vstdate BETWEEN CURRENT_DATE -4   and CURRENT_DATE 
GROUP BY vstdate,ord   
UNION ALL 
SELECT  '10' :: integer as ord,'Refer_in (รับเข้า)' as type,refer_date,count(*) as cc  FROM referin  WHERE refer_date BETWEEN CURRENT_DATE -4   and CURRENT_DATE 
GROUP BY refer_date,ord   
UNION ALL 
SELECT '11' :: integer as ord,'Refer_out (ส่งต่อ)' as type,refer_date,count(*) as cc FROM referout  WHERE refer_date  BETWEEN CURRENT_DATE -4   and CURRENT_DATE 
GROUP BY refer_date,ord  
)as OPD
GROUP BY TYPE,ord
ORDER BY ord;  ";
$result_rt = pg_query($sql_rt);
$curdate = strtotime("now");
$lastday = strtotime("last day");
$day_3 = strtotime("-2 day");
$day_4 = strtotime("-3 day");
$day_5 = strtotime("-4 day");
$dhc_rt = '<div class="container">
<table class="table">
<thead>
<tr>
<th class="text-center">#</th>
<th class="text-center">รายการ</th>
<th class="text-center">'.thf(date("Y-m-d",$curdate)) .'<sup class="text-danger"> ( ข้อมูลวันนี้ ) </sup></th>
<th class="text-center">'.thf(date("Y-m-d",$lastday)).'</th>
<th class="text-center">'.thf(date("Y-m-d",$day_3)).'</th>
<th class="text-center">'.thf(date("Y-m-d",$day_4)).'</th>
<th class="text-center">'.thf(date("Y-m-d",$day_5)).'</th>
</tr>';
while ($row_result = pg_fetch_assoc($result_rt)) {
 $dhc_rt .= 
 '<tr>
 <td class="">'.$row_result['ord'].' </td>
 <td class="">'.$row_result['type'].' </td>
 <td class="text-center">'.$row_result['aa'].'</td>
 <td class="text-center">'.$row_result['bb'].'</td>
 <td class="text-center">'.$row_result['cc'].'</td>
 <td class="text-center">'.$row_result['dd'].'</td>
 <td class="text-center">'.$row_result['ee'].'</td>
 </tr>
 <thead>
 </div>';
}
$dhc_rt .= '</table><hr>';
echo json_encode($dhc_rt);
?>
