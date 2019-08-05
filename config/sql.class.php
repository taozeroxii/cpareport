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

//ER 

$sql_er1 = " SELECT CASE
        WHEN a.er_pt_type = '1' THEN 'ผู้ป่วยตรวจโรคทั่วไป'
        WHEN a.er_pt_type = '2' THEN 'ผู้ป่วยรับบริการอื่นๆ'
        WHEN a.er_pt_type = '3' THEN 'ผู้ป่วยฉุกเฉิน'
        WHEN a.er_pt_type = '4' THEN 'ผู้ป่วยอุบัติเหตุ(ทั่วไป)'
        WHEN a.er_pt_type = '5' THEN 'ผู้ป่วยอุบัติเหตุ(ยานพาหนะ)'
        ELSE ' - '
      END  AS erpt,
       SUM ( CASE WHEN  a.er_emergency_type = '1' THEN 1 ELSE 0 END ) AS  Resuscitate,
       SUM ( CASE WHEN  a.er_emergency_type = '2' THEN 1 ELSE 0 END ) AS  Emergency,
       SUM ( CASE WHEN  a.er_emergency_type = '3' THEN 1 ELSE 0 END ) AS  Urgent,
       SUM ( CASE WHEN  a.er_emergency_type = '4' THEN 1 ELSE 0 END ) AS  Ac_illness,
       SUM ( CASE WHEN  a.er_emergency_type = '5' THEN 1 ELSE 0 END ) AS  Non_Ac_illness
FROM er_regist a
inner join er_emergency_type  as c on c.er_emergency_type = a.er_emergency_type
INNER JOIN vn_stat        as b ON a.vn = b.vn
INNER JOIN er_pt_type     as d ON d.er_pt_type = a.er_pt_type
WHERE b.vstdate = CURRENT_DATE
AND a.er_pt_type IS NOT NULL
GROUP BY erpt
ORDER BY erpt ASC ";
$result_1 = pg_query($sql_er1);

$sql_er2 = " SELECT   es.er_refer_sender_name as sender
      ,SUM ( CASE WHEN  a.er_emergency_type = '1' THEN 1 ELSE 0 END ) AS  Resuscitate,
       SUM ( CASE WHEN  a.er_emergency_type = '2' THEN 1 ELSE 0 END ) AS  Emergency,
       SUM ( CASE WHEN  a.er_emergency_type = '3' THEN 1 ELSE 0 END ) AS  Urgent,
       SUM ( CASE WHEN  a.er_emergency_type = '4' THEN 1 ELSE 0 END ) AS  Ac_illness,
       SUM ( CASE WHEN  a.er_emergency_type = '5' THEN 1 ELSE 0 END ) AS  Non_Ac_illness
FROM er_regist a
inner join er_emergency_type    as c on c.er_emergency_type = a.er_emergency_type
INNER JOIN vn_stat as b ON a.vn = b.vn
INNER JOIN er_nursing_detail  as er ON er.vn = a.vn
INNER JOIN er_refer_sender as es ON es.er_refer_sender_id = er.er_refer_sender_id
WHERE b.vstdate = CURRENT_DATE
GROUP BY sender ";
$result_2 = pg_query($sql_er2);

$sql_er3 = " SELECT CASE
    WHEN er_leave_status_id = '1' THEN 'Admit'
    WHEN er_leave_status_id = '2' THEN 'Referทางกาย'
    WHEN er_leave_status_id = '3' THEN 'Referทางจิต'
    WHEN er_leave_status_id = '4' THEN 'รับยา'
    WHEN er_leave_status_id = '5' THEN 'Observe'
    WHEN er_leave_status_id = '6' THEN 'กลับบ้าน'
    WHEN er_leave_status_id = '7' THEN 'หนีกลับ'
    WHEN er_leave_status_id = '8' THEN 'ปฏิเสธการรักษา'   
    WHEN er_leave_status_id = '9' THEN 'ตาย'        
    ELSE ' - '
END  AS v_time,
       SUM ( CASE WHEN  a.er_emergency_type = '1' THEN 1 ELSE 0 END ) AS  Resuscitate,
       SUM ( CASE WHEN  a.er_emergency_type = '2' THEN 1 ELSE 0 END ) AS  Emergency,
       SUM ( CASE WHEN  a.er_emergency_type = '3' THEN 1 ELSE 0 END ) AS  Urgent,
       SUM ( CASE WHEN  a.er_emergency_type = '4' THEN 1 ELSE 0 END ) AS  Ac_illness,
       SUM ( CASE WHEN  a.er_emergency_type = '5' THEN 1 ELSE 0 END ) AS  Non_Ac_illness
FROM er_regist a
inner join er_emergency_type    as c on c.er_emergency_type = a.er_emergency_type
inner join er_emergency_level   as d on d.er_emergency_level_id = c.er_emergency_type
INNER JOIN vn_stat as b ON a.vn = b.vn
WHERE b.vstdate = CURRENT_DATE
AND er_leave_status_id IS NOT NULL
GROUP BY v_time
ORDER BY v_time ASC ";
$result_3 = pg_query($sql_er3);

