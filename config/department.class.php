<?php require "pg_con.class.php";
 	$load_department = $_GET['selector'];
    if($load_department == "load_department"){
    	$result= pg_query(" SELECT *  FROM kskdepartment WHERE roomno <> 'IPD' AND department NOT LIKE '%%(ยกเลิก)%%' AND department_active = 'Y' ");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'depcode' => $row['depcode'],
							 'department'  => $row['department'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>