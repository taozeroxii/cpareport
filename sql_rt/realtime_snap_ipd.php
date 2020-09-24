
<?php 
include "pg_con.class.php";

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
$sql_rt = "SELECT
spclty.NAME as แผนก,ipt.ward as codeward, w.NAME  AS ward ,count(ipt.an)as จำนวนคนนอน
,(select count(an) from an_stat where regdate = CURRENT_DATE AND ward = ipt.ward)as รับเข้าในวัน
,(select count(an) from an_stat where dchdate = CURRENT_DATE AND ward = ipt.ward)as จำหน่ายในวัน
FROM
ipt
LEFT OUTER JOIN spclty ON spclty.spclty = ipt.spclty
LEFT OUTER JOIN iptadm ON iptadm.an = ipt.an
LEFT OUTER JOIN bedno bn ON bn.bedno = iptadm.bedno
LEFT OUTER JOIN patient ON patient.hn = ipt.hn
LEFT OUTER JOIN ipt_reg_infection ii ON ii.an = ipt.an
LEFT OUTER JOIN doctor dt ON dt.code = ipt.admdoctor
LEFT OUTER JOIN roomno ON roomno.roomno = iptadm.roomno
LEFT OUTER JOIN iptdiag ON iptdiag.an = ipt.an 
AND iptdiag.diagtype = '1'
LEFT OUTER JOIN icd101 i1 ON i1.code = SUBSTRING ( iptdiag.icd10, 1, 3 )
LEFT OUTER JOIN an_stat aa ON aa.an = ipt.an
LEFT OUTER JOIN ipt_pttype_check ic ON ic.an = ipt.an
LEFT OUTER JOIN pttype_check_status pcs ON pcs.pttype_check_status_id = ic.pttype_check_status_id
LEFT OUTER JOIN ward w ON w.ward = ipt.ward 
LEFT OUTER JOIN dchtype dc1 ON dc1.dchtype = ipt.dchtype
LEFT OUTER JOIN dchstts dc2 ON dc2.dchstts = ipt.dchstts
LEFT OUTER JOIN ipt_finance_status fs ON fs.an = ipt.an
LEFT OUTER JOIN finance_status ft ON ft.finance_status = fs.finance_status
LEFT OUTER JOIN doctor di ON di.code = ipt.incharge_doctor
LEFT OUTER JOIN ipt_admit_type ia ON ia.ipt_admit_type_id = ipt.ipt_admit_type_id
LEFT OUTER JOIN ipt_newborn i4 ON i4.an = ipt.an
LEFT OUTER JOIN ipt_labour i6 ON i6.an = ipt.an
LEFT OUTER JOIN ipt_discharge id1 ON id1.an = ipt.an
LEFT OUTER JOIN doctor d4 ON d4.code = i4.doctor
LEFT OUTER JOIN doctor d6 ON d6.code = ipt.dch_doctor
LEFT OUTER JOIN ipt_pttype ip1 ON ip1.an = ipt.an 
AND ip1.pttype_number = 1
LEFT OUTER JOIN hospcode hc1 ON hc1.hospcode = ip1.hospmain
LEFT OUTER JOIN hospcode hc2 ON hc2.hospcode = ip1.hospsub
LEFT OUTER JOIN physic_pt_send pr1 ON pr1.anvn = ipt.an
LEFT OUTER JOIN hospcode h2 ON h2.hospcode = ipt.hhc_hospcode
LEFT OUTER JOIN pttype ptt ON ptt.pttype = ip1.pttype
LEFT OUTER JOIN kskdepartment K ON K.depcode = ipt.cur_dep_code
LEFT OUTER JOIN ipt_summary_status iss ON iss.ipt_summary_status_id = ipt.ipt_summary_status_id
LEFT OUTER JOIN ipt_doctor_list il1 ON il1.an = ipt.an 
AND il1.ipt_doctor_type_id = 1 
AND il1.active_doctor = 'Y'
LEFT OUTER JOIN ipt_coll_stat ict ON ict.an = ipt.an
LEFT OUTER JOIN ipt_coll_status_type it ON it.ipt_coll_status_type_id = ict.ipt_coll_status_type_id
LEFT OUTER JOIN doctor dct1 ON dct1.code = il1.doctor 
WHERE
1 = 1 
-- 		and w.ward_active = 'Y'
AND ipt.confirm_discharge = 'N' 

GROUP BY  spclty.NAME,w.NAME,ipt.ward ";
$result_rt = pg_query($sql_rt);

$curdate = strtotime("now");
$lastday = strtotime("last day");
$day_3 = strtotime("-2 day");
$day_4 = strtotime("-3 day");
$day_5 = strtotime("-4 day");

$dhc_rt = //'<br><table class="table table-bordered " style= "margin-left:9px"> 
'<div class="container">
<table class="table">
<thead>
<tr>
<th class="text-center">แผนก</th>
<th class="text-center">รหัสวอร์ด</th>
<th class="text-center">วอร์ด</th>
<th class="text-center">จำนวนผู้ป่วยในวอร์ด</th>
<th class="text-center">รับเข้าในวัน</th>
<th class="text-center">จำหน่ายในวัน</th>
</tr>';
while ($row_result = pg_fetch_assoc($result_rt)) {
 $dhc_rt .= 
 '<tr>
 <td class="">'.$row_result['แผนก'].' </td>
 <td class="">'.$row_result['codeward'].' </td>
 <td class="text-center">'.$row_result['ward'].'</td>
 <td class="text-center">'.$row_result['จำนวนคนนอน'].'</td>
 <td class="text-center">'.$row_result['รับเข้าในวัน'].'</td>
 <td class="text-center">'.$row_result['จำหน่ายในวัน'].'</td>
 </tr>
 <thead>
 </div>';
}
$dhc_rt .= '</table><hr>';
echo json_encode($dhc_rt);
?>
