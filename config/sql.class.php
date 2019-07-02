<?php
// นัด วันนี้ แยก คลินิก
$sql = " SELECT CURRENT_DATE, C.NAME AS clinic_name ,count(C.NAME) as c_clinic
          FROM oapp o
          LEFT OUTER JOIN patient P ON P.hn = o.hn
          LEFT OUTER JOIN clinic C ON C.clinic = o.clinic
          LEFT OUTER JOIN doctor d ON d.code = o.doctor
          LEFT OUTER JOIN kskdepartment K ON K.depcode = o.depcode
          LEFT OUTER JOIN oapp_status o2 ON o2.oapp_status_id = o.oapp_status_id
          LEFT OUTER JOIN opduser o3 ON o3.loginname = o.app_user
          LEFT OUTER JOIN opd_qs_slot qs ON qs.opd_qs_slot_id = o.opd_qs_slot_id 
        WHERE o.nextdate = CURRENT_DATE
          AND (( o.oapp_status_id < 4 ) OR o.oapp_status_id IS NULL ) 
        GROUP BY clinic_name
        ORDER BY count(C.NAME) DESC ";
$result = pg_query($sql);

// นัด วันนี้ รวม
$sql_ap = " SELECT count(o.hn) as cc
        FROM oapp o
          LEFT OUTER JOIN patient P ON P.hn = o.hn
          LEFT OUTER JOIN clinic C ON C.clinic = o.clinic
          LEFT OUTER JOIN doctor d ON d.code = o.doctor
          LEFT OUTER JOIN kskdepartment K ON K.depcode = o.depcode
          LEFT OUTER JOIN oapp_status o2 ON o2.oapp_status_id = o.oapp_status_id
          LEFT OUTER JOIN opduser o3 ON o3.loginname = o.app_user
          LEFT OUTER JOIN opd_qs_slot qs ON qs.opd_qs_slot_id = o.opd_qs_slot_id 
        WHERE o.nextdate = CURRENT_DATE
          AND (( o.oapp_status_id < 4 ) OR o.oapp_status_id IS NULL ) ";
$result_app_t = pg_query($sql_ap);
$row_apt = pg_fetch_array($result_app_t);
$app_total = $row_apt['cc'];

// Admit วันนี้
$sql_admit = " SELECT count(an) AS cc FROM ipt WHERE  regdate = CURRENT_DATE ";
$result_admit = pg_query($sql_admit);
$row_readmit = pg_fetch_array($result_admit);
$admit_todate = $row_readmit['cc'];


// จำหน่าย วันนี้
$sql_dhc = " SELECT count(an)as cc FROM ipt WHERE  dchdate = CURRENT_DATE; ";
$result_dhc = pg_query($sql_dhc);
$row_dhc = pg_fetch_array($result_dhc);
$dhc_todate = $row_dhc['cc'];

// จำนวนผู้ป่วยใน ยังไม่จำหน่าย วันนี้/''

$sql_null = " SELECT count(an)as cc FROM ipt WHERE  dchdate IS NULL; ";
$result_null = pg_query($sql_null);
$row_null = pg_fetch_array($result_null);
$dhc_null = $row_null['cc'];

$bed      = 495 - $dhc_null;


//refer out
$sql_referout = " SELECT count(*) as fout FROM referout WHERE refer_date = CURRENT_DATE; ";
$result_referout = pg_query($sql_referout);
$row_referout = pg_fetch_array($result_referout);
$dhc_referout = $row_referout['fout'];

//refer in
$sql_referin = " SELECT count(*) as fin FROM referin  WHERE refer_date = CURRENT_DATE; ";
$result_referin = pg_query($sql_referin);
$row_referin = pg_fetch_array($result_referin);
$dhc_referin = $row_referin['fin'];

// จำนวนผู้รับบริการวันนี้ visit
$sql_vn = " SELECT count(vn) AS  cc FROM ovst WHERE  vstdate = CURRENT_DATE; ";
$result_vn = pg_query($sql_vn);
$row_vn = pg_fetch_array($result_vn);
$dhc_vn = $row_vn['cc'];