$sql_er4 = " SELECT e.name AS job,
       SUM ( CASE WHEN  a.er_emergency_type = '1' THEN 1 ELSE 0 END ) AS  Resuscitate,
       SUM ( CASE WHEN  a.er_emergency_type = '2' THEN 1 ELSE 0 END ) AS  Emergency,
       SUM ( CASE WHEN  a.er_emergency_type = '3' THEN 1 ELSE 0 END ) AS  Urgent,
       SUM ( CASE WHEN  a.er_emergency_type = '4' THEN 1 ELSE 0 END ) AS  Ac_illness,
       SUM ( CASE WHEN  a.er_emergency_type = '5' THEN 1 ELSE 0 END ) AS  Non_Ac_illness
FROM er_regist a
inner join er_emergency_type    as c on c.er_emergency_type = a.er_emergency_type
inner join er_emergency_level   as d on d.er_emergency_level_id = c.er_emergency_type
inner join er_period            as e on e.er_period = a.er_period
INNER JOIN vn_stat as b ON a.vn = b.vn
WHERE a.vstdate  = CURRENT_DATE
AND a.er_period IS NOT NULL
GROUP BY job
ORDER BY job ASC ";
$result_4 = pg_query($sql_er4);

/*
Resuscitate (กู้ชีพทันที)
Emergency (ฉุกเฉินเร่งด่วน)
Urgency (ด่วนมาก)
Semi Urgency (ด่วน)
Non Urgency (รอได้)
*/

$sql_er5 = " SELECT   es.er_refer_hosptype_name as hos
      ,SUM ( CASE WHEN  a.er_emergency_type = '1' THEN 1 ELSE 0 END ) AS  Resuscitate,
       SUM ( CASE WHEN  a.er_emergency_type = '2' THEN 1 ELSE 0 END ) AS  Emergency,
       SUM ( CASE WHEN  a.er_emergency_type = '3' THEN 1 ELSE 0 END ) AS  Urgent,
       SUM ( CASE WHEN  a.er_emergency_type = '4' THEN 1 ELSE 0 END ) AS  Ac_illness,
       SUM ( CASE WHEN  a.er_emergency_type = '5' THEN 1 ELSE 0 END ) AS  Non_Ac_illness
FROM er_regist a
inner join er_emergency_type    as c on c.er_emergency_type = a.er_emergency_type
INNER JOIN vn_stat as b ON a.vn = b.vn
INNER JOIN er_nursing_detail  as er ON er.vn = a.vn
INNER JOIN er_refer_hosptype as es ON es.er_refer_hosptype_id = er.er_refer_hosptype_id
WHERE b.vstdate  = CURRENT_DATE
GROUP BY hos ";
$result_5 = pg_query($sql_er5);

$sql_er6 = " SELECT w.name as wardname
       ,SUM ( CASE WHEN  a.er_emergency_type = '1' THEN 1 ELSE 0 END ) AS  Resuscitate,
       SUM ( CASE WHEN  a.er_emergency_type = '2' THEN 1 ELSE 0 END ) AS  Emergency,
       SUM ( CASE WHEN  a.er_emergency_type = '3' THEN 1 ELSE 0 END ) AS  Urgent,
       SUM ( CASE WHEN  a.er_emergency_type = '4' THEN 1 ELSE 0 END ) AS  Ac_illness,
       SUM ( CASE WHEN  a.er_emergency_type = '5' THEN 1 ELSE 0 END ) AS  Non_Ac_illness
FROM er_regist a
inner join er_emergency_type    as c on c.er_emergency_type = a.er_emergency_type
inner join er_emergency_level   as d on d.er_emergency_level_id = c.er_emergency_type
INNER JOIN vn_stat              as b ON a.vn = b.vn
INNER JOIN ipt                  as i ON i.vn = a.vn 
INNER JOIN ward                 as w ON w.ward = i.ward
WHERE b.vstdate = CURRENT_DATE
AND er_leave_status_id IS NOT NULL
GROUP BY wardname
ORDER BY wardname ASC ";
$result_6 = pg_query($sql_er6);

$sql_er7 = " SELECT CASE
    WHEN b.age_y BETWEEN '0'  AND '4'   THEN '00-04'
    WHEN b.age_y BETWEEN '5'  AND '9'   THEN '05-09'
    WHEN b.age_y BETWEEN '10' AND '14'  THEN '10-14'
    WHEN b.age_y BETWEEN '15' AND '19'  THEN '15-19'
    WHEN b.age_y BETWEEN '20' AND '24'  THEN '20-24'
    WHEN b.age_y BETWEEN '25' AND '29'  THEN '25-29'
    WHEN b.age_y BETWEEN '30' AND '34'  THEN '30-34'    
    WHEN b.age_y BETWEEN '35' AND '39'  THEN '35-39'  
    WHEN b.age_y BETWEEN '40' AND '44'  THEN '40-44'  
    WHEN b.age_y BETWEEN '45' AND '49'  THEN '45-49'  
    WHEN b.age_y BETWEEN '50' AND '54'  THEN '50-54'  
    WHEN b.age_y BETWEEN '55' AND '59'  THEN '55-59'  
    WHEN b.age_y BETWEEN '60' AND '64'  THEN '60-64'  
    WHEN b.age_y BETWEEN '65' AND '69'  THEN '65-69'  
    WHEN b.age_y BETWEEN '70' AND '74'  THEN '70-74'  
    WHEN b.age_y > '74'                 THEN '> 74' 
    ELSE ' '
