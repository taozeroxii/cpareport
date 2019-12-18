<?php require "pg_con.class.php";
 	$room = $_GET['selector'];
    if($room == "room"){
    	$result= pg_query("SELECT * FROM kskdepartment where department not like 'ฮ%%' and department_active ='Y'");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'code' => $row['depcode'],
							 'name'  => $row['department'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>