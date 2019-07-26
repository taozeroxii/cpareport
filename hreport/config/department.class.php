<?php require "pg_con.class.php";
 	$load_department = $_GET['selector'];
    if($load_department == "load_department"){
    	$result= pg_query(" SELECT *  FROM kskdepartment 
							 WHERE  department NOT LIKE '%%(ยกเลิก)%%' 
							 AND department NOT LIKE '%%หอ%%'
							 AND department_active = 'Y'
							 AND spclty NOT IN ('00','10','19','22','23','24','27','28','32','34')");
							    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'depcode' => $row['depcode'],
							 'department'  => $row['department'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>