END  AS อายุ
      ,SUM ( CASE WHEN  a.er_emergency_type = '1' THEN 1 ELSE 0 END ) AS  Resuscitate,
       SUM ( CASE WHEN  a.er_emergency_type = '2' THEN 1 ELSE 0 END ) AS  Emergency,
       SUM ( CASE WHEN  a.er_emergency_type = '3' THEN 1 ELSE 0 END ) AS  Urgent,
       SUM ( CASE WHEN  a.er_emergency_type = '4' THEN 1 ELSE 0 END ) AS  Ac_illness,
       SUM ( CASE WHEN  a.er_emergency_type = '5' THEN 1 ELSE 0 END ) AS  Non_Ac_illness
FROM er_regist a
inner join er_emergency_type    as c on c.er_emergency_type = a.er_emergency_type
inner join er_emergency_level   as d on d.er_emergency_level_id = c.er_emergency_type
INNER JOIN vn_stat as b ON a.vn = b.vn
WHERE a.vstdate = CURRENT_DATE
GROUP BY อายุ
ORDER BY อายุ ASC
 ";
$result_7 = pg_query($sql_er7);

$sql_er8 = " SELECT CASE
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '00:00:00' AND '00:59:59'  THEN '00.00 - 00.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '01:00:00' AND '01:59:59'  THEN '01.00 - 01.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '02:00:00' AND '02:59:59'  THEN '02.00 - 02.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '03:00:00' AND '03:59:59'  THEN '03.00 - 03.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '04:00:00' AND '04:59:59'  THEN '04.00 - 04.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '05:00:00' AND '05:59:59'  THEN '05.00 - 05.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '06:00:00' AND '06:59:59'  THEN '06.00 - 06.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '07:00:00' AND '07:59:59'  THEN '07.00 - 07.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '08:00:00' AND '08:59:59'  THEN '08.00 - 08.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '09:00:00' AND '09:59:59'  THEN '09.00 - 09.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '10:00:00' AND '10:59:59'  THEN '10.00 - 10.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '11:00:00' AND '11:59:59'  THEN '11.00 - 11.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '12:00:00' AND '12:59:59'  THEN '12.00 - 12.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '13:00:00' AND '13:59:59'  THEN '13.00 - 13.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '14:00:00' AND '14:59:59'  THEN '14.00 - 14.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '15:00:00' AND '15:59:59'  THEN '15.00 - 15.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '16:00:00' AND '16:59:59'  THEN '16.00 - 16.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '17:00:00' AND '17:59:59'  THEN '17.00 - 17.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '18:00:00' AND '18:59:59'  THEN '18.00 - 18.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '19:00:00' AND '19:59:59'  THEN '19.00 - 19.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '20:00:00' AND '20:59:59'  THEN '20.00 - 20.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '21:00:00' AND '21:59:59'  THEN '21.00 - 21.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '22:00:00' AND '22:59:59'  THEN '22.00 - 22.59'
    WHEN to_char(enter_er_time,'HH24:MI:SS') BETWEEN '23:00:00' AND '23:59:59'  THEN '23.00 - 23.59'
    ELSE ' - '
END  AS v_time,
       SUM ( CASE WHEN  a.er_emergency_type = '1' THEN 1 ELSE 0 END ) AS  Resuscitate,
       SUM ( CASE WHEN  a.er_emergency_type = '2' THEN 1 ELSE 0 END ) AS  Emergency,
       SUM ( CASE WHEN  a.er_emergency_type = '3' THEN 1 ELSE 0 END ) AS  Urgent,
       SUM ( CASE WHEN  a.er_emergency_type = '4' THEN 1 ELSE 0 END ) AS  Ac_illness,
       SUM ( CASE WHEN  a.er_emergency_type = '5' THEN 1 ELSE 0 END ) AS  Non_Ac_illness
FROM er_regist a
inner join er_emergency_type    as c on c.er_emergency_type = a.er_emergency_type
inner join er_emergency_level   as d on d.er_emergency_level_id = c.er_emergency_type
INNER JOIN vn_stat as b ON a.vn = b.vn
WHERE b.vstdate = CURRENT_DATE
GROUP BY v_time
ORDER BY v_time ASC ";
$result_8 = pg_query($sql_er8);
?>