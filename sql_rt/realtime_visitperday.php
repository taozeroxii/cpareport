<?php 
include "pg_con.class.php";
$resultall = ' ';
$sql_rt = " SELECT type,string_agg(date_cc,' || ' ORDER BY date_cc)as cc FROM (
	SELECT 'ผู้ป่วย OPD' as type,concat('วันที่ ',vstdate::TEXT,' จำนวน ',count(hn)::TEXT)as date_cc FROM ovst where vstdate between CURRENT_DATE -4  and CURRENT_DATE 
	GROUP BY vstdate 
	UNION ALL
	SELECT 'ผู้ป่วย admit ' as type,concat('วันที่ ',regdate::TEXT,' จำนวน ',count(an)::TEXT) as date_cc  FROM ipt where regdate between CURRENT_DATE -4  and CURRENT_DATE 
	GROUP BY regdate 
    UNION ALL
    SELECT 'ผู้ป่วย จำหน่าย' as type,concat('วันที่ ',dchdate::TEXT,' จำนวน ',count(an)::TEXT) as date_cc  FROM ipt WHERE  dchdate between CURRENT_DATE -4  and CURRENT_DATE
	GROUP BY dchdate 
	UNION ALL
	select 'ผู้ป่วย ผ่าตัด' as type,concat('วันที่ ',os.operation_request_date::TEXT,' จำนวน ',count(*)::TEXT) as date_cc  from operation_set os where os.operation_request_date between CURRENT_DATE -4  and CURRENT_DATE 
	GROUP BY os.operation_request_date 
	UNION ALL
	SELECT 'ผู้ป่วย ทันตกรรม' as type,concat('วันที่ ',d1.vstdate::TEXT,' จำนวน ',count(d1.dtmain_id)::TEXT) as date_cc  FROM dtmain d1 WHERE d1.vstdate BETWEEN CURRENT_DATE -4   and CURRENT_DATE 
	GROUP BY vstdate  
    UNION ALL
    SELECT  'refer_in' as type,concat('วันที่ ',refer_date::TEXT,' จำนวน ',count(*)::TEXT) as date_cc  FROM referin  WHERE refer_date BETWEEN CURRENT_DATE -4   and CURRENT_DATE 
	GROUP BY refer_date 
    UNION ALL 
	SELECT 'refer_out' as type,concat('วันที่ ',refer_date::TEXT,' จำนวน ',count(*)::TEXT) as date_cc FROM referout  WHERE refer_date  BETWEEN CURRENT_DATE -4   and CURRENT_DATE 
	GROUP BY refer_date   
)as sss group by type   ";
$result_rt = pg_query($sql_rt);
//$row_rt = pg_fetch_array($result_rt);
$dhc_rt = '<br><table class="table table-bordered " style= "margin-left:9px"> <tr><th>รายการ</th><th>วันที่/จำนวน</th></tr>';
while ($row_result = pg_fetch_assoc($result_rt)) {
   $dhc_rt .= '<tr><td>'.$row_result['type'].' </td><td>'.$row_result['cc'].'<td/></tr>';
}
$dhc_rt .= '</table><br><hr>';
echo json_encode($dhc_rt);
