<?php
include "pg_con.class.php";
$sql_rt = " 	SELECT '5.มากกว่า 80 ปี' AS age,COUNT(*)AS cc	FROM 
(SELECT ov.hn,age(pt.birthday) As age FROM ovst ov
inner join patient pt on pt.hn = ov.hn and EXTRACT(YEAR FROM age(pt.birthday)) > '80'
where ov.vstdate = CURRENT_DATE
group by ov.hn,age)AS morethan80  ";
$result_rt = pg_query($sql_rt);
$row_rt = pg_fetch_array($result_rt);
$rty18 = $row_rt['cc'];
echo json_encode($rty18);
?>