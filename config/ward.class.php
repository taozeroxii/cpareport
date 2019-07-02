<?php require "pg_con.class.php";
 	$load_ward = $_GET['selector'];
    if($load_ward == "load_ward"){
    	$result= pg_query(" SELECT *  FROM ward WHERE  name NOT LIKE '%%(ยกเลิก)%%' AND ward_active = 'Y' ");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
	$resultArray[] =  array( 'ward' => $row['ward'],
							 'name'  => $row['name'], 
							 );
 		} 
 		echo json_encode($resultArray);
    }
?>