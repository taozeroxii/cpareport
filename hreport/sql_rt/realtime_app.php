<?php 
include "pg_con.class.php";
$sql_rt = " SELECT count(o.hn) as cc
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
$result_rt = pg_query($sql_rt);
$row_rt = pg_fetch_array($result_rt);
$dhc_rt = $row_rt['cc'];
echo json_encode($dhc_rt);
?>