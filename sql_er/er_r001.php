<?php 
include "pg_con.class.php";
	$strSQL = "  SELECT CASE
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
	$objQuery = pg_query($strSQL) or die (pg_error());
	$intNumField = pg_num_fields($objQuery);
	$resultArray = array();
	while($obResult = pg_fetch_array($objQuery))
	{
		$arrCol = array();
		for($i=0;$i<$intNumField;$i++)
		{
			$arrCol[pg_field_name($objQuery,$i)] = $obResult[$i];
		}
		array_push($resultArray,$arrCol);
	}
	echo json_encode($resultArray);
?>