$sql_death = " SELECT count(*) AS  cc FROM death d
            LEFT OUTER JOIN patient pt ON pt.hn = d.hn
            LEFT OUTER JOIN rpt_504_name c1 ON c1.ID = CAST ( COALESCE ( d.death_cause, '0' ) AS INTEGER )
            LEFT OUTER JOIN icd101 i1 ON i1.code = d.death_diag_1 
            WHERE d.death_date = CURRENT_DATE; ";
$result_death = pg_query($sql_death);
$row_death = pg_fetch_array($result_death);
$dhc_death = $row_death['cc'];




$todate2 = date('m')-1;
$todate3 = date('Y');
if ($todate2 == 0) 
{
   $todate2 = 12;
   $todate3 = $todate3-1;
}
$todate = $todate3."-".$todate2."-";
if ($todate2 == 1 or $todate2 ==3 or $todate2 ==5 or $todate2 ==7 or $todate2 ==8 or $todate2 ==10 or $todate2 ==12) 
{
  $datein = $todate."1";
  $dateout = $todate."31";
}
elseif ($todate2 == 4 or $todate2 ==6 or $todate2 ==9 or $todate2 ==11) 
{
  $datein = $todate."1";
  $dateout = $todate."30";
}
elseif ($todate2 == 2 ) 
{
  $datein = $todate."1";
  if ($todate3 %4 == 0) $dateout = $todate."29";
  else $dateout == $todate."28";
}


$todate_mback_start = $datein;
$todate_mback_stop  = $dateout;

$sql_diag_ipd = " SELECT  a.pdx,i.tname,count(a.*) as cc
                  from an_stat a
                  left outer join icd101 i on a.pdx=i.code
                  where a.dchdate between '".$datein."' AND '".$dateout."'
                  AND a.pdx not like 'Z%%' AND a.pdx <> '' AND a.pdx is not null
                  group by a.pdx,i.tname
                  order by count(a.*) desc
                  limit 10";
$result_diagipd = pg_query($sql_diag_ipd);



$sql_diag_opd = " SELECT a.icd10,b.tname,COUNT(a.*) as cc
                  from ovstdiag as a
                  INNER join icd101 as b on b.code = a.icd10
                  where a.vstdate between '".$datein."' AND '".$dateout."'
                   AND a.icd10 not like 'Z%%' 
                   AND a.icd10 <> '' 
                   AND a.icd10 is not null
                   AND a.icd10 not like 'U%%'
                  group by a.icd10,b.tname
                  Order by cc DESC
                  limit 10 ";
$result_diagopd = pg_query($sql_diag_opd);




$sql_cmi = " SELECT  CASE 
          WHEN date_part('MONTH' ,i.dchdate) = 1 THEN 'ม.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 2 THEN 'ก.พ.' 
          WHEN date_part('MONTH' ,i.dchdate) = 3 THEN 'มี.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 4 THEN 'เม.ย.'
          WHEN date_part('MONTH' ,i.dchdate) = 5 THEN 'พ.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 6 THEN 'มิ.ย'
          WHEN date_part('MONTH' ,i.dchdate) = 7 THEN 'ก.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 8 THEN 'ส.ค'
          WHEN date_part('MONTH' ,i.dchdate) = 9 THEN 'ก.ย.'
          WHEN date_part('MONTH' ,i.dchdate) = 10 THEN 'ต.ค.'
          WHEN date_part('MONTH' ,i.dchdate) = 11 THEN 'พ.ย.'
          WHEN date_part('MONTH' ,i.dchdate) = 12 THEN 'ธ.ค.'
          ELSE '-'
          END AS md 
          ,date_part('MONTH' ,i.dchdate) as dm
          ,date_part('YEAR' ,i.dchdate) as yy
          ,ROUND(avg(adjrw),4) cmi_test
          ,ROUND(sum(adjrw)/count(an),4) as cmi
         FROM ipt i
          left join pttype p1 on i.pttype = p1.pttype
         WHERE i.dchdate between '2019-01-01' AND '2019-12-31'
         GROUP BY md,dm ,yy 
         ORDER BY yy,dm DESC
         LIMIT 6 ";
$row_cmi = pg_query($sql_cmi);





?>