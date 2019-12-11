<?php 	require "pg_con.class.php";
 	$sss = $_GET['selector'];
    if($sss == "diagdental"){
    	$result= pg_query(" SELECT * from dttm where active_status = 'Y' order by code");
    	$resultArray = array();
		while($row= pg_fetch_assoc($result)) { 
			$resultArray[] =  array( 'code' => $row['code'],'name'  => $row['name'],'hos_guide' =>$row['hos_guid'], );
 		} 
 		echo json_encode($resultArray);
    }
